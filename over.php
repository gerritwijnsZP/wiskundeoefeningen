<?php
require $_SERVER["DOCUMENT_ROOT"] . "/config.php";
include('kop.php');
?>
<style>
p{
	font-size:120%;
}
a{
	color: purple;
	font-weight: bold;
}
a:hover{
	color: purple;
	font-weight: bold;
}
</style>
<div class="container">
	<h1>Over De Oefeningen Generator</h1>
	<a href='index.php' class='button'>Terug</a>&nbsp;
	<!--
	<a href='#LaTeX.copypasten' class='button'>LaTeX copypasten</a>&nbsp;
	<a href='#wie.zijn.wij' class='button'>Wie zijn wij?</a>&nbsp;
	<a href='#steun.ons' class='button'>Steun ons</a>&nbsp;
	<a href='#updates' class='button'>Updates</a>&nbsp;
	<a href='#wishlist' class='button'>Wishlist</a>&nbsp;
	-->
</div>
<div class="container" id='LaTeX.copypasten'> 
	<p>Voor de wiskunde op deze website steunen we op het krachtige \(\LaTeX\). 
		De rendering wordt aan de gebruikerszijde afgehandeld door <a href='https://www.mathjax.org/' target=_blank rel="noopener" >MathJax</a>.
		De layout is sober en mobile-friendly met het oog op een optimale presentatie op alle soorten schermen.
	</p>
	<div class="row">
		<h3>\(\LaTeX\) copypasten in toetsen</h3>
		<p>Je kan de achterliggende \(\LaTeX\)-code laten verschijnen door de optie <a href='latex.php'>Zet LaTeX aan</a> in te schakelen op de voorpagina.
		Bij het genereren van een oefeningenreeks verschijnt dan de code onder elke opgave.</p>
		<p>Wij (leerkrachten) genereren zo reeks na reeks en copypasten de interessantste opgaves in onze toetsen in Google Documents.
		De add-on <b>Auto-LaTeX Equations</b> maakt er vervolgens in een handomdraai mooie wiskunde van.</p>
		<p>Onze collega Dirk Ploegaerts maakte hier volgend instructiefilmpje over.
		<iframe width="100%" height="400" src="https://www.youtube.com/embed/n0Z6tFhdmag" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</p>
		<p>Tijdens de coronaperiode hebben we onze leerlingen van het tweede leerjaar hierover <b>een initiatie</b> gegeven. 
		Je kan de uitleg die we hen hebben gegeven <a href='https://docs.google.com/document/d/1EB_sPKmBzVAPHTh936jqXoDwVbxiRQsUa41jBnj888c/edit?usp=sharing' target=_blank rel="noopener">hier</a> bekijken en downloaden.</p>
		<p>Bij de oplossingen kun je de LaTeX-code ook laten verschijnen via <b>Rechtsklik > Show Math As > Tex Commands</b>.
		<img src='/public/assets/show.math.as.png' border=1 style='width:100%' />
		</p>
	</div>
	<div class="row">
		<h3 id='wie.zijn.wij'>Wie zijn wij?</h3>
		<p>De vakgroep wiskunde van <a href="http://www.babotaniek.be" target=_blank rel="noopener">Busleyden Atheneum Campus Botaniek</a> 
		is de drijvende kracht achter deze website.</p>
		<p>De vakgroep bestaat uit: Juanita Joly (voorzitter), Sofie Luyten,
		Els Rosiers, Kiara Roofthooft, Anja Van Craenenbroeck en Sven Vanhoecke (implementie). 
		Je kan ons altijd contacteren via <a href='mailto:vakgroep_wiskunde@babotaniek.be' target=_blank rel="noopener" style='text-decoration:none;'>vakgroep_wiskunde@babotaniek.be</a></p>
		<p>Juanita Joly ontwikkelt ook <a href='https://sites.google.com/babotaniek.be/wiskunde/home' target=_blank rel="noopener" >een online cursus wiskunde</a>. 
		Neem zeker een kijkje!</p>
	</div>
	<div class="row">
		<h3 id='steun.ons'>Steun ons</h3>
		<p><!--<span style='float:right;padding:3px;width:100px; '><a href='https://creativecommons.org/licenses/by/3.0/deed.nl' target=_blank rel="noopener"><img src='/public/assets/free.cultural.works.jpg' /></a></span>-->
		De oefeningengenerator zal <b>altijd gratis</b> worden aangeboden. 
		Er zullen nooit reclamebanners of andere geldgenererende mechanismen op deze educatieve website worden geplaatst.
		</p><p>
		Iedereen is vrij om het materiaal op deze website te <b>kopiëren, aan te passen en te verspreiden</b>.
		Gelieve hierbij gewoon ergens de <b>website</b> te <b>vermelden</b>.
		</p>
		<p>Je kan als leerkracht de oefeningengenerator steunen door ze 
		<a href='https://www.klascement.net/websites/105420/wiskunde-oefeningengenerator/' target=_blank rel="noopener" >op Klascement</a> 
		een goede waardering te geven.
		</p><p> Feedback wordt eveneens enorm geapprecieerd! 
		Bedankt aan <b><i>Sofie De Smedt</i></b>, <b><i>Regien Geerts</i></b> en <b><i>Jan Verstuyft</i></b> voor het rapporteren van fouten via KlasCement of e-mail.
		</p>
		<p>Klascement is natuurlijk niet het enige platform waarop je onze website kan aanbevelen.
			Deel de website met collega's, medeleerlingen en ouders via uw favoriet sociaal medium.
			Alvast bedankt!
		</p>
	</div>
	<div class="row">
		<h3 id='updates'>Updates</h3>
		<p>Begin februari 2021 werden een reeks updates uitgevoerd.</p>
		<p>
		De <b>layout</b> van de website werd aangepast. 
			<ul>
				<li>De knop om het aantal oefeningen te kiezen werd weggehaald. De standaard is nu <b>12 oefeningen</b>.</li>
				<li>De verschillende oefeningenreeksen werden ondergebracht in <b>logische blokken</b> en zijn aanklikbaar.</li>
				<li>Er is al wat meer kleur.</li>
			</ul>
		</p>
		<p>De <b>links</b> naar elke oefeningenreeks zijn gewijzigd.
			<ul>
				<li>
					De links zijn vanaf nu <b>permanent</b>. Ze gaan niet meer worden aangepast (<b>beloofd!</b>).
				</li>
				<li>
					Je kan oefeningen voortaan probleemloos <b>integreren</b> in je eigen website en <b>delen</b> naar hartelust.
				</li>
			</ul> 
		</p>
		<p>
			Er werd een <b>nieuwe feature</b> toegevoegd 
			<ul>
				<li>We noemen het <b>"de mixer"</b>, want ze laat ons ook toe om oefeningen uit verschillende reeksen door elkaar te mengen.</li>
				<li>Je start de mixer door op <b>de titel van een blok</b> te klikken.</li>
				<li>De oefeningen worden <b>een per een</b> gegenereerd met een verborgen oplossing.</li>
				<li>Er werden ook nog aparte mix-lijsten gemaakt. Je vindt deze in het eerste, andersgekleurde blok op de voorpagina.</li>
				<li>
					<u>Opmerking:</u> Gezien de samenstelling van de logische blokken nog kan wijzigen, 
					zullen de links naar de gemixte oefeningen (die je kan bereiken via de bloktitel) wel nog wijzigen.
				</li>
			</ul>
			
		</p>
		<p>
			Er werd een betere <b>foutafhandeling</b> voorzien.
			<ul>
				<li>
					Als door een codeerfout ergens een <b>oneindige lus</b> zou ontstaan, dan zal deze vanaf nu <b>tijdig onderbroken</b> worden.
				</li>
				<li>
					De functie om <b>een copriem</b> te bepalen (bvb. om onvereenvoudigbare breuken op te stellen) is een voorbeeld van 
					zo'n functie die in het verleden een oneindige lus veroorzaakte. Ze werd nu volledig herschreven, de reeksen
					werken nu zonder verdere problemen.
				</li>
				<li>
					Je zal als gebruiker geen lelijke foutmelding meer zien, maar gewoon een <b>Oeps!-pagina</b> met een <b>probeer opnieuw</b>-knop.
				</li>
			</ul>
		</p>
	</div>	
	<div class='row'>
		<h3 id='wishlist'>Wishlist</h3>
		<p>
			Hier komt de wishlist.
		</p>
	</div>
	
</div>
<?php include(COMPONENTS . 'voet.html');?>
