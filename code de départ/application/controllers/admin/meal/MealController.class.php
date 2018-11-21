<?php

class MealController
{
    public function httpGetMethod(Http $http)
    {
    	
    }

    public function httpPostMethod(Http $http, array $formfields)
    {
        print_r($_FILES);
        if($http->hasUploadedFile('productImage') == true)
        {
            $photo = $http->moveUploadedFile('productImage', '/images/meals');
        }
        else
        {
            $photo = 'no-photo.png';
        }

        var_dump($photo);

        $newMeal = new MealModel;
        $newMeal->saveMeal(
        	$_POST['productName'],
        	$_POST['description'],
        	$_FILES['productImage']['name'],
        	$_POST['initialStock'],
        	$_POST['buyPrice'],
        	$_POST['salePrice']
        	);
    }
}