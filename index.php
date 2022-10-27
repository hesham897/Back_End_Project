<?php
    require_once 'config.php';
    require_once 'layout/header.php';
  ?> 
<?php
function ellipsis($long_string, $max_character = 300)
{
    $short_string = strlen($long_string) > $max_character ? substr($long_string, 0, $max_character) . "..." : $long_string;
    return $short_string;
}
?>

<?php
  try {
  $sql = "SELECT * FROM sections";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $sections = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $sections = $stmt->fetchAll();
  } 
  catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  }
  // $conn = null;
?>
  <?php foreach ($sections as $section) : ?>
    <?php
    try {
      $sql = "SELECT * FROM posts where Sections_ID=:id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id', $section['ID'] );
      $stmt->execute();
      $posts = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $posts = $stmt->fetchAll();
    } 
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  ?>
  <?php 
 if(empty($posts)){continue;}
 ?>
  <div class="container card my-3 p-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $section['Name'] ?></h1>
      </div>

      <div class="row">
        <?php foreach ($posts as $post) : ?>
          <div class="col-sm-4" style="height:300px;">
            <div class="card" style="height:300px;">
                <div class="card-header" style="background-color: #f3ca20;">
                  <?= $post['Update_Date'] ?>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?= $post['Title'] ?></h5>
                  <p class="card-text"><?= ellipsis($post['Content']) ?></p>
                  <a href="http://localhost:8080/FullStack/Backend/post_view.php?id=<?= $post['Post_ID'] ?>">Read More</a>
                </div>
              </div>
            </div>          
        <?php endforeach; ?>
      </div>
  </div>

  <?php endforeach; ?>

<?php   $conn = null; ?>

<?php require_once 'layout/footer.php';?>

