<?php

class BookingController
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
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
       print_r($_SESSION);
       print_r($_POST);
       $bookingSave = new BookingModel();
       $bookingSave->booking( 
            $_POST['bookingYear'].'-'.$_POST['bookingMonth'].'-'.$_POST['bookingDay'],
            $_POST['bookingHours'].':'.$_POST['bookingMinutes'].':00', 
            $_POST['bookingSeatNumber'],
            $_SESSION['user']['UserId']
                );
    }
}

?>