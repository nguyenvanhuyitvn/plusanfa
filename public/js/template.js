//[Master Javascript]

//Project:	SoftPro admin - Responsive Admin Template
//Primary use:	SoftPro admin - Responsive Admin Template

//should be included in all pages. It controls some layout


// Make sure jQuery has been loaded
if (typeof jQuery === 'undefined') {
throw new Error('template requires jQuery')
}

// Layout()

//  Implements layout.
//  Fixes the layout height in case min-height fails.

//  @usage activated automatically upon window load.
//  Configure any options by passing data-option="value"
//  to the body tag.



+function ($) {
  'use strict'

  var DataKey = 'fabadmin.layout'

  var Default = {
    slimscroll : true,
    resetHeight: true
  }
  var Selector = {
    wrapper       : '.wrapper',
    contentWrapper: '.content-wrapper',
    layoutBoxed   : '.layout-boxed',
    mainFooter    : '.main-footer',
    mainHeader    : '.main-header',
    sidebar       : '.sidebar',
    controlSidebar: '.control-sidebar',
    fixed         : '.fixed',
    sidebarMenu   : '.sidebar-menu',
    logo          : '.main-header .logo'
  }

  var ClassName = {
    fixed         : 'fixed',
    holdTransition: 'hold-transition'
  }

  var Layout = function (options) {
    this.options      = options
    this.bindedResize = false
    this.activate()
  }

  Layout.prototype.activate = function () {
    this.fix()
    this.fixSidebar()

    $('body').removeClass(ClassName.holdTransition)

    if (this.options.resetHeight) {
      $('body, html, ' + Selector.wrapper).css({
        'height'    : 'auto',
        'min-height': '100%'
      })
    }

    if (!this.bindedResize) {
      $(window).resize(function () {
        this.fix()
        this.fixSidebar()

        $(Selector.logo + ', ' + Selector.sidebar).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
          this.fix()
          this.fixSidebar()
        }.bind(this))
      }.bind(this))

      this.bindedResize = true
    }

    $(Selector.sidebarMenu).on('expanded.tree', function () {
      this.fix()
      this.fixSidebar()
    }.bind(this))

    $(Selector.sidebarMenu).on('collapsed.tree', function () {
      this.fix()
      this.fixSidebar()
    }.bind(this))
  }

  Layout.prototype.fix = function () {
    // Remove overflow from .wrapper if layout-boxed exists
    $(Selector.layoutBoxed + ' > ' + Selector.wrapper).css('overflow', 'hidden')

    // Get window height and the wrapper height
    var footerHeight  = $(Selector.mainFooter).outerHeight() || 0
    var neg           = $(Selector.mainHeader).outerHeight() + footerHeight
    var windowHeight  = $(window).height()
    var sidebarHeight = $(Selector.sidebar).height() || 0

    // Set the min-height of the content and sidebar based on
    // the height of the document.
    if ($('body').hasClass(ClassName.fixed)) {
      $(Selector.contentWrapper).css('min-height', windowHeight - footerHeight)
    } else {
      var postSetHeight

      if (windowHeight >= sidebarHeight) {
        $(Selector.contentWrapper).css('min-height', windowHeight - neg)
        postSetHeight = windowHeight - neg
      } else {
        $(Selector.contentWrapper).css('min-height', sidebarHeight)
        postSetHeight = sidebarHeight
      }

      // Fix for the control sidebar height
      var $controlSidebar = $(Selector.controlSidebar)
      if (typeof $controlSidebar !== 'undefined') {
        if ($controlSidebar.height() > postSetHeight)
          $(Selector.contentWrapper).css('min-height', $controlSidebar.height())
      }
    }
  }

  Layout.prototype.fixSidebar = function () {
    // Make sure the body tag has the .fixed class
    if (!$('body').hasClass(ClassName.fixed)) {
      if (typeof $.fn.slimScroll !== 'undefined') {
        $(Selector.sidebar).slimScroll({ destroy: true }).height('auto')
      }
      return
    }

    // Enable slimscroll for fixed layout
    if (this.options.slimscroll) {
      if (typeof $.fn.slimScroll !== 'undefined') {
        // Destroy if it exists
        $(Selector.sidebar).slimScroll({ destroy: true }).height('auto')

        // Add slimscroll
        $(Selector.sidebar).slimScroll({
          height: ($(window).height() - $(Selector.mainHeader).height()) + 'px',
          color : 'rgba(0,0,0,0.2)',
          size  : '3px'
        })
      }
    }
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, (data = new Layout(options)))
      }

      if (typeof option == 'string') {
        if (typeof data[option] == 'undefined') {
          throw new Error('No method named ' + option)
        }
        data[option]()
      }
    })
  }

  var old = $.fn.layout

  $.fn.layout            = Plugin
  $.fn.layout.Constuctor = Layout

  // No conflict mode
  $.fn.layout.noConflict = function () {
    $.fn.layout = old
    return this
  }

  // Layout DATA-API
  $(window).on('load', function () {
    Plugin.call($('body'))
  });
}(jQuery)  // End of use strict

