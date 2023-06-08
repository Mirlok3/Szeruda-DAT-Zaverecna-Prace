<?php

Class Posts extends Controller
{
    function index()
    {
        $DB = new Database();

        $data['page_title'] = "Příspěvky";

        $query = "select * from posts order by id desc";
        $data['posts'] = $DB->read($query);

        $this->view("post/posts", $data);
    }

    function show($id)
    {
        $DB = new Database();

        $query = "select * from posts where id = $id";
        $data['posts'] = $DB->read($query);

        if (isset($_POST['content'])) {
            $uploader = $this->loadModel("comment");
            $uploader->upload($_POST, $_SESSION);
        }

        $query = "select * from comments where post_id = $id";
        $data['comments'] = $DB->read($query);

        $data['page_title'] = $data['posts'][0]->title;
        $this->view("post/show_post", $data);
    }

    function profile($username)
    {
        $DB = new Database();

        $data['page_title'] = "Příspěvky od $username";

        $query = "select * from posts where username = :username";
        $data['posts'] = $DB->read($query, [':username' => $username]);

        $this->view("post/profile", $data);
    }

    function create()
    {
        $user = $this->loadModel("user");
        auth($user);

        $data['page_title'] = "Vytvořte příspěvek";

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $uploader = $this->loadModel("post");
            $uploader->upload($_POST, $_FILES, $_SESSION);
        }

        $this->view("post/create", $data);
    }

    function edit($id)
    {
        $DB = new Database();
        $data['page_title'] = "Edit příspěvek $id";

        $query = "select * from posts where id = :id";
        $data['posts'] = $DB->read($query, [':id' => $id]);

        auth_post($data['posts']);

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $uploader = $this->loadModel("post");
            $uploader->update($_POST, $_FILES, $id);
        }

        $this->view("post/edit", $data);
    }

    function delete($id)
    {
        $DB = new Database();

        $query = "select * from posts where id = $id";
        $data['posts'] = $DB->read($query);
        auth_post($data['posts']);

        $pdo = $DB->db_connect();

        $query = "delete from posts where id = $id limit 1";
        $statement = $pdo->prepare($query);
        $statement->execute();

        header("Location:" . ROOT . "posts");
        $_SESSION['message'] = "Váš příspěvek byl smazán!";
    }
}
