
<?php include 'protected/views/layouts/HeaderSecure.php';?>
<script type="text/javascript">
    <?php include 'js/jquery.cookie.js';?>

    <?php include 'js/AddTech.js';?>
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style>
 .multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;    
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}


</style>
     
     <div class ="container">
         <form method="post" action="<?php echo Yii::app()->createUrl('Site/PreviewTech')?>">
            <fieldset>
                <div class="row">
                    <div class="col-md-9">
                        <legend>Create Listing</legend>
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="col-md-4" placeholder="Name">                            
                   <?php  
                   $listing = null;
                       if(isset(Yii::app()->request->cookies['jsonListing'])){
                           $listing = json_decode(Yii::app()->request->cookies['jsonListing']->value);
                           echo $listing->NAME;
                       }
                   ////$name = Yii::app()->request->cookies['listingname']->value;
                    // echo $name;?>
                        <label>Project Summary</label>
                            <textarea rows="4" name="desc" class="col-md-8" placeholder="Project Summary"></textarea>
                                                                            
                        <label class="checkbox">
                        <h4>Questions</h4>
                        <col-md- class="help-block">Please answer the following questions about your listing</col-md->                          
                       <!-- <col-md- class="help-block">Rate from 1 to 5, 5 being most positive</col-md-> -->
                        <div class="row">
                            <div class="col-md-4">
                                <?php questions($questionsLeft);?>
                            </div>
                            <div class="col-md-4">
                                <?php questions($questionsRight);?>
                            </div>
                        </div>
                        </label>
                        <div class="row">
                        
                          
                        <?php 
                            $countries = Country::model()->findAll(array("order"=>"NAME"));
                        ?>
                          

                        <legend>Countries where licensing is available</legend>
                        <table style='width:370px;'>
                            <tr>
                                <td style='width:160px;'>
                                    <b>Not Available</b><br/>
                                   <select multiple="multiple" size="15" id='lstBox1'>
                                    <?php 
                                      foreach($countries as $country){
                                        ?>
                                          <option value="<?php echo $country->NAME; ?>"><?php echo $country->NAME; ?></option>  
                                        <?php
                                      }
                                    ?>
                                </select>
                            </td>
                            <td style='width:50px;text-align:center;vertical-align:middle;'>
                                <input type='button' id='btnRight' value ='  >  '/>
                                <br/><input type='button' id='btnLeft' value ='  <  '/>
                            </td>
                            <td style='width:160px;'>
                                <b>Available </b><br/>
                                <select multiple="multiple" size="15" id='lstBox2' name="countries[]"></select>
                            </td>
                        </tr>
                        </table>


                        </div><br>

                    </div>
                    <div class="col-md-3">
                        <br><br><br>
                        <div class="well">
                            <label>Main Category</label>
                            <select class="input-medium" id="mainCat" name="mainCat">
                        <?php 
                            $cats = MainCategory::model()->findAll();
                            foreach($cats as $cat){
                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                            }
                           // onclick="selectAll();"
                        ?>
                            </select><br>     
                            <label>Sub Category</label>
                            <select class="input-medium" name="subCat" id="subCat">
                            </select>  
                                                      
                        </div>     
                                                
                        <div class="well">
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios1" value="Patent" checked>
                              Patented
                            </label>
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios2" value="Pending">
                              Patent Pending
                            </label>                        
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios2" value="No">
                              No Patent
                            </label>   
                        </div>
                        <div class="well text-center">
                            <p>
                                Are there pre-existing rights associated with this listing?
                            </p>
                            <label class="radio inline">
                              <input type="radio" name="rights" id="rights" value="1" checked/>
                              Yes
                            </label>
                            <label class="radio inline">
                              <input type="radio" name="rights" id="rights" value="0"/>
                              No
                            </label>  
                            <br><br>
                            <textarea rows="4" class="input-medium" name="details" value=" " id="details" placeholder="Details"></textarea>
                        </div>
                        <div class="well text-center">
                            <p>
                            <h4>Listing Agreement</h4>
                                <a href="">view</a><br>
                                I have read the agreement and accept the terms
                            </p>
                            <label class="radio inline">
                              <input type="radio" name="agreement" id="agreement" value="1">
                              Yes
                            </label>
                            <label class="radio inline">
                              <input type="radio" name="agreement" id="agreement" value="0" checked>
                              No
                            </label>                              
                        </div>
                    </div>
                </div>                               
              </fieldset>          
              <div class="row text-center">
                <input type="submit" id="preview" class="btn btn-large btn-primary" onclick="selectAll();" value="Preview Listing"/>  
              </div>
         </form>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>

<?php 
function question($values, $quest){
    $question = '<label>'.$quest->QUESTION.'</label>
        <div class="well">';
    for($i=0; $i<count($values); $i++){
        $question .= '   
        <label class="radio">
            <input type="radio" name="'.$quest->NAME.'" id="'.$quest->NAME.'" value="'.$values[$i]->ID.'">
            '.$values[$i]->DISPLAYVALUE.'
        </label>   ';
    } 
    $question .= '</div>';
    return $question;
}
?>

<?php 
function questions($questions){
    foreach($questions as $question){
        echo question($question["Values"],$question["Question"]);       
    }
}?>
