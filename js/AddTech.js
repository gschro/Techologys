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

$("#addCountry").click(function(){

});
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