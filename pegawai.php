<?php
require_once "functions.php";
$sql = "SELECT * FROM kontak";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    		$data=array();
            while($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
            }
            $json = json_encode($data);
			echo $json;
        mysqli_free_result($result);
    } else{
        echo "No records were found.";
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}
?>