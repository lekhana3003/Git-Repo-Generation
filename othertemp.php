<?php
session_start();

if(isset($_SESSION['login']))
{
if ($_SESSION['login']==false) {

 header("Location: index.php");
}
else if ($_SESSION['login']==true) {
  # code...


require "db.php";
?>

 <html>
 <head>
  <meta charset="utf-8">
  <title>The Dragas</title>
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

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">


</head>
  
<style type="text/css">
body{

        background-image: url('./assets/pets/r.jpg');
    }
    .card {
       box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
       transition: 0.3s;
       display: inline-block;
       margin-top: 10px;
       margin-right:10px;
    }

    .card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  
}
</style>
 <body>
   <nav class="navbar navbar-default navbar-trans">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">The<span class="color-b">Dragas</span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
    </div>
  </nav>

  <div class="row container-fluid" style="text-align: center;">
<?php
 $Query="SELECT * from repo";
                    $Stmt=$pdo->prepare($Query);
                    $Stmt->execute();
     while ($row=$Stmt->fetch(PDO::FETCH_ASSOC))
     {
      $name=$row['name'];
      $public=$row['pub'];
      $description=$row['description'];
      $repo_id=$row['repo_id'];
      $username=$row['username'];

?>
    <div class="container-fluid col-lg-5 col-md-5 col-sm-5 col-xs-12 card">
      <div class="card-body">
        <h3 >Template</h3>  
        <div class="form-group">
          <h5>Template: <?php echo $repo_id;?></h5></br>
        </div>
        <div class="form-group">
          <h5>Name:<?php echo $name;?></h5></br>
        </div>
      <div class="form-group">
        <h5>Public/Private : <?php echo $public;?></h5></br>
      </div>
      <div class="form-group">
        <h5>Username : <?php echo $username;?></h5></br>
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
}
}
?>

</div>
</body>
</html>