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

        $questionIds = [];
        foreach ($questionsFromDb as $question) {
            array_push($questionIds, $question->question_id);
        }

        //load the session library
        $this->load->library('session');
        //save question numbers in the session
        $this->session->set_userdata('questionIds', $questionIds);
        $this->session->set_userdata('correctQuestions', array());
        $this->session->set_userdata('wrongQuestions', array());

        $this->loadQuestion(0, true);
    }

    function loadQuestion($index, $answerProvided)
    {
        //load the session library
        $this->load->library('session');
        $questionId = $this->session->userdata('questionIds')[$index];

        $this->load->model('QuestionModel');
        $questionData['query'] = $this->QuestionModel->getQuestionData($questionId);

        $answerData = $this->QuestionModel->getAnswersForAQuestion($questionId);

        $questionData['query'][0]->question_number = $index + 1;

        $answers = [];
        foreach ($answerData as $data) {
            array_push($answers, array($data->answer_description, $data->answer_id));
        }

        $questionData['query'][0]->answers = $answers;
        $questionData['query'][0]->answerProvided = $answerProvided;
        $this->load->view('QuestionView', $questionData);
    }

    function checkAnswers()
    {
        if (isset($_GET['answer'])) {
            $this->load->model('QuestionModel');
            $answerResponse = $this->QuestionModel->getCorrectAnswerForAQuestion();

            //load the session library
            $this->load->library('session');
            if ($answerResponse[3] === "correct") {
                $correctQuestions = $this->session->userdata('correctQuestions');
                array_push($correctQuestions, $answerResponse[1]);
                $this->session->set_userdata('correctQuestions', $correctQuestions);
            } else {
                $wrongQuestions = $this->session->userdata('wrongQuestions');
                array_push($wrongQuestions, $answerResponse[1]);
                $this->session->set_userdata('wrongQuestions', $wrongQuestions);
            }
            if ($answerResponse[0] < 10) {
                $this->loadQuestion($answerResponse[0], true);
            } else {
                $this->generateFeedback();
            }
        } else {
            $this->loadQuestion($_GET['question_number'] - 1, false);
        }
    }

    function generateFeedback()
    {
        //load the session library
        $this->load->library('session');
        $correctQuestions = $this->session->userdata('correctQuestions');
        $wrongQuestions = $this->session->userdata('wrongQuestions');

        foreach ($correctQuestions as $value) {
            print_r($value);
        }

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

    function viewAnswerDescription()
    {
        $this->load->library('session');
        $questionIds = $this->session->userdata('questionIds');
        $correctQuestionIds = $this->session->userdata('correctQuestions');
        $wrongQuestionIds = $this->session->userdata('wrongQuestions');


        $feedbackSummary['query'] = array();

        foreach ($questionIds as $questionId) {
            $this->load->model('QuestionModel');

            foreach ($correctQuestionIds as $cqId) {
                if ($questionId == $cqId) {
                    $answerResponse = $this->QuestionModel->getQuestionData($questionId);
                    print_r($answerResponse);
                    $data = array($questionId, "correct", $answerResponse[0]->question_detail);
                    array_push($feedbackSummary['query'], $data);
                }
            }

            foreach ($wrongQuestionIds as $wqId) {
                if ($questionId == $wqId) {
                    $answerResponse = $this->QuestionModel->getQuestionData($questionId);
                    $data = array($questionId, "correct", $answerResponse[0]->question_detail);
                    array_push($feedbackSummary['query'], $data);
                }
            }
        }

        $this->load->view('FeedbackDescriptionView',$feedbackSummary);
    }

}
