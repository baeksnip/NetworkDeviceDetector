#!/bin/bash

function ctrl_c(){
 exit 1
}
trap ctrl_c INT

# Config parametros #
rango="192.168.100"
ruta_ficheros="/var/www/html/netscan/ips/"
ruta_ficheros_arp="/var/www/html/netscan/arp/"
# Config parametros #

#Escaneo de IPs
for ip in $(seq 1 254); do
        timeout 1 bash -c "ping -c 1 $rango.$ip" &>/dev/null && touch $ruta_ficheros$rango"."$ip &
done; wait

#Consulta MAC si el fichero de la MAC esta vacio
for fichero_ip in `ls $ruta_ficheros`; do
        if ! [ -s $ruta_ficheros_arp$fichero_ip ]; then
                bash -c "ip neigh | grep $fichero_ip' '" | awk '{print $5}' > $ruta_ficheros_arp$fichero_ip
        fi
done

#Escaneo de puertos si el fichero de la ip esta vacio
for fichero_ip in `ls $ruta_ficheros`; do
        if ! [ -s $ruta_ficheros$fichero_ip ]; then
                for port in $(seq 1 65535); do
                        timeout 0.1 bash -c "echo '' > /dev/tcp/$fichero_ip/$port" 2>/dev/null && echo -n $port"," >> $ruta_ficheros$fichero_ip
                done; wait
        fi
done
