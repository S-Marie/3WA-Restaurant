<?php
class MealModel
{

	function listAll(){

		$meal = new Database();
		$sql = 'SELECT * FROM Meal';
		return $meal->query($sql);
	}

	 public function find($mealId)
    {
    	$database = new Database();
		$meal = $database->queryOne
        (
            "SELECT *
            FROM Meal
            WHERE Id = ?", [ $mealId ]
        );
        return $meal;
    }

    public function saveMeal($name, $description, $photo, $quantityInStock, $buyPrice, $salePrice){

        $database = new Database();

        $saveNewMeal = "INSERT INTO Meal
                        (Name, Description, Photo, QuantityInStock, BuyPrice, SalePrice)
                        VALUES (?, ?, ?, ?, ?, ?)";

        $database->executeSql(
            $saveNewMeal, [$name, $description, $photo, $quantityInStock, $buyPrice, $salePrice]
            );
    }
}

?>