<?php

include_once("superclass.php");

	if ( isset($_POST['submit'])) {
		try {   
                $user = new User();
                $user->setFullname(htmlspecialchars($_POST['fullname']));
                $user->setUsername(htmlspecialchars($_POST['username']));        
                $user->setEmail(htmlspecialchars($_POST['email']));
                $user->setPassword(htmlspecialchars($_POST['password']));
                $user->setpasswordConfirmation(htmlspecialchars($_POST['password_confirmation']));
            
            if($user->emailCheck($_POST['email']) && $user->userCheck($_POST['username']) && $user->passwordCheck($_POST['password'], $_POST['password_confirmation'])){
                if ($user->register()) {
                    $_SESSION['username'] = $user->getUsername();
                    header('location: login.php');
                }
            }else{
                echo '<div class="alert alert-danger" id="error">Something went <strong>wrong</strong>!</div>';
            }
            
        } catch (\Throwable $th) {
                //throw $th;
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
                <h1 style="padding-bottom: 30px;">Registreren</h1>
                    <div class="form-group">
                    <div class="alert alert-success" id="usercheck" style="display:none;">De <strong>gebruikersnaam</strong> is toegestaan.</div>
                    <div class="alert alert-danger" id="usercheck2" style="display:none;">verander uw <strong>gebruikersnaam</strong>!</div>
                        <label for="username" style="margin-left: -100px;">Gebruikersnaam</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname" style="margin-left: -25px;">Naam</label>
                        <input class="form-control" type="text" name="fullname" id="fullname" required>
                    </div>
                    <div class="form-group">
                    <div class="alert alert-success" id="mailcheck" style="display:none;">Het <strong>email</strong> adres is toegestaan.</div>
                    <div class="alert alert-danger" id="mailcheck2" style="display:none;">verander uw <strong>email</strong>!</div>
                        <label for="email" style="margin-left: -25px;">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="alert alert-success" id="passwordcheck" style="display:none;">De <strong>wachtwoorden</strong> komen overeen.</div>
                    <div class="alert alert-danger" id="passwordcheck2" style="display:none;">De <strong>wachtwoorden</strong> zijn niet hetzelfde!</div>
                    <div class="form-group">
                        <label for="password" style="margin-left: -75px;">Wachtwoord</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" style="margin-left: -135px;">Herhaal Wachtwoord</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit" style="margin-top: 20px;">
                    </div>
                    <div class="form-group">
                        <a href="login.php" class="btn btn-primary white" name="login">Al een account? Login</a>
                    </div>
            </form>
        </div>
    </div>
    <section class="" style="margin-top: 225px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #F7CF1D">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
  </footer>

</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/emailconf.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/userconf.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/passwordconf.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>