# LocalNetworkScanner

La finalidad es tener el script de bash ejecutandose de forma periodica para detectar nuevos dispositivos dentro de una red, ya que este realiza un escaneo de 254 IPS dentro de un rango definido, mostrando (MAC,IP y PUERTOS ABIERTOS) en una tabla web.

#LocalNetworkScanner.sh (script que realiza las funciones de busqueda)

#networkScanner.php (Script php que genera una tabla a partir de los datos recabados por el script bash)

#Carpetas utilizadas:

./arp/("FICHEROS_IPS_CON_DIRECCIONES_MAC")

./ips/("FICHEROS_IPS_CON_PUERTOS_ABIERTOS")

./nombres/("FICHEROS_IPS_CON_NOMBRES_DESCRIPTIVOS")
