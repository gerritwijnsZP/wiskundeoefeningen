<?php 
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.rational.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$gen	= new R(1,1);
		$a		= array("a","b","p","q","x")[rand(0,4)];
		$b 		= array("a","b","p","q","x")[rand(0,4)];
		$x 		= $gen->rand();$x->haakjes(False);
		$y		= $gen->rand();$y->haakjes(False);
		$op1	= array("+","-")[rand(0,1)];
		$op2	= array("+","-")[rand(0,1)];
		$i 		= rand(1,4);
		$opgave = "";
		/////Haakjes rond negatieve gehele getallen
		if($x->noemer == 1 and $x->teller < 0){$x->haakjes(True);}
		if($y->noemer == 1 and $y->teller < 0){$y->haakjes(True);}
		//De effectieve opgave
		switch($i)
		{
			case 1: $opgave .= "(".$a.$op1.$x.")(".$b.$op2.$y.")"; break;
			case 2: $opgave .= "(".$a.$op1.$x.")(".$y.$op2.$b.")"; break;
			case 3: $opgave .= "(".$x.$op1.$a.")(".$b.$op2.$y.")"; break;
			case 4: $opgave .= "(".$x.$op1.$a.")(".$y.$op2.$b.")";
		}
		$oplossing 	= "\\begin{align}".$opgave;
		/////Haakjes rond negatieve gehele getallen weer uit
		$x->haakjes(False);$y->haakjes(False);
		//Vereenvoudig
		$x->vereenvoudig();
		$y->vereenvoudig();
		//Twee opeenvolgende mintekens
		if(($i == 1 or $i == 2) and $op1 == "-")
		{
			$op1 = "+";$x->tegengestelde();
		}
		if(($i == 1 or $i == 3) and $op2 == "-")
		{
			$op2 = "+";$y->tegengestelde();
		}
		$t1="";$t2="";
		if		($i==2 and $op2 == '-'){ $t2 = '-';}
		if		($i==3 and $op1 == '-'){ $t1 = '-';}
		if		($i==4 and $op1 == '-'){ $t1 = '-';}
		if		($i==4 and $op2 == '-'){ $t2 = '-';}
		/////Haakjes rond negatieve gehele getallen
		if($x->noemer == 1 and $x->teller < 0){$x->haakjes(True);}
		if($y->noemer == 1 and $y->teller < 0){$y->haakjes(True);}
		//Resultaat stap 
		$oplossing .= "& =(\\color{red}{".$t1.$a."}+\\color{orange}{".$x."}).(\\color{green}{".$t2.$b."}+\\color{blue}{".$y."})";
		$oplossing .= "& \\text{Vereenvoud".$i."g (verplicht!) en herschik (niet verplicht)} \\\\";
		/////Haakjes rond negatieve gehele getallen weer uit
		$x->haakjes(False);$y->haakjes(False);
		//Uitschrijven
		$oplossing .= "& = \\color{red}{(".$t1.$a.")} . \\color{green}{(".$t2.$b.")} + \\color{red}{(".$t1.$a.")} . \\color{blue}{(".$y.")}
		+ \\color{orange}{(".$x.")} . \\color{green}{(".$t2.$b.")} +  \\color{orange}{(".$x.")}  . \\color{blue}{(".$y.")}";
		$oplossing .= "& \\text{Boogjes en uitschrijven} \\\\";
		//Uitwerken
		$uitwerking = "";
		if($t1==""){$t1="+";}
		if($t2==""){$t2="+";}
		////Term 1
		if($t1 != $t2){ $uitwerking .= '-';$tt1 = "-";}else{$tt1="+";}
		if($a<$b){$uitwerking .= $a.$b;}else{$uitwerking .= $b.$a;}
		////Term 2
		if($t1 != $y->teken()){ $uitwerking .= "-";$tt2="-";}else{$uitwerking .= "+";$tt2="+";}
		$uitwerking .= $y->abs().$a;
		////Term 3
		if($t2 != $x->teken()){ $uitwerking .= "-";$tt3="-";}else{$uitwerking .= "+";$tt3="+";}
		$uitwerking .= $x->abs().$b;
		////Term 4
		if($x->teken() != $y->teken()){$tt4="-";}else{$tt4="+";}
		$oplossing .= " & = ".$uitwerking. $tt4.$x->abs().".".$y->abs()."& \\text{Uitwerken } \\\\";
		//Laatste stap(pen)
		$oplossing .= " & =";
		$x = $x->abs();
		$y = $y->abs();
		
		if($a == $b) //Zelfde letter
		{
			if($tt1 == "+"){$tt1 = "";}
			$oplossing .= $tt1.$a."^2";
			if($tt2 == '-'){$y = $y->mul(-1);}
			if($tt3 == '-'){$x = $x->mul(-1);}
			$oplossing .= "+(".$y."+".$x.")".$a;
			$oplossing .= $tt4 . $x->mul($y);
			$oplossing .= " & \\text{Neem samen} \\\\";
			
			$factor = $x->add($y);
			$oplossing .= " &=";
			$oplossing .= $tt1.$a."^2";
			$oplossing .= $factor->teken().$factor->abs().$a;
			$laatste_term = $x->mul($y);
			$oplossing .= $tt4.$laatste_term ." & \\text{Maak de som} \\\\";
			
			$oja_factor = $factor->mul(1);
			$oja_term = $laatste_term->mul(1);
			$factor->vereenvoudig();
			$laatste_term->vereenvoudig();
			if($oja_factor->noemer != $factor->noemer or $oja_term->noemer != $laatste_term->noemer)
			{
				$oplossing .= " &=";
				$oplossing .= $tt1.$a."^2";
				$oplossing .= $factor->teken().$factor->abs().$a;
				$laatste_term = $x->mul($y);
				$laatste_term->vereenvoudig();
				$status = 0;
				if($tt4=="-" and $laatste_term->teken() =="-")
				{
					$tt4 = '+';
					$laatste_term = $laatste_term->mul(-1);
					$status = 1;
				}
				$oplossing .= $tt4.$laatste_term ." & \\text{Vereenvoudig indien mogelijk $status} \\\\";
			}
		}
		else //Verschillende letter
		{
			$laatste_term = (($x->mul($y))->abs());
			$oplossing .= $uitwerking . $tt4 . $laatste_term ." & \\text{Uitrekenen (Geen Smoothie!)} \\\\";
			$oja_term = $laatste_term->mul(1);
			$laatste_term->vereenvoudig();
			if($laatste_term->noemer != $oja_term->noemer)
			{
				$oplossing .= " & = ".$uitwerking . $tt4 . $laatste_term ." & \\text{Vereenvoudig} \\\\";
			}
		}
		$oplossing .= "\\end{align}";
		$stamp 		= rand(1,2000);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
