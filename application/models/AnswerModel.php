<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/9/2016
 * Time: 12:51 AM
 */
class AnswerModel extends CI_Model
{
    /**
     * gets the last answer id from the database
     * this is used to generate the next answer id
     * @return mixed
     */
    function getLastAnswerId()
    {
        $this->load->database();
        $query = $this->db->query("SELECT answer_id FROM answer ORDER BY answer_id DESC LIMIT 1");
        return $query->result();
    }

    /**
     * add new answer
     * @param $data
     * @return mixed
     */
    function addNewAnswer($data)
    {
        $this->load->database();
        $result = $this->db->insert('answer',$data);
        return $result;
    }
}