/* PushMenu()
 * Adds the push menu functionality to the sidebar.
 *
 * @usage: $('.btn').pushMenu(options)
 *          or add [data-toggle="push-menu"] to any button
 *          Pass any option as data-option="value"
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.pushmenu'

  var Default = {
    collapseScreenSize   : 767,
    expandOnHover        : false,
    expandTransitionDelay: 200
  }

  var Selector = {
    collapsed     : '.sidebar-collapse',
    open          : '.sidebar-open',
    mainSidebar   : '.main-sidebar',
    contentWrapper: '.content-wrapper',
    searchInput   : '.sidebar-form .form-control',
    button        : '[data-toggle="push-menu"]',
    mini          : '.sidebar-mini',
    expanded      : '.sidebar-expanded-on-hover',
    layoutFixed   : '.fixed'
  }

  var ClassName = {
    collapsed    : 'sidebar-collapse',
    open         : 'sidebar-open',
    mini         : 'sidebar-mini',
    expanded     : 'sidebar-expanded-on-hover',
    expandFeature: 'sidebar-mini-expand-feature',
    layoutFixed  : 'fixed'
  }

  var Event = {
    expanded : 'expanded.pushMenu',
    collapsed: 'collapsed.pushMenu'
  }

  // PushMenu Class Definition
  var PushMenu = function (options) {
    this.options = options
    this.init()
  }

  PushMenu.prototype.init = function () {
    if (this.options.expandOnHover
      || ($('body').is(Selector.mini + Selector.layoutFixed))) {
      this.expandOnHover()
      $('body').addClass(ClassName.expandFeature)
    }

    $(Selector.contentWrapper).on(function () {
      // Enable hide menu when clicking on the content-wrapper on small screens
      if ($(window).width() <= this.options.collapseScreenSize && $('body').hasClass(ClassName.open)) {
        this.close()
      }
    }.bind(this))

    // __Fix for android devices
    $(Selector.searchInput).on(function (e) {
      e.stopPropagation()
    })
  }

  PushMenu.prototype.toggle = function () {
    var windowWidth = $(window).width()
    var isOpen      = !$('body').hasClass(ClassName.collapsed)

    if (windowWidth <= this.options.collapseScreenSize) {
      isOpen = $('body').hasClass(ClassName.open)
    }

    if (!isOpen) {
      this.open()
    } else {
      this.close()
    }
  }

  PushMenu.prototype.open = function () {
    var windowWidth = $(window).width()

    if (windowWidth > this.options.collapseScreenSize) {
      $('body').removeClass(ClassName.collapsed)
        .trigger($.Event(Event.expanded))
    }
    else {
      $('body').addClass(ClassName.open)
        .trigger($.Event(Event.expanded))
    }
  }

  PushMenu.prototype.close = function () {
    var windowWidth = $(window).width()
    if (windowWidth > this.options.collapseScreenSize) {
      $('body').addClass(ClassName.collapsed)
        .trigger($.Event(Event.collapsed))
    } else {
      $('body').removeClass(ClassName.open + ' ' + ClassName.collapsed)
        .trigger($.Event(Event.collapsed))
    }
  }

  PushMenu.prototype.expandOnHover = function () {
    $(Selector.mainSidebar).hover(function () {
      if ($('body').is(Selector.mini + Selector.collapsed)
        && $(window).width() > this.options.collapseScreenSize) {
        this.expand()
      }
    }.bind(this), function () {
      if ($('body').is(Selector.expanded)) {
        this.collapse()
      }
    }.bind(this))
  }

  PushMenu.prototype.expand = function () {
    setTimeout(function () {
      $('body').removeClass(ClassName.collapsed)
        .addClass(ClassName.expanded)
    }, this.options.expandTransitionDelay)
  }

  PushMenu.prototype.collapse = function () {
    setTimeout(function () {
      $('body').removeClass(ClassName.expanded)
        .addClass(ClassName.collapsed)
    }, this.options.expandTransitionDelay)
  }

  // PushMenu Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, (data = new PushMenu(options)))
      }

      if (option == 'toggle') data.toggle()
    })
  }

  var old = $.fn.pushMenu

  $.fn.pushMenu             = Plugin
  $.fn.pushMenu.Constructor = PushMenu

  // No Conflict Mode
  $.fn.pushMenu.noConflict = function () {
    $.fn.pushMenu = old
    return this
  }

  // Data API
  $(document).on('click', Selector.button, function (e) {
    e.preventDefault()
    Plugin.call($(this), 'toggle')
  })
  $(window).on('load', function () {
    Plugin.call($(Selector.button))
  })
}(jQuery) // End of use strict


/* Tree()
 * Converts a nested list into a multilevel
 * tree view menu.
 *
 * @Usage: $('.my-menu').tree(options)
 *         or add [data-widget="tree"] to the ul element
 *         Pass any option as data-option="value"
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.tree'

  var Default = {
    animationSpeed: 500,
    accordion     : true,
    followLink    : false,
    trigger       : '.treeview a'
  }

  var Selector = {
    tree        : '.tree',
    treeview    : '.treeview',
    treeviewMenu: '.treeview-menu',
    open        : '.menu-open, .active',
    li          : 'li',
    data        : '[data-widget="tree"]',
    active      : '.active'
  }

  var ClassName = {
    open: 'menu-open',
    tree: 'tree'
  }

  var Event = {
    collapsed: 'collapsed.tree',
    expanded : 'expanded.tree'
  }

  // Tree Class Definition
  var Tree = function (element, options) {
    this.element = element
    this.options = options

    $(this.element).addClass(ClassName.tree)

    $(Selector.treeview + Selector.active, this.element).addClass(ClassName.open)

    this._setUpListeners()
  }

  Tree.prototype.toggle = function (link, event) {
    var treeviewMenu = link.next(Selector.treeviewMenu)
    var parentLi     = link.parent()
    var isOpen       = parentLi.hasClass(ClassName.open)

    if (!parentLi.is(Selector.treeview)) {
      return
    }

    if (!this.options.followLink || link.attr('href') == '#') {
      event.preventDefault()
    }

    if (isOpen) {
      this.collapse(treeviewMenu, parentLi)
    } else {
      this.expand(treeviewMenu, parentLi)
    }
  }

  Tree.prototype.expand = function (tree, parent) {
    var expandedEvent = $.Event(Event.expanded)

    if (this.options.accordion) {
      var openMenuLi = parent.siblings(Selector.open)
      var openTree   = openMenuLi.children(Selector.treeviewMenu)
      this.collapse(openTree, openMenuLi)
    }

    parent.addClass(ClassName.open)
    tree.slideDown(this.options.animationSpeed, function () {
      $(this.element).trigger(expandedEvent)
    }.bind(this))
  }

  Tree.prototype.collapse = function (tree, parentLi) {
    var collapsedEvent = $.Event(Event.collapsed)

    tree.find(Selector.open).removeClass(ClassName.open)
    parentLi.removeClass(ClassName.open)
    tree.slideUp(this.options.animationSpeed, function () {
      tree.find(Selector.open + ' > ' + Selector.treeview).slideUp()
      $(this.element).trigger(collapsedEvent)
    }.bind(this))
  }

  // Private

  Tree.prototype._setUpListeners = function () {
    var that = this

    $(this.element).on('click', this.options.trigger, function (event) {
      that.toggle($(this), event)
    })
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, new Tree($this, options))
      }
    })
  }

  var old = $.fn.tree

  $.fn.tree             = Plugin
  $.fn.tree.Constructor = Tree

  // No Conflict Mode
  $.fn.tree.noConflict = function () {
    $.fn.tree = old
    return this
  }

  // Tree Data API
  $(window).on('load', function () {
    $(Selector.data).each(function () {
      Plugin.call($(this))
    })
  })

}(jQuery) // End of use strict


/* ControlSidebar()
 * Toggles the state of the control sidebar
 *
 * @Usage: $('#control-sidebar-trigger').controlSidebar(options)
 *         or add [data-toggle="control-sidebar"] to the trigger
 *         Pass any option as data-option="value"
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.controlsidebar'

  var Default = {
    slide: true
  }

  var Selector = {
    sidebar: '.control-sidebar',
    data   : '[data-toggle="control-sidebar"]',
    open   : '.control-sidebar-open',
    bg     : '.control-sidebar-bg',
    wrapper: '.wrapper',
    content: '.content-wrapper',
    boxed  : '.layout-boxed'
  }

  var ClassName = {
    open : 'control-sidebar-open',
    fixed: 'fixed'
  }

  var Event = {
    collapsed: 'collapsed.controlsidebar',
    expanded : 'expanded.controlsidebar'
  }

  // ControlSidebar Class Definition
  var ControlSidebar = function (element, options) {
    this.element         = element
    this.options         = options
    this.hasBindedResize = false

    this.init()
  }

  ControlSidebar.prototype.init = function () {
    // Add click listener if the element hasn't been
    // initialized using the data API
    if (!$(this.element).is(Selector.data)) {
      $(this).on('click', this.toggle)
    }

    this.fix()
    $(window).resize(function () {
      this.fix()
    }.bind(this))
  }

  ControlSidebar.prototype.toggle = function (event) {
    if (event) event.preventDefault()

    this.fix()

    if (!$(Selector.sidebar).is(Selector.open) && !$('body').is(Selector.open)) {
      this.expand()
    } else {
      this.collapse()
    }
  }

  ControlSidebar.prototype.expand = function () {
    if (!this.options.slide) {
      $('body').addClass(ClassName.open)
    } else {
      $(Selector.sidebar).addClass(ClassName.open)
    }

    $(this.element).trigger($.Event(Event.expanded))
  }

  ControlSidebar.prototype.collapse = function () {
    $('body, ' + Selector.sidebar).removeClass(ClassName.open)
    $(this.element).trigger($.Event(Event.collapsed))
  }

  ControlSidebar.prototype.fix = function () {
    if ($('body').is(Selector.boxed)) {
      this._fixForBoxed($(Selector.bg))
    }
  }

  // Private

  ControlSidebar.prototype._fixForBoxed = function (bg) {
    bg.css({
      position: 'absolute',
      height  : $(Selector.wrapper).height()
    })
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, (data = new ControlSidebar($this, options)))
      }

      if (typeof option == 'string') data.toggle()
    })
  }

  var old = $.fn.controlSidebar

  $.fn.controlSidebar             = Plugin
  $.fn.controlSidebar.Constructor = ControlSidebar

  // No Conflict Mode
  $.fn.controlSidebar.noConflict = function () {
    $.fn.controlSidebar = old
    return this
  }

  // ControlSidebar Data API
  $(document).on('click', Selector.data, function (event) {
    if (event) event.preventDefault()
    Plugin.call($(this), 'toggle')
  })

}(jQuery) // End of use strict


/* BoxWidget()
 * Adds box widget functions to boxes.
 *
 * @Usage: $('.my-box').boxWidget(options)
 *         This plugin auto activates on any element using the `.box` class
 *         Pass any option as data-option="value"
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.boxwidget'

  var Default = {
    animationSpeed : 500,
    collapseTrigger: '[data-widget="collapse"]',
    removeTrigger  : '[data-widget="remove"]',
    collapseIcon   : 'fa-minus',
    expandIcon     : 'fa-plus',
    removeIcon     : 'fa-times'
  }

  var Selector = {
    data     : '.box',
    collapsed: '.collapsed-box',
    body     : '.box-body',
    footer   : '.box-footer',
    tools    : '.box-tools'
  }

  var ClassName = {
    collapsed: 'collapsed-box'
  }

  var Event = {
    collapsed: 'collapsed.boxwidget',
    expanded : 'expanded.boxwidget',
    removed  : 'removed.boxwidget'
  }

  // BoxWidget Class Definition
  var BoxWidget = function (element, options) {
    this.element = element
    this.options = options

    this._setUpListeners()
  }

  BoxWidget.prototype.toggle = function () {
    var isOpen = !$(this.element).is(Selector.collapsed)

    if (isOpen) {
      this.collapse()
    } else {
      this.expand()
    }
  }

  BoxWidget.prototype.expand = function () {
    var expandedEvent = $.Event(Event.expanded)
    var collapseIcon  = this.options.collapseIcon
    var expandIcon    = this.options.expandIcon

    $(this.element).removeClass(ClassName.collapsed)

    $(this.element)
      .find(Selector.tools)
      .find('.' + expandIcon)
      .removeClass(expandIcon)
      .addClass(collapseIcon)

    $(this.element).find(Selector.body + ', ' + Selector.footer)
      .slideDown(this.options.animationSpeed, function () {
        $(this.element).trigger(expandedEvent)
      }.bind(this))
  }

  BoxWidget.prototype.collapse = function () {
    var collapsedEvent = $.Event(Event.collapsed)
    var collapseIcon   = this.options.collapseIcon
    var expandIcon     = this.options.expandIcon

    $(this.element)
      .find(Selector.tools)
      .find('.' + collapseIcon)
      .removeClass(collapseIcon)
      .addClass(expandIcon)

    $(this.element).find(Selector.body + ', ' + Selector.footer)
      .slideUp(this.options.animationSpeed, function () {
        $(this.element).addClass(ClassName.collapsed)
        $(this.element).trigger(collapsedEvent)
      }.bind(this))
  }

  BoxWidget.prototype.remove = function () {
    var removedEvent = $.Event(Event.removed)

    $(this.element).slideUp(this.options.animationSpeed, function () {
      $(this.element).trigger(removedEvent)
      $(this.element).remove()
    }.bind(this))
  }

  // Private

  BoxWidget.prototype._setUpListeners = function () {
    var that = this

    $(this.element).on('click', this.options.collapseTrigger, function (event) {
      if (event) event.preventDefault()
      that.toggle()
    })

    $(this.element).on('click', this.options.removeTrigger, function (event) {
      if (event) event.preventDefault()
      that.remove()
    })
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, (data = new BoxWidget($this, options)))
      }

      if (typeof option == 'string') {
        if (typeof data[option] == 'undefined') {
          throw new Error('No method named ' + option)
        }
        data[option]()
      }
    })
  }

  var old = $.fn.boxWidget

  $.fn.boxWidget             = Plugin
  $.fn.boxWidget.Constructor = BoxWidget

  // No Conflict Mode
  $.fn.boxWidget.noConflict = function () {
    $.fn.boxWidget = old
    return this
  }

  // BoxWidget Data API
  $(window).on('load', function () {
    $(Selector.data).each(function () {
      Plugin.call($(this))
    })
  })

}(jQuery) // End of use strict


/* TodoList()
 * Converts a list into a todoList.
 *
 * @Usage: $('.my-list').todoList(options)
 *         or add [data-widget="todo-list"] to the ul element
 *         Pass any option as data-option="value"
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.todolist'

  var Default = {
    iCheck   : false,
    onCheck  : function () {
    },
    onUnCheck: function () {
    }
  }

  var Selector = {
    data: '[data-widget="todo-list"]'
  }

  var ClassName = {
    done: 'done'
  }

  // TodoList Class Definition
  var TodoList = function (element, options) {
    this.element = element
    this.options = options

    this._setUpListeners()
  }

  TodoList.prototype.toggle = function (item) {
    item.parents(Selector.li).first().toggleClass(ClassName.done)
    if (!item.prop('checked')) {
      this.unCheck(item)
      return
    }

    this.check(item)
  }

  TodoList.prototype.check = function (item) {
    this.options.onCheck.call(item)
  }

  TodoList.prototype.unCheck = function (item) {
    this.options.onUnCheck.call(item)
  }

  // Private

  TodoList.prototype._setUpListeners = function () {
    var that = this
    $(this.element).on('change ifChanged', 'input:checkbox', function () {
      that.toggle($(this))
    })
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option)
        $this.data(DataKey, (data = new TodoList($this, options)))
      }

      if (typeof data == 'string') {
        if (typeof data[option] == 'undefined') {
          throw new Error('No method named ' + option)
        }
        data[option]()
      }
    })
  }

  var old = $.fn.todoList

  $.fn.todoList         = Plugin
  $.fn.todoList.Constructor = TodoList

  // No Conflict Mode
  $.fn.todoList.noConflict = function () {
    $.fn.todoList = old
    return this
  }

  // TodoList Data API
  $(window).on('load', function () {
    $(Selector.data).each(function () {
      Plugin.call($(this))
    })
  })

}(jQuery) // End of use strict


/* DirectChat()
 * Toggles the state of the control sidebar
 *
 * @Usage: $('#my-chat-box').directChat()
 *         or add [data-widget="direct-chat"] to the trigger
 */
