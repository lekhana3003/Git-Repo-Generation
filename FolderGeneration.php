<?php
// session_start();
$repo_id=$_GET['repo_id'];
require "db.php";
//$con = mysqli_connect('localhost','bhavya','bhavya123','gitrepo');
$sql = "SELECT dir_id,name,parent_dir FROM dir WHERE repo_id = $repo_id";
    $Stmt=$pdo->prepare($sql);
      $Stmt->execute();
$json_array = array();
while($row=$Stmt->fetch(PDO::FETCH_ASSOC))
{   
if($row['parent_dir'] == -1){
    $row['parent_dir'] = '#';
}
    $json_array[] = $row;

}
 //echo (json_encode($json_array));

 $sql1 = "SELECT f_id,name,parent_dir FROM files WHERE repo_id = $repo_id";
$Stmt=$pdo->prepare($sql1);
      $Stmt->execute();
$json_array1 = array();
while($row1=$Stmt->fetch(PDO::FETCH_ASSOC))
{
  if($row1['parent_dir'] == -1){
    $row1['parent_dir'] = '#';
}
    $json_array1[] = $row1;
}



  json_encode($json_array1);
 $result = array_merge($json_array,$json_array1);

//$test = ['f_id' => 2, 'name' => 'test', 'parent_dir' => 'test2', 'dir_id' => 2];
 $rewriteKeys = array('f_id' => 'id', 'name' => 'text', 'parent_dir' => 'parent', 'dir_id' => 'id');
 $newArr = array();
 


 foreach ($result as $index => $item){ 
    foreach ($item as $key => $value) {
        $newArr[$index][$rewriteKeys[$key]] = $value; 
    }
}

 
echo(json_encode($newArr));

?>