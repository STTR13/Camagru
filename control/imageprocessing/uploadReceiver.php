<?php

   $img = $_POST['img'];
	// echo "I'm here\n";
	// var_dump($_POST['img']);
   if (strpos($img, 'data:image/png;base64,') === 0) {
	   // echo "And here too\n";
      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $file = '../../data/tmp/up'.date("YmdHis").'.png';
	  // echo "And finaly here\n";

      if (file_put_contents($file, $data)) {
         echo "$file";
      } else {
         // echo 'The canvas could not be saved.';
      }

   }

?>
