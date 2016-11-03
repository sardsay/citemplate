<?php

/*$uploaddir = 'uploads/';
$file = basename($_FILES['userImage']['name']);
$uploadfile = $uploaddir . $file;

if (move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadfile)) {
        echo "1";
}else{
   echo "0";
}
*/
?>
<?php
if(isset($_FILES["myImage"]["tmp_name"])){

	list($width, $height, $type, $attr) = getimagesize($_FILES["myImage"]["tmp_name"]);
	$target_dir = "../tmp/upload/";
	$name_image = time().'_'.basename($_FILES["myImage"]["name"]);
	$target_file = $target_dir . $name_image;
	$target_file400 = time().'_400';
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["myImage"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    //echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["myImage"]["size"] > 2000000) {
	    //echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")||$type=="") {
	    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo 0;
	    //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		
	    if (move_uploaded_file($_FILES["myImage"]["tmp_name"], $target_file)) {

	    	include('class.Images.php');
			$image = new Image($target_file);
			$image->resize(400, 400, 'fit');
			$image->save($target_file400, $target_dir);
			unlink($target_file);
	        //echo "The file ". basename( $_FILES["myImage"]["name"]). " has been uploaded.";
	        echo '{"myImage":"'.$target_file400.'.'.$imageFileType.'"}';
	    } else {
	    	echo 0;
	        //echo "Sorry, there was an error uploading your file.";
	    }
	}

}
?>