$.getJSON(getRequestUrl() + '/meal?id=1', changeMealDisplay);

function changeMealDisplay(meal) {
$('#orderArticle #photo').attr('src', getWwwUrl() + '/images/meals/' + meal.Photo);
$('#orderArticle #description').text(meal.Description);
$('#orderArticle #price').text(meal.SalePrice);
}

function onEventChangeMeal(e) {
	e.preventDefault();
	var id = $('#article').val();
	
	$.getJSON(
        getRequestUrl() + '/meal?id='+id,
            changeMealDisplay// Méthode appelée au retour de la réponse HTTP
    );
}

$('#article').on('change', onEventChangeMeal);

var items = null;
load();

function load(){
	items = loadDataFromDomStorage('panier');
	if(items == null)
    {
        items = new Array();
    }
    else {
    	var table = $('<table class="generic-table" id="articleDetails">').append('<tr><td class="number">Quantité</td><td class="number">Produit</td><td class="number">Prix Unitaire</td><td class="number">Prix Total</td></tr>');
    	
    	for(var i = 0; i < items.length; i++) {
    		var info = '<tr><td class="number">'+items[i].quantity+'</td><td class="number">'+items[i].name+'</td><td class="number">'+items[i].salePrice+'</td><td class="number">'+(items[i].quantity*items[i].salePrice)+' € <button class="button-cancel" data-meal-id="'+items[i].mealId+'"><i class="fa fa-trash"></i></button></td>';
    		table.append(info);
    	}


    	$('#orderDetails').html(table);
    }
}

function save()
{
    // Enregistrement du panier dans le DOM storage.
    saveDataToDomStorage('panier', items);
};


function add(mealId, name, quantity, salePrice, photo)
{
	var index;
    
    mealId    = parseInt(mealId);
    quantity  = parseInt(quantity);
    salePrice = parseFloat(salePrice);

    for(index = 0; index < items.length; index++)
    {
    	if(items[index].mealId == mealId)
        {
        	items[index].quantity += quantity;

            save();
            load();
            return;
        }
    }

    items.push(
    {
        mealId    : mealId,
        name      : name,
        quantity  : quantity,
        salePrice : salePrice,
        photo : photo
    });
    
    save();
    load();
}

function onClickAdd(e) {
	console.log('hey');
	e.preventDefault();
	var id = $('#article').val();
	var name = $('#'+id).text();
	var quantity = $('#quantity').val();
	var price = parseFloat($('#orderArticle #price').text());
    var photo = $('#photo').attr('src');

	add(
		id,
		name,
		quantity,
		price,
        photo
	);

	
}

$('#addArticle').on('click', onClickAdd);

function onClickDeleteArticle(e)
{
	e.preventDefault();
    var id = $(this).data('meal-id');
    var index;
    for (var index = 0; index < items.length; index++)
    {
        if (items[index].mealId == id)
        {
            items.splice(index, 1);
            save();
            load();
            return;
        }
    }
    
}

$(document).on('click', '.button-cancel', onClickDeleteArticle);
$(document).on('click', '.button-cancel .fa-trash',  onClickDeleteArticle);
