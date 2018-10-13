// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles

// eslint-disable-next-line no-global-assign
parcelRequire = (function (modules, cache, entry) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports);
    }

    return cache[name].exports;

    function localRequire(x){
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x){
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;

  for (var i = 0; i < entry.length; i++) {
    newRequire(entry[i]);
  }

  // Override the current require with this new one
  return newRequire;
})({55:[function(require,module,exports) {
var core = module.exports = { version: '2.5.5' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef

},{}],26:[function(require,module,exports) {
var core = require('../../modules/_core');
var $JSON = core.JSON || (core.JSON = { stringify: JSON.stringify });
module.exports = function stringify(it) { // eslint-disable-line no-unused-vars
  return $JSON.stringify.apply($JSON, arguments);
};

},{"../../modules/_core":55}],9:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/json/stringify"), __esModule: true };
},{"core-js/library/fn/json/stringify":26}],4:[function(require,module,exports) {
(function () {
  var AutoModeSettings,
      Cell,
      CellCollection,
      CellTemplate,
      CellTemplateCollection,
      CollectionBase,
      CustomFieldFilter,
      CustomFieldFilterCollection,
      Font,
      FontCollection,
      FontSettings,
      GridEditorModel,
      HoverOptions,
      LayoutModeSettings,
      LayoutSettings,
      LightboxOptions,
      LinkOptions,
      NestedModel,
      PaginationSettings,
      TaxonomyFilter,
      TaxonomyFilterCollection,
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  };

  module.exports.NestedModel = NestedModel = function (superClass) {
    extend(NestedModel, superClass);

    function NestedModel() {
      return NestedModel.__super__.constructor.apply(this, arguments);
    }

    NestedModel.prototype.nested = {};

    NestedModel.prototype.initialize = function () {
      var klass, name, ref, results;
      NestedModel.__super__.initialize.apply(this, arguments);
      ref = this.nested;
      results = [];
      for (name in ref) {
        klass = ref[name];
        results.push(this.set(name, new klass()));
      }
      return results;
    };

    NestedModel.prototype.toJSON = function () {
      var json, name;
      json = NestedModel.__super__.toJSON.apply(this, arguments);
      for (name in this.nested) {
        json[name] = this.get(name).toJSON();
      }
      return json;
    };

    NestedModel.prototype.parse = function (data) {
      var attr, existing, prop;
      if (!(_.isObject(data) || _.isUndefined(data))) {
        data = JSON.parse(data);
      }
      if (_.isUndefined(data) || !data) {
        return data;
      }
      for (prop in this.nested) {
        attr = data[prop];
        if (existing = this.get(prop)) {
          data[prop] = existing;
        } else {
          data[prop] = new this.nested[prop]();
        }
        data[prop].set(data[prop].parse(attr));
      }
      return data;
    };

    NestedModel.prototype.clone = function () {
      var clone, prop;
      clone = NestedModel.__super__.clone.apply(this, arguments);
      for (prop in this.nested) {
        clone.set(prop, this.get(prop).clone());
      }
      return clone;
    };

    return NestedModel;
  }(Backbone.Model);

  module.exports.CollectionBase = CollectionBase = function (superClass) {
    extend(CollectionBase, superClass);

    function CollectionBase() {
      this.parse = bind(this.parse, this);
      return CollectionBase.__super__.constructor.apply(this, arguments);
    }

    CollectionBase.prototype.parse = function (items) {
      return _.map(items, function (_this) {
        return function (item) {
          var newItem;
          newItem = new _this.model();
          return newItem.set(newItem.parse(item));
        };
      }(this));
    };

    return CollectionBase;
  }(Backbone.Collection);

  module.exports.HoverOptions = HoverOptions = function (superClass) {
    extend(HoverOptions, superClass);

    function HoverOptions() {
      return HoverOptions.__super__.constructor.apply(this, arguments);
    }

    HoverOptions.prototype.defaults = {
      position: 'top_left',
      background_image_position: 'repeat'
    };

    return HoverOptions;
  }(NestedModel);

  module.exports.LightboxOptions = LightboxOptions = function (superClass) {
    extend(LightboxOptions, superClass);

    function LightboxOptions() {
      this.isImageOrGrid = bind(this.isImageOrGrid, this);
      return LightboxOptions.__super__.constructor.apply(this, arguments);
    }

    LightboxOptions.prototype.defaults = {
      mode: 'image',
      description_style: 'mini'
    };

    LightboxOptions.prototype.isImage = function () {
      return this.get('mode') === 'image';
    };

    LightboxOptions.prototype.isGrid = function () {
      return this.get('mode') === 'ubergrid';
    };

    LightboxOptions.prototype.isIframe = function () {
      var ref;
      return (ref = this.get('mode')) === 'iframe' || ref === 'ubergrid';
    };

    LightboxOptions.prototype.isImageOrGrid = function () {
      return this.isImage() || this.isGrid();
    };

    return LightboxOptions;
  }(NestedModel);

  module.exports.LinkOptions = LinkOptions = function (superClass) {
    extend(LinkOptions, superClass);

    function LinkOptions() {
      return LinkOptions.__super__.constructor.apply(this, arguments);
    }

    LinkOptions.prototype.nested = {
      lightbox: LightboxOptions
    };

    LinkOptions.prototype.defaults = {
      mode: 'url'
    };

    return LinkOptions;
  }(NestedModel);

  module.exports.Cell = Cell = function (superClass) {
    extend(Cell, superClass);

    function Cell() {
      return Cell.__super__.constructor.apply(this, arguments);
    }

    Cell.prototype.nested = {
      hover: HoverOptions,
      label: Backbone.Model,
      link: LinkOptions
    };

    Cell.prototype.defaults = function () {
      return {
        layout: 'r1c1-io',
        title_position: 'center',
        title_background_image_position: 'repeat'
      };
    };

    Cell.prototype.clone = function () {
      return this.collection.add(Cell.__super__.clone.apply(this, arguments));
    };

    return Cell;
  }(NestedModel);

  CellTemplate = function (superClass) {
    extend(CellTemplate, superClass);

    function CellTemplate() {
      return CellTemplate.__super__.constructor.apply(this, arguments);
    }

    CellTemplate.prototype.defaults = function () {
      return _.extend(CellTemplate.__super__.defaults.apply(this, arguments), {
        criteria: 'order'
      });
    };

    CellTemplate.prototype.isPHP = function () {
      return this.get('criteria') === 'php';
    };

    CellTemplate.prototype.initialize = function () {
      CellTemplate.__super__.initialize.apply(this, arguments);
      if (!this.get('criteria')) {
        return this.set('criteria') === 'order';
      }
    };

    return CellTemplate;
  }(Cell);

  CellCollection = function (superClass) {
    extend(CellCollection, superClass);

    function CellCollection() {
      return CellCollection.__super__.constructor.apply(this, arguments);
    }

    CellCollection.prototype.model = Cell;

    return CellCollection;
  }(CollectionBase);

  CellTemplateCollection = function (superClass) {
    extend(CellTemplateCollection, superClass);

    function CellTemplateCollection() {
      return CellTemplateCollection.__super__.constructor.apply(this, arguments);
    }

    CellTemplateCollection.prototype.model = CellTemplate;

    CellTemplateCollection.prototype.initialize = function () {
      CellTemplateCollection.__super__.initialize.apply(this, arguments);
      if (this.lentgh === 0) {
        return this.add({});
      }
    };

    return CellTemplateCollection;
  }(CellCollection);

  TaxonomyFilter = function (superClass) {
    extend(TaxonomyFilter, superClass);

    function TaxonomyFilter() {
      return TaxonomyFilter.__super__.constructor.apply(this, arguments);
    }

    TaxonomyFilter.prototype.defaults = {
      operator: 'IN'
    };

    return TaxonomyFilter;
  }(Backbone.Model);

  TaxonomyFilterCollection = function (superClass) {
    extend(TaxonomyFilterCollection, superClass);

    function TaxonomyFilterCollection() {
      return TaxonomyFilterCollection.__super__.constructor.apply(this, arguments);
    }

    TaxonomyFilterCollection.prototype.model = TaxonomyFilter;

    return TaxonomyFilterCollection;
  }(CollectionBase);

  CustomFieldFilter = function (superClass) {
    extend(CustomFieldFilter, superClass);

    function CustomFieldFilter() {
      return CustomFieldFilter.__super__.constructor.apply(this, arguments);
    }

    CustomFieldFilter.prototype.defaults = {
      operator: '=',
      type: 'CHAR'
    };

    return CustomFieldFilter;
  }(Backbone.Model);

  CustomFieldFilterCollection = function (superClass) {
    extend(CustomFieldFilterCollection, superClass);

    function CustomFieldFilterCollection() {
      return CustomFieldFilterCollection.__super__.constructor.apply(this, arguments);
    }

    CustomFieldFilterCollection.prototype.model = CustomFieldFilter;

    return CustomFieldFilterCollection;
  }(CollectionBase);

  AutoModeSettings = function (superClass) {
    extend(AutoModeSettings, superClass);

    function AutoModeSettings() {
      return AutoModeSettings.__super__.constructor.apply(this, arguments);
    }

    AutoModeSettings.prototype.defaults = {
      choose_template_method: 'sequential',
      taxonomy_filters_relation: 'AND',
      custom_field_filters_relation: 'AND'
    };

    AutoModeSettings.prototype.nested = {
      taxonomyFilters: TaxonomyFilterCollection,
      customFieldFilters: CustomFieldFilterCollection,
      cellTemplates: CellTemplateCollection
    };

    return AutoModeSettings;
  }(NestedModel);

  Font = function (superClass) {
    extend(Font, superClass);

    function Font() {
      return Font.__super__.constructor.apply(this, arguments);
    }

    Font.prototype.defaults = {
      font: '',
      style: 'regular'
    };

    return Font;
  }(Backbone.Model);

  FontSettings = function (superClass) {
    extend(FontSettings, superClass);

    function FontSettings() {
      return FontSettings.__super__.constructor.apply(this, arguments);
    }

    FontSettings.prototype.nested = {
      title: Font,
      tagline: Font,
      hover_title: Font,
      hover_text: Font,
      lightbox_title: Font,
      lightbox_text: Font,
      label_title: Font,
      label_tagline: Font,
      label_price: Font,
      filters: Font,
      pagination: Font
    };

    return FontSettings;
  }(NestedModel);

  module.exports.FontCollection = FontCollection = function (superClass) {
    extend(FontCollection, superClass);

    function FontCollection() {
      return FontCollection.__super__.constructor.apply(this, arguments);
    }

    FontCollection.prototype.url = "admin-ajax.php?action=uber_grid_get_fonts";

    FontCollection.prototype.parse = function (data) {
      return data.items;
    };

    return FontCollection;
  }(Backbone.Collection);

  LayoutModeSettings = function (superClass) {
    extend(LayoutModeSettings, superClass);

    function LayoutModeSettings() {
      return LayoutModeSettings.__super__.constructor.apply(this, arguments);
    }

    return LayoutModeSettings;
  }(NestedModel);

  LayoutSettings = function (superClass) {
    extend(LayoutSettings, superClass);

    function LayoutSettings() {
      return LayoutSettings.__super__.constructor.apply(this, arguments);
    }

    LayoutSettings.prototype.nested = {
      "default": LayoutModeSettings,
      '440': LayoutModeSettings,
      '768': LayoutModeSettings
    };

    return LayoutSettings;
  }(NestedModel);

  PaginationSettings = function (superClass) {
    extend(PaginationSettings, superClass);

    function PaginationSettings() {
      return PaginationSettings.__super__.constructor.apply(this, arguments);
    }

    PaginationSettings.prototype.isPagination = function () {
      return this.get('style') === 'pagination';
    };

    return PaginationSettings;
  }(Backbone.Model);

  module.exports.GridEditorModel = GridEditorModel = function (superClass) {
    extend(GridEditorModel, superClass);

    function GridEditorModel() {
      return GridEditorModel.__super__.constructor.apply(this, arguments);
    }

    GridEditorModel.prototype.nested = {
      cells: CellCollection,
      auto: AutoModeSettings,
      fonts: FontSettings,
      layout: LayoutSettings,
      filters: Backbone.Model,
      pagination: PaginationSettings,
      effects: Backbone.Model
    };

    return GridEditorModel;
  }(NestedModel);
}).call(this);
},{}],36:[function(require,module,exports) {
(function () {
  var CellEditorBase,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  module.exports = CellEditorBase = function (superClass) {
    extend(CellEditorBase, superClass);

    function CellEditorBase() {
      this.onRemoveClicked = bind(this.onRemoveClicked, this);
      this.onCloneClicked = bind(this.onCloneClicked, this);
      return CellEditorBase.__super__.constructor.apply(this, arguments);
    }

    CellEditorBase.prototype.className = 'ug-cell';

    CellEditorBase.prototype.tagName = 'li';

    CellEditorBase.prototype.regions = function () {
      return {
        main: '.ug-cell-main-wrapper',
        filtering: '.ug-cell-filtering-wrapper',
        layout: '.ug-cell-layout-wrapper',
        linking: '.ug-cell-linking-wrapper',
        hover: '.ug-cell-hover-wrapper',
        label: '.ug-cell-label-wrapper'
      };
    };

    CellEditorBase.prototype.className = 'ug-cell';

    CellEditorBase.prototype.ui = function () {
      return {
        header: '> h3',
        headerText: 'h3 .heading',
        cloneLink: '> h3 a[data-action=clone]',
        removeLink: '> h3 a[data-action=remove]'
      };
    };

    CellEditorBase.prototype.events = {
      'click @ui.header': 'onHeaderClicked',
      'click @ui.cloneLink': 'onCloneClicked',
      'click @ui.removeLink': 'onRemoveClicked'
    };

    CellEditorBase.prototype.onCloneClicked = function (e) {
      e.stopPropagation();
      e.preventDefault();
      return this.model.clone();
    };

    CellEditorBase.prototype.onRemoveClicked = function (e) {
      e.preventDefault();
      return this.model.collection.remove(this.model);
    };

    CellEditorBase.prototype.onHeaderClicked = function () {
      this.$el.toggleClass('ug-expanded');
      if (this.$el.hasClass('ug-expanded')) {
        return this.displaySections();
      } else {
        return this.hideSections();
      }
    };

    CellEditorBase.prototype.scrollTo = function () {
      return this.$el.scrollTo();
    };

    return CellEditorBase;
  }(Marionette.LayoutView);
}).call(this);
},{}],35:[function(require,module,exports) {
(function () {
  var CellEditorSectionView,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  module.exports = CellEditorSectionView = function (superClass) {
    extend(CellEditorSectionView, superClass);

    function CellEditorSectionView() {
      this.onHeaderLabelClicked = bind(this.onHeaderLabelClicked, this);
      this.onHeaderCheckboxClicked = bind(this.onHeaderCheckboxClicked, this);
      return CellEditorSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorSectionView.prototype.ui = function () {
      return {
        header: 'label.huge',
        headerCheckbox: 'label.huge :checkbox',
        imageSelectors: '.image-selector',
        columns: '.ug-columns-2, .ug-column-1',
        colorPickers: '.color-picker'
      };
    };

    CellEditorSectionView.prototype.events = function () {
      return {
        'change @ui.headerCheckbox': 'onHeaderCheckboxClicked',
        'click @ui.header': 'onHeaderLabelClicked'
      };
    };

    CellEditorSectionView.prototype.className = function () {
      return 'ug-section ug-expandable';
    };

    CellEditorSectionView.prototype.initialize = function () {
      CellEditorSectionView.__super__.initialize.apply(this, arguments);
      if (this.model) {
        return this.listenTo(this.model, "change:" + this.getOption('visibilityProperty'), this.onHeaderLabelClicked);
      }
    };

    CellEditorSectionView.prototype.bindUIElements = function () {
      var visibilityProperty;
      CellEditorSectionView.__super__.bindUIElements.apply(this, arguments);
      if (visibilityProperty = this.getOption('visibilityProperty')) {
        if (this.model.get(visibilityProperty)) {
          this.$el.addClass('ug-expanded');
        }
      }
      return this.ui.colorPickers.wpColorPicker();
    };

    CellEditorSectionView.prototype.onHeaderCheckboxClicked = function (e) {};

    CellEditorSectionView.prototype.onHeaderLabelClicked = function (e) {
      if (this.$el.hasClass('ug-expandable') && this.ui.headerCheckbox.length > 0) {
        return this.$el.toggleClass('ug-expanded');
      } else {
        return this.$el.toggleClass('ug-expanded');
      }
    };

    return CellEditorSectionView;
  }(Marionette.LayoutView);
}).call(this);
},{}],75:[function(require,module,exports) {
(function () {
  var ImageSelector,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  module.exports = ImageSelector = function (superClass) {
    extend(ImageSelector, superClass);

    function ImageSelector() {
      this.loadNewImageById = bind(this.loadNewImageById, this);
      this.loadNewImage = bind(this.loadNewImage, this);
      this.onLayoutChanged = bind(this.onLayoutChanged, this);
      this.setImageField = bind(this.setImageField, this);
      this.onImageDeleteClicked = bind(this.onImageDeleteClicked, this);
      this.onImageSelectClicked = bind(this.onImageSelectClicked, this);
      this.onImageChanged = bind(this.onImageChanged, this);
      this.onMouseOut = bind(this.onMouseOut, this);
      this.onMouseEnter = bind(this.onMouseEnter, this);
      return ImageSelector.__super__.constructor.apply(this, arguments);
    }

    ImageSelector.prototype.ui = {
      input: 'input',
      image: 'img',
      actions: '.actions-wrapper',
      overlay: '.overlay',
      select: '.select-image',
      remove: '.image-delete'
    };

    ImageSelector.prototype.events = {
      'click button.select-image': 'onImageSelectClicked',
      'click a.image-delete': 'onImageDeleteClicked',
      mouseenter: 'onMouseEnter',
      mouseleave: 'onMouseOut'
    };

    ImageSelector.prototype.modelEvents = {
      'change:layout': 'onLayoutChanged'
    };

    ImageSelector.prototype.initialize = function () {
      ImageSelector.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      return this.onImageChanged();
    };

    ImageSelector.prototype.bindUIElements = function () {
      ImageSelector.__super__.bindUIElements.apply(this, arguments);
      this.ui.image.hide();
      if (this.ui.input.val()) {
        this.model.loadImage(this.getOption('imageProperty'));
        this.ui.select.hide();
        this.ui.remove.show();
        this.ui.overlay.show();
      } else {
        this.ui.select.show();
        this.ui.remove.hide();
        this.ui.overlay.hide();
      }
      return this.listenTo(this.model, "change:" + this.getOption('imageProperty'), this.onImageChanged);
    };

    ImageSelector.prototype.onMouseEnter = function () {
      if (this.model.get(this.getOption('imageProperty'))) {
        this.ui.actions.fadeIn('fast');
        return this.ui.overlay.fadeIn('fast');
      }
    };

    ImageSelector.prototype.onMouseOut = function () {
      if (this.model.get(this.getOption('imageProperty'))) {
        this.ui.actions.fadeOut('fast');
        return this.ui.overlay.fadeOut('fast');
      }
    };

    ImageSelector.prototype.onImageChanged = function () {
      var image;
      if (image = this.model.get(this.getOption('imageProperty'))) {
        return this.loadNewImageById(image);
      }
    };

    ImageSelector.prototype.onImageSelectClicked = function (event) {
      var flow, id, postID, selector, state;
      selector = this;
      event.preventDefault();
      id = selector.ui.input.val();
      postID = wp.media.model.settings.post.id;
      wp.media.model.settings.post.id = jQuery('#post_ID').val();
      flow = wp.media({
        title: "Select an image",
        library: {
          type: 'image'
        },
        button: {
          text: "Select Image"
        },
        multiple: false
      }).open();
      state = flow.state();
      if ('' !== id && -1 !== id) {
        state.get('selection').reset([wp.media.model.Attachment.get(id)]);
      }
      state.set('display', false);
      return state.on('select', function (el) {
        var selection;
        wp.media.model.settings.post.id = postID;
        selection = this.get('selection').single();
        selector.setImageField(selection.id);
        return selector.loadNewImageById(selection.id);
      });
    };

    ImageSelector.prototype.onImageDeleteClicked = function (event) {
      event.preventDefault();
      this.ui.input.val('');
      this.model.set(this.getOption('imageProperty'), null);
      this.ui.image.hide().attr('src', '');
      this.ui.overlay.hide();
      this.ui.select.fadeIn('fast');
      this.ui.actions.show();
      return this.ui.remove.hide();
    };

    ImageSelector.prototype.layouts = {
      "r1c1-io": "r1c1",
      "r1c2-ir": "r1c1",
      "r1c2-il": "r1c1",
      "r2c1-it": "r1c1",
      "r2c1-ib": "r1c1",
      "r2c2-io": "r2c2",
      "r2c2-it": "r1c2",
      "r2c2-ib": "r1c2",
      "r2c2-il": "r2c1",
      "r2c2-ir": "r2c1",
      "r1c2-io": "r1c2",
      "r2c1-io": "r2c1"
    };

    ImageSelector.prototype.setImageField = function (selection) {
      this.ui.input.val(selection);
      return this.model.set(this.getOption('imageProperty'), selection);
    };

    ImageSelector.prototype.onLayoutChanged = function () {
      var image;
      if (image = this.model.get(this.getOption('imageProperty'))) {
        return this.loadNewImageById(image);
      }
    };

    ImageSelector.prototype.loadNewImage = function (url) {
      this.ui.image.attr('src', url).show();
      this.$el.find('.image-delete').fadeIn('fast');
      this.$el.find('.actions-wrapper, .overlay').fadeOut('fast');
      return false;
    };

    ImageSelector.prototype.loadNewImageById = function (id) {
      var layout;
      if (this.getOption('obeyLayout')) {
        layout = this.layouts[this.model.get('layout')];
      } else {
        layout = 'thumbnail';
      }
      return jQuery.post('admin-ajax.php?action=uber_grid_reload_images', {
        ids: id,
        layout: layout
      }, function (_this) {
        return function (response) {
          return _this.loadNewImage(response.srcs[0]);
        };
      }(this));
    };

    return ImageSelector;
  }(Marionette.ItemView);
}).call(this);
},{}],76:[function(require,module,exports) {
(function () {
  var LayoutSelector,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  module.exports = LayoutSelector = function (superClass) {
    extend(LayoutSelector, superClass);

    function LayoutSelector() {
      this.onLayoutChanged = bind(this.onLayoutChanged, this);
      return LayoutSelector.__super__.constructor.apply(this, arguments);
    }

    LayoutSelector.prototype.ui = {
      options: 'li',
      input: 'input'
    };

    LayoutSelector.prototype.events = {
      'click @ui.options': 'onLayoutChanged'
    };

    LayoutSelector.prototype.initialize = function () {
      LayoutSelector.__super__.initialize.apply(this, arguments);
      return this.bindUIElements();
    };

    LayoutSelector.prototype.bindUIElements = function () {
      var layout;
      LayoutSelector.__super__.bindUIElements.apply(this, arguments);
      if (layout = this.model.get('layout')) {
        return this.$el.find("li." + layout).addClass("selected");
      }
    };

    LayoutSelector.prototype.onLayoutChanged = function (event) {
      var clicked;
      clicked = jQuery(event.target).parent();
      this.ui.options.removeClass("selected");
      clicked.addClass("selected");
      return this.model.set('layout', clicked.attr("class").split(/\s+/)[0]);
    };

    return LayoutSelector;
  }(Marionette.ItemView);
}).call(this);
},{}],37:[function(require,module,exports) {
(function () {
  var CellEditorHoverSectionView,
      CellEditorLabelSectionView,
      CellEditorLayoutSectionView,
      CellEditorLinkingSectionView,
      CellEditorMainSectionView,
      CellEditorSectionView,
      CellTemplateMainSectionView,
      ImageSelector,
      LayoutSelector,
      LightboxLinkingOptions,
      LinkingOptions,
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  };

  CellEditorSectionView = require('./cell-editor-section.coffee');

  ImageSelector = require('./image-selector');

  LayoutSelector = require('./layout-selector');

  module.exports.CellEditorMainSectionView = CellEditorMainSectionView = function (superClass) {
    extend(CellEditorMainSectionView, superClass);

    function CellEditorMainSectionView() {
      return CellEditorMainSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorMainSectionView.prototype.template = '#ug-cell-main-section-template';

    CellEditorMainSectionView.prototype.className = function () {
      return 'ug-section cell-title';
    };

    CellEditorMainSectionView.prototype.ui = function () {
      return _.extend(CellEditorMainSectionView.__super__.ui.apply(this, arguments), {
        titleEditor: 'input.ug-cell-title',
        mainImageSelector: '.ug-main-image-selector',
        backgroundImageSelector: '.ug-background-image-selector'
      });
    };

    CellEditorMainSectionView.prototype.bindUIElements = function () {
      CellEditorMainSectionView.__super__.bindUIElements.apply(this, arguments);
      this.mainImageSelector = new ImageSelector({
        el: this.ui.mainImageSelector,
        model: this.model,
        imageProperty: 'image',
        obeyLayout: true
      });
      return this.backgroundImageSelector = new ImageSelector({
        el: this.ui.backgroundImageSelector,
        model: this.model,
        imageProperty: 'background_image',
        obeyLayout: true
      });
    };

    return CellEditorMainSectionView;
  }(CellEditorSectionView);

  module.exports.CellTemplateMainSectionView = CellTemplateMainSectionView = function (superClass) {
    extend(CellTemplateMainSectionView, superClass);

    function CellTemplateMainSectionView() {
      return CellTemplateMainSectionView.__super__.constructor.apply(this, arguments);
    }

    return CellTemplateMainSectionView;
  }(CellEditorMainSectionView);

  module.exports.CellEditorLayoutSectionView = CellEditorLayoutSectionView = function (superClass) {
    extend(CellEditorLayoutSectionView, superClass);

    function CellEditorLayoutSectionView() {
      return CellEditorLayoutSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorLayoutSectionView.prototype.template = '#ug-cell-section-layout-template';

    CellEditorLayoutSectionView.prototype.className = function () {
      return CellEditorLayoutSectionView.__super__.className.apply(this, arguments) + ' cell-layout';
    };

    CellEditorLayoutSectionView.prototype.ui = function () {
      return _.extend(CellEditorLayoutSectionView.__super__.ui.apply(this, arguments), {
        lightboxImageSelector: '.image-selector',
        layouts: '.ug-layouts'
      });
    };

    CellEditorLayoutSectionView.prototype.initialize = function () {
      return CellEditorLayoutSectionView.__super__.initialize.apply(this, arguments);
    };

    CellEditorLayoutSectionView.prototype.bindUIElements = function () {
      CellEditorLayoutSectionView.__super__.bindUIElements.apply(this, arguments);
      return this.layoutSelector = new LayoutSelector({
        el: this.ui.layouts,
        model: this.model
      });
    };

    return CellEditorLayoutSectionView;
  }(CellEditorSectionView);

  module.exports.CellEditorLinkingSectionView = CellEditorLinkingSectionView = function (superClass) {
    extend(CellEditorLinkingSectionView, superClass);

    function CellEditorLinkingSectionView() {
      this.onLinkModeChanged = bind(this.onLinkModeChanged, this);
      this.onShow = bind(this.onShow, this);
      return CellEditorLinkingSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorLinkingSectionView.prototype.template = '#ug-cell-section-link-mode-template';

    CellEditorLinkingSectionView.prototype.className = 'ug-section ug-expandable ug-cell-link';

    CellEditorLinkingSectionView.prototype.regions = {
      details: '.ug-linking-details'
    };

    CellEditorLinkingSectionView.prototype.ui = function () {
      return _.extend(CellEditorLinkingSectionView.__super__.ui.apply(this, arguments), {
        lightboxImageSelector: '.image-selector'
      });
    };

    CellEditorLinkingSectionView.prototype.modelEvents = {
      'change:mode': 'onLinkModeChanged'
    };

    CellEditorLinkingSectionView.prototype.visibilityProperty = 'enable';

    CellEditorLinkingSectionView.prototype.onShow = function () {
      return this.onLinkModeChanged();
    };

    CellEditorLinkingSectionView.prototype.onLinkModeChanged = function () {
      this.details.show(this.getLinkingModeView());
      if (this.binding) {
        this.binding.unbind();
      }
      return this.binding = rivets.bind(this.$el, this.model);
    };

    CellEditorLinkingSectionView.prototype.getLinkingModeView = function () {
      if (this.model.get('mode') === 'lightbox') {
        return new LightboxLinkingOptions({
          model: this.model.get('lightbox')
        });
      } else {
        return new LinkingOptions({
          model: this.model
        });
      }
    };

    CellEditorLinkingSectionView.prototype.remove = function () {
      if (this.binding) {
        this.binding.unbind();
      }
      return CellEditorLinkingSectionView.__super__.remove.apply(this, arguments);
    };

    return CellEditorLinkingSectionView;
  }(CellEditorSectionView);

  LightboxLinkingOptions = function (superClass) {
    extend(LightboxLinkingOptions, superClass);

    function LightboxLinkingOptions() {
      return LightboxLinkingOptions.__super__.constructor.apply(this, arguments);
    }

    LightboxLinkingOptions.prototype.template = '#ug-cell-linking-lightbox-template';

    LightboxLinkingOptions.prototype.ui = {
      imageSelector: '.image-selector'
    };

    LightboxLinkingOptions.prototype.onShow = function () {
      return this.lightboxImageSelector = new ImageSelector({
        el: this.ui.imageSelector,
        model: this.model,
        imageProperty: 'image'
      });
    };

    LightboxLinkingOptions.prototype.remove = function () {
      this.lightboxImageSelector.remove();
      return LightboxLinkingOptions.__super__.remove.apply(this, arguments);
    };

    return LightboxLinkingOptions;
  }(Marionette.ItemView);

  LinkingOptions = function (superClass) {
    extend(LinkingOptions, superClass);

    function LinkingOptions() {
      return LinkingOptions.__super__.constructor.apply(this, arguments);
    }

    LinkingOptions.prototype.template = '#ug-cell-linking-url';

    return LinkingOptions;
  }(Marionette.ItemView);

  module.exports.CellEditorHoverSectionView = CellEditorHoverSectionView = function (superClass) {
    extend(CellEditorHoverSectionView, superClass);

    function CellEditorHoverSectionView() {
      return CellEditorHoverSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorHoverSectionView.prototype.template = '#ug-cell-section-hover-template';

    CellEditorHoverSectionView.prototype.className = 'ug-section ug-expandable ug-cell-hover';

    CellEditorHoverSectionView.prototype.ui = function () {
      return _.extend(CellEditorHoverSectionView.__super__.ui.apply(this, arguments), {
        hoverImageSelector: '.image-selector'
      });
    };

    CellEditorHoverSectionView.prototype.visibilityProperty = 'enable';

    CellEditorHoverSectionView.prototype.onShow = function () {
      return this.hoverImageSelector = new ImageSelector({
        el: this.ui.hoverImageSelector,
        model: this.model,
        imageProperty: 'background_image',
        obeyLayout: false
      });
    };

    return CellEditorHoverSectionView;
  }(CellEditorSectionView);

  module.exports.CellEditorLabelSectionView = CellEditorLabelSectionView = function (superClass) {
    extend(CellEditorLabelSectionView, superClass);

    function CellEditorLabelSectionView() {
      return CellEditorLabelSectionView.__super__.constructor.apply(this, arguments);
    }

    CellEditorLabelSectionView.prototype.template = '#ug-cell-section-label-template';

    CellEditorLabelSectionView.prototype.className = 'ug-section ug-expandable ug-cell-label';

    CellEditorLabelSectionView.prototype.visibilityProperty = 'enable';

    return CellEditorLabelSectionView;
  }(CellEditorSectionView);
}).call(this);
},{"./cell-editor-section.coffee":35,"./image-selector":75,"./layout-selector":76}],21:[function(require,module,exports) {
(function () {
  var Cell,
      CellEditorBase,
      CellEditorHoverSectionView,
      CellEditorLabelSectionView,
      CellEditorLayoutSectionView,
      CellEditorLinkingSectionView,
      CellEditorMainSectionView,
      CellEditorSectionView,
      CellEditorView,
      EmptyManualEditorView,
      ManualEditorView,
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  };

  CellEditorBase = require('./cell-editor-base');

  Cell = require('./models').Cell;

  CellEditorMainSectionView = require('./sections').CellEditorMainSectionView;

  CellEditorSectionView = require('./cell-editor-section.coffee');

  CellEditorLayoutSectionView = require('./sections').CellEditorLayoutSectionView;

  CellEditorHoverSectionView = require('./sections').CellEditorHoverSectionView;

  CellEditorLabelSectionView = require('./sections').CellEditorLabelSectionView;

  CellEditorLinkingSectionView = require('./sections').CellEditorLinkingSectionView;

  EmptyManualEditorView = function (superClass) {
    extend(EmptyManualEditorView, superClass);

    function EmptyManualEditorView() {
      return EmptyManualEditorView.__super__.constructor.apply(this, arguments);
    }

    EmptyManualEditorView.prototype.template = '#ug-manual-editor-no-cells-template';

    EmptyManualEditorView.prototype.tagName = 'li';

    EmptyManualEditorView.prototype.className = 'ug-no-cells';

    return EmptyManualEditorView;
  }(Marionette.ItemView);

  CellEditorView = function (superClass) {
    extend(CellEditorView, superClass);

    function CellEditorView() {
      this.onTitleChanged = bind(this.onTitleChanged, this);
      return CellEditorView.__super__.constructor.apply(this, arguments);
    }

    CellEditorView.prototype.template = '#ug-cell-manual-template';

    CellEditorView.prototype.modelEvents = {
      'change:title': 'onTitleChanged'
    };

    CellEditorView.prototype.onShow = function () {
      return this.onTitleChanged();
    };

    CellEditorView.prototype.displaySections = function () {
      this.main.show(new CellEditorMainSectionView({
        model: this.model
      }));
      this.filtering.show(new CellEditorSectionView({
        model: this.model,
        className: 'ug-section ug-expandable',
        template: '#ug-cell-filtering-section-template'
      }));
      this.layout.show(new CellEditorLayoutSectionView({
        model: this.model
      }));
      this.hover.show(new CellEditorHoverSectionView({
        model: this.model.get('hover')
      }));
      this.label.show(new CellEditorLabelSectionView({
        model: this.model.get('label')
      }));
      this.binding = rivets.bind(this.$el, {
        model: this.model
      });
      return this.linking.show(new CellEditorLinkingSectionView({
        model: this.model.get('link')
      }));
    };

    CellEditorView.prototype.hideSections = function () {
      var j, len, ref, region, results;
      this.binding.unbind();
      ref = [this.main, this.filtering, this.layout, this.linking, this.hover, this.label];
      results = [];
      for (j = 0, len = ref.length; j < len; j++) {
        region = ref[j];
        results.push(region.empty());
      }
      return results;
    };

    CellEditorView.prototype.onTitleChanged = function () {
      var i, text;
      if (!(text = this.model.get('title'))) {
        i = this.model.collection.indexOf(this.model) + 1;
        text = "Cell " + i;
      }
      return this.ui.headerText.html(text);
    };

    return CellEditorView;
  }(CellEditorBase);

  module.exports.ManualEditorView = ManualEditorView = function (superClass) {
    extend(ManualEditorView, superClass);

    function ManualEditorView() {
      this.onAddCellAfterClicked = bind(this.onAddCellAfterClicked, this);
      this.onAddCellBeforeClicked = bind(this.onAddCellBeforeClicked, this);
      this.onSorted = bind(this.onSorted, this);
      return ManualEditorView.__super__.constructor.apply(this, arguments);
    }

    ManualEditorView.prototype.template = '#ug-manual-editor-template';

    ManualEditorView.prototype.childViewContainer = '> ul';

    ManualEditorView.prototype.childView = CellEditorView;

    ManualEditorView.prototype.emptyView = EmptyManualEditorView;

    ManualEditorView.prototype.ui = function () {
      return {
        addCellBefore: 'button[data-action=add-new-before]',
        addCellAfter: 'button[data-action=add-new-after]',
        children: '>ul'
      };
    };

    ManualEditorView.prototype.events = {
      'click @ui.addCellBefore': 'onAddCellBeforeClicked',
      'click @ui.addCellAfter': 'onAddCellAfterClicked'
    };

    ManualEditorView.prototype.bindUIElements = function () {
      ManualEditorView.__super__.bindUIElements.apply(this, arguments);
      return this.ui.children.sortable({
        axis: 'y',
        update: this.onSorted
      });
    };

    ManualEditorView.prototype.onSorted = function (event, ui) {
      var child, index, item;
      item = ui.item[0];
      child = this.children.find(function (_this) {
        return function (child) {
          return item === child.el;
        };
      }(this));
      index = this.ui.children.find('> li').index(child.$el);
      this.collection.remove(child.model);
      return this.collection.add(child.model, {
        at: index
      });
    };

    ManualEditorView.prototype.onAddCellBeforeClicked = function (event) {
      var cell;
      event.preventDefault();
      this.collection.add(cell = new Cell(), {
        at: 0
      });
      return this.children.findByModel(cell).scrollTo();
    };

    ManualEditorView.prototype.onAddCellAfterClicked = function (event) {
      var cell;
      event.preventDefault();
      this.collection.add(cell = new Cell());
      return this.children.findByModel(cell).scrollTo();
    };

    return ManualEditorView;
  }(Marionette.CompositeView);
}).call(this);
},{"./cell-editor-base":36,"./models":4,"./sections":37,"./cell-editor-section.coffee":35}],22:[function(require,module,exports) {
(function () {
  var AutoCategoriesView,
      AutoEditorQueryView,
      AutomaticEditorView,
      CellEditorBase,
      CellEditorHoverSectionView,
      CellEditorLabelSectionView,
      CellEditorLayoutSectionView,
      CellEditorLinkingSectionView,
      CellEditorSectionView,
      CellTemplateMainSectionView,
      CellTemplateView,
      CellTemplatesView,
      CustomFieldFilterView,
      CustomFieldFiltersView,
      FilterView,
      FiltersView,
      ManualEditorView,
      TaxonomyFilterView,
      TaxonomyFiltersView,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  ManualEditorView = require('./manual-editor').ManualEditorView;

  CellEditorBase = require('./cell-editor-base');

  CellEditorSectionView = require('./cell-editor-section.coffee');

  CellTemplateMainSectionView = require('./sections.coffee').CellTemplateMainSectionView;

  CellEditorLayoutSectionView = require('./sections.coffee').CellEditorLayoutSectionView;

  CellEditorHoverSectionView = require('./sections.coffee').CellEditorHoverSectionView;

  CellEditorLabelSectionView = require('./sections.coffee').CellEditorLabelSectionView;

  CellEditorLinkingSectionView = require('./sections.coffee').CellEditorLinkingSectionView;

  FiltersView = function (superClass) {
    extend(FiltersView, superClass);

    function FiltersView() {
      this.onAddClicked = bind(this.onAddClicked, this);
      return FiltersView.__super__.constructor.apply(this, arguments);
    }

    FiltersView.prototype.ui = {
      addButton: 'button[data-action=add]'
    };

    FiltersView.prototype.events = {
      'click @ui.addButton': 'onAddClicked'
    };

    FiltersView.prototype.childViewContainer = 'ul';

    FiltersView.prototype.onShow = function () {
      return this.binding = rivets.bind(this.$el, this.model);
    };

    FiltersView.prototype.onAddClicked = function (e) {
      e.preventDefault();
      return this.collection.add({});
    };

    return FiltersView;
  }(Marionette.CompositeView);

  FilterView = function (superClass) {
    extend(FilterView, superClass);

    function FilterView() {
      return FilterView.__super__.constructor.apply(this, arguments);
    }

    FilterView.prototype.tagName = 'li';

    FilterView.prototype.ui = function () {
      return {
        'button': 'button'
      };
    };

    FilterView.prototype.events = {
      'click @ui.button': 'onRemoveClicked'
    };

    FilterView.prototype.onShow = function () {
      return this.binding = rivets.bind(this.$el, {
        model: this.model
      });
    };

    FilterView.prototype.onRemoveClicked = function () {
      return this.model.collection.remove(this.model);
    };

    return FilterView;
  }(Marionette.ItemView);

  TaxonomyFilterView = function (superClass) {
    extend(TaxonomyFilterView, superClass);

    function TaxonomyFilterView() {
      return TaxonomyFilterView.__super__.constructor.apply(this, arguments);
    }

    TaxonomyFilterView.prototype.template = '#ug-taxonomy-filter-template';

    TaxonomyFilterView.prototype.ui = function () {
      return _.extend(TaxonomyFilterView.__super__.ui.apply(this, arguments), {
        taxonomySelect: 'select[role=taxonomy]'
      });
    };

    TaxonomyFilterView.prototype.onShow = function () {
      TaxonomyFilterView.__super__.onShow.apply(this, arguments);
      if (!this.model.get('taxonomy')) {
        return this.model.set('taxonomy', this.ui.taxonomySelect.find('option:first-child').attr('value'));
      }
    };

    return TaxonomyFilterView;
  }(FilterView);

  TaxonomyFiltersView = function (superClass) {
    extend(TaxonomyFiltersView, superClass);

    function TaxonomyFiltersView() {
      return TaxonomyFiltersView.__super__.constructor.apply(this, arguments);
    }

    TaxonomyFiltersView.prototype.template = '#ug-taxonomy-filters-template';

    TaxonomyFiltersView.prototype.childView = TaxonomyFilterView;

    return TaxonomyFiltersView;
  }(FiltersView);

  CustomFieldFilterView = function (superClass) {
    extend(CustomFieldFilterView, superClass);

    function CustomFieldFilterView() {
      return CustomFieldFilterView.__super__.constructor.apply(this, arguments);
    }

    CustomFieldFilterView.prototype.template = '#ug-custom-fields-filter-template';

    CustomFieldFilterView.prototype.ui = function () {
      return _.extend(CustomFieldFilterView.__super__.ui.apply(this, arguments), {
        keySelect: 'select[role=key]'
      });
    };

    CustomFieldFilterView.prototype.onShow = function () {
      CustomFieldFilterView.__super__.onShow.apply(this, arguments);
      if (!this.model.get('key')) {
        return this.model.set('key', this.ui.keySelect.find('option:first-child').attr('value'));
      }
    };

    return CustomFieldFilterView;
  }(FilterView);

  CustomFieldFiltersView = function (superClass) {
    extend(CustomFieldFiltersView, superClass);

    function CustomFieldFiltersView() {
      return CustomFieldFiltersView.__super__.constructor.apply(this, arguments);
    }

    CustomFieldFiltersView.prototype.template = '#ug-custom-fields-filters-template';

    CustomFieldFiltersView.prototype.childView = CustomFieldFilterView;

    return CustomFieldFiltersView;
  }(FiltersView);

  CellTemplateView = function (superClass) {
    extend(CellTemplateView, superClass);

    function CellTemplateView() {
      this.onCollectionChange = bind(this.onCollectionChange, this);
      return CellTemplateView.__super__.constructor.apply(this, arguments);
    }

    CellTemplateView.prototype.template = '#ug-auto-cell-template-template';

    CellTemplateView.prototype.regions = function () {
      return _.extend(CellTemplateView.__super__.regions.apply(this, arguments), {
        legend: '.ug-cell-legend-wrapper',
        application: '.ug-cell-application-wrapper'
      });
    };

    CellTemplateView.prototype.ui = function () {
      return _.extend(CellTemplateView.__super__.ui.apply(this, arguments), {
        application: '.ug-cell-application-wrapper'
      });
    };

    CellTemplateView.prototype.initialize = function () {
      this.listenTo(this.model.collection, 'remove', this.onCollectionChange);
      this.listenTo(this.model.collection, 'add', this.onCollectionChange);
      return this.listenTo(this.getOption('ownerModel'), 'change:choose_template_method', this.onTemplateSelectionMethodChanged);
    };

    CellTemplateView.prototype.onCollectionChange = function () {
      if (this.model.collection.length === 1) {
        if (this.ui.removeLink.hide) {
          return this.ui.removeLink.hide();
        }
      } else {
        if (this.ui.removeLink.show) {
          return this.ui.removeLink.show();
        }
      }
    };

    CellTemplateView.prototype.onTemplateSelectionMethodChanged = function () {
      var method, params;
      params = {
        model: this.model,
        className: 'ug-section ug-expandable'
      };
      method = this.getOption('ownerModel').get('choose_template_method');
      switch (method) {
        case 'php':
          this.ui.application.show();
          return this.application.show(new CellEditorSectionView(_.extend(params, {
            template: '#ug-auto-cell-template-php-application-mode'
          })));
        case 'taxonomy':
          this.ui.application.show();
          return this.application.show(new CellEditorSectionView(_.extend(params, {
            template: '#ug-auto-cell-template-taxonomy-application-mode'
          })));
        default:
          this.ui.application.hide();
          return this.application.empty();
      }
    };

    CellTemplateView.prototype.onShow = function () {
      return this.onCollectionChange();
    };

    CellTemplateView.prototype.displaySections = function () {
      this.legend.show(new CellEditorSectionView({
        template: '#ug-auto-cell-template-legend-section-template',
        className: 'ug-section ug-expandable'
      }));
      this.onTemplateSelectionMethodChanged();
      this.main.show(new CellTemplateMainSectionView({
        model: this.model,
        className: 'ug-section ug-expandable'
      }));
      this.layout.show(new CellEditorLayoutSectionView({
        model: this.model,
        className: 'ug-section ug-expandable'
      }));
      this.hover.show(new CellEditorHoverSectionView({
        model: this.model.get('hover')
      }));
      this.label.show(new CellEditorLabelSectionView({
        model: this.model.get('label')
      }));
      this.binding = rivets.bind(this.$el, {
        model: this.model
      });
      return this.linking.show(new CellEditorLinkingSectionView({
        model: this.model.get('link')
      }));
    };

    CellTemplateView.prototype.hideSections = function () {
      var i, len, ref, region, results;
      this.binding.unbind();
      ref = [this.legend, this.main, this.layout, this.linking, this.hover, this.label];
      results = [];
      for (i = 0, len = ref.length; i < len; i++) {
        region = ref[i];
        results.push(region.empty());
      }
      return results;
    };

    return CellTemplateView;
  }(CellEditorBase);

  CellTemplatesView = function (superClass) {
    extend(CellTemplatesView, superClass);

    function CellTemplatesView() {
      this.onAddCellClicked = bind(this.onAddCellClicked, this);
      this.childViewOptions = bind(this.childViewOptions, this);
      return CellTemplatesView.__super__.constructor.apply(this, arguments);
    }

    CellTemplatesView.prototype.template = '#ug-auto-cell-templates-wrapper-template';

    CellTemplatesView.prototype.childView = CellTemplateView;

    CellTemplatesView.prototype.ui = function () {
      return _.extend(CellTemplatesView.__super__.ui.apply(this, arguments), {
        header: '.cells-header'
      });
    };

    CellTemplatesView.prototype.childViewOptions = function (child, index) {
      return {
        ownerModel: this.model
      };
    };

    CellTemplatesView.prototype.onAddCellClicked = function (event) {
      var cell;
      event.preventDefault();
      this.collection.add(cell = new CellTemplate());
      return this.children.findByModel(cell).scrollTo();
    };

    CellTemplatesView.prototype.onShow = function () {
      return this.binding = rivets.bind(this.ui.header, this.model);
    };

    return CellTemplatesView;
  }(ManualEditorView);

  AutoEditorQueryView = function (superClass) {
    extend(AutoEditorQueryView, superClass);

    function AutoEditorQueryView() {
      return AutoEditorQueryView.__super__.constructor.apply(this, arguments);
    }

    AutoEditorQueryView.prototype.id = 'auto-post-settings';

    AutoEditorQueryView.prototype.template = "#ug-auto-mode-query-template";

    AutoEditorQueryView.prototype.className = 'ug-cell';

    AutoEditorQueryView.prototype.regions = {
      taxonomyFilters: '.ug-taxonomy-filters-wrapper',
      customFieldFilters: '.ug-custom-field-filters-wrapper'
    };

    AutoEditorQueryView.prototype.onShow = function () {
      this.binding = rivets.bind(this.$el, {
        model: this.model
      });
      this.taxonomyFilters.show(new TaxonomyFiltersView({
        collection: this.model.get('taxonomyFilters'),
        model: this.model
      }));
      return this.customFieldFilters.show(new CustomFieldFiltersView({
        collection: this.model.get('customFieldFilters'),
        model: this.model
      }));
    };

    return AutoEditorQueryView;
  }(Marionette.LayoutView);

  AutoCategoriesView = function (superClass) {
    extend(AutoCategoriesView, superClass);

    function AutoCategoriesView() {
      return AutoCategoriesView.__super__.constructor.apply(this, arguments);
    }

    AutoCategoriesView.prototype.template = '#ug-auto-mode-filters-source';

    AutoCategoriesView.prototype.className = 'ug-cell';

    AutoCategoriesView.prototype.onAttach = function () {
      return this.binding = rivets.bind(this.$el, this.model);
    };

    return AutoCategoriesView;
  }(Marionette.ItemView);

  module.exports = AutomaticEditorView = function (superClass) {
    extend(AutomaticEditorView, superClass);

    function AutomaticEditorView() {
      return AutomaticEditorView.__super__.constructor.apply(this, arguments);
    }

    AutomaticEditorView.prototype.template = '#auto-mode-template';

    AutomaticEditorView.prototype.regions = {
      query: '.ug-post-query-wrapper',
      categories: '.ug-categories-wrapper',
      cellTemplate: '.ug-cell-template'
    };

    AutomaticEditorView.prototype.onShow = function () {
      this.query.show(new AutoEditorQueryView({
        model: this.model
      }));
      this.categories.show(new AutoCategoriesView({
        model: this.model
      }));
      return this.cellTemplate.show(new CellTemplatesView({
        collection: this.model.get('cellTemplates'),
        model: this.model
      }));
    };

    return AutomaticEditorView;
  }(Marionette.LayoutView);
}).call(this);
},{"./manual-editor":21,"./cell-editor-base":36,"./cell-editor-section.coffee":35,"./sections.coffee":37}],5:[function(require,module,exports) {
(function () {
  var AutomaticEditorView,
      GridEditor,
      ManualEditorView,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  ManualEditorView = require('./manual-editor.coffee').ManualEditorView;

  AutomaticEditorView = require('./automatic-editor.coffee');

  module.exports = GridEditor = function (superClass) {
    extend(GridEditor, superClass);

    function GridEditor() {
      this.onAutomaticClicked = bind(this.onAutomaticClicked, this);
      this.enableManual = bind(this.enableManual, this);
      this.onManualClicked = bind(this.onManualClicked, this);
      return GridEditor.__super__.constructor.apply(this, arguments);
    }

    GridEditor.prototype.ui = {
      manualModeTab: '#ug-manual-mode-link',
      autoModeTab: '#ug-auto-mode-link'
    };

    GridEditor.prototype.events = {
      'click @ui.manualModeTab': 'onManualClicked',
      'click @ui.autoModeTab': 'onAutomaticClicked'
    };

    GridEditor.prototype.regions = {
      editor: '#ug-editor-wrapper'
    };

    GridEditor.prototype.initialize = function () {
      GridEditor.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      return this.chooseMode();
    };

    GridEditor.prototype.chooseMode = function () {
      if (this.model.get('mode') !== 'auto') {
        return this.enableManual();
      } else {
        return this.enableAutomatic();
      }
    };

    GridEditor.prototype.onManualClicked = function (e) {
      e.preventDefault();
      return this.enableManual();
    };

    GridEditor.prototype.enableManual = function () {
      this.ui.autoModeTab.removeClass('nav-tab-active');
      this.ui.manualModeTab.addClass('nav-tab-active');
      this.model.set('mode', 'manual');
      return this.editor.show(new ManualEditorView({
        collection: this.model.get('cells')
      }));
    };

    GridEditor.prototype.onAutomaticClicked = function (e) {
      e.preventDefault();
      return this.enableAutomatic();
    };

    GridEditor.prototype.enableAutomatic = function () {
      this.ui.autoModeTab.addClass('nav-tab-active');
      this.ui.manualModeTab.removeClass('nav-tab-active');
      this.model.set('mode', 'auto');
      return this.editor.show(new AutomaticEditorView({
        model: this.model.get('auto')
      }));
    };

    return GridEditor;
  }(Marionette.LayoutView);
}).call(this);
},{"./manual-editor.coffee":21,"./automatic-editor.coffee":22}],100:[function(require,module,exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef

},{}],129:[function(require,module,exports) {
module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};

},{}],101:[function(require,module,exports) {
// optional / simple context binding
var aFunction = require('./_a-function');
module.exports = function (fn, that, length) {
  aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1: return function (a) {
      return fn.call(that, a);
    };
    case 2: return function (a, b) {
      return fn.call(that, a, b);
    };
    case 3: return function (a, b, c) {
      return fn.call(that, a, b, c);
    };
  }
  return function (/* ...args */) {
    return fn.apply(that, arguments);
  };
};

},{"./_a-function":129}],131:[function(require,module,exports) {
module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};

},{}],118:[function(require,module,exports) {
var isObject = require('./_is-object');
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};

},{"./_is-object":131}],97:[function(require,module,exports) {
module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};

},{}],104:[function(require,module,exports) {
// Thank's IE8 for his funny defineProperty
module.exports = !require('./_fails')(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_fails":97}],134:[function(require,module,exports) {
var isObject = require('./_is-object');
var document = require('./_global').document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};

},{"./_is-object":131,"./_global":100}],119:[function(require,module,exports) {
module.exports = !require('./_descriptors') && !require('./_fails')(function () {
  return Object.defineProperty(require('./_dom-create')('div'), 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_descriptors":104,"./_fails":97,"./_dom-create":134}],120:[function(require,module,exports) {
// 7.1.1 ToPrimitive(input [, PreferredType])
var isObject = require('./_is-object');
// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
module.exports = function (it, S) {
  if (!isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};

},{"./_is-object":131}],105:[function(require,module,exports) {
var anObject = require('./_an-object');
var IE8_DOM_DEFINE = require('./_ie8-dom-define');
var toPrimitive = require('./_to-primitive');
var dP = Object.defineProperty;

exports.f = require('./_descriptors') ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  anObject(O);
  P = toPrimitive(P, true);
  anObject(Attributes);
  if (IE8_DOM_DEFINE) try {
    return dP(O, P, Attributes);
  } catch (e) { /* empty */ }
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};

},{"./_an-object":118,"./_ie8-dom-define":119,"./_to-primitive":120,"./_descriptors":104}],117:[function(require,module,exports) {
module.exports = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};

},{}],102:[function(require,module,exports) {
var dP = require('./_object-dp');
var createDesc = require('./_property-desc');
module.exports = require('./_descriptors') ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};

},{"./_object-dp":105,"./_property-desc":117,"./_descriptors":104}],103:[function(require,module,exports) {
var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};

},{}],84:[function(require,module,exports) {

var global = require('./_global');
var core = require('./_core');
var ctx = require('./_ctx');
var hide = require('./_hide');
var has = require('./_has');
var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F;
  var IS_GLOBAL = type & $export.G;
  var IS_STATIC = type & $export.S;
  var IS_PROTO = type & $export.P;
  var IS_BIND = type & $export.B;
  var IS_WRAP = type & $export.W;
  var exports = IS_GLOBAL ? core : core[name] || (core[name] = {});
  var expProto = exports[PROTOTYPE];
  var target = IS_GLOBAL ? global : IS_STATIC ? global[name] : (global[name] || {})[PROTOTYPE];
  var key, own, out;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    if (own && has(exports, key)) continue;
    // export native or passed
    out = own ? target[key] : source[key];
    // prevent global pollution for namespaces
    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
    // bind timers to global for call from export context
    : IS_BIND && own ? ctx(out, global)
    // wrap global constructors for prevent change them in library
    : IS_WRAP && target[key] == out ? (function (C) {
      var F = function (a, b, c) {
        if (this instanceof C) {
          switch (arguments.length) {
            case 0: return new C();
            case 1: return new C(a);
            case 2: return new C(a, b);
          } return new C(a, b, c);
        } return C.apply(this, arguments);
      };
      F[PROTOTYPE] = C[PROTOTYPE];
      return F;
    // make static versions for prototype methods
    })(out) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
    if (IS_PROTO) {
      (exports.virtual || (exports.virtual = {}))[key] = out;
      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
      if (type & $export.R && expProto && !expProto[key]) hide(expProto, key, out);
    }
  }
};
// type bitmap
$export.F = 1;   // forced
$export.G = 2;   // global
$export.S = 4;   // static
$export.P = 8;   // proto
$export.B = 16;  // bind
$export.W = 32;  // wrap
$export.U = 64;  // safe
$export.R = 128; // real proto method for `library`
module.exports = $export;

},{"./_global":100,"./_core":55,"./_ctx":101,"./_hide":102,"./_has":103}],126:[function(require,module,exports) {
var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};

},{}],96:[function(require,module,exports) {
// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = require('./_cof');
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};

},{"./_cof":126}],122:[function(require,module,exports) {
// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};

},{}],144:[function(require,module,exports) {
// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = require('./_iobject');
var defined = require('./_defined');
module.exports = function (it) {
  return IObject(defined(it));
};

},{"./_iobject":96,"./_defined":122}],148:[function(require,module,exports) {
// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};

},{}],152:[function(require,module,exports) {
// 7.1.15 ToLength
var toInteger = require('./_to-integer');
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};

},{"./_to-integer":148}],153:[function(require,module,exports) {
var toInteger = require('./_to-integer');
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};

},{"./_to-integer":148}],147:[function(require,module,exports) {
// false -> Array#indexOf
// true  -> Array#includes
var toIObject = require('./_to-iobject');
var toLength = require('./_to-length');
var toAbsoluteIndex = require('./_to-absolute-index');
module.exports = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = toIObject($this);
    var length = toLength(O.length);
    var index = toAbsoluteIndex(fromIndex, length);
    var value;
    // Array#includes uses SameValueZero equality algorithm
    // eslint-disable-next-line no-self-compare
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      // eslint-disable-next-line no-self-compare
      if (value != value) return true;
    // Array#indexOf ignores holes, Array#includes - not
    } else for (;length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    } return !IS_INCLUDES && -1;
  };
};

},{"./_to-iobject":144,"./_to-length":152,"./_to-absolute-index":153}],136:[function(require,module,exports) {

var global = require('./_global');
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});
module.exports = function (key) {
  return store[key] || (store[key] = {});
};

},{"./_global":100}],137:[function(require,module,exports) {
var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};

},{}],125:[function(require,module,exports) {
var shared = require('./_shared')('keys');
var uid = require('./_uid');
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};

},{"./_shared":136,"./_uid":137}],115:[function(require,module,exports) {
var has = require('./_has');
var toIObject = require('./_to-iobject');
var arrayIndexOf = require('./_array-includes')(false);
var IE_PROTO = require('./_shared-key')('IE_PROTO');

module.exports = function (object, names) {
  var O = toIObject(object);
  var i = 0;
  var result = [];
  var key;
  for (key in O) if (key != IE_PROTO) has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};

},{"./_has":103,"./_to-iobject":144,"./_array-includes":147,"./_shared-key":125}],116:[function(require,module,exports) {
// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');

},{}],92:[function(require,module,exports) {
// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = require('./_object-keys-internal');
var enumBugKeys = require('./_enum-bug-keys');

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};

},{"./_object-keys-internal":115,"./_enum-bug-keys":116}],93:[function(require,module,exports) {
exports.f = Object.getOwnPropertySymbols;

},{}],94:[function(require,module,exports) {
exports.f = {}.propertyIsEnumerable;

},{}],95:[function(require,module,exports) {
// 7.1.13 ToObject(argument)
var defined = require('./_defined');
module.exports = function (it) {
  return Object(defined(it));
};

},{"./_defined":122}],85:[function(require,module,exports) {
'use strict';
// 19.1.2.1 Object.assign(target, source, ...)
var getKeys = require('./_object-keys');
var gOPS = require('./_object-gops');
var pIE = require('./_object-pie');
var toObject = require('./_to-object');
var IObject = require('./_iobject');
var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
module.exports = !$assign || require('./_fails')(function () {
  var A = {};
  var B = {};
  // eslint-disable-next-line no-undef
  var S = Symbol();
  var K = 'abcdefghijklmnopqrst';
  A[S] = 7;
  K.split('').forEach(function (k) { B[k] = k; });
  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
}) ? function assign(target, source) { // eslint-disable-line no-unused-vars
  var T = toObject(target);
  var aLen = arguments.length;
  var index = 1;
  var getSymbols = gOPS.f;
  var isEnum = pIE.f;
  while (aLen > index) {
    var S = IObject(arguments[index++]);
    var keys = getSymbols ? getKeys(S).concat(getSymbols(S)) : getKeys(S);
    var length = keys.length;
    var j = 0;
    var key;
    while (length > j) if (isEnum.call(S, key = keys[j++])) T[key] = S[key];
  } return T;
} : $assign;

},{"./_object-keys":92,"./_object-gops":93,"./_object-pie":94,"./_to-object":95,"./_iobject":96,"./_fails":97}],78:[function(require,module,exports) {
// 19.1.3.1 Object.assign(target, source)
var $export = require('./_export');

$export($export.S + $export.F, 'Object', { assign: require('./_object-assign') });

},{"./_export":84,"./_object-assign":85}],50:[function(require,module,exports) {
require('../../modules/es6.object.assign');
module.exports = require('../../modules/_core').Object.assign;

},{"../../modules/es6.object.assign":78,"../../modules/_core":55}],23:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/assign"), __esModule: true };
},{"core-js/library/fn/object/assign":50}],98:[function(require,module,exports) {
// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var has = require('./_has');
var toObject = require('./_to-object');
var IE_PROTO = require('./_shared-key')('IE_PROTO');
var ObjectProto = Object.prototype;

module.exports = Object.getPrototypeOf || function (O) {
  O = toObject(O);
  if (has(O, IE_PROTO)) return O[IE_PROTO];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  } return O instanceof Object ? ObjectProto : null;
};

},{"./_has":103,"./_to-object":95,"./_shared-key":125}],99:[function(require,module,exports) {
// most Object methods by ES6 should accept primitives
var $export = require('./_export');
var core = require('./_core');
var fails = require('./_fails');
module.exports = function (KEY, exec) {
  var fn = (core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  $export($export.S + $export.F * fails(function () { fn(1); }), 'Object', exp);
};

},{"./_export":84,"./_core":55,"./_fails":97}],86:[function(require,module,exports) {
// 19.1.2.9 Object.getPrototypeOf(O)
var toObject = require('./_to-object');
var $getPrototypeOf = require('./_object-gpo');

require('./_object-sap')('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return $getPrototypeOf(toObject(it));
  };
});

},{"./_to-object":95,"./_object-gpo":98,"./_object-sap":99}],74:[function(require,module,exports) {
require('../../modules/es6.object.get-prototype-of');
module.exports = require('../../modules/_core').Object.getPrototypeOf;

},{"../../modules/es6.object.get-prototype-of":86,"../../modules/_core":55}],38:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/get-prototype-of"), __esModule: true };
},{"core-js/library/fn/object/get-prototype-of":74}],39:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

