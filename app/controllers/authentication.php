<?php

Class Authentication extends Controller
{
    function register()
    {
        $data['page_title'] = "Register";

        $this->view("register", $data);
    }

    function login()
    {
        $data['page_title'] = "Login";

        $this->view("login", $data);
    }
}
