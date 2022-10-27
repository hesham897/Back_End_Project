<?php
    require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['name'];
    $Nationalty_ID = $_POST['nationalty'];
    $DateOfBirth = $_POST['dateofbirth'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Status = $_POST['status'];

    try {
        $sql = "INSERT INTO users (Name,Nationalty_ID,DateOfBirth,Email,Password,Status) VALUES (:Name,:Nationalty_ID,:DateOfBirth,:Email,:Password,:Status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':Nationalty_ID', $Nationalty_ID);
        $stmt->bindParam(':DateOfBirth', $DateOfBirth);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':Password', $Password);
        $stmt->bindParam(':Status', $Status);
        $stmt->execute();
        $_SESSION['success'] = "User Created Successfully";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/users.php'</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>



   
<?php require_once 'layout/header.php';?>
    
<div class="container card my-3 p-3">
    <form method="POST">
        <div style="color:#f3ca20;background-color:black;text-align:center;">
            <h1 class="h2">New User</h1>
        </div>

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name">
        </div>
        <?php
            try {
            $sql = "SELECT * FROM nationalities";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $posts = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $posts = $stmt->fetchAll();
            } 
            catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
            $conn = null;
        ?>
        <label class="form-label">Nationalty</label>
        <select name="nationalty">                      
            <?php foreach ($posts as $post) : ?>
                <option value=<?= $post['Nationality_ID'] ?>><?= $post['Name'] ?></option> 
            <?php endforeach; ?>
        </select>  

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
            <input type="text" class="form-control" placeholder="Date Of Birth" name="dateofbirth">
        </div>

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="text" class="form-control" placeholder="Email" name="email">
        </div>

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="Password" name="password">
        </div>

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Status</label>
                <select name="status" id="status">
                    <option value="Active">Active</option>
                    <option value="Not Active">Not Active</option>
                </select>
        </div>
        <div style="text-align: center;">
                <button class="btn btn-lg btn-primary" type="submit">Save</button>
                <button class="btn btn-lg btn-primary"> Discard<a href="http://localhost:8080/FullStack/Backend/admin/users.php" ></a></button>
        </div>              
    </form>
</div>
<?php require_once 'layout/footer.php'; ?>