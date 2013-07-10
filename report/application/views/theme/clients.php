<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'navigation.php';
?>
<div class="block">

  	<!-- .block_head ends -->

    <div class="block withsidebar">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>

        <h2>Lista de Clientes</h2>
    </div>		<!-- .block_head ends -->



    <div class="block_content">

    <div class="sidebar">
        <ul class="sidemenu">
            <li class=""><a href="<?=$baseurl?>admin/">Inicio</a></li>
            <li class="active"><a href="<?=$baseurl?>admin/client">Administrar Clientes</a></li>
            <li class=""><a href="#sb3">Administrar Nichos</a></li>
            <li class=""><a href="#sb1">Agendar visitas</a></li>
            <li><a href="#sb2">Administrar usuario</a></li>
            <li><a href="#sb3">Admiistrar Roles/a></li>
        </ul>

     </div>		<!-- .sidebar ends -->
     <div class="block_content">
         <form accept="" method="post">
         <table cellpadding="0" cellspacing="0" width="100%">

                <tr>
                    <th>Nombre</th>
                    <td>Código SAP</td>
                    <td>Nicho</td>
                    <td>&nbsp;</td>
                </tr>

                <?php
                foreach($allClient as $clientdata)
                    {
                    ?>
                    <tr id='ut<?=$clientdata->id?>'>
                        <td><?=$clientdata->name?></td>
                        <td><?=$clientdata->sap_code?></td>
                        <td><?=$clientdata->market_niche_id?></td>
                        <td class="delete">
                           <a id='ue<?=$clientdata->id;?>' style="cursor:pointer" onclick="">Ver</a> | <a id='ue<?=$clientdata->id;?>' style="cursor:pointer" onclick="editclient('<?=$clientdata->id;?>')">Editar</a> | <a style="cursor:pointer" onclick="delClient(<?=$clientdata->id;?>,'ut');">Borrar</a>
                        </td>
                    </tr>
                    <?php
                    }
                ?>


            </table>
             </form>
     </div>
    </div>
     <div class="bendl"></div>
    <div class="bendr"></div>
    </div>
    </div>
    