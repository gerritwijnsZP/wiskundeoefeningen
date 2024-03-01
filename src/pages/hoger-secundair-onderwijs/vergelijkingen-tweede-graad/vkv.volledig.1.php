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
	private function oef11()
	{
		/*
			ax^2 + bx + c = 0 met a, b, c \in \Z en a = 1
		*/
		$x1 =	nietnul(-12,12);
		$x2 =	nietgetal(-12,12,array(0,-$x1));
		//Swap
		if($x1 > $x2){$d = $x1; $x1 = $x2; $x2=$d;}
		$a	= 1;
		$b 	=	-($x1+$x2);
		$c 	=	$x1*$x2;
		$d	= $b*$b-4*$a*$c;
		$bla = $this->solve($a,$b,$c,$d,array($x1,$x2));
		$opgave = $bla['opgave'];
		$oplossing = $bla['oplossing'];
		$stamp		= "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		/* MP (ax + b)^2 = a^2x^2 + 2ab x + b^2 = 0  <=> ax+b = 0 <=> x = -b/a
		 * 
			ax^2 + bx + c = 0 met a, b, c \in \Z en a = 1
		*/
		$alfa 	=	nietnul(-4,4);
		$beta 	=	nietgetal(-12,12,array(0,-$alfa, $alfa));
		$fuckup =	array(0,0,1)[rand(0,2)];
		$a	= $alfa*$alfa;
		if(!$fuckup){
			$b 	= 2*$alfa*$beta;
		}else{
			$b	= 2 * nietnul(-abs($alfa*$beta)+1,abs($alfa*$beta)-1);
		}
		$c 	=	$beta * $beta;
		$d	= $b*$b-4*$a*$c;
		$teken = ($alfa * -$beta < 0);
		$ggd = ggd($alfa, $beta);
		if($alfa != $ggd)
		{
			$x	= array('','-')[$teken] . "\\frac{".abs($beta/$ggd)."}{".abs($alfa/$ggd)."}";
		}else{
			$x	= array('','-')[$teken] . abs($beta/$ggd);
		}
		$bla = $this->solve($a,$b,$c,$d,array($x));
		$opgave = $bla['opgave'];
		$oplossing = $bla['oplossing'];
		$stamp		= "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		/*
			ax^2 + bx + c = 0 met a, b, c \in \Z en pytha
			* 
			* (b,a,c) koppels
		*/ 
		$pytha = array(	
					array(5,4,1), array(5,2,2), array(3, 4, -1), array(3, 2, -2), //5,4,3
					array(10,16,1), array(6,16,-1), //10,8,6
					array(13,2,18), array(13,4,9), array(13,3,12),array(13,6,6),array(13,9,4), array(13,12,3),array(13,18,2), //13,12,5
					array(5,2,-18), array(5,4,-9), array(5,3,-12),array(5,6,-6),array(5,9,-4), array(5,12,-3),array(5,18,-2),
					array(17,8,2), array(17, 16, 1), array(17,4,4), array(17, 2, 8), // 17, 8, 15
					array(15,8,-2), array(15,16,-1), array(15,4,-4), array(15,2,-8),
					array(25,12,12), array(25,2,72),array(25,3,48), array(25,4,36), array(25,6,24), array(25, 8, 18), array(25, 18,8), //25,24,7
					array(25,24,6), array(25,36,4), array(25,48,3), array(25,72,2),
					array(7,12,-12), array(7,2,-72),array(7,3,-48), array(7,4,-36), array(7,6,-24), array(7, 8, -18), array(7, 18,-8), //25,24,7
					array(7,24,-6), array(7,36,-4), array(7,48,-3), array(7,72,-2),
				);
		$coeff = $pytha[rand(0, count($pytha)-1)];
		$a	= $coeff[1];
		$b	= $coeff[0];
		$c	= $coeff[2];
		$d	= $b*$b-4*$a*$c;
		$t1 = (int) -$b-sqrt($d);
		$t2 = (int) -$b+sqrt($d);
		$n = 2*$a;
		$g1 = abs(ggd($t1,$n));
		$g2 = abs(ggd($t2,$n));
		if(abs($n/$g1)==1)
		{
			$x1 = $t1 / $g1;
		}else{
			$x1 = "\\frac{".($t1/$g1)."}{".($n/$g1)."}";
		}
		if(abs($n/$g2)==1)
		{
			$x2 = $t2 / $g2;
		}else{
			$x2 = "\\frac{".($t2/$g2)."}{".($n/$g2)."}";
		}
		$bla = $this->solve($a,$b,$c,$d,array($x1,$x2));
		$opgave = $bla['opgave'];
		$oplossing = $bla['oplossing'];
		$stamp		= "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function genereer_opgave($a, $b, $c)
	{
		$b1 = nietgetal(-12,12, array($b,0));
		$c1 = nietgetal(-12,12, array($c,0));
		$mogelijkheden = array(
							array(	"opgave"=>p($a,1)."x^2".p($b,0).'x'.p($c,2)."=0", //normaal
									"omzetting"=>''
								 ),
							array( 	"opgave"=>p($a,1)."x^2".p($b+$b1,0).'x'.p($c+$c1,2)."=".p($b1,1)."x".p($c1,2) ,
									"omzetting"=>p($a,1)."x^2".p($b+$b1,0).'x'.p($c+$c1,2)."=".p($b1,1)."x".p($c1,2) ."\\\\
												\Leftrightarrow ".p($a,1)."x^2".p($b,0).'x'.p($c,2)."=0 \\\\"
								),
						 );
		return $mogelijkheden[rand(0, count($mogelijkheden)-1)];
	}
	private function solve($a,$b,$c,$d,$res)
	{
		$boem = $this->genereer_opgave($a, $b, $c);
		$x1 = $res[0];
		$x2 = "";
		if(count($res)==2)
		{
			$x2 = $res[1];
		}
		$opgave 	= $boem['opgave'];
		$oplossing 	= $boem['omzetting']."\\text{We zoeken de oplossingen van } ".color('blue',p($a,1)."x^2".p($b,0).'x'.p($c,2)."=0"). "\\\\ \\\\";
		$oplossing 	.= "\\begin{align} 
							D & = b^2 - 4.a.c & & \\\\
									& = ($b)^2-4.".h($a).".".h($c)." & &\\\\
									& = ".$b*$b.p(-4*$a*$c,2) . " & & \\\\
									& = ".($d) ." & & \\\\ ";
		if($d > 0)
		{
			$oplossing  .= "\\\\
								x_1 	& = \\frac{-b-\\sqrt{D}}{2.a} 				& x_2 	& = \\frac{-b+\\sqrt{D}}{2.a} \\\\
										& = \\frac{-".h($b)."-\\sqrt{$d}}{2.".h($a)."}  &		& = \\frac{-".h($b)."+\\sqrt{$d}}{2.".h($a)."} \\\\
										& = \\frac{".(-$b-sqrt($d))."}{".(2*$a)."} 		&		& = \\frac{".(-$b+sqrt($d))."}{".(2*$a)."} \\\\
										& = $x1 										&		& = $x2 \\\\ ";
			$oplossing .= " \\\\ ";
			$oplossing 	.= "V	&= \\Big\\{ $x1 ; $x2 \\Big\\} & &";
		}elseif($d == 0){
			$oplossing  .= "x 	& = \\frac{-b\\pm \\sqrt{D}}{2.a} 	& & \\\\
								& = \\frac{-".h($b)."}{2.".h($a)."} & & \\\\
								& = $x1 & & \\\\";
			$oplossing 	.= "V	&= \\Big\\{ $x1 \\Big\\} & &";
		}else{
			$oplossing .= " & < 0  \\\\";
			$oplossing .= "V &= \\varnothing ";
		}
		$oplossing 	.= "\\end{align} \\\\ -----------------";
		return array("opgave"=>$opgave,"oplossing"=>$oplossing);
	}
}
?>