exports.default = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};
},{}],89:[function(require,module,exports) {
var $export = require('./_export');
// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
$export($export.S + $export.F * !require('./_descriptors'), 'Object', { defineProperty: require('./_object-dp').f });

},{"./_export":84,"./_descriptors":104,"./_object-dp":105}],83:[function(require,module,exports) {
require('../../modules/es6.object.define-property');
var $Object = require('../../modules/_core').Object;
module.exports = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};

},{"../../modules/es6.object.define-property":89,"../../modules/_core":55}],69:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/define-property"), __esModule: true };
},{"core-js/library/fn/object/define-property":83}],40:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _defineProperty = require("../core-js/object/define-property");

var _defineProperty2 = _interopRequireDefault(_defineProperty);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      (0, _defineProperty2.default)(target, descriptor.key, descriptor);
    }
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor;
  };
}();
},{"../core-js/object/define-property":69}],123:[function(require,module,exports) {
var toInteger = require('./_to-integer');
var defined = require('./_defined');
// true  -> String#at
// false -> String#codePointAt
module.exports = function (TO_STRING) {
  return function (that, pos) {
    var s = String(defined(that));
    var i = toInteger(pos);
    var l = s.length;
    var a, b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
      ? TO_STRING ? s.charAt(i) : a
      : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};

},{"./_to-integer":148,"./_defined":122}],138:[function(require,module,exports) {
module.exports = true;

},{}],139:[function(require,module,exports) {
module.exports = require('./_hide');

},{"./_hide":102}],128:[function(require,module,exports) {
module.exports = {};

},{}],133:[function(require,module,exports) {
var dP = require('./_object-dp');
var anObject = require('./_an-object');
var getKeys = require('./_object-keys');

module.exports = require('./_descriptors') ? Object.defineProperties : function defineProperties(O, Properties) {
  anObject(O);
  var keys = getKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) dP.f(O, P = keys[i++], Properties[P]);
  return O;
};

},{"./_object-dp":105,"./_an-object":118,"./_object-keys":92,"./_descriptors":104}],135:[function(require,module,exports) {
var document = require('./_global').document;
module.exports = document && document.documentElement;

},{"./_global":100}],113:[function(require,module,exports) {
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var anObject = require('./_an-object');
var dPs = require('./_object-dps');
var enumBugKeys = require('./_enum-bug-keys');
var IE_PROTO = require('./_shared-key')('IE_PROTO');
var Empty = function () { /* empty */ };
var PROTOTYPE = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = require('./_dom-create')('iframe');
  var i = enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  require('./_html').appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE][enumBugKeys[i]];
  return createDict();
};

