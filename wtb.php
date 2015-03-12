<?PHP
#                     #
#    w t b . p h p    #
#                     #

#worthless IE detection
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false){
	$IE = "SUCKS"; }
#include the database
include('inc/dbc.php');
#form submitted, handle the results
if(isset($_POST['subby'])){
	// format the lat & lon values how we need them
	$temp = $_POST['subby'];
	$temp = str_replace("(", "", $temp);
	$temp = str_replace(")", "", $temp);
	$temp = explode(", ", $temp, 2);
	$latty = $temp[0];
	$longy = $temp[1];
	$rad = str_replace(" miles", "", $_POST['radius']);
	$radius = $_POST['radius'];
	$searched = 1;
}
#set the page title
$title = "Harris Wood - Where to Buy";
#include the header
include('header.php'); ?>

<div id="sectionHeaderShell"></div>
<div id="sectionHeader"><img src="img/header_where-to-buy.png" alt="Where to buy Harris Hardwood Flooring" /></div>
<div id="sectionSubHeader" class="white bold" style="text-align: right">
	<?PHP if(@$searched == 1){ echo "&nbsp;&nbsp;&nbsp;<a href=\"wtb.php\" class=\"link-state s12 bold white\" style=\"margin-right: 20px; margin-bottom: -30px;\">search again</a>"; }?>
</div>

<div id="wtb-shell">

	<?PHP if(isset($searched)){ ?>
	<div id="map"></div>
	<div id="mapside" class="sbPlain"></div>
	<div style="clear: both;"></div>
	<?PHP } else { ?>

	<div id="wtb-search" class="font s14">

		<div id="wtb-head" class="bold brown">
		Enter your address or zip/postal code into the form below, select your search radius from the drop down menu and then click the "SEARCH" button. Entering your full street address will return more accurate distance estimates. If you get no results, try increasing your search radius.
		</div>

		<div id="wtb-form" class="font">
			<div id="wtb-addressShell"><input type="text" id="address" name="address" class="font s14 grey italic" value="Address or Zip/Postal Code" onfocus="clearIT('address')" onblur="fillIT('address', 'Address or Zip/Postal Code')" /></div>
			<div id="wtb-radiusShell">
				<form name="addzip" id="addzip" action="wtb.php" method="post">
				<input type="text" id="radius" name="radius" class="font brown bold s14" value="10 miles" />
				<input type="hidden" name="subby" id="subby" value="" />
			</div>
			<div id="wtb-radiusArrowShell">
				<div id="wtb-radiusArrow"></div>
				<div id="wtb-radiusFly" class="bold brown s14">
					<div id="rad10" class="wtb-radiusFlyOpt" onclick="radIT('10');">10 miles</div>
					<div id="rad25" class="wtb-radiusFlyOpt" onclick="radIT('25');">25 miles</div>
					<div id="rad50" class="wtb-radiusFlyOpt" onclick="radIT('50');">50 miles</div>
					<div id="rad100" class="wtb-radiusFlyOpt" onclick="radIT('100');">100 miles</div>
					<div id="rad150" class="wtb-radiusFlyOpt" onclick="radIT('150');">150 miles</div>
					<div id="rad200" class="wtb-radiusFlyOpt" onclick="radIT('200');">200 miles</div>
				</div>
			</div>
			<div id="wtb-submitShell" class="white s14 bold" onclick="codeAddress()">Search</div>

		</div>

	</div>

<!--
			<div id="wtbForm">
                <input type="textbox" id="address" name="address" class="s14 grey wtbAZP italic" style=" <?PHP if($IE){ echo "line-height: 30px;"; } ?>" value="Address or Zip/Postal Code" onfocus="clearIT('address')" onblur="fillIT('address', 'Address or Zip/Postal Code')" />
                <form name="addzip" id="addzip" action="wtb.php" method="post">
                <div class="wtbRADdiv">
                <select name="rad" class="s14 wtbRAD">
                    <option value="10" selected="selected">10 miles</option>
                    <option value="25">25 miles</option>
                    <option value="50">50 miles</option>
                    <option value="100">100 miles</option>
                    <option value="150">150 miles</option>
                    <option value="200">200 miles</option>
                </select>
                </div>
                <input type="hidden" name="subby" id="subby" value="" />
                </form>
                <input type="button" name="submit" id="submit" value="S E A R C H" onclick="codeAddress()" style="width: 150px; height: 38px; text-align: center; float: left; margin: -1px 0px 0px 0px; padding: 0px;" class="s14 bold" />
                <div style="clear: both;"></div>
            </div>

        </div>
-->
	<?PHP } ?>
</div>
<div id="alertBarShell">
	<div id="alertDiv">
		<center><img src="img/icon_leaf.png" alt="Harris Wood" style="margin-top:30px;" /></center>
		<div style="width:750px; margin:10px auto; text-align:center;"><span id="msg" class="brown bold s16">Unfortunately we don't have any locations in your area. Try increasing your search radius.</span></div>
		<div class="alertClose1 white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="alertBar(0,'alertDiv',0);">OK</div>
	</div>
