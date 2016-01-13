<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/13/2016
 * Time: 2:12 AM
 */
class AttemptModel extends CI_Model
{
    /**
     * @return mixed
     */
    function getLastAttemptId()
    {
        $this->load->database();
        $query = $this->db->query("SELECT attempt_id FROM attempt ORDER BY attempt_id DESC LIMIT 1");
        return $query->result();
    }
}