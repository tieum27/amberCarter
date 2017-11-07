<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Lang" content="en" />
<meta name="author" content="Matthieu Tripoli" />
<meta name="description" content="Financial Advisor" />
<meta name="keywords" content="Insurance, Securities, Senior Advisor, Life Insurance, Financial Advisor, investments, retirement" />

<title>WJC William James Carter</title>

<script language="javascript" src="banner/inc/jquery-1.3.2.js"></script>
<script language="javascript" src="banner/inc/jquery.pngFix.js"></script>
<script language="javascript" src="banner/inc/jquery.backgroundPosition.js"></script>
<script language="javascript" src="banner/inc/jquery.easing.compatibility.js"></script>
<script language="javascript" type="text/javascript">

/********************************************************************************|
 # This copyright notice must be kept untouched in the stylesheet at all times.  |
 # The original version of this script and the associated (x)html                |
 # is available at http://www.encodez.com/                                       |
 # Copyright (c) 2009 Encodez Systems. All rights reserved.                      |
 # ------------------------------------------------------------------------------|
 # This script and the associated (x)html may be modified in any                 | 
 # way to fit your requirements.                                                 |
 #                                                                               | 
 # DYNAMIC MULTI TRANSITION BANNER                                               |                                                                              |
 # Author       : MUNEER SAHEED                                                  |
 # Released on  : 16 June 2009                                                   |
 # Version      : 1.0.0                                                          |
 # Website      : http://www.encodez.com/                                        |
 # Contact      : muneer AT encodez DOT c o m                                    |
 #-------------------------------------------------------------------------------|
 *
 *
 *
 * Properties
 * Following properties of can be editable according to
 * the final result expected.
 *
 * width of the banner
 * If changing this varibale, please do not forget to change
 * the CSS 
 * I    "#bannerTD"
 * II   "#bannerContainer"
 * III  "#bannerFooter"
 * IV   "#bannerFooterNav"
 */ 
var encBannerWidth = 900;

/*
 * This peroperty describes how the banner transition will be
 * The option availbale are
 * I    "slide"         - This slides the banner from left to right.
 * II   "slideDown"     - This slides the banner from top to bottom.
 * III  "fade"          - This makes the banner fade in/fade out.
 */
var encTransitionType = "slide";

/*
 * Describes the number of background images and thumbnail images
 * are there. 
 * Recomended values are 3 or 4
 * Can be 1 to max possible according to the width of banner.
 */
var encNumOfImages = 3;

/*
 * This array contains the path to large version of background images.
 * Path can be configured according to the user path.
 * Arrange the images in order. This order will be executed while processing.
 */
var encImageArray = new Array("banner/img/frontBanner/large/boat.jpg", "banner/img/frontBanner/large/bridge.jpg", "banner/img/frontBanner/large/building.jpg", "banner/img/frontBanner/large/port.jpg");

/*
 * This array contains the path to thumbnail version of background images.
 * Path can be configured according to the user path.
 */
var encThumbNailImageArray = new Array("banner/img/frontBanner/thumb/boat.png", "banner/img/frontBanner/thumb/bridge.png", "banner/img/frontBanner/thumb/building.png", "banner/img/frontBanner/thumb/port.png");

/*
 * This property describes the transition of the banner.
 * If it is set to true, the banner will automatically change according to the Timeout
 * value. The selected transition type will be applied while auto transition.
 */
var encAutoRotateBanner = true;

/*
 * Transition timeout.
 */
var encAutoRotateTimeout = 5000;

/*
 * Enable or disable description footer containing thumbnail image.
 * If this is set to true, the properties "encDisableTextsAll", "encEnableThumbImageLink",
 * "encEnableDescription", "encEnableReadMore" will not be executed.
 */
var encEnableFooter = true;

/*
 * Disable all text from the footer
 * except the thumbnail image. This will make possible to 
 * maximise the number of thumbnail image using variable "encNumOfImages".
 */
var encDisableTextsAll = false;

/*
 * Enable/disable link for thumbnail click event.
 */
var encEnableThumbImageLink = true;

/*
 * Enable/disable description in footer
 */
var encEnableDescription = true;

