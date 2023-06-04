<?php

function printX($x)
{
    echo "<pre>";
    print_r($x);
    echo "</pre>";
}

function active($currect_page){ // TODO: fix when not established
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
        echo 'active';
    }
}

function check_message()
{
    if(isset($_SESSION['error']) && $_SESSION['error'] != "")
    {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

function vote_color($id, $color) {
    if (!isset($_SESSION['id'])) return;
    $user_id = $_SESSION['id'];

    $DB = new Database();

    $query = "select vote from votes where user_id = $user_id AND post_id = $id";
    $vote = $DB->read($query);
    if (!isset($vote[0]->vote)) return;
    
    if ($vote[0]->vote == -1 && $color == 'red') {
        echo "font-red";
        return;
    } elseif ($vote[0]->vote == 1 && $color == 'blue') {
        echo "font-blue";
        return;
    }
}

function auth($user) {
    if (!$user->is_logged()) {
        header("Location:" . ROOT . "authentication/login");
        die;
    }
}

function auth_post($data) {
    if ($data[0]->username != $_SESSION['username']) {
        header("Location:" . ROOT . "posts");
        die;
    }
}
