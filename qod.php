<?php
	$useEcho  = 1;
	$mysqlerr = 0;
	
	if(isset($_SERVER["REMOTE_ADDR"])) { 
	$ipAddress = $_SERVER["REMOTE_ADDR"];
	} else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) { 
	$ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else if(isset($_SERVER["HTTP_CLIENT_IP"])) { 
	$ipAddress = $_SERVER["HTTP_CLIENT_IP"]; 
	}
	
	$userIPs = explode(',', $ipAddress);
	
	$ipParsed = "127.0.0.1";

	if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $userIPs[0]))
	{
		$ipParsed = $userIPs[0];
	}
	
	
	$con = mysql_connect("localhost","guest","pass");

	if(mysql_errno() != 0)
	{
	  if($useEcho == 1) echo "No Connection con = " . $con . '__error = ' . mysql_error() . '<br />';
	  $mysqlerr = 1;
	}
	else
	{
	  mysql_select_db("jas15anniv", $con);

	  if(mysql_errno() != 0)
	  {
		if($useEcho == 1) echo "Could not select Table con = " . $con . '__error = ' . mysql_error() . '<br />';
		$mysqlerr = 2;
	  }
	  else
	  {
		if((isset($_POST['qid']) == true) && (isset($_POST['name']) == true) && (isset($_POST['ipaddr']) == true) && (isset($_POST['ans']) == true))
		{
			$Query  = 'INSERT INTO qod (qid, name, ipaddr, ans) ';
			$Query .= 'VALUES (';
			$Query .= "'" . $_POST['qid'] . "', ";
			$Query .= "'" . $_POST['name'] . "', ";
			$Query .= "'" . $_POST['ipaddr'] . "', ";
			$Query .= "'" . $_POST['ans'] . "'); ";

			$result = mysql_query($Query);

			if(mysql_errno() != 0)
			{
				if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
				$mysqlerr = 3;
			}
			
			echo '<span style="color:#339933;"> Your answer has been saved </span>';
		}
		else
		{
			if(($ipParsed == "127.0.0.1") || ($ipParsed == "172.16.6.60") || ($ipParsed == "172.16.6.87") || ($ipParsed == "172.16.6.115") || ($ipParsed == "172.16.6.69"))
			{
				echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
				echo '<html xmlns="http://www.w3.org/1999/xhtml">';
				echo '<head>';
				echo '<!-- Tile of the page -->';
				echo '<title> Jasmin 15th Anniversary </title>';
	
				echo '<link rel="icon" type="image/ico" href="favicon.ico" />';

				echo '<link rel="stylesheet" type="text/css" href="css/main.css" />';
				echo '<link rel="stylesheet" type="text/css" href="css/salsa.css"  />';
				echo '<link rel="stylesheet" type="text/css" href="css/offside.css" />';
				echo '<link rel="stylesheet" type="text/css" href="css/handlee.css" />';
				echo '<link rel="stylesheet" type="text/css" href="css/philosopher.css" />';
				echo '<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />';
	
				echo '<script type="text/javascript" src="scripts/jquerymin.js"></script>';
				echo '<script type="text/javascript" src="scripts/scripts.js"></script>';
				echo '<script type="text/javascript" src="scripts/jquery.mCustomScrollbar.min.js"></script>';
				
				echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
	
				echo '</head>';
				echo '<body style="margin-right:3%;">';
				echo '<div class="mainHeading"> JASMIN Infotech 15th Year Anniversary Celebrations </div><div class="lineSepLong"></div><br /><br />';
				echo '<h2> Question of the Day Results </h2>';
				
				for($i=1;$i<=30;$i++)
				{
					$Query = 'SELECT NAME, ANS, TIMESTAMP from qod WHERE QID="' . $i . '" ORDER BY TIMESTAMP ASC;';
					
					$result = mysql_query($Query);
					
					if(mysql_errno() != 0)
					{
					  if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
					  $mysqlerr = 5;
					}	
					else
					{
						echo '<h3> Result for Question No : ' . $i . '</h3>';
						echo '<table style="margin-left:3%;width:93%;border:1px solid black;text-align:center;">';
						echo '<tr style="width:99%;border:1px solid black;background-color:#999999;"> <td style="border:1px solid black;text-align:center;"> Sl.No. </td> <td style="border:1px solid black;text-align:center;"> Name </td> <td style="border:1px solid black;text-align:center;"> Answer </td> <td style="border:1px solid black;text-align:center;"> Timestamp </td></tr>';
						
						$j = 1;
						
						while($row = mysql_fetch_array($result))
						{
							echo '<tr style="width:99%;border:1px solid black;"> <td style="border:1px solid black;text-align:center;">' . $j . '</td> <td style="border:1px solid black;text-align:center;">' . $row['NAME'] . ' </td> <td style="border:1px solid black;text-align:center;">' . $row['ANS'] . ' </td> <td style="border:1px solid black;text-align:center;">' . $row['TIMESTAMP'] . '</td></tr>';
							$j++;
						}
						
						echo '</table><br /><br />';
					}
				}
				
				echo '</body>';
				echo '</html>';
			}
			else
			{
				echo '<h2> Access Denied </h2>';
			}
		}
	  }
	}
	
?>