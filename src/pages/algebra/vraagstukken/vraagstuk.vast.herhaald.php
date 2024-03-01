<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$items		= array(
							array("naam"=>"tandpasta","container"=>"tube","mv"=>"tubes"),
							array("naam"=>"chips","container"=>"zak","mv"=>"zakken"),
							array("naam"=>"skittles","container"=>"zakje","mv"=>"zakjes"),
							array("naam"=>"tandflos","container"=>"rolletje","mv"=>"rolletjes"),
						);
		$item		= $items[random_int(0,count($items)-1)];
		$prijs		= random_int(6,12)*0.25;
		$korting	= random_int(2,7)*0.25;
		$aantal 	= random_int(2,5);
		$totaal		= $aantal*$prijs-$korting;
		
		$opgave 	= "\\text{ In de supermarkt krijgt je korting op ".$item["naam"]."}\\\\";
		$opgave 	.="\\text{ Bij aankoop van ".ntt($aantal)." ".$item["mv"]. " ".$item["naam"]." krijg je $korting euro korting en betaal je slechts $totaal euro.} \\\\";
		$opgave 	.="\\text{ Bereken de prijs van een ".$item["container"]." ".$item["naam"]." zonder korting.}";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is de prijs van ".$item["naam"]." zonder korting} \\\\
						\\color{red}{ $aantal . x - $korting = $totaal} \\\\
						\\Leftrightarrow $aantal . x = $totaal + $korting = ".($totaal + $korting)." \\\\
						\\Leftrightarrow x = $prijs \\\\
						\\text{De prijs van een ".$item["container"]." ".$item["naam"]." zonder korting is $prijs euro.}";
		$stamp		= "11.".$item["naam"].$totaal;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$personen	= array("Mariam","Nada","Noor","Oumaima","Mila","Lore","Lotte","Chemse","Alysia","Drieka","Laura","Jitte","Lina","Kiara","Rowenn");
		$i			= random_int(0,count($personen)-1);
		$j			= nietgetal(0,count($personen)-1, array($i));
		$iemandA	= $personen[$i];
		$iemandB	= $personen[$j];
		$items		= array(
							array("naam"=>"kampeerplaats","vast"=>"de standplaats","variabel"=>"water en elektriciteit", "fvast"=>20, "fvar"=>5),
							array("naam"=>"hotelkamer","vast"=>"het zwembad","variabel"=>"het verblijf en de maaltijden","fvast"=>5,"fvar"=>40),
						);
		$item		= $items[random_int(0,count($items)-1)];
		$variabel	= random_int(2,8)*$item["fvar"];
		$vast		= random_int(4,9)*$item["fvast"];
		$aantal		= random_int(5,20);
		$totaal		= $aantal*$variabel+$vast;
		
		$opgave 	= "\\text{ $iemandA en $iemandB gaan samen op reis en reserveren een ".$item["naam"]."}\\\\
						\\text{Voor ".$item["vast"]." betalen ze eenmaal $vast euro.} \\\\
						\\text{Per dag moeten ze ook $variabel euro betalen voor ".$item["variabel"]."}\\\\
						\\text{Bij hun vertrek betaalden ze $totaal euro.}\\\\
						\\text{Hoeveel dagen verbleven $iemandA en $iemandB daar?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is het aantal dagen} \\\\
						\\color{red}{ $variabel . x + $vast = $totaal} \\\\
						\\Leftrightarrow $variabel . x = $totaal - $vast = ".($totaal - $vast)." \\\\
						\\Leftrightarrow x = $aantal \\\\
						\\text{Ze verbleven er $aantal dagen.}";
		$stamp		= "12.$iemandA.$iemandB";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$personen	= array("Mariam","Nada","Noor","Oumaima","Mila","Lore","Lotte","Chemse","Alysia","Drieka","Laura","Jitte","Lina","Kiara","Rowenn");
		$i			= random_int(0,count($personen)-1);
		$iemand		= $personen[$i];
		$items		= array(
							"strips","boeken","smartphonehoesjes"
						);
		$item		= $items[random_int(0,count($items)-1)];
		$prijs		= random_int(5,10)+0.95;
		$aantal		= random_int(5,20);
		$verzendkosten = random_int(7,15)*0.5;
		$totaal		= $aantal*$prijs+$verzendkosten;
		
		$opgave 	= "\\text{ $iemand bestelt $aantal (even dure) $item online en betaalt hiervoor $totaal euro.}\\\\
						\\text{De verzendingskosten van $verzendkosten euro zijn inbegrepen.} \\\\
						\\text{Hoeveel kost een van de $item ?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is de kostprijs voor slechts een van de $item} \\\\
						\\color{red}{ $aantal . x + $verzendkosten = $totaal} \\\\
						\\Leftrightarrow $aantal . x = $totaal - $verzendkosten = ".($totaal - $verzendkosten)." \\\\
						\\Leftrightarrow x = $prijs \\\\
						\\text{De kostprijs is $prijs euro.}";
		$stamp		= "13.$iemand";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
