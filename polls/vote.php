<?php

	$useEcho  = 1;
	$mysqlerr = 0;
	$result = "Not Accepted";
	
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
	    /* Return results */
		if((isset($_POST['evtId']) == true) && (isset($_POST['imgName']) == true) && (isset($_POST['authName']) == true))
		{
			$Query  = 'INSERT INTO pollsInfo (evtId, imgName, authName, ipAddr) ';
			$Query .= 'VALUES (';
			$Query .= "'" . $_POST['evtId'] . "', ";
			$Query .= "'" . $_POST['imgName'] . "', ";
			$Query .= "'" . $_POST['authName'] . "', ";
			$Query .= "'" . $ipParsed . "'); ";

			$result = mysql_query($Query);

			if(mysql_errno() != 0)
			{
				if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
				$mysqlerr = 3;
			}
			else
			{
				$result = "Success!";
			}
		}
	  }
	}
?>