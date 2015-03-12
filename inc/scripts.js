<!--                          -->
<!--  H E A D E R  S T U F F  -->
<!--                          -->
$(function(){
	<!-- s e a r c h -->
	$('#searchTXT').focus(function(){
		if(this.value == "Search ..."){
			this.value = "";
			this.className = "bold s14 font greenD";
		}
	}).keyup(function(event){
		if(event.which == 13){
			if(this.value != ""){
				$('#searchBUTT').trigger('click');
			}
		}
	}).blur(function(){
		if(this.value == ""){
			this.className = "bold italic s14 font green";
			this.value = "Search ...";
		}
	})
	$('#searchBUTT').click(function(){
		var st = $('#searchTXT').val();
		if(st != "Search ..."){
			document.location.href='search.php?st='+st;
		}
	})
})




<!--                                -->
<!--  N A V I G A T I O N  M E N U  -->
<!--                                -->

$(function(){
	// main level drop down menus
	$('.drop').on('mouseover',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Drop').css('display','block');
	}).on('mouseout',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Drop').css('display','none');
	})
	// sub level drop down menus
	$('.drop2').on('mouseover',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Arrow').css('display','block');
		$('#'+theDiv+'Drop').css('display','block');
	}).on('mouseout',function(){
		var theDiv = $(this).attr('id');
		$('#'+theDiv+'Arrow').css('display','none');
		$('#'+theDiv+'Drop').css('display','none');
	})
	// detecting clicks and routing accordingly
	$('.go').on('click',function(){
		var theLINK = $(this).data('link');
		document.location.href=theLINK;
	})
})




<!--                                     -->
<!--  C O N T A C T  U S  S E C T I O N  -->
<!--                                     -->

// changes the lable font color on focus/blur
function cOcO(theDiv){
	if($('#'+theDiv).hasClass('brown') == true){
		$('#'+theDiv).removeClass('brown').addClass('green');
	} else if($('#'+theDiv).hasClass('green') == true){
		$('#'+theDiv).removeClass('green').addClass('brown');
	} else {
		$('#'+theDiv).removeClass('red').addClass('green');
	}
}

// when they click the send your message button
$(function(){
	$('#form-butt').click(function(){
		var formname = document.getElementById('formy')
		var fName = document.getElementById('name')
		var fEmail = document.getElementById('email')
		var fQncs = document.getElementById('qncs')
		var halt = $('#zip').val();
		var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
		if(fName.value == '' || fEmail.value == '' || fQncs.value == ''){
			$('#inMsg').html("<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />Please fill out all the <span class='red bold'>required*</span> fields");
			if(fName.value == ''){ $('#nm').removeClass('brown').addClass('red'); }
			if(fEmail.value == ''){ $('#em').removeClass('brown').addClass('red'); }
			if(fQncs.value == ''){ $('#qc').removeClass('brown').addClass('red'); }
			alertBar(1,'contactErrorShell');
		} else if(halt != ""){
			// do nothing
		} else  {
			if(!filter.test(fEmail.value)){
				$('#inMsg').html("<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />Please make sure you entered a properly formatted email address.");
				alertBar(1,'contactErrorShell');
				$('#em').removeClass('brown').addClass('red');
			} else {
				// submit the form
				$('#contact-sending').css({ 'opacity' : 1, 'left' : '-2px' });
				setTimeout(function(){
					$.post("inc/func.php?contactus", $('#formy').serialize(), function(data){
						// message sent successfully
						/*if(data == 3){
							// do nothing
						} else*/ if(data == 1){
							$('#contact-sent').html('<img src="img/icon_leaf.png" style="margin: 110px 0px 20px 0px;" /><br />Thank you for your message.');
							$('#contact-sent').css({'opacity' : 1, 'left' : '-2px'});
						// error processing (not likely, but just in case)
						} else {
							$('#contact-sent').html('<img src="img/icon_leaf.png" style="margin: 90px 0px 20px 0px;" /><br />Something went wrong, please try again.<br /><div id="contactClose" class="white bold s14 text-shadow-blacker" onclick="conClose();">OK</div>');
							$('#contact-sent').css({'opacity' : 1, 'left' : '-2px'});
							
						}
					})
				}, 2500);
			}
		}
	   
	})
})
// closes the Contact Us Error message
function conClose(){
	$('#contact-sending').css({'opacity' : 0, 'left' : '-2000px'});
	setTimeout(function(){ $('#contact-sent').css({'opacity' : 0}); }, 100);
	setTimeout(function(){ $('#contact-sent').css({'left' : '-2000px'}); }, 400);
}




