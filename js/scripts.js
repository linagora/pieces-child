/*
	scripts.js
	
	License: GNU General Public License v2.0
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	
	Copyright: (c) 2013 csThemes, http://csthemes.com
*/

jQuery(document).ready(function($) {
	// set the container that Masonry will be inside of in a var
	var container = document.querySelector('#masonry');

	// create empty var msnry
	var msnry;

	// initialize Masonry after all images have loaded
	imagesLoaded( container, function() {
		msnry = new Masonry( container, {
			itemSelector: '.masonry-item'
		});
	});
});