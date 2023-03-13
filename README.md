# LocalNetworkScanner

The purpose is to have the bash script running periodically to identify the devices within a network, as well as their open ports, representing the information in a web table.

#LocalNetworkScanner.sh (script that performs the search functions)

#networkScanner.php (php script that generates a table from the data collected by the bash script)

#Used folders:

./arp/("IPS_FILES_WITH_MAC_ADDRESSES")

./ips/("IPS_FILES_WITH_OPEN_PORTS")

./names/("IPS_FILES_WITH_FRIENDLY_NAMES")

# As an additional task, you could configure an alert to be sent by mail every time a new device is found
