/*! Open external links into a new tab */

$('a[rel*=external],a.external').each(function(i){this.target='_blank'});
