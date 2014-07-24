<?php include 'protected/views/layouts/HeaderSecure.php';?>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script><?php include 'js/TechView.js';?></script>

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
                        // session_start();
                         $_SESSION['techViewId'] = $tech->ID;
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
                        echo 'Pre-existing rights <span class="label '.$label.'">'.$status.'</span>';
                         
                         ?>
                     </p>
                 </div>
                 <div class="row" id="charts">
                 </div>
                 <div class="row">
                     <span class="span6 offset2">
                         <h3>TechChute Score: <?php echo $tech->TOTALSCORE ?> out of 100</h3>
                     </span>
                 </div>
                 <div class="row">
                    <?php if($tech->USERID === $_SESSION['user']){?>
                     <p>
                         <a href="<?php echo Yii::app()->createUrl('Site/University')?>" class="btn btn-large" >Back</a>                        
                         <a href="<?php echo Yii::app()->createUrl('Site/EditTech')?>" class="btn btn-large">Edit</a>
                         <a href="<?php echo Yii::app()->createUrl('Site/DeleteTech')?>" class="btn btn-large" >Delete</a>                         
                     </p>
                     <p>
                         <?php 
                            $visible = "";
                            if($tech->VISIBLE == 1){
                                $visible = "Unlist";                            
                            }
                            else{
                                $visible = "List";
                            }
                         ?>                        
                         <input id="list" class="btn btn-large" value="<?php echo $visible; ?>" />                         
                    </p>
                    <?php } 
                    else{
                         ?> <input id="license" class="btn btn-large" value="License this Tech!" /> <?php                                                 
                    }
                    ?>
                 </div>

     <h3>Available for Licensing:</h3>
         <div id="chart_div" style="width: 900px; height: 500px;"></div>

             </div>
             <div class="span2">
                 Related Stocks<br><br>
                 <?php 
                    //load stocks here
                     $scatid = $tech->SUBCATEGORYID;
                     $stocks = Stocks::model()->findAllByAttributes(array("SUBCATEGORYID"=>$scatid));
                     foreach($stocks as $stock){
                        echo $stock->SYMBOL . " $" . $stock->PRICE . " " . $stock->CHANGE . "<br>";
                     }

                 ?>
<!--<iframe src="http://edulifeline.com/includes/stocks_widget/?presets=pep,su,ntl" height="322px" width="250px" frameborder="0" scrolling="0"></iframe>                  -->
             
             </div>
         </div>
     </div>
<script>
        google.load('visualization', '1', {'packages': ['geochart','corechart']});
        google.setOnLoadCallback(drawRegionsMap);   
        google.setOnLoadCallback(drawChart);
</script>


<br><br>
<?php include 'protected/views/layouts/Footer.php'; ?>