<?PHP
echo $this->Html->css('item');
echo $javascript->link('prototype');
//add fancy stuff if we aren't in wap

if(!$isMobile){
    echo $javascript->link('scriptaculous');
    echo $javascript->link('builder');
    echo $javascript->link('effects');
    echo $javascript->link('controls');
    echo $javascript->link('dragdrop');
    echo $javascript->link('item_advanced');
}
else{
    echo "MOBILE!!" ;
    echo $javascript->link('itemMobile');
    echo $this->Html->css('itemMobile');
}
echo $javascript->link('items');


?>

<div id=stats>
    ...
</div>
<?php 
 echo $ajax->remoteTimer(
	array(
	'url' => array( 'controller' => 'items', 'action' => 'stats' ),
	'update' => 'stats',
	'frequency' => 120
	)
);
?>
<div class="items index">
	<h2><?php __('Items');?></h2>
	<div cellpadding="0" cellspacing="0" id="items">
	<div>
			<span><?php echo $this->Paginator->sort('id');?></span>
			<span><?php echo $this->Paginator->sort('name');?></span>
			<span><?php echo $this->Paginator->sort('quantity');?></span>
			<span><?php echo $this->Paginator->sort('price');?></span>
			<span><?php echo $this->Paginator->sort('created');?></span>
			<span><?php echo $this->Paginator->sort('modified');?></span>
			<span><?php echo $this->Paginator->sort('bought');?></span>
			<span class="actions"><?php __('Actions');?></span>
	</div>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>

    <?php echo $this->element('itemDiv', array('item'=>$item,'class'=>$class)) ?>

	<?php endforeach; ?>
	<?php $form->data=null;?>
    </div>
	<?php if (!$isMobile): ?>
	<div id='newItem'>	

	<?PHP
	echo $ajax->form('add','post',array('model'=>'Item','update'=>'items','position'=>'bottom'));
//	echo $form->create();
	echo $form->input('name');
	echo $form->input('quantity',array('default'=>1));
	echo $form->input('price',array('default'=>1));
	echo $form->submit('New item');

	echo $form->end();
	?>
	</div>
	
	<div id='avg_items'>
	Loading ...
	</div>
	
	<!--
	   TODO Make the sorting actually do something
	-->
	<?PHP echo $this->Ajax->drag('avg_items',array('revert'=>false)) ;?>
	<?PHP echo $this->Ajax->sortable('items',array('tag'=>'div')) ;?>
	<script>
	<?PHP echo $this->Ajax->remoteFunction(array('url'=>array('action'=>'average'),'update'=>'avg_items','evalScripts'=>true));?>
	</script>
	<?PHP echo $this->Ajax->drop('items',array('hoverclass'=>'hover','onDrop'=>'dropItemUpdateForm'))?>
	<?php endif; ?>	
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
