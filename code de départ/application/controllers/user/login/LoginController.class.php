<?php

class LoginController
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
    	

        $getNewUser = new UserModel();
        $user = $getNewUser->getUser($_POST['email'], $_POST['password']);
        
       
		$newSession = new UserSession();
		$newSession->create(
			$user['Id'], 
			$user['LastName'], 
			$user['FirstName'], 
			$user['Email'],
            $user['Address'],
            $user['ZipCode'],
            $user['City']
			);

		
    }
}

?>