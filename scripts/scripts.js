var isItIE = -1;
var currAlbId = 0;

function onLoadEvents(uname, ipaddr)
{
	window.onresize = function () {resizeMe();};
	isItIE = getInternetExplorerVersion();

	
	registerForms(uname, ipaddr);
	configScrollBar();
	
	if(isItIE == -1)
	{
		resizeMe();
		configSmoothScrolling();
	}	
	showUserCP();
	resetAllAlbums();
}

function adminInit()
{
	window.onresize = function () {resizeMe();};
	isItIE = getInternetExplorerVersion();
	
	registerAdminForms();
	configScrollBar();
	
	if(isItIE == -1)
	{
		resizeMe();
		configSmoothScrolling();
	}	
}
	
function pollLoadEvents()
{
	window.onresize = function () {resizeMe();};
	isItIE = getInternetExplorerVersion();
	if(isItIE == -1)
	{
		resizeMe(); 
    }		
}
	
function configScrollBar()
{	
	$("#lnd").mCustomScrollbar(
									{
										theme:"light-thick",
										mouseWheel:true, 
										mouseWheelPixels:300,
										scrollButtons:{
												enable:true,
												scrollType:"continuous",
												scrollSpeed:120,
												scrollAmount:300
										},
										advanced:{
											updateOnBrowserResize:true,
											updateOnContentResize:true
										}
									}
								);	
}

function closeUserInfoForm()
{
	$("#uis").css("display", "none");
}

function registerForms(uname, ipaddr)
{
	$("#uif").submit(function(event) {
	 
	  /* stop form from submitting normally */
	  event.preventDefault();
	  
	  /* get some values from elements on the page: */
	  var $form = $( this ),
		  name  = $form.find( 'input[name="name"]' ).val(),
		  email = $form.find( 'input[name="email"]' ).val(),
		  url = $form.attr( 'action' );
	  
	  /* Validate the form */
	  if((name == "") || (name == " ") || (name == "Name... (Req)"))
	  {
		alert("A Valid Name is required....");
	  }
	  else if((email == "") || (email == " ") || (email == " Enter Your Wishes in Our Guestbook... "))
	  {
		alert("A Valid email is required....");
	  }
	  else
	  {
		var posting = $.post( url, { name: name, email: email, uname: uname, ipaddr: ipaddr }, null);
	 
		/* Put the results in a div */
		posting.done(function( data ) 
		{
			postResponse(data);
			$("#wun").html(name);
			showUserCP();
		});
	  }
	});
}

function registerAdminForms()
{	
	for(i=0;i<37;i++)
	{
		  var divId = "#evt" + i + "Form";
		  
		  $(divId).submit(function(event) {
	 
		  /* stop form from submitting normally */
		  event.preventDefault();
		  
		  /* get some values from elements on the page: */
		  var $form = $( this ),
			  name  = $form.find( 'input[name="name"]' ).val(),
			  email = $form.find( 'input[name="email"]' ).val(),
			  groupname = $form.find( 'input[name="groupname"]' ).val(),
			  evtId = $form.find( 'input[name="evtId"]' ).val(),
			  url = $form.attr( 'action' );
	  
		  /* Validate the form */
		  if((name == "") || (name == " ") || (name == "Name... (Req)"))
		  {
			alert("A Valid Name is required....");
		  }
		  else
		  {
			var posting = $.post( "reg.php", { evtId: evtId, set: 1, name: name, ipaddr: "", groupId: 0, groupName: groupname, admin:1, email: "" }, null);
			 
			/* Put the results in a div */
			posting.done(function( data ) 
			{
				divId = "#evt" + evtId + "table";
				$(divId).html(data);
				setTimeout(function () {registerAdminForms();}, 100);
			});
		  }
		});
	}
}

function postResponse(data)
{
	setTimeout(function () {closeUserInfoForm();}, 1200);
	$("#uis").css("opacity", "0.5");
	$("#uifd").css("textAlign", "center");
	$("#uifd").html(data);
}

function postRegInfo(admin, evtId, regUnreg, name, ipaddr, groupId, groupName, divId)
{
	/* Get group Values */
	var ipId  = "evt" + evtId + "GroupId";
	var ipObj = document.getElementById(ipId);
	if(ipObj) { groupId = ipObj.value; }
	ipId = "evt" + evtId + "GroupName";
	ipObj = document.getElementById(ipId);
	if(ipObj) { groupName = ipObj.value; }
	
	/* Post the data */
	var posting = $.post( "reg.php", { evtId: evtId, set: regUnreg, name: name, ipaddr: ipaddr, groupId: groupId, groupName: groupName, admin:admin }, null);
	 
	/* Put the results in a div */
	posting.done(function( data ) 
	{
		$(divId).html(data);
		if(admin == 1) { setTimeout(function () {registerAdminForms();}, 100); }
		else { showUserCP();}
	});
}

