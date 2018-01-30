<?


include "dbcon.php";
include "mobile_device_detect.php";

$bitlyusername = "bitly user name"; //
$bitlykey = "bitly open api key"; //
$tableName = "my_table_name"; //

selectAction();

$mobile = mobile_device_detect();

function selectAction()
{
	$gDataX = $_GET['x'];
	$gDataY = $_GET['y'];
	$gContent = $_GET['subject'];
	$gAction = $_GET['action'];
	$gPage = $_GET['p'];
	$gLongurl = urldecode($_GET['longurl']);

	if (!isset($gDataX)) $gDataX = $_POST['x'];
	if (!isset($gDataY)) $gDataY = $_POST['y'];
	if (!isset($gContent)) $gContent = $_POST['subject'];
	if (!isset($gAction)) $gAction = $_POST['action'];
	if (!isset($gPage)) $gPage = $_POST['p'];
	if (!isset($gLongurl)) $gLongurl = urldecode($_POST['longurl']);

	if(!isset($gAction) || strcmp($gAction, "read") == 0) {
		readData($gDataX, $gDataY);
	}
	else if(strcmp($gAction, "write") == 0) {
		writeData($gDataX, $gDataY, $gContent);
	}
	else if(strcmp($gAction, "latest") == 0) {
		ShowRecentList();
	}
	else if(strcmp($gAction, "latest_next") == 0) {
		ShowRecentNext($gPage);
	}
	else if(strcmp($gAction, "shorturl") == 0) {
		send_bitly_service($gLongurl);
	}

	exit(0);
}

function readData($gDataX, $gDataY) {
	HTMLHeader($gDataX, $gDataY);
	readIndexFile();
	HTMLFooter();
}


function HTMLHeader($gDataX, $gDataY) {
	global $mobile;

	$gFirstTitle = "AiRPAGE MEMO";

	if(isset($gDataX) || isset($gDataY)) {
		$gFirstTitle = readIndexFileForTitle($gDataX, $gDataY);
	}

?>

	<html xmlns:fb="http://ogp.me/ns/fb#">
	<head>
	<title><? echo $gFirstTitle; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,  minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
	<meta contents="낙서하기,scribbling,메모,간단,낙서,긁적이기,쓰기">
	<meta http-equiv="Cache-Control" content="No-Cache"/>
	<meta http-equiv="Pragma" content="No-Cache"/>
  	<meta name="keywords" content="낙서,scribbling,memo,infinite,unlimited" />
	<meta name="description" content="You can write something, everywhere !" />
	<link rel="icon" type="image/x-icon" href="http://airpage.org/airpage.ico" />
	<link rel="icon" type="image/png" href="http://airpage.org/airpage.png" />
	<link rel="icon" type="image/gif" href="http://airpage.org/airpage.gif" />
	<meta property="og:locale" content="ko_KR" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://airpage.org/memo" />
	<meta property="og:site_name" content="AiRPAGE 낙서장" />
	<meta property="og:title" content="AiRPAGE 낙서장" />
	<meta property="og:image" content="http://airpage.org/xe/files/attach/site_image/site_image.1488777071.jpg" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="315" />
	<meta property="og:description" content="이것저것을 이곳저곳에 마구마구 낙서하세요." />
	<link rel="SHORTCUT ICON" href="http://airpage.org/airpage.ico"/>
	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
	<script type="text/javascript" src="memo.js" charset="UTF-8"></script>
	<script language="javascript">
	<!--

	function mD(x, y) {
		$("#dialog2").css('top', yPosBefore);
		$("#dialog2").css('left', xPosBefore);
		//transition effect
		$("#dialog2").fadeIn(2000);
		showElement("myInputForm", false);
		getUrl("http://airpage.org/memo/memo.php?x=" + x + "&y="  + y);
	}

	-->
	</script>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0"

<?

echo "onLoad='";

if(isset($gDataX) || isset($gDataY)) {
	echo "myScroll($gDataX,  $gDataY);";
	if( $mobile ) {}
	else {
	    echo "showMyMessage($gDataX,  $gDataY);";
	}
}
else {
	if( $mobile ) {}
	else {
		    echo "showMyMessage(0,0);";
	}
}

echo "'>";

?>


	<div id=fbll><font size=2 face=돋움 color=#555555><b>이 낙서장이</b></font><fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></div>
	<div id=fbll2><font size=2 face=돋움 color=#555555><b>이 낙서장이</b></font><fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></div>
	<div id=fbll3><font size=2 face=돋움 color=#555555><b>이 낙서장이</b></font><fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></div>

<?

}

