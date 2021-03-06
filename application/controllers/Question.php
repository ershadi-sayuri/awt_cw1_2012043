<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author Ershadi
 */
class Question extends CI_Controller
{

    /**
     * 3 questions with the difficulty level 1
     * 4 questions with the difficulty level 2
     * 3 questions with the difficulty level 3
     */
    function loadTenQuestionIds()
    {
        $this->load->model('QuestionModel');
        $statusOneQuestionIds = $this->QuestionModel->getThreeRandomStatusOneQuestions();
        $statusTwoQuestionIds = $this->QuestionModel->getFourRandomStatusTwoQuestions();
        $statusThreeQuestionIds = $this->QuestionModel->getThreeRandomStatusThreeQuestions();

        $questionsFromDb = array_merge($statusOneQuestionIds, $statusTwoQuestionIds, $statusThreeQuestionIds);

        // array to keep randomly selected question ids
        $questionIds = [];
        foreach ($questionsFromDb as $question) {
            array_push($questionIds, $question->question_id);
        }

        // load the session library
        $this->load->library('session');
        //set question id array, correct question number id array & wrong question number id array in the session
        $this->session->set_userdata('questionIds', $questionIds);
        $this->session->set_userdata('correctQuestions', array());
        $this->session->set_userdata('wrongQuestions', array());

        // save user attempt
        $this->saveAttempt();

        $this->loadQuestion(0, true);
    }

    /**
     * @param $index of the question id array stored in the session
     * @param $answerProvided boolean value to indicate whether the user has provided answers
     */
    function loadQuestion($index, $answerProvided)
    {
        // load the session library
        $this->load->library('session');
        $questionId = $this->session->userdata('questionIds')[$index];

        $this->load->model('QuestionModel');
        $questionData['query'] = $this->QuestionModel->getQuestionData($questionId);

        $answerData = $this->QuestionModel->getAnswersForAQuestion($questionId);

        // question number = $index + 1
        $questionData['query'][0]->question_number = $index + 1;

        // get the answers for a question and adding it to  the answers array
        $answers = [];
        foreach ($answerData as $data) {
            array_push($answers, array($data->answer_description, $data->answer_id));
        }

        $questionData['query'][0]->answers = $answers;
        $questionData['query'][0]->answerProvided = $answerProvided;

        $this->load->view('QuestionView', $questionData);
    }

    /**
     * function to check answers when user clicks next/submit
     */
    function checkAnswers()
    {
        // check if a user has selected an answer
        if (isset($_GET['answer'])) {
            $this->load->model('QuestionModel');
            $answerResponse = $this->QuestionModel->getCorrectAnswerForAQuestion();

            //load the session library
            $this->load->library('session');
            // if answer is correct add the question id to correct question id array
            if ($answerResponse[3] === "correct") {
                $correctQuestions = $this->session->userdata('correctQuestions');
                array_push($correctQuestions, $answerResponse[1]);
                $correctQuestions = array_unique($correctQuestions);
                $this->session->set_userdata('correctQuestions', $correctQuestions);

                $this->saveAttemptQuestion($_GET['question_id'], 1);

            } else {
                // if answer is wrong add the question id to wrong question id array
                $wrongQuestions = $this->session->userdata('wrongQuestions');
                array_push($wrongQuestions, $answerResponse[1]);
                $wrongQuestions = array_unique($wrongQuestions);
                $this->session->set_userdata('wrongQuestions', $wrongQuestions);

                $this->saveAttemptQuestion($_GET['question_id'], 0);
            }

            if ($answerResponse[0] < 10) {
                // load next question
                $this->loadQuestion($answerResponse[0], true);
            } else {
                $this->generateFeedback();
            }
        } else {
            // load the same question if user has nt selected an answer
            $this->loadQuestion($_GET['question_number'] - 1, false);
        }
    }

