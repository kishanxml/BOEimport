<?php

$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo connect_error;
}
echo "Connected successfully";
$sql="use list_codes";
$result = $conn->query($sql);
echo $result;

#======================================================================
 $count=0;
 $table='code_def';// get from request parameter
 $stack = array();
 $path='C:/xampp/htdocs/BOEimport/uploads/';
 
 $target_dir = "./uploads/"; foreach ($_FILES['fileToUpload']['name'] as $i => $name) {
        if (strlen($_FILES['fileToUpload']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], './uploads/'.$name)) {
				$target_file = $target_dir.$name;
				$handle = fopen($target_file, "r");
				$row = 1;
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$data = fgetcsv($handle, 10000, ",");
					$num = count($data);
					$row++;
			for ($c=0; $c < $num; $c++) {
					array_push($stack,$data[$c]);					
					echo $data[$c]." |--| ";
			}
			fclose($handle);
        }else{
			echo "one file cant uploads \n";
			echo move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], './uploads/'.$name);
		}
		}
	}
echo $count;
// get table name variable from requests and then check that table column with csv header
$sql1="select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='".$table."'";
$result1 = $conn->query($sql1);

while($row=$result1->fetch_assoc()) {
	$var= current($stack);
	 if ($row['COLUMN_NAME'] != $var ){
		echo "column dont match".$row['COLUMN_NAME']."==>".$var; 
	 }
	 next($stack);
}

$result = $conn->query($sql);
$sql1="LOAD DATA INFILE '".$path.$name."' INTO TABLE ".$table." IGNORE 1 LINES";

echo $target_file;
echo $sql1;

$result1 = $conn->query($sql1);
?>