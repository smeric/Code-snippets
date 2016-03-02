/**
 * Register onpaste on inputs and textareas in browsers that don't natively support it.
 * Cross-browser(*) implementation of Internet Explorer's (and others') onpaste event
 * handler.
 *
 * (*) oninput isn't part of the W3C DOM spec, but all of the browsers I've tested
 * this code with—Chrome 2, Safari 4, Firefox 3, Opera 10, IE6, IE7—support either
 * oninput or onpaste. Out of all these browsers, only Opera doesn't support onpaste,
 * but it does support oninput.
 *
 * @usage <input type="text" onpaste="return false;" oncopy="return false;" oncut="return false;" autocomplete="off" />
 *
 * @author Christopher Parker
 * @source http://stackoverflow.com/questions/1226574/disable-copy-paste-into-html-form-using-javascript#1723838
 */
(function(){
	var onload = window.onload;
	window.onload = function(){
		if ( 'function' == typeof onload ){
			onload.apply( this, arguments );
		}
		var fields    = [],
			inputs    = document.getElementsByTagName( 'input' ),
			textareas = document.getElementsByTagName( 'textarea' );
		for ( var i = 0; i < inputs.length; i++ ){
			fields.push(inputs[i]);
		}
		for ( var i = 0; i < textareas.length; i++ ){
			fields.push( textareas[i] );
		}
		for ( var i = 0; i < fields.length; i++ ){
			var field=fields[i];
			if ( 'function' != typeof field.onpaste && !!field.getAttribute( 'onpaste' ) ){
				field.onpaste = eval('(function(){' + field.getAttribute( 'onpaste' ) + '})');
			}
			if ( 'function' == typeof field.onpaste ){
				var oninput = field.oninput;
				field.oninput = function(){
					if ( 'function' == typeof oninput ){
						oninput.apply( this, arguments );
					}
					if ( 'undefined' == typeof this.previousValue ){
						this.previousValue = this.value;
					}
					var pasted = ( Math.abs( this.previousValue.length - this.value.length ) > 1 && '' != this.value );
					if ( pasted && !this.onpaste.apply( this, arguments ) ){
						this.value = this.previousValue;
					}
					this.previousValue = this.value;
				};
				if ( field.addEventListener ){
					field.addEventListener( 'input', field.oninput, false );
				}
				else if ( field.attachEvent ){
					field.attachEvent( 'oninput', field.oninput );
				}
			}
		}
	}
})();

/* Minified version */
/*! Register onpaste on inputs and textareas in browsers that don't natively support it. - Christopher Parker
 *  @source http://stackoverflow.com/questions/1226574/disable-copy-paste-into-html-form-using-javascript#1723838 */
!function(){var w=window.onload;window.onload=function(){"function"==typeof w&&w.apply(this,arguments);for(var f=[],h=document.getElementsByTagName("input"),t=document.getElementsByTagName("textarea"),i=0;i<h.length;i++)f.push(h[i]);for(var i=0;i<t.length;i++)f.push(t[i]);for(var i=0;i<f.length;i++){var g=f[i];if("function"!=typeof g.onpaste&&g.getAttribute("onpaste")&&(g.onpaste=eval("(function(){"+g.getAttribute("onpaste")+"})")),"function"==typeof g.onpaste){var n=g.oninput;g.oninput=function(){"function"==typeof n&&n.apply(this,arguments),"undefined"==typeof this.previousValue&&(this.previousValue=this.value);var t=Math.abs(this.previousValue.length-this.value.length)>1&&""!=this.value;t&&!this.onpaste.apply(this,arguments)&&(this.value=this.previousValue),this.previousValue=this.value},g.addEventListener?g.addEventListener("input",g.oninput,!1):g.attachEvent&&g.attachEvent("oninput",g.oninput)}}}}();

/* jQuery version */
$('body').on('copy paste cut','.disablecopypaste',function(e){e.preventDefault()});


