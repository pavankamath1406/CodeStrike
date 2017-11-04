<?php
require ('../imacConnect.php'); 
session_start();
if(!isset($_SESSION['userId'])){
	header('Location:login.php');
}
?>
<div id="content_table">
	<form action="" method="post">
<input type="text" name="search">
<input type="submit" name="submit" value="Search">
</form>
<p id="studentsList">List of Students Registered:</p>
	<table >
		<tr>
			<th>Name</th>
			<th>Year</th>
			<th>Branch</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Batch</th>
		</tr>
		<tr>
			<td>Name</td>
			<td>Year</td>
			<td>Branch</td>
			<td>Email</td>
			<td>Mobile</td>
			<td>Status</td>
			<td>Batch</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>Year</td>
			<td>Branch</td>
			<td>Email</td>
			<td>Mobile</td>
			<td>Status</td>
			<td>Batch</td>
		</tr>
		<?php
		$search_value=$_POST["search"];
		$sql="SELECT * FROM $tableName where Name like '%$search_value%'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>".$row["Name"]."</td>";
				echo "<td>".$row["Year"]."</td>";
				echo "<td>".$row["Branch"]."</td>";
				echo "<td>".$row["Email"]."</td>";
				echo "<td>".$row["Mobile"]."</td>";
				echo "<td>".$row["Status"]."</td>";
				echo "<td>".$row["Batch"]."</td>";
				echo "</tr>";
			}
		}else{
			echo "NO DATA";
		}
		?>
		<?php
		$sql = "SELECT * FROM $tableName ";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while ($row=mysqli_fetch_assoc($result)){
				echo "<tr>";
				echo "<td>".$row["Name"]."</td>";
				echo "<td>".$row["Year"]."</td>";
				echo "<td>".$row["Branch"]."</td>";
				echo "<td>".$row["Email"]."</td>";
				echo "<td>".$row["Mobile"]."</td>";
				echo "<td>".$row["Status"]."</td>";
				echo "<td>".$row["Batch"]."</td>";
				echo "</tr>";
			}
		}else{
			echo "NO DATA";
		}
		?>
	</table>
</div>