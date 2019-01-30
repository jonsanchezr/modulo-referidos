<?
/*
* @+================================================================+
* @¦ Modulo Sistema de Referidos MUCore                             ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/

//abrir archivo q almacena la config y edita y recibe valores nuevos
$get_config = simplexml_load_file('../engine/referido_settings.xml');
if (isset($_POST['settings'])) {
		$f1 = new_config_xml('../engine/referido_settings', 'f1', $_POST['f1']);
        $f2 = new_config_xml('../engine/referido_settings', 'f2', $_POST['f2']);
        $f3 = new_config_xml('../engine/referido_settings', 'f3', $_POST['f3']);
		$f4 = new_config_xml('../engine/referido_settings', 'f4', $_POST['f4']);
		$f5 = new_config_xml('../engine/referido_settings', 'f5', $_POST['f5']);
        echo notice_message_admin('Settings successfully saved', 1, 0, 'index.php?get=referido_manager'); 
} else {

//verifica si el modulo esta activo
	if (isset($_POST['module_active'])) {
                $save_status = new_config_xml('../engine/referido_settings', 'active', safe_input($_POST['module_active'], ''));
            }
            $get_config = simplexml_load_file('../engine/referido_settings.xml');
            echo '<form action="" name="settings" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-bottom: 20px;">
<tr>
 <td align="center" class="panel_title" colspan="2">Sistema de Referidos Settings</td>
</tr>
<tr>';
            if ($get_config->active == '1') {
                echo '<td align="left" class="panel_buttons" style="background: #0C0;"><b>Referidos is active.</b></td>
<td align="right" class="panel_buttons" style="background: #0C0;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Referidos Off"><input type="hidden" name="module_active" value="0">';
                
                
            } elseif ($get_config->active == '0') {
                echo '<td align="left" class="panel_buttons" style="background: #C00;"><b>Referidos is inactive.</b></td>
<td align="right" class="panel_buttons" style="background: #C00;">
<input type="hidden" name="edit_settings"><input type="submit" value="Turn Referidos On"><input type="hidden" name="module_active" value="1">';
            }
            echo '</td>
</tr>
</table>
</form>';
	
	
//lista de opciones a config en un formulario
echo '<form action="" name="form_edit" method="POST">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
 <td align="center" class="panel_title" colspan="2">Cantidad de Premios</td>
</tr>

<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Cantidad del premio que se dara a los user.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f1 . '" name="f1"><br>
</td>
</tr>

<tr>
 <td align="center" class="panel_title" colspan="2">Configurar Tabla SQL de la Moneda</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">SQL Table</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Tabla de la base de datos.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f2 . '" name="f2"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">SQL Column</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Columna de la base de datos.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f3 . '" name="f3"><br>
</td>
</tr>

<tr>
<td align="left" class="panel_title_sub" colspan="2">SQL User Column</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">columna de los users de la base de datos.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f4 . '" name="f4"><br>
</td>
</tr>

<tr>
 <td align="center" class="panel_title" colspan="2">Visible block de referido</td>
</tr>

<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">0 = no es visible el bloque.<br>1 = si es visible el bloque.<br>2 = si es visible el bloque deja escoger de quien ser referido.</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<input type="text" size="30" maxlength="50" value="' . $get_config->f5 . '" name="f5"><br>
</td>
</tr>

<tr>
<td align="right" class="panel_buttons" colspan="2">
<input type="hidden" name="settings">
<input type="submit" value="Save"></td>
</tr>
</table>
</form>';
    }
/*
* @+================================================================+
* @¦ Modulo Sistema de Referidos MUCore                             ¦
* @¦ Credits: Thejonyx - https://www.facebook.com/RoboticGames      ¦
* @¦ Credits: Thejonyx - https://jonsanchezr.github.io/cv/          ¦
* @+================================================================+
*/
?> 