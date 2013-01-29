<?php

/*
#######################################
#     AACGC Class Roster              #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);

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
$title .= $pref['cr_pagetitle'];
//--------------------------------------------------------------+


$text .= "
<table style='width:100%' class=''>
	<tr>
			<td colspan='2' class='".$themeb."' style='text-align:center'>".$tp->toHTML($pref['cr_header'], TRUE)."</td>
	</tr>
	<tr>
		<td style='width:75%' class='".$themea."'>".CR_01."</td>
		<td style='width:25%' class='".$themea."'>".CR_02."</td>
	</tr>";
	
	
        $sql->db_Select("aacgc_classroster", "*", "ORDER BY cr_order ASC","");
        while($row = $sql->db_Fetch()){
			
$class = "".$row['cr_name']."<br/><img src='".e_PLUGIN."aacgc_classroster/ranks/".$row['cr_image']."' alt='".$row['cr_name']."' />";

$text .= "<tr><td colspan='2' class='".$themeb."' style='text-align:center'><b>".$row['cr_name']."</b></td></tr>";
		
	$sql2 = new db;
	$sql2->db_Select("user_classes", "*", "userclass_id='".$row['cr_class']."'");
	$row2 = $sql2->db_Fetch();
	$sql3 = new db;
	$sql3->db_Select("user", "*", "");
	while($row3 = $sql3->db_Fetch()){
	$sql4 = new db;
	$sql4 ->db_Select("user_extended", "*", "user_extended_id = '".$row3['user_id']."'");
	$row4 = $sql4 ->db_Fetch();

if ($pref['plug_installed']['aacgc_xfirestats'] AND $pref['cr_xfire'] == "1"){
if ($pref['xf_skin'] == "Xfire Default"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row4['user_extended_id']."'><img src='http://miniprofile.xfire.com/bg/bg/type/3/".$row4['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Sci-fi"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row4['user_extended_id']."'><img src='http://miniprofile.xfire.com/bg/sf/type/3/".$row4['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Shadow"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row4['user_extended_id']."'><img src='http://miniprofile.xfire.com/bg/sh/type/3/".$row4['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Combat"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row4['user_extended_id']."'><img src='http://miniprofile.xfire.com/bg/co/type/3/".$row4['user_xfire'].".png' width='149' height='29' /></a>";}
if ($pref['xf_skin'] == "Fantasy"){
$xfireskin = "<a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row4['user_extended_id']."'><img src='http://miniprofile.xfire.com/bg/os/type/3/".$row4['user_xfire'].".png' width='149' height='29' /></a>";}
if($row4['user_xfire'] != "")
{$xfirebadge = "<br/>".$xfireskin."";}
else
{$xfirebadge = "";}}

if ($pref['plug_installed']['aacgc_steamstats'] AND $pref['cr_steam'] == "1"){
if ($row4['user_steamurl'] == "id") 
{$steamurl = "http://steamcommunity.com/id/".$row4['user_steamid']."";}
if ($row4['user_steamurl'] == "profile")
{$steamurl = "http://steamcommunity.com/profiles/".$row4['user_steamid']."";}
if ($row4['user_steamurl'] == "")
{$steamurl = "".e_BASE."user.php?id.".$row4['user_extended_id']."";}
if($row4['user_steamid'] == "")
{$steambadge = "";}
else
{$steambadge = "<br/><a href='".$steamurl."' target='_blank'><img width='149px' height='29px' src='http://badges.steamprofile.com/profile/simple/steam/".$row4['user_steamid'].".png' border='0' /></a>";}
}

	$user = explode(',', $row3['user_class']);
	if (in_array($row['cr_class'], $user)){

	$user = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$row3['user_name']."</a>";
	if ($row3['user_image'] == "")
	{$cravatar = "<img src='".e_PLUGIN."aacgc_classroster/images/default.png' width='25px', height='25px' /> ";}
	else
	{$useravatar = $row3[user_image];
	require_once(e_HANDLER."avatar_handler.php");
	$useravatar = avatar($useravatar);
	$cravatar = "<img src='".$useravatar."' width='25px', height='25px' /> ";}
	
$text .= "<tr>
			<td class='".$themeb."'>".$cravatar."".$user."</td>
			<td class='".$themeb."'>".$class."".$xfirebadge."".$steambadge."</td>
		</tr>
";}}}


$text .= "</table>";


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_classroster/plugin.php');
$text .= "<br/><br/><br/><br/><br/><br/><br/>
<a href='http://www.aacgc.com' target='_blank'><font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font></a>";
//------------------------------------------------------------------------+
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>