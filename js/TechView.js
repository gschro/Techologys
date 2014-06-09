$(document).ready(function () {
    //loadCats();
    listTech();

});                            

function listTech(){
    $("#list").click(function(){
        var x = $("#list").val();
        alert("val "+x);
        var action = "";
        if(x === "List"){
            url = "<?php echo Yii::app()->createUrl('Site/ShowTech') ?>";
        }
        else{
            url = "<?php echo Yii::app()->createUrl('Site/UnlistTech') ?>";
        }
        $.ajax({
          type: "POST",
          url: url,
          //data: {"qcategory":cat},
          success: function(data){
              var dat = JSON.parse(data);
              $("#list").attr("value",dat.title);
              //alert(dat.result);
          }
        });                
    })
}

function loadSubCats(){
        var catId = $("#mainCat").val();
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createUrl('Admin/GetSubCategories')?>",
            data: {"catId": catId},
            success: function(data){
                var dat = JSON.parse(data);
                $("#subCat").empty();
                for(var i = 0; i < dat.categories.length; i++){
                    $("#subCat").append($("<option></option>")
                            .attr("value",dat.categories[i].ID).text(dat.categories[i].CATEGORY));                                                    
                }
            }
        });                                                            
}
                            