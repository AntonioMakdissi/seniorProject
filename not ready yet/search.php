<?php
if(isset($_POST['submit'])) {
  $selected_department = $_POST['department'];
  $selected_department2=explode(" ",$_POST['department']);
  if(count($selected_department2)<2){
  $f1=$selected_department2[0];
  $query = "SELECT * FROM app_data WHERE (Firstname LIKE'".$f1."%' OR Lastname LIKE'".$f1."%' OR Department LIKE '".$selected_department."%') AND status = 'approved' ORDER BY id ASC";
 
  }else{
    $f1=$selected_department2[0];
  $f2=$selected_department2[1];
  $query = "SELECT * FROM app_data WHERE (Firstname LIKE '".$f1."%' OR Lastname LIKE '".$f2."%' OR Department LIKE '".$selected_department."%') AND status = 'approved' ORDER BY id ASC";
  
  }
   $result = mysqli_query($conn, $query);
  $_POST= array();
}else
{

  $query = "SELECT * FROM app_data WHERE status = 'approved' ORDER BY id ASC";
  $result = mysqli_query($conn, $query);
}

?>

<!-- to use in html -->
<form action="contact.php" method="POST">
			<input name="department" type="text" placeholder="Search...">
    <input name="submitt" type="submit" value="Search"/>			
    
		</form>