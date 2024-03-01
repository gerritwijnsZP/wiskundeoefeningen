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

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 17 e.v
	private function oef11()
	{
		$letter = array("a","b","c","p","q","x","y")[rand(0,6)];
		$a 		= nietnul(-4,4);
		$b		= nietnul(-8,8);
		$c		= nietnul(-2,2);
		$opgave 	= p($a,1).$letter.p($b,0).$letter."^2".p($c,0).$letter;
		$oplossing	= "\\begin{align} ".$opgave;
		$oplossing	.= "&=".$a.".".$letter.p($b,2).".".$letter."^2".p($c,2).".".$letter."\\\\";
		$oplossing	.= "&=".$a.".".$letter.p($c,2).".".$letter.p($b,2).".".$letter."^2\\\\";
		$oplossing	.= "&=".p($a+$c,1).$letter.p($b,0).$letter."^2\\\\";
		if($a+$c==0){$oplossing	.= " &=".p($b,1).$letter."^2";}
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '11.'.$a.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$letters = array(array("a","b"),array("p","q"),array("x","y"),array("x","xy"),array("xy","y"))[rand(0,4)];
		$x = $letters[0];
		$y = $letters[1];
		$a 		= nietnul(-2,2);
		$b		= nietnul(-3,3);
		$c		= nietnul(-4,4);
		$d		= nietnul(-4,4);
		$e		= nietnul(-2,2);
		$opgave 	= p($a,1).$x.p($b,0).$y.p($c,0).$x.p($d,0).$y.p($e,0).$x;
		$oplossing	= "\\begin{align}". $opgave;
		$oplossing	.= "&=".$a.".".$x.p($b,2).".".$y.p($c,2).".".$x.p($d,2).".".$y.p($e,2).".".$x."\\\\";
		$oplossing	.= "&=".$a.".".$x.p($c,2).".".$x.p($e,2).".".$x.p($b,2).".".$y.p($d,2).".".$y."\\\\";
		$oplossing	.= "&=".p($a+$c+$e,1).$x.p($b+$d,0).$y."\\\\";
		
		if($a+$c+$e==0 && $b+$d==0 ){$oplossing	.= "&=0";}
		elseif($a+$c+$e==0){$oplossing	.= "&=".p($b+$d,1).$y;}
		elseif($b+$d==0){$oplossing	.= "&=".p($a+$c+$e,1).$x;}
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '12.'.$a.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$letters = array(array("a","b"),array("p","q"),array("x","y"),array("x","xy"),array("xy","y"))[rand(0,4)];
		$x = $letters[0];
		$y = $letters[1];
		$a 		= nietnul(-2,2);
		$b		= nietnul(-3,3);
		$c		= nietnul(-4,4);
		$d		= nietnul(-4,4);
		$opgave 	= p($a,1).$x.p($b,0).$y.p($c,0).$x.p($d,0).$y;
		$oplossing	= "\\begin{align}". $opgave;
		$oplossing	.= "&=".$a.".".$x.p($b,2).".".$y.p($c,2).".".$x.p($d,2).".".$y."\\\\";
		$oplossing	.= "&=".$a.".".$x.p($c,2).".".$x.p($b,2).".".$y.p($d,2).".".$y."\\\\";
		$oplossing	.= "&=".p($a+$c,1).$x.p($b+$d,0).$y."\\\\";
		
		if($a+$c==0 && $b+$d==0 ){$oplossing	.= "&=0";}
		elseif($a+$c==0){$oplossing	.= "&=".p($b+$d,1).$y;}
		elseif($b+$d==0){$oplossing	.= "&=".p($a+$c,1).$x;}
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '13.'.$a.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
