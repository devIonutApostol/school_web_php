<?php include("top-guard.php") ?>

<?php
if (!isset($_SESSION['type']) || $_SESSION["type"] != 0) {
    session_destroy();
    header("Location: index.php");
    exit;
}
include('articles-repo.php');
$repo = new ArticlesRepo;

?>
<div style="width: 500px; margin-top: 50px;">
<h1>Articles</h1>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <?php
      $result = $repo->getCategories();
      foreach ($result as &$row) {
        echo '<li class="nav-item"><a class="nav-link" href="reader.php?category='.$row.'">'.$row.'</a></li>';
      } 
      ?>
      </ul>
    </div>
  </div>
</nav>

<?php
if (isset($_GET['category'])) {
    $result = $repo->getApprovedArticlesByCategory($_GET['category']);
    foreach ($result as &$row) {
        echo '<hr>';
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$row->title.'</h5>';
        echo '<p class="card-text">'.$row->content.'</p>';
        echo '<div class="card-footer text-muted">Written by '.$row->authorname.'</div>';
        echo '</div></div>';
    }
}
?>


</div>


<?php include("bottom.php") ?>