<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/1/2016
 * Time: 1:14 PM
 */
class UserModel extends CI_Model
{

    /**
     * gets the last user id from the database
     * this is used to generate the next user id
     * @return mixed
     */
    function getLastUserId()
    {
        $this->load->database();
        $query = $this->db->query("SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1");
        return $query->result();
    }

    function addNewUser($userId, $username, $encryptedPassword)
    {
        $this->load->database();
        $query = $this->db->query("INSERT INTO user VALUES ('$userId', '$username', '$encryptedPassword', 'r002')");
        return $query->result();
    }
}