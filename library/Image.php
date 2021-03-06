<?php
    function resizeAndSave($source,$name,$selectedWidth,$selectedHeight){
        if($name==="no hay nombre!")
            die();
        $imgSize=getimagesize($source);
        if($imgSize[0]>$imgSize[1]){
            $newWidth=$selectedWidth;
            $newHeight=$imgSize[1]/($imgSize[0]/$selectedWidth);
        }else{
            $newHeight=$selectedHeight;
            $newWidth=$imgSize[0]/($imgSize[1]/$selectedHeight);
        }
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true); 
        switch ($imgSize['mime']){
            case 'image/jpeg';
                $image=imagecreatefromjpeg($source);
                imagecopyresampled($thumb, $image, 0, 0, 0,  0, $newWidth, $newHeight, $imgSize[0],$imgSize[1]);
                imagejpeg($thumb,$name.".jpg",60);
                break;
            case 'image/png';
                $image=imagecreatefrompng($source);
                imagecopyresampled($thumb, $image, 0, 0, 0,  0, $newWidth, $newHeight, $imgSize[0],$imgSize[1]);
                imagepng($thumb,$name.".png");;  
                break;
            case 'image/gif';
                $image=imagecreatefromgif($source);
                imagecopyresampled($thumb, $image, 0, 0, 0,  0, $newWidth, $newHeight, $imgSize[0],$imgSize[1]);
                imagegif($thumb,$name.".gif");
                break;
            default:
                echo "otro!<br/>";
        }
        imagedestroy($thumb);
        imagedestroy($image);
        return $imgSize;
    }
    
     function cropAndSave($source,$name,$newWidth,$newHeight){
         if($name==="")
            die("no hay nombre!");
        $imgSize=getimagesize($source);
        $difScale=$imgSize[0]/$imgSize[1]-$newWidth/$newHeight;
        if($difScale>0){
            $difScale=-$imgSize[1]/$imgSize[0]+$newHeight/$newWidth;
            $originX=$difScale*$imgSize[0]/2;
            $originY=0;
        }else{
            $originX=0;
            $originY=-$difScale*$imgSize[1]/2;
        }
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true); 
        switch ($imgSize['mime']){
            case 'image/jpeg';
                $image=imagecreatefromjpeg($source);
                imagecopyresampled($thumb, $image, 0, 0, $originX,  $originY, $newWidth, $newHeight, $imgSize[0]-$originX*2,$imgSize[1]-$originY*2);
                imagejpeg($thumb,$name.".jpg",60);
                break;
            case 'image/png';
                $image=imagecreatefrompng($source);
                imagecopyresampled($thumb, $image, 0, 0, $originX,  $originY, $newWidth, $newHeight, $imgSize[0]-$originX*2,$imgSize[1]-$originY*2);
                imagepng($thumb,$name.".png");
                break;
            case 'image/gif';
                $image=imagecreatefromgif($source);
                imagecopyresampled($thumb, $image, 0, 0, $originX,  $originY, $newWidth, $newHeight, $imgSize[0]-$originX*2,$imgSize[1]-$originY*2);
                imagegif($thumb, $name.".gif");
                break;
            default:
                echo "otro!<br/>";
        }
        imagedestroy($thumb);
        imagedestroy($image);
        return $imgSize;
    }
    function save($file,$fileDestination,$fileName){
        $allowedExts = array('jpg', 'gif', 'png');
        $final=explode('.', $_FILES[$file]['name']);
        $extension = strtolower(end($final));
        if (((($_FILES[$file]["type"] == "image/gif")
            || ($_FILES[$file]["type"] == "image/jpeg")
            || ($_FILES[$file]["type"] == "image/png")
            || ($_FILES[$file]["type"] == "image/pjpeg"))
            && ($_FILES[$file]["size"] < 10000000)
            && in_array($extension, $allowedExts))){
          if ($_FILES[$file]["error"] > 0 ){
                echo "Return Code: " . $_FILES[$file]["error"] . "<br>";
          }
          else{
               move_uploaded_file($_FILES[$file]["tmp_name"],
                $fileDestination. $fileName.".".$extension); 
          }
        }
        else{
            //echo 'tamaño:'.$_FILES[$file]["size"]-'---';
          return false;
        }
        //echo 'tamaño:'.$_FILES[$file]["size"]."----";
        return true;
    }
    function alert($text){
        echo "<script> alert('$text');</script>";
    }
?>
