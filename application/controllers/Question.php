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
//        $this->load->view('QuestionView', $questionData);
        $this->load->view('AdminView', $questionData);
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
            } else {
                // if answer is wrong add the question id to wrong question id array
                $wrongQuestions = $this->session->userdata('wrongQuestions');
                array_push($wrongQuestions, $answerResponse[1]);
                $wrongQuestions = array_unique($wrongQuestions);
                $this->session->set_userdata('wrongQuestions', $wrongQuestions);
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

}
