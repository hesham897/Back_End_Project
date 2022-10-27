<?php
    require_once '../config.php';
    require_once '../layout/header.php';

try {
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM users WHERE ID = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User not Found!";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/users.php'</script>";
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        $sql = "UPDATE users SET name = :name, email = :email";
        if (!empty($password))
            $sql .= ", password = :password";
            $sql .= " WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);

        if (!empty($password))
            $stmt->bindParam(':password', $password);

        $stmt->execute();

        $_SESSION['success'] = "User Updated Successfully";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/users.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>

<div class="container card my-3 p-3">
    <div style="color:#f3ca20;background-color:black;text-align:center;">
        <h1 class="h2">Edit User</h1>
        
    </div>

    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $user['Name'] ?>">
            <label for="name">Name</label>
        </div>

        <div class="form-floating my-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?= $user['Email'] ?>">
            <label for="email">Email address</label>
        </div>

        <div class="form-floating my-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div style="text-align: center;">
                <button class="btn btn-lg btn-primary" type="submit">Update</button>
                <button class="btn btn-lg btn-primary"> Discard<a href="http://localhost:8080/FullStack/Backend/admin/users.php" ></a></button>
        </div>
    </form>
</div>

<?php require_once '../layout/footer.php'?>