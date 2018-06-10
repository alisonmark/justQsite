"use strict";

/**************************************
MB CUSTOM SCRIPTS

EMBED SCROLL PROTECT
ANIMATE TO NEW CONTAINER HEIGHT
GENERATE UNIQUE ID
SHUFFLE ARRAY

***************************************/



/*************************************************************

EMBED SCROLL PROTECT

AUTHOR: Michael Bregnbak
DESCRIPTION: When embedding content sometimes scrolling when mouse is over embedded content will interact with content instead of scrolling page (e.g. zoom on Google Maps). 
The Embed Scroll Protect will protect against this by creating an invisible overlay. Clicking this overlay will remove it and allow users to interact with content.
HOW-TO-USE: $('.some-selector').mbEmbedScrollProtect();
Now you can put class some-selector on e.g. Google Maps iframe.

*************************************************************/


	(function ( $ ) {
	 
	    $.fn.mbEmbedScrollProtect = function() {

	        // add markup
	        this.wrap('<div class="embed-scroll-protect-wrapper"></div>');
	        this.before('<div class="embed-scroll-protect-overlay"></div>')

	        var $wrapper = $('.embed-scroll-protect-wrapper');
	        var $overlay = $('.embed-scroll-protect-overlay');
	 
	        // add css
	        $wrapper.css({
	        	position: 'relative',
	        });
	        $overlay.css({
	        	position: 'absolute',
	        	top: 0,
	        	left: 0,
	        	width: '100%',
	        	height: '100%',
	        	"z-index": 999,
	        });

	        // on click event
	        $overlay.on('click', function() {
	        	$(this).remove();	
	        })

	        return this;
	 
	    };
	 
	}( jQuery ));


/*************************************************************

ANIMATE TO NEW CONTAINER HEIGHT

AUTHOR: Michael Bregnbak
DESCRIPTION: Use on a container that has content that changes dynamically to make the container height animate from old height to new height. 
NB: The container must have a fixed height to begin with as this script assumes that the new content is already present in the container.

*************************************************************/


	(function ( $ ) {
	 
	    $.fn.mbAnimateToNewContainerHeight = function(animationSpeed) {

			var oldContainerHeight = this.height();
			this.css('height', 'auto');
			var newContainerheight = this.height();
			this.height(oldContainerHeight);
			this.animate({
				height: newContainerheight,
			}, animationSpeed, function() {
				$(this).css('height','auto');	
			});

	        return this;
	 
	    };
	 
	}( jQuery ));



/*************************************************************
GENERATE UNIQUE ID

AUTHOR: Michael Bregnbak
DESCRIPTION: Generates a unique identifier (string). Optional parameters: prefix (string), addRandom (boolean). 
First creates a timestamp (ms since epoch). Optionally adds a set prefix and appends a random number between 1-1.000.000.
Not 100% guaranteed unique - but close enough for everyday use.

*************************************************************/

	function mbGenerateUniqueId (prefix, addRandom) {

		var prefix = (typeof prefix != 'undefined') ? prefix : "";
		var dateTimeStamp = new Date().getTime();
		var uniqueId = prefix + dateTimeStamp;

		if (typeof addRandom != 'undefined') {
			if (addRandom === true)	{ 
				var randomNumber = Math.floor(Math.random() * 1000000) + 1;
				uniqueId = uniqueId + "r" + randomNumber; 
			}
		}
		return uniqueId;

	}


/*************************************************************
SHUFFLE ARRAY

INFO: Fisher-Yates (aka Knuth) Shuffle
*************************************************************/


	function mbShuffleArray(array) {
	  var currentIndex = array.length, temporaryValue, randomIndex ;

	  // While there remain elements to shuffle...
	  while (0 !== currentIndex) {

	    // Pick a remaining element...
	    randomIndex = Math.floor(Math.random() * currentIndex);
	    currentIndex -= 1;

	    // And swap it with the current element.
	    temporaryValue = array[currentIndex];
	    array[currentIndex] = array[randomIndex];
	    array[randomIndex] = temporaryValue;
	  }

	  return array;
	}
