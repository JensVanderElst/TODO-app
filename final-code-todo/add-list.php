<?php
include_once("superclass.php");

    if (isset($_SESSION['username'])) {
        $user = new User();
        $user->setUsername($_SESSION['username']);
        //var_dump($_SESSION);
    } else {
        header('location: login.php');
    }
    
    $_SESSION["listpage"] = $_SERVER["REQUEST_URI"];

    $task = new Task();
    $listid = $_GET['id'];
    $tasks = $task->getAll($listid);

    $date = date('Y-m-d');


    
    
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/master.css">

</head>
<body>
    <nav id="navigatie" style="background-color: #F7CF1D;">
    <div class="logo" style="margin-left: 200px;">
    <a href="index.php">
      <img src="img/tmlogo.png" style="height: 80px;">
    </a>
    </div>
    <div id="welcome" class="alert alert-light">Hallo, <?php echo $_SESSION['username']?></div>
    <a href="index.php" class="btn btn-primary white" id="logout">Ga terug</a>
    </nav>

    <div class="container taskcontainer">
    <h1 class="title"><?php echo $_GET['name']; ?></h1>
    <div class="alert alert-danger" id="taskerror" style="display:none;">Vul de lijst naam in.</div>
    <div class="create-group">
            <label class="tasklabel" for="name">To do:</label>
            <label class="tasklabel" for="time">Tijd nodig:</label>
            <label class="tasklabel" for="enddate">Deadline:</label>
    </div>

    <div class="create-group">
            <input class="form-control" type="text" name="taskname" id="taskname" data-index="<?php echo $_GET['id'] ?>">
            <input class="form-control" type="time" name="timestamp" id="time">
            <input type="date" name="datestamp" id="enddate">
            <input class="btn btn-success" type="submit" name="createtask" id="createtask" value="Maak taak">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ToDo</th>
                <th>Tijd</th>
                <th>deadline</th>
                <th>Status</th>
                <th>Verwijderen</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $t):?>
    
            <?php $date1 = date('Y-m-d'); $date2 = $t['enddate']; 
                    $d1 = strtotime($date1); $d2 = strtotime($date2);
                    $years = date('Y', $d2) - date('Y', $d1); 
                    $months = date('m', $d2) - date('m', $d1); 
                    $days = date('d', $d2) - date('d', $d1);
                    //https://www.php.net/manual/en/ref.datetime.php
            ?>
                <tr>
                    <td><a href="comment.php?id=<?php echo htmlspecialchars($t['id']); ?>&name=<?php echo htmlspecialchars($t['title']); ?>" ><?php echo htmlspecialchars($t['title']);?></a></td>
                    <td><p><?php echo htmlspecialchars($t['time']); ?></p></td>
                    <td><p id="<?php if ($days > 0 && $days < 1 ) {echo 'binnenkort';} elseif ($days < 0 ) {echo 'laat';} ?>"><?php echo htmlspecialchars($t['enddate']); ?></p> <p><?php echo $days, ' days remaining'; ?></p></td>
                    <td><a href="" taskid="<?php echo htmlspecialchars($t['id']); ?>"  data-index="<?php echo htmlspecialchars($t['title']); ?>" data-listid="<?php echo $listid ?>" id="done<?php echo $t['id']; ?>" class="taskbtn btn <?php if ($t['done'] == '0') {echo 'btn-danger';} else {echo 'btn-success';}?> delete"><?php if ($t['done'] == '0') {echo 'Niet voltooid';} else {echo 'Voltooid';}?></a></td>
                    <td><a href="delete-task.php?task=<?php echo htmlspecialchars($t['title']) ?>&id=<?php echo $t['id'] ?>" data-index="<?php echo htmlspecialchars($t['name']); ?>" class="btn btn-danger delete">Verwijder</a></td>
                    <td>
                    <div class="container">
               
     <div class="row">
        <?php
        //https://www.startutorial.com/articles/view/php_file_upload_tutorial_part_1
        $folder = "uploads";
        $results = scandir('uploads');
        foreach ($results as $result) {
         if ($result === '.' or $result === '..') continue;
         
         if (is_file($folder . '/' . $result)) {
             echo '
             <div class="col-md-3">
                 <div class="thumbnail">
                     <img src="'.$folder . '/' . $result.'" alt="..." style="width: 150px;">
                         <div class="caption">
                         <p><a href="remove.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Remove</a></p>
                     </div>
                 </div>
             </div>';
         }
        }
        ?>
     </div>
      
      

       <div class="row">
         <div class="col-lg-12">
            <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="file">Selecteer een bestand om op te laden</label>
                 <input type="file" name="file">
               </div>
               <input type="submit" class="btn btn-lg btn-primary" value="Upload">
             </form>
         </div>
       </div>
 </div> <!-- /container -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    
    <section class="" style="margin-top: 356px;">

  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #F7CF1D">
    <div class="container p-4 pb-0">
    </div>

  </footer>

</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/createtask.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/done.js"></script>
</body>
</html> 