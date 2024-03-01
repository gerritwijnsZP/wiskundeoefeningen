<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,15);
		return call_user_func(array($this,"oef".$i));
	}
	private function afgerond($waarde, $cijfers_na_komma = 3)
	{
		return puntkomma(round($waarde,$cijfers_na_komma));
	}
	private function oef11()
	{
		$b			= rand(2,18);
		$c			= rand(2,18);
		$a			= sqrt($b**2+$c**2);
		$B			= atan($b/$c)*180/pi();
		$C			= 90 - $B;
		$opgave		= "\\) 
							<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>
							<script>opgave(".$b.",".$c.", {b:".$b.", c:".$c."});</script>
						\\(";
		$oplossing	= " a = \\sqrt{".$b."^2+".$c."^2} \\approx ".$this->afgerond($a)." \\text{ (Pythagoras)} \\\\
						\\text{sin}(B)=\\frac{".$b."}{".$this->afgerond($a)."} \\Leftrightarrow B = \\text{arcsin}(\\frac{".$b."}{".puntkomma($a)."}) \\approx ".$this->afgerond($B)."=".DDtoDMS($B)."  \\text{ (Formule sinus)}\\\\
						\\text{sin}(C)=\\frac{".$c."}{".$this->afgerond($a)."} \\Leftrightarrow C = \\text{arcsin}(\\frac{".$c."}{".puntkomma($a)."}) \\approx ".$this->afgerond($C)."=".DDtoDMS($C)."  \\text{ (Formule sinus)}\\\\
						-----alternatief----\\\\
						\\text{tan}(B)=\\frac{".$b."}{".$c."} \\Leftrightarrow B = \\text{arctan}(\\frac{".$b."}{".$c."})\\approx ".$this->afgerond($B)."=".DDtoDMS($B)." \\text{ (Formule tangens)}\\\\
						\\text{tan}(C)=\\frac{".$c."}{".$b."} \\Leftrightarrow C = \\text{arctan}(\\frac{".$c."}{".$b."})\\approx ".$this->afgerond($C)."=".DDtoDMS($C)." \\text{ (Formule tangens)}\\\\
						-----controle-----\\\\
						B + C = 90^\\circ \\Leftrightarrow ".DDtoDMS($B)."+".DDtoDMS($C)." = 90^\\circ \\text{(Complementaire hoeken)}";
		$stamp		= "11.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a			= rand(4,18);
		$b			= rand(2,$a-1);
		$c			= sqrt($a**2-$b**2);
		$B			= asin($b/$a)*180/pi();
		$C			= 90 - $B;
		$opgave		= "\\) 
							<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>
							<script>opgave(".$b.",".$c.", {a:".$a.", b:".$b."});</script>
						\\(";
		$oplossing	= " c = \\sqrt{".$a."^2-".$b."^2} \\approx ".$this->afgerond($c)." \\text{ (Pythagoras)} \\\\
						\\text{sin}(B)=\\frac{".$b."}{".$a."} \\Leftrightarrow B = \\text{arcsin}(\\frac{".$b."}{".$a."})\\approx ".$this->afgerond($B)."=".DDtoDMS($B)." \\text{ (Formule sinus)}\\\\
						\\text{cos}(C)=\\frac{".$b."}{".$a."} \\Leftrightarrow C = \\text{arccos}(\\frac{".$b."}{".$a."})\\approx ".$this->afgerond($C)."=".DDtoDMS($C)." \\text{ (Formule cosinus)}\\\\
						-----controle-----\\\\
						B + C = 90^\\circ \\Leftrightarrow ".DDtoDMS($B)."+".DDtoDMS($C)." = 90^\\circ \\text{(Complementaire hoeken)}";
		$stamp		= "12.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$a			= rand(4,18);
		$c			= rand(2,$a-1);
		$b			= sqrt($a**2-$c**2);
		$C			= asin($c/$a)*180/pi();
		$B			= 90 - $C;
		$opgave		= "\\) 
							<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>
							<script>opgave(".$b.",".$c.", {a:".$a.", c:".$c."});</script>
						\\(";
		$oplossing	= " c = \\sqrt{".$a."^2-".$c."^2} \\approx ".$this->afgerond($b)." \\text{ (Pythagoras)} \\\\
						\\text{sin}(C)=\\frac{".$c."}{".$a."} \\Leftrightarrow C = \\text{arcsin}(\\frac{".$c."}{".$a."})\\approx ".$this->afgerond($C)."=".DDtoDMS($C)." \\text{ (Formule sinus)}\\\\
						\\text{cos}(B)=\\frac{".$c."}{".$a."} \\Leftrightarrow B = \\text{arccos}(\\frac{".$c."}{".$a."})\\approx ".$this->afgerond($B)."=".DDtoDMS($B)." \\text{ (Formule cosinus)}\\\\
						-----controle-----\\\\
						B + C = 90^\\circ \\Leftrightarrow ".DDtoDMS($B)."+".DDtoDMS($C)." = 90^\\circ \\text{(Complementaire hoeken)}";
		$stamp		= "13.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$a			= rand(9,21);
		$B_gr		= rand(25,65);
		$B			= $B_gr * pi() / 180;
		$C_gr		= 90 - $B_gr;
		$C			= $C_gr / 180 * pi();
		$b			= $a * sin($B);
		$c			= $a * sin($C);
		$opgave		= "\\) 
							<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>
							<script>opgave(".$b.",".$c.", {a:".$a.", B:".$B_gr."});</script>
						\\(";
		$oplossing	= " C = 90^\\circ - B = ".$C_gr."^\\circ \\\\";
		$oplossing .= "\\text{sin}(B) = \\dfrac{b}{".$a."} \\Leftrightarrow b = ".$a.".\\text{sin}(".$B_gr."^\\circ) \\approx ".$this->afgerond($b). "\\\\";
		$oplossing .= "\\text{cos}(B) = \\dfrac{c}{".$a."} \\Leftrightarrow c = ".$a.".\\text{cos}(".$B_gr."^\\circ) \\approx ".$this->afgerond($c);
		$stamp		= "14.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15()
	{
		$a			= rand(9,21);
		$B_gr		= rand(25,65);
		$B			= $B_gr * pi() / 180;
		$C_gr		= 90 - $B_gr;
		$C			= $C_gr / 180 * pi();
		$b			= $a * sin($B);
		$c			= $a * sin($C);
		$opgave		= "\\) 
							<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>
							<script>opgave(".$b.",".$c.", {a:".$a.", C:".$C_gr."});</script>
						\\(";
		$oplossing	= " B = 90^\\circ - C = ".$B_gr."^\\circ \\\\";
		$oplossing .= "\\text{sin}(C) = \\dfrac{c}{".$a."} \\Leftrightarrow c = ".$a.".\\text{sin}(".$C_gr."^\\circ) \\approx ".$this->afgerond($c). "\\\\";
		$oplossing .= "\\text{cos}(C) = \\dfrac{b}{".$a."} \\Leftrightarrow b = ".$a.".\\text{cos}(".$C_gr."^\\circ) \\approx ".$this->afgerond($b);
		$stamp		= "15.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
<script src="/public/scripts/goniometrie.js"></script>
