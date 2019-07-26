<?php
/*session_start();
if(isset($_SESSION['login']))
{
if ($_SESSION['login']==false) {

 header("Location: index.php");
}
else
{
  header("Location: index.php");
}
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <link href="lib/animate/animate.min.css" rel="stylesheet">
 <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
 <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
 <link href="css/style.css" rel="stylesheet">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    body{
        margin: 2rem;
        background-image: url('./assets/pets/r.jpg');
    }
    .card {
       box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
       transition: 0.3s;
       width: 100%;
       margin-top: 75px;
       margin-left:15px;
       margin-top: 75px;
    }

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}

.container {
  padding: 2px 16px;
}
    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.php" font size="6">The<span class="color-b"  font size="6">Dragas</span></a><br/><br/><br/><br/>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        
      </div>
      
    </div>
  </nav>
  <br><br>
  <div class="row container-fluid" style="text-align: center;">
<?php
require 'db.php';
$count=0;
$x = $_GET['name'];
$Query = "SELECT * FROM repo WHERE name LIKE '%$x%'";
$Stmt = $pdo->prepare($Query);
$Stmt->execute();
while($row=$Stmt->fetch(PDO::FETCH_ASSOC))
{ $count=1;
    $repo_id = $row['repo_id'];
    $name = $row['name'];
    $description = $row['description'];
    $pub = $row['pub'];

?>

<div class="container-fluid col-lg-5 col-md-5 col-sm-5 col-xs-12 card">
      <div class="card-body">
        <h3 >Template</h3>  
        <div class="form-group">
          <h5>Repository: <?php echo $repo_id;?></h5></br>
        </div>
        <div class="form-group">
          <h5>Name:<?php echo $name;?></h5></br>
        </div>
      <div class="form-group">
        <h5>Public/Private : <?php echo $pub;?></h5></br>
      </div>
      <table style="width: 100%">
        <tr>
          <td><form action="display.php?repo_id=<?php echo $repo_id;?>&name=<?php echo $name;?>" method="POST" ><input type="submit" name="get_link" value="Show Structure" class="btn btn-lg btn-success"></form></td>
          <td><form action="get_link.php?repo_id=<?php echo $repo_id;?>&name=<?php echo $name;?>" method="POST" ><input type="submit" name="get_link" value="Get github link" class="btn btn-lg btn-success"></form></td>
        </tr>  
      </table>      
    </div>
  </div>
<?php
}
if ($count==0) {
   echo "<h3>No results found</h3>";
}

?>
</div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 


</body>
</html>


