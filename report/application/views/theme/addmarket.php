<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'navigation.php';

$edit = (count($client_data) > 0) ? true : false;
$edit = (count($_POST) > 0 ) ? false : true;
?>

<div class="block small right">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>

        <h2><?php echo $pagetitle; ?></h2>

        <ul>
            <li><a href="<?php echo $baseurl ?>marketniche">Volver</a></li>
        </ul>
    </div>		<!-- .block_head ends -->
    <div class="block_content">
        <form method="post" action="#">
            <p>
                <label>Cliente:</label><br>
                <input type="text" class="text small" name="title" value="<?php echo set_value('title', ($edit) ?$client_data[0]['title'] : ''); ?>">
                <?php echo form_error('title', '<span class="note error">', '</span>'); ?>
            </p>

            <p>
                <input type="submit" class="submit small" name="submit" value="Submit"/>
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