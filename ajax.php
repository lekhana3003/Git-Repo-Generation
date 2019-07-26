<?php
 $con = mysqli_connect('localhost','bhavya','bhavya123','gitrepo');
 
if (isset($_POST['search'])) {
  $Name = $_POST['search'];
  $Query = "SELECT name,repo_id FROM repo WHERE name LIKE '%$Name%' LIMIT 5";
  $ExecQuery = MySQLi_query($con, $Query);
  echo "
    <div class='searchResult'>
      <ul style=''>
  ";
  while ($Result = MySQLi_fetch_array($ExecQuery)) {
  ?>
   <li onclick='fill("<?php echo $Result['name']; ?>")'>
   <a>
      <?php
        $cname = $Result['name'];
        $rid = $Result['repo_id'];
        echo "
          <a href='show.php?rid=$rid'>$cname</a>
        ";
      ?>

    </li>
    </a>
  <?php
}}
?>

</ul>
</div>