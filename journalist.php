<?php include("top-guard.php") ?>

<?php
if (!isset($_SESSION['type']) || $_SESSION["type"] != 1) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<div style=" width: 500px; margin-top: 50px; margin-right: 100px;">
    <h3>Articles status</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Created</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include('articles-repo.php');
            $repo = new ArticlesRepo;
            $result = $repo->getAurthorArticles($_SESSION['id']);

            foreach ($result as &$row)
            {

                echo '<tr>';
                echo '<td>'.$row->title."</td>";
                echo '<td>'.$row->category."</td>";
                echo '<td>'.$row->created."</td>";
                echo '<td>'.$row->status."</td>";
                echo '</tr>';
            }
            ?>

        </tbody>
    </table>

</div>

<div style="width: 500px; margin-top: 50px;">
    <h3>Create Article</h3>
    <form action="create-article.php" method="post">
        <div class="form-outline mb-4">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required minlength="5" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" required minlength="5" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="content">Content</label>
            <textarea style="height: 200px" type="text" name="content" id="content" class="form-control" required
                minlength="20"> </textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Create</button>
        <?php include("info-error.php") ?>
    </form>
    <div>

        <?php include("bottom.php") ?>