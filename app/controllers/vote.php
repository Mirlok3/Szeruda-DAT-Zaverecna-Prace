<?php

Class Vote extends Controller
{
    function upVote($id)
    {
        $DB = new Database();

        $query = "select votes from posts where id = :id";
        $data['posts'] = $DB->read($query, [':id' => $id]);
        $arr['votes'] = $data['posts'][0]->votes;

        $query = "UPDATE posts SET votes = :votes + 1 WHERE id=$id;";
        $data = $DB->write($query, $arr);
        printX($arr['votes']);
    }
}
