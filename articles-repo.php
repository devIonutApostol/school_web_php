<?php

include('database.php');

class Article
{
    public $title;
    public $category;
    public $content;
    public $created;
    public $status;
}

class ArticlesRepo
{
    private $database;

    function __construct()
    {
        $this->database = new Database;
    }


    public function getAurthorArticles($authorid)
    {
        $result = $this->database->query(
            "select title,category,created,content,editorid from articles where authorid = ?",
            array(
                array(
                    "param_type" => "s",
                    "param_value" => $authorid
                )
            )
        );

        return $this->mapResult($result);
    }

    public function getApprovedArticles()
    {
        $result = $this->database->query(
            "select title,category,created,content,editorid from articles where editorid is not null"
        );


        return $this->mapResult($result);
    }

    public function getUnApprovedArticles()
    {
        $result = $this->database->query(
            "select title,category,created,content,editorid from articles where editorid is null"
        );

        return $this->mapResult($result);
    }

    private function mapResult($result)
    {
        if (is_null($result))
            return array();

        return array_map('mapArticle', $result);
    }


    public function createArticle($title, $category, $content, $authorid)
    {
        $this->database->insert(
            "insert into articles (title,category,content,created,authorid) values (?,?,?,?,?)",
            array(
                array(
                    "param_type" => "s",
                    "param_value" => $title
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $category
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $content
                ),
                array(
                    "param_type" => "s",
                    "param_value" => date("Y-m-d")
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $authorid
                )
            )
        );
    }
}



function mapArticle($row)
{
    $result = new Article;

    $result->title = $row['title'];
    $result->category = $row['category'];
    $result->created = date('d-m-Y', strtotime($row['created']));
    $result->content = $row['content'];
    $result->status = 'Pending Approval';

    if (isset($row['editorid'])) {
        $result->status = 'approved';
    }


    return $result;
}

?>