<?PHP
#                             #
#    d e t a i l s . p h p    #
#                             #

#connect to the database
include('inc/dbc.php');
#get product information
if(isset($_GET['id'])){
	$prodID = $_GET['id'];
	#query for the deets
	$pQ = "SELECT p.*, c.collID, c.name AS collname FROM products p LEFT JOIN collections c ON c.collID = p.collection WHERE prodID = $prodID";
	$pR = $db->query($pQ);
	$pA = $pR->fetch_array();
	#create the variable FOR the deets
	$coll    = str_replace("-", " ", $pA['collname'])." Collection";
	$collID  = $pA['collID'];
	$prodID  = $pA['prodID'];
	$name    = $pA['species']." ".$pA['color'];
	$type    = $pA['type'];
	$species = $pA['species'];
	$color   = $pA['color'];
	$tone    = $pA['tone'];
	if(strpos($pA['width'], '</div>') !== false){
		$tempWidth = str_replace("<d1>", "<div id=\"meas1\" class='white'>", $pA['width']);
		$tempWidth = str_replace("<d2>", "<div id=\"meas2\" class='green s12 bold'>", $tempWidth);
		$tempWidth = str_replace("<d3>", "<div id=\"meas3\" class='white'>", $tempWidth);
		$width     = "multiple widths click to view<div id='widthFly'><div id='widthTri'></div>&nbsp;$tempWidth</div>";
	} else {
		$width = str_replace("\""," inch", $pA['width']);
	}
	$length  = str_replace("\""," inch",$pA['length']);
	$breaks  = substr_count($width, '<br />');
	$thick   = str_replace("\""," inch",$pA['thickness']);
	$sqft    = $pA['sqft']; if(strpos($pA['sqft'],"width") == false){ $sqft .= " sqft"; }
	$const   = $pA['construction'];
	$finish  = $pA['finish'];
	$sheen   = $pA['sheen'];
	$install = $pA['installation'];
	$hard    = $pA['hardness'];
	if($finish == "FinishLoc"){ $warranty = "FinishLoc Lifetime Residential"; $warrlink = "warranty-lifetime.pdf"; }
	elseif($finish == "Aluminum Oxide"){ $warranty = "25 Year Residential"; $warrlink = "warranty-25year.pdf"; }
	#image(s)
	$img  = "img/prod/".$pA['itemnum'].".jpg";
	if(!is_file($img)){ $img = "img/no-img.jpg"; }
	$room = "img/rooms/".$pA['itemnum'].".jpg";
	if(!is_file($room)){ $room = "img/rooms/no-room-".$tone.".jpg"; }
	#itemnum
	if(strpos($width, '</div>') !== false){
		$itemnum = "";
	} else {
		$itemnum = "<span class=\"s14 bold green\">".$pA['itemnum']."</span>";
	}
} else {
	header('Location: index.php');
	exit();
}
#set the page title
$title = "Harris Wood - $name";
#include the header
include('header.php');
#convert fractions if the browser is NOT worthless internet explorer
if(!isset($IE)){
	$width  = str_replace("-1/4", " &frac14;", $width);
	$width  = str_replace("-3/8", " &frac38;", $width);
	$width  = str_replace("-1/2", " &frac12;", $width);
	$width  = str_replace("-3/4", " &frac34;", $width);
	$length = str_replace("-1/4", " &frac14;", $length);
	$length = str_replace("-3/8", " &frac38;", $length);
	$length = str_replace("-1/2", " &frac12;", $length);
	$length = str_replace("-3/4", " &frac34;", $length);
	$thick  = str_replace("1/4", " &frac14;", $thick);
	$thick  = str_replace("3/8", " &frac38;", $thick);
	$thick  = str_replace("1/2", " &frac12;", $thick);
	$thick  = str_replace("3/4", " &frac34;", $thick);
} ?>

<div id="sectionHeaderShell"></div>
<div id="sectionHeader">
	<div id="detailHeader" class="bold white <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>">
		<?PHP echo "<span class='green s12 italic'>".$coll."</span><br /><h1 class='s24'>".$name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$itemnum."</h1>"; ?>
	</div>
	<img src="img/header_product-details.png" alt="Product Detais" style="position: absolute; top: 0px; right: 0px;" />
</div>
<div id="sectionSubHeader" class="white bold">
	<div id="detailSubNavShell">
		<div id="detailSubNavOpt" onclick="location.href='files/collections/<?PHP echo $collID; ?>.pdf'">Product Sheet</div>
		<div id="detailSubNavOpt" onclick="alertBar(1,'emailShell');">Email</div>
		<div id="detailSubNavOpt" onclick="location.href='moldings.php';">Moldings</div>
		<div id="detailSubNavOpt" onclick="location.href='files/<?PHP echo $warrlink; ?>';">Warranty</div>
	</div>
