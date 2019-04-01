<?php 
    define('LARGE_IMAGE_WIDTH', 430);
    define('LARGE_IMAGE_HEIGHT', 570);
    define('MEDIUM_IMAGE_WIDTH', 370);
    define('MEDIUM_IMAGE_HEIGHT', 475);
    define('SMALL_IMAGE_WIDTH', 290);
    define('SMALL_IMAGE_HEIGHT', 380);
    define('X_SMALL_IMAGE_WIDTH', 150);
    define('X_SMALL_IMAGE_HEIGHT', 190);
    define('DEGREE', '90');
	class Image{
		//Hàm thu nhỏ hình
		public static function thumb($link_img, $typeimg, $folder, $desired_width, $desired_height)
		{
		      $source_img = imagecreatefromjpeg($link_img);
				$width = imagesx($source_img);
				$height = imagesy($source_img);
                if($height <= $width){
                    imagerotate($source_img, DEGREE, 0);
                }
			if($typeimg=="image/jpeg" || $typeimg=="image/jpg")
			{//lấy nguồn img
				
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width, $desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				
				imagejpeg($virtual_img, $folder);
			}
			else if($typeimg=="image/png")
			{	
				
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				imagepng($virtual_img,$folder);
			}
			else{
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				imagegif($virtual_img,$folder);
			}
			
		}
		public static function GetFile($ten, $index=-1){	
			//print_r($_FILES["'".$ten."'"]); //In mảng
            $date = date_create();
            $d = $date->format('d_m_y_h_m_s'); 
			$dest="";
            $img_path = "";
            if($index == -1){
    			if($ten["type"]=="image/jpeg" || $ten["type"]=="image/gif" || $ten["type"]=="image/png" )
    			{	$type = $ten["type"];
    				move_uploaded_file($ten["tmp_name"],"../Views/img/". $d . '_' . $ten["name"]);
    				$source="../Views/img/". $d . '_'. $ten['name'];
    				//$img=$ten["name"];
    				$dest_large = "../Views/img/thumb/large_". $d . '_' .$ten['name']; //Nguồn lưu ảnh nhỏ
                    $dest_medium = "../Views/img/thumb/medium_". $d . '_' .$ten['name']; //Nguồn lưu ảnh nhỏ
                    $dest_small = "../Views/img/thumb/small_". $d . '_' .$ten['name']; //Nguồn lưu ảnh nhỏ
                    $dest_x_small = "../Views/img/thumb/x_small_". $d . '_' .$ten['name']; //Nguồn lưu ảnh nhỏ
    				//$clss= new Image();
    				//$clss->thumb($source,$dest,100);
                    //cùng chung 1 lớp, dùng self thay cho this để gọi hàm static
                    self::thumb($source,$type, $dest_large, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_medium, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_small, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_x_small, X_SMALL_IMAGE_WIDTH, X_SMALL_IMAGE_HEIGHT);
                    $img_path = $d . '_' . $ten['name'];
    			}
            }
            else{
                if($ten['type'][$index]=="image/jpeg" || $ten["type"][$index]=="image/gif" || $ten["type"][$index]=="image/png" ){
                    $type = $ten["type"][$index];
    				move_uploaded_file($ten["tmp_name"][$index],"../Views/img/". $d . '_' . $ten["name"][$index]);
    				$source="../Views/img/". $d . '_'. $ten['name'][$index];
    				//$img=$ten["name"];
    				
                    $dest_large = "../Views/img/thumb/large_". $d . '_' .$ten['name'][$index]; //Nguồn lưu ảnh nhỏ
                    $dest_medium = "../Views/img/thumb/medium_". $d . '_' .$ten['name'][$index]; //Nguồn lưu ảnh nhỏ
                    $dest_small = "../Views/img/thumb/small_". $d . '_' .$ten['name'][$index]; //Nguồn lưu ảnh nhỏ
                    $dest_x_small = "../Views/img/thumb/x_small_". $d . '_' .$ten['name'][$index]; //Nguồn lưu ảnh nhỏ
    				//$clss= new Image();
    				//$clss->thumb($source,$dest,100);
                    //cùng chung 1 lớp, dùng self thay cho this để gọi hàm static
                    self::thumb($source,$type, $dest_large, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_medium, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_small, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
                    self::thumb($source,$type, $dest_x_small, X_SMALL_IMAGE_WIDTH, X_SMALL_IMAGE_HEIGHT);
    				//$clss= new Image();
    				//$clss->thumb($source,$dest,100);
                    //cùng chung 1 lớp, dùng self thay cho this để gọi hàm static
                    $img_path = $d . '_' . $ten['name'][$index];
                }
            }
            //Nên trả về tên file hơn là đường dẫn
			//return $dest;
            
            return $img_path;
		}
	}
?>