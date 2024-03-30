<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$a			= nietnul(3, 9);
		$b			= nietnul(3, 9);
		$var1		= array("a","b","c","d","x","y","z");
		$var2		= array("p","q","r","s");
		$x			= $var1[rand(0,6)];
		$y			= $var2[rand(0,3)];
		$oef		= array( 
						array(
							"opgave" => "\\) ".ntt($a)." meer dan een ".breuk($b)." van $x \\(",
							"oplossing" => "\\frac{1}{$b}.$x+$a"),
						array(
							"opgave" => "\\) de som van een ".breuk($b)." van $x en $a \\(",
							"oplossing" => "\\frac{1}{$b}.$x+$a"),
						array(
							"opgave" => "\\) ".ntt($a)." minder dan een ".breuk($b)." van $x \\(",
							"oplossing" => "\\frac{1}{$b}.$x-$a"),
						array(
							"opgave" => "\\) het verschil van een ".breuk($b)." van $x en $a \\(",
							"oplossing" => "\\frac{1}{$b}.$x-$a"),
						array(
							"opgave" => "\\) ".ntt($a)." meer dan een ".voud($b)." van $x \\(",
							"oplossing" => "$b.$x+$a"),
						array(
							"opgave" => "\\) de som van een ".voud($b)." van $x en $a \\(",
							"oplossing" => "$b.$x+$a"),
						array(
							"opgave" => "\\) ".ntt($a)." minder dan een ".voud($b)." van $x \\(",
							"oplossing" => "$b.$x-$a"),
						array(
							"opgave" => "\\) het verschil van een ".voud($b)." van $x en $a \\(",
							"oplossing" => "$b.$x-$a"),
						array(
							"opgave" => "\\) een ".breuk($a)." van een ".breuk($b)." van $x \\(",
							"oplossing" => "\\frac{1}{$a}.\\frac{1}{$b}.$x"),
						array(
							"opgave" => "\\) $a keer de som van $x en $b \\(",
							"oplossing" => "$a.($x+$b)"),
						array(
							"opgave" => "\\) $a keer ".ntt($b)." meer dan $x \\(",
							"oplossing" => "$a.($x+$b)"),
						array(
							"opgave" => "\\) $a keer ".ntt($b)." minder dan $x \\(",
							"oplossing" => "$a.($x-$b)"),
						array(
							"opgave" => "\\) een ".breuk($a)." van de som van $x en $b \\(",
							"oplossing" => "\\frac{1}{$a}.($x+$b)"),
						array(
							"opgave" => "\\) een ".breuk($a)." van ".ntt($b)." meer dan $x \\(",
							"oplossing" => "\\frac{1}{$a}.($x+$b)"),
						array(
							"opgave" => "\\) een ".breuk($a)." van ".ntt($b)." minder dan $x \\(",
							"oplossing" => "\\frac{1}{$a}.($x-$b)"),
						
						array(
							"opgave" => "\\) de som van een ".voud($a)." van $x en $b \\(",
							"oplossing" => "$a.$x+$b"),
						array(
							"opgave" => "\\) de som van een ".breuk($a)." van $x en $b \\(",
							"oplossing" => "\\frac{1}{$a}.$x+$b"),
						
						array(
							"opgave" => "\\) het verschil van een ".voud($a)." van $x en $b \\(",
							"oplossing" => "$a.$x-$b"),
						array(
							"opgave" => "\\) het verschil van een ".breuk($a)." van $x en $b \\(",
							"oplossing" => "\\frac{1}{$a}.$x-$b"),
							
						array(
							"opgave" => "\\) ".ntt($b)." meer dan een ".voud($a)." van $x \\(",
							"oplossing" => "$a.$x+$b"),
						array(
							"opgave" => "\\) ".ntt($b)." meer dan een ".breuk($a)." van $x \\(",
							"oplossing" => "\\frac{1}{$a}.$x+$b"),
						array(
							"opgave" => "\\) ".ntt($b)." minder dan een ".voud($a)." van $x\\(",
							"oplossing" => "$a.$x-$b"),
						array(
							"opgave" => "\\) ".ntt($b)." minder dan een ".breuk($a)." van $x\\(",
							"oplossing" => "\\frac{1}{$a}.$x-$b"),
						);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $a.$b.$x;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
