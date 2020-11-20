'use strict';
////////////////////////// Delay displaying media until window has loaded ////////////////////
/*
$(document).ready(function() {
	$("img").fadeIn([6000]);
	$("video").fadeIn([6000]);
});

const IMG = document.querySelector("img");
const VIDEO = document.querySelector("video");
IMG.style.display = block;
VIDEO.style.display = block;
*/

/* Add grey horisontal line under page subheaders and remove underline from subhead class */
(function() {
	let subHead;
	/* Check if querySelector is supported by turning it into boolean with !! */
	if (!!document.querySelector === true) {
		subHead = document.querySelectorAll(".subhead");
	}
	/* If querySelector is unsupported try getElementsByClassName */
	else subHead = document.getElementsByClassName("subhead");
	/* loop through array to set property values */
	for (let i = 0; i < subHead.length; i++) {
		subHead[i].style.textDecoration = "none";
		subHead[i].innerHTML += "<hr style='color: #EEEEEE'>";
	}
})();

/* Either float or reposition if browser doesn't support CSS float or grid */
(function() {
	const MEDIA = ["#media", "#media-grid"];
	const ARTICLE = ["#article"];
	
	// if not CSS3 support remove image and video ** intention here is to delete images and add them after text node
	if (CSS.supports("display: flex") !== true || CSS.supports("display: grid") !== true) {
		//alert("Your browser is hardly supported.\nSince it doesn't support modern features, I've disabled media.");
		moveMedia();
	}	
	// function move media to above footer
	function moveMedia() {
	for (let i = 0; i < MEDIA.length; i++) {
			if (!!document.querySelector(MEDIA[i]) === true) { /* finding the media type. Either grid or normal */
				// set media to id aside
				let node = document.querySelector(MEDIA[i]);
				//let media = node.innerHTML;
				node.id = "aside";
				node.style = "float: left;";
				/*
				if (node.parentNode) {
					node.parentNode.removeChild(node);
					document.querySelector("#article").innerHTML += "<aside>" + media + "</aside>";
					document.querySelector
				}*/
			}
		}
		/*for (let i = 0; i < MEDIA.length; i++) {
			if (!!document.querySelector(MEDIA[i]) === true) {
				let node = document.querySelector(MEDIA[i]);
				let media = document.querySelector(MEDIA[i]).innerHTML;
				if (node.parentNode) {
					node.parentNode.removeChild(node);
					document.querySelector("#article").innerHTML += media;
					alert(node);//document.querySelector("#m
				}
			}
		}*/
	}	
})();
