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
		
		$personen	= array("Wouter", "Maxim","Mohamed","Ayman");
		$cadeaus	= array("kerstcadeau voor een vriendin", "spelletje voor de PlayStation", "gouden Pokemonkaart","nieuwe batterij voor zijn smartphone","spidermanpak");
		
		$uitgave	= nietnul(22,60);
		$rest 		= nietnul(33,333);
		$totaal		= $uitgave + $rest;
		
		$iemand		= $personen[random_int(0,count($personen)-1)];
		$cadeau		= $cadeaus[random_int(0,count($cadeaus)-1)];
		
		$opgave 	= "\\text{".$iemand ." heeft ".$uitgave." euro uitgegeven aan een ".$cadeau.".} \\\\ \\text{Er is nu nog ".$rest." euro over.} \\\\  \\text{Hoeveel geld had ".$iemand." voor de aankoop?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing 	.= "	\\text{x is de hoeveelheid geld van ".$iemand." voor de aankoop} \\\\
						x - ".$uitgave." = ".$rest." \\\\
						\\Leftrightarrow x = ".$rest." + ".$uitgave." = ".$totaal." \\\\
						\\text{".$iemand." had ".$totaal." euro}";
		$stamp		= "11.$iemand.$cadeau";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		
		$personen	= array("Nihad", "Sarah","Jana","Loubna");
		$activiteiten	= array(
							array("activiteit"=>"zwemmen","tour"=>"baantje", "ww"=>"gezwommen", "factor"=>0.05),
							array("activiteit"=>"lopen","tour"=>"ronde", "ww"=>"gelopen", "factor"=>1),
							array("activiteit"=>"schaatsen","tour"=>"rondje", "ww"=>"geschaatst", "factor"=>0.5),
							array("activiteit"=>"fietsen","tour"=>"tourke", "ww"=>"gefietst", "factor"=>3),
						);
		$activiteit	= $activiteiten[random_int(0,count($activiteiten)-1)];
		$aantal		= nietnul(3,6);
		$afstand	= nietnul(4,8) * $activiteit["factor"];
		$totaal		= $aantal * $afstand;
		$iemand		= $personen[random_int(0,count($personen)-1)];
		
		$opgave 	= "\\text{".$iemand ." gaat ".$aantal." dagen in de week ".$activiteit["activiteit"].".} \\\\
						\\text{Ze doet elke keer hetzelfde aantal ".$activiteit["tour"]."s.} \\\\
						\\text{Aan het einde van de week heeft ze ".$totaal." km ".$activiteit["ww"].".} \\\\  
						\\text{Hoeveel km legt ze af per dag?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing 	.= "	\\text{x is het aantal km per ".$activiteit["tour"]."} \\\\
						".$aantal.".x = ".$totaal." \\\\
						\\Leftrightarrow x = \\frac{".$totaal."}{".$aantal."} = ".$afstand." \\\\
						\\text{".$iemand." legt ".$afstand." km af per ".$activiteit["tour"]."}";
		$stamp		= "12.".$iemand.$activiteit["activiteit"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		
		$personen	= array("Warinda", "Mila","Lina","Froukje");
		$redenen	= array(
						array("reden"=>"een kleedje te maken","eenheid"=>"meter", "object"=>"stof"),
						array("reden"=>"mee te nemen naar een feestje", "eenheid"=>"liter", "object"=>"frisdrank"),
						array("reden"=>"chocoladecakes te bakken","eenheid"=>"gram", "object"=>"chocolade"),
						//array("reden"=>"kettingen te maken met haar nichtjes", "eenheid"=>"zak(ken)", "object"=>"zak(ken) met kraaltjes"),
						);
		$totaal		= nietnul(36,88);
		$aantal 	= nietnul(3,7);
		$iemand		= $personen[random_int(0,count($personen)-1)];
		$reden		= $redenen[random_int(0,count($redenen)-1)];
		
		$opgave 	= "\\text{".$iemand ." heeft ".$aantal." ".$reden["eenheid"]." ".$reden["object"]." nodig om ".$reden["reden"].".} \\\\ 
					\\text{Ze heeft een budget van maximaal ".$totaal." euro.} \\\\  
					\\text{Hoeveel mag de ".$reden["object"]." per ".$reden["eenheid"]." maximaal kosten?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing 	.= "	\\text{x is maximale kost per ".$reden["object"]."} \\\\
						".$aantal.".x = ".$totaal." \\\\
						\\Leftrightarrow x = \\frac{".$totaal."}{".$aantal."} = ".round($totaal/$aantal, 2)." \\\\
						\\text{".$iemand." kan maximaal ".round($totaal/$aantal, 2)." euro uitgeven aan een ".$reden["eenheid"]." ".$reden["object"]."}";
		$stamp		= "13.$totaal.$aantal";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
}
?>
