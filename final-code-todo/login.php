<?php
include_once("superclass.php");
	
	if ( isset($_POST['submit'])) {
		try {   
                $user = new User();
                $user->setUsername(htmlspecialchars($_POST['username']));        
                $user->setPassword(htmlspecialchars($_POST['password']));
            
                if ($user->login()) {
                    if ($_SESSION['admin'] == 1) {
                        header('location: admin.php');
                    }
                    else {
                        header('location: index.php');
                    }
                }
            
        } catch (\Throwable $th) {
                //throw $th;
                echo '<div class="alert alert-danger" id="error">Something went <strong>wrong</strong>!</div>';
        }
	}
    
   

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Todo</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/master.css">
</head>
<body style="background-color: #D3D3D3;">
<nav id="navigatie" style="background-color: #F7CF1D;">
    <div class="logo" style="margin-left: 200px;">
      <img src="img/tmlogo.png" style="height: 80px;">
    </div>
</nav>

    <div class="container" style="content-align: center; text-align: center;">
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <h1 style="padding-bottom: 30px;">Aanmelden</h1>
                    <div class="form-group">
                        <label for="username" style="margin-left: -100px;">Gebruikersnaam</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" style="margin-left: -75px;">Wachtwoord</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Login" style="margin-top: 20px;">
                        <br>
                        <br>
                        <a href="register.php" class="btn btn-primary white" name="register">Registreer hier</a>
                    </div>
            </form>
        </div>
    </div>
    <section class="" style="margin-top: 392px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="height: 200px; background-color: #F7CF1D">
    <!-- Grid container -->
    <div class="container p-4 pb-0">    
  </footer>

</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>