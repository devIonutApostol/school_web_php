<?php

include('database.php');

class Article
{
    public $id;
    public $title;
    public $category;
    public $content;
    public $created;
    public $status;
    public $authorname;
    public $editorname;
}

class ArticlesRepo
{
    private $database;

    private $base_columns;

    function __construct()
    {
        $this->database = new Database;
        $this->base_columns = "u1.username as authorname, u2.username as editorname, a.id as id, a.title as title, a.category as category, a.created as created, a.content as content, a.editorid as editorid from articles a join users u1 on a.authorid = u1.id left join users u2 on a.editorid = u2.id";
    }


    public function getAurthorArticles($authorid)
    {
        $result = $this->database->query(
            sprintf("select %s where authorid = ?", $this->base_columns),
            array(
                array(
                    "param_type" => "s",
                    "param_value" => $authorid
                )
            )
        );

        return $this->mapResult($result);
    }

    public function getApprovedArticlesByCategory($category)
    {
        $result = $this->database->query(
            sprintf("select %s where editorid is not null and category = ?", $this->base_columns),
            array(
                array(
                    "param_type" => "s",
                    "param_value" => $category
                )
            )
        );


        return $this->mapResult($result);
    }

    public function getCategories()
    {
        $result = $this->database->query(
             "select distinct category from articles where editorid is not null"
        );

        if (is_null($result))
            return array();
        return array_map('mapCategory', $result);
    }

    public function getUnppprovedArticles()
    {
        $result = $this->database->query(
            sprintf("select %s where editorid is null", $this->base_columns)
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

    public function approveArticle($id, $editorid)
    {
        $this->database->query(
            "update articles set editorid = ? where id = ?",
            array(
                array(
                    "param_type" => "s",
                    "param_value" => $editorid
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $id
                )
            )
        );
    }
}



function mapArticle($row)
{
    $result = new Article;

    $result->id = $row['id'];
    $result->title = $row['title'];
    $result->category = $row['category'];
    $result->created = date('d-m-Y', strtotime($row['created']));
    $result->content = $row['content'];
    $result->status = 'Pending Approval';
    $result->authorname = $row['authorname'];
    $result->editorname = $row['editorname'];

    if (isset($row['editorid'])) {
        $result->status = 'Approved by';
    }


    return $result;
}

function mapCategory($row)
{
    return $row['category'];
}

?>