module.exports = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE] = anObject(O);
    result = new Empty();
    Empty[PROTOTYPE] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO] = O;
  } else result = createDict();
  return Properties === undefined ? result : dPs(result, Properties);
};

},{"./_an-object":118,"./_object-dps":133,"./_enum-bug-keys":116,"./_shared-key":125,"./_dom-create":134,"./_html":135}],121:[function(require,module,exports) {
var store = require('./_shared')('wks');
var uid = require('./_uid');
var Symbol = require('./_global').Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;

},{"./_shared":136,"./_uid":137,"./_global":100}],141:[function(require,module,exports) {
var def = require('./_object-dp').f;
var has = require('./_has');
var TAG = require('./_wks')('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};

},{"./_object-dp":105,"./_has":103,"./_wks":121}],149:[function(require,module,exports) {
'use strict';
var create = require('./_object-create');
var descriptor = require('./_property-desc');
var setToStringTag = require('./_set-to-string-tag');
var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
require('./_hide')(IteratorPrototype, require('./_wks')('iterator'), function () { return this; });

module.exports = function (Constructor, NAME, next) {
  Constructor.prototype = create(IteratorPrototype, { next: descriptor(1, next) });
  setToStringTag(Constructor, NAME + ' Iterator');
};

},{"./_object-create":113,"./_property-desc":117,"./_set-to-string-tag":141,"./_hide":102,"./_wks":121}],124:[function(require,module,exports) {
'use strict';
var LIBRARY = require('./_library');
var $export = require('./_export');
var redefine = require('./_redefine');
var hide = require('./_hide');
var Iterators = require('./_iterators');
var $iterCreate = require('./_iter-create');
var setToStringTag = require('./_set-to-string-tag');
var getPrototypeOf = require('./_object-gpo');
var ITERATOR = require('./_wks')('iterator');
var BUGGY = !([].keys && 'next' in [].keys()); // Safari has buggy iterators w/o `next`
var FF_ITERATOR = '@@iterator';
var KEYS = 'keys';
var VALUES = 'values';

var returnThis = function () { return this; };

module.exports = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  $iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS: return function keys() { return new Constructor(this, kind); };
      case VALUES: return function values() { return new Constructor(this, kind); };
    } return function entries() { return new Constructor(this, kind); };
  };
  var TAG = NAME + ' Iterator';
  var DEF_VALUES = DEFAULT == VALUES;
  var VALUES_BUG = false;
  var proto = Base.prototype;
  var $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT];
  var $default = $native || getMethod(DEFAULT);
  var $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined;
  var $anyNative = NAME == 'Array' ? proto.entries || $native : $native;
  var methods, key, IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = getPrototypeOf($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype && IteratorPrototype.next) {
      // Set @@toStringTag to native iterators
      setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!LIBRARY && typeof IteratorPrototype[ITERATOR] != 'function') hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() { return $native.call(this); };
  }
  // Define iterator
  if ((!LIBRARY || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    hide(proto, ITERATOR, $default);
  }
  // Plug for library
  Iterators[NAME] = $default;
  Iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) redefine(proto, key, methods[key]);
    } else $export($export.P + $export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};

},{"./_library":138,"./_export":84,"./_redefine":139,"./_hide":102,"./_iterators":128,"./_iter-create":149,"./_set-to-string-tag":141,"./_object-gpo":98,"./_wks":121}],106:[function(require,module,exports) {
'use strict';
var $at = require('./_string-at')(true);

// 21.1.3.27 String.prototype[@@iterator]()
require('./_iter-define')(String, 'String', function (iterated) {
  this._t = String(iterated); // target
  this._i = 0;                // next index
// 21.1.5.2.1 %StringIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var index = this._i;
  var point;
  if (index >= O.length) return { value: undefined, done: true };
  point = $at(O, index);
  this._i += point.length;
  return { value: point, done: false };
});

},{"./_string-at":123,"./_iter-define":124}],150:[function(require,module,exports) {
module.exports = function () { /* empty */ };

},{}],151:[function(require,module,exports) {
module.exports = function (done, value) {
  return { value: value, done: !!done };
};

},{}],127:[function(require,module,exports) {
'use strict';
var addToUnscopables = require('./_add-to-unscopables');
var step = require('./_iter-step');
var Iterators = require('./_iterators');
var toIObject = require('./_to-iobject');

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
module.exports = require('./_iter-define')(Array, 'Array', function (iterated, kind) {
  this._t = toIObject(iterated); // target
  this._i = 0;                   // next index
  this._k = kind;                // kind
// 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var kind = this._k;
  var index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return step(1);
  }
  if (kind == 'keys') return step(0, index);
  if (kind == 'values') return step(0, O[index]);
  return step(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
Iterators.Arguments = Iterators.Array;

addToUnscopables('keys');
addToUnscopables('values');
addToUnscopables('entries');

},{"./_add-to-unscopables":150,"./_iter-step":151,"./_iterators":128,"./_to-iobject":144,"./_iter-define":124}],107:[function(require,module,exports) {

require('./es6.array.iterator');
var global = require('./_global');
var hide = require('./_hide');
var Iterators = require('./_iterators');
var TO_STRING_TAG = require('./_wks')('toStringTag');

var DOMIterables = ('CSSRuleList,CSSStyleDeclaration,CSSValueList,ClientRectList,DOMRectList,DOMStringList,' +
  'DOMTokenList,DataTransferItemList,FileList,HTMLAllCollection,HTMLCollection,HTMLFormElement,HTMLSelectElement,' +
  'MediaList,MimeTypeArray,NamedNodeMap,NodeList,PaintRequestList,Plugin,PluginArray,SVGLengthList,SVGNumberList,' +
  'SVGPathSegList,SVGPointList,SVGStringList,SVGTransformList,SourceBufferList,StyleSheetList,TextTrackCueList,' +
  'TextTrackList,TouchList').split(',');

for (var i = 0; i < DOMIterables.length; i++) {
  var NAME = DOMIterables[i];
  var Collection = global[NAME];
  var proto = Collection && Collection.prototype;
  if (proto && !proto[TO_STRING_TAG]) hide(proto, TO_STRING_TAG, NAME);
  Iterators[NAME] = Iterators.Array;
}

},{"./es6.array.iterator":127,"./_global":100,"./_hide":102,"./_iterators":128,"./_wks":121}],108:[function(require,module,exports) {
exports.f = require('./_wks');

},{"./_wks":121}],87:[function(require,module,exports) {
require('../../modules/es6.string.iterator');
require('../../modules/web.dom.iterable');
module.exports = require('../../modules/_wks-ext').f('iterator');

},{"../../modules/es6.string.iterator":106,"../../modules/web.dom.iterable":107,"../../modules/_wks-ext":108}],80:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/symbol/iterator"), __esModule: true };
},{"core-js/library/fn/symbol/iterator":87}],140:[function(require,module,exports) {
var META = require('./_uid')('meta');
var isObject = require('./_is-object');
var has = require('./_has');
var setDesc = require('./_object-dp').f;
var id = 0;
var isExtensible = Object.isExtensible || function () {
  return true;
};
var FREEZE = !require('./_fails')(function () {
  return isExtensible(Object.preventExtensions({}));
});
var setMeta = function (it) {
  setDesc(it, META, { value: {
    i: 'O' + ++id, // object ID
    w: {}          // weak collections IDs
  } });
};
var fastKey = function (it, create) {
  // return primitive with prefix
  if (!isObject(it)) return typeof it == 'symbol' ? it : (typeof it == 'string' ? 'S' : 'P') + it;
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return 'F';
    // not necessary to add metadata
    if (!create) return 'E';
    // add missing metadata
    setMeta(it);
  // return object ID
  } return it[META].i;
};
var getWeak = function (it, create) {
  if (!has(it, META)) {
    // can't set metadata to uncaught frozen object
    if (!isExtensible(it)) return true;
    // not necessary to add metadata
    if (!create) return false;
    // add missing metadata
    setMeta(it);
  // return hash weak collections IDs
  } return it[META].w;
};
// add metadata on freeze-family methods calling
var onFreeze = function (it) {
  if (FREEZE && meta.NEED && isExtensible(it) && !has(it, META)) setMeta(it);
  return it;
};
var meta = module.exports = {
  KEY: META,
  NEED: false,
  fastKey: fastKey,
  getWeak: getWeak,
  onFreeze: onFreeze
};

},{"./_uid":137,"./_is-object":131,"./_has":103,"./_object-dp":105,"./_fails":97}],130:[function(require,module,exports) {

var global = require('./_global');
var core = require('./_core');
var LIBRARY = require('./_library');
var wksExt = require('./_wks-ext');
var defineProperty = require('./_object-dp').f;
module.exports = function (name) {
  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty($Symbol, name, { value: wksExt.f(name) });
};

},{"./_global":100,"./_core":55,"./_library":138,"./_wks-ext":108,"./_object-dp":105}],142:[function(require,module,exports) {
// all enumerable object keys, includes symbols
var getKeys = require('./_object-keys');
var gOPS = require('./_object-gops');
var pIE = require('./_object-pie');
module.exports = function (it) {
  var result = getKeys(it);
  var getSymbols = gOPS.f;
  if (getSymbols) {
    var symbols = getSymbols(it);
    var isEnum = pIE.f;
    var i = 0;
    var key;
    while (symbols.length > i) if (isEnum.call(it, key = symbols[i++])) result.push(key);
  } return result;
};

},{"./_object-keys":92,"./_object-gops":93,"./_object-pie":94}],143:[function(require,module,exports) {
// 7.2.2 IsArray(argument)
var cof = require('./_cof');
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};

},{"./_cof":126}],146:[function(require,module,exports) {
// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = require('./_object-keys-internal');
var hiddenKeys = require('./_enum-bug-keys').concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};

},{"./_object-keys-internal":115,"./_enum-bug-keys":116}],145:[function(require,module,exports) {
// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window
var toIObject = require('./_to-iobject');
var gOPN = require('./_object-gopn').f;
var toString = {}.toString;

var windowNames = typeof window == 'object' && window && Object.getOwnPropertyNames
  ? Object.getOwnPropertyNames(window) : [];

var getWindowNames = function (it) {
  try {
    return gOPN(it);
  } catch (e) {
    return windowNames.slice();
  }
};

module.exports.f = function getOwnPropertyNames(it) {
  return windowNames && toString.call(it) == '[object Window]' ? getWindowNames(it) : gOPN(toIObject(it));
};

},{"./_to-iobject":144,"./_object-gopn":146}],132:[function(require,module,exports) {
var pIE = require('./_object-pie');
var createDesc = require('./_property-desc');
var toIObject = require('./_to-iobject');
var toPrimitive = require('./_to-primitive');
var has = require('./_has');
var IE8_DOM_DEFINE = require('./_ie8-dom-define');
var gOPD = Object.getOwnPropertyDescriptor;

exports.f = require('./_descriptors') ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = toIObject(O);
  P = toPrimitive(P, true);
  if (IE8_DOM_DEFINE) try {
    return gOPD(O, P);
  } catch (e) { /* empty */ }
  if (has(O, P)) return createDesc(!pIE.f.call(O, P), O[P]);
};

},{"./_object-pie":94,"./_property-desc":117,"./_to-iobject":144,"./_to-primitive":120,"./_has":103,"./_ie8-dom-define":119,"./_descriptors":104}],109:[function(require,module,exports) {

'use strict';
// ECMAScript 6 symbols shim
var global = require('./_global');
var has = require('./_has');
var DESCRIPTORS = require('./_descriptors');
var $export = require('./_export');
var redefine = require('./_redefine');
var META = require('./_meta').KEY;
var $fails = require('./_fails');
var shared = require('./_shared');
var setToStringTag = require('./_set-to-string-tag');
var uid = require('./_uid');
var wks = require('./_wks');
var wksExt = require('./_wks-ext');
var wksDefine = require('./_wks-define');
var enumKeys = require('./_enum-keys');
var isArray = require('./_is-array');
var anObject = require('./_an-object');
var isObject = require('./_is-object');
var toIObject = require('./_to-iobject');
var toPrimitive = require('./_to-primitive');
var createDesc = require('./_property-desc');
var _create = require('./_object-create');
var gOPNExt = require('./_object-gopn-ext');
var $GOPD = require('./_object-gopd');
var $DP = require('./_object-dp');
var $keys = require('./_object-keys');
var gOPD = $GOPD.f;
var dP = $DP.f;
var gOPN = gOPNExt.f;
var $Symbol = global.Symbol;
var $JSON = global.JSON;
var _stringify = $JSON && $JSON.stringify;
var PROTOTYPE = 'prototype';
var HIDDEN = wks('_hidden');
var TO_PRIMITIVE = wks('toPrimitive');
var isEnum = {}.propertyIsEnumerable;
var SymbolRegistry = shared('symbol-registry');
var AllSymbols = shared('symbols');
var OPSymbols = shared('op-symbols');
var ObjectProto = Object[PROTOTYPE];
var USE_NATIVE = typeof $Symbol == 'function';
var QObject = global.QObject;
// Don't use setters in Qt Script, https://github.com/zloirock/core-js/issues/173
var setter = !QObject || !QObject[PROTOTYPE] || !QObject[PROTOTYPE].findChild;

// fallback for old Android, https://code.google.com/p/v8/issues/detail?id=687
var setSymbolDesc = DESCRIPTORS && $fails(function () {
  return _create(dP({}, 'a', {
    get: function () { return dP(this, 'a', { value: 7 }).a; }
  })).a != 7;
}) ? function (it, key, D) {
  var protoDesc = gOPD(ObjectProto, key);
  if (protoDesc) delete ObjectProto[key];
  dP(it, key, D);
  if (protoDesc && it !== ObjectProto) dP(ObjectProto, key, protoDesc);
} : dP;

var wrap = function (tag) {
  var sym = AllSymbols[tag] = _create($Symbol[PROTOTYPE]);
  sym._k = tag;
  return sym;
};

var isSymbol = USE_NATIVE && typeof $Symbol.iterator == 'symbol' ? function (it) {
  return typeof it == 'symbol';
} : function (it) {
  return it instanceof $Symbol;
};

var $defineProperty = function defineProperty(it, key, D) {
  if (it === ObjectProto) $defineProperty(OPSymbols, key, D);
  anObject(it);
  key = toPrimitive(key, true);
  anObject(D);
  if (has(AllSymbols, key)) {
    if (!D.enumerable) {
      if (!has(it, HIDDEN)) dP(it, HIDDEN, createDesc(1, {}));
      it[HIDDEN][key] = true;
    } else {
      if (has(it, HIDDEN) && it[HIDDEN][key]) it[HIDDEN][key] = false;
      D = _create(D, { enumerable: createDesc(0, false) });
    } return setSymbolDesc(it, key, D);
  } return dP(it, key, D);
};
var $defineProperties = function defineProperties(it, P) {
  anObject(it);
  var keys = enumKeys(P = toIObject(P));
  var i = 0;
  var l = keys.length;
  var key;
  while (l > i) $defineProperty(it, key = keys[i++], P[key]);
  return it;
};
var $create = function create(it, P) {
  return P === undefined ? _create(it) : $defineProperties(_create(it), P);
};
var $propertyIsEnumerable = function propertyIsEnumerable(key) {
  var E = isEnum.call(this, key = toPrimitive(key, true));
  if (this === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return false;
  return E || !has(this, key) || !has(AllSymbols, key) || has(this, HIDDEN) && this[HIDDEN][key] ? E : true;
};
var $getOwnPropertyDescriptor = function getOwnPropertyDescriptor(it, key) {
  it = toIObject(it);
  key = toPrimitive(key, true);
  if (it === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key)) return;
  var D = gOPD(it, key);
  if (D && has(AllSymbols, key) && !(has(it, HIDDEN) && it[HIDDEN][key])) D.enumerable = true;
  return D;
};
var $getOwnPropertyNames = function getOwnPropertyNames(it) {
  var names = gOPN(toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (!has(AllSymbols, key = names[i++]) && key != HIDDEN && key != META) result.push(key);
  } return result;
};
var $getOwnPropertySymbols = function getOwnPropertySymbols(it) {
  var IS_OP = it === ObjectProto;
  var names = gOPN(IS_OP ? OPSymbols : toIObject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (has(AllSymbols, key = names[i++]) && (IS_OP ? has(ObjectProto, key) : true)) result.push(AllSymbols[key]);
  } return result;
};

// 19.4.1.1 Symbol([description])
if (!USE_NATIVE) {
  $Symbol = function Symbol() {
    if (this instanceof $Symbol) throw TypeError('Symbol is not a constructor!');
    var tag = uid(arguments.length > 0 ? arguments[0] : undefined);
    var $set = function (value) {
      if (this === ObjectProto) $set.call(OPSymbols, value);
      if (has(this, HIDDEN) && has(this[HIDDEN], tag)) this[HIDDEN][tag] = false;
      setSymbolDesc(this, tag, createDesc(1, value));
    };
    if (DESCRIPTORS && setter) setSymbolDesc(ObjectProto, tag, { configurable: true, set: $set });
    return wrap(tag);
  };
  redefine($Symbol[PROTOTYPE], 'toString', function toString() {
    return this._k;
  });

  $GOPD.f = $getOwnPropertyDescriptor;
  $DP.f = $defineProperty;
  require('./_object-gopn').f = gOPNExt.f = $getOwnPropertyNames;
  require('./_object-pie').f = $propertyIsEnumerable;
  require('./_object-gops').f = $getOwnPropertySymbols;

  if (DESCRIPTORS && !require('./_library')) {
    redefine(ObjectProto, 'propertyIsEnumerable', $propertyIsEnumerable, true);
  }

  wksExt.f = function (name) {
    return wrap(wks(name));
  };
}

$export($export.G + $export.W + $export.F * !USE_NATIVE, { Symbol: $Symbol });

for (var es6Symbols = (
  // 19.4.2.2, 19.4.2.3, 19.4.2.4, 19.4.2.6, 19.4.2.8, 19.4.2.9, 19.4.2.10, 19.4.2.11, 19.4.2.12, 19.4.2.13, 19.4.2.14
  'hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables'
).split(','), j = 0; es6Symbols.length > j;)wks(es6Symbols[j++]);

for (var wellKnownSymbols = $keys(wks.store), k = 0; wellKnownSymbols.length > k;) wksDefine(wellKnownSymbols[k++]);

$export($export.S + $export.F * !USE_NATIVE, 'Symbol', {
  // 19.4.2.1 Symbol.for(key)
  'for': function (key) {
    return has(SymbolRegistry, key += '')
      ? SymbolRegistry[key]
      : SymbolRegistry[key] = $Symbol(key);
  },
  // 19.4.2.5 Symbol.keyFor(sym)
  keyFor: function keyFor(sym) {
    if (!isSymbol(sym)) throw TypeError(sym + ' is not a symbol!');
    for (var key in SymbolRegistry) if (SymbolRegistry[key] === sym) return key;
  },
  useSetter: function () { setter = true; },
  useSimple: function () { setter = false; }
});

$export($export.S + $export.F * !USE_NATIVE, 'Object', {
  // 19.1.2.2 Object.create(O [, Properties])
  create: $create,
  // 19.1.2.4 Object.defineProperty(O, P, Attributes)
  defineProperty: $defineProperty,
  // 19.1.2.3 Object.defineProperties(O, Properties)
  defineProperties: $defineProperties,
  // 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
  getOwnPropertyDescriptor: $getOwnPropertyDescriptor,
  // 19.1.2.7 Object.getOwnPropertyNames(O)
  getOwnPropertyNames: $getOwnPropertyNames,
  // 19.1.2.8 Object.getOwnPropertySymbols(O)
  getOwnPropertySymbols: $getOwnPropertySymbols
});

// 24.3.2 JSON.stringify(value [, replacer [, space]])
$JSON && $export($export.S + $export.F * (!USE_NATIVE || $fails(function () {
  var S = $Symbol();
  // MS Edge converts symbol values to JSON as {}
  // WebKit converts symbol values to JSON as null
  // V8 throws on boxed symbols
  return _stringify([S]) != '[null]' || _stringify({ a: S }) != '{}' || _stringify(Object(S)) != '{}';
})), 'JSON', {
  stringify: function stringify(it) {
    var args = [it];
    var i = 1;
    var replacer, $replacer;
    while (arguments.length > i) args.push(arguments[i++]);
    $replacer = replacer = args[1];
    if (!isObject(replacer) && it === undefined || isSymbol(it)) return; // IE8 returns string on undefined
    if (!isArray(replacer)) replacer = function (key, value) {
      if (typeof $replacer == 'function') value = $replacer.call(this, key, value);
      if (!isSymbol(value)) return value;
    };
    args[1] = replacer;
    return _stringify.apply($JSON, args);
  }
});

// 19.4.3.4 Symbol.prototype[@@toPrimitive](hint)
$Symbol[PROTOTYPE][TO_PRIMITIVE] || require('./_hide')($Symbol[PROTOTYPE], TO_PRIMITIVE, $Symbol[PROTOTYPE].valueOf);
// 19.4.3.5 Symbol.prototype[@@toStringTag]
setToStringTag($Symbol, 'Symbol');
// 20.2.1.9 Math[@@toStringTag]
setToStringTag(Math, 'Math', true);
// 24.3.3 JSON[@@toStringTag]
setToStringTag(global.JSON, 'JSON', true);

},{"./_global":100,"./_has":103,"./_descriptors":104,"./_export":84,"./_redefine":139,"./_meta":140,"./_fails":97,"./_shared":136,"./_set-to-string-tag":141,"./_uid":137,"./_wks":121,"./_wks-ext":108,"./_wks-define":130,"./_enum-keys":142,"./_is-array":143,"./_an-object":118,"./_is-object":131,"./_to-iobject":144,"./_to-primitive":120,"./_property-desc":117,"./_object-create":113,"./_object-gopn-ext":145,"./_object-gopd":132,"./_object-dp":105,"./_object-keys":92,"./_object-gopn":146,"./_object-pie":94,"./_object-gops":93,"./_library":138,"./_hide":102}],110:[function(require,module,exports) {

},{}],111:[function(require,module,exports) {
require('./_wks-define')('asyncIterator');

},{"./_wks-define":130}],112:[function(require,module,exports) {
require('./_wks-define')('observable');

},{"./_wks-define":130}],88:[function(require,module,exports) {
require('../../modules/es6.symbol');
require('../../modules/es6.object.to-string');
require('../../modules/es7.symbol.async-iterator');
require('../../modules/es7.symbol.observable');
module.exports = require('../../modules/_core').Symbol;

},{"../../modules/es6.symbol":109,"../../modules/es6.object.to-string":110,"../../modules/es7.symbol.async-iterator":111,"../../modules/es7.symbol.observable":112,"../../modules/_core":55}],79:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/symbol"), __esModule: true };
},{"core-js/library/fn/symbol":88}],66:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _iterator = require("../core-js/symbol/iterator");

