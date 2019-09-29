<?php
@set_time_limit(0);
# ShinChan - N45HT - N45HT.WEB.ID
# fb.com/angelia.put - fb.com/ShinChan.admin - fb.com/N45HTOfficial - fb.com/groups/N45HTOfficial
# shinchan0x1945@gmail.com

# your list.txt must a single directory with this exploiter #
# Modified by ./MyHeartIsyr

function saveresult($data,$status){
	$date=date("Y-m-d");
	$fp=@fopen("result-$status-$date.txt", "a") or die("Permission Denied!");
	fwrite($fp, $data);
	fclose($fp);
}

$agents=array(
"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
"Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0",
"Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0",
"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0",
"Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0",
"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0",
"Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0",
"Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0",
"Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101  Firefox/28.0",
"Mozilla/5.0 (Windows NT 6.1; rv:27.3) Gecko/20130101 Firefox/27.3",
"Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:27.0) Gecko/20121011 Firefox/27.0",
"Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0",
"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:25.0) Gecko/20100101 Firefox/25.0",
"Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:24.0) Gecko/20100101 Firefox/24.0",
"Mozilla/5.0 (Windows NT 6.0; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0");

echo "
  ___  _  _  __  _  _  __  _  _   __   _  _     _    _  ____  ___ 
 / __)( )( )(  )( \( )/ _)( )( ) (  ) ( \( )   ( \/\/ )(_  _)(  _)
 \__ \ )__(  )(  )  (( (_  )__(  /__\  )  (  ___\    /   )(   ) _)
 (___/(_)(_)(__)(_)\_)\__)(_)(_)(_)(_)(_)\_)(___)\/\/   (__) (_)  
                Admin Finder - coded by ShinChan

  Thanks to :  PETR03X - Mr.x0x - SCYTHE404_LOL - ./Mr.Blank007
                        All Members N45HT

Modified by ./MyHeartIsyr

";

echo "Input your target : ";
$target = trim(fgets(STDIN));
echo "Input admin directory list : ";
$list = trim(fgets(STDIN));


if(!preg_match("/^http:\/\//",$target) AND !preg_match("/^https:\/\//",$target)){
	$targets = "http://$target";
}else{
	$targets = $target;
}
$read=@fread(fopen($list, "r"),filesize($list));
$lists = explode("\r\n", $read);

foreach($lists as $login){
	$admins = "$targets/$login";
	
	$ch = curl_init("$admins");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $agents[rand(0,15)]);
	curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	if($httpcode == 200){
		echo $found = "Testing $admins => 200 OK\r\n";
		saveresult($found, "Found");
	}
	else if($httpcode == 404){
		echo $notfound = "Testing $admins => 404 Not Found\r\n";
		saveresult($notfound, "Not_Found");
	}
	else if($httpcode == 403){
		echo $forbidden = "Testing $admins => 403 Forbidden\r\n";
		saveresult($forbidden, "Forbidden");
	}
	else if($httpcode == 302){
		echo $redirected = "Testing $admins => 302 Found (Redirect to custom 404 page)\r\n";
		saveresult($redirected, "302_Found");
	}
	else if($httpcode == 301){
		echo $redirected2 = "Testing $admins => 301 Moved Permanently\r\n";
		saveresult($redirected2, "Moved_Permanently");
	}
	else {
		echo $another = "Testing $admins => Another Response Code ($httpcode)\r\n";
		saveresult($another, "Another_Response_Code");
	}
}