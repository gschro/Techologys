$(document).ready(function () {
    loadCats();
    

});                            

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
                            