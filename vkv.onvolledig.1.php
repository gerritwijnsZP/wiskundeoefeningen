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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$x1 = rand(1,15);
		if(rand(0,7)==0){ $x1 = 0;} //Op vraag van Juanita, kans op x = 0 verhogen tot 1/8
		$x	= array(1,-1,1)[rand(0,2)]*$x1*$x1;
		$a	= nietnul(-8,8);
		$c 	= $a * $x;
		$meta = $this->metamorfose($a,$c);
		$opgave = $meta["opgave"];
		$uitwerking = $meta["uitwerking"];
		
		$oplossing = $opgave . " \\\\ ";
		if($uitwerking){$oplossing .= " \Leftrightarrow ".$uitwerking . " \\\\ ";}
		
		//Default
		$oplossing .= "
			\\Leftrightarrow ". p($a,1)."x^2 				 = ".$c. " \\\\
			\\Leftrightarrow "."		 x^2 				 = \\frac{".$c."}{".$a. "}";
		if($x < 0)
		{
			$oplossing .= " 		< 0 \\\\ 
			V = \\varnothing";
		}elseif($x == 0){
			$oplossing .= "\\\\ 
			\\Leftrightarrow x = 0 \\\\
			V = \\Big\\{ 0 \\Big\\}";
		}else{
			$oplossing .= "=".$x." \\\\
			\Leftrightarrow  x  = ".$x1." \\vee x = ".(-$x1)." \\\\
			V = \\Big\\{".(-$x1).", ". $x1." \\Big\\}";
		}
		$oplossing .= " \\\\ -----------------";
		$stamp		= "$a.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	function metamorfose($a, $c)
	{
		$p = array(-1,1)[rand(0,1)] * nietgetal(2, 10, array(abs($a)));
		$q = array(-1,1)[rand(0,1)] * nietgetal(2, 10, array(abs($c)));
		$f = array(-1,1)[rand(0,1)] * rand(2,5);
		$mogelijkheden = array(
							array(	"opgave"=> p($a,1).'x^2'.p(-$c,2)."=0", //basis
									"uitwerking" => ""
								),
							array(	"opgave"=> p($a+$p,1).'x^2'.p(-$c-$q,2)."=".p($p,1).'x^2'.p(-$q,2),
									"uitwerking" => p($a+$p,1).'x^2'.p(-$p,0).'x^2'."=".(-$q).p($c+$q,2)
								),
							array(	"opgave"=> p($f,1)."(".p($p,1)."x^2".p($q,2).")=-(".p($a-$f*$p,1).'x^2'.p(-$c-$f*$q,2).")",
									"uitwerking" => p($f*$p,1).'x^2'.p($f*$q,2)."=".p($f*$p-$a,1).'x^2'.p($c+$f*$q,2). " \\\\
										\Leftrightarrow ".p($f*$p,1).'x^2'.p($a-$f*$p,0).'x^2'."=".($c+$f*$q).p(-$f*$q,2)
								),	
							//$this->breuk1($a,$c)
							);
		return $mogelijkheden[rand(0, count($mogelijkheden)-1)];
	}
	function breuk1($a, $c)
	{
		$nmr = ggd($a,$c)*rand(2,5);
		$f	= abs(ggd($a,$c))+1; if($f == 1){$f = -1;}
		if(-$c*$f < 0){$teken = '-';}else{$teken='+';}
		$opgave = p($f,1)."\left("."\\frac{".($a*$nmr/$f)."}{".$nmr."}x^2".p($teken,0)."\\frac{".abs($c*$nmr)."}{".abs($f)."}\\right)=0";
		$uitwerking = "\ldots";
		return array("opgave"=>$opgave, "uitwerking"=>$uitwerking);
	}
}
?>
