<?php

function check($ip,$puerto){
    if($puerto <> "0"){
        if(fsockopen($ip,$puerto,$timeout = 1))
        {
                print "<td bgcolor=green width=20>";
        }
        else
        {
                print "<td bgcolor=red width=20>";
        }
    }
}

$fileList = glob('./ips/192.168.*');
natsort($fileList);

print ("<table border=1>");
foreach($fileList as $filename){
        if(is_file($filename)){

                $ip_array = explode ("./ips/", $filename);
                $ip = $ip_array[1];
                print ("<tr>");

                $linesP = fopen($filename,'r');
                $puertos = (fgets($linesP));
                $puerto = explode (",",$puertos);
                $puerto = ($puerto[0]);
                fclose($linesP);
                check($ip,$puerto);
                print ("</td>");

                $ruta_last = "./last/".$ip;
                $last = fopen($ruta_last,"r");
                print ("<td><font color=blue>".fgets($last)."</font></td>");
                fclose($ruta_last);

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
