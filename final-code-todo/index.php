<?php
include_once("superclass.php");


    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }
    
    $list = new Lists();
    $userid = $_SESSION['id'][0];
    $lists = $list->getAll($userid);
    

    
    
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
    <link rel="icon" 
      type="image/png" 
      href="/img/LogoTodo.png" />

</head>
<body style="background-color: #D3D3D3;">
    <nav id="navigatie" style="background-color: #F7CF1D;">
    <div class="logo" style="margin-left: 200px;">
    <a href="index.php">
      <img src="img/tmlogo.png" style="height: 80px;">
    </a>
    </div>
    <div id="welcome" class="alert alert-light">Hallo, <?php echo $_SESSION['username']?></div>
    <a href="logout.php" class="btn btn-primary white" id="logout">Logout</a>
    </nav>
   

    <div class="container">
         <div class="alert alert-danger" id="listerror" style="display:none;">Vul de lijst aan.</div>
    <div class="create-group">
            <input class="form-control" type="text" name="listname" id="listname" data-index="<?php echo $_SESSION['id'][0] ?>">
            <input class="btn btn-success" type="submit" name="createlist" id="createlist" value="Maak lijst">
            
    </div>
    <table class="table">
        <thead>
            <tr style="color: #000000">
                <th>Todo</th>
                <th>Aangemaakt</th>
                <th>Verwijderen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lists as $l):?>
                <tr>
                    <td><a href="add-list.php?id=<?php echo htmlspecialchars($l['id']); ?>&name=<?php echo htmlspecialchars($l['name']); ?>" ><?php echo htmlspecialchars($l['name']); ?></a></td>
                    <td><p><?php echo $l['time']; ?></p></td>
                    <td><a href="delete-list.php?list=<?php echo htmlspecialchars($l['name']) ?>&id=<?php echo htmlspecialchars($l['id']) ?>" data-index="<?php echo htmlspecialchars($l['name']); ?>" class="btn btn-danger delete">Verwijder</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

<section class="" style="margin-top: 546px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #F7CF1D">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
  </footer>
</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/makelist.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>