var items = null;
loadPayment();



function loadPayment(){

    items = loadDataFromDomStorage('panier');
    if(items == null)
    {
        items = new Array();
        document.location.href= getRequestUrl()+'/order';

    } else {
        display();
         $('#items').val(JSON.stringify(items));
    }
}

function savePayment()
{
    // Enregistrement du panier dans le DOM storage.
    saveDataToDomStorage('panier', items);
};

function display(){
    var table = $('<thead>').append('<tr><td class="number">Nom</td><td class="number">Quantité</td><td class="number">Prix Unitaire</td><td class="number">Prix Total</td></tr>');
    var totalHT = 0;
    var totalTTC = 0;

    for(var i = 0; i < items.length; i++) {
    
        var info = '<tr><td class="number"><img src="'+items[i].photo+'"/>'+' '+items[i].name+'</td><td class="number">'+items[i].quantity+'</td><td class="number">'+items[i].salePrice+'</td><td class="number">'+(items[i].quantity*items[i].salePrice)+' €</td>';
        table.append(info);
        totalHT += items[i].quantity*items[i].salePrice;
        
    }

    totalTTC = totalHT * 1.2;
    $('#paymentDetails').append(table);
    $('#ht').text(parseInt(totalHT)+' €');
    $('#ttc').text(parseInt(totalTTC)+' €');
}


function onCancel(){
       
    items = null;

    savePayment();

}

$('#cancel').on('click', onCancel);
$('#logout').on('click', onCancel);