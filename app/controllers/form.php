<?php

Class Form extends Controller
{
    function index()
    {
        $data['page_title'] = "Form";

        $this->view("form", $data);
    }
}
