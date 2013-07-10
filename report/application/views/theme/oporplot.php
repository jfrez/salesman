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
    <script src="<?=$baseurl?>static/RGraph/libraries/RGraph.pie.js" ></script>
        <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.bar.js" ></script>

    

<div class="block small right">
        <h2 class="fg-color-blue"><?php echo $pagetitle;?> <? echo date("Y-m-d") ?></h2>
    <div class="block_content">

        <div class="filter">

            <select name="salesman" id="salesman"  style="width: 180px;">

                <option value="">Filtrar por vendedor</option>

                <?php if(isset($salesManList) && count($salesManList) > 0) :

                foreach($salesManList as $val) :

                    ?>

                    <option value="<?php echo $val['id'];?>" <?php echo ($val['id'] == $filterBySalesman) ? 'selected': '';?>><?php echo $val['name'];?></option>

                    <?php endforeach; endif;?>

            </select>&nbsp;&nbsp;

            <select name="category" id="category" style="width: 180px;">

                <option value="">Filtrar por categoría</option>

                <?php foreach ($categoryList as $category):?>

                <option value="<?php echo $category['id'];?>" <?php echo ($category['id'] == $filterBycategory) ? 'selected': '';?>><?php echo $category['title'];?></option>

                <?php endforeach;?>

            </select>&nbsp;&nbsp;



            <select name="client" id="client"  style="width: 180px;">

                <option value="">Filtrar por cliente</option>

                <?php if(isset($clientList) && count($clientList) > 0) :

                foreach($clientList as $val) :

                    ?>

                    <option value="<?php echo $val['id'];?>" <?php echo ($val['id'] == $filterByClient) ? 'selected': '';?>><?php echo $val['name'];?></option>

                    <?php endforeach; endif;?>

            </select>&nbsp;&nbsp;

            <select name="location" id="location" style="width: 180px;">

                <option value="">Filtrar por ubicación</option>

                <?php foreach ($locationList as $location): if($location['name']!= '') :?>

                <option value="<?php echo $location['id'];?>" <?php echo ($location['id'] == $filterBylocation) ? 'selected': '';?>><?php echo $location['name'];?></option>

                <?php endif;endforeach;?>

            </select>
      <select name="status" id="status" style="width: 220px;">

                <option value="" <?php echo (empty($status)) ? 'selected': '';?>>Estado</option>

               
                <option value="New"  <?php echo (isset($status) && "New" == $status) ? 'selected': '';?> >Nueva</option>
                <option value="Proceso"  <?php echo (isset($status) && "Proceso" == $status) ? 'selected': '';?> >En proceso</option>
                <option value="Cerrada"  <?php echo (isset($status) && "Cerrada" == $status) ? 'selected': '';?> >Cerrada</option>



            </select>
             <select name="prob" id="prob" style="width: 220px;">

                <option value="" <?php echo (empty($prob)) ? 'selected': '';?>>Probabilidad</option>

               
                <option value="10"  <?php echo (isset($prob) && 10 == $prob) ? 'selected': '';?> >Baja</option>
                <option value="50"  <?php echo (isset($prob) && 50 == $prob) ? 'selected': '';?> >Media</option>
                <option value="90"  <?php echo (isset($prob) && 90 == $prob) ? 'selected': '';?> >Alta</option>



            </select>

        </div> 

        <p style="float:left">

            <label>Desde:</label>

            <input id="startdate"  type="text" value="<?php echo isset ($filterByFrom) ? $filterByFrom: '';?>" style="width: 20%"  />

            &nbsp;&nbsp;

            <label>Hasta:</label>

            <input id="enddate" type="text"  value="<?php echo isset ($filterByTo) ? $filterByTo: '';?>" style="width: 20%" />




        </p>
		
		</div></div>
        <hr /><br />
        <div class=grid>
  <div class=row>  </div>        
<div class=row>
    <div class="span5 padding10 text-center place-left bg-color-blueLight">
     <h3>Oportunidades por cliente</h3>
    <canvas id="cvs" width="450" height="300">[No canvas support]</canvas>
    </div>
    <div class="span5 padding10 text-center place-left bg-color-blueLight">
           <h3>Monto</h3>
        <canvas id="cvs2" width="450" height="300">[No canvas support]</canvas>
    </div>