var _iterator2 = _interopRequireDefault(_iterator);

var _symbol = require("../core-js/symbol");

var _symbol2 = _interopRequireDefault(_symbol);

var _typeof = typeof _symbol2.default === "function" && typeof _iterator2.default === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj; };

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = typeof _symbol2.default === "function" && _typeof(_iterator2.default) === "symbol" ? function (obj) {
  return typeof obj === "undefined" ? "undefined" : _typeof(obj);
} : function (obj) {
  return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj === "undefined" ? "undefined" : _typeof(obj);
};
},{"../core-js/symbol/iterator":80,"../core-js/symbol":79}],41:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _typeof2 = require("../helpers/typeof");

var _typeof3 = _interopRequireDefault(_typeof2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = function (self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return call && ((typeof call === "undefined" ? "undefined" : (0, _typeof3.default)(call)) === "object" || typeof call === "function") ? call : self;
};
},{"../helpers/typeof":66}],114:[function(require,module,exports) {
// Works with __proto__ only. Old v8 can't work with null proto objects.
/* eslint-disable no-proto */
var isObject = require('./_is-object');
var anObject = require('./_an-object');
var check = function (O, proto) {
  anObject(O);
  if (!isObject(proto) && proto !== null) throw TypeError(proto + ": can't set as prototype!");
};
module.exports = {
  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
    function (test, buggy, set) {
      try {
        set = require('./_ctx')(Function.call, require('./_object-gopd').f(Object.prototype, '__proto__').set, 2);
        set(test, []);
        buggy = !(test instanceof Array);
      } catch (e) { buggy = true; }
      return function setPrototypeOf(O, proto) {
        check(O, proto);
        if (buggy) O.__proto__ = proto;
        else set(O, proto);
        return O;
      };
    }({}, false) : undefined),
  check: check
};

},{"./_is-object":131,"./_an-object":118,"./_ctx":101,"./_object-gopd":132}],91:[function(require,module,exports) {
// 19.1.3.19 Object.setPrototypeOf(O, proto)
var $export = require('./_export');
$export($export.S, 'Object', { setPrototypeOf: require('./_set-proto').set });

},{"./_export":84,"./_set-proto":114}],82:[function(require,module,exports) {
require('../../modules/es6.object.set-prototype-of');
module.exports = require('../../modules/_core').Object.setPrototypeOf;

},{"../../modules/es6.object.set-prototype-of":91,"../../modules/_core":55}],67:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/set-prototype-of"), __esModule: true };
},{"core-js/library/fn/object/set-prototype-of":82}],90:[function(require,module,exports) {
var $export = require('./_export');
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
$export($export.S, 'Object', { create: require('./_object-create') });

},{"./_export":84,"./_object-create":113}],81:[function(require,module,exports) {
require('../../modules/es6.object.create');
var $Object = require('../../modules/_core').Object;
module.exports = function create(P, D) {
  return $Object.create(P, D);
};

},{"../../modules/es6.object.create":90,"../../modules/_core":55}],68:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/create"), __esModule: true };
},{"core-js/library/fn/object/create":81}],42:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _setPrototypeOf = require("../core-js/object/set-prototype-of");

var _setPrototypeOf2 = _interopRequireDefault(_setPrototypeOf);

var _create = require("../core-js/object/create");

var _create2 = _interopRequireDefault(_create);

var _typeof2 = require("../helpers/typeof");

var _typeof3 = _interopRequireDefault(_typeof2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = function (subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === "undefined" ? "undefined" : (0, _typeof3.default)(superClass)));
  }

  subClass.prototype = (0, _create2.default)(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      enumerable: false,
      writable: true,
      configurable: true
    }
  });
  if (superClass) _setPrototypeOf2.default ? (0, _setPrototypeOf2.default)(subClass, superClass) : subClass.__proto__ = superClass;
};
},{"../core-js/object/set-prototype-of":67,"../core-js/object/create":68,"../helpers/typeof":66}],77:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var NO_OP = '$NO_OP';
var ERROR_MSG = 'a runtime error occured! Use Inferno in development environment to find the error.';
// This should be boolean and not reference to window.document
var isBrowser = !!(typeof window !== 'undefined' && window.document);
// this is MUCH faster than .constructor === Array and instanceof Array
// in Node 7 and the later versions of V8, slower in older versions though
var isArray = Array.isArray;
function isStringOrNumber(o) {
    var type = typeof o;
    return type === 'string' || type === 'number';
}
function isNullOrUndef(o) {
    return isUndefined(o) || isNull(o);
}
function isInvalid(o) {
    return isNull(o) || o === false || isTrue(o) || isUndefined(o);
}
function isFunction(o) {
    return typeof o === 'function';
}
function isString(o) {
    return typeof o === 'string';
}
function isNumber(o) {
    return typeof o === 'number';
}
function isNull(o) {
    return o === null;
}
function isTrue(o) {
    return o === true;
}
function isUndefined(o) {
    return o === void 0;
}
function isDefined(o) {
    return o !== void 0;
}
function isObject(o) {
    return typeof o === 'object';
}
function throwError(message) {
    if (!message) {
        message = ERROR_MSG;
    }
    throw new Error("Inferno Error: " + message);
}
function combineFrom(first, second) {
    var out = {};
    if (first) {
        for (var key in first) {
            out[key] = first[key];
        }
    }
    if (second) {
        for (var key$1 in second) {
            out[key$1] = second[key$1];
        }
    }
    return out;
}

var keyPrefix = '$';
function getVNode(childFlags, children, className, flags, key, props, ref, type) {
    return {
        childFlags: childFlags,
        children: children,
        className: className,
        dom: null,
        flags: flags,
        key: key === void 0 ? null : key,
        parentVNode: null,
        props: props === void 0 ? null : props,
        ref: ref === void 0 ? null : ref,
        type: type
    };
}
function createVNode(flags, type, className, children, childFlags, props, key, ref) {
    var childFlag = childFlags === void 0 ? 1 /* HasInvalidChildren */ : childFlags;
    var vNode = getVNode(childFlag, children, className, flags, key, props, ref, type);
    var optsVNode = options.createVNode;
    if (typeof optsVNode === 'function') {
        optsVNode(vNode);
    }
    if (childFlag === 0 /* UnknownChildren */) {
            normalizeChildren(vNode, vNode.children);
        }
    return vNode;
}
function createComponentVNode(flags, type, props, key, ref) {
    if ((flags & 2 /* ComponentUnknown */) > 0) {
        flags = isDefined(type.prototype) && isFunction(type.prototype.render) ? 4 /* ComponentClass */ : 8 /* ComponentFunction */;
    }
    // set default props
    var defaultProps = type.defaultProps;
    if (!isNullOrUndef(defaultProps)) {
        if (!props) {
            props = {}; // Props can be referenced and modified at application level so always create new object
        }
        for (var prop in defaultProps) {
            if (isUndefined(props[prop])) {
                props[prop] = defaultProps[prop];
            }
        }
    }
    if ((flags & 8 /* ComponentFunction */) > 0) {
        var defaultHooks = type.defaultHooks;
        if (!isNullOrUndef(defaultHooks)) {
            if (!ref) {
                // As ref cannot be referenced from application level, we can use the same refs object
                ref = defaultHooks;
            } else {
                for (var prop$1 in defaultHooks) {
                    if (isUndefined(ref[prop$1])) {
                        ref[prop$1] = defaultHooks[prop$1];
                    }
                }
            }
        }
    }
    var vNode = getVNode(1 /* HasInvalidChildren */, null, null, flags, key, props, ref, type);
    var optsVNode = options.createVNode;
    if (isFunction(optsVNode)) {
        optsVNode(vNode);
    }
    return vNode;
}
function createTextVNode(text, key) {
    return getVNode(1 /* HasInvalidChildren */, isNullOrUndef(text) ? '' : text, null, 16 /* Text */, key, null, null, null);
}
function normalizeProps(vNode) {
    var props = vNode.props;
    if (props) {
        var flags = vNode.flags;
        if (flags & 481 /* Element */) {
                if (isDefined(props.children) && isNullOrUndef(vNode.children)) {
                    normalizeChildren(vNode, props.children);
                }
                if (isDefined(props.className)) {
                    vNode.className = props.className || null;
                    props.className = undefined;
                }
            }
        if (isDefined(props.key)) {
            vNode.key = props.key;
            props.key = undefined;
        }
        if (isDefined(props.ref)) {
            if (flags & 8 /* ComponentFunction */) {
                    vNode.ref = combineFrom(vNode.ref, props.ref);
                } else {
                vNode.ref = props.ref;
            }
            props.ref = undefined;
        }
    }
    return vNode;
}
function directClone(vNodeToClone) {
    var newVNode;
    var flags = vNodeToClone.flags;
    if (flags & 14 /* Component */) {
            var props;
            var propsToClone = vNodeToClone.props;
            if (!isNull(propsToClone)) {
                props = {};
                for (var key in propsToClone) {
                    props[key] = propsToClone[key];
                }
            }
            newVNode = createComponentVNode(flags, vNodeToClone.type, props, vNodeToClone.key, vNodeToClone.ref);
        } else if (flags & 481 /* Element */) {
            var children = vNodeToClone.children;
            newVNode = createVNode(flags, vNodeToClone.type, vNodeToClone.className, children, vNodeToClone.childFlags, vNodeToClone.props, vNodeToClone.key, vNodeToClone.ref);
        } else if (flags & 16 /* Text */) {
            newVNode = createTextVNode(vNodeToClone.children, vNodeToClone.key);
        } else if (flags & 1024 /* Portal */) {
            newVNode = vNodeToClone;
        }
    return newVNode;
}
function createVoidVNode() {
    return createTextVNode('', null);
}
function _normalizeVNodes(nodes, result, index, currentKey) {
    for (var len = nodes.length; index < len; index++) {
        var n = nodes[index];
        if (!isInvalid(n)) {
            var newKey = currentKey + keyPrefix + index;
            if (isArray(n)) {
                _normalizeVNodes(n, result, 0, newKey);
            } else {
                if (isStringOrNumber(n)) {
                    n = createTextVNode(n, newKey);
                } else {
                    var oldKey = n.key;
                    var isPrefixedKey = isString(oldKey) && oldKey[0] === keyPrefix;
                    if (!isNull(n.dom) || isPrefixedKey) {
                        n = directClone(n);
                    }
                    if (isNull(oldKey) || isPrefixedKey) {
                        n.key = newKey;
                    } else {
                        n.key = currentKey + oldKey;
                    }
                }
                result.push(n);
            }
        }
    }
}
function getFlagsForElementVnode(type) {
    if (type === 'svg') {
        return 32 /* SvgElement */;
    }
    if (type === 'input') {
        return 64 /* InputElement */;
    }
    if (type === 'select') {
        return 256 /* SelectElement */;
    }
    if (type === 'textarea') {
        return 128 /* TextareaElement */;
    }
    return 1 /* HtmlElement */;
}
function normalizeChildren(vNode, children) {
    var newChildren;
    var newChildFlags = 1 /* HasInvalidChildren */;
    // Don't change children to match strict equal (===) true in patching
    if (isInvalid(children)) {
        newChildren = children;
    } else if (isString(children)) {
        newChildFlags = 2 /* HasVNodeChildren */;
        newChildren = createTextVNode(children);
    } else if (isNumber(children)) {
        newChildFlags = 2 /* HasVNodeChildren */;
        newChildren = createTextVNode(children + '');
    } else if (isArray(children)) {
        var len = children.length;
        if (len === 0) {
            newChildren = null;
            newChildFlags = 1 /* HasInvalidChildren */;
        } else {
            // we assign $ which basically means we've flagged this array for future note
            // if it comes back again, we need to clone it, as people are using it
            // in an immutable way
            // tslint:disable-next-line
            if (Object.isFrozen(children) || children['$'] === true) {
                children = children.slice();
            }
            newChildFlags = 8 /* HasKeyedChildren */;
            for (var i = 0; i < len; i++) {
                var n = children[i];
                if (isInvalid(n) || isArray(n)) {
                    newChildren = newChildren || children.slice(0, i);
                    _normalizeVNodes(children, newChildren, i, '');
                    break;
                } else if (isStringOrNumber(n)) {
                    newChildren = newChildren || children.slice(0, i);
                    newChildren.push(createTextVNode(n, keyPrefix + i));
                } else {
                    var key = n.key;
                    var isNullDom = isNull(n.dom);
                    var isNullKey = isNull(key);
                    var isPrefixed = !isNullKey && key[0] === keyPrefix;
                    if (!isNullDom || isNullKey || isPrefixed) {
                        newChildren = newChildren || children.slice(0, i);
                        if (!isNullDom || isPrefixed) {
                            n = directClone(n);
                        }
                        if (isNullKey || isPrefixed) {
                            n.key = keyPrefix + i;
                        }
                        newChildren.push(n);
                    } else if (newChildren) {
                        newChildren.push(n);
                    }
                }
            }
            newChildren = newChildren || children;
            newChildren.$ = true;
        }
    } else {
        newChildren = children;
        if (!isNull(children.dom)) {
            newChildren = directClone(children);
        }
        newChildFlags = 2 /* HasVNodeChildren */;
    }
    vNode.children = newChildren;
    vNode.childFlags = newChildFlags;
    return vNode;
}
var options = {
    afterMount: null,
    afterRender: null,
    afterUpdate: null,
    beforeRender: null,
    beforeUnmount: null,
    createVNode: null,
    roots: []
};

/**
 * Links given data to event as first parameter
 * @param {*} data data to be linked, it will be available in function as first parameter
 * @param {Function} event Function to be called when event occurs
 * @returns {{data: *, event: Function}}
 */
function linkEvent(data, event) {
    if (isFunction(event)) {
        return { data: data, event: event };
    }
    return null; // Return null when event is invalid, to avoid creating unnecessary event handlers
}

var xlinkNS = 'http://www.w3.org/1999/xlink';
var xmlNS = 'http://www.w3.org/XML/1998/namespace';
var svgNS = 'http://www.w3.org/2000/svg';
var namespaces = {
    'xlink:actuate': xlinkNS,
    'xlink:arcrole': xlinkNS,
    'xlink:href': xlinkNS,
    'xlink:role': xlinkNS,
    'xlink:show': xlinkNS,
    'xlink:title': xlinkNS,
    'xlink:type': xlinkNS,
    'xml:base': xmlNS,
    'xml:lang': xmlNS,
    'xml:space': xmlNS
};

// We need EMPTY_OBJ defined in one place.
// Its used for comparison so we cant inline it into shared
var EMPTY_OBJ = {};
var LIFECYCLE = [];
function appendChild(parentDom, dom) {
    parentDom.appendChild(dom);
}
function insertOrAppend(parentDom, newNode, nextNode) {
    if (isNullOrUndef(nextNode)) {
        appendChild(parentDom, newNode);
    } else {
        parentDom.insertBefore(newNode, nextNode);
    }
}
function documentCreateElement(tag, isSVG) {
    if (isSVG === true) {
        return document.createElementNS(svgNS, tag);
    }
    return document.createElement(tag);
}
function replaceChild(parentDom, newDom, lastDom) {
    parentDom.replaceChild(newDom, lastDom);
}
function removeChild(parentDom, dom) {
    parentDom.removeChild(dom);
}
function callAll(arrayFn) {
    var listener;
    while ((listener = arrayFn.shift()) !== undefined) {
        listener();
    }
}

