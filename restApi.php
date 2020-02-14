<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
   $req=$_GET['name'];
}
else
{
		$req=$_POST['roll'];
}
$conn=mysqli_connect("localhost:3306","root","");
if(mysqli_connect_errno())
{
	echo'DataBase can\'t be connected';
}
else
{
	$data=array();
	mysqli_select_db($conn,"db1");
	$query="select * from student where name='$req';";
	$result=mysqli_query($conn,$query);
	$num_results=mysqli_num_rows($result);
	for($i=0;$i<$num_results;$i++)
	{
		$row=mysqli_fetch_assoc($result);
		$nam=$row['name'];
		$mob=$row['mobnumber'];
		array_push($data,"{'name':'$nam','mobnumber':'$mob'}");
	}
	if($num_results==0)
	{
		 http_response_code(404);
		 $da=json_encode(array("message" => "No products found."));
	}
	else
	{
		http_response_code(200);
	}
	exit();
}	

?>