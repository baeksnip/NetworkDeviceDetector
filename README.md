# LocalNetworkScanner

La finalidad es tener el script de bash ejecutandose de forma periodica para tener identificados los dispositivos dentro de una red, así como sus puertos abiertos, representando la información en una tabla web.

#LocalNetworkScanner.sh (script que realiza las funciones de busqueda)

#networkScanner.php (Script php que genera una tabla a partir de los datos recabados por el script bash)

#Carpetas utilizadas:

./arp/("FICHEROS_IPS_CON_DIRECCIONES_MAC")

./ips/("FICHEROS_IPS_CON_PUERTOS_ABIERTOS")

./nombres/("FICHEROS_IPS_CON_NOMBRES_DESCRIPTIVOS")

#Como tarea adicional, se podría configurar una alerta a enviar por correo cada vez que se encuentre un nuevo dispositivo
