<?PHP
# --                                                                  -- #
# --    H A R R I S  W O O D  F U N C T I O N  P R O C E S S I N G    -- #
# --                                                                  -- #

#                          #
#  WTB GEO CODER FUNCTION  #
#                          #
if(isset($_GET['wtb']) && $_GET['wtb'] == 'check'){
	include "dbc.php";
	$temp = $_GET['latlon'];
	$temp = str_replace("(", "", $temp);
	$temp = str_replace(")", "", $temp);
	$temp = explode(", ", $temp, 2);
	$latty = $temp[0];
	$longy = $temp[1];
	$rad = str_replace(" miles", "", $_GET['radius']);
	$query = "SELECT dist.cust_name, dist.addy,	dist.city, dist.state, dist.zip, dist.phone, dist.lat, dist.lon, dist.website, dist.rank,
				( 3959 * acos( cos( radians( $latty ) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians( $longy ) ) + sin( radians( $latty ) ) * sin( radians( lat ) ) ) ) AS distance
			FROM dist
			INNER JOIN dist_cross ON dist.pkID = dist_cross.distID
			WHERE dist_cross.siteID = 5
			HAVING distance <= $rad
			ORDER BY distance ASC
				";
	$result = $db_reg->query($query);
	$total = $db_reg->affected_rows;
	if($total == 0 || $total == -1 ){
		if($_GET['radius'] == 200){
			echo 2;	
		} else {
			echo 0;		
		}
	} else {
		echo 1;
	}
}

