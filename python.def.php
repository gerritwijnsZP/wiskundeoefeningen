<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 17 e.v
	private function oef11()
	{
		$letters = array(array("a","b","c"),array("p","q","r"),array("x","y","z"))[rand(0,2)];
		$x 		= $letters[0];
		$y		= $letters[1];
		$z		= $letters[2];
		$hoofdletter = array("T","I","F","R","Z","D")[rand(0,5)];
		$a		= nietnul(2,10);
		$b		= copriem($a);
		$c		= copriem($b);
		$data	= array("L"=>$hoofdletter, "a"=>$a, "b"=>$b, "c"=>$c, "x"=>$x, "y"=>$y,"z"=>$z,"def"=>"\\textbf{def }","return"=>"\\textbf{return }");
		$formules = array(
						array("L=ax+by","def &L(x,y):\\\\ & return a*x+b*y"),
						array("L=ax+b","def &L(x):\\\\ & return a*x+b"),
						array("L=ax-by+c","def &L(x,y):\\\\ & return a*x-b*y+c"),
						array("L=axy+cz","def &L(x,y,z):\\\\ & return a*x*y+c*z"),
						array("L=ax+by+cz","def &L(x,y,z):\\\\ & return a*x+b*y+c*z"),
						array("L=axyz+b","def &L(x,y,z):\\\\ & return a*x*y*z+b"),
					)[rand(0,5)];
		
		$opgave 	= strReplaceAssoc($data, $formules[0]);
		$oplossing	= $opgave."\\\\ \\begin{align} ".strReplaceAssoc($data,$formules[1])."\\end{align}";
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
