<?php 
    if(isset($_SESSION['user'])){
        include 'protected/views/layouts/HeaderSecure.php';
     }
     else{
        include 'protected/views/layouts/Header.php';
     }
?>
     
     <div class ="container">
         Account
     </div>

<?php include 'protected/views/layouts/Footer.php'?>