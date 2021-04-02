flytedesk_digital_publisher = flytedesk_digital_publisher || {
	"uuid": "---"
};
(function (w, d, s, p) {
	'use strict';
	var f = d.getElementsByTagName(s)[0], j = d.createElement(s);
	j.id = 'flytedigital';
	j.async = true;
	j.src = 'https://digital.flytedesk.com/js/head.js#' + p;
	f.parentNode.insertBefore(j, f);
}
)(window, document, 'script', flytedesk_digital_publisher.uuid);