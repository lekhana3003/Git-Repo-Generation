<!DOCTYPE html>
<html lang="en">
<head>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <style>
 .card {
    box-shadow: 0 45px 60px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 100%;
    height:250px;
    border: 3px;
}
h3{
  color: white;
  background-color: green; 
  width: 100%;
  height: 30px;
  vertical-align: middle;
  display: inline-block;
  font-size: 20px;
  padding: 7px;

}
.card:hover {
    box-shadow: 0 10px 15px 0 rgba(0,0,0,0.2);
}

.container {
  
}
table
{
    border-collapse: collapse;
   
}
th {
    font-size: 20px;
      font-weight: bold;
     
    border-collapse: collapse;
}
td
{
  font-weight: bold;
    border-collapse: collapse;
    padding: 8px;

    font-size: 20px;
   
}
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
      <a class="navbar-brand text-brand" href="index.php">The<span class="color-b">Dragas</span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
        
          <li class="nav-item">
            <a class="nav-link" href="index.php#about_product">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#team">Team</a>
          </li>
        </ul>
      </div>
      
    </div>
  </nav>
   <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
<?php
require 'db.php';

$repo_id = $_GET['repo_id'];
$result = "SELECT * FROM repo WHERE repo_id=$repo_id";
$Stmt = $pdo->prepare($result);
$Stmt->execute();
$row=$Stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="card" style="height: 100%;">
<h3 >TEMPLATE :<?php echo $repo_id;?></h3>  

        <table style="width: 100%">
      <tr>
        <td>NAME : <?php echo $row['name'];?></td>
        <td></td>
        <td>PUBLIC\PRIVATE <?php echo $row['pub'];?></td>
      </tr>
      <tr>
        <td>DESCRIPTION : <?php echo $row['description'];?></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><form action="structure.php" method="POST" ><input type="submit" name="structure" class="btn btn-lg btn-success" value="show structure"></form></td>
        <td><form action="edit_structure.php" method="POST" ><input type="submit" name="edit_structure" class="btn btn-lg btn-success" value="Edit structure"></form></td>
        <td><form action="get_link.php?repo_id=<?php echo $repo_id;?>&name=<?php echo $name;?>" method="POST" ><input type="submit" name="get_link" value="Get github link" class="btn btn-lg btn-success"></form></td>
      </tr>
    
    </table> 

</div>


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
</body>
</html>