var attachedEventCounts = {};
var attachedEvents = {};
function handleEvent(name, nextEvent, dom) {
    var eventsLeft = attachedEventCounts[name];
    var eventsObject = dom.$EV;
    if (nextEvent) {
        if (!eventsLeft) {
            attachedEvents[name] = attachEventToDocument(name);
            attachedEventCounts[name] = 0;
        }
        if (!eventsObject) {
            eventsObject = dom.$EV = {};
        }
        if (!eventsObject[name]) {
            attachedEventCounts[name]++;
        }
        eventsObject[name] = nextEvent;
    } else if (eventsObject && eventsObject[name]) {
        attachedEventCounts[name]--;
        if (eventsLeft === 1) {
            document.removeEventListener(normalizeEventName(name), attachedEvents[name]);
            attachedEvents[name] = null;
        }
        eventsObject[name] = nextEvent;
    }
}
function dispatchEvents(event, target, isClick, name, eventData) {
    var dom = target;
    while (!isNull(dom)) {
        // Html Nodes can be nested fe: span inside button in that scenario browser does not handle disabled attribute on parent,
        // because the event listener is on document.body
        // Don't process clicks on disabled elements
        if (isClick && dom.disabled) {
            return;
        }
        var eventsObject = dom.$EV;
        if (eventsObject) {
            var currentEvent = eventsObject[name];
            if (currentEvent) {
                // linkEvent object
                eventData.dom = dom;
                if (currentEvent.event) {
                    currentEvent.event(currentEvent.data, event);
                } else {
                    currentEvent(event);
                }
                if (event.cancelBubble) {
                    return;
                }
            }
        }
        dom = dom.parentNode;
    }
}
function normalizeEventName(name) {
    return name.substr(2).toLowerCase();
}
function stopPropagation() {
    this.cancelBubble = true;
    this.stopImmediatePropagation();
}
function attachEventToDocument(name) {
    var docEvent = function (event) {
        var type = event.type;
        var isClick = type === 'click' || type === 'dblclick';
        if (isClick && event.button !== 0) {
            // Firefox incorrectly triggers click event for mid/right mouse buttons.
            // This bug has been active for 12 years.
            // https://bugzilla.mozilla.org/show_bug.cgi?id=184051
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
        event.stopPropagation = stopPropagation;
        // Event data needs to be object to save reference to currentTarget getter
        var eventData = {
            dom: document
        };
        Object.defineProperty(event, 'currentTarget', {
            configurable: true,
            get: function get() {
                return eventData.dom;
            }
        });
        dispatchEvents(event, event.target, isClick, name, eventData);
        return;
    };
    document.addEventListener(normalizeEventName(name), docEvent);
    return docEvent;
}

function isSameInnerHTML(dom, innerHTML) {
    var tempdom = document.createElement('i');
    tempdom.innerHTML = innerHTML;
    return tempdom.innerHTML === dom.innerHTML;
}
function isSamePropsInnerHTML(dom, props) {
    return Boolean(props && props.dangerouslySetInnerHTML && props.dangerouslySetInnerHTML.__html && isSameInnerHTML(dom, props.dangerouslySetInnerHTML.__html));
}

function triggerEventListener(props, methodName, e) {
    if (props[methodName]) {
        var listener = props[methodName];
        if (listener.event) {
            listener.event(listener.data, e);
        } else {
            listener(e);
        }
    } else {
        var nativeListenerName = methodName.toLowerCase();
        if (props[nativeListenerName]) {
            props[nativeListenerName](e);
        }
    }
}
function createWrappedFunction(methodName, applyValue) {
    var fnMethod = function (e) {
        e.stopPropagation();
        var vNode = this.$V;
        // If vNode is gone by the time event fires, no-op
        if (!vNode) {
            return;
        }
        var props = vNode.props || EMPTY_OBJ;
        var dom = vNode.dom;
        if (isString(methodName)) {
            triggerEventListener(props, methodName, e);
        } else {
            for (var i = 0; i < methodName.length; i++) {
                triggerEventListener(props, methodName[i], e);
            }
        }
        if (isFunction(applyValue)) {
            var newVNode = this.$V;
            var newProps = newVNode.props || EMPTY_OBJ;
            applyValue(newProps, dom, false, newVNode);
        }
    };
    Object.defineProperty(fnMethod, 'wrapped', {
        configurable: false,
        enumerable: false,
        value: true,
        writable: false
    });
    return fnMethod;
}

function isCheckedType(type) {
    return type === 'checkbox' || type === 'radio';
}
var onTextInputChange = createWrappedFunction('onInput', applyValueInput);
var wrappedOnChange = createWrappedFunction(['onClick', 'onChange'], applyValueInput);
/* tslint:disable-next-line:no-empty */
function emptywrapper(event) {
    event.stopPropagation();
}
emptywrapper.wrapped = true;
function inputEvents(dom, nextPropsOrEmpty) {
    if (isCheckedType(nextPropsOrEmpty.type)) {
        dom.onchange = wrappedOnChange;
        dom.onclick = emptywrapper;
    } else {
        dom.oninput = onTextInputChange;
    }
}
function applyValueInput(nextPropsOrEmpty, dom) {
    var type = nextPropsOrEmpty.type;
    var value = nextPropsOrEmpty.value;
    var checked = nextPropsOrEmpty.checked;
    var multiple = nextPropsOrEmpty.multiple;
    var defaultValue = nextPropsOrEmpty.defaultValue;
    var hasValue = !isNullOrUndef(value);
    if (type && type !== dom.type) {
        dom.setAttribute('type', type);
    }
    if (!isNullOrUndef(multiple) && multiple !== dom.multiple) {
        dom.multiple = multiple;
    }
    if (!isNullOrUndef(defaultValue) && !hasValue) {
        dom.defaultValue = defaultValue + '';
    }
    if (isCheckedType(type)) {
        if (hasValue) {
            dom.value = value;
        }
        if (!isNullOrUndef(checked)) {
            dom.checked = checked;
        }
    } else {
        if (hasValue && dom.value !== value) {
            dom.defaultValue = value;
            dom.value = value;
        } else if (!isNullOrUndef(checked)) {
            dom.checked = checked;
        }
    }
}

function updateChildOptionGroup(vNode, value) {
    var type = vNode.type;
    if (type === 'optgroup') {
        var children = vNode.children;
        var childFlags = vNode.childFlags;
        if (childFlags & 12 /* MultipleChildren */) {
                for (var i = 0, len = children.length; i < len; i++) {
                    updateChildOption(children[i], value);
                }
            } else if (childFlags === 2 /* HasVNodeChildren */) {
                updateChildOption(children, value);
            }
    } else {
        updateChildOption(vNode, value);
    }
}
function updateChildOption(vNode, value) {
    var props = vNode.props || EMPTY_OBJ;
    var dom = vNode.dom;
    // we do this as multiple may have changed
    dom.value = props.value;
    if (isArray(value) && value.indexOf(props.value) !== -1 || props.value === value) {
        dom.selected = true;
    } else if (!isNullOrUndef(value) || !isNullOrUndef(props.selected)) {
        dom.selected = props.selected || false;
    }
}
var onSelectChange = createWrappedFunction('onChange', applyValueSelect);
function selectEvents(dom) {
    dom.onchange = onSelectChange;
}
function applyValueSelect(nextPropsOrEmpty, dom, mounting, vNode) {
    var multiplePropInBoolean = Boolean(nextPropsOrEmpty.multiple);
    if (!isNullOrUndef(nextPropsOrEmpty.multiple) && multiplePropInBoolean !== dom.multiple) {
        dom.multiple = multiplePropInBoolean;
    }
    var childFlags = vNode.childFlags;
    if ((childFlags & 1 /* HasInvalidChildren */) === 0) {
        var children = vNode.children;
        var value = nextPropsOrEmpty.value;
        if (mounting && isNullOrUndef(value)) {
            value = nextPropsOrEmpty.defaultValue;
        }
        if (childFlags & 12 /* MultipleChildren */) {
                for (var i = 0, len = children.length; i < len; i++) {
                    updateChildOptionGroup(children[i], value);
                }
            } else if (childFlags === 2 /* HasVNodeChildren */) {
                updateChildOptionGroup(children, value);
            }
    }
}

var onTextareaInputChange = createWrappedFunction('onInput', applyValueTextArea);
var wrappedOnChange$1 = createWrappedFunction('onChange');
function textAreaEvents(dom, nextPropsOrEmpty) {
    dom.oninput = onTextareaInputChange;
    if (nextPropsOrEmpty.onChange) {
        dom.onchange = wrappedOnChange$1;
    }
}
function applyValueTextArea(nextPropsOrEmpty, dom, mounting) {
    var value = nextPropsOrEmpty.value;
    var domValue = dom.value;
    if (isNullOrUndef(value)) {
        if (mounting) {
            var defaultValue = nextPropsOrEmpty.defaultValue;
            if (!isNullOrUndef(defaultValue) && defaultValue !== domValue) {
                dom.defaultValue = defaultValue;
                dom.value = defaultValue;
            }
        }
    } else if (domValue !== value) {
        /* There is value so keep it controlled */
        dom.defaultValue = value;
        dom.value = value;
    }
}

/**
 * There is currently no support for switching same input between controlled and nonControlled
 * If that ever becomes a real issue, then re design controlled elements
 * Currently user must choose either controlled or non-controlled and stick with that
 */
function processElement(flags, vNode, dom, nextPropsOrEmpty, mounting, isControlled) {
    if (flags & 64 /* InputElement */) {
            applyValueInput(nextPropsOrEmpty, dom);
        } else if (flags & 256 /* SelectElement */) {
            applyValueSelect(nextPropsOrEmpty, dom, mounting, vNode);
        } else if (flags & 128 /* TextareaElement */) {
            applyValueTextArea(nextPropsOrEmpty, dom, mounting);
        }
    if (isControlled) {
        dom.$V = vNode;
    }
}
function addFormElementEventHandlers(flags, dom, nextPropsOrEmpty) {
    if (flags & 64 /* InputElement */) {
            inputEvents(dom, nextPropsOrEmpty);
        } else if (flags & 256 /* SelectElement */) {
            selectEvents(dom);
        } else if (flags & 128 /* TextareaElement */) {
            textAreaEvents(dom, nextPropsOrEmpty);
        }
}
function isControlledFormElement(nextPropsOrEmpty) {
    return nextPropsOrEmpty.type && isCheckedType(nextPropsOrEmpty.type) ? !isNullOrUndef(nextPropsOrEmpty.checked) : !isNullOrUndef(nextPropsOrEmpty.value);
}

function remove(vNode, parentDom) {
    unmount(vNode);
    if (!isNull(parentDom)) {
        removeChild(parentDom, vNode.dom);
        // Let carbage collector free memory
        vNode.dom = null;
    }
}
function unmount(vNode) {
    var flags = vNode.flags;
    if (flags & 481 /* Element */) {
            var ref = vNode.ref;
            var props = vNode.props;
            if (isFunction(ref)) {
                ref(null);
            }
            var children = vNode.children;
            var childFlags = vNode.childFlags;
            if (childFlags & 12 /* MultipleChildren */) {
                    unmountAllChildren(children);
                } else if (childFlags === 2 /* HasVNodeChildren */) {
                    unmount(children);
                }
            if (!isNull(props)) {
                for (var name in props) {
                    switch (name) {
                        case 'onClick':
                        case 'onDblClick':
                        case 'onFocusIn':
                        case 'onFocusOut':
                        case 'onKeyDown':
                        case 'onKeyPress':
                        case 'onKeyUp':
                        case 'onMouseDown':
                        case 'onMouseMove':
                        case 'onMouseUp':
                        case 'onSubmit':
                        case 'onTouchEnd':
                        case 'onTouchMove':
                        case 'onTouchStart':
                            handleEvent(name, null, vNode.dom);
                            break;
                        default:
                            break;
                    }
                }
            }
        } else if (flags & 14 /* Component */) {
            var instance = vNode.children;
            var ref$1 = vNode.ref;
            if (flags & 4 /* ComponentClass */) {
                    if (isFunction(options.beforeUnmount)) {
                        options.beforeUnmount(vNode);
                    }
                    if (isFunction(instance.componentWillUnmount)) {
                        instance.componentWillUnmount();
                    }
                    if (isFunction(ref$1)) {
                        ref$1(null);
                    }
                    instance.$UN = true;
                    unmount(instance.$LI);
                } else {
                if (!isNullOrUndef(ref$1) && isFunction(ref$1.onComponentWillUnmount)) {
                    ref$1.onComponentWillUnmount(vNode.dom, vNode.props || EMPTY_OBJ);
                }
                unmount(instance);
            }
        } else if (flags & 1024 /* Portal */) {
            var children$1 = vNode.children;
            if (!isNull(children$1) && isObject(children$1)) {
                remove(children$1, vNode.type);
            }
        }
}
function unmountAllChildren(children) {
    for (var i = 0, len = children.length; i < len; i++) {
        unmount(children[i]);
    }
}
function removeAllChildren(dom, children) {
    unmountAllChildren(children);
    dom.textContent = '';
}

function createLinkEvent(linkEvent, nextValue) {
    return function (e) {
        linkEvent(nextValue.data, e);
    };
}
function patchEvent(name, lastValue, nextValue, dom) {
    var nameLowerCase = name.toLowerCase();
    if (!isFunction(nextValue) && !isNullOrUndef(nextValue)) {
        var linkEvent = nextValue.event;
        if (linkEvent && isFunction(linkEvent)) {
            dom[nameLowerCase] = createLinkEvent(linkEvent, nextValue);
        } else {}
    } else {
        var domEvent = dom[nameLowerCase];
        // if the function is wrapped, that means it's been controlled by a wrapper
        if (!domEvent || !domEvent.wrapped) {
            dom[nameLowerCase] = nextValue;
        }
    }
}
function getNumberStyleValue(style, value) {
    switch (style) {
        case 'animationIterationCount':
        case 'borderImageOutset':
        case 'borderImageSlice':
        case 'borderImageWidth':
        case 'boxFlex':
        case 'boxFlexGroup':
        case 'boxOrdinalGroup':
        case 'columnCount':
        case 'fillOpacity':
        case 'flex':
        case 'flexGrow':
        case 'flexNegative':
        case 'flexOrder':
        case 'flexPositive':
        case 'flexShrink':
        case 'floodOpacity':
        case 'fontWeight':
        case 'gridColumn':
        case 'gridRow':
        case 'lineClamp':
        case 'lineHeight':
        case 'opacity':
        case 'order':
        case 'orphans':
        case 'stopOpacity':
        case 'strokeDasharray':
        case 'strokeDashoffset':
        case 'strokeMiterlimit':
        case 'strokeOpacity':
        case 'strokeWidth':
        case 'tabSize':
        case 'widows':
        case 'zIndex':
        case 'zoom':
            return value;
        default:
            return value + 'px';
    }
}
// We are assuming here that we come from patchProp routine
// -nextAttrValue cannot be null or undefined
function patchStyle(lastAttrValue, nextAttrValue, dom) {
    var domStyle = dom.style;
    var style;
    var value;
    if (isString(nextAttrValue)) {
        domStyle.cssText = nextAttrValue;
        return;
    }
    if (!isNullOrUndef(lastAttrValue) && !isString(lastAttrValue)) {
        for (style in nextAttrValue) {
            // do not add a hasOwnProperty check here, it affects performance
            value = nextAttrValue[style];
            if (value !== lastAttrValue[style]) {
                domStyle[style] = isNumber(value) ? getNumberStyleValue(style, value) : value;
            }
        }
        for (style in lastAttrValue) {
            if (isNullOrUndef(nextAttrValue[style])) {
                domStyle[style] = '';
            }
        }
    } else {
        for (style in nextAttrValue) {
            value = nextAttrValue[style];
            domStyle[style] = isNumber(value) ? getNumberStyleValue(style, value) : value;
        }
    }
}
function patchProp(prop, lastValue, nextValue, dom, isSVG, hasControlledValue, lastVNode) {
    switch (prop) {
        case 'onClick':
        case 'onDblClick':
        case 'onFocusIn':
        case 'onFocusOut':
        case 'onKeyDown':
        case 'onKeyPress':
        case 'onKeyUp':
        case 'onMouseDown':
        case 'onMouseMove':
        case 'onMouseUp':
        case 'onSubmit':
        case 'onTouchEnd':
        case 'onTouchMove':
        case 'onTouchStart':
            handleEvent(prop, nextValue, dom);
            break;
        case 'children':
        case 'childrenType':
        case 'className':
        case 'defaultValue':
        case 'key':
        case 'multiple':
        case 'ref':
            return;
        case 'allowfullscreen':
        case 'autoFocus':
        case 'autoplay':
        case 'capture':
        case 'checked':
        case 'controls':
        case 'default':
        case 'disabled':
        case 'hidden':
        case 'indeterminate':
        case 'loop':
        case 'muted':
        case 'novalidate':
        case 'open':
        case 'readOnly':
        case 'required':
        case 'reversed':
        case 'scoped':
        case 'seamless':
        case 'selected':
            prop = prop === 'autoFocus' ? prop.toLowerCase() : prop;
            dom[prop] = !!nextValue;
            break;
        case 'defaultChecked':
        case 'value':
        case 'volume':
            if (hasControlledValue && prop === 'value') {
                return;
            }
            var value = isNullOrUndef(nextValue) ? '' : nextValue;
            if (dom[prop] !== value) {
                dom[prop] = value;
            }
            break;
        case 'dangerouslySetInnerHTML':
            var lastHtml = lastValue && lastValue.__html || '';
            var nextHtml = nextValue && nextValue.__html || '';
            if (lastHtml !== nextHtml) {
                if (!isNullOrUndef(nextHtml) && !isSameInnerHTML(dom, nextHtml)) {
                    if (!isNull(lastVNode)) {
                        if (lastVNode.childFlags & 12 /* MultipleChildren */) {
                                unmountAllChildren(lastVNode.children);
                            } else if (lastVNode.childFlags === 2 /* HasVNodeChildren */) {
                                unmount(lastVNode.children);
                            }
                        lastVNode.children = null;
                        lastVNode.childFlags = 1 /* HasInvalidChildren */;
                    }
                    dom.innerHTML = nextHtml;
                }
            }
            break;
        default:
            if (prop[0] === 'o' && prop[1] === 'n') {
                patchEvent(prop, lastValue, nextValue, dom);
            } else if (isNullOrUndef(nextValue)) {
                dom.removeAttribute(prop);
            } else if (prop === 'style') {
                patchStyle(lastValue, nextValue, dom);
            } else if (isSVG && namespaces[prop]) {
                // We optimize for NS being boolean. Its 99.9% time false
                // If we end up in this path we can read property again
                dom.setAttributeNS(namespaces[prop], prop, nextValue);
            } else {
                dom.setAttribute(prop, nextValue);
            }
            break;
    }
}
function mountProps(vNode, flags, props, dom, isSVG) {
    var hasControlledValue = false;
    var isFormElement = (flags & 448 /* FormElement */) > 0;
    if (isFormElement) {
        hasControlledValue = isControlledFormElement(props);
        if (hasControlledValue) {
            addFormElementEventHandlers(flags, dom, props);
        }
    }
    for (var prop in props) {
        // do not add a hasOwnProperty check here, it affects performance
        patchProp(prop, null, props[prop], dom, isSVG, hasControlledValue, null);
    }
    if (isFormElement) {
        processElement(flags, vNode, dom, props, true, hasControlledValue);
    }
}

function createClassComponentInstance(vNode, Component, props, context) {
    var instance = new Component(props, context);
    vNode.children = instance;
    instance.$V = vNode;
    instance.$BS = false;
    instance.context = context;
    if (instance.props === EMPTY_OBJ) {
        instance.props = props;
    }
    instance.$UN = false;
    if (isFunction(instance.componentWillMount)) {
        instance.$BR = true;
        instance.componentWillMount();
        if (instance.$PSS) {
            var state = instance.state;
            var pending = instance.$PS;
            if (isNull(state)) {
                instance.state = pending;
            } else {
                for (var key in pending) {
                    state[key] = pending[key];
                }
            }
            instance.$PSS = false;
            instance.$PS = null;
        }
        instance.$BR = false;
    }
    if (isFunction(options.beforeRender)) {
        options.beforeRender(instance);
    }
    var input = handleComponentInput(instance.render(props, instance.state, context), vNode);
    var childContext;
    if (isFunction(instance.getChildContext)) {
        childContext = instance.getChildContext();
    }
    if (isNullOrUndef(childContext)) {
        instance.$CX = context;
    } else {
        instance.$CX = combineFrom(context, childContext);
    }
    if (isFunction(options.afterRender)) {
        options.afterRender(instance);
    }
    instance.$LI = input;
    return instance;
}
function handleComponentInput(input, componentVNode) {
    if (isInvalid(input)) {
        input = createVoidVNode();
    } else if (isStringOrNumber(input)) {
        input = createTextVNode(input, null);
    } else {
        if (input.dom) {
            input = directClone(input);
        }
        if (input.flags & 14 /* Component */) {
                // if we have an input that is also a component, we run into a tricky situation
                // where the root vNode needs to always have the correct DOM entry
                // we can optimise this in the future, but this gets us out of a lot of issues
                input.parentVNode = componentVNode;
            }
    }
    return input;
}

function mount(vNode, parentDom, lifecycle, context, isSVG) {
    var flags = vNode.flags;
    if (flags & 481 /* Element */) {
            return mountElement(vNode, parentDom, lifecycle, context, isSVG);
        }
    if (flags & 14 /* Component */) {
            return mountComponent(vNode, parentDom, lifecycle, context, isSVG, (flags & 4 /* ComponentClass */) > 0);
        }
    if (flags & 512 /* Void */ || flags & 16 /* Text */) {
            return mountText(vNode, parentDom);
        }
    if (flags & 1024 /* Portal */) {
            mount(vNode.children, vNode.type, lifecycle, context, false);
            return vNode.dom = mountText(createVoidVNode(), parentDom);
        }
}
function mountText(vNode, parentDom) {
    var dom = vNode.dom = document.createTextNode(vNode.children);
    if (!isNull(parentDom)) {
        appendChild(parentDom, dom);
    }
    return dom;
}
function mountElement(vNode, parentDom, lifecycle, context, isSVG) {
    var flags = vNode.flags;
    var children = vNode.children;
    var props = vNode.props;
    var className = vNode.className;
    var ref = vNode.ref;
    var childFlags = vNode.childFlags;
    isSVG = isSVG || (flags & 32 /* SvgElement */) > 0;
    var dom = documentCreateElement(vNode.type, isSVG);
    vNode.dom = dom;
    if (!isNullOrUndef(className) && className !== '') {
        if (isSVG) {
            dom.setAttribute('class', className);
        } else {
            dom.className = className;
        }
    }
    if (!isNull(parentDom)) {
        appendChild(parentDom, dom);
    }
    if ((childFlags & 1 /* HasInvalidChildren */) === 0) {
        var childrenIsSVG = isSVG === true && vNode.type !== 'foreignObject';
        if (childFlags === 2 /* HasVNodeChildren */) {
                mount(children, dom, lifecycle, context, childrenIsSVG);
            } else if (childFlags & 12 /* MultipleChildren */) {
                mountArrayChildren(children, dom, lifecycle, context, childrenIsSVG);
            }
    }
    if (!isNull(props)) {
        mountProps(vNode, flags, props, dom, isSVG);
    }
    if (isFunction(ref)) {
        mountRef(dom, ref, lifecycle);
    }
    return dom;
}
function mountArrayChildren(children, dom, lifecycle, context, isSVG) {
    for (var i = 0, len = children.length; i < len; i++) {
        var child = children[i];
        if (!isNull(child.dom)) {
            children[i] = child = directClone(child);
        }
        mount(child, dom, lifecycle, context, isSVG);
    }
}
function mountComponent(vNode, parentDom, lifecycle, context, isSVG, isClass) {
    var dom;
    var type = vNode.type;
    var props = vNode.props || EMPTY_OBJ;
    var ref = vNode.ref;
    if (isClass) {
        var instance = createClassComponentInstance(vNode, type, props, context);
        vNode.dom = dom = mount(instance.$LI, null, lifecycle, instance.$CX, isSVG);
        mountClassComponentCallbacks(vNode, ref, instance, lifecycle);
        instance.$UPD = false;
    } else {
        var input = handleComponentInput(type(props, context), vNode);
        vNode.children = input;
        vNode.dom = dom = mount(input, null, lifecycle, context, isSVG);
        mountFunctionalComponentCallbacks(props, ref, dom, lifecycle);
    }
    if (!isNull(parentDom)) {
        appendChild(parentDom, dom);
    }
    return dom;
}
function createClassMountCallback(instance, hasAfterMount, afterMount, vNode, hasDidMount) {
    return function () {
        instance.$UPD = true;
        if (hasAfterMount) {
            afterMount(vNode);
        }
        if (hasDidMount) {
            instance.componentDidMount();
        }
        instance.$UPD = false;
    };
}
function mountClassComponentCallbacks(vNode, ref, instance, lifecycle) {
    if (isFunction(ref)) {
        ref(instance);
    } else {}
    var hasDidMount = isFunction(instance.componentDidMount);
    var afterMount = options.afterMount;
    var hasAfterMount = isFunction(afterMount);
    if (hasDidMount || hasAfterMount) {
        lifecycle.push(createClassMountCallback(instance, hasAfterMount, afterMount, vNode, hasDidMount));
    }
}
// Create did mount callback lazily to avoid creating function context if not needed
function createOnMountCallback(ref, dom, props) {
    return function () {
        return ref.onComponentDidMount(dom, props);
    };
}
function mountFunctionalComponentCallbacks(props, ref, dom, lifecycle) {
    if (!isNullOrUndef(ref)) {
        if (isFunction(ref.onComponentWillMount)) {
            ref.onComponentWillMount(props);
        }
        if (isFunction(ref.onComponentDidMount)) {
            lifecycle.push(createOnMountCallback(ref, dom, props));
        }
    }
}
function mountRef(dom, value, lifecycle) {
    lifecycle.push(function () {
        return value(dom);
    });
}

function hydrateComponent(vNode, dom, lifecycle, context, isSVG, isClass) {
    var type = vNode.type;
    var ref = vNode.ref;
    var props = vNode.props || EMPTY_OBJ;
    if (isClass) {
        var instance = createClassComponentInstance(vNode, type, props, context);
        var input = instance.$LI;
        hydrateVNode(input, dom, lifecycle, instance.$CX, isSVG);
        vNode.dom = input.dom;
        mountClassComponentCallbacks(vNode, ref, instance, lifecycle);
        instance.$UPD = false; // Mount finished allow going sync
    } else {
        var input$1 = handleComponentInput(type(props, context), vNode);
        hydrateVNode(input$1, dom, lifecycle, context, isSVG);
        vNode.children = input$1;
        vNode.dom = input$1.dom;
        mountFunctionalComponentCallbacks(props, ref, dom, lifecycle);
    }
}
function hydrateElement(vNode, dom, lifecycle, context, isSVG) {
    var children = vNode.children;
    var props = vNode.props;
    var className = vNode.className;
    var flags = vNode.flags;
    var ref = vNode.ref;
    isSVG = isSVG || (flags & 32 /* SvgElement */) > 0;
    if (dom.nodeType !== 1 || dom.tagName.toLowerCase() !== vNode.type) {
        var newDom = mountElement(vNode, null, lifecycle, context, isSVG);
        vNode.dom = newDom;
        replaceChild(dom.parentNode, newDom, dom);
    } else {
        vNode.dom = dom;
        var childNode = dom.firstChild;
        var childFlags = vNode.childFlags;
        if ((childFlags & 1 /* HasInvalidChildren */) === 0) {
            var nextSibling = null;
            while (childNode) {
                nextSibling = childNode.nextSibling;
                if (childNode.nodeType === 8) {
                    if (childNode.data === '!') {
                        dom.replaceChild(document.createTextNode(''), childNode);
                    } else {
                        dom.removeChild(childNode);
                    }
                }
                childNode = nextSibling;
            }
            childNode = dom.firstChild;
            if (childFlags === 2 /* HasVNodeChildren */) {
                    if (isNull(childNode)) {
                        mount(children, dom, lifecycle, context, isSVG);
                    } else {
                        nextSibling = childNode.nextSibling;
                        hydrateVNode(children, childNode, lifecycle, context, isSVG);
                        childNode = nextSibling;
                    }
                } else if (childFlags & 12 /* MultipleChildren */) {
                    for (var i = 0, len = children.length; i < len; i++) {
                        var child = children[i];
                        if (isNull(childNode)) {
                            mount(child, dom, lifecycle, context, isSVG);
                        } else {
                            nextSibling = childNode.nextSibling;
                            hydrateVNode(child, childNode, lifecycle, context, isSVG);
                            childNode = nextSibling;
                        }
                    }
                }
            // clear any other DOM nodes, there should be only a single entry for the root
            while (childNode) {
                nextSibling = childNode.nextSibling;
                dom.removeChild(childNode);
                childNode = nextSibling;
            }
        } else if (!isNull(dom.firstChild) && !isSamePropsInnerHTML(dom, props)) {
            dom.textContent = ''; // dom has content, but VNode has no children remove everything from DOM
            if (flags & 448 /* FormElement */) {
                    // If element is form element, we need to clear defaultValue also
                    dom.defaultValue = '';
                }
        }
        if (!isNull(props)) {
            mountProps(vNode, flags, props, dom, isSVG);
        }
        if (isNullOrUndef(className)) {
            if (dom.className !== '') {
                dom.removeAttribute('class');
            }
        } else if (isSVG) {
            dom.setAttribute('class', className);
        } else {
            dom.className = className;
        }
        if (isFunction(ref)) {
            mountRef(dom, ref, lifecycle);
        } else {}
    }
}
function hydrateText(vNode, dom) {
    if (dom.nodeType !== 3) {
        var newDom = mountText(vNode, null);
        vNode.dom = newDom;
        replaceChild(dom.parentNode, newDom, dom);
    } else {
        var text = vNode.children;
        if (dom.nodeValue !== text) {
            dom.nodeValue = text;
        }
        vNode.dom = dom;
    }
}
function hydrateVNode(vNode, dom, lifecycle, context, isSVG) {
    var flags = vNode.flags;
    if (flags & 14 /* Component */) {
            hydrateComponent(vNode, dom, lifecycle, context, isSVG, (flags & 4 /* ComponentClass */) > 0);
        } else if (flags & 481 /* Element */) {
            hydrateElement(vNode, dom, lifecycle, context, isSVG);
        } else if (flags & 16 /* Text */) {
            hydrateText(vNode, dom);
        } else if (flags & 512 /* Void */) {
            vNode.dom = dom;
        } else {
        throwError();
    }
}
function hydrate(input, parentDom, callback) {
    var dom = parentDom.firstChild;
    if (!isNull(dom)) {
        if (!isInvalid(input)) {
            hydrateVNode(input, dom, LIFECYCLE, EMPTY_OBJ, false);
        }
        dom = parentDom.firstChild;
        // clear any other DOM nodes, there should be only a single entry for the root
        while (dom = dom.nextSibling) {
            parentDom.removeChild(dom);
        }
    }
    if (LIFECYCLE.length > 0) {
        callAll(LIFECYCLE);
    }
    if (!parentDom.$V) {
        options.roots.push(parentDom);
    }
    parentDom.$V = input;
    if (isFunction(callback)) {
        callback();
    }
}

function replaceWithNewNode(lastNode, nextNode, parentDom, lifecycle, context, isSVG) {
    unmount(lastNode);
    replaceChild(parentDom, mount(nextNode, null, lifecycle, context, isSVG), lastNode.dom);
}
function patch(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG) {
    if (lastVNode !== nextVNode) {
        var nextFlags = nextVNode.flags | 0;
        if (lastVNode.flags !== nextFlags || nextFlags & 2048 /* ReCreate */) {
                replaceWithNewNode(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG);
            } else if (nextFlags & 481 /* Element */) {
                patchElement(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG);
            } else if (nextFlags & 14 /* Component */) {
                patchComponent(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG, (nextFlags & 4 /* ComponentClass */) > 0);
            } else if (nextFlags & 16 /* Text */) {
                patchText(lastVNode, nextVNode, parentDom);
            } else if (nextFlags & 512 /* Void */) {
                nextVNode.dom = lastVNode.dom;
            } else {
            // Portal
            patchPortal(lastVNode, nextVNode, lifecycle, context);
        }
    }
}
function patchPortal(lastVNode, nextVNode, lifecycle, context) {
    var lastContainer = lastVNode.type;
    var nextContainer = nextVNode.type;
    var nextChildren = nextVNode.children;
    patchChildren(lastVNode.childFlags, nextVNode.childFlags, lastVNode.children, nextChildren, lastContainer, lifecycle, context, false);
    nextVNode.dom = lastVNode.dom;
    if (lastContainer !== nextContainer && !isInvalid(nextChildren)) {
        var node = nextChildren.dom;
        lastContainer.removeChild(node);
        nextContainer.appendChild(node);
    }
}
function patchElement(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG) {
    var nextTag = nextVNode.type;
    if (lastVNode.type !== nextTag) {
        replaceWithNewNode(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG);
    } else {
        var dom = lastVNode.dom;
        var nextFlags = nextVNode.flags;
        var lastProps = lastVNode.props;
        var nextProps = nextVNode.props;
        var isFormElement = false;
        var hasControlledValue = false;
        var nextPropsOrEmpty;
        nextVNode.dom = dom;
        isSVG = isSVG || (nextFlags & 32 /* SvgElement */) > 0;
        // inlined patchProps  -- starts --
        if (lastProps !== nextProps) {
            var lastPropsOrEmpty = lastProps || EMPTY_OBJ;
            nextPropsOrEmpty = nextProps || EMPTY_OBJ;
            if (nextPropsOrEmpty !== EMPTY_OBJ) {
                isFormElement = (nextFlags & 448 /* FormElement */) > 0;
                if (isFormElement) {
                    hasControlledValue = isControlledFormElement(nextPropsOrEmpty);
                }
                for (var prop in nextPropsOrEmpty) {
                    var lastValue = lastPropsOrEmpty[prop];
                    var nextValue = nextPropsOrEmpty[prop];
                    if (lastValue !== nextValue) {
                        patchProp(prop, lastValue, nextValue, dom, isSVG, hasControlledValue, lastVNode);
                    }
                }
            }
            if (lastPropsOrEmpty !== EMPTY_OBJ) {
                for (var prop$1 in lastPropsOrEmpty) {
                    // do not add a hasOwnProperty check here, it affects performance
                    if (!nextPropsOrEmpty.hasOwnProperty(prop$1) && !isNullOrUndef(lastPropsOrEmpty[prop$1])) {
                        patchProp(prop$1, lastPropsOrEmpty[prop$1], null, dom, isSVG, hasControlledValue, lastVNode);
                    }
                }
            }
        }
        var lastChildren = lastVNode.children;
        var nextChildren = nextVNode.children;
        var nextRef = nextVNode.ref;
        var lastClassName = lastVNode.className;
        var nextClassName = nextVNode.className;
        if (lastChildren !== nextChildren) {
            patchChildren(lastVNode.childFlags, nextVNode.childFlags, lastChildren, nextChildren, dom, lifecycle, context, isSVG && nextTag !== 'foreignObject');
        }
        if (isFormElement) {
            processElement(nextFlags, nextVNode, dom, nextPropsOrEmpty, false, hasControlledValue);
        }
        // inlined patchProps  -- ends --
        if (lastClassName !== nextClassName) {
            if (isNullOrUndef(nextClassName)) {
                dom.removeAttribute('class');
            } else if (isSVG) {
                dom.setAttribute('class', nextClassName);
            } else {
                dom.className = nextClassName;
            }
        }
        if (isFunction(nextRef) && lastVNode.ref !== nextRef) {
            mountRef(dom, nextRef, lifecycle);
        } else {}
    }
}
function patchChildren(lastChildFlags, nextChildFlags, lastChildren, nextChildren, parentDOM, lifecycle, context, isSVG) {
    switch (lastChildFlags) {
        case 2 /* HasVNodeChildren */:
            switch (nextChildFlags) {
                case 2 /* HasVNodeChildren */:
                    patch(lastChildren, nextChildren, parentDOM, lifecycle, context, isSVG);
                    break;
                case 1 /* HasInvalidChildren */:
                    remove(lastChildren, parentDOM);
                    break;
                default:
                    remove(lastChildren, parentDOM);
                    mountArrayChildren(nextChildren, parentDOM, lifecycle, context, isSVG);
                    break;
            }
            break;
        case 1 /* HasInvalidChildren */:
            switch (nextChildFlags) {
                case 2 /* HasVNodeChildren */:
                    mount(nextChildren, parentDOM, lifecycle, context, isSVG);
                    break;
                case 1 /* HasInvalidChildren */:
                    break;
                default:
                    mountArrayChildren(nextChildren, parentDOM, lifecycle, context, isSVG);
                    break;
            }
            break;
        default:
            if (nextChildFlags & 12 /* MultipleChildren */) {
                    var lastLength = lastChildren.length;
                    var nextLength = nextChildren.length;
                    // Fast path's for both algorithms
                    if (lastLength === 0) {
                        if (nextLength > 0) {
                            mountArrayChildren(nextChildren, parentDOM, lifecycle, context, isSVG);
                        }
                    } else if (nextLength === 0) {
                        removeAllChildren(parentDOM, lastChildren);
                    } else if (nextChildFlags === 8 /* HasKeyedChildren */ && lastChildFlags === 8 /* HasKeyedChildren */) {
                            patchKeyedChildren(lastChildren, nextChildren, parentDOM, lifecycle, context, isSVG, lastLength, nextLength);
                        } else {
                        patchNonKeyedChildren(lastChildren, nextChildren, parentDOM, lifecycle, context, isSVG, lastLength, nextLength);
                    }
                } else if (nextChildFlags === 1 /* HasInvalidChildren */) {
                    removeAllChildren(parentDOM, lastChildren);
                } else {
                removeAllChildren(parentDOM, lastChildren);
                mount(nextChildren, parentDOM, lifecycle, context, isSVG);
            }
            break;
    }
}
function updateClassComponent(instance, nextState, nextVNode, nextProps, parentDom, lifecycle, context, isSVG, force, fromSetState) {
    var lastState = instance.state;
    var lastProps = instance.props;
    nextVNode.children = instance;
    var renderOutput;
    if (instance.$UN) {
        return;
    }
    if (lastProps !== nextProps || nextProps === EMPTY_OBJ) {
        if (!fromSetState && isFunction(instance.componentWillReceiveProps)) {
            instance.$BR = true;
            instance.componentWillReceiveProps(nextProps, context);
            // If instance component was removed during its own update do nothing...
            if (instance.$UN) {
                return;
            }
            instance.$BR = false;
        }
        if (instance.$PSS) {
            nextState = combineFrom(nextState, instance.$PS);
            instance.$PSS = false;
            instance.$PS = null;
        }
    }
    /* Update if scu is not defined, or it returns truthy value or force */
    var hasSCU = isFunction(instance.shouldComponentUpdate);
    if (force || !hasSCU || hasSCU && instance.shouldComponentUpdate(nextProps, nextState, context)) {
        if (isFunction(instance.componentWillUpdate)) {
            instance.$BS = true;
            instance.componentWillUpdate(nextProps, nextState, context);
            instance.$BS = false;
        }
        instance.props = nextProps;
        instance.state = nextState;
        instance.context = context;
        if (isFunction(options.beforeRender)) {
            options.beforeRender(instance);
        }
        renderOutput = instance.render(nextProps, nextState, context);
        if (isFunction(options.afterRender)) {
            options.afterRender(instance);
        }
        var didUpdate = renderOutput !== NO_OP;
        var childContext;
        if (isFunction(instance.getChildContext)) {
            childContext = instance.getChildContext();
        }
        if (isNullOrUndef(childContext)) {
            childContext = context;
        } else {
            childContext = combineFrom(context, childContext);
        }
        instance.$CX = childContext;
        if (didUpdate) {
            var lastInput = instance.$LI;
            var nextInput = instance.$LI = handleComponentInput(renderOutput, nextVNode);
            patch(lastInput, nextInput, parentDom, lifecycle, childContext, isSVG);
            if (isFunction(instance.componentDidUpdate)) {
                instance.componentDidUpdate(lastProps, lastState);
            }
            if (isFunction(options.afterUpdate)) {
                options.afterUpdate(nextVNode);
            }
        }
    } else {
        instance.props = nextProps;
        instance.state = nextState;
        instance.context = context;
    }
    nextVNode.dom = instance.$LI.dom;
}
function patchComponent(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG, isClass) {
    var nextType = nextVNode.type;
    var lastKey = lastVNode.key;
    var nextKey = nextVNode.key;
    if (lastVNode.type !== nextType || lastKey !== nextKey) {
        replaceWithNewNode(lastVNode, nextVNode, parentDom, lifecycle, context, isSVG);
    } else {
        var nextProps = nextVNode.props || EMPTY_OBJ;
        if (isClass) {
            var instance = lastVNode.children;
            instance.$UPD = true;
            updateClassComponent(instance, instance.state, nextVNode, nextProps, parentDom, lifecycle, context, isSVG, false, false);
            instance.$V = nextVNode;
            instance.$UPD = false;
        } else {
            var shouldUpdate = true;
            var lastProps = lastVNode.props;
            var nextHooks = nextVNode.ref;
            var nextHooksDefined = !isNullOrUndef(nextHooks);
            var lastInput = lastVNode.children;
            nextVNode.dom = lastVNode.dom;
            nextVNode.children = lastInput;
            if (nextHooksDefined && isFunction(nextHooks.onComponentShouldUpdate)) {
                shouldUpdate = nextHooks.onComponentShouldUpdate(lastProps, nextProps);
            }
            if (shouldUpdate !== false) {
                if (nextHooksDefined && isFunction(nextHooks.onComponentWillUpdate)) {
                    nextHooks.onComponentWillUpdate(lastProps, nextProps);
                }
                var nextInput = nextType(nextProps, context);
                if (nextInput !== NO_OP) {
                    nextInput = handleComponentInput(nextInput, nextVNode);
                    patch(lastInput, nextInput, parentDom, lifecycle, context, isSVG);
                    nextVNode.children = nextInput;
                    nextVNode.dom = nextInput.dom;
                    if (nextHooksDefined && isFunction(nextHooks.onComponentDidUpdate)) {
                        nextHooks.onComponentDidUpdate(lastProps, nextProps);
                    }
                }
            } else if (lastInput.flags & 14 /* Component */) {
                    lastInput.parentVNode = nextVNode;
                }
        }
    }
}
function patchText(lastVNode, nextVNode, parentDom) {
    var nextText = nextVNode.children;
    var textNode = parentDom.firstChild;
    var dom;
    // Guard against external change on DOM node.
    if (isNull(textNode)) {
        parentDom.textContent = nextText;
        dom = parentDom.firstChild;
    } else {
        dom = lastVNode.dom;
        if (nextText !== lastVNode.children) {
            dom.nodeValue = nextText;
        }
    }
    nextVNode.dom = dom;
}
function patchNonKeyedChildren(lastChildren, nextChildren, dom, lifecycle, context, isSVG, lastChildrenLength, nextChildrenLength) {
    var commonLength = lastChildrenLength > nextChildrenLength ? nextChildrenLength : lastChildrenLength;
    var i = 0;
    var nextChild;
    for (; i < commonLength; i++) {
        nextChild = nextChildren[i];
        if (nextChild.dom) {
            nextChild = nextChildren[i] = directClone(nextChild);
        }
        patch(lastChildren[i], nextChild, dom, lifecycle, context, isSVG);
    }
    if (lastChildrenLength < nextChildrenLength) {
        for (i = commonLength; i < nextChildrenLength; i++) {
            nextChild = nextChildren[i];
            if (nextChild.dom) {
                nextChild = nextChildren[i] = directClone(nextChild);
            }
            mount(nextChild, dom, lifecycle, context, isSVG);
        }
    } else if (lastChildrenLength > nextChildrenLength) {
        for (i = commonLength; i < lastChildrenLength; i++) {
            remove(lastChildren[i], dom);
        }
    }
}
function patchKeyedChildren(a, b, dom, lifecycle, context, isSVG, aLength, bLength) {
    var aEnd = aLength - 1;
    var bEnd = bLength - 1;
    var aStart = 0;
    var bStart = 0;
    var i;
    var j;
    var aNode = a[aStart];
    var bNode = b[bStart];
    var nextNode;
    var nextPos;
    // Step 1
    // tslint:disable-next-line
    outer: {
        // Sync nodes with the same key at the beginning.
        while (aNode.key === bNode.key) {
            if (bNode.dom) {
                b[bStart] = bNode = directClone(bNode);
            }
            patch(aNode, bNode, dom, lifecycle, context, isSVG);
            aStart++;
            bStart++;
            if (aStart > aEnd || bStart > bEnd) {
                break outer;
            }
            aNode = a[aStart];
            bNode = b[bStart];
        }
        aNode = a[aEnd];
        bNode = b[bEnd];
        // Sync nodes with the same key at the end.
        while (aNode.key === bNode.key) {
            if (bNode.dom) {
                b[bEnd] = bNode = directClone(bNode);
            }
            patch(aNode, bNode, dom, lifecycle, context, isSVG);
            aEnd--;
            bEnd--;
            if (aStart > aEnd || bStart > bEnd) {
                break outer;
            }
            aNode = a[aEnd];
            bNode = b[bEnd];
        }
    }
    if (aStart > aEnd) {
        if (bStart <= bEnd) {
            nextPos = bEnd + 1;
            nextNode = nextPos < bLength ? b[nextPos].dom : null;
            while (bStart <= bEnd) {
                bNode = b[bStart];
                if (bNode.dom) {
                    b[bStart] = bNode = directClone(bNode);
                }
                bStart++;
                insertOrAppend(dom, mount(bNode, null, lifecycle, context, isSVG), nextNode);
            }
        }
    } else if (bStart > bEnd) {
        while (aStart <= aEnd) {
            remove(a[aStart++], dom);
        }
    } else {
        var aLeft = aEnd - aStart + 1;
        var bLeft = bEnd - bStart + 1;
        var sources = [];
        for (i = 0; i < bLeft; i++) {
            sources.push(0);
        }
        // Keep track if its possible to remove whole DOM using textContent = '';
        var canRemoveWholeContent = aLeft === aLength;
        var moved = false;
        var pos = 0;
        var patched = 0;
        // When sizes are small, just loop them through
        if (bLeft <= 4 || aLeft * bLeft <= 16) {
            for (i = aStart; i <= aEnd; i++) {
                aNode = a[i];
                if (patched < bLeft) {
                    for (j = bStart; j <= bEnd; j++) {
                        bNode = b[j];
                        if (aNode.key === bNode.key) {
                            sources[j - bStart] = i + 1;
                            if (canRemoveWholeContent) {
                                canRemoveWholeContent = false;
                                while (i > aStart) {
                                    remove(a[aStart++], dom);
                                }
                            }
                            if (pos > j) {
                                moved = true;
                            } else {
                                pos = j;
                            }
                            if (bNode.dom) {
                                b[j] = bNode = directClone(bNode);
                            }
                            patch(aNode, bNode, dom, lifecycle, context, isSVG);
                            patched++;
                            break;
                        }
                    }
                    if (!canRemoveWholeContent && j > bEnd) {
                        remove(aNode, dom);
                    }
                } else if (!canRemoveWholeContent) {
                    remove(aNode, dom);
                }
            }
        } else {
            var keyIndex = {};
            // Map keys by their index in array
            for (i = bStart; i <= bEnd; i++) {
                keyIndex[b[i].key] = i;
            }
            // Try to patch same keys
            for (i = aStart; i <= aEnd; i++) {
                aNode = a[i];
                if (patched < bLeft) {
                    j = keyIndex[aNode.key];
                    if (isDefined(j)) {
                        if (canRemoveWholeContent) {
                            canRemoveWholeContent = false;
                            while (i > aStart) {
                                remove(a[aStart++], dom);
                            }
                        }
                        bNode = b[j];
                        sources[j - bStart] = i + 1;
                        if (pos > j) {
                            moved = true;
                        } else {
                            pos = j;
                        }
                        if (bNode.dom) {
                            b[j] = bNode = directClone(bNode);
                        }
                        patch(aNode, bNode, dom, lifecycle, context, isSVG);
                        patched++;
                    } else if (!canRemoveWholeContent) {
                        remove(aNode, dom);
                    }
                } else if (!canRemoveWholeContent) {
                    remove(aNode, dom);
                }
            }
        }
        // fast-path: if nothing patched remove all old and add all new
        if (canRemoveWholeContent) {
            removeAllChildren(dom, a);
            mountArrayChildren(b, dom, lifecycle, context, isSVG);
        } else {
            if (moved) {
                var seq = lis_algorithm(sources);
                j = seq.length - 1;
                for (i = bLeft - 1; i >= 0; i--) {
                    if (sources[i] === 0) {
                        pos = i + bStart;
                        bNode = b[pos];
                        if (bNode.dom) {
                            b[pos] = bNode = directClone(bNode);
                        }
                        nextPos = pos + 1;
                        insertOrAppend(dom, mount(bNode, null, lifecycle, context, isSVG), nextPos < bLength ? b[nextPos].dom : null);
                    } else if (j < 0 || i !== seq[j]) {
                        pos = i + bStart;
                        bNode = b[pos];
                        nextPos = pos + 1;
                        insertOrAppend(dom, bNode.dom, nextPos < bLength ? b[nextPos].dom : null);
                    } else {
                        j--;
                    }
                }
            } else if (patched !== bLeft) {
                // when patched count doesn't match b length we need to insert those new ones
                // loop backwards so we can use insertBefore
                for (i = bLeft - 1; i >= 0; i--) {
                    if (sources[i] === 0) {
                        pos = i + bStart;
                        bNode = b[pos];
                        if (bNode.dom) {
                            b[pos] = bNode = directClone(bNode);
                        }
                        nextPos = pos + 1;
                        insertOrAppend(dom, mount(bNode, null, lifecycle, context, isSVG), nextPos < bLength ? b[nextPos].dom : null);
                    }
                }
            }
        }
    }
}
// // https://en.wikipedia.org/wiki/Longest_increasing_subsequence
function lis_algorithm(arr) {
    var p = arr.slice();
    var result = [0];
    var i;
    var j;
    var u;
    var v;
    var c;
    var len = arr.length;
    for (i = 0; i < len; i++) {
        var arrI = arr[i];
        if (arrI !== 0) {
            j = result[result.length - 1];
            if (arr[j] < arrI) {
                p[i] = j;
                result.push(i);
                continue;
            }
            u = 0;
            v = result.length - 1;
            while (u < v) {
                c = (u + v) / 2 | 0;
                if (arr[result[c]] < arrI) {
                    u = c + 1;
                } else {
                    v = c;
                }
            }
            if (arrI < arr[result[u]]) {
                if (u > 0) {
                    p[i] = result[u - 1];
                }
                result[u] = i;
            }
        }
    }
    u = result.length;
    v = result[u - 1];
    while (u-- > 0) {
        result[u] = v;
        v = p[v];
    }
    return result;
}

var roots = options.roots;
var documentBody = isBrowser ? document.body : null;
function render(input, parentDom, callback) {
    if (input === NO_OP) {
        return;
    }
    var rootLen = roots.length;
    var rootInput;
    var index;
    for (index = 0; index < rootLen; index++) {
        if (roots[index] === parentDom) {
            rootInput = parentDom.$V;
            break;
        }
    }
    if (isUndefined(rootInput)) {
        if (!isInvalid(input)) {
            if (input.dom) {
                input = directClone(input);
            }
            if (isNull(parentDom.firstChild)) {
                mount(input, parentDom, LIFECYCLE, EMPTY_OBJ, false);
                parentDom.$V = input;
                roots.push(parentDom);
            } else {
                hydrate(input, parentDom);
            }
            rootInput = input;
        }
    } else {
        if (isNullOrUndef(input)) {
            remove(rootInput, parentDom);
            roots.splice(index, 1);
        } else {
            if (input.dom) {
                input = directClone(input);
            }
            patch(rootInput, input, parentDom, LIFECYCLE, EMPTY_OBJ, false);
            rootInput = parentDom.$V = input;
        }
    }
    if (LIFECYCLE.length > 0) {
        callAll(LIFECYCLE);
    }
    if (isFunction(callback)) {
        callback();
    }
    if (rootInput && rootInput.flags & 14 /* Component */) {
            return rootInput.children;
        }
    return;
}
function createRenderer(parentDom) {
    return function renderer(lastInput, nextInput) {
        if (!parentDom) {
            parentDom = lastInput;
        }
        render(nextInput, parentDom);
    };
}
function createPortal(children, container) {
    return createVNode(1024 /* Portal */, container, null, children, 0 /* UnknownChildren */, null, isInvalid(children) ? null : children.key, null);
}

var resolvedPromise = typeof Promise === 'undefined' ? null : Promise.resolve();
// raf.bind(window) is needed to work around bug in IE10-IE11 strict mode (TypeError: Invalid calling object)
var fallbackMethod = typeof requestAnimationFrame === 'undefined' ? setTimeout : requestAnimationFrame.bind(window);
function nextTick(fn) {
    if (resolvedPromise) {
        return resolvedPromise.then(fn);
    }
    return fallbackMethod(fn);
}
function queueStateChanges(component, newState, callback) {
    if (isFunction(newState)) {
        newState = newState(component.state, component.props, component.context);
    }
    var pending = component.$PS;
    if (isNullOrUndef(pending)) {
        component.$PS = newState;
    } else {
        for (var stateKey in newState) {
            pending[stateKey] = newState[stateKey];
        }
    }
    if (!component.$PSS && !component.$BR) {
        if (!component.$UPD) {
            component.$PSS = true;
            component.$UPD = true;
            applyState(component, false, callback);
            component.$UPD = false;
        } else {
            // Async
            var queue = component.$QU;
            if (isNull(queue)) {
                queue = component.$QU = [];
                nextTick(promiseCallback(component, queue));
            }
            if (isFunction(callback)) {
                queue.push(callback);
            }
        }
    } else {
        component.$PSS = true;
        if (component.$BR && isFunction(callback)) {
            LIFECYCLE.push(callback.bind(component));
        }
    }
}
function promiseCallback(component, queue) {
    return function () {
        component.$QU = null;
        component.$UPD = true;
        applyState(component, false, function () {
            for (var i = 0, len = queue.length; i < len; i++) {
                queue[i].call(component);
            }
        });
        component.$UPD = false;
    };
}
function applyState(component, force, callback) {
    if (component.$UN) {
        return;
    }
    if (force || !component.$BR) {
        component.$PSS = false;
        var pendingState = component.$PS;
        var prevState = component.state;
        var nextState = combineFrom(prevState, pendingState);
        var props = component.props;
        var context = component.context;
        component.$PS = null;
        var vNode = component.$V;
        var lastInput = component.$LI;
        var parentDom = lastInput.dom && lastInput.dom.parentNode;
        updateClassComponent(component, nextState, vNode, props, parentDom, LIFECYCLE, context, (vNode.flags & 32 /* SvgElement */) > 0, force, true);
        if (component.$UN) {
            return;
        }
        if ((component.$LI.flags & 1024 /* Portal */) === 0) {
            var dom = component.$LI.dom;
            while (!isNull(vNode = vNode.parentVNode)) {
                if ((vNode.flags & 14 /* Component */) > 0) {
                    vNode.dom = dom;
                }
            }
        }
        if (LIFECYCLE.length > 0) {
            callAll(LIFECYCLE);
        }
    } else {
        component.state = component.$PS;
        component.$PS = null;
    }
    if (isFunction(callback)) {
        callback.call(component);
    }
}
var Component = function Component(props, context) {
    this.state = null;
    // Internal properties
    this.$BR = false; // BLOCK RENDER
    this.$BS = true; // BLOCK STATE
    this.$PSS = false; // PENDING SET STATE
    this.$PS = null; // PENDING STATE (PARTIAL or FULL)
    this.$LI = null; // LAST INPUT
    this.$V = null; // VNODE
    this.$UN = false; // UNMOUNTED
    this.$CX = null; // CHILDCONTEXT
    this.$UPD = true; // UPDATING
    this.$QU = null; // QUEUE
    /** @type {object} */
    this.props = props || EMPTY_OBJ;
    /** @type {object} */
    this.context = context || EMPTY_OBJ; // context should not be mutable
};
Component.prototype.forceUpdate = function forceUpdate(callback) {
    if (this.$UN) {
        return;
    }
    applyState(this, true, callback);
};
Component.prototype.setState = function setState(newState, callback) {
    if (this.$UN) {
        return;
    }
    if (!this.$BS) {
        queueStateChanges(this, newState, callback);
    } else {
        return;
    }
};
// tslint:disable-next-line:no-empty
Component.prototype.render = function render(nextProps, nextState, nextContext) {
    return undefined;
};
// Public
Component.defaultProps = null;

var JSX = /*#__PURE__*/Object.freeze({});

var version = "5.0.4";

exports.Component = Component;
exports.EMPTY_OBJ = EMPTY_OBJ;
exports.NO_OP = NO_OP;
exports.createComponentVNode = createComponentVNode;
exports.createPortal = createPortal;
exports.createRenderer = createRenderer;
exports.createTextVNode = createTextVNode;
exports.createVNode = createVNode;
exports.directClone = directClone;
exports.getFlagsForElementVnode = getFlagsForElementVnode;
exports.getNumberStyleValue = getNumberStyleValue;
exports.hydrate = hydrate;
exports.linkEvent = linkEvent;
exports.normalizeProps = normalizeProps;
exports.options = options;
exports.render = render;
exports.version = version;
exports.JSX = JSX;
},{}],58:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _indexEsm = require('./dist/index.esm.js');

