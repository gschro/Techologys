<!DOCTYPE html>
<meta charset="utf-8">
<?php 
  header("access-control-allow-origin: *");?>
<style>
path {
  stroke: white;
  stroke-width: 0.25px;
  fill: grey;
}
</style>
<body>
  
<script type="text/javascript" src="js/d3.js"></script>
<script src="js/topojson.js"></script>
<script>
var width = 600,
    height = 300;

var projection = d3.geo.mercator()
    .center([0, 0 ])
    .scale(75)
    .rotate([360,0]);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);

var path = d3.geo.path()
    .projection(projection);

var g = svg.append("g");

// load and display the World
d3.json("js/world-110m.json", function(error, topology) {
    g.selectAll("path")
      .data(topojson.object(topology, topology.objects.countries)
          .geometries)
    .enter()
      .append("path")
      .attr("d", path)
});

var zoom = d3.behavior.zoom()
    .on("zoom",function() {
        g.attr("transform","translate("+ 
            d3.event.translate.join(",")+")scale("+d3.event.scale+")");
        g.selectAll("path")  
            .attr("d", path.projection(projection)); 
  });

svg.call(zoom)

</script>
</body>
</html>
