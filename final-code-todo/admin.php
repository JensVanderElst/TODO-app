<?php
include_once("superclass.php");

    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }
    
    $user = new User();
    $users = $user->getAll();
    $count = $user->getCount();

    $list = new Lists();
    $getcount = $list->getCount();


    
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/master.css">

</head>
<body>
<nav id="navigatie">
    <div class="logo" style="margin-left: 200px;">
    <a href="index.php">
      <img src="/img/LogoTodo.png" style="height: 80px;">
    </a>
    </div>
    <div id="welcome" class="alert alert-light">Welkom <?php echo $_SESSION['username']?></div>
    <a href="logout.php" class="btn btn-primary white" id="logout">Logout</a>
    </nav>

    <div class="container">
    <h1 style="padding-bottom: 30px;">Admin paneel</h1>
        <table class="table">
            <tr>
                <td><p>Aantal gebruikers: <?php echo implode(",", $count[0]); ?></p></td>
            </tr>
            <tr>
                <td><p>Aantal lijsten: <?php echo implode(",", $getcount[0]); ?></p></td>
            </tr>
        </table>
    <table class="table">
        <thead>
            <tr>
                <th>gebruikers</th>
                <th>maak admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u):?>
                <tr>
                    <td><p><?php echo $u['username']; ?></p></td>
                    <td><a href="<?php if ($u['admin'] == 1) { echo "newuser.php?user=".$u['username'].""; }else {echo "newadmin.php?user=".$u['username'].""; } ?>" class="btn btn-primary delete"><?php if ($u['admin'] == 1) { echo "Maak gebruiker";}else {echo "Maak admin";}?></a></td>                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <section class="" style="margin-top: 376px;">
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
  <script src="js/makelist.js"></script>
</body>
</html>