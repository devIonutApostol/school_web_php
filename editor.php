<?php include("top-guard.php") ?>

<?php
if (!isset($_SESSION['type']) || $_SESSION["type"] != 2) {
    session_destroy();
    header("Location: index.php");
    exit;
}

include('articles-repo.php');
?>

<div style=" margin-top: 50px; margin-right: 100px;">
    <h3>Pending Approval Articles</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Created</th>
                <th scope="col">Content</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $repo = new ArticlesRepo;
            if (isset($_GET['id'])) {
                $repo->approveArticle($_GET['id'], $_SESSION['id']);
                header("Location: editor.php");
                exit;
            }

            $result = $repo->getUnppprovedArticles();

            foreach ($result as &$row) {

                echo '<tr>';
                echo '<td>' . $row->title . '</td>';
                echo '<td>' . $row->category . '</td>';
                echo '<td>' . $row->created . '</td>';
                echo '<td>' . $row->content . '</td>';
                echo '<td> <a href="editor.php?id=' . $row->id . '" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Approve</a></td>';
                echo '</tr>';
            }
            ?>

        </tbody>
    </table>

</div>

<?php include("bottom.php") ?>