<?php

Class Posts extends Controller
{
    function index()
    {
        $DB = new Database();

        $data['page_title'] = "Posts";

        $query = "select * from posts order by id desc";
        $data['posts'] = $DB->read($query);

        $this->view("posts", $data);
    }

    function delete($id)
    {
        $DB = new Database();

        $pdo = $DB->db_connect();

        $query = "delete from posts where id = :id limit 1";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        header("Location:" . ROOT . "posts");
    }
}
