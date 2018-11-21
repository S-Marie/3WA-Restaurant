<?php
class UserModel
{

	public function saveUsers($lastName, $firstName, $birthDate, $address, $city, $zipCode, $phone, $email, $password)
	{
		$sql = new Database();
		
		$user = $sql->queryOne
        (
            "SELECT Id FROM User WHERE Email = ?", [ $email ]
        );
        
        
        if(empty($user) == false)  // natif php => message d'erreur
        {
            throw new DomainException
            (
                "Il existe déjà un compte utilisateur avec cette adresse e-mail"
            );
        }
        
		$save = 'INSERT INTO Users
		(LastName, FirstName, BirthDate, Address, City, ZipCode, Phone, Email, Password, CreationTimestamp)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';
		$passwordHash = $this->hashPassword($password);

		$sql->executeSql($save, [$lastName, $firstName, $birthDate, $address, $city, $zipCode, $phone, $email, $passwordHash]);
	}
 	
 	private function hashPassword($password)
	    {
	        /*
	         * Génération du sel, nécessite l'extension PHP OpenSSL pour fonctionner.
	         *
	         * openssl_random_pseudo_bytes() va renvoyer n'importe quel type de caractères.
	         * Or le chiffrement en blowfish nécessite un sel avec uniquement les caractères
	         * a-z, A-Z ou 0-9.
	         *
	         * On utilise donc bin2hex() pour convertir en une chaîne hexadécimale le résultat,
	         * qu'on tronque ensuite à 22 caractères pour être sûr d'obtenir la taille
	         * nécessaire pour construire le sel du chiffrement en blowfish.
	         */
	        $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

	        // Voir la documentation de crypt() : http://devdocs.io/php/function.crypt
	        return crypt($password, $salt);
	    }

	public function verifyPassword($password, $hashedPassword)
	{
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
		return crypt($password, $hashedPassword) == $hashedPassword;
	}

	public function getUser($email, $password)
	{
		
		$database = new Database();
		$user = $database->queryOne(

            "SELECT * 
             FROM Users 
             WHERE Email = ?", [ $email ]
        );

		if(empty($user) == true)
        {
            throw new DomainException
            (
                "Il n'y a pas de compte utilisateur associé à cette adresse email"
            );
        }

		if($this->verifyPassword($password, $user['Password']) == false)
		{
			throw new DomainException
			(
				'Le mot de passe spécifié est incorrect'
			);
    	} else {
			return $user;	
		}
	}    
}

?>