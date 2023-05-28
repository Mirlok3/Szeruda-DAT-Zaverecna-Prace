<?php

Class Posts extends Controller
{
    function index()
    {
        $DB = new Database();

        $data['page_title'] = "Příspěvky";

        $query = "select * from posts order by id desc";
        $data['posts'] = $DB->read($query);

        $this->view("posts", $data);
    }

    function show($id)
    {
        $DB = new Database();

        $query = "select * from posts where id = :id";
        $data['posts'] = $DB->read($query, [':id' => $id]);

        $data['page_title'] = $data['posts'][0]->title;
        $this->view("posts", $data);
    }

    function profile($username)
    {
        $DB = new Database();

        $data['page_title'] = "Příspěvky od $username";

        $query = "select * from posts where username = :username";
        $data['posts'] = $DB->read($query, [':username' => $username]);

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
