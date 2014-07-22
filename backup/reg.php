<?php
  global $con;
  $useEcho  = 0;
  $mysqlerr = 0;
  $maxMemReached = 0;
  $evtMemberCount = array(1, 1, 2, 1, 1, 1, 2, 1 , 1, 1, 1, 2, 1, 2 ,1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 1 ,1, 3, 1, 1, 1, 2, 1, 2, 1, 8);

  if((isset($_POST['admin']) == true) && (isset($_POST['evtId']) == true) && (isset($_POST['set']) == true) && (isset($_POST['name']) == true) && (isset($_POST['ipaddr']) == true) && (isset($_POST['groupId']) == true) && (isset($_POST['groupName']) == true))
  {	
	$con = mysqli_connect("localhost","guest","pass");
	
	if(mysql_errno() != 0)
    {
      if($useEcho == 1) echo "No Connection con = " . $con . '__error = ' . mysql_error() . '<br />';
      $mysqlerr = 1;
    }
    else
    {
      mysqli_select_db( $con, "jas16anniv");

      if(mysql_errno() != 0)
      {
        if($useEcho == 1) echo "Could not select Table con = " . $con . '__error = ' . mysql_error() . '<br />';
        $mysqlerr = 2;
      }
      else
      {
		if($_POST['set'] == 1)
		{
			if(($_POST['groupName'] == "") && ($evtMemberCount[$_POST['evtId']] != 1))
			{
				echo '<br /><div style="color:red;"> Please provide a group name to enter a group event </div>';
				$maxMemReached = 1;
				$Query = 'SELECT COUNT(*) as total from eventinfo;'; /* Dummy Query */
			}
			else if($evtMemberCount[$_POST['evtId']] != 1)
			{
				$Query = 'SELECT COUNT(*) as total from eventinfo WHERE EVTID="' . $_POST['evtId'] . '" AND GROUPNAME="' . $_POST['groupName'] . '";';
				
				$result = mysqli_query($con,$Query);
				$data   = mysqli_fetch_assoc($result);
				
				if(mysql_errno() != 0)
				{
				  if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
				  $mysqlerr = 5;
				}			
				
				if($data['total'] >= $evtMemberCount[$_POST['evtId']])
				{
					$maxMemReached = 1;
					
					echo '<br /><div style="color:red;"> The team you have specified is full, Please add to another team </div>';
				}
			}
			
			if($maxMemReached == 0)
			{
				$Query  = 'INSERT INTO eventinfo (evtid, name, ipaddr, groupid, groupname) ';
				$Query .= 'VALUES (';
				$Query .= "'" . $_POST['evtId'] . "', ";
				$Query .= "'" . $_POST['name'] . "', ";
				$Query .= "'" . $_POST['ipaddr'] . "', ";
				$Query .= "'" . $_POST['groupId'] . "', ";
				$Query .= "'" . $_POST['groupName'] . "'); ";
			}
		}
		else
		{
			if($_POST['ipaddr'] == "")
			{
				$Query  = 'DELETE FROM eventinfo WHERE EVTID=' . $_POST['evtId'] . ' AND NAME="' . $_POST['name'] . '" ;';
			}
			else
			{
				$Query  = 'DELETE FROM eventinfo WHERE EVTID=' . $_POST['evtId'] . ' AND IPADDR="' . $_POST['ipaddr'] . '" ;';
			}
		}
		
		if($useEcho == 1) echo 	$Query;
		
		$result = mysqli_query($con,$Query);
		
        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />';
          $mysqlerr = 3;
        }
        else
        {
			if($_POST['admin'] == 0) 
			{
				PrintEvtMembers($_POST['evtId']);
			}
			else
			{
				PrintEvtAdMembers($_POST['evtId']);
			}
		}
	  }
	}
  }
  else
  {
	echo 'Error in pgm';
  }
  
	if($useEcho == 1) echo "mysqlerr = ". $mysqlerr .'<br />';
		
	function PrintEvtMembers($evtId)
	{
		global $useEcho;
		global $ipParsed;
		global $fullName;
		global $evtMemberCount;
		global $con;
		
		$query = 'SELECT eventinfo.NAME, eventinfo.IPADDR, eventinfo.GROUPNAME, userinfo.EMAIL FROM eventinfo LEFT JOIN userinfo ON eventinfo.IPADDR = userinfo.IPADDR WHERE EVTID=' . $evtId . ' ORDER BY eventinfo.GROUPNAME ASC ';

        $result = mysqli_query($con,$query);

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
		  $userName = $_POST['name'];
		  $userIP   = $_POST['ipaddr'];
		  
		  if($evtMemberCount[$evtId] == 1)
		  {
			  echo '<tr style="width:100%;background-color:#666666;"><td style="width:10%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Sl.No. </td>';
			  echo '<td style="width:30%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Name </td>';
			  echo '<td style="width:60%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Email ID </td></tr>';
				
			  while($row = mysqli_fetch_array($result))
			  {
				if($_POST['ipaddr'] == $row['IPADDR'])
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
			  
			  while($row = mysqli_fetch_array($result))
			  {
				if($_POST['ipaddr'] == $row['IPADDR'])
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
	}
	
	function PrintEvtAdMembers($evtId)
	{
		global $useEcho;
		global $evtMemberCount;
		global $con;
		
		$query = 'SELECT eventinfo.NAME, eventinfo.IPADDR, eventinfo.GROUPNAME, userinfo.EMAIL FROM eventinfo LEFT JOIN userinfo ON eventinfo.IPADDR = userinfo.IPADDR WHERE EVTID=' . $evtId . ' ORDER BY eventinfo.GROUPNAME ASC ';

        $result = mysqli_query($con,$query);

        if(mysql_errno() != 0)
        {
          if($useEcho == 1) echo "result for query = " . $result . '__error = ' . mysql_error() . '<br />' . "\r\n";
          $mysqlerr = 3;
        }
        else
        {
		  echo '<br /><div id="evt' . $evtId . 'table">' . "\r\n";
		  echo '<table style="width:87%;text-align:center;margin-left:6%;">' . "\r\n";
		  
		  $i = 1;
		  
		  if($evtMemberCount[$evtId] == 1)
		  {
			  echo '<tr style="width:100%;background-color:#666666;"><td style="width:6%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Sl.No. </td>' . "\r\n";
			  echo '<td style="width:30%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Name </td>' . "\r\n";
			  echo '<td style="width:50%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Email ID </td>' . "\r\n";
			  echo '<td style="width:15%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Remove </td></tr>' . "\r\n";
				
			  while($row = mysqli_fetch_array($result))
			  {
				echo '<tr style="width:100%;"><td style="width:6%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $i . '</td>' . "\r\n";
				echo '<td style="width:30%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>' . "\r\n";
				echo '<td style="width:50%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td>' . "\r\n";
				echo '<td style="width:15%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> <button id="evt'. $i . 'adbtn" class="evtRegAdBtn" type="submit" value="Reg" onclick="postRegInfo(1, ' . $evtId . ', 0, ' . "'" . $row['NAME'] . "'" . ", '' , 0, '', '#evt". $evtId . "table'" . ")" . '"> Remove </button></td></tr>' . "\r\n";
			
				$i++;
			  }
		  }
		  else
		  {
			  echo '<tr style="width:100%;background-color:#666666;"><td style="width:6%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Sl.No. </td>' . "\r\n";
			  echo '<td style="width:18%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Group Name </td>' . "\r\n";
			  echo '<td style="width:18%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Name </td>' . "\r\n";
			  echo '<td style="width:42%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Email ID </td>' . "\r\n";
			  echo '<td style="width:15%;border:1px solid black;color:#cccccc;vertical-align:middle;"> Remove </td></tr>' . "\r\n";
				
			  $prevGroupName = "";
			  $teamSize = $evtMemberCount[$evtId];
			  $j = 0;
			  
			  while($row = mysqli_fetch_array($result))
			  {
				if($prevGroupName != $row['GROUPNAME'])
				{
					for($j=$teamSize;$j<$evtMemberCount[$evtId];$j++)
					{
						echo '<tr style="width:100%;">' . "\r\n";
						echo '<td style="width:18%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>' . "\r\n";
						echo '<td style="width:42%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>' . "\r\n";
						echo '<td style="width:15%;border:1px solid black;font-family:philosopher;vertical-align:middle;">  &nbsp;  </td></tr>' . "\r\n";			
					}
					$teamSize = 1;
					
					echo '<tr style="width:100%;"><td style="width:6%;border:1px solid black;font-family:philosopher;vertical-align:middle;" rowspan="' . $evtMemberCount[$evtId] . '">' . $i . '</td>' . "\r\n";
					echo '<td style="width:18%;border:1px solid black;font-family:philosopher;vertical-align:middle;" rowspan="' . $evtMemberCount[$evtId] . '">' . $row['GROUPNAME'] . '</td>' . "\r\n";
					echo '<td style="width:18%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>' . "\r\n";
					echo '<td style="width:42%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td>' . "\r\n";
					echo '<td style="width:15%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> <button id="evt'. $i . 'adbtn" class="evtRegAdBtn" type="submit" value="Reg" onclick="postRegInfo(1, ' . $evtId . ', 0, ' . "'" . $row['NAME'] . "'" . ", '' , 0, '', '#evt". $evtId . "table'" . ")" . '"> Remove </button></td></tr>' . "\r\n";
					$i++;
				}
				else
				{
					echo '<tr style="width:100%;">' . "\r\n";
					echo '<td style="width:18%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['NAME'] . '</td>' . "\r\n";
					echo '<td style="width:42%;border:1px solid black;font-family:philosopher;vertical-align:middle;">' . $row['EMAIL'] . '</td>' . "\r\n";
					echo '<td style="width:15%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> <button id="evt'. $i . 'adbtn" class="evtRegAdBtn" type="submit" value="Reg" onclick="postRegInfo(1, ' . $evtId . ', 0, ' . "'" . $row['NAME'] . "'" . ", '' , 0, '', '#evt". $evtId . "table'" . ")" . '"> Remove </button></td></tr>' . "\r\n";					
					$teamSize++;
				}
				
				$prevGroupName = $row['GROUPNAME'];
				
			  }
			  for($j=$teamSize;$j<$evtMemberCount[$evtId];$j++)
   			  {
				echo '<tr style="width:100%;">' . "\r\n";
				echo '<td style="width:18%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>' . "\r\n";
				echo '<td style="width:42%;border:1px solid black;font-family:philosopher;vertical-align:middle;"> &nbsp; </td>' . "\r\n";
				echo '<td style="width:15%;border:1px solid black;font-family:philosopher;vertical-align:middle;">  &nbsp;  </td></tr>' . "\r\n";			
			  }
		  }
		  
		  echo '</table><br />' . "\r\n";
		  
		  echo '<form id="evt' . $evtId . 'Form" action="reg.php" method="post" style="margin-left:6%;">' . "\r\n";
          echo 'Name: <input id="evt' . $evtId . 'NameIp" name="name"  class="ipAdText" type="text" val="" />&nbsp;&nbsp;&nbsp;'. "\r\n";
		  echo 'Email: <input id="evt'  .$evtId . 'MailIp" name="email" class="ipAdText" type="text" val="" />&nbsp;&nbsp;&nbsp;'. "\r\n";
		  if($evtMemberCount[$evtId] != 1) { $gpNameType = 'type="text"'; } else { $gpNameType = 'type="hidden"'; }
		  echo 'Group Name: <input id="evt'  .$evtId . 'GroupName" name="groupname" class="ipAdText"' . $gpNameType . 'val="" />&nbsp;&nbsp;&nbsp;'. "\r\n";
		  echo '<input id="evt'  .$evtId . 'IdIp" name="evtId" class="ipAdText" type="hidden" value="'  .$evtId . '" />&nbsp;&nbsp;&nbsp;'. "\r\n";
		  echo '<button id="uib" class="ipFormAdBtn" type="submit" val="submit"> Add Name </button>&nbsp;&nbsp;&nbsp;'. "\r\n";		  
		  echo '</form>' . "\r\n";
		  echo '<br /><br /><div class="lineSepLong"></div>';
		  echo '</div>' . "\r\n";
		}
	}
?>  	
