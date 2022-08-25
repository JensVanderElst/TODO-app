<?php
include_once("superclass.php");

    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }

    $getcomment = new Comment();
    $getid = $_GET['id'];
    $commenttitle = $getcomment->getcomment($getid);


    if ( !empty($_POST)) {
        $comment = new Comment();
        $commentid = $_GET['id'];
        $commenttext = $_POST['comment'];
        $comment->update($commentid, $commenttext);
        
        header("location:" .$_SESSION["previous"]."");
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
<body style="background-color: #D3D3D3;">
<nav id="navigatie" style="background-color: #F7CF1D;">
    <div class="logo" style="margin-left: 200px;">
    <a href="index.php">
      <img src="img/tmlogo.png" style="height: 80px;">
    </a>
    </div>
    <div id="welcome" class="alert alert-light">Welkom <?php echo $_SESSION['username']?></div>
    <a href="index.php" class="btn btn-primary white" id="logout">Ga terug</a>
    </nav>
    <div class="container taskcontainer">
    <form class="form-horizontal" action="" method="post">
        <input class="input-field" name="comment" value="<?php print_r($commenttitle[0]['title']); ?>"/>
                <div class="form-actions taskcontainer">
            <input type="submit" href="#" onClick="history.go(-2)" class="btn btn-success" value="Update">
        <a class="btn btn-danger" href="#" onClick="history.go(-1)">Ga terug</a>
                </div>
    </form>
    </div>
    <section class="" style="margin-top: 555px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #9fa6d2">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
  </footer>

</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>