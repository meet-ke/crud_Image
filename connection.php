<?php
    $con = mysqli_connect("localhost","root","","card");

    if (mysqli_connect_errno()) {
        die("Can not Connect  Database". mysqli_connect_errno());
    }

    define("UPLODE_SRC",$_SERVER['DOCUMENT_ROOT']."C:\wamp64\www\Crud\crud_Image\uplode")
?>