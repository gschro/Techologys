<?php include 'protected/views/layouts/HeaderSecure.php'?>
     
     <div class ="container">
        <form method="post" action="<?php echo Yii::app()->createUrl('Site/ListTech')?>">
         <div class="row">             
             <div class="span10">
                 <div class="row">
                     <?php 
                     $listing = json_decode($jsonListing);
                   //  session_start();
                     $_SESSION['jsonListing'] = $jsonListing;
                     $_SESSION['jsonDetails'] = $jsonDetails;
                  //   echo "<input type='text' type='hidden' name='jsonListing' value='".$jsonListing."' />";
                 //    echo "<input type='text' type='hidden' name='jsonDetails' value='".$jsonDetails."' />";
                     
                     $details = json_decode($jsonDetails);
                     echo "<h2>".$listing->NAME;
                     //echo $tech->NAME ?></h2>                     
                 </div>
                 <div class="row">                     
                     <p class="span8">
                         <?php echo $listing->DESC ?>
                     </p>
                     <p class="span2 offset7">
                         <?php 
                         $status = $listing->PATENTSTATUS;
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
                     <input type="submit" class="btn btn-large span3 offset2" value="List my Tech!"/>
                 </div>
             </div>
             <div class="span2">
                 Stocks
<iframe src="http://edulifeline.com/includes/stocks_widget/?presets=pep,su,ntl" height="322px" width="250px" frameborder="0" scrolling="0"></iframe>                  
             
             </div>
         </div>
        </form>
     </div>
<br><br>
<?php include 'protected/views/layouts/Footer.php'?>