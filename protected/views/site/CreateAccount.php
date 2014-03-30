<?php include 'protected/views/layouts/Header.php'?>

     
     <div class ="container">
         <div class="row">
             <div class="pagination-centered">
                 <p>
                 <ul class="media-list">
                 <li><input type="text" placeholder="First Name" id="firstName"></li>
                 <li><input type="text" placeholder="Last Name" id="lastName"></li>                 
                 <li><input type="text" placeholder="University/Company" id="universityCompany"></li>                 
                 <li><input type="text" placeholder="ex. person@univ.edu" id="email"></li>
                 <li><input type="password" placeholder="password" id="password"></li>
                 <li><input type="password" placeholder="confirm password" id="confirmPassword"></li>                 
                 </ul>
                 <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('Site/Investor')?>">Create Account</a>
                 </p>
             </div>
         </div>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>