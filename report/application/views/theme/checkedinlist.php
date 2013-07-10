<?php

/* 

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



include_once 'header.php';

include_once 'navigation.php';

?>


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

        </div> 

        <p style="float:left">

            <label>Desde:</label>

            <input id="startdate"  type="text" value="<?php echo isset ($filterByFrom) ? $filterByFrom: '';?>" style="width: 20%"  />

            &nbsp;&nbsp;

            <label>Hasta:</label>

            <input id="enddate" type="text"  value="<?php echo isset ($filterByTo) ? $filterByTo: '';?>" style="width: 20%" />




        </p>

<div>
<hr />

            <table width="100%" cellspacing="0" cellpadding="0" id="datatable" class="hovered bordered striped">



                <tbody><tr>
				    <th width="160">Fecha</th>
                    <th width="160">Tiempo</th>

                    <th width="160">Cliente</th>

                    <th width="160">Vendedor</th>

                    <th width="100">Ubicación</th>

                    <th width="100">Comentario</th>

                </tr>

                <?php if(isset($scheduleList) && count($scheduleList) > 0) :

                    foreach($scheduleList as $val) :

                ?>

                <tr style="background-color: rgb(251, 251, 251);">
					 <td><?php echo $val['created_date'];?></td>
                     					 <td><?php echo round($val['visittime']/60);?> min</td>

                    <td><a href="#"><?php echo $val['client_name'];?></a></td>
                    <td><?php echo $val['salesman_name'];?></td>

                    <td><?php echo $val['location_name'];?></td>

                   

                    <td><?php

                        if(strlen($val['message']) > 15) {

                            $msg = substr($val['message'], 0, 15);

                            echo $msg . '<span style="color:blue;cursor:pointer" onclick="javascript:alert(\'' . $val['message'] . '\')">...more</span>';

                        } else {

                            echo $val['message'];

                        }

                        ?></td>

                </tr>

                <?php endforeach; else :?>

                <tr style="background-color: rgb(251, 251, 251);">

                    <td colspan="4" > No hay visitas agendadas</td>

                </tr>

                    <? endif;?>

                </tbody>

            </table>



            <div class="paggination right">

                <?php //echo $this->pagination->create_links();?> Total : <?php echo $total_count;?>



            </div>		<!-- .paggination ends -->

        

        <p class="pull-right"><a href="<?php echo $exporturl;?>" >Exportar como CSV</a></p>

    </div>

</div>

<?

//include_once 'semifooter.php';

include_once 'footer.php';



?>

<script type="text/javascript">
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