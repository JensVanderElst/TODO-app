<?php
include_once("superclass.php");

    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }
    
    

    $_SESSION["previous"] = $_SERVER["REQUEST_URI"];
    
    
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
    <div id="welcome" class="alert alert-light">Hallo, <?php echo $_SESSION['username']?></div>
    <a href="<?php echo $_SESSION["listpage"]; ?>" class="btn btn-primary white" id="logout">Terug</a>
    </nav>

    <div class="container taskcontainer">
    <h1 class="title"><?php echo $_GET['name']; ?></h1>
    <div class="alert alert-danger" id="commenterror" style="display:none;">Plaats commentaar.</div>
    <form class="form-horizontal" action="" method="post">
    <div class="create-group">
            <label class="tasklabel" for="name">comment:</label>
    </div>
    <div class="create-group">
            <input class="form-control" type="text" name="comval" id="comval" data-index="<?php echo $_GET['id'] ?>">
            <input type="hidden" id="uri" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <input class="btn btn-success" type="submit" name="comment" id="comment" value="Comment">
    </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Comment</th>
                <th>Tijd</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $comment = new Comment();
            $taskid = $_GET['id'];
            $comments = $comment->getAll($taskid);
            
            foreach ($comments as $c):?>
                <tr>
                    <td><p><?php echo htmlspecialchars($c['title']); ?></p></td>
                    <td><p><?php echo $c['time']; ?></p></td>
                    <td><a href="update.php?id=<?php echo $c['id']; ?>" class="btn btn-primary">Update</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <section class="" style="margin-top: 266px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #F7CF1D">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
  </footer>

</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/commentconf.js"></script>
</body>
</html>