<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'navigation.php';

$edit = ($client_data[0]['name'] != null) ? true : false;
$edit = (count($_POST) > 0 ) ? false : true;

?>

<script>
    var locationno = 1;
    var editableLocationId = null;
    $(function() {
        var addresspickerMap = $( "#addresspicker" ).addresspicker({
            elements: {
                map:      "#map",
                lat:      "#lat",
                lng:      "#lon"
                //locality: '#locality',
                //country:  '#country'
            }
        });
        var gmarker = addresspickerMap.addresspicker( "marker");
        gmarker.setVisible(true);
        addresspickerMap.addresspicker( "updatePosition");
        $('#addresspicker').val('');
        $('#lat').val('');
        $('#lon').val('');
        $('#locationname').val('');

    });
    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function addLocation() {
        if($('#addresspicker').val() == null) {
            alert('Please add a location'); return;
        }
        locationno++;
        if(editableLocationId!=null) {
            var locId = editableLocationId;
        } else {
            var locId = 'loc_' + locationno ;
        }
        var html = '<li id="' + locId +'"> ' + $('#locationname').val()  +
                   '<span> ( <a onclick="editLocation(\'' + locId + '\')" href="#">edit</a> | <a onclick="deleteLocation(\'' + locId + '\')" href="#">del</a> ) </span>' +
                   '<input name="location[id][]" type="hidden" value="' + locId +'">' +
                   '<input name="location[address][]" type="hidden" value="' + $('#addresspicker').val() + '">' +
                   '<input name="location[name][]" type="hidden" value="' + $('#locationname').val() + '">' +
                   '<input name="location[lat][]" type="hidden" value="' + $('#lat').val() + '">' +
                   '<input name="location[lon][]" type="hidden" value="' + $('#lon').val() + '">' +
                    '</li>';
        if(editableLocationId!=null) {
            $('#'+editableLocationId).replaceWith(html);
            editableLocationId = null;
        } else {
            $("#locationlist").append(html);
        }

        $('#addresspicker').val('');
        $('#lat').val('');
        $('#lon').val('');
        $('#locationname').val('');
    }
    function editLocation(id) {
        editableLocationId = id;
        var locationname = $('#'+id +' input[name="location[name][]"]').val();
        var adds = $('#'+id +' input[name="location[address][]"]').val();
        var lat = $('#'+id +' input[name="location[lat][]"]').val();
        var ln = $('#'+id +' input[name="location[lon][]"]').val();
        $('#locationname').val(locationname);
        $('#addresspicker').val(adds);
        $('#lat').val(lat);
        $('#lon').val(ln);
        $('#addresspicker').trigger('paste');
    }
    function deleteLocation(id) {
        $('#'+id).remove();
        if(isNumber(id)) {
            $.get(baseurl + 'clients/deletelocation/' + id, function(data) {

            });
        }

    }
</script>
<style type="text/css">

    .gist {
        margin-top: 10px;
        font-size: 12px;
    }

    .ui-autocomplete-input, .input input {
        border: none;
        font-size: 14px;
        width: 300px;
        height: 24px;
        margin-bottom: 5px;
        padding-top: 2px;
    }

    .ui-autocomplete-input {
        border: 1px solid #DDD !important;
        padding-top: 0px !important;
    }

    #map {
        border: 1px solid #DDD;
        width:300px;
        height: 300px;
        float:left;
        margin: 0px 0 0 10px;
        -webkit-box-shadow: #AAA 0px 0px 15px;
    }
    #locationlist li{
        border: 1px solid #eee;
        padding:5px;
    }
    .input {
        float:left;
    }
</style>
<div class="block small right">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>

        <h2><?php echo $pagetitle; ?></h2>

        <ul>
            <li><a href="<?php echo $baseurl ?>clients">Volver</a></li>
        </ul>
    </div>		<!-- .block_head ends -->
    <div class="block_content">
        <form method="post" action="#">
            <p>
                <label>Nombre:</label><br>
                <input type="text" class="text small" name="name" value="<?php echo set_value('name', ($edit) ?$client_data[0]['name'] : ''); ?>">
                <?php echo form_error('name', '<span class="note error">', '</span>'); ?>
            </p>
            <p>
                <label>Código SAP:</label><br>
                <input type="text" class="text small" name="sap_code" value="<?php echo set_value('sap_code', ($edit) ?$client_data[0]['sap_code'] : ''); ?>">
                <?php echo form_error('sap_code', '<span class="note error">', '</span>'); ?>
            </p>
            <p>
                <label>Nicho:</label> <br>
		 <select class="styled" name="market" style="opacity: 0; position: relative; z-index: 100; ">
             <option value="">Seleccione</option>
                    <?php foreach($market_niche as $market):?>
                     <option <?php echo set_select('market',  $market['id'], ($edit && ($client_data[0]['market_niche_id'] == $market['id'])) ? true : false); ?> value="<?php echo $market['id'];?>"><?php echo $market['title'];?></option>
                    <?php endforeach;?>
                 </select>
                <?php echo form_error('market', '<span class="note error">', '</span>'); ?>
        </p>
        <p>
            <label>Ubicaciones:</label><br>
            <ul id="locationlist">
            <?php if(count($client_locations) >0 ) :
            foreach($client_locations as $location) :
                ?>
                <li id="<?php echo $location['id']?>"><?php echo $location['name']?>
                <span> ( <a onclick="editLocation('<?php echo $location['id']?>')" href="#">editar</a> | <a onclick="deleteLocation('<?php echo $location['id']?>')" href="#">supr</a> ) </span>
                <input name="location[id][]" type="hidden" value="<?php echo $location['id']?>">
                <input name="location[name][]" type="hidden" value="<?php echo $location['name']?>">
                <input name="location[address][]" type="hidden" value="<?php echo $location['address']?>">
                <input name="location[lat][]" type="hidden" value="<?php echo $location['lat']?>">
                <input name="location[lon][]" type="hidden" value="<?php echo $location['lon']?>">
                </li>
                <?php endforeach; endif;?>
            </ul>
            <?php echo form_error('location[address][]', '<span class="note error">', '</span>'); ?>
            <fieldset style="padding: 10px">
                <legend>Agregar</legend>
                <div style="float: left;width:440px;">
                    <label>Nombre :</label>
                    <input id="locationname" type="text" style="margin: 0px 0 10px 10px;width:340px;" class="text small"><br />

                    <label>Dirección:</label>
                    <input id="addresspicker" type="text" style="width:340px;" class="text small"><br />
                    <label>lat:</label> <input id="lat" type="text" style="width:100px;margin-top: 10px"  class="text">  <label>Lon:</label> <input id="lon" style="width:100px;margin-top: 10px" class="text" type="text">
                    <input type="button" onclick="addLocation()" class="submit small" style="margin: 10px 0px 0px 15px" value="Agregar"/>
                </div>
                <div id="map" style="width:330px;height: 200px; float: right"></div>
            </fieldset>
        </p>
            <p>
                <label>Descripción:</label><br>
                <textarea rows="5" cols="10" name="description"><?php echo set_value('description', ($edit) ?$client_data[0]['description'] : ''); ?></textarea>
                <?php echo form_error('descripción', '<span class="note error">', '</span>'); ?>
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
//include_once 'footer.php';
?>