<?php include 'protected/views/layouts/HeaderSecure.php'?>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script><?php include 'js/PreviewTech.js'?></script>
     
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
                     $_SESSION['countries'] = $countries;
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
                    <ul id="charts"></ul>
                 </div>
                 <div class="row">
                     <span class="span6 offset2">
                         <h3>TechChute Score: <?php echo $score; ?>56 out of 100</h3>
                     </span>
                 </div>
                 <div class="row">
                    <h3>Available for Licensing:</h3>
                    <div id="chart_div" style="width: 900px; height: 500px;"></div>

                 </div>
                <script>
                    google.load('visualization', '1', {'packages': ['geochart','corechart']});
                    google.setOnLoadCallback(drawRegionsMap);   
                    google.setOnLoadCallback(drawChart); 
                </script>

                     <br>
                     <input type="submit" class="btn btn-large span3 offset2" value="List my Tech!" />

             </div>
             <div class="span2">
                 Related Stocks<br><br>
                 <?php 
                    //load stocks here
                     $scatid = $listing->SUBCATEGORYID;
                     $stocks = Stocks::model()->findAllByAttributes(array("SUBCATEGORYID"=>$scatid));
                     foreach($stocks as $stock){
                        echo $stock->SYMBOL . " $" . $stock->PRICE . " " . $stock->CHANGE . "<br>";
                     }
                 ?>
<!--<iframe src="http://edulifeline.com/includes/stocks_widget/?presets=pep,su,ntl" height="322px" width="250px" frameborder="0" scrolling="0"></iframe>                  -->
             
             </div>
         </div>
        </form>
     </div>
<br><br>
<?php include 'protected/views/layouts/Footer.php'?>