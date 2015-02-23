//// drag div
// Cargo los ID's de los arrays que se convierten en "scrollables"
var scrollDivs=new Array();
scrollDivs[0]="despacho";
scrollDivs[1]="";

function carga()
{
	posicion=0;
	
	// IE
	if(navigator.userAgent.indexOf("MSIE")>=0) navegador=0;
	// Otros
	else navegador=1;

	registraDivs();
}

function registraDivs()
{
	for(divId in scrollDivs)
	{
		document.getElementById(scrollDivs[divId]).onmouseover=function() { this.style.cursor="move"; }
		document.getElementById(scrollDivs[divId]).ondblclick=comienzoMovimiento;
	}
}

function evitaEventos(event)
{
	// Funcion que evita que se ejecuten eventos adicionales
	if(navegador==0)
	{
		//window.event.cancelBubble=true;
		//window.event.returnValue=false;
	}
	//if(navegador==1) event.preventDefault();
}

function comienzoMovimiento(event)
{
	var id=this.id;
	elMovimiento=document.getElementById(id);
	
	 // Obtengo la posicion del cursor
	 
	if(navegador==0)
	 {
	 	cursorComienzoX=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		cursorComienzoY=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}
	if(navegador==1)
	{    
		cursorComienzoX=event.clientX+window.scrollX;
		cursorComienzoY=event.clientY+window.scrollY;
	}
	
	elMovimiento.onmousemove=enMovimiento;
	elMovimiento.onmouseup=finMovimiento;
	
	elComienzoX=parseInt(elMovimiento.style.left);
	elComienzoY=parseInt(elMovimiento.style.top);
	// Actualizo el posicion del elemento
	elMovimiento.style.zIndex=++posicion;
	
	evitaEventos(event);
}

function enMovimiento(event)
{  
	var xActual, yActual;
	if(navegador==0)
	{    
		xActual=window.event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		yActual=window.event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}  
	if(navegador==1)
	{
		xActual=event.clientX+window.scrollX;
		yActual=event.clientY+window.scrollY;
	}
	
	elMovimiento.style.left=(elComienzoX+xActual-cursorComienzoX)+"px";
	elMovimiento.style.top=(elComienzoY+yActual-cursorComienzoY)+"px";

	evitaEventos(event);
}

function finMovimiento(event)
{
	elMovimiento.onmousemove=null;
	elMovimiento.onmouseup=null;
}

window.onload=carga;
//// fin drag div


function resultadoUpload(estado, file,respuesta,id) {
var link = '<br />';
if (estado == 0)
var mensaje = '<img class=" img-thumbnail responsive" src="'+respuesta+'images/secure/?file=600/' + file + '" >' + link;

if (estado == 1)
var mensaje = 'Error ! - El Archivo no llego al servidor' + link;

if (estado == 2)
{var mensaje = '<img src="'+respuesta+'images/atencion.gif"> Error ! - Tipo de archivo incorrecto o demasiado grande' + link;
 }
if (estado == 3)
var mensaje = 'Error ! - No se pudo copiar Archivo. Posible problema de permisos en server' + link;
document.getElementById('formUpload').innerHTML=mensaje;
document.getElementById(id).value=file;
}

function resultadoUploadArchivo(estado,file,div) {
var link = '';
if (estado == 0)

var mensaje = '<div id="boton_subir"><input class="btn btn-success btn-block" type="button" value="Importar" onclick="xajax_formulario_importar(\''+file+'\',\'grabar\',(document.getElementById(\'seleccion_formulario\').value)) "></div>';
if (estado == 1)
var mensaje = 'Error ! - El Archivo ('+ file +') no llegó al servidor' + link;
if (estado == 2)
var mensaje = ' <div class="alert alert-danger">Error ! - Tipo de archivo incorrecto o demasiado grande</div>';
if (estado == 3)
var mensaje = 'Error ! - No se pudo copiar Archivo. Posible problema de permisos en server' + link;
document.getElementById(''+div+'').innerHTML=mensaje;
//document.getElementById('archivo').value=file;
xajax_formulario_importar(''+file+'','',(document.getElementById("seleccion_formulario").value));
} 


