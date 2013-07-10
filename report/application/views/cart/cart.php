<?php if(!$this->cart->contents()):  
    echo '<h2 class="fg-color-white" >Ordenes de Compra</h2>';  
else:  
?>  
  
<?php echo form_open('index.php?/cart/update_cart'); ?>  
<table width="100%" cellpadding="0" cellspacing="0" class="fg-color-white">  
    <thead>  
        <tr>  
            <td>Cant</td>  
            <td>Producto</td>  
            <td>Precio</td>  
            <td>Sub-Total</td>  
        </tr>  
    </thead>  
    <tbody>  
        <?php $i = 1; ?>  
        <?php foreach($this->cart->contents() as $items): ?>  
          
        <?php echo form_hidden('rowid[]', $items['rowid']); ?>  
        <tr <?php if($i&1){ echo 'class="alt"'; }?>>  
            <td>  
                <?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>  
            </td>  
              
            <td><?php echo $items['name']; ?></td>  
              
            <td>$<?php echo $this->cart->format_number($items['price']); ?></td>  
            <td>$<?php echo $this->cart->format_number($items['subtotal']); ?></td>  
        </tr>  
          
        <?php $i++; ?>  
        <?php endforeach; ?>  
          
        <tr>  
            <td</td>  
            <td></td>  
            <td><strong>Total</strong></td>  
            <td>$<?php echo $this->cart->format_number($this->cart->total()); ?></td>  
        </tr>  
    </tbody>  
</table>  
  
<p><?php echo form_submit('', 'Actualizar'); echo anchor('cart/empty_cart', 'Limpiar', 'class="empty"');?></p>  
<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>  
<?php   
echo form_close();   
endif;  
?>  