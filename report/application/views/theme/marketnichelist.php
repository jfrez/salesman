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
            <li><a href="<?php echo $baseurl?>marketniche/add">+ Agregar</a></li>
        </ul>
    </div>		<!-- .block_head ends -->

    <div class="block_content">

        <form method="post" action="">

            <table width="100%" cellspacing="0" cellpadding="0">

                <tbody><tr>
                    <th width="476">Categoria</th>
                    <th width="93">Estado</th>
                    <th width="89">Fecha</th>
                    <td width="97">&nbsp;</td>
                </tr>
                <?php if(count($marketList) > 0) :
                    foreach($marketList as $val) :
                ?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td><a href="#"><?php echo $val['title'];?></a></td>
                    <td><?php echo $val['status'];?></td>
                    <td><?php echo date("d M, Y", strtotime($val['created_date']));?></td>
                    <td class="delete"><a href="<?php echo $baseurl.'marketniche/edit/'.$val['id'];?>">Edit</a> | <a onclick="return confirm('Borrar?')" href="<?php echo $baseurl.'marketniche/delete/'.$val['id'];?>">Borrar</a></td>
                </tr>
                <?php endforeach; else :?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td colspan="3" > No hay nichos aún</td>
                </tr>
                    <? endif;?>

                </tbody></table>
            <div class="paggination right">
                <?php echo $this->pagination->create_links();?> Total : <?php echo $total_count;?>
            </div>		<!-- .paggination ends -->

        </form>
<p class="pull-right"><a href="<?php echo $baseurl.'marketniche/export';?>" >Exportar como CSV</a></p>
    </div>
    <!-- .block_content ends -->

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>
<?
//include_once 'semifooter.php';
//include_once 'footer.php';

?>
