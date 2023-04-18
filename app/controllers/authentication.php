<?php

Class Authentication extends Controller
{
    function register()
    {
        $data['page_title'] = "Register";

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $this->loadModel("user");
            $user->register($_POST);
        }

        $this->view("register", $data);
    }

    function login()
    {
        $data['page_title'] = "Login";

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $this->loadModel("user");
            $user->login($_POST);
        }

        $this->view("login", $data);
    }

    function logout()
    {
        $user = $this->loadModel("user");
        $user->logout();
    }
}
