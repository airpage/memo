


function myRecentListShow()
{	
	
	showElement("myRecentList", true);
		
	return false;
}

function myRecentListHide()
{	
	
	showElement("myRecentList", false);
		
	return false;
}

function myHide()
{	
	
	showElement("myInputForm", false);
		
	return false;
}
	
function book_address(url) 
{
	prompt ("아래의 주소를 Ctrl + C를 눌러 복사하세요!",url);
}

	
function mymove(e) 
{
	
	var x1, x2, y1, y2;
	var xCoord, yCoord;
	var myData;
	
  if(e){
		x1 = e.pageX ; 
 		x2 = 0; 
 		y1 = e.pageY;
 		y2 = 0;
	}	
	else
	{
		x1 = window.event.clientX ; 
 		x2 = document.body.scrollLeft ;
 
 		y1 = window.event.clientY;
 		y2 = document.body.scrollTop ;
 	}
  
  	xCoord = x1 + x2;
  	yCoord = y1 + y2;
	
	myData = document.getElementById("overDiv");			
	

	myData.innerHTML = "<font class=myLayerText>&nbsp;&nbsp;x:" + xCoord + " y:" + yCoord +  "&nbsp;&nbsp;</font>";		
	
	myData.style.top  = yCoord + 50;
 	myData.style.left = xCoord + 80;	
}

function FocusElement(id) {
  (document.getElementById(id) || document.all[id]).subject.focus();    
}

function showElement(id, w) {
  (document.getElementById(id) || document.all[id]).style.visibility = ((typeof w !== "undefined"  && !w) ? "hidden" : "");    
}


function post_s(href, parm) {
      $.post(href, parm, function(req) {      	            	      
	      $(req).appendTo("body");             
	      var f = document.toForm;
	      f.subject.value = '';
	      f.name.value = '.';
	      showElement("myInputForm", false);
	      $('#latestFrame').attr("src", $('#latestFrame').attr("src"));
    });  
}


function enter_key() {
  if (event.keyCode == 13)  
  {
     f_submit(); 
  }
}


function myclipboard_trackbackd(strd) 
{	
    window.clipboardData.setData('Text', strd);
    alert('낙서의 단축 주소가 복사되었습니다.\n\n' + strd + ' ');    
}


function myScroll(MMx, MMy)
{
	self.scrollTo(MMx, MMy);
}



function gd_submit(f) {
  
  if(f.x.value==""){
       alert("x 좌표를 입력해주5.");
		f.x.focus();
		return false;
  }
  
  if(f.y.value==""){
       alert("y 좌표를 입력해주5.");
		f.y.focus();
		return false;
  }
    
 //f .action = "$gCGI_URL";
  f.submit();
  
  return false;
}


//bit_url function
function bit_url(murl) 
{ 	
	$.ajax({
	url:"memo.php?action=shorturl&longurl=" + encodeURIComponent(murl),	
	success:function(obj)
	{ 		
		var v = eval("("+obj+")");		
		var bit_url=v.data.url;
		$("#result").html('<a onClick=book_address("' + bit_url + '");><font size=2 face=arial color=#0000ff><b>'+bit_url+'</b></font></a>');			
		$("#fblikeblock").html('<font size=2 face=돋움 color=#885555><b>이 낙서가</b></font><fb:like href="' + bit_url + '" send="false" width="120" layout="button_count" show_faces="false"></fb:like>');
		FB.XFBML.parse(document.getElementById('fblikeblock'));
	}

	});
}






function getUrl(url)
{
var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
var urltest=urlRegex.test(url);
if(urltest)
{
	bit_url(url);
}
else
{
 //alert("Bad URL");
}
}




 if (typeof document.compatMode!='undefined'&&document.compatMode!='BackCompat'){
	fixData_DOC="_top:expression(document.documentElement.scrollTop +document.documentElement.clientHeight-this.clientHeight);_left:expression (document.documentElement.scrollLeft + document.documentElement.clientWidth - offsetWidth);}";
 } else {
    fixData_DOC="_top:expression(document.body.scrollTop+document.body.clientHeight- this.clientHeight);_left:expression(document.body.scrollLeft + document.body.clientWidth -  offsetWidth);}";
 }

 
 var recentData_DOC_FIXED_CSS='#myRecentList{position:fixed;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'_position:absolute;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'z-index:8;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'width:120px;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'text-align:center;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'bottom:0px;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+'left:0px;';
 var recentData_DOC_FIXED_CSS=recentData_DOC_FIXED_CSS+fixData_DOC;
 document.write('<style type="text/css">'+recentData_DOC_FIXED_CSS+'</style>');
 
 
 
//function mD(delNo)
//{			
//	self.location = '?id=$FORM{id}&l=' + delNo + '&action=users_login';
//}



var bIsfirst = 1;
var yPosBefore;
var xPosBefore;
 	
 //select all the a tag with name equal to modal
	
 
