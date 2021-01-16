/*************************************************
 * Title: Using the PageVisibility API
 * Author: Joe Marini
 * Date: October 25th, 2012
 * Availability: https://www.html5rocks.com/en/tutorials/pagevisibility/intro/
 *************************************************/

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
	var txtFld = document.getElementById("visChangeText");

	if (txtFld) {
		if (isHidden()) penaltyFunc();
	}
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
