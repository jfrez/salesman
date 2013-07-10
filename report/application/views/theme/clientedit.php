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

        <h2><?php echo $pagetitle; ?></h2>

        <ul>
            <li><a href="<?php echo $baseurl ?>clients">Volver</a></li>
        </ul>
    </div>		<!-- .block_head ends -->
    <div class="block_content">

        <form method="post" action="#">
            <p>
                <label>Nombre</label><br>
                <input type="text" class="text small" name="name" value="<?php echo $client_data[0]['name'];?>"> 
            </p>
            <p>
                <label>Código SAP:</label><br>
                <input type="text" class="text small" name="sap_code" value="<?php echo $client_data[0]['sap_code'];?>"> 
            </p>
            <p>
                <label>Nicho:</label> <br>
		 <select class="styled" name="market" style="opacity: 0; position: relative; z-index: 100; ">
                    <?php foreach($market_niche as $market):?>
                     <option value="<?php echo $market['id'];?>"  <?php echo ($market['id'] == $client_data[0]['market_niche_id']) ? 'selected="selected"': '';?>><?php echo $market['title'];?></option>
                    <?php endforeach;?>
                 </select>
                
        </p>
        <p>
                <label>Ubicaciones:</label><br>
                <input type="text" class="text small" name="location"> 
            </p>
            <p>
                <label>Descripción:</label><br>
                <textarea rows="5" cols="10" name="description"><?php echo $client_data[0]['description'];?></textarea>
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