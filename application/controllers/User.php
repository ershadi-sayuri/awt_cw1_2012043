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
     * generate new user id
     * @return string
     */
    function generateUserId()
    {
        $this->load->model('UserModel');
        // get the last user id from the database
        $userIdData = $this->UserModel->getLastUserId();

        // substring it and removed  the prefix to get the integer value
        $lastUserId = substr($userIdData[0]->user_id, 1);
        // add 1 to it
        $userId = intval($lastUserId) + 1;

        $newUserId = "";
        // added the prefix again, inorder to make user id contains 4 characters
        if ($userId < 10) {
            $newUserId = "U00" . $userId;
        } else if ($userId < 100) {
            $newUserId = "U0" . $userId;
        } else if ($userId < 1000) {
            $newUserId = "U" . $userId;
        }

        return $newUserId;
    }

    /**
     * add new user to the system
     * @return mixed
     */
    function addNewUser()
    {
        $userId = $this->generateUserId();
        $username = $_GET["username"];
        $password = $_GET["password"];
        // password is encrypted before saving in the database
        $encryptedPassword = crypt($password);

        $this->load->model('UserModel');
        // role r002 is the student
        // allows signing up only the students from the home page
        $result = $this->UserModel->addNewUser($userId, $username, $encryptedPassword, "r002");

        return $result;
    }

    /**
     * login user to the system after validating username and password
     */
    function signInUser()
    {
        $enteredUsername = $_GET["username"];
        $enteredPassword = $_GET["password"];

        $this->load->model('UserModel');
        $result = $this->UserModel->validateUser($enteredUsername);

        if (!empty($result)) {
            // check if the passwords are equal
            if (crypt($enteredPassword, $result[0]->password) == $result[0]->password) {

                // check whether the user is an administrator or a student
                // roo1 id admin
                // r002 id student
                if ($result[0]->role_id == "r001") {
                    echo "admin";
                    print_r("done");
                    // load admin view
                    $this->load->view('AdminView');
                } else if ($result[0]->role_id == "r002") {
                    echo "student";
                    // load question view
                    $this->load->library('../controllers/question');
                    $this->question->loadTenQuestionIds();
                }
            } else {
                // incorrect password
            }
        } else {
            // there is no such user with the given username

        }

    }
}