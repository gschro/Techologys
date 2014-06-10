$(document).ready(function () {
    
    hideLists();
    getSubCatsForStocks();
    //getStocks();
    
    $("#qcat").click(function(){
       getQuestionCategories(); 
    });
    
    $("#addQCat").click(function(){
       addQuestionCategory(); 
    });
    
    $("#removeQCategory").click(function(){
       removeQuestionCategory(); 
    });

    $("#qlist").click(function(){
        getListingQuestions();
    });      
    
    $("#remove").click(function(){
        removeListingQuestion();
    });
    
    $("#addLQ").click(function(){
        addListingQuestion();
    });
    
    $("#squestion").click(function(){
       getSecurityQuestions(); 
    });
    
    $("#addSQ").click(function(){
       addSecurityQuestion(); 
    });
    
    $("#removeSq").click(function(){
       removeSecurityQuestion(); 
    });
    
    $("#maincats").click(function(){
       getMainCategories(); 
    });

    $("#addMCat").click(function(){
       addMainCategory(); 
    });

    $("#removeMCat").click(function(){
       removeMainCategory(); 
    });
    
    $("#subcats").click(function(){
       getSubCategories(); 
    });
    
    $("#addSCat").click(function(){
       addSubCategory(); 
    });
    
    $("#removeSCat").click(function(){
        removeSubCategory();
    });
    
    $("#maincat").change(function(){
        if($("#subcats").val()==="Hide"){
            getSubCategoryData();
        }
    });
    
    $("#maincatstock").change(function(){
        getSubCatsForStocks();
    });

    $("#subcatstocks").click(function(){
        getStocks();
      //  getSubCatStocks();
    });

    $("#subcatstock").click(function(){
        //getStocks();
        getSubCatStocks();
    });

    $("#removeSCatStock").click(function(){
        removeSubCatStock();
    });

    $("#addSCatStock").click(function(){
        addSubCatStock();
    });

});                  

function hideLists(){
    $("#removeListingQuestion").hide();
    $("#removeQuestionCategory").hide();
    $("#removeSecurityQuestion").hide();
    $("#removeMainCat").hide();
    $("#removeSubCat").hide(); 
    $("#removeSubCatStock").hide();
}

function addSubCatStock(){
    var stock = $("#stock").val();
    var scId = $("#subcatstock").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddSubCatStock') ?>",
      data: {"stock":stock, "scId":scId},
      success: function(data){
          var dat = JSON.parse(data);
          getSubCatStocks();    
          $("#stock").val('');
          alert(dat.message);
      }
    }); 
}

function removeSubCatStock(){
    var catId = $("#listofstocks").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveSubCatStock') ?>",
      data: {"catId":catId},
      success: function(data){
          var dat = JSON.parse(data);
          getSubCatStocks();             
      }
    });  
}

function getSubCatsForStocks(){
    var mcId = $("#maincatstock").val();    
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetSubCategories')?>",
        data: {"mcId":mcId},
        success: function(data){
            var dat = JSON.parse(data);
            $("#subcatstock").empty();
            for(var i = 0; i < dat.categories.length; i++){
                $("#subcatstock").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));
            }
        }
    }); 
}

function getStocks(){
    toggleBtn("#subcatstocks");
    $("#removeSubCatStock").toggle();
    var show = $("#removeSubCatStock").is(":visible");  
    if(show){            
       getSubCatStocks();         
    }
}

function getSubCatStocks(){
  //  var mcId = $("#maincatstock").val(); 
    var scId = $("#subcatstock").val();  
    //alert(scId+ " scid") ;
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetSubCatStocks')?>",
        data: {"subcatstock":scId},
        success: function(data){
            var dat = JSON.parse(data);            
            $("#listofstocks").empty();
            for(var i = 0; i < dat.stocks.length; i++){
                $("#listofstocks").append($("<option></option>")
                .attr("value",dat.stocks[i].ID).text(dat.stocks[i].SYMBOL));
            }
        }
    });  
}

function getQuestionCategories(){
    toggleBtn("#qcat");
    $("#removeQuestionCategory").toggle();
    var show = $("#removeQuestionCategory").is(":visible");  
    if(show){            
        getListingCategories();         
    }
}

function addQuestionCategory(){
    var cat = $("#qcategory").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddQuestionCategory') ?>",
      data: {"qcategory":cat},
      success: function(data){
          var dat = JSON.parse(data);
          getListingCategories();       
          alert(dat.message);
      }
    });             
}

function removeQuestionCategory(){
    var catId = $("#listofqcategories").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveQuestionCategory') ?>",
      data: {"catId":catId},
      success: function(data){
          var dat = JSON.parse(data);
          getListingCategories();              
      }
    });     
}