</div>
<div id="wtb-foot" class="s16 bold white"><span class="green s18">Please Note:</span> Inventory can <span class="green s18">NOT</span> be guaranteed. Please call before visiting.</div>

<?PHP include('footer.php'); ?>
<script> 
var mapOpts = { mapTypeId: google.maps.MapTypeId.ROADMAP, scaleControl: true, scrollwheel: true, mapTypeControl: false }
var map = new google.maps.Map(document.getElementById("map"), mapOpts); // set zoom and center later by fitBounds()
var infoWindow = new google.maps.InfoWindow();
var markerBounds = new google.maps.LatLngBounds();
var markerArray = [];
function makeMarker(options){
	var pushPin = new google.maps.Marker({map:map});
	pushPin.setOptions(options);
	google.maps.event.addListener(pushPin, "click", function(){
		infoWindow.setOptions(options);
		infoWindow.open(map, pushPin);
		if(this.sidebarButton)this.sidebarButton.button.focus();
	});
	var idleIcon = pushPin.getIcon();
	if(options.sidebarItem){ pushPin.sidebarButton = new SidebarItem(pushPin, options);	pushPin.sidebarButton.addIn("sidebar");	}
	markerBounds.extend(options.position); markerArray.push(pushPin); return pushPin;
}
google.maps.event.addListener(map, "click", function(){ infoWindow.close(); });
function SidebarItem(marker, opts){
	var tag = opts.sidebarItemType || "button";
	var row = document.createElement(tag);
	row.innerHTML = opts.sidebarItem;
	row.className = opts.sidebarItemClassName || "sidebar_item";  
	row.style.display = "block";
	row.style.width = opts.sidebarItemWidth || "100%";
	row.onclick = function(){ google.maps.event.trigger(marker, 'click'); }
	row.onmouseover = function(){ google.maps.event.trigger(marker, 'mouseover'); }
	row.onmouseout = function(){ google.maps.event.trigger(marker, 'mouseout'); }
	this.button = row;
}
SidebarItem.prototype.addIn = function(block){
	if(block && block.nodeType == 1)this.div = block;
	else
	this.div = document.getElementById(block) || document.getElementById("mapside") || document.getElementsByTagName("body")[0]; this.div.appendChild(this.button); }

<?PHP
#--    q u e r y  f o r  d i s t r i b u t o r s     --#
if(@$searched == 1){
	$count = 1;
	$query = "SELECT
				dist.cust_name,
				dist.addy,
				dist.city,
				dist.state,
				dist.zip,
				dist.phone,
				dist.lat,
				dist.lon,
				dist.website,
				dist.rank,
				( 3959 * acos( cos( radians( $latty ) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians( $longy ) ) + sin( radians( $latty ) ) * sin( radians( lat ) ) ) ) AS distance
			FROM dist
			INNER JOIN dist_cross ON dist.pkID = dist_cross.distID
			WHERE dist_cross.siteID = 5
			HAVING distance <= $rad
			ORDER BY distance ASC
				";
	$result = $db_reg->query($query);
	$total = $db_reg->affected_rows;
	$numrow = $result->num_rows;
	while($row = $result->fetch_assoc()){
		$cust  = addslashes(ucwords(strtolower($row['cust_name'])));
		$pref  = $row['rank'];
		$addy  = $row['addy'];
		$city  = $row['city'];
		$state = $row['state'];
		$zip   = $row['zip'];
		$phnum = $row['phone'];
		$part1 = substr($phnum, 0, 3);
		$part2 = substr($phnum, 3, 3);
		$part3 = substr($phnum, 6, 4);
		$phone = "(".$part1.")$part2-$part3";
		$web   = $row['website'];
		$lat2  = $row['lat'];
		$lon2  = $row['lon'];
		$dist  = number_format($row['distance'],2);
		#$dist2 = number_format(($dist*1.6),2);
		$marker_info = "";
		$sidebar_info = "<span class='brown bold'>$cust</span><br /><span class='green'>distance: <strong>$dist miles</strong></span>";
?> 
makeMarker({
	position: new google.maps.LatLng(<?PHP echo $lat2; ?>,<?PHP echo $lon2; ?>),
	title: "<?PHP echo $cust; ?>",
	sidebarItem: "<?PHP echo $sidebar_info; ?>",
	content: "<div class=\"font s14\" style=\" text-align: center; width: 280px; margin: 10px; line-height: 12px;\"><?PHP echo '<span class=\"green bold size16\" style=\"font-weight:bold\">'.$cust.'</span><br /><br />'.$addy.'<br />'.$city.', '.$state.' '.$zip.'<br /><div class=\"s12 bold\" style=\"font-weight:bold; padding-top: 6px;\">'.$phone.'</div>'; if($web != "-"){ echo '<div class=\"s10 bold\" style=\"padding-top: 4px;\"><a href=\"'.$web.'\" target=\"_blank\" class=\"link_nav\">'.$web.'</a></div>'; } ?></div>"
});
<?PHP }} ?>
// fit viewport to markers
map.fitBounds(markerBounds);
</script>
