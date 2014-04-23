<?php 
    if(isset($_SESSION['user'])){
        include 'protected/views/layouts/HeaderSecure.php';
     }
     else{
        include 'protected/views/layouts/Header.php';
     }
?>
     
     <div class ="container">
         Mission
     </div>

<?php include 'protected/views/layouts/Footer.php'?>