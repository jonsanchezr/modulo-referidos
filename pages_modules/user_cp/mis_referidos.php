<?php
/*
* @+================================================================+
* @¦ Modulo Sistema de Referidos MUCore                             ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/

//funcion para mostrar mensaje y redireccionar
function notice_message($notice, $redirect = 0, $error = 0, $url)
{
if ($url == null) {
$url_red = '';
} else {
$url_red = $url;
}
if ($error == 1) {
$title   = "Error";
$go_back = '<p><a href="javascript:history.go(-1);">Go Back</a></p>';
} else {
$title = "Success";
}
$return_msg = '<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;"><p>' . $notice . '</p>' . $go_back . '
</td> 
</tr>
</table>';
if ($redirect == 1) {
$return_msg .= '<meta http-equiv="Refresh" content="1; URL=' . $url_red . '">';
}
return $return_msg;
}


//abrir archivo del config
$get_config = simplexml_load_file('engine/referido_settings.xml');
$active = trim($get_config->active);
$f1 = trim($get_config->f1);
$f2 = trim($get_config->f2);
$f3 = trim($get_config->f3);
$f4 = trim($get_config->f4);

if ($active == '0') {

} 

else {
	
//thejonyx-comprobar si existe el archivo sino se crea
$nombre_referido = 'referido/user/'.$user_auth_id.'.tDB';
	if (!file_exists($nombre_referido)) {
	$new_db = fopen('referido/user/'.$user_auth_id.'.tDB', "w+");
	fwrite($new_db);
	fclose($new_db);
	} 
								
$vf = file('referido/user/'.$user_auth_id.'.tDB.');

//si el user da cobrar
if($_POST['cobrar'] == 'cobrar'){
	$ref = $_POST['ref'];
    $dat = $_POST['dat'];
	
	//monedas escogidas en el admin (por defecto WCoinC)
    $update = $core_db2->Execute( "Update ".$f2." set ".$f3." = ".$f3." +?  where ".$f4." =?", array(
        $f1,
        $user_auth_id
    ) );
    if ( $update )
    {
		$p_id   = safe_input(xss_clean($_POST['ref']), '_');
        $p_file = file('referido/user/'.$user_auth_id.'.tDB');
        foreach ($p_file as $check_id) {
            $check_id = explode("¦", $check_id);
            if ($check_id[0] == $p_id) {
                $ref_id  = $check_id[0];
                $data    = $check_id[1];
                break;
            }
        }
        if (isset($_POST['cobrar'])) {
				$idadfly  = $_POST['ref'];
                $title    = $_POST['dat'];
                    
                $old_db = file("referido/user/".$user_auth_id.".tDB");
                $new_db = fopen("referido/user/".$user_auth_id.".tDB", "w");
                foreach ($old_db as $old_db_line) {
                    $old_db_arr = explode("¦", $old_db_line);
                    if ($p_id != $old_db_arr[0]) {
                        fwrite($new_db, "$old_db_line");
                    } else {
                        fwrite($new_db, $ref_id . "¦" . $data . "¦" . "pagado" . "¦\n");
                    }
                }
                fclose($new_db);
                echo notice_message('<div class="msg_success" align="center">Premio de Referido Agregado con Exito</div>', 1, 0, 'index.php');
            }
            
    }
    else
    {
        echo "A ocurrido un, system error";
    }
	
}

?>
<style>
.btn {
  font-family: Arial;
  color: #ffffff;
  font-size: 14px;
  background: #4CAF50;
  padding: 5px 5px 5px 5px;
  text-decoration: none;
}

.btn:hover {
  background: #387d3b;
  text-decoration: none;
}

</style>
<h2 style="margin-top:20px;">Lista de referidos</h2>
<table style="	background-color: white; border-collapse: collapse; width: 100%;">
  <tr>
    <th style="background-color: #4CAF50; color: white; text-align: left; padding: 8px;">Referido</th>
    <th style="background-color: #4CAF50; color: white; text-align: left; padding: 8px;">Creado</th>
    <th style="background-color: #4CAF50; color: white; text-align: left; padding: 8px;">Recompensa</th>
  </tr>
        <?  
        $ss = 0;
foreach ($vf as $vote_data){
$vote_data = explode('¦',$vote_data);
$ss++;
echo '  
		<tr>
			<td style="text-align: left; padding: 8px; color: black;">'.$vote_data[0].'</td>
			<td style="text-align: left; padding: 8px; color: black;">'.$vote_data[1].'</td>
			<td style="text-align: left; padding: 8px; color: black;">';
			if ($vote_data[2] == 'pagado'){
				echo 'Pagado';
			} else {
				$query = mssql_query('SELECT [AccountID] FROM [dbo].[warehouse]');
				for ($i = 0; $i < mssql_num_rows($query); ++$i) {
				$hola = mssql_result($query, $i, 'AccountID');
        			if($vote_data[0] == $hola){
						echo'<form method="post" action="">
						<input name="ref" value="'.$vote_data[0].'" type="hidden" />
						<input name="dat" value="'.$vote_data[1].'" type="hidden" />
						<input class="btn" type="submit" name="cobrar" value="cobrar"/></form>';
					}
    			}
			}
			
		echo '</td></tr>';
}
}
?>
</table>

<div style="background-color:#4CAF50; width: 100%;padding:8px;color:white; margin-top:30px;">Su enlace de Referido es:  <b> <?=$core['config']['website_url']?>/index.php?page_id=register&ref=<?=$user_auth_id?> </b></div>
<?php
/*
* @+================================================================+
* @¦ Modulo Sistema de Referidos MUCore                             ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/
?>