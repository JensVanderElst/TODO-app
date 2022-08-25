<?php
include_once("superclass.php");

    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }
    
    if ( !empty($_POST)) {
        $user = new User();
        $username = $_POST['username'];
        $user->makeuser($username );
        header("Location: admin.php");
    }

    
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/master.css">

</head>
<body>
<nav id="navigatie">
    <div class="logo" style="margin-left: 200px;">
    <a href="index.php">
      <img src="/img/LogoTodo.png" style="height: 80px;">
    </a>
    </div>
    <div id="welcome" class="alert alert-light">Welkom <?php echo $_SESSION['username']?></div>
    <a href="admin.php" class="btn btn-primary white" id="logout">Ga terug</a>
    </nav>
    <div class="container taskcontainer">
    <form class="form-horizontal" action="newuser.php" method="post" style="text-align: center;">
        <input type="hidden" name="username" value="<?php echo $_GET['user'];?>"/>
            <p class="alert alert-error">Ben je zeker dat je <?php echo $_GET['user']; ?> terug gebruiker wilt maken?</p>
                <div class="form-actions">
            <button type="submit" class="btn btn-success">Ja</button>
        <a class="btn btn-danger" href="admin.php">Nee</a>
                </div>
    </form>
    </div>
    <section class="" style="margin-top: 577px;">
  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #9fa6d2">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->
      <section class="">
        <p class="d-flex justify-content-center align-items-center">
          <span class="me-3">Registreer gratis</span>
          <button onclick="location.href='register.php'" type="button" class="btn btn-outline-light btn-rounded" style="margin-left: 10px;">
            Aanmelden!
          </button>
        </p>
      </section>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #9fa6d2;">
      © 2021 Copyright:
      <a class="text-white" href="index.php">IMD-todo.be</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>