function readIndexFile() {
	global $dbcon, $tableName;	

	showInputForm();
		
	$query = "SELECT * FROM `$tableName`;"; 	 	
	$result = mysql_query($query, $dbcon) or die("{\"result\":\"error\", \"reason\":\"lnvalid Token\"}\n");		
					
	while ($row = mysql_fetch_array($result)) {												
		$SubjectData = $row[content];				;
		$myLength = mb_strlen($SubjectData, 'UTF-8');
		$myLeft = $row[x];
		$myTop = $row[y];
		$fonSize = $row[fontsize];
		$fonFamily = $row[fontfamily];
		$fonColor = $row[fontcolor];
		$underLine = $row[underline];
		$fontBold = $row[fontbold];
		$myLength = $myLength * $fonSize;

		echo "\n<div style=\"width:$myLength" . "px; z-index:0; position:absolute; height:$fonSize;";
		echo "left:" . "$myLeft" . "px; top:" . "$myTop" . "px;\">";
		echo "<a href=javascript:mD('$myLeft','$myTop'); style=\"";				
		echo "font-size: $fonSize" . "px;";
		echo "font-family: $fonFamily;";
		echo " color:#" . "$fonColor;";

		if($underLine == 1)
		{
			echo " text-decoration:underline;";
		}

		if ($fontBold == 1)
		{
			echo " font-weight:bold;";
		}

		echo "\">$SubjectData</a>";		
		echo "</div>";
	}
					
	mysql_close();		
}


function readIndexFileForTitle($gDataX, $gDataY) {
	global $dbcon, $tableName;	
	
	$query = "SELECT * FROM `$tableName` WHERE x = $gDataX AND y = $gDataY;"; 	 	
	$result = mysql_query($query, $dbcon) or die("{\"result\":\"error\", \"reason\":\"lnvalid Token\"}\n");		
					
	while ($row = mysql_fetch_array($result)) {												
		$SubjectData = $row[content] . " 낙서";		
		mysql_close();		
		return $SubjectData;
	}
					
	mysql_close();		
	
	return "";
}



function ShowRecentList() {		

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js" charset=utf-8></script>


<script type="text/javascript">

$(document).ready(function(){

lastPostFunc();
	
function lastPostFunc() 
{ 
	$('div#lastPostsLoader').html('<img src="loader.gif">'); 
	
	
	$.post("./memo.php", {'action':'latest_next', 'p':'' + $(".wrdLatest:last").attr("id") + ''},
		function(data){ 			
			if (data != "") { 
				$(".wrdLatest:last").after(data); 				
			} 
		
			$('div#lastPostsLoader').empty(); 
		}); 
}

	$(window).scroll(function(){				
			var docElement = $(document)[0].documentElement;
      var winElement = $(window)[0];

      if ((docElement.scrollHeight - winElement.innerHeight) == winElement.pageYOffset)			
			{				
				lastPostFunc();
			}								
	});

});
</script>

</head>
<body>
<div class="wrdLatest" id=1></div> 
<div id="lastPostsLoader"></div>
</body></html>

<?
	
}

function ShowRecentNext($CurPage)
{
	global $dbcon, $tableName;	

	if ($CurPage == 0)
		$CurPage = 1;

	$gRecPerPage = 13;
	$startCount = ($CurPage-1) * $gRecPerPage;
	$endCount = (($CurPage-1) * $gRecPerPage) + $gRecPerPage;
							
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<body>";

	$nextPage = $CurPage + 1;

	echo "<div class=\"wrdLatest\" id=$nextPage>";

	$query = "SELECT * FROM `$tableName` ORDER BY id DESC LIMIT $startCount , $endCount;"; 	 	
	$result = mysql_query($query, $dbcon) or die("{\"result\":\"error\", \"reason\":\"lnvalid Token\"}\n");		
					
	while ($row = mysql_fetch_array($result)) {												
		$myTitle = $row[content];		
		$myLeft = $row[x];
		$myTop = $row[y];

		$needMore = 0;
		if (mb_strlen($myTitle, 'UTF-8') > 10)
		  $needMore = 1;

		$myTitle = iconv_substr($myTitle, 0, 10, "utf-8");

		if ($needMore == 1)
			$myTitle = "$myTitle ...";

		echo "<a href=memo.php?x=$myLeft&y=$myTop target=_top><font size=1 face=arial color=#336699>";
		echo "$myTitle";
		echo "</font></a><br>\n";
	}
					
	mysql_close();		
		
	echo "</div>\n";
	echo "</body></html>";
}

