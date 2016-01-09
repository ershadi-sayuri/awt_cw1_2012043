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

    /**
     * add new user
     * @param $data
     * @return mixed
     */
    function addNewUser($data)
    {
        $this->load->database();
        $result = $this->db->insert('user',$data);
        return $result;
    }

    /**
     * find whether there is a user from the given username in the database
     * @param $username
     * @return mixed
     */
    function validateUser($username)
    {
        $this->load->database();
        $query = $this->db->query("SELECT * from user WHERE user_name='$username'");
        return $query->result();
    }

    /**
     * get all users from the database
     * @return mixed
     */
    function getAllUsers()
    {
        $this->load->database();
        $query = $this->db->query("SELECT * FROM user");
        return $query->result();
    }
}