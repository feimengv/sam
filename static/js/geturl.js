function geturl(url) {
	var url= url || document.URL;
	var a  = document.createElement('a');
	a.href = url;
	return {
		source: url,
		protocol: a.protocol.replace(':', ''),
		host: a.hostname,
		domain:(function(){
			domains = a.hostname;
			var redomain 	  = '';
			var domainArray   = new Array("com", "net", "org", "gov", "edu");
			var domains_array = domains.split('.');
			var domain_count  = domains_array.length - 1;
			var flag 		  = false;
			if (domains_array[domain_count] == 'cn') {
				for (i = 0; i < domainArray.length; i++) {
					if (domains_array[domain_count - 1] == domainArray[i]) {
						flag = true;
						break;
					}
				}
				if (flag == true) {
					redomain = domains_array[domain_count - 2] + "." + domains_array[domain_count - 1] + "." + domains_array[domain_count];
				} else {
					redomain = domains_array[domain_count - 1] + "." + domains_array[domain_count];
				}
			} else {
				redomain = domains_array[domain_count - 1] + "." + domains_array[domain_count];
			}
			return redomain;
		})(),
		port: a.port,
		query: a.search,
		params: (function() {
			var ret = {},
			seg = a.search.replace(/^\?/, '').split('&'),
			len = seg.length,
			i = 0,
			s;
			for (; i < len; i++) {
				if (!seg[i]) {
					continue;
				}
				s = seg[i].split('=');
				ret[s[0]] = decodeURI(s[1]);
			}
			return ret;
		})(),
		file: (a.pathname.match(/\/([^\/?#]+)$/i) || [, ''])[1],
		hash: a.hash.replace('#', ''),
		path: a.pathname.replace(/^([^\/])/, '/$1'),
		relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [, ''])[1],
		segments: a.pathname.replace(/^\//, '').split('/')
	};
}