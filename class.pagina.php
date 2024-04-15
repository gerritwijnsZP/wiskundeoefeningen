<?php 

class Pagina
{
	public $titel;
	public $pagina;
	public function __construct($titel, $pagina)
	{
		$this->titel = $titel;
		$this->pagina = $pagina;
	}
	public function toon($aantal=10, $leerling="")
	{
		include($this->pagina);
		$fabriek 	= new Fabriek($this->titel);
		$reeks 		= new OefeningReeks($fabriek);
		$reeks->maak($aantal);
		echo "<h4>".$this->titel."</h4>";
		echo "<p><i>".$leerling."</i></p>";
		echo $reeks;
		echo "<hr/ style='page-break-after: always;'>";
		echo "<h4>".$this->titel."</h4>";
		echo "<h5>Verbetersleutel</h5>";
		echo "<p><i>".$leerling."</i></p>";
		echo $reeks->verbetersleutel();
	}
	public function mix()
	{	
		include($this->pagina);
		$fabriek 	= new Fabriek($this->titel);
		$reeks 		= new OefeningReeks($fabriek);
		$reeks->maak(1);
		//return $reeks;
		echo "<div style='text-align:center;font-style: italic;'>".$this->titel."</div>";
		
		$q = array_pop($reeks->lijst);
		echo 	"<div style='float:center;text-align:center;font-size:120%;padding:10px 10px;' id='opgave'>
					\\(". $q->opgave ."\\)
				</div>";
		echo "<div align='center'><button onclick=\"myFunction()\" id='knop'>Toon oplossing</button></div>";
		echo "<div style='float:center;text-align:center;display:none;padding:10px 10px;color:purple;' id='oplossing'>
					\\(". $q->oplossing ."\\)
				</div>";
	}
	public function mix2()
	{	
		include($this->pagina);
		$fabriek 	= new Fabriek($this->titel);
		$reeks 		= new OefeningReeks($fabriek);
		$reeks->maak(1);
		//return $reeks;
		echo "<div style='text-align:center;font-style: italic;'>".$this->titel."</div>";
		
		$q = array_pop($reeks->lijst);
		echo 	"<div style='float:center;text-align:center;font-size:120%;padding:10px 10px;' id='opgave'>
					\\(". $q->opgave ."\\)
				</div>";
		echo "<div align='center'><button onclick=\"myFunction()\" id='knop'>Toon oplossing</button></div>";
		echo "<div style='padding:10px 10px;color:purple;' id='oplossing'>
				<div id='cover' style='width:100%;height:100%;z-index:20;'></div>
					\\(". $q->oplossing ."\\)
				</div>";
	}
}
?>
