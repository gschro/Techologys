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