<?php

class UserController
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

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
        //print_r($formFields);
        $userModel = new UserModel();
        $userModel->saveUsers($formFields['lastName'], $formFields['firstName'], $formFields['birthYear'].'-'.$formFields['birthMonth'].'-'.$formFields['birthDay'], $formFields['address'], $formFields['city'], $formFields['zipCode'], $formFields['phone'], $formFields['email'], $formFields['password']);
        $http->redirectTo('/');
    }
}

?>