+function ($) {
  'use strict'

  var DataKey = 'fabadmin.directchat'

  var Selector = {
    data: '[data-widget="chat-pane-toggle"]',
    box : '.direct-chat'
  }

  var ClassName = {
    open: 'direct-chat-contacts-open'
  }

  // DirectChat Class Definition
  var DirectChat = function (element) {
    this.element = element
  }

  DirectChat.prototype.toggle = function ($trigger) {
    $trigger.parents(Selector.box).first().toggleClass(ClassName.open)
  }

  // Plugin Definition
  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data(DataKey)

      if (!data) {
        $this.data(DataKey, (data = new DirectChat($this)))
      }

      if (typeof option == 'string') data.toggle($this)
    })
  }

  var old = $.fn.directChat

  $.fn.directChat             = Plugin
  $.fn.directChat.Constructor = DirectChat

  // No Conflict Mode
  $.fn.directChat.noConflict = function () {
    $.fn.directChat = old
    return this
  }

  // DirectChat Data API
  $(document).on('click', Selector.data, function (event) {
    if (event) event.preventDefault()
    Plugin.call($(this), 'toggle')
  })
  
  // Slim scrolling
  
  $('.inner-content-div').slimScroll({
    height: 'auto'
  });
  $('.direct-chat-messages').slimScroll({
    height: '310'
  });

  
  $(".search-box a, .search-box .app-search .srh-btn").on('click', function() {
        $(".app-search").toggle(200);
    });
	
	
	
  // Close
    //
    $(document).on('click', '.box-btn-close', function() {
      $(this).parents('.box').fadeOut(600, function() {
        if ($(this).parent().children().length == 1) {
          $(this).parent().remove();
        }
        else {
          $(this).remove();
        }
      });
    });



    // Slide up/down
    //
    $(document).on('click', '.box-btn-slide', function(){
      $(this).toggleClass('rotate-180').parents('.box').find('.box-content, .box-body').slideToggle();
    });
    // $(document).on('click', '.box-slided-up-detail', function(){
    //   $(this).find('.box-content, .box-body').slideToggle();
    // });
    $(function(){
       $('.box-slided-up-detail').each(function(){
          $(this).on('click', function(e){
            $(this).find('.box-content, .box-body').slideToggle();
          });
       });
    });
    // $(document).on('click', '.box-header', function(){
    //   $(this).parents('.box').find('.box-content, .box-body').slideToggle();
    // });


    // Maximize
    //
    $(document).on('click', '.box-btn-maximize', function(){
      $(this).parents('.box').toggleClass('box-maximize').removeClass('box-fullscreen');
    });



    // Fullscreen
    //
    $(document).on('click', '.box-btn-fullscreen', function(){
      $(this).parents('.box').toggleClass('box-fullscreen').removeClass('box-maximize');
    });
	
	
	
	

		
		// Disable demonstrative links!
    //
    $(document).on('click', 'a[href="#"]', function(e){
      e.preventDefault();
    });
	
	
	
	
    // Upload
    //
    $(document).on('click', '.file-browser', function() {
      var $browser = $(this);
      if ( $browser.hasClass('form-control') ) {
        setTimeout(function(){
          $browser.closest('.file-group').find('[type="file"]').trigger('click');
        },300);
      }
      else {
        var file = $browser.closest('.file-group').find('[type="file"]');
        file.on( 'click', function(e) {
          e.stopPropagation();
        });
        file.trigger('click');
      }
    });

    // Event to change file name after file selection
    $(document).on('change', '.file-group [type="file"]', function(){
      var input = $(this)[0];
      var len = input.files.length;
      var filename = '';

      for (var i = 0; i < len; ++i) {
        filename += input.files.item(i).name + ', ';
      }
      filename = filename.substr(0, filename.length-2);
      $(this).closest('.file-group').find('.file-value').val(filename).text(filename).focus();
    });

    // Update file name for bootstrap custom file upload
    $(document).on('change', '.custom-file-input', function(){
      var filename = $(this).val().split('\\').pop();
      $(this).next('.custom-file-control').attr('data-input-value', filename);
    });
    $('.custom-file-control:not([data-input-value])').attr('data-input-value', 'Choose file...');
	
}(jQuery) // End of use strict

