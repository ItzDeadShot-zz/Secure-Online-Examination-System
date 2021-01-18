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
	var popup_restriction_modal = document.getElementById("popupRestriction");
	var countdown_to_dismiss = document.getElementById("countdown_warning");
	popup_restriction_modal.style.display = "block";
	var distance = 1000 * 60 * 10;
	clearInterval(intervalFunc);
	// Update the count down every 1 second
	intervalFunc = setInterval(function () {
		// Time calculations for days, hours, minutes and seconds
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Output the result in an element with id="demo"
		countdown_to_dismiss.innerHTML = minutes + "m " + seconds + "s ";

		// If the count down is over, write some text
		if (distance < 0) {
			clearInterval(x);
			countdown_to_dismiss.innerHTML = "EXPIRED";
			popup_restriction_modal.style.display = "none";
		}
		distance = distance - 1000;
	}, 1000);
}

/*************************************************
 * Title: visibilitychange event is not triggered when switching program/window with ALT+TAB or clicking in taskbar
 * Author: TylerH
 * Date:  Sep 16 '20 at 23:16
 * Availability: https://stackoverflow.com/questions/28993157/visibilitychange-event-is-not-triggered-when-switching-program-window-with-altt
 *************************************************/
var return_from_hidden = false;

var browserPrefixes = ["moz", "ms", "o", "webkit"],
	isVisible = true; // internal flag, defaults to true

// get the correct attribute name
function getHiddenPropertyName(prefix) {
	return prefix ? prefix + "Hidden" : "hidden";
}

// get the correct event name
function getVisibilityEvent(prefix) {
	return (prefix ? prefix : "") + "visibilitychange";
}

// get current browser vendor prefix
function getBrowserPrefix() {
	for (var i = 0; i < browserPrefixes.length; i++) {
		if (getHiddenPropertyName(browserPrefixes[i]) in document) {
			// return vendor prefix
			return browserPrefixes[i];
		}
	}

	// no vendor prefix needed
	return null;
}

// bind and handle events
var browserPrefix = getBrowserPrefix(),
	hiddenPropertyName = getHiddenPropertyName(browserPrefix),
	visibilityEventName = getVisibilityEvent(browserPrefix);

function onVisible() {
	// prevent double execution
	if (isVisible) {
		return;
	}
	if (return_from_hidden) {
		penaltyFunc();
		return_from_hidden = false;
	}
	// change flag value
	isVisible = true;
	//console.log("visible");
}
function onHidden() {
	// prevent double execution
	if (!isVisible) {
		return;
	}

	return_from_hidden = true;
	// change flag value
	isVisible = false;
	//console.log("hidden");
}

function handleVisibilityChange(forcedFlag) {
	// forcedFlag is a boolean when this event handler is triggered by a
	// focus or blur eventotherwise it's an Event object
	if (typeof forcedFlag === "boolean") {
		if (forcedFlag) {
			return onVisible();
		}

		return onHidden();
	}

	if (document[hiddenPropertyName]) {
		return onHidden();
	}

	return onVisible();
}

document.addEventListener(visibilityEventName, handleVisibilityChange, false);

// extra event listeners for better behaviour
document.addEventListener(
	"focus",
	function () {
		handleVisibilityChange(true);
	},
	false
);

document.addEventListener(
	"blur",
	function () {
		handleVisibilityChange(false);
	},
	false
);

window.addEventListener(
	"focus",
	function () {
		handleVisibilityChange(true);
	},
	false
);

window.addEventListener(
	"blur",
	function () {
		handleVisibilityChange(false);
	},
	false
);
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

function fullscreenchange_exit() {
	if (isInFullscreen() == false) {
		openFullscreen();
	}
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
	fullscreenchange_exit();
	var visProp = getHiddenProp();
	if (visProp) {
		var evtname = visProp.replace(/[H|h]idden/, "") + "visibilitychange";
		document.addEventListener(evtname, visChange);
	}
};