#                                           #
#  PART NUMBER RETRIEVAL FOR WARRANTY FORM  #
#                                           #
if(isset($_GET['gpn'])){
	include "dbc.php";
	$value  = $_GET['gpn'];
	$thediv = $_GET['thediv'];
	//                                                                              
	//  COLLECTION PICKED - DISPLAY THE SPECIES/COLORS FOR THE SELECTED COLLECTION  
	//                                                                              
	if($thediv == "prod-spec"){
		// set up the <select> option
		echo "<span id='species2' class='brown reqFi2'>Species*</span><br />
		<select name='species' id='species' class='war-dropDown s18' onchange=\"getProdnum('prod-width',this.value);\" onfocus=\" deHI(this.id,2);\">
		<option value='0' select='selected'>Please Select ...</option>";
		// query for the species/color and prodID
		$speciesQ = "SELECT * FROM products WHERE collection = $value AND site = 1";
		$speciesR = $db->query($speciesQ);
		while($speciesA = $speciesR->fetch_array(MYSQLI_ASSOC)){
			$prodID   = $speciesA['prodID'];
			$prodNAME = $speciesA['species']." ".$speciesA['color'];
			echo "<option value='$prodID'>$prodNAME</option>";
		}
		// close the <select> option
		echo "</select>";
	}
	//                                                                                      
	//  SPECIES/COLOR PICKED - DISPLAY THE AVAILABLE WIDTHS FOR THE SELECTED SPECIES/COLOR  
	//                                                                                      
	if($thediv == "prod-width"){
		// set up the <select> option
		echo "<span id='width2' class='brown reqFi2'>Width*<br />
		<select name='width' id='width' class='war-dropDown s18' onfocus=' deHI(this.id,2);'>";
		// query for the species/color and prodID
		$wQ = "SELECT * FROM products WHERE prodID = $value";
		$wR = $db->query($wQ);
		while($wA = $wR->fetch_array(MYSQLI_ASSOC)){
			$width = $wA['width'];
			$itemnum = $wA['itemnum'];
			if(strpos($width, "br /")){
				// more than one width
				echo "<option value='0' selected='selected'>Please Select ...</option>";
				$count  = 0;
				$parts1 = explode("<br />", $width);
				$amt    = count($parts1);
				while($count != $amt){
					$parts2  = explode("</div>", $parts1[$count]);
					$width   = str_replace("<d1>", "", $parts2[0]); $width = str_replace("\"", " inch", $width);
					$itemnum = str_replace("<d2>", "", $parts2[1]);
					echo "<option value=\"".$itemnum."\">$width</option>";
					$count++;
				}
			} else {
				// only one width
				$width = str_replace("\"", " inch", $width);
				echo "<option value=\"".$itemnum."\" selected='selected'>$width</option>";
			}
		}
		// close the <select> option
		echo "</select>";
	}
}
#                        #
#  CAPTCHA VERIFICATION  #
#                        #
if(isset($_GET['capver'])){
	$theCode = $_POST['code'];
	// include the captcha checker
	include "../inc/captcha/securimage.php";
	$securimage = new Securimage();
	if($securimage->check($theCode) == false){
		echo 0;
	} else {
		echo 1;
	}
}
#                           #
#  FORM SUBMIT AND PROCESS  #
#                           #
if(isset($_GET['warform'])){
	include "dbc.php";
	$prodNUM   = $_POST['width'];
	$prodSQFT  = $db_reg->real_escape_string($_POST['prodsqft']);
	$prodFROM  = $db_reg->real_escape_string($_POST['prodfrom']);
	$prodCITY  = $db_reg->real_escape_string($_POST['prodcity']);
	$prodSTATE = $_POST['prodstate'];
	$prodZIP   = $db_reg->real_escape_string($_POST['prodzip']);
	$prodMONTH = $_POST['prodmonth'];
	$prodDAY   = $_POST['prodday'];
	$prodYEAR  = $_POST['prodyear'];
	if($prodMONTH != 0 && $prodDAY != 0){ $prodDATE = strtotime($prodDAY.'-'.$prodMONTH.'-'.$prodYEAR);	} else { $prodDATE = 0; }
	$prodPPC   = $db_reg->real_escape_string($_POST['prodppc']);
	$prodAREA  = $db_reg->real_escape_string($_POST['prodarea']);
	$prodMDC   = $db_reg->real_escape_string($_POST['prodmdc']);
	$purNAME   = $db_reg->real_escape_string($_POST['purname']);
	$purADDY   = $db_reg->real_escape_string($_POST['puraddy']);
	$purCITY   = $db_reg->real_escape_string($_POST['purcity']);
	$purSTATE  = $_POST['purstate'];
	$purZIP    = $db_reg->real_escape_string($_POST['purzip']);
	$purPHONE  = $db_reg->real_escape_string($_POST['purphone']);
	$purEMAIL  = $_POST['puremail'];
	$purAGE    = $_POST['purage'];
	$purINST   = $_POST['purinst'];
	$purBETTER = $db_reg->real_escape_string($_POST['purdobetter']);
	// checked the "help out" option
	if($_POST['moreQs'] == "on"){ $helpOUT = 1; } else { $helpOUT = 0; }
	// what was important in making this purchase
	foreach($_POST['purimp'] as $value){ $purIMP .= "$value "; }
	if($_POST['purimp-other'] == "other"){ $purIMPother = $db_reg->real_escape_string($_POST['purimp-otherEXP']); } else { $purIMPother = ""; }
	// how did you hear about
	if($_POST['purhear'] == "other"){ $purHEAR = $db_reg->real_escape_string($_POST['purhear-otherEXP']); } else { $purHEAR = $_POST['purhear']; }
	// where did you shop first
	if($_POST['purshop'] == "other"){ $purSHOP = $db_reg->real_escape_string($_POST['purshop-otherEXP']); } else { $purSHOP = $_POST['purshop']; }
	// would you recommend
	if($_POST['purrec'] == "no"){ $purREC = $db_reg->real_escape_string($_POST['purrec-noEXP']); } else { $purREC = $_POST['purrec']; }

	//echo "$prodNUM - $prodSQFT - $prodFROM\n$prodCITY $prodSTATE $prodZIP\n$prodDATE\n$prodPPC - $prodAREA - $prodMDC\n\n\n";
	//echo "$purNAME - $purADDY\n$purCITY $purSTATE $purZIP\n$purPHONE - $purEMAIL\n$purAGE\n\n\n";
	//echo "$purIMP ($purIMPother)\n$purHEAR\n$purINST\n$purSHOP\n$purREC\n$purBETTER";

	// set up the query to insert the registration info into the database
	$query = "INSERT INTO prod_reg_harris (prodNUM, prodSQFT, prodFROM, prodCITY, prodSTATE, prodZIP, prodDATE, prodPPC, prodAREA, prodMDC, purNAME, purADDY, purCITY, purSTATE, purZIP, purPHONE, purEMAIL, purAGE, purIMP, purIMPother, purHEAR, purINST, purSHOP, purREC, purBETTER, helpOUT) VALUES ('$prodNUM', '$prodSQFT', '$prodFROM', '$prodCITY', '$prodSTATE', '$prodZIP', '$prodDATE', '$prodPPC', '$prodAREA', '$prodMDC', '$purNAME', '$purADDY', '$purCITY', '$purSTATE', '$purZIP', '$purPHONE', '$purEMAIL', '$purAGE', '$purIMP', '$purIMPother', '$purHEAR', '$purINST', '$purSHOP', '$purREC', '$purBETTER', '$helpOUT')";
	$result = $db_reg->query($query);
	$total_r = $db_reg->affected_rows;
	if($total_r > 0){ echo '0'; } else { echo '1'; }
}

