<?php



session_start();
require "create.php";
require "db.php";
$change=$_GET['change'];
$old_repo_id=$_GET['old_repo_id'];
$new_repo_id=$old_repo_id;
$username=$_SESSION['user'] ;
$user_id=$_SESSION['user_id'];
 $new_name=$_GET['name'];

  $new_description=$_GET['description'];
  //$readme=$_POST['readme'];
  //$organization=$_POST['organization'];
  $new_Private=$_GET['private'];


if (isset($_POST['save_continue']))

 { 

   $change=$change+1;
    if ($change==1) 
    {
$old_id=$_GET['old_repo_id'];
   


  
//$url=create_repo($access_token,$name);
$Query="INSERT INTO repo(name,description,pub) values(:name,:description,:pub)";
    $Stmt=$pdo->prepare($Query);
    //$Stmt->bindValue(':repo_id',$REPO_ID);
    $Stmt->bindValue(':name',$name);
    $Stmt->bindValue(':description',$description);
    $Stmt->bindValue(':pub',$pub);
    $Stmt->execute();
    //$row=$Stmt->fetch(PDO::FETCH_ASSOC);

  # code...
   
$Query="SELECT MAX(repo_id) as max_id FROM repo";
    $Stmt=$pdo->prepare($Query);
    $Stmt->execute();
    $row=$Stmt->fetch(PDO::FETCH_ASSOC);
    $new_repo_id=$row['max_id'];
    $access_token=$_SESSION['access_token'];
    
   $_SESSION['new_repo_id']=$new_repo_id; 
$Query="SELECT * from dir where repo_id=$old_id";
    $Stmt=$pdo->prepare($Query);
    $Stmt->execute();
    while($row=$Stmt->fetch(PDO::FETCH_ASSOC))
    {

      $name=$row['name'];
      $parent_dir=$row['parent_dir'];
      $dir_id=$row['dir_id'];
$Query="INSERT INTO dir(dir_id,name,parent_dir,repo_id) values(:dir_id,:name,:parent_id,:repo_id)";
  $Stmt=$pdo->prepare($Query);
  $Stmt->bindValue(':dir_id',$dir_id);
  $Stmt->bindValue(':name',$name);
  $Stmt->bindValue(':parent_id',$parent_dir);
   $Stmt->bindValue(':repo_id',$old_repo_id);
  #Stmt->bindValue(':pub',$pub);
  $Stmt->execute();
}
$Query="SELECT * from files where repo_id=$old_id";
    $Stmt=$pdo->prepare($Query);
    $Stmt->execute();
    while($row=$Stmt->fetch(PDO::FETCH_ASSOC))
    {
      $name=$row['name'];
      $parent_dir=$row['parent_dir'];
      $f_id=$row['f_id'];
$Query="INSERT INTO files(f_id,name,parent_dir,repo_id) values(:f_id,:name,:parent_id,:repo_id)";
  $Stmt=$pdo->prepare($Query);
  $Stmt->bindValue(':f_id',$f_id);
  $Stmt->bindValue(':name',$name);
  $Stmt->bindValue(':parent_id',$parent_dir);
   $Stmt->bindValue(':repo_id',$old_repo_id);
  #Stmt->bindValue(':pub',$pub);
  $Stmt->execute();

}
}

$new_repo_id=$_SESSION['new_repo_id'];
 
  $name=$_POST['name'];
   $dir_id=$_POST['dir_id'];
   $x = $_POST["file/dir"];
   
if($x == "file")
{
  if($dir_id==-1) {
    $Query="INSERT INTO files(name,parent_id,repo_id) values(:name,:parent_id,:repo_id)";
  $Stmt=$pdo->prepare($Query);
  //$Stmt->bindValue(':repo_id',$REPO_ID);
  $Stmt->bindValue(':name',$name);
  $Stmt->bindValue(':parent_id',-1);
   $Stmt->bindValue(':repo_id',$old_repo_id);
  #Stmt->bindValue(':pub',$pub);
  $Stmt->execute();
  }
  else
  {
 $Query="INSERT INTO files(name,parent_dir,repo_id) values(:name,:parent_id,:repo_id)";
  $Stmt=$pdo->prepare($Query);
  //$Stmt->bindValue(':repo_id',$REPO_ID);
  $Stmt->bindValue(':name',$name);
  $Stmt->bindValue(':parent_id',$dir_id);
   $Stmt->bindValue(':repo_id',$old_repo_id);
  #Stmt->bindValue(':pub',$pub);
  $Stmt->execute();
}
}
else if($x == "dir")
{
  $Query="INSERT INTO dir(name,parent_dir,repo_id) values(:name,:parent_id,:repo_id)";
  $Stmt=$pdo->prepare($Query);
  //$Stmt->bindValue(':repo_id',$REPO_ID);
  $Stmt->bindValue(':name',$name);
  if ($dir_id==-1) {
    $Stmt->bindValue(':parent_id',-1);
  }
  else{
  $Stmt->bindValue(':parent_id',$dir_id);
}
   $Stmt->bindValue(':repo_id',$new_repo_id);
  #Stmt->bindValue(':pub',$pub);
  $Stmt->execute();
}

 header("Location: edit_filess.php?old_repo_id=$new_repo_id&name=$name&description=$description&private=$Private&change=$change");

  }







  






