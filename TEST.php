<?php

require 'fitbitphp.php';

if(isset($_GET['submit']))
{


//$fitbitkey = $_REQUEST['FITBIT_KEY'];
//$fitbitkey= $_REQUEST['FITBIT_SECRET'];

$fitbit = new FitBitPHP($fitbitkey, $fitbitsecret);
$fitbit->resetSession();
$fitbit->initSession('');
$fitbit->resetSession();
$xml = $fitbit->getHeartRate();

echo '<prev>';
var_dump($xml);
echo '</prev>';
}

?>

<html>
 <div class="textboxes">
    <p>FITBIT KEY</p>
    <form method="GET" action="TEST.PHP">
    <input type="text" name="tb1" id="t1">
    <p>FITBIT SECRET</p>
    <input type="text" name="tb2" id="t2">
    <input type="submit" name="submit">
    </form>
 </div>  
</html>