    /**
     * function to generate feedback in the end of the questionnaire
     */
    function generateFeedback()
    {
        //load the session library
        $this->load->library('session');
        $correctQuestions = $this->session->userdata('correctQuestions');

        // set a feedback message according to the number of correct answers
        $feedback = "";
        if (sizeof($correctQuestions) < 3) {
            $feedback = "You have to improve your knowledge";
        } else if (sizeof($correctQuestions) < 6) {
            $feedback = "Average, You have to improve your knowledge";
        } else if (sizeof($correctQuestions) < 9) {
            $feedback = "Good. But you have to improve your knowledge on some basics";
        } else if (sizeof($correctQuestions) < 10) {
            $feedback = "Great! You have a good knowledge in PHP basics.";
        }

        $feedbackData['query'] = array(sizeof($correctQuestions), $feedback);
        $this->load->view('FeedbackView', $feedbackData);
    }

    /**
     * function to view feedback summary
     */
    function viewAnswerDescription()
    {
        $this->load->library('session');
        $questionIds = $this->session->userdata('questionIds');
        $correctQuestionIds = $this->session->userdata('correctQuestions');
        $wrongQuestionIds = $this->session->userdata('wrongQuestions');

        /**
         * creates feedbackSummary array with question number, whether the answer is correct or not and the
         * theory/answer of the question
         */
        $feedbackSummary['query'] = array();

        foreach ($questionIds as $key => $questionId) {
            $this->load->model('QuestionModel');

            foreach ($correctQuestionIds as $cqId) {
                if ($questionId == $cqId) {
                    $answerResponse = $this->QuestionModel->getQuestionData($questionId);
                    $data = array($key + 1, "correct", $answerResponse[0]->explanation);
                }
            }

            foreach ($wrongQuestionIds as $wqId) {
                if ($questionId == $wqId) {
                    $answerResponse = $this->QuestionModel->getQuestionData($questionId);
                    $data = array($key + 1, "wrong", $answerResponse[0]->explanation);
                }
            }

            if (!in_array($data, $feedbackSummary['query'], true)) {
                array_push($feedbackSummary['query'], $data);
            }
        }

        $this->load->view('FeedbackDescriptionView', $feedbackSummary);
    }

    /**
     * function to load all the questions
     * @return mixed
     */
    function loadAllQuestions()
    {
        $this->load->model('QuestionModel');
        $questions = $this->QuestionModel->getAllQuestions();
        echo json_encode($questions);
    }

    /**
     * generate new question id
     * @return string
     */
    function generateQuestionId()
    {
        $this->load->model('QuestionModel');
        // get the last question id from the database
        $questionIdData = $this->QuestionModel->getLastQuestionId();

        // substring it and removed  the prefix to get the integer value
        $lastQuestionId = substr($questionIdData[0]->question_id, 1);
        // add 1 to it
        $questionId = intval($lastQuestionId) + 1;

        $newQuestionId = "";
        // added the prefix again, inorder to make $questionId id contains 4 characters
        if ($questionId < 10) {
            $newQuestionId = "Q00" . $questionId;
        } else if ($questionId < 100) {
            $newQuestionId = "Q0" . $questionId;
        } else if ($questionId < 1000) {
            $newQuestionId = "Q" . $questionId;
        }

        return $newQuestionId;
    }

    /**
     * save new question in the database
     */
    function saveQuestion()
    {
        $questionId = $this->generateQuestionId();
        $json_data = json_decode(file_get_contents('php://input'));
        $questionData = array(
            'question_id' => $questionId,
            'question' => $json_data->{'question'},
            'difficulty' => $json_data->{'difficulty'},
            'explanation' => $json_data->{'explanation'}
        );
        $this->load->model('QuestionModel');
        // saves question
        $add_question_status = $this->QuestionModel->saveQuestion($questionData);


        $answerId1 = $this->generateAnswerId();
        $answerData1 = array(
            'answer_id' => $answerId1,
            'question_id' => $questionId,
            'status' => $json_data->{'answer1Status'},
            'answer_description' => $json_data->{'answer1'}
        );

        // saves answer
        $add_answer_status1 = $this->QuestionModel->saveAnswer($answerData1);

        $answerId2 = $this->generateAnswerId();
        $answerData2 = array(
            'answer_id' => $answerId2,
            'question_id' => $questionId,
            'status' => $json_data->{'answer2Status'},
            'answer_description' => $json_data->{'answer2'}
        );

        // saves answer
        $add_answer_status2 = $this->QuestionModel->saveAnswer($answerData2);

        $answerId3 = $this->generateAnswerId();
        $answerData3 = array(
            'answer_id' => $answerId3,
            'question_id' => $questionId,
            'status' => $json_data->{'answer3Status'},
            'answer_description' => $json_data->{'answer3'}
        );

        // saves answer
        $add_answer_status3 = $this->QuestionModel->saveAnswer($answerData3);

        // responce is made as a json string
        echo json_encode(array("question_status" => $add_question_status,
            "answer_status" => array($add_answer_status1, $add_answer_status2, $add_answer_status3)));
    }

