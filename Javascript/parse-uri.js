/*! parseUri 1.2.2 - (c) 2007 Steven Levithan <stevenlevithan.com>
 *  source http://blog.stevenlevithan.com/archives/parseuri
 *  MIT License - Usage : var anchor = $myUri.parseUri(self.location.href)['anchor']; */

var $myUri={parseUri:function(s){var o=this.parseUri.options,m=o.parser[o.strictMode?"strict":"loose"].exec(s),uri={},i=14;while(i--){uri[o.key[i]]=m[i]||"";};uri[o.q.name]={};uri[o.key[12]].replace(o.q.parser,function($0,$1,$2){if($1){uri[o.q.name][$1]=$2;};});return uri;}};$myUri.parseUri.options={strictMode:false,key:["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],q:{name:"queryKey",parser:/(?:^|&)([^&=]*)=?([^&]*)/g},parser:{strict:/^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,loose:/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/}};

