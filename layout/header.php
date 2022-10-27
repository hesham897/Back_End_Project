
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Blog</title>
    <link href="http://localhost:8080/FullStack/Backend/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost:8080/FullStack/Backend/blog.css">

  </head>
  
<body >
    <div style=" background-color: #f3ca20;font-weight: bold;">
        <header class="blog-header lh-1 py-3">
            <div class="row"style="text-align: center;  align-items: center;">
                <div class="col-4 pt-1">

                <?php
                  if ($_COOKIE["setcookie"]=="False") {                  
                    if (!$_SESSION["user_name"])
                    { 
                        header('Location:login.php');
                        exit();
                    }
                   else 
                    {
                    $user_name = $_SESSION["user_name"];
                    }
                  } 
                  else{
                    $user_name = $_COOKIE["setcookie"];
                  }                   
                ?> 
                    Welcome <?= $user_name ?>!
                </div>
                
                <div class="col-4">
                <img class="mb-4" src="https://blogin.co/images/blogin_logo.svg" alt="" width="150">
                </div>

                <div class="col-4">
                    <a class="btn btn-sm btn-outline-dark" href="http://localhost:8080/FullStack/Backend/login.php">Log Out</a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="http://localhost:8080/FullStack/Backend/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://localhost:8080/FullStack/Backend/new_post.php">Create a New Post</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost:8080/FullStack/Backend/admin/users.php">Users</a></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/FullStack/Backend/new_user.php">New User</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/FullStack/Backend/admin/sections.php">Sections</a></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/FullStack/Backend/new_section.php">New Sections</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/FullStack/Backend/posts.php">Posts</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        </header>


    </div>
    <script src="http://localhost:8080/FullStack/Backend/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 