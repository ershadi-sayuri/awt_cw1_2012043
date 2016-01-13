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

    function saveAttempt($data)
    {
        $this->load->database();
        $result = $this->db->insert('attempt', $data);
        return $result;
    }

    function saveAttemptQuestion($data)
    {
        $this->load->database();
        $result = $this->db->insert('attempt_question', $data);
        return $result;
    }

    function updateAttempt($data, $attempt_id)
    {
        $this->load->database();
        $this->db->where('attempt_id', $attempt_id);
        $result = $this->db->update('attempt', $data);
        return $result;
    }

    function getUserAttempts($userId)
    {
        $this->load->database();
        $query = $this->db->query("SELECT attempt_id FROM attempt WHERE user_id='$userId'");
        return $query->result();
    }

    function getUserAttemptStatus($attempt_id)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM attempt_question WHERE aq_attempt_id='$attempt_id'");
        return $query->result();
    }
}