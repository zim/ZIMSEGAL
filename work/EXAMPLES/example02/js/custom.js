/* -------------------------------------------- Variables ----------------------------------------- */

var oldBtn = $('#button_1');
var popup = $('#popup');
var once = false;


/* -------------------------------------------- Click to action ----------------------------------------- */

$(document).ready(function(){

	/******* Popup Function *******/
	$('#buttons li').bind('touchend', function(){
	
	//alert("pressed");
		
		if ($(this).hasClass('active')){
			// Do nothing
		} else {
			newBtn = $(this);
			popupNum = newBtn.attr('data-num');
			
			// Add the active state
			oldBtn.removeClass('active');
			newBtn.addClass('active');
			
			// Do the rotation
			popup.css({"-webkit-transition": "-webkit-transform 500ms linear"});
			popup.css({"-webkit-transform":"perspective(800) rotate3d(0, 1, 0, 90deg)"});
			
			popup.bind('webkitTransitionEnd', function(){
			
				if (once == false){
					$(this).attr("src", "img/popup/" + popupNum + ".png");
					popup.css({"opacity":"0"});
					popup.css({"-webkit-transition": "none"});
					popup.css({"-webkit-transform":"perspective(800) rotate3d(0, 1, 0, 270deg)"});
					
					setTimeout(function(){
						popup.css({"opacity":"1"});
						popup.css({"-webkit-transition": "-webkit-transform 500ms linear"});
						popup.css({"-webkit-transform":"perspective(800) rotate3d(0, 1, 0, 360deg)"});
					}, 0);
				
					once = true;
				}

			});
			
			once = false;
			oldBtn = newBtn;
		}
		
	});
	
	/******* animation *******/
	var closed = document.getElementById('closed');
			var open = document.getElementById('open');
			
			randomized();
			
			function randomized(){
				randomTime = Math.floor(Math.random()*2000) + 500;
				randomBlinking = Math.floor(Math.random()*150) + 50;
				
				open.style.display = 'none';
				
				setTimeout(function(){
					open.style.display = 'block';
				}, randomBlinking);
				
				setTimeout(function(){ randomized(); }, randomTime);	
			}	
	
	/******* Author popup Function *******/
	$('#author_btn').bind('touchend', function(){
		
		if ($('#author').hasClass('active')){
			$('#author').removeClass('active');
		} else {
			$('#author').addClass('active');
		}
		
	});

});


/* -------------------------------------------- Remove Touch events ----------------------------------------- */

function loaded(){
	document.addEventListener('touchmove', function(e){
		e.preventDefault;
	});
}

document.addEventListener('DOMContentLoaded', loaded, false);