function HTMLFooter() {
	global $mobile, $dbcon, $tableName;
	
?>

	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1&appId=375862545770954";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	<div id="boxes">

	<div id="dialog2" class="window">
	<table border=0 width=250 height=140 align=center valign=center>
	<tr><td colspan=2>
	<font size=2 face=돋움 color=black><b>해당 낙서의 단축 주소입니다.</b></font>
	</td></tr><tr><td>
	<div id="result"></div></td><td width=60><input type="button" value="닫기" onClick="javascript:hideMe();" class="myMobileButton3"/></td>
	</td></tr>
	<tr><td height=40>
	<div id='fblikeblock'></div>
	</td></tr>
	<tr><td height=40>
	<div id=a><fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></div>
	</td></tr>
	</table>
	</div>

<?

	
	if( $mobile ) {}
	else
	{
		$query = "SELECT * FROM `$tableName`"; 	 	
		$result = mysql_query($query, $dbcon) or die("{\"result\":\"error\", \"reason\":\"lnvalid Token\"}\n");	
		$gNoOfData = mysql_num_rows($result);
		mysql_close();		
?>
	
	<div id="dialogM" class="window">
	<table border=0 width=400 height=200 align=center valign=center bgcolor=#eeeeee>	
	<tr><td height=100 align=LEFT>
	<font size=2 face=돋움 color=black><b>초... 초간단 사용법</b><br>
	- 아무곳이나 클릭하면 내용을 입력할 수 있는 창이 나타납니다.<BR>
	- 낙서를 클릭하면 해당낙서의 링크주소를 공유 할 수 있습니다.<BR>
	- 링크주소를 통해 낙서장에 오면 좌측상단에서 해당 낙서를<BR> &nbsp;&nbsp;볼 수 있습니다.
	</td></tr>
	 <tr><td align=center>
	 <input type="checkbox" id="myNotice" name="myNotice" class="myNotice"><font size=2 face=돋움 color=black>오늘 창 그만보기 </font>
	 <input type="button" value="닫기" id="myMobileButton4" name="myMobileButton4" class="myMobileButton4">
	 </td></tr>
	<tr><td>	
	<table border=0 cellspacing=0 cellpadding=2 align=left bgcolor=#444444 width=100%>	
	<tr><td align=center><font size=2 color=white face=돋움><img src=icon.gif>낙서수- <? echo $gNoOfData; ?> / </font><a  href="https://github.com/gunman97/memo"><font size=1 face=arial color=#99ccff>(repository)</font></a> <fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></td></tr>
	<tr><td align=center><font color=white size=1>Copyright(c) 2009-2017 <a  href=http://airpage.org/>AiRPAGE</a> All rights reserved.</font></td></tr>
	</table>	
	</td></tr>
	</table>
	</div>
		

	</div>		
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2386952-5', 'auto');
  ga('send', 'pageview');

</script>
		</body></html>

<?

	}

}


