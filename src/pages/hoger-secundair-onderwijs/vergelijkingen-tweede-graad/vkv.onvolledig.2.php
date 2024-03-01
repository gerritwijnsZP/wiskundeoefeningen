<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
//require_once(LIB . "class.rational.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a	= nietnul(-8,8);
		$b 	= rand(-25,25);
		$meta = $this->metamorfose($a,$b);
		$opgave = $meta["opgave"];
		$uitwerking = $meta["uitwerking"];
		
		$oplossing = $opgave . " \\\\ ";
		if($uitwerking){$oplossing .= " \Leftrightarrow ".$uitwerking . " \\\\ ";}
		
		//Default
		if($b==0)
		{
			$oplossing .= "	\\Leftrightarrow ".p($a,1).'x^2'."=0 \\\\
							\\Leftrightarrow x^2 = \\frac{".($b)."}{".$a."} \\\\
							\\Leftrightarrow x = 0 ";
		}else{
			$oplossing .= "
				\\Leftrightarrow ". 'x'."(".p($a,1).'x'.p($b,2).") = 0 \\\\
				\\Leftrightarrow "." x = 0 \\vee ".p($a,1).'x'.p($b,2)."=0 \\\\ 
				\\Leftrightarrow "." x = 0 \\vee x = \\frac{".(-$b)."}{".$a."} ";
			$g = abs(ggd($a,$b));
			$kuis = False;
			if($a < 0){$a *= -1; $b *= -1; $kuis = True;} //noemer tekenvrij
			$res = "\\frac{".(-$b/$g)."}{".($a/$g)."}";
			if($a/$g == 1){ $res = -$b/$g; $oplossing .= "= ".$res;}
			elseif($g != 1 or $kuis){$oplossing .= "= ".$res;}
		}		
		if($b < 0){
			$oplossing .= " \\\\ V = \\Big\\{  ".$res."; 0 \\Big\\}";
		}elseif($b == 0){
			$oplossing .= " \\\\ V = \\Big\\{  0 \\Big\\}";
		}else{
			$oplossing .= " \\\\ V = \\Big\\{ 0 ; ".$res." \\Big\\}";
		}
		$oplossing .= " \\\\ -----------------";
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	function metamorfose($a, $b)
	{
		$p = array(-1,1)[rand(0,1)] * nietgetal(2, 10, array(abs($a)));
		$q = array(-1,1)[rand(0,1)] * nietgetal(2, 10, array(abs($b)));
		$f = array(-1,1)[rand(0,1)] * rand(2,5);
		$mogelijkheden = array(
							array(	"opgave"=> p($a,1).'x^2'.p($b,2)."x=0", //basis
									"uitwerking" => ""
								),
							array(	"opgave"=> p($a+$p,1).'x^2'.p($b-$q,0).'x'."=".p($p,1).'x^2'.p(-$q,0).'x',
									"uitwerking" => p($a,1).'x^2'.p($b,2)."x=0"
								),
							array(	"opgave"=> p($f,1)."(".p($p,1)."x^2".p($q,0)."x)=-(".p($a-$f*$p,1).'x^2'.p(-$b-$f*$q,0)."x)",
									"uitwerking" => p($f*$p,1).'x^2'.p($f*$q,0)."x=".p($f*$p-$a,1).'x^2'.p($b+$f*$q,0). "x \\\\
										\Leftrightarrow ".p($f*$p,1).'x^2'.p($f*$q,0)."x".p(-($f*$p-$a),0).'x^2'.p(-($b+$f*$q),0). "x= 0 \\\\
										\Leftrightarrow ".p($a,1).'x^2'.p($b,2)."x=0"
								),	
							);
		return $mogelijkheden[rand(0, count($mogelijkheden)-1)];
	}
	
}
?>
