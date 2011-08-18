<?php 
$formId = 'Item'. $item['Item']['id']; 

?>
<div class='item'>

<?PHP 
$form->data=$item;
echo $form->create('Item',array('id'=>$formId,'defaut'=>false,'class'=>'itemForm',
'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
));?>
	<span><?php  //echo $item['Item']['id']; ?> <?PHP echo $form->input("id")?>&nbsp;</span>
	<span><?PHP echo $this->Form->input('bought')?> </span>
	<span><?PHP echo $this->Form->input('price',array('type'=>'text','length'=>3,'class'=>'itemPrice'))?></span>
	<span><?php echo $item['Item']['name']; ?>&nbsp;</span> *
	<!--span><?php echo $item['Item']['quantity']; ?>&nbsp;</span-->
	<span><?PHP echo $this->Form->input('quantity',array('length'=>3,'class'=>'itemQuantity'))?></span>
	<span><?php //echo $item['Item']['created']; ?>&nbsp;</span>
	<span><?php //echo $item['Item']['modified']; ?>&nbsp;</span>
	
	<script>
		
		if($('<?echo $formId ?>').down('#ItemBought').checked){
			$('<?echo $formId ?>').addClassName('bought');
		}
		else{
			$('<?echo $formId ?>').removeClassName('bought');
		}
	</script>
	<?php echo $this->Ajax->observeForm($formId,array('url' => array( 'action' => 'edit' ), 'frequency' => 7 , "create"=>'$('.$formId.').addClassName("loading")',"complete"=>'$('.$formId.').removeClassName("loading")'    ) );?>
	<span class="actions">
		<?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Item']['id'])); ?>
		<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Item']['id'])); ?>
		<?php //echo $this->Ajax->link(__('Done', true), array('action' => 'bought', $item['Item']['id'])); ?>
		<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
	</span>
	<?php echo $form->end();?>
</div>