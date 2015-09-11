
function select_dependiente() //nombre de la funcion

{

$("#select1").change(function () //Aqui va el primer select a utilizar.

{

$("#select1 option:selected").each(function () //Opción seleccionada

{

//Se le pasa a la variable opcion1 el valor del <input>

var opcion1=$(this).val();

//lavariable es enviada mediante $_POST['opcion_1'] al archivo llamado filtro1.php.

$.post("filtro1.php", { opcion_1: opcion1 }, function(datos)

{

//Todas los <option> impresos en filtro1.php se visualizaran en <select id="select2">

$("#select2").html(datos);

//<select id="select3"> depende de select2

$("#select3").html("");

});

});

})

//el select2 funciona de la misma manera que el select1. Si necesitas 2, 3 o más selects anidados, el procedimiento es el mismo.

$("#select2").change(function ()

{

$("#select2 option:selected").each(function ()

{

var opcion2=$(this).val();

$.post("filtro2.php", { opcion_2: opcion2 }, function(datos)

{

$("#select3").html(datos);

});

});

})

//nada mas para mostrar la funcion del evento click en Jquery.

$("#boton_ver").click(function(evento) //("#id del boton que se utlizará para este evento")

{

//pasamos el valor de select1 a la variable seleccion_1, de igual forma para las siguientes variables.

var seleccion_1=$("#select1 option:selected").val();

var seleccion_2=$("#select2 option:selected").val();

var seleccion_3=$("#select3 option:selected").val();

//enviamos al div con id="listar" el valor de las variables.

$("#listar").html("Medio de transporte= "+seleccion_1+"/ Modelo= "+seleccion_2+"/ Color= "+seleccion_3);});

}
