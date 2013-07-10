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
    <script src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.effects.js" ></script>
     <script type="text/javascript" src="<?=$baseurl?>static/RGraph/libraries/RGraph.common.annotate.js" ></script>
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
 <select name="is_approved" id="is_approved" style="width: 80px;">

                <option value="" <?php echo (empty($is_approved)) ? 'selected': '';?>>Estado</option>

               
                <option value="0"  <?php echo (isset($is_approved) && 0 == $is_approved) ? 'selected': '';?> >Pendiente</option>
                <option value="1"  <?php echo (1 == $is_approved) ? 'selected': '';?> >Cumplido</option>


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
    <canvas id="cvs" width="450" height="300">[No canvas support]</canvas>
    <canvas id="cvs2" width="450" height="300">[No canvas support]</canvas>

		
<script>
var client = Array();

var salesman = Array();



                <?php if(isset($scheduleList) && count($scheduleList) > 0) {

                    foreach($scheduleList as $val) {

                ?>


//client["<?php echo $val['client_name'];?>"] = [].concat( client["<?php echo $val['client_name'];?>"] );
if(isNaN(client["<?php echo $val['client_name'];?>"]))client["<?php echo $val['client_name'];?>"]=0;
client["<?php echo $val['client_name'];?>"] = parseInt(client["<?php echo $val['client_name'];?>"]) +parseInt(1);

//salesman["<?php echo $val['salesman_name'];?>"] = [].concat( salesman["<?php echo $val['salesman_name'];?>"] );
if(isNaN(salesman["<?php echo $val['salesman_name'];?>"]))salesman["<?php echo $val['salesman_name'];?>"]=0;
salesman["<?php echo $val['salesman_name'];?>"] = parseInt(salesman["<?php echo $val['salesman_name'];?>"]) +parseInt(1);


<?
}
}

//include_once 'semifooter.php';





?>



 
 
$(function(){


	
	var clients = client.length;
	
	
	var key;
	
var vals = Array();
var names = Array();
for (key in client) {
	  vals.push(client[key]);
      names.push(key);
	  
}


           var pie = new RGraph.Pie('cvs', vals);
            pie.Set('chart.strokestyle', '#e8e8e8');
            pie.Set('chart.linewidth', 5);
            pie.Set('chart.shadow', true);
            pie.Set('chart.shadow.offsety', 15);
            pie.Set('chart.shadow.offsetx', 0);
            pie.Set('chart.shadow.color', '#aaa');
            pie.Set('chart.exploded', 10);
            pie.Set('chart.radius', 80);
                   //     pie.Set('annotatable', true);

            pie.Set('chart.tooltips', names);
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
 
vals = Array();
names=Array();
for (key in salesman) {
	names.push(key);
	vals.push( salesman[key]);
}

var bar4 = new RGraph.Bar('cvs2', vals);
            bar4.Set('colors', ['#2A17B1']); 
            bar4.Set('labels', names);
            bar4.Set('numyticks', 5);
            bar4.Set('ylabels.count', 5);
            bar4.Set('gutter.left', 35);
               //         bar4.Set('annotatable', true);

            bar4.Set('variant', '3d');
            bar4.Set('strokestyle', 'transparent');
            bar4.Set('hmargin.grouped', 0);
            bar4.Set('scale.round', true);
            bar4.Draw();

});
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
	 $('select[name="is_approved"]').change(function() {

        updateUrl();

    });


    $('#startdate').datepicker({dateFormat: "yy-mm-dd"});

    $('#enddate').datepicker({

        dateFormat: "yy-mm-dd" ,

        onSelect: function(dateText, inst){

            updateUrl();

        }





    });

    function updateUrl() {

        var categoryId = $("#category").val();

        var locationId = $("#location").val();

        var clientId = $("#client").val();

        var salesmanId = $("#salesman").val();

        var startdate = $('#startdate').val();

        var enddate = $('#enddate').val();
		var is_approved = $('#is_approved').val();




        var url = '<?php echo $baseurl.'schedule/checkedin/'; ?>';

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
		 if(is_approved) {

            url += 'is_approved/' + is_approved + '/';

        }

        url += 'status/isok';

        window.location = url;

    }

</script>