Object.keys(_indexEsm).forEach(function (key) {
  if (key === "default" || key === "__esModule") return;
  Object.defineProperty(exports, key, {
    enumerable: true,
    get: function () {
      return _indexEsm[key];
    }
  });
});


if ('production' !== 'production') {
  console.warn('You are running production build of Inferno in development mode. Use dev:module entry point.');
}
},{"./dist/index.esm.js":77}],59:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.cloneVNode = undefined;

var _inferno = require('inferno');

// This should be boolean and not reference to window.document
var isBrowser = !!(typeof window !== 'undefined' && window.document);
// this is MUCH faster than .constructor === Array and instanceof Array
// in Node 7 and the later versions of V8, slower in older versions though
var isArray = Array.isArray;
function isStringOrNumber(o) {
    var type = typeof o;
    return type === 'string' || type === 'number';
}
function isInvalid(o) {
    return isNull(o) || o === false || isTrue(o) || isUndefined(o);
}
function isNull(o) {
    return o === null;
}
function isTrue(o) {
    return o === true;
}
function isUndefined(o) {
    return o === void 0;
}
function isDefined(o) {
    return o !== void 0;
}
function combineFrom(first, second) {
    var out = {};
    if (first) {
        for (var key in first) {
            out[key] = first[key];
        }
    }
    if (second) {
        for (var key$1 in second) {
            out[key$1] = second[key$1];
        }
    }
    return out;
}

