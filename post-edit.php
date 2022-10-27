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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Sections_ID = $_POST['Sections_ID'];
    $Title = $_POST['Title'];
    $Content = $_POST['Content'];

    try {
        $sql = "UPDATE posts SET Sections_ID = :Sections_ID, Title = :Title, Content = :Content";

        $sql .= " WHERE Post_ID = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id );
        $stmt->bindParam(':Sections_ID', $Sections_ID);
        $stmt->bindParam(':Title', $Title);
        $stmt->bindParam(':Content', $Content);

        $stmt->execute();

        $_SESSION['success'] = "post updated successfully";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/posts.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>

<div class="container card my-3 p-3">
    <div style="color:#f3ca20;background-color:black;text-align:center;">
        <h1 class="h2">Edit Post</h1>
        
    </div>

    <form method="POST">        
        <div class="form-floating my-3">
            <input type="text" name="Sections_ID" class="form-control" value="<?= $post['Sections_ID'] ?>">
            <label for="text">Sections_ID</label>
        </div>

        <div class="form-floating my-3">
            <input type="text" name="Title" class="form-control" id="Title" value="<?= $post['Title'] ?>">
            <label for="name">Title</label>
        </div>

        <div class="form-floating my-3">
            <input type="text" name="Content" class="form-control" id="Content" value="<?= $post['Content'] ?>">
            <label for="Content">Content</label>
        </div>
        <div style="text-align: center;">
                <button class="btn btn-lg btn-primary" type="submit">Update</button>
                <button class="btn btn-lg btn-primary"> Discard<a href="http://localhost:8080/FullStack/Backend/posts.php" ></a></button>
        </div>
    </form>
</div>

<?php require_once 'layout/footer.php'; ?>