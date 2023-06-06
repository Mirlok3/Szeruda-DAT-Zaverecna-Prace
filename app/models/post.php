<?php

class post
{
    function upload($POST, $FILES, $SESSION)
    {
        $DB = new Database();

        $_SESSION['error'] = "";

        if (isset($POST['title']) && isset($FILES['image'])) {
            //upload image
            if ($FILES['image']['name'] != "" && $FILES['image']['error'] == 0)
            {
                $folder = "../../public/assets/images";
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $FILES['image']['name'];
                move_uploaded_file($FILES['image']['tmp_name'], $destination);

                $arr['image'] = $destination;
            } else {
                $arr['image'] = NULL;
            }

            // Save to db
            $arr['title'] = $POST['title'];
            $arr['description'] = $POST['description'];
            $arr['date'] = date("Y-m-d H:i:s");
            $arr['username'] = $SESSION['username'];

            $query = "insert into posts (title, description, image, username, date ) values (:title, :description, :image, :username, :date)";
            $data = $DB->write($query, $arr);

            if ($data) {
                header("Location:" . ROOT . "posts");
                $_SESSION['message'] = "Váš příspěvek byl vytvořen!";
                die;
            }
        }
    }

    function update($POST, $FILES, $ID)
    {
        $DB = new Database();

        $_SESSION['error'] = "";

        if (isset($POST['title']) && isset($FILES['image'])) { // TODO: delete old image
            if ($FILES['image']['name'] != "" && $FILES['image']['error'] == 0) {
                $folder = "uploads/";
                $destination = $folder . $FILES['image']['name'];
                move_uploaded_file($FILES['image']['tmp_name'], $destination);

                $arr['image'] = $destination;
            } else {
                $arr['image'] = NULL;
            }

            $arr['title'] = $POST['title']; // TODO : authenticate delete
            $arr['description'] = $POST['description'];

            $query = "UPDATE posts SET title=:title, description=:description, image=:image WHERE id=$ID;";
            $data = $DB->write($query, $arr);

            if ($data) {
                header("Location:" . ROOT . "posts");
                $_SESSION['message'] = "Váš příspěvek byl změněn!";
                die;
            }
        }
    }
}
