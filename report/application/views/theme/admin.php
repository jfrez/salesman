<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_once 'header.php';
include_once 'navigation.php';

?>
<div class="block">

    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2 id="titlebar">Acciones</h2>

        <ul class="tabs">
            <li id="abtypes"><a href="#default" onclick="changeTitleBar('Build Types');">Build Types</a></li>
            <li id="aptypes"><a href="#tab2" onclick="changeTitleBar('Project Types');">Project Types</a></li>
            <li id="ausers"><a href="#tab3" onclick="changeTitleBar('Users');">Users</a></li>
            <li id="aroles"><a href="#tab4" onclick="changeTitleBar('Roles');">Roles</a></li>
        </ul>
    </div>		<!-- .block_head ends -->



    <div class="block_content tab_content" id="default" >


<?php
include_once 'semifooter.php';
include_once 'footer.php';
?>
