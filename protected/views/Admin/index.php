<?php include 'protected/views/layouts/HeaderSecure.php' ?>


<div class ="container">
    <div class="row">
    	<p>
        	<a class="btn" href="<?php echo Yii::app()->createUrl('Admin/Questions')?>">Questions and Categories</a>        
    	</p>
   <!-- <p>
        	<a class="btn" href="<?php echo Yii::app()->createUrl('Admin/GetStocksByIndustry')?>">Get Stocks By Industry</a>       
    	</p>
        <p>  -->
        	<a class="btn" href="<?php echo Yii::app()->createUrl('Admin/GetStockInfo')?>">Get Current Stock Information</a>        
    	</p>    	
    </div>
</div>
             </div>

<?php include 'protected/views/layouts/Footer.php' ?>