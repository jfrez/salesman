<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'navigation.php';
?>

 <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.core.js" ></script>
     <script src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.dynamic.js" ></script>
    <script src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.tooltips.js" ></script>
         <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.annotate.js" ></script>

    <script src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.effects.js" ></script>
        <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.funnel.js" ></script>
                <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.gauge.js" ></script>
        <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.pie.js" ></script>


<h2>Dashboard</h2><hr />


        <div class="span5 padding30  text-center place-left ">
            <h3>Oportunidades</h3>
<canvas id="funnel1" width="300" height="350">[No canvas support]</canvas>
</div>

 <div class="span5 padding30 text-center place-left ">
    <h3>Compromisos</h3>
<canvas id="gauge" width="250" height="250">[No canvas support]</canvas>
</div>

<div class="span6 padding30 text-center  ">
    <h3>Visitas</h3>
    <canvas id="pie" width="450" height="250">[No canvas support]</canvas>
</div>
<script>

var nueva=0;
var proceso=0;
var cerrada=0;
var pendiente=0;
var completada=0;
var client = Array();
<?php if(isset($opor) && count($opor) > 0) {

     foreach($opor as $val) {
                       
if($val['state']=="New") echo "nueva+= ".$val['amount'].";";
if($val['state']=="Proceso") echo "proceso+=".$val['amount'].";";
if($val['state']=="Cerrada") echo "cerrada+=".$val['famount'].";";



    }
}
 if(isset($comp) && count($comp) > 0) {

     foreach($comp as $val) {
                       
if($val['done']==1) echo "completada++;";
if($val['done']==0) echo "pendiente++;";



    }
}
 if(isset($visit) && count($visit) > 0) {

     foreach($visit as $val) {
        ?>
   //client["<?php echo $val['client_name'];?>"] = [].concat( client["<?php echo $val['client_name'];?>"] );
if(isNaN(client["<?php echo $val['client_name'];?>"]))client["<?php echo $val['client_name'];?>"]=0;
client["<?php echo $val['client_name'];?>"] = parseInt(client["<?php echo $val['client_name'];?>"]) +parseInt(1);

<?


    }
}
?>

$(function(){
    
var vals = Array();
var names = Array();
var cant = Array();

for (key in client) {
      vals.push(client[key]);
            cant.push(client[key]+"");

      names.push(key +" "+client[key]);
      
}


           var pie = new RGraph.Pie('pie', vals);
            pie.Set('chart.strokestyle', '#e8e8e8');
            pie.Set('chart.linewidth', 5);
            pie.Set('chart.shadow', true);
            pie.Set('chart.shadow.offsety', 15);
            pie.Set('chart.shadow.offsetx', 0);
            pie.Set('chart.shadow.color', '#aaa');
            pie.Set('chart.exploded', 10);
            pie.Set('chart.radius', 80);
                   //     pie.Set('annotatable', true);

            pie.Set('chart.tooltips', cant);
            pie.Set('chart.tooltips.coords.page', true);
            pie.Set('chart.labels', names);
            pie.Set('chart.labels.sticks', true);
            pie.Set('chart.labels.sticks.length', 15);
            
            // This is the factor that the canvas is scaled by
            var factor = 1;
        
            // Set the transformation of the canvas - a scale up by the factor (which is 1.5 and a simultaneous translate
            // so that the Pie appears in the center of the canvas
           // pie.context.setTransform(factor,0,0,1,((pie.canvas.width * factor) - pie.canvas.width) * -0.5,0);
        
            //pie.Draw();
            RGraph.Effects.Pie.RoundRobin(pie, {frames:30});



 var funnel = new RGraph.Funnel('funnel1', [nueva,proceso,cerrada]);
           
            funnel.Set('chart.text.boxed', true);
            funnel.Set('chart.shadow', true);
                        funnel.Set('chart.text.halign', 'center');
            funnel.Set('chart.shadow.color', 'gray');
            funnel.Set('chart.shadow.blur', 25);
            funnel.Set('chart.shadow.offsetx', 0);
            funnel.Set('chart.shadow.offsety', 0);
            
            
            funnel.Set('chart.labels', [' Nuevas $'+nueva, ' En proceso $'+proceso, ' Cerradas $'+cerrada])
                .Draw();

                var gauge1 = new RGraph.Gauge('gauge', 0, 100, 100*completada/(pendiente+completada));
            gauge1.Set('chart.scale.decimals', 0);
            gauge1.Set('chart.tickmarks.small', 50);
            gauge1.Set('chart.tickmarks.big',5);
            gauge1.Set('chart.title.top', 'Cumplimiento');
            gauge1.Set('chart.title.top.size', 12);
            gauge1.Set('chart.title.top.pos', 0.15);
            gauge1.Set('chart.title.bottom', '%');
            gauge1.Set('chart.title.bottom.color', '#aaa');
            gauge1.Set('chart.colors.ranges', [[0, 30, 'red'], [30, 70, 'yellow'], [70, 100, 'green']])

            RGraph.isOld() ? gauge1.Draw() : RGraph.Effects.Gauge.Grow(gauge1);

});
</script>


    
<?
//include_once 'semifooter.php';
//include_once 'footer.php';

?>
