/*! Steven Levithan trim function - 2007
 *  source http://blog.stevenlevithan.com/archives/faster-trim-javascript */

/* as a String prototype */
if(!String.prototype.trim){String.prototype.trim=function(){var s=this.replace(/^\s\s*/,''),ws=/\s/,i=s.length;while(ws.test(s.charAt(--i)));return s.slice(0,i+1);};};

/* as a function */
function trim(s){var s=s.replace(/^\s\s*/,''),ws=/\s/,i=s.length;while(ws.test(s.charAt(--i)));return s.slice(0,i+1);}