/*
 * Enable/disable readmore button in footer.
 * read more button is described using ".bttnMore" class
 */
var encEnableReadMore = true;

/*
 * This array contains the contents used in footer.
 * The sample values can be changed,
 * the array size can be altered according to the need.
 * It contains
 * I    Title
 * II   Description
 * II   Link
 * If wanted to remove the link only for a single item, just remove the value.
 */
var encBannerTexts = new Array(4);

encBannerTexts[0] = new Array(3);
encBannerTexts[0][0] = "Platinum";
encBannerTexts[0][1] = "";
encBannerTexts[0][2] = "platinum.htlm";

encBannerTexts[1] = new Array(3);
encBannerTexts[1][0] = "Silver";
encBannerTexts[1][1] = "";
encBannerTexts[1][2] = "silver.html";

encBannerTexts[2] = new Array(3);
encBannerTexts[2][0] = "Gold";
encBannerTexts[2][1] = "";
encBannerTexts[2][2] = "gold.html";

encBannerTexts[3] = new Array(3);
encBannerTexts[3][0] = "STAY CONNECTED";
encBannerTexts[3][1] = "Keep in touch 365 days with us.";
encBannerTexts[3][2] = "http://www.msn.com";

/*
 * STOP !
 * WARNING !!!!
 * pLease do not change the below variables.
 * Thosea are private variables and used for runtime configuration
 */
var encBusy = false;
var encCurrentBanner = -1;
var encImg = new Array(encNumOfImages);
var encThumbs = new Array(encNumOfImages);
/*
 *  THANK YOU for leaving them.
 */


/*
 * The "encLoadBanner()" is the main function to start the banner.
 * It can be placed inside "$(document).ready(function()" jquery document ready
 * funciton or inside the "onload=function()" javascript document onload function.
 * both will work. The advantage of placing inside "onload=function()" is, 
 * the banner image will be loaded after the complete website rendered in to browser.
 */
onload=function()
{
    encLoadBanner();
}

encLoadBanner = function()
{
    encImg = encPreloadImages(encImageArray, encNumOfImages);
    if(encEnableFooter)
    {
        encThumbs = encPreloadImages(encThumbNailImageArray, encNumOfImages);        
    }
    
    $("#bannerBody").html("");
    
    $("div#bannerContainerCover").css("background-image", "url(" + encImg[encImg.length-1].src + ")");
    encTransformBanner(0);
    
    if(encEnableFooter)
    {
        var tmpCellWidth = Math.floor(encBannerWidth/encNumOfImages);
        var tmpLastCellWidth = tmpCellWidth + (encBannerWidth%encNumOfImages);
        
        var footerContents = "<table cellpadding='0' cellspacing='0' width='" + encBannerWidth + "' align='center'><tr>";
        for(i=0; i<encNumOfImages; i++)
        {
            if((i+1) == encNumOfImages)
                footerContents += "<td class='footerCell' width='" + tmpCellWidth + "'>";
            else
                footerContents += "<td class='footerCell' width='" + tmpLastCellWidth + "'>";
                
            footerContents += "<div class='imgBgDiv_i'><div id='thumbDiv_" + i + "' class='imgDiv' style='background:url(" + encThumbs[i].src + ") 0px 0px no-repeat;'></div></div>";
            footerContents += "<ul id='footerContents_" + i + "'>";
            footerContents += "<li class='footerTitle'></li>";
            footerContents += "<li class='footerDesc'></li>";
            footerContents += "<li class='footerLink'></li>";
            footerContents += "</ul>";
            footerContents += "</td>";
        }
        footerContents += "</tr></table>";
        $("#bannerFooterNav").html(footerContents);
        $("#bannerFooter").fadeTo("fast", 0.4);
        showFooter();
        $(".imgDiv").fadeTo("fast", 0.75);
    }
    
    
    if(! encDisableTextsAll && encEnableFooter)
    {
        for(i=0; i<encNumOfImages; i++)
        {
            $(".footerTitle:eq(" + i + ")").html(encBannerTexts[i][0]);
            if(encEnableDescription) $(".footerDesc:eq(" + i + ")").html(encBannerTexts[i][1]);
            if(encBannerTexts[i][2] != "" & encEnableReadMore)
            {
                $(".footerLink:eq(" + i + ")").html("<div class='bttnMore'><a href='" + encBannerTexts[i][2] + "'>&nbsp;</a></div>");
            }
        } 
    }
    
    if(encEnableThumbImageLink && encEnableFooter)
    {
        for(i=0; i<encNumOfImages; i++)
        {
            link = encBannerTexts[i][2];
            $("#thumbDiv_" + i).attr("onclick", "window.location.href='" + link + "'")
        }
    }
    
    if(encEnableFooter)
    {
        a=0;
        $(".imgDiv").each(function()
        {
            var ids = a;
            $(this).mouseover(function()
            {
                $(this).fadeTo("fast", 1);
                var cssObj = {"margin-top": "0px", "margin-bottom": "2px"}
                $(this).css(cssObj);
                encBusy = true;
                encTransformBanner(ids);
                $(document).pngFix();
            })
            a++;
        }).mouseout(function() {
           $(this).fadeTo("fast", 0.75);
           var cssObj = {"margin-top": "2px", "margin-bottom": "0px"}
           $(this).css(cssObj);
           encBusy = false;
           $(document).pngFix();
        });
        
        $(document).pngFix(); 
    }
    
    if(encAutoRotateBanner)
    {
        var tmpBannerTimer = setTimeout("encAutorotate(0)", encAutoRotateTimeout);
    }
}

