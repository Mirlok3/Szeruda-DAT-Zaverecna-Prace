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

            try {
                $query = "insert into users (username, password, email, date) values (:username, :password, :email, :date)";
                $data = $DB->write($query, $arr);
            } catch(PDOException $e) {
                header("Location:" . ROOT . "authentication/register");
                $_SESSION['error'] = "Jméno je obsazeno!";
                die;
            }

            if ($data) {
                header("Location:" . ROOT . "authentication/login");
                $_SESSION['message'] = "Děkujeme za registraci!";
                die;
            }
        } else {
            $_SESSION['error'] = "Špatně zadané údaje!";
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

            if (!empty($data)) {
                // logged in
                $_SESSION['username'] = $data[0]->username;
                $_SESSION['id'] = $data[0]->id;

                header("Location:" . ROOT . "home");
                $_SESSION['message'] = "Úspěšně jste se přihlásili!";
                die;
            } else {
                $_SESSION['error'] = "Špatně zadané jméno nebo heslo!";
            }
        } else {
            $_SESSION['error'] = "Špatně zadané údaje!";
        }
    }

    function logout()
    {
        unset ($_SESSION['id']);
        unset ($_SESSION['username']);

        header("Location:" . ROOT . "authentication/login");
        $_SESSION['message'] = "Úspěšne jste se odhlásili!";
        die;
    }

    function is_logged()
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