<!--                          -->
<!--  PRODUCT PAGE JUMP MENU  -->
<!--                          -->
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}


<!--                          -->
<!--  CLEAR or FILL ELEMENTS  -->
<!--                          -->
function clearIT(id) {
	var itemID   = document.getElementById(id);
	var itemVAL  = itemID.value;
	var curCLASS = itemID.className;
	if(itemVAL == "Address or Zip/Postal Code" || itemVAL == "Search ..." || itemVAL == "enter code"){ itemID.value=''; itemID.className = curCLASS.replace('grey', 'black').replace('italic', ''); }
	if(itemVAL != "" || itemVAL != "Address or Zip/Postal Code" || itemVAL != "Search ..." || itemVAL != "enter code"){ itemID.className.replace('grey', 'black').replace('italic', '')}}
function fillIT(id, value) {
	var itemID  = document.getElementById(id);
	var itemVAL = value;
	var curCLASS = itemID.className;
	if(itemID.value == ""){ itemID.value = itemVAL; itemID.className = curCLASS.replace('black', 'grey italic'); }}


<!--                              -->
<!--  WTB.PHP GEO CODER FUNCTION  -->
<!--                              -->
var geocoder;
function codeAddress() {
	var address = document.getElementById("address").value;
	geocoder = new google.maps.Geocoder();
	if (geocoder) {
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var LatLon = results[0].geometry.location;
				var checkMe = AddressCheck(LatLon);
					//document.addzip.submit();
			} else {
		 		msgCloser(2);
			}
	  	});
	}
}

function AddressCheck(latlon){
	var getBack;
	var radius = document.getElementById("radius").value;
	$.post( "inc/func.php?wtb=check&latlon="+latlon+"&radius="+radius, function( data ) {
		 var getBack = makeMap(data,latlon);
	});
}
function makeMap(data,latlon){
  if(data == 0 || data == 2){
	 alertBar(1,"alertDiv")
	 if(data == 0){
		 document.getElementById('msg').innerHTML = "Unfortunately we don't have any locations in your area. Try increasing your search radius.";
	 } else {
		 document.getElementById('msg').innerHTML = "Unfortunately we don't have any locations in your area."; 
	 }
  } else {
	 document.addzip.subby.value=latlon;
	 document.addzip.submit();
  }
}
<!--                                    -->
<!--  W H E R E  T O  B U Y  S T U F F  -->
<!--                                    -->
$(function(){
	$('#wtb-radiusArrowShell').mouseover(function(){
		$('#wtb-radiusFly').css({'display':'inline'});
	}).mouseout(function(){
		$('#wtb-radiusFly').css({'display':'none'});
	})
})
function radIT(therad){
	$('#radius').val(therad+' miles');
	$('#wtb-radiusFly').css({'display':'none'});
}


<!--                                             -->
<!--  W A R R A N T Y   R E G I S T R A T I O N  -->
<!--                                             -->

<!-- COLLECTION/SPECIES/COLOR/WIDTH -->
function getProdnum(thediv,value){
	// this conditional resets and disables the width drop-down if they change their collection selection (to avoid having the old width from a previous collection carry over)
	if(thediv == 'prod-spec'){
		document.getElementById('prod-width').innerHTML = '<span class="grey">Width*</span><br /><select name="width" id="width" style="width: 310px; height: 30px;" class="s18"><option value="0"></option></select>'; 
		document.getElementById('width').disabled = 'disabled';
	}
	$(function(){$('#'+thediv).load('inc/func.php?gpn='+value+'&thediv='+thediv); });
	// this conditional resets and disables the width drop-down if they pick "please select" from the species drop down menu after already selecting a species/color previously
	if(thediv == 'prod-width'){
		if(value == 0){
			setTimeout(function(){
				document.getElementById('prod-width').innerHTML = '<span class="grey">Width*</span><br /><select name="width" id="width" style="width: 310px; height: 30px;" class="s18"><option value="0"></option></select>';
				document.getElementById('width').disabled = 'disabled';},100);
		}
	}

}
<!-- HIGHLIGHT CURRENT LABEL -->
function hiLITE(divy,onoff){
	var theDIV = document.getElementById(divy+'1');
	if(onoff == 1){	theDIV.style.background = "#FFFFCA"; }
	else { theDIV.style.background = "#F8F9E8"; }
}
<!-- HIGHLIGHT CHECKED ITEMS -->
function checkIT(divydo,extra){
	var x = document.getElementById(divydo);
	if(extra == "1"){ x.className = (x.className == 'green s18') ? 'brown s18' : 'green s18';
	} else { x.className = (x.className == 'green') ? 'brown' : 'green'; }
}
<!-- HIGHLIGHT RADIO BUTTONS -->
function colorIT(thedivs,thediv,thequant,grower){
	var theCount = 1;
	while(theCount != thequant){
		document.getElementById(thedivs+theCount).className = 'brown';
		theCount++;
	}
	document.getElementById(thedivs+thediv).className = 'green';
	if(grower == 0){ document.getElementById(thedivs+thequant).style.height = '0px';
	} else { document.getElementById(thedivs+thequant).style.height = '150px'; }
}
<!-- GROW THE 'OTHER' TEXT DIV -->
function growIT(divydo){
	var x = document.getElementById(divydo);
	x.style.height = (x.style.height == '150px') ? '0px' : '150px';
}

	

