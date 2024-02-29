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
	private function canvas($marge = 30, $x = 0, $y = 0)
	{
		return "<br/><input type='number' value=".$marge." step=5 min=5 id='marge' onchange='teken(f);' style='width:1.5cm;visibility:hidden;' />
				<button onclick=\"document.getElementById('marge').value = parseInt(document.getElementById('marge').value) + 5;teken(f);\">+</button>
				<button onclick=\"document.getElementById('marge').value = Math.max(5, parseInt(document.getElementById('marge').value) - 5);teken(f);\">-</button>
				<i style='font-size:70%'>Gebruik de toetsenbordpijltjes om grafiek te verschuiven</i>
				<input type='number' value=".$x." step=1 id='x' onchange='teken(f);' style='visibility:hidden;width:0cm;' />
				<input type='number' value=".$y." step=1 id='y' onchange='teken(f);' style='visibility:hidden;width:0cm;' /><br/>
				<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>";
	}
	private function oef11()
	{
		$a			= rand(-8,8);
		$b			= nietnul(-12,12);
		$ggd 		= ggd($a,$b);
		if($a != 0)
		{
			$opgave 	= "f(x)=".p($a,1)."x".p($b,2);
		}else{
			$opgave 	= "f(x)=".p($b,2);
		}
		//Slimme positionering
		$canvas_marge 	= 30;
		$canvas_x		= 0;
		$canvas_y		= round(-$b/2);
		//
		$opgave		.= "\\) 
							".$this->canvas($canvas_marge, $canvas_x, $canvas_y)."
							<script>
								function f(x)
								{
									return ".$a."*x".p($b,2).";
								}
								teken(f);
							</script>
						\\(";
		$oplossing	= "\\textbf{Waardentabel} \\\\ \\begin{array}{l|c|c|c}";
		$nulwaarde	= ""; //breuk opvangen
		$nulwaarden = array();
		if($a != 0)
		{
			$teller		= -$b / $ggd; $noemer = $a / $ggd; 
			if($noemer < 0){$teller *= -1; $noemer *= -1;}
			if($noemer == 1){ $nulwaarde = $teller;}
			else{	$nulwaarde = "\\dfrac{".$teller."}{".$noemer."}";}
			$nulwaarden[$nulwaarde] = 0;
			$nulwaarden[0]			= $b;
			$nulwaarden[1]			= $a + $b;
		}else{
			
			$nulwaarden[0]	= $b;
			$nulwaarden[1]	= $b;
			$nulwaarden[2]	= $b;
		}
		$oplossing	.= "x 		& ".implode(' & ', array_keys($nulwaarden)) . " \\\\";
		$oplossing	.= " \\hline ";
		$oplossing	.= "f(x) 	& ".implode(' & ', array_values($nulwaarden));
		$oplossing	.= "\\end{array} \\\\";
		
		$oplossing	.= "\\\\ \\underline{\\text{Nulwaarde}} \\\\";
		if($a != 0)
		{
			$oplossing	.= "f(x)=0 \\Leftrightarrow ".p($a,1)."x".p($b,2)." = 0 \\Leftrightarrow x = ".$nulwaarde." \\\\";
		}else{
			$oplossing	.= "\\text{ Geen nulwaarde } \\\\";
		}
		
		$oplossing	.= "\\\\ \\underline{\\text{Snijpunt Y-as}} \\\\ (0;".$b.") \\\\ \\\\";
		
		
		$oplossing	.= "\\textbf{Tekenschema} \\\\
						\\begin{array}{r|c c c}
							x & -\\infty & $nulwaarde & +\\infty \\\\
							\\hline
							f(x) & ".($a != 0 ? ($a < 0 ? '+' : '-') : ($b < 0 ? '-' : '+' ))." & ".($a != 0 ? '0' : $b)." & ".($a != 0 ? ($a < 0 ? '-' : '+') : ($b < 0 ? '-' : '+' ))."\\\\
						\\end{array}\\\\";
	
		$oplossing	.= "\\textbf{Domein en bereik} \\\\
						\\text{dom} f = \\mathbb{R} \\text{ en ber} f = ".($a == 0 ? "\{".$b."\}" : "\\mathbb{R}")."\\\\";
		
		$oplossing	.= "\\textbf{Verloopschema} \\\\
						\\begin{array}{r|c c c}
							x & -\\infty & & +\\infty \\\\
							\\hline
							f(x) & ".($a != 0 ? ($a < 0 ? '+\\infty' : '-\\infty') : $b)." & ".($a != 0 ? ($a < 0 ? '\\searrow' : '\\nearrow') : '\\rightarrow')." & ".($a != 0 ? ($a < 0 ? '-\\infty' : '+\\infty') : $b)." \\\\
						\\end{array}\\\\
					";
		
		$oplossing	.= "\\textbf{Voor leerlingen derde graad} \\\\
						\\displaystyle{ \\lim_{x \\to -\\infty} } f(x) = ".($a != 0 ? ($a < 0 ? '+\\infty' : '-\\infty') : $b) . " \\\\
						\\displaystyle{ \\lim_{x \\to +\\infty} } f(x) = ".($a != 0 ? ($a < 0 ? '-\\infty' : '+\\infty') : $b) . "";
		$stamp		= "11.$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
<script src="/public/scripts/grafiek.js"></script>
