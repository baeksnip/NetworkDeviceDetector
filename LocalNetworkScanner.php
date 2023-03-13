<?php
$fileList = glob('./ips/192.168.*');
natsort($fileList);

print ("<table border=1>");
foreach($fileList as $filename){
        if(is_file($filename)){
                $ip_array = explode ("./ips/", $filename);
                $ip = $ip_array[1];
                print ("<tr>");

                $ruta_nombres = "./nombres/".$ip;
                $nombres = fopen($ruta_nombres,"r");
                print ("<td><font color=blue>".fgets($nombres)."</font></td>");
                fclose($ruta_nombres);

                $ruta_arp = "./arp/".$ip;
                $arp = fopen($ruta_arp,"r");
                print ("<td><font color=red>".fgets($arp)."</font></td>");
                fclose($ruta_arp);

                print ("<td><b>".$ip."</b></td>");

                $lines = fopen($filename,'r');
                while ($line = fgets($lines)) {
                        print ("<td>".$line."</td>");
                }

                fclose($lines);
                print ("</tr>");
        }
}
print ("</table>");
?>
