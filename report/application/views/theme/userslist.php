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
            <li><a href="<?php echo $baseurl?>users/add">+ Agregar</a></li>
        </ul>
    </div>		<!-- .block_head ends -->

    <div class="block_content">

        <form method="post" action="">

            <table width="100%" cellspacing="0" cellpadding="0">

                <tbody><tr>
                    <th width="300">Usuario</th>
                    <th width="93">Nombre completo</th>
                    <th width="100">Rol</th>
                    <td width="97">&nbsp;</td>
                </tr>
                <?php if(count($userList) > 0) :
                    foreach($userList as $user) :
                ?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td><a href="#"><?php echo $user['username'];?></a></td>
                    <td><?php echo $user['name'];?></td>
                    <td><?php echo $user['role_title'];?></td>
                    <td class="delete"><a href="<?php echo $baseurl.'users/edit/'.$user['id'];?>">Editar</a> | <a onclick="return confirm('Borrar?')" href="<?php echo $baseurl.'users/delete/'.$user['id'];?>">Borrar</a></td>
                </tr>
                <?php endforeach; else :?>
                <tr style="background-color: rgb(251, 251, 251);">
                    <td colspan="3" > No hay usuarios</td>
                </tr>
                <? endif;?>
                </tbody></table>

            <div class="paggination right">
                <?php echo $this->pagination->create_links();?> Total : <?php echo $total_count;?>
            </div>		<!-- .paggination ends -->

        </form>
<p class="pull-right"><a href="<?php echo $baseurl.'users/export';?>" >Exportar como CSV</a></p>
    </div>
    <!-- .block_content ends -->

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>
<?
//include_once 'semifooter.php';
//include_once 'footer.php';

?>
