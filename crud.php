<?php

    require("connection.php");

    function image_uplode($img){
        $img_loc = $img['tmp_name'];
        $new_name = random_int(111111,999999).$img['name'];
        
        $new_lock = UPLODE_SRC.$new_name;
    }

    if(isset($_POST['addproduct']))
    {
        foreach($_POST as $key => $value)
        {
            $_POST[$key] = mysqli_real_escape_string($con,$value);
            image_uplode($_FILES['image']);    
        }
    }
?>