/*
 directClone is preferred over cloneVNode and used internally also.
 This function makes Inferno backwards compatible.
 And can be tree-shaked by modern bundlers

 Would be nice to combine this with directClone but could not do it without breaking change
*/
/**
 * Clones given virtual node by creating new instance of it
 * @param {VNode} vNodeToClone virtual node to be cloned
 * @param {Props=} props additional props for new virtual node
 * @param {...*} _children new children for new virtual node
 * @returns {VNode} new virtual node
 */
function cloneVNode(vNodeToClone, props) {
    var _children = [],
        len$1 = arguments.length - 2;
    while (len$1-- > 0) _children[len$1] = arguments[len$1 + 2];

    if (arguments.length === 3) {
        if (!props) {
            props = {};
        }
        props.children = _children[0];
    } else {
        var childrenLen = _children.length;
        if (childrenLen > 0) {
            if (!props) {
                props = {};
            }
            props.children = _children;
        }
    }
    var newVNode;
    var flags = vNodeToClone.flags;
    var className = vNodeToClone.className;
    var key = vNodeToClone.key;
    var ref = vNodeToClone.ref;
    if (props) {
        if (isDefined(props.className)) {
            className = props.className;
        }
        if (isDefined(props.ref)) {
            ref = props.ref;
        }
        if (isDefined(props.key)) {
            key = props.key;
        }
    }
    if (flags & 14 /* Component */) {
            newVNode = (0, _inferno.createComponentVNode)(flags, vNodeToClone.type, !vNodeToClone.props && !props ? _inferno.EMPTY_OBJ : combineFrom(vNodeToClone.props, props), key, ref);
            var newProps = newVNode.props;
            var newChildren = newProps.children;
            // we need to also clone component children that are in props
            // as the children may also have been hoisted
            if (newChildren) {
                if (isArray(newChildren)) {
                    var len = newChildren.length;
                    if (len > 0) {
                        var tmpArray = [];
                        for (var i = 0; i < len; i++) {
                            var child = newChildren[i];
                            if (isStringOrNumber(child)) {
                                tmpArray.push(child);
                            } else if (!isInvalid(child) && child.flags) {
                                tmpArray.push((0, _inferno.directClone)(child));
                            }
                        }
                        newProps.children = tmpArray;
                    }
                } else if (newChildren.flags) {
                    newProps.children = (0, _inferno.directClone)(newChildren);
                }
            }
            newVNode.children = null;
        } else if (flags & 481 /* Element */) {
            if (!props) {
                props = {
                    children: vNodeToClone.children
                };
            }
            newVNode = (0, _inferno.createVNode)(flags, vNodeToClone.type, className, null, 1 /* HasInvalidChildren */, combineFrom(vNodeToClone.props, props), key, ref);
        } else if (flags & 16 /* Text */) {
            return (0, _inferno.createTextVNode)(props ? props.children : vNodeToClone.children);
        }
    return (0, _inferno.normalizeProps)(newVNode);
}

exports.cloneVNode = cloneVNode;
},{"inferno":58}],60:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.createClass = undefined;

var _inferno = require('inferno');

var ERROR_MSG = 'a runtime error occured! Use Inferno in development environment to find the error.';
// This should be boolean and not reference to window.document
var isBrowser = !!(typeof window !== 'undefined' && window.document);
function isFunction(o) {
    return typeof o === 'function';
}
function isDefined(o) {
    return o !== void 0;
}
function isObject(o) {
    return typeof o === 'object';
}
function throwError(message) {
    if (!message) {
        message = ERROR_MSG;
    }
    throw new Error("Inferno Error: " + message);
}

// don't autobind these methods since they already have guaranteed context.
var AUTOBIND_BLACKLIST = {
    componentDidMount: 1,
    componentDidUnmount: 1,
    componentDidUpdate: 1,
    componentWillMount: 1,
    componentWillUnmount: 1,
    componentWillUpdate: 1,
    constructor: 1,
    render: 1,
    shouldComponentUpdate: 1
};
function extend(base, props) {
    for (var key in props) {
        if (props.hasOwnProperty(key)) {
            base[key] = props[key];
        }
    }
    return base;
}
function bindAll(ctx) {
    for (var i in ctx) {
        var v = ctx[i];
        if (typeof v === 'function' && !v.__bound && !AUTOBIND_BLACKLIST[i]) {
            (ctx[i] = v.bind(ctx)).__bound = true;
        }
    }
}
function collateMixins(mixins, keyed) {
    if (keyed === void 0) keyed = {};

    for (var i = 0, len = mixins.length; i < len; i++) {
        var mixin = mixins[i];
        // Surprise: Mixins can have mixins
        if (mixin.mixins) {
            // Recursively collate sub-mixins
            collateMixins(mixin.mixins, keyed);
        }
        for (var key in mixin) {
            if (mixin.hasOwnProperty(key) && typeof mixin[key] === 'function') {
                (keyed[key] || (keyed[key] = [])).push(mixin[key]);
            }
        }
    }
    return keyed;
}
function multihook(hooks, mergeFn) {
    return function () {
        var arguments$1 = arguments;
        var this$1 = this;

        var ret;
        for (var i = 0, len = hooks.length; i < len; i++) {
            var hook = hooks[i];
            var r = hook.apply(this$1, arguments$1);
            if (mergeFn) {
                ret = mergeFn(ret, r);
            } else if (isDefined(r)) {
                ret = r;
            }
        }
        return ret;
    };
}
function mergeNoDupes(previous, current) {
    if (isDefined(current)) {
        if (!isObject(current)) {
            throwError('Expected Mixin to return value to be an object or null.');
        }
        if (!previous) {
            previous = {};
        }
        for (var key in current) {
            if (current.hasOwnProperty(key)) {
                if (previous.hasOwnProperty(key)) {
                    throwError("Mixins return duplicate key " + key + " in their return values");
                }
                previous[key] = current[key];
            }
        }
    }
    return previous;
}
function applyMixin(key, inst, mixin) {
    var hooks = isDefined(inst[key]) ? mixin.concat(inst[key]) : mixin;
    if (key === 'getDefaultProps' || key === 'getInitialState' || key === 'getChildContext') {
        inst[key] = multihook(hooks, mergeNoDupes);
    } else {
        inst[key] = multihook(hooks);
    }
}
function applyMixins(Cl, mixins) {
    for (var key in mixins) {
        if (mixins.hasOwnProperty(key)) {
            var mixin = mixins[key];
            var inst = void 0;
            if (key === 'getDefaultProps') {
                inst = Cl;
            } else {
                inst = Cl.prototype;
            }
            if (isFunction(mixin[0])) {
                applyMixin(key, inst, mixin);
            } else {
                inst[key] = mixin;
            }
        }
    }
}
function createClass(obj) {
    var Cl = function (Component$$1) {
        function Cl(props, context) {
            Component$$1.call(this, props, context);
            bindAll(this);
            if (this.getInitialState) {
                this.state = this.getInitialState();
            }
        }

        if (Component$$1) Cl.__proto__ = Component$$1;
        Cl.prototype = Object.create(Component$$1 && Component$$1.prototype);
        Cl.prototype.constructor = Cl;
        Cl.prototype.replaceState = function replaceState(nextState, callback) {
            this.setState(nextState, callback);
        };
        Cl.prototype.isMounted = function isMounted() {
            return this.$LI !== null && !this.$UN;
        };

        return Cl;
    }(_inferno.Component);
    Cl.displayName = obj.name || obj.displayName || 'Component';
    Cl.propTypes = obj.propTypes;
    Cl.mixins = obj.mixins && collateMixins(obj.mixins);
    Cl.getDefaultProps = obj.getDefaultProps;
    extend(Cl.prototype, obj);
    if (obj.statics) {
        extend(Cl, obj.statics);
    }
    if (obj.mixins) {
        applyMixins(Cl, collateMixins(obj.mixins));
    }
    if (Cl.getDefaultProps) {
        Cl.defaultProps = Cl.getDefaultProps();
    }
    return Cl;
}

exports.createClass = createClass;
},{"inferno":58}],61:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.createElement = undefined;

var _inferno = require('inferno');

// This should be boolean and not reference to window.document
var isBrowser = !!(typeof window !== 'undefined' && window.document);
function isNullOrUndef(o) {
    return isUndefined(o) || isNull(o);
}
function isInvalid(o) {
    return isNull(o) || o === false || isTrue(o) || isUndefined(o);
}
function isString(o) {
    return typeof o === 'string';
}
function isNull(o) {
    return o === null;
}
function isTrue(o) {
    return o === true;
}
function isUndefined(o) {
    return o === void 0;
}
function isObject(o) {
    return typeof o === 'object';
}

var componentHooks = {
    onComponentDidMount: 1,
    onComponentDidUpdate: 1,
    onComponentShouldUpdate: 1,
    onComponentWillMount: 1,
    onComponentWillUnmount: 1,
    onComponentWillUpdate: 1
};
/**
 * Creates virtual node
 * @param {string|Function|Component<any, any>} type Type of node
 * @param {object=} props Optional props for virtual node
 * @param {...{object}=} _children Optional children for virtual node
 * @returns {VNode} new virtual ndoe
 */
function createElement(type, props) {
    var _children = [],
        len = arguments.length - 2;
    while (len-- > 0) _children[len] = arguments[len + 2];

    if (isInvalid(type) || isObject(type)) {
        throw new Error('Inferno Error: createElement() name parameter cannot be undefined, null, false or true, It must be a string, class or function.');
    }
    var children = _children;
    var ref = null;
    var key = null;
    var className = null;
    var flags = 0;
    var newProps;
    if (_children) {
        if (_children.length === 1) {
            children = _children[0];
        } else if (_children.length === 0) {
            children = void 0;
        }
    }
    if (isString(type)) {
        flags = (0, _inferno.getFlagsForElementVnode)(type);
        if (!isNullOrUndef(props)) {
            newProps = {};
            for (var prop in props) {
                if (prop === 'className' || prop === 'class') {
                    className = props[prop];
                } else if (prop === 'key') {
                    key = props.key;
                } else if (prop === 'children' && isUndefined(children)) {
                    children = props.children; // always favour children args, default to props
                } else if (prop === 'ref') {
                    ref = props.ref;
                } else {
                    newProps[prop] = props[prop];
                }
            }
        }
    } else {
        flags = 2 /* ComponentUnknown */;
        if (!isUndefined(children)) {
            if (!props) {
                props = {};
            }
            props.children = children;
            children = null;
        }
        if (!isNullOrUndef(props)) {
            newProps = {};
            for (var prop$1 in props) {
                if (componentHooks[prop$1] !== void 0) {
                    if (!ref) {
                        ref = {};
                    }
                    ref[prop$1] = props[prop$1];
                } else if (prop$1 === 'key') {
                    key = props.key;
                } else if (prop$1 === 'ref') {
                    ref = props.ref;
                } else {
                    newProps[prop$1] = props[prop$1];
                }
            }
        }
        return (0, _inferno.createComponentVNode)(flags, type, newProps, key, ref);
    }
    return (0, _inferno.createVNode)(flags, type, className, children, 0 /* UnknownChildren */, newProps, key, ref);
}