$(document).ready(function() {							
		$('#myMobileButton4').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();								
			if($("input:checkbox[id='myNotice']").is(":checked") == true)
			{							       	         
				closeWinAt00('dialogM', 1);
			}
			
			$('.window').hide();						                  	         	         		        
		});		
		
		activatePlaceholders();		
});


function hideMe()
{	
	$('.window').hide();	
}
	
function showMyMessage(x, y) {																
   var blnCookie	= getCookie( 'dialogM' );   
   if( !blnCookie ) {
	   //obj.style.display = "block";
	   	$("#dialogM").css('top', y);
		$("#dialogM").css('left', x);		
		//transition effect
		$("#dialogM").fadeIn(2000);		
   }
}

 
function f_submit(msUrl) {
  var f = document.toForm;
  
  if(f.subject.value=="" || f.subject.value == "무얼 상상하세요?")    
  {
       alert("내용을 입력해 주세요.");
		f.subject.focus();
		return false;
  }  
  
  //if(f.passwd.value=="") {
  //  alert("비번을 입력해 주세요.");
//		f.passwd.focus();
//		return false;
//  }
  
  
  //if(f.name.value=="") {
    //alert("이름를 입력해 주세요.");
		//f.name.focus();
		//return false;
  //}
  
 
  post_s(msUrl, {'x':'' + xPosBefore + '', 'y':'' +  yPosBefore + '','subject' : '' + f.subject.value + '', 'id': '' + f.id.value + '', 'name' : ''  + f.name.value + '','action':'write'});    
   
  refreshPage(msUrl, f.id.value, xPosBefore, yPosBefore);
  return false;
}

function refreshPage(msUrl, id, x, y)
{
	//alert("??");
    //$.changePage(msUrl + '?id=' + id + '&x=' + x + '&y=' + y , { transition: "slideup", changeHash: false });
    window.location.href = msUrl + '?id=' + id + '&x=' + x + '&y=' + y;
}

function ismaxlength(obj){
	var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
	if (obj.getAttribute && obj.value.length>mlength)
	obj.value=obj.value.substring(0,mlength);
}


function activatePlaceholders() {

	var detect = navigator.userAgent.toLowerCase(); 
	if (detect.indexOf("safari") > 0) return false;
	var inputs = document.getElementsByTagName("textarea");
	for (var i=0;i < inputs.length;i++) {
		if(inputs[i].getAttribute("placeholder") == "무얼 상상하세요?") 
		{	    
				    inputs[i].value = inputs[i].getAttribute("placeholder");
				    inputs[i].style.color = '#cccccc';
				    
				 
				    inputs[i].onclick = function() {
				     if (this.value == this.getAttribute("placeholder")) {
				      this.value = "";
				      this.style.color = "#000000";
				     }
				     return false;
				    }
				    
				    inputs[i].onblur = function() {
				     if (this.value.length < 1) {
				      this.value = this.getAttribute("placeholder");
				      this.style.color = '#cccccc';
				     }
				    }	    
	   }
  }	
}


// 출처 http://rocabilly.tistory.com/98
function openWin( winName ) {
   var blnCookie	= getCookie( winName );
   var obj = eval( "window." + winName );
   if( !blnCookie ) {
	   obj.style.display = "block";
   }
}

// 창닫기
function closeWin(winName, expiredays) { 
   setCookie( winName, "done" , expiredays); 
   var obj = eval( "window." + winName );
   obj.style.display = "none";
}
function closeWinAt00(winName, expiredays) { 
   setCookieAt00( winName, "done" , expiredays); 
   var obj = eval( "window." + winName );
   obj.style.display = "none";
}

// 쿠키 가져오기
function getCookie( name ) {
   var nameOfCookie = name + "=";
   var x = 0;
   while ( x <= document.cookie.length )
   {
	   var y = (x+nameOfCookie.length);
	   if ( document.cookie.substring( x, y ) == nameOfCookie ) {
		   if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
			   endOfCookie = document.cookie.length;
		   return unescape( document.cookie.substring( y, endOfCookie ) );
	   }
	   x = document.cookie.indexOf( " ", x ) + 1;
	   if ( x == 0 )
		   break;
   }
   return "";
}


// 24시간 기준 쿠키 설정하기
// expiredays 후의 클릭한 시간까지 쿠키 설정
function setCookie( name, value, expiredays ) { 
   var todayDate = new Date(); 
   todayDate.setDate( todayDate.getDate() + expiredays ); 
   document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
}

// 00:00 시 기준 쿠키 설정하기
// expiredays 의 새벽  00:00:00 까지 쿠키 설정
function setCookieAt00( name, value, expiredays ) { 
	var todayDate = new Date(); 
	todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);
	if ( todayDate > new Date() )
	{
	expiredays = expiredays - 1;
	}
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	 document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
  }

