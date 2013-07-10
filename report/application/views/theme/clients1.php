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
        <h2>Lista de Clientes</h2>

    </div>

<div class="block_content">
      <!--<h3>All Client Info</h3>-->
      <form accept="" method="post">
      <table cellpadding="0" cellspacing="0" width="100%">

                <tr>
                    <th>Nombre</th>
                    <td>Apellido</td>
                    <td>Email</td>
                    <td>&nbsp;</td>
                </tr>

                <?php
                foreach($allclient as $clientdata)
                    {
                    ?>
                    <tr id='ut<?=$clientdata['id']?>'>
                        <td><?=$clientdata['first_name']?></td>
                        <td><?=$clientdata['last_name']?></td>
                        <td><?=$clientdata['email']?></td>
                        <td class="delete">
                            <a id='ue<?=$clientdata['id'];?>' style="cursor:pointer" onclick="editclient('<?=$clientdata['id'];?>')">Editar</a> | <a style="cursor:pointer" onclick="delClient(<?=$clientdata['id'];?>,'ut');">Borrar</a>
                        </td>
                    </tr>
                    <?php
                    }
                ?>


            </table>
     <div class="paggination">
            <?php
           // echo "<br>";
             echo $this->pagination->create_links();
            ?>
       </div>
      </form>
    </div>

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>

<div class="block" id="edit_form" style="display:none">

    <div class="block_head">
           <div class="bheadl"></div>
	   <div class="bheadr"></div>
        <h2>Contacto</h2>
<!--
        <ul class="tabs">
            <li><a href="#default">Client Contact</a></li>
            <li><a href="#tab2">Primary Address</a></li>
            <li><a href="#tab3" id="l_id">Billing Address</a></li>
        </ul>
