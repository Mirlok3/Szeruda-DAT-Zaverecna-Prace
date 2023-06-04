<?php

Class Vote extends Controller
{
    function upVote($post_id)
    {
        $user = $this->loadModel("user");
        if (!$user->is_logged()) {
            header("Location:" . ROOT . "authentication/login");
            die;
        }

        $DB = new Database();
        $pdo = $DB->db_connect();

        $u_id = $_SESSION['id'];
        $arr['user_id'] = $_SESSION['id'];
        $arr['post_id'] = $post_id;
        $arr['vote'] = 1;
        $arr['date'] = date("Y-m-d H:i:s");

        $query = "select vote, id from votes WHERE post_id=$post_id AND user_id=$u_id";
        $vote = $DB->read($query);
        $vote_id = $vote[0]->id;
    
        if ($vote[0]->vote == 0) { 
            $query = "UPDATE posts SET votes = votes + 1 WHERE id=$post_id;";
            $data = $DB->write($query);
            $query = "INSERT INTO votes (user_id, post_id, vote, date) VALUES (:user_id, :post_id, :vote, :date)";
            $data = $DB->write($query, $arr);

            header("Location:" . ROOT . "posts");
            die;
        } elseif ($vote[0]->vote == 1) {
            $query = "UPDATE posts SET votes = votes - 1 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "DELETE FROM votes WHERE id=$vote_id LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute();

            header("Location:" . ROOT . "posts");
            die;
        } elseif ($vote[0]->vote == -1) {
            $query = "UPDATE posts SET votes = votes + 2 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "UPDATE votes SET vote = 1 WHERE id=$vote_id;";
            $data = $DB->write($query);

            header("Location:" . ROOT . "posts");
            die;
        } 

        header("Location:" . ROOT . "posts");
    }

    function downVote($post_id)
    {
        $user = $this->loadModel("user");
        if (!$user->is_logged()) {
            header("Location:" . ROOT . "authentication/login");
            die;
        }

        $DB = new Database();
        $pdo = $DB->db_connect();

        $u_id = $_SESSION['id'];
        $arr['user_id'] = $_SESSION['id'];
        $arr['post_id'] = $post_id;
        $arr['vote'] = -1;
        $arr['date'] = date("Y-m-d H:i:s");

        $query = "select vote, id from votes WHERE post_id=$post_id AND user_id=$u_id";
        $vote = $DB->read($query);
        $vote_id = $vote[0]->id;
    
        if ($vote[0]->vote == 0) { 
            $query = "UPDATE posts SET votes = votes - 1 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "INSERT INTO votes (user_id, post_id, vote, date) VALUES (:user_id, :post_id, :vote, :date)";
            $data = $DB->write($query, $arr);

            header("Location:" . ROOT . "posts");
            die;
        } elseif ($vote[0]->vote == 1) {
            $query = "UPDATE posts SET votes = votes - 2 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "UPDATE votes SET vote = -1 WHERE id=$vote_id;";
            $data = $DB->write($query);

            header("Location:" . ROOT . "posts");
            die;
        } elseif ($vote[0]->vote == -1) {
            $query = "UPDATE posts SET votes = votes + 1 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "DELETE FROM votes WHERE id=$vote_id LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute();

            header("Location:" . ROOT . "posts");
            die;
        } 

        header("Location:" . ROOT . "posts");
    }
}