<!-- VERIFY REQUIRED FIELDS AND CAPTCHA | SUBMIT FORM -->
$(function(){
	$("#cap-butt").click(function(){
		// email validation first checks if they've selected the "help us out" option
		// and if so, requires they enter an email address then it checks that the   
		// email address they entered is properly formatted                          
		var purEMAIL  = document.getElementById('puremail').value;
		var moreQs    = document.getElementById('moreQs');
		if(moreQs.checked){
			if(purEMAIL == ""){
				// if they've selected to take part in future questionaires but neglected to enter their email address, this accounts for that error
				$('#inMsg').html('<img src="img/icon_leaf.png" /><br />In order to assist us with our future questionaires we will need<br />your email address.  Please enter it above.');
				alertBar(1,'regAlertShell');
				$('html, body').animate({ scrollTop: $("#scroller").offset().top }, 500);
				return false;
			}
		}
		if(purEMAIL != ""){
			var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
			if(!filter.test(purEMAIL)){
				// if they entered an improperly formatted email address
				$('#inMsg').html('<img src="img/icon_leaf.png" /><br />Please make sure you entered a properly formatted email address.');
				alertBar(1,'regAlertShell');
				$('html, body').animate({ scrollTop: $("#scroller").offset().top }, 500);
				return false;
			}
		}
		// required  P R O D U C T  information fields
		var prodNUM   = document.getElementById('width').value;
		var prodSQFT  = document.getElementById('prodsqft').value;
		var prodFROM  = document.getElementById('prodfrom').value;
		var prodCITY  = document.getElementById('prodcity').value;
		var prodSTATE = document.getElementById('prodstate').value;
		var prodZIP   = document.getElementById('prodzip').value;
		// required  P U R C H A S E R  information fields
		var purNAME   = document.getElementById('purname').value;
		var purADDY   = document.getElementById('puraddy').value;
		var purCITY   = document.getElementById('purcity').value;
		var purSTATE  = document.getElementById('purstate').value;
		var purZIP    = document.getElementById('purzip').value;
		// verify the required fields have been filled and remove the error class from     
		// the fields that have data so only the missing fields will be highlighted in red 
		$('.reqFi').each(function(){
			var tmpStr = document.getElementById(this.id.substring(0, this.id.length-1));
			if(tmpStr.value != ""){ this.className='s12 bold brown war-label'; }
		})
		$('.reqFi2').each(function(){
			var tmpStr = document.getElementById(this.id.substring(0, this.id.length-1));
			if(tmpStr.value != 0){ this.className='brown'; }
		})
		// required fields
		if(prodNUM == 0 || prodSQFT == '' || prodFROM == '' || prodCITY == '' || prodSTATE == '' || prodZIP == '' || purNAME == '' || purADDY == '' || purCITY == '' || purSTATE == '' || purZIP == ''){ var errors = 1; } else { var errors = 0;/*alert("OK");*/}
		// no errors detected, validate captcha and process the data
		if(errors == 0){
			//alert("IN IF");
			var theCode = document.getElementById('capcode').value;
			var dataString = 'code='+theCode;
			$.ajax({
				type: "POST",
				url: "inc/func.php?capver",
				data: dataString,
				success: function(data){
					//alert(data);
					// invalid captcha
					if(data == 0){
						//alert("NO CAPTCHA IF");
						$('#inMsg').html('<img src="img/icon_leaf.png" /><br />The code you entered did not match the code in the image. Please try again.');
						alertBar(1,'regAlertShell');
					}
					// valid captcha
					if(data == 1){
						// process the data
						$.post("inc/func.php?warform", $('#warForm').serialize(), function(data){
							//alert(data);
							if(data == 1){
								// something went wrong please try again (not likely to ever happen but just in case)
								$('#inMsg').html('<img src="img/icon_leaf.png" /><br />Something went wrong. Please try again.');
								alertBar(1,'regAlertShell');
								$('html, body').animate({ scrollTop: $("#warForm").offset().top }, 500);
							} else if(data == 0) {
								// data added, confirm for the customer
								//$('html, body').animate({ scrollTop: $("#headerShell").offset().top }, 200);
								$('#inMsg').html('<img src="img/icon_leaf.png" /><br />Thank you for registering your product.<br />We know you will enjoy it for many years to come.');
								$('#regAlertClose').click(function(){ location.href='index.php'; });
								alertBar(1,'regAlertShell','index.php');
							}
						});
					}
				}
			});
		// errors detected, change the missing fields to RED 
		} else {
			$('.reqFi').each(function(){ this.className='s12 bold red war-label'; }); 
			$('.reqFi2').each(function(){ this.className='red'; });
			$('html, body').animate({ scrollTop: $("#warForm").offset().top }, 500);
			$('#inMsg').html('<img src="img/icon_leaf.png" /><br />Please fill out all the <span class="red bold">required</span> fields.');
			alertBar(1,'regAlertShell');
		}
	})
})
<!-- SHOW WARRANTY BLURB -->
function showWar(){
	var thediv = document.getElementById('war-TermReq');
	thediv.style.height = (thediv.style.height == '1700px') ? '0px' : '1700px';
	if(thediv.style.height == '1700px'){ $('html, body').animate({ scrollTop: $("#war-TermReq").offset().top }, 500)}
}
<!-- UNHIGHLIGHT REQUIRED FIELDS WHEN FOCUSED -->
function deHI(thediv,theopt){
	var divy = document.getElementById(thediv+theopt);
	//alertClose();
	if(theopt == 1){ divy.className='s12 bold brown war-label reqFi'; }
	if(theopt == 2){ divy.className='brown reqFi2'; }
}


