<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8 />
<title>Drag &amp; Drop</title>
<script type="text/javascript">
<!--
var addEvent = (function () {
  if (document.addEventListener) {
    return function (el, type, fn) {
      if (el && el.nodeName || el === window) {
        el.addEventListener(type, fn, false);
      } else if (el && el.length) {
        for (var i = 0; i < el.length; i++) {
          addEvent(el[i], type, fn);
        }
      }
    };
  } else {
    return function (el, type, fn) {
      if (el && el.nodeName || el === window) {
        el.attachEvent('on' + type, function () { return fn.call(el, window.event); });
      } else if (el && el.length) {
        for (var i = 0; i < el.length; i++) {
          addEvent(el[i], type, fn);
        }
      }
    };
  }
})();


// Add event handlers onload 
addEvent(window, 'load', function() {
  var draggableBlueBall = new DragObj(document.getElementById('blueball'), "This is a blue ball");
  var draggableRedBall = new DragObj(document.getElementById('redball'), "This is a red ball");
  var draggableText = new DragObj(document.getElementById('text'), "This is text"); 
  var drop          = new DragObj(document.getElementById('drop'), "None");
  var countBtn		= document.getElementById('countBtn');
  
// Drag information
function DragObj(element, data) {
	this.data = data;
	this.element = element;
	this.count = 0;
	element.setAttribute("data-count", 0);
	
	this.dropBall = function (e) {
	var innerHTML = '<img alt="' + this.alt + '" src="' + this.src + '">';
	if (e.preventDefault) e.preventDefault();

	if (!drop.count) {
	  	drop.element.innerHTML = '<div id="start"></div>' + innerHTML;
	    drop.element.backgroundColor="#ff0000"; 
		drop.count++;
	  }
	  else
	  {
		var lastChild;
		if (lastChild = drop.element.lastElementChild) {
	  		lastChild.insertAdjacentHTML('afterend', innerHTML);
		drop.count++;
		}
			
	  }
	  var count = this.getAttribute('data-count');
	  this.setAttribute("data-count", ++count);
  }
  

}
  
  // Cancel - don't allow this to propagate.
  function cancel(e) {
    if (e.preventDefault) e.preventDefault();
    return false;
  }

  //Tells the browser that we can drop on this target
  addEvent(drop.element, 'dragover', cancel);  //DOM event
  addEvent(drop.element, 'dragenter', cancel); //IE event
	
  addEvent(drop.element, 'drop', function (e) {
    if (e.preventDefault) e.preventDefault(); // stops the browser from redirecting off to the text.
    //this.innerHTML = "<strong>Done!</strong>";
    
		return false;
  });
  
  addEvent(draggableBlueBall.element, 'dragend', draggableBlueBall.dropBall);
  addEvent(draggableRedBall.element, 'dragend', draggableRedBall.dropBall);
 
  addEvent(draggableText.element, 'dragend', function (e) {
	  if (e.preventDefault) e.preventDefault();
	  drop.element.innerHTML="<strong>Text Dropped!</strong>";
	  drop.element.backgroundColor="#ff0000"; 
  });
    addEvent(countBtn, 'click', function (e) {
	  var redBallCount = draggableRedBall.element.getAttribute('data-count');
	  var blueBallCount = draggableBlueBall.element.getAttribute('data-count');
	  document.getElementById('countArea').innerHTML='<p><strong>Blue Balls: ' + redBallCount + '<br />Red Balls: ' + blueBallCount + '</strong></p>';
  });

});
// -->
</script>
<style>
#drop {
  min-height: 150px;
  width: 250px;
  border: 1px solid blue;
  margin: 10px;
  padding: 10px;
}
</style>
</head>
<body>
  <h1 align=center>Drag &amp; Drop - Fill the box with balls</h1>
  <a href="http://www.janbthomas.com" id="text" draggable="true">JanBThomas.com 1</a>
  <img id="redball" alt="ball (2K)" src="images/redball.png" height="50" width="50" draggable="true" />
  <img id="blueball" alt="ball (2K)" src="images/blueball.png" height="50" width="50" draggable="true" />
  </div>
  <div id="drop"><div id="start"></div></div>
  <input type="button" id="countBtn" value="Count">
  <br />
  <div id="countArea"></div>
</body>
</html>
