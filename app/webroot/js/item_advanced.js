function dropItemUpdateForm(element){
	console.debug(element);
	element = $(element);
	$('newItem').down('#ItemName').value = element.getAttribute('name');
	$('newItem').down('#ItemPrice').value = element.getAttribute('price');
	$('newItem').down('#ItemQuantity').value = element.getAttribute('quantity');
}