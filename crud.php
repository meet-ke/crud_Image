<?php

    require("connection.php");

    function image_uplode($img){
        $tmp_loc = $img['tmp_name'];
        $new_name = random_int(111111,999999).$img['name'];
        
        $new_loc = UPLODE_SRC.$new_name;

        if (!move_uploaded_file($tmp_loc, $new_loc)){
            header("Location:index.php?alert=img_uplode");
            exit;
        }
        else
        {
            return $new_name;
        }
    }

    if(isset($_POST['addproduct']))
    {
        foreach($_POST as $key => $value)
        {
            $_POST[$key] = mysqli_real_escape_string($con,$value);
            $imgpath = image_uplode($_FILES['image']);    

            $query = "INSERT INTO `product`(`name`, `price`, `description`, `image`) 
            VALUES ('$_POST[name]','$$_POST[price]','$$$_POST[desc]','$imgpath') ";

            if(mysqli_query($con,$query)){
                header("Location:imdex.php?success=added");
            }
            else
            {
                header("Location:index.php?alert=add_filed");
            }
        }
    }
?>