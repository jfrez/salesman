<?php

/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



include_once 'header.php';

include_once 'navigation.php';

$edit = (count($schedule_data) > 0) ? true : false;

$edit = (count($_POST) > 0 ) ? false : true;

?>



        <h2 class="fg-color-blue"><?php echo $pagetitle; ?></h2>



        <div style="text-align:right">

            <a class="fg-color-green" href="<?php echo $baseurl ?>schedule">Volver</a>

        </div>


    <div class="block_content">

        <form method="post" action="#">

            <p>

                <table>

                    <tr>

                        <th>Vendedor</th>

                        <th>Cliente</th>

                        <th>Ubicación</th>

                    </tr>

                    <tr>

                        <td>

                         <select class="" name="salesman" id="salesmanList" size="4" >

                             <?php foreach ($salesManList as $salesman):?>

                             <option value="<?php echo $salesman['id'];?>" <?php echo set_value('salesman', ($edit && $schedule_data[0]['salesman_id'] == $salesman['id']) ? 'selected' : '');?>><?php echo $salesman['name'];?></option>

                             <?php endforeach;?>

                         </select>

                        <?php echo form_error('salesman', '<span class="note error">', '</span>'); ?>

                        </td>

                        <td>

                         <select class="" name="client" id="clientList" size="4" >

                             <?php foreach ($clientList as $client):?>

                             <option value="<?php echo $client['id'];?>" <?php echo set_value('client', ($edit && $schedule_data[0]['client_id'] == $client['id']) ? 'selected' : '');?>><?php echo $client['name'];?></option>

                             <?php endforeach;?>

                         </select>

                            <?php echo form_error('client', '<span class="note error">', '</span>'); ?>

                        </td>

                        <td>

                         <select class="" name="location" id="locationList" size="4"  >

                            <?php //print_r($locationList);die;

                            foreach($locationList as $location){

//                                if($edit && $schedule_data[0]['location_id'] == $location['id'])

//                                {

//                                    echo '<option value="'.$location['id'].'" selected >'.$location['name'].'</option>';

//                                } else {

//

//                                }

                                echo '<option value="'.$location['id'].'"  >'.$location['name'].'</option>';

                            }

                            ?>

                         </select>

                            <?php echo form_error('location', '<span class="note error">', '</span>'); ?>

                        </td>

                    </tr>

                </table>

                

            </p>
            <p>
            <textarea name="comment" id="comment">
            </textarea>
            </p>
<p>
Fecha: <input type="date" id="date" name="date" />
</p>
            <p>

                <input type="submit" class="submit small" name="submit" value="Enviar"/>

            </p>

        </form>



   

</div> <!-- .block_content ends -->



    <div class="bendl"></div>

    <div class="bendr"></div>

     </div>

<?

//include_once 'semifooter.php';

include_once 'footer.php';

?>

<style>

    #salesmanList, #clientList, #locationList

    {

        height: inherit;

        width:250px;

    }

</style>

<script type="text/javascript">
jQuery.extend(DateInput.DEFAULT_OPTS, {
  month_names: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
  short_month_names: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
  short_day_names: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sab"]
});
jQuery.extend(DateInput.DEFAULT_OPTS, {
  stringToDate: function(string) {
    var matches;
    if (matches = string.match(/^(\d{4,4})-(\d{2,2})-(\d{2,2})$/)) {
      return new Date(matches[1], matches[2] - 1, matches[3]);
    } else {
      return null;
    };
  },

  dateToString: function(date) {
    var month = (date.getMonth() + 1).toString();
    var dom = date.getDate().toString();
    if (month.length == 1) month = "0" + month;
    if (dom.length == 1) dom = "0" + dom;
    return date.getFullYear() + "-" + month + "-" + dom;
  }
});
$(function() {
  $("#date").date_input();
});
   
    $('select[name="client"]').change(function() { 

       var clientId = $("#clientList").val();

       var dataString = 'client_id='+clientId;

       var url = "<?php echo $baseurl.'clients/get_location/'; ?>"+clientId;

       $.ajax({

            type: "GET",

            url: url,

            data: dataString,

            cache: false,

            success: function(msg)

                {

                    if(msg){

                        $('#locationList')

                        .find('option')

                        .remove();

                        $('#locationList').append(msg);

                    }else{

                        $('#locationList')

                        .find('option')

                        .remove();

                        $('#locationList').append('<option value="">No Location available</option>');

                

                    }

            },

            error: function(msg){

                alert(msg);

                 $('#locationList')

                        .find('option')

                        .remove();

                    $('#locationList').append('<option value="">No Location available</option>');

                return false;

            }

        });

   });


</script>