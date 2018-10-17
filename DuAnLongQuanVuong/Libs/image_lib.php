<?php 
	class Image{
		
		//Hàm thu nhỏ hình
		public static function thumb($link_img,$typeimg,$folder,$desired_width)
		{
			if($typeimg=="image/jpeg" || $typeimg=="image/jpg")
			{//lấy nguồn img
				$source_img = imagecreatefromjpeg($link_img);
				$width = imagesx($source_img);
				$height = imagesy($source_img);
				//$png = imagecreatefrompng($link_img);
				
				//Chiều cao muốn thu nhỏ of hình
				$desired_height = floor($height*($desired_width/$width));
				
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				
				imagejpeg($virtual_img,$folder);
			}
			else if($typeimg=="image/png")
			{	
				//lấy nguồn img
				$source_img = imagecreatefrompng($link_img);
				$width = imagesx($source_img);
				$height = imagesy($source_img);
				//$png = imagecreatefrompng($link_img);
				
				//Chiều cao muốn thu nhỏ of hình
				$desired_height = floor($height*($desired_width/$width));
				
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				imagepng($virtual_img,$folder);
			}
			else{
				//lấy nguồn img
				$source_img = imagecreatefromgif($link_img);
				$width = imagesx($source_img);
				$height = imagesy($source_img);
				//$png = imagecreatefrompng($link_img);
				
				//Chiều cao muốn thu nhỏ of hình
				$desired_height = floor($height*($desired_width/$width));
				
				//Tạo hình mới
				$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
				
				imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
				imagegif($virtual_img,$folder);
			}
			
		}
		public static function GetFile($ten){	
			//print_r($_FILES["'".$ten."'"]); //In mảng 
			$dest="";
			if($ten["type"]=="image/jpeg" || $ten["type"]=="image/gif" || $ten["type"]=="image/png" )
			{	$type = $ten["type"];
				move_uploaded_file($ten["tmp_name"],"../Views/img/".$ten["name"]);
				$source="../Views/img/".$ten['name'];
				//$img=$ten["name"];
				$dest = "../Views/img/thumb/thumb_".$ten['name']; //Nguồn lưu ảnh nhỏ
				//$clss= new Image();
				//$clss->thumb($source,$dest,100);
                //cùng chung 1 lớp, dùng self thay cho this để gọi hàm static
                self::thumb($source,$type, $dest, 100);
			}
            //Nên trả về tên file hơn là đường dẫn
			//return $dest;
            return $ten['name'];
		}
	}
?>