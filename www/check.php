<?
$DbLink = new DB;

$DbLink->query("DELETE FROM ".C_CODES_TBL." where (time + 86400) < ".time()." and info='pwreset'");

if($unconfirmed_deltime != " "){
$deletetime=60*60*$unconfirmed_deltime;

$DbLink->query("SELECT UUID FROM ".C_CODES_TBL." where (time + $deletetime) < ".time()." and info='confirm'");	
while(list($REGUUID) = $DbLink->next_record()){

$DbLink1 = new DB;
$DbLink1->query("DELETE FROM ".C_USERS_TBL." where UUID='$REGUUID'");
$DbLink1->query("DELETE FROM ".C_WIUSR_TBL." where UUID='$REGUUID'");	
$DbLink1->query("DELETE FROM ".C_CODES_TBL." where UUID='$REGUUID'");	

}
}
?>