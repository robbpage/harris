<?PHP
#                               #
#    f l o o r i n g . p h p    #
#                               #

# set the page title
$title = "Harris Wood - Hardwood Flooring";
# define the page URL
$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
# page name 
$urlPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
# check for question mark, add if needed, this is to account for the question mark in the URL if they haven't yet sorted.
$pos = strpos($url,"?");
if($pos === FALSE){ 
	$url .= "?"; $init = 1; 
} else if (strpos($url,$urlPage.'?adv') !== false) {
    $init = 2;
	$url = str_replace('adv', '', $url);
}

# connect the the database
include('inc/dbc.php');
# define the collections
$collQ = "SELECT * FROM collections WHERE status = 1 AND site = 1 ORDER BY sort ASC";
$collR = $db->query($collQ);
$sect1 = "";
$sect2 = "";
$sect3 = "";
$photo = "";
while($collA = $collR->fetch_array()){
	$collID = $collA['collID'];
	$collNAME = str_replace("-"," ",$collA['name']);
	$collDIV  = $collA['image'];
	$collSORT = $collA['sort'];
	switch($collDIV){
		case 1: # 3/8" Engineered Collections
			$sect1 .= "<div id='floorCollRow' onclick=\"location.href='flooring.php?&collection=".$collA['name']."';\" onmouseover=\"collPic('".$collA['name']."');\">$collNAME</div>";
			$photo .= "<img src='img/collection_".strtolower($collA['name']).".jpg' style='display: none;' alt=\"$collNAME\">\n";
			break;
		case 2: # 1/2" Engineered Collections
			$sect2 .= "<div id='floorCollRow' onclick=\"location.href='flooring.php?&collection=".$collA['name']."';\" onmouseover=\"collPic('".$collA['name']."');\">$collNAME</div>";
			$photo .= "<img src='img/collection_".strtolower($collA['name']).".jpg' style='display: none;' alt=\"$collNAME\">\n";
			break;
		case 3: # 3/4" Solid Collections
			$sect3 .= "<div id='floorCollRow' onclick=\"location.href='flooring.php?&collection=".$collA['name']."';\" onmouseover=\"collPic('".$collA['name']."');\">$collNAME</div>";
			$photo .= "<img src='img/collection_".strtolower($collA['name']).".jpg' style='display: none;' alt=\"$collNAME\">\n";
			break;
	}
}
# include the header
include('header.php');
#  p r o d u c t   s u m m a r y  #
if(@$init == 1){ ?>
<div id="sectionHeaderShell"></div>

<div id="sectionHeader"><img src="img/header_product-summary1.png" style="position: absolute; top: 0px; right: 37px;" /><img src="img/header_product-summary2.png" style="position: absolute; top: 0px; right: 0px;" /></div>

<div id="sectionSubHeader" class="white bold">
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-specie').style.display='block';" onmouseout="document.getElementById('sum-sub-specie').style.display='none';" style="padding-left: 3px;">Species
	<div id="sum-sub-specie" class="sum-sub-flyout" style="left: 1px;">
		<?PHP # get all the species
		$specieR = $db->query("SELECT DISTINCT species FROM products WHERE species NOT LIKE '%Vintage%' AND site = 1 ORDER BY species ASC");
		while($specieA = $specieR->fetch_array()){
			$specieName = $specieA['species'];
			echo "<div id=\"sum-sub-fly-opt\" onclick=\"location.href='flooring.php?&species=".str_replace(" ", "-", $specieName)."'\">$specieName</div>";
		} ?>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-color').style.display='block';" onmouseout="document.getElementById('sum-sub-color').style.display='none';">Color
	<div id="sum-sub-color" class="sum-sub-flyout" style="left: 145px;">
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&color=light'">Light Colors</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&color=medium'">Medium Colors</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&color=dark'">Dark Colors</div>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-type').style.display='block';" onmouseout="document.getElementById('sum-sub-type').style.display='none';">Type
	<div id="sum-sub-type" class="sum-sub-flyout" style="left: 287px;">
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&type=Engineered'" style="padding-right: 65px;">Engineered</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&type=Solid'">Solid</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&type=SpringLOC'">SpringLoc Click System</div>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-treat').style.display='block';" onmouseout="document.getElementById('sum-sub-treat').style.display='none';">Treatment
	<div id="sum-sub-treat" class="sum-sub-flyout" style="left: 429px;">
		<?PHP # get all the treatments
		$treatR = $db->query("SELECT DISTINCT treatment FROM products WHERE site = 1 ORDER BY treatment ASC");
		while($treatA = $treatR->fetch_array()){
			$treatName = $treatA['treatment'];
			echo "<div id=\"sum-sub-fly-opt\" onclick=\"location.href='flooring.php?&treat=".str_replace(" ", "-", $treatName)."'\">$treatName</div>";
		} ?>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-width').style.display='block';" onmouseout="document.getElementById('sum-sub-width').style.display='none';">Width
	<div id="sum-sub-width" class="sum-sub-flyout" style="left: 571px;">
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=2-1/4'" style="padding-right: 60px;">2 1/4 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=3'" style="padding-right: 60px;">3 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=3-1/4'">3 1/4 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=4'">4 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=4-3/4'">4 3/4 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=5'">5 inches</div>
		<div id="sum-sub-fly-opt" onclick="location.href='flooring.php?&width=7'">7 inches</div>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" onmouseover="document.getElementById('sum-sub-thick').style.display='block';" onmouseout="document.getElementById('sum-sub-thick').style.display='none';">Thickness
	<div id="sum-sub-thick" class="sum-sub-flyout" style="left: 713px;">
		<?PHP # get all the thickness
		$thickR = $db->query("SELECT DISTINCT thickness FROM products WHERE site = 1 ORDER BY thickness ASC");
		while($thickA = $thickR->fetch_array()){
			$thickName = str_replace("\"", "", $thickA['thickness']);
			echo "<div id=\"sum-sub-fly-opt\" onclick=\"location.href='flooring.php?&thick=".str_replace(" ", "-", $thickName)."'\" style=\"padding-right: 60px;\">$thickName inches</div>";
		} ?>
	</div>
</div>
<div id="sum-sub-head-opt" class="white bold" style="border: 0px;" onclick="location.href='flooring.php?'">View All</div>
</div>

<div id="floorContainer">
	<div id="floorCollCon" class="bold greyDark">
		<div id="floorCollRowHead" class="white s16 italic text-shadow-black">3/8" Engineered Collections</div>
		<?PHP echo $sect1; ?>
		<div id="floorCollRowHead" class="white s16 italic text-shadow-black">1/2" Engineered Collections</div>
		<?PHP echo $sect2; ?>
		<div id="floorCollRowHead" class="white s16 italic text-shadow-black">3/4" Solid Collections</div>
		<?PHP echo $sect3; ?>
	</div>
	<div id="floorPicCon">
		<img src="img/collection_aspen.jpg" onclick="location.href='flooring.php?&collection=Aspen';" alt="twst" />
	</div>
	<?PHP echo $photo; ?>
</div>

<?PHP
#  p r o d u c t  a d v a n c e  s e a r c h  #
} else if($init == 2){ ?>
	<div id="sectionHeaderShell"></div>
<div id="sectionHeader"><img src="img/header_hard-wood-flooring.png" alt="Hard Wood Flooring" /></div>
<div id="sectionSubHeader" class="s18 white bold" style="text-align: left;"><h1 class="s18">&nbsp;&nbsp;&nbsp;Advanced <span class='green italic'>Search</span></h1></div>

<div id="content-container">
	<div id="content2">
		<div id="flooring-container">
		<div id="flooring-left" class="bold green s16">
			<?PHP # create the COLLECTION variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['collection'])){
				$collection = $_GET['collection'];
				# query to get the collection number
				$cq = "SELECT collID FROM collections WHERE name = '$collection' AND site = 1";
				$cr = $db->query($cq);
				$ca = $cr->fetch_array();
				$collection = $ca['collID'];
				$replace = "&collection=".$_GET['collection'];
				$url0    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url0 = $url; } ?>
			<div id="sort-opts">Collections<br />
			<form name="form0" id="form0">
			<select id="jumpMenu0" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url0; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Collections</option>
				<?PHP # get collections from database
				$colQ = "SELECT * FROM collections WHERE status = 1 AND site = 1 ORDER BY sort ASC";
				$colR = $db->query($colQ);
				while($colA = $colR->fetch_array()){
					$colName  = $colA['name']; ?>
				<option value="<?PHP echo $url0; ?>&collection=<?PHP echo $colName; ?>" <?PHP if($_GET['collection'] == $colName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $colName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the SPECIES variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['species'])){
				$species = $_GET['species'];
				$replace = "&species=".$_GET['species'];
				$url1    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url1 = $url; } ?>
			<div id="sort-opts">Species<br />
			<form name="form1" id="form1">
			<select id="jumpMenu1" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url1; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Species</option>
				<?PHP # get species from database
				$speQ = "SELECT DISTINCT species FROM products WHERE species NOT LIKE '%Vintage%' AND site = 1 ORDER BY species ASC";
				$speR = $db->query($speQ);
				while($speA = $speR->fetch_array()){
					$speName = str_replace("Vintage ", "", $speA['species']);
					$speName = str_replace(" ", "-", $speA['species']); ?>
				<option value="<?PHP echo $url1; ?>&species=<?PHP echo $speName;?>" <?PHP if($_GET['species'] == $speName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $speName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the COLOR variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['color'])){
				$color   = $_GET['color'];
				$replace = "&color=".$_GET['color'];
				$url2    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url2 = $url; }
			?>
			<div id="sort-opts">Color<br />
			<form name="form2" id="form2">
			<select id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url2; ?>"<?PHP if(!isset($_GET['color'])){ echo "selected"; }?>>All Colors</option>
				<option value="<?PHP echo $url2; ?>&color=light"<?PHP if($_GET['color'] == 'light'){ echo "selected"; }?>>Light</option>
				<option value="<?PHP echo $url2; ?>&color=medium"<?PHP if($_GET['color'] == 'medium'){ echo "selected"; }?>>Medium</option>
				<option value="<?PHP echo $url2; ?>&color=dark"<?PHP if($_GET['color'] == 'dark'){ echo "selected"; }?>>Dark</option>
			</select>
			</form>
			</div>
			<?PHP # create the TYPE variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['type'])){
				$type1   = $_GET['type'];
				switch($type1){
					case "Engineered": $type = "Engineered Tongue and Groove"; break;
					case "Solid": $type = "Solid"; break;
					case "SpringLOC": $type = "Engineered Click"; break; }
				$replace = "&type=".$_GET['type'];
				$url3    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url3 = $url; } ?>
			<form name="form3" id="form3">
			<div id="sort-opts">Type<br />
			<select id="jumpMenu3" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url3; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Types</option>
				<option value="<?PHP echo $url3; ?>&type=Engineered"<?PHP if($_GET['type'] == 'Engineered'){ echo "selected"; }?>>Engineered</option>
				<option value="<?PHP echo $url3; ?>&type=Solid"<?PHP if($_GET['type'] == 'Solid'){ echo "selected"; }?>>Solid</option>
				<option value="<?PHP echo $url3; ?>&type=SpringLOC"<?PHP if($_GET['type'] == 'SpringLOC'){ echo "selected"; }?>>SpringLOC Click System</option>
			</select>
			</form>
			</div>
			<?PHP # create the TREAT variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['treat'])){
				$treat   = $_GET['treat'];
				$replace = "&treat=".$_GET['treat'];
				$url4    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url4 = $url; } ?>
			<div id="sort-opts">Treatment<br />
			<form name="form4" id="form4">
			<select id="jumpMenu4" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url4; ?>"<?PHP if(!isset($_GET['treat'])){ echo "selected"; }?>>All Treatments</option>
				<?PHP # get treatments from database
				$treatQ = "SELECT DISTINCT treatment FROM products WHERE site = 1 ORDER BY treatment ASC";
				$treatR = $db->query($treatQ);
				while($treatA = $treatR->fetch_array()){
					$treatName = str_replace(" ", "-", $treatA['treatment']); ?>
				<option value="<?PHP echo $url4; ?>&treat=<?PHP echo $treatName; ?>"<?PHP if($_GET['treat'] == $treatName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $treatName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the WIDTH variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['width'])){
				$width   = $_GET['width'];
				$width2  = str_replace("-", " ", $width);
				$replace = "&width=".$_GET['width'];
				$url5    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url5 = $url; } ?>
			<form name="form5" id="form5">
			<div id="sort-opts">Width<br />
			<select id="jumpMenu5" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url5; ?>"<?PHP if(!isset($_GET['width'])){ echo "selected"; }?>>All Widths</option>
				<option value="<?PHP echo $url5; ?>&width=2-1/4"<?PHP if($_GET['width'] == '2-1/4'){ echo "selected"; }?>>2 1/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=3"<?PHP if($_GET['width'] == '3'){ echo "selected"; }?>>3 inches</option>
				<option value="<?PHP echo $url5; ?>&width=3-1/4"<?PHP if($_GET['width'] == '3-1/4'){ echo "selected"; }?>>3 1/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=4"<?PHP if($_GET['width'] == '4'){ echo "selected"; }?>>4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=4-3/4"<?PHP if($_GET['width'] == '4-3/4'){ echo "selected"; }?>>4 3/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=5"<?PHP if($_GET['width'] == '5'){ echo "selected"; }?>>5 inches</option>
				<option value="<?PHP echo $url5; ?>&width=7"<?PHP if($_GET['width'] == '7'){ echo "selected"; }?>>7 inches</option>
			</select>
			</form>
			</div>
			<?PHP # create the THICKNESS variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['thick'])){
				$thick   = $_GET['thick'];
				$replace = "&thick=".$_GET['thick'];
				$url4    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url6 = $url; } ?>
			<div id="sort-opts">Thickness<br />
			<form name="form6" id="form6">
			<select id="jumpMenu6" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url4; ?>"<?PHP if(!isset($_GET['treat'])){ echo "selected"; }?>>All Thickness</option>
				<?PHP # get thicknesses from database
				$thickQ = "SELECT DISTINCT thickness FROM products WHERE site = 1";
				$thickR = $db->query($thickQ);
				while($thickA = $thickR->fetch_array()){
					$thickName = str_replace("\"", "", $thickA['thickness']); ?>
				<option value="<?PHP echo $url4; ?>&thick=<?PHP echo $thickName; ?>"<?PHP if($_GET['thick'] == $thickName.""){ echo "selected"; }?>><?PHP echo $thickName." inch"; ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<div id="sort-clear" class="s14 bold white text-shadow" onclick="location.href='flooring.php?'">Clear Sort Options</div>

		</div>

		<div id="flooring-right">
			<div id="floor-advanceSearch" class="green bold s20" style="margin-bottom: 40px;"><div class="adv">No results, please check your search term(s) for accuracy or
use the drop-down menus on the left to narrow your search.</div>
</div>
		</div>

		<div style="clear: both;"></div>

	</div>

	</div>
</div>
<?PHP
#  p r o d u c t  d i s p l a y  #	
} else {
?>
<div id="sectionHeaderShell"></div>
<div id="sectionHeader"><img src="img/header_hard-wood-flooring.png" alt="Hard Wood Flooring" /></div>
<div id="sectionSubHeader" class="s18 white bold" style="text-align: left;"><h1 class="s18"><?PHP if(isset($_GET['collection'])){ echo "&nbsp;&nbsp;&nbsp;".str_replace("-"," ",$_GET['collection']." <span class='green italic'>Collection</span>"); } ?></h1></div>

<div id="content-container">
	<div id="content2">
		<div id="flooring-container">
		<div id="flooring-left" class="bold green s16">
			<?PHP # create the COLLECTION variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['collection'])){
				$collection = $_GET['collection'];
				# query to get the collection number
				$cq = "SELECT collID FROM collections WHERE name = '$collection' AND site = 1";
				$cr = $db->query($cq);
				$ca = $cr->fetch_array();
				$collection = $ca['collID'];
				$replace = "&collection=".$_GET['collection'];
				$url0    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url0 = $url; } ?>
			<div id="sort-opts">Collections<br />
			<form name="form0" id="form0">
			<select id="jumpMenu0" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url0; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Collections</option>
				<?PHP # get collections from database
				$colQ = "SELECT * FROM collections WHERE status = 1 AND site = 1 ORDER BY sort ASC";
				$colR = $db->query($colQ);
				while($colA = $colR->fetch_array()){
					$colName  = $colA['name']; ?>
				<option value="<?PHP echo $url0; ?>&collection=<?PHP echo $colName; ?>" <?PHP if($_GET['collection'] == $colName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $colName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the SPECIES variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['species'])){
				$species = $_GET['species'];
				$replace = "&species=".$_GET['species'];
				$url1    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url1 = $url; } ?>
			<div id="sort-opts">Species<br />
			<form name="form1" id="form1">
			<select id="jumpMenu1" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url1; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Species</option>
				<?PHP # get species from database
				$speQ = "SELECT DISTINCT species FROM products WHERE species NOT LIKE '%Vintage%' AND site = 1 ORDER BY species ASC";
				$speR = $db->query($speQ);
				while($speA = $speR->fetch_array()){
					$speName = str_replace("Vintage ", "", $speA['species']);
					$speName = str_replace(" ", "-", $speA['species']); ?>
				<option value="<?PHP echo $url1; ?>&species=<?PHP echo $speName;?>" <?PHP if($_GET['species'] == $speName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $speName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the COLOR variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['color'])){
				$color   = $_GET['color'];
				$replace = "&color=".$_GET['color'];
				$url2    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url2 = $url; }
			?>
			<div id="sort-opts">Color<br />
			<form name="form2" id="form2">
			<select id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url2; ?>"<?PHP if(!isset($_GET['color'])){ echo "selected"; }?>>All Colors</option>
				<option value="<?PHP echo $url2; ?>&color=light"<?PHP if($_GET['color'] == 'light'){ echo "selected"; }?>>Light</option>
				<option value="<?PHP echo $url2; ?>&color=medium"<?PHP if($_GET['color'] == 'medium'){ echo "selected"; }?>>Medium</option>
				<option value="<?PHP echo $url2; ?>&color=dark"<?PHP if($_GET['color'] == 'dark'){ echo "selected"; }?>>Dark</option>
			</select>
			</form>
			</div>
			<?PHP # create the TYPE variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['type'])){
				$type1   = $_GET['type'];
				switch($type1){
					case "Engineered": $type = "Engineered Tongue and Groove"; break;
					case "Solid": $type = "Solid"; break;
					case "SpringLOC": $type = "Engineered Click"; break; }
				$replace = "&type=".$_GET['type'];
				$url3    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url3 = $url; } ?>
			<form name="form3" id="form3">
			<div id="sort-opts">Type<br />
			<select id="jumpMenu3" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url3; ?>"<?PHP if(!isset($_GET['collection'])){ echo "selected"; }?>>All Types</option>
				<option value="<?PHP echo $url3; ?>&type=Engineered"<?PHP if($_GET['type'] == 'Engineered'){ echo "selected"; }?>>Engineered</option>
				<option value="<?PHP echo $url3; ?>&type=Solid"<?PHP if($_GET['type'] == 'Solid'){ echo "selected"; }?>>Solid</option>
				<option value="<?PHP echo $url3; ?>&type=SpringLOC"<?PHP if($_GET['type'] == 'SpringLOC'){ echo "selected"; }?>>SpringLOC Click System</option>
			</select>
			</form>
			</div>
			<?PHP # create the TREAT variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['treat'])){
				$treat   = $_GET['treat'];
				$replace = "&treat=".$_GET['treat'];
				$url4    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url4 = $url; } ?>
			<div id="sort-opts">Treatment<br />
			<form name="form4" id="form4">
			<select id="jumpMenu4" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url4; ?>"<?PHP if(!isset($_GET['treat'])){ echo "selected"; }?>>All Treatments</option>
				<?PHP # get treatments from database
				$treatQ = "SELECT DISTINCT treatment FROM products WHERE site = 1 ORDER BY treatment ASC";
				$treatR = $db->query($treatQ);
				while($treatA = $treatR->fetch_array()){
					$treatName = str_replace(" ", "-", $treatA['treatment']); ?>
				<option value="<?PHP echo $url4; ?>&treat=<?PHP echo $treatName; ?>"<?PHP if($_GET['treat'] == $treatName){ echo "selected"; }?>><?PHP echo str_replace("-", " ", $treatName); ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<?PHP # create the WIDTH variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['width'])){
				$width   = $_GET['width'];
				$width2  = str_replace("-", " ", $width);
				$replace = "&width=".$_GET['width'];
				$url5    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url5 = $url; } ?>
			<form name="form5" id="form5">
			<div id="sort-opts">Width<br />
			<select id="jumpMenu5" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url5; ?>"<?PHP if(!isset($_GET['width'])){ echo "selected"; }?>>All Widths</option>
				<option value="<?PHP echo $url5; ?>&width=2-1/4"<?PHP if($_GET['width'] == '2-1/4'){ echo "selected"; }?>>2 1/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=3"<?PHP if($_GET['width'] == '3'){ echo "selected"; }?>>3 inches</option>
				<option value="<?PHP echo $url5; ?>&width=3-1/4"<?PHP if($_GET['width'] == '3-1/4'){ echo "selected"; }?>>3 1/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=4"<?PHP if($_GET['width'] == '4'){ echo "selected"; }?>>4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=4-3/4"<?PHP if($_GET['width'] == '4-3/4'){ echo "selected"; }?>>4 3/4 inches</option>
				<option value="<?PHP echo $url5; ?>&width=5"<?PHP if($_GET['width'] == '5'){ echo "selected"; }?>>5 inches</option>
				<option value="<?PHP echo $url5; ?>&width=7"<?PHP if($_GET['width'] == '7'){ echo "selected"; }?>>7 inches</option>
			</select>
			</form>
			</div>
			<?PHP # create the THICKNESS variable and replace the $url variable accordingly for each menu click
			if(isset($_GET['thick'])){
				$thick   = $_GET['thick'];
				$replace = "&thick=".$_GET['thick'];
				$url4    = str_replace($replace, "", $_SERVER["REQUEST_URI"]);
			} else { $url6 = $url; } ?>
			<div id="sort-opts">Thickness<br />
			<form name="form6" id="form6">
			<select id="jumpMenu6" onchange="MM_jumpMenu('parent',this,0)" style="width: 158px;" class="font s12 bold brown">
				<option value="<?PHP echo $url4; ?>"<?PHP if(!isset($_GET['treat'])){ echo "selected"; }?>>All Thickness</option>
				<?PHP # get thicknesses from database
				$thickQ = "SELECT DISTINCT thickness FROM products WHERE site = 1";
				$thickR = $db->query($thickQ);
				while($thickA = $thickR->fetch_array()){
					$thickName = str_replace("\"", "", $thickA['thickness']); ?>
				<option value="<?PHP echo $url4; ?>&thick=<?PHP echo $thickName; ?>"<?PHP if($_GET['thick'] == $thickName.""){ echo "selected"; }?>><?PHP echo $thickName." inch"; ?></option>
				<?PHP } ?>
			</select>
			</form>
			</div>
			<div id="sort-clear" class="s14 bold white text-shadow" onclick="location.href='flooring.php?'">Clear Sort Options</div>

		</div>

		<div id="flooring-right">

			

		<?PHP # query for the products needed for display
		$query = "
		SELECT *
		FROM products
		WHERE status = 1";
		# --  S o r t  b y  C O L L E C T I O N  -- #
		if(isset($collection)){ $query .= " AND collection = '".$collection."'"; }
		# --  S o r t  b y  S P E C I E S  -- #
		if(isset($species)){ $query .= " AND species LIKE '%".str_replace("-", " ", $species)."%'"; }
		# --  S o r t  b y  C O L O R  -- #
		if(isset($color)){ $query .= " AND tone = '".$color."'"; }
		# --  S o r t  b y  T Y P E  --  #
		if(isset($type)){ $query .= " AND type = '".$type."'"; }
		# --  S o r t  b y  T R E A T M E N T  -- #
		if(isset($treat)){ $query .= " AND treatment = '".addslashes(str_replace("-", " ", $treat))."'"; }
		# --  S o r t  b y  W I D T H  -- #
		if(isset($width)){ $query .= " AND width LIKE '%".$width."\"%'"; }
		# --  S o r t  b y  T H I C K N E S S  -- #
		if(isset($thick)){ $query .= " AND thickness LIKE '%".$thick."%'"; }
		# finish off the query, determining sort order, first by prodSort (if they ever decide to use it) then by prodSpecies
		$query .= " 
		AND site = 1 ORDER BY sort ASC";
		# run the query
		$result = $db->query($query);
		if($result->num_rows != 0){
			while($array = $result->fetch_array()){
				$prodID   = $array['prodID'];
				$prodName = $array['species'] . " " . $array['color'];
				$prodNam2 = str_replace(" ", "-", $prodName);
				$prodImg  = "img/prod/". $array['itemnum'] . ".jpg";
				if(!is_file($prodImg)){ $prodImg = "img/no-img.jpg"; }
				if($result->num_rows <= 4){ $styleIT = "margin-bottom: 214px;"; }
				echo "<div id=\"prod-grid\" style=\"$styleIT\" class=\"bold\" onmouseover=\"this.className='greenD bold';\" onmouseout=\"this.className='bold';\" onclick=\"location.href='details.php?id=$prodID&prod=$prodNam2';\"><div id=\"prod-img\"><img src=\"$prodImg\" height=\"175\" width=\"175\" border=\"0\" alt=\"$prodName\" /></div><div id=\"prod-name\" class=\"s14\">$prodName</div></div>";
			}
		} else { ?>
				<div id="floor-noresults" class="green bold s20" style="margin-bottom: 40px;">Sorry, there are no matches for your sort criteria.</div>
		<?PHP } ?>
		</div>

		<div style="clear: both;"></div>

	</div>

	</div>
</div>
<?PHP
}
# include the footer
include('footer.php'); ?>