    /**
     * generate new answer id
     * @return string
     */
    function generateAnswerId()
    {
        $this->load->model('QuestionModel');
        // get the last answer id from the database
        $answerIdData = $this->QuestionModel->getLastAnswerId();

        // substring it and removed  the prefix to get the integer value
        $lastAnswerId = substr($answerIdData[0]->answer_id, 1);
        // add 1 to it
        $answerId = intval($lastAnswerId) + 1;

        $newAnswerId = "";
        // added the prefix again, inorder to make answer id contains 4 characters
        if ($answerId < 10) {
            $newAnswerId = "A00" . $answerId;
        } else if ($answerId < 100) {
            $newAnswerId = "A0" . $answerId;
        } else if ($answerId < 1000) {
            $newAnswerId = "A" . $answerId;
        }

        return $newAnswerId;
    }

    /**
     * get question data from the database for a given question id
     */
    function getQuestionData()
    {
        //"get segment 1 , question segment 2 , (:any) segment 3
        $question_id = $this->uri->segment(3);
        $this->load->model('QuestionModel');
        $questionData = $this->QuestionModel->getQuestionData($question_id);
        $answerData = $this->QuestionModel->getAnswersForAQuestion($question_id);

        $QuestionString1 = substr(json_encode($questionData[0]), 1, -1);

        // answer data
        $QuestionString2 = "\"answer1Id\":\"" . $answerData[0]->answer_id . "\",\"answer1\":\"" .
            $answerData[0]->answer_description . "\",\"answer1Status\":\"" . $answerData[0]->status .
            "\",\"answer2Id\":\"" . $answerData[1]->answer_id . "\",\"answer2\":\"" . $answerData[1]->answer_description
            . "\",\"answer2Status\":\"" . $answerData[1]->status . "\",\"answer3Id\":\"" . $answerData[2]->answer_id .
            "\",\"answer3\":\"" . $answerData[2]->answer_description . "\",\"answer3Status\":\"" .
            $answerData[2]->status . "\"";

        $result = "{" . $QuestionString1 . "," . $QuestionString2 . "}";
        echo $result;
    }

    /**
     * get answer data from question_id
     */
    function getAnswerData()
    {
        //"get segment 1 , question segment 2 , (:any) segment 3
        $question_id = $this->uri->segment(3);
        $this->load->model('QuestionModel');
        $answerData = $this->QuestionModel->getAnswersForAQuestion($question_id);
    }

    /**
     * update question
     */
    function updateQuestionData()
    {
        //"get segment 1 , question segment 2 , (:any) segment 3
        $question_id = $this->uri->segment(3);
        $json_data = json_decode(file_get_contents('php://input'));

        $questionData = array(
            'question_id' => $question_id,
            'question' => $json_data->{'question'},
            'difficulty' => $json_data->{'difficulty'},
            'explanation' => $json_data->{'explanation'}
        );

        $this->load->model('QuestionModel');
        //update question
        $update_question_status = $this->QuestionModel->updateQuestion($questionData, $question_id);

        $answerId1 = $this->generateAnswerId();
        $answerData1 = array(
            'answer_id' => $answerId1,
            'question_id' => $question_id,
            'status' => $json_data->{'answer1Status'},
            'answer_description' => $json_data->{'answer1'}
        );

        // update answer
        $update_answer_status1 = $this->QuestionModel->updateAnswer($answerData1, $answerId1);

        $answerId2 = $this->generateAnswerId();
        $answerData2 = array(
            'answer_id' => $answerId2,
            'question_id' => $question_id,
            'status' => $json_data->{'answer2Status'},
            'answer_description' => $json_data->{'answer2'}
        );

        $update_answer_status2 = $this->QuestionModel->updateAnswer($answerData2, $answerId2);

        $answerId3 = $this->generateAnswerId();
        $answerData3 = array(
            'answer_id' => $answerId3,
            'question_id' => $question_id,
            'status' => $json_data->{'answer3Status'},
            'answer_description' => $json_data->{'answer3'}
        );

        $update_answer_status3 = $this->QuestionModel->updateAnswer($answerData3, $answerId3);

        echo json_encode(array("question_status" => $update_question_status,
            "answer_status" => array($update_answer_status1, $update_answer_status2, $update_answer_status3)));
    }

