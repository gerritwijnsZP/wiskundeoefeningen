<style>
	.rubriek {
		font-size: 120%;
		width: 100%;
		text-align: center;
		padding: 5px 10px;
		color: black;
	}

	fieldset {
		background-color: lightgreen;
	}

	fieldset.special {
		background-color: lightblue;
	}

	legend {
		font-size: 120%;
		background-color: darkgreen;
		color: white;
		padding: 5px 10px;
		/*margin-left: 20px;*/
	}

	legend.special {
		background-color: #0000A0;
	}

	@media print {
		span.special {
			display: none;
		}
	}
</style>
<?php
require LIB . "/metadata-parser.php";

$paginas = array(
	// DONE
	"BSS" => array("Titel" => "@Basis"),

	// DONE
	"plus" => array("Titel" => "#Basis Optellen", "Opgave" => "Reken uit"),
	"plus.5" => array("Titel" => "0 - 5", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.10" => array("Titel" => "0 - 10", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.10" => array("Titel" => "Brug naar 10", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.over.10" => array("Titel" => "Brug over 10 (reeks 1)", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.over.10.bis" => array("Titel" => "Brug over 10 (reeks 2)", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.20" => array("Titel" => "10 - 20", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.naar.10voud" => array("Titel" => "Brug naar tienvoud", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.tot.100" => array("Titel" => "Brug over tiental", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.10vouden" => array("Titel" => "Brug met tienvoud", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug" => array("Titel" => "Brug Mix (reeks 1)", "folder" => "plus", "Opgave" => "Reken uit"),
	"plus.brug.mix" => array("Titel" => "Brug Mix (reeks 2)", "folder" => "plus", "Opgave" => "Reken uit"),

	// DONE
	"tafelsblok" => array("Titel" => "#Tafels", "Opgave" => ""),
	"tafels.2" => array("Titel" => "Tafel van 2", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.3" => array("Titel" => "Tafel van 3", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.4" => array("Titel" => "Tafel van 4", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.5" => array("Titel" => "Tafel van 5", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.6" => array("Titel" => "Tafel van 6", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.7" => array("Titel" => "Tafel van 7", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.8" => array("Titel" => "Tafel van 8", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.9" => array("Titel" => "Tafel van 9", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels.10" => array("Titel" => "Tafel van 10", "folder" => "tafels", "Opgave" => "Reken uit"),
	"tafels" => array("Titel" => "Tafels Mix", "folder" => "tafels", "Opgave" => "Reken uit"),

	// DONE
	"basisgeletterdheid1" => array("Titel" => "#BGL 6.1", "Opgave" => "Reken uit"),
	"basisgeletterdheid.breuken.1" => array("Titel" => "Procenten (reeks 1)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.breuken.2" => array("Titel" => "Procenten (reeks 2)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.breuken.3" => array("Titel" => "Procenten (reeks 3)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.breuken.4" => array("Titel" => "Breuken (reeks 1)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),

	// DONE
	"basisgeletterdheid3" => array("Titel" => "#BGL 6.3", "Opgave" => "Reken uit"),
	"basisgeletterdheid.eenheden.1" => array("Titel" => "Basiseenheden (reeks 1)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.eenheden.2" => array("Titel" => "Oppervlakte (reeks 2)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.eenheden.3" => array("Titel" => "Volume (reeks 3)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),
	"basisgeletterdheid.eenheden.4" => array("Titel" => "Tijd (reeks 4)", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),

	// DONE
	"basisgeletterdheid56" => array("Titel" => "#BGL 6.5 / 6.6", "Opgave" => "Reken uit"),
	"basisgeletterdheid.rechthoek" => array("Titel" => "Rechthoek", "folder" => "basisgeletterdheid", "Opgave" => "Reken uit"),

	// DONE
	"statistiek" => array("Titel" => "#Statistiek", "Opgave" => ""),
	"statistiek.gemiddelde" => array("Titel" => "Gemiddelde", "folder" => "statistiek", "Opgave" => "Bereken het gemiddelde"),
	"statistiek.mediaan" => array("Titel" => "Mediaan", "folder" => "statistiek", "Opgave" => "Bepaal de mediaan"),

	// DONE
	"ZQ" => array("Titel" => "@Bewerkingen in \(\mathbb{Z}\) en \(\mathbb{Q}\)"),

	// DONE
	"gehele.getallen.basis" => array("Titel" => "#Gehele getallen + en -", "Opgave" => "Reken uit"),
	"geheel.optellen.aftrekken.1" => array("Titel" => "Optellen en aftrekken (reeks 1)", "folder" => "geheel", "Opgave" => "Reken uit"),
	"geheel.haakjesregel" => array("Titel" => "Haakjesregel (intermezzo)", "folder" => "geheel", "Opgave" => "Werk de haakjes weg"),
	"geheel.optellen.aftrekken.2" => array("Titel" => "Optellen en aftrekken (reeks 2)", "folder" => "geheel", "Opgave" => "Reken uit"),
	"geheel.optellen.aftrekken.3" => array("Titel" => "Optellen en aftrekken (reeks 3)", "folder" => "geheel", "Opgave" => "Reken uit"),

	// DONE
	"gehele.getallen" => array("Titel" => "#Gehele getallen . en :", "Opgave" => "Reken uit"),
	"geheel.vermenigvuldigen.delen.1" => array("Titel" => "Tekenregel . en : (reeks 1)", "folder" => "geheel", "Opgave" => "Reken uit"),
	"geheel.vermenigvuldigen.delen.2" => array("Titel" => "Tekenregel . en : (reeks 2)", "folder" => "geheel", "Opgave" => "Reken uit"),

	// DONE
	"volgorde.alles" => array("Titel" => "#Volgorde van bewerkingen", "Opgave" => "Reken uit"),
	"volgorde.geheel" => array("Titel" => "Volgorde van bewerkingen", "folder" => "volgorde", "Opgave" => "Reken uit"),
	"volgorde" => array("Titel" => "Volgorde van bewerkingen (gevorderd)", "folder" => "volgorde", "Opgave" => "Reken uit"),

	// DONE
	"breuken.basis" => array("Titel" => "#Basis breuken", "folder" => "breuken", "Opgave" => ""),
	"grootste.gemene.deler" =>
	array(
		"Titel" => "Grootste gemene deler",
		"folder", "grootste",
		"Opgave" => "Bepaal de grootste gemene deler door gebruik te maken van de priemfactorenmethode"
	),
	"breuken.vereenvoudig.op.zicht" =>
	array(
		"Titel" => "Breuken vereenvoudigen op zicht",
		"folder" => "breuken",
		"Opgave" => "Herleid tot een onvereenvoudigbare breuk zonder ZRM (kladblad mag)"
	),
	"breuken.vereenvoudig" => array("Titel" => "Breuken vereenvoudigen", "Opgave" => "Herleid tot een onvereenvoudigbare breuk"),
	"decimaal2breuk" => array("Titel" => "Decimaal naar breuk", "Opgave" => "Zet het decimaal getal om naar een breuk"),
	"rationaal.orde" => array("Titel" => "Ordenen rationale getallen", "Opgave" => "Vul aan met <, > of ="),

	// DONE
	"breuken.plus.min" => array("Titel" => "#Breuken + en -", "Opgave" => "Bereken"),
	"breuken.optellen.pos" => array("Titel" => "Breuken optellen (reeks 1)", "folder" => "breuken", "Opgave" => "Tel de breuken op"),
	"breuken.aftrekken.1" => array("Titel" => "Breuken aftrekken (reeks 1)", "folder" => "breuken", "Opgave" => "Trek de breuken af"),
	"breuken.optellen" => array("Titel" => "Breuken optellen (reeks 2)", "folder" => "breuken", "Opgave" => "Tel de breuken op"),
	"breuken.aftrekken.2" => array("Titel" => "Breuken aftrekken (reeks 2)", "folder" => "breuken", "Opgave" => "Trek de breuken af"),
	"breuken.haakjes.1" => array("Titel" => "Breuken haakjesregel (reeks 1)", "folder" => "breuken", "Opgave" => "Bereken"),
	"breuken.haakjes.2" => array("Titel" => "Breuken haakjesregel (reeks 2)", "folder" => "breuken", "Opgave" => "Bereken"),

	// DONE
	"breuken.bewerkingen" => array("Titel" => "#Breuken . en :", "Opgave" => "Bereken"),
	"breuken.vermenigvuldigen.pos" => array("Titel" => "Breuken verm. (reeks 1)", "folder" => "breuken", "Opgave" => "Vermenigvuldig de breuken"),
	"breuken.vermenigvuldigen" => array("Titel" => "Breuken verm. (reeks 2)", "folder" => "breuken", "Opgave" => "Vermenigvuldig de breuken"),
	"breuken.vermenigvuldigen.3" => array("Titel" => "Breuken verm. (reeks 3)", "folder" => "breuken", "Opgave" => "Vermenigvuldig de breuken"),
	"breuken.delen" => array("Titel" => "Breuken delen (reeks 1)", "folder" => "breuken", "Opgave" => "Deel de breuken"),
	"breuken.delen.2" => array("Titel" => "Breuken delen (reeks 2)", "folder" => "breuken", "Opgave" => "Deel de breuken"),

	// DONE
	"machten.blok" => array("Titel" => "#Machten", "Opgave" => "Pas de rekenregels toe en werk uit"),
	"machten.regenboogtabel" => array("Titel" => "'Regenboogtabel'-training", "folder" => "machten", "Opgave" => "Train je parate kennis"),
	"machten.0" => array("Titel" => "Negatieve exponent (reeks 1)", "folder" => "machten", "Opgave" => "Zet om naar een positieve exponent"),
	"machten.1" => array("Titel" => "Negatieve exponent (reeks 2)", "folder" => "machten", "Opgave" => "Zet om naar een positieve exponent"),
	"machten.2" => array("Titel" => "Rekenregels (zelfde grondtal)", "folder" => "machten", "Opgave" => "Schrijf als een macht met positieve exponent"),
	"machten.3" => array("Titel" => "Rekenregels (zelfde exponent)", "folder" => "machten", "Opgave" => "Schrijf als een macht met positieve exponent"),
	"machten" => array("Titel" => "Rekenregels machten", "folder" => "machten", "Opgave" => "Pas de correcte rekenregel(s) van machten toe [en reken uit indien mogelijk]"),

	"wortel.blok" => array("Titel" => "#Wortels", "Opgave" => "Pas de rekenregels toe en werk uit"),
	"wortel.rekenen" => array("Titel" => "Rekenen met wortels (reeks 1)", "folder" => "wortel", "Opgave" => "Reken uit"),
	"wortel.rekenen.2" => array("Titel" => "Rekenen met wortels (reeks 2)", "folder" => "wortel", "Opgave" => "Reken uit"),
	"wortel.rekenen.3" => array("Titel" => "Rekenen met wortels (reeks 3)", "folder" => "wortel", "Opgave" => "Reken uit"),
	"wortel.rekenen.4" => array("Titel" => "Rekenen met wortels (reeks 4)", "folder" => "wortel", "Opgave" => "Reken uit"),
	"wortel.rekenen.5" => array("Titel" => "Rekenen met wortels (reeks 5)", "folder" => "wortel", "Opgave" => "Maak de noemer wortelvrij"),

	// DONE
	"natuurwetenschappen" => array("Titel" => "#Toepassing", "Opgave" => ""),
	"wetenschappelijke.notatie" => array("Titel" => "Wetenschappelijke notatie (basis)", "folder" => "natuurwetenschappen", "Opgave" => "Omzetten van wetenschappelijke notatie naar decimaal getal en omgekeerd"),
	"eenheden" => array("Titel" => "Eenheden en wetenschappelijke notatie", "folder" => "natuurwetenschappen", "Opgave" => "Schrijf in de wetenschappelijke notatie en zet de eenheid om"),

	// DONE
	"ALG" => array("Titel" => "@Algebra"),

	// DONE
	"mp" => array("Titel" => "#Merkwaardige producten", "Opgave" => "Gebruik merkwaardige producten van links naar rechts en rechts naar links"),
	"merkwaardige.producten" => array("Titel" => "Merkwaardige producten (MP)", "Opgave" => "Bereken de volgende merkwaardige producten"),
	"mp.ontbinden.factoren" => array("Titel" => "Ontbinden in factoren (1)", "Opgave" => "Ontbind in factoren door gebruik te maken van merkwaardige producten"),
	"ontbinden.factoren" => array("Titel" => "Ontbinden in factoren (2)", "Opgave" => "Zonder de gemeenschappelijke factor af. Ontbind verder in factoren indien mogelijk."),
	"ontbinden.factoren.2" => array("Titel" => "Tweeterm als gem. factor (3)", "Opgave" => "Zonder de gemeenschappelijke tweeterm af en 'kuis op'."),

	// DONE
	"veeltermen.inleiding" => array("Titel" => "#Inleiding veeltermen", "Opgave" => ""),
	"lettervorm.herleiden" => array("Titel" => "Lettervormen herleiden", "Opgave" => "Herleid de lettervormen"),
	"lettervorm.getalwaarde" => array("Titel" => "Lettervormen getalwaarde", "Opgave" => "Bereken de getalwaarde"),
	"lettervorm.distributiviteit" => array("Titel" => "Lettervormen distributiviteit", "Opgave" => "Bereken"),
	"distributiviteit" => array("Titel" => "Distributiviteit \((a+r)(b+s)\)", "Opgave" => "Werk uit en vereenvoudig"),
	"veeltermen.bewerkingen.geheel" => array("Titel" => "Bewerkingen met veeltermen", "Opgave" => "Bereken, herleid en rangschik naar dalende macht (ZRM toegestaan) "),

	// DONE
	"blok.wiskundetaal" => array("Titel" => "#Vertalen / Omvormen", "Opgave" => "Vertaal of zet om"),
	"wiskundetaal" => array("Titel" => "Wiskundetaal", "Opgave" => "Vertaal naar een lettervorm"),
	"formules.omvormen" => array("Titel" => "Formules omvormen", "Opgave" => "Vorm de formules om"),
	"vgl1.6.wiskundetaal" => array("Titel" => "Vgln. en Wiskundetaal", "Opgave" => "Zet om in symbolen. Gebruik de letter x als onbekende"),
	"vrgstk1.1" => array("Titel" => "Eenvoudige vraagstukken", "Opgave" => "Vertaal naar een wiskundige vergelijking. Los op door gebruik te maken van het stappenplan."),
	"python.def" => array("Titel" => "Python functies", "Opgave" => "Zet de formule om in een een Python functie"),

	// DONE
	"vgln.graad.1" => array("Titel" => "#Vgln. eerste graad", "Opgave" => "Bepaal de waarde x. Bij wiskundetaal en vraagstukken, gebruik x om op te lossen."),
	"vgl1.1" => array("Titel" => "Vgln. eerste graad (reeks 1)", "Opgave" => "Bepaal de waarde van x."),
	"vgl1.2" => array("Titel" => "Vgln. eerste graad (reeks 2)", "Opgave" => "Bepaal de waarde van x. Meerdere manieren van oplossen mogelijk"),
	"vgl1.3" => array("Titel" => "Vgln. eerste graad (reeks 3)", "Opgave" => "Reeks met haakjes"),
	"vgl1.4" => array("Titel" => "Vgln. eerste graad (reeks 4)", "Opgave" => "Reeks met breuken waarbij we ervoor kiezen om de breuken weg te werken. Neem je ZRM!"),
	"vgl1.5" => array("Titel" => "Vgln. eerste graad (reeks 5)", "Opgave" => "Alles samen. Gebruik stappenplan en ZRM!"),

	// DONE
	"vraagstukken.graad.1" => array("Titel" => "#Vraagstukken", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.eenvoudig" => array("Titel" => "Instapvraagstukken", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.vast.herhaald" => array("Titel" => "Vaste en herhaalde kost", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.vorm.binair" => array("Titel" => "Vrgst met 2 gevraagden", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.breuken" => array("Titel" => "Vrgst met breuken", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.vorm.tertiair" => array("Titel" => "Vrgst met 3 gevraagden", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"vraagstuk.doordenkers" => array("Titel" => "Doordenkers", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),

	// DONE
	"problem.solving" => array("Titel" => "#Problem Solving", "Opgave" => "Gebruik het stappenplan voor het oplossen van vraagstukken."),
	"snelheid" => array("Titel" => "Snelheid", "Opgave" => "Zet het vraagstuk om in wiskundetaal"),
	"krachten" => array("Titel" => "Krachten", "Opgave" => "Zet het vraagstuk om in wiskundetaal en bereken"),

	// DONE
	"HSO" => array("Titel" => "@Hoger Secundair Onderwijs"),

	// DONE
	"vgln.graad.2" => array("Titel" => "#Vgln. tweede graad", "Opgave" => "Los op. Vermijd indien mogelijk het gebruik van de discriminant."),
	"vkv.volledig.1" => array("Titel" => "Vierkantsvergelijkingen (VKV)", "Opgave" => "Gebruik de discriminant om volgende vierkantsvergelijkingen op te lossen"),
	"vkv.volledig.2" => array("Titel" => "VKV met breuken of rekenwerk", "Opgave" => "Gebruik de discriminant om volgende vierkantsvergelijkingen op te lossen"),
	"vkv.onvolledig.1" => array("Titel" => "Onvolledige VKV (b=0)", "Opgave" => "Los de vierkantsvergelijking op zonder de discriminant te gebruiken"),
	"vkv.onvolledig.2" => array("Titel" => "Onvolledige VKV (c=0)", "Opgave" => "Los de vierkantsvergelijking op zonder de discriminant te gebruiken"),

	// DONE
	"logica" => array("Titel" => "#Logica", "Opgave" => "Bepaal de waarheidswaarde en noteer in woorden"),
	"logica.niet" => array("Titel" => "Negatie", "Opgave" => "Stel een waarheidstabel op en noteer de negatie in eigen woorden."),
	"logica.samenstelling.1" => array("Titel" => "Samenstellingen (reeks 1)", "Opgave" => "Stel een waarheidstabel op en noteer de samenstelling in eigen woorden."),
	"logica.samenstelling.2" => array("Titel" => "Samenstellingen (reeks 2)", "Opgave" => "Stel een waarheidstabel op en noteer de samenstelling in eigen woorden."),

	// DONE
	"stelsels" => array("Titel" => "#Stelsels", "Opgave" => "Werk uit"),
	"stelsels.substitutie" => array("Titel" => "Stelsels substitutie", "Opgave" => "Substitutie"),
	"stelsels.combinatie" => array("Titel" => "Stelsels combinatie", "Opgave" => "Combinatie"),
	"stelsels.breuken" => array("Titel" => "Stelsels met breuken", "Opgave" => "Substitutie of combinatie"),

	// DONE
	"eerstegraadsfuncties" => array("Titel" => "#Eerstegraadsfuncties", "Opgave" => "Werk uit"),
	"eerstegraadsfunctie.bepalen.rico.en.punt.gegeven" => array("Titel" => "Bepalen voorschrift (rico + punt gegeven)", "Opgave" => "Bepaal het voorschrift in de vorm f(x)=ax+b"),
	"eerstegraadsfunctie.bepalen.2punten.gegeven" => array("Titel" => "Bepalen voorschrift (2 punten gegeven)", "Opgave" => "Bepaal het voorschrift in de vorm f(x)=ax+b"),
	"eerstegraadsfunctie.bepalen" => array("Titel" => "Bepalen voorschrift (gemengd)", "Opgave" => "Bepaal het voorschrift in de vorm f(x)=ax+b"),

	// DONE
	"hoeken.omrekenen" => array("Titel" => "#Hoeken omrekenen", "Opgave" => "Probeer op zicht. Indien te complex, gebruik ZRM (radialen op 0,001 nauwkeurig, hoeken op een seconde nauwkeurig)"),
	"hoeken.graad.naar.radiaal.1" => array("Titel" => "Van graden naar radialen", "Opgave" => "Geef een exacte uitkomst (laat &pi; staan). Zonder ZRM!"),
	"hoeken.graad.naar.radiaal.2" => array("Titel" => "Van graden naar radialen (ZRM)", "Opgave" => "Zet om op 0,001 nauwkeurig. Met ZRM!"),
	"hoeken.radiaal.naar.graad.1" => array("Titel" => "Van radialen naar graden", "Opgave" => "Zet om zonder ZRM"),
	"hoeken.radiaal.naar.graad.2" => array("Titel" => "Van radialen naar graden (ZRM)", "Opgave" => "Zet om op 1 seconde nauwkeurig. Met ZRM!"),
	"hoeken.lengte.cirkelboog" => array("Titel" => "Lengte cirkelboog AB", "Opgave" => "Los op"),

	// DONE
	"machten.rationaal" => array("Titel" => "#Rationale machten", "Opgave" => "Werk uit m.b.v. de rekenregels"),
	"machten.rationaal.1" => array("Titel" => "Product zelfde grondtal", "Opgave" => "Werk uit m.b.v. de rekenregels"),
	"machten.rationaal.2" => array("Titel" => "Quoti&euml;nt zelfde grondtal", "Opgave" => "Werk uit m.b.v. de rekenregels"),
	"machten.rationaal.3" => array("Titel" => "Macht van een macht", "Opgave" => "Werk uit m.b.v. de rekenregels"),
	"machten.rationaal.getallen" => array("Titel" => "Getallen als grondtal", "Opgave" => "Bereken m.b.v. de rekenregels (zonder ZRM)"),

	// DONE
	"logaritmen" => array("Titel" => "#Logaritmen", "Opgave" => "Bereken. Gebruik ZRM als oplossing op zicht niet mogelijk is."),
	"logaritmen.1" => array("Titel" => "Rekenen met log<sub>10</sub> (reeks 1)", "Opgave" => "Bereken"),
	"logaritmen.2" => array("Titel" => "Rekenen met log<sub>10</sub> (reeks 2)", "Opgave" => "Bepaal x"),
	"logaritmen.3" => array("Titel" => "log<sub>10</sub> met rekenmachien", "Opgave" => "Bepaal x met ZRM"),
	"logaritmen.4" => array("Titel" => "Rekenregels (reeks 1)", "Opgave" => "Pas de rekenregels toe en bereken"),
	//"logaritmen.5"=>array( "Titel"=> "Rekenregels (reeks 2)" ,"Opgave"=> "Pas de rekenregels toe en bereken" ),

	// DONE
	"Complexe getallen" => array("Titel" => "#Complexe getallen", "Opgave" => "Bereken. Gebruik ZRM als oplossing op zicht niet mogelijk is."),
	"complexe.getallen.1" => array("Titel" => "Optellen en aftrekken (a+bi)", "Opgave" => "Bereken"),
	"complexe.getallen.2" => array("Titel" => "Vermenigvuldigen en delen (a+bi)", "Opgave" => "Bereken"),
	"complexe.getallen.3" => array("Titel" => "Basisbewerkingen gemengd (a+bi)", "Opgave" => "Bereken"),
	"complexe.getallen.4" => array("Titel" => "Bepaal modulus en argument", "Opgave" => "Bepaal modulus en argument"),
	//"logaritmen.5"=>array( "Titel"=> "Rekenregels (reeks 2)" ,"Opgave"=> "Pas de rekenregels toe en bereken" ),



);
/* Hier definiëren we de mixers die niet alle oefeningen bevatten
 * We vullen deze array straks aan met de mixers per blok o.b.v. $paginas
 */
/*
$blokken = array(
					"hoeken.omrekenen.mix"=>array("Titel"=>"Hoeken omzetten", 
												"Opgave"=>"Zet om van graden naar radialen en omgekeerd (zonder ZRM!).",
												"reeksen"=>array('hoeken.graad.naar.radiaal.1','hoeken.radiaal.naar.graad.1')
												),
					"vgln.gr.1.mix" => array(	"Titel" => "Vgln. eerste graad", 
											"Opgave"=> "Bepaal de waarde van x",
											"reeksen"=> array('vgl1.1','vgl1.2','vgl1.3','vgl1.4','vgl1.5')),
					"geheel.alles" => array( "Titel"=>"Gehele getallen (alles)",
											"Opgave"=> "Bereken",
											"reeksen"=>array("geheel.optellen.aftrekken.1", "geheel.haakjesregel")),
					);
*/
//Dit zijn de meetkundige oefeningen die slechts één per één mogen worden getoond
$meetkunde = array(
	"#meetkunde" => array("Titel" => "", "Opgave" => ""), ////Meetkunde marker

	// DONE
	"goniometrie" => array("Titel" => "#Goniometrie", "Opgave" => "Bereken de grootte van de hoek(en) en de lengte van de zijde(n) in een rechthoekige driehoek"),
	"goniometrie.1" => array("Titel" => "Pythagoras, sin, cos, tan", "Opgave" => "Bereken de grootte van de hoek(en) en de lengte van de zijde(n) in een rechthoekige driehoek"),

	// DONE
	"functieonderzoek" => array("Titel" => "#Functieonderzoek", "Opgave" => "Bepaal nulwaarde, waardentabel, domein en bereik. Teken de grafiek."),
	"functieonderzoek.1" => array("Titel" => "1e graad met grafiek (1)", "Opgave" => "Bepaal nulwaarde, waardentabel, domein en bereik"),
	//"functieonderzoek.1.1"=> array("Titel"=>"1e graad zelf grafiek (2)", "Opgave"=>"Bepaal nulwaarde, waardentabel, domein en bereik. Teken grafiek."),

	"einde" => array("Titel" => "#", "Opgave" => ""),
);

$order = json_decode(file_get_contents('src/pages/metadata.json'), true)["order"];
$pages = array();
$chapters = array_diff(scandir('src/pages'), array('..', '.'), array('metadata.json'));
foreach ($order as $chapter => $data) {
	$chapterMetadata = json_decode(file_get_contents('src/pages/' . $chapter . '/metadata.json'), true);
	
	$pages[$chapter] = array();
	
	$pages[$chapter]['title'] = $chapterMetadata['title'];
	$pages[$chapter]['description'] = $chapterMetadata['description'];

	$sections = array_diff(scandir('src/pages/' . $chapter), array('..', '.'), array('metadata.json'));
	foreach ($sections as $section) {
		$pages[$chapter]['sections'][$section] = array();

		$pages[$chapter]['sections'][$section]['title'] = $chapterMetadata['sections'][$section]['title'];
		$pages[$chapter]['sections'][$section]['description'] = $chapterMetadata['sections'][$section]['description'];
		
		$exercises = array_diff(scandir('src/pages/' . $chapter . '/' . $section), array('..', '.'));
		foreach ($exercises as $exercise) {
			$pages[$chapter]['sections'][$section]['exercises'][] = $exercise;
		}
	}
}

//Voorbereiding rest
$deel = "";
$inhoudsopgave = array();
$rijnr = 0;
$menu = "<div>";
$aantal_oefeningenreeksen = 0;
$teller = 0; //aantal getekende blokken, wordt gereset na 3
$menurij = '';
$txt = "";
$is_meetkunde = false;
$is_meetkunde_new_row = false;
$stijl = '';
$menurij = "";
$txt = '';
$alles = array_merge($paginas, $meetkunde);

foreach ($alles as $pagina => $data) {

	if ($pagina == "#meetkunde") {
		$is_meetkunde = true;
		continue;
	}

	if ($data["Titel"][0] == "@") {
		$deel = $pagina;
		if ($txt != '') {
			$menurij .= "<div class='one-third column'>
							<fieldset $stijl>
								" . $txt . "
							</fieldset>
						</div>";
			$txt = '';
		}
		//Teken de rij met drie blokken
		if ($menurij != "") {
			$menu .= "<div class='row' id='rijnr$rijnr'>" . $menurij . "</div>";
			$rijnr++;
		}
		//Maak een nieuwe rij en begin terug te tellen vanaf 0
		$menurij = '';
		$teller = 0;
		$menu .= "<div class='row'>
					<h1 id='$pagina'>" . ltrim($data["Titel"], "@") . "<span style='float:right;text-color:black;'><a href='#'>\(\\uparrow\)</a></span></h1>
					
				</div>";
		array_push($inhoudsopgave, "<a href='#$pagina'>" . ltrim($data["Titel"], "@") . "</a>");
		continue;
	}

	//Als je een rubriektitel tegenkomt
	if ($data["Titel"][0] == "#") {
		//Onthoud welk deel dit is en voeg als broldata toe aan $blokken
		$deel = $pagina;
		$blokken[$deel] = array(
			"Titel" => ltrim($data["Titel"], '#'),
			"Opgave" => $data["Opgave"],
			"reeksen" => array()
		);
		//Controleer of je ondertussen ook al links hebt opgespaard (en dus niet de eerste rubriek bent)
		if ($txt != '') {
			//Voeg je blok toe aan de rij
			$menurij .= "<div class='one-third column'>
							<fieldset $stijl>
								" . $txt . "
							</fieldset>
						</div>";
			$teller += 1;
			//Controleer of de meetkunde marker al gepasseerd is en verander de stijl van de volgende blokken
			if ($is_meetkunde && !$is_meetkunde_new_row) {
				$stijl 	= " class='special' ";
				$teller = 100;
				$is_meetkunde_new_row = true;
			}
			//Als er drie blokken in een rij zitten
			if ($teller >= 3) {
				//Teken de rij met drie blokken
				$menu .= "<div class='row' id='rijnr$rijnr'>" . $menurij . "</div>";
				$rijnr++;
				//Maak een nieuwe rij en begin terug te tellen vanaf 0
				$menurij = '';
				$teller = 0;
			}
		}
		//Voeg sowieso de "legende" toe aan je blok
		$txt = "<legend $stijl>
					<a href='mixer.php?blok=$pagina&rijnr=$rijnr' style='text-decoration:none;color:white;'>
						" . ltrim($data["Titel"], '#') . "
					</a>
				</legend>";
		$aantal_oefeningenreeksen += 1;
		continue;
	}

	//Als je geen rubriek bent, dan ben je een oefeningenreeks
	//Voeg jezelf toe aan het menu van jouw blok
	if (!$is_meetkunde) {
		$txt .= "<a href='?pagina=$pagina&rijnr=$rijnr' class='rubriek'>" . $data["Titel"] . "</a><br/>";
	} else {
		$txt .= "<a href='mixer.php?blok=$pagina&rijnr=$rijnr' class='rubriek'>" . $data["Titel"] . "</a><br/>";
	}
	//Voeg jezelf toe aan de lijst van aparte blokken
	array_push($blokken[$deel]["reeksen"], $pagina);
	$aantal_oefeningenreeksen += 1;
}

if ($menurij != '') {
	//Als je op 't einde bent en 
	//je hebt nog een menurij staan die toevallig geen drie volledige blokken bevat, 
	//teken die dan toch maar eventjes. Je hebt ze niet voor niets gemaakt, toch?
	$menu .= "<div class='row' id='rijnr$rijnr'>" . $menurij . "</div>";
}
//Dat was 't.
$menu .= "</div>";
$inhoudsopgave = "<ol style='list-style-type: upper-roman;'>
					<li>" . implode("</li><li>", $inhoudsopgave) . "</li>
				</ol>";
?>