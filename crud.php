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

    function image_remove($img){
        if(unlink(UPLODE_SRC.$img)){
            header("Location:index.php?alert=img_rem_fail");
            exit;
        }   
    }
    
    if(isset($_POST['addproduct']))
    {
        foreach($_POST as $key => $value)
        {
            $_POST[$key] = mysqli_real_escape_string($con,$value);
        }
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
    

    if(isset($_GET['rem']) && $_GET['rem']>0)
    {
        $query = "SELECT * FROM `product` WHERE id=$_GET[rem]";
        $result=mysqli_query($con,$query);
        $fetch=mysqli_fetch_array($result);  

        image_remove($fetch['image']);

        $query="DELETE FROM `product` WHERE id=$_GET[rem]";
        if(mysqli_query( $con,$query)){
            header("Location:index.php?success=removed");
        }
        else
        {
            header("Location:index.php?alert =removed_failed");
        }
    }

    if(isset($_POST['editproduct']))
    {
        foreach($_POST as $key => $value)
        {
            $_POST[$key] = mysqli_real_escape_string($con,$value);
        }
        
        if(file_exists($_FILES['iamge']['tmp_name']) || is_uploaded_file($_FILES['iamge']['tmp_name']))
        {
            $query = "SELECT * FROM `product` WHERE id='$_POST[editpid]'";
            $result=mysqli_query($con,$query);
            $fetch=mysqli_fetch_array($result);  

            image_remove($fetch['image']);

            image_uplode($_FILES['image']);

            $update="UPDATE `product` SET `name`='$_POST[name]',`price`='$_POST[price]',
            `description`='$_POST[desc]',`image`='$imagepath ' WHERE 1";
        }
        else{
            $update="UPDATE `product` SET `name`='$_POST[name]',`price`='$_POST[price]',
            `description`='$_POST[desc]' WHERE 1";
        }
        if(mysqli_query($con,$update)){
            header("loacation:index.php?success=updated");
        }    
        else{
            header("location:index.php?alert=update_failed");
        }
    }  
?>