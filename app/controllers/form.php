<?php

Class Form extends Controller
{
    function index()
    {
        $data['page_title'] = "Vytvořte příspěvek";

        $user = $this->loadModel("user");
        if (!$user->auth()) {
            header("Location:" . ROOT . "authentication/login");
            die;
        }

        if (isset($_POST['title']) && isset($_FILES['image'])) {
            $uploader = $this->loadModel("upload_file");
            $uploader->upload($_POST, $_FILES, $_SESSION);
        }

        $this->view("form", $data);
    }
}
