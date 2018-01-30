

if (window.captureEvents)
{
	window.captureEvents(Event.MOUSEUP | Event.MOUSEMOVE);	
	window.onmouseup=myclick;
	window.onmousemove=mymove;		
}
else
{
	if(document.addEventListener){
		document.addEventListener('touchend', myclick, false);
		document.addEventListener('touchmove', mymove, false);
	}
	
 	document.onmouseup=myclick;
 	document.onmousemove=mymove;
}


function myclick(e)
{

	var x1, x2, y1, y2;
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
 	
 	var yPos = y1 + y2;
 	var xPos = x1 + x2;
 	
 	if (document.getElementById && !document.all) 
 		myData = document.getElementById("myInputForm");
 	else
		myData = document.all.myInputForm;				
 		
 	if(bIsfirst == 1)
	{
 		bIsfirst = 0;
 	}
 	else
 	{ 		 	 		
 		if( xPos > xPosBefore &&
 			xPos < (xPosBefore +230) &&
 			yPos > yPosBefore &&
 			yPos < (yPosBefore + 60) ) 
 		{	 		 			 				 	 			 				 				 		 		 		
		
			if(myData.style.visibility == "hidden")			
			{
				showElement("myInputForm", true);
				FocusElement("toForm");
			}
			
			if(e)
				e.proceed();
	 	
	 		return false; 		
	 	}
	} 	
	
	yPosBefore = yPos;
 	xPosBefore = xPos;
 		 		
 	myData.style.top  = yPos - 60;
 	myData.style.left = xPos;
 	
 	showElement("myInputForm", true);
 	FocusElement("toForm");

	return false;
}

