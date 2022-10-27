<?php
    require_once '../config.php';
    require_once '../layout/header.php';

if (!empty($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $sql = "DELETE FROM users WHERE ID = $id";
    $stmt = $conn->prepare($sql);
    $stmt = $stmt->execute();

    $_SESSION['success'] = "User Deleted!";
    echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/users.php'</script>";
    die;
}

try {
    $sql = "SELECT * FROM users";

    // die($sql);

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // set the resulting array to associative
    $users = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
            <?php if (!empty($_SESSION['success'])) : ?>
                    <div class="alert alert-success my-3">
                        <p class="m-0 fs-5 text-center"><?= $_SESSION['success'] ?></p>
                    </div>
                <?php
                    unset($_SESSION['success']);
                endif;
                ?>

                <?php if (!empty($_SESSION['error'])) : ?>
                    <div class="alert alert-danger my-3">
                        <p class="m-0 fs-5 text-center"><?= $_SESSION['error'] ?></p>
                    </div>
                <?php
                    unset($_SESSION['error']);
                endif;
                ?>

<div class="container card my-3 p-3">
    <div style="color:#f3ca20;background-color:black;text-align:center;">
        <h1 class="h2">Users</h1>
    </div>

    <table class="table table-striped table-sm" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['ID'] ?></td>
                    <td><?= $user['Name'] ?></td>
                    <td><?= $user['Email'] ?></td>
                    <td>
                        <a href="http://localhost:8080/FullStack/Backend/admin/users-edit.php?id=<?= $user['ID'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <!-- <a href="?delete=<?= $user['ID'] ?>" class="btn btn-sm btn-danger">Delete</a> -->
                        <button type="button" data-id="<?= $user['ID'] ?>" onclick="deleteClick(this)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function deleteClick(e) {
    console.log(e)
    let id = e.getAttribute('data-id');
    let answer = confirm("Are you sure to delete user " + id + "?")
    if (answer) {
        window.location = "?delete=" + id
    }
}
</script>
<?php require_once '../layout/footer.php'?>