<?php
class Oefening
{
	public $vraag; //Vereenvoudig
	public $opgave; //\frac{3}{9}
	public $oplossing; //stappenplan 
	public $stamp; //133 (=1, 3, ggd 3)
	
	public function __construct($vraag, $opgave, $oplossing, $stamp)
	{
		$this->vraag = $vraag;
		$this->opgave = $opgave;
		$this->oplossing = $oplossing;
		$this->stamp = $stamp;
	}
	public function __toString(): string
	{
		return $this->opgave;
	}
}
class OefeningFactory
{
	public $titel;
	public function __construct($titel)
	{
		$this->titel = $titel;
	}
	public function __toString(): string
	{
		return $this->titel;
	}
	public function run()
	{
		return false;
	}
}
class OefeningReeks
{
	public $lijst = array();
	public $factory;
	public function __construct($factory)
	{
		$this->factory = $factory;
	}
	public function maak($aantal)
	{
		while(count($this->lijst)<$aantal)
		{
			$oef = $this->factory->run();
			if(!in_array($oef->stamp, array_keys($this->lijst)))
			{
				$this->lijst[$oef->stamp] = $oef;
			}
		}
	}
	public function __toString(): string
	{
		$txt = "<ol style='list-style-type: lower-alpha;'>\n";
		foreach($this->lijst as $oefening)
		{
			$txt .= "\t<li>\(".$oefening->opgave."\)";
			if(isset($_SESSION['latex']) && $_SESSION['latex'])
			{
				$latex = $oefening->opgave;
				$latex = str_replace("\\)","",$latex);
				$latex = str_replace("\\(","",$latex);
				$txt .= "<br/>$latex";
			}
			$txt .= "</li>\n";
		}
		$txt .= "</ol>\n";
		return $txt;
	}
	public function verbetersleutel()
	{
		$txt = "<ol style='list-style-type: lower-alpha;'>\n";
		foreach($this->lijst as $oefening)
		{
			$txt .= "\t<li>\(".$oefening->oplossing."\)";
			$txt .= "</li>\n";
		}
		$txt .= "</ol>\n";
		return $txt;
	}
}
/*
$oef = new Oefening("Vereenvoudig","wiskunde","stappenplan","stamp");
echo $oef."<br/>";
$oefv = new Vereenvoudig("Vereenvoudig");
$oefr = new OefeningReeks($oefv);
$oefr->maak(20);
//print_r($oefr);
echo $oefr;
echo "<hr>";
echo $oefr->verbetersleutel();
*/
?>
