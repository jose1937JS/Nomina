<?php 

class Conexion 
{	//clase conexion la cual define los parametro de entrada
	const DB_LOCAL = 'localhost';
	const DB_NAME = 'nomina';
	const DB_USER = 'root';
	const DB_PASWOR = 'root';

	public static function enlace()
	{
		return new mysqli(self::DB_LOCAL,self::DB_USER,self::DB_PASWOR,self::DB_NAME);
	}

		

}

?>