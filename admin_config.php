<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Class Roster              #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
} 
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN."aacgc_classroster/languages/".e_LANGUAGE.".php");

if (isset($_POST['update']))
{ 
    $pref['cr_pagetitle'] = $tp->toDB($_POST['cr_pagetitle']);
    $pref['cr_menutitle'] = $tp->toDB($_POST['cr_menutitle']);
    $pref['cr_header'] = $tp->toDB($_POST['cr_header']);
    $pref['cr_menuheight'] = $tp->toDB($_POST['cr_menuheight']);
    $pref['cr_menuimgwidth'] = $tp->toDB($_POST['cr_menuimgwidth']);
    $pref['cr_maxranks'] = $tp->toDB($_POST['cr_maxranks']);

if (isset($_POST['cr_theme'])) 
{$pref['cr_theme'] = 1;}
else
{$pref['cr_theme'] = 0;}

if (isset($_POST['cr_forum'])) 
{$pref['cr_forum'] = 1;}
else
{$pref['cr_forum'] = 0;}

if (isset($_POST['cr_profile'])) 
{$pref['cr_profile'] = 1;}
else
{$pref['cr_profile'] = 0;}

if (isset($_POST['cr_steam'])) 
{$pref['cr_steam'] = 1;}
else
{$pref['cr_steam'] = 0;}

if (isset($_POST['cr_xfire'])) 
{$pref['cr_xfire'] = 1;}
else
{$pref['cr_xfire'] = 0;}


    save_prefs();

$text .= "".ACR_14."";

}
//-------------------------# BB Code Support #----------------------------------------------
include(e_HANDLER."ren_help.php");
//------------------------------------------------------------------------------------------

$text .= "<form method='post' action='".e_SELF."' id='conslform'>
<table class='fborder' width='100%'>
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>".ACR_02."</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_26.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='15' name='cr_maxranks' value='" . $pref['cr_maxranks'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_15.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='cr_pagetitle' value='" . $pref['cr_pagetitle'] . "' /></td>
</tr>
<tr>
        <td style='width:' class='forumheader3'>".ACR_17.":</td>
        <td style='width:' class='forumheader3'>
	    <textarea class='tbox' rows='5' cols='100' name='cr_header' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$pref['cr_header']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td> 
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_18.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['cr_theme'] == 1 ? "<input type='checkbox' name='cr_theme' value='1' checked='checked' />" : "<input type='checkbox' name='cr_theme' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_16.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='cr_menutitle' value='" . $pref['cr_menutitle'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_24.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='cr_menuheight' value='" . $pref['cr_menuheight'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_25.":</b></td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='50' name='cr_menuimgwidth' value='" . $pref['cr_menuimgwidth'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_20.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['cr_profile'] == 1 ? "<input type='checkbox' name='cr_profile' value='1' checked='checked' />" : "<input type='checkbox' name='cr_profile' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_19.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['cr_forum'] == 1 ? "<input type='checkbox' name='cr_forum' value='1' checked='checked' />" : "<input type='checkbox' name='cr_forum' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>".ACR_PLUGS_04."</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_PLUGS_06.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['cr_steam'] == 1 ? "<input type='checkbox' name='cr_steam' value='1' checked='checked' />" : "<input type='checkbox' name='cr_steam' value='0' />")."</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'><b>".ACR_PLUGS_05.":</b></td>
<td colspan=2 class='forumheader3'>".($pref['cr_xfire'] == 1 ? "<input type='checkbox' name='cr_xfire' value='1' checked='checked' />" : "<input type='checkbox' name='cr_xfire' value='0' />")."</td>
</tr>
</table><br/><br/>";

//------------------------------------------------------------------------------------
$text .= "
<table class='fborder' width='100%'><tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='".ACR_21."' class='button' />\n
</td>
</tr></table></form>";


$ns->tablerender("AACGC Class Roster(".ACR_02.")", $text);
require_once(e_ADMIN . "footer.php");

?>