#                            #
#  EMAIL A FRIEND PROCESSOR  #
#                            #
if(isset($_GET['emailFriend'])){
	include "dbc.php";
	$frEmail = $_POST['frEmail'];
	if($_POST['yrEmail'] != ""){ $yrEmail = $_POST['yrEmail']; } else { $yrEmail = "noreply@harriswoodfloors.com"; }
	$theLink = $_POST['theLink'];
	$prodID  = $_POST['prodID'];
	$message = $_POST['msg']."\r\n\r\n".$theLink;
	$headers = "From: $yrEmail" . "\r\n" . "Reply-To: $yrEmail" . "\r\n";
	if(mail($frEmail, 'Check out this great wood floor at HarrisWoodFloors.com!', $message, $headers)){
		// message sent
		$db->query("UPDATE products SET email = email + 1 WHERE prodID = $prodID LIMIT 1");
		echo 1;
	} else {
		// message not sent
		echo 0;
	}
}

#                          #
#  CONTACT FORM PROCESSOR  #
#                          #
if(isset($_GET['contactus'])){
	$name  = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$prod  = $_POST['product'];
	$qANDc = $_POST['qncs'];
	$body   = "$name - $email";
	if($phone != ""){ $body .= "\n$phone"; }
	if($prod  != ""){ $body .= "\n$prod"; }
	$body  .= "\n\nQuestions/Comments\n$qANDc";
	$from   = "From: $name <$email>";
	$sendto = "bward@qep.com"; #rtester@qep.com   bward@qep.com
	/*if(isset($_POST['zipCode'])){
		echo "3";
	} else */if(mail($sendto, 'Harris Wood Website Contact Form', $body, $from, '-f $sendto')){
		echo "1";
	} else {
		echo "2";
	}
}
?>