// En Javascript
///sugiere



val=0;

function numeros(e,item_cie,Vtipo,Tabla,Campo,Campo_descripcion)
{
window["item_cie"] = item_cie;
window["Vinput"] = "buscar"+item_cie;
window["Vcontenedor"] = "contenedor"+item_cie;
window["Vtipo"] = Vtipo;
window["Tabla"] = Tabla;
window["Campo"] = Campo;
window["Campo_descripcion"] = Campo_descripcion;

var key;
if(window.event) // IE
{
  key = e.keyCode;
  nav='ie';
}
  else if(e.which) // Netscape/Firefox/Opera
{
  key = e.which;
  nav='otro';
}
if(key!=40 && key!=38){if(key==13 && val!=0){dat='e'+val;document.getElementById(Vinput).value=document.getElementById(dat).innerHTML;document.getElementById(Vcontenedor).innerHTML='';document.getElementById(Vcontenedor).style.display='none';
}else{val=0;document.getElementById(Vcontenedor).scrollTop =0;OnKeyRequestBuffer.modified(Vinput);}}
                else{if (key==40){node = document.getElementById('lista'+item_cie);
          if(val<node.childNodes.length)
          {
          try{
          document.getElementById(val).className='nosel';
          }
          catch(e)
          {
          }
val++;
alto=document.getElementById(val).offsetTop;
document.getElementById(Vcontenedor).scrollTop =alto;
document.getElementById(val).className='sel';
}
}
          if (key==38){
          if(val>=1)
          {
          document.getElementById(val).className='nosel';
          try{
                   val--;
                   alto=document.getElementById(val).offsetTop;
                 document.getElementById(Vcontenedor).scrollTop =alto;
                 document.getElementById(val).className='sel';
         }
         catch(e)
          {
          }
          }
}
}
}

    var OnKeyRequestBuffer =
    {
        bufferText: false,
        bufferTime: 500,
       
        modified : function(strId)
        {
                setTimeout('OnKeyRequestBuffer.compareBuffer("'+strId+'","'+xajax.$(strId).value+'");', this.bufferTime);
        },
       
        compareBuffer : function(strId, strText)
        {
            if (strText == xajax.$(strId).value && strText != this.bufferText)
            {
                this.bufferText = strText;
                OnKeyRequestBuffer.makeRequest(strId);
            }
        },
       
        makeRequest : function(strId)
        {
       
            this.bufferText = '';
            if(Vtipo == "generico"){
            xajax_sugiere_generico(xajax.$(strId).value,item_cie,Tabla,Campo,Campo_descripcion);
            }else{
            xajax_sugiere(xajax.$(strId).value,item_cie);
            }
        }
    }
    function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
function limpia(Vcontenedor)
{
document.getElementById(Vcontenedor).innerHTML='';
document.getElementById(Vcontenedor).style.display='none';

}
function revisa(Vinput)
{
if(document.getElementById(Vinput).value!='')
{
return 'si';
}
else
{
return 'no';
}
}
function sobre()
{
try{document.getElementById(val).className='nosel';val=0;}catch(e){}

}

// finsugiere


function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="hand";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}


   function SoloCerrar(){
window.close()
}

function actualizar()
{
location.reload();
}
   function amplia(){
    resizeTo(screen.width-10,screen.height-80)
    moveTo(0, 0);
   }
   
function abrir(ventana,nombre,a,b,c,d,v,r)
{
e='width='+a+','
f='height='+b+','
g='screenx='+c+','
h='screeny='+d+','
s='scrollbars='+v+','
j='alwaysRaised='+r+','
hola=window.open(ventana,nombre,e+f+g+h+s+j);
hola.focus()
}

function toggleDiv(id,flagit) {

if (flagit=="1"){
if (document.layers) document.layers[''+id+''].visibility = "show"
else if (document.all) document.all[''+id+''].style.visibility = "visible"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"
}
else
if (flagit=="0"){
if (document.layers) document.layers[''+id+''].visibility = "visible"
else if (document.all) document.all[''+id+''].style.visibility = "hidden"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"
}
}

