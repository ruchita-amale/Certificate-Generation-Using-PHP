<?php
	function UploadImage($file, $order_id, $location){
		$message = '';
		$uploadOk = 1;
		$file_name = $file['name'];
		$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
		$check = getimagesize($file["tmp_name"]);
		if($check !== false) {
			// Check if image file is a actual image or fake image
		} 
		else {
			$message .= " ERROR:File is not an image.";
			$uploadOk = 0;
		}
		$valid_extensions = array("jpg","jpeg","png");
		if(!in_array(strtolower($imageFileType),$valid_extensions)) {
			$message .= " ERROR:File type not allowed. Upload only .jpg, .jpeg, .png.";
		   	$uploadOk = 0;
		}
		// echo $message;
		if($uploadOk == 0){
			// $message = "ERROR: " + $message;
			return 'ERROR';
		}
		else{
			//UPLOADING

			$temp = explode(".", $file["name"]);
			$a_file = $order_id . '.' . end($temp);
			// if(move_uploaded_file($file["tmp_name"],$location."/".$a_file)){
			// 	return $a_file;
			// }
			// else{
			// 	return 'ERROR';
			// }

			$info = getimagesize($file["tmp_name"]);
            if ($info['mime'] == 'image/jpeg') 
                $image = imagecreatefromjpeg($file["tmp_name"]);
            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($file["tmp_name"]);
            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($file["tmp_name"]);
            
            if(imagejpeg($image, $location."/".$a_file, 50))
				return $a_file;
		}
	}
?>