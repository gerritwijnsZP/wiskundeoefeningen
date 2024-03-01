<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,16);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$a			= nietnul(3, 10);
		$oef 		= array(
						array("opgave"=>"\\)een even getal\\(" , "oplossing"=>"2x" , "stamp"=> "11.1"),
						array("opgave"=>"\\)een oneven getal\\(" , "oplossing"=>"2x+1" , "stamp"=>"11.1" ),
						array("opgave"=>"\\)2 opeenvolgende even getallen\\(" , "oplossing"=>"2x, 2x+2" , "stamp"=>"11.2" ),
						array("opgave"=>"\\)2 opeenvolgende oneven getallen\\(" , "oplossing"=>"2x+1, 2x+3" , "stamp"=>"11.2" ),
						array("opgave"=>"\\) ".ntt($a)." keer een bedrag \\(" , "oplossing"=>"$a x" , "stamp"=> "11.3"),
						array("opgave"=>"\\)als ".ntt($a)." personen x euro betalen, hoeveel betalen ze dan samen? \\(" , "oplossing"=>"$a x" , "stamp"=>"11.3" ),
						array("opgave"=>"\\)een ".voud($a)." \\(" , "oplossing"=>"$a x" , "stamp"=>"11.3" ),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a			= nietnul(3, 10);
		$oef 		= array(
						array(	"opgave"=>"\\)2 opeenvolgende gehele getallen waarvan de grootste een ".voud($a)." is \\(" , 
								"oplossing"=>"$a x-1, $a x" , "stamp"=> "12.$a"),
						array(	"opgave"=>"\\)2 opeenvolgende gehele getallen waarvan de kleinste een ".voud($a)." is \\(" , 
								"oplossing"=>"$a x, $a x+1" , "stamp"=>"12.$a" ),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp	 	= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$a			= nietnul(1, 5);
		$b			= nietnulcopriem($a, $a+1, 10);
		$oef 		= array(
						array(	"opgave"=>"\\)als men van een bedrag ".breuken($a, $b)." uitgeeft, hoeveel heeft men dan nog over? \\(",
								"oplossing"=>"\\frac{".($b-$a)."x}{".$b."}"),
						array(	"opgave"=>"\\)de resterende inhoud van een fles als je er ".breuken($a, $b)." van hebt opgedronken?\\(" , 
								"oplossing"=>"\\frac{".($b-$a)."x}{".$b."}" ),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= "13.$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$a			= nietnul(3, 10);
		$b			= nietnulcopriem($a, 2, 10);
		$oef 		= array(
						array(	"opgave"=>"\\)een ".breuk($a)." van een bedrag \\(",
								"oplossing"=>"\\frac{x}{".$a."}", "stamp"=> "14.$a"),
						array(	"opgave"=>"\\) ".ntt($b)." minder dan een ".breuk($a)." van een getal \\(" , 
								"oplossing"=>"\\frac{x}{".$a."} - $b" , "stamp"=>"14.$a" ),
						array(	"opgave"=>"\\) ".ntt($b)." meer dan een ".breuk($a)." van een getal \\(" , 
								"oplossing"=>"\\frac{x}{".$a."} + $b" , "stamp"=>"14.$a" ),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= "14.$a";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	private function oef15() //een derde van een vierde van een bedrag
	{
		$a			= nietnul(3, 10);
		$b			= nietnul(3, 10);
		$oef 		= array(
						array(	"opgave"=>"\\) ".breuken(1, $a)." van ".breuken(1, $b)." van een bedrag \\(" , 
								"oplossing"=>"\\frac{1}{".$a."}.\\frac{x}{".$b."} = \\frac{x}{".($a*$b)."}" , "stamp"=> "15.$a$b"),
						array(	"opgave"=>"\\) ".ntt($a)." keer ".breuken(1, $b)." van een bedrag \\(" , 
								"oplossing"=>$a.".\\frac{x}{".$b."} = \\frac{".$a."x}{".$b."}" , "stamp"=> "15.$a$b"),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16()
	{
		$a			= nietnul(3, 10);
		$oef 		= array(
						array(	"opgave"=>"\\)2 opeenvolgende ".voud($a)."en \\(" , 
								"oplossing"=>"$a x, $a x+ $a" , "stamp"=> "16.$a"),
						array(	"opgave"=>"\\)3 opeenvolgende ".voud($a)."en \\(" , 
								"oplossing"=>"$a x, $a x+ $a, $a x+ ".(2*$a) , "stamp"=> "16.$a"),
					);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp	 	= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