function showInputForm() {
?>

	<DIV ID="overDiv" class=overDiv name="overDiv" width=200 height=12></DIV>
		<script type="text/javascript" src="for_pc.js"></script>


		<div id="myInputForm" style="border-radius: 25px;border-width:3px; border-color:#aaaaaa; border-style: dotted; z-index:5; visibility: hidden;  position:absolute;">

			<table border=0 cellpadding=0 cellspacing=0 width=300><tr><td align=center valing=center>

						<table border=0 cellspacing=2 cellpadding=0 align=center bgcolor="white" width=260>
							<form method=post action="/memo/memo.php" name=toForm onsubmit="return f_submit('/memo/memo.php');">
							<input type=hidden name=x>
							<input type=hidden name=y>
							<input type=hidden name=action value=write>
						<tr>
							<td valign=top align=center>
								<textarea name=subject rows=2 cols=50  maxlength=100 class=myInput onkeyup="return ismaxlength(this)" placeholder="무얼 상상하세요?"></textarea>
							</td>
						</tr>
						<tr>
							<td align=right>
									<input type=button value="홈으로" class=myButton2 onclick="location.href='/memo/memo.php'">
									<input type=button value="작성하기" class=myButton2 onclick="return f_submit('/memo/memo.php');">
							</td>
						</tr></form>
						<tr><td><hr size=1 color=#eeeeee></td></tr>
						<tr>
							<td align=center>
								<table border=0 cellpadding=0 cellspacing=0><tr>
									<td><font size=2 face=돋움 color=black>이 낙서장이</font></td><td><fb:like href="http://airpage.org/memo" send="false" width="110" show_faces="false" layout="button_count"></fb:like></td></tr></table>
							</td>
						</tr>
						<tr><td align=center>
							<font face="arial" color=#666666 size=1>© 2009 - 2018 <a href="http://airpage.org">GUNMAN</a> All rights reserved.</font>
						</td></tr>
						</table>

				</td></tr></table>
		</div>


		<div id="myRecentList" align=left class=myRecentList>
		<table border=0 cellspacing=0 cellpadding=0 align=right bgcolor=white width=120px>
		<tr><td bgcolor=#333333 align=center><font color=white face=돋움  size=2>최신글</font></td></tr>
		<tr><td>
		<iframe id="latestFrame" name="latestFrame" src=./memo.php?action=latest width=120px height=140px frameborder=0 marginwidth=0 marginheight=0 scrolling=auto></iframe>
		</td></tr>
		<tr><form><td bgcolor=#333333 align=center><input type=button value="숨기기"  class=myButton2 onclick=myRecentListHide();></td></form></tr>
		</table>
		</div>

<?
}


function writeData($gDataX, $gDataY, $gContent) {
	global $dbcon, $tableName;
		
	$myColor1 = sprintf("%02X%02X%02X", rand(0, 210), rand(0, 210), rand(0, 210));		
	
	$temp = rand(0, 6);
	switch($temp) {
		case 0:
			$myType = "고딕";
		break;
		
		case 1:
			$myType = "굴림";
		break;
		
		case 2:
			$myType = "명조";
		break;
		
		case 3:
			$myType = "바탕";
		break;
		
		case 4:
			$myType = "궁서";
		break;
		
		default:
			$myType = "돋움";
		break;
	}	

	$temp = rand(0, 3);
	if($temp == 2)
	{
		$myType3 = 1;
	}
	else
	{
		$myType3 = 0;
	}


	$temp = rand(0, 2);

	if($temp == 0)
	{
		$myType2 = 1;
	}
	else
	{
		$myType2 = 0;
	}

	$myFontSize = rand(12, 60);

	$gContent = str_replace("'", "\"", $gContent);

	$query = "INSERT INTO `$tableName` (`content`, `x`, `y`, `fontcolor`, `fontfamily`, `fontsize`, `fontbold`, `underline`) VALUES ('$gContent', $gDataX, $gDataY, '$myColor1', '$myType', $myFontSize, $myType3, $myType2);";
	$result = mysql_query($query, $dbcon) or die("{\"result\":\"error\", \"reason\":\"func_on lnvalid Token\"}\n"); 			   			   														
	mysql_close();


	$myLength = mb_strlen($subject, 'UTF-8');
	$myLength = $myLength * $myFontSize;

	echo "Content-type: text/html\n\n";

	echo "\n<div style=\"width:$myLength" . "px; z-index:0; position:absolute; height:10px;";
	echo "left:" . "$gDataX" . "px; top:" . "$gDataY" . "px;\">";

	echo "<a href=javascript:mD('$gDataX','$gDataY'); style=\"";
	echo "font-size:" . $myFontSize . "px;";
	echo "font-family: $myType;";
	echo " color:#" . "$myColor1;";

	if($myType3 == 1)
	{
		echo " text-decoration:underline;";
	}

	if ($myType2 == 1)
	{
		echo " font-weight:bold;";
	}

	echo "\">$gContent</a>";

	echo "</div>";
}

function json_render($content) {
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    echo json_encode($content);
}



function send_bitly_service($url){
	global $bitlyusername, $bitlykey;
  $query = array(
    "version" => "2.0.1",
    "longUrl" => $url,
    "login" => $bitlyusername, 
    "apiKey" => $bitlykey 
  );

  $query = http_build_query($query);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://api.bitly.com/v3/shorten?".$query);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $response = curl_exec($ch);
  curl_close($ch);


