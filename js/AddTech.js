$(document).ready(function () {
    loadSubCats();
    allowSubmit();
    setName();

    $("#mainCat").change(function(){
        loadSubCats();
    });   
    
    $("input[name=rights]:radio").click(function(){
        $("#details").toggle();
    });
    
    $("input[name=agreement]:radio").click(function(){
        allowSubmit();
    });



});                            
                          
function setName(){
                        try{
                      //      alert($.cookie('listingname'));
                            //alert("val "+va);
//                            if(va !== ""){
//                                $("#name").attr("value",va);
//                            }
                        }
                        catch(err){
                     //       alert("error");
                        }    
}                          
                          
function loadSubCats(){
        var mcId = $("#mainCat").val();
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createUrl('Admin/GetSubCategories')?>",
            data: {"mcId": mcId},
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

function allowSubmit(){
        var check = $('input:radio[name=agreement]:checked').val();
        if(check === "false"){
            $('input[type=submit]').attr('disabled', 'disabled'); 
        }
        else{
            $('input[type=submit]').removeAttr('disabled');            
        }    
}