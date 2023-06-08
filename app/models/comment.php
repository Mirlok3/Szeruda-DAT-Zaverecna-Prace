<?php

class comment
{
    function upload($POST, $SESSION)
    {
        $DB = new Database();

        $_SESSION['error'] = "";

        if (isset($POST['content'])) {
            $arr['content'] = $POST['content'];
            $arr['date'] = date("Y-m-d H:i:s");
            $arr['username'] = $SESSION['username'];
            $arr['post_id'] = $POST['post_id'];

            try {
                $query = "INSERT INTO comments (content, username, post_id, date) VALUES (:content, :username, :post_id, :date)";
                $data = $DB->write($query, $arr);
            } catch(PDOException $e) {
                header("Location:" . ROOT . "posts/show/". $arr['post_id']);
                $_SESSION['error'] = "Údaj je moc velký!";
                die;
            }

            if ($data) {
                header("Location:" . ROOT . "posts/show/". $arr['post_id']);
                $_SESSION['message'] = "Komentář vytvořen!";
                die;
            }
        }
    }
}
