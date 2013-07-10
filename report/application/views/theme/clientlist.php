<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'navigation.php';
?>

<div class="block small right">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>

        <h2><?php echo $pagetitle;?></h2>

        <ul>
            <li><a href="<?php echo $baseurl?>clients/add">+ Agregar</a></li>
        </ul>
    </div>		<!-- .block_head ends -->

    <div class="block_content">
        <div class="filter">
            <select name="category" id="category">
                <option value="">Seleccionar categoria</option>
                <?php foreach ($categoryList as $category):?>
                <option value="<?php echo $category['id'];?>" <?php echo ($category['id'] == $filter) ? 'selected': '';?>><?php echo $category['title'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <br/><br/>
            <table width="100%" cellspacing="0" cellpadding="0">

                <tbody><tr>
                    <th width="250">Nombre</th>
                    <th width="93">Codigo SAP</th>
                    <th width="100">Nicho</th>
                    <th width="100">Fecha</th>
                    <td width="120">&nbsp;</td>
                </tr>
                <?php if(count($clientList) > 0) :
                    foreach($clientList as $val) :
                ?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td><a href="<?php echo $baseurl.'clients/details/'.$val['id'];?>"><?php echo $val['name'];?></a></td>
                    <td><?php echo $val['sap_code'];?></td>
                    <td><?php echo $val['title'];?></td>
                    <td><?php echo date("d M, Y", strtotime($val['created_date']));?></td>
                    <td class="delete"><a href="<?php echo $baseurl.'clients/details/'.$val['id'];?>">Ver</a> | <a href="<?php echo $baseurl.'clients/edit/'.$val['id'];?>">Editar</a> | <a onclick="return confirm('Eliminar?')" href="<?php echo $baseurl.'clients/delete/'.$val['id'];?>">Borrar</a></td>
                </tr>
                <?php endforeach; else :?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td colspan="3" >No hay clientes agregados</td>
                </tr>
                    <? endif;?>
                </tbody></table>



            <div class="paggination right">
                <?php echo $this->pagination->create_links();?> Total : <?php echo $total_count;?>

            </div>		<!-- .paggination ends -->

        </form>
<p class="pull-right"><a href="<?php echo ($filter) ? $baseurl.'clients/export/filter/'.$filter : $baseurl.'clients/export';?>" >Exportar como CSV</a></p>
    </div>
    <!-- .block_content ends -->

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>
<?
//include_once 'semifooter.php';
//include_once 'footer.php';

?>
<script type="text/javascript">
$('select[name="category"]').change(function() { 
            var categoryId = $("#category").val();
            var url = '<?php echo $baseurl.'clients/filter/'; ?>'+ categoryId;
            
            window.location = url;
         });

</script>