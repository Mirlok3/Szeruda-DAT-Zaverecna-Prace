<?php

Class Vote extends Controller
{
    function upVote($post_id, $link)
    {
        $user = $this->loadModel("user");
        auth($user);

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
        } elseif ($vote[0]->vote == 1) {
            $query = "UPDATE posts SET votes = votes - 1 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "DELETE FROM votes WHERE id=$vote_id LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute();
        } elseif ($vote[0]->vote == -1) {
            $query = "UPDATE posts SET votes = votes + 2 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "UPDATE votes SET vote = 1 WHERE id=$vote_id;";
            $data = $DB->write($query);
        } 

        if ($link === 'show') $link = "posts/show/$post_id";
        else if ($link === 'home') $link = "home";
        else if (str_starts_with($link, 'profile')) $link = "posts/" . str_replace('.', '/', $link);
        header("Location:" . ROOT . $link);
        die;
    }

    function downVote($post_id, $link)
    {
        $user = $this->loadModel("user");
        auth($user);

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
        } elseif ($vote[0]->vote == 1) {
            $query = "UPDATE posts SET votes = votes - 2 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "UPDATE votes SET vote = -1 WHERE id=$vote_id;";
            $data = $DB->write($query);
        } elseif ($vote[0]->vote == -1) {
            $query = "UPDATE posts SET votes = votes + 1 WHERE id=$post_id;";
            $data = $DB->write($query);

            $query = "DELETE FROM votes WHERE id=$vote_id LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute();
        } 

        if ($link === 'show') $link = "posts/show/$post_id";
        else if ($link === 'home') $link = "home";
        else if (str_starts_with($link, 'profile')) $link = "posts/" . str_replace('.', '/', $link);
        header("Location:" . ROOT . $link);
        die;
    }
}
