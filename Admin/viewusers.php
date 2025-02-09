<?php 
include('../connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>


<?php include('header.php')  ?>


<div class="container">
   
<div class="row">
 
  <div class="col-lg-12" style="padding-top:100px">
  
     <table class="table">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role Type</th>      
        <th>Action</th>
      </tr>
      
      <?php
      $sql = "SELECT * FROM `userdata`";
      $res  = mysqli_query($conn, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){

          ?>

          <tr>
            <td><?= $data['userid'] ?></td>
            <td><?= $data['Name'] ?></td>
            <td><?= $data['Email'] ?> </td>
            <td><?= $data['Password'] ?> </td>       
            <td>

             <?php
               if($data['rotetype'] == 1){
                echo "ADMIN";
               }else{
                echo "USER";
               }

             ?>

            </td>
     
          
           
            <td>
              <a href="viewusers.php?userid=<?= $data['userid'] ?>" class="btn btn-danger"> Delete </a>
            
          </td>
          </tr>


       <?php
        }
      }else{
        echo 'no user found';
      }
    

      ?>


     </table>

  </div>
</div>
  

</div>


<?php include('footer.php')  ?>

</body>
</html>

<?php

if(isset($_GET['userid'])){

  $userid = $_GET['userid'];

  $sql = "delete from userdata WHERE userid ='$bookingid'";

  if(mysqli_query($conn, $sql)){
    echo "<script> alert('user deleted successfully')</script>";
    echo "<script> window.location.href='viewusers.php' </script>";
  }else{
    echo "<script> alert('user not deleted')</script>";
  }

}



?>