<?PHP
#                          #
#  PRESS RELEASE FUNCTION  #
#                          #
function Press_release($siteName, $type, $time) {
//-----------GET NEWS TYPE
	//---F = FINANCIAL N = NEWS B = BOTH
switch ($type) {
    case 'F':
        $NewsType ='AND financial = 1';
        break;
    case 'N':
        $NewsType ='AND financial = 0';
        break;
    case 'B':
        $NewsType ='';
        break;
}
//---GET TIME AND MULT MY 2628000 THAT IS EQUIVALENT TO A MONTH
$time = $time * '2628000';
$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
$range = $today - $time;
include_once 'dbc.php';
$queryX = "SELECT newsTitle, newsSummary, newsFile, date  FROM news_news AS n 
			LEFT JOIN (news_links AS l, news_sites AS s) 
			ON (n.newsID = l.newsID AND l.websiteID = s.websiteID)
			WHERE (s.websiteName = '".$siteName."' AND n.status =1 AND n.date > $range $NewsType)
			ORDER BY n.date DESC";
$newsX = $db_corp->query($queryX);
// CHECKS TO SEE IF QUERY IS EMPTY 
$news_count = $newsX->num_rows;
 // IF IS EMPTY DISPLAYS NO RESULTS
	if($news_count <= '0'){
		echo '<h1 class="news_title">No Results</h1><br>';
	} else if($news_count <= '20'){
	$query = "SELECT newsTitle, newsSummary, newsFile, date  FROM news_news AS n 
			LEFT JOIN (news_links AS l, news_sites AS s) 
			ON (n.newsID = l.newsID AND l.websiteID = s.websiteID)
			WHERE (s.websiteName = '".$siteName."' AND n.status =1 AND n.date > 1000 $NewsType)
			ORDER BY n.date DESC LIMIT 20";	
	}else{
	$query = "SELECT newsTitle, newsSummary, newsFile, date  FROM news_news AS n 
			LEFT JOIN (news_links AS l, news_sites AS s) 
			ON (n.newsID = l.newsID AND l.websiteID = s.websiteID)
			WHERE (s.websiteName = '".$siteName."' AND n.status =1 AND n.date > $range $NewsType)
			ORDER BY n.date DESC";	
	}
$news = $db_corp->query($query);
?>
<?php
// CREATES THE NEWS SUMMARY AND LINKS TO A PDF FIEL
while($nArray = $news->fetch_array()){
		$id = $nArray['newsID'];
		$Title = $nArray['newsTitle'];
		$Summary = $nArray['newsSummary'];
		$link = $nArray['newsFile'];
		$date   = date('F j, Y', $nArray['date']);
?>
 <div id="news<?PHP echo $id;?>"class="news-shell" onMouseOver="this.style.background='#FAFAFA';" onMouseOut="this.style.background='';"  <?PHP if($link != ""){?>onclick="location.href='http://www.qepcorporate.com/files/news/<?PHP echo $link;?>'"<?PHP }?>>
    <div id="news-head"><div class="news-date"><?PHP echo $date; ?>&nbsp;&nbsp;</div><h2><div class="news-title"><?PHP echo $Title; ?></div></h2></div>
    <div id="news-desc"><?PHP echo $Summary; ?></div>
    <?PHP if($link != ""){ ?><div id="news-more"><span class="news-link" >Read Full Story</span></div><?PHP } ?>
    <div class="bottom-news-border"></div>
    </div>
<?php 
	}
}
?>
<?php
function LatestNews($siteName){
	include_once 'dbc.php';
	$latestQuery = "SELECT newsTitle, newsSummary, newsFile, date  FROM news_news AS n 
			LEFT JOIN (news_links AS l, news_sites AS s) 
			ON (n.newsID = l.newsID AND l.websiteID = s.websiteID)
			WHERE s.websiteName = '".$siteName."' ORDER BY n.date DESC LIMIT 1";
	$latestNews = $db_corp->query($latestQuery);
	$newsDisplay ='';
	while($newsArray = $latestNews->fetch_array()){
		$id = $newsArray['newsID'];
		$Title = $newsArray['newsTitle'];
		$Summary = $newsArray['newsSummary'];
		$link = $newsArray['newsFile'];
		$date   = date('F j, Y', $newsArray['date']);
		$newsDisplay .='<span class="bold s10">'.$date.'</span><br /><span class="bold s12 mouse_over" onclick="location.href=\'http://www.qepcorporate.com/files/news/'.$link.'\'">'.$Title.'</span><div class="latest-shell mouse_over" onclick="location.href=\'http://www.qepcorporate.com/files/news/'.$link.'\'">'.$Summary.'</div>';
	}	
	$newsDisplay .= '<div id="inNewsMore" class="s12 italic bold"><a href=http://www.qepcorporate.com/files/news/'.$link.' class="link-news">Read Full Story</a><br /><a href="news.php" class="link-news">See All News</a></div>';
	return $newsDisplay;
}
?>
