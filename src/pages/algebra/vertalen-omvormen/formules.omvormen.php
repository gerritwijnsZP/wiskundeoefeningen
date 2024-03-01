<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
function randonbekende_extended($not = array())
{
	$letters = array_diff(array('a','b','c','q','s','x','y','\\omega','\\psi', '\\phi', '\\delta','\\rho', 'Q','R','P','T','N','H'), $not);
	$i 		= array_rand($letters);
	return $letters[$i];
}

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
		$varianten = array(
				"#=\\dfrac{@}{*}"=>array("@"=>"@=#\\cdot *", "*"=>"#\\cdot * = @ \\\\ \\Leftrightarrow * = \\dfrac{@}{#}"),
				"#=@ \\cdot *"=>array("@"=> "@=\\dfrac{#}{*}", "*"=>"* = \\dfrac{#}{@}"),
				"#=@ + *"=>array("@"=> "@=#-*", "*"=>"* = #-@"),
				"#=@ - *"=>array("@"=> "#+*=@", "*"=>"#-@ = -* \\\\ \\Leftrightarrow -#+@ = *"),
				"# @ = * §"=>array("#"=>"#=\\dfrac{* \\cdot §}{@}", 
												"@"=>"@=\\dfrac{* \\cdot §}{#}", 
												"*"=>"\\dfrac{# \\cdot @}{§}=*",
												"§"=>"\\dfrac{# \\cdot @}{*} = §"),
				"# = @ * + §"=>array("@"=>"#-§ = @ \\cdot * \\\\ \\Leftrightarrow \\dfrac{#-§}{*} = @", 
											"*"=>"#-§ = @ \\cdot * \\\\ \\Leftrightarrow \\dfrac{#-§}{@} = *", 
											"§"=>"# - @ \\cdot * = §"),
				"# = @ * - §"=>array("@"=>"#+§ = @ \\cdot * \\\\ \\Leftrightarrow \\dfrac{#+§}{*} = @", 
											"*"=>"#+§ = @ \\cdot * \\\\ \\Leftrightarrow \\dfrac{#+§}{@} = *", 
											"§"=>"#+§ = @ \\cdot * \\\\ \\Leftrightarrow § = @ \\cdot * - #"),							
				"# = µ (@ * + §)"=>array("@"=>"# = µ \\cdot @ \\cdot * + µ \\cdot § \\\\ 
												\\Leftrightarrow #- µ \\cdot § = µ \\cdot @ \\cdot * \\\\ 
												\\Leftrightarrow \\dfrac{#- µ \\cdot §}{µ \\cdot *} = @", 
											"*"=>"# = µ \\cdot @ \\cdot * + µ \\cdot § \\\\ 
												\\Leftrightarrow #- µ \\cdot § = µ \\cdot @ \\cdot * \\\\ 
												\\Leftrightarrow \\dfrac{#- µ \\cdot §}{µ \\cdot @} = *", 
											"§"=>"# = µ \\cdot @ \\cdot * + µ \\cdot § \\\\ 
												\\Leftrightarrow #- µ \\cdot @  \\cdot * = µ \\cdot § \\\\ 
												\\Leftrightarrow \\dfrac{#- µ \\cdot @ \\cdot *}{µ} = § ",
										),
				"# = µ (@ + *)"=>array("@"=>"\\dfrac{#}{µ} = @ + * \\\\ 
												\\Leftrightarrow \\dfrac{#}{µ} - * = @", 
											"*"=>"\\dfrac{#}{µ} = @ + * \\\\ 
												\\Leftrightarrow \\dfrac{#}{µ} - @ = *", 
										),
				"# = µ @ + *"=>array("@"=>"# - * = µ \\cdot @ \\\\ 
												\\Leftrightarrow \\dfrac{#-*}{µ} = @ \\\\", 
											"*"=>"# - µ@ = *", 
										),
				"#^2 = @^2 + *^2"=>array("@"=>"#^2 - *^2 = @^2 \\\\ 
												\\Leftrightarrow \\sqrt{#^2 - *^2} = @ \\\\", 
											"*"=>"#^2 - @^2 = *^2 \\\\ 
												\\Leftrightarrow \\sqrt{#^2 - @^2} = * \\\\",  
										),
				"# = \\dfrac{@}{* §}"=>array("@"=>"# \\cdot * \\cdot § = @", 
											"*"=>"# \\cdot * = \\dfrac{@}{§} \\\\
											\\Leftrightarrow * = \\dfrac{@}{§ \\cdot #}", 
										),
				"# = @ *^2"=>array("@"=>"\\dfrac{#}{*^2}  = @", 
								   "*"=>"\\dfrac{#}{@} = *^2 \\\\
											\\Leftrightarrow \\sqrt{\\dfrac{#}{@}} = *", 
										),
				"# = \\dfrac{(@+*)§}{µ}"=>array("@"=>"µ \\cdot # = (@ + * ) § \\\\
												\\Leftrightarrow \\dfrac{µ \\cdot #}{§} = @ + * \\\\
												\\Leftrightarrow \\dfrac{µ \\cdot #}{§} - * = @", 
											"*"=>"µ \\cdot # = (@ + * ) § \\\\
												\\Leftrightarrow \\dfrac{µ \\cdot #}{§} = @ + * \\\\
												\\Leftrightarrow \\dfrac{µ \\cdot #}{§} - @ = *", 
											"§"=>"µ \\cdot # = (@ + * ) § \\\\
												\\Leftrightarrow \\dfrac{µ \\cdot #}{@ + *} = §", 
										),
				);
		$hekje	= randonbekende_extended();
		$sterretje = randonbekende_extended(array($hekje));
		$apestaartje = randonbekende_extended(array($hekje, $sterretje));
		$paragraaf = randonbekende_extended(array($hekje, $sterretje, $apestaartje));
		$mu		= nietnul(2,10);
		$van	= array_rand($varianten);
		$naar	= array_rand($varianten[$van]);
		$woordenboek = array("#"=>$hekje, "@"=>$apestaartje, "*"=>$sterretje, "§"=>$paragraaf,"µ"=>$mu);
		$formule	= str_replace(array_keys($woordenboek),array_values($woordenboek), $van);
		$symbool	= $woordenboek[$naar];
		$opgave 	= "\\text{Vorm de formule } $formule \\text{ om naar de variabele } $symbool";
		$resultaat	= str_replace(array_keys($woordenboek),array_values($woordenboek), $varianten[$van][$naar]);
		$oplossing  = color("red",$formule) . "\\\\ \\Leftrightarrow " .$resultaat;
		if($van == "#=@ + *")
		{ 	$stamp = '11.plus';}
		elseif($van == "#=@ - *")
		{ 	$stamp = '11.min';}
		else
		{
			$stamp		= '11.'.$hekje.$sterretje.$apestaartje;
		}
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
