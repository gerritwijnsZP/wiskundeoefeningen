<?php
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

if (!class_exists('Fabriek')) {
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,14);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		do {
			$A = rand(20,120);
			$B = rand(20,140-$A);
			$C = 180-$A-$B;
		} while ($C < 20);
		$a 		= rand(4,12);
		$b 		= round($a * sin(deg2rad($B)) / sin(deg2rad($A)), 1);
		$c 		= round($a * sin(deg2rad($C)) / sin(deg2rad($A)), 1);
		$cosA 	= max(-1, min(1, ($b*$b + $c*$c - $a*$a) / (2*$b*$c)));
		$cosB 	= max(-1, min(1, ($a*$a + $c*$c - $b*$b) / (2*$a*$c)));
		$A_uit 	= round(rad2deg(acos($cosA)), 2);
		$B_uit 	= round(rad2deg(acos($cosB)), 2);
		$C_uit 	= round(180 - $A_uit - $B_uit, 2);
		$opgave 	= "\\text{Driehoek }ABC\\text{ met }a=".$a.",\\ b=".$b.",\\ c=".$c."\\\\ \\text{Bereken alle hoeken.}";
		$oplossing	= "\\cos A = \\dfrac{b^2+c^2-a^2}{2bc} = \\dfrac{".$b."^2+".$c."^2-".$a."^2}{2\\cdot".$b."\\cdot".$c."} \\Rightarrow A = ".$A_uit."^\\circ \\\\";
		$oplossing	.= "\\cos B = \\dfrac{a^2+c^2-b^2}{2ac} = \\dfrac{".$a."^2+".$c."^2-".$b."^2}{2\\cdot".$a."\\cdot".$c."} \\Rightarrow B = ".$B_uit."^\\circ \\\\";
		$oplossing	.= "C = 180^\\circ - ".$A_uit."^\\circ - ".$B_uit."^\\circ = ".$C_uit."^\\circ";
		$stamp		= '11.'.$a.'.'.$b.'.'.$c;
		return new Oefening($this->titel, $opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		do {
			$C 	= rand(20,140);
			$a 	= rand(4,15);
			$b 	= rand(4,15);
		} while ($a == $b);
		$c 		= round(sqrt($a*$a + $b*$b - 2*$a*$b*cos(deg2rad($C))), 2);
		$sinA 	= max(-1, min(1, $a * sin(deg2rad($C)) / $c));
		$A_uit 	= round(rad2deg(asin($sinA)), 2);
		$B_uit 	= round(180 - $C - $A_uit, 2);
		$opgave 	= "\\text{Driehoek }ABC\\text{ met }a=".$a.",\\ b=".$b.",\\ C=".$C."^\\circ \\\\ \\text{Bereken zijde }c\\text{ en hoeken }A\\text{ en }B.";
		$oplossing	= "c^2 = a^2+b^2-2ab\\cos C = ".$a."^2+".$b."^2-2\\cdot".$a."\\cdot".$b."\\cdot\\cos(".$C."^\\circ) \\Rightarrow c = ".$c." \\\\";
		$oplossing	.= "\\sin A = \\dfrac{a\\cdot\\sin C}{c} = \\dfrac{".$a."\\cdot\\sin(".$C."^\\circ)}{".$c."} \\Rightarrow A = ".$A_uit."^\\circ \\\\";
		$oplossing	.= "B = 180^\\circ - ".$C."^\\circ - ".$A_uit."^\\circ = ".$B_uit."^\\circ";
		$stamp		= '12.'.$a.'.'.$b.'.'.$C;
		return new Oefening($this->titel, $opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		do {
			$A = rand(20,120);
			$B = rand(20,140-$A);
			$C = 180-$A-$B;
		} while ($C < 20);
		$c 		= rand(4,15);
		$a 		= round($c * sin(deg2rad($A)) / sin(deg2rad($C)), 2);
		$b 		= round($c * sin(deg2rad($B)) / sin(deg2rad($C)), 2);
		$opgave 	= "\\text{Driehoek }ABC\\text{ met }A=".$A."^\\circ,\\ B=".$B."^\\circ,\\ c=".$c."\\\\ \\text{Bereken hoek }C\\text{ en zijden }a\\text{ en }b.";
		$oplossing	= "C = 180^\\circ - ".$A."^\\circ - ".$B."^\\circ = ".$C."^\\circ \\\\";
		$oplossing	.= "a = \\dfrac{c\\cdot\\sin A}{\\sin C} = \\dfrac{".$c."\\cdot\\sin(".$A."^\\circ)}{\\sin(".$C."^\\circ)} = ".$a." \\\\";
		$oplossing	.= "b = \\dfrac{c\\cdot\\sin B}{\\sin C} = \\dfrac{".$c."\\cdot\\sin(".$B."^\\circ)}{\\sin(".$C."^\\circ)} = ".$b."";
		$stamp		= '13.'.$A.'.'.$B.'.'.$c;
		return new Oefening($this->titel, $opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		do {
			$A 		= rand(20,80);
			$b 		= rand(5,15);
			$a 		= rand(3,$b-1);
			$sinB 	= $b * sin(deg2rad($A)) / $a;
		} while ($sinB > 1 || $a == $b);
		$B1 	= round(rad2deg(asin($sinB)), 2);
		$B2 	= round(180 - $B1, 2);
		$C1 	= round(180 - $A - $B1, 2);
		$c1 	= round($a * sin(deg2rad($C1)) / sin(deg2rad($A)), 2);
		$opgave 	= "\\text{Driehoek }ABC\\text{ met }a=".$a.",\\ b=".$b.",\\ A=".$A."^\\circ \\\\ \\text{Bereken alle ontbrekende hoeken en zijde }c.";
		$oplossing	= "\\sin B = \\dfrac{b\\cdot\\sin A}{a} = \\dfrac{".$b."\\cdot\\sin(".$A."^\\circ)}{".$a."} = ".round($sinB,4)." \\\\";
		$oplossing	.= "\\textbf{Oplossing 1:}\\\\ B_1 = ".$B1."^\\circ,\\quad C_1 = 180^\\circ-".$A."^\\circ-".$B1."^\\circ = ".$C1."^\\circ \\\\";
		$oplossing	.= "c_1 = \\dfrac{".$a."\\cdot\\sin(".$C1."^\\circ)}{\\sin(".$A."^\\circ)} = ".$c1." \\\\";
		if ($A + $B2 < 180) {
			$C2 	= round(180 - $A - $B2, 2);
			$c2 	= round($a * sin(deg2rad($C2)) / sin(deg2rad($A)), 2);
			$oplossing	.= "\\textbf{Oplossing 2:}\\\\ B_2 = ".$B2."^\\circ,\\quad C_2 = 180^\\circ-".$A."^\\circ-".$B2."^\\circ = ".$C2."^\\circ \\\\";
			$oplossing	.= "c_2 = \\dfrac{".$a."\\cdot\\sin(".$C2."^\\circ)}{\\sin(".$A."^\\circ)} = ".$c2."";
		} else {
			$oplossing	.= "\\text{Oplossing 2 vervalt: } ".$A."^\\circ + ".$B2."^\\circ \\geq 180^\\circ";
		}
		$stamp		= '14.'.$a.'.'.$b.'.'.$A;
		return new Oefening($this->titel, $opgave, $oplossing, $stamp);
	}
}
}
?>