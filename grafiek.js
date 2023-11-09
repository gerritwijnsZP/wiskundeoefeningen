/**
 * Author: Sven Vanhoecke 
 * Source: vanhoeckes.be/wiskunde
 * Fiddle: https://jsfiddle.net/vhsbabo/a651snr2/
 */
function teken(f)
{
	var canvas = document.getElementById("surface");
	var context = canvas.getContext("2d");
	context.clearRect(0, 0, canvas.width, canvas.height);
	var marge = parseInt(document.getElementById('marge').value),
  		x_waarde = parseInt(document.getElementById('x').value),
      y_waarde = parseInt(document.getElementById('y').value);
  raster(canvas, context, marge, x_waarde, y_waarde);
  grafiek(canvas, context, f,marge, x_waarde, y_waarde);
}

function raster(canvas, context, marge, x_centrum, y_centrum)
{
	
  //Raster
  for(var i=1; i < Math.max(canvas.clientWidth/2+Math.abs(x_centrum)*marge, canvas.clientHeight/2+Math.abs(y_centrum)*marge)/marge; i++)
  {
  	context.beginPath();
    context.lineWidth = 0.7; 
    if(i % 5 == 0)
    {context.strokeStyle = 'blue';}
    else
    {context.strokeStyle = 'lightgrey';}
    //Links verticaal
    context.moveTo(canvas.clientWidth/2+(x_centrum-i)*marge, 0);
    context.lineTo(canvas.clientWidth/2+(x_centrum-i)*marge, canvas.clientHeight);
    //Rechtsverticaal
    context.moveTo(canvas.clientWidth/2+x_centrum*marge+i*marge, 0);
    context.lineTo(canvas.clientWidth/2+x_centrum*marge+i*marge, canvas.clientHeight);
    //Boven horizontaal
    context.moveTo(0, canvas.clientHeight/2-i*marge-y_centrum*marge);
    context.lineTo(canvas.clientWidth,canvas.clientHeight/2-i*marge-y_centrum*marge);
    //Onder horizontaal
    context.moveTo(0, canvas.clientHeight/2+(i-y_centrum)*marge);
    context.lineTo(canvas.clientWidth, canvas.clientHeight/2+(i-y_centrum)*marge);
    context.closePath();
    context.stroke();
  }
  //x en Y
  context.lineWidth = 2.5;
  context.strokeStyle = 'red';
  context.fillStyle = "red";
  context.font = "20px Arial";
  context.beginPath();
  context.fillText('x',canvas.clientWidth-20, canvas.clientHeight/2-y_centrum*marge-10);
  canvas_arrow(context, 0,canvas.clientHeight/2-y_centrum*marge, canvas.clientWidth, canvas.clientHeight/2-y_centrum*marge);
  context.fillText('y',canvas.clientWidth/2+x_centrum*marge+10, 20);
  canvas_arrow(context, canvas.clientWidth/2+x_centrum*marge, canvas.clientHeight, canvas.clientWidth/2+x_centrum*marge, 0);
  context.closePath();
  context.stroke();
  //Eenheden
  context.beginPath();
  context.moveTo(canvas.clientWidth/2+x_centrum*marge+marge, canvas.clientHeight/2-y_centrum*marge-marge*0.1);
  context.lineTo(canvas.clientWidth/2+x_centrum*marge+marge, canvas.clientHeight/2-y_centrum*marge+marge*0.05);
  context.moveTo(canvas.clientWidth/2+x_centrum*marge-marge*0.05, canvas.clientHeight/2-y_centrum*marge-marge);
  context.lineTo(canvas.clientWidth/2+x_centrum*marge+marge*0.1, canvas.clientHeight/2-y_centrum*marge-marge);
  if(marge >= 25 && marge <= 60)
  {
	  context.fillStyle = "red";
	  context.font = Math.round(3+marge/2.5)+"px Arial";
	  context.fillText('0',canvas.clientWidth/2+x_centrum*marge-marge*0.35, canvas.clientHeight/2-y_centrum*marge+marge*0.45);  
	  context.fillText('1',canvas.clientWidth/2+x_centrum*marge+marge*0.9, canvas.clientHeight/2-y_centrum*marge+marge*0.45);
	  context.fillText('1',canvas.clientWidth/2+x_centrum*marge-marge*0.35, canvas.clientHeight/2-y_centrum*marge-marge*0.9);
  }
  context.closePath();
  context.stroke();
 }
function grafiek(canvas, context, f, marge, x_centrum, y_centrum)
{
  context.beginPath();
  context.lineWidth = 1.5;
  context.strokeStyle = 'black';
  var bla = Math.max(canvas.clientWidth/marge/2 + Math.abs(x_centrum),
  										canvas.clientHeight/marge/2 + Math.abs(y_centrum));
	for(var x=-bla; x < bla;x++)
  {
  	for(var i=0; i < 100; i++)
    {
    	var a = x + i/100;
      var b = x + (i+1)/100;
    	context.moveTo(	a*marge+canvas.clientWidth/2+x_centrum*marge,
      								canvas.clientHeight/2-y_centrum*marge-f(a)*marge);
    	context.lineTo(	b*marge+canvas.clientWidth/2+x_centrum*marge,
											canvas.clientHeight/2-y_centrum*marge-f(b)*marge);
    }
  }
  context.closePath();
	context.stroke();
}
//Pijltjes
document.onkeydown = checkKey;
function checkKey(e) {

    e = e || window.event;

    if (e.keyCode == '38') {
        var y = parseInt(document.getElementById("y").value);
        document.getElementById("y").value = y + 1;
    }
    else if (e.keyCode == '40') {
        var y = parseInt(document.getElementById("y").value);
        document.getElementById("y").value = y - 1;
    }
    else if (e.keyCode == '37') {
       var x = parseInt(document.getElementById("x").value);
        document.getElementById("x").value = x - 1;
    }
    else if (e.keyCode == '39') {
       var x = parseInt(document.getElementById("x").value);
        document.getElementById("x").value = x + 1;
    }
    teken(f);
}
//https://stackoverflow.com/questions/808826/draw-arrow-on-canvas-tag
function canvas_arrow(context, fromx, fromy, tox, toy) {
  var headlen = 10; // length of head in pixels
  var dx = tox - fromx;
  var dy = toy - fromy;
  var angle = Math.atan2(dy, dx);
  context.moveTo(fromx, fromy);
  context.lineTo(tox, toy);
  context.lineTo(tox - headlen * Math.cos(angle - Math.PI / 6), toy - headlen * Math.sin(angle - Math.PI / 6));
  context.moveTo(tox, toy);
  context.lineTo(tox - headlen * Math.cos(angle + Math.PI / 6), toy - headlen * Math.sin(angle + Math.PI / 6));
}
