<?
if($_SESSION[ADMINUID] == $ADMINCHECK){

if($_SESSION[ADMINUID] == "") {

echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
} else {

$GoPage= "page=manage";

$AnzeigeStart 		= 0;
$AnzeigeLimit		= 25;


if($_POST[firstname]) { $USR_1 = "username LIKE '%$_POST[firstname]%' and";}
if($_POST[lastname]) { $USR_2 = "lastname LIKE '%$_POST[lastname]%' and";}
if(($_POST[firstname]) or ($_POST[lastname])){
$USR ="WHERE";
$USR_3 ="username !=''";
}

// LINK SELECTOR

if($_POST[firstname]){ $Link1.="firstname=$_POST[firstname]&";}
if($_POST[lastname]) { $Link2.="lastname=$_POST[lastname]&";}

if($_GET[AStart]){$AStart=$_GET[AStart];};
if($_GET[ALimit]){$ALimit=$_GET[ALimit];};

if(!$AStart) $AStart = $AnzeigeStart;
if(!$ALimit) $ALimit = $AnzeigeLimit;

$Limit = "LIMIT $AStart, $ALimit";

//DELETE USER START
if(($_GET[action2] == 'delete') and ($_GET[quest] == 'yes')) {
	$DbLink3 = new DB;
	$DbLink3->query("Delete FROM ".C_USERS_TBL." WHERE PrincipalID='$_GET[user_id]'");
	$DbLink3 = new DB;
	$DbLink3->query("Delete FROM ".C_AUTH_TBL." where UUID='$_GET[user_id]'");
	$DbLink3 = new DB;
	$DbLink3->query("Delete FROM ".C_GRIDUSER_TBL." where UserID='$_GET[user_id]'");
	$DbLink3->query("Delete FROM ".C_WIUSR_TBL." WHERE UUID='$_GET[user_id]'");
	$DbLink3->query("Delete FROM ".C_CODES_TBL." WHERE UUID='$_GET[user_id]'");
}
//DELETE USER END

//BAN USER START
if(($_GET[action2] == 'ban') and ($_GET[quest] == 'yes')) {
	$DbLink3 = new DB;
	$DbLink3->query("SELECT agentIP FROM ".C_WIUSR_TBL." WHERE UUID='$_GET[user_id]'");
	list($agentIP) = $DbLink3->next_record();
	$DbLink->query("INSERT INTO ".C_USRBAN_TBL." (UUID,agentIP)	VALUES ('$_GET[user_id]','$agentIP') ");
	$DbLink3->query("UPDATE ".C_AUTH_TBL." SET passwordHash='' WHERE UUID='$_GET[user_id]'");
	$DbLink3->query("UPDATE ".C_WIUSR_TBL." SET active='5' WHERE UUID='$_GET[user_id]'");
}
//BAN USER END

//UNBAN USER START
if(($_GET[action2] == 'unban') and ($_GET[quest] == 'yes')) {
	$DbLink3 = new DB;
	$DbLink3->query("SELECT passwordHash,active FROM ".C_WIUSR_TBL." WHERE UUID='$_GET[user_id]'");
	list($passbkp,$active) = $DbLink3->next_record();
	$DbLink3 = new DB;
	$DbLink3->query("UPDATE ".C_AUTH_TBL." SET passwordHash='$passbkp' WHERE UUID='$_GET[user_id]'");
	$DbLink3->query("UPDATE ".C_WIUSR_TBL." SET active='1' WHERE UUID='$_GET[user_id]'");
	$DbLink3->query("DELETE FROM ".C_USRBAN_TBL." Where UUID='$_GET[user_id]'");
	
}
//UNBAN USER END

$DbLink = new DB;
$DbLink->query("SELECT COUNT(*) FROM ".C_USERS_TBL." ");
list($count) = $DbLink->next_record();

}
?>

<BR><CENTER>
<? 
// DELETE QUESTION
if($_GET[action] == 'delete'){

	echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
	echo "<FONT COLOR=#FFFFFF><B>Do you want to delete the User $_GET[delusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=delete&quest=yes&uname=$_GET[delusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
	echo "<br></center></TD></TR></TABLE><br>";
}
//DELETE ANSWER
 if(($_GET[action2] == 'delete') and ($_GET[quest] == 'yes')) {
	echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
	echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully deleted</B>";
	echo "</TD></TR></TABLE>";
} 

// BAN QUESTION
if($_GET[action] == 'ban'){

	echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
	echo "<FONT COLOR=#FFFFFF><B>Do you want to Ban $_GET[banusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=ban&quest=yes&uname=$_GET[banusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
	echo "<br></center></TD></TR></TABLE><br>";
}
//BAN ANSWER
 if(($_GET[action2] == 'ban') and ($_GET[quest] == 'yes')) {
	echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
	echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully banned</B>";
	echo "</TD></TR></TABLE>";
} 

// UNBAN QUESTION
if($_GET[action] == 'unban'){

	echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
	echo "<FONT COLOR=#FFFFFF><B>Do you want to remove $_GET[unbanusr] from Ban List?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=unban&quest=yes&uname=$_GET[unbanusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
	echo "<br></center></TD></TR></TABLE><br>";
}
//UNBAN ANSWER
 if(($_GET[action2] == 'unban') and ($_GET[quest] == 'yes')) {
	echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
	echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully removed from Ban List</B>";
	echo "</TD></TR></TABLE>";
} 


?>
<TABLE WIDTH=95% CELLPADDING=3 CELLSPACING=0 BGCOLOR=#999999>
	<TR><TD style="filter:progid:DXImageTransform.Microsoft.Gradient(startColorStr='#CC0000', endColorStr='#FFFFFF', gradientType='1')">

<?
	echo "<TABLE CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD>"
	    ."<FONT COLOR=#FFFFFF><B>$count Users found</B></FONT></TD><TD ALIGN=right>";

// ################################## Navigation ###################################### 	

?>

<TABLE CELLPADDING=1 CELLSPACING=0><TR>
<TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD WIDTH=100 ALIGN=center>
<FONT COLOR="#000000"><?=$LANG_ADMPAYMENT8?> <?= round($AStart / $ALimit ,0)+1; ?> <!--von <?= @round($count / $ALimit,0); ?>--></FONT></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD WIDTH="10"></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=10" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10"></a></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=25" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25"></a></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=50" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50"></a></TD><TD>
<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=100" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100"></a></TD><TD>
</TD></TR></TABLE>
</TD></TR></TABLE>
</TD></TR></TABLE><BR>

<TABLE WIDTH="95%" CELLPADDING="3" CELLSPACING="1" BGCOLOR="#547FDB">
<FORM ACTION="index.php?<?=$GoPage?>" METHOD="POST">	
	<TR>
	  <TD>
	<B>Usersearch</B><BR>
	</TD></TR><TR><TD BGCOLOR="#FFFFFF">


<TABLE CELLPADDING="0" CELLSPACING="0" WIDTH="100%" BGCOLOR="#FFFFFF">
	<TR>
	  <TD>
  
	<FONT COLOR="#000000">Firstname</TD>
	  <TD>
	<INPUT TYPE="TEXT" NAME="firstname" SIZE="15" value="<?=$_POST[firstname]?>" STYLE="HEIGHT:20">
	</TD>
	  <TD>
	<FONT COLOR="#000000">Lastname</TD>
	  <TD>
	<INPUT TYPE="TEXT" NAME="lastname" SIZE="15" value="<?=$_POST[lastname]?>" STYLE="HEIGHT:20">
	</TD>
	<TD>&nbsp;</TD>
	<TD>&nbsp;</TD>
	<TD>
	<INPUT TYPE="Submit" value="Search" STYLE="HEIGHT:20">
	</TD>
	</TR></TABLE>
	</TD></TR>
  </FORM>
</TABLE><br>

<?
// ##################################### Ende #########################################
$w=1;
?>

<TABLE CELLPADDING="5" CELLSPACING="0" border="0" WIDTH="95%" Height="70%" BGCOLOR="#FFFFFF">
	<TR>
	  <TD VALIGN="top">
	  <div style="position:relative;height:100%;">

<TABLE CELLPADDING=0 CELLSPACING=1 border=0 WIDTH=100% BGCOLOR=#305AB1>
	<TR>
		<TD BGCOLOR=#547FDB>
			<TABLE CELLPADDING=2 CELLSPACING=0 border=0 WIDTH=100%>
				<TR>
					<TD WIDTH=28></TD>
					<TD WIDTH=83><B>EDIT</B></TD>
					<TD WIDTH=241><B>Firstname</B></TD>
					<TD WIDTH=229><B>Lastname</B></TD>
					<TD width=170><B>Created</B></TD>
					<TD width=124><B>Active</B></TD>
					<TD WIDTH=41></TD>
				</TR>
			</TABLE>
		</TD>
	</TR>
</TABLE>
<IMG SRC=../images/icons/dot.gif WIDTH=1 HEIGHT=2><BR>
<?
$DbLink1 = new DB;
$DbLink1->query("SELECT PrincipalID,FirstName,LastName,Created FROM ".C_USERS_TBL." $USR $USR_1 $USR_2 $USR_3 ORDER by created ASC $Limit ");
while(list($user_id,$username,$lastname,$created) = $DbLink1->next_record()){


$DbLink2 = new DB; 

$DbLink2->query("SELECT a.active,(SELECT info FROM ".C_CODES_TBL." b WHERE b.uuid = a.uuid ) as confirm FROM ".C_WIUSR_TBL." a where UUID='$user_id'");
list($active,$confirm) = $DbLink2->next_record(); 

if($confirm == 'confirm'){
$active=3;
} 

$create = date("d.m.Y", $created);
?>
<TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0 BORDER=0>
	<TR>
	<TD width=32><img src="../images/icons/icon_user.gif"></TD>
	<TD WIDTH=91>
	<A href="index.php?page=edit&userid=<?=$user_id?>">
	<FONT COLOR=Blue><B>EDIT</B></FONT></A></TD>
	<TD WIDTH=243><FONT COLOR=Blue><B><?=$username?></B></FONT></TD>
	<TD WIDTH=236><FONT COLOR=#888888><B><?=$lastname?></B></FONT></TD>
	<TD WIDTH=173><FONT COLOR=#888888><B><?=$create?></B></FONT></TD>
	<TD width=100><B>
	<?
	if($active==1){
	echo"<FONT COLOR=#00FF00>Active</FONT>";
	}elseif($active==3){
	echo"<FONT COLOR=#FF0000>Not Confirmed</FONT>";
	}elseif($active==5){
	echo"<FONT COLOR=#FF0000>Banned</FONT>"; 
	}else{
	echo"<FONT COLOR=#FF0000>Inactive</FONT>";
	} ?>
	</B></TD>
	<TD width=32>
	<? if($active ==5){?>
	<a href="index.php?<?=$GoPage?>&action=unban&unbanusr=<?=$username?>%20<?=$lastname?>&user_id=<?=$user_id?>">
	<img src="../images/icons/unban.jpg" alt="Unban this User" border="0" /></a>
	<? } else{ ?>
	<a href="index.php?<?=$GoPage?>&action=ban&banusr=<?=$username?>%20<?=$lastname?>&user_id=<?=$user_id?>">
	<img src="../images/icons/ban.jpg" alt="Ban this User" border="0" /></a>
	<? } ?></TD>
	<TD WIDTH=39 ALIGN=right>
	<A HREF="index.php?<?=$GoPage?>&action=delete&delusr=<?=$username?>%20<?=$lastname?>&user_id=<?=$user_id?>">
	<img src="../images/icons/btn_del.gif" alt="Delete User" BORDER="0"></a></TD>
	</TR>
</TABLE>
	
<? } ?>
</div></TD></TR></TABLE><BR>

<? } ?>
