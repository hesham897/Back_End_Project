<?php
    require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['name'];
    $Status = $_POST['status'];

    try {
        $sql = "INSERT INTO sections (Name,Status) VALUES (:Name,:Status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Name', $Name);
        $stmt->bindParam(':Status', $Status);
        $stmt->execute();
        $_SESSION['success'] = "Section Created Successfully";
        echo "<script> window.location='http://localhost:8080/FullStack/Backend/admin/sections.php'</script>";
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
            <h1 class="h2">New Section</h1>
        </div>


        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Section Name" name="name">
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