<!--                                                 -->
<!--    S u b  N a v  D r o p  D o w n  M e n u s    -->
<!--                                                 -->
function collPic(collname){
	var collLOW = collname.toLowerCase();
	var collIMG = 'img/collection_'+collLOW+'.jpg';
	document.getElementById('floorPicCon').innerHTML='<img src="'+collIMG+'" onclick="location.href=\'flooring.php?&collection='+collname+'\'">';
}


<!--                                           -->
<!--    M o l d i n g  M o u s e  O v e r s    -->
<!--                                           -->
// for good browsers (not IE)
function moldIT(div,onoff){
	var moldDIV = document.getElementById(div);
	// show the popup
	if(onoff == 1){ moldDIV.style.opacity = 1; }
	// hide the popup
	if(onoff == 0){ moldDIV.style.opacity = 0; }
}
// for horrible browsers (IE)
function moldIE(div,onoff){
	var moldDIV = document.getElementById(div);
	// show the popup
	if(onoff == 1){ moldDIV.style.display = "block"; }
	// hide the popup
	if(onoff == 0){ moldDIV.style.display = "none"; }
}


<!--                                  -->
<!--    P R O D U C T  S L I D E R    -->
<!--                                  -->

if(location.pathname.substring(location.pathname.lastIndexOf("/") + 1) == "index.php"){
	$(document).ready(function(){
		//console.log(location.pathname);
		setInterval(function(){ startSLICE(); },7000);
	})
}
function startSLICE(){
	var delay = 100;
	$('.photoSlice').each(function(){
		moveSLICE($(this).attr('id'),delay);
		delay = delay + 100;
	})
	setTimeout(function(){
		var id = $('#mainPhoto').attr('src').replace('img/slides/slide','').replace('.jpg','');
		swapSLIDE(id); }, 4200);
}

function moveSLICE(id,delay){
	var imgSLICE = $('#'+id);
	setTimeout(function(){ imgSLICE.css({'opacity':'1','top':'0'}); }, delay);
}

