<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location:../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status'] == 0){
    $status = '<b style = "color:red">Not Voted</b>';
}
else{
    $status = '<b style = "color:green"> Voted</b>';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    
</head>
<style>
  .logo{
      margin-left: 50px;
  }
.navbar{
   width: 100%;
   margin-top: 5px;
   padding: 15px 0;
   display: flex;
   align-items: center;
   justify-content: space-between;
   
}

.navbar ul li{
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;
}
.navbar ul li a{
   text-decoration: none;
   color: black;
   text-transform: uppercase;

}
.navbar ul li::after{
    content: '';
    height: 3px;
    width: 0px;
    background: #009688;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;
}
.navbar ul li:hover::after{
    width: 100%;
}
 
#Group {
    background-color: #212529;
    width: 60%;
    padding: 20px;
    float: right;
}

#votebtn {
    cursor: pointer;
    font-size: 15px;
    background-color: #346eec;
    color: white;
    border-radius: 5px;
}

#voted{
    cursor: pointer;
    font-size: 15px;
    background-color: green;
    color: white;
    border-radius: 5px;
}

#votebtn:hover{
    cursor: pointer;
    background-color: green;
    font-size: 16px;
    width: 100px;
}

button{
    cursor: pointer;
    font-size: 15px;
    background-color: #346eec;
    color: white;
    border-radius: 5px;
}
*{
   
    box-sizing: border-box;
    font-family: sans-serif;
}
body{
   background-image: url(../bgimages/wave.png);
   background-size: cover;
   background-position: center center;
   background-repeat: no-repeat;
   background-attachment: fixed;
   height: 100vh;

}
.profile-card{
    width: 500px;
    margin: auto;
    margin-top: 12px;
    margin-bottom: 12px;
    background: #ffffffd9;
    border-radius: 10px;
    box-shadow: 2px 4px 10px 2px rgba(0,0,0,0.5);
    position: absolute;
    font-weight: 800;
    opacity: 0.98;
    
}
.image-container{
    position: relative;

}
.image-container img{
    width: 29%;
    border-radius: 50%;
    margin-top: 15px;
    margin-left: 190px;
    height: 152px;

}

.main-container{
    padding: 32px 20px 20px 20px;


}
</style>

<body>
    <div class="banner">
        <div class="navbar">
            <h2 class="logo">E-Vote</h2>
            <ul>
                <li class="item"><a href="../homepage/home.html">Home</a></li>
                <li class="item"><a href="logout.php">Log-Out</a></li>
               
            </ul>
        </div>
   
        <div class="profile-card">
            <div class="image-container">
                <img src="../uploads/<?php  echo $userdata['photo'] ?>" height="100" width="100">

            </div>
            <div class="main-container">
                <p>Name:
            <?php  echo $userdata['name']?></p>
                <p> Mobile No:
                <?php  echo $userdata['mobile']?></p>
                <p>Address:
                <?php  echo $userdata['address']?></p>
                <b style="font-size: 16.5px;font-weight: bolder;">Status:</b>
                <?php  echo $status ?>
            </div>
            </div>
            <div id="Group">
            <?php 
           if($_SESSION['groupsdata']) {
            
                 for($i=0;$i<count($groupsdata); $i++){
                    ?>
                <div>
                    <img style = "float:right;border-radius: 50%;" src="../uploads/<?php  echo $groupsdata[$i]['photo']  ?>" height="100" width="100">
                    <b style = "color:red; font-size: 20px;" >Group Name: </b>
                       <b style = "color:white;font-size: 22px;"> <?php echo $groupsdata[$i]['name']        ?></b> <br><br>
                   
                    <b style="color: #198754;font-size: 22px;">Votes: </b> 
                    <b style = "color:white;font-size: 20px;"><?php echo $groupsdata[$i]['votes'] ?> </b><br><br>
                    <form action="../api/vote.php" method = "POST">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">

                    <?php
                         if($_SESSION['userdata']['status'] == 0){
                             ?>
                             <input type="submit" name = "votebtn" value="Vote" id = "votebtn">
                             <?php
                         }
                         else{
                            ?>
                           <button disabled type="submit" name="votebtn" value="Vote" id = "voted"> Voted</button>
                            <?php
                         }

                         ?>
            
                    </form>
                </div>
              <hr style="border: 1px solid #6610f2;">
<?php 
              
 
                 } 
                }
           
           else{
               

           }
           ?>

         
            </div>
        </div>
    


</body>

</html>