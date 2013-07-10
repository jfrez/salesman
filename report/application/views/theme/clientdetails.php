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

    </div>		<!-- .block_head ends -->
    <div class="block_content">
        <h2><?php echo $client_data[0]['name'];?></h2>
        <p>
            <?php echo '<b>Description : </b>'.$client_data[0]['description'];?><br/><br/>
            <?php echo '<b>Sap Code : </b>'.$client_data[0]['sap_code'];?><br/><br/>
            <?php echo '<b>Market Niche : </b>'.$client_data[0]['title'];?><br/><br/>
            <?php echo '<b>Joining Date : </b>'.date('F j, Y', $client_data[0]['created_date']);?><br/>
        </p>
        <br/>
        <br/>
        <br/>
        <?php if(!empty($client_locations)):?>
        <h2><?php echo 'Locations';?></h2>
        <ul>
            <?php foreach ($client_locations as $location):?>
            <li><?php echo '<b>'.$location['name'].' - </b>'.$location['address'].' ['.$location['lat'].', '.$location['lon'].']';?></li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div> <!-- .block_content ends -->

    <div class="bendl"></div>
    <div class="bendr"></div>
     </div>
<?
//include_once 'semifooter.php';
include_once 'footer.php';
?>