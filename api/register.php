<?php

include("connect.php");
$name = $_POST ['name']; 
$mobile = $_POST ['mobile']; 
$password = $_POST ['password']; 
$cpassword = $_POST ['cpassword']; 
$address = $_POST ['address']; 
$image = $_FILES['photo']['name'];
$tmp_name =  $_FILES['photo']['tmp_name'];
$role = $_POST ['role']; 

if($password == $cpassword){
    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect,"INSERT INTO user ( name,mobile,address,password,photo,role,status,votes) 
    VALUES ('$name','$mobile','$address','$password','$image','$role',0,0)");
    if($insert){

        echo '
        <script>
      alert("Registered Successfully");
        window.location = "../";
        </script>
        ';
    }
    else{
        echo'
        <script>
       alert("Some error occued!");
        window.location = "../routers/register.html";
        </script>
        ';
    }

}
else{
    echo'
    <script>
   alert("Password and Confirm Password Does not Match!");
    window.location = "../routers/register.html";
    </script>
    ';
    
}


?>