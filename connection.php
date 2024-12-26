<?php
    $con = mysqli_connect("localhost","root","","card");

    if (mysqli_connect_errno()) {
        die("Can not Connect  Database". mysqli_connect_errno());
    }

    define("UPLODE_SRC",$_SERVER['DOCUMENT_ROOT']."/Crud/crud_Image/uplode/");

    define("FETCH_SRC","/Crud/crud_Image/uplode/");
?>