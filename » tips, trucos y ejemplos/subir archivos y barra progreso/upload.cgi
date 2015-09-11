#!/usr/bin/perl -W

#Definimos los módulos que vamos a utilizar
use CGI;
use CGI::Carp qw(fatalsToBrowser);
use Fcntl qw(:DEFAULT :flock);
use LWP::UserAgent;
use HTTP::Request;
use File::Temp qw/ tempfile tempdir /;
use File::Copy;

##############################################
######VARIABLES QUE HAY QUE MODIFICAR#########
##############################################

#ruta absoluta donde se encuentra nuestro ejemplo
$DIR="/var/www/vhosts/codigo-fuente.com/httpdocs/samples/subir_archivos_barra_progreso_2/";
$URL="http://codigo-fuente.com/samples/subir_archivos_barra_progreso_2/";
$URL_UPLOAD="http://codigo-fuente.com/samples/subir_archivos_barra_progreso_2/upload/";
#definimos el tamaño máximo que permitimos para la subida del archivo en bytes
$MAX_ARCHIVO = 500000; #Aproximadamente 0'5MB Debe coincidir con la definicion _MAX_ARCHIVO_ del archivo proceso.php

##############################################
###FIN VARIABLES QUE HAY QUE MODIFICAR########
##############################################

#Nombre del archivo lo cogemos a traves de la variable GET
#Através de la url cogemos el valor del archivo
@qstring=split(/&/,$ENV{'QUERY_STRING'});
@p1 = split(/=/,$qstring[0]);
$nombre_archivo = $p1[1];
@p2 = split(/=/,$qstring[1]);
$id_archivo = $p2[1];

#capturamos el tamaño total del archivo extrayendolo de la cabecera
$tamano_archivo = $ENV{'CONTENT_LENGTH'};



#EL DIRECTORIO tmp/ y upload/ DEBE TENER 777 DE PRIVILEGIOS
$TMP_DIR ="$DIR"."/tmp";
$UPLOAD_DIR="$DIR"."/upload";
#Declaramos los nombres de los archivos
$G_tam_archivo = "$TMP_DIR/$id_archivo"; #Donde se guardará informacion del archivo


##DEFINIMOS NUEVO DIRCTORIO PARA LOS ARCHIVOS TEMPORALES
($fh, $nombre_archivo_tmp) = tempfile( DIR => $TMP_DIR );
$fh = tempfile();  

$|=1;
  $archivo = $nombre_archivo_tmp;
1;

sysopen(FH, $G_tam_archivo, O_RDWR | O_CREAT)
	or die "No se puede abrir numfile: $!";


# autoflush FH
$ofh = select(FH); $| = 1; select ($ofh);
flock(FH, LOCK_EX)
	or die "No se puede escribir numfile: $!";
seek(FH, 0, 0)
	or die "No se puede volver a trás numfile : $!";
	
#Escribimos la ruta del archivo temporal###el tamaño del archivo#nombre del archivo 
print FH $nombre_archivo_tmp."###".$tamano_archivo."###".$nombre_archivo."###".$disp; 
close(FH);#Cerramos el flujo

#Comprobamos si el tamaño del archivo es mayor que el permitido
if($tamano_archivo > $MAX_ARCHIVO)
{
  close  STDIN;
	salir("S&oacute;lo se permite subir archivos no superior a $max_upload Bytes");
}

#Abrimos el archivo para escribir los datos y lo definimos como TMP
open(TMP,">","$archivo") or &salir ("No se puede abrir el archivo de datos");


#Definimos el contador
my $i=0;
my $a=0;
$ofh = select(TMP); $| = 1; select ($ofh);

while (read (STDIN ,$LINE, 4092) && $bRead < $tamano_archivo )
{	
            $bRead += length $LINE;
          	#Escribimos en el archivo
            print TMP $LINE;
            select(undef, undef, undef,0.35);	# dormimos 0.35 segundos.
}
#Cerramos el archivo
close (TMP);
chmod 0755, $nombre_archivo_tmp;

	print "Location: ".$URL."proceso.php?op=copy&id=$id_archivo\n\n";

sub salir{
  $info = shift;
	print "Content-type: text/html\n\n";
}