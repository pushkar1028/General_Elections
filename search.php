<?php
$con=mysqli_connect("localhost","root","","arcd2");
set_time_limit(0);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_POST)
{
$q=$_POST['search'];
if($sql_res=mysqli_query($con,"select term from tf where term like '%$q%' LIMIT 5"))
{

while($row=mysqli_fetch_array($sql_res))
{
$username=$row['term'];

?>
<div class="show" align="left">
<span class="name"><?php echo $username; ?></span>&nbsp;<br/><br/>
</div>
<?php
}
}}
if(isset($_GET["searchid"])){
$query=$_GET["searchid"];
$words = preg_split('/[\s,]+/', $query, -1, PREG_SPLIT_NO_EMPTY);
$last_key = key( array_slice( $words, -1, 1, TRUE ) );
if(!$last_key)
$last_key=0;
echo "<h1> The top 10 results for your search are <br> </h1>";
for($i=1;$i<=280;$i++)
{
$vector[$i]=0;
}
$res3=mysqli_query($con,"delete from results");
for($i=1;$i<=280;$i++)
{
$f="doc".$i;
//$vector[$i]=0;
//echo  "<br>";
for($j=0;$j<=$last_key;$j++)
{
//echo $last_key;
//echo  "<br>";
//echo $words[$j];
//echo  "<br>";
if($res=mysqli_query($con,"select * from tf where term='$words[$j]'"))
{
$row1=mysqli_fetch_array($res);
{
if($row1[$f])
{
if($res1=mysqli_query($con,"select * from `table 4` where term='$words[$j]'"))
{
$row2=mysqli_fetch_array($res1);
//echo $f;
//echo  "<br>";
//echo $words[$j]."----------------------";
$var1=log((1+$row1[$f]));//
$var2=$row2['idf'];
//$vector[$i]=$var1*$var2;
//echo $row1[$f];
//echo  "<br>";
}
$var3=$var1*$var2;
$vector[$i]=$vector[$i]+$var3;
//echo $vector[$i];
$var1=0;
$var2=0;
}
}
}
//echo $var1;
//echo  "<br>";
//echo $var2;

//echo $vector[$i];
//echo  "<br>";
}

$res4=mysqli_query($con,"insert into results values ('$f','$vector[$i]')");

}

$res5=mysqli_query($con,"select * from results order by vector desc limit 10 ");
while($row6=mysqli_fetch_array($res5))
{
if($row6['vector']==0)
{
echo"NO MORE RESULTS <br>";
break;
}
$temp=$row6['doc'];
$res2=mysqli_query($con,"select * from link where doc='$temp'");
$row3=mysqli_fetch_array($res2);
echo "<a href=\"".$row3['link']."\">".$row3['link'];
echo "-------------------------------- </a>";
echo $row6['vector'];
echo  "<br>";
}}
?>
