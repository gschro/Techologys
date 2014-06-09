<?php include 'protected/views/layouts/HeaderSecure.php'?>

     
     <div class ="container">
     	<div>
     		<p>
         		Congrats! Your tech has been listed!
        	</p>
        	<p>
        	    <a class="btn" href="<?php echo Yii::app()->createUrl('Site/AddTech')?>">Post Another Technology</a>        			            	
        		<a class="btn" href="<?php echo Yii::app()->createUrl('Site/University')?>">See My Listed Technologies</a>                		
			    <a class="btn" href="<?php echo Yii::app()->createUrl('Site/TechList')?>">See All Listed Technologies</a>                		
        	</p>
        </div>
		<div>

		</div>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>