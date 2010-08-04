//SPECIAL SCRIPT FOR MOBILE

function mobileKeyHandler(e){
    //console.debug(e.keyCode);
    switch(e.keyCode){
        //0 m 
        case 48: 
        case 77: 
        case 109: 
        case 1510:
            addToSelectedItem(0);
            break;
        //1 r 
        case 49: 
        case 82: 
        case 114: 
        case 1512:
            addToSelectedItem(1);
            break; 
        //2 t 
        case 50: 
        case 84: 
        case 116: 
        case 1488:
            addToSelectedItem(2);
            break; 
        //3 y 
        case 51: 
        case 89: 
        case 121: 
        case 1496:
            addToSelectedItem(3);
            break; 
        //4 f 
        case 52: 
        case 70: 
        case 102: 
        case 1499:
            addToSelectedItem(4);
            break; 
        //5 g 
        case 53: 
        case 71: 
        case 103: 
        case 1506:
            addToSelectedItem(5);
            break; 
        //6 h 
        case 54: 
        case 72: 
        case 104: 
        case 1497:
            addToSelectedItem(6);
            break; 
        //7 v
        case 55: 
        case 86: 
        case 118: 
        case 1492:
            addToSelectedItem(7);
            break; 
        //8 b 
        case 56: 
        case 66: 
        case 98: 
        case 1504:
            addToSelectedItem(8);
            break; 
        //9 n 
        case 57: 
        case 78: 
        case 110: 
        case 1502:
            addToSelectedItem(9);
            break; 
        //. 
        case 46: 
            addToSelectedItem('.');
            break;
        //bkspace 
        case 8: 
            e.stop();
            clearSelectedItem();
            break;
        //price with math
        case 61: 
        case 80: 
        case 112: 
        case 1508:
            priceMath();
            break;
        //space scroll to selected item;
        case 32:
            selectedItem.scrollTo();
            break;
            
    }
}

function addToSelectedItem (num) {
    if (selectedItem){
        price = selectedItem.down('#ItemPrice');
        selectedItem.down('#ItemPrice').value = selectedItem.down('#ItemPrice').value +'' + num;
    }
}

function clearSelectedItem () {
    if (selectedItem){
        selectedItem.down('#ItemPrice').value = '';
    }
}

function priceMath(){
     if (selectedItem){
         price = selectedItem.down('#ItemPrice').value;
         newprice = prompt("Enter some price math",price);
         try{
             selectedItem.down('#ItemPrice').value = eval(newprice);
         }
         catch(err){
             alert("ERROR:"+err.description);
         }
     }   
}


Event.observe(window, 'load', function() {
//    selectedItem = $$('.item')[0];
    Event.observe(document, 'keypress', mobileKeyHandler);
//    price = prompt("Enter the price","123");
//    alert(price);
});