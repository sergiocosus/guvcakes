  var imagenFondo=[
    'templo_borroso.jpg',
'fondo_ojo_noche.jpg',
'90564086.jpg',
'90564087.jpg',
'90754441.jpg',
'88507987.jpg',
'97097558.jpg'];
var nFondo=Math.floor(Math.random()*imagenFondo.length);
$('body').css('background-image','url("/imagenes/fondos/'+imagenFondo[nFondo]+'")');
         
