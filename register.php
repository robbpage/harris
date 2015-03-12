<?PHP
#                            #
#   c o n t a c t . p h p    #
#                            #

# include the database connection
include('inc/dbc.php');

# create the collections drop down
$collR = $db->query("SELECT * FROM collections WHERE site = 1 ORDER BY sort ASC");
while($collA = $collR->fetch_array(MYSQLI_ASSOC)){
	$collID    = $collA['collID'];
	$collNAME  = str_replace("-"," ", $collA['name']);
	$collLIST .= "<option value=\"$collID\">$collNAME</option>";
}

# set the page title
$title = "Harris Wood - Warranty Registration";

# include the header file
include('header.php');
?>

<div id="sectionHeaderShell"></div>
<div id="sectionHeader"><img src="img/header_product-registration.png" alt="Product Registration" /></div>
<div id="sectionSubHeader" class="white bold"></div>

<div id="contentShell">
	<div id="content" style="overflow: hidden;">
		<div id="war-letter" class="s16" style="margin-top: 26px;"><span style="line-height: 25px;" class="bold s18">Dear Valued Customer,</span><br />Thank you for making Harris<span class="s12">&reg;</span>Wood the preferred choice for your recent purchase.  We are dedicated to engineering value and performance into our wood flooring products and know you will enjoy the durability and reliability of your Harris Wood flooring for many years to come.  To register your new product, simply fill out the form below for on-line registration or you can call 1-800-842-7816.  The information you provide assists us in processing claims in a quick and efficient manner.  All information remains private, confidential and the exclusive property of Q.E.P. Co., Inc.<br /><br /><strong>Sincerely,<br />Harris Wood</strong></div>

		<form name="warForm" id="warForm">
		<div id="war-fullRowHead" class="s22 white bold text-shadow-black">Product Information<span class="s10 bold green">&nbsp;&nbsp;&nbsp;&nbsp;REQUIRED FIELDS<span class="s14 bold"> *</span></span></div>
		<div id="prod-coll" class="war-form-row bold" style="padding-right: 15px;"><span id='collection2' class="brown reqFi2">Collection*</span><br />
			<select id="collection" name="collection" class="war-dropDown s18" onchange="getProdnum('prod-spec',this.value);" onfocus="deHI(this.id,2);">
			<option value="0" selected="selected">Please Select ...</option>
			<?PHP echo $collLIST; ?>
			</select>
		</div>
		<div id="prod-spec" class="war-form-row bold" style="padding-right: 15px;"><span class="grey">Species*</span><br />
			<select id="species" name="species" class="war-dropDown s18" disabled="disabled">
			<option value="0" selected="selected"></option>
			</select>
		</div>
		<div id="prod-width" class="war-form-row bold"><span class="grey">Width*</span><br />
			<select id="width" name="width" class="war-dropDown s18" disabled="disabled">
			<option value="0" selected="selected"></option>
			</select>
		</div>
        <div style="clear: both; padding-bottom: 30px;"></div>
		<div style="width: 480px; float: left;">
			<div id="prodsqft1" class="s12 bold brown war-label reqFi">SqFt Purchased*</div>
			<div id="war-field"><input type="text" name="prodsqft" id="prodsqft" class="s18 warField" maxlength="25" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="prodcity1" class="s12 bold brown war-label reqFi">City*</div>
			<div id="war-field"><input type="text" name="prodcity" id="prodcity" class="s18 warField" maxlength="35" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="prodzip1" class="s12 bold brown war-label reqFi">Zip Code*</div>
			<div id="war-field"><input type="text" name="prodzip" id="prodzip" class="s18 warField" maxlength="25" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="prodppc1" class="s12 bold brown war-label">Price per Carton</div>
			<div id="war-field"><input type="text" name="prodppc" id="prodppc" class="s18 warField" maxlength="25" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="prodmdc1" class="s12 bold brown war-label" style="line-height: 10px; padding-top: 6px; height: 24px;">Manufacturer Date Code<br /><span class="s10 green italic">&nbsp;&nbsp;&nbsp;upper left corner of the label</span></div>
			<div id="war-field"><input type="text" name="prodmdc" id="prodmdc" class="s18 warField" maxlength="30" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
		</div>
		<div style="width: 465px; float: left; margin-left: 15px;">
			<div id="prodfrom1" class="s12 bold brown war-label reqFi">Purchased From*</div>
			<div id="war-field" style="width: 265px;"><input type="text" name="prodfrom" id="prodfrom" class="s18 warField" maxlength="100" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="prodstate1" class="s12 bold brown war-label reqFi">State*</div>
			<div id="war-field" style="width: 265px;">
            <select name="prodstate" id="prodstate" class="s18" style="width: 265px; height: 30px;" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);">
            <option value="" selected="selected">Please select ...</option>
            <option value="AK">Alaska</option>
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="AZ">Arizona</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DC">Washington D.C.</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="IA">Iowa</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="MA">Massachusetts</option>
            <option value="MD">Maryland</option>
            <option value="ME">Maine</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MO">Missouri</option>
            <option value="MS">Mississippi</option>
            <option value="MT">Montana</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="NE">Nebraska</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NV">Nevada</option>
            <option value="NY">New York</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="PR">Puerto Rico</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VA">Virginia</option>
            <option value="VT">Vermont</option>
            <option value="WA">Washington</option>
            <option value="WI">Wisconsin</option>
            <option value="WV">West Virginia</option>
            <option value="WY">Wyoming</option>
            </select>
			</div>
			<div style="clear: both;"></div>
			<div id="proddate1" class="s12 bold brown war-label">Date of Purchase</div>
			<div id="war-field" style="width: 265px;">
				<select name="prodmonth" id="prodmonth" class="s18" style="width: 108px; height: 30px;" onfocus="hiLITE('proddate',1);" onblur=" hiLITE('proddate',2);">
                <option value="0" selected="selected">Month ...</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
                </select>
                <select name="prodday" id="prodday" class="s18" style="width: 80px; height: 30px;" onfocus="hiLITE('proddate',1);" onblur=" hiLITE('proddate',2);">
                <option value="0" selected="selected">Day ...</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                </select>
                <select name="prodyear" id="prodyear" class="s18" style="width: 70px; height: 30px;" onfocus="hiLITE('proddate',1);" onblur=" hiLITE('proddate',2);">
                <?PHP $year = date('Y'); $year2 = (date('Y')-1); $year3 = (date('Y')-2); ?>
                <option value="<?PHP echo $year3; ?>"><?PHP echo $year3; ?></option>
                <option value="<?PHP echo $year2; ?>"><?PHP echo $year2; ?></option>
                <option value="<?PHP echo $year; ?>" selected="selected"><?PHP echo $year; ?></option>
                </select>
			</div>
			<div style="clear: both;"></div>
			<div id="prodarea1" class="s12 bold brown war-label">Area(s) to be installed</div>
			<div id="war-field" style="width: 265px;"><input type="text" name="prodarea" id="prodarea" class="s18 warField" maxlength="100" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
		</div>

		<div id="scroller" style="clear: both;"></div>

		<div id="war-fullRowHead" class="s22 white bold text-shadow-black">Purchaser Information<span class="s10 bold green">&nbsp;&nbsp;&nbsp;&nbsp;REQUIRED FIELDS<span class="s14 bold"> *</span></span></div>
        
        <div style="width: 480px; float: left;">
            <div id="purname1" class="s12 bold brown war-label reqFi">Name*</div>
            <div id="war-field"><input type="text" name="purname" id="purname" class="s18 warField" maxlength="50" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
            <div style="clear: both;"></div>
            <div id="purcity1" class="s12 bold brown war-label reqFi">City*</div>
            <div id="war-field"><input type="text" name="purcity" id="purcity" class="s18 warField" maxlength="35" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
            <div style="clear: both;"></div>
            <div id="purzip1" class="s12 bold brown war-label reqFi">Zip Code*</div>
            <div id="war-field"><input type="text" name="purzip" id="purzip" class="s18 warField" maxlength="25" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
            <div style="clear: both;"></div>
            <div id="puremail1" class="s12 bold brown war-label">Email</div>
            <div id="war-field"><input type="text" name="puremail" id="puremail" class="s18 warField" maxlength="100" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
            <div style="clear: both;"></div>
        </div>
		<div style="width: 465px; float: left; margin-left: 15px;">
			<div id="puraddy1" class="s12 bold brown war-label reqFi">Address*</div>
			<div id="war-field" style="width: 265px;"><input type="text" name="puraddy" id="puraddy" class="s18 warField" maxlength="150" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="purstate1" class="s12 bold brown war-label reqFi">State*</div>
			<div id="war-field" style="width: 265px;">
            <select name="purstate" id="purstate" class="s18" style="width: 265px; height: 30px;" onfocus="deHI(this.id,1); hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);">
            <option value="" selected="selected">Please select ...</option>
            <option value="AK">Alaska</option>
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="AZ">Arizona</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DC">Washington D.C.</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="IA">Iowa</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="MA">Massachusetts</option>
            <option value="MD">Maryland</option>
            <option value="ME">Maine</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MO">Missouri</option>
            <option value="MS">Mississippi</option>
            <option value="MT">Montana</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="NE">Nebraska</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NV">Nevada</option>
            <option value="NY">New York</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="PR">Puerto Rico</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VA">Virginia</option>
            <option value="VT">Vermont</option>
            <option value="WA">Washington</option>
            <option value="WI">Wisconsin</option>
            <option value="WV">West Virginia</option>
            <option value="WY">Wyoming</option>
            </select>
			</div>
			<div style="clear: both;"></div>
			<div id="purphone1" class="s12 bold brown war-label">Phone</div>
			<div id="war-field" style="width: 265px;"><input type="text" name="purphone" id="purphone" class="s18 warField" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);" /></div>
			<div style="clear: both;"></div>
			<div id="purage1" class="s12 bold brown war-label">Age</div>
			<div id="war-field" style="width: 265px;">
            <select name="purage" id="purage" class="s18" style="width: 265px; height: 30px;" onfocus="hiLITE(this.id,1);" onblur=" hiLITE(this.id,2);">
            <option value="" selected="selected">Please select ...</option>
            <option value="0-20">Under 20 Years Old</option>
            <option value="21-30">21-30 Years Old</option>
            <option value="31-40">31-40 Years Old</option>
            <option value="41-50">41-50 Years Old</option>
            <option value="51-60">51-60 Years Old</option>
            <option value="60+">Over 60 Years Old</option>
            </select>
			</div>
		</div>
		<div style="clear: both; padding-bottom: 30px;"></div>

		<div id="war-optHead" class="s14 brownL bold">What was important to you in choosing this product? (choose all that apply)</div>
		<div id="war-fullRow" class="s14 bold green" style="margin-top: 6px;">
			<input type="checkbox" name="purimp[]" id="purimp-price" onclick="checkIT('purimp1');" value="price" /><label id="purimp1" for="purimp-price" class="brown">&nbsp;Price&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp[]" id="purimp-color" onclick="checkIT('purimp2');" value="color" /><label id="purimp2" for="purimp-color" class="brown">&nbsp;Color&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp[]" id="purimp-species" onclick="checkIT('purimp3');" value="species" /><label id="purimp3" for="purimp-species" class="brown">&nbsp;Species&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp[]" id="purimp-finish" onclick="checkIT('purimp4');" value="finish" /><label id="purimp4" for="purimp-finish" class="brown">&nbsp;Finish Features&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp[]" id="purimp-usa" onclick="checkIT('purimp5');" value="USA" /><label id="purimp5" for="purimp-usa" class="brown">&nbsp;Made in the USA&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp[]" id="purimp-avail" onclick="checkIT('purimp6');" value="availability" /><label id="purimp6" for="purimp-avail" class="brown">&nbsp;Availability&nbsp;&nbsp;&nbsp;</label>
			<input type="checkbox" name="purimp-other" id="purimp-other" onclick="checkIT('purimp7'); growIT('purimp8');" value="other" /><label id="purimp7" for="purimp-other" class="brown">&nbsp;Other (please explain)</label>
			<div id= "purimp8" class="purOTHERexp"><textarea id="purimp-otherEXP" name="purimp-otherEXP" style="width: 450px; height: 130px;" class="s16 bold" maxlength="200"></textarea></div>
		</div>

		<div id="war-optHead" class="s14 brownL bold" style="margin-top: 20px;">How did you hear about Harris Wood?</div>
		<div id="war-fullRow" class="s14 bold green" style="margin-top: 6px;">
			<input type="radio" name="purhear" id="purhear-fb" onclick="colorIT('purhear',1,5,0);" value="Facebook" /><label id="purhear1" for="purhear-fb" class="brown">&nbsp;Facebook&nbsp;&nbsp;&nbsp;</label>
			<input type="radio" name="purhear" id="purhear-twit" onclick="colorIT('purhear',2,5,0);" value="Twitter" /><label id="purhear2" for="purhear-twit" class="brown">&nbsp;Twitter&nbsp;&nbsp;&nbsp;</label>
			<input type="radio" name="purhear" id="purhear-pin" onclick="colorIT('purhear',3,5,0);" value="Pinterest" /><label id="purhear3" for="purhear-pin" class="brown">&nbsp;Pinterest&nbsp;&nbsp;&nbsp;</label>
			<input type="radio" name="purhear" id="purhear-other" onclick="colorIT('purhear',4,5);" value="other" /><label id="purhear4" for="purhear-other" class="brown">&nbsp;Other (please specify)</label>
			<div id="purhear5" class="purOTHERexp"><textarea id="purhear-otherEXP" name="purhear-otherEXP" style="width: 450px; height: 130px;" class="s16 bold" maxlength="200"></textarea></div>
		</div>

		<div id="war-optHead" class="s14 brownL bold" style="margin-top: 20px;">Who installed your new Harris Wood Flooring?</div>
		<div id="war-fullRow" class="s14 bold green" style="margin-top: 6px;">
			<input type="radio" name="purinst" id="purinst-store" onclick="colorIT('purinst',1,4);" value="wherepurchased" /><label id="purinst1" for="purinst-store" class="brown">&nbsp;Company where flooring was purchased&nbsp;&nbsp;&nbsp;</label>
			<input type="radio" name="purinst" id="purinst-priv" onclick="colorIT('purinst',2,4);" value="privateinstaller" /><label id="purinst2" for="purinst-priv" class="brown">&nbsp;Private Installer&nbsp;&nbsp;&nbsp;</label>
			<input type="radio" name="purinst" id="purinst-diy" onclick="colorIT('purinst',3,4);" value="diyfamfriend" /><label id="purinst3" for="purinst-diy" class="brown">&nbsp;DIY, Family or Friend</label>
		</div>

		<div id="war-optHead" class="s14 brownL bold" style="margin-top: 30px;">Where did you shop for other flooring before making your final decision?</div>
		<div id="war-fullRow" class="s14 bold green" style="margin-top: 6px;">
			<label id="purshop1" for="purshop-store" class="brown"><input type="radio" name="purshop" id="purshop-store" onclick="colorIT('purshop',1,3,0);" class="rdoSHOP" value="homestore" />&nbsp;Home Improvement Store&nbsp;&nbsp;&nbsp;</label>
			<label id="purshop2" for="purshop-other" class="brown"><input type="radio" name="purshop" id="purshop-other" onclick="colorIT('purshop',2,3);" class="rdoSHOP" value="other" />&nbsp;Online/Other (please specify)&nbsp;&nbsp;&nbsp;</label>
			<div id="purshop3" class="purOTHERexp"><textarea id="purshop-otherEXP" name="purshop-otherEXP" style="width: 450px; height: 130px;" class="s16 bold" maxlength="200"></textarea></div>
		</div>

		<div id="war-optHead" class="s14 brownL bold" style="margin-top: 20px;">Would you recommend Harris Wood products to a friend?</div>
		<div id="war-fullRow" class="s14 bold green" style="margin-top: 6px;">
			<label id="purrec1" for="purrec-yes" class="brown"><input type="radio" name="purrec" id="purrec-yes" onclick="colorIT('purrec',1,3,0);" class="rdoREC" value="yes" />&nbsp;Yes&nbsp;&nbsp;&nbsp;</label>
			<label id="purrec2" for="purrec-no" class="brown"><input type="radio" name="purrec" id="purrec-no" onclick="colorIT('purrec',2,3);" class="rdoREC" value="no" />&nbsp;No (please explain)</label>
			<div id="purrec3" class="purOTHERexp"><textarea id="purrec-noEXP" name="purrec-noEXP" style="width: 450px; height: 130px;" class="s16 bold" maxlength="200"></textarea></div>
		</div>

		<div id="war-optHead" class="s14 brownL bold" style="margin: 20px 0px 8px 0px;">What could Harris Wood do better?</div>
		<div id="war-halfRow" class="s14 bold green">
			<textarea id="purdobetter" name="purdobetter" style="width: 480px; height: 130px;" class="s16 bold" maxlength="500"></textarea>
		</div>
		<div id="war-halfRow" class="s14 brownL bold"><br /><br />
			Would you be interested in participating in additional<br />questionnaires to help Harris Wood improve?<br /><br />
			<label id="morequestions" for="moreQs" class="brown s18"><input type="checkbox" id="moreQs" name="moreQs" onclick="checkIT('morequestions',1);" />&nbsp;Sure, sign me up</label>
		</div>
		<div style="clear: both;"></div>

		<div id="war-subContainer">
			<div id="war-subBlurb">
				By submitting this Product Registration you are acknowledging that you've<br />read and accepted the <a href="JavaScript:void(0);" class="link-war bold" onclick="showWar();">Harris&reg;Wood Warranty Terms/Requirements</a>
			</div>
			<div id="war-capShell">
				<div id="war-capButton" class="s14 bold white" onclick="document.getElementById('war-captcha').src = 'inc/captcha/securimage_show.php?' + Math.random(); return false; fillIT('capcode','enter code');">Change Image</div>
                <img id="war-captcha" src="inc/captcha/securimage_show.php" alt="CAPTCHA Image" />
                <div style="width: 250px; text-align: center; margin: 10px 0px 10px 0px;"><input id="capcode" name="capcode" type="text" class="s18 bold grey italic" style="width: 250px; height: 24px; text-align: center; border: 1px solid #CCC;" value="enter code" onfocus="clearIT('capcode');" onblur="fillIT('capcode','enter code');" /></div>
                <div id="cap-butt" class="subbutt s14 bold white" style="width: 250px;">Submit Registration</div>
			</div>
		</div>
		</form>

		<!-- Warranty Terms/Requirements -->
		<div id="war-TermReq" class="s14 black">
		<div id="war-fullRowHead" class="s22 white bold text-shadow-black">Warranty Terms/Requirements</div>
		Warranty information must be received within 30 days from date of purchase to qualify for validation.  This warranty may not apply in your country.<br /><br />
		<span class="s22 bold brownL">Harris<span class="s14"><sup>&reg;</sup></span>Wood - Limited Warranty</span><br />
		<span class="s16 bold green italic">WHO IS COVERED UNDER THE HARRIS WOOD WARRANTY?</span><br />
		All warranties are given to the original retail purchaser of our products.  All warranties are non-transferable.<br /><br />
		<span class="s16 bold green italic">WHAT IS COVERED UNDER MY HARRIS WOOD WARRANTY?</span><br />
		The warranties described in this brochure are subject to product applications, limitations, disclaimers and exclusions.  All warranties apply from the date of purchase.<br /><br />
		<span class="s16 bold green italic">WHAT IS THE HOMEOWNER RESPONSIBLE FOR?</span><br />
		For warranty coverage, please retain your original sales receipt/invoice.  Claims cannot be ﬁled without this information. Please ensure the ﬂooring is properly installed according to guidelines.  Harris Wood is not responsible for products installed with visible defects. Interior temperature and humidity controls should be maintained year round.  Interior temperature should be kept between 60-80&deg; F.<br /><br />
		<span class="s16 bold green italic">WHAT IS THE PROCESS IF A WARRANTED CONDITION OCCURS?</span><br />
		If a warranted condition occurs with ﬁrst quality goods, Harris Wood will either repair, replace (with like or comparable ﬂooring) or reﬁnish the ﬂoor, in part or in whole, at no cost to the original purchaser or issue a refund of the purchase price, at Harris Wood's sole discretion.  If Harris Wood has made reasonable attempts to remedy the problem and the problem is not solved, the purchase price of the effected area will be returned.<br /><br />

		<span class="s16 bold green italic">WHAT IS COVERED UNDER THIS WARRANTY?</span><br />
		•&nbsp;&nbsp;&nbsp;<strong>Residential Warranty:</strong> Applicable products will be free from manufacturing defects for as long as you own your home. (Examples of manufacturing defects are improper milling, grading or separation of plies which occur in recommended conditions.)<br />
		•&nbsp;&nbsp;&nbsp;<strong>Finish Warranty:</strong> We warrant that under normal residential conditions and with proper maintenance, our ﬁnish will not wear through for a limited period.  Gloss reduction is not considered finish wear through.  Therefore, it is not covered under the ﬁnish warranty. Finish wear through is deﬁned as 100% ﬁnish removal over at least 3% of the area of a total ﬂooring installation.<br />
		•&nbsp;&nbsp;&nbsp;<strong>Reﬁnishing Warranty:</strong> Harris Wood warrants that our preﬁnished Solid products can be sanded and reﬁnished up to three times and Engineered products can be sanded and reﬁnished one time.  This refinishing warranty is valid when performed by a professional sand and reﬁnisher.  Please note on surface textured products, sanding will alter handscraped/distressed appearance.  On beveled edged products, stained color will remain on the beveled sides and ends.<br />
		•&nbsp;&nbsp;&nbsp;<strong>Radiant Heat Warranty:</strong> Solid products are not warranted for use over radiant heat systems.  Please see Warranty Chart for information on Engineered products and approved species.<br /><br />
        <span class="s16 bold green italic">REGARDING ALL WARRANTY COVERAGE</span><br />
        •&nbsp;&nbsp;&nbsp;It is critical that all installations are done in compliance with the procedures outlined in the installation instructions.  Failure to install flooring in accordance with the instructions will void all warranties.<br />
        •&nbsp;&nbsp;&nbsp;Only ﬂooring that was professionally installed will be eligible for labor cost reimbursement.  If you installed the ﬂoor yourself we will cover the cost of replacement materials only.  Retain your receipts for all product and installation costs.<br />
        •&nbsp;&nbsp;&nbsp;No warranty coverage is provided for ﬂooring that contains obvious defects of any kind that were installed nonetheless.  If before installation you discover any ﬂooring that has obvious defects please contact Harris Wood immediately, and replacement ﬂooring will be provided at no cost.<br />
        •&nbsp;&nbsp;&nbsp;Our product is not intended for a full bath installation.<br /><br />
        
        <span class="s16 bold green italic">EXCLUSIONS</span><br />
        •&nbsp;&nbsp;&nbsp;All warranties are limited to the original retail purchaser.<br />
        •&nbsp;&nbsp;&nbsp;Harris Wood cannot warrant a color match of our products to other wood products, such as stairs, stair railings, cabinets, trim, molding, etc.<br />
        •&nbsp;&nbsp;&nbsp;In order to maintain the recommended relative humidity (35%-55%) inside the home, installation of a humidiﬁer or dehumidiﬁer may be necessary.  The ﬂooring is designed to perform in an environmentally controlled structure.  Varying levels of humidity and temperature will affect the performance and appearance of wood ﬂooring.  Care should be taken to control the environment the ﬂooring is exposed to.  Heating season brings low humidity (dry air) that can lead to shrinkage, separation or squeaking in a wood ﬂoor.  Non-heating season brings high humidity (humid/wet air) that can lead to expansion, cupping, buckling, or squeaking.  Problems arising in ﬂooring exposed to conditions outside of these parameters are not covered under Harris Wood warranties.<br />
        •&nbsp;&nbsp;&nbsp;Natural wood characteristics such as mineral streaks, small knots, grain variations, etc. are normal characteristics and are not construed as defects.  Nature leaves no two pieces of wood flooring the same and color or other variations can occur.  We do not warrant against natural variations, or the normal minor differences between color samples and the color of installed ﬂoors.  Due to the nature of hand scraping and unique distressing, these processes leave no two pieces the same.  Samples may slightly vary from installed ﬂooring.  This is not a cause for a warranty claim.<br />
        •&nbsp;&nbsp;&nbsp;Only approved cleaning and maintenance products are appropriate for use on our products.  Use of non-approved cleaners and maintenance products or any oil soap or ammonia-based cleaners will void all warranties.  For textured/distressed/scraped products, it is recommended to vacuum and sweep before use of approved cleaner.  For a current list of approved products please call 1-800-842-7816.<br />
        •&nbsp;&nbsp;&nbsp;The warranty does not cover damage arising from accidents, abuse, abnormal wear, spike heels, grit, scratches, dents, abrasives (salt, sand, glass, etc.), rubbing, excessive heat or excessive dryness.<br />
        •&nbsp;&nbsp;&nbsp;Gloss reduction is not considered finish wear-through.  Therefore, it is not covered under the ﬁnish warranty.<br />
        •&nbsp;&nbsp;&nbsp;The warranty does not cover color changes to any products which result from ultraviolet (UV) or artiﬁcial light.  American Cherry and Walnut flooring are especially susceptible and may darken or lighten due to UV or artiﬁcial light exposure.  Area rugs should be moved periodically to minimize the effects of UV and artificial light on wood ﬂoors.<br />
        •&nbsp;&nbsp;&nbsp;Products designed as "bargain," "cabin grade," "seconds," "close-out," "off-goods," "non-standard" are sold AS IS. These products while structurally sound are not ﬁrst quality, but will provide a serviceable ﬂoor.  Harris Wood provides no warranties, implied or direct, for this type of flooring.<br />
        •&nbsp;&nbsp;&nbsp;Excessive ground moisture caused by natural weather conditions including (but not limited to): excessive rainfall, hurricanes, tornadoes, flooding or other natural disasters are not covered by the terms of this warranty.<br />
        •&nbsp;&nbsp;&nbsp;Warranty excludes and Harris Wood will not pay consequential or incidental damages associated with any warranty claim.  Harris Wood will repair, replace (with like or comparable flooring) or reﬁnish the ﬂoor, in part or in whole, at no cost to the original purchaser or to issue a refund of the purchase price, at Harris Wood's discretion.  If Harris Wood has made reasonable attempts to remedy the problem, the purchase price of the effected area will be returned.<br />
        •&nbsp;&nbsp;&nbsp;The warranty does not cover insect infestation after the product has left our factory or scratches or stains caused by domestic pets.<br />
        •&nbsp;&nbsp;&nbsp;Damage due to water saturation (including but not limited to) a leaky faucet, broken pipe and wet-mopping is excluded.<br />
        •&nbsp;&nbsp;&nbsp;The use of putties during and after the installation of wood ﬂooring is considered normal and is not cause for a claim against this warranty.<br />
        •&nbsp;&nbsp;&nbsp;THERE ARE NO WARRANTIES WHICH EXTEND BEYOND THE DESCRIPTION ON THE FACE HEREOF.  NO OTHER WARRANTIES EXPRESS, IMPLIED, BY OPERATION OF LAW OR OTHERWISE ARE MADE, INCLUDING BUT NOT LIMITED TO WARRANTIES FOR MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.  UNDER NO CIRCUMSTANCES SHALL HARRIS WOOD BE LIABLE FOR ANY LOSS OR DAMAGE ARISING FROM THE PURCHASE, USE OR INABILITY TO USE THIS PRODUCT, OR FOR ANY SPECIAL, INDIRECT, INCIDENTAL OR CONSEQUENTIAL DAMAGES.  SOME STATES DO NOT ALLOW LIMITATIONS ON HOW LONG AN IMPLIED WARRANTY LASTS OR THE EXCLUSION OR LIMITATION OF INCIDENTAL OR CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.<br />
        •&nbsp;&nbsp;&nbsp;No installer, retailer, distributor, agent or employee of Harris Wood has the authority to increase or alter the obligations or limitations of this warranty.<br />
        •&nbsp;&nbsp;&nbsp;This warranty gives you speciﬁc legal rights.  You may also have other rights which vary from state to state.<br />
        •&nbsp;&nbsp;&nbsp;If you need to ﬁle a claim under this warranty, ﬁrst contact your Harris Wood retailer, or write to us at: Harris Wood Technical Services 2225 Eddie Williams Rd. Johnson City, TN 37601.<br />
        •&nbsp;&nbsp;&nbsp;Any and all disputes arising out of the purchase of products or this warranty shall be subject to mandatory and binding arbitration in Johnson City, Tennessee, pursuant to the rules of the American Arbitration Association.  Any trials by jury are expressly waived.<br />
        •&nbsp;&nbsp;&nbsp;<strong>Note: Please read installation instructions prior to installing</strong>
		<div class="subbutt s14 bold white" style="margin-top: 30px;" onclick="showWar();">Back to Top</div>
		</div>

	</div>
</div>
<?PHP include('footer.php'); ?>

<div id="alertBarShell">
	<div id="regAlertShell">
		<div id="inMsg" class="s14 bold brown" style="padding-top: 0px;">test</div>
		<div id="regAlertClose" class="alertClose white bold s14 <?PHP if(!$IE){ echo "text-shadow-blacker"; } ?>" onclick="msgCloser(2);">Close</div>
	</div>
</div>
