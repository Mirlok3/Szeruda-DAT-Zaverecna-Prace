<?php

Class Home extends Controller
{
    function index()
    {
        $DB = new Database();
        $data['page_title'] = "Home";

        $query = "select * from posts order by votes desc limit 3";
        $data['posts'] = $DB->read($query);

        $this->view("home", $data);
    }
}
