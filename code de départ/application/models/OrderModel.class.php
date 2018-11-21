<?php


class OrderModel
{

	public function addNewOrder(){
    	$database = new Database();

        $sql = 'SELECT MAX(Id) AS MaxID FROM `Order`';

        return $database->queryOne($sql);
    
    }

    public function validate($userId, array $items) {
    	
    	$database = new Database();

    	$sqlOrder = 'INSERT INTO `Orders`
            (User_Id, CreationTimestamp, TaxRate) 
            VALUES (?, NOW(), 20.0)';

         $orderId = $database->executeSql(
            $sqlOrder,
            [ $userId ]
        );

        $sqlOrderLine = 'INSERT INTO Orderline
       					 (Order_Id, Meal_Id, QuantityOrdered, PriceEach) 
        				 VALUES (?, ?, ?, ?)';
        				$totalAmount = 0;

        foreach($items as $item)
        {
            // Ajout du montant HT de la ligne du panier au montant total HT.
            $totalAmount += $item->quantity * $item->salePrice;

            // Insertion d'une ligne de commande dans la base de données.
            $database->executeSql(
                $sqlOrderLine,
                
                [
                    $orderId,
                    $item->mealId,
                    $item->quantity,
                    $item->salePrice
                ]
            );
        }

        $sqlUpdate = 'UPDATE `Orders`
                	  SET TotalAmount       = ?,
                    	  TaxAmount         = ? * TaxRate / 100
                	  WHERE Id = ?';

        $database->executeSql
        (
            $sqlUpdate,
            [
                $totalAmount,
                $totalAmount,
                $orderId
            ]
        );
    }

}



