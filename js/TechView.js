
   // google.load('visualization', '1', {'packages': ['geochart']});
  //  google.setOnLoadCallback(drawRegionsMap);
     // alert('<?php echo CJSON::Encode($scorepairs); ?>');

$(document).ready(function () {
    //loadCats();
   // alert('help');
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
   
         function drawChart() {
    
       var dat = '<?php echo CJSON::Encode($scorepairs); ?>';
      //  var dat = [['ID','Marketability','Growth'],['Score',5,6]];        
        var dat = JSON.parse(dat);
   // alert(dat.length);
        for(var i = 0; i < dat.length; i++){

            var data = google.visualization.arrayToDataTable(dat[i]);
            // var data = google.visualization.arrayToDataTable([
            //   ['ID', 'Novelty', 'Marketability'],
            //   ['Score',    2,              8.67],          
            //   ]);
            var options = {
              //title: 'Growth',
              bubble: {textStyle: {fontSize: 11}},
              hAxis: {minValue: 0, maxValue: 10, title: dat[i][0][1], textPosition: 'none' },
              vAxis: {minValue: 0, maxValue: 10, title: dat[i][0][2], textPosition: 'none' },
              keepAspectRatio: true
            };

           // stringID()
// var listitem = document.createElement('p');
// var h3 = document.createElement('h3');
// h3.innerText = 'Growth';
// var p = document.createElement('p');
// p.innerText = 'Heres a graph about stuff';
// var div = document.createElement('div');
// listitem.appendChild(h3);
// listitem.appendChild(p);
// listitem.innerText = '<img src="" alt="">
//                                     <h3>Growth</h3>
//                                     <p>Heres a graph about stuff</p>
//                                     <div id="scoreChart'+i+'" style="width: 350px; height: 350px;"></div>';
//                                  +'  <h3></h3>'
                                   //+' <p>'+dat[i][0][1]+' and '+dat[i][0][1]+'</p>'
            var test = $('<li style="width: 220px; display: inline-block;">'
                                   +' <img src="" alt="">'
                                   +' <div id="scoreChart'+i+'" style="width: 200px; height: 200px;"></div>   '                                     

                                +'  </li>');
//var test = $('<p>test</p>');
            $('#charts').append(test);

  //alert(p.innerText);
          //  alert($('#charts').attr('id'));
          //var help = document.getElementById('charts');
          //help.appendChild(listitem);

            var chart = new google.visualization.BubbleChart(document.getElementById('scoreChart'+i));
            chart.draw(data, options);
        };


      }


function stringID(dataTable, rowNum){
    // return dataTable.getValue(rowNum, 0).toString();
    // return an empty string instead to avoid the bubble labels
    return "";
}

  
                            