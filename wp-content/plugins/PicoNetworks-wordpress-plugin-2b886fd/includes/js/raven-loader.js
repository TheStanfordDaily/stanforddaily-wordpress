(function () {
    function ready(fn) {
        if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    ready(function () {
        var headTag = document.getElementsByTagName("head")[0];
        var script = document.createElement("script");

        script.setAttribute("type", "text/javascript");
        script.setAttribute("crossorigin", "anonymous");
        script.setAttribute("src", "https://cdn.ravenjs.com/3.26.4/raven.min.js");
        headTag.appendChild(script);
    });
})();
