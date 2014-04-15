<?php
$con=mysqli_connect("localhost","root","","arcd2");
set_time_limit(0);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
//print_r($words);
  $result1 = mysqli_query($con,"SELECT term FROM tf");
  while($row1 = mysqli_fetch_array($result1))   
  {
   for($i=1;$i<=280;$i++)
  {
  $f=$i.".txt";
  $filecontent = file_get_contents($f);
  $words = preg_split('/[\n,]+/', $filecontent, -1, PREG_SPLIT_NO_EMPTY);
  //print_r($words);
	$last_key = key( array_slice( $words, -1, 1, TRUE ) );
	echo $last_key;
	echo "<br>";
	for($k=0;$k<$last_key;$k=$k+2)
	{
	if($row1['term']==$words[$k])
	{
		$hh="doc".$i;
		$pg=$row1['term'];
		$l=$k+1;
		echo $hh;
		echo $words[$l];
		$result2=mysqli_query($con,"UPDATE tf SET $hh=$words[$l] WHERE term='$pg'");
	}
	}
	}
	}
	

?>