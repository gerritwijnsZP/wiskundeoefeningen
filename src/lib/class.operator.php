<?php
require_once('class.math.php');
class Operatie
{
	public $naam;
	public $operator;
	public $waarden;
	public function __construct($naam, $op, $waarden=array())
	{
		$this->naam = $naam;
		$this->operator = $op;
		if(is_array($waarden))
		{
			$this->waarden = $waarden;
		}else{
			$this->waarden = array($waarden);
		}
	}
	public function __toString(): string
	{
		return implode($this->operator, array_map(strval, $this->waarden));
	}
	public function push($iets)
	{
		array_push($this->waarden, $iets);
	}
	public function solve()
	{
		return False;
	}
}
class Getal extends Operatie
{
	public function __construct($waarde)
	{
		$this->waarden 	= $waarde;
		$this->naam		= "getal";
		$this->operator = "";
	}
	public function __toString(): string
	{
		return $this->waarden;
	}
	public function solve()
	{
		return $this->waarden;
	}
}
class Plus extends Operatie
{
	public function __construct()
	{
		$this->naam = "Optellen";
		$this->operator = '+';
	}
	/*
	public function solve()
	{
		return call_user_func_array(array($this, "solve"), $this->waarden);
	}
	*/
}

$x = new Getal(2);
$y = new Getal(3);
$z = new Getal(4);
$plus = Plus();
$plus->push($x);
$plus->push($y);
$plus->push($z);
echo $plus;
//echo $plus->solve();

echo "The End";
?>