<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/13/2016
 * Time: 2:11 AM
 */
class Attempt extends CI_Controller
{
    function generateAttemptId()
    {
        $this->load->model('AttemptModel');
        // get the last answer id from the database
        $answerIdData = $this->AttemptModel->getLastAnswerId();

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
}