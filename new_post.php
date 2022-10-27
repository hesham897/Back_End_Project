<?php
    require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_SESSION['user_id']){
        $User_ID = $_SESSION['user_id'];
    }else{
        $User_ID=$_COOKIE['user_id'];
    }

    $Sections_ID = $_POST['Sections_ID'];
    $Title = $_POST['Title'];
    $Content = $_POST['Content'];

    try {
        $sql = "INSERT INTO posts (User_ID,Sections_ID,Title, Content) VALUES (:User_ID, :Sections_ID, :Title, :Content)";

        // die($sql);

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':User_ID', $User_ID);
        $stmt->bindParam(':Sections_ID', $Sections_ID);
        $stmt->bindParam(':Title', $Title);
        $stmt->bindParam(':Content', $Content);

        $stmt->execute();

        $_SESSION['success'] = "Your Account created successfully";

        echo "<script> window.location='http://localhost:8080/FullStack/Backend/index.php'</script>";
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>

    
<?php require_once 'layout/header.php';?>
    
<div class="container card my-3 p-3">
    <form method="POST" Style="margin: 30px;">
        <div style="color:#f3ca20;background-color:black;text-align:center;">
            <h1 class="h2">New Post</h1>
            
        </div>

        <div class="mb-3" style ="width: 70%;">
            <label for="exampleFormControlInput1" class="form-label">Sections</label>   
            <?php
            try {
            $sql = "SELECT * FROM sections";
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
            <select name="Sections_ID">                      
                <?php foreach ($posts as $post) : ?>
                    <option value=<?= $post['ID'] ?>><?= $post['Name'] ?></option> 
                <?php endforeach; ?>
            </select>  
        </div>

        <div class="mb-3" >
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="Title">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="Content"></textarea>
        </div>
        <div style="text-align: center;">
                <button class="btn btn-lg btn-primary" type="submit">Save</button>
                <button class="btn btn-lg btn-primary"> Discard<a href="http://localhost:8080/FullStack/Backend/index.php" ></a></button>
        </div>
    </form>
</div>

<?php require_once 'layout/footer.php';?>
    
