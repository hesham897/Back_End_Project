<?php
    require_once 'config.php';
    require_once 'layout/header.php';

try {
    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM posts WHERE Post_ID = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $post = $stmt->fetch();

    if (!$post) {
        $_SESSION['error'] = "Post not Found!";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/posts.php'</script>";
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
            <?php
                try {
                $sql = "SELECT * FROM sections where ID =:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $post['Sections_ID'] );
                $stmt->execute();
                $sections = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $sections = $stmt->fetch();
                } 
                catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                }
                $conn = null;
            ?> 
<div class="container card my-3 p-3">
    <div class="row border-bottom">
        <div class="col-6">
            <h4><?= $sections['Name'] ?> / <?= $post['Title'] ?></h4>
            <p>Last Update: <?= $post['Update_Date'] ?></p>            
        </div>
        <div class="col-6" style="text-align: end;">
            <a href="http://localhost:8080/FullStack/Backend/index.php" class="btn btn-warning">back</a>
        </div>
    </div>
        <form method="POST">
            <div class="form-floating my-3">
                <p><?= $post['Content'] ?></p>
            </div>
        </form>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>
