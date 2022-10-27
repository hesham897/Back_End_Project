<?php
function ellipsis($long_string, $max_character = 80)
{
    $short_string = strlen($long_string) > $max_character ? substr($long_string, 0, $max_character) . "..." : $long_string;
    return $short_string;
}
?>

<?php
    require_once 'config.php';
    require_once 'layout/header.php';

if (!empty($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $sql = "DELETE FROM posts WHERE Post_ID = $id";
    $stmt = $conn->prepare($sql);
    $stmt = $stmt->execute();
    $_SESSION['success'] = "Post Deleted!";
    echo "<script> window.location='http://localhost:8080/FullStack/Backend/posts.php'</script>";
    die;
}

try {
    $sql = "SELECT * FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $posts = $stmt->fetchAll();
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
        <h1 class="h2">Posts</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm" style="text-align: center;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sections</th>
                    <th scope="col">User</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Update Date</th>
                    <th scope="col" style="width: 10%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post['Post_ID'] ?></td>
                        <td><?= $post['Sections_ID'] ?></td>
                        <td><?= $post['User_ID'] ?></td>
                        <td><?= $post['Title'] ?></td>
                        <td><?= ellipsis($post['Content']) ?></td>
                        <td><?= $post['Status'] ?></td>
                        <td><?= $post['Create_Date'] ?></td>
                        <td><?= $post['Update_Date'] ?></td>
                        <td>
                            <a href="http://localhost:8080/FullStack/Backend/post-edit.php?id=<?= $post['Post_ID'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <!-- <a href="?delete=<?=  $post['Post_ID'] ?>" class="btn btn-sm btn-danger">Delete</a> -->
                            <button type="button" data-id="<?= $post['Post_ID'] ?>" onclick="deleteClick(this)" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteClick(e) 
{
    console.log(e)
    let id = e.getAttribute('data-id');
    let answer = confirm("Are you sure to delete post " + id + "?")
    if (answer) {
        window.location = "?delete=" + id
    }
}
</script>

<?php require_once 'layout/footer.php' ?>