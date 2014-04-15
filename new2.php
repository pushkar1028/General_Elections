<?php
$con=mysqli_connect("localhost","root","","arcd2");
set_time_limit(0);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $filecontent = file_get_contents('order.txt');

$words = preg_split('/[\n]+/', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
//print_r($words);
for($i=0;$i<280;$i=$i+1)
{
echo $words[$i];
$j=$i+1;
$tub="doc".$j;
echo"<br>";
echo $tub;
echo"<br>";
$result1 = mysqli_query($con,"INSERT INTO link VALUES ('$words[$i]','$tub')");
}

?>