/* Resize the fonts according to the size of the browser window */
function resizeMe()
{
    //Standard height, for which the body font size is correct
    var preferredHeight = 864; 
    var preferredWidth = 1152; 
    var fontsize = 15;

    var displayHeight = $(window).height();
    var displayWidth  = $(window).width();
    var percentageH   = ((displayHeight) / preferredHeight);
    var percentageW   = ((displayWidth) / preferredWidth);
    //var percentage    = ((percentageH > percentageW)?(percentageW):(percentageH))
	var percentage = (percentageH + percentageW)/2;
    var newFontSize   = Math.floor(fontsize * percentage);
	/* var newWidth      = (((preferredWidth)*(displayHeight)) / (preferredHeight));
	
	$("html").css("width", newWidth);
	$("body").css("width", newWidth);
	$(window).width(newWidth);
	var t = $(window).width(); */
	
    $("body").css("font-size", newFontSize); 
	
	var bt = document.getElementById("bmtxt");
	
	if(bt)
	{
		if(displayHeight < 270)
		{
			bt.style.display = "none";
		}
		else
		{
			bt.style.display = "block";
		}
	}
}

function getInternetExplorerVersion()
{
   var rv = -1; 
   
   if (navigator.appName == 'Microsoft Internet Explorer')
   {
      var ua = navigator.userAgent;
      var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
      if (re.exec(ua) != null)
         rv = parseFloat( RegExp.$1 );
   }
   
   return rv;
}

function configSmoothScrolling()
{
$(document).ready(function() {
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');
 
  $('a[href*=#]').each(function() {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target) {
        var targetOffset = $target.offset().top;
        $(this).click(function(event) {
          event.preventDefault();
		  $(scrollElem).clearQueue();
          $(scrollElem).animate({scrollTop: targetOffset-30}, 690, function() {
            //location.hash = target;
          });
        });
      }
    }
  });
 
  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }
 
});
}

function submitQODAnswer(id, name, ipaddr)
{
	/* Get group Values */
	var ans = "TBD";
	
	var ipObj = document.getElementById("qOfDay");
	if(ipObj) { ans = ipObj.value; }
	
	if((ans == "") || (ans == " "))
	{
		alert("A Valid answer is required....");
	}
	else
	{
		/* Post the data */
		var posting = $.post( "qod.php", { qid: id, name: name, ipaddr: ipaddr, ans:ans }, null);
		 
		/* Put the results in a div */
		posting.done(function( data ) 
		{
			$("#qodDiv").html(data);
			showUserCP();
		});
	}
}

function voteFor(evtId, imgName, authName, vid, bid)
{
	/* Post the data */
	var posting = $.post( "vote.php", { evtId: evtId, imgName: imgName, authName: authName}, null);
	 
	$('.' + bid).css("display", "none");
	 
	/* Put the results in a div */
	posting.done(function( data ) 
	{
		$('.' + vid).css("display", "block");
	});
}

function showUserCP()
{
	/* Post the data */
	var posting = $.post( "usercp.php", {  }, null);
	 
	/* Put the results in a div */
	posting.done(function( data ) 
	{
		$("#userCPFrame").html(data);
	});
}

function resetAllAlbums()
{
	var i = 0;
	
	while(1)
	{
		var currAlb     = "alb" + i;
		var currAlbName = "albName" + i;
		var cA          = document.getElementById(currAlb);
		var cAN         = document.getElementById(currAlbName);
	
		if(cA)
		{
			$("#" + currAlb).slideUp(300, function() {
				
			});
		}
		else
		{
			break;
		}
		if(cAN)
		{
			cAN.src = "images/da.png"
		}
		i++;
	}
	
	
	$("#alb0").slideDown(300, function() { configSmoothScrolling(); });
}

function switchAlbums(nextAlbId)
{
	var currAlb     = "alb" + currAlbId;
	var currAlbName = "albName" + currAlbId;
	var cA          = document.getElementById(currAlb);
	var cAN         = document.getElementById(currAlbName);
	
	if(cA)
	{
		$('#' + currAlb).slideUp(1500, function() {
			
		});
		
		if(cAN)
		{
			cAN.src = "images/da.png"
		}
		
		var nextAlb     = "alb" + nextAlbId;
		var nextAlbName = "albName" + nextAlbId;
		var nA          = document.getElementById(nextAlb);
		var nAN         = document.getElementById(nextAlbName);
		
		if(nA)
		{
			$('#' + nextAlb).slideDown(1500, function() { configSmoothScrolling(); });
		}
		
		if(nAN)
		{
			nAN.src = "images/ua.png"
		}
		
		currAlbId = nextAlbId;
	
	}
}