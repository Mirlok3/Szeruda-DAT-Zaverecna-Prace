<?php

Class Form extends Controller
{
    function index()
    {
        $data['page_title'] = "Vytvořte příspěvek";

        $this->view("form", $data);
    }
}
