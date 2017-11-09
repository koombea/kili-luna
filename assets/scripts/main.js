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
 * ======================================================================== */

(function($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Luna = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        lunaUtils.overrideStyles();
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  var lunaUtils = (function () {
    var overrideStyles = function () {
      var $styleContainers = $('.js-styles');
      var css = '';

      for (var i = 0; i < $styleContainers.length; i++) {
        css += $styleContainers[i].innerHTML;
      }

      if (css !== '') {
        var heads = document.querySelectorAll('head');
        if (heads.length > 0) {
          var node = document.createElement('style');
          node.type = 'text/css';
          node.appendChild(document.createTextNode(css));
          heads[0].appendChild(node);
        }
        for (var j = 0; j < $styleContainers.length; j++) {
          $styleContainers[j].parentNode.removeChild($styleContainers[j]);
        }
      }
    };

    return {
      overrideStyles: overrideStyles
    };
  })();

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Luna;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  var lunaPosts = (function () {
    var showCommentForm = function (ev) {
      ev.preventDefault();
      var link = ev.target || ev.srcElement;
      var targetDivSelector = '.js-form-'+(link.dataset.id), targetClassToggle = link.dataset.class;
      $(targetDivSelector).toggle('slow');
    };
    return {
      showCommentForm: showCommentForm
    };
  })();

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
