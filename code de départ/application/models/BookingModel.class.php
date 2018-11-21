<?php

class BookingModel
{

	public function booking($reservedDate, $reservedHour, $seatNumber, $userId)
	{
		$sql = new Database();
		$booked = 'INSERT INTO Réservation
		(ReservedDate, ReservedHour, SeatNumber, User_Id)
		VALUES (?, ?, ?, ?)';
		$sql->executeSql($booked, [$reservedDate, $reservedHour, $seatNumber, $userId]);
	}

}

?>