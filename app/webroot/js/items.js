var selectedItem = null;
//console.debug(selectedItem);


function loading(){
	//console.log(this);
}

function nextItem(back){
    if(!selectedItem){
      selectedItem = $$('.item')[0];   
    }
    else{
        selectedItem.removeClassName('selected');
        if(back){
            selectedItem = $(selectedItem).previous('.item');
        }else{
            selectedItem = $(selectedItem).next('.item');
        }   
        if(!selectedItem){
          selectedItem = $$('.item')[0];   
        }
       // console.debug(selectedItem);
       try{
           selectedItem.scrollIntoViewIfNeeded();;
        }catch(err){
            
        }
    }
    selectedItem.addClassName('selected');
	if(selectedItem.viewportOffset()[1] <0 || selectedItem.viewportOffset()[1] > document.viewport.getHeight()){
	selectedItem.scrollTo();
	}
    
}

//Event.observe(document, 'keypress', keyHandler);

function keyHandler(e){
    //console.debug(e.keyCode);
    switch(e.keyCode){
        case 47:
            nextItem();
            e.stop();
            break;
        case 44:
            nextItem(true);
            e.stop();
            break;
        case 64:
            e.stop();
            if(selectedItem){
                //priceBox =selectedItem.down('#ItemPrice').activate();
                //selectedItem.down('#ItemBought').click();
                if(selectedItem.down('#ItemBought').checked==false){
                    selectedItem.down('#ItemBought').checked = true;
                }
                else{
                    selectedItem.down('#ItemBought').checked=false;
                }

                //priceBox.observe('keypress', function(e){if(e.keycode==32) console.debug(e.target) })
            }
            
            break;
        case 43:
            e.stop();
            if(selectedItem){
                priceBox =selectedItem.down('#ItemPrice').activate();
                priceBox.observe('blur', function(e){e.target.value = eval(e.target.value) });
            }
            break;
    }
}
    
Event.observe(window, 'load', function() {
//    selectedItem = $$('.item')[0];
    Event.observe(document, 'keypress', keyHandler);
    //price = prompt("Enter the price","123");
    //alert(price);
});
