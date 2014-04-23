<?php include 'protected/views/layouts/HeaderSecure.php'?>
     
     <div class ="container">
         <div class="row">
             <div class="span10">
                 <div class="row">
                     <h2><?php echo $tech->NAME ?></h2>                     
                 </div>
                 <div class="row">                     
                     <p class="span8">
                         <?php echo $tech->DESC ?>
                     </p>
                     <p class="span2 offset7">
                         <?php 
                         $status = $tech->PATENTSTATUS;
                         $label = "";
                         if($status === "Patent"){
                             $label = "label-success";
                         }
                         elseif($status === "Pending"){
                             $label = "label-warning";
                         }
                         else{
                             $label = "label-important";
                         }
                        echo 'Pre-existing rights <span class="label '.$label.'">'.$status.'</span>'
                         
                         ?>
                     </p>
                 </div>
                 <div class="row">
                    <ul class="thumbnails">
                        <li class="span5">
                                <img src="http://ts3.mm.bing.net/th?id=H.4825671903742110&pid=1.7" alt="">
                            <h3>Growth</h3>
                            <p>Here's a graph about stuff</p>
                        </li>    
                        <li class="span5">
                                <img src="http://ts3.mm.bing.net/th?id=H.4825671903742110&pid=1.7" alt="">
                            <h3>Marketability</h3>
                            <p>Here's another graph about more stuff</p>                    
                        </li> 
                    </ul>                     
                 </div>
                 <div class="row">
                     <span class="span6 offset2">
                         <h3>TechChute Score: 56 of 100</h3>
                     </span>
                 </div>
                 <div class="row">
                     <br>
                     <a href="" class="btn btn-large span3 offset2">License This Tech!</a>
                 </div>
             </div>
             <div class="span2">
                 Stocks
<iframe src="http://edulifeline.com/includes/stocks_widget/?presets=pep,su,ntl" height="322px" width="250px" frameborder="0" scrolling="0"></iframe>                  
             
             </div>
         </div>
     </div>
<br><br>
<?php include 'protected/views/layouts/Footer.php'?>