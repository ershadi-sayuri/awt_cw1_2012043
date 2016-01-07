<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionModel
 *
 * @author Ershadi
 */
class QuestionModel extends CI_Model
{
    /**
     * get 3 random questions from the database with difficulty level 1
     * @return mixed
     */
    function getThreeRandomStatusOneQuestions()
    {
        $this->load->database();
        $query = $this->db->query("SELECT question_id FROM question WHERE difficulty=1 ORDER BY RAND() LIMIT 3");
        return $query->result();
    }

    /**
     * get 4 random questions from the database with difficulty level 2
     * @return mixed
     */
    function getFourRandomStatusTwoQuestions()
    {
        $this->load->database();
        $query = $this->db->query("SELECT question_id FROM question WHERE difficulty=2 ORDER BY RAND() LIMIT 4");
        return $query->result();
    }

    /**
     * get 3 random questions from the database with difficulty level 3
     * @return mixed
     */
    function getThreeRandomStatusThreeQuestions()
    {
        $this->load->database();
        $query = $this->db->query("SELECT question_id FROM question WHERE difficulty=3 ORDER BY RAND() LIMIT 3");
        return $query->result();
    }

    /**
     * get question data from the database for a given question id
     * @param $question_id
     * @return mixed
     */
    function getQuestionData($question_id)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM question WHERE question_id='$question_id'");
        return $query->result();
    }

    /**
     * get answers for a question from answer table using question id
     * @param $question_id
     * @return mixed
     */
    function getAnswersForAQuestion($question_id)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM answer WHERE question_id='$question_id'");
        return $query->result();
    }

    /**
     * get the correct answer for a question from answer table using the status 1
     * @return array
     */
    function getCorrectAnswerForAQuestion()
    {
        $question_number = $_GET['question_number'];
        $question_id = $_GET['question_id'];
        $given_answer_id = $_GET['answer'];

        $this->load->database();
        $query = $this->db->query("SELECT * FROM answer WHERE question_id='$question_id' && status=1");

        if ($given_answer_id === $query->result()[0]->answer_id) {
            return array($question_number, $question_id, $given_answer_id, "correct");
        } else {
            return array($question_number, $question_id, $given_answer_id, "wrong");
        }
    }

    /**
     * get all questions from the database
     * @return mixed
     */
    function getAllQuestions()
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM question");
        return $query->result();
    }
}