function swapSLIDE(id){
	var newSLIDE = parseInt(id) + 1;
	if(newSLIDE == 7){ newSLIDE = 1; };
	$('#mainPhoto').attr('src','img/slides/slide'+newSLIDE+'.jpg');
	var nextSLIDE = newSLIDE + 1;
	if(nextSLIDE == 7){ nextSLIDE = 1 };
	$('.photoSlice').css({'opacity':'0','top':'-400px','background-image':'url(img/slides/slide'+nextSLIDE+'.jpg)'});
}


<!--                                    -->
<!--    A l e r t  B a r  P o p  U p    -->
<!--                                    -->
function alertBar(onoff,whatDiv,theLink){
// onoff    =  the on or off status of the alert bar                                             //
// whatDiv  =  what div to display when the alert bar shows                                      //
// theLink  =  if a link INSIDE the alert bar needs to close the bar and then load a new page    //
	var alertBar = document.getElementById('alertBarShell');
	var theDiv   = document.getElementById(whatDiv);
	if(onoff == 1){
		theDiv.style.display   = 'inline'; theDiv.style.opacity = 1;
		alertBar.style.display = 'inline';
		setTimeout(function(){ alertBar.style.top = '50%'; alertBar.style.opacity = 1; }, 50);
	}
	if(onoff == 0){
		alertBar.style.opacity = 0;
		setTimeout(function(){ alertBar.style.top = '-200px'; theDiv.style.display = 'none'; }, 300);
		if(theLink != "0"){
			setTimeout(function(){ location.href = theLink; }, 300);
		}
	}
}

// email options for alert bar pop up
function emailFriend(onoff){
	var newDiv = document.getElementById('friendShell');
	var oldDiv = document.getElementById('emailShell');
	if(onoff == 1){
		oldDiv.style.opacity = 0;
		oldDiv.style.marginLeft = '300px';
		setTimeout(function(){ oldDiv.style.display = 'none'; }, 300);
		newDiv.style.display = 'inline';
		setTimeout(function(){ newDiv.style.opacity = 1; newDiv.style.marginLeft = '-300px'; }, 100);
	}
	if(onoff == 0){
		var alertBar = document.getElementById('alertBarShell');
		alertBar.style.opacity = 0;
		setTimeout(function(){ alertBar.style.top = '-200px'; newDiv.style.opacity = 0; newDiv.style.marginLeft = '-900px'; oldDiv.style.opacity = 1; oldDiv.style.marginLeft = '-300px'; newDiv.style.display = 'none'; }, 300);
	}
}

// highlight the labels when the form field is focused
function emHi(onoff,titid){
	if(onoff == 1){
		document.getElementById(titid).className = 'green'; }
	if(onoff == 0){
		document.getElementById(titid).className = 'greenD'; }
}

// close the inner message window
function msgCloser(doWhat){
	if(doWhat == 1){
		// closes just the inner message window
		var closeDiv = document.getElementById('inMsgShell');
		closeDiv.style.opacity = 0;
		setTimeout(function(){ closeDiv.style.top = '-200px'; closeDiv.style.display = 'none'; $('#msgClose').hide(); }, 300);
	}
	if(doWhat == 2){
		// closes the alert bar
		var closeDiv = document.getElementById('alertBarShell');
		var msgDiv   = document.getElementById('inMsgShell');
		closeDiv.style.opacity = 0;
		setTimeout(function(){ closeDiv.style.top = '-200px'; closeDiv.style.display = 'none'; msgDiv.style.display = 'none'; msgDiv.style.opacity = '0'; emailFriend(0); $('#alertClose').hide(); }, 300);
	}
}

