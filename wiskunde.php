<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiskunde Hulpsite met Tussenstappen en Oefeningen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .tool {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        input, button, select {
            padding: 8px;
            margin: 5px 0;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .result {
            font-weight: bold;
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .steps {
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 4px;
            font-family: monospace;
            white-space: pre-wrap;
        }
        .exercise {
            margin-top: 15px;
            padding: 10px;
            background-color: #e8f4f8;
            border-radius: 4px;
        }
        .exercise button {
            margin-top: 10px;
            background-color: #2ecc71;
        }
        .exercise button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <h1>Wiskunde Hulpsite met Tussenstappen en Oefeningen</h1>
    
    <!-- Afstand tussen twee punten -->
    <div class="tool">
        <h2>Afstand tussen twee punten berekenen</h2>
        <p>Voer de coördinaten van punt A en B in:</p>
        <label>Punt A: x = <input type="number" id="ax" value="1">, y = <input type="number" id="ay" value="7"></label><br>
        <label>Punt B: x = <input type="number" id="bx" value="2">, y = <input type="number" id="by" value="4"></label><br>
        <button onclick="berekenAfstand()">Bereken afstand</button>
        <div class="result" id="afstandResult"></div>
        <div class="steps" id="afstandSteps"></div>
        
        <div class="exercise">
            <h3>Oefening genereren</h3>
            <button onclick="genereerAfstandOefening()">Nieuwe oefening</button>
            <div id="afstandOefening"></div>
            <button onclick="toonAfstandOplossing()" id="afstandOplossingKnop" style="display:none;">Toon oplossing</button>
            <div class="steps" id="afstandOplossing" style="display:none;"></div>
        </div>
    </div>
    
    <!-- Middelloodlijn -->
    <div class="tool">
        <h2>Middelloodlijn bepalen</h2>
        <p>Voer de coördinaten van twee punten in:</p>
        <label>Punt A: x = <input type="number" id="ml_ax" value="1">, y = <input type="number" id="ml_ay" value="7"></label><br>
        <label>Punt B: x = <input type="number" id="ml_bx" value="2">, y = <input type="number" id="ml_by" value="4"></label><br>
        <button onclick="berekenMiddelloodlijn()">Bereken middelloodlijn</button>
        <div class="result" id="middelloodlijnResult"></div>
        <div class="steps" id="middelloodlijnSteps"></div>
        
        <div class="exercise">
            <h3>Oefening genereren</h3>
            <button onclick="genereerMiddelloodlijnOefening()">Nieuwe oefening</button>
            <div id="middelloodlijnOefening"></div>
            <button onclick="toonMiddelloodlijnOplossing()" id="middelloodlijnOplossingKnop" style="display:none;">Toon oplossing</button>
            <div class="steps" id="middelloodlijnOplossing" style="display:none;"></div>
        </div>
    </div>
    
    <!-- Rekenregels machten -->
    <div class="tool">
        <h2>Rekenregels machten met onbekenden</h2>
        <p>Voorbeelden van rekenregels met tussenstappen:</p>
        <div class="steps">
            <strong>Voorbeeld 1: a<sup>m</sup> × a<sup>n</sup> = a<sup>m+n</sup></strong>
            2<sup>3</sup> × 2<sup>4</sup> = 2<sup>3+4</sup> = 2<sup>7</sup> = 128
            
            <strong>Voorbeeld 2: a<sup>m</sup> ÷ a<sup>n</sup> = a<sup>m-n</sup></strong>
            5<sup>6</sup> ÷ 5<sup>2</sup> = 5<sup>6-2</sup> = 5<sup>4</sup> = 625
            
            <strong>Voorbeeld 3: (a<sup>m</sup>)<sup>n</sup> = a<sup>m×n</sup></strong>
            (3<sup>2</sup>)<sup>3</sup> = 3<sup>2×3</sup> = 3<sup>6</sup> = 729
            
            <strong>Voorbeeld 4: a<sup>-n</sup> = 1/a<sup>n</sup></strong>
            4<sup>-2</sup> = 1/4<sup>2</sup> = 1/16 = 0.0625
            
            <strong>Voorbeeld 5: a<sup>1/n</sup> = <sup>n</sup>√a</strong>
            27<sup>1/3</sup> = ³√27 = 3
        </div>
        
        <div class="exercise">
            <h3>Oefening genereren</h3>
            <select id="machtenType">
                <option value="vermenigvuldigen">Vermenigvuldigen (a^m × a^n)</option>
                <option value="delen">Delen (a^m ÷ a^n)</option>
                <option value="machtVanMacht">Macht van een macht ((a^m)^n)</option>
                <option value="negatieveExponent">Negatieve exponent (a^-n)</option>
                <option value="wortelAlsExponent">Wortel als exponent (a^(1/n))</option>
            </select>
            <button onclick="genereerMachtenOefening()">Nieuwe oefening</button>
            <div id="machtenOefening"></div>
            <button onclick="toonMachtenOplossing()" id="machtenOplossingKnop" style="display:none;">Toon oplossing</button>
            <div class="steps" id="machtenOplossing" style="display:none;"></div>
        </div>
    </div>
    
    <!-- Stelling van Pythagoras -->
    <div class="tool">
        <h2>Stelling van Pythagoras</h2>
        <p>Geef twee zijden om de derde te berekenen:</p>
        <select id="pythagorasKeuze">
            <option value="schuine">Bereken schuine zijde (c)</option>
            <option value="rechthoeks">Bereken rechthoekszijde (a of b)</option>
        </select><br>
        <label>Zijde a: <input type="number" id="pyth_a" value="3"></label><br>
        <label>Zijde b: <input type="number" id="pyth_b" value="4"></label><br>
        <button onclick="berekenPythagoras()">Bereken</button>
        <div class="result" id="pythagorasResult"></div>
        <div class="steps" id="pythagorasSteps"></div>
        
        <div class="exercise">
            <h3>Oefening genereren</h3>
            <select id="pythagorasOefeningType">
                <option value="schuine">Bereken schuine zijde</option>
                <option value="rechthoeks">Bereken rechthoekszijde</option>
                <option value="willekeurig">Willekeurig</option>
            </select>
            <button onclick="genereerPythagorasOefening()">Nieuwe oefening</button>
            <div id="pythagorasOefening"></div>
            <button onclick="toonPythagorasOplossing()" id="pythagorasOplossingKnop" style="display:none;">Toon oplossing</button>
            <div class="steps" id="pythagorasOplossing" style="display:none;"></div>
        </div>
    </div>
    
    <!-- Rechthoekige driehoeken oplossen -->
    <div class="tool">
        <h2>Rechthoekige driehoeken oplossen</h2>
        <p>Geef 2 gegevens (zijden of hoeken):</p>
        <label>Zijde a: <input type="number" id="driehoek_a"></label><br>
        <label>Zijde b: <input type="number" id="driehoek_b"></label><br>
        <label>Zijde c (schuine): <input type="number" id="driehoek_c"></label><br>
        <label>Hoek α (graden): <input type="number" id="driehoek_alpha"></label><br>
        <label>Hoek β (graden): <input type="number" id="driehoek_beta"></label><br>
        
        <button onclick="losDriehoekOp()">Bereken</button>
        <div class="result" id="driehoekResult"></div>
        <div class="steps" id="driehoekSteps"></div>
        
        <div class="exercise">
            <h3>Oefening genereren</h3>
            <select id="driehoekOefeningType">
                <option value="zijden">Gegeven 2 zijden</option>
                <option value="zijdeHoek">Gegeven 1 zijde en 1 hoek</option>
                <option value="willekeurig">Willekeurig</option>
            </select>
            <button onclick="genereerDriehoekOefening()">Nieuwe oefening</button>
            <div id="driehoekOefening"></div>
            <button onclick="toonDriehoekOplossing()" id="driehoekOplossingKnop" style="display:none;">Toon oplossing</button>
            <div class="steps" id="driehoekOplossing" style="display:none;"></div>
        </div>
    </div>

    <script>
        // Hulpfunctie voor willekeurige getallen
        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        
        // Afstand tussen twee punten
        function berekenAfstand() {
            const ax = parseFloat(document.getElementById('ax').value);
            const ay = parseFloat(document.getElementById('ay').value);
            const bx = parseFloat(document.getElementById('bx').value);
            const by = parseFloat(document.getElementById('by').value);
            
            let steps = `Stap 1: Formule afstand = √((x₂ - x₁)² + (y₂ - y₁)²)\n`;
            steps += `Stap 2: Vul de coördinaten in: √((${bx} - ${ax})² + (${by} - ${ay})²)\n`;
            const dx = bx - ax;
            const dy = by - ay;
            steps += `Stap 3: Bereken verschillen: √(${dx}² + ${dy}²)\n`;
            const dx2 = dx * dx;
            const dy2 = dy * dy;
            steps += `Stap 4: Kwadrateer: √(${dx2} + ${dy2})\n`;
            const som = dx2 + dy2;
            steps += `Stap 5: Tel op: √${som}\n`;
            const afstand = Math.sqrt(som);
            steps += `Stap 6: Neem vierkantswortel: ${afstand.toFixed(2)}`;
            
            document.getElementById('afstandResult').innerHTML = 
                `Afstand tussen A(${ax},${ay}) en B(${bx},${by}) = ${afstand.toFixed(2)}`;
            document.getElementById('afstandSteps').innerHTML = steps;
        }
        
        function genereerAfstandOefening() {
            // Genereer willekeurige punten
            const ax = randomInt(-10, 10);
            const ay = randomInt(-10, 10);
            const bx = randomInt(-10, 10);
            const by = randomInt(-10, 10);
            
            document.getElementById('afstandOefening').innerHTML = 
                `Bereken de afstand tussen punt A(${ax}, ${ay}) en punt B(${bx}, ${by}).`;
            
            // Bereken de oplossing voor later
            const dx = bx - ax;
            const dy = by - ay;
            const afstand = Math.sqrt(dx*dx + dy*dy);
            
            let oplossing = `Stap 1: Formule afstand = √((x₂ - x₁)² + (y₂ - y₁)²)\n`;
            oplossing += `Stap 2: Vul in: √((${bx} - ${ax})² + (${by} - ${ay})²)\n`;
            oplossing += `Stap 3: Bereken verschillen: √(${dx}² + ${dy}²)\n`;
            oplossing += `Stap 4: Kwadrateer: √(${dx*dx} + ${dy*dy})\n`;
            oplossing += `Stap 5: Tel op: √${dx*dx + dy*dy}\n`;
            oplossing += `Stap 6: Wortel: ${afstand.toFixed(2)}`;
            
            // Sla de oplossing op in een data-attribuut
            document.getElementById('afstandOplossing').setAttribute('data-oplossing', oplossing);
            document.getElementById('afstandOplossingKnop').style.display = 'inline-block';
            document.getElementById('afstandOplossing').style.display = 'none';
        }
        
        function toonAfstandOplossing() {
            const oplossing = document.getElementById('afstandOplossing').getAttribute('data-oplossing');
            document.getElementById('afstandOplossing').innerHTML = oplossing;
            document.getElementById('afstandOplossing').style.display = 'block';
        }
        
        // Middelloodlijn
        function berekenMiddelloodlijn() {
            const ax = parseFloat(document.getElementById('ml_ax').value);
            const ay = parseFloat(document.getElementById('ml_ay').value);
            const bx = parseFloat(document.getElementById('ml_bx').value);
            const by = parseFloat(document.getElementById('ml_by').value);
            
            let steps = `Stap 1: Bepaal middelpunt M tussen A en B\n`;
            const mx = (ax + bx) / 2;
            const my = (ay + by) / 2;
            steps += `M = ((${ax} + ${bx})/2, (${ay} + ${by})/2) = (${mx}, ${my})\n\n`;
            
            steps += `Stap 2: Bereken richtingscoëfficiënt van AB\n`;
            const rc_ab = (by - ay) / (bx - ax);
            steps += `rc_AB = (${by} - ${ay})/(${bx} - ${ax}) = ${rc_ab.toFixed(2)}\n\n`;
            
            steps += `Stap 3: Bereken rc van middelloodlijn (loodrecht op AB)\n`;
            const rc_ml = -1 / rc_ab;
            steps += `rc_ml = -1 / ${rc_ab.toFixed(2)} = ${rc_ml.toFixed(2)}\n\n`;
            
            steps += `Stap 4: Vergelijking middelloodlijn door M(${mx},${my})\n`;
            steps += `y - y₁ = rc × (x - x₁)\n`;
            steps += `y - ${my} = ${rc_ml.toFixed(2)} × (x - ${mx})\n\n`;
            
            steps += `Stap 5: Zet om naar lineaire vorm y = ax + b\n`;
            const b = my - rc_ml * mx;
            steps += `y = ${rc_ml.toFixed(2)}x + ${b.toFixed(2)}`;
            
            document.getElementById('middelloodlijnResult').innerHTML = 
                `Middelloodlijn van A(${ax},${ay}) en B(${bx},${by}):<br>
                Vergelijking: y - ${my.toFixed(2)} = ${rc_ml.toFixed(2)} × (x - ${mx.toFixed(2)})<br>
                Of: y = ${rc_ml.toFixed(2)}x + ${b.toFixed(2)}`;
            document.getElementById('middelloodlijnSteps').innerHTML = steps;
        }
        
        function genereerMiddelloodlijnOefening() {
            // Genereer willekeurige punten
            const ax = randomInt(-10, 10);
            const ay = randomInt(-10, 10);
            const bx = randomInt(-10, 10);
            const by = randomInt(-10, 10);
            
            document.getElementById('middelloodlijnOefening').innerHTML = 
                `Bepaal de vergelijking van de middelloodlijn van lijnstuk AB met A(${ax}, ${ay}) en B(${bx}, ${by}).`;
            
            // Bereken de oplossing voor later
            const mx = (ax + bx) / 2;
            const my = (ay + by) / 2;
            const rc_ab = (by - ay) / (bx - ax);
            const rc_ml = -1 / rc_ab;
            const b = my - rc_ml * mx;
            
            let oplossing = `Stap 1: Bepaal middelpunt M\n`;
            oplossing += `M = ((${ax} + ${bx})/2, (${ay} + ${by})/2) = (${mx}, ${my})\n\n`;
            oplossing += `Stap 2: Bereken rc van AB\n`;
            oplossing += `rc_AB = (${by} - ${ay})/(${bx} - ${ax}) = ${rc_ab.toFixed(2)}\n\n`;
            oplossing += `Stap 3: Bereken rc van middelloodlijn (loodrecht)\n`;
            oplossing += `rc_ml = -1 / ${rc_ab.toFixed(2)} = ${rc_ml.toFixed(2)}\n\n`;
            oplossing += `Stap 4: Vergelijking middelloodlijn door M\n`;
            oplossing += `y - ${my} = ${rc_ml.toFixed(2)}(x - ${mx})\n\n`;
            oplossing += `Stap 5: Lineaire vorm\n`;
            oplossing += `y = ${rc_ml.toFixed(2)}x + ${b.toFixed(2)}`;
            
            document.getElementById('middelloodlijnOplossing').setAttribute('data-oplossing', oplossing);
            document.getElementById('middelloodlijnOplossingKnop').style.display = 'inline-block';
            document.getElementById('middelloodlijnOplossing').style.display = 'none';
        }
        
        function toonMiddelloodlijnOplossing() {
            const oplossing = document.getElementById('middelloodlijnOplossing').getAttribute('data-oplossing');
            document.getElementById('middelloodlijnOplossing').innerHTML = oplossing;
            document.getElementById('middelloodlijnOplossing').style.display = 'block';
        }
        
        // Rekenregels machten
        function genereerMachtenOefening() {
            const type = document.getElementById('machtenType').value;
            let opgave, oplossing;
            
            switch(type) {
                case 'vermenigvuldigen':
                    const basis1 = randomInt(2, 5);
                    const exponent1a = randomInt(1, 4);
                    const exponent1b = randomInt(1, 4);
                    opgave = `Vereenvoudig: ${basis1}<sup>${exponent1a}</sup> × ${basis1}<sup>${exponent1b}</sup>`;
                    oplossing = `Stap 1: ${basis1}<sup>${exponent1a}</sup> × ${basis1}<sup>${exponent1b}</sup>\n`;
                    oplossing += `Stap 2: ${basis1}<sup>${exponent1a + exponent1b}</sup>\n`;
                    oplossing += `Stap 3: ${Math.pow(basis1, exponent1a + exponent1b)}`;
                    break;
                    
                case 'delen':
                    const basis2 = randomInt(2, 5);
                    const exponent2a = randomInt(3, 6);
                    const exponent2b = randomInt(1, exponent2a-1);
                    opgave = `Vereenvoudig: ${basis2}<sup>${exponent2a}</sup> ÷ ${basis2}<sup>${exponent2b}</sup>`;
                    oplossing = `Stap 1: ${basis2}<sup>${exponent2a}</sup> ÷ ${basis2}<sup>${exponent2b}</sup>\n`;
                    oplossing += `Stap 2: ${basis2}<sup>${exponent2a - exponent2b}</sup>\n`;
                    oplossing += `Stap 3: ${Math.pow(basis2, exponent2a - exponent2b)}`;
                    break;
                    
                case 'machtVanMacht':
                    const basis3 = randomInt(2, 4);
                    const exponent3a = randomInt(2, 4);
                    const exponent3b = randomInt(2, 3);
                    opgave = `Vereenvoudig: (${basis3}<sup>${exponent3a}</sup>)<sup>${exponent3b}</sup>`;
                    oplossing = `Stap 1: (${basis3}<sup>${exponent3a}</sup>)<sup>${exponent3b}</sup>\n`;
                    oplossing += `Stap 2: ${basis3}<sup>${exponent3a * exponent3b}</sup>\n`;
                    oplossing += `Stap 3: ${Math.pow(basis3, exponent3a * exponent3b)}`;
                    break;
                    
                case 'negatieveExponent':
                    const basis4 = randomInt(2, 5);
                    const exponent4 = randomInt(1, 3);
                    opgave = `Vereenvoudig: ${basis4}<sup>-${exponent4}</sup>`;
                    oplossing = `Stap 1: ${basis4}<sup>-${exponent4}</sup>\n`;
                    oplossing += `Stap 2: 1 / ${basis4}<sup>${exponent4}</sup>\n`;
                    oplossing += `Stap 3: 1 / ${Math.pow(basis4, exponent4)}\n`;
                    oplossing += `Stap 4: ${1/Math.pow(basis4, exponent4)}`;
                    break;
                    
                case 'wortelAlsExponent':
                    const basis5 = Math.pow(randomInt(2, 5), randomInt(2, 3));
                    const exponent5 = randomInt(2, 3);
                    opgave = `Vereenvoudig: ${basis5}<sup>1/${exponent5}</sup>`;
                    oplossing = `Stap 1: ${basis5}<sup>1/${exponent5}</sup>\n`;
                    oplossing += `Stap 2: ${exponent5}√${basis5}\n`;
                    oplossing += `Stap 3: ${Math.round(Math.pow(basis5, 1/exponent5))}`;
                    break;
            }
            
            document.getElementById('machtenOefening').innerHTML = opgave;
            document.getElementById('machtenOplossing').setAttribute('data-oplossing', oplossing);
            document.getElementById('machtenOplossingKnop').style.display = 'inline-block';
            document.getElementById('machtenOplossing').style.display = 'none';
        }
        
        function toonMachtenOplossing() {
            const oplossing = document.getElementById('machtenOplossing').getAttribute('data-oplossing');
            document.getElementById('machtenOplossing').innerHTML = oplossing;
            document.getElementById('machtenOplossing').style.display = 'block';
        }
        
        // Stelling van Pythagoras
        function berekenPythagoras() {
            const keuze = document.getElementById('pythagorasKeuze').value;
            const a = parseFloat(document.getElementById('pyth_a').value);
            const b = parseFloat(document.getElementById('pyth_b').value);
            
            let resultaat, steps;
            
            if (keuze === "schuine") {
                steps = `Stap 1: Formule c = √(a² + b²)\n`;
                steps += `Stap 2: Vul in: c = √(${a}² + ${b}²)\n`;
                const a2 = a * a;
                const b2 = b * b;
                steps += `Stap 3: Kwadrateer: c = √(${a2} + ${b2})\n`;
                const som = a2 + b2;
                steps += `Stap 4: Tel op: c = √${som}\n`;
                const c = Math.sqrt(som);
                steps += `Stap 5: Wortel: c = ${c.toFixed(2)}`;
                
                resultaat = `Schuine zijde c = √(${a}² + ${b}²) = ${c.toFixed(2)}`;
            } else {
                if (a === 0 && b === 0) {
                    resultaat = "Voer minstens één rechthoekszijde in";
                    steps = "";
                } else if (a === 0) {
                    steps = `Stap 1: Formule a = √(c² - b²)\n`;
                    steps += `Stap 2: Vul in: a = √(${b}² - ${a}²)\n`;
                    const c2 = b * b;
                    const b2 = a * a;
                    steps += `Stap 3: Kwadrateer: a = √(${c2} - ${b2})\n`;
                    const verschil = c2 - b2;
                    steps += `Stap 4: Trek af: a = √${verschil}\n`;
                    const andereZijde = Math.sqrt(verschil);
                    steps += `Stap 5: Wortel: a = ${andereZijde.toFixed(2)}`;
                    
                    resultaat = `Rechthoekszijde a = √(${b}² - ${a}²) = ${andereZijde.toFixed(2)}`;
                } else {
                    steps = `Stap 1: Formule b = √(a² - c²)\n`;
                    steps += `Stap 2: Vul in: b = √(${a}² - ${b}²)\n`;
                    const a2 = a * a;
                    const c2 = b * b;
                    steps += `Stap 3: Kwadrateer: b = √(${a2} - ${c2})\n`;
                    const verschil = a2 - c2;
                    steps += `Stap 4: Trek af: b = √${verschil}\n`;
                    const andereZijde = Math.sqrt(verschil);
                    steps += `Stap 5: Wortel: b = ${andereZijde.toFixed(2)}`;
                    
                    resultaat = `Rechthoekszijde b = √(${a}² - ${b}²) = ${andereZijde.toFixed(2)}`;
                }
            }
            
            document.getElementById('pythagorasResult').innerHTML = resultaat;
            document.getElementById('pythagorasSteps').innerHTML = steps;
        }
        
        function genereerPythagorasOefening() {
            const type = document.getElementById('pythagorasOefeningType').value;
            let oefeningType;
            
            if (type === 'willekeurig') {
                oefeningType = Math.random() < 0.5 ? 'schuine' : 'rechthoeks';
            } else {
                oefeningType = type;
            }
            
            let opgave, oplossing;
            
            if (oefeningType === 'schuine') {
                const a = randomInt(1, 10);
                const b = randomInt(1, 10);
                const c = Math.sqrt(a*a + b*b);
                
                opgave = `Gegeven een rechthoekige driehoek met rechthoekszijden a = ${a} en b = ${b}. Bereken de schuine zijde c.`;
                
                oplossing = `Stap 1: Formule c = √(a² + b²)\n`;
                oplossing += `Stap 2: Vul in: c = √(${a}² + ${b}²)\n`;
                oplossing += `Stap 3: Kwadrateer: c = √(${a*a} + ${b*b})\n`;
                oplossing += `Stap 4: Tel op: c = √${a*a + b*b}\n`;
                oplossing += `Stap 5: Wortel: c = ${c.toFixed(2)}`;
            } else {
                // Zorg dat we een pythagoreïsch drietal hebben voor mooie oplossingen
                const drietallen = [
                    [3, 4, 5], [5, 12, 13], [6, 8, 10], [7, 24, 25], [8, 15, 17],
                    [9, 12, 15], [9, 40, 41], [12, 16, 20], [12, 35, 37]
                ];
                const drietal = drietallen[Math.floor(Math.random() * drietallen.length)];
                
                // Kies willekeurig welke rechthoekszijde we weglaten
                if (Math.random() < 0.5) {
                    opgave = `Gegeven een rechthoekige driehoek met rechthoekszijde a = ${drietal[0]} en schuine zijde c = ${drietal[2]}. Bereken rechthoekszijde b.`;
                    
                    oplossing = `Stap 1: Formule b = √(c² - a²)\n`;
                    oplossing += `Stap 2: Vul in: b = √(${drietal[2]}² - ${drietal[0]}²)\n`;
                    oplossing += `Stap 3: Kwadrateer: b = √(${drietal[2]*drietal[2]} - ${drietal[0]*drietal[0]})\n`;
                    oplossing += `Stap 4: Trek af: b = √${drietal[2]*drietal[2] - drietal[0]*drietal[0]}\n`;
                    oplossing += `Stap 5: Wortel: b = ${drietal[1]}`;
                } else {
                    opgave = `Gegeven een rechthoekige driehoek met rechthoekszijde b = ${drietal[1]} en schuine zijde c = ${drietal[2]}. Bereken rechthoekszijde a.`;
                    
                    oplossing = `Stap 1: Formule a = √(c² - b²)\n`;
                    oplossing += `Stap 2: Vul in: a = √(${drietal[2]}² - ${drietal[1]}²)\n`;
                    oplossing += `Stap 3: Kwadrateer: a = √(${drietal[2]*drietal[2]} - ${drietal[1]*drietal[1]})\n`;
                    oplossing += `Stap 4: Trek af: a = √${drietal[2]*drietal[2] - drietal[1]*drietal[1]}\n`;
                    oplossing += `Stap 5: Wortel: a = ${drietal[0]}`;
                }
            }
            
            document.getElementById('pythagorasOefening').innerHTML = opgave;
            document.getElementById('pythagorasOplossing').setAttribute('data-oplossing', oplossing);
            document.getElementById('pythagorasOplossingKnop').style.display = 'inline-block';
            document.getElementById('pythagorasOplossing').style.display = 'none';
        }
        
        function toonPythagorasOplossing() {
            const oplossing = document.getElementById('pythagorasOplossing').getAttribute('data-oplossing');
            document.getElementById('pythagorasOplossing').innerHTML = oplossing;
            document.getElementById('pythagorasOplossing').style.display = 'block';
        }
        
        // Rechthoekige driehoeken oplossen
        // Rechthoekige driehoeken oplossen
function losDriehoekOp() {
    let a = parseFloat(document.getElementById('driehoek_a').value) || 0;
    let b = parseFloat(document.getElementById('driehoek_b').value) || 0;
    let c = parseFloat(document.getElementById('driehoek_c').value) || 0;
    let alpha = parseFloat(document.getElementById('driehoek_alpha').value) || 0;
    let beta = parseFloat(document.getElementById('driehoek_beta').value) || 0;
    
    let resultaat = "";
    let steps = "";
    
    // Als we twee zijden hebben
    if ((a && b) || (a && c) || (b && c)) {
        // Bereken ontbrekende zijde
        let zijden = {a, b, c};
        
        if (!zijden.c && zijden.a && zijden.b) {
            steps += `Stap 1: Bereken schuine zijde c met Pythagoras\n`;
            steps += `Formule: c = √(a² + b²)\n`;
            steps += `Vul in: c = √(${a}² + ${b}²)\n`;
            zijden.c = Math.sqrt(zijden.a*zijden.a + zijden.b*zijden.b);
            steps += `Stap 2: Bereken: c = ${zijden.c.toFixed(2)}\n`;
            resultaat = `Schuine zijde c = ${zijden.c.toFixed(2)}`;
        } else if (!zijden.a && zijden.b && zijden.c) {
            steps += `Stap 1: Bereken rechthoekszijde a met Pythagoras\n`;
            steps += `Formule: a = √(c² - b²)\n`;
            steps += `Vul in: a = √(${zijden.c}² - ${zijden.b}²)\n`;
            zijden.a = Math.sqrt(zijden.c*zijden.c - zijden.b*zijden.b);
            steps += `Stap 2: Bereken: a = ${zijden.a.toFixed(2)}\n`;
            resultaat = `Rechthoekszijde a = ${zijden.a.toFixed(2)}`;
        } else if (!zijden.b && zijden.a && zijden.c) {
            steps += `Stap 1: Bereken rechthoekszijde b met Pythagoras\n`;
            steps += `Formule: b = √(c² - a²)\n`;
            steps += `Vul in: b = √(${zijden.c}² - ${zijden.a}²)\n`;
            zijden.b = Math.sqrt(zijden.c*zijden.c - zijden.a*zijden.a);
            steps += `Stap 2: Bereken: b = ${zijden.b.toFixed(2)}\n`;
            resultaat = `Rechthoekszijde b = ${zijden.b.toFixed(2)}`;
        }
        
        // Bereken hoeken als we alle zijden hebben
        if (zijden.a && zijden.b && zijden.c) {
            steps += `\nStap 3: Bereken hoek α met tangens\n`;
            steps += `Formule: tan(α) = overstaande/aanliggende = a/b\n`;
            steps += `Vul in: tan(α) = ${zijden.a}/${zijden.b}\n`;
            alpha = Math.atan2(zijden.a, zijden.b) * 180 / Math.PI;
            steps += `Stap 4: Bereken: α = tan⁻¹(${zijden.a}/${zijden.b}) ≈ ${alpha.toFixed(2)}°\n`;
            
            steps += `\nStap 5: Bereken hoek β\n`;
            steps += `Formule: β = 90° - α\n`;
            steps += `Vul in: β = 90° - ${alpha.toFixed(2)}°\n`;
            beta = 90 - alpha;
            steps += `Stap 6: Bereken: β ≈ ${beta.toFixed(2)}°\n`;
            
            resultaat += `<br>Hoeken berekend: α ≈ ${alpha.toFixed(2)}°, β ≈ ${beta.toFixed(2)}°`;
        }
    } 
    // Als we een zijde en een hoek hebben
    else if ((a || b || c) && (alpha || beta)) {
        // Bereken ontbrekende hoek
        if (!alpha && beta) {
            steps += `Stap 1: Bereken hoek α\n`;
            steps += `Formule: α = 90° - β\n`;
            steps += `Vul in: α = 90° - ${beta}°\n`;
            alpha = 90 - beta;
            steps += `Stap 2: Bereken: α = ${alpha}°\n`;
        } else if (!beta && alpha) {
            steps += `Stap 1: Bereken hoek β\n`;
            steps += `Formule: β = 90° - α\n`;
            steps += `Vul in: β = 90° - ${alpha}°\n`;
            beta = 90 - alpha;
            steps += `Stap 2: Bereken: β = ${beta}°\n`;
        }
        
        // Bereken zijden met goniometrie
        if (c) {
            steps += `\nStap 3: Bereken zijden met sinus/cosinus\n`;
            steps += `Formule: a = c × sin(α)\n`;
            a = c * Math.sin(alpha * Math.PI / 180);
            steps += `Vul in: a = ${c} × sin(${alpha}°) ≈ ${a.toFixed(2)}\n`;
            
            steps += `Formule: b = c × cos(α)\n`;
            b = c * Math.cos(alpha * Math.PI / 180);
            steps += `Vul in: b = ${c} × cos(${alpha}°) ≈ ${b.toFixed(2)}\n`;
            
            resultaat = `Zijden berekend: a ≈ ${a.toFixed(2)}, b ≈ ${b.toFixed(2)}, c = ${c}<br>`;
            resultaat += `Hoeken: α = ${alpha}°, β = ${beta}°`;
        } else if (a) {
            steps += `\nStap 3: Bereken zijden met sinus/tangens\n`;
            steps += `Formule: c = a / sin(α)\n`;
            c = a / Math.sin(alpha * Math.PI / 180);
            steps += `Vul in: c = ${a} / sin(${alpha}°) ≈ ${c.toFixed(2)}\n`;
            
            steps += `Formule: b = a / tan(α)\n`;
            b = a / Math.tan(alpha * Math.PI / 180);
            steps += `Vul in: b = ${a} / tan(${alpha}°) ≈ ${b.toFixed(2)}\n`;
            
            resultaat = `Zijden berekend: a = ${a}, b ≈ ${b.toFixed(2)}, c ≈ ${c.toFixed(2)}<br>`;
            resultaat += `Hoeken: α = ${alpha}°, β = ${beta}°`;
        } else if (b) {
            steps += `\nStap 3: Bereken zijden met cosinus/tangens\n`;
            steps += `Formule: c = b / cos(α)\n`;
            c = b / Math.cos(alpha * Math.PI / 180);
            steps += `Vul in: c = ${b} / cos(${alpha}°) ≈ ${c.toFixed(2)}\n`;
            
            steps += `Formule: a = b × tan(α)\n`;
            a = b * Math.tan(alpha * Math.PI / 180);
            steps += `Vul in: a = ${b} × tan(${alpha}°) ≈ ${a.toFixed(2)}\n`;
            
            resultaat = `Zijden berekend: a ≈ ${a.toFixed(2)}, b = ${b}, c ≈ ${c.toFixed(2)}<br>`;
            resultaat += `Hoeken: α = ${alpha}°, β = ${beta}°`;
        }
    } else {
        resultaat = "Onvoldoende gegevens om de driehoek op te lossen. Geef minstens 2 zijden of 1 zijde en 1 hoek.";
    }

    document.getElementById('driehoekResult').innerHTML = resultaat;
    document.getElementById('driehoekSteps').innerHTML = steps;
}
</script>
</body>
</html>