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
$old_repo_id=$_GET['repo_id'];

$_SESSION['temp']=false;
require "create.php";
require "db.php";
$name=$_GET['name'];
$access_token=$_SESSION['access_token'];
$username=$_SESSION['user'];

if (isset($_POST['create_repo_temp']))
 {
  
  $name=$_POST['name_d'];
  $description=$_POST['description'];
  //$readme=$_POST['readme'];
  //$organization=$_POST['organization'];
  $pub=$_POST['pub'];
  if ($pub=="1") {
    $Private="false";
    # code...
  }
  else
  {
    $Private="true";
  }
  




$html_url=create_repo($access_token,$name,$description,$Private);
 


ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
 $Query="SELECT * from dir where repo_id=$old_repo_id";
                    $Stmt=$pdo->prepare($Query);
                    $Stmt->execute();
     while ($row=$Stmt->fetch(PDO::FETCH_ASSOC))
                     {
                      //echo "$str";
                      $url=$row['name']."/".".gitignore";
                      $pdir=$row['parent_dir'];
                      
                      $dir_id=$row['dir_id'];
                     
                    
                     while(!($pdir==-1))
                      {
                        $Query="SELECT * from dir where dir_id=:pdir and repo_id=$old_repo_id";
                        $Stmt2=$pdo->prepare($Query);
                         $Stmt2->bindValue(':pdir',$pdir);
                        $Stmt2->execute();
                        $r=$Stmt2->fetch(PDO::FETCH_ASSOC);
                        $url = $r['name']."/".$url;
                        $pdir = $r['parent_dir'];
                      }
                      
                     
                                           
                    //echo $url;
                    create_files($access_token,$username,$name,$url,$username);
                  }

 $Query="SELECT * from files where repo_id=$old_repo_id";
                    $Stmt=$pdo->prepare($Query);
                    $Stmt->execute();
     while ($row=$Stmt->fetch(PDO::FETCH_ASSOC))
                     {
                      //echo "$str";
                      $url=$row['name'];
                      $pdir=$row['parent_dir'];
                      
                      //$dir_id=$row['dir_id'];
                     
                    
                     while($pdir!=-1)
                      {
                        $Query="SELECT * from dir where dir_id=:pdir  and repo_id=$old_repo_id";
                        $Stmt2=$pdo->prepare($Query);
                         $Stmt2->bindValue(':pdir',$pdir);
                        $Stmt2->execute();
                        $r=$Stmt2->fetch(PDO::FETCH_ASSOC);
                        $url = $r['name']."/".$url;
                   
                        $pdir = $r['parent_dir'];
                      }
                      
                     
                                           
                    //echo $url;
                     create_files($access_token,$username,$name,$url,$username);
                  }

header("Location: final.php?html_url=$html_url;");

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

<body>


<!-- <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.php">The<span class="color-b">dragas</span></a>
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
  </nav>-->
   <br/> <br/> <br/> <br/> <br/> <br/> 
  <h3>Create repository using "<?php echo $name;?>" template</h3>
         <div class="col-sm-12 section-t8">
          <div class="row">
            <div class="col-md-7">
      <form class="form-a contactForm" action="get_link.php?repo_id=<?php echo $old_repo_id;?>&name=<?php echo $name;?>" method="POST" role="form"> 
                 <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <h4>Name:</h4>
                      <input type="text" name="name_d" class="form-control form-control-lg form-control-a" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                      <div class="validation"></div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <h4>Description</h4>
                      <textarea name="description" class="form-control" cols="45" rows="8" placeholder="description"></textarea>
                      <div class="validation"></div>
                    </div>
                  </div>
  <!--
                    <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <textarea name="readme" class="form-control" cols="45" rows="8" placeholder=readme></textarea>
                      <div class="validation"></div>
                    </div>
                  </div>
              <div class="col-md-12 mb-3">
                    <div class="form-group">
                  <select class="custom-select" name="organization">
                <option selected>All</option>
                <option value="1">New to Old</option>
                <option value="2">For Rent</option>
                <option value="3">For Sale</option>
              </select>
            </div>
          </div>-->
<br><br>
                              <div class="col-md-12 mb-3">
                    <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="pub" value="1" checked><h4>Public</h4> 
                    </label>
                    <label class="radio-inline"><input type="radio" name="pub" value="0"> <h4>Private</h4></label>
                      
                      </div>
                      </div>
                  <div class="col-md-12">
                    <input type="submit"  class="btn btn-lg btn-success" style="margin-left:650px;margin-top:100px; " name="create_repo_temp" value="Create Template">
                </div>
              </form>
            </div>
</body>
</html>