// handle the form submit
$(function(){
	$("#friendSend").click(function(){
		var inErr  = document.getElementById('inMsgShell');
		var fEmail = document.getElementById('frEmail').value;
		var yEmail = document.getElementById('yrEmail').value;
		var brMess = document.getElementById('msg').value;
		var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
		var errMsg = "";
		inErr.style.display = 'inline';
		inErr.style.top = 0;
		if(fEmail != ""){
			if(!filter.test(fEmail)){
				errMsg = "<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />Please make sure you entered a properly formatted email address for your friend.";
			}
		}
		if(fEmail == ""){
			errMsg = "<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />You must at least enter a friend\'s email address.";
		}
		if(errMsg != ""){
			$('#inMsg').html(errMsg);
			$('#msgClose').show();
			setTimeout(function(){ inErr.style.opacity = 1; }, 100);
		} else {
			/* submit */
			$('#friendSending').css({'display':'inline'});
			setTimeout(function(){ $('#friendSending').css({'top' : '0','opacity' : 1}); },10);
			$.post("inc/func.php?emailFriend", $('#friendForm').serialize(), function(data){
				if(data == 1){
					// message sent
					$('#inMsg').html("<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />Your message has been sent. Thank you");
					$('#alertClose').show();
					inErr.style.display = 'inline';
					setTimeout(function(){ inErr.style.top = 0; inErr.style.opacity = 1; $('#frEmail,#msg,#yrEmail').val(''); }, 100);
				} else {
					// error
					$('#inMsg').html("<img src='img/icon_leaf.png' style='margin-bottom: 10px;' /><br />Something went wrong, please try again.");
					$('#msgClose').show();
					inErr.style.display = 'inline';
					setTimeout(function(){ inErr.style.top = 0; inErr.style.opacity = 1; }, 100);
				}
			})
			setTimeout(function(){ $('#friendSending').css({'opacity' : 0}); }, 2500);
			setTimeout(function(){ $('#friendSending').css({'top' : '-200px'}); }, 2800);
		}
	})
})

<!--                                    -->
<!--   T W I T T E R  F E T C H E R     -->
<!--                                    -->
var twitterFetcher=function(){function x(e){return e.replace(/<b[^>]*>(.*?)<\/b>/gi,function(c,e){return e}).replace(/class=".*?"|data-query-source=".*?"|dir=".*?"|rel=".*?"/gi,"")}function p(e,c){for(var g=[],f=RegExp("(^| )"+c+"( |$)"),a=e.getElementsByTagName("*"),h=0,d=a.length;h<d;h++)f.test(a[h].className)&&g.push(a[h]);return g}var y="",l=20,s=!0,k=[],t=!1,q=!0,r=!0,u=null,v=!0,z=!0,w=null,A=!0;return{fetch:function(e,c,g,f,a,h,d,b,m,n){void 0===g&&(g=20);void 0===f&&(s=!0);void 0===a&&(a=
!0);void 0===h&&(h=!0);void 0===d&&(d="default");void 0===b&&(b=!0);void 0===m&&(m=null);void 0===n&&(n=!0);t?k.push({id:e,domId:c,maxTweets:g,enableLinks:f,showUser:a,showTime:h,dateFunction:d,showRt:b,customCallback:m,showInteraction:n}):(t=!0,y=c,l=g,s=f,r=a,q=h,z=b,u=d,w=m,A=n,c=document.createElement("script"),c.type="text/javascript",c.src="//cdn.syndication.twimg.com/widgets/timelines/"+e+"?&lang=en&callback=twitterFetcher.callback&suppress_response_codes=true&rnd="+Math.random(),document.getElementsByTagName("head")[0].appendChild(c))},
callback:function(e){var c=document.createElement("div");c.innerHTML=e.body;"undefined"===typeof c.getElementsByClassName&&(v=!1);e=[];var g=[],f=[],a=[],h=[],d=0;if(v)for(c=c.getElementsByClassName("tweet");d<c.length;){0<c[d].getElementsByClassName("retweet-credit").length?a.push(!0):a.push(!1);if(!a[d]||a[d]&&z)e.push(c[d].getElementsByClassName("e-entry-title")[0]),h.push(c[d].getAttribute("data-tweet-id")),g.push(c[d].getElementsByClassName("p-author")[0]),f.push(c[d].getElementsByClassName("dt-updated")[0]);
d++}else for(c=p(c,"tweet");d<c.length;)e.push(p(c[d],"e-entry-title")[0]),h.push(c[d].getAttribute("data-tweet-id")),g.push(p(c[d],"p-author")[0]),f.push(p(c[d],"dt-updated")[0]),0<p(c[d],"retweet-credit").length?a.push(!0):a.push(!1),d++;e.length>l&&(e.splice(l,e.length-l),g.splice(l,g.length-l),f.splice(l,f.length-l),a.splice(l,a.length-l));c=[];d=e.length;for(a=0;a<d;){if("string"!==typeof u){var b=new Date(f[a].getAttribute("datetime").replace(/-/g,"/").replace("T"," ").split("+")[0]),b=u(b);
f[a].setAttribute("aria-label",b);if(e[a].innerText)if(v)f[a].innerText=b;else{var m=document.createElement("p"),n=document.createTextNode(b);m.appendChild(n);m.setAttribute("aria-label",b);f[a]=m}else f[a].textContent=b}b="";s?(r&&(b+='<div class="user">'+x(g[a].innerHTML)+"</div>"),b+='<p class="tweet">'+x(e[a].innerHTML)+"</p>",q&&(b+='<p class="timePosted">'+f[a].getAttribute("aria-label")+"</p>")):e[a].innerText?(r&&(b+='<p class="user">'+g[a].innerText+"</p>"),b+='<p class="tweet">'+e[a].innerText+
"</p>",q&&(b+='<p class="timePosted">'+f[a].innerText+"</p>")):(r&&(b+='<p class="user">'+g[a].textContent+"</p>"),b+='<p class="tweet">'+e[a].textContent+"</p>",q&&(b+='<p class="timePosted">'+f[a].textContent+"</p>"));A&&(b+='<p class="interact"><a href="https://twitter.com/intent/tweet?in_reply_to='+h[a]+'" class="twitter_reply_icon">Reply</a><a href="https://twitter.com/intent/retweet?tweet_id='+h[a]+'" class="twitter_retweet_icon">Retweet</a><a href="https://twitter.com/intent/favorite?tweet_id='+
h[a]+'" class="twitter_fav_icon">Favorite</a></p>');c.push(b);a++}if(null==w){e=c.length;g=0;f=document.getElementById(y);for(h="<ul>";g<e;)h+="<li>"+c[g]+"</li>",g++;f.innerHTML=h+"</ul>"}else w(c);t=!1;0<k.length&&(twitterFetcher.fetch(k[0].id,k[0].domId,k[0].maxTweets,k[0].enableLinks,k[0].showUser,k[0].showTime,k[0].dateFunction,k[0].showRt,k[0].customCallback,k[0].showInteraction),k.splice(0,1))}}}();


