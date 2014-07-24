<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <!-- Tile of the page -->
    <title> Jasmin 15th Anniversary </title>
	
	<link rel="icon" type="image /ico" href="favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/salsa.css"  />
	<link rel="stylesheet" type="text/css" href="css/offside.css" />
	<link rel="stylesheet" type="text/css" href="css/handlee.css" />
	<link rel="stylesheet" type="text/css" href="css/philosopher.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
	
	<script type="text/javascript" src="scripts/jquerymin.js"></script>
	<script type="text/javascript" src="scripts/scripts.js"></script>
	<script type="text/javascript" src="scripts/jquery.mCustomScrollbar.min.js"></script>
	<script type="text/javascript" src="scripts/galleria.js"></script>
	
  </head>
   
  <?php 
 
	$useEcho  = 0;
	$mysqlerr = 0;
	$fullName = "Guest";
  $emailID  = "";
  $preLevel = 0;
	$noReg    = 1;
	$evtD = 0;
	$evtT = 0;
	$totEvts = 36;
	
	/* EDIT HERE for question of the day */
	$qodId    = 14;
	$qodQues  = "Manish is the son of Harish.. So Harish is the ________of Manish's Father?";
	
	                     /* 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5) */  
	$evtMemberCount = array(1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 2, 1, 2 ,1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 1 ,1, 3, 1, 1, 1, 2, 1, 2, 1, 8);  
  $stopRegForEvt  = array(0, 1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1);    
    
					   /*      0              1            2             3             4     */
	$evtSchDates = array('31.07.2013', '29.07.2013', '26.07.2013', '30.07.2013', '31.07.2013', // 0
						 '23.07.2013', '01.08.2013', '07.08.2013', '31.07.2013', '13.08.2013', // 1 
						 '25.07.2013', '22.07.2013', '31.07.2013', '13.08.2013', '23.07.2013', // 2 
						 '05.08.2013', '06.08.2013', '22.07.2013', '12.08.2013', '01.08.2013', // 3
						 '19.07.2013', '25.07.2013', '08.08.2013', '02.08.2013', '29.07.2013', // 4
						 '07.08.2013', '08.08.2013', '06.08.2013', '06.08.2013', '09.08.2013', // 5
						 '31.07.2013', '09.08.2013', '19.07.2013', '29.07.2013', '25.07.2013', // 6
						 '29.07.2013',
						 
						 '01.08.2013', '30.07.2013', '29.07.2013', '31.07.2013', '01.08.2013', // 0
						 '24.07.2013', '02.08.2013', '08.08.2013', '01.08.2013', '14.08.2013', // 1 
						 '26.07.2013', '23.07.2013', '01.08.2013', '14.08.2013', '24.07.2013', // 2 
						 '06.08.2013', '07.08.2013', '23.07.2013', '13.08.2013', '02.08.2013', // 3
						 '22.07.2013', '26.07.2013', '09.08.2013', '05.08.2013', '30.07.2013', // 4
						 '08.08.2013', '09.08.2013', '07.08.2013', '07.08.2013', '12.08.2013', // 5
						 '03.08.2013', '12.08.2013', '22.07.2013', '31.07.2013', '29.07.2013', // 6
						 '30.07.2013');                                                        // 7
							
						/*	0          1          2           3         4          5          6          7          8         9       */ 
	$evtSchTimes = array('4:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 0
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 1
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', // 2
						 '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM', '6:00 PM',                                             // 3
						 
						 '5:00 PM', '5:00 PM', '4:00 PM', '4:00 PM', '5:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', // 0
						 '4:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '5:00 PM', // 1
						 '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '4:00 PM', '5:00 PM', '5:00 PM', '4:00 PM', '4:30 PM', '4:00 PM', // 2
						 '7:00 AM', '5:00 PM', '5:00 PM', '3:00 PM', '4:00 PM', '4:00 PM');		                                       // 3
						 
				   /*   0                         1                     2                           3                            4           */
	$events = array("Big Shot",             "Aim the Game",         "Collage",              "Soap Architect",           "Poster Desinging",     // 0
	                "Singing",              "Dumb Charades",        "Blind Game",           "Jasmin's Lucky Charm",     "Sense of Balance",     // 1
					"Maze'3'",              "Word Hint",            "Plate and Bangles",    "Detective",        		"Delayed Response",     // 2
					"Slow Rider",           "Debate",               "Air Warrior",          "Pocket the Ball",          "Ring to Bottle",       // 3
					"Nanban",               "Just A Minute",        "Top Manager",          "Find the Partner",         "Poster Drawing",       // 4
					"HaHa HuHu HaeHae",     "Assembler",            "Six Legged Race",      "Drink Enough",             "Picture Puzzle",       // 5
					"Cricket",              "Carrom",                "Chess",                "Shuttle",                 "Jasmin Bailvan",       // 6
					"Throwball (Ladies)");  																									// 7						 
					
	$extraDates = array();
	
	$extraDates[30] = "03.08.2013, 10.08.2013";
	$extraDates[31] = "13.08.2013, 14.08.2013";
	$extraDates[32] = "23.07.2013, 24.07.2013, 25.07.2013, 26.07.2013";
	$extraDates[33] = "06.08.2013, 07.08.2013, 08.08.2013, 09.08.2013";
	$extraDates[34] = "";	
	$extraDates[35] = "";	
	
	if($noReg == 0)
	{
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
        $query = 'SELECT UNAME, NAME, EMAIL, LEVEL FROM userinfo WHERE IPADDR="' . $ipParsed . '"';

        $result = mysql_query($query);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
          if($row = mysql_fetch_array($result))
          {
          $uName = $row['UNAME'];
          $fullName = $row['NAME'];
          $emailID  = $row['EMAIL'];
          $preLevel = $row['LEVEL'];
          }
          else
          {
          $mysqlerr = 4;
          }
        }
      }
    }
		
		if($useEcho == 1) echo "mysqlerr = ". $mysqlerr .'<br />';
		
		if($mysqlerr != 0)
		{
			$udName = @gethostbyaddr($ipParsed);
			$names  = explode('.', $udName);
			$uName  = ucfirst($names[0]);
			$fullName = $uName;
			$emailID  = "";
			$preLevel = 0;		
		}
		
		if($useEcho == 1) echo "User Info : " . $uName . ', ' . $fullName . ', ' . $emailID . ', ' . $preLevel;
		
		echo '<body onload="onLoadEvents(' . "'" . $uName . "'," . "'" . $ipParsed . "'" . ')">'. "\r\n";
		
		/* Seems to be new user as info not in DB, so ask user to update info */
		if($mysqlerr == 4)
		{
			requestUserInfo();
		}
	}
	else
	{
		echo '<body onload="onLoadEvents(' . "' Guest '," . "' '" . ')">'. "\r\n";
	}
	
	function requestUserInfo() {
		global $uName;
		global $fullName;
		
		echo '<br /> <div class="userInfoScreen" id="uis">'. "\r\n";
		echo '<div class="userInfoForm" id="uifd">'. "\r\n";
		echo '<div class="userInfoClose" id="uic" onclick="closeUserInfoForm()"></div>'. "\r\n";
		echo '<h2> User Information </h2/>'. "\r\n";
		echo 'Welcome <span class="uName">' . $fullName . '</span>, Please update your information <br />'. "\r\n";
		echo '<span style="font-size:81%;"> (Only for registration purposes) </span> <br /><br />'. "\r\n";
		echo '<form class="ipForm" id="uif" action="saveinfo.php" method="post">'. "\r\n";
		echo 'Enter your full name : <br /><input id="uin" name="name"  class="ipText" type="text" val="" /><br />'. "\r\n";
		echo 'Enter your email-id  : <br /><input id="uie" name="email" class="ipText" type="text" val="" /><br /><br />'. "\r\n";
		echo '<button id="uib" class="ipFormBtn" type="submit" val="submit"> Save User Info </button><br />'. "\r\n";
		echo '</form>'. "\r\n";
		echo '<br /><br /></div></div>'. "\r\n";
	}
	
	function PrintEvtMembers($evtId)
	{
		global $useEcho;
		global $ipParsed;
		global $fullName;
		global $evtMemberCount;
		global $stopRegForEvt;
    global $noReg;
		
    if($noReg == 0)
    {
      $query = 'SELECT eventinfo.NAME, eventinfo.IPADDR, eventinfo.GROUPNAME, userinfo.EMAIL FROM eventinfo LEFT JOIN userinfo ON eventinfo.IPADDR = userinfo.IPADDR WHERE EVTID=' . $evtId . ' ORDER BY eventinfo.GROUPNAME ASC ';

      $result = mysql_query($query);

      if(mysql_errno() != 0)
      {
        if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
        $mysqlerr = 3;
      }
      else
      {
        echo '<h3> Registration </h3>';
        echo '<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->';
        echo '<table style="width:87%;text-align:center;margin-left:3%;">';
        
        $i = 1;
        $userRegistered = 0;
        $userName = $fullName;
        $userIP   = $ipParsed;
        
        if($evtMemberCount[$evtId] == 1)
        {
          echo '<tr style="width:100%;background-color:#666666;"><td style="width:10%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Sl.No. </td>';
          echo '<td style="width:30%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Name </td>';
          echo '<td style="width:60%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Email ID </td></tr>';
          
          while($row = mysql_fetch_array($result))
          {
          if($ipParsed == $row['IPADDR'])
          {
            $userRegistered = 1;
            $userName = $row['NAME'];
            $userIP   = $row['IPADDR'];
          }
          echo '<tr style="width:100%;"><td style="width:10%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $i . '</td>';
          echo '<td style="width:30%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>';
          echo '<td style="width:60%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td></tr>';
          $i++;
          }
        }
        else
        {
          echo '<tr style="width:100%;background-color:#666666;"><td style="width:6%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Sl.No. </td>';
          echo '<td style="width:21%;border:1px solid black;color:#cccccc;vertical-align:middle;"> GroupName </td>';
          echo '<td style="width:21%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Name </td>';
          echo '<td style="width:51%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Email ID </td></tr>';
        
          $prevGroupName = "";
          $teamSize = $evtMemberCount[$evtId];
          $j = 0;
          
          while($row = mysql_fetch_array($result))
          {
          if($ipParsed == $row['IPADDR'])
          {
            $userRegistered = 1;
            $userName = $row['NAME'];
            $userIP   = $row['IPADDR'];
          }
          if($prevGroupName != $row['GROUPNAME'])
          {
            for($j=$teamSize;$j<$evtMemberCount[$evtId];$j++)
            {
              echo '<tr style="width:100%;">';
              echo '<td style="width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>';
              echo '<td style="width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td></tr>';
            }
            $teamSize = 1;
            
            echo '<tr style="width:100%;"><td style="width:6%;border:1px solid black;font-family:philosopher;vertical-align:middle;" rowspan="' . $evtMemberCount[$evtId] . '">' . $i . '</td>';
            echo '<td style="width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;" rowspan="' . $evtMemberCount[$evtId] . '">' . $row['GROUPNAME'] . '</td>';
            echo '<td style="width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>';
            echo '<td style="width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td></tr>';
            $i++;
          }
          else
          {
            echo '<tr style="width:100%;">';
            echo '<td style="width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>';
            echo '<td style="width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td></tr>';
            $teamSize++;
          }
          $prevGroupName = $row['GROUPNAME'];
          
          }
          for($j=$teamSize;$j<$evtMemberCount[$evtId];$j++)
          {
            echo '<tr style="width:100%;">';
            echo '<td style="width:21%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>';
            echo '<td style="width:51%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td></tr>';
          }
        }
        
        echo '</table>';
        
        if($stopRegForEvt[$evtId] != 1)
        {
          /* Group Event */
          if($evtMemberCount[$evtId] != 1)
          {
          echo '<br />';
          /* echo '<span  style="margin-left:3%;">Group ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   :&nbsp;&nbsp;&nbsp;</span><input id="evt' . $evtId . 'GroupId" name="groupid"  class="ipAdText" type="text" val="" /><br />'. "\r\n"; */
          echo '<span  style="margin-left:3%;">Group Name :&nbsp;&nbsp;&nbsp;</span><input id="evt'  .$evtId . 'GroupName" name="groupname" class="ipAdText" type="text" val="" />&nbsp;&nbsp;&nbsp;'. "\r\n";
          }
          
          if($userRegistered == 0) {
          echo '<button id="evt' . $evtId . 'btn" class="evtRegBtn" type="submit" value="Reg" onclick="postRegInfo(0, ' . $evtId . ', 1, ' . "'" . $userName . "'" . ', ' . "'" . $userIP . "'" . ', 0,' . "''," . "'#evt" . $evtId . "Table'" . ')"> Register for this Event </button>'; }
          else {
          echo '<button id="evt' . $evtId . 'btn" class="evtRegBtn" style="color:#ff0000;" type="submit" value="Unreg" onclick="postRegInfo(0, ' . $evtId . ', 0, ' . "'" . $userName . "'" . ', ' . "'" . $userIP . "'" . ', 0,' . "''," . "'#evt" . $evtId . "Table'" . ')"> Unregister from this Event </button>';
          }
        }
        else
        {
          echo '<br />';
          echo '<div style="text-align:left;margin-left:3%;width:93%;color:#3333cc;font-weight:bold;"> Event Closed </div>';
        }
      }
    }
    else
    {
      $file = 'http://jicelebrationstest.appspot.com/data/evt_' . $evtId . '.htm';
      echo '&nbsp;&nbsp;&nbsp; <br />';
      echo file_get_contents($file);
    }
	}
	
	function IsAnswerPresent()
	{
		global $ipParsed;
		global $useEcho;
		global $qodId;
		$present = false;
		
		$query = 'SELECT NAME FROM QOD WHERE QID=' . $qodId . ' AND IPADDR="' . $ipParsed . '";';

        $result = mysql_query($query);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
			if($row = mysql_fetch_array($result))
			{
				$present = true;
			}
		}
		
		return $present;
	}
	
	function AddAlbumImages()
	{
		global $useEcho;
		$albPath = "albums/";
		$noAlb   = 1;
		$i       = 0;
		$fileCnt = array();
		
		if(is_dir($albPath))
		{
			$currRootDir = opendir($albPath);
	
			while($folder = readdir($currRootDir))
			{
				if($useEcho ) { echo $folder . '  '; }
				
				$fullPath = $albPath . $folder . '/';
				
				if((is_dir($fullPath)) && ($folder != ".") && ($folder != ".."))
				{				
					if($currDir = opendir($fullPath))
					{
						echo '<div class="albName" onclick="switchAlbums(' . $i . ')">' . $folder . ' <img id="albName' . $i . '" style="float:right;width:3%;border:0px;" src="images/ua.png" /> </div>';
						echo '<div id="alb' . $i . '" class="albDiv">';
						
						$j = 0;
						
						while(($file = readdir($currDir)) != false)
						{
							if(($file != ".") && ($file != "..") && ($file != "thumbs"))
							{
								$noAlb   = 0;
								if($useEcho ) { echo $file . ' '; }
								
								if(strstr($file, ".db"))
								{
								}
								else if(strstr($file, ".mp4"))
								{
									echo '<a href="' . $fullPath . $file . '"><span class="video"> Watch the Video </span></a>';
								}
								else
								{
									echo '<a href="' . $fullPath . $file . '"><img src="' . $fullPath . "thumbs/" . $file . '" /></a>';
								}
								
								$j++;
							}
						}
						
						if($j == 0)
						{
							echo '<div style="color:#331111;text-align:center;font-weight:bold;text-shadow:0px 0px 1px #eeeeee;"> No Pictures in this Album Yet :( </div>';
						}
						$fileCnt[$i] = $j;
						
						echo '</div>';
						$i++;
					}
				}
			}
		}
		
		if($noAlb == 1)
		{
			echo '<div style="color:#aa9999;text-align:center;font-weight:bold;text-shadow:0px 0px 1px #eeeeee;"> No Albums Yet! </div>';
		}
		else
		{
			echo '<script type="text/javascript">';
			echo "Galleria.loadTheme('scripts/themes/lightbox/galleria.lightbox.js');";
			for($j=0;$j<$i;$j++)
			{
				if($fileCnt[$j] != 0)
				{
					echo "$('#alb". $j ."').galleria();";
				}
			}
			echo '</script>';
		}
		
		echo '<br /><br /><br />';
	}
	
  ?>  	
  
    <!-- Top Navigation  -->     
	<div class="ji15LogoDiv">
		<a href="http://jicelebrations.x10host.com" target="_blank"> 
			<img src="images/ji15.png" class="ji15LogoImg" /> 
		</a>
		<!--[if !IE]> --><div class="lineSepLong"></div><!-- <![endif]-->
		<a href="http://www.jasmin-infotech.com" target="_blank"> 
			<img src="images/jilogo.png" style="width:96%;margin-top:0.6%;" />
		</a>
	</div>
	<div class="topNav">
		<table style="padding-left:6%;width:100%;text-align:center;">
			<tr style="width:100%;">
				<td class="navCell" style=""> <a href="#home" class="topNavLink"> Home </a> </td>
				<td class="navCell"> <a href="#news" class="topNavLink"> News </a> </td>
				<td class="navCell"> <a href="#evts" class="topNavLink"> Events </a> </td>
				<td class="navCell"> <a href="#schd" class="topNavLink"> Schedule </a> </td>
				<td class="navCell"> <a href="#rels" class="topNavLink"> Results </a> </td>
				<td class="navCell"> <a href="#albs" class="topNavLink"> Albums  </a> </td>
				<?php if($noReg == 0) { echo '<td class="navCell"> <a href="#uscp" class="topNavLink"> UserInfo  </a> </td>'; } ?>
				<td class="navCell"> <a href="usage.html" target="_blank" class="topNavLink"> Usage Guide  </a> </td>
			</tr>
		</table>
	</div>
	
	<!-- Right Navigation -->
	<div class="rightNavHeader"> Quick Links </div>
	<div class="rightNav" id="lnd">
		<div class="evtLink"> <a href="#evt32" class="leftNavLink"> <img src="images/32.png" class="evtImgSmall" /> &nbsp;Chess  </a> </div>
		<div class="evtLink"> <a href="#evt20" class="leftNavLink"> <img src="images/20.png" class="evtImgSmall" /> &nbsp;Nanban  </a> </div>
		<div class="evtLink"> <a href="#evt11" class="leftNavLink"> <img src="images/11.png" class="evtImgSmall" /> &nbsp;Word Hint  </a> </div>
		<div class="evtLink"> <a href="#evt17" class="leftNavLink"> <img src="images/17.png" class="evtImgSmall" /> &nbsp;Air Warrior  </a> </div>
		<div class="evtLink"> <a href="#evt05" class="leftNavLink"> <img src="images/5.png" class="evtImgSmall" /> &nbsp;Singing  </a> </div>
		<div class="evtLink"> <a href="#evt14" class="leftNavLink"> <img src="images/14.png" class="evtImgSmall" /> &nbsp;Delayed Response  </a> </div>
		<div class="evtLink"> <a href="#evt01" class="leftNavLink"> <img src="images/1.png" class="evtImgSmall" /> &nbsp;Aim the Game  </a> </div>
		<div class="evtLink"> <a href="#evt10" class="leftNavLink"> <img src="images/10.png" class="evtImgSmall" /> &nbsp;Maze'3'  </a> </div>
		<div class="evtLink"> <a href="#evt21" class="leftNavLink"> <img src="images/21.png" class="evtImgSmall" /> &nbsp;Just A Minute  </a> </div>
		<div class="evtLink"> <a href="#evt30" class="leftNavLink"> <img src="images/30.png" class="evtImgSmall" /> &nbsp;Cricket  </a> </div>
		<div class="evtLink"> <a href="#evt34" class="leftNavLink"> <img src="images/34.png" class="evtImgSmall" /> &nbsp;Jasmin Bailvan </a> </div>
		<div class="evtLink"> <a href="#evt02" class="leftNavLink"> <img src="images/2.png" class="evtImgSmall" /> &nbsp;Collage  </a> </div>
		<div class="evtLink"> <a href="#evt24" class="leftNavLink"> <img src="images/24.png" class="evtImgSmall" /> &nbsp;Poster Drawing  </a> </div>
		<div class="evtLink"> <a href="#evt35" class="leftNavLink"> <img src="images/35.png" class="evtImgSmall" /> &nbsp;Throwball (Ladies) </a> </div>
		<div class="evtLink"> <a href="#evt03" class="leftNavLink"> <img src="images/3.png" class="evtImgSmall" /> &nbsp;Soap Architect  </a> </div>
		<div class="evtLink"> <a href="#evt00" class="leftNavLink"> <img src="images/0.png" class="evtImgSmall" /> &nbsp;Big Shot  </a> </div>
		<div class="evtLink"> <a href="#evt04" class="leftNavLink"> <img src="images/4.png" class="evtImgSmall" /> &nbsp;Poster Designing  </a> </div>
		<div class="evtLink"> <a href="#evt08" class="leftNavLink"> <img src="images/8.png" class="evtImgSmall" /> &nbsp;Jasmin's Lucky Charm  </a> </div>
		<div class="evtLink"> <a href="#evt12" class="leftNavLink"> <img src="images/12.png" class="evtImgSmall" /> &nbsp;Plate and Bangle  </a> </div>
		<div class="evtLink"> <a href="#evt06" class="leftNavLink"> <img src="images/6.png" class="evtImgSmall" /> &nbsp;Dumb Charades  </a> </div>
		<div class="evtLink"> <a href="#evt19" class="leftNavLink"> <img src="images/19.png" class="evtImgSmall" /> &nbsp;Ring to Bottle  </a> </div>
		<div class="evtLink"> <a href="#evt33" class="leftNavLink"> <img src="images/33.png" class="evtImgSmall" /> &nbsp;Shuttle  </a> </div>
		<div class="evtLink"> <a href="#evt23" class="leftNavLink"> <img src="images/23.png" class="evtImgSmall" /> &nbsp;Find the Partner  </a> </div>
		<div class="evtLink"> <a href="#evt15" class="leftNavLink"> <img src="images/15.png" class="evtImgSmall" /> &nbsp;Slow Rider  </a> </div>
		<div class="evtLink"> <a href="#evt27" class="leftNavLink"> <img src="images/27.png" class="evtImgSmall" /> &nbsp;Six legged race  </a> </div>
		<div class="evtLink"> <a href="#evt16" class="leftNavLink"> <img src="images/16.png" class="evtImgSmall" /> &nbsp;Debate  </a> </div>
		<div class="evtLink"> <a href="#evt28" class="leftNavLink"> <img src="images/28.png" class="evtImgSmall" /> &nbsp;Drink Enough  </a> </div>
		<div class="evtLink"> <a href="#evt25" class="leftNavLink"> <img src="images/25.png" class="evtImgSmall" /> &nbsp;Haha Huhu Haehae  </a> </div>
		<div class="evtLink"> <a href="#evt07" class="leftNavLink"> <img src="images/7.png" class="evtImgSmall" /> &nbsp;Blind Game  </a> </div>
		<div class="evtLink"> <a href="#evt22" class="leftNavLink"> <img src="images/22.png" class="evtImgSmall" /> &nbsp;Top Manager  </a> </div>
		<div class="evtLink"> <a href="#evt26" class="leftNavLink"> <img src="images/26.png" class="evtImgSmall" /> &nbsp;Assembler  </a> </div>
		<div class="evtLink"> <a href="#evt31" class="leftNavLink"> <img src="images/31.png" class="evtImgSmall" /> &nbsp;Carrom  </a> </div>
		<div class="evtLink"> <a href="#evt29" class="leftNavLink"> <img src="images/29.png" class="evtImgSmall" /> &nbsp;Picture Puzzle  </a> </div>
		<div class="evtLink"> <a href="#evt18" class="leftNavLink"> <img src="images/18.png" class="evtImgSmall" /> &nbsp;Pocket the Ball  </a> </div>
		<div class="evtLink"> <a href="#evt09" class="leftNavLink"> <img src="images/9.png" class="evtImgSmall" /> &nbsp;Sense of Balance  </a> </div>
		<div class="evtLink"> <a href="#evt13" class="leftNavLink"> <img src="images/13.png" class="evtImgSmall" /> &nbsp;Detective</a> </div>
		
		
		
		
	</div>
	
	<!-- Home Section -->
	<a id="home" name="home"> &nbsp; </a><br /><div class="lineSepLong"></div>
	<div class="mainHeading"> JASMIN Infotech 16th Year Anniversary Celebrations - Test </div><div class="lineSepLong"></div><br /><br />
	<img src="images/header.png" style="width:72%;margin-left:12%;margin-right:12%;" /><br /><br /><div class="lineSepLong"></div>

	<div class="todayDiv"> 
		<h3 style="text-align:center;">Todays Events </h3><!--[if !IE]> --><div class="lineSepLong"></div><!-- <![endif]--><br />
		
		<!-- EDIT HERE with the current date -->
		<div class="date" style="width:100%;text-align:left;"> Friday, 02-08-2013 </div>
		
		<!-- EDIT HERE for Events of the day -->
		<ul>
			<li>Today :- Shuttle - 3.30 pm  Throw ball- 4.30 pm Dumb charat-4.00 pm Ring to Bottle - 5.00 pm </li>
			<li>Find the partner registration will be closed by today evening</li>
		</ul>
	</div>
	<div style="float:right;width:1px;margin:3%;">
		<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
	</div>
	
	<br /><br /> Welcome <span class="uName" id="wun"> <?php echo $fullName; ?> </span>, browse through the site and register for events <br /><br />
	A Milestone, 15 years of Innovation..... <br /> Welcome to Jasmin's anniversary celebration spectacular.
	<br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
		if($noReg == 0)
		{
			echo '<div class="lineSepLong"></div><h3> Question of the day </h3>';
			echo '<div id="qodDiv">';
			echo $qodQues . '&nbsp;:&nbsp;';
			
			if(IsAnswerPresent() == false)
			{
				echo '<input id="qOfDay" name="qodAns" type="text" value="" > </input>';
				echo '<button id="qOfDatBtn" type="submit" value="Reg" onclick="submitQODAnswer(' . $qodId . ", '" . $fullName . "', '" . $ipParsed . "'" . ')"> Submit </button><br /><br />';
			}
			else
			{
				echo '<span style="color:#666699;"> You have already anwered  the question </span>';
			}
			echo '</div>';
		}
	?>
	
	<!-- News Section -->
	<a id="news" name="news"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> News </h2>
	
	<br />
	
	<!-- EDIT HERE for News -->
	<ol style="font-family:Handlee;">
		<li> Registrations for all events now open </li>
		<li> SUBMISSION:-Photography(Hard and Softcopy) to Hariharapandiyan and Poster Design to Arul.M<img src="images/new.gif" style="" /></li>
		<li> Cricket schedule will be announced soon<img src="images/new.gif" style="" /></li>
		<li> Web portal Usage Guide updated in the <a href="usage.html" target="_blank"> following path  </a> </li>
		<li> Web portal <a href="http://celebrations/" target="_blank"> http://celebrations/ </a> for internal users and <a href="http://jicelebrations.x10host.com/" target="_blank"> http://jicelebrations.x10host.com/ </a> for external users are launched </li>
	</ol>
	
	<br />
 	
	<!-- Events Section -->
	<a id="evts" name="evts"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> Events </h2>
	
	<div class="eventsList">
		<table style="width:99%;">
			<tr style="width:100%";>
				
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt32" class="evtListLink"> <img src="images/32.png" class="evtImgTiny" /><br /> Chess  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt20" class="evtListLink"> <img src="images/20.png" class="evtImgTiny" /><br /> Nanban  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt11" class="evtListLink"> <img src="images/11.png" class="evtImgTiny" /><br /> Word Hint  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt17" class="evtListLink"> <img src="images/17.png" class="evtImgTiny" /><br /> Air Warrior  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt05" class="evtListLink"> <img src="images/5.png" class="evtImgTiny" /><br />  Singing  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt14" class="evtListLink"> <img src="images/14.png" class="evtImgTiny" /><br /> Delayed Response  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt01" class="evtListLink"> <img src="images/1.png" class="evtImgTiny" /><br />  Aim the Game  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt10" class="evtListLink"> <img src="images/10.png" class="evtImgTiny" /><br /> Maze'3'  </a> </div>
				</tr>
				<tr style="width:100%";>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt21" class="evtListLink"> <img src="images/21.png" class="evtImgTiny" /><br /> Just A Minute  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt30" class="evtListLink"> <img src="images/30.png" class="evtImgTiny" /><br /> Cricket  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt34" class="evtListLink"> <img src="images/34.png" class="evtImgTiny" /><br /> Jasmin Bailvan </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt02" class="evtListLink"> <img src="images/2.png" class="evtImgTiny" /><br />  Collage  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt24" class="evtListLink"> <img src="images/24.png" class="evtImgTiny" /><br /> Poster Drawing  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt35" class="evtListLink"> <img src="images/35.png" class="evtImgTiny" /><br /> Throwball (Ladies) </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt03" class="evtListLink"> <img src="images/3.png" class="evtImgTiny" /><br />  Soap Architect  </a> </div>				
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt00" class="evtListLink"> <img src="images/0.png" class="evtImgTiny" /><br />  Big Shot  </a> </div>
				</tr>
				<tr style="width:100%";>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt04" class="evtListLink"> <img src="images/4.png" class="evtImgTiny" /><br />  Poster Designing  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt08" class="evtListLink"> <img src="images/8.png" class="evtImgTiny" /><br />  Jasmin's Lucky Charm  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt12" class="evtListLink"> <img src="images/12.png" class="evtImgTiny" /><br /> Plate and Bangle  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt06" class="evtListLink"> <img src="images/6.png" class="evtImgTiny" /><br />  Dumb Charades  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt19" class="evtListLink"> <img src="images/19.png" class="evtImgTiny" /><br /> Ring to Bottle  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt33" class="evtListLink"> <img src="images/33.png" class="evtImgTiny" /><br /> Shuttle  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt23" class="evtListLink"> <img src="images/23.png" class="evtImgTiny" /><br /> Find the Partner  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt15" class="evtListLink"> <img src="images/15.png" class="evtImgTiny" /><br /> Slow Rider  </a> </div>
				</tr>
				<tr style="width:100%";>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt27" class="evtListLink"> <img src="images/27.png" class="evtImgTiny" /><br /> Six legged race  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt16" class="evtListLink"> <img src="images/16.png" class="evtImgTiny" /><br /> Debate  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt28" class="evtListLink"> <img src="images/28.png" class="evtImgTiny" /><br /> Drink Enough  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt25" class="evtListLink"> <img src="images/25.png" class="evtImgTiny" /><br /> Haha Huhu Haehae  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt07" class="evtListLink"> <img src="images/7.png" class="evtImgTiny" /><br />  Blind Game  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt22" class="evtListLink"> <img src="images/22.png" class="evtImgTiny" /><br /> Top Manager  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt26" class="evtListLink"> <img src="images/26.png" class="evtImgTiny" /><br /> Assembler  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt31" class="evtListLink"> <img src="images/31.png" class="evtImgTiny" /><br /> Carrom  </a> </div>
				</tr>
				<tr style="width:100%";>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt29" class="evtListLink"> <img src="images/29.png" class="evtImgTiny" /><br /> Picture Puzzle  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt18" class="evtListLink"> <img src="images/18.png" class="evtImgTiny" /><br /> Pocket the Ball  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt09" class="evtListLink"> <img src="images/9.png" class="evtImgTiny" /><br />  Sense of Balance  </a> </div>
				<td style="width:9%;"> <div class="eventDiv"><a href="#evt13" class="evtListLink"> <img src="images/13.png" class="evtImgTiny" /><br /> Detective Straw  </a> </div>
				
				</tr>
		
			
		</table>
	</div>
	
	<!-- Tournaments Section -->
	<!-- <a id="tour" name="tour"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> Tournaments </h2>
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> -->
	
	<!-- Schedules Section -->
	<a id="schd" name="schd"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> Schedule </h2>
	
	<table style="width:87%;margin:1%;margin-left:6%;font-size:105%;">
		<tr>
			<td colspan="7" style="border:1px solid #000000;background-color:#dddddd;text-align:center;"> 
				Legend <br /> 
				<span class="schDate"> Date </span><br />
				<span class="schReg"> Registration/Submission Deadline </span><br />
				<span class="schEvt"> Event/Polling Time </span><br />
			</td>
		</tr>
		<tr style="width:99%;">
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Sunday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Monday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Tuesday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Wednesday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Thursday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Friday </td>
			<td style="width:14.2%;border:1px solid #000000;background-color:#999999;text-align:center;"> Saturday </td>
		</tr>
		
				
		<?php
		
			$date = 14;
			$mnth = 7;
			$year = 2013;
			$d    = "";
			
			for($i=0;$i<5;$i++)
			{
				echo '<tr style="width:99%;">';
				
				for($j=0;$j<7;$j++)
				{
					if($date < 10) { $d = '0'. $date; }
					else {$d = $date; }
					$d = $d . '.';
					if($mnth < 10) { $d = $d . '0'. $mnth; }
					else {$d = $d . $mnth; }
					$d = $d . '.';
					$d = $d . $year;
					
					echo '<td style="width:14.2%;border:1px solid #000000;background-color:#eeeeee;text-align:center;">';
					echo '<div class="schDate">' . $d . '</div>';
					echo '<!--[if !IE]> --><div class="lineSepLong" style="height:1px;"></div><!-- <![endif]-->';
					echo '<div class="schReg">' . FindSchReg($d) . '</div>';
					echo '<div class="schEvt">' . FindSchEvt($d) . '</div>';
					echo '</td>';
					
					$date++;
					if($date >= 32) {$date = 1; $mnth++;}
				}
				
			    echo '</tr>';
			}

			function FindSchReg($d)
			{
				global $evtSchDates;
				global $evtSchTimes;
				global $events;
				
				$respTxt = "";
				
				for($i=0;$i<count($evtSchDates);$i++)
				{
					if($evtSchDates[$i] == $d)
					{
						if($i < count($events))
						{
							$respTxt = $respTxt . $events[$i] . '@' . $evtSchTimes[$i] . ', ';
						}
					}
				}
				
				if($respTxt == "")
				{
					$respTxt = "Free";
				}
				
				return $respTxt;
			}
			
			function FindSchEvt($d)
			{
				global $evtSchDates;
				global $evtSchTimes;
				global $extraDates;
				global $events;
				
				$respTxt = "";
				
				for($i=0;$i<count($evtSchDates);$i++)
				{
					if($evtSchDates[$i] == $d)
					{
						if($i >= count($events))
						{
							$k = $i - count($events);
							$respTxt = $respTxt . $events[$k] . '@' . $evtSchTimes[$i] . ', ';
						}
					}
				}
				for($k=0;$k<count($events);$k++)
				{
					if(isset($extraDates[$k]) == true)
					{
						if(strstr($extraDates[$k], $d))
						{
							$respTxt = $respTxt . $events[$k] . '@' . $evtSchTimes[$k+count($events)] . ', ';
						}
					}
				}
				
				if($respTxt == "")
				{
					$respTxt = "Free";
				}
				
				return $respTxt;
			}
		?>
		
	</table>
	
	<!-- Results Section -->
	<a id="rels" name="rels"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> Results </h2>
	<div style="text-align:center;">Results will be updated only at the end of all events. </div><br /><br />
		
	<!-- Albums Section -->
	<a id="albs" name="albs"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> Albums </h2>
	<?php AddAlbumImages(); ?>
		
	<!-- UserCP Section -->
	<?php
		if($noReg == 0)
		{
			echo '<a id="uscp" name="uscp"> &nbsp; </a><div class="lineSepLong"></div>';
		
			echo '<div id="userCPFrame">  </div>';
		
			echo '<!-- <button class="evtRegBtn" style="margin:0px;margin-left:39%;width:22%;font-size:96%;" onclick="showUserCP()"> Refresh Info </button> -->';
			echo '<br /><br />';
		}
    ?>
	
	<!-- Event Section -->
	<a id="evt32" name="evt32"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/32.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Chess</h2>	
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				The tournament for Chess game.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Seperate event for both gender</li>
					<li>If any player,skip the match for any reason,their opponent will be declared winner for the corresponding round</li> 
					<li>There will be 5 rounds in total.</li>
					<li>The team and match schedules will be announced once registration over</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[32]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[32]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Tournaments Starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[32+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[32+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt32Table" style="margin-left:3%;"> <?php {PrintEvtMembers(32);} ?> </div>
			</td>
		</tr>
	</table>
	<!-- Event Section -->
	<a id="evt20" name="evt20"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/20.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Nanban </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Know your friend. Participate with your dear friend .
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two participants, live event </li>
					<li>Common event for both gender </li>
					<li>Participant should answer correctly for the question about your friend</li>
					<li>Participant who answer correctly for maximum question will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[20]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[20]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[20+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[20+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt20Table" style="margin-left:3%;"> <?php {PrintEvtMembers(20);} ?> </div>
			</td>
		</tr>
	</table>
		
		<!-- Event Section -->
	<a id="evt11" name="evt11">  &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/11.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Word Hint </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Mind your words. Not here. Time to play with words.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per team</li>
					<li>Common event for both gender</li>
					<li>10 words will be given per team (5 Tamil words, 5 English words) </li>
					<li>Maximum 5 clues allowed for finding a word and clues should be meaningful word</li>
					<li>Tamil clues only allowed for Tamil words and English clues for English words</li>
					<li>5 minutes will be given for finding all 10 words</li>
					<li>The hint word should not have part of the actual word</li>
					<li>The team who find the maximun words in short time will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[11]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[11]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[11+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[11+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt11Table" style="margin-left:3%;"> <?php {PrintEvtMembers(11);} ?> </div>
			</td>
		</tr>
	</table>
		
		<!-- Event Section -->
	<a id="evt17" name="evt17"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/17.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Air Warroir </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Try to balance a balloon simply by blowing.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to balance the baloon in air </li>
					<li>Participants who balance for long time will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[17]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[17]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[17+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[17+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt17Table" style="margin-left:3%;"> <?php {PrintEvtMembers(17);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt05" name="evt05"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/5.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Singing </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Sing a song of your choice. Chance for JASMINATES to be SUPER SINGERS.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to sing a single song minimum of 3 minutes</li>
					<li>Judges decision is final</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[5]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[5]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[5+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[5+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt5Table" style="margin-left:3%;"> <?php {PrintEvtMembers(5);} ?> </div>
			</td>
		</tr>
	</table>
			
			<!-- Event Section -->
	<a id="evt14" name="evt14"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/14.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Delayed Response </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Playing mind games. Not everyone can remember everything. Let�s find how much you can remember�
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to answer for the previous question</li>
					<li>Participants who scores more points will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[14]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[14]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[14+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[14+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt14Table" style="margin-left:3%;"> <?php {PrintEvtMembers(14);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt01" name="evt01"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/1.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Aim the Game </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Come with the Aim! Go with the Gain!!<br />
				Event for persons with good aiming capacity. Not only for them!!! ?
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to aim and throw the dart </li>
					<li>Participant who scores more points will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[1]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[1]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[1+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[1+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt1Table" style="margin-left:3%;"> <?php {PrintEvtMembers(1);} ?> </div>
			</td>
		</tr>
	</table>
	
	
	<!-- Event Section -->
	<a id="evt21" name="evt21"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/21.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Just A Minute </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Talk for a minute. Walk with a prize. 
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to speak on given topic for one minute </li>
					<li>Judges decision will be the final</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[21]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[21]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[21+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[21+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt21Table" style="margin-left:3%;"> <?php {PrintEvtMembers(21);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt10" name="evt10"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/10.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Maze'3' </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Build your dream house not with bricks, but with cups.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, time based live event </li>
					<li>Common event for both gender</li>
					<li>Cups will be provided  </li>
					<li>Cups have to be arranged in a given pattern </li>
					<li>The participant who arrange in short time will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[10]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[10]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[10+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[10+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt10Table" style="margin-left:3%;"> <?php {PrintEvtMembers(10);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt30" name="evt30"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/30.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Cricket</h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Come dude let�s play cricket!!!
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Group(11 main,maximum 3 substitute if required), live event </li>
					<li>Seperate event for men </li>
					<li>The team and match schedules will be announced once registration over</li>
					<li></li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[30]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[30]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Tournaments starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[30+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[30+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt30Table" style="margin-left:3%;"> <?php {PrintEvtMembers(30);} ?> </div>
			</td>
		</tr>
	</table>
	<!-- Event Section -->
	<a id="evt34" name="evt34"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/34.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Jasmin Bailwan</h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event to show your physical strength, endurance, technique against your opponent. Come on lets Prove!!! 
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Seperate event for both gender </li>
					<li>The schedule will be announced once registration over</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[34]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[34]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Tournaments Starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[34+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[34+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt34Table" style="margin-left:3%;"> <?php {PrintEvtMembers(34);} ?> </div>
			</td>
		</tr>
	</table>
	<!-- Event Section -->
	<a id="evt02" name="evt02"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/2.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Collage </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for expressing your imagination and creativity with scissors, papers and glues.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per team </li>
					<li>Common event for both gender </li>
					<li>Only newspaper should be used </li>
					<li>One A2 size chart paper will be provided per team </li>
					<li>Participants should bring the other required materials (Glue, scissor,fresh newspaper) </li>
					<li>Collage Theme:Celebration </li>
					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[2]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[2]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event time : </td> 
						<td class="date"> <?php echo $evtSchDates[2+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[2+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt2Table" style="margin-left:3%;"> <?php {PrintEvtMembers(2);} ?> </div>
			</td>
		</tr>
	</table>
<!-- Event Section -->
	<a id="evt35" name="evt35"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/35.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Throwball</h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for ladies. Lets see who throw good..
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Event for women only </li>
					<li>Team - 8members (6 main players,maximum 2 substitute if required)</li>
					<li>Server should be in one hand,Net touch serve is not allowed,Under arm serve is not allowed </li>
					<li>The players can catch the ball in two hands and should have to throw it in one hand</li>
					<li>The players can hold the ball for 3seconds before the throw, if the time exceeds more than 3seconds will be the foul.</li>
					<li>15 points per set; Two set for a game; The team who win the two continuously will be the winner; If not one more set have to play for 10 points </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[35]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[35]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Tournaments Starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[35+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[35+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt35Table" style="margin-left:3%;"> <?php {PrintEvtMembers(35);} ?> </div>
			</td>
		</tr>
	</table>	
		
	<!-- Event Section -->
	<a id="evt24" name="evt24"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/24.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Poster Drawing </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for artists. Show your talent in the art of drawing.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual,live and time depend event</li>
					<li>Common event for both gender</li>
					<li>Charts will be given to participants</li>
					<li>Poster drawing presented depends on the themes to be given</li>
					<li>Judges decision will be the final</li>
					<li>Time Duration:45 min</li>

				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[24]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[24]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[24+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[24+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt24Table" style="margin-left:3%;"> <?php {PrintEvtMembers(24);} ?> </div>
			</td>
		</tr>
	</table>
	
	
	<!-- Event Section -->
	<a id="evt03" name="evt03"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/3.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Soap Architect </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for innovative architects. Build your dream on a SOAP.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, time based live event</li>
					<li>Common event for both gender</li>
					<li>Soap and needed equipments have to be brought by the participant</li>
					<li>Architect Theme: Bird/Animal</li>
					<li>60 mins time</li>
					<li>Judges decision is final</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[3]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[3]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[3+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[3+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt3Table" style="margin-left:3%;"> <?php {PrintEvtMembers(3);} ?> </div>
			</td>
		</tr>
	</table>
			
	<!-- Event Section -->
	<a id="evt00" name="evt00"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/0.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Big Shot </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for photo crazies.Single photo narrates thousands of meanings. Waiting for your turn !!!
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, Polling Event</li>
					<li>Common event for both gender</li>
					<li>Participants should give recently taken photographs, not more than one month</li>
					<li>Edited photos are Rejected</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Submission Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[0]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[0]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Polling Time: </td> 
						<td class="date"> <?php echo $evtSchDates[0+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[0+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt0Table" style="margin-left:3%;"> <?php {PrintEvtMembers(0);} ?> </div>
			</td>
		</tr>
	</table>	
		
	
	
	
	<!-- Event Section -->
	<a id="evt04" name="evt04"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/4.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Poster Designing </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Design your innovation in digital pixels.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual event </li>
					<li>Common event for both gender </li>
					<li>Participant has to submit the design by photoshop based on given Theme </li>
					<li>Your Design Theme will be on "Jasmin Today" </li>
					<li>Judges decision is final</li>
					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Submission Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[4]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[4]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Polling Date: </td> 
						<td class="date"> <?php echo $evtSchDates[4+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[4+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt4Table" style="margin-left:3%;"> <?php {PrintEvtMembers(4);} ?> </div>
			</td>
		</tr>
	</table>
		
			<!-- Event Section -->
	<a id="evt08" name="evt08"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/8.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Jasmin's Lucky Charm </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event to find the luckiest person among JASMINATES.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Group live event </li>
					<li>Common event for both gender </li>
					<li>Rules will be announced on the spot</li>
					<li>The luckiest participant will get the prize</li>
					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[8]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[8]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[8+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[8+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt8Table" style="margin-left:3%;"> <?php {PrintEvtMembers(8);} ?> </div>
			</td>
		</tr>
	</table>
	
	
	<!-- Event Section -->
	<a id="evt12" name="evt12"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/12.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Plate and Bangle</h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Place the bangle on a plate. Place the plate on your head. Game for fun and joy.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Seperate event for women </li>
					<li>Participant has to place the bangle on the plate</li>
					<li>Participants who scores more points will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[12]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[12]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[12+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[12+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt12Table" style="margin-left:3%;"> <?php {PrintEvtMembers(12);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt06" name="evt06"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/6.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Dumb Charades </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				�Action speaks louder than words�. Show your words through actions.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per Team, live event </li>
					<li>Common event for both gender </li>
					<li>One person from a team has to act for the word given by event organizer, another person has to find the word </li>
					<li>The person who is acting for the word should not speak and the actions are not related to letters</li>
					<li>The team which find the word within short time will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[6]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[6]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[6+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[6+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt6Table" style="margin-left:3%;"> <?php {PrintEvtMembers(6);} ?> </div>
			</td>
		</tr>
	</table>
		
		<!-- Event Section -->
	<a id="evt19" name="evt19"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/19.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Ring to Bottle </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Many of us know fishing. Handle a bait to put a ring on a bottle neck. Seems easy? Try it.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common to both gender </li>
					<li>Participant who put the ring to bottle using bait within a minute will be the winner </li>				
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[19]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[19]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[19+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[19+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt19Table" style="margin-left:3%;"> <?php {PrintEvtMembers(19);} ?> </div>
			</td>
		</tr>
	</table>

	<!-- Event Section -->
	<a id="evt33" name="evt33"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/33.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Shuttle </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				The tournament for Shuttle cock game.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per team</li>
					<li>Seperate event for both gender </li>
					<li>The team and match schedules will be announced once registration over</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[33]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[33]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Tournaments Starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[33+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[33+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt33Table" style="margin-left:3%;"> <?php {PrintEvtMembers(33);} ?> </div>
			</td>
		</tr>
	</table>
		
				
			<!-- Event Section -->
	<a id="evt23" name="evt23"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/23.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Find the Partner </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Participate with a partner. You will lose and find them through this event.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per team, live event </li>
					<li>Common event for both gender </li>
					<li>The rules will be announced on the spot</li>					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[23]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[23]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[23+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[23+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt23Table" style="margin-left:3%;"> <?php {PrintEvtMembers(23);} ?> </div>
			</td>
		</tr>
	</table>
			
			<!-- Event Section -->
	<a id="evt15" name="evt15"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/15.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Slow Rider </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for �professional level� bike riders. Try to balance by driving slow.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to ride the bike and reach the target</li>
					<li>Participants who takes more time to reach the target will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[15]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[15]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[15+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[15+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt15Table" style="margin-left:3%;"> <?php {PrintEvtMembers(15);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt27" name="evt27"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/27.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Six Legged Race </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Those who got six legs can participate in this event.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Three per team, live event </li>
					<li>Seperate event for both gender </li>
					<li>Participants legs are tied with each other</li>
					<li>The team which reaches the finish line first will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[27]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[27]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[27+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[27+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt27Table" style="margin-left:3%;"> <?php {PrintEvtMembers(27);} ?> </div>
			</td>
		</tr>
	</table>
	<!-- Event Section -->
	<a id="evt16" name="evt16"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/16.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Debate </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				War of Words. Participate and express the freedom of speech.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Group, live event </li>
					<li>Common event for both gender </li>
					<li>The topics will be announced soon</li>
					<li>Judges decision will be the final</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[16]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[16]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[16+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[16+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt16Table" style="margin-left:3%;"> <?php {PrintEvtMembers(16);} ?> </div>
			</td>
		</tr>
	</table>
	
<!-- Event Section -->
	<a id="evt28" name="evt28"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/28.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Drink Enough </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Is drinking a cool drink easy? Why don�t you try and tell.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common to both gender </li>
					<li>Two straw and one cool drink bottle will be given per person</li>
					<li>Insert one straw into the other and drink</li>
					<li>Participant who finished drinking will be the winner (No time limit) </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[28]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[28]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[28+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[28+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt28Table" style="margin-left:3%;"> <?php {PrintEvtMembers(28);} ?> </div>
			</td>
		</tr>
	</table>
	
	<!-- Event Section -->
	<a id="evt25" name="evt25"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/25.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Haha-Huhu-Haehae </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Time to get funny. Participate to get some fun.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Group,live and fun event </li>
					<li>Common event for both gender </li>
					<li>The rules will be announced on the spot</li>					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[25]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[25]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[25+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[25+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt25Table" style="margin-left:3%;"> <?php {PrintEvtMembers(25);} ?> </div>
			</td>
		</tr>
	</table>
			
	<!-- Event Section -->
	<a id="evt07" name="evt07"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/7.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Blind Game </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Act blind. Spot the right. Dedicated to brothers and sisters who are really visually impaired.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Eyes will be closed </li>
					<li>You have to draw the missing part of the picture </li>
					<li>Those who complete the picture in short time with accuracy will be the winner </li>
					
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[7]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[7]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[7+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[7+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt7Table" style="margin-left:3%;"> <?php {PrintEvtMembers(7);} ?> </div>
			</td>
		</tr>
	</table>
			
<!-- Event Section -->
	<a id="evt22" name="evt22"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/22.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Top Manager</h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Situations may happen in life. One who manages it is the best manager.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Events only for managers </li>
					<li>Paper will be provided</li>
					<li>Different type of situation will be given</li>
					<li>Participant who give best solutions relevant to the situation will be awarded</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt">Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[22]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[22]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt">Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[22+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[22+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt22Table" style="margin-left:3%;"> <?php {PrintEvtMembers(22);} ?> </div>
			</td>
		</tr>
	</table>

	<!-- Event Section -->
	<a id="evt26" name="evt26"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/26.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp; Assembler </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Pen is mightier than the sword. But arranging disassembled pens is more than walking on a sword.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common event for both gender </li>
					<li>Participant has to reassemble the pens </li>
					<li>Person who assembles maximum no. of pens within time will be winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[26]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[26]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[26+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[26+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt26Table" style="margin-left:3%;"> <?php {PrintEvtMembers(26);} ?> </div>
			</td>
		</tr>
	</table>
			
	<!-- Event Section -->
	<a id="evt31" name="evt31"> &nbsp; </a><div class="lineSepLong"></div>
	<h2><img src="images/31.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Carrom </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				The tournament for Carrom board game.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two per team</li>
					<li>Seperate event for both gender</li>
					<li>The team and match schedules will be announced once registration over</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[31]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[31]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt">Tournaments Starts from : </td> 
						<td class="date"> <?php echo $evtSchDates[31+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[31+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt31Table" style="margin-left:3%;"> <?php {PrintEvtMembers(31);} ?> </div>
			</td>
		</tr>
	</table>			
			<!-- Event Section -->
	<a id="evt29" name="evt29"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/29.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Picture Puzzle </h2>	
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Arrange the pieces to get the original picture. A test of concentration.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Common to both gender </li>
					<li>Original picture will provided </li>
					<li>Rejoin the picture within 5 minutes with refer to original picture</li> 
					<li>Participants who rejoins the picture in short time will be the winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[29]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[29]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[29+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[29+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt29Table" style="margin-left:3%;"> <?php {PrintEvtMembers(29);} ?> </div>
			</td>
		</tr>
	</table>
	
				
	<!-- Event Section -->
	<a id="evt18" name="evt18"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/18.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Pocket the Ball </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Put the bouncing ball inside a bucket in a pitch.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event</li>
					<li>Common event for both gender</li>
					<li>Bucket the ball in a single pitch through the Obstacles</li>
					<li>Ball bucketed with more than one bounce is not counted</li>
					<li>Participants must throw from certain specified distance, crossing the mark might lead to disqualification</li>
					<li>Participants who pocket the ball more times will be the winner</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[18]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[18]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[18+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[18+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt18Table" style="margin-left:3%;"> <?php {PrintEvtMembers(18);} ?> </div>
			</td>
		</tr>
	</table>
		
	<!-- Event Section -->
	<a id="evt09" name="evt09"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/9.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Sense of Balance </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Event for perfect balance. Not balancing time and work, but simply a steel pipe.
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Individual, live event </li>
					<li>Separate event for both gender </li>
					<li>Participant has to balance the rod/ pipe by a finger and reach the target </li>
					<li>Participants who balance for longer time and also reach the target in short time will be winner </li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[9]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[9]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[9+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[9+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt9Table" style="margin-left:3%;"> <?php {PrintEvtMembers(9);} ?> </div>
			</td>
		</tr>
	</table>

		
	<!-- Event Section -->
	<a id="evt13" name="evt13"> &nbsp; </a><div class="lineSepLong"></div>
	<h2> <img src="images/13.png" class="evtImgBig" /> &nbsp;&nbsp;&nbsp;Detective </h2>
	<!--[if !IE]> --><div class="lineSepTiny"></div><!-- <![endif]-->
	<table style="width:100%;">
		<tr style="width:100%;">
			<td	<?php { echo 'style="width:39%;"';}  ?> >
				<h3> Description </h3>
				Chance for being a detective. Use your logical ability to find the solution. <br />
				"Let's show your Logic thinking,Memory capacity and finally check how clever you are !!!"
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Rules </h3> 
				 <ol>
					<li>Two members event, Live Event � Two rounds </li>
					<li>Common event for both gender</li>
					<li>Round one �Participants have to answer ten questions from the essay in 15 Minutes</li>
					<li>Round two �Participants have to answer the questions asked on the basis of one image showed in projector</li>
				</ol>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
				<h3> Schedule </h3> 
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Registration Deadline : </td> 
						<td class="date"> <?php echo $evtSchDates[13]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[13]; ?> </td>  
					</tr> 
				</table>
				<table style="width:100%;"> 
					<tr style="width:100%;">
						<td class="timeEvt"> Event Time : </td> 
						<td class="date"> <?php echo $evtSchDates[13+$totEvts]; ?> </td> 
						<td class="time"> <?php echo $evtSchTimes[13+$totEvts]; ?> </td>  
					</tr> 
				</table>
				<!--[if !IE]> --><div class="lineSepSmall"></div><!-- <![endif]-->
			</td>
			<td style="width:1%;vertical-align:middle;">
				<div class="lineSepVert"> <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div>
			</td>
			<td	<?php { echo 'style="width:69%;"';}  ?> >
				<div id="evt13Table" style="margin-left:3%;"> <?php {PrintEvtMembers(13);} ?> </div>
			</td>
		</tr>
	</table>
		
		
	
		
	
	
		
	
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />	
	
  </body>

  
  
  
</html>
