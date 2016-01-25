(($) ->
  'use strict'
  $ ->

    ### ========================================================================
    # DOM-based Routing
    # Based on http://goo.gl/EUTi53 by Paul Irish
    #
    # Only fires on body classes that match. If a body class contains a dash,
    # replace the dash with an underscore when adding it to the object below.
    #
    # .noConflict()
    # The routing is enclosed within an anonymous function so that you can
    # always reference jQuery with $, even when in .noConflict() mode.
    # ======================================================================== 
    ###

    # Use this variable to set up the common and page specific functions. If you
    # rename this variable, you will also need to rename the namespace below.
    Plugin_Name = 
      common: init: ->
        # JavaScript to be fired on all pages
        return
      home: init: ->
        # JavaScript to be fired on the home page
        return
    # The routing fires all common scripts, followed by the page specific scripts.
    # Add additional events for more control over timing e.g. a finalize event
    UTIL = 
      fire: (func, funcname, args) ->
        namespace = Plugin_Name
        funcname = if funcname == undefined then 'init' else funcname
        if func != '' and namespace[func] and typeof namespace[func][funcname] == 'function'
          namespace[func][funcname] args
        return
      loadEvents: ->
        UTIL.fire 'common'
        $.each document.body.className.replace(/-/g, '_').split(/\s+/), (i, classnm) ->
          UTIL.fire classnm
          return
        return
    $(document).ready UTIL.loadEvents
    # Write in console log the PHP value passed in enqueue_js_vars in public/class-plugin-name.php
    console.log pn_js_vars.alert
    # Place your public-facing JavaScript here
    return
  return
) jQuery
