<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function namen($niet=array())
	{
		$namen 		= array("Rojin","Roukaya","Imane","Inaya","Rana",
						"Dina","Ilias","Nabil","Zaid","Robin",
						"Bilal","Farah","Anissa","Nada", "Sofiane");
		$gekuist	= array_diff($namen, $niet);
		$sleutel	= array_rand($gekuist, 1);
		//print_r($sleutel . $gekuist[$sleutel]);
		return $gekuist[$sleutel];
	}
	private function oef11()
	{	//Krachten samenstellen
		$persoon1	= $this->namen();
		$persoon2	= $this->namen(array($persoon1));
		$a			= nietnul(3, 10);
		$b			= nietgetal(3, 10, array($a));
		$hoek		= 45;
		$a	*= 100; $b *= 100;
		$opgaves	= array(
							array("opgave"=>"\\)$persoon1 en $persoon2 trekken aan weerszijden van een winkelkar. 
											$persoon1 trekt met een kracht van $a N, $persoon2 met een kracht van $b N. 
											Teken en bepaal de resulterende kracht\\(",
									"oplossing"=> "\\leftarrow F_{".$persoon1."} = $a N ; F_{".$persoon2."} = $b N \\rightarrow
													\\\\F_R = $b N - $a N = ".($b - $a)." N 
													\\\\ \\text{De kar beweegt met een resulterende kracht van ".abs($a-$b)." N naar ".($a > $b ? $persoon1 : $persoon2)." toe}",
									"stamp"=>"0.$a.$b"
							),
							array("opgave"=>"\\)Een winkelkar wordt geduwd door $persoon1 met een kracht van $a N. 
											$persoon2 staat aan de andere kant van de kar en trekt met een kracht van $b N. 
											Teken en bepaal de resulterende kracht\\(",
									"oplossing"=> "\\rightarrow F_{".$persoon1."} = $a N ; F_{".$persoon2."} = $b N \\rightarrow
													\\\\F_R = $a N + $b N = ".($a + $b)." N 
													\\\\ \\text{De kar beweegt met een resulterende kracht van ".abs($a+$b)." N naar $persoon2 toe}",
									"stamp"=>"1.$a.$b"
							),
							array("opgave"=>"\\)Een winkelkar wordt getrokken door $persoon1 met een kracht van $a N. 
											$persoon2 trekt onder een hoek van 45° met een kracht van $b N. 
											Teken en bepaal de resulterende kracht\\(",
									"oplossing"=> "\\rightarrow F_{".$persoon1."} = $a N ; F_{".$persoon2."} = $b N \\nearrow
													\\\\ \\text{De kar beweegt met een resulterende kracht van ongeveer ".puntkomma(round(sqrt( pow($a + $b / sqrt(2), 2) + pow($b,2)/2 ),-1))." N (o.b.v. schets) }",
									"stamp"=>"2.$a.$b"
							),
							array("opgave"=>"\\)Een winkelkar wordt getrokken door $persoon1 met een kracht van $a N. 
											$persoon2 trekt onder een hoek van 90° met een kracht van $b N. 
											Teken en bepaal de resulterende kracht\\(",
									"oplossing"=> "\\rightarrow F_{".$persoon1."} = $a N ; F_{".$persoon2."} = $b N \\uparrow
													\\\\F_R = ".vkw("$a^2 + $b^2")." N  \\text{(Pythagoras)}
													\\\\ \\text{De kar beweegt met een resulterende kracht van (afgerond) ".puntkomma(round(sqrt(pow($a,2)+pow($b,2)),1))." N }",
									"stamp"=>"3.$a.$b"
							),
					);
		$oefening	= $opgaves[rand(0,count($opgaves)-1)];
		$opgave		= $oefening["opgave"];
		$oplossing = $oefening["oplossing"];	
		$stamp		= "11.".$oefening["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	//Zwaartekracht
		$planeten	= array(
						array("naam"=>"Mercurius","g"=>2.78),
						array("naam"=>"Venus","g"=>8.6),
						array("naam"=>"Aarde","g"=>9.81),
						array("naam"=>"de maan","g"=>1.62),
						array("naam"=>"Mars","g"=>3.72),
						array("naam"=>"Jupiter","g"=>22.9),
						array("naam"=>"Saturnus","g"=>9.05),
						array("naam"=>"Uranus","g"=>7.77),
						array("naam"=>"Neptunus","g"=>11.0),
						);
		$i		= rand(0, count($planeten)-1);
		$planeet_data	= $planeten[$i];
		$j		= nietgetal(0, count($planeten)-1, array($i));
		$planeet	= $planeet_data['naam'];
		$g			= $planeet_data['g'];
		$planeet_data2	= $planeten[$j];
		$planeet2	= $planeet_data2['naam'];
		$g2			= $planeet_data2['g'];
		$massa		= rand(2,20);
		$Fz			= $massa * $g;
		$Fz2		= $massa * $g2;
		$opgaves	= array(
							array("opgave"=>"\\)Op $planeet (g = ".puntkomma($g)." N/kg) ondervindt een voorwerp een zwaartekracht van ".puntkomma($Fz)." N.
								Bereken de massa van het voorwerp. \\(",
									"oplossing"=>"m = \\dfrac{F_Z}{g} = \\dfrac{".puntkomma($Fz)."N}{".puntkomma($g)." N/kg} = $massa kg
									\\\\ \\text{De massa van het voorwerp is $massa kg}",
									"stamp"=>"0.$massa.$g"
							),
							array("opgave"=>"\\)Welke zwaartekracht ondervindt een voorwerp van $massa kg op $planeet (g = ".puntkomma($g)." N/kg)? \\(",
									"oplossing"=>"F_Z = m . g = ($massa kg) . (".puntkomma($g)." N/kg) = ".puntkomma($massa * $g)."N
									\\\\ \\text{De zwaartekracht die het voorwerp ondervindt op $planeet is ".puntkomma($massa * $g)."N }",
									"stamp"=>"1.$massa.$g"
							),
							array("opgave"=>"\\)Op $planeet (g = ".puntkomma($g)." N/kg) ondervindt een voorwerp een zwaartekracht van ".puntkomma($Fz)." N.
								Bereken de zwaartekracht van het voorwerp op $planeet2 (g = ".puntkomma($g2)." N/kg). \\(",
									"oplossing"=>"m = \\dfrac{F_Z}{".puntkomma($g2)." N/kg} = \\dfrac{".puntkomma($Fz)." N}{".puntkomma($g)." N/kg}
									\\\\ \\Leftrightarrow F_Z = \\dfrac{".puntkomma($Fz)." N .".puntkomma($g2)." N/kg}{".puntkomma($g)." N/kg} = ".puntkomma($massa * $g2)."N
									\\\\ \\text{De zwaartekracht die het voorwerp ondervindt op $planeet2 is ".puntkomma($massa * $g2)."N }",
									"stamp"=>"2.$massa.$g"
							),
					);
		$oefening	= $opgaves[rand(0,count($opgaves)-1)];
		$opgave		= $oefening["opgave"];
		$oplossing = $oefening["oplossing"];	
		$stamp		= "12.".$oefening["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$k	= rand(2,13); //veerconstante N/m
		$dl	= rand(1,99) * 0.1; //m
		$eenh	= array(3=>'mm',2=>'cm',1=>'dm',0=>'m');
		$i	= rand(0,3);
		$Fv	= $k * $dl; //Fv N
		$opgaves	= array(
							array(	"opgave"	=>"\\)Een veer verlengt ".puntkomma($dl*pow(10,$i))." ".$eenh[$i]." 
													en ondervindt een veerkracht van ".puntkomma($Fv)." N.
													Wat is de veerconstante? \\(",
									"oplossing"	=>"F_V = k . \\Delta l
													\\\\ \\Leftrightarrow k = \\dfrac{F_V}{\\Delta l} = \\dfrac{".puntkomma($Fv)."N}{".puntkomma($dl)."m}
													= ".puntkomma($Fv / $dl)." N/m
													\\\\ \\text{De veerconstante is ".puntkomma($Fv / $dl)." N/m}",
									"stamp"		=>"0.$k.$dl"
							),
							array(	"opgave"	=>"\\)Een veer (k = $k N/m) verlengt ".puntkomma($dl*pow(10,$i))." ".$eenh[$i]." .
													Wat is de veerkracht? \\(",
									"oplossing"	=>"F_V = k . \\Delta l
													\\\\ \\Leftrightarrow F_V = ($k N/m ) . (".puntkomma($dl)." m) = ".puntkomma($Fv)."N
													\\\\ \\text{De veerkracht is ".puntkomma($Fv)."N}",
									"stamp"		=>"1.$k.$dl"
							),
							array(	"opgave"	=>"\\)Een veer (k = $k N/m) ondervindt een veerkracht van ".puntkomma($Fv)." N.
													Hoeveel ".$eenh[$i]." rekt zij uit? \\(",
									"oplossing"	=>"F_V = k . \\Delta l
													\\\\ \\Leftrightarrow \\Delta l = \\dfrac{".puntkomma($Fv)." N}{".$k." N/m} = ".puntkomma($dl)."m ".($i > 0 ? ("=".puntkomma($dl*pow(10,$i))." ".$eenh[$i]) : "")."
													\\\\ \\text{De veer rekt ".puntkomma($dl*pow(10,$i))." ".$eenh[$i]." uit}",
									"stamp"		=>"2.$k.$dl"
							),
						);
		$oefening	= $opgaves[rand(0,count($opgaves)-1)];
		$opgave		= $oefening["opgave"];
		$oplossing = $oefening["oplossing"];	
		$stamp		= "13.".$oefening["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
