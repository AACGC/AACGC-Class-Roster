<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Class Roster              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/

require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
include_lan(e_PLUGIN."aacgc_classroster/languages/".e_LANGUAGE.".php");
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
if($pref['cr_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-----------------------------------------------------------------------------------------------------------+
//---# New #
if ($_POST['add_class'] == '1') {
$newname = $_POST['cr_name'];
$newimage = $_POST['cr_image'];
$newclass = $_POST['cr_class'];
$neworder = $_POST['cr_order'];

$sql->db_Insert("aacgc_classroster", "NULL, '".$newname."', '".$newimage."', '".$newclass."', '".$neworder."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".ACR_05."</b></center>");
}
//---# Update #
if (isset($_POST['update_class'])) {
$newname = $_POST['cr_name'];
$newimage = $_POST['cr_image'];
$newclass = $_POST['cr_class'];
$neworder = $_POST['cr_order'];

$message = ($sql->db_Update("aacgc_classroster", "cr_name='".$tp->toDB($newname)."',cr_image='".$tp->toDB($newimage)."',cr_class='".$tp->toDB($newclass)."',cr_order='".$tp->toDB($neworder)."' WHERE cr_id='".$_POST['id']."' ")) ? "".ACR_11."" : "".ACR_12."";
}
//---# Delete #
if (isset($_POST['main_delete'])) {
$delete_id = array_keys($_POST['main_delete']);
$sql2 = new db;
$sql2->db_Delete("aacgc_classroster", "cr_id='".$delete_id[0]."'");
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($message)) {$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");}
//-----------------------------------------------------------------------------------------------------------+
if ($action == ""){
	
$text .= "<form method='POST' action='admin_classes.php'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_06.":</td>
		<td colspan='2'  class='forumheader3'>
			<input class='tbox' type='text' size='50' name='cr_name' />
		</td>
	</tr>";
	
        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_classroster/ranks";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

$text .= "
	<tr>
		<td style='width:; text-align:right' class='".$themea."'>".ACR_07.":</td>
		<td style='width:' class='".$themea."' colspan=2>
			".$rs -> form_text("cr_image", 25, $row['cr_image'], 100)."
			".$rs -> form_button("button", '', "".ACR_08."", "onclick=\"expandit('plcico')\"")."
			<div id='plcico' style='{head}; display:none'>";
			foreach($iconlist as $icon){
$text .= "<a href=\"javascript:insertext('".$icon['fname']."','cr_image','plcico')\"><img src='".$icon['path'].$icon['fname']."' /></a> ";}

$text .= "	</div>
        </td>
	</tr>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_09.":</td>
		<td colspan='2'  class='forumheader3'>
		<select name='cr_class' size='1' class='tbox' style='width:50%'>";

		$sql->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
		while($row = $sql->db_Fetch()){

$text .= "<option name='cr_class' value='".$row['userclass_id']."'>".$row['userclass_name']."</option>";}
	
 $text .= "</select></td>
 	</tr>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_27.":</td>
		<td colspan='2'  class='forumheader3'>
		<select name='cr_order' size='1' class='tbox' style='width:100%'>";
		
$sql->db_Select("aacgc_classroster", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$n++;
$options .= "<option name='cr_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;
		
$text .= "<option name='cr_order' value='0'>0</option>
        ".$options."
		<option name='cr_order' value='".$next."'>".$next."</option>
		</select>	
		</td>
	</tr>	
    <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
			<input type='hidden' name='add_class' value='1'>
			<input class='button' type='submit' value='".ACR_10."' style='width:150px'>
		</td>
    </tr>
</table>
</form>
";
//--------------------------------------------------------------------------------------------------------
$text .= $rs->form_open("post", e_SELF, "myform_".$row['cr_id']."", "", "");
$text .= "<table style='width:100%' class='' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='".$themea."'>".ACR_27."</td>
        <td style='width:0%' class='".$themea."'>".ACR_22."</td>
        <td style='width:50%' class='".$themea."'>".ACR_06." / ".ACR_07."</td>
        <td style='width:50%' class='".$themea."'>".ACR_09."</td>
        <td style='width:0%' class='".$themea."'>".ACR_23."</td>
       </tr>";

        $sql->db_Select("aacgc_classroster", "*", "ORDER BY cr_order ASC","");
        while($row = $sql->db_Fetch()){
		$sql2 = new db;
        $sql2->db_Select("userclass_classes", "*", "userclass_id='".$row['cr_class']."'");
        $row2 = $sql2->db_Fetch();

$text .= "
        <tr>
        <td style='width:' class='".$themea."'>".$row['cr_order']."</td>
        <td style='width:' class='".$themea."'>".$row['cr_id']."</td>
        <td style='width:' class='".$themea."'>".$row['cr_name']."<br/><img src='".e_PLUGIN."aacgc_classroster/ranks/".$row['cr_image']."' /></td>
        <td style='width:' class='".$themea."'>".$row2['userclass_name']."</td>
        <td style='width:' class='".$themea."'>
		<a href='".e_SELF."?edit.{$row['cr_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['cr_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [{$row['cr_id']}: {$row['cr_name']} ]')\"/>	</td>
        </tr>";
}

$text .= "</table>";
$text .= $rs->form_close();
}
//------------------------------------------------------------------------------------------------------

if ($action == "edit"){

		$sql->db_Select("aacgc_classroster", "*", "cr_id = '".$sub_action."'");
		$row = $sql->db_Fetch();
		$sql2 = new db;
        $sql2->db_Select("userclass_classes", "*", "userclass_id='".$row['cr_class']."'");
        $row2 = $sql2->db_Fetch();

$text .= "".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='width:100%' class='' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='".$themea."'>".ACR_06.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("cr_name", 100, $row['cr_name'], 500)."
        </td>
        </tr>";
		
		$rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_classroster/ranks/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='".$themea."'>".ACR_07.":</td>
        <td style='width:' class='".$themea."' colspan=2>
        ".$rs -> form_button("button", '', "".ACR_08."", "onclick=\"expandit('plcicor')\"")."
        ".$rs -> form_text("cr_image", 20, $row['cr_image'], 100)."
            <div id='plcicor' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','cr_image','plcicor')\"><img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }



$text .= "</div>
        </td>
		</tr>
		<tr>
        <td style='width:; text-align:right' class='".$themea."'>".ACR_08.":</td>
        <td style='width:' class='".$themea."'>
		<select name='cr_class'>
		<option name='cr_class' value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";
			
	$sql4 = new db;
	$sql4->db_Select("userclass_classes", "*", "");
    while($row4 = $sql4->db_Fetch()){

$text .= "<option name='cr_class' value='".$row4['userclass_id']."'>".$row4['userclass_name']."</option>";}
$text .= "</select></td>
		</tr>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_27.":</td>
		<td colspan='2'  class='forumheader3'>
		<select name='cr_order' size='1' class='tbox' style='width:100%'>";
		
	$order = $sql->db_Select("aacgc_classroster", "*", "ORDER BY cr_id ASC","");
    $rowor = $sql->db_Fetch();
	extract($rowor);
	for($a = 1; $a <= $order; $a++){
$text .= ($rowor['cr_order'] == $a ? "<option value='".$rowor['cr_order']."' selected='selected'>".$a."</option>\n" : "<option value='".$a."'>".$a."</option>\n");
}	
		
$text .= "	</select>	
		</td>
	</tr>	
		
        <tr style='vertical-align:top'>
        <td colspan='3' style='text-align:center' class='".$themea."'>
        ".$rs->form_hidden("id", "".$row['cr_id']."")."
        ".$rs -> form_button("submit", "update_class", "".ACR_13."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
}
//-----------------------------------------------------------------------------------------------------------------------------
$ns -> tablerender("AACGC Class Roster (".ACR_04.")", $text);
require_once(e_ADMIN."footer.php");
?>