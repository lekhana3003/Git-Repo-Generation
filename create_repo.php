<?php
session_start();
/*if(isset($_SESSION['login']))
{
if ($_SESSION['login']==false) {

 header("Location: index.php");
}
else
{
  header("Location: home.php");
}
}*/



require "create.php";
require "db.php";

$name="";
$access_token=$_SESSION['access_token'];
$username=$_SESSION['user'] ;


if (isset($_POST['create_repo']))
 {
  
  $name=$_POST['name_d'];
  $description=$_POST['description'];
  //$readme=$_POST['readme'];
  //$organization=$_POST['organization'];
  $pub=$_POST['pub'];
  if ($pub=="1") {
    $Private="true";
    # code...
  }
  else
  {
    $Private="false";
  }

  
//$url=create_repo($access_token,$name);
$Query="INSERT INTO repo(name,description,pub,username) values(:name,:description,:pub,:user)";
    $Stmt=$pdo->prepare($Query);
    //$Stmt->bindValue(':repo_id',$REPO_ID);
    $Stmt->bindValue(':name',$name);
    $Stmt->bindValue(':description',$description);
    $Stmt->bindValue(':pub',$pub);
    $Stmt->bindValue(':user',$username);
    $Stmt->execute();
    //$row=$Stmt->fetch(PDO::FETCH_ASSOC);

  # code...
   
$Query="SELECT MAX(repo_id) as max_id FROM repo";
    $Stmt=$pdo->prepare($Query);
    $Stmt->execute();
    $row=$Stmt->fetch(PDO::FETCH_ASSOC);
    $repo_id=$row['max_id'];
    $access_token=$_SESSION['access_token'];
    
   $_SESSION['repo_id']=$repo_id; 
    header("Location: create_filess.php?repo_id=$repo_id");



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The Dragas</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<style>
  h3{
    margin-left: 100px;
    margin-top: 50px;
  }
  .card{
 margin-right: 100px;
 margin-left: 100px;
 margin-bottom: 100px;
 margin-top: 20px;
 box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

</style>
<body>
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
  <div class="container">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
      aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <a class="navbar-brand text-brand" href="index.php" font size="5">The<span class="color-b"  font size="5">Dragas</span></a><br/><br/>
    <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
      data-target="#navbarTogglerDemo01" aria-expanded="false">
      <span class="fa fa-search" aria-hidden="true"></span>
    </button>  
  </div>
</nav>
<br><br><br><br>
<h3>Create Template</h3>
  <div class="card">
      <div class="card-body">
        <div class="container">
         <div class="col-sm-12 section-t8">
          <div class="row">
            <div class="col-md-7">
      <form class="form-a contactForm" action="create_repo.php" method="POST" role="form"> 
                 <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <h4>Name:</h4>
                      <input type="text" name="name_d" class="form-control form-control-lg form-control-a" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                      <div class="validation"></div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <h4>Description:</h4>
                      <textarea name="description" class="form-control" cols="45" rows="8" placeholder="Description"></textarea>
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <h4>Jenkins:</h4>
                      <textarea name="description" class="form-control" cols="45" rows="8" placeholder="Description"></textarea>
                      <div class="validation"></div>
                    </div>
                  </div>
                </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <input type="radio" name="pub" value="1" checked><h6>Public</h6> 
                      <input type="radio" name="pub" value="0"> <h6>Private</h6>
                      </div>
                      </div>
                  <div class="col-md-12">
                    <input type="submit"  class="btn btn-lg btn-success" style="margin-left:400px;margin-top:20px; " name="create_repo" value="Create Template">
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
</body>
</html>

 