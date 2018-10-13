(function() {
	function ready(fn) {
        if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

	ready(function() {
        // TODO:
        // properties to remove once we are sure everyone has updated to version >= 0.3.9
        // api_endpoint (now under endpoints)
        // post_id (now under post)
        // post_title (now under post)
        // post_type (now under post)
        // resource_ref (now under post)
        // show_read_more_button (now under post.content_chop)
        // url (now under post)
        // verify_endpoint (now under endpoints)
        // widget_endpoint (now under endpoints)
        window.Pico = {
            api_endpoint: pp_vars.api_endpoint,
            break_selector: pp_vars.break_selector || null,
            debug_info: pp_vars,
            endpoints: {
                api: pp_vars.api_endpoint,
                verify: pp_vars.verify_endpoint,
                widget: pp_vars.widget_endpoint
            },
            post: {
                post_id: pp_vars.post_id || null,
                post_title: pp_vars.post_title || null,
                post_type: pp_vars.post_type || null,
                resource_ref: pp_vars.resource_ref || null,
                content_chop: !!pp_vars.show_read_more_button,
                url: window.location.href
            },
            post_id: pp_vars.post_id || '',
            post_title: pp_vars.post_title || '',
            post_type: pp_vars.post_type,
            publisher_id: pp_vars.publisher_id,
            raven: {
                'nonce': pp_vars.raven_nonce
            },
            resource_ref: pp_vars.resource_ref || '',
            show_read_more_button: !!pp_vars.show_read_more_button,
            url: window.location.href,
            verify_endpoint: pp_vars.verify_endpoint,
            plugin_version: pp_vars.plugin_version,
            widget_endpoint: pp_vars.widget_endpoint
        }
        if (!!pp_vars.categories) {
            window.Pico.categories = JSON.parse(pp_vars.categories) || '';
            window.Pico.post.categories = window.Pico.categories;
        }
        if (!!pp_vars.tags) {
            window.Pico.tags = JSON.parse(pp_vars.tags) || '';
            window.Pico.post.tags = window.Pico.tags;
        }

        var element = document.getElementsByTagName("head")[0];

        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script.setAttribute("async", !0);
        script.setAttribute("defer", !0);
        script.setAttribute("crossorigin", "anonymous");
        script.setAttribute("src", pp_vars.widget_endpoint + "/static/js/bundle.js?client_id=" + pp_vars.publisher_id + "&widget_version=" + pp_vars.widget_version);
        element.appendChild(script);

	});
})();
