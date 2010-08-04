
<?PHP foreach($items as $key=>$item):?>

	<div class='item' id="<?PHP echo  $itemId = "avgItem_{$key}" ?>" 
	price='<?echo ($item[0]['price']);?>'
	name='<?PHP echo($item[0]['name']); ?>'
	quantity = '<?PHP echo($item[0]['quantity']); ?>';
	>
	   <?PHP echo($item[0]['name']); ?>
	   <strong><?PHP echo($item[0]['price']); ?></strong>
	   * <?PHP echo($item[0]['quantity']); ?>
	</div>
	<?PHP echo $this->Ajax->drag($itemId,array('revert'=>true))?>
<?PHP endforeach;?>

