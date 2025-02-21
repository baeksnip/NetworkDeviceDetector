#!/bin/bash
function ctrl_c(){
 exit 1
}
trap ctrl_c INT

# Configuración de rango y rutas #
rango="192.168.100"
ruta_ficheros_puertos="/var/www/html/argos/_puertos/"
ruta_ficheros_mac="/var/www/html/argos/_mac/"
ruta_ficheros_fecha="/var/www/html/argos/_fecha/"
ruta_ficheros_nombre="/var/www/html/argos/_nombre/"
fecha=`date +"%d/%m/%Y %H:%M"`
# Config parametros #

#Escaneo de IPs
for ip in $(seq 1 254); do
        timeout 1 bash -c "ping -c 1 $rango.$ip" &>/dev/null && touch $ruta_ficheros_puertos$rango"."$ip && echo -n $fecha > $ruta_ficheros_fecha$rango"."$ip &
done; wait

#Consulta MAC si el fichero de la MAC esta vacio
for fichero_ip in `ls $ruta_ficheros_puertos`; do
        if ! [ -s $ruta_ficheros_mac$fichero_ip ]; then
                bash -c "ip neigh | grep $fichero_ip' '" | awk '{print $5}' > $ruta_ficheros_mac$fichero_ip
        fi
done

#Escaneo de puertos si el fichero de la ip esta vacio 65535
for fichero_ip in `ls $ruta_ficheros_puertos`; do
	size=$(wc -c < "$ruta_ficheros_puertos$fichero_ip") 	#Compruebo que el fichero este totalmente vacio
	if [ "$size" -le 2 ]; then				#Si esta vacio es que no pudo escanear la ip o no encontro ningun puerto abierto
		rm $ruta_ficheros_puertos$fichero_ip		#No quiero utilizar el fichero si ocupa un byte
		touch $ruta_ficheros_puertos$fichero_ip		#Lo borro y lo creo vacio
                for port in $(seq 1 65535); do
                        timeout 0.1 bash -c "echo '' > /dev/tcp/$fichero_ip/$port" 2>/dev/null && echo -n $port"," >> $ruta_ficheros_puertos$fichero_ip
                done; wait
        fi
done