showFooter=function()
{
    $("div#bannerFooter").animate({ width: '900px', opacity: '0.5' }, 'slow');
}

encTransformBanner = function(ids)
{
    encCurrentBanner = ids;
    var currentBg = $("div#bannerContainerCover").css("background-image");
    $("div#bannerContainer").css("background-image", currentBg);
    
    var cssObj = {"opacity": "0.1", "background-repeat": "no-repeat", "background-image": "url(" + encImg [ids].src + ")"}
    $("div#bannerContainerCover").css(cssObj);
    
    if(encTransitionType == "slide")
    {     
        $("div#bannerContainerCover").css("background-position", "-50px 0");                
        $("div#bannerContainerCover").stop().animate({backgroundPosition:"(0 0)", opacity:"1"}, {duration:600});
    }    
    else if(encTransitionType == "slideDown")
    {      
        $("div#bannerContainerCover").css("background-position", "0 -50px");                
        $("div#bannerContainerCover").stop().animate({backgroundPosition:"(0 0)", opacity:"1"}, {duration:600});
    }
    else
    {      
        $("div#bannerContainerCover").stop().animate({opacity:"1"}, {duration:1000});
    }
}

encAutorotate = function(bannerID)
{
    if(encCurrentBanner > -1)
    {
        bannerID = encCurrentBanner;
        encCurrentBanner = -1;
    }
    
    if(!encBusy)
    {
        if(bannerID < (encNumOfImages-1) && bannerID >= 0)
            bannerID++;
        else
            bannerID =0;
            
        encTransformBanner(bannerID);
    }
    
    var tmpBannerTimer = setTimeout("encAutorotate(" + bannerID + ")", encAutoRotateTimeout);
}

encPreloadImages = function(images, size)
{
    var tmpArray = new Array(size);
    for(i=0; i<size; i++)
    {
        tmpArray[i]      = new Image;
        tmpArray[i].src  = images[i];
    }
    return tmpArray;
}

</script>

<style>
body {text-align:center; margin:0;}

#logoPart {height:90px;}

#bannerTD { width:900px; height:325px; background-color:#333; background-repeat: no-repeat;}
#bannerTD #bannerContainer { width:900px; height:325px; text-align:center;}
#bannerTD #bannerContainerCover { width:900px; height:325px; text-align:center;}
#bannerTD #bannerBody { height:245px; text-align:center;}

