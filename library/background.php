<?php

  $imagenFondo=[
    '_DSC5436_low.jpg'];
  
$random=rand(0,count($imagenFondo)-1);
?>
<style>
    body{
        background-image: 
            url("/imagenes/fondos/<?php echo $imagenFondo[$random];?>");
    }
</style>