</div>

<div id="detailShell">
	<div id="detailSwatch"><img src="<?PHP echo $img; ?>" alt="<?PHP echo $pA['itemnum'].' '.$name; ?>" /></div>
	<div id="detailRoom"><img src="<?PHP echo $room; ?>" alt="Room Scene for <?PHP echo $pA['itemnum'].' '.$name; ?>" /></div>
</div>
<div id="detailFootShell">
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">PRODUCT</div><?PHP echo $type; ?></div>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">FINISH</div><?PHP echo $finish; ?></div>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">SHEEN</div><?PHP echo $sheen; ?></div>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">THICKNESS</div><?PHP echo $thick; ?></div>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">LENGTH</div><?PHP echo $length; ?></div>
	<?PHP if(strpos($width, "</div>")){ ?>
	<div id="testWidth" class="detailColl widthX s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onmouseover="document.getElementById('widthFly').style.display='inline';" onmouseout="document.getElementById('widthFly').style.display='none';"><div class="detailCollHeader s10 bold green">WIDTH</div><?PHP echo $width; ?></div>
	<?PHP } else { ?>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">WIDTH</div><?PHP echo $width; ?></div>
	<?PHP } ?>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">COVERAGE</div><?PHP echo $sqft; ?></div>
	<div id="" class="detailColl s14 white bold <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>"><div class="detailCollHeader s10 bold green">INSTALLATION</div><?PHP echo $install; ?></div>
</div>

<!-- alert window -->
<div id="alertBarShell">

	<div id="emailShell">
		<div id="emailFriend" onclick="emailFriend(1);"><span class="green bold s16">Email a Friend</span><br />Click here to email a link for this product<br />to a friend of yours</div>
		<div id="emailDivide"><img src="img/icon_leaf.png" alt="Harris Wood" style="margin-top: 10px;" /></div>
		<div id="emailCstSup" onclick="alertBar(0,'emailShell','contact.php?id=<?PHP echo $prodID; ?>');"><span class="green bold s16">Email Customer Service</span><br />Click here to email our Customer Service department about this product</div>
		<div id="emailClose" class="alertClose emailCancel white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="alertBar(0,'emailShell',0);">Cancel</div>
	</div>

	<div id="friendShell" class="greenD bold s12">
		<form id="friendForm" name="friendForm" method="post" action="details.php">
		<div id="friendColl" class="friend1">
			<div>
				<span id="friendEM">friend's email</span><br />
				<input type="text" name="frEmail" id="frEmail" style="width: 270px; height: 24px; border: 1px solid #CCC;" class="bold brown s14" onfocus="emHi(1,'friendEM');" onblur="emHi(0,'friendEM');" />
			</div>
			<div style="margin-top: 10px;">
				<span id="yourEM">your email <span class="s10">(optional)</span></span><br />
				<input type="text" name="yrEmail" id="yrEmail" style="width: 270px; height: 24px; border: 1px solid #CCC;" class="bold brown s14" onfocus="emHi(1,'yourEM');" onblur="emHi(0,'yourEM');" />
			</div>
		</div>
		<div id="friendColl" class="friend2" style="text-align: right;">
			<span id="bmsg">brief message</span><br />
			<textarea name="msg" id="msg" style="width: 288px; height: 76px; border: 1px solid #CCC;" class="bold brown s14" onfocus="emHi(1,'bmsg');" onblur="emHi(0,'bmsg');"></textarea>
		</div>
		<input type="hidden" id="theLink" name="theLink" value="http://<?PHP echo $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" />
		<input type="hidden" id="prodID" name="prodID" value="<?PHP echo $prodID; ?>" />
		<div id="friendSend" class="white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>">Send</div>
		<div id="friendCancel" class="white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="emailFriend(0);">Cancel</div>
		</form>
	</div>

	<div id="friendSending"><img src="img/sending-animation.gif" style="margin-top: 52px;" /></div>

	<div id="inMsgShell">
		<div id="inMsg" class="s14 bold brown"></div>
		<div id="msgClose" class="alertClose white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="msgCloser(1);" style="display: none;">Close</div>
		<div id="alertClose" class="alertClose white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="msgCloser(2);" style="display: none;">Close</div>
	</div>

</div>
<?PHP include('footer.php'); ?>
