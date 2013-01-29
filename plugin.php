<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Class Roster              #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Class Roster";
$eplug_version = "1.3";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Userclass roster allows admins to assign rank names and images to userclasses so that any member within the userclass is shown with listed rank.";
$eplug_compatible = "e107 v7+";
$eplug_readme = "";
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

$eplug_folder = "aacgc_classroster";

$eplug_menu_name = "AACGC Class Roster";

$eplug_conffile = "admin_main.php";

$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_large = "".e_PLUGIN."aacgc_classroster/images/icon_64.png";

$eplug_caption = "AACGC Class Roster";

$eplug_prefs = array(
"cr_menutitle" => "Class Roster",
"cr_pagetitle" => "Class Roster",
"cr_theme" => "1",
"cr_profile" => "1",
"cr_forum" => "1",
"cr_header" => "",
"cr_menuheight" => "auto",
"cr_maxranks" => "3",
);

$eplug_table_names = array("aacgc_classroster");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_classroster(cr_id int(11) NOT NULL auto_increment,cr_name text NOT NULL,cr_image text NOT NULL,cr_class text NOT NULL,cr_order INT NOT NULL, PRIMARY KEY  (cr_id)) ENGINE=MyISAM;",
);

$eplug_link = true;
$eplug_link_name = "C-Roster";
$eplug_link_url = e_PLUGIN."aacgc_classroster/Class_Roster.php";

$eplug_done = "The plugin is now installed.";

//------- # UPGRADE #--------------------------------------+

if($pref['plug_installed']['aacgc_classroster'] == "1.0"){
$upgrade_alter_tables = array(
"ALTER TABLE " . MPREFIX . "aacgc_classroster ADD COLUMN cr_order INT NOT NULL AFTER cr_class;",
);
$upgrade_add_prefs = array(
"cr_maxranks" => "3",
);
$upgrade_remove_prefs = "";
$eplug_upgrade_done = "Upgrade Complete";
}
//---------------------------+
if($pref['plug_installed']['aacgc_classroster'] == "1.1"){
$upgrade_alter_tables = array(
"ALTER TABLE " . MPREFIX . "aacgc_classroster MODIFY cr_order INT;",
);
$upgrade_add_prefs ="";
$upgrade_remove_prefs = "";
$eplug_upgrade_done = "Upgrade Complete";
}
//---------------------------+
if($pref['plug_installed']['aacgc_classroster'] == "1.2"){
$upgrade_alter_tables = "";
$upgrade_add_prefs ="";
$upgrade_remove_prefs = "";
$eplug_upgrade_done = "Upgrade Complete";
}

?>	

