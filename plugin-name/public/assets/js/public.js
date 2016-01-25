(function($) {
  'use strict';
  $(function() {

    /* ========================================================================
     * DOM-based Routing
     * Based on http://goo.gl/EUTi53 by Paul Irish
     *
     * Only fires on body classes that match. If a body class contains a dash,
     * replace the dash with an underscore when adding it to the object below.
     *
     * .noConflict()
     * The routing is enclosed within an anonymous function so that you can
     * always reference jQuery with $, even when in .noConflict() mode.
     * ========================================================================
     */
    var Plugin_Name, UTIL;
    Plugin_Name = {
      common: {
        init: function() {}
      },
      home: {
        init: function() {}
      }
    };
    UTIL = {
      fire: function(func, funcname, args) {
        var namespace;
        namespace = Plugin_Name;
        funcname = funcname === void 0 ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
          namespace[func][funcname](args);
        }
      },
      loadEvents: function() {
        UTIL.fire('common');
        $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
          UTIL.fire(classnm);
        });
      }
    };
    $(document).ready(UTIL.loadEvents);
    console.log(pn_js_vars.alert);
  });
})(jQuery);
