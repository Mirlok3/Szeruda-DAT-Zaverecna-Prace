<?php

class User
{
    function register($POST)
    {
        $DB = new Database();

        $_SESSION['error'] = "";

        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];
            $arr['email'] = $POST['email'];
            $arr['date'] = date("Y-m-d H:i:s");

            $query = "insert into users (username, password, email, date) values (:username, :password, :email, :date)";
            $data = $DB->write($query, $arr);

            if ($data) {
                header("Location:" . ROOT . "authentication/login");
                die;
            }
        } else {
            $_SESSION['error'] = "Invalid credential"; // TODO: Error messages
        }
    }

    function login($POST)
    {
        $DB = new Database();

        $_SESSION['error'] = "";

        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['password'] = $POST['password'];

            $query = "select * from users where username = :username && password = :password";
            $data = $DB->read($query, $arr);

            if (is_array($data)) {
                // logged in
                $_SESSION['username'] = $data[0]->username;
                $_SESSION['id'] = $data[0]->id;

                header("Location:" . ROOT . "home");
                die;
            } else {
                $_SESSION['error'] = "Wrong username or password";
            }
        } else {
            $_SESSION['error'] = "Invalid credential"; // TODO: Error messages
        }
    }

    function logout()
    {
        unset ($_SESSION['id']);
        unset ($_SESSION['username']);

        header("Location:" . ROOT . "login");
        die;
    }

    function auth()
    {
        $DB = new Database();

        if(isset($_SESSION['id'])) {
            $arr['id'] = $_SESSION['id'];

            $query = "select * from users where id = :id limit 1";
            $data = $DB->read($query, $arr);

            if (is_array($data)) {
                // logged in
                $_SESSION['id'] = $data[0]->id;
                $_SESSION['username'] = $data[0]->username;

                return true;
            }

            return false;
        }
    }
}
