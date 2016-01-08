<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/9/2016
 * Time: 12:55 AM
 */
class Answer extends CI_Controller
{
    /**
     * generate new answer id
     * @return string
     */
    function generateAnswerId()
    {
        $this->load->model('AnswerModel');
        // get the last answer id from the database
        $answerIdData = $this->AnswerModel->getLastAnswerId();

        // substring it and removed  the prefix to get the integer value
        $lastAnswerId = substr($answerIdData[0]->answer_id, 1);
        // add 1 to it
        $answerId = intval($lastAnswerId) + 1;

        $newAnswerId = "";
        // added the prefix again, inorder to make answer id contains 4 characters
        if ($answerId < 10) {
            $newAnswerId = "U00" . $answerId;
        } else if ($answerId < 100) {
            $newAnswerId = "U0" . $answerId;
        } else if ($answerId < 1000) {
            $newAnswerId = "U" . $answerId;
        }

        return $newAnswerId;
    }
}