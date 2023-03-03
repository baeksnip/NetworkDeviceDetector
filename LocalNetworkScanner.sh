#!/bin/bash

# Config parametros #
rango="192.168.100"
ruta_ficheros="./scan/"
# Config parametros #

#Escaneo de IPs
for ip in $(seq 1 254); do
        timeout 1 bash -c "ping -c 1 $rango.$ip" &>/dev/null && touch $ruta_ficheros$rango"."$ip &
done; wait

#Escaneo de puertos si el fichero de la ip esta vacio
for fichero_ip in `ls $ruta_ficheros`; do
        if ! [ -s $ruta_ficheros$fichero_ip ]; then
                printf $fichero_ip"\n"
                for port in $(seq 1 65535); do
                        timeout 0.1 bash -c "echo '' > /dev/tcp/$fichero_ip/$port" 2>/dev/null && echo -n $port"," >> $ruta_ficheros$fichero_ip
                done; wait
        fi
done
