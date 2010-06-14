<?PHP
echo $javascript->link('prototype');
echo $javascript->link('scriptaculous');
echo $javascript->link('builder');
echo $javascript->link('effects');
echo $javascript->link('controls');
echo $javascript->link('dragdrop');


?>
<div class="items index">
	<h2><?php __('Items');?></h2>
	<table cellpadding="0" cellspacing="0" id="items">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('quantity');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('bought');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>


	<?php 
	$formId = 'Item'. $item['Item']['id']; 
	
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $form->create('Item',array('id'=>$formId)); echo $item['Item']['id']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['name']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['quantity']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['price']; ?>&nbsp;<?PHP echo $this->Form->input('price')?></td>
		<td><?php echo $item['Item']['created']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['modified']; ?>&nbsp;</td>
		<td><?php echo $item['Item']['bought']; ?>&nbsp;<?PHP echo $this->Form->input('bought')?> </td>
		<?php echo $form->end();?>
		<?php echo $this->Ajax->observeForm($formId,array(        'url' => array( 'action' => 'edit' ),        'frequency' => 0.2,    ) );?>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $item['Item']['id'])); ?>
			<?php echo $this->Ajax->link(__('Done', true), array('action' => 'bought', $item['Item']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?PHP echo $this->Ajax->sortable('items',array()) ;?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Item', true), array('action' => 'add')); ?></li>
	</ul>
</div>