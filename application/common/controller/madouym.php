<?php 
$skey = 'madouym';
function madoujm($xzv_4 = '', $xzv_1 = '')
{
	$xzv_3 = str_split(base64_encode($xzv_4));
	$xzv_5 = count($xzv_3);
	foreach (str_split($xzv_1) as $xzv_2 => $xzv_0) $xzv_2 < $xzv_5 && $xzv_3[$xzv_2] .= $xzv_0;
	return str_replace(array('=', '+', '/'), array(
		'O0O0O',
		'o000o',
		'oo00o'
	), join('', $xzv_3));
}

$url = str_replace('$$$', '~~#', $url);
$Arrstr1 = explode('#', $url);
for ($k = 0; $k < count($Arrstr1); $k++) {
	$vodfj = $Arrstr1[$k];
	$lspo = strpos($vodfj, '$');
	$tname = substr($vodfj, 0, $lspo+1);
	$string = substr($vodfj, $lspo+1);
	if (strstr($string, '~~')) {
		$string = madoujm(str_replace('~~', '', $string), $skey).'$$$';
	}
	else {
		$string = madoujm($string, $skey);
	}
	$jmstr .= $tname.$string.'#';
}
$jmstr = substr(str_replace('$$$#', '$$$', $jmstr), 0, -1);
$url = "'".$jmstr."';";
?>
