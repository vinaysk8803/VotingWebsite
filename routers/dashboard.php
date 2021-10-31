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
    #Backbtn {
        float: left;
    }

    #logoutbtn {
        float: right;
        margin: 10px;
    }

    #Profile {
        background-color: white;
        width: 30%;
        padding: 20px;
        float: left;
    }

    #Group {
        background-color: white;
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

    .mainpanel {
        padding: 10px;
    }
    #voted{
        cursor: pointer;
        font-size: 15px;
        background-color: green;
        color: white;
        border-radius: 5px;
    }
</style>

<body>
    <div class="mainsection">
        <center>
            <a class="headersection">
                <a href="../"><button id="Backbtn"> back</button></a>
                <a href="../routers/logout.php"><button id="logoutbtn">Log-Out</button></a>
                <h1>Online voting system</h1>
                <hr>
            </div>
        </center>
        <div class="mainpanel">
            <div id="Profile">
                <center><img src="../uploads/<?php  echo $userdata['photo'] ?>" height="100" width="100"></center>
                <br><br>
                <b>Name:</b>
                <?php  echo $userdata['name']?><br><br>
                <b>Mobile no:</b>
                <?php  echo $userdata['mobile']?><br><br>
                <b>Adress:</b>
                <?php  echo $userdata['address']?><br><br>
                <b>Status:</b>
                <?php  echo $status ?><br><br>
            </div>
            <div id="Group">
            <?php 
           if($_SESSION['groupsdata']) {
            
                 for($i=0;$i<count($groupsdata); $i++){
                    ?>
                <div>
                    <img style = "float:right" src="../uploads/<?php  echo $groupsdata[$i]['photo']  ?>" height="100" width="100">
                    <b>Group Name: </b>
                        <?php echo $groupsdata[$i]['name']        ?>
                   <br><br>
                    <b>Votes: </b> <?php echo $groupsdata[$i]['votes'] ?> <br><br>
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
              <hr>
<?php 
              
 
                 } 
                }
           
           else{
               

           }
           ?>

         
            </div>
        </div>
    </div>


</body>

</html>