function getListingCategories(){
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetListingCategories')?>",
        success: function(data){
            dat = JSON.parse(data);
            $("#listofqcategories").empty();
            $("#category").empty();            
            for(var i = 0; i < dat.categories.length; i++){
                $("#listofqcategories").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));
                $("#category").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));                
            }         
        }
    });
}

function addListingQuestion(){
    var cat = $("#category").val();
    var quest = $("#question").val();        
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddListingQuestion') ?>",
      data: {"category":cat, "question":quest},
      success: function(data){
          var dat = JSON.parse(data);
          getListingQuestionData();       
          alert(dat.message);
      }
    });             
}

function removeListingQuestion(){
    var qid = $("#listofquestions").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveListingQuestion') ?>",
      data: {"qId":qid},
      success: function(data){
          getListingQuestionData();              
      }
    });   
}

function getListingQuestions(){
    toggleBtn("#qlist");
    $("#removeListingQuestion").toggle();
    var show = $("#removeListingQuestion").is(":visible");        
    if(show){            
        getListingQuestionData();
    }
}                   

function getListingQuestionData(){
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetListingQuestions')?>",
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofquestions").empty();
            for(var i = 0; i < dat.questions.length; i++){
              //  alert(dat.questions[i].QUESTION);
                $("#listofquestions").append($("<option></option>")
                .attr("value",dat.questions[i].ID).text(dat.questions[i].QUESTION));
            }
        }
    });
}

function getSecurityQuestions(){
    toggleBtn("#squestion");
    $("#removeSecurityQuestion").toggle();
    var show = $("#removeSecurityQuestion").is(":visible");        
    if(show){            
        getSecurityQuestionData();
    }
}

function getSecurityQuestionData(){
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetSecurityQuestions')?>",
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofsquestions").empty();
            for(var i = 0; i < dat.questions.length; i++){
              //  alert(dat.questions[i].QUESTION);
                $("#listofsquestions").append($("<option></option>")
                .attr("value",dat.questions[i].ID).text(dat.questions[i].SECURITYQUESTION));
            }
        }
    });    
}

function addSecurityQuestion(){
    var question = $("#securityquestion").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddSecurityQuestion') ?>",
      data: {"question":question},
      success: function(data){
          var dat = JSON.parse(data);
          alert(dat.message);
          getSecurityQuestionData();       
      }
    });                 
}

function removeSecurityQuestion(){
    var sqid = $("#listofsquestions").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveSecurityQuestion') ?>",
      data: {"sqId":sqid},
      success: function(data){
          getSecurityQuestionData();              
      }
    });   
}

function getMainCategories(){
    toggleBtn("#maincats");
    $("#removeMainCat").toggle();
    var show = $("#removeMainCat").is(":visible");        
    if(show){            
        getMainCategoryData();
    }
}

function getMainCategoryData(){
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetMainCategories')?>",
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofmcats").empty();
            $("#maincat").empty();            
            for(var i = 0; i < dat.categories.length; i++){
                $("#listofmcats").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));
                $("#maincat").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));                
            }
        }
    });      
}

function addMainCategory(){
    var cat = $("#maincategory").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddMainCategory') ?>",
      data: {"mc":cat},
      success: function(data){
          var dat = JSON.parse(data);
          getMainCategoryData();  
         // getSubCatMainCats();     
          alert(dat.message);
      }
    });             
}

function removeMainCategory(){
    var catId = $("#listofmcats").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveMainCategory') ?>",
      data: {"mc":catId},
      success: function(data){
          var dat = JSON.parse(data);
          getMainCategoryData();       
          //getSubCatMainCats();       
      }
    });     
}

function getSubCategories(){
    toggleBtn("#subcats");  
    $("#removeSubCat").toggle();
    var show = $("#removeSubCat").is(":visible");        
    if(show){            
        getSubCategoryData();
    }
}

function getSubCategoryData(){
    var mcId = $("#maincat").val();    
    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createUrl('Admin/GetSubCategories')?>",
        data: {"mcId":mcId},
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofscats").empty();
            for(var i = 0; i < dat.categories.length; i++){
                $("#listofscats").append($("<option></option>")
                .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));
            }
        }
    });    
}

function addSubCategory(){
    var sc = $("#subcategory").val();
    var mc = $("#maincat").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddSubCategory') ?>",
      data: {"mc":mc, "sc":sc},
      success: function(data){
          var dat = JSON.parse(data);
          getSubCategoryData();       
          alert(dat.message);
      }
    });                 
}

function removeSubCategory(){
    var sc = $("#listofscats").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveSubCategory') ?>",
      data: {"sc":sc},
      success: function(data){
          var dat = JSON.parse(data);
          getSubCategoryData();              
      }
    });         
}

function toggleBtn(id){
    if($(id).val()==="View All"){
        $(id).attr("value","Hide");
    }
    else{
        $(id).attr("value","View All");  
    }    
}
