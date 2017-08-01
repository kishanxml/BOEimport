<?php

$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo connect_error;
}
echo "Connected successfully";

#======================================================================
 $count=0;
 $target_dir = "./uploads/";
echo phpinfo();
 foreach ($_FILES['fileToUpload']['name'] as $i => $name) {
        if (strlen($_FILES['fileToUpload']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], './uploads/'.$name)) {
				$target_file = $target_dir.$name;
				$handle = fopen($target_file, "r");
				$row = 1;
				echo "started";
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$data = fgetcsv($handle, 10000, ",");
					$num = count($data);
					$row++;
			for ($c=0; $c < $num; $c++) {
						echo $data[$c]."--";
			}
			fclose($handle);
        }else{
			echo "one file cant uploads \n";
			echo move_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i], './uploads/'.$name);
			
			echo "one file cant uploads \n";
		}
		}
	}

echo $count;



//$result = $conn->query($sql);

//$sql1="LOAD DATA INFILE 'ulster_verified.csv' INTO TABLE table_name IGNORE 1 LINES";

//$result1 = $conn->query($sql1);




?>
