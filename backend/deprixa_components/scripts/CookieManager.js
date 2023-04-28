(function () {
    var cookieManager = function () {
        var cookies = {
            set: function (name, value, milliseconds, isSession) {
                var expires = "";

                if (!isSession && milliseconds) {
                    var date = new Date();
                    date.setTime(date.getTime() + milliseconds);
                    expires = "; expires=" + date.toGMTString();
                }

                document.cookie = name + "=" + value + expires + "; path=/";
            },

            remove: function (name) {
                cookies.set(name, "", -1, false);
            },

            get: function (name) {
                if (document.cookie.length > 0) {
                    var start = document.cookie.indexOf(name + "="), end;

                    if (start != -1) {
                        start = start + name.length + 1;
                        end = document.cookie.indexOf(";", start);

                        if (end == -1) {
                            end = document.cookie.length;
                        }

                        return unescape(document.cookie.substring(start, end));
                    }
                }
                return null;
            }
        };

        this.set = function (name, value, days, isSession) {
            cookies.set(name, value, days, isSession);
        };

        this.remove = function (name) {
            cookies.remove(name);
        };

        this.get = function (name) {
            return cookies.get(name);
        };
    };

    window.CookieManager = cookieManager;
})();