// Fullscreen
	$(function () {
		'use strict'

		$('[data-provide~="fullscreen"]').on('click', function () {
			screenfull.toggle($('#container')[0]);
		});

	}); // End of use strict

 $(function(){
   //change image when choose file
  $("#avatar").change(function(){
      var file = $(this)[0].files[0];
      console.log(file.type);
      var patterImage = new RegExp("image/*");
      if(!patterImage.test(file.type)) {
              alert("Please choose image");
      } else {
              var fileReader = new FileReader();
              fileReader.readAsDataURL(file);
              fileReader.onload = function(e) {
                      $("#img-avatar").attr("src",e.target.result);
              }
      }
  });
  $("#img-avatar").click(function(){
      $("#avatar").click();
  });
 });
// Location
 $(function(){
    var localId;
    var token = $("#token").val();
    $( ".btn-location-edit" ).each(function(index) {
        $(this).on("click", function(e){
            e.stopPropagation();
            $('#edit-location-type').html('');
            localId = $(this).attr('data-id');
            var urlEdit = 'location/edit/' + localId;
            urlEdit = urlEdit.replace(':id', localId);
            urlUpdate = 'location/update/' + localId;
            locationType = JSON.parse($('#locationTypeJson').val());
            $.ajax({
                  url: urlEdit,
                  type: 'get',
                  dataType:'json',
                  success: function(response){
                      var option='';
                      $('#edit-location-home-form').attr('action', urlUpdate);
                      $('#edit_location_name').val(response['location_name']);
                      $('#edit_location_detail').val(response['detail']);
                      var type = response["type"]["id_master"];
                      for(var i=0; i< locationType.length; i++){
                          if(locationType[i]['id_master'] == type){
                            option += "<option value=" + locationType[i]['id_master']+" selected>"+locationType[i]['name']+"</option>";
                          }else{
                            option += "<option value=" + locationType[i]['id_master']+">"+locationType[i]['name']+"</option>";
                          }
                      } 
                      $('#edit-location-type').append(option);
                  }
              });
          });
      });
 });


