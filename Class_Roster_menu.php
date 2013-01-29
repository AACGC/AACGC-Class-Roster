<?php
	
if($pref['cr_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_classroster/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

//-------------------------Title--------------------------------+
$crmenu_title .= $pref['cr_menutitle'];
//--------------------------------------------------------------+

if($pref['twitch_menuheight'] != "auto")
{$crmenu_text .= "<div style='width:100%; height:".$pref['cr_menuheight']."; overflow:auto'>";}

$crmenu_text .= "<table style='width:100%' class=''>";
		
        $sql->db_Select("aacgc_classroster", "*", "ORDER BY cr_order ASC","");
        while($row = $sql->db_Fetch()){
			
$class = "".$row['cr_name']."<br/><img width='".$pref['cr_menuimgwidth']."' src='".e_PLUGIN."aacgc_classroster/ranks/".$row['cr_image']."' alt='".$row['cr_name']."' />";

$crmenu_text .= "
	<tr>
		<td colspan='2' class='".$themeb."' style='text-align:center'><b>".$row['cr_name']."</b></td>
	</tr>
	<tr>
		<td style='width:75%' class='".$themea."'>".CR_01."</td>
		<td style='width:25%' class='".$themea."'>".CR_02."</td>
	</tr>";


	$sql2 = new db;
	$sql2->db_Select("user_classes", "*", "userclass_id='".$row['cr_class']."'");
	$row2 = $sql2->db_Fetch();
	$sql3 = new db;
	$sql3->db_Select("user", "*", "");
	while($row3 = $sql3->db_Fetch()){
	$sql4 = new db;
	$sql4 ->db_Select("user_extended", "*", "user_extended_id = '".$row3['user_id']."'");
	$row4 = $sql4 ->db_Fetch();

	$user = explode(',', $row3['user_class']);
	if (in_array($row['cr_class'], $user)){

	$user = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$row3['user_name']."</a>";
	if ($row3['user_image'] == "")
	{$cravatar = "<img src='".e_PLUGIN."aacgc_classroster/images/default.png' width='16px', height='16px' /> ";}
	else
	{$useravatar = $row3[user_image];
	require_once(e_HANDLER."avatar_handler.php");
	$useravatar = avatar($useravatar);
	$cravatar = "<img src='".$useravatar."' width='16px', height='16px' /> ";}
	
$crmenu_text .= "<tr>
			<td class='".$themeb."'>".$cravatar."".$user."</td>
			<td class='".$themeb."'>".$class."</td>
		</tr>
";}}}


$crmenu_text .= "</table>";

if($pref['cr_menuheight'] != "auto")
{$twitchstream_text .= "</div>";}

$ns -> tablerender($crmenu_title, $crmenu_text);
?>