<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Class Roster              #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



//-----------------------------------------------------------------------------------------------------------+
include_lan(e_PLUGIN."aacgc_classroster/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

         	

$text1 .= "<table class='fborder' style='width:100%'>";
$text1 .= "<tr>";
        


if (e_PAGE == "admin_main.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> ".ACR_01." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_main.php'>".ACR_01."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";


if (e_PAGE == "admin_config.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_config.php'>>> ".ACR_02." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_config.php'>".ACR_02."</a></td>";}


$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";
	
	
if (e_PAGE == "admin_classes.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_classes.php'>>> ".ACR_04." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_classes.php'>".ACR_04."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr><tr>";
	
	
if (e_PAGE == "admin_vupdate.php") 
{$text1 .= "<td style='width:30%' class='button'><b><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>>> ".ACR_03." <<</a></b></td>";}
else
{$text1 .= "<td style='width:30%' class='button'><a style='cursor:hand; text-decoration:none' href='admin_vupdate.php'>".ACR_03."</a></td>";}



$text1 .= "</tr><tr>
	   <td style='width:30%' class='header'><b>-</b></td>
	   </tr>";
	   
$text1 .= "</table>";

//-----------------# Plugin Detection #-------------------+

$steam = $pref['plug_installed']['aacgc_steamstats'];
$xfire = $pref['plug_installed']['aacgc_xfirestats'];

$green = "<img width='16px' src='".e_PLUGIN."aacgc_classroster/images/check.png' />";
$yellow = "<img width='16px' src='".e_PLUGIN."aacgc_classroster/images/yellowdot.png' />";
$red = "<img width='16px' src='".e_PLUGIN."aacgc_classroster/images/redx.png' />";

if ($steam){
	if ($steam > "1.9")
		{$steam_plugin = $green;}
	else
		{$steam_plugin = $yellow;}
}else{$steam_plugin = $red;}

if ($xfire){
	if ($xfire > "1.6")
		{$xfire_plugin = $green;}
	else
		{$xfire_plugin = $yellow;}
}else{$xfire_plugin = $red;}


$text1 .= "
<table style='width:100%' class='forumheader3'>
	<tr>
	<td colspan='2' class='forumheader3'>
	".ACR_PLUGS_01."<br/>
	".$green." = ".ACR_PLUGS_08."<br/>
	".$yellow." = ".ACR_PLUGS_09."<br/>
	".$red." = ".ACR_PLUGS_10."<br/>
	".ACR_PLUGS_07."
	</td>
	</tr>
	
	<tr>
		<td style='width:100%'><a href='http://www.aacgc.com/download.php?view.529' target='_blank'>".ACR_PLUGS_02."</a></td>
		<td style='width:0%'>".$steam_plugin."</td>
	</tr>
	<tr>
		<td style='width:100%'><a href='http://www.aacgc.com/download.php?view.504' target='_blank'>".ACR_PLUGS_03."</a></td>
		<td style='width:0%'>".$xfire_plugin."</td>
	</tr>
</table>
";
	 
	   
	   
$text1 .= "<br>
<center>
Donate To AACGC.
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='hidden' name='hosted_button_id' value='6506985'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
<img alt='' border='0' src='https://www.paypal.com/en_US/i/scr/pixel.gif' width='1' height='1'>
</form>
";



$ns -> tablerender($ttl1, $text1);

?>