// $(function(){
//   $( ".btn-location-delete" ).each(function(index) {
//       $(this).on('click', function (e) {
//         e.stopPropagation();
//         enroll_location = $('.enroll-location').val();
//         console.log(enroll_location);
//         LocationId= parseInt($(this).attr('data-id'));
//         console.log(LocationId);
//         enroll_location = JSON.parse(enroll_location);
//         var checkDelete;
//         for(var i=0; i < enroll_location.length; i++){
//             if(enroll_location[i]['location_id'] == LocationId){
//                 checkDelete = true;
//             }
//             console.log(typeof enroll_location[i]['location_id']);
//         }
//         const url = $(this).attr('href');
//         if(checkDelete){
//           swal({
//               title: 'Are you sure?',
//               text: 'There are the devices in this location and those devices will be permanantly deleted!',
//               icon: 'warning',
//               buttons: ["Cancel", "Yes!"],
//           }).then(function(value) {
//               if (value) {
//                 window.location.href = url;
//               }
//           });
//         }else if(!checkDelete){
//           swal({
//             title: 'Are you sure?',
//             text: 'This location will be permanantly deleted!',
//             icon: 'warning',
//             buttons: ["Cancel", "Yes!"],
//           }).then(function(value) {
//               if (value) {
//                 window.location.href = url;
//               }
//           });
//         }
        
