        // $(document).ready(function () {

        // });
        var test = true;

        function drawRegionsMap() {
            if(test){
           var dat = '<?php echo CJSON::Encode($countries); ?>';
           var dat = JSON.parse(dat);
           var ctrys = [];
           for(var i = 0; i < dat.length; i++){
                ctrys.push([dat[i]]);
           }

        var data = google.visualization.arrayToDataTable(ctrys);

        var options = {
          keepAspectRatio: true,
        };

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        test = false;
        }
    };   

             function drawChart() {
    
       var dat = '<?php echo $scorepairs; ?>';
      //  var dat = [['ID','Marketability','Growth'],['Score',5,6]];    
    //  dat = dat.replace(/\\/,"");
      alert(dat);
        var dat = JSON.parse(dat);
       // alert(dat[1][0]);
   // alert(dat.length);
        for(var i = 0; i < dat.length; i++){

            var data = google.visualization.arrayToDataTable(dat[i]);
            // var data = google.visualization.arrayToDataTable([
            //   ['ID', 'Novelty', 'Marketability'],
            //   ['Score',    2,              8.67],          
            //   ]);
       // alert(data.getValue(0, 1).toString());
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
