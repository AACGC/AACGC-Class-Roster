if ($pref['cr_profile'] == "1"){

global $sql,$sql2,$user, $tp; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
if ($suser[1] == 'php?id')
{$suser = $suser[2];}

$SUSER_ID = $suser;

$cruser .= "<tr><td class='forumheader3' colspan='2'>";

	$i = 0;
	$sql->db_Select("user", "*", "user_id = '".$SUSER_ID."'");
	$rowus = $sql->db_Fetch();
	$sql2 = new db;
    $sql2->db_Select("aacgc_classroster", "*", "ORDER BY cr_order ASC LIMIT 0,".$pref['cr_maxranks']."", "");
    while($row2 = $sql2->db_Fetch()){
	
	$userus = explode(',', $rowus['user_class']);
	if (in_array($row2['cr_class'], $userus)){	

	if(++$i > $pref['cr_maxranks']) break;		
$cruser .= "<img src='".e_PLUGIN."aacgc_classroster/ranks/".$row2['cr_image']."' alt='".$row2['cr_name']."' /><br/>";
}}

$cruser .= "</td>";

return $cruser;

}