//     });
//   });
// });

$(function(){
   $( ".img-location" ).each(function(index) {
    $(this).on('click', function (event) {
      event.preventDefault();
      $(this).parent().children('.box-slided-up-detail').click();
    });
  });
});


// Display Device when clicked to specific Location in next collumn
 $(function(){
// Display detail device in right slider when the size of screen is small
  $( ".location-home-box" ).each(function(index) {
      $(this).on('click', function (event) {
        event.preventDefault();
        // Add border location
       $('.inner').each(function() { 
            $(this).click(function(){
              $('.inner.active-box').removeClass("active-box"); 
              $(this).addClass("active-box");
            }); 
        }); 
        // ./Add border location
        $('.device-selected-by-location-home').removeClass('d-none');
        $('.control-device-screen').addClass('d-none');
        var locationId= $(this).attr('data-id');
        var locationName = $(this).children('.inner').children('.location-name-selected').text();
        console.log(locationName);
        $('.device-belong-to-location').html('- Khu vực: ' + locationName);
        var urlGetDeviceByLocationId = 'device/' + locationId;
        $.ajax({
          url: urlGetDeviceByLocationId,
          type: 'get',
          dataType:'json',
          success: function(response){
            var content='';
            if(response.length > 0 ){
              for(var i=0; i< response.length; i++){
                // Device
                content += '<div class="custom-col-4">';
                content += '<div class="card device-home-box" data-id="' + response[i]['device_id']['id']  + '" data-toggle=""  data-target="#modal-right">';
                content += '<img class="card-img-top" src="'+ response[i]['device_id']['type']['icon'] + '" width="35px" height="100px"  alt="device">';
                content += '<div class="card-body body-device">';
                content += '<h5 class="card-title text-center device-name-selected">'+ response[i]["nickname_device"] + '</h5>';
                content += '<p class="card-text text-center"><i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off"></i></p>';
                content += '</div>';
                content += '</div>';
                content += '</div>';
              }
          }else{
                content +='<div class="mr-auto h1">Không có thiết bị nào</div>';
          }
            $('.device-selected-by-location-home').html(content);
          }
        });
        });
    });
  // $(window).resize(function(){
  //    if (window.matchMedia('(max-width: 768px)').matches)
  //     {
  //         $('.location-home-box').attr('data-toggle','modal');
  //          $( ".location-home-box" ).each(function(index) {
  //             $(this).on('click', function (event) {
  //               event.preventDefault();
  //               $('.device-selected-by-location-home').removeClass('d-none');
  //               $('.control-device-screen').addClass('d-none');
  //               var locationId= $(this).attr('data-id');
  //               var urlGetDeviceByLocationId = 'device/' + locationId;
  //               $.ajax({
  //                 url: urlGetDeviceByLocationId,
  //                 type: 'get',
  //                 dataType:'json',
  //                 success: function(response){

  //                   var content='';
  //                   if(response.length > 0 ){
  //                     for(var i=0; i< response.length; i++){
  //                       // Device
  //                       content += '<div class="custom-col-4">';
  //                       content += '<div class="card device-home-box" data-id="' + response[i]['device_id']['id']  + '" data-toggle="" data-target="#modal-right">';
  //                       content += '<img class="card-img-top" src="'+ response[i]['device_id']['type']['icon'] + '"  alt="device">';
  //                       content += '<div class="card-body">';
  //                       content += '<h5 class="card-title text-center">'+ response[i]["nickname_device"] + '</h5>';
  //                       content += '<p class="card-text text-center"><i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off"></i></p>';
  //                       content += '</div>';
  //                       content += '</div>';
  //                       content += '</div>';
  //                     }
  //                 }else{
  //                       content +='<div class="mr-auto h1">Không có thiết bị nào</div>';
  //                 }
  //                 // console.log(content);    
  //                   $('.modal-right-device-location-append').html(content);
  //                 }
  //               });
  //               });
  //           });
  //     }
  //     else{
  //       $('.location-home-box').attr('data-toggle','');
  //         $( ".location-home-box" ).each(function(index) {
  //           $(this).on('click', function (event) {
  //             event.preventDefault();
  //             $('.device-selected-by-location-home').removeClass('d-none');
  //             $('.control-device-screen').addClass('d-none');
  //             var locationId= $(this).attr('data-id');
  //             var urlGetDeviceByLocationId = 'device/' + locationId;
  //             $.ajax({
  //               url: urlGetDeviceByLocationId,
  //               type: 'get',
  //               dataType:'json',
  //               success: function(response){
  //                 var content='';
  //                 if(response.length > 0 ){
  //                   for(var i=0; i< response.length; i++){
  //                     // Device
  //                     content += '<div class="custom-col-4">';
  //                     content += '<div class="card device-home-box" data-id="' + response[i]['device_id']['id']  + '">';
  //                     content += '<img class="card-img-top" src="'+ response[i]['device_id']['type']['icon'] + '"  alt="device">';
  //                     content += '<div class="card-body">';
  //                     content += '<h5 class="card-title text-center">'+ response[i]["nickname_device"] + '</h5>';
  //                     content += '<p class="card-text text-center"><i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off pr-2"></i> <i class="fas fa-power-off"></i></p>';
  //                     content += '</div>';
  //                     content += '</div>';
  //                     content += '</div>';
  //                   }
  //               }else{
  //                     content +='<div class="mr-auto h1">Không có thiết bị nào</div>';
  //               }
  //                 $('.device-selected-by-location-home').html(content);
  //               }
  //             });
  //           });
  //       });
  //     }
  // });
});

