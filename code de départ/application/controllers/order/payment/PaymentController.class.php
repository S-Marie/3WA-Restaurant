<?php

class PaymentController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        if (empty($_SESSION['user']) == true) {
            $http->redirectTo('/');
        }

        $orderModel = new OrderModel;
        $orderId = $orderModel->addNewOrder();
        if ($orderId['MaxID'] == null) {
            $orderId['MaxID'] = 1;
        } else {
            $orderId['MaxID'] = intval($orderId['MaxID']) + 1;  
        }
        return [
                'orderId' => $orderId['MaxID']
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

    }
}