if (isset($_POST['save_template'])) {
  header("Location: home.php");

}
if (isset($_POST['github_link1'])) {

$Query="select * from repo where repo_id=:repo_id";
  $Stmt=$pdo->prepare($Query);
     $Stmt->bindValue(':repo_id',$old_repo_id);
  $Stmt->execute();
  $row=$Stmt->fetch(PDO::FETCH_ASSOC);
  if ($row['pub']=="1") {
    $Private="false";
  }
  else
  {
    $Private="true";
  }
$description=$row['description'];
$name=$row['name'];
$access_token=$_SESSION['access_token'];
$html_url=create_repo($access_token,$name,$description,$Private);
 


ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
 $Query="SELECT * from dir where repo_id=$repo_id";
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
                        $Query="SELECT * from dir where dir_id=:pdir and repo_id=$new_repo_id";
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

 $Query="SELECT * from files where repo_id=$repo_id";
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
                        $Query="SELECT * from dir where dir_id=:pdir and repo_id=$new_repo_id";
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
  <style>
    h3{
      margin-top: 70px;
      margin-left: 100px;
    }
    .card{
      margin-left: 100px;
      margin-right: 0px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
  </style>
  
</head>

<body>

  <!--/ Nav Star /-->
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
   <br/> <br/> <br/> <br/> <br/> 
         <div class="col-sm-12 section-t8">
          <div class="row">
            <div class="col-md-7">
              <h3>Edit files</h3>
              <div class="card">
                  <div class="card-body" style="width:100%;">
                    <div class="container">
                     <form class="form-a contactForm" action="edit_filess.php?old_repo_id=<?php echo $old_repo_id;?>&name=<?php echo $name;?>&description=<?php echo $description;?>&private=<?php echo $Private;?> &change=<?php echo $change;?>" method="post" role="form">
                     <div class="col-md-12 mb-3">
                       <div class="form-group">
                         <h5>Select File Or Folder</h5>
                          <input type="radio" name="file/dir" value="file" checked> File<br>
                          <input type="radio" name="file/dir" value="dir"> Directory<br>
                      </div>
                </div>
                 <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control form-control-lg form-control-a" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" size="70">
                      <div class="validation"></div>
                    </div>
                  </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                  <select class="custom-select" name="dir_id">
                    <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                  
                      $temp="SELECT name from repo where repo_id=$old_repo_id";
                      $Stmt=$pdo->prepare($temp);
                      $Stmt->execute();
                      $x=$Stmt->fetch(PDO::FETCH_ASSOC);
                      $repo_name=$x['name'];
                      $str = "<option value='-1'>".$repo_name."</option>";
                      echo $str;
                    $Query="SELECT * from dir where repo_id=$old_repo_id";
                    $Stmt=$pdo->prepare($Query);
                    $Stmt->execute();

                    while ($row=$Stmt->fetch(PDO::FETCH_ASSOC))
                     {
                      
                      $url=$row['name'];
                      $pdir=$row['parent_dir'];
                      
                      $dir_id=$row['dir_id'];
                     
                      if($pdir==-1)
                      {
                        $url = $repo_name."/".$url;
                        $str = "<option value='".$dir_id."'>".$url."</option>";
                   
                     echo $str;
                    }
                    else
                    {
                    
                     while($pdir!=-1)
                      {
                        $Query="SELECT * from dir where dir_id=:pdir and repo_id=$old_repo_id";
                        $Stmt2=$pdo->prepare($Query);
                         $Stmt2->bindValue(':pdir',$pdir);
                        $Stmt2->execute();
                        $r=$Stmt2->fetch(PDO::FETCH_ASSOC);
                        $url = $r['name']."/".$url;
                     
                        $pdir = $r['parent_dir'];
                      }
                      
                      $url=$repo_name.'/'.$url;
                      $str = "<option value='".$dir_id."'>".$url."</option>";
                      echo $str;
                                           
                    }
                  }
                    ?> 
              </select>
            </div>
          </div>
<br><br>
<div class="row">
 <div class="col-md-12">
   <input type="submit"  class="btn btn-lg btn-success" style="margin-left:180px;margin-top:20px; " name="save_continue" value="Save and continue">
 </div>
 <div class="col-md-12">
    <input type="submit"  class="btn btn-lg btn-success" style="margin-left:200px;margin-top:20px; " name="save_template" value="Save Template">
 </div>
 <div class="col-md-12">
    <input type="submit"  class="btn btn-lg btn-success" style="margin-left:200px;margin-top:20px; " name="github_link" value="Get github link">
 </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