exports.createElement = createElement;
},{"inferno":58}],25:[function(require,module,exports) {
var global = (1,eval)("this");
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.version = exports.unstable_renderSubtreeIntoContainer = exports.unmountComponentAtNode = exports.isValidElement = exports.findDOMNode = exports.__spread = exports.createFactory = exports.PureComponent = exports.PropTypes = exports.NO_OP = exports.DOM = exports.Children = exports.createElement = exports.createClass = exports.cloneVNode = exports.cloneElement = exports.render = exports.options = exports.normalizeProps = exports.linkEvent = exports.hydrate = exports.getNumberStyleValue = exports.getFlagsForElementVnode = exports.directClone = exports.createVNode = exports.createTextVNode = exports.createRenderer = exports.createPortal = exports.createComponentVNode = exports.EMPTY_OBJ = exports.Component = undefined;

var _inferno = require('inferno');

Object.defineProperty(exports, 'Component', {
    enumerable: true,
    get: function () {
        return _inferno.Component;
    }
});
Object.defineProperty(exports, 'EMPTY_OBJ', {
    enumerable: true,
    get: function () {
        return _inferno.EMPTY_OBJ;
    }
});
Object.defineProperty(exports, 'createComponentVNode', {
    enumerable: true,
    get: function () {
        return _inferno.createComponentVNode;
    }
});
Object.defineProperty(exports, 'createPortal', {
    enumerable: true,
    get: function () {
        return _inferno.createPortal;
    }
});
Object.defineProperty(exports, 'createRenderer', {
    enumerable: true,
    get: function () {
        return _inferno.createRenderer;
    }
});
Object.defineProperty(exports, 'createTextVNode', {
    enumerable: true,
    get: function () {
        return _inferno.createTextVNode;
    }
});
Object.defineProperty(exports, 'createVNode', {
    enumerable: true,
    get: function () {
        return _inferno.createVNode;
    }
});
Object.defineProperty(exports, 'directClone', {
    enumerable: true,
    get: function () {
        return _inferno.directClone;
    }
});
Object.defineProperty(exports, 'getFlagsForElementVnode', {
    enumerable: true,
    get: function () {
        return _inferno.getFlagsForElementVnode;
    }
});
Object.defineProperty(exports, 'getNumberStyleValue', {
    enumerable: true,
    get: function () {
        return _inferno.getNumberStyleValue;
    }
});
Object.defineProperty(exports, 'hydrate', {
    enumerable: true,
    get: function () {
        return _inferno.hydrate;
    }
});
Object.defineProperty(exports, 'linkEvent', {
    enumerable: true,
    get: function () {
        return _inferno.linkEvent;
    }
});
Object.defineProperty(exports, 'normalizeProps', {
    enumerable: true,
    get: function () {
        return _inferno.normalizeProps;
    }
});
Object.defineProperty(exports, 'options', {
    enumerable: true,
    get: function () {
        return _inferno.options;
    }
});
Object.defineProperty(exports, 'render', {
    enumerable: true,
    get: function () {
        return _inferno.render;
    }
});

var _infernoCloneVnode = require('inferno-clone-vnode');

Object.defineProperty(exports, 'cloneElement', {
    enumerable: true,
    get: function () {
        return _infernoCloneVnode.cloneVNode;
    }
});
Object.defineProperty(exports, 'cloneVNode', {
    enumerable: true,
    get: function () {
        return _infernoCloneVnode.cloneVNode;
    }
});

var _infernoCreateClass = require('inferno-create-class');

Object.defineProperty(exports, 'createClass', {
    enumerable: true,
    get: function () {
        return _infernoCreateClass.createClass;
    }
});

var _infernoCreateElement = require('inferno-create-element');

Object.defineProperty(exports, 'createElement', {
    enumerable: true,
    get: function () {
        return _infernoCreateElement.createElement;
    }
});


var NO_OP = '$NO_OP';
// This should be boolean and not reference to window.document
var isBrowser = !!(typeof window !== 'undefined' && window.document);
// this is MUCH faster than .constructor === Array and instanceof Array
// in Node 7 and the later versions of V8, slower in older versions though
var isArray = Array.isArray;
function isNullOrUndef(o) {
    return isUndefined(o) || isNull(o);
}
function isInvalid(o) {
    return isNull(o) || o === false || isTrue(o) || isUndefined(o);
}
function isFunction(o) {
    return typeof o === 'function';
}
function isString(o) {
    return typeof o === 'string';
}
function isNull(o) {
    return o === null;
}
function isTrue(o) {
    return o === true;
}
function isUndefined(o) {
    return o === void 0;
}
function isObject(o) {
    return typeof o === 'object';
}

function isValidElement(obj) {
    var isNotANullObject = isObject(obj) && isNull(obj) === false;
    if (isNotANullObject === false) {
        return false;
    }
    var flags = obj.flags;
    return (flags & (14 /* Component */ | 481 /* Element */)) > 0;
}

/**
 * @module Inferno-Compat
 */
/**
 * Inlined PropTypes, there is propType checking ATM.
 */
// tslint:disable-next-line:no-empty
function proptype() {}
proptype.isRequired = proptype;
var getProptype = function () {
    return proptype;
};
var PropTypes = {
    any: getProptype,
    array: proptype,
    arrayOf: getProptype,
    bool: proptype,
    checkPropTypes: function () {
        return null;
    },
    element: getProptype,
    func: proptype,
    instanceOf: getProptype,
    node: getProptype,
    number: proptype,
    object: proptype,
    objectOf: getProptype,
    oneOf: getProptype,
    oneOfType: getProptype,
    shape: getProptype,
    string: proptype,
    symbol: proptype
};

/**
 * This is a list of all SVG attributes that need special casing,
 * namespacing, or boolean value assignment.
 *
 * When adding attributes to this list, be sure to also add them to
 * the `possibleStandardNames` module to ensure casing and incorrect
 * name warnings.
 *
 * SVG Attributes List:
 * https://www.w3.org/TR/SVG/attindex.html
 * SMIL Spec:
 * https://www.w3.org/TR/smil
 */
var ATTRS = ['accent-height', 'alignment-baseline', 'arabic-form', 'baseline-shift', 'cap-height', 'clip-path', 'clip-rule', 'color-interpolation', 'color-interpolation-filters', 'color-profile', 'color-rendering', 'dominant-baseline', 'enable-background', 'fill-opacity', 'fill-rule', 'flood-color', 'flood-opacity', 'font-family', 'font-size', 'font-size-adjust', 'font-stretch', 'font-style', 'font-constiant', 'font-weight', 'glyph-name', 'glyph-orientation-horizontal', 'glyph-orientation-vertical', 'horiz-adv-x', 'horiz-origin-x', 'image-rendering', 'letter-spacing', 'lighting-color', 'marker-end', 'marker-mid', 'marker-start', 'overline-position', 'overline-thickness', 'paint-order', 'panose-1', 'pointer-events', 'rendering-intent', 'shape-rendering', 'stop-color', 'stop-opacity', 'strikethrough-position', 'strikethrough-thickness', 'stroke-dasharray', 'stroke-dashoffset', 'stroke-linecap', 'stroke-linejoin', 'stroke-miterlimit', 'stroke-opacity', 'stroke-width', 'text-anchor', 'text-decoration', 'text-rendering', 'underline-position', 'underline-thickness', 'unicode-bidi', 'unicode-range', 'units-per-em', 'v-alphabetic', 'v-hanging', 'v-ideographic', 'v-mathematical', 'vector-effect', 'vert-adv-y', 'vert-origin-x', 'vert-origin-y', 'word-spacing', 'writing-mode', 'x-height', 'xlink:actuate', 'xlink:arcrole', 'xlink:href', 'xlink:role', 'xlink:show', 'xlink:title', 'xlink:type', 'xml:base', 'xmlns:xlink', 'xml:lang', 'xml:space'];
var SVGDOMPropertyConfig = {};
var CAMELIZE = /[\-\:]([a-z])/g;
var capitalize = function (token) {
    return token[1].toUpperCase();
};
ATTRS.forEach(function (original) {
    var reactName = original.replace(CAMELIZE, capitalize);
    SVGDOMPropertyConfig[reactName] = original;
});

function unmountComponentAtNode(container) {
    (0, _inferno.render)(null, container);
    return true;
}
function extend(base, props) {
    var arguments$1 = arguments;

    for (var i = 1, obj = void 0; i < arguments.length; i++) {
        if (obj = arguments$1[i]) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    base[key] = obj[key];
                }
            }
        }
    }
    return base;
}
function flatten(arr, result) {
    for (var i = 0, len = arr.length; i < len; i++) {
        var value = arr[i];
        if (isArray(value)) {
            flatten(value, result);
        } else {
            result.push(value);
        }
    }
    return result;
}
var ARR = [];
var Children = {
    map: function map(children, fn, ctx) {
        if (isNullOrUndef(children)) {
            return children;
        }
        children = Children.toArray(children);
        if (ctx && ctx !== children) {
            fn = fn.bind(ctx);
        }
        return children.map(fn);
    },
    forEach: function forEach(children, fn, ctx) {
        if (isNullOrUndef(children)) {
            return;
        }
        children = Children.toArray(children);
        if (ctx && ctx !== children) {
            fn = fn.bind(ctx);
        }
        for (var i = 0, len = children.length; i < len; i++) {
            var child = isInvalid(children[i]) ? null : children[i];
            fn(child, i, children);
        }
    },
    count: function count(children) {
        children = Children.toArray(children);
        return children.length;
    },
    only: function only(children) {
        children = Children.toArray(children);
        if (children.length !== 1) {
            throw new Error('Children.only() expects only one child.');
        }
        return children[0];
    },
    toArray: function toArray$$1(children) {
        if (isNullOrUndef(children)) {
            return [];
        }
        // We need to flatten arrays here,
        // because React does it also and application level code might depend on that behavior
        if (isArray(children)) {
            var result = [];
            flatten(children, result);
            return result;
        }
        return ARR.concat(children);
    }
};
_inferno.Component.prototype.isReactComponent = {};
var currentComponent = null;
_inferno.options.beforeRender = function (component) {
    currentComponent = component;
};
_inferno.options.afterRender = function () {
    currentComponent = null;
};
var version = '15.4.2';
function normalizeGenericProps(props) {
    for (var prop in props) {
        if (prop === 'onDoubleClick') {
            props.onDblClick = props[prop];
            props[prop] = void 0;
        }
        if (prop === 'htmlFor') {
            props.for = props[prop];
            props[prop] = void 0;
        }
        var mappedProp = SVGDOMPropertyConfig[prop];
        if (mappedProp && mappedProp !== prop) {
            props[mappedProp] = props[prop];
            props[prop] = void 0;
        }
    }
}
function normalizeFormProps(name, props) {
    if ((name === 'input' || name === 'textarea') && props.type !== 'radio' && props.onChange) {
        var type = props.type;
        var eventName;
        if (!type || type === 'text') {
            eventName = 'oninput';
        } else if (type === 'file') {
            eventName = 'onchange';
        }
        if (eventName && !props[eventName]) {
            props[eventName] = props.onChange;
            props.onChange = void 0;
        }
    }
}
// we need to add persist() to Event (as React has it for synthetic events)
// this is a hack and we really shouldn't be modifying a global object this way,
// but there isn't a performant way of doing this apart from trying to proxy
// every prop event that starts with "on", i.e. onClick or onKeyPress
// but in reality devs use onSomething for many things, not only for
// input events
if (typeof Event !== 'undefined') {
    var eventProtoType = Event.prototype;
    if (!eventProtoType.persist) {
        // tslint:disable-next-line:no-empty
        eventProtoType.persist = function () {};
    }
    if (!eventProtoType.isDefaultPrevented) {
        eventProtoType.isDefaultPrevented = function () {
            return this.defaultPrevented;
        };
    }
    if (!eventProtoType.isPropagationStopped) {
        eventProtoType.isPropagationStopped = function () {
            return this.cancelBubble;
        };
    }
}
function iterableToArray(iterable) {
    var iterStep;
    var tmpArr = [];
    do {
        iterStep = iterable.next();
        tmpArr.push(iterStep.value);
    } while (!iterStep.done);
    return tmpArr;
}
var g = typeof window === 'undefined' ? global : window;
var hasSymbolSupport = typeof g.Symbol !== 'undefined';
var symbolIterator = hasSymbolSupport ? g.Symbol.iterator : '';
var oldCreateVNode = _inferno.options.createVNode;
_inferno.options.createVNode = function (vNode) {
    var children = vNode.children;
    var ref = vNode.ref;
    var props = vNode.props;
    if (isNullOrUndef(props)) {
        props = vNode.props = {};
    }
    // React supports iterable children, in addition to Array-like
    if (hasSymbolSupport && !isNull(children) && !isArray(children) && typeof children === 'object' && isFunction(children[symbolIterator])) {
        vNode.children = iterableToArray(children[symbolIterator]());
    }
    if (typeof ref === 'string' && !isNull(currentComponent)) {
        if (!currentComponent.refs) {
            currentComponent.refs = {};
        }
        vNode.ref = function (val) {
            this.refs[ref] = val;
        }.bind(currentComponent);
    }
    if (vNode.className) {
        props.className = vNode.className;
    }
    if (!isNullOrUndef(children) && isNullOrUndef(props.children)) {
        props.children = children;
    }
    if (vNode.flags & 14 /* Component */) {
            if (isString(vNode.type)) {
                vNode.flags = (0, _inferno.getFlagsForElementVnode)(vNode.type);
                if (props) {
                    (0, _inferno.normalizeProps)(vNode);
                }
            }
        }
    var flags = vNode.flags;
    if (flags & 448 /* FormElement */) {
            normalizeFormProps(vNode.type, props);
        }
    if (flags & 481 /* Element */) {
            normalizeGenericProps(props);
        }
    if (oldCreateVNode) {
        oldCreateVNode(vNode);
    }
};
// Credit: preact-compat - https://github.com/developit/preact-compat :)
function shallowDiffers(a, b) {
    for (var i in a) {
        if (!(i in b)) {
            return true;
        }
    }
    for (var i$1 in b) {
        if (a[i$1] !== b[i$1]) {
            return true;
        }
    }
    return false;
}
var PureComponent = function (Component$$1) {
    function PureComponent() {
        Component$$1.apply(this, arguments);
    }

    if (Component$$1) PureComponent.__proto__ = Component$$1;
    PureComponent.prototype = Object.create(Component$$1 && Component$$1.prototype);
    PureComponent.prototype.constructor = PureComponent;

    PureComponent.prototype.shouldComponentUpdate = function shouldComponentUpdate(props, state) {
        return shallowDiffers(this.props, props) || shallowDiffers(this.state, state);
    };

    return PureComponent;
}(_inferno.Component);
var WrapperComponent = function (Component$$1) {
    function WrapperComponent() {
        Component$$1.apply(this, arguments);
    }

    if (Component$$1) WrapperComponent.__proto__ = Component$$1;
    WrapperComponent.prototype = Object.create(Component$$1 && Component$$1.prototype);
    WrapperComponent.prototype.constructor = WrapperComponent;

    WrapperComponent.prototype.getChildContext = function getChildContext() {
        // tslint:disable-next-line
        return this.props.context;
    };
    WrapperComponent.prototype.render = function render$$1(props) {
        return props.children;
    };

    return WrapperComponent;
}(_inferno.Component);
function unstable_renderSubtreeIntoContainer(parentComponent, vNode, container, callback) {
    var wrapperVNode = (0, _inferno.createComponentVNode)(4 /* ComponentClass */, WrapperComponent, {
        children: vNode,
        context: parentComponent.context
    });
    (0, _inferno.render)(wrapperVNode, container);
    var component = vNode.children;
    if (callback) {
        // callback gets the component as context, no other argument.
        callback.call(component);
    }
    return component;
}
// Credit: preact-compat - https://github.com/developit/preact-compat
var ELEMENTS = 'a abbr address area article aside audio b base bdi bdo big blockquote body br button canvas caption cite code col colgroup data datalist dd del details dfn dialog div dl dt em embed fieldset figcaption figure footer form h1 h2 h3 h4 h5 h6 head header hgroup hr html i iframe img input ins kbd keygen label legend li link main map mark menu menuitem meta meter nav noscript object ol optgroup option output p param picture pre progress q rp rt ruby s samp script section select small source span strong style sub summary sup table tbody td textarea tfoot th thead time title tr track u ul var video wbr circle clipPath defs ellipse g image line linearGradient mask path pattern polygon polyline radialGradient rect stop svg text tspan'.split(' ');
function createFactory(type) {
    return _infernoCreateElement.createElement.bind(null, type);
}
var DOM = {};
for (var i = ELEMENTS.length; i--;) {
    DOM[ELEMENTS[i]] = createFactory(ELEMENTS[i]);
}
function findDOMNode(ref) {
    if (ref && ref.nodeType) {
        return ref;
    }
    if (!ref || ref.$UN) {
        return null;
    }
    if (ref.$LI) {
        return ref.$LI.dom;
    }
    return null;
}
// Mask React global in browser enviornments when React is not used.
if (isBrowser && typeof window.React === 'undefined') {
    var exports$1 = {
        Children: Children,
        Component: _inferno.Component,
        DOM: DOM,
        EMPTY_OBJ: _inferno.EMPTY_OBJ,
        NO_OP: NO_OP,
        PropTypes: PropTypes,
        PureComponent: PureComponent,
        __spread: extend,
        cloneElement: _infernoCloneVnode.cloneVNode,
        cloneVNode: _infernoCloneVnode.cloneVNode,
        createClass: _infernoCreateClass.createClass,
        createComponentVNode: _inferno.createComponentVNode,
        createElement: _infernoCreateElement.createElement,
        createFactory: createFactory,
        createPortal: _inferno.createPortal,
        createRenderer: _inferno.createRenderer,
        createTextVNode: _inferno.createTextVNode,
        createVNode: _inferno.createVNode,
        directClone: _inferno.directClone,
        findDOMNode: findDOMNode,
        getFlagsForElementVnode: _inferno.getFlagsForElementVnode,
        getNumberStyleValue: _inferno.getNumberStyleValue,
        hydrate: _inferno.hydrate,
        isValidElement: isValidElement,
        linkEvent: _inferno.linkEvent,
        normalizeProps: _inferno.normalizeProps,
        options: _inferno.options,
        render: _inferno.render,
        unmountComponentAtNode: unmountComponentAtNode,
        unstable_renderSubtreeIntoContainer: unstable_renderSubtreeIntoContainer,
        version: version
    };
    window.React = exports$1;
    window.ReactDOM = exports$1;
}
var index = {
    Children: Children,
    Component: _inferno.Component,
    DOM: DOM,
    EMPTY_OBJ: _inferno.EMPTY_OBJ,
    NO_OP: NO_OP,
    PropTypes: PropTypes,
    PureComponent: PureComponent,
    __spread: extend,
    cloneElement: _infernoCloneVnode.cloneVNode,
    cloneVNode: _infernoCloneVnode.cloneVNode,
    createClass: _infernoCreateClass.createClass,
    createComponentVNode: _inferno.createComponentVNode,
    createElement: _infernoCreateElement.createElement,
    createFactory: createFactory,
    createPortal: _inferno.createPortal,
    createRenderer: _inferno.createRenderer,
    createTextVNode: _inferno.createTextVNode,
    createVNode: _inferno.createVNode,
    directClone: _inferno.directClone,
    findDOMNode: findDOMNode,
    getFlagsForElementVnode: _inferno.getFlagsForElementVnode,
    getNumberStyleValue: _inferno.getNumberStyleValue,
    hydrate: _inferno.hydrate,
    isValidElement: isValidElement,
    linkEvent: _inferno.linkEvent,
    normalizeProps: _inferno.normalizeProps,
    options: _inferno.options,
    render: _inferno.render,
    unmountComponentAtNode: unmountComponentAtNode,
    unstable_renderSubtreeIntoContainer: unstable_renderSubtreeIntoContainer,
    version: version
};

exports.default = index;
exports.Children = Children;
exports.DOM = DOM;
exports.NO_OP = NO_OP;
exports.PropTypes = PropTypes;
exports.PureComponent = PureComponent;
exports.createFactory = createFactory;
exports.__spread = extend;
exports.findDOMNode = findDOMNode;
exports.isValidElement = isValidElement;
exports.unmountComponentAtNode = unmountComponentAtNode;
exports.unstable_renderSubtreeIntoContainer = unstable_renderSubtreeIntoContainer;
exports.version = version;
},{"inferno":58,"inferno-clone-vnode":59,"inferno-create-class":60,"inferno-create-element":61}],24:[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _getPrototypeOf = require("babel-runtime/core-js/object/get-prototype-of");

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _classCallCheck2 = require("babel-runtime/helpers/classCallCheck");

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require("babel-runtime/helpers/createClass");

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require("babel-runtime/helpers/possibleConstructorReturn");

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require("babel-runtime/helpers/inherits");

var _inherits3 = _interopRequireDefault(_inherits2);

var _infernoCompat = require("inferno-compat");

var _infernoCompat2 = _interopRequireDefault(_infernoCompat);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Lightbox = function (_React$Component) {
  (0, _inherits3.default)(Lightbox, _React$Component);

  function Lightbox() {
    (0, _classCallCheck3.default)(this, Lightbox);
    return (0, _possibleConstructorReturn3.default)(this, (Lightbox.__proto__ || (0, _getPrototypeOf2.default)(Lightbox)).apply(this, arguments));
  }

  (0, _createClass3.default)(Lightbox, [{
    key: "render",
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;
      var state = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.state;

      return _infernoCompat2.default.createElement(
        "div",
        { className: "test" },
        _infernoCompat2.default.createElement(
          "p",
          null,
          _infernoCompat2.default.createElement(
            "label",
            null,
            _infernoCompat2.default.createElement("input", { type: "checkbox", checked: props.carousel,
              onChange: function onChange(e) {
                return props.onChange({ carousel: e.target.checked });
              } }),
            "Enable carousel"
          )
        ),
        _infernoCompat2.default.createElement(
          "p",
          null,
          _infernoCompat2.default.createElement(
            "label",
            null,
            "Lightbox theme"
          ),
          _infernoCompat2.default.createElement(
            "select",
            { value: props.theme,
              onChange: function onChange(e) {
                return props.onChange({ theme: e.target.value });
              } },
            _infernoCompat2.default.createElement(
              "option",
              { value: "black" },
              "Black"
            ),
            _infernoCompat2.default.createElement(
              "option",
              { value: "white" },
              "White"
            )
          )
        )
      );
    }
  }]);
  return Lightbox;
}(_infernoCompat2.default.Component);

exports.default = Lightbox;
},{"babel-runtime/core-js/object/get-prototype-of":38,"babel-runtime/helpers/classCallCheck":39,"babel-runtime/helpers/createClass":40,"babel-runtime/helpers/possibleConstructorReturn":41,"babel-runtime/helpers/inherits":42,"inferno-compat":25}],6:[function(require,module,exports) {
'use strict';

var _assign = require('babel-runtime/core-js/object/assign');

var _assign2 = _interopRequireDefault(_assign);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

(function () {
  var ExtraTabsView,
      LayoutTabsView,
      LightboxTab,
      React,
      ReactDOM,
      TabsView,
      bind = function bind(fn, me) {
    return function () {
      return fn.apply(me, arguments);
    };
  },
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  LightboxTab = require('./lightbox')["default"];

  ReactDOM = require('inferno-compat');

  React = require('inferno-compat');

  TabsView = function (superClass) {
    extend(TabsView, superClass);

    function TabsView() {
      this.onLinkClicked = bind(this.onLinkClicked, this);
      return TabsView.__super__.constructor.apply(this, arguments);
    }

    TabsView.prototype.ui = function () {
      return {
        links: '.ubergrid-tabs li a',
        panels: '.ubergrid-panels li',
        firstPanel: '.ubergrid-panels li:first-child',
        firstLink: '.ubergrid-tabs li:first-child a'
      };
    };

    TabsView.prototype.events = {
      'click @ui.links': 'onLinkClicked'
    };

    TabsView.prototype.initialize = function (params) {
      TabsView.__super__.initialize.call(this, params);
      return this.bindUIElements();
    };

    TabsView.prototype.bindUIElements = function () {
      TabsView.__super__.bindUIElements.apply(this, arguments);
      this.ui.firstLink.addClass('ubergrid-current');
      return this.ui.firstPanel.addClass('ubergrid-current');
    };

    TabsView.prototype.onLinkClicked = function (event) {
      var index;
      event.preventDefault();
      this.ui.panels.removeClass('ubergrid-current');
      index = this.ui.links.index(event.target);
      this.ui.panels.eq(index).addClass('ubergrid-current');
      this.ui.links.parent().removeClass('ubergrid-current');
      return jQuery(event.target).parent().addClass('ubergrid-current');
    };

    return TabsView;
  }(Marionette.ItemView);

  module.exports.LayoutTabsView = LayoutTabsView = function (superClass) {
    extend(LayoutTabsView, superClass);

    function LayoutTabsView() {
      return LayoutTabsView.__super__.constructor.apply(this, arguments);
    }

    LayoutTabsView.prototype.ui = function () {
      return _.extend(LayoutTabsView.__super__.ui.apply(this, arguments), {
        "default": '#ubergrid-layout-default',
        under768: '#ubergrid-layout-768',
        under440: '#ubergrid-layout-440'
      });
    };

    LayoutTabsView.prototype.initialize = function () {
      LayoutTabsView.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      this.defaultBinding = rivets.bind(this.ui["default"], this.model.get('default'));
      this.binding440 = rivets.bind(this.ui.under440, this.model.get('440'));
      return this.binding768 = rivets.bind(this.ui.under768, this.model.get('768'));
    };

    return LayoutTabsView;
  }(TabsView);

  module.exports.ExtraTabsView = ExtraTabsView = function (superClass) {
    extend(ExtraTabsView, superClass);

    function ExtraTabsView() {
      return ExtraTabsView.__super__.constructor.apply(this, arguments);
    }

    ExtraTabsView.prototype.ui = function () {
      return _.extend(ExtraTabsView.__super__.ui.apply(this, arguments), {
        lightbox: '#lightbox-options'
      });
    };

    ExtraTabsView.prototype.initialize = function () {
      ExtraTabsView.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      this.binding = rivets.bind(this.$el, {
        model: this.model
      });
      return this.model.on('change:lightbox', function (_this) {
        return function (a) {
          var data, render;
          data = a.get('lightbox');
          render = function render() {
            data = a.get('lightbox');
            return ReactDOM.render(React.createElement(LightboxTab, data), _this.ui.lightbox[0]);
          };
          data.onChange = function (modify) {
            _this.model.attributes.lightbox = (0, _assign2.default)({}, _this.model.attributes.lightbox, modify);
            return render();
          };
          return render();
        };
      }(this));
    };

    return ExtraTabsView;
  }(TabsView);
}).call(undefined);
},{"babel-runtime/core-js/object/assign":23,"./lightbox":24,"inferno-compat":25}],7:[function(require,module,exports) {
(function () {
  var FontCollection,
      FontsView,
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  FontCollection = require('./models').FontCollection;

  module.exports = FontsView = function (superClass) {
    extend(FontsView, superClass);

    function FontsView() {
      return FontsView.__super__.constructor.apply(this, arguments);
    }

    FontsView.prototype.ui = {
      fontSelectors: 'select[role=font]',
      fontVariantSelectors: 'select[role=style]',
      spinner: '.spin-wrapper',
      content: '#fonts'
    };

    FontsView.prototype.initialize = function () {
      FontsView.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      this.fonts = new FontCollection();
      this.listenTo(this.fonts, 'sync', this.onFontsSync);
      return this.fonts.fetch();
    };

    FontsView.prototype.onFontsSync = function (param) {
      var font, i, len, ref;
      ref = this.fonts.models;
      for (i = 0, len = ref.length; i < len; i++) {
        font = ref[i];
        this.ui.fontSelectors.append(jQuery("<option />").text(font.get('family')));
      }
      this.ui.spinner.remove();
      this.ui.content.css('visibility', 'visible');
      return this.bind();
    };

    FontsView.prototype.bind = function () {
      return this.binding = rivets.bind(this.$el, this.model, {
        components: {
          fonts: this.fonts
        }
      });
    };

    return FontsView;
  }(Marionette.ItemView);
}).call(this);
},{"./models":4}],8:[function(require,module,exports) {
'use strict';

var _stringify = require('babel-runtime/core-js/json/stringify');

var _stringify2 = _interopRequireDefault(_stringify);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

(function () {
  var PublishBlockView,
      extend = function extend(child, parent) {
    for (var key in parent) {
      if (hasProp.call(parent, key)) child[key] = parent[key];
    }function ctor() {
      this.constructor = child;
    }ctor.prototype = parent.prototype;child.prototype = new ctor();child.__super__ = parent.prototype;return child;
  },
      hasProp = {}.hasOwnProperty;

  module.exports = PublishBlockView = function (superClass) {
    extend(PublishBlockView, superClass);

    function PublishBlockView() {
      return PublishBlockView.__super__.constructor.apply(this, arguments);
    }

    PublishBlockView.prototype.ui = {
      previewButton: '#preview',
      publishButton: '#publish'
    };

    PublishBlockView.prototype.events = {
      'click @ui.previewButton': 'onPreviewClick'
    };

    PublishBlockView.prototype.initialize = function () {
      PublishBlockView.__super__.initialize.apply(this, arguments);
      this.bindUIElements();
      return this.ui.publishButton.removeAttr("disabled");
    };

    PublishBlockView.prototype.onPreviewClick = function () {
      jQuery("#preview-backdrop, #preview-window").show();
      jQuery("#preview-content").html("");
      jQuery.post("admin-ajax.php?action=uber_grid_preview", {
        data: (0, _stringify2.default)(this.model.toJSON()),
        id: jQuery('#post_ID').val()
      }, function (response) {
        jQuery("#preview-content").css("visibility", "hidden");
        jQuery("#preview-content").html(jQuery(response));
        return jQuery("#preview-content").css("visibility", "visible");
      });
      return jQuery("#preview-close, #preview-footer-close").click(function () {
        return jQuery("#preview-backdrop, #preview-window").hide();
      });
    };

    return PublishBlockView;
  }(Marionette.ItemView);
}).call(undefined);
},{"babel-runtime/core-js/json/stringify":9}],1:[function(require,module,exports) {
'use strict';

var _stringify = require('babel-runtime/core-js/json/stringify');

var _stringify2 = _interopRequireDefault(_stringify);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

(function () {
  jQuery(function ($) {
    var ExtraTabsView, FontsView, GridEditor, GridEditorModel, LayoutTabsView, PublishBlockView, gridEditor, model;
    GridEditorModel = require('./editor/models.coffee').GridEditorModel;
    GridEditor = require('./editor/editor.coffee');
    LayoutTabsView = require('./editor/tabs').LayoutTabsView;
    ExtraTabsView = require('./editor/tabs.coffee').ExtraTabsView;
    FontsView = require('./editor/fonts');
    PublishBlockView = require('./editor/publish');
    rivets.configure({
      prefix: 'rv',
      preloadData: true
    });
    rivets.binders.color = {
      publishes: true,
      bind: function bind(el) {
        return jQuery(el).wpColorPicker('option', 'change', function (_this) {
          return function (e, ui) {
            return _this.observer.setValue(ui.color.toCSS());
          };
        }(this));
      },
      unbind: function unbind(el) {
        return jQuery(el).wpColorPicker('option', 'change', null);
      },
      routine: function routine(el, value) {
        return jQuery(el).wpColorPicker('color', value);
      }
    };
    rivets.binders['font-family'] = {
      publishes: true,
      bind: rivets.binders.value.bind,
      unbind: rivets.binders.value.unbind,
      routine: function routine(el, value) {
        var font, i, len, option, ref, results, variant, variantsElement;
        rivets.binders.value.routine(el, value);
        variantsElement = jQuery(el).next();
        variantsElement.find('option').remove();
        if (font = this.view.components.fonts.find(function (item) {
          return item.get('family') === value;
        })) {
          ref = font.get('variants');
          results = [];
          for (i = 0, len = ref.length; i < len; i++) {
            variant = ref[i];
            option = jQuery("<option />").text(variant);
            if (option.text() === this.model.get('style')) {
              option.attr('selected', 'selected');
            }
            results.push(variantsElement.append(option));
          }
          return results;
        } else {
          variantsElement.append(jQuery("<option value='light'>Light</option>"));
          variantsElement.append(jQuery("<option value='regular' selected='selected'>Regular</option>"));
          return variantsElement.append(jQuery("<option value='bold'>Bold</option>"));
        }
      }
    };
    model = new GridEditorModel();
    gridEditor = new GridEditor({
      el: jQuery('#post-body-content'),
      model: model
    });
    new LayoutTabsView({
      el: $('#grid_layout'),
      model: model.get('layout')
    });
    new ExtraTabsView({
      el: $('#grid_extras'),
      model: model
    });
    new FontsView({
      el: $('#grid_fonts'),
      model: model.get('fonts')
    });
    new PublishBlockView({
      el: $('#submitpost'),
      model: model
    });
    model.set(model.parse($("#ug-data").val()));
    gridEditor.chooseMode();
    return $("#post").submit(function (e) {
      $(this).parent().find(".spinner").show();
      return $("#ug-data").val((0, _stringify2.default)(model.toJSON()));
    });
  });
}).call(undefined);
},{"babel-runtime/core-js/json/stringify":9,"./editor/models.coffee":4,"./editor/editor.coffee":5,"./editor/tabs":6,"./editor/tabs.coffee":6,"./editor/fonts":7,"./editor/publish":8}]},{},[1])
//# sourceMappingURL=/grid-editor.map