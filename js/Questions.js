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

    $("#category").change(function(){
        getListingQuestionData();
    });
    
    $("#remove").click(function(){
        removeListingQuestion();
    });
    
    $("#addLQ").click(function(){
        addListingQuestion();
    });

    $("#addCP").click(function(){
        addCategoryPair();
    });    

    $("#removeCP").click(function(){
        removeCategoryPair();
    });        

    $("#cplist").click(function(){
        getCategoryPairs();
    });            
    
    $("#scategory").click(function(){
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

    $('#btnRight').click(function(e) {
        var selectedOpts = $('#lstBox1 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox2').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnLeft').click(function(e) {
        var selectedOpts = $('#lstBox2 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox1').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });


});                  

function hideLists(){
    $("#removeListingQuestion").hide();
    $("#removeQuestionCategory").hide();
    $("#removeSecurityQuestion").hide();
    $("#removeMainCat").hide();
    $("#removeSubCat").hide(); 
    $("#removeSubCatStock").hide();
    $("#removeCategoryPair").hide();
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
 //   var category = $("#category option:selected").text();
    $.ajax({
        type: "POST",
        data: {"category": $("#category option:selected").val()},
        url: "<?php echo Yii::app()->createUrl('Admin/GetListingQuestions')?>",
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofquestions").empty();
          //  alert(dat.cat);
            for(var i = 0; i < dat.questions.length; i++){
               // alert(dat.questions[i].QUESTION);
                //alert(dat.questions);
              // alert(dat.cat);
                $("#listofquestions").append($("<option></option>")
                .attr("value",dat.questions[i].ID).text(dat.questions[i].QUESTION));
            }
        }
    });
}

function addCategoryPair(){
    var cp1 = $("#cp1").val();
    var cp2 = $("#cp2").val();        
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddCategoryPair') ?>",
      data: {"cp1id":cp1, "cp2id":cp2},
      success: function(data){
          var dat = JSON.parse(data);
        //  alert(dat.categorypairs);
          getCategoryPairData();   
      }
    });   
}

function getCategoryPairs(){
    toggleBtn("#cplist");
    $("#removeCategoryPair").toggle();
    var show = $("#removeCategoryPair").is(":visible");        
    if(show){            
        getCategoryPairData();
    }
}

function getCategoryPairData(){
    $.ajax({
        type: "POST",
        data: {
            //   "cp1id": $("#cp1 option:selected").val(),
          //     "cp2id": $("#cp2 option:selected").val(),
              },
        url: "<?php echo Yii::app()->createUrl('Admin/GetCategoryPairs')?>",
        success: function(data){
            var dat = JSON.parse(data);
            $("#listofcategorypairs").empty();
            alert(JSON.stringify(dat)+" TEST");
            for(var i = 0; i < dat.categorypairs.length; i++){
               // alert(dat.questions[i].QUESTION);
                //alert(dat.questions);
           //   alert(JSON.stringify(dat.categorypairs));
                $("#listofcategorypairs").append($("<option></option>")
                .attr("value",dat.categorypairs[i].ID).text(dat.categorypairs[i].category1+" & "+dat.categorypairs[i].category2));
            }
        }
    });
}

function removeCategoryPair(){
    var test = $("#listofcategorypairs").val();

    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/RemoveCategoryPair') ?>",
      data: {'cpId':test},
      success: function(data){
        var dat = JSON.parse(data);
      //  alert(dat.message);
        getCategoryPairData();              
      }
    });   
}

function getSecurityQuestions(){
    toggleBtn("#scategory");
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
    var category = $("#securitycategory").val();
    $.ajax({
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Admin/AddSecurityQuestion') ?>",
      data: {"category":category},
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

// submit_bttn.click(function () {
//             $('#lstBox2 option').each(function () {
//             $(this).attr('selected', true);
//         }); 



    function selectAll(){
        //$("#countries").click(function(){
        $('#lstBox2 option').each(function () {
            $(this).attr('selected', true);
        });            
      //      $('#countries option').prop('selected', true);
        //});
    }