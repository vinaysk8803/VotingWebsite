<?php

$connect = mysqli_connect("localhost:3308","root","","voting") or die("connection faied!");
if($connect){
    echo "Connected";
}
else{
    echo " Not Connected";
}

?>