/*
* ### HOW TO CREATE A VALID ID TO USE: ###
* Go to www.twitter.com and sign in as normal, go to your settings page.
* Go to "Widgets" on the left hand side.
* Create a new widget for what you need eg "user timeline" or "search" etc. 
* Feel free to check "exclude replies" if you dont want replies in results.
* Now go back to settings page, and then go back to widgets page, you should
* see the widget you just created. Click edit.
* Now look at the URL in your web browser, you will see a long number like this:
* 345735908357048478
* Use this as your ID below instead!
*/
/**
 * How to use fetch function:
 * @param {string} Your Twitter widget ID.
 * @param {string} The ID of the DOM element you want to write results to. 
 * @param {int} Optional - the maximum number of tweets you want returned. Must
 *     be a number between 1 and 20.
 * @param {boolean} Optional - set true if you want urls and hash
       tags to be hyperlinked!
 * @param {boolean} Optional - Set false if you dont want user photo /
 *     name for tweet to show.
 * @param {boolean} Optional - Set false if you dont want time of tweet
 *     to show.
 * @param {function/string} Optional - A function you can specify to format
 *     tweet date/time however you like. This function takes a JavaScript date
 *     as a parameter and returns a String representation of that date.
 *     Alternatively you may specify the string 'default' to leave it with
 *     Twitter's default renderings.
 * @param {boolean} Optional - Show retweets or not. Set false to not show.
 * @param {function/string} Optional - A function to call when data is ready. It
 *     also passes the data to this function should you wish to manipulate it
 *     yourself before outputting. If you specify this parameter you  must
 *     output data yourself!
 * @param {boolean} Optional - Show links for reply, retweet, favourite. Set false to not show.
 */
twitterFetcher.fetch('370924910459109376', '', 1, true, false, false, '', false, handleTweets, false);
function handleTweets(tweets){
    var x = tweets.length;
    var n = 0;
    var element = document.getElementById('Get_Tweet');
    var html = '<ul>';
    while(n < x) {
      html += '<li>' + tweets[n] + '</li>';
      n++;
    }
    html += '</ul>';
    element.innerHTML = html;
}

