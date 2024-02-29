/**
 * Author: Sven Vanhoecke 
 * Source: vanhoeckes.be/wiskunde
 * Fiddle (v1): https://jsfiddle.net/vhsbabo/o7fLgbe5/
 * Fiddle (v2): https://jsfiddle.net/vhsbabo/36w2Lnkx/
 */
function opgave(b,c,show)
{	//show is object like {b:5, B:50}
	//Basisinstellingen
	var canvas = document.getElementById("surface");
	var context = canvas.getContext("2d");
	var marge = 25;
	var x = Math.round(canvas.clientWidth/2/marge - b / 2), 
			y = Math.round(canvas.clientHeight/2/marge - c / 2);
  context.clearRect(0, 0, canvas.width, canvas.height);
  raster(canvas, context, marge);
  rechthoekigeDriehoek(canvas,context,x,y,b,c,marge,show);
}
//////////////////////////////////
//Raster
function raster(canvas, context, marge)
{
	context.lineWidth = 0.3;
  context.strokeStyle = 'blue';
  context.beginPath();
  for(var i=0;i<Math.max(canvas.clientWidth, canvas.clientHeight)/marge;i++)
  {
    //X-as
    context.moveTo(i*marge, 0);
    context.lineTo(i*marge, canvas.clientHeight);
    //Y-as
    context.moveTo(0,i*marge);
    context.lineTo(canvas.clientWidth, i*marge);
  }
  context.closePath();
  context.stroke();
}
//Figuur
function rechthoekigeDriehoek(canvas, context, x, y, b, c, marge, show)
{
	context.lineWidth = 3;
  context.strokeStyle = 'green';
	context.beginPath();
	context.font = "16px Arial";
  context.fillStyle = "green";
  //Horizontaal
	context.fillText("A",(x-1)*marge,y*marge);
  context.moveTo(x*marge,y*marge);
  context.lineTo((x+b)*marge,y*marge);
  //Verticaal
  context.fillText("B",(x-1)*marge,(y+c)*marge);
  context.moveTo(x*marge,y*marge);
  context.lineTo(x*marge,(y+c)*marge);
  if ('B' in show){ 
  	context.fillText(show.B+"°",(x+b/24)*marge,(y+c-c/6)*marge); 
    context.moveTo(x*marge,(y+c)*marge);
    context.arc(x*marge, (y+c)*marge, marge*c/6, -Math.PI/2, -Math.PI/2+ Math.atan(b/c));
  }
  //Schuin
  context.fillText("C",(x+b)*marge,y*marge);
  context.moveTo((x+b)*marge,y*marge);
  context.lineTo(x*marge,(y+c)*marge);
  if ('C' in show){ 
  	context.fillText(show.C+"°",(x+b*5/6)*marge-20,(y+c/24)*marge+20); 
    context.moveTo((x+b)*marge,y*marge);
    context.arc((x+b)*marge, y*marge, marge*b/6, -Math.PI, -Math.PI- Math.atan(c/b), true);
   }
  context.closePath();
  context.stroke();
  //L-symbool en zo
  context.beginPath();
  context.font = "16px Arial";
  context.lineWidth = 1;
  context.moveTo(x*marge+marge/5, y*marge+marge/5);
  context.lineTo(x*marge+3*marge/5, y*marge+marge/5);
  context.moveTo(x*marge+marge/5, y*marge+marge/5);
  context.lineTo(x*marge+marge/5, y*marge+3*marge/5);
  if('b' in show)
  {
  	context.fillText(show.b,canvas.clientWidth/2,(y-0.5)*marge);
  }
  /*
   else{
  	context.fillText("b",canvas.clientWidth/2,(y-0.5)*marge);
  }*/
  if('c' in show)
  {
  	context.fillText(show.c,(x-1)*marge,canvas.clientHeight/2);
  }
  /*
  else{
  	context.fillText("c",(x-1)*marge,canvas.clientHeight/2);
  }
  */
  if('a' in show)
  {
  	context.fillText(show.a,(x+0.5+b/2)*marge,(y+0.5+c/2)*marge);
  }
  /*
  else{
  	context.fillText("a",(x+0.5+b/2)*marge,(y+0.5+c/2)*marge);
  }*/
  
  context.closePath();
  context.stroke();
}
