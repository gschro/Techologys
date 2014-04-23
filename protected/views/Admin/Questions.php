<?php include 'protected/views/layouts/HeaderSecure.php'?>
<script><?php include 'js/Questions.js'?></script>
     
     <div class ="container">
         <div class="row">
             <div class="span6">
                <legend>Listing Questions</legend>
                <form class="well" name="cform" id="cform">
                    <h4>Add a Listing Question Category</h4>
                    <label>Category</label>
                    <input type="text" class="span4" id="qcategory" name="qcategory" placeholder="Category">                    
                    <br>
                    <input type="button" id="addQCat" class="btn btn-success" value="Add"/>                    
                    <input type="button" id="qcat" class="btn btn-default pull-right" value="View All"/>                                 
                       <div id="removeQuestionCategory"><br>
                            <label>Current Categories</label>
                                <select  multiple="multiple" id="listofqcategories" class="span5">                        
                                </select>                    
                                <div id="removeQCategory" class="btn btn-danger">Remove</div>
                        </div>                                        
                </form>
                <form class="well" id="qform" name="qform">
                    <h4>Add a Listing Question</h4>
                    <label>Question</label>
                        <input type="text" class="span5" id="question" name="question" placeholder="Question">
                        <label>Category</label>
                                <select id="category" name="category">
                                    <?php 
                                        $cats = QuestionCategory::model()->findAll();
                                        foreach($cats as $cat){
                                            echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                                        }
                                    ?>
                                </select><br>
                                <div id="addLQ" class="btn btn-success" value="Add">Add</div>
                                <input type="button" id="qlist" class="btn btn-default pull-right" value="View All"/> 
                       <div id="removeListingQuestion"><br>
                            <label>Current Questions</label>
                                <select  multiple="multiple" id="listofquestions" class="span5" hidden>                        
                                </select>                    
                                <div id="remove" class="btn btn-danger">Remove</div>
                        </div>                    
                </form>
                <legend>Security Questions</legend>
                <form class="well" id="sqform" name="sqform">
                    <h4>Add a Security Question</h4>
                    <label>Question</label>
                    <input type="text" class="span4" id="securityquestion" name="securityquestion" placeholder="Question">                    
                    <br>
                    <input type="button" id="addSQ" class="btn btn-success" value="Add"/>   
                    <input type="button" id="squestion" class="btn btn-default pull-right" value="View All"/>                                                       
                       <div id="removeSecurityQuestion"><br>
                            <label>Security Questions</label>
                                <select  multiple="multiple" id="listofsquestions" class="span5" hidden>                        
                                </select>                    
                                <div id="removeSq" class="btn btn-danger">Remove</div>
                        </div>                                        
                </form>
                
             </div>
             <div class="span6">
                 <legend>Listing Categories</legend>
                 <form class="well" id="mform" name="mform" method="post" action="<?php echo Yii::app()->createUrl('Admin/AddMainCategory')?>">
                    <h4>Add a Listing Main Category</h4>
                    <label>Category</label>
                    <input type="text" class="span4" id="maincategory" name="maincategory" placeholder="Category"><br>                    
                    <input type="button" id="addMCat" class="btn btn-success" value="Add"> 
                    <input type="button" id="maincats" class="btn btn-default pull-right" value="View All"/>                                   
                       <div id="removeMainCat"><br>
                            <label>Main Categories</label>
                                <select  multiple="multiple" id="listofmcats" class="span5" hidden>                        
                                </select>                    
                                <div id="removeMCat" class="btn btn-danger">Remove</div>
                        </div>                                                            
                 </form>
                 <form class="well" id="mform" name="mform" method="post" action="<?php echo Yii::app()->createUrl('Admin/AddSubCategory')?>">
                    <h4>Add a Listing Sub Category</h4>
                    <label>Main Category</label>
                    <select name="maincat" id="maincat" class="span3 offset5">
                        <?php 
                            $cats = MainCategory::model()->findAll();
                            foreach($cats as $cat){
                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                            }
                        ?>
                    </select><br>
                    <label>Sub Category</label>                    
                    <input type="text" id="subcategory" class="span4" name="subcategory" placeholder="Sub Category"><br>
                    <input type="button" id="addSCat" class="btn btn-success" value="Add"> 
                    <input type="button" id="subcats" class="btn btn-default pull-right" value="View All"/>                                                       
                       <div id="removeSubCat"><br>
                            <label>Sub Categories</label>
                                <select  multiple="multiple" id="listofscats" class="span5" hidden>                        
                                </select>                    
                                <div id="removeSCat" class="btn btn-danger">Remove</div>
                        </div>                                                            
                 </form>
             </div>
         </div>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>