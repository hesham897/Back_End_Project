<?php
    require_once '../config.php';
    require_once '../layout/header.php';

try {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM sections WHERE ID = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $section = $stmt->fetch();
    if (!$section) {
        $_SESSION['error'] = "Section not Found!";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/sections.php'</script>";
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    try {
        $sql = "UPDATE sections SET name = :name";
        $sql .= " WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $_SESSION['success'] = "Section Updated Successfully";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/sections.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>


<div class="container card my-3 p-3">
    <div style="color:#f3ca20;background-color:black;text-align:center;">
        <h1 class="h2">Edit Section</h1>
        
    </div>

    <div class="container card my-3 p-3">
        <form method="POST">
            <div class="form-floating my-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $section['Name'] ?>">
                <label for="name">Name</label>
            </div>
            <div style="text-align: center;">
                <button class="btn btn-lg btn-primary" type="submit">Update</button>
                <button class="btn btn-lg btn-primary"> Discard<a href="http://localhost:8080/FullStack/Backend/admin/sections.php" ></a></button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../layout/footer.php'?>