// special video pop-up
/*function specialVid(opt){
	if(opt == 1){
		// show the special video
		var theHeight = window.innerHeight;
		var theWidth = window.innerWidth;
		if(theWidth > '1300'){
			var wid2 = 1280; var hgt2 = 720; }
		else {
			var wid2 = 720; var hgt2 = 480; }
		var wOFF = (theWidth/2)-(wid2/2);
		var hOFF = (theHeight/2)-((hgt2/2)+65);
		$('#special').css({'width':theWidth,'height':theHeight,'padding-left':wOFF});
		//$('#specVid').html("<iframe id='ytplayer' type='text/html' src='http://www.youtube.com/embed/j29BsMNg29g?autoplay=1&rel=0&vq=720' width='"+wid2+"' height='"+hgt2+"' frameborder='0'></iframe>");
		$('#specVid').html("<iframe id='ytplayer' type='text/html' src='http://www.youtube.com/embed/3bKNZb1Lvxg?autoplay=1&rel=0&vq=729' width="+wid2+" height="+hgt2+" frameborder='0'></iframe>");
		setTimeout(function(){
			$('#special').css({'width':theWidth,'height':theHeight,'opacity':1});
			$('#ytplayer').css({'opacity': 1});
			$('#specHead').css({'width':wid2,'marginTop': hOFF});
			$('#specVid').css({'height':hgt2}); 
			$('#specFoot').css({'width':wid2});
		}, 700)
	} else if(opt == 2){
		// hide the special video
		$('#special').css({'opacity':0});
		if($('#noVid').is(':checked')){ document.cookie="noVid; expires=Fri, 31 Jan 2014 12:00:00 GMT"; }
		setTimeout(function(){
			$('#special').css({'width':0,'height':0,}).html('');
		})
	}
}*/

function onYouTubePlayerAPIReady() {
		var theHeight = window.innerHeight;
			var theWidth = window.innerWidth;
			if(theWidth > '1300'){
				var wid2 = 1280; var hgt2 = 720; }
			else {
				var wid2 = 720; var hgt2 = 480; }
				
		player = new YT.Player('specVid', {
		  height: hgt2,
		  width: wid2,
		  videoId: '3bKNZb1Lvxg',
		  events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		  }
		});
	}


// autoplay video
function onPlayerReady(event) {
	event.target.playVideo();
}

function specialVid(opt){
	if(opt == 2){
	$( "#special" ).hide();
	$('#special').css({'opacity':0});
		if($('#noVid').is(':checked')){ document.cookie="noVid; expires=Fri, 31 Jan 2014 12:00:00 GMT"; }
		setTimeout(function(){
			$('#special').css({'width':0,'height':0,}).html('');
		}) 
	} else if(opt == 1) {
		var theHeight = window.innerHeight;
		var theWidth = window.innerWidth;
		if(theWidth > '1300'){
			var wid2 = 1280; var hgt2 = 720; }
		else {
			var wid2 = 720; var hgt2 = 480; }
		var wOFF = (theWidth/2)-(wid2/2);
		var hOFF = (theHeight/2)-((hgt2/2)+65);
		$('#special').css({'width':theWidth,'height':theHeight,'padding-left':wOFF});
		//$('#specVid').html("<iframe id='ytplayer' type='text/html' src='http://www.youtube.com/embed/j29BsMNg29g?autoplay=1&rel=0&vq=720' width='"+wid2+"' height='"+hgt2+"' frameborder='0'></iframe>");
		setTimeout(function(){
			$('#special').css({'width':theWidth,'height':theHeight,'opacity':1});
			$('#ytplayer').css({'opacity': 1});
			$('#specHead').css({'width':wid2,'marginTop': hOFF});
			$('#specVid').css({'height':hgt2}); 
			$('#specFoot').css({'width':wid2});
		}, 700)	
	} 
}
// when video ends
function onPlayerStateChange(event) {        
	if(event.data === 0) { 
		$( "#special" ).hide();           
	}
}

<!--                          -->
<!--  SPECIAL MESSAGE POP-UP  -->
<!--                          -->
function msgPOP(status){
	if(status == 1){
		var theHeight = window.outerHeight;
		setTimeout(function(){
			$('#bgDimmer').css({'width':'100%','height':theHeight,'opacity':1});
			$('#theMSG').css({'top':'100px'});},700);
	} else {
		$('#bgDimmer').css({'opacity':0});
		$('#theMSG').css({'top':'-500px'});
		setTimeout(function(){
			$('#bgDimmer').css({'width':0,'height':0});
			if(status == 3){ window.location.href='http://www.qepcorporate.com/files/news/PR_FausAcquisition.pdf';}},300);
	}
}
