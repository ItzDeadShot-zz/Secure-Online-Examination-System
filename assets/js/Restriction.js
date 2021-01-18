var modal = document.getElementById("myModal");
var intervalFunc;

//Fullscreen Mode
function openFullscreen() {
	elem = document.documentElement;
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.webkitRequestFullscreen) {
		/* Safari */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) {
		/* IE11 */
		elem.msRequestFullscreen();
	}
}

function penaltyFunc() {
	modal.style.display = "block";
	var distance = 1000 * 60 * 10;
	clearInterval(intervalFunc);
	// Update the count down every 1 second
	intervalFunc = setInterval(function () {
		// Time calculations for days, hours, minutes and seconds
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Output the result in an element with id="demo"
		document.getElementById("countdown").innerHTML =
			minutes + "m " + seconds + "s ";

		// If the count down is over, write some text
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdown").innerHTML = "EXPIRED";
			modal.style.display = "none";
		}
		distance = distance - 1000;
	}, 1000);
}

/*************************************************
 * Title: Using the PageVisibility API
 * Author: Joe Marini
 * Date: October 25th, 2012
 * Availability: https://www.html5rocks.com/en/tutorials/pagevisibility/intro/
 *************************************************/
// Get the modal
function getHiddenProp() {
	var prefixes = ["webkit", "moz", "ms", "o"];

	// if 'hidden' is natively supported just return it
	if ("hidden" in document) return "hidden";

	// otherwise loop over all the known prefixes until we find one
	for (var i = 0; i < prefixes.length; i++) {
		if (prefixes[i] + "Hidden" in document) return prefixes[i] + "Hidden";
	}

	// otherwise it's not supported
	return null;
}
function isHidden() {
	var prop = getHiddenProp();
	if (!prop) return false;

	return document[prop];
}

var visProp = getHiddenProp();
if (visProp) {
	var evtname = visProp.replace(/[H|h]idden/, "") + "visibilitychange";
	document.addEventListener(evtname, visChange);
}

function visChange() {
	if (isHidden()) penaltyFunc();
}

/*************************************************
 * Title: 3 Ways to Disable Copy Text in Javascript & CSS
 * Author:  W.S. Toh
 * Date: December 19, 2020
 * Availability: https://code-boxx.com/disable-copy-text-javascript-css/
 *************************************************/

// PREVENT CONTEXT MENU FROM OPENING
document.addEventListener(
	"contextmenu",
	function (evt) {
		evt.preventDefault();
	},
	false
);

// PREVENT CLIPBOARD COPYING
document.addEventListener(
	"copy",
	function (evt) {
		// Change the copied text if you want
		evt.clipboardData.setData(
			"text/plain",
			"Copying is not allowed on this webpage"
		);

		// Prevent the default copy action
		evt.preventDefault();
	},
	false
);

function isInFullscreen() {
	return !!(
		document.fullscreenElement ||
		document.mozFullScreenElement ||
		document.webkitFullscreenElement ||
		document.msFullscreenElement
	);
}

function EventListenerFullscreen() {
	if (isInFullscreen() == true) {
		[
			"fullscreenchange",
			"webkitfullscreenchange",
			"mozfullscreenchange",
			"msfullscreenchange",
		].forEach((eventType) =>
			document.addEventListener(eventType, fullscreenchange_exit())
		);
	} else {
		[
			"fullscreenchange",
			"webkitfullscreenchange",
			"mozfullscreenchange",
			"msfullscreenchange",
		].forEach((eventType) =>
			document.removeEventListener(eventType, fullscreenchange_exit())
		);
	}
}

function fullscreenchange_exit() {
	if (isInFullscreen() == false) {
		//penaltyFunc();
		openFullscreen();
	}
	//EventListenerFullscreen();
}

$(document).keydown(function (event) {
	if (event.key == "F12") {
		// Prevent F12
		return false;
	} else if (event.ctrlKey && event.shiftKey && event.key == "I") {
		// Prevent Ctrl+Shift+I
		return false;
	} else if (event.ctrlKey && event.shiftKey && event.key == "Escape") {
		// Prevent Ctrl+Shift+Esc
		return false;
	} else if (event.key == "Escape") {
		// Prevent Esc
		return false;
	} else if (event.key == "F11") {
		//Prevent F11
		return false;
	} else if (event.key == "F4") {
		//Prevent F4
		return false;
	} else if (event.altKey) {
		//Prevent Ctrl
		return false;
	} else if (event.metaKey) {
		//Prevent Windows Key / Left ⌘ / Chromebook Search key / Meta
		return false;
	}
});
window.onload = function () {
	openFullscreen();
};
//openFullscreen();