    /**
     * delete question from an id
     */
    function deleteQuestion()
    {
        //"get segment 1 , question segment 2 , (:any) segment 3
        $question_id = $this->uri->segment(3);
        $this->load->model('QuestionModel');
        $question = new QuestionModel();
        $delete_question_status = $question->deleteQuestion($question_id);
        echo json_encode(array("delete_question_status" => $delete_question_status));
    }

    /**
     * save attempt data of a user
     * attempt is made when the user views the first question
     */
    function saveAttempt()
    {
        $attemptId = $this->generateAttemptId();

        $this->load->library('session');
        $this->session->set_userdata('attemptId', $attemptId);
        $user_id = $this->session->userdata('user')->user_id;

        $attemptData = array(
            'attempt_id' => $attemptId,
            'user_id' => $user_id,
        );
        $this->load->model('AttemptModel');

        $saveAttemptStatus = $this->AttemptModel->saveAttempt($attemptData);

        return json_encode(array("attempt_status" => $saveAttemptStatus));
    }

    /**
     * generate attempt id
     * @return string
     */
    function generateAttemptId()
    {
        $this->load->model('AttemptModel');
        // get the last answer id from the database
        $attemptIdData = $this->AttemptModel->getLastAttemptId();

        if (json_encode($attemptIdData) == "[]") {
            $newAttemptId = "T001";
        } else {
            // substring it and removed  the prefix to get the integer value
            $lastAttemptId = substr($attemptIdData[0]->attempt_id, 1);
            // add 1 to it
            $attemptId = intval($lastAttemptId) + 1;

            $newAnswerId = "";
            // added the prefix again, inorder to make answer id contains 4 characters
            if ($attemptId < 10) {
                $newAttemptId = "T00" . $attemptId;
            } else if ($attemptId < 100) {
                $newAttemptId = "T0" . $attemptId;
            } else if ($attemptId < 1000) {
                $newAttemptId = "T" . $attemptId;
            }
        }

        return $newAttemptId;
    }

    /**
     * save the question of an attempt with its status 0/1 indication wrong/correct
     * @param $questionId
     * @param $status
     * @return string
     */
    function saveAttemptQuestion($questionId, $status)
    {
        $this->load->library('session');
        $attemptId = $this->session->userdata('attemptId');
        $attemptQuestionData = array(
            'aq_attempt_id' => $attemptId,
            'aq_question_id' => $questionId,
            'status' => $status,
        );
        $this->load->model('AttemptModel');
        $saveAttemptQuestionStatus = $this->AttemptModel->saveAttemptQuestion($attemptQuestionData);
        return json_encode(array("attempt_question_status" => $attemptQuestionData));
    }

    /**
     * load view to show the user progress
     */
    function viewProgress()
    {
        $this->load->view('ProgressView');
    }

    /**
     * load data to progress graph
     */
    function loadProgress()
    {
        $this->load->library('session');
        $user_id = $this->session->userdata('user')->user_id;

        $this->load->model('AttemptModel');
        $attempts = $this->AttemptModel->getUserAttempts($user_id);

        $attempt_scores = [];

        foreach ($attempts as $attempt) {
            $attempt_questions = $this->AttemptModel->getUserAttemptStatus($attempt->attempt_id);
            $attempt_score = 0;

            foreach ($attempt_questions as $attempt_question) {

                if ($attempt_question->status == 1) {
                    // calculate attempt score
                    $attempt_score = $attempt_score + 1;
                }
            }
            // generate attempt score
            $attempt_score = $attempt_score *10;

            array_push($attempt_scores, array("attempt_id" => $attempt->attempt_id, "attempt_score" => $attempt_score));
        }
        echo json_encode(array("question_status" => $attempt_scores));
    }

}
