<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 1/1/2016
 * Time: 2:21 PM
 */
class User extends CI_Controller
{
    /**
     * get the last user id from the database
     * substring it and removed  the prefix to get the integer value
     * add 1 to it
     * added the prefix again, inorder to make user id contains 4 characters
     * @return string
     */
    function generateUserId()
    {
        $this->load->model('UserModel');
        $userIdData = $this->UserModel->getLastUserId();

        $lastUserId = substr($userIdData[0]->user_id, 1);
        $userId = intval($lastUserId) + 1;

        $newUserId = "";
        if ($userId < 10) {
            $newUserId = "U00" . $userId;
        } else if ($userId < 100) {
            $newUserId = "U0" . $userId;
        } else if ($userId < 1000) {
            $newUserId = "U" . $userId;
        }

        return $newUserId;
    }

    function addNewUser()
    {
        $userId = $this->generateUserId();
        $username = $_GET["username"];
        $password = $_GET["password"];
        $encryptedPassword = crypt($password);

        $this->load->model('UserModel');
        $result = $this->UserModel->addNewUser($userId, $username, $encryptedPassword);
        return $result;
    }
}