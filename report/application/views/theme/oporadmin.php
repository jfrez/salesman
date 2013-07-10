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
             <table width="100%" cellspacing="0" cellpadding="0" id="datatable" class="hovered bordered striped">



                <tbody><tr>
                    <th width="160">Fecha</th>

                    <th width="160">Cliente</th>
                                        <th width="160">Vendedor</th>


              

                    <th width="100">Comentario</th>

                                        <th width="100">Monto</th>
                                         <th width="100">Monto final</th>
                                                 
                                                            <th width="100">Estado</th>

<th></th>

                </tr>

                <?php if(isset($scheduleList) && count($scheduleList) > 0) :

                    foreach($scheduleList as $val) :

                ?>

                <tr style="background-color: rgb(251, 251, 251);">
                     <td><?php echo $val['date'];?></td>

                    <td><a href="#"><?php echo $val['client_name'];?></a></td>
                    <td><?php echo $val['salesman'];?></td>

              

                   

                    <td><?php

                        if(strlen($val['comment']) > 15) {

                            $msg = substr($val['comment'], 0, 15);

                            echo $msg . '<span style="color:blue;cursor:pointer" onclick="javascript:alert(\'' . $val['comment'] . '\')">...more</span>';

                        } else {

                            echo $val['comment'];

                        }

                        ?></td>
                        <td><?php echo $val['amount'];?></td>
                        <td><?php echo $val['famount'];?></td>
                     
                     <td><?php echo $val['state'];?></td>
                       <td><button  onclick="process(<?php echo $val['id'];?>,'Ingrese el monto de la venta efectiva o cierre sin venta <hr /><input type=number id=famount />')" class="bg-color-blue">Cerrar</button></td>




                </tr>

                <?php endforeach; else :?>

                <tr style="background-color: rgb(251, 251, 251);">

                    <td colspan="4" > No hay nuevas oportunidades</td>

                </tr>

                    <? endif;?>

                </tbody>

            </table>



</div>

<script>

 
$(function(){




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




        var url = '<?php echo $baseurl.'opor/nuevas/'; ?>';

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

        url += 'status/isok';

        window.location = url;

    }
function process(id,html){
 $.Dialog({
            'title'       : 'Nueva Oportunidad',
            'content'     : html,
            'draggable'   : true,
            'overlay'     : true,
            'closeButton' : true,
            'buttonsAlign': 'right',
            'position'    : {
                'zone'    : 'right'
            },
            'buttons'     : {
                'Sin venta'     : {
                    'action': function(){

                        $.ajax({
                            url: "<?=$baseurl?>/opor/ChangeState/"+id+"/ProcessClosed",
                            success:function(){
                                location.href="<?=$baseurl?>/opor/admin";
                            }
                        });
                    }
                },
                'Con venta'     : {
                    'action': function(){
                        $.ajax({
                            url: "<?=$baseurl?>/opor/ChangeState/"+id+"/Sale/",
                            success:function(){
                               // alert($("#famount").val());
                                $.ajax({
                                    url: "<?=$baseurl?>/opor/changeMontoF/"+id+"/"+$("#famount").val(),
                                    success:function(){
                                        location.href="<?=$baseurl?>/opor/admin";
                                    }
                                });
                            }
                        });


                    }
                }
            }
        });



}
</script>
