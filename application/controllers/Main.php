<?php

/**
 * Created by IntelliJ IDEA.
 * User: Ershadi Sayuri
 * Date: 12/31/2015
 * Time: 2:55 PM
 */
class Main extends CI_Controller
{
    // loads the home page of the quiz app
    function loadHomePage()
    {
        $this->load->view('Home');
        $this->load->library('session');
        $this->session->unset_userdata("user");
    }

    // loads the sign up page of the quiz app
    function loadSignUpPage()
    {
        $this->load->view('SignUp');
    }

    // loads the sign in page of the quiz app
    function loadSignInPage()
    {
        $this->load->view('SignIn');
    }

    // loads admin page
    function loadAdminPage()
    {
        $this->load->view('AdminView');
    }
}