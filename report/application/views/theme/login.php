<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';

?>
<style>
body{
text-align:center;
}
.login{
margin-top:50px;
text-align:left;


}
hr{
height:20px;
}
.content{
margin-left:10px;
margin-right:10px;
padding: 40px;
padding-top: 10px;
display: inline-block;
	border: solid 1px #000;
	overflow: hidden;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, .4);
	-moz-box-shadow: 0 2px 6px rgba(0, 0, 0, .4);
	box-shadow: 0 2px 6px rgba(0, 0, 0, .4);
}
</style>

<center>
    <div class="" >
<div class="content bg-color-white login span6">
    <hr />
<h2 class="fg-color-green span5">Ingreso</h2>

        
        <form action="<?=$baseurl?>admin/login" method="post">
            <fieldset>

 <div class="input-control text span5 bg-color-grayDark">
                <input type="text" name="username" placeholder="Usuario" />
                </div>
      <div class="input-control password span5">

                <input type="password"  name="password" placeholder="Contraseña"/>
                </div>
</fieldset>
 <hr />
    <div style="text-align:right;">
   
                <input type="submit" class=" bg-color-green fg-color-white" value="Entrar" /> 
        </form>
<center>	<i class="fg-color-green span5">Salesman Report App</i></center>
</div>
</div>
</center>
<?php
include_once 'footer.php';
?>