-->
    </div>		<!-- .block_head ends -->

    <?php
    if($message!="")
        echo "<div class='message {$messagetype}'><p>{$message}</p></div>";
    ?>
        <!--<div class="message errormsg"><p>An error message goes here</p></div>
        <div class="message success"><p>A success message goes here</p></div>
        <div class="message info"><p>An informative message goes here</p></div>
        <div class="message warning"><p>A warning message goes here</p></div>-->



    <div class="block_content" id="default">

        <form action="<?=$baseurl?>Clients/addClients" method="post" id="Clientform">
        <input type="hidden" name="id" id="id" value="" >
            <table cellpadding="5">
                
                <tr>
                    <td><label>Nombre:</label></td>
                    <td><input type="text" name="first_name" id="first_name" class="text small" /></td>
                </tr>
                <tr>
                    <td><label >Apellido:</label></td>
                    <td><input type="text" name="last_name" id="last_name" class="text small" /></td>
                </tr>


                <tr>
                    <td><label >Telefono:</label></td>
                    <td>
                        <input type="text" name="primary_phone1" id="primary_phone1" class="text validate[required,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="primary_phone2" id="primary_phone2" class="text validate[required,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="primary_phone3" id="primary_phone3" class="text validate[required,custom[onlyNumber],length[0,4]]" maxlength="4" style="width:100px"/>
                        
                    </td>
                </tr>

               


                <tr>
                    <td><label >Telefono 2:</label></td>
                    <td>
                        <input type="text" name="secondary_phone1" id="secondary_phone1" class="text validate[optional,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="secondary_phone2" id="secondary_phone2" class="text validate[optional,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="secondary_phone3" id="secondary_phone3" class="text validate[optional,custom[onlyNumber],length[0,4]]" maxlength="4" style="width:100px"/>
                       
                    </td>
                </tr>


                


                <tr>
                    <td><label >Fax:</label></td>
                    <td>
                        <input type="text" name="fax1" id="fax1"  class="text validate[required,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="fax2" id="fax2"  class="text validate[required,custom[onlyNumber],length[0,3]]" maxlength="3" style="width:100px"/> -
                        <input type="text" name="fax3" id="fax3"  class="text validate[required,custom[onlyNumber],length[0,4]]" maxlength="4" style="width:100px"/>
                       
                    </td>
                </tr>





                <tr>
                    <td><label >Email:</label></td>
                    <td>
                        <input type="text" name="email" id="email" class="text small validate[required,custom[email]]"/>
                    </td>
                </tr>



                <tr>
                    <td><label >Horario:</label></td>
                    <td><input type="text" name="contact_time"  id="contact_time" class="text small" /></td>
                </tr>
            </table>

          <!--
            <p>
                <input type="submit" class="submit small" value="Submit" />

            </p>
          -->
        </form>
    </div>		<!-- .block_content ends -->




    <div class="block_content">
        <h2>Dirección</h2>
        <form action="<?=$baseurl?>Clients/addclientcontactinfo" method="post" id="ClientContactform">
        <input type="hidden" name="id" id="c_client_id" value="" >
        <input type="hidden" name="client_id" value="">
            <table cellpadding="5">
                <tr>
                    <td colspan="2"><input type="checkbox" name="same_address" id="same_address" class="checkbox">&nbsp;&nbsp;&nbsp;Direccion de facturación?</td>
                </tr>
                <tr>
                    <td><label>Dirección Linea 1:</label></td>
                    <td><input type="text" name="address1" id="c_address1" class="text small validate[required]" /></td>
                </tr>
                <tr>
                    <td><label >Dirección Linea 2:</label></td>
                    <td><input type="text" name="address2" id="c_address2" class="text small" /></td>
                </tr>
                <tr>
                    <td><label >Ciudad:</label></td>
                    <td>
                        <input type="text" name="city" id="c_city" class="text small validate[required]" />
                    </td>
                </tr>
                <tr>
                    <td><label >Region:</label></td>
                    <td>
                        <select name="state"  id="c_state" class="" style=" width: 250px;font-size:14px;padding:3px;">
                            <option value="0" >Regiones</option>
                            <?=getStatesAsOption();?>
                        </select>
                    </td>
                </tr>
                


                <tr>
                    <td><label >Zip Code:</label></td>
                    <td>
                        <input type="text" name="zipcode1" id="zipcode1" class="text  validate[required,custom[onlyNumber],length[0,5]]" maxlength="5" style="width:100px" /> - <input type="text" id="zipcode2" name="zipcode2" class="text validate[optional,custom[onlyNumber],length[0,5]]" maxlength="5" style="width:100px" />
                    </td>
                </tr>



                
                <tr>
                    <td><label >Country:</label></td>
                    <td>
                        <select class="" name="country"  id="country" style="width: 250px;font-size:14px;padding:3px;">
                            <option value="0" >Select country</option>
                            <?=getCountriesAsOption();?>
                        </select>
                    </td>
                </tr>
            </table>


            <p>
                <input type="button" class="submit small" value=" Save " id="submit_1"  onclick="submitnow()" style="display: none" />

            </p>

        </form>
    </div>



    <div class="block_content" id="billing" style="display: block">
        <h2>Billing Address</h2>
        <form action="<?=$baseurl?>Clients/addclientbillingContact" method="post" id="ClientBillingform">
        <input type="hidden" name="id" id="b_client_id" value="" >
        <input type="hidden" name="client_id" value="<?=$this->session->userdata('clientid')?>">
            <table cellpadding="5">
                <tr>
                    <td><label>Address Line 1:</label></td>
                    <td><input type="text" name="address1" id="b_address1" class="text small" /></td>
                </tr>
                <tr>
                    <td><label >Address Line 2:</label></td>
                    <td><input type="text" name="address2" id="b_address2" class="text small" /></td>
                </tr>
                <tr>
                    <td><label >City:</label></td>
                    <td>
                        <input type="text" name="city" id="b_city" class="text small" />
                    </td>
                </tr>
                <tr>
                    <td><label >State:</label></td>
                    <td>
                        <select name="state" id="b_state" class="" style=" width: 250px;font-size:14px;padding:3px;">
                            <option value="0" >Select state</option>
                            <?=getStatesAsOption();?>
                        </select>
                    </td>
                </tr>



                 <tr>
                    <td><label >Zip Code:</label></td>
                    <td>
                        <input type="text" name="zipcode1" id="b_zipcode1" class="text  validate[required,custom[onlyNumber],length[0,5]]" maxlength="5" style="width:100px" /> - <input type="text" id="zipcode2" name="b_zipcode2" class="text validate[optional,custom[onlyNumber],length[0,5]]" maxlength="5" style="width:100px" />
                    </td>
                </tr>


                <tr>
                    <td><label >Country:</label></td>
                    <td>
                        <select class="" name="country" id="b_country" style="width: 250px;font-size:14px;padding:3px;">
                            <option value="0" >Select country</option>
                            <?=getCountriesAsOption();?>
                        </select>
                    </td>
                </tr>
            </table>


            <p>
                <input type="button" class="submit small" value=" Save " onclick="submitnow()" />

            </p>
        </form>
    </div>




    <div class="block_content tab_content" id="tab4">
      <h3>All Client Info</h3>
      <form accept="" method="post">
      <table cellpadding="0" cellspacing="0" width="100%">

                <tr>
                    <th>First Name</th>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>&nbsp;</td>
                </tr>

                <?php
                foreach($allclient as $clientdata)
                    {
                    ?>
                    <tr id='ut<?=$clientdata['id']?>'>
                        <td><?=$clientdata['first_name']?></td>
                        <td><?=$clientdata['last_name']?></td>
                        <td><?=$clientdata['email']?></td>
                        <td class="delete">
                            <a id='ue<?=$clientdata['id'];?>' style="cursor:pointer" onclick="editclient('<?=$clientdata['id'];?>')">Edit</a> | <a style="cursor:pointer" onclick="delClient(<?=$clientdata['id'];?>,'ut');">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                ?>


            </table>
      <?php
      echo "<br>";
	  echo $this->pagination->create_links();
      ?>
      </form>
    </div>

    <div class="bendl"></div>
    <div class="bendr"></div>

</div>		<!-- .block_content ends -->
<!-- .block ends -->


<script type="text/javascript">
    var baseurl = "<?=$baseurl;?>";
    var loadingimg = "<img src = '"+baseurl+"images/loading.gif' />";
    function editclient(id)
    {
        $('#b_client_id').val(id);
        $('#c_client_id').val(id);
        $("#edit_form").fadeOut('fast');
        url = baseurl + "Clients/getClientInfo";
        params = {"id":id}
        $.post(url, params,function(data){
            //alert(data);
            //alert(data.toSource());
            
            for(key in data)
                {
                    try {
                      if(key=='primary_phone' || key=='secondary_phone' || key=='fax')
                        {
                            var number = data[key].split('-');

                            for(i=0;i<3;i++)
                            {
                                var j = i+1;
                                $("#"+key+j).val(number[i]);
                            }
                        }
                    else
                        $("#"+key).val(data[key]);
                    
                }
                catch(e)
                    {}
                }

        },'json');
        
        url = baseurl + "Clients/getClientContactInfo";
        params = {"id":id}
        $.post(url, params,function(data){
            //alert(data);
            //alert(data.toSource());
            
            for(key in data)
                {
                    try {
                       $("#c_"+key).val(data[key]);
                    }
                    catch(e)
                    {}

                }

        },'json');


        url = baseurl + "Clients/getClientBillingInfo";
        params = {"id":id}
        $.post(url, params,function(data){
            //alert(data);
            //alert(data.toSource());

            for(key in data)
                {
                    try {
                       $("#b_"+key).val(data[key]);
                      //console.log("key->"+key+"--Log->"+data[key]);
                    }
                    catch(e)
                    {}

                }

        },'json');

        $("#tab2").hide();
        $("#default").show();
        $("#tab4").hide();
        $("#edit_form").fadeIn('slow');
        scrollTo('#default',100);
        
    }

    function delClient(ClientId,parent)
    {
        if(confirm("Are you sure you want to delete this?")==true){
            url = baseurl + "Clients/deleteClient";
            params = {"id":ClientId}
            $.post(url, params,function(data){
                $("#"+parent+ClientId).hide();
            });
        }
    }

$('#same_address').click(function()
{
    $('#billing').toggle();
    $("#submit_1").toggle();
}
);



function submitnow(){

    var val1 = $('#Clientform').validationEngine({returnIsValid:true});
    var val2 = $('#ClientContactform').validationEngine({returnIsValid:true});
    //var val3 = $('#insuranceform').validationEngine({returnIsValid:true});

    if(val1 && val2)
        {
        submitForm('#Clientform',success('#Clientform','Operation complate successfullty.'));
        submitForm('#ClientContactform',success);
        submitForm('#ClientBillingform',success);
        }
}

function success(form,data){
        //alert(data);
        $.jGrowl(data);
        //clearForm(form);
        
    }


    $(document).ready(function(){
         $('#Clientform').validationEngine({validationEventTriggers:"blur"});
         $('#ClientContactform').validationEngine({validationEventTriggers:"blur"});
         $('#ClientBillingform').validationEngine({validationEventTriggers:"blur"});

    })

</script>



<?php
include_once 'semifooter.php';
include_once 'footer.php';
?>
