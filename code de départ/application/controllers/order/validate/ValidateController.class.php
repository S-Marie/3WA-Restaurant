<?php

class ValidateController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    }

    public function httpPostMethod(Http $http)
    {
        $items = json_decode($_POST['items']);
  
        $orderModel = new OrderModel();
        $orderModel->validate(
            $_SESSION['user']['UserId'],
            $items
        );

        $http->redirectTo('/order/validate');
    }
}