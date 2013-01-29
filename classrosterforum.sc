if ($pref['cr_forum'] == "1"){

include_lan(e_PLUGIN."aacgc_twitchstream/languages/".e_LANGUAGE.".php");

global $post_info, $sql, $tp;

$postowner  = $post_info['user_id'];

	$i = 0;
	$sql->db_Select("user", "*", "user_id = '".$postowner."'");
	$row = $sql->db_Fetch();
	$sql2 = new db;
    $sql2->db_Select("aacgc_classroster", "*", "ORDER BY cr_order ASC LIMIT 0,".$pref['cr_maxranks']."", "");
    while($row2 = $sql2->db_Fetch()){
	
	$user = explode(',', $row['user_class']);
	if (in_array($row2['cr_class'], $user)){	

	if(++$i > $pref['cr_maxranks']) break;		
$crforum .= "<img src='".e_PLUGIN."aacgc_classroster/ranks/".$row2['cr_image']."' alt='".$row2['cr_name']."' /><br/>";
}}


return "".$crforum."";
}