</div>
<div class=row>
    <div class="span5 padding10 text-center place-left bg-color-blueLight">
     <h3>Probabilidad</h3>
    <canvas id="cvs3" width="450" height="300">[No canvas support]</canvas>
    </div>
    <div class="span5 padding10 text-center place-left bg-color-blueLight">
           <h3>Estado</h3>
        <canvas id="cvs4" width="450" height="300">[No canvas support]</canvas>
    </div>
</div>



</div>

<script>

var client = Array();
var amount = Array();

var prob = 0;
var nocumplido = 0;

var nueva = 0;
var proceso = 0;
var cerrada = 0;


var bajo =0;
var medio =0;
var alto =0;






                <?php if(isset($scheduleList) && count($scheduleList) > 0) {

                    foreach($scheduleList as $val) {
                       
                ?>


//client["<?php echo $val['client_name'];?>"] = [].concat( client["<?php echo $val['client_name'];?>"] );
if(isNaN(client["<?php echo $val['client_name'];?>"]))client["<?php echo $val['client_name'];?>"]=0;
if(isNaN(amount["<?php echo $val['client_name'];?>"]))amount["<?php echo $val['client_name'];?>"]=0;

client["<?php echo $val['client_name'];?>"] = parseInt(client["<?php echo $val['client_name'];?>"]) +parseInt(1);
amount["<?php echo $val['client_name'];?>"] = parseInt(amount["<?php echo $val['client_name'];?>"]) +parseInt(<?php echo $val['amount'];?>);




<?
if($val['prob']==10){
?>
    bajo++;

<?

}else{
if($val['prob']==50){
?>
    medio++;

<?

}else{
?>
    alto++;

<?


}
}
?>

<?
if($val['state']=="New"){
?>
    nueva++;

<?

}else{
if($val['state']=="Proceso"){
?>
    proceso++;

<?

}else{
?>
    cerrada++;

<?


}
}
?>


<?
}
}
?>


 
$(function(){


	
	var clients = client.length;
	
	
	var key;
	
var vals = Array();
var tools = Array();

var names = Array();
for (key in client) {
	  vals.push(client[key]);
          tools.push(client[key]+"");

      names.push(key);
	  
}


           var pie = new RGraph.Pie('cvs', vals);
            pie.Set('chart.strokestyle', '#e8e8e8');
            pie.Set('chart.linewidth', 5);
            pie.Set('chart.shadow', true);
            pie.Set('chart.shadow.offsety', 15);
            pie.Set('chart.shadow.offsetx', 0);
            pie.Set('chart.shadow.color', '#aaa');
                    //    pie.Set('annotatable', true);

            pie.Set('chart.exploded', 10);
            pie.Set('chart.radius', 40);
            pie.Set('chart.tooltips', tools);
            pie.Set('chart.tooltips.coords.page', true);
            pie.Set('chart.labels', names);
            pie.Set('chart.labels.sticks', true);
            pie.Set('chart.labels.sticks.length', 15);
             // This is the factor that the canvas is scaled by
            var factor = 1;
            // Set the transformation of the canvas - a scale up by the factor (which is 1.5 and a simultaneous translate
            // so that the Pie appears in the center of the canvas
            pie.context.setTransform(factor,0,0,1,((pie.canvas.width * factor) - pie.canvas.width) * -0.5,0);
        
            pie.Draw();
            RGraph.Effects.Pie.RoundRobin(pie, {frames:30});


   var vals = Array();
var names = Array();
var tools = Array();

for (key in amount) {
      vals.push(amount[key]);
      names.push(key);
                tools.push(amount[key]+"");

      
}
var bar4 = new RGraph.Bar('cvs2', vals);
            bar4.Set('colors', ['#2A17B1']); 
            bar4.Set('labels', names);
            bar4.Set('numyticks', 5);
            bar4.Set('ylabels.count', 5);
            bar4.Set('gutter.left', 65);
               //         bar4.Set('annotatable', true);
                bar4.Set('chart.tooltips', tools);
            bar4.Set('chart.tooltips.coords.page', true);
            bar4.Set('variant', '3d');
            bar4.Set('strokestyle', 'transparent');
            bar4.Set('hmargin.grouped', 0);
            bar4.Set('scale.round', true);
            bar4.Draw();


           



              var pie3 = new RGraph.Pie('cvs3', [bajo,medio,alto]);
            pie3.Set('chart.strokestyle', '#e8e8e8');
            pie3.Set('chart.linewidth', 5);
            pie3.Set('chart.shadow', true);
            pie3.Set('chart.shadow.offsety', 15);
            pie3.Set('chart.shadow.offsetx', 0);
           //             pie3.Set('annotatable', true);

            pie3.Set('chart.shadow.color', '#aaa');
            pie3.Set('chart.exploded', 10);
            pie3.Set('chart.radius', 40);
            pie3.Set('chart.tooltips', [bajo+"",medio+"",alto+""]);
            pie3.Set('chart.tooltips.coords.page', true);
            pie3.Set('chart.labels', ["Baja","Media","Alta"]);
            pie3.Set('chart.labels.sticks', true);
            pie3.Set('chart.labels.sticks.length', 15);
             // This is the factor that the canvas is scaled by
            var factor = 1;
            // Set the transformation of the canvas - a scale up by the factor (which is 1.5 and a simultaneous translate
            // so that the Pie appears in the center of the canvas
            pie3.context.setTransform(factor,0,0,1,((pie3.canvas.width * factor) - pie3.canvas.width) * -0.5,0);
        
            pie3.Draw();
            RGraph.Effects.Pie.RoundRobin(pie3, {frames:60});



              var pie4 = new RGraph.Pie('cvs4', [nueva,proceso,cerrada]);
            pie4.Set('chart.strokestyle', '#e8e8e8');
            pie4.Set('chart.linewidth', 5);
            pie4.Set('chart.shadow', true);
            pie4.Set('chart.shadow.offsety', 15);
            pie4.Set('chart.shadow.offsetx', 0);
           //             pie3.Set('annotatable', true);

            pie4.Set('chart.shadow.color', '#aaa');
            pie4.Set('chart.exploded', 10);
            pie4.Set('chart.radius', 40);
            pie4.Set('chart.tooltips', [nueva+"",proceso+"",cerrada+""]);
            pie4.Set('chart.tooltips.coords.page', true);
            pie4.Set('chart.labels', ["Nueva","Proceso","Cerrada"]);
            pie4.Set('chart.labels.sticks', true);
            pie4.Set('chart.labels.sticks.length', 15);
             // This is the factor that the canvas is scaled by
            var factor = 1;
            // Set the transformation of the canvas - a scale up by the factor (which is 1.5 and a simultaneous translate
            // so that the Pie appears in the center of the canvas
            pie4.context.setTransform(factor,0,0,1,((pie4.canvas.width * factor) - pie4.canvas.width) * -0.5,0);
        
            pie4.Draw();
            RGraph.Effects.Pie.RoundRobin(pie4, {frames:60});
 



    //$filterBySalesman

    $('select[name="salesman"]').change(function() {

        updateUrl();

    });

    $('select[name="category"]').change(function() {

        updateUrl();

    });

    $('select[name="location"]').change(function() {

        updateUrl();

    });

    $('select[name="client"]').change(function() {

        updateUrl();

    });
	 $('select[name="prob"]').change(function() {

        updateUrl();

    });
      $('select[name="status"]').change(function() {

        updateUrl();

    });


    $('#startdate').datepicker({dateFormat: "yy-mm-dd"});

    $('#enddate').datepicker({

        dateFormat: "yy-mm-dd" ,

        onSelect: function(dateText, inst){

            updateUrl();

        }





    });
      });

    function updateUrl() {

        var categoryId = $("#category").val();

        var locationId = $("#location").val();

        var clientId = $("#client").val();

        var salesmanId = $("#salesman").val();

        var startdate = $('#startdate').val();

        var enddate = $('#enddate').val();
		var prob = $('#prob').val();
    var status = $('#status').val();



        var url = '<?php echo $baseurl.'opor/report/'; ?>';

        if(categoryId) {

            url += 'category/' + categoryId + '/';

        }

        if(locationId) {

            url += 'location/' + locationId + '/';

        }

        if(clientId) {

            url += 'client/' + clientId + '/';

        }

        if(salesmanId) {

            url += 'salesman/' + salesmanId + '/';

        }

        if(startdate) {

            url += 'from/' + startdate + '/';

        }

        if(enddate) {

            url += 'to/' + enddate + '/';

        }
		 if(prob) {

            url += 'prob/' + prob + '/';

        }
         if(status) {

            url += 'status/' + status + '/';

        }

      

        window.location = url;

    }

</script>
