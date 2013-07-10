<?php

/* 

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



include_once 'header.php';

include_once 'navigation.php';

?>





        <h2 class="fg-color-blue"><?php echo $pagetitle;?> </h2>



       



    <div class="block_content">

        <div class="filter">

            <select name="salesman" id="salesman"  style="width: 180px;">

                <option value="">Filtrar por Vendedor</option>

                <?php if(isset($salesManList) && count($salesManList) > 0) :

                foreach($salesManList as $val) :

                    ?>

                    <option value="<?php echo $val['id'];?>" <?php echo ($val['id'] == $filterBySalesman) ? 'selected': '';?>><?php echo $val['name'];?></option>

                    <?php endforeach; endif;?>

            </select>&nbsp;&nbsp;

            <select name="category" id="category" style="width: 180px;">

                <option value="">Filtrar por Nicho</option>

                <?php foreach ($categoryList as $category):?>

                <option value="<?php echo $category['id'];?>" <?php echo ($category['id'] == $filterBycategory) ? 'selected': '';?>><?php echo $category['title'];?></option>

                <?php endforeach;?>

            </select>&nbsp;&nbsp;



            <select name="client" id="client"  style="width: 180px;">

                <option value="">Filtrar por Cliente</option>

                <?php if(isset($clientList) && count($clientList) > 0) :

                foreach($clientList as $val) :

                    ?>

                    <option value="<?php echo $val['id'];?>" <?php echo ($val['id'] == $filterByClient) ? 'selected': '';?>><?php echo $val['name'];?></option>

                    <?php endforeach; endif;?>

            </select>&nbsp;&nbsp;

            <select name="location" id="location" style="width: 180px;">

                <option value="">Filtrar por Ubicación</option>

                <?php foreach ($locationList as $location): if($location['name']!= '') :?>

                <option value="<?php echo $location['id'];?>" <?php echo ($location['id'] == $filterBylocation) ? 'selected': '';?>><?php echo $location['name'];?></option>

                <?php endif;endforeach;?>

            </select>






        <p style="float:left">

            <label>Desde:</label>

            <input id="startdate"  type="text" value="<?php echo isset ($filterByFrom) ? $filterByFrom: '';?>" style="width: 20%"  />

            &nbsp;&nbsp;

            <label>Hasta:</label>

            <input id="enddate" type="text"  value="<?php echo isset ($filterByTo) ? $filterByTo: '';?>" style="width: 20%" />



        </p>
		        </div> <br /><br />
 <div style="text-align:left">

            <a class="button bg-color-blue" href="<?php echo $baseurl?>schedule/add">Agregar</a>

        </div>

        <script type="text/javascript" language="javascript" src="http://www.gwork.cl/datatable/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="http://www.gwork.cl/datatable/media/js/DT_bootstrap.js"></script>
         <style type="text/css" title="currentStyle">
			
			@import "http://www.gwork.cl/datatable/media/css/demo_table.css";
		</style>


            <table width="100%" cellspacing="0" cellpadding="0" class="table table-condensed table-bordered table-striped">



                <tbody><tr>

                    <th width="300">Cliente</th>

                    <th width="93">Vendedor</th>

                    <th width="100">Ubicación</th>
                    <th width="100">Fecha</th>
					<th width="100">Comentario</th>
                    <th width="97">&nbsp;</th>

                </tr>

                <?php if(isset($scheduleList) && count($scheduleList) > 0) :

                    foreach($scheduleList as $val) :

                ?>

                <tr style="background-color: rgb(251, 251, 251);">

                    <td><a href="#"><?php echo $val['client_name'];?></a></td>

                    <td><?php echo $val['salesman_name'];?></td>

                    <td><?php echo $val['location_name'];?></td>
                    <td><?php echo $val['date'];?></td>
                        <td><?php

                        if(strlen($val['comment']) > 15) {

                            $msg = substr($val['comment'], 0, 15);

                            echo $msg . '<span style="color:blue;cursor:pointer" onclick="javascript:alert(\'' . $val['comment'] . '\')">...more</span>';

                        } else {

                            echo $val['comment'];

                        }

                        ?></td>

                    <td class="delete"><a href="<?php echo $baseurl.'schedule/edit/'.$val['id'];?>">Editar</a> | <a onclick="return confirm('Borrar?')" href="<?php echo $baseurl.'schedule/delete/'.$val['id'];?>">Borrar</a></td>
					
                </tr>

                <?php endforeach; else :?>

                <tr style="background-color: rgb(251, 251, 251);">

                    <td colspan="4" > No hay requerimientos agendados</td>

                </tr>

                    <? endif;?>

                </tbody></table>







            <div class="paggination right">

                <?php echo $this->pagination->create_links();?> Total : <?php echo $total_count;?>



            </div>		<!-- .paggination ends -->

        

    </div>

    <!-- .block_content ends -->



    <div class="bendl"></div>

    <div class="bendr"></div>



</div>

<?

//include_once 'semifooter.php';

include_once 'footer.php';



?>

<style>

    p.pull-right

    {

        text-align: right;

        clear: both;

        padding-top: 20px;

    }

</style>



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



        var url = '<?php echo $baseurl.'schedule/'; ?>';

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

        url += 'status/pending';

        window.location = url;

    }

</script>