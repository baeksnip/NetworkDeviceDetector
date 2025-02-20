<?php
function check($ip,$puerto){
    if($puerto <> "0,"){
        if(fsockopen($ip,$puerto,$errno,$errstr,1))
        {
		print "<td bgcolor=green width=20>";
        }
        else
        {
		print "<td bgcolor=red width=20>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$ficheroEditado=$_REQUEST['fichero'];
	$nombreEditado=$_REQUEST['nombre'];
	$fp = fopen($ficheroEditado, 'w');
	fwrite($fp, $nombreEditado);
	fclose($fp);
}

$fileList = glob('./_puertos/*');
natsort($fileList);

print("
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
");

//CABECERAS DE TABLA
print ("<table>");
print ("
<tr>
<td><b>Fecha</td>
<td><b>Activo</td>
<td><b>Nombre</td>
<td><b>IP</td>
<td><b>Puertos</td>
<td><b>Mac</td>
");

foreach($fileList as $filename){
	if(is_file($filename)){
		$ip_array = explode ("./_puertos/", $filename);	//CAPTURO IPS DESCUBIERTAS POR SCRIPT BASH
		$ip = $ip_array[1];
		print ("<tr>");

                $ruta_last = "./_fecha/".$ip;			//FECHA
                $last = fopen($ruta_last,"r");
                print ("<td valign='top'>".fgets($last)."</td>");
                fclose($ruta_last);
                $linesP = fopen($filename,'r');

		$puertos = (fgets($linesP));
		$puerto = explode (",",$puertos);
		$puerto = ($puerto[0]);
		fclose($linesP);
		check($ip,$puerto);				//COLOR SI ESTÁ ACTIVO EN ESTE MISMO MOMENTO
		print ("</td>");

                $ruta_nombre = "./_nombre/".$ip;		//NOMBRE EDITABLE
		touch($ruta_nombre);
                $nombre = fopen($ruta_nombre,"r");
		print ("<td style='font-size:0px;'><form method='post'><input type='hidden' name='fichero' value='".$ruta_nombre."'><input style='font-size:14px;border:0;outline:0;' type='text' name='nombre' value='".fgets($nombre)."'></form></td>");
                fclose($ruta_nombre);

	        print ("<td valign='top'>".$ip."</td>");	//IP

		print("<td valign='top'>");			//LISTADO DE PUERTOS
		$lines = fopen($filename,'r');
		while ($line = fgets($lines)) {
			print ($line);
		}
		fclose($lines);
		print("</td>");

                $ruta_arp = "./_mac/".$ip;			//MAC
                $arp = fopen($ruta_arp,"r");
                print ("<td valign='top'>".fgets($arp)."</td>");
                fclose($ruta_arp);
		print ("</tr>");
	}
}
print ("</table>");
?>
