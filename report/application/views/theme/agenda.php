<?php

/* 

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



include_once 'header.php';

include_once 'navigation.php';

?>

<div class="span12">

    <center> <select name="salesman" id="salesman"  style="width: 180px;; border: 10 10 10 10; margin: 10 10 10 10; margin-bottom:30;">

                <option value="0">Filtrar por vendedor</option>

                <?php if(isset($salesManList) && count($salesManList) > 0) :

                foreach($salesManList as $val) :

                    ?>

                    <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>

                    <?php endforeach; endif;?>

            </select>&nbsp;&nbsp;</center>
            
            <script>
			$("#salesman").change(function(){
			
					$("select option:selected").each(function () {
					if($(this).val()!=0){
									jQuery("#if").attr("src","http://www.salesman.cl/report/calendar/?user="+$(this).val());
									}else{
									jQuery("#if").attr("src","http://www.salesman.cl/report/calendar2/");

									}

  					});
			
			});
			</script>

<iframe src="http://www.salesman.cl/report/calendar2/index.php" id="if" style="border: 0;  height: 550px;" allowtransparency="yes"scrolling="no" class="span11"></iframe>
			
     </div>  

