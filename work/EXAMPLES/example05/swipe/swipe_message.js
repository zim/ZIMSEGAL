var swipeBox = document.getElementById("swipe_message");

setTimeout(function(){
	document.getElementById("swipe_message").style.webkitTransform = "translate3d(0, 65px, 0)";
}, 1000);
setTimeout(function(){
	document.getElementById("swipe_message").style.webkitTransform = "translate3d(0, 0, 0)";
}, 4000);