#bannerTD #bannerFooter {     
    background:#000000; height:80px; 
    display:none; 
    width:900px;
}
#bannerTD #bannerFooterNav { 
    position:absolute;
    top:335px;margin-top:0;
    left:50%;margin-left:-450px;
    width:900px;
}
.footerCell{ padding:5px; text-align:left; border:0px #F90 solid;}
.footerCell .footerTitle {font-family:tahoma, arial; font-size:11px; color:#fff; font-weight: bold;}
.footerCell .footerDesc {font-family:tahoma, arial; font-size:11px; color:#efefef;}
.footerCell ul {list-style: none; margin: 2px; margin-left: 75px; padding-left: 10px;}
.footerCell ul li {margin: 2px; line-height: 13px; padding: 0;}
.footerLink {text-align: right;}

.footerCell .imgDiv{ position:relative; float:left; width:80px; height:65px; margin: 2px 1px 0px 1px;}
.bttnMore {width:57px; height:19px; float: right;}
.bttnMore a{display: block; background:url(banner/img/gen/bttn_more_small.png) 0 0 no-repeat; line-height: 19px; text-decoration: none;}

.imgBgDiv_i {
    width:82px; height:67px;
    background: url(banner/img/gen/thumbBgBordered.png) 0 0 no-repeat;
    padding: 0;
    float:left;
}


#bannerCornerOverlayT{position:absolute; left:50%; margin-top:0; margin-left:-450px; top:90px; background:url(banner/img/gen/bg_bigbanner_trans.gif) 0 -5px no-repeat; width:900px; height:5px; z-index:1000;}
#bannerCornerOverlayB{position:absolute; left:50%; margin-top:0; margin-left:-450px; top:410px; background:url(banner/img/gen/bg_bigbanner_trans.gif) 0 0 no-repeat; width:900px; height:5px; z-index:1001;}


</style>

<link rel="stylesheet" href="assets/css/styles.css" />
<link rel="stylesheet" type="text/css" href="slidelogin/demo.css" media="screen" />
<link rel="stylesheet" type="text/css" href="slidelogin/login_panel/css/slide.css" media="screen" />

<!-- PNG FIX for IE6 -->
<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
<!--[if lte IE 6]>
    <script type="text/javascript" src="slidelogin/login_panel/js/pngfix/supersleight-min.js"></script>
<![endif]-->

<script src="slidelogin/login_panel/js/slide.js" type="text/javascript"></script>

</head>

<body>

<div id="bannerCornerOverlayT"></div>
    <div id="bannerCornerOverlayB"></div>
        <table cellpadding="0" cellspacing="0" width="900" align="center">
                <tr>
                	<td>
                    <table align="center">
                     <tr>	
                           <td width="75" align="left" id="logoPart">
                           <a href="index.html"><img src="img/logo_ini_rnd.gif" border="0" alt="logo" align="absmiddle" /></a>
                           </td>
                           <td width="100"></td>                     
                           <td width="555">
                                <nav>
                                    <ul class="fancyNav">
                                        <li id="home"><a href="index.html" class="homeIcon">Home</a></li>
                                        <li id="news"><a href="about.html" class="homeIcon1">About WJC</a></li>
                                        <li id="about"><a href="careers.html" class="homeIcon2">Careers</a></li>
                                        <li id="services"><a href="contact.php" class="homeIcon3">Contact Us</a></li>
                                        <li id="contact"><a href="login.php" class="homeIcon4">Log on</a></li>
                                    </ul>
                                </nav>
                        </td>
                       </tr>
                     </table>
                    </td>
                </tr>
                <!-- ______________________ BANNER ___________________-->
                <tr>
                    <td id="bannerTD" bgcolor="#FFFFFF">
                    <div id="bannerContainer">
                        <div id="bannerContainerCover">
                            <div id="bannerBody"><img src="banner/img/gen/loading_animation.gif" border="0" alt="Loading..." />
                            </div>
                            <div id="bannerFooter">    
                            </div>
                        </div>
                    </div>
                     <!-- ________________ NAVIGATOR ___________________ -->
                    <div id="bannerFooterNav">
                    </div>
                     <!-- ________________ /NAVIGATOR ___________________ -->
                    </td>
                </tr>
                <!-- ______________________ /BANNER ___________________-->
        </table>
<table>
	<tr>
    	<td>

       </td>
    </tr>
</table>

</body>
</html>
