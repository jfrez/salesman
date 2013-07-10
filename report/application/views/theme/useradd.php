<?php

/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



include_once 'header.php';

include_once 'navigation.php';

$edit = (count($user_data) > 0) ? true : false;

$edit = (count($_POST) > 0 ) ? false : true;

?>



<div class="block small right">



    <div class="block_head">

        <div class="bheadl"></div>

        <div class="bheadr"></div>



        <h2><?php echo $pagetitle; ?></h2>



        <ul>

            <li><a href="<?php echo $baseurl ?>users">Volver</a></li>

        </ul>

    </div>		<!-- .block_head ends -->

    <div class="block_content">

        <form method="post" action="#">

            <p>

                <label>Nombre:</label><br>

                <input type="text" class="text small" name="name" value="<?php echo set_value('name', ($edit) ?$user_data[0]['name'] : ''); ?>">

                <?php echo form_error('name', '<span class="note error">', '</span>'); ?>

            </p>

            <p>

                <label>Apellido:</label><br>

                <input type="text" class="text small" name="sur_name" value="<?php echo set_value('sur_name', ($edit) ?$user_data[0]['sur_name'] : ''); ?>">

                <?php echo form_error('sur_name', '<span class="note error">', '</span>'); ?>

            </p>

            <p>

                <label>Usuario:</label><br>

                <input type="text" class="text small" name="username" value="<?php echo set_value('username', ($edit) ?$user_data[0]['username'] : ''); ?>">

                <?php echo form_error('username', '<span class="note error">', '</span>'); ?>

            </p>

   

            <p>

                <label>Contraseña:</label><br>

                <input type="password" class="text small" name="password" value="<?php echo set_value('password'); ?>">

                <?php echo form_error('password', '<span class="note error">', '</span>'); ?>

            </p>
         <?php if(count($user_data) < 1) :?>
            <p>

                <label>Confirmar Contraseña:</label><br>

                <input type="password" class="text small" name="cpassword" value="<?php echo set_value('cpassword'); ?>">

                <?php echo form_error('cpassword', '<span class="note error">', '</span>'); ?>

            </p>

            <?php  endif; ?>

            <p>

                <label>Email:</label><br>

                <input type="text" class="text small" name="email" value="<?php echo set_value('email', ($edit) ?$user_data[0]['email'] : ''); ?>">

                <?php echo form_error('email', '<span class="note error">', '</span>'); ?>

            </p>

            <p>

                <label>Fecha nacimiento:</label><br>

                <input type="text" class="text date_picker" name="birth_date" value="<?php echo set_value('birth_date', ($edit) ?$user_data[0]['birth_date'] : ''); ?>">

                <?php echo form_error('birth_date', '<span class="note error">', '</span>'); ?>

            </p>

               <p>

                <label>ID:</label><br>

                <input type="text" class="text small" value="<?php echo set_value('id_no', ($edit) ?$user_data[0]['Identification_no'] : ''); ?>" name="id_no">

                <?php echo form_error('id_no', '<span class="note error">', '</span>'); ?>

            </p>

            <p>

                <label>Roles :</label> <br>

		      <?php

                $userroles = ($edit) ? explode(',', $user_data[0]['role_ids']) : array();

                foreach($roles as $role):?>

                        <p>

                            <input type="checkbox" name="roles[]" class="checkbox" <?php echo set_checkbox('roles[]', $role['id'], ($edit && in_array($role['id'], $userroles)) ? true : false); ?> id="cbdemo_<?php echo $role['id'];?>" value="<?php echo $role['id'];?>"> <label for="cbdemo_<?php echo $role['id'];?>"><?php echo $role['title'];?></label>

                        </p>                

                      <?php endforeach;?>

                    <?php echo form_error('roles[]', '<span class="note error">', '</span>'); ?>

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