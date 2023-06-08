<?php

Class Comments extends Controller
{
    function create()
    {
        $DB = new Database();
        $data['page_title'] = "Home";

        $this->view("home", $data);
    }
}
