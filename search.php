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
?>