<?php
function GenerateCertificate($name, $school, $oder_id, $state){  
  // (A) OPEN IMAGE
  $img = imagecreatefromjpeg('certificates/template.jpg');

  // (B) WRITE TEXT
  $color = imagecolorallocate($img, 200, 0, 0);

  $font = __DIR__."/ARIAL.TTF";
  // Set the environment variable for GD
  // putenv('GDFONTPATH=' . realpath('.'));
  // Name the font to be used (note the lack of the .ttf extension)
  // $font = 'blueberry';


  // THE IMAGE SIZE
  $width = imagesx($img);
  $height = imagesy($img);

  // THE TEXT SIZE
  $txt = strtoupper($name);
  // $txt = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
  $font_size = 36;
  $text_size = imagettfbbox($font_size, 0, $font, $txt);
  $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
  // CENTERING THE TEXT BLOCK
  $centerX = CEIL(($width - $text_width) / 2);
  $centerX = $centerX<0 ? 0 : $centerX;
  $centerY = 622;
  imagettftext($img, $font_size, 0, $centerX, $centerY, $color, $font, $txt);

  // THE TEXT SIZE

//   $color = imagecolorallocate($img, 30, 0, 160);
//   $txt = $school;
  // $txt = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
//   $font_size = 30;
//   $text_size = imagettfbbox($font_size, 0, $font, $txt);
//   $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
  // CENTERING THE TEXT BLOCK
//   $centerX = CEIL(($width - $text_width) / 2);
//   $centerX = $centerX<0 ? 0 : $centerX;
//   $centerY = 732;
//   imagettftext($img, $font_size, 0, $centerX, $centerY, $color, $font, $txt);

  $filename = 'certificates/'.$state.'/'.$oder_id.'.jpg';
  // echo $filename;
  imagejpeg($img, $filename);

  // (C) OUTPUT IMAGE
  // header('Content-type: image/jpeg');
  // imagejpeg($img);
  // imagedestroy($jpg_image);

  // $file_url = 'certificates/'.$oder_id.'.jpg';
  // header('Content-Type: application/octet-stream');
  // header("Content-Transfer-Encoding: Binary"); 
  // header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
  // readfile($file_url);
}
?>