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
        $json_data = json_decode(file_get_contents('php://input'));

        // password is encrypted before saving in the database
        $encryptedPassword = crypt($json_data->{'password'});
        $data = array(
            'user_id' => $userId,
            'user_name' => $json_data->{'username'},
            'password' => $encryptedPassword,
            'role_id' => $json_data->{'roleId'}
        );

        $this->load->model('UserModel');
        $result = $this->UserModel->addNewUser($data);

        echo json_encode(array("user_status" => $result));
    }

    /**
     * login user to the system after validating username and password
     */
    function signInUser()
    {
        $userId = $this->generateUserId();
        $json_data = json_decode(file_get_contents('php://input'));

        // password is encrypted before saving in the database
        $data = array(
            'user_id' => $userId,
            'user_name' => $json_data->{'username'},
            'password' => $json_data->{'password'}
        );

        $this->load->model('UserModel');
        $result = $this->UserModel->validateUser($json_data->{'username'});

        if (!empty($result)) {
            // check if the passwords are equal
            if (crypt($json_data->{'username'}, $result[0]->password) == $result[0]->password) {

                // check whether the user is an administrator or a student
                // roo1 id admin
                // r002 id student
                if ($result[0]->role_id == "r001") {
                    // load admin view
                    echo json_encode(array("login_status" => "admin user"));
                    $this->load->view('AdminView');
                } else if ($result[0]->role_id == "r002") {
                    echo "student";
                    // load question view
                    echo json_encode(array("login_status" => "student user"));
                }
            } else {
                // incorrect password
                echo json_encode(array("login_status" => "incorrect password"));
            }
        } else {
            // there is no such user with the given username
            echo json_encode(array("login_status" => "incorrect username and password"));
        }
    }

    /**
     * function to load all the users
     * @return mixed
     */
    function loadAllUsers()
    {
        $this->load->model('UserModel');
        $users = $this->UserModel->getAllUsers();
        echo json_encode($users);
    }
}