// Display or Hide add location sreen in home screen
$(function(){
    $('.btn-add-location-home').click(function(){
        $('#add-location-home-content').removeClass('d-none');
        $('#location-home-content').addClass('d-none');
        $(this).css('display','none');
        $('.btn-back-location-home').css('display','block');
        $('.btn-add-location-cancel').removeClass('d-none');
    });
    $('.btn-location-edit').click(function(e){
        e.stopPropagation();
        $('.btn-add-location-home').css('display','none');
        $('#edit-location-home-content').removeClass('d-none');
        $('#location-home-content').addClass('d-none');
        $('.btn-back-location-home').css('display','block');
        $('.btn-edit-location-cancel').removeClass('d-none');
    });
    $('.btn-back-location-home').click(function(){
        $('#add-location-home-content').addClass('d-none');
        $('#location-home-content').removeClass('d-none');
        $(this).css('display','none');
        $('.btn-add-location-home').css('display','block');
        $('.btn-add-location-cancel').removeClass('d-none');
        $('#edit-location-home-content').addClass('d-none');
    });
    $('.btn-add-location-cancel').click(function(){
        $('.btn-back-location-home').addClass('d-none');
        $('#add-location-home-content').addClass('d-none');
        $('#location-home-content').removeClass('d-none');
        $('.btn-add-location-home').css('display','block');
    });
    $('.btn-edit-location-cancel').click(function(){
        $('.btn-back-location-home').css('display','block');
        $('#edit-location-home-content').addClass('d-none');
        $('#location-home-content').removeClass('d-none');
        $('.btn-add-location-home').css('display','block');
    });
});


$(function(){
 
  $('.delete-location').click(function(e){
      console.log(e);
        e.preventDefault();
        e.stopPropagation();
        enroll_location = $('.enroll-location').val();
        LocationId= parseInt($(this).attr('data-id'));
        enroll_location = JSON.parse(enroll_location);
        var checkDelete;
        for(var i=0; i < enroll_location.length; i++){
            if(enroll_location[i]['location_id'] == LocationId){
                checkDelete = true;
            }
        }
        const url = $(this).attr('href');
        // const url = $('.url-location-delete').val();
        console.log(url);
        if(checkDelete){
          swal({
<<<<<<< HEAD
              title: 'Bạn có chắc chắn muốn xóa?',
              text: 'Khu vực này đã có thiết bị được cài đặt. Bạn vẫn muốn xóa?',
=======
              title: 'Are you sure?',
              text: 'There are the devices in this location and those devices will be permanantly deleted!',
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
              icon: 'warning',
              buttons: ["Cancel", "Yes!"],
          }).then(function(value) {
              if (value) {
                window.location.href = url;
              }
          });
        }else if(!checkDelete){
          swal({
<<<<<<< HEAD
            title: 'Bạn có chắc chắn muốn xóa?',
            text: 'Khu vực này sẽ bị xóa!',
=======
            title: 'Are you sure?',
            text: 'This location will be permanantly deleted!',
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
          }).then(function(value) {
              if (value) {
                window.location.href = url;
              }
          });
        }
  });
  $(function() {
    $('.schedule-active-button').bootstrapToggle({
      on: 'ON',
      off: 'OFF'
    });
    // $('.schedule-active-button').change(function(){
    //    alert("ok");
    // })
  })
})
// Device js
$(function () {
    $('#getTime').datetimepicker({
        format: 'LT',
        icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
    });
    $('#getDate').datetimepicker({
        // format: 'LD'
        viewMode: 'years',
        format: 'DD/MM/YYYY'
    });
});
$(function(){
    $('.btn-set-schedule').click(function(){
        $('#add-schedule-device-content').removeClass('d-none');
        $('.schedule-list').addClass('d-none');
    });
    $('.btn-set-schedule-cancel').click(function(){
        $('.schedule-list').removeClass('d-none');
        $('#add-schedule-device-content').addClass('d-none');
    });
});

$(function(){
    $('.select-type-schedule').each(function(){
      $(this).on('click', function(){
          var checkType = $('input[name=repeat-schedule]:checked').val();
          // alert(checkType);
          checkType = parseInt(checkType);
          if(checkType == 1){
              $('.daily-schedule').removeClass('d-none');
              $('.getDate').addClass('d-none');
          }else if(checkType == 2){
              $('.daily-schedule').addClass('d-none');
              $('.getDate').removeClass('d-none');
          }else if(checkType ==3){
              $('.daily-schedule').addClass('d-none');
              $('.getDate').removeClass('d-none');
              $('#getDate').datetimepicker({
                  viewMode: 'years',
                  format: 'DD/MM'
              });
          }else if(checkType == 0){
              $('.daily-schedule').addClass('d-none');
              $('.getDate').removeClass('d-none');
              $('#getDate').datetimepicker({
                  // format: 'LD'
                  viewMode: 'years',
                  format: 'DD/MM/YYYY'
              });
          }
      });
    });
});

