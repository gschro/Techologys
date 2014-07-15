
   // google.load('visualization', '1', {'packages': ['geochart']});
  //  google.setOnLoadCallback(drawRegionsMap);
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

      function drawRegionsMap() {
       // var dat = [['Country'],['Germany'],['United States'],['China']];
  //      var countries = JSON.parse(dat);
      //  alert(countries);
       var dat = '<?php echo CJSON::Encode($map); ?>';
       var dat = JSON.parse(dat);
       // var ar = new array();
       // for(var i = 0; i < dat.length; i++){
       //    ar.push(dat[i]);
       // }
     //  alert(dat);
        var data = google.visualization.arrayToDataTable(dat);

        var options = {
          keepAspectRatio: true,
        };

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    };   
   




  
                            