$(function(){
  $('.btn-info-setting').click(function(){
    $('#info-device-content').removeClass('d-none');
    $('#setting-device-content').addClass('d-none');
    $('.btn-info-setting').addClass('d-none');
    $('.btn-setting').addClass('d-none');
  });
  $('.btn-setting').click(function(){
    $('#info-device-content').addClass('d-none');
    $('#setting-device-content').removeClass('d-none');
    $('.btn-info-setting').addClass('d-none');
    $('.btn-setting').addClass('d-none');
  });
  $('.btn-info-back').click(function(){
    $('#info-device-content').addClass('d-none');
    $('#setting-device-content').addClass('d-none');
    $('.btn-setting-device').removeClass('d-none');
    $('.btn-info-setting').removeClass('d-none');
    $('.btn-setting').removeClass('d-none');
  }); 
  $('.btn-back-setting-device').click(function(){
    $('#info-device-content').addClass('d-none');
    $('#setting-device-content').addClass('d-none');
    $('.btn-setting-device').removeClass('d-none');
    $('.btn-info-setting').removeClass('d-none');
    $('.btn-setting').removeClass('d-none');
  });
});

// Edit Device
// Display control device panel in right slider
$(function(){
  $('body').on('click','.device-home-box',function(){
      event.preventDefault();
      var id = $(this).attr('data-id');
      $('.control-device-screen').removeClass('d-none');
      $('.device-selected-by-location-home').addClass('d-none');
      // alert(id);
      // Get device info to editting
      $('.edit-device-location-type').html('');
<<<<<<< HEAD
      // Delete device
        var urlDel = $('.btn-delete-device-item').attr('href');
        urlDel = urlDel.split("/");
        removed = urlDel.splice(urlDel.length-1,1, id);
        urlDel = urlDel.join("/");
        $('.btn-delete-device-item').attr('href', urlDel);

        $('.btn-delete-device-item').on('click', function(e){
          e.preventDefault();
          swal({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: 'Khu vực này sẽ bị xóa!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
              }).then(function(willDelete) {
                 if (willDelete) {
                    window.location.href = urlDel;
                  } else {
                    swal("Thiết bị chưa bị xóa!");
                  }
              });
        });
      // ./Delete device

      // Update History
        var urlUpdateHistory = $('.btn-update-status-item').attr('href');
        urlUpdateHistory = urlUpdateHistory.split("/");
        removed = urlUpdateHistory.splice(urlUpdateHistory.length-1,1, id);
        urlUpdateHistory = urlUpdateHistory.join("/");
        console.log(urlUpdateHistory);
        $('.btn-update-status-item').attr('href', urlUpdateHistory);
      // ./Update History

      // Edit Device
      var urlEdit = 'device/edit/' + id;
=======
      var urlEdit = 'device/edit/' + id;
      console.log(urlEdit);
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
      urlEdit = urlEdit.replace(':id', id);
      urlUpdate = 'device/update/' + id;
      locations = JSON.parse($('#locationsJson').val());
      $.ajax({
            url: urlEdit,
            type: 'get',
            dataType:'json',
            success: function(response){
<<<<<<< HEAD
                // console.log(response);
=======
                console.log(response);
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
                var option='';
                $('#edit-info-device-form').attr('action', urlUpdate);
                $('#nickname_device').val(response['nickname_device']);
                $('#ip-address').val(response['password']);
                $('#password-device').val(response['ip_address']);
                var location_id = response["location_id"];
                for(var i=0; i< locations.length; i++){
                    if(locations[i]['id'] == location_id){
                      option += "<option value=" + locations[i]['id']+" selected>"+locations[i]['location_name']+"</option>";
                    }else{
                      option += "<option value=" + locations[i]['id']+">"+locations[i]['location_name']+"</option>";
                    }
                } 
                $('#edit-device-location-type').append(option);
            }
      });
<<<<<<< HEAD
      // Schedule Device
      var urlSchedule = 'device/getSchedule/' + id;
      urlSchedule = urlSchedule.replace(':id', id);
      // console.log(urlSchedule);
      $.ajax({
            url: urlSchedule,
            type: 'get',
            dataType:'json',
            success: function(response){
                // console.log(response['alarms']);
                var incomming = new Array();
                var arrayDays = new Array();
                var arrayHours = new Array();
                var date = new Array();
                var today= new Date();
                var day = today.getDate();
                var month = today.getMonth()+1;
                var hours = today.getHours(); 
                var minutes = today.getMinutes();
                var minYear = null;
                var minDay = null;
                var minHour = null;
                var minMinute = null;
                var bin = null;
                for(var a=0; a< response['alarms'].length; a++){
                  if (minDay == null){
                      minDay = response['alarms'][a]['day'];
                      arrayDays.push(response['alarms'][a]);
                  }
                  else {
                      if (response['alarms'][a]['day'] <= minDay){
                          minDay = response['alarms'][a]['day'];
                          arrayDays.push(response['alarms'][a]);
                          arrayDays = arrayDays.filter(function(item){
                            // if(item.day == 0){
                            //       // bin = (+item.date).toString(2);
                            //       bin = (item.date >>> 0).toString(2);
                            //       date = bin.split("");
                            //       date.length=7;
                            //       // for(var i=0; i<=date.length; i)
                            // }
                            return item.day == minDay
                          });
                      }
                  }
                }
                for(var i=0; i< arrayDays.length; i++){
                  if (minHour == null){
                      minHour = arrayDays[i]['hour'];
                      arrayHours.push(arrayDays[i]);
                  }
                  else {
                      if (arrayDays[i]['hour'] <= minHour ){
                          minHour = arrayDays[i]['hour'];
                          arrayHours.push(arrayDays[i]);
                          arrayHours = arrayHours.filter(item => item.hour == minHour);
                      }
                  }
                }
                for(var j=0; j< arrayHours.length; j++){
                  if (minMinute == null){
                      minMinute = arrayHours[j]['minute'];
                      incomming.push(arrayHours[j]);
                  }
                  else {
                      if (arrayHours[j]['minute'] < minMinute ){
                          minHour = arrayHours[j]['minute'];
                          incomming.push(arrayHours[j]);
                          incomming = incomming.filter(item => item.minute == minMinute);
                      }
                  }
                }
              console.log(incomming);
               console.log(bin); 
            }
      });
=======
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
  });
});
