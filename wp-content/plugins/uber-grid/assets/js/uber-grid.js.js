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
})({8:[function(require,module,exports) {
/**
 * Array.prototype.filter() - Polyfill
 *
 * @ref https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter
 */

'use strict';

(function() {
    if (!Array.prototype.filter) {
        Array.prototype.filter = function(fun/*, thisArg*/) {
            'use strict';

            if (this === void 0 || this === null) {
                throw new TypeError();
            }

            var t = Object(this);
            var len = t.length >>> 0;
            if (typeof fun !== 'function') {
                throw new TypeError();
            }

            var res = [];
            var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
            for (var i = 0; i < len; i++) {
                if (i in t) {
                    var val = t[i];

                    // NOTE: Technically this should Object.defineProperty at
                    //       the next index, as push can be affected by
                    //       properties on Object.prototype and Array.prototype.
                    //       But that method's new, and collisions should be
                    //       rare, so use the more-compatible alternative.
                    if (fun.call(thisArg, val, i, t)) {
                        res.push(val);
                    }
                }
            }

            return res;
        };
    }
})();

},{}],135:[function(require,module,exports) {

// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
var global = module.exports = typeof window != 'undefined' && window.Math == Math
  ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef

},{}],67:[function(require,module,exports) {
var core = module.exports = { version: '2.5.3' };
if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef

},{}],250:[function(require,module,exports) {
module.exports = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};

},{}],224:[function(require,module,exports) {
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

},{"./_a-function":250}],191:[function(require,module,exports) {
module.exports = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};

},{}],110:[function(require,module,exports) {
var isObject = require('./_is-object');
module.exports = function (it) {
  if (!isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};

},{"./_is-object":191}],172:[function(require,module,exports) {
module.exports = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};

},{}],168:[function(require,module,exports) {
// Thank's IE8 for his funny defineProperty
module.exports = !require('./_fails')(function () {
  return Object.defineProperty({}, 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_fails":172}],214:[function(require,module,exports) {
var isObject = require('./_is-object');
var document = require('./_global').document;
// typeof document.createElement is 'object' in old IE
var is = isObject(document) && isObject(document.createElement);
module.exports = function (it) {
  return is ? document.createElement(it) : {};
};

},{"./_is-object":191,"./_global":135}],211:[function(require,module,exports) {
module.exports = !require('./_descriptors') && !require('./_fails')(function () {
  return Object.defineProperty(require('./_dom-create')('div'), 'a', { get: function () { return 7; } }).a != 7;
});

},{"./_descriptors":168,"./_fails":172,"./_dom-create":214}],198:[function(require,module,exports) {
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

},{"./_is-object":191}],169:[function(require,module,exports) {
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

},{"./_an-object":110,"./_ie8-dom-define":211,"./_to-primitive":198,"./_descriptors":168}],199:[function(require,module,exports) {
module.exports = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};

},{}],136:[function(require,module,exports) {
var dP = require('./_object-dp');
var createDesc = require('./_property-desc');
module.exports = require('./_descriptors') ? function (object, key, value) {
  return dP.f(object, key, createDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};

},{"./_object-dp":169,"./_property-desc":199,"./_descriptors":168}],167:[function(require,module,exports) {

var global = require('./_global');
var core = require('./_core');
var ctx = require('./_ctx');
var hide = require('./_hide');
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
    if (own && key in exports) continue;
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

},{"./_global":135,"./_core":67,"./_ctx":224,"./_hide":136}],126:[function(require,module,exports) {
var $export = require('./_export');
// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
$export($export.S + $export.F * !require('./_descriptors'), 'Object', { defineProperty: require('./_object-dp').f });

},{"./_export":167,"./_descriptors":168,"./_object-dp":169}],61:[function(require,module,exports) {
require('../../modules/es6.object.define-property');
var $Object = require('../../modules/_core').Object;
module.exports = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};

},{"../../modules/es6.object.define-property":126,"../../modules/_core":67}],48:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/define-property"), __esModule: true };
},{"core-js/library/fn/object/define-property":61}],25:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _defineProperty = require("../core-js/object/define-property");

var _defineProperty2 = _interopRequireDefault(_defineProperty);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = function (obj, key, value) {
  if (key in obj) {
    (0, _defineProperty2.default)(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
};
},{"../core-js/object/define-property":48}],179:[function(require,module,exports) {
module.exports = function () { /* empty */ };

},{}],180:[function(require,module,exports) {
module.exports = function (done, value) {
  return { value: value, done: !!done };
};

},{}],137:[function(require,module,exports) {
module.exports = {};

},{}],248:[function(require,module,exports) {
var toString = {}.toString;

module.exports = function (it) {
  return toString.call(it).slice(8, -1);
};

},{}],226:[function(require,module,exports) {
// fallback for non-array-like ES3 and non-enumerable old V8 strings
var cof = require('./_cof');
// eslint-disable-next-line no-prototype-builtins
module.exports = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return cof(it) == 'String' ? it.split('') : Object(it);
};

},{"./_cof":248}],156:[function(require,module,exports) {
// 7.2.1 RequireObjectCoercible(argument)
module.exports = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};

},{}],181:[function(require,module,exports) {
// to indexed object, toObject with fallback for non-array-like ES3 strings
var IObject = require('./_iobject');
var defined = require('./_defined');
module.exports = function (it) {
  return IObject(defined(it));
};

},{"./_iobject":226,"./_defined":156}],187:[function(require,module,exports) {
module.exports = true;

},{}],188:[function(require,module,exports) {
module.exports = require('./_hide');

},{"./_hide":136}],170:[function(require,module,exports) {
var hasOwnProperty = {}.hasOwnProperty;
module.exports = function (it, key) {
  return hasOwnProperty.call(it, key);
};

},{}],155:[function(require,module,exports) {
// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
module.exports = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};

},{}],267:[function(require,module,exports) {
// 7.1.15 ToLength
var toInteger = require('./_to-integer');
var min = Math.min;
module.exports = function (it) {
  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};

},{"./_to-integer":155}],270:[function(require,module,exports) {
var toInteger = require('./_to-integer');
var max = Math.max;
var min = Math.min;
module.exports = function (index, length) {
  index = toInteger(index);
  return index < 0 ? max(index + length, 0) : min(index, length);
};

},{"./_to-integer":155}],263:[function(require,module,exports) {
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

},{"./_to-iobject":181,"./_to-length":267,"./_to-absolute-index":270}],194:[function(require,module,exports) {

var global = require('./_global');
var SHARED = '__core-js_shared__';
var store = global[SHARED] || (global[SHARED] = {});
module.exports = function (key) {
  return store[key] || (store[key] = {});
};

},{"./_global":135}],195:[function(require,module,exports) {
var id = 0;
var px = Math.random();
module.exports = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};

},{}],171:[function(require,module,exports) {
var shared = require('./_shared')('keys');
var uid = require('./_uid');
module.exports = function (key) {
  return shared[key] || (shared[key] = uid(key));
};

},{"./_shared":194,"./_uid":195}],247:[function(require,module,exports) {
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

},{"./_has":170,"./_to-iobject":181,"./_array-includes":263,"./_shared-key":171}],213:[function(require,module,exports) {
// IE 8- don't enum bug keys
module.exports = (
  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
).split(',');

},{}],178:[function(require,module,exports) {
// 19.1.2.14 / 15.2.3.14 Object.keys(O)
var $keys = require('./_object-keys-internal');
var enumBugKeys = require('./_enum-bug-keys');

module.exports = Object.keys || function keys(O) {
  return $keys(O, enumBugKeys);
};

},{"./_object-keys-internal":247,"./_enum-bug-keys":213}],212:[function(require,module,exports) {
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

},{"./_object-dp":169,"./_an-object":110,"./_object-keys":178,"./_descriptors":168}],215:[function(require,module,exports) {
var document = require('./_global').document;
module.exports = document && document.documentElement;

},{"./_global":135}],176:[function(require,module,exports) {
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

},{"./_an-object":110,"./_object-dps":212,"./_enum-bug-keys":213,"./_shared-key":171,"./_dom-create":214,"./_html":215}],138:[function(require,module,exports) {
var store = require('./_shared')('wks');
var uid = require('./_uid');
var Symbol = require('./_global').Symbol;
var USE_SYMBOL = typeof Symbol == 'function';

var $exports = module.exports = function (name) {
  return store[name] || (store[name] =
    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
};

$exports.store = store;

},{"./_shared":194,"./_uid":195,"./_global":135}],190:[function(require,module,exports) {
var def = require('./_object-dp').f;
var has = require('./_has');
var TAG = require('./_wks')('toStringTag');

module.exports = function (it, tag, stat) {
  if (it && !has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};

},{"./_object-dp":169,"./_has":170,"./_wks":138}],189:[function(require,module,exports) {
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

},{"./_object-create":176,"./_property-desc":199,"./_set-to-string-tag":190,"./_hide":136,"./_wks":138}],127:[function(require,module,exports) {
// 7.1.13 ToObject(argument)
var defined = require('./_defined');
module.exports = function (it) {
  return Object(defined(it));
};

},{"./_defined":156}],128:[function(require,module,exports) {
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

},{"./_has":170,"./_to-object":127,"./_shared-key":171}],109:[function(require,module,exports) {
'use strict';
var LIBRARY = require('./_library');
var $export = require('./_export');
var redefine = require('./_redefine');
var hide = require('./_hide');
var has = require('./_has');
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
  var $default = (!BUGGY && $native) || getMethod(DEFAULT);
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
      if (!LIBRARY && !has(IteratorPrototype, ITERATOR)) hide(IteratorPrototype, ITERATOR, returnThis);
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

},{"./_library":187,"./_export":167,"./_redefine":188,"./_hide":136,"./_has":170,"./_iterators":137,"./_iter-create":189,"./_set-to-string-tag":190,"./_object-gpo":128,"./_wks":138}],134:[function(require,module,exports) {
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

},{"./_add-to-unscopables":179,"./_iter-step":180,"./_iterators":137,"./_to-iobject":181,"./_iter-define":109}],63:[function(require,module,exports) {

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

},{"./es6.array.iterator":134,"./_global":135,"./_hide":136,"./_iterators":137,"./_wks":138}],108:[function(require,module,exports) {
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

},{"./_to-integer":155,"./_defined":156}],64:[function(require,module,exports) {
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

},{"./_string-at":108,"./_iter-define":109}],192:[function(require,module,exports) {
// getting tag from 19.1.3.6 Object.prototype.toString()
var cof = require('./_cof');
var TAG = require('./_wks')('toStringTag');
// ES3 wrong here
var ARG = cof(function () { return arguments; }()) == 'Arguments';

// fallback for IE11 Script Access Denied error
var tryGet = function (it, key) {
  try {
    return it[key];
  } catch (e) { /* empty */ }
};

module.exports = function (it) {
  var O, T, B;
  return it === undefined ? 'Undefined' : it === null ? 'Null'
    // @@toStringTag case
    : typeof (T = tryGet(O = Object(it), TAG)) == 'string' ? T
    // builtinTag case
    : ARG ? cof(O)
    // ES3 arguments fallback
    : (B = cof(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : B;
};

},{"./_cof":248,"./_wks":138}],111:[function(require,module,exports) {
var classof = require('./_classof');
var ITERATOR = require('./_wks')('iterator');
var Iterators = require('./_iterators');
module.exports = require('./_core').getIteratorMethod = function (it) {
  if (it != undefined) return it[ITERATOR]
    || it['@@iterator']
    || Iterators[classof(it)];
};

},{"./_classof":192,"./_wks":138,"./_iterators":137,"./_core":67}],65:[function(require,module,exports) {
var anObject = require('./_an-object');
var get = require('./core.get-iterator-method');
module.exports = require('./_core').getIterator = function (it) {
  var iterFn = get(it);
  if (typeof iterFn != 'function') throw TypeError(it + ' is not iterable!');
  return anObject(iterFn.call(it));
};

},{"./_an-object":110,"./core.get-iterator-method":111,"./_core":67}],50:[function(require,module,exports) {
require('../modules/web.dom.iterable');
require('../modules/es6.string.iterator');
module.exports = require('../modules/core.get-iterator');

},{"../modules/web.dom.iterable":63,"../modules/es6.string.iterator":64,"../modules/core.get-iterator":65}],26:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/get-iterator"), __esModule: true };
},{"core-js/library/fn/get-iterator":50}],154:[function(require,module,exports) {
'use strict';

var toStr = Object.prototype.toString;

module.exports = function isArguments(value) {
	var str = toStr.call(value);
	var isArgs = str === '[object Arguments]';
	if (!isArgs) {
		isArgs = str !== '[object Array]' && value !== null && typeof value === 'object' && typeof value.length === 'number' && value.length >= 0 && toStr.call(value.callee) === '[object Function]';
	}
	return isArgs;
};
},{}],99:[function(require,module,exports) {
'use strict';

// modified from https://github.com/es-shims/es5-shim

var has = Object.prototype.hasOwnProperty;
var toStr = Object.prototype.toString;
var slice = Array.prototype.slice;
var isArgs = require('./isArguments');
var isEnumerable = Object.prototype.propertyIsEnumerable;
var hasDontEnumBug = !isEnumerable.call({ toString: null }, 'toString');
var hasProtoEnumBug = isEnumerable.call(function () {}, 'prototype');
var dontEnums = ['toString', 'toLocaleString', 'valueOf', 'hasOwnProperty', 'isPrototypeOf', 'propertyIsEnumerable', 'constructor'];
var equalsConstructorPrototype = function (o) {
	var ctor = o.constructor;
	return ctor && ctor.prototype === o;
};
var excludedKeys = {
	$console: true,
	$external: true,
	$frame: true,
	$frameElement: true,
	$frames: true,
	$innerHeight: true,
	$innerWidth: true,
	$outerHeight: true,
	$outerWidth: true,
	$pageXOffset: true,
	$pageYOffset: true,
	$parent: true,
	$scrollLeft: true,
	$scrollTop: true,
	$scrollX: true,
	$scrollY: true,
	$self: true,
	$webkitIndexedDB: true,
	$webkitStorageInfo: true,
	$window: true
};
var hasAutomationEqualityBug = function () {
	/* global window */
	if (typeof window === 'undefined') {
		return false;
	}
	for (var k in window) {
		try {
			if (!excludedKeys['$' + k] && has.call(window, k) && window[k] !== null && typeof window[k] === 'object') {
				try {
					equalsConstructorPrototype(window[k]);
				} catch (e) {
					return true;
				}
			}
		} catch (e) {
			return true;
		}
	}
	return false;
}();
var equalsConstructorPrototypeIfNotBuggy = function (o) {
	/* global window */
	if (typeof window === 'undefined' || !hasAutomationEqualityBug) {
		return equalsConstructorPrototype(o);
	}
	try {
		return equalsConstructorPrototype(o);
	} catch (e) {
		return false;
	}
};

var keysShim = function keys(object) {
	var isObject = object !== null && typeof object === 'object';
	var isFunction = toStr.call(object) === '[object Function]';
	var isArguments = isArgs(object);
	var isString = isObject && toStr.call(object) === '[object String]';
	var theKeys = [];

	if (!isObject && !isFunction && !isArguments) {
		throw new TypeError('Object.keys called on a non-object');
	}

	var skipProto = hasProtoEnumBug && isFunction;
	if (isString && object.length > 0 && !has.call(object, 0)) {
		for (var i = 0; i < object.length; ++i) {
			theKeys.push(String(i));
		}
	}

	if (isArguments && object.length > 0) {
		for (var j = 0; j < object.length; ++j) {
			theKeys.push(String(j));
		}
	} else {
		for (var name in object) {
			if (!(skipProto && name === 'prototype') && has.call(object, name)) {
				theKeys.push(String(name));
			}
		}
	}

	if (hasDontEnumBug) {
		var skipConstructor = equalsConstructorPrototypeIfNotBuggy(object);

		for (var k = 0; k < dontEnums.length; ++k) {
			if (!(skipConstructor && dontEnums[k] === 'constructor') && has.call(object, dontEnums[k])) {
				theKeys.push(dontEnums[k]);
			}
		}
	}
	return theKeys;
};

keysShim.shim = function shimObjectKeys() {
	if (Object.keys) {
		var keysWorksWithArguments = function () {
			// Safari 5.0 bug
			return (Object.keys(arguments) || '').length === 2;
		}(1, 2);
		if (!keysWorksWithArguments) {
			var originalKeys = Object.keys;
			Object.keys = function keys(object) {
				if (isArgs(object)) {
					return originalKeys(slice.call(object));
				} else {
					return originalKeys(object);
				}
			};
		}
	} else {
		Object.keys = keysShim;
	}
	return Object.keys || keysShim;
};

module.exports = keysShim;
},{"./isArguments":154}],100:[function(require,module,exports) {

var hasOwn = Object.prototype.hasOwnProperty;
var toString = Object.prototype.toString;

module.exports = function forEach (obj, fn, ctx) {
    if (toString.call(fn) !== '[object Function]') {
        throw new TypeError('iterator must be a function');
    }
    var l = obj.length;
    if (l === +l) {
        for (var i = 0; i < l; i++) {
            fn.call(ctx, obj[i], i, obj);
        }
    } else {
        for (var k in obj) {
            if (hasOwn.call(obj, k)) {
                fn.call(ctx, obj[k], k, obj);
            }
        }
    }
};


},{}],29:[function(require,module,exports) {
'use strict';

var keys = require('object-keys');
var foreach = require('foreach');
var hasSymbols = typeof Symbol === 'function' && typeof Symbol() === 'symbol';

var toStr = Object.prototype.toString;

var isFunction = function (fn) {
	return typeof fn === 'function' && toStr.call(fn) === '[object Function]';
};

var arePropertyDescriptorsSupported = function () {
	var obj = {};
	try {
		Object.defineProperty(obj, 'x', { enumerable: false, value: obj });
		/* eslint-disable no-unused-vars, no-restricted-syntax */
		for (var _ in obj) {
			return false;
		}
		/* eslint-enable no-unused-vars, no-restricted-syntax */
		return obj.x === obj;
	} catch (e) {
		/* this is IE 8. */
		return false;
	}
};
var supportsDescriptors = Object.defineProperty && arePropertyDescriptorsSupported();

var defineProperty = function (object, name, value, predicate) {
	if (name in object && (!isFunction(predicate) || !predicate())) {
		return;
	}
	if (supportsDescriptors) {
		Object.defineProperty(object, name, {
			configurable: true,
			enumerable: false,
			value: value,
			writable: true
		});
	} else {
		object[name] = value;
	}
};

var defineProperties = function (object, map) {
	var predicates = arguments.length > 2 ? arguments[2] : {};
	var props = keys(map);
	if (hasSymbols) {
		props = props.concat(Object.getOwnPropertySymbols(map));
	}
	foreach(props, function (name) {
		defineProperty(object, name, map[name], predicates[name]);
	});
};

defineProperties.supportsDescriptors = !!supportsDescriptors;

module.exports = defineProperties;
},{"object-keys":99,"foreach":100}],186:[function(require,module,exports) {
'use strict';

/* eslint no-invalid-this: 1 */

var ERROR_MESSAGE = 'Function.prototype.bind called on incompatible ';
var slice = Array.prototype.slice;
var toStr = Object.prototype.toString;
var funcType = '[object Function]';

module.exports = function bind(that) {
    var target = this;
    if (typeof target !== 'function' || toStr.call(target) !== funcType) {
        throw new TypeError(ERROR_MESSAGE + target);
    }
    var args = slice.call(arguments, 1);

    var bound;
    var binder = function () {
        if (this instanceof bound) {
            var result = target.apply(
                this,
                args.concat(slice.call(arguments))
            );
            if (Object(result) === result) {
                return result;
            }
            return this;
        } else {
            return target.apply(
                that,
                args.concat(slice.call(arguments))
            );
        }
    };

    var boundLength = Math.max(0, target.length - args.length);
    var boundArgs = [];
    for (var i = 0; i < boundLength; i++) {
        boundArgs.push('$' + i);
    }

    bound = Function('binder', 'return function (' + boundArgs.join(',') + '){ return binder.apply(this,arguments); }')(binder);

    if (target.prototype) {
        var Empty = function Empty() {};
        Empty.prototype = target.prototype;
        bound.prototype = new Empty();
        Empty.prototype = null;
    }

    return bound;
};

},{}],151:[function(require,module,exports) {
'use strict';

var implementation = require('./implementation');

module.exports = Function.prototype.bind || implementation;

},{"./implementation":186}],150:[function(require,module,exports) {
var bind = require('function-bind');

module.exports = bind.call(Function.call, Object.prototype.hasOwnProperty);
},{"function-bind":151}],205:[function(require,module,exports) {
module.exports = function isPrimitive(value) {
	return value === null || typeof value !== 'function' && typeof value !== 'object';
};
},{}],206:[function(require,module,exports) {
'use strict';

var fnToStr = Function.prototype.toString;

var constructorRegex = /^\s*class /;
var isES6ClassFn = function isES6ClassFn(value) {
	try {
		var fnStr = fnToStr.call(value);
		var singleStripped = fnStr.replace(/\/\/.*\n/g, '');
		var multiStripped = singleStripped.replace(/\/\*[.\s\S]*\*\//g, '');
		var spaceStripped = multiStripped.replace(/\n/mg, ' ').replace(/ {2}/g, ' ');
		return constructorRegex.test(spaceStripped);
	} catch (e) {
		return false; // not a function
	}
};

var tryFunctionObject = function tryFunctionObject(value) {
	try {
		if (isES6ClassFn(value)) {
			return false;
		}
		fnToStr.call(value);
		return true;
	} catch (e) {
		return false;
	}
};
var toStr = Object.prototype.toString;
var fnClass = '[object Function]';
var genClass = '[object GeneratorFunction]';
var hasToStringTag = typeof Symbol === 'function' && typeof Symbol.toStringTag === 'symbol';

module.exports = function isCallable(value) {
	if (!value) {
		return false;
	}
	if (typeof value !== 'function' && typeof value !== 'object') {
		return false;
	}
	if (hasToStringTag) {
		return tryFunctionObject(value);
	}
	if (isES6ClassFn(value)) {
		return false;
	}
	var strClass = toStr.call(value);
	return strClass === fnClass || strClass === genClass;
};
},{}],207:[function(require,module,exports) {
'use strict';

var getDay = Date.prototype.getDay;
var tryDateObject = function tryDateObject(value) {
	try {
		getDay.call(value);
		return true;
	} catch (e) {
		return false;
	}
};

var toStr = Object.prototype.toString;
var dateClass = '[object Date]';
var hasToStringTag = typeof Symbol === 'function' && typeof Symbol.toStringTag === 'symbol';

module.exports = function isDateObject(value) {
	if (typeof value !== 'object' || value === null) {
		return false;
	}
	return hasToStringTag ? tryDateObject(value) : toStr.call(value) === dateClass;
};
},{}],208:[function(require,module,exports) {
'use strict';

var toStr = Object.prototype.toString;
var hasSymbols = typeof Symbol === 'function' && typeof Symbol() === 'symbol';

if (hasSymbols) {
	var symToStr = Symbol.prototype.toString;
	var symStringRegex = /^Symbol\(.*\)$/;
	var isSymbolObject = function isSymbolObject(value) {
		if (typeof value.valueOf() !== 'symbol') {
			return false;
		}
		return symStringRegex.test(symToStr.call(value));
	};
	module.exports = function isSymbol(value) {
		if (typeof value === 'symbol') {
			return true;
		}
		if (toStr.call(value) !== '[object Symbol]') {
			return false;
		}
		try {
			return isSymbolObject(value);
		} catch (e) {
			return false;
		}
	};
} else {
	module.exports = function isSymbol(value) {
		// this environment does not support Symbols.
		return false;
	};
}
},{}],149:[function(require,module,exports) {
'use strict';

var hasSymbols = typeof Symbol === 'function' && typeof Symbol.iterator === 'symbol';

var isPrimitive = require('./helpers/isPrimitive');
var isCallable = require('is-callable');
var isDate = require('is-date-object');
var isSymbol = require('is-symbol');

var ordinaryToPrimitive = function OrdinaryToPrimitive(O, hint) {
	if (typeof O === 'undefined' || O === null) {
		throw new TypeError('Cannot call method on ' + O);
	}
	if (typeof hint !== 'string' || hint !== 'number' && hint !== 'string') {
		throw new TypeError('hint must be "string" or "number"');
	}
	var methodNames = hint === 'string' ? ['toString', 'valueOf'] : ['valueOf', 'toString'];
	var method, result, i;
	for (i = 0; i < methodNames.length; ++i) {
		method = O[methodNames[i]];
		if (isCallable(method)) {
			result = method.call(O);
			if (isPrimitive(result)) {
				return result;
			}
		}
	}
	throw new TypeError('No default value');
};

var GetMethod = function GetMethod(O, P) {
	var func = O[P];
	if (func !== null && typeof func !== 'undefined') {
		if (!isCallable(func)) {
			throw new TypeError(func + ' returned for property ' + P + ' of object ' + O + ' is not a function');
		}
		return func;
	}
};

// http://www.ecma-international.org/ecma-262/6.0/#sec-toprimitive
module.exports = function ToPrimitive(input, PreferredType) {
	if (isPrimitive(input)) {
		return input;
	}
	var hint = 'default';
	if (arguments.length > 1) {
		if (PreferredType === String) {
			hint = 'string';
		} else if (PreferredType === Number) {
			hint = 'number';
		}
	}

	var exoticToPrim;
	if (hasSymbols) {
		if (Symbol.toPrimitive) {
			exoticToPrim = GetMethod(input, Symbol.toPrimitive);
		} else if (isSymbol(input)) {
			exoticToPrim = Symbol.prototype.valueOf;
		}
	}
	if (typeof exoticToPrim !== 'undefined') {
		var result = exoticToPrim.call(input, hint);
		if (isPrimitive(result)) {
			return result;
		}
		throw new TypeError('unable to convert exotic object to primitive');
	}
	if (hint === 'default' && (isDate(input) || isSymbol(input))) {
		hint = 'string';
	}
	return ordinaryToPrimitive(input, hint === 'default' ? 'number' : hint);
};
},{"./helpers/isPrimitive":205,"is-callable":206,"is-date-object":207,"is-symbol":208}],143:[function(require,module,exports) {
module.exports = Number.isNaN || function isNaN(a) {
	return a !== a;
};
},{}],142:[function(require,module,exports) {
var $isNaN = Number.isNaN || function (a) {
  return a !== a;
};

module.exports = Number.isFinite || function (x) {
  return typeof x === 'number' && !$isNaN(x) && x !== Infinity && x !== -Infinity;
};
},{}],144:[function(require,module,exports) {
var has = Object.prototype.hasOwnProperty;
module.exports = function assign(target, source) {
	if (Object.assign) {
		return Object.assign(target, source);
	}
	for (var key in source) {
		if (has.call(source, key)) {
			target[key] = source[key];
		}
	}
	return target;
};
},{}],145:[function(require,module,exports) {
module.exports = function sign(number) {
	return number >= 0 ? 1 : -1;
};
},{}],147:[function(require,module,exports) {
module.exports = function mod(number, modulo) {
	var remain = number % modulo;
	return Math.floor(remain >= 0 ? remain : remain + modulo);
};
},{}],209:[function(require,module,exports) {
'use strict';

var toStr = Object.prototype.toString;

var isPrimitive = require('./helpers/isPrimitive');

var isCallable = require('is-callable');

// https://es5.github.io/#x8.12
var ES5internalSlots = {
	'[[DefaultValue]]': function (O, hint) {
		var actualHint = hint || (toStr.call(O) === '[object Date]' ? String : Number);

		if (actualHint === String || actualHint === Number) {
			var methods = actualHint === String ? ['toString', 'valueOf'] : ['valueOf', 'toString'];
			var value, i;
			for (i = 0; i < methods.length; ++i) {
				if (isCallable(O[methods[i]])) {
					value = O[methods[i]]();
					if (isPrimitive(value)) {
						return value;
					}
				}
			}
			throw new TypeError('No default value');
		}
		throw new TypeError('invalid [[DefaultValue]] hint supplied');
	}
};

// https://es5.github.io/#x9
module.exports = function ToPrimitive(input, PreferredType) {
	if (isPrimitive(input)) {
		return input;
	}
	return ES5internalSlots['[[DefaultValue]]'](input, PreferredType);
};
},{"./helpers/isPrimitive":205,"is-callable":206}],141:[function(require,module,exports) {
'use strict';

var $isNaN = require('./helpers/isNaN');
var $isFinite = require('./helpers/isFinite');

var sign = require('./helpers/sign');
var mod = require('./helpers/mod');

var IsCallable = require('is-callable');
var toPrimitive = require('es-to-primitive/es5');

var has = require('has');

// https://es5.github.io/#x9
var ES5 = {
	ToPrimitive: toPrimitive,

	ToBoolean: function ToBoolean(value) {
		return !!value;
	},
	ToNumber: function ToNumber(value) {
		return Number(value);
	},
	ToInteger: function ToInteger(value) {
		var number = this.ToNumber(value);
		if ($isNaN(number)) {
			return 0;
		}
		if (number === 0 || !$isFinite(number)) {
			return number;
		}
		return sign(number) * Math.floor(Math.abs(number));
	},
	ToInt32: function ToInt32(x) {
		return this.ToNumber(x) >> 0;
	},
	ToUint32: function ToUint32(x) {
		return this.ToNumber(x) >>> 0;
	},
	ToUint16: function ToUint16(value) {
		var number = this.ToNumber(value);
		if ($isNaN(number) || number === 0 || !$isFinite(number)) {
			return 0;
		}
		var posInt = sign(number) * Math.floor(Math.abs(number));
		return mod(posInt, 0x10000);
	},
	ToString: function ToString(value) {
		return String(value);
	},
	ToObject: function ToObject(value) {
		this.CheckObjectCoercible(value);
		return Object(value);
	},
	CheckObjectCoercible: function CheckObjectCoercible(value, optMessage) {
		/* jshint eqnull:true */
		if (value == null) {
			throw new TypeError(optMessage || 'Cannot call method on ' + value);
		}
		return value;
	},
	IsCallable: IsCallable,
	SameValue: function SameValue(x, y) {
		if (x === y) {
			// 0 === -0, but they are not identical.
			if (x === 0) {
				return 1 / x === 1 / y;
			}
			return true;
		}
		return $isNaN(x) && $isNaN(y);
	},

	// http://www.ecma-international.org/ecma-262/5.1/#sec-8
	Type: function Type(x) {
		if (x === null) {
			return 'Null';
		}
		if (typeof x === 'undefined') {
			return 'Undefined';
		}
		if (typeof x === 'function' || typeof x === 'object') {
			return 'Object';
		}
		if (typeof x === 'number') {
			return 'Number';
		}
		if (typeof x === 'boolean') {
			return 'Boolean';
		}
		if (typeof x === 'string') {
			return 'String';
		}
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-property-descriptor-specification-type
	IsPropertyDescriptor: function IsPropertyDescriptor(Desc) {
		if (this.Type(Desc) !== 'Object') {
			return false;
		}
		var allowed = {
			'[[Configurable]]': true,
			'[[Enumerable]]': true,
			'[[Get]]': true,
			'[[Set]]': true,
			'[[Value]]': true,
			'[[Writable]]': true
		};
		// jscs:disable
		for (var key in Desc) {
			// eslint-disable-line
			if (has(Desc, key) && !allowed[key]) {
				return false;
			}
		}
		// jscs:enable
		var isData = has(Desc, '[[Value]]');
		var IsAccessor = has(Desc, '[[Get]]') || has(Desc, '[[Set]]');
		if (isData && IsAccessor) {
			throw new TypeError('Property Descriptors may not be both accessor and data descriptors');
		}
		return true;
	},

	// http://ecma-international.org/ecma-262/5.1/#sec-8.10.1
	IsAccessorDescriptor: function IsAccessorDescriptor(Desc) {
		if (typeof Desc === 'undefined') {
			return false;
		}

		if (!this.IsPropertyDescriptor(Desc)) {
			throw new TypeError('Desc must be a Property Descriptor');
		}

		if (!has(Desc, '[[Get]]') && !has(Desc, '[[Set]]')) {
			return false;
		}

		return true;
	},

	// http://ecma-international.org/ecma-262/5.1/#sec-8.10.2
	IsDataDescriptor: function IsDataDescriptor(Desc) {
		if (typeof Desc === 'undefined') {
			return false;
		}

		if (!this.IsPropertyDescriptor(Desc)) {
			throw new TypeError('Desc must be a Property Descriptor');
		}

		if (!has(Desc, '[[Value]]') && !has(Desc, '[[Writable]]')) {
			return false;
		}

		return true;
	},

	// http://ecma-international.org/ecma-262/5.1/#sec-8.10.3
	IsGenericDescriptor: function IsGenericDescriptor(Desc) {
		if (typeof Desc === 'undefined') {
			return false;
		}

		if (!this.IsPropertyDescriptor(Desc)) {
			throw new TypeError('Desc must be a Property Descriptor');
		}

		if (!this.IsAccessorDescriptor(Desc) && !this.IsDataDescriptor(Desc)) {
			return true;
		}

		return false;
	},

	// http://ecma-international.org/ecma-262/5.1/#sec-8.10.4
	FromPropertyDescriptor: function FromPropertyDescriptor(Desc) {
		if (typeof Desc === 'undefined') {
			return Desc;
		}

		if (!this.IsPropertyDescriptor(Desc)) {
			throw new TypeError('Desc must be a Property Descriptor');
		}

		if (this.IsDataDescriptor(Desc)) {
			return {
				value: Desc['[[Value]]'],
				writable: !!Desc['[[Writable]]'],
				enumerable: !!Desc['[[Enumerable]]'],
				configurable: !!Desc['[[Configurable]]']
			};
		} else if (this.IsAccessorDescriptor(Desc)) {
			return {
				get: Desc['[[Get]]'],
				set: Desc['[[Set]]'],
				enumerable: !!Desc['[[Enumerable]]'],
				configurable: !!Desc['[[Configurable]]']
			};
		} else {
			throw new TypeError('FromPropertyDescriptor must be called with a fully populated Property Descriptor');
		}
	},

	// http://ecma-international.org/ecma-262/5.1/#sec-8.10.5
	ToPropertyDescriptor: function ToPropertyDescriptor(Obj) {
		if (this.Type(Obj) !== 'Object') {
			throw new TypeError('ToPropertyDescriptor requires an object');
		}

		var desc = {};
		if (has(Obj, 'enumerable')) {
			desc['[[Enumerable]]'] = this.ToBoolean(Obj.enumerable);
		}
		if (has(Obj, 'configurable')) {
			desc['[[Configurable]]'] = this.ToBoolean(Obj.configurable);
		}
		if (has(Obj, 'value')) {
			desc['[[Value]]'] = Obj.value;
		}
		if (has(Obj, 'writable')) {
			desc['[[Writable]]'] = this.ToBoolean(Obj.writable);
		}
		if (has(Obj, 'get')) {
			var getter = Obj.get;
			if (typeof getter !== 'undefined' && !this.IsCallable(getter)) {
				throw new TypeError('getter must be a function');
			}
			desc['[[Get]]'] = getter;
		}
		if (has(Obj, 'set')) {
			var setter = Obj.set;
			if (typeof setter !== 'undefined' && !this.IsCallable(setter)) {
				throw new TypeError('setter must be a function');
			}
			desc['[[Set]]'] = setter;
		}

		if ((has(desc, '[[Get]]') || has(desc, '[[Set]]')) && (has(desc, '[[Value]]') || has(desc, '[[Writable]]'))) {
			throw new TypeError('Invalid property descriptor. Cannot both specify accessors and a value or writable attribute');
		}
		return desc;
	}
};

module.exports = ES5;
},{"./helpers/isNaN":143,"./helpers/isFinite":142,"./helpers/sign":145,"./helpers/mod":147,"is-callable":206,"es-to-primitive/es5":209,"has":150}],148:[function(require,module,exports) {
'use strict';

var has = require('has');
var regexExec = RegExp.prototype.exec;
var gOPD = Object.getOwnPropertyDescriptor;

var tryRegexExecCall = function tryRegexExec(value) {
	try {
		var lastIndex = value.lastIndex;
		value.lastIndex = 0;

		regexExec.call(value);
		return true;
	} catch (e) {
		return false;
	} finally {
		value.lastIndex = lastIndex;
	}
};
var toStr = Object.prototype.toString;
var regexClass = '[object RegExp]';
var hasToStringTag = typeof Symbol === 'function' && typeof Symbol.toStringTag === 'symbol';

module.exports = function isRegex(value) {
	if (!value || typeof value !== 'object') {
		return false;
	}
	if (!hasToStringTag) {
		return toStr.call(value) === regexClass;
	}

	var descriptor = gOPD(value, 'lastIndex');
	var hasLastIndexDataProperty = descriptor && has(descriptor, 'value');
	if (!hasLastIndexDataProperty) {
		return false;
	}

	return tryRegexExecCall(value);
};
},{"has":150}],76:[function(require,module,exports) {
'use strict';

var has = require('has');
var toPrimitive = require('es-to-primitive/es6');

var toStr = Object.prototype.toString;
var hasSymbols = typeof Symbol === 'function' && typeof Symbol.iterator === 'symbol';

var $isNaN = require('./helpers/isNaN');
var $isFinite = require('./helpers/isFinite');
var MAX_SAFE_INTEGER = Number.MAX_SAFE_INTEGER || Math.pow(2, 53) - 1;

var assign = require('./helpers/assign');
var sign = require('./helpers/sign');
var mod = require('./helpers/mod');
var isPrimitive = require('./helpers/isPrimitive');
var parseInteger = parseInt;
var bind = require('function-bind');
var arraySlice = bind.call(Function.call, Array.prototype.slice);
var strSlice = bind.call(Function.call, String.prototype.slice);
var isBinary = bind.call(Function.call, RegExp.prototype.test, /^0b[01]+$/i);
var isOctal = bind.call(Function.call, RegExp.prototype.test, /^0o[0-7]+$/i);
var regexExec = bind.call(Function.call, RegExp.prototype.exec);
var nonWS = ['\u0085', '\u200b', '\ufffe'].join('');
var nonWSregex = new RegExp('[' + nonWS + ']', 'g');
var hasNonWS = bind.call(Function.call, RegExp.prototype.test, nonWSregex);
var invalidHexLiteral = /^[-+]0x[0-9a-f]+$/i;
var isInvalidHexLiteral = bind.call(Function.call, RegExp.prototype.test, invalidHexLiteral);

// whitespace from: http://es5.github.io/#x15.5.4.20
// implementation from https://github.com/es-shims/es5-shim/blob/v3.4.0/es5-shim.js#L1304-L1324
var ws = ['\x09\x0A\x0B\x0C\x0D\x20\xA0\u1680\u180E\u2000\u2001\u2002\u2003', '\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028', '\u2029\uFEFF'].join('');
var trimRegex = new RegExp('(^[' + ws + ']+)|([' + ws + ']+$)', 'g');
var replace = bind.call(Function.call, String.prototype.replace);
var trim = function (value) {
	return replace(value, trimRegex, '');
};

var ES5 = require('./es5');

var hasRegExpMatcher = require('is-regex');

// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-abstract-operations
var ES6 = assign(assign({}, ES5), {

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-call-f-v-args
	Call: function Call(F, V) {
		var args = arguments.length > 2 ? arguments[2] : [];
		if (!this.IsCallable(F)) {
			throw new TypeError(F + ' is not a function');
		}
		return F.apply(V, args);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toprimitive
	ToPrimitive: toPrimitive,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toboolean
	// ToBoolean: ES5.ToBoolean,

	// http://www.ecma-international.org/ecma-262/6.0/#sec-tonumber
	ToNumber: function ToNumber(argument) {
		var value = isPrimitive(argument) ? argument : toPrimitive(argument, Number);
		if (typeof value === 'symbol') {
			throw new TypeError('Cannot convert a Symbol value to a number');
		}
		if (typeof value === 'string') {
			if (isBinary(value)) {
				return this.ToNumber(parseInteger(strSlice(value, 2), 2));
			} else if (isOctal(value)) {
				return this.ToNumber(parseInteger(strSlice(value, 2), 8));
			} else if (hasNonWS(value) || isInvalidHexLiteral(value)) {
				return NaN;
			} else {
				var trimmed = trim(value);
				if (trimmed !== value) {
					return this.ToNumber(trimmed);
				}
			}
		}
		return Number(value);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-tointeger
	// ToInteger: ES5.ToNumber,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toint32
	// ToInt32: ES5.ToInt32,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-touint32
	// ToUint32: ES5.ToUint32,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toint16
	ToInt16: function ToInt16(argument) {
		var int16bit = this.ToUint16(argument);
		return int16bit >= 0x8000 ? int16bit - 0x10000 : int16bit;
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-touint16
	// ToUint16: ES5.ToUint16,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toint8
	ToInt8: function ToInt8(argument) {
		var int8bit = this.ToUint8(argument);
		return int8bit >= 0x80 ? int8bit - 0x100 : int8bit;
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-touint8
	ToUint8: function ToUint8(argument) {
		var number = this.ToNumber(argument);
		if ($isNaN(number) || number === 0 || !$isFinite(number)) {
			return 0;
		}
		var posInt = sign(number) * Math.floor(Math.abs(number));
		return mod(posInt, 0x100);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-touint8clamp
	ToUint8Clamp: function ToUint8Clamp(argument) {
		var number = this.ToNumber(argument);
		if ($isNaN(number) || number <= 0) {
			return 0;
		}
		if (number >= 0xFF) {
			return 0xFF;
		}
		var f = Math.floor(argument);
		if (f + 0.5 < number) {
			return f + 1;
		}
		if (number < f + 0.5) {
			return f;
		}
		if (f % 2 !== 0) {
			return f + 1;
		}
		return f;
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-tostring
	ToString: function ToString(argument) {
		if (typeof argument === 'symbol') {
			throw new TypeError('Cannot convert a Symbol value to a string');
		}
		return String(argument);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-toobject
	ToObject: function ToObject(value) {
		this.RequireObjectCoercible(value);
		return Object(value);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-topropertykey
	ToPropertyKey: function ToPropertyKey(argument) {
		var key = this.ToPrimitive(argument, String);
		return typeof key === 'symbol' ? key : this.ToString(key);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-tolength
	ToLength: function ToLength(argument) {
		var len = this.ToInteger(argument);
		if (len <= 0) {
			return 0;
		} // includes converting -0 to +0
		if (len > MAX_SAFE_INTEGER) {
			return MAX_SAFE_INTEGER;
		}
		return len;
	},

	// http://www.ecma-international.org/ecma-262/6.0/#sec-canonicalnumericindexstring
	CanonicalNumericIndexString: function CanonicalNumericIndexString(argument) {
		if (toStr.call(argument) !== '[object String]') {
			throw new TypeError('must be a string');
		}
		if (argument === '-0') {
			return -0;
		}
		var n = this.ToNumber(argument);
		if (this.SameValue(this.ToString(n), argument)) {
			return n;
		}
		return void 0;
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-requireobjectcoercible
	RequireObjectCoercible: ES5.CheckObjectCoercible,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-isarray
	IsArray: Array.isArray || function IsArray(argument) {
		return toStr.call(argument) === '[object Array]';
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-iscallable
	// IsCallable: ES5.IsCallable,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-isconstructor
	IsConstructor: function IsConstructor(argument) {
		return typeof argument === 'function' && !!argument.prototype; // unfortunately there's no way to truly check this without try/catch `new argument`
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-isextensible-o
	IsExtensible: function IsExtensible(obj) {
		if (!Object.preventExtensions) {
			return true;
		}
		if (isPrimitive(obj)) {
			return false;
		}
		return Object.isExtensible(obj);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-isinteger
	IsInteger: function IsInteger(argument) {
		if (typeof argument !== 'number' || $isNaN(argument) || !$isFinite(argument)) {
			return false;
		}
		var abs = Math.abs(argument);
		return Math.floor(abs) === abs;
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-ispropertykey
	IsPropertyKey: function IsPropertyKey(argument) {
		return typeof argument === 'string' || typeof argument === 'symbol';
	},

	// http://www.ecma-international.org/ecma-262/6.0/#sec-isregexp
	IsRegExp: function IsRegExp(argument) {
		if (!argument || typeof argument !== 'object') {
			return false;
		}
		if (hasSymbols) {
			var isRegExp = argument[Symbol.match];
			if (typeof isRegExp !== 'undefined') {
				return ES5.ToBoolean(isRegExp);
			}
		}
		return hasRegExpMatcher(argument);
	},

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-samevalue
	// SameValue: ES5.SameValue,

	// https://people.mozilla.org/~jorendorff/es6-draft.html#sec-samevaluezero
	SameValueZero: function SameValueZero(x, y) {
		return x === y || $isNaN(x) && $isNaN(y);
	},

	/**
  * 7.3.2 GetV (V, P)
  * 1. Assert: IsPropertyKey(P) is true.
  * 2. Let O be ToObject(V).
  * 3. ReturnIfAbrupt(O).
  * 4. Return O.[[Get]](P, V).
  */
	GetV: function GetV(V, P) {
		// 7.3.2.1
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('Assertion failed: IsPropertyKey(P) is not true');
		}

		// 7.3.2.2-3
		var O = this.ToObject(V);

		// 7.3.2.4
		return O[P];
	},

	/**
  * 7.3.9 - http://www.ecma-international.org/ecma-262/6.0/#sec-getmethod
  * 1. Assert: IsPropertyKey(P) is true.
  * 2. Let func be GetV(O, P).
  * 3. ReturnIfAbrupt(func).
  * 4. If func is either undefined or null, return undefined.
  * 5. If IsCallable(func) is false, throw a TypeError exception.
  * 6. Return func.
  */
	GetMethod: function GetMethod(O, P) {
		// 7.3.9.1
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('Assertion failed: IsPropertyKey(P) is not true');
		}

		// 7.3.9.2
		var func = this.GetV(O, P);

		// 7.3.9.4
		if (func == null) {
			return void 0;
		}

		// 7.3.9.5
		if (!this.IsCallable(func)) {
			throw new TypeError(P + 'is not a function');
		}

		// 7.3.9.6
		return func;
	},

	/**
  * 7.3.1 Get (O, P) - http://www.ecma-international.org/ecma-262/6.0/#sec-get-o-p
  * 1. Assert: Type(O) is Object.
  * 2. Assert: IsPropertyKey(P) is true.
  * 3. Return O.[[Get]](P, O).
  */
	Get: function Get(O, P) {
		// 7.3.1.1
		if (this.Type(O) !== 'Object') {
			throw new TypeError('Assertion failed: Type(O) is not Object');
		}
		// 7.3.1.2
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('Assertion failed: IsPropertyKey(P) is not true');
		}
		// 7.3.1.3
		return O[P];
	},

	Type: function Type(x) {
		if (typeof x === 'symbol') {
			return 'Symbol';
		}
		return ES5.Type(x);
	},

	// http://www.ecma-international.org/ecma-262/6.0/#sec-speciesconstructor
	SpeciesConstructor: function SpeciesConstructor(O, defaultConstructor) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('Assertion failed: Type(O) is not Object');
		}
		var C = O.constructor;
		if (typeof C === 'undefined') {
			return defaultConstructor;
		}
		if (this.Type(C) !== 'Object') {
			throw new TypeError('O.constructor is not an Object');
		}
		var S = hasSymbols && Symbol.species ? C[Symbol.species] : void 0;
		if (S == null) {
			return defaultConstructor;
		}
		if (this.IsConstructor(S)) {
			return S;
		}
		throw new TypeError('no constructor found');
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-completepropertydescriptor
	CompletePropertyDescriptor: function CompletePropertyDescriptor(Desc) {
		if (!this.IsPropertyDescriptor(Desc)) {
			throw new TypeError('Desc must be a Property Descriptor');
		}

		if (this.IsGenericDescriptor(Desc) || this.IsDataDescriptor(Desc)) {
			if (!has(Desc, '[[Value]]')) {
				Desc['[[Value]]'] = void 0;
			}
			if (!has(Desc, '[[Writable]]')) {
				Desc['[[Writable]]'] = false;
			}
		} else {
			if (!has(Desc, '[[Get]]')) {
				Desc['[[Get]]'] = void 0;
			}
			if (!has(Desc, '[[Set]]')) {
				Desc['[[Set]]'] = void 0;
			}
		}
		if (!has(Desc, '[[Enumerable]]')) {
			Desc['[[Enumerable]]'] = false;
		}
		if (!has(Desc, '[[Configurable]]')) {
			Desc['[[Configurable]]'] = false;
		}
		return Desc;
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-set-o-p-v-throw
	Set: function Set(O, P, V, Throw) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('O must be an Object');
		}
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('P must be a Property Key');
		}
		if (this.Type(Throw) !== 'Boolean') {
			throw new TypeError('Throw must be a Boolean');
		}
		if (Throw) {
			O[P] = V;
			return true;
		} else {
			try {
				O[P] = V;
			} catch (e) {
				return false;
			}
		}
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-hasownproperty
	HasOwnProperty: function HasOwnProperty(O, P) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('O must be an Object');
		}
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('P must be a Property Key');
		}
		return has(O, P);
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-hasproperty
	HasProperty: function HasProperty(O, P) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('O must be an Object');
		}
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('P must be a Property Key');
		}
		return P in O;
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-isconcatspreadable
	IsConcatSpreadable: function IsConcatSpreadable(O) {
		if (this.Type(O) !== 'Object') {
			return false;
		}
		if (hasSymbols && typeof Symbol.isConcatSpreadable === 'symbol') {
			var spreadable = this.Get(O, Symbol.isConcatSpreadable);
			if (typeof spreadable !== 'undefined') {
				return this.ToBoolean(spreadable);
			}
		}
		return this.IsArray(O);
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-invoke
	Invoke: function Invoke(O, P) {
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('P must be a Property Key');
		}
		var argumentsList = arraySlice(arguments, 2);
		var func = this.GetV(O, P);
		return this.Call(func, O, argumentsList);
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-createiterresultobject
	CreateIterResultObject: function CreateIterResultObject(value, done) {
		if (this.Type(done) !== 'Boolean') {
			throw new TypeError('Assertion failed: Type(done) is not Boolean');
		}
		return {
			value: value,
			done: done
		};
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-regexpexec
	RegExpExec: function RegExpExec(R, S) {
		if (this.Type(R) !== 'Object') {
			throw new TypeError('R must be an Object');
		}
		if (this.Type(S) !== 'String') {
			throw new TypeError('S must be a String');
		}
		var exec = this.Get(R, 'exec');
		if (this.IsCallable(exec)) {
			var result = this.Call(exec, R, [S]);
			if (result === null || this.Type(result) === 'Object') {
				return result;
			}
			throw new TypeError('"exec" method must return `null` or an Object');
		}
		return regexExec(R, S);
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-arrayspeciescreate
	ArraySpeciesCreate: function ArraySpeciesCreate(originalArray, length) {
		if (!this.IsInteger(length) || length < 0) {
			throw new TypeError('Assertion failed: length must be an integer >= 0');
		}
		var len = length === 0 ? 0 : length;
		var C;
		var isArray = this.IsArray(originalArray);
		if (isArray) {
			C = this.Get(originalArray, 'constructor');
			// TODO: figure out how to make a cross-realm normal Array, a same-realm Array
			// if (this.IsConstructor(C)) {
			// 	if C is another realm's Array, C = undefined
			// 	Object.getPrototypeOf(Object.getPrototypeOf(Object.getPrototypeOf(Array))) === null ?
			// }
			if (this.Type(C) === 'Object' && hasSymbols && Symbol.species) {
				C = this.Get(C, Symbol.species);
				if (C === null) {
					C = void 0;
				}
			}
		}
		if (typeof C === 'undefined') {
			return Array(len);
		}
		if (!this.IsConstructor(C)) {
			throw new TypeError('C must be a constructor');
		}
		return new C(len); // this.Construct(C, len);
	},

	CreateDataProperty: function CreateDataProperty(O, P, V) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('Assertion failed: Type(O) is not Object');
		}
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('Assertion failed: IsPropertyKey(P) is not true');
		}
		var oldDesc = Object.getOwnPropertyDescriptor(O, P);
		var extensible = oldDesc || typeof Object.isExtensible !== 'function' || Object.isExtensible(O);
		var immutable = oldDesc && (!oldDesc.writable || !oldDesc.configurable);
		if (immutable || !extensible) {
			return false;
		}
		var newDesc = {
			configurable: true,
			enumerable: true,
			value: V,
			writable: true
		};
		Object.defineProperty(O, P, newDesc);
		return true;
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-createdatapropertyorthrow
	CreateDataPropertyOrThrow: function CreateDataPropertyOrThrow(O, P, V) {
		if (this.Type(O) !== 'Object') {
			throw new TypeError('Assertion failed: Type(O) is not Object');
		}
		if (!this.IsPropertyKey(P)) {
			throw new TypeError('Assertion failed: IsPropertyKey(P) is not true');
		}
		var success = this.CreateDataProperty(O, P, V);
		if (!success) {
			throw new TypeError('unable to create data property');
		}
		return success;
	},

	// http://ecma-international.org/ecma-262/6.0/#sec-advancestringindex
	AdvanceStringIndex: function AdvanceStringIndex(S, index, unicode) {
		if (this.Type(S) !== 'String') {
			throw new TypeError('Assertion failed: Type(S) is not String');
		}
		if (!this.IsInteger(index)) {
			throw new TypeError('Assertion failed: length must be an integer >= 0 and <= (2**53 - 1)');
		}
		if (index < 0 || index > MAX_SAFE_INTEGER) {
			throw new RangeError('Assertion failed: length must be an integer >= 0 and <= (2**53 - 1)');
		}
		if (this.Type(unicode) !== 'Boolean') {
			throw new TypeError('Assertion failed: Type(unicode) is not Boolean');
		}
		if (!unicode) {
			return index + 1;
		}
		var length = S.length;
		if (index + 1 >= length) {
			return index + 1;
		}
		var first = S.charCodeAt(index);
		if (first < 0xD800 || first > 0xDBFF) {
			return index + 1;
		}
		var second = S.charCodeAt(index + 1);
		if (second < 0xDC00 || second > 0xDFFF) {
			return index + 1;
		}
		return index + 2;
	}
});

delete ES6.CheckObjectCoercible; // renamed in ES6 to RequireObjectCoercible

module.exports = ES6;
},{"has":150,"es-to-primitive/es6":149,"./helpers/isNaN":143,"./helpers/isFinite":142,"./helpers/assign":144,"./helpers/sign":145,"./helpers/mod":147,"./helpers/isPrimitive":205,"function-bind":151,"./es5":141,"is-regex":148}],30:[function(require,module,exports) {
'use strict';

module.exports = require('./es2015');
},{"./es2015":76}],20:[function(require,module,exports) {
'use strict';

var ES = require('es-abstract/es6');

module.exports = function find(predicate) {
	var list = ES.ToObject(this);
	var length = ES.ToInteger(ES.ToLength(list.length));
	if (!ES.IsCallable(predicate)) {
		throw new TypeError('Array#find: predicate must be a function');
	}
	if (length === 0) {
		return undefined;
	}
	var thisArg = arguments[1];
	for (var i = 0, value; i < length; i++) {
		value = list[i];
		if (ES.Call(predicate, thisArg, [value, i, list])) {
			return value;
		}
	}
	return undefined;
};

},{"es-abstract/es6":30}],22:[function(require,module,exports) {
'use strict';

module.exports = function getPolyfill() {
	// Detect if an implementation exists
	// Detect early implementations which skipped holes in sparse arrays
  // eslint-disable-next-line no-sparse-arrays
	var implemented = Array.prototype.find && [, 1].find(function () {
		return true;
	}) !== 1;

  // eslint-disable-next-line global-require
	return implemented ? Array.prototype.find : require('./implementation');
};

},{"./implementation":20}],21:[function(require,module,exports) {
'use strict';

var define = require('define-properties');
var getPolyfill = require('./polyfill');

module.exports = function shimArrayPrototypeFind() {
	var polyfill = getPolyfill();

	define(Array.prototype, { find: polyfill }, {
		find: function () {
			return Array.prototype.find !== polyfill;
		}
	});

	return polyfill;
};

},{"define-properties":29,"./polyfill":22}],9:[function(require,module,exports) {
'use strict';

var define = require('define-properties');
var ES = require('es-abstract/es6');

var implementation = require('./implementation');
var getPolyfill = require('./polyfill');
var shim = require('./shim');

var slice = Array.prototype.slice;

var polyfill = getPolyfill();

var boundFindShim = function find(array, predicate) { // eslint-disable-line no-unused-vars
	ES.RequireObjectCoercible(array);
	var args = slice.call(arguments, 1);
	return polyfill.apply(array, args);
};

define(boundFindShim, {
	getPolyfill: getPolyfill,
	implementation: implementation,
	shim: shim
});

module.exports = boundFindShim;

},{"define-properties":29,"es-abstract/es6":30,"./implementation":20,"./polyfill":22,"./shim":21}],19:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.filter = filter;
exports.gather = gather;
exports.cellTags = cellTags;

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var array = function array(something) {
  return Array.prototype.slice.call(something);
};
var includes = function includes(item, array) {
  return array.indexOf(item) !== -1;
};
function __guard__(value, transform) {
  return typeof value !== 'undefined' && value !== null ? transform(value) : undefined;
}

function filter(items, filter) {
  return items.filter(function (item) {
    return includes(filter, item.tags);
  });
}

function filterFromLink(link) {
  return {
    slug: link.attributes.href.value.replace(/^#/, ''),
    text: link.innerText
  };
}
function gather(el) {
  var filters = el.querySelector('div.uber-grid-filters');
  if (!filters) {
    return null;
  }
  return array(filters.querySelectorAll('a')).map(filterFromLink);
}

function cellTags(tags) {
  return (tags || '').split(/,\s+/);
}
},{"array.prototype.find":9}],24:[function(require,module,exports) {
'use strict';

module.exports = function (str, sep) {
	if (typeof str !== 'string') {
		throw new TypeError('Expected a string');
	}

	sep = typeof sep === 'undefined' ? '_' : sep;

	return str.replace(/([a-z\d])([A-Z])/g, '$1' + sep + '$2').replace(/([A-Z]+)([A-Z][a-z\d]+)/g, '$1' + sep + '$2').toLowerCase();
};
},{}],3:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = require('babel-runtime/helpers/defineProperty');

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _getIterator2 = require('babel-runtime/core-js/get-iterator');

var _getIterator3 = _interopRequireDefault(_getIterator2);

exports.default = function (el, config) {
  var filters = (0, _filters.gather)(el);
  return (0, _defineProperty3.default)({
    config: config,
    filter: getFilter(config, filters),
    className: el.querySelector('.uber-grid').attributes.class.value,
    filters: __guard__(filters, function (x) {
      return x.filter(function (filter) {
        return !!filter && !!filter.slug;
      });
    }),
    all: __guard__(__guard__(filters, function (x2) {
      return x2.filter(function (filter) {
        return !filter || !filter.slug;
      })[0];
    }), function (x1) {
      return x1.text;
    }),
    cells: collectItems(el, config, data('slug', el)),
    id: __guard__(el.querySelector('.uber-grid'), function (x3) {
      return x3.id;
    }),
    page: 0,
    visibleCells: [],
    filteredCells: [],
    hoverEffect: data('effect', el),
    slug: data('slug', el)
  }, 'config', config);
};

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

var _filters = require('./filters');

var _decamelize = require('decamelize');

var _decamelize2 = _interopRequireDefault(_decamelize);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var cellContent = function cellContent(el) {
  return el.querySelector('div.uber-grid-cell-content');
};
var getLightboxType = function getLightboxType(el) {
  var content = cellContent(el);
  if (data('lightboxMode', content) === 'ubergrid') {
    return 'iframe';
  }
  if (data('lightboxMode', content)) {
    return data('lightboxMode', content);
  }
  if (data('iframe', content)) {
    return 'iframe';
  } else {
    return undefined;
  }
};
var getLayout = function getLayout(el) {
  var match = el.attributes.class.value.match(/r\dc\d/);
  return match ? match[0] : 'r1c1';
};
var parseCell = function parseCell(el, index, config, slug) {
  var label = void 0;
  var link = el.querySelector('a.uber-grid-cell-link');
  var titleWrapper = el.querySelector('div.uber-grid-cell-title-wrapper');
  var cell = {
    id: el.id,
    className: el.attributes.class.value,
    layout: getLayout(el),
    tags: (0, _filters.cellTags)(data('tags', el)),
    slug: data('slug', el),
    image: __guard__(el.querySelector('div.uber-grid-cell-content img.uber-grid-cell-image'), function (x1) {
      return x1.attributes.src ? x1.attributes.src.value : null;
    }),
    alt: __guard__(el.querySelector('div.uber-grid-cell-content img.uber-grid-cell-image'), function (x1) {
      return x1.attributes.alt ? x1.attributes.alt.value : null;
    }),
    title: {
      position: __guard__(__guard__(__guard__(titleWrapper, function (x4) {
        return x4.attributes.class;
      }), function (x3) {
        return x3.value;
      }), function (x2) {
        return x2.match(/uber-grid-title-position-(bottom-left|bottom-right|bottom-center|top-left|top-center|top-right|left-center|right-center|center)/)[1];
      }),
      html: __guard__(__guard__(titleWrapper, function (x6) {
        return x6.querySelector('div.uber-grid-cell-title');
      }), function (x5) {
        return x5.innerHTML;
      })
    },
    url: __guard__(link, function (x7) {
      return x7.attributes.href.value;
    }),
    target: __guard__(__guard__(link, function (x9) {
      return x9.attributes.target;
    }), function (x8) {
      return x8.value;
    })
  };
  if (label = el.querySelector('div.uber-grid-cell-label')) {
    cell.label = label.innerHTML;
  }
  if (el.querySelector('.uber-grid-lightbox')) {
    var html = void 0;
    var id = void 0;
    cell.lightbox = {
      download: __guard__(el.querySelector('div.uber-grid-cell-content'), function (x10) {
        return data('lightboxDownloadUrl', x10);
      }),
      thumbnail: __guard__(el.querySelector('div.uber-grid-cell-content'), function (x11) {
        return data('lightboxThumbnail', x11);
      }),
      description: html = __guard__(el.querySelector('div.uber-grid-lightbox-content-wrapper'), function (x12) {
        return x12.innerHTML;
      }),
      html: html,
      descriptionStyle: __guard__(el.querySelector('div.uber-grid-lightbox-content-wrapper'), function (x13) {
        return data('style', x13);
      }),
      type: getLightboxType(el),
      hash: slug + '/' + data('slug', el)
    };
    if (cell.lightbox.type === 'html') {
      cell.lightbox.descriptionStyle = 'none';
    }
    if (cell.lightbox.type === 'iframe' && (id = data('lightboxGridId', cellContent(el)))) {
      cell.url = config.ajaxurl + ('?action=uber_grid_render_grid_iframe&id=' + id);
    }
  }
  var inner = el.querySelector('.uber-grid-hover-inner');
  if (inner) {
    cell.hover = __guard__(inner, function (x14) {
      return x14.innerHTML;
    });
  }
  var hover = el.querySelector('.uber-grid-hover');
  if (hover) {
    cell.hoverClasses = hover.attributes['class'].value;
  }
  cell.index = index;
  return cell;
};

var collectItems = function collectItems(el, config, slug) {
  var cells = el.querySelectorAll('div.uber-grid-cell');
  if (cells.length === 0) {
    return [];
  }
  var result = [];
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = (0, _getIterator3.default)(__range__(0, cells.length - 1, true)), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var i = _step.value;

      result.push(parseCell(cells[i], i, config, slug));
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator.return) {
        _iterator.return();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  return result;
};

var getFilter = function getFilter(config, filters) {
  if (!!window.location.hash) {
    var filter = window.location.hash.replace(/^#/, '').toLowerCase();
    if ((0, _arrayPrototype2.default)(filters || [], function (current) {
      return current.slug.toLowerCase() === filter;
    })) {
      return filter;
    }
  }
  return config.filters.default;
};

function data(prop, el) {
  if (el.dataset) {
    return el.dataset[prop];
  }
  var attr = el.attributes['data-' + (0, _decamelize2.default)(prop, '-')];
  if (!attr) {
    return null;
  }
  return attr.value;
}

;

function __guard__(value, transform) {
  return typeof value !== 'undefined' && value !== null ? transform(value) : undefined;
}
function __range__(left, right, inclusive) {
  var range = [];
  var ascending = left < right;
  var end = !inclusive ? right : ascending ? right + 1 : right - 1;
  for (var i = left; ascending ? i < end : i > end; ascending ? i++ : i--) {
    range.push(i);
  }
  return range;
}
},{"babel-runtime/helpers/defineProperty":25,"babel-runtime/core-js/get-iterator":26,"array.prototype.find":9,"./filters":19,"decamelize":24}],77:[function(require,module,exports) {
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
        var sources = new Array(bLeft);
        for (i = 0; i < bLeft; i++) {
            sources[i] = -1;
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
                            sources[j - bStart] = i;
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
                        sources[j - bStart] = i;
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
                    if (sources[i] === -1) {
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
                    if (sources[i] === -1) {
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
        if (arrI !== -1) {
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

var version = "5.0.3";

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
},{}],33:[function(require,module,exports) {
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
},{"./dist/index.esm.js":77}],32:[function(require,module,exports) {
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
            newVNode = (0, _inferno.createTextVNode)(vNodeToClone.children);
        }
    return (0, _inferno.normalizeProps)(newVNode);
}

exports.cloneVNode = cloneVNode;
},{"inferno":33}],31:[function(require,module,exports) {
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
},{"inferno":33}],34:[function(require,module,exports) {
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
},{"inferno":33}],6:[function(require,module,exports) {
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
},{"inferno":33,"inferno-clone-vnode":32,"inferno-create-class":31,"inferno-create-element":34}],7:[function(require,module,exports) {
var global = (1,eval)("this");

'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault2(_reactDom);

var _react = require('react');

var _react2 = _interopRequireDefault2(_react);

function _interopRequireDefault2(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function unwrapExports(x) {
  return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
}

function createCommonjsModule(fn, module) {
  return module = { exports: {} }, fn(module, module.exports), module.exports;
}

var _global = createCommonjsModule(function (module) {
  // https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
  var global = module.exports = typeof window != 'undefined' && window.Math == Math ? window : typeof self != 'undefined' && self.Math == Math ? self : Function('return this')();
  if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef
});

var _core = createCommonjsModule(function (module) {
  var core = module.exports = { version: '2.4.0' };
  if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef
});
var _core_1 = _core.version;

var _aFunction = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};

// optional / simple context binding

var _ctx = function (fn, that, length) {
  _aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1:
      return function (a) {
        return fn.call(that, a);
      };
    case 2:
      return function (a, b) {
        return fn.call(that, a, b);
      };
    case 3:
      return function (a, b, c) {
        return fn.call(that, a, b, c);
      };
  }
  return function () /* ...args */{
    return fn.apply(that, arguments);
  };
};

var _isObject = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};

var _anObject = function (it) {
  if (!_isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};

var _fails = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};

// Thank's IE8 for his funny defineProperty
var _descriptors = !_fails(function () {
  return Object.defineProperty({}, 'a', { get: function () {
      return 7;
    } }).a != 7;
});

var document$1 = _global.document
// in old IE typeof document.createElement is 'object'
,
    is = _isObject(document$1) && _isObject(document$1.createElement);
var _domCreate = function (it) {
  return is ? document$1.createElement(it) : {};
};

var _ie8DomDefine = !_descriptors && !_fails(function () {
  return Object.defineProperty(_domCreate('div'), 'a', { get: function () {
      return 7;
    } }).a != 7;
});

// 7.1.1 ToPrimitive(input [, PreferredType])

// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
var _toPrimitive = function (it, S) {
  if (!_isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !_isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !_isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !_isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};

var dP = Object.defineProperty;

var f = _descriptors ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  _anObject(O);
  P = _toPrimitive(P, true);
  _anObject(Attributes);
  if (_ie8DomDefine) try {
    return dP(O, P, Attributes);
  } catch (e) {/* empty */}
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};

var _objectDp = {
  f: f
};

var _propertyDesc = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};

var _hide = _descriptors ? function (object, key, value) {
  return _objectDp.f(object, key, _propertyDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};

var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F,
      IS_GLOBAL = type & $export.G,
      IS_STATIC = type & $export.S,
      IS_PROTO = type & $export.P,
      IS_BIND = type & $export.B,
      IS_WRAP = type & $export.W,
      exports = IS_GLOBAL ? _core : _core[name] || (_core[name] = {}),
      expProto = exports[PROTOTYPE],
      target = IS_GLOBAL ? _global : IS_STATIC ? _global[name] : (_global[name] || {})[PROTOTYPE],
      key,
      own,
      out;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    if (own && key in exports) continue;
    // export native or passed
    out = own ? target[key] : source[key];
    // prevent global pollution for namespaces
    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
    // bind timers to global for call from export context
    : IS_BIND && own ? _ctx(out, _global)
    // wrap global constructors for prevent change them in library
    : IS_WRAP && target[key] == out ? function (C) {
      var F = function (a, b, c) {
        if (this instanceof C) {
          switch (arguments.length) {
            case 0:
              return new C();
            case 1:
              return new C(a);
            case 2:
              return new C(a, b);
          }return new C(a, b, c);
        }return C.apply(this, arguments);
      };
      F[PROTOTYPE] = C[PROTOTYPE];
      return F;
      // make static versions for prototype methods
    }(out) : IS_PROTO && typeof out == 'function' ? _ctx(Function.call, out) : out;
    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
    if (IS_PROTO) {
      (exports.virtual || (exports.virtual = {}))[key] = out;
      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
      if (type & $export.R && expProto && !expProto[key]) _hide(expProto, key, out);
    }
  }
};
// type bitmap
$export.F = 1; // forced
$export.G = 2; // global
$export.S = 4; // static
$export.P = 8; // proto
$export.B = 16; // bind
$export.W = 32; // wrap
$export.U = 64; // safe
$export.R = 128; // real proto method for `library` 
var _export = $export;

var hasOwnProperty = {}.hasOwnProperty;
var _has = function (it, key) {
  return hasOwnProperty.call(it, key);
};

var toString = {}.toString;

var _cof = function (it) {
  return toString.call(it).slice(8, -1);
};

// fallback for non-array-like ES3 and non-enumerable old V8 strings

var _iobject = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return _cof(it) == 'String' ? it.split('') : Object(it);
};

// 7.2.1 RequireObjectCoercible(argument)
var _defined = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};

// to indexed object, toObject with fallback for non-array-like ES3 strings

var _toIobject = function (it) {
  return _iobject(_defined(it));
};

// 7.1.4 ToInteger
var ceil = Math.ceil,
    floor = Math.floor;
var _toInteger = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};

// 7.1.15 ToLength
var min = Math.min;
var _toLength = function (it) {
  return it > 0 ? min(_toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};

var max = Math.max,
    min$1 = Math.min;
var _toIndex = function (index, length) {
  index = _toInteger(index);
  return index < 0 ? max(index + length, 0) : min$1(index, length);
};

// false -> Array#indexOf
// true  -> Array#includes

var _arrayIncludes = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = _toIobject($this),
        length = _toLength(O.length),
        index = _toIndex(fromIndex, length),
        value;
    // Array#includes uses SameValueZero equality algorithm
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      if (value != value) return true;
      // Array#toIndex ignores holes, Array#includes - not
    } else for (; length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    }return !IS_INCLUDES && -1;
  };
};

var SHARED = '__core-js_shared__',
    store = _global[SHARED] || (_global[SHARED] = {});
var _shared = function (key) {
  return store[key] || (store[key] = {});
};

var id = 0,
    px = Math.random();
var _uid = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};

var shared = _shared('keys');
var _sharedKey = function (key) {
  return shared[key] || (shared[key] = _uid(key));
};

var arrayIndexOf = _arrayIncludes(false),
    IE_PROTO = _sharedKey('IE_PROTO');

var _objectKeysInternal = function (object, names) {
  var O = _toIobject(object),
      i = 0,
      result = [],
      key;
  for (key in O) if (key != IE_PROTO) _has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (_has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};

// IE 8- don't enum bug keys
var _enumBugKeys = 'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'.split(',');

// 19.1.2.14 / 15.2.3.14 Object.keys(O)


var _objectKeys = Object.keys || function keys(O) {
  return _objectKeysInternal(O, _enumBugKeys);
};

var f$1 = Object.getOwnPropertySymbols;

var _objectGops = {
  f: f$1
};

var f$2 = {}.propertyIsEnumerable;

var _objectPie = {
  f: f$2
};

// 7.1.13 ToObject(argument)

var _toObject = function (it) {
  return Object(_defined(it));
};

// 19.1.2.1 Object.assign(target, source, ...)
var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
var _objectAssign = !$assign || _fails(function () {
  var A = {},
      B = {},
      S = Symbol(),
      K = 'abcdefghijklmnopqrst';
  A[S] = 7;
  K.split('').forEach(function (k) {
    B[k] = k;
  });
  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
}) ? function assign(target, source) {
  // eslint-disable-line no-unused-vars
  var T = _toObject(target),
      aLen = arguments.length,
      index = 1,
      getSymbols = _objectGops.f,
      isEnum = _objectPie.f;
  while (aLen > index) {
    var S = _iobject(arguments[index++]),
        keys = getSymbols ? _objectKeys(S).concat(getSymbols(S)) : _objectKeys(S),
        length = keys.length,
        j = 0,
        key;
    while (length > j) if (isEnum.call(S, key = keys[j++])) T[key] = S[key];
  }return T;
} : $assign;

// 19.1.3.1 Object.assign(target, source)


_export(_export.S + _export.F, 'Object', { assign: _objectAssign });

var assign = _core.Object.assign;

var assign$1 = createCommonjsModule(function (module) {
  module.exports = { "default": assign, __esModule: true };
});

unwrapExports(assign$1);

var _extends = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _assign2 = _interopRequireDefault(assign$1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  exports.default = _assign2.default || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };
});

var _extends$1 = unwrapExports(_extends);

var classCallCheck = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  exports.default = function (instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  };
});

var _classCallCheck = unwrapExports(classCallCheck);

// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
_export(_export.S + _export.F * !_descriptors, 'Object', { defineProperty: _objectDp.f });

var $Object = _core.Object;
var defineProperty = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};

var defineProperty$1 = createCommonjsModule(function (module) {
  module.exports = { "default": defineProperty, __esModule: true };
});

unwrapExports(defineProperty$1);

var createClass = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _defineProperty2 = _interopRequireDefault(defineProperty$1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

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
});

var _createClass = unwrapExports(createClass);

// true  -> String#at
// false -> String#codePointAt
var _stringAt = function (TO_STRING) {
  return function (that, pos) {
    var s = String(_defined(that)),
        i = _toInteger(pos),
        l = s.length,
        a,
        b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff ? TO_STRING ? s.charAt(i) : a : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};

var _library = true;

var _redefine = _hide;

var _iterators = {};

var _objectDps = _descriptors ? Object.defineProperties : function defineProperties(O, Properties) {
  _anObject(O);
  var keys = _objectKeys(Properties),
      length = keys.length,
      i = 0,
      P;
  while (length > i) _objectDp.f(O, P = keys[i++], Properties[P]);
  return O;
};

var _html = _global.document && document.documentElement;

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
var IE_PROTO$1 = _sharedKey('IE_PROTO'),
    Empty = function () {/* empty */},
    PROTOTYPE$1 = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = _domCreate('iframe'),
      i = _enumBugKeys.length,
      lt = '<',
      gt = '>',
      iframeDocument;
  iframe.style.display = 'none';
  _html.appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE$1][_enumBugKeys[i]];
  return createDict();
};

var _objectCreate = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE$1] = _anObject(O);
    result = new Empty();
    Empty[PROTOTYPE$1] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO$1] = O;
  } else result = createDict();
  return Properties === undefined ? result : _objectDps(result, Properties);
};

var _wks = createCommonjsModule(function (module) {
  var store = _shared('wks'),
      Symbol = _global.Symbol,
      USE_SYMBOL = typeof Symbol == 'function';

  var $exports = module.exports = function (name) {
    return store[name] || (store[name] = USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : _uid)('Symbol.' + name));
  };

  $exports.store = store;
});

var def = _objectDp.f,
    TAG = _wks('toStringTag');

var _setToStringTag = function (it, tag, stat) {
  if (it && !_has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};

var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
_hide(IteratorPrototype, _wks('iterator'), function () {
  return this;
});

var _iterCreate = function (Constructor, NAME, next) {
  Constructor.prototype = _objectCreate(IteratorPrototype, { next: _propertyDesc(1, next) });
  _setToStringTag(Constructor, NAME + ' Iterator');
};

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
var IE_PROTO$2 = _sharedKey('IE_PROTO'),
    ObjectProto = Object.prototype;

var _objectGpo = Object.getPrototypeOf || function (O) {
  O = _toObject(O);
  if (_has(O, IE_PROTO$2)) return O[IE_PROTO$2];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  }return O instanceof Object ? ObjectProto : null;
};

var ITERATOR = _wks('iterator'),
    BUGGY = !([].keys && 'next' in [].keys()) // Safari has buggy iterators w/o `next`
,
    FF_ITERATOR = '@@iterator',
    KEYS = 'keys',
    VALUES = 'values';

var returnThis = function () {
  return this;
};

var _iterDefine = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  _iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS:
        return function keys() {
          return new Constructor(this, kind);
        };
      case VALUES:
        return function values() {
          return new Constructor(this, kind);
        };
    }return function entries() {
      return new Constructor(this, kind);
    };
  };
  var TAG = NAME + ' Iterator',
      DEF_VALUES = DEFAULT == VALUES,
      VALUES_BUG = false,
      proto = Base.prototype,
      $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT],
      $default = $native || getMethod(DEFAULT),
      $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined,
      $anyNative = NAME == 'Array' ? proto.entries || $native : $native,
      methods,
      key,
      IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = _objectGpo($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype) {
      // Set @@toStringTag to native iterators
      _setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!_library && !_has(IteratorPrototype, ITERATOR)) _hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() {
      return $native.call(this);
    };
  }
  // Define iterator
  if ((!_library || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    _hide(proto, ITERATOR, $default);
  }
  // Plug for library
  _iterators[NAME] = $default;
  _iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) _redefine(proto, key, methods[key]);
    } else _export(_export.P + _export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};

var $at = _stringAt(true);

// 21.1.3.27 String.prototype[@@iterator]()
_iterDefine(String, 'String', function (iterated) {
  this._t = String(iterated); // target
  this._i = 0; // next index
  // 21.1.5.2.1 %StringIteratorPrototype%.next()
}, function () {
  var O = this._t,
      index = this._i,
      point;
  if (index >= O.length) return { value: undefined, done: true };
  point = $at(O, index);
  this._i += point.length;
  return { value: point, done: false };
});

var _iterStep = function (done, value) {
  return { value: value, done: !!done };
};

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
var es6_array_iterator = _iterDefine(Array, 'Array', function (iterated, kind) {
  this._t = _toIobject(iterated); // target
  this._i = 0; // next index
  this._k = kind; // kind
  // 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t,
      kind = this._k,
      index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return _iterStep(1);
  }
  if (kind == 'keys') return _iterStep(0, index);
  if (kind == 'values') return _iterStep(0, O[index]);
  return _iterStep(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
_iterators.Arguments = _iterators.Array;

var TO_STRING_TAG = _wks('toStringTag');

for (var collections = ['NodeList', 'DOMTokenList', 'MediaList', 'StyleSheetList', 'CSSRuleList'], i = 0; i < 5; i++) {
  var NAME = collections[i],
      Collection = _global[NAME],
      proto = Collection && Collection.prototype;
  if (proto && !proto[TO_STRING_TAG]) _hide(proto, TO_STRING_TAG, NAME);
  _iterators[NAME] = _iterators.Array;
}

// getting tag from 19.1.3.6 Object.prototype.toString()
var TAG$1 = _wks('toStringTag')
// ES3 wrong here
,
    ARG = _cof(function () {
  return arguments;
}()) == 'Arguments';

// fallback for IE11 Script Access Denied error
var tryGet = function (it, key) {
  try {
    return it[key];
  } catch (e) {/* empty */}
};

var _classof = function (it) {
  var O, T, B;
  return it === undefined ? 'Undefined' : it === null ? 'Null'
  // @@toStringTag case
  : typeof (T = tryGet(O = Object(it), TAG$1)) == 'string' ? T
  // builtinTag case
  : ARG ? _cof(O)
  // ES3 arguments fallback
  : (B = _cof(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : B;
};

var _anInstance = function (it, Constructor, name, forbiddenField) {
  if (!(it instanceof Constructor) || forbiddenField !== undefined && forbiddenField in it) {
    throw TypeError(name + ': incorrect invocation!');
  }return it;
};

// call something on iterator step with safe closing on error

var _iterCall = function (iterator, fn, value, entries) {
  try {
    return entries ? fn(_anObject(value)[0], value[1]) : fn(value);
    // 7.4.6 IteratorClose(iterator, completion)
  } catch (e) {
    var ret = iterator['return'];
    if (ret !== undefined) _anObject(ret.call(iterator));
    throw e;
  }
};

// check on default Array iterator
var ITERATOR$1 = _wks('iterator'),
    ArrayProto = Array.prototype;

var _isArrayIter = function (it) {
  return it !== undefined && (_iterators.Array === it || ArrayProto[ITERATOR$1] === it);
};

var ITERATOR$2 = _wks('iterator');
var core_getIteratorMethod = _core.getIteratorMethod = function (it) {
  if (it != undefined) return it[ITERATOR$2] || it['@@iterator'] || _iterators[_classof(it)];
};

var _forOf = createCommonjsModule(function (module) {
  var BREAK = {},
      RETURN = {};
  var exports = module.exports = function (iterable, entries, fn, that, ITERATOR) {
    var iterFn = ITERATOR ? function () {
      return iterable;
    } : core_getIteratorMethod(iterable),
        f = _ctx(fn, that, entries ? 2 : 1),
        index = 0,
        length,
        step,
        iterator,
        result;
    if (typeof iterFn != 'function') throw TypeError(iterable + ' is not iterable!');
    // fast case for arrays with default iterator
    if (_isArrayIter(iterFn)) for (length = _toLength(iterable.length); length > index; index++) {
      result = entries ? f(_anObject(step = iterable[index])[0], step[1]) : f(iterable[index]);
      if (result === BREAK || result === RETURN) return result;
    } else for (iterator = iterFn.call(iterable); !(step = iterator.next()).done;) {
      result = _iterCall(iterator, f, step.value, entries);
      if (result === BREAK || result === RETURN) return result;
    }
  };
  exports.BREAK = BREAK;
  exports.RETURN = RETURN;
});

// 7.3.20 SpeciesConstructor(O, defaultConstructor)
var SPECIES = _wks('species');
var _speciesConstructor = function (O, D) {
  var C = _anObject(O).constructor,
      S;
  return C === undefined || (S = _anObject(C)[SPECIES]) == undefined ? D : _aFunction(S);
};

// fast apply, http://jsperf.lnkit.com/fast-apply/5
var _invoke = function (fn, args, that) {
  var un = that === undefined;
  switch (args.length) {
    case 0:
      return un ? fn() : fn.call(that);
    case 1:
      return un ? fn(args[0]) : fn.call(that, args[0]);
    case 2:
      return un ? fn(args[0], args[1]) : fn.call(that, args[0], args[1]);
    case 3:
      return un ? fn(args[0], args[1], args[2]) : fn.call(that, args[0], args[1], args[2]);
    case 4:
      return un ? fn(args[0], args[1], args[2], args[3]) : fn.call(that, args[0], args[1], args[2], args[3]);
  }return fn.apply(that, args);
};

var process = _global.process,
    setTask = _global.setImmediate,
    clearTask = _global.clearImmediate,
    MessageChannel = _global.MessageChannel,
    counter = 0,
    queue = {},
    ONREADYSTATECHANGE = 'onreadystatechange',
    defer,
    channel,
    port;
var run = function () {
  var id = +this;
  if (queue.hasOwnProperty(id)) {
    var fn = queue[id];
    delete queue[id];
    fn();
  }
};
var listener = function (event) {
  run.call(event.data);
};
// Node.js 0.9+ & IE10+ has setImmediate, otherwise:
if (!setTask || !clearTask) {
  setTask = function setImmediate(fn) {
    var args = [],
        i = 1;
    while (arguments.length > i) args.push(arguments[i++]);
    queue[++counter] = function () {
      _invoke(typeof fn == 'function' ? fn : Function(fn), args);
    };
    defer(counter);
    return counter;
  };
  clearTask = function clearImmediate(id) {
    delete queue[id];
  };
  // Node.js 0.8-
  if (_cof(process) == 'process') {
    defer = function (id) {
      process.nextTick(_ctx(run, id, 1));
    };
    // Browsers with MessageChannel, includes WebWorkers
  } else if (MessageChannel) {
    channel = new MessageChannel();
    port = channel.port2;
    channel.port1.onmessage = listener;
    defer = _ctx(port.postMessage, port, 1);
    // Browsers with postMessage, skip WebWorkers
    // IE8 has postMessage, but it's sync & typeof its postMessage is 'object'
  } else if (_global.addEventListener && typeof postMessage == 'function' && !_global.importScripts) {
    defer = function (id) {
      _global.postMessage(id + '', '*');
    };
    _global.addEventListener('message', listener, false);
    // IE8-
  } else if (ONREADYSTATECHANGE in _domCreate('script')) {
    defer = function (id) {
      _html.appendChild(_domCreate('script'))[ONREADYSTATECHANGE] = function () {
        _html.removeChild(this);
        run.call(id);
      };
    };
    // Rest old browsers
  } else {
    defer = function (id) {
      setTimeout(_ctx(run, id, 1), 0);
    };
  }
}
var _task = {
  set: setTask,
  clear: clearTask
};

var macrotask = _task.set,
    Observer = _global.MutationObserver || _global.WebKitMutationObserver,
    process$1 = _global.process,
    Promise = _global.Promise,
    isNode = _cof(process$1) == 'process';

var _microtask = function () {
  var head, last, notify;

  var flush = function () {
    var parent, fn;
    if (isNode && (parent = process$1.domain)) parent.exit();
    while (head) {
      fn = head.fn;
      head = head.next;
      try {
        fn();
      } catch (e) {
        if (head) notify();else last = undefined;
        throw e;
      }
    }last = undefined;
    if (parent) parent.enter();
  };

  // Node.js
  if (isNode) {
    notify = function () {
      process$1.nextTick(flush);
    };
    // browsers with MutationObserver
  } else if (Observer) {
    var toggle = true,
        node = document.createTextNode('');
    new Observer(flush).observe(node, { characterData: true }); // eslint-disable-line no-new
    notify = function () {
      node.data = toggle = !toggle;
    };
    // environments with maybe non-completely correct, but existent Promise
  } else if (Promise && Promise.resolve) {
    var promise = Promise.resolve();
    notify = function () {
      promise.then(flush);
    };
    // for other environments - macrotask based on:
    // - setImmediate
    // - MessageChannel
    // - window.postMessag
    // - onreadystatechange
    // - setTimeout
  } else {
    notify = function () {
      // strange IE + webpack dev server bug - use .call(global)
      macrotask.call(_global, flush);
    };
  }

  return function (fn) {
    var task = { fn: fn, next: undefined };
    if (last) last.next = task;
    if (!head) {
      head = task;
      notify();
    }last = task;
  };
};

var _redefineAll = function (target, src, safe) {
  for (var key in src) {
    if (safe && target[key]) target[key] = src[key];else _hide(target, key, src[key]);
  }return target;
};

var SPECIES$1 = _wks('species');

var _setSpecies = function (KEY) {
  var C = typeof _core[KEY] == 'function' ? _core[KEY] : _global[KEY];
  if (_descriptors && C && !C[SPECIES$1]) _objectDp.f(C, SPECIES$1, {
    configurable: true,
    get: function () {
      return this;
    }
  });
};

var ITERATOR$3 = _wks('iterator'),
    SAFE_CLOSING = false;

try {
  var riter = [7][ITERATOR$3]();
  riter['return'] = function () {
    SAFE_CLOSING = true;
  };
} catch (e) {/* empty */}

var _iterDetect = function (exec, skipClosing) {
  if (!skipClosing && !SAFE_CLOSING) return false;
  var safe = false;
  try {
    var arr = [7],
        iter = arr[ITERATOR$3]();
    iter.next = function () {
      return { done: safe = true };
    };
    arr[ITERATOR$3] = function () {
      return iter;
    };
    exec(arr);
  } catch (e) {/* empty */}
  return safe;
};

var task = _task.set,
    microtask = _microtask(),
    PROMISE = 'Promise',
    TypeError$1 = _global.TypeError,
    process$2 = _global.process,
    $Promise = _global[PROMISE],
    process$2 = _global.process,
    isNode$1 = _classof(process$2) == 'process',
    empty = function () {/* empty */},
    Internal,
    GenericPromiseCapability,
    Wrapper;

var USE_NATIVE = !!function () {
  try {
    // correct subclassing with @@species support
    var promise = $Promise.resolve(1),
        FakePromise = (promise.constructor = {})[_wks('species')] = function (exec) {
      exec(empty, empty);
    };
    // unhandled rejections tracking support, NodeJS Promise without it fails @@species test
    return (isNode$1 || typeof PromiseRejectionEvent == 'function') && promise.then(empty) instanceof FakePromise;
  } catch (e) {/* empty */}
}();

// helpers
var sameConstructor = function (a, b) {
  // with library wrapper special case
  return a === b || a === $Promise && b === Wrapper;
};
var isThenable = function (it) {
  var then;
  return _isObject(it) && typeof (then = it.then) == 'function' ? then : false;
};
var newPromiseCapability = function (C) {
  return sameConstructor($Promise, C) ? new PromiseCapability(C) : new GenericPromiseCapability(C);
};
var PromiseCapability = GenericPromiseCapability = function (C) {
  var resolve, reject;
  this.promise = new C(function ($$resolve, $$reject) {
    if (resolve !== undefined || reject !== undefined) throw TypeError$1('Bad Promise constructor');
    resolve = $$resolve;
    reject = $$reject;
  });
  this.resolve = _aFunction(resolve);
  this.reject = _aFunction(reject);
};
var perform = function (exec) {
  try {
    exec();
  } catch (e) {
    return { error: e };
  }
};
var notify = function (promise, isReject) {
  if (promise._n) return;
  promise._n = true;
  var chain = promise._c;
  microtask(function () {
    var value = promise._v,
        ok = promise._s == 1,
        i = 0;
    var run = function (reaction) {
      var handler = ok ? reaction.ok : reaction.fail,
          resolve = reaction.resolve,
          reject = reaction.reject,
          domain = reaction.domain,
          result,
          then;
      try {
        if (handler) {
          if (!ok) {
            if (promise._h == 2) onHandleUnhandled(promise);
            promise._h = 1;
          }
          if (handler === true) result = value;else {
            if (domain) domain.enter();
            result = handler(value);
            if (domain) domain.exit();
          }
          if (result === reaction.promise) {
            reject(TypeError$1('Promise-chain cycle'));
          } else if (then = isThenable(result)) {
            then.call(result, resolve, reject);
          } else resolve(result);
        } else reject(value);
      } catch (e) {
        reject(e);
      }
    };
    while (chain.length > i) run(chain[i++]); // variable length - can't use forEach
    promise._c = [];
    promise._n = false;
    if (isReject && !promise._h) onUnhandled(promise);
  });
};
var onUnhandled = function (promise) {
  task.call(_global, function () {
    var value = promise._v,
        abrupt,
        handler,
        console;
    if (isUnhandled(promise)) {
      abrupt = perform(function () {
        if (isNode$1) {
          process$2.emit('unhandledRejection', value, promise);
        } else if (handler = _global.onunhandledrejection) {
          handler({ promise: promise, reason: value });
        } else if ((console = _global.console) && console.error) {
          console.error('Unhandled promise rejection', value);
        }
      });
      // Browsers should not trigger `rejectionHandled` event if it was handled here, NodeJS - should
      promise._h = isNode$1 || isUnhandled(promise) ? 2 : 1;
    }promise._a = undefined;
    if (abrupt) throw abrupt.error;
  });
};
var isUnhandled = function (promise) {
  if (promise._h == 1) return false;
  var chain = promise._a || promise._c,
      i = 0,
      reaction;
  while (chain.length > i) {
    reaction = chain[i++];
    if (reaction.fail || !isUnhandled(reaction.promise)) return false;
  }return true;
};
var onHandleUnhandled = function (promise) {
  task.call(_global, function () {
    var handler;
    if (isNode$1) {
      process$2.emit('rejectionHandled', promise);
    } else if (handler = _global.onrejectionhandled) {
      handler({ promise: promise, reason: promise._v });
    }
  });
};
var $reject = function (value) {
  var promise = this;
  if (promise._d) return;
  promise._d = true;
  promise = promise._w || promise; // unwrap
  promise._v = value;
  promise._s = 2;
  if (!promise._a) promise._a = promise._c.slice();
  notify(promise, true);
};
var $resolve = function (value) {
  var promise = this,
      then;
  if (promise._d) return;
  promise._d = true;
  promise = promise._w || promise; // unwrap
  try {
    if (promise === value) throw TypeError$1("Promise can't be resolved itself");
    if (then = isThenable(value)) {
      microtask(function () {
        var wrapper = { _w: promise, _d: false }; // wrap
        try {
          then.call(value, _ctx($resolve, wrapper, 1), _ctx($reject, wrapper, 1));
        } catch (e) {
          $reject.call(wrapper, e);
        }
      });
    } else {
      promise._v = value;
      promise._s = 1;
      notify(promise, false);
    }
  } catch (e) {
    $reject.call({ _w: promise, _d: false }, e); // wrap
  }
};

// constructor polyfill
if (!USE_NATIVE) {
  // 25.4.3.1 Promise(executor)
  $Promise = function Promise(executor) {
    _anInstance(this, $Promise, PROMISE, '_h');
    _aFunction(executor);
    Internal.call(this);
    try {
      executor(_ctx($resolve, this, 1), _ctx($reject, this, 1));
    } catch (err) {
      $reject.call(this, err);
    }
  };
  Internal = function Promise(executor) {
    this._c = []; // <- awaiting reactions
    this._a = undefined; // <- checked in isUnhandled reactions
    this._s = 0; // <- state
    this._d = false; // <- done
    this._v = undefined; // <- value
    this._h = 0; // <- rejection state, 0 - default, 1 - handled, 2 - unhandled
    this._n = false; // <- notify
  };
  Internal.prototype = _redefineAll($Promise.prototype, {
    // 25.4.5.3 Promise.prototype.then(onFulfilled, onRejected)
    then: function then(onFulfilled, onRejected) {
      var reaction = newPromiseCapability(_speciesConstructor(this, $Promise));
      reaction.ok = typeof onFulfilled == 'function' ? onFulfilled : true;
      reaction.fail = typeof onRejected == 'function' && onRejected;
      reaction.domain = isNode$1 ? process$2.domain : undefined;
      this._c.push(reaction);
      if (this._a) this._a.push(reaction);
      if (this._s) notify(this, false);
      return reaction.promise;
    },
    // 25.4.5.1 Promise.prototype.catch(onRejected)
    'catch': function (onRejected) {
      return this.then(undefined, onRejected);
    }
  });
  PromiseCapability = function () {
    var promise = new Internal();
    this.promise = promise;
    this.resolve = _ctx($resolve, promise, 1);
    this.reject = _ctx($reject, promise, 1);
  };
}

_export(_export.G + _export.W + _export.F * !USE_NATIVE, { Promise: $Promise });
_setToStringTag($Promise, PROMISE);
_setSpecies(PROMISE);
Wrapper = _core[PROMISE];

// statics
_export(_export.S + _export.F * !USE_NATIVE, PROMISE, {
  // 25.4.4.5 Promise.reject(r)
  reject: function reject(r) {
    var capability = newPromiseCapability(this),
        $$reject = capability.reject;
    $$reject(r);
    return capability.promise;
  }
});
_export(_export.S + _export.F * (_library || !USE_NATIVE), PROMISE, {
  // 25.4.4.6 Promise.resolve(x)
  resolve: function resolve(x) {
    // instanceof instead of internal slot check because we should fix it without replacement native Promise core
    if (x instanceof $Promise && sameConstructor(x.constructor, this)) return x;
    var capability = newPromiseCapability(this),
        $$resolve = capability.resolve;
    $$resolve(x);
    return capability.promise;
  }
});
_export(_export.S + _export.F * !(USE_NATIVE && _iterDetect(function (iter) {
  $Promise.all(iter)['catch'](empty);
})), PROMISE, {
  // 25.4.4.1 Promise.all(iterable)
  all: function all(iterable) {
    var C = this,
        capability = newPromiseCapability(C),
        resolve = capability.resolve,
        reject = capability.reject;
    var abrupt = perform(function () {
      var values = [],
          index = 0,
          remaining = 1;
      _forOf(iterable, false, function (promise) {
        var $index = index++,
            alreadyCalled = false;
        values.push(undefined);
        remaining++;
        C.resolve(promise).then(function (value) {
          if (alreadyCalled) return;
          alreadyCalled = true;
          values[$index] = value;
          --remaining || resolve(values);
        }, reject);
      });
      --remaining || resolve(values);
    });
    if (abrupt) reject(abrupt.error);
    return capability.promise;
  },
  // 25.4.4.4 Promise.race(iterable)
  race: function race(iterable) {
    var C = this,
        capability = newPromiseCapability(C),
        reject = capability.reject;
    var abrupt = perform(function () {
      _forOf(iterable, false, function (promise) {
        C.resolve(promise).then(capability.resolve, reject);
      });
    });
    if (abrupt) reject(abrupt.error);
    return capability.promise;
  }
});

var promise = _core.Promise;

var promise$1 = createCommonjsModule(function (module) {
  module.exports = { "default": promise, __esModule: true };
});

var _Promise = unwrapExports(promise$1);

function direct(objects, action) {
  return objects.filter(function (obj) {
    return !!obj[action] && typeof obj[action] === 'function';
  }).map(function (obj) {
    return obj[action];
  });
}

function nested(objects, action) {
  var index = action.indexOf('.');
  if (index === -1) {
    return [];
  }
  var current = action.substr(0, index);
  var next = objects.filter(function (object) {
    return object[current] && typeof object[current] !== 'function';
  }).map(function (object) {
    return object[current];
  });
  return callbacks(next, action.substr(index + 1));
}

function callbacks(objects, action) {
  return direct(objects, action).concat(nested(objects, action));
}

function maybeCall() {
  if (arguments[0]) {
    arguments[0].apply(null, Array.prototype.slice.call(arguments, 1));
  }
}

var Store = function () {
  function Store(state, reducers, options) {
    _classCallCheck(this, Store);

    this.state = state;
    this.reducers = reducers || [];
    this.options = _extends$1({ inPlace: true }, options);
    this.dispatch = this.dispatch.bind(this);
  }

  _createClass(Store, [{
    key: 'dispatch',
    value: function dispatch(action, params, options) {
      var _this = this;

      maybeCall(this.onDispatch, action, params);
      if (typeof action === 'function') {
        return _Promise.resolve(action(this.dispatch, this.state, params, options));
      } else {
        this.state = callbacks(this.reducers, action).reduce(function (state, callback) {
          var result = callback.call(_this, state, params);
          if (_this.options.inPlace) {
            return state;
          } else {
            return result;
          }
        }, this.state);
        maybeCall(this.onChange, this.state);
        return _Promise.resolve(this.state);
      }
    }
  }]);

  return Store;
}();

var App = function () {
  function App(state, reducers, element, component) {
    _classCallCheck(this, App);

    this.store = new Store(state, reducers);
    this.component = component;
    this.element = element;
    this.store.onChange = this._onChange.bind(this);
    this._onChange(this.store.state);
  }

  _createClass(App, [{
    key: '_onChange',
    value: function _onChange(state) {
      var _this = this;

      var props = _extends$1({
        dispatch: function dispatch(action, param) {
          return _this.store.dispatch(action, param);
        }
      }, state);
      _reactDom2.default.render(_react2.default.createElement(this.component, props), this.element);
    }
  }]);

  return App;
}();

exports.default = App;
},{"react-dom":6,"react":6}],204:[function(require,module,exports) {
exports.f = Object.getOwnPropertySymbols;

},{}],203:[function(require,module,exports) {
exports.f = {}.propertyIsEnumerable;

},{}],256:[function(require,module,exports) {
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

},{"./_object-keys":178,"./_object-gops":204,"./_object-pie":203,"./_to-object":127,"./_iobject":226,"./_fails":172}],239:[function(require,module,exports) {
// 19.1.3.1 Object.assign(target, source)
var $export = require('./_export');

$export($export.S + $export.F, 'Object', { assign: require('./_object-assign') });

},{"./_export":167,"./_object-assign":256}],158:[function(require,module,exports) {
require('../../modules/es6.object.assign');
module.exports = require('../../modules/_core').Object.assign;

},{"../../modules/es6.object.assign":239,"../../modules/_core":67}],106:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/assign"), __esModule: true };
},{"core-js/library/fn/object/assign":158}],27:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

var _assign = require("../core-js/object/assign");

var _assign2 = _interopRequireDefault(_assign);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = _assign2.default || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};
},{"../core-js/object/assign":106}],129:[function(require,module,exports) {
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

},{"./_export":167,"./_core":67,"./_fails":172}],66:[function(require,module,exports) {
// 19.1.2.9 Object.getPrototypeOf(O)
var toObject = require('./_to-object');
var $getPrototypeOf = require('./_object-gpo');

require('./_object-sap')('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return $getPrototypeOf(toObject(it));
  };
});

},{"./_to-object":127,"./_object-gpo":128,"./_object-sap":129}],53:[function(require,module,exports) {
require('../../modules/es6.object.get-prototype-of');
module.exports = require('../../modules/_core').Object.getPrototypeOf;

},{"../../modules/es6.object.get-prototype-of":66,"../../modules/_core":67}],39:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/get-prototype-of"), __esModule: true };
},{"core-js/library/fn/object/get-prototype-of":53}],40:[function(require,module,exports) {
"use strict";

exports.__esModule = true;

exports.default = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};
},{}],42:[function(require,module,exports) {
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
},{"../core-js/object/define-property":48}],116:[function(require,module,exports) {
exports.f = require('./_wks');

},{"./_wks":138}],75:[function(require,module,exports) {
require('../../modules/es6.string.iterator');
require('../../modules/web.dom.iterable');
module.exports = require('../../modules/_wks-ext').f('iterator');

},{"../../modules/es6.string.iterator":64,"../../modules/web.dom.iterable":63,"../../modules/_wks-ext":116}],59:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/symbol/iterator"), __esModule: true };
},{"core-js/library/fn/symbol/iterator":75}],193:[function(require,module,exports) {
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

},{"./_uid":195,"./_is-object":191,"./_has":170,"./_object-dp":169,"./_fails":172}],157:[function(require,module,exports) {

var global = require('./_global');
var core = require('./_core');
var LIBRARY = require('./_library');
var wksExt = require('./_wks-ext');
var defineProperty = require('./_object-dp').f;
module.exports = function (name) {
  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty($Symbol, name, { value: wksExt.f(name) });
};

},{"./_global":135,"./_core":67,"./_library":187,"./_wks-ext":116,"./_object-dp":169}],196:[function(require,module,exports) {
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

},{"./_object-keys":178,"./_object-gops":204,"./_object-pie":203}],197:[function(require,module,exports) {
// 7.2.2 IsArray(argument)
var cof = require('./_cof');
module.exports = Array.isArray || function isArray(arg) {
  return cof(arg) == 'Array';
};

},{"./_cof":248}],202:[function(require,module,exports) {
// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
var $keys = require('./_object-keys-internal');
var hiddenKeys = require('./_enum-bug-keys').concat('length', 'prototype');

exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return $keys(O, hiddenKeys);
};

},{"./_object-keys-internal":247,"./_enum-bug-keys":213}],200:[function(require,module,exports) {
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

},{"./_to-iobject":181,"./_object-gopn":202}],201:[function(require,module,exports) {
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

},{"./_object-pie":203,"./_property-desc":199,"./_to-iobject":181,"./_to-primitive":198,"./_has":170,"./_ie8-dom-define":211,"./_descriptors":168}],112:[function(require,module,exports) {

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

},{"./_global":135,"./_has":170,"./_descriptors":168,"./_export":167,"./_redefine":188,"./_meta":193,"./_fails":172,"./_shared":194,"./_set-to-string-tag":190,"./_uid":195,"./_wks":138,"./_wks-ext":116,"./_wks-define":157,"./_enum-keys":196,"./_is-array":197,"./_an-object":110,"./_is-object":191,"./_to-iobject":181,"./_to-primitive":198,"./_property-desc":199,"./_object-create":176,"./_object-gopn-ext":200,"./_object-gopd":201,"./_object-dp":169,"./_object-keys":178,"./_object-gopn":202,"./_object-pie":203,"./_object-gops":204,"./_library":187,"./_hide":136}],113:[function(require,module,exports) {

},{}],114:[function(require,module,exports) {
require('./_wks-define')('asyncIterator');

},{"./_wks-define":157}],115:[function(require,module,exports) {
require('./_wks-define')('observable');

},{"./_wks-define":157}],74:[function(require,module,exports) {
require('../../modules/es6.symbol');
require('../../modules/es6.object.to-string');
require('../../modules/es7.symbol.async-iterator');
require('../../modules/es7.symbol.observable');
module.exports = require('../../modules/_core').Symbol;

},{"../../modules/es6.symbol":112,"../../modules/es6.object.to-string":113,"../../modules/es7.symbol.async-iterator":114,"../../modules/es7.symbol.observable":115,"../../modules/_core":67}],58:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/symbol"), __esModule: true };
},{"core-js/library/fn/symbol":74}],51:[function(require,module,exports) {
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
},{"../core-js/symbol/iterator":59,"../core-js/symbol":58}],41:[function(require,module,exports) {
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
},{"../helpers/typeof":51}],177:[function(require,module,exports) {
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

},{"./_is-object":191,"./_an-object":110,"./_ctx":224,"./_object-gopd":201}],132:[function(require,module,exports) {
// 19.1.3.19 Object.setPrototypeOf(O, proto)
var $export = require('./_export');
$export($export.S, 'Object', { setPrototypeOf: require('./_set-proto').set });

},{"./_export":167,"./_set-proto":177}],71:[function(require,module,exports) {
require('../../modules/es6.object.set-prototype-of');
module.exports = require('../../modules/_core').Object.setPrototypeOf;

},{"../../modules/es6.object.set-prototype-of":132,"../../modules/_core":67}],54:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/set-prototype-of"), __esModule: true };
},{"core-js/library/fn/object/set-prototype-of":71}],131:[function(require,module,exports) {
var $export = require('./_export');
// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
$export($export.S, 'Object', { create: require('./_object-create') });

},{"./_export":167,"./_object-create":176}],70:[function(require,module,exports) {
require('../../modules/es6.object.create');
var $Object = require('../../modules/_core').Object;
module.exports = function create(P, D) {
  return $Object.create(P, D);
};

},{"../../modules/es6.object.create":131,"../../modules/_core":67}],55:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/create"), __esModule: true };
},{"core-js/library/fn/object/create":70}],43:[function(require,module,exports) {
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
},{"../core-js/object/set-prototype-of":54,"../core-js/object/create":55,"../helpers/typeof":51}],122:[function(require,module,exports) {
/*!
  Copyright (c) 2016 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames () {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg)) {
				classes.push(classNames.apply(null, arg));
			} else if (argType === 'object') {
				for (var key in arg) {
					if (hasOwn.call(arg, key) && arg[key]) {
						classes.push(key);
					}
				}
			}
		}

		return classes.join(' ');
	}

	if (typeof module !== 'undefined' && module.exports) {
		module.exports = classNames;
	} else if (typeof define === 'function' && typeof define.amd === 'object' && define.amd) {
		// register as 'classnames', consistent with npm package name
		define('classnames', [], function () {
			return classNames;
		});
	} else {
		window.classNames = classNames;
	}
}());

},{}],68:[function(require,module,exports) {
'use strict';

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);
    }
  }return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;
  };
}();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : { default: obj };
}

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });
  } else {
    obj[key] = value;
  }return obj;
}

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _possibleConstructorReturn(self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }return call && ((typeof call === "undefined" ? "undefined" : _typeof(call)) === "object" || typeof call === "function") ? call : self;
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === "undefined" ? "undefined" : _typeof(superClass)));
  }subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
}

var DEFAULT_PLACEHOLDER_STRING = 'Select...';

var Dropdown = function (_Component) {
  _inherits(Dropdown, _Component);

  function Dropdown(props) {
    _classCallCheck(this, Dropdown);

    var _this = _possibleConstructorReturn(this, (Dropdown.__proto__ || Object.getPrototypeOf(Dropdown)).call(this, props));

    _this.state = {
      selected: props.value || {
        label: props.placeholder || DEFAULT_PLACEHOLDER_STRING,
        value: ''
      },
      isOpen: false
    };
    _this.mounted = true;
    _this.handleDocumentClick = _this.handleDocumentClick.bind(_this);
    _this.fireChangeEvent = _this.fireChangeEvent.bind(_this);
    return _this;
  }

  _createClass(Dropdown, [{
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(newProps) {
      if (newProps.value && newProps.value !== this.state.selected) {
        this.setState({ selected: newProps.value });
      } else if (!newProps.value) {
        this.setState({ selected: {
            label: newProps.placeholder || DEFAULT_PLACEHOLDER_STRING,
            value: ''
          } });
      }
    }
  }, {
    key: 'componentDidMount',
    value: function componentDidMount() {
      document.addEventListener('click', this.handleDocumentClick, false);
      document.addEventListener('touchend', this.handleDocumentClick, false);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      this.mounted = false;
      document.removeEventListener('click', this.handleDocumentClick, false);
      document.removeEventListener('touchend', this.handleDocumentClick, false);
    }
  }, {
    key: 'handleMouseDown',
    value: function handleMouseDown(event) {
      if (this.props.onFocus && typeof this.props.onFocus === 'function') {
        this.props.onFocus(this.state.isOpen);
      }
      if (event.type === 'mousedown' && event.button !== 0) return;
      event.stopPropagation();
      event.preventDefault();

      if (!this.props.disabled) {
        this.setState({
          isOpen: !this.state.isOpen
        });
      }
    }
  }, {
    key: 'setValue',
    value: function setValue(value, label) {
      var newState = {
        selected: {
          value: value,
          label: label
        },
        isOpen: false
      };
      this.fireChangeEvent(newState);
      this.setState(newState);
    }
  }, {
    key: 'fireChangeEvent',
    value: function fireChangeEvent(newState) {
      if (newState.selected !== this.state.selected && this.props.onChange) {
        this.props.onChange(newState.selected);
      }
    }
  }, {
    key: 'renderOption',
    value: function renderOption(option) {
      var _classes;

      var classes = (_classes = {}, _defineProperty(_classes, this.props.baseClassName + '-option', true), _defineProperty(_classes, option.className, !!option.className), _defineProperty(_classes, 'is-selected', option === this.state.selected), _classes);

      var optionClass = (0, _classnames2.default)(classes);

      var value = option.value || option.label || option;
      var label = option.label || option.value || option;

      return _react2.default.createElement('div', {
        key: value,
        className: optionClass,
        onMouseDown: this.setValue.bind(this, value, label),
        onClick: this.setValue.bind(this, value, label) }, label);
    }
  }, {
    key: 'buildMenu',
    value: function buildMenu() {
      var _this2 = this;

      var _props = this.props,
          options = _props.options,
          baseClassName = _props.baseClassName;

      var ops = options.map(function (option) {
        if (option.type === 'group') {
          var groupTitle = _react2.default.createElement('div', { className: baseClassName + '-title' }, option.name);
          var _options = option.items.map(function (item) {
            return _this2.renderOption(item);
          });

          return _react2.default.createElement('div', { className: baseClassName + '-group', key: option.name }, groupTitle, _options);
        } else {
          return _this2.renderOption(option);
        }
      });

      return ops.length ? ops : _react2.default.createElement('div', { className: baseClassName + '-noresults' }, 'No options found');
    }
  }, {
    key: 'handleDocumentClick',
    value: function handleDocumentClick(event) {
      if (this.mounted) {
        if (!_reactDom2.default.findDOMNode(this).contains(event.target)) {
          if (this.state.isOpen) {
            this.setState({ isOpen: false });
          }
        }
      }
    }
  }, {
    key: 'render',
    value: function render() {
      var _classNames, _classNames2, _classNames3;

      var _props2 = this.props,
          baseClassName = _props2.baseClassName,
          placeholderClassName = _props2.placeholderClassName,
          menuClassName = _props2.menuClassName,
          className = _props2.className;

      var disabledClass = this.props.disabled ? 'Dropdown-disabled' : '';
      var placeHolderValue = typeof this.state.selected === 'string' ? this.state.selected : this.state.selected.label;

      var dropdownClass = (0, _classnames2.default)((_classNames = {}, _defineProperty(_classNames, baseClassName + '-root', true), _defineProperty(_classNames, className, !!className), _defineProperty(_classNames, 'is-open', this.state.isOpen), _classNames));
      var placeholderClass = (0, _classnames2.default)((_classNames2 = {}, _defineProperty(_classNames2, baseClassName + '-placeholder', true), _defineProperty(_classNames2, placeholderClassName, !!placeholderClassName), _classNames2));
      var menuClass = (0, _classnames2.default)((_classNames3 = {}, _defineProperty(_classNames3, baseClassName + '-menu', true), _defineProperty(_classNames3, menuClassName, !!menuClassName), _classNames3));

      var value = _react2.default.createElement('div', { className: placeholderClass }, placeHolderValue);
      var menu = this.state.isOpen ? _react2.default.createElement('div', { className: menuClass }, this.buildMenu()) : null;

      return _react2.default.createElement('div', { className: dropdownClass }, _react2.default.createElement('div', { className: baseClassName + '-control ' + disabledClass, onMouseDown: this.handleMouseDown.bind(this), onTouchEnd: this.handleMouseDown.bind(this) }, value, _react2.default.createElement('span', { className: baseClassName + '-arrow' })), menu);
    }
  }]);

  return Dropdown;
}(_react.Component);

Dropdown.defaultProps = { baseClassName: 'Dropdown' };
exports.default = Dropdown;
},{"react":6,"react-dom":6,"classnames":122}],52:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var Dropdown = require('react-dropdown');

function Tab(props) {
  var slug = props.currentFilter.slug;
  return _react2.default.createElement('div', { className: props.filter == slug ? 'active' : '' }, _react2.default.createElement('a', { href: '#' + slug,
    onClick: function onClick(e) {
      props.dispatch('filter', e.target.attributes.href.value.replace('#', ''));
      e.preventDefault();
    } }, props.currentFilter.text));
}

function Tabs(props) {
  return _react2.default.createElement('div', { className: props.tabsClassName }, props.filters.map(function (filter, index) {
    return _react2.default.createElement(Tab, _extends({}, props, { currentFilter: filter, key: filter.slug }));
  }, this));
}

function filterToOption(filter) {
  return { label: filter.text, value: filter.slug };
}

function DropdownFilters(props) {
  var filter = (0, _arrayPrototype2.default)(props.filters, function (item) {
    return item.slug === props.filter;
  });
  return _react2.default.createElement('div', { className: props.dropdownClassName }, _react2.default.createElement(Dropdown, { options: props.filters.map(filterToOption),
    onChange: function onChange(value) {
      return props.dispatch('filter', value.value);
    },
    value: filter ? filterToOption(filter) : null }));
}

var index = function (props) {
  if (props.style === 'dropdown') {
    return _react2.default.createElement(DropdownFilters, props);
  } else {
    return _react2.default.createElement(Tabs, props);
  }
};

exports.default = index;
},{"react":6,"array.prototype.find":9,"react-dropdown":68}],35:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

exports.default = FiltersWrapper;

require('./filters.sass');

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _galleryFilters = require('gallery-filters');

var _galleryFilters2 = _interopRequireDefault(_galleryFilters);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function shouldAddAll(config) {
  return config.filters.exclude_all != 1;
}

function generateAll(all) {
  return { slug: '_', text: all };
}

function FiltersWrapper(props) {
  var config = props.config;
  var filters = props.filters;
  if (shouldAddAll(config)) filters = [generateAll(config.filters.all)].concat(filters);
  return _react2.default.createElement(_galleryFilters2.default, (0, _extends3.default)({}, props, {
    dropdownClassName: 'uber-grid-filters-dropdown',
    tabsClassName: 'uber-grid-filters',
    style: config.filters.style,
    filters: filters }));
}
},{"babel-runtime/helpers/extends":27,"./filters.sass":113,"react":6,"gallery-filters":52}],78:[function(require,module,exports) {
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t(require("react")):"function"==typeof define&&define.amd?define(["react"],t):"object"==typeof exports?exports.ScrollArea=t(require("react")):e.ScrollArea=t(e.React)}(this,function(e){return function(e){function t(o){if(n[o])return n[o].exports;var r=n[o]={exports:{},id:o,loaded:!1};return e[o].call(r.exports,r,r.exports,t),r.loaded=!0,r.exports}var n={};return t.m=e,t.c=n,t.p="",t(0)}([function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),n(31);var r=n(13),i=o(r);t.default=i.default},function(t,n){t.exports=e},function(e,t,n){e.exports=n(19)()},function(e,t){"use strict";function n(e){var t={};for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]="number"==typeof e[n]?e[n]:e[n].val);return t}t.__esModule=!0,t.default=n,e.exports=t.default},function(e,t,n){(function(t){(function(){var n,o,r;"undefined"!=typeof performance&&null!==performance&&performance.now?e.exports=function(){return performance.now()}:"undefined"!=typeof t&&null!==t&&t.hrtime?(e.exports=function(){return(n()-r)/1e6},o=t.hrtime,n=function(){var e;return e=o(),1e9*e[0]+e[1]},r=n()):Date.now?(e.exports=function(){return Date.now()-r},r=Date.now()):(e.exports=function(){return(new Date).getTime()-r},r=(new Date).getTime())}).call(this)}).call(t,n(10))},function(e,t,n){(function(t){for(var o=n(23),r="undefined"==typeof window?t:window,i=["moz","webkit"],a="AnimationFrame",l=r["request"+a],s=r["cancel"+a]||r["cancelRequest"+a],u=0;!l&&u<i.length;u++)l=r[i[u]+"Request"+a],s=r[i[u]+"Cancel"+a]||r[i[u]+"CancelRequest"+a];if(!l||!s){var c=0,f=0,p=[],d=1e3/60;l=function(e){if(0===p.length){var t=o(),n=Math.max(0,d-(t-c));c=n+t,setTimeout(function(){var e=p.slice(0);p.length=0;for(var t=0;t<e.length;t++)if(!e[t].cancelled)try{e[t].callback(c)}catch(e){setTimeout(function(){throw e},0)}},Math.round(n))}return p.push({handle:++f,callback:e,cancelled:!1}),f},s=function(e){for(var t=0;t<p.length;t++)p[t].handle===e&&(p[t].cancelled=!0)}}e.exports=function(e){return l.call(r,e)},e.exports.cancel=function(){s.apply(r,arguments)},e.exports.polyfill=function(e){e||(e=r),e.requestAnimationFrame=l,e.cancelAnimationFrame=s}}).call(t,function(){return this}())},function(e,t){"use strict";function n(e){var t={};for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=0);return t}t.__esModule=!0,t.default=n,e.exports=t.default},function(e,t){"use strict";function n(e,t,n){for(var o in t)if(Object.prototype.hasOwnProperty.call(t,o)){if(0!==n[o])return!1;var r="number"==typeof t[o]?t[o]:t[o].val;if(e[o]!==r)return!1}return!0}t.__esModule=!0,t.default=n,e.exports=t.default},function(e,t){"use strict";function n(e,t,n,r,i,a,l){var s=-i*(t-r),u=-a*n,c=s+u,f=n+c*e,p=t+f*e;return Math.abs(f)<l&&Math.abs(p-r)<l?(o[0]=r,o[1]=0,o):(o[0]=p,o[1]=f,o)}t.__esModule=!0,t.default=n;var o=[0,0];e.exports=t.default},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e){return p?f.default.findDOMNode(e):e}function i(){d||p||(d=!0,console.error("With React 0.14 and later versions, you no longer need to wrap <ScrollArea> child into a function."))}function a(){!d&&p&&(d=!0,console.error("With React 0.13, you need to wrap <ScrollArea> child into a function."))}function l(e){return e<0?0:e}function s(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:function(e){return e},n={};for(var o in e)e.hasOwnProperty(o)&&(n[o]=t(e[o]));return n}function u(e){var t=e.version;if("string"!=typeof t)return!0;var n=t.split("."),o=parseInt(n[0],10),r=parseInt(n[1],10);return 0===o&&13===r}Object.defineProperty(t,"__esModule",{value:!0}),t.findDOMNode=r,t.warnAboutFunctionChild=i,t.warnAboutElementChild=a,t.positiveOrZero=l,t.modifyObjValues=s,t.isReact13=u;var c=n(1),f=o(c),p=u(f.default),d=!1},function(e,t){function n(){throw new Error("setTimeout has not been defined")}function o(){throw new Error("clearTimeout has not been defined")}function r(e){if(c===setTimeout)return setTimeout(e,0);if((c===n||!c)&&setTimeout)return c=setTimeout,setTimeout(e,0);try{return c(e,0)}catch(t){try{return c.call(null,e,0)}catch(t){return c.call(this,e,0)}}}function i(e){if(f===clearTimeout)return clearTimeout(e);if((f===o||!f)&&clearTimeout)return f=clearTimeout,clearTimeout(e);try{return f(e)}catch(t){try{return f.call(null,e)}catch(t){return f.call(this,e)}}}function a(){y&&d&&(y=!1,d.length?h=d.concat(h):v=-1,h.length&&l())}function l(){if(!y){var e=r(a);y=!0;for(var t=h.length;t;){for(d=h,h=[];++v<t;)d&&d[v].run();v=-1,t=h.length}d=null,y=!1,i(e)}}function s(e,t){this.fun=e,this.array=t}function u(){}var c,f,p=e.exports={};!function(){try{c="function"==typeof setTimeout?setTimeout:n}catch(e){c=n}try{f="function"==typeof clearTimeout?clearTimeout:o}catch(e){f=o}}();var d,h=[],y=!1,v=-1;p.nextTick=function(e){var t=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];h.push(new s(e,t)),1!==h.length||y||r(l)},s.prototype.run=function(){this.fun.apply(null,this.array)},p.title="browser",p.browser=!0,p.env={},p.argv=[],p.version="",p.versions={},p.on=u,p.addListener=u,p.once=u,p.off=u,p.removeListener=u,p.removeAllListeners=u,p.emit=u,p.binding=function(e){throw new Error("process.binding is not supported")},p.cwd=function(){return"/"},p.chdir=function(e){throw new Error("process.chdir is not supported")},p.umask=function(){return 0}},function(e,t){"use strict";t.__esModule=!0,t.default={noWobble:{stiffness:170,damping:26},gentle:{stiffness:120,damping:14},wobbly:{stiffness:180,damping:12},stiff:{stiffness:210,damping:20}},e.exports=t.default},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e.default:e}t.__esModule=!0;var r=n(24);t.Motion=o(r);var i=n(25);t.StaggeredMotion=o(i);var a=n(26);t.TransitionMotion=o(a);var l=n(29);t.spring=o(l);var s=n(11);t.presets=o(s);var u=n(3);t.stripStyle=o(u);var c=n(28);t.reorderKeys=o(c)},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},s=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},u=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),c=n(1),f=o(c),p=n(2),d=o(p),h=n(18),y=o(h),v=n(12),m=n(9),b=n(14),S=o(b),g={wheel:"wheel",api:"api",touch:"touch",touchEnd:"touchEnd",mousemove:"mousemove",keyPress:"keypress"},w=function(e){function t(e){r(this,t);var n=i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return n.state={topPosition:0,leftPosition:0,realHeight:0,containerHeight:0,realWidth:0,containerWidth:0},n.scrollArea={refresh:function(){n.setSizesToState()},scrollTop:function(){n.scrollTop()},scrollBottom:function(){n.scrollBottom()},scrollYTo:function(e){n.scrollYTo(e)},scrollLeft:function(){n.scrollLeft()},scrollRight:function(){n.scrollRight()},scrollXTo:function(e){n.scrollXTo(e)}},n.evntsPreviousValues={clientX:0,clientY:0,deltaX:0,deltaY:0},n.bindedHandleWindowResize=n.handleWindowResize.bind(n),n}return a(t,e),u(t,[{key:"getChildContext",value:function(){return{scrollArea:this.scrollArea}}},{key:"componentDidMount",value:function(){this.props.contentWindow&&this.props.contentWindow.addEventListener("resize",this.bindedHandleWindowResize),this.lineHeightPx=(0,y.default)((0,m.findDOMNode)(this.content)),this.setSizesToState()}},{key:"componentWillUnmount",value:function(){this.props.contentWindow&&this.props.contentWindow.removeEventListener("resize",this.bindedHandleWindowResize)}},{key:"componentDidUpdate",value:function(){this.setSizesToState()}},{key:"render",value:function(){var e=this,t=this.props,n=t.children,o=t.className,r=t.contentClassName,i=t.ownerDocument,a=this.props.smoothScrolling&&(this.state.eventType===g.wheel||this.state.eventType===g.api||this.state.eventType===g.touchEnd||this.state.eventType===g.keyPress),l=this.canScrollY()?f.default.createElement(S.default,{ownerDocument:i,realSize:this.state.realHeight,containerSize:this.state.containerHeight,position:this.state.topPosition,onMove:this.handleScrollbarMove.bind(this),onPositionChange:this.handleScrollbarYPositionChange.bind(this),containerStyle:this.props.verticalContainerStyle,scrollbarStyle:this.props.verticalScrollbarStyle,smoothScrolling:a,minScrollSize:this.props.minScrollSize,onFocus:this.focusContent.bind(this),type:"vertical"}):null,u=this.canScrollX()?f.default.createElement(S.default,{ownerDocument:i,realSize:this.state.realWidth,containerSize:this.state.containerWidth,position:this.state.leftPosition,onMove:this.handleScrollbarMove.bind(this),onPositionChange:this.handleScrollbarXPositionChange.bind(this),containerStyle:this.props.horizontalContainerStyle,scrollbarStyle:this.props.horizontalScrollbarStyle,smoothScrolling:a,minScrollSize:this.props.minScrollSize,onFocus:this.focusContent.bind(this),type:"horizontal"}):null;"function"==typeof n?((0,m.warnAboutFunctionChild)(),n=n()):(0,m.warnAboutElementChild)();var c="scrollarea "+(o||""),p="scrollarea-content "+(r||""),d={marginTop:-this.state.topPosition,marginLeft:-this.state.leftPosition},h=a?(0,m.modifyObjValues)(d,function(e){return(0,v.spring)(e)}):d;return f.default.createElement(v.Motion,{style:h},function(t){return f.default.createElement("div",{ref:function(t){return e.wrapper=t},className:c,style:e.props.style,onWheel:e.handleWheel.bind(e)},f.default.createElement("div",{ref:function(t){return e.content=t},style:s({},e.props.contentStyle,t),className:p,onTouchStart:e.handleTouchStart.bind(e),onTouchMove:e.handleTouchMove.bind(e),onTouchEnd:e.handleTouchEnd.bind(e),onKeyDown:e.handleKeyDown.bind(e),tabIndex:e.props.focusableTabIndex},n),l,u)})}},{key:"setStateFromEvent",value:function(e,t){this.props.onScroll&&this.props.onScroll(e),this.setState(s({},e,{eventType:t}))}},{key:"handleTouchStart",value:function(e){var t=e.touches;if(1===t.length){var n=t[0],o=n.clientX,r=n.clientY;this.eventPreviousValues=s({},this.eventPreviousValues,{clientY:r,clientX:o,timestamp:Date.now()})}}},{key:"handleTouchMove",value:function(e){this.canScroll()&&(e.preventDefault(),e.stopPropagation());var t=e.touches;if(1===t.length){var n=t[0],o=n.clientX,r=n.clientY,i=this.eventPreviousValues.clientY-r,a=this.eventPreviousValues.clientX-o;this.eventPreviousValues=s({},this.eventPreviousValues,{deltaY:i,deltaX:a,clientY:r,clientX:o,timestamp:Date.now()}),this.setStateFromEvent(this.composeNewState(-a,-i))}}},{key:"handleTouchEnd",value:function(e){var t=this.eventPreviousValues,n=t.deltaX,o=t.deltaY,r=t.timestamp;"undefined"==typeof n&&(n=0),"undefined"==typeof o&&(o=0),Date.now()-r<200&&this.setStateFromEvent(this.composeNewState(10*-n,10*-o),g.touchEnd),this.eventPreviousValues=s({},this.eventPreviousValues,{deltaY:0,deltaX:0})}},{key:"handleScrollbarMove",value:function(e,t){this.setStateFromEvent(this.composeNewState(t,e))}},{key:"handleScrollbarXPositionChange",value:function(e){this.scrollXTo(e)}},{key:"handleScrollbarYPositionChange",value:function(e){this.scrollYTo(e)}},{key:"handleWheel",value:function(e){var t=e.deltaY,n=e.deltaX;if(this.props.swapWheelAxes){var o=[n,t];t=o[0],n=o[1]}1===e.deltaMode&&(t*=this.lineHeightPx,n*=this.lineHeightPx),t*=this.props.speed,n*=this.props.speed;var r=this.composeNewState(-n,-t);(r.topPosition&&this.state.topPosition!==r.topPosition||r.leftPosition&&this.state.leftPosition!==r.leftPosition||this.props.stopScrollPropagation)&&(e.preventDefault(),e.stopPropagation()),this.setStateFromEvent(r,g.wheel),this.focusContent()}},{key:"handleKeyDown",value:function(e){if("input"!==e.target.tagName.toLowerCase()&&"textarea"!==e.target.tagName.toLowerCase()&&!e.target.isContentEditable){var t=0,n=0,o=this.lineHeightPx?this.lineHeightPx:10;switch(e.keyCode){case 33:t=this.state.containerHeight-o;break;case 34:t=-this.state.containerHeight+o;break;case 37:n=o;break;case 38:t=o;break;case 39:n=-o;break;case 40:t=-o}if(0!==t||0!==n){var r=this.composeNewState(n,t);e.preventDefault(),e.stopPropagation(),this.setStateFromEvent(r,g.keyPress)}}}},{key:"handleWindowResize",value:function(){var e=this.computeSizes();e=this.getModifiedPositionsIfNeeded(e),this.setStateFromEvent(e)}},{key:"composeNewState",value:function(e,t){var n=this.computeSizes();return this.canScrollY(n)?n.topPosition=this.computeTopPosition(t,n):n.topPosition=0,this.canScrollX(n)&&(n.leftPosition=this.computeLeftPosition(e,n)),n}},{key:"computeTopPosition",value:function(e,t){var n=this.state.topPosition-e;return this.normalizeTopPosition(n,t)}},{key:"computeLeftPosition",value:function(e,t){var n=this.state.leftPosition-e;return this.normalizeLeftPosition(n,t)}},{key:"normalizeTopPosition",value:function(e,t){return e>t.realHeight-t.containerHeight&&(e=t.realHeight-t.containerHeight),e<0&&(e=0),e}},{key:"normalizeLeftPosition",value:function(e,t){return e>t.realWidth-t.containerWidth?e=t.realWidth-t.containerWidth:e<0&&(e=0),e}},{key:"computeSizes",value:function(){var e=this.content.offsetHeight,t=this.wrapper.offsetHeight,n=this.content.offsetWidth,o=this.wrapper.offsetWidth;return{realHeight:e,containerHeight:t,realWidth:n,containerWidth:o}}},{key:"setSizesToState",value:function(){var e=this.computeSizes();e.realHeight===this.state.realHeight&&e.realWidth===this.state.realWidth||this.setStateFromEvent(this.getModifiedPositionsIfNeeded(e))}},{key:"scrollTop",value:function(){this.scrollYTo(0)}},{key:"scrollBottom",value:function(){this.scrollYTo(this.state.realHeight-this.state.containerHeight)}},{key:"scrollLeft",value:function(){this.scrollXTo(0)}},{key:"scrollRight",value:function(){this.scrollXTo(this.state.realWidth-this.state.containerWidth)}},{key:"scrollYTo",value:function(e){if(this.canScrollY()){var t=this.normalizeTopPosition(e,this.computeSizes());this.setStateFromEvent({topPosition:t},g.api)}}},{key:"scrollXTo",value:function(e){if(this.canScrollX()){var t=this.normalizeLeftPosition(e,this.computeSizes());this.setStateFromEvent({leftPosition:t},g.api)}}},{key:"canScrollY",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.state,t=e.realHeight>e.containerHeight;return t&&this.props.vertical}},{key:"canScrollX",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.state,t=e.realWidth>e.containerWidth;return t&&this.props.horizontal}},{key:"canScroll",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this.state;return this.canScrollY(e)||this.canScrollX(e)}},{key:"getModifiedPositionsIfNeeded",value:function(e){var t=e.realHeight-e.containerHeight;this.state.topPosition>=t&&(e.topPosition=this.canScrollY(e)?(0,m.positiveOrZero)(t):0);var n=e.realWidth-e.containerWidth;return this.state.leftPosition>=n&&(e.leftPosition=this.canScrollX(e)?(0,m.positiveOrZero)(n):0),e}},{key:"focusContent",value:function(){this.content&&(0,m.findDOMNode)(this.content).focus()}}]),t}(f.default.Component);t.default=w,w.childContextTypes={scrollArea:d.default.object},w.propTypes={className:d.default.string,style:d.default.object,speed:d.default.number,contentClassName:d.default.string,contentStyle:d.default.object,vertical:d.default.bool,verticalContainerStyle:d.default.object,verticalScrollbarStyle:d.default.object,horizontal:d.default.bool,horizontalContainerStyle:d.default.object,horizontalScrollbarStyle:d.default.object,onScroll:d.default.func,contentWindow:d.default.any,ownerDocument:d.default.any,smoothScrolling:d.default.bool,minScrollSize:d.default.number,swapWheelAxes:d.default.bool,stopScrollPropagation:d.default.bool,focusableTabIndex:d.default.number},w.defaultProps={speed:1,vertical:!0,horizontal:!0,smoothScrolling:!1,swapWheelAxes:!1,contentWindow:"object"===("undefined"==typeof window?"undefined":l(window))?window:void 0,ownerDocument:"object"===("undefined"==typeof document?"undefined":l(document))?document:void 0,focusableTabIndex:1}},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}Object.defineProperty(t,"__esModule",{value:!0});var l=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},s=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),u=n(1),c=o(u),f=n(2),p=o(f),d=n(12),h=n(9),y=function(e){function t(e){r(this,t);var n=i(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e)),o=n.calculateState(e);return n.state={position:o.position,scrollSize:o.scrollSize,isDragging:!1,lastClientPosition:0},"vertical"===e.type?n.bindedHandleMouseMove=n.handleMouseMoveForVertical.bind(n):n.bindedHandleMouseMove=n.handleMouseMoveForHorizontal.bind(n),n.bindedHandleMouseUp=n.handleMouseUp.bind(n),n}return a(t,e),s(t,[{key:"componentDidMount",value:function(){this.props.ownerDocument&&(this.props.ownerDocument.addEventListener("mousemove",this.bindedHandleMouseMove),this.props.ownerDocument.addEventListener("mouseup",this.bindedHandleMouseUp))}},{key:"componentWillReceiveProps",value:function(e){this.setState(this.calculateState(e))}},{key:"componentWillUnmount",value:function(){this.props.ownerDocument&&(this.props.ownerDocument.removeEventListener("mousemove",this.bindedHandleMouseMove),this.props.ownerDocument.removeEventListener("mouseup",this.bindedHandleMouseUp))}},{key:"calculateFractionalPosition",value:function(e,t,n){var o=e-t;return 1-(o-n)/o}},{key:"calculateState",value:function(e){var t=this.calculateFractionalPosition(e.realSize,e.containerSize,e.position),n=e.containerSize*e.containerSize/e.realSize,o=n<e.minScrollSize?e.minScrollSize:n,r=(e.containerSize-o)*t;return{scrollSize:o,position:Math.round(r)}}},{key:"render",value:function(){var e=this,t=this.props,n=t.smoothScrolling,o=t.isDragging,r=t.type,i=t.scrollbarStyle,a=t.containerStyle,s="horizontal"===r,u="vertical"===r,f=this.createScrollStyles(),p=n?(0,h.modifyObjValues)(f,function(e){return(0,d.spring)(e)}):f,y="scrollbar-container "+(o?"active":"")+" "+(s?"horizontal":"")+" "+(u?"vertical":"");return c.default.createElement(d.Motion,{style:p},function(t){return c.default.createElement("div",{className:y,style:a,onMouseDown:e.handleScrollBarContainerClick.bind(e),ref:function(t){return e.scrollbarContainer=t}},c.default.createElement("div",{className:"scrollbar",style:l({},i,t),onMouseDown:e.handleMouseDown.bind(e)}))})}},{key:"handleScrollBarContainerClick",value:function(e){e.preventDefault();var t=this.computeMultiplier(),n=this.isVertical()?e.clientY:e.clientX,o=this.scrollbarContainer.getBoundingClientRect(),r=o.top,i=o.left,a=this.isVertical()?r:i,l=n-a,s=this.props.containerSize*this.props.containerSize/this.props.realSize;this.setState({isDragging:!0,lastClientPosition:n}),this.props.onPositionChange((l-s/2)/t)}},{key:"handleMouseMoveForHorizontal",value:function(e){var t=this.computeMultiplier();if(this.state.isDragging){e.preventDefault();var n=this.state.lastClientPosition-e.clientX;this.setState({lastClientPosition:e.clientX}),this.props.onMove(0,n/t)}}},{key:"handleMouseMoveForVertical",value:function(e){var t=this.computeMultiplier();if(this.state.isDragging){e.preventDefault();var n=this.state.lastClientPosition-e.clientY;this.setState({lastClientPosition:e.clientY}),this.props.onMove(n/t,0)}}},{key:"handleMouseDown",value:function(e){e.preventDefault(),e.stopPropagation();var t=this.isVertical()?e.clientY:e.clientX;this.setState({isDragging:!0,lastClientPosition:t}),this.props.onFocus()}},{key:"handleMouseUp",value:function(e){this.state.isDragging&&(e.preventDefault(),this.setState({isDragging:!1}))}},{key:"createScrollStyles",value:function(){return"vertical"===this.props.type?{height:this.state.scrollSize,marginTop:this.state.position}:{width:this.state.scrollSize,marginLeft:this.state.position}}},{key:"computeMultiplier",value:function(){return this.props.containerSize/this.props.realSize}},{key:"isVertical",value:function(){return"vertical"===this.props.type}}]),t}(c.default.Component);y.propTypes={onMove:p.default.func,onPositionChange:p.default.func,onFocus:p.default.func,realSize:p.default.number,containerSize:p.default.number,position:p.default.number,containerStyle:p.default.object,scrollbarStyle:p.default.object,type:p.default.oneOf(["vertical","horizontal"]),ownerDocument:p.default.any,smoothScrolling:p.default.bool,minScrollSize:p.default.number},y.defaultProps={type:"vertical",smoothScrolling:!1},t.default=y},function(e,t){var n=function(e,t,n){return n=window.getComputedStyle,(n?n(e):e.currentStyle)[t.replace(/-(\w)/gi,function(e,t){return t.toUpperCase()})]};e.exports=n},function(e,t,n){t=e.exports=n(17)(),t.push([e.id,".scrollarea-content{margin:0;padding:0;overflow:hidden;position:relative}.scrollarea-content:focus{outline:0}.scrollarea{position:relative;overflow:hidden}.scrollarea .scrollbar-container{position:absolute;background:none;opacity:.1;z-index:9999;-webkit-transition:all .4s;transition:all .4s}.scrollarea .scrollbar-container.horizontal{width:100%;height:10px;left:0;bottom:0}.scrollarea .scrollbar-container.horizontal .scrollbar{width:20px;height:8px;background:#000;margin-top:1px}.scrollarea .scrollbar-container.vertical{width:10px;height:100%;right:0;top:0}.scrollarea .scrollbar-container.vertical .scrollbar{width:8px;height:20px;background:#000;margin-left:1px}.scrollarea .scrollbar-container.active,.scrollarea .scrollbar-container:hover{background:gray;opacity:.6!important}.scrollarea:hover .scrollbar-container{opacity:.3}",""])},function(e,t){e.exports=function(){var e=[];return e.toString=function(){for(var e=[],t=0;t<this.length;t++){var n=this[t];n[2]?e.push("@media "+n[2]+"{"+n[1]+"}"):e.push(n[1])}return e.join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var o={},r=0;r<this.length;r++){var i=this[r][0];"number"==typeof i&&(o[i]=!0)}for(r=0;r<t.length;r++){var a=t[r];"number"==typeof a[0]&&o[a[0]]||(n&&!a[2]?a[2]=n:n&&(a[2]="("+a[2]+") and ("+n+")"),e.push(a))}},e}},function(e,t,n){function o(e){var t=r(e,"line-height"),n=parseFloat(t,10);if(t===n+""){var o=e.style.lineHeight;e.style.lineHeight=t+"em",t=r(e,"line-height"),n=parseFloat(t,10),o?e.style.lineHeight=o:delete e.style.lineHeight}if(t.indexOf("pt")!==-1?(n*=4,n/=3):t.indexOf("mm")!==-1?(n*=96,n/=25.4):t.indexOf("cm")!==-1?(n*=96,n/=2.54):t.indexOf("in")!==-1?n*=96:t.indexOf("pc")!==-1&&(n*=16),n=Math.round(n),"normal"===t){var i=e.nodeName,a=document.createElement(i);a.innerHTML="&nbsp;";var l=r(e,"font-size");a.style.fontSize=l;var s=document.body;s.appendChild(a);var u=a.offsetHeight;n=u,s.removeChild(a)}return n}var r=n(15);e.exports=o},function(e,t,n){"use strict";var o=n(21),r=n(22),i=n(20);e.exports=function(){function e(e,t,n,o,a,l){l!==i&&r(!1,"Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types")}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t};return n.checkPropTypes=o,n.PropTypes=n,n}},function(e,t){"use strict";var n="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED";e.exports=n},function(e,t){"use strict";function n(e){return function(){return e}}var o=function(){};o.thatReturns=n,o.thatReturnsFalse=n(!1),o.thatReturnsTrue=n(!0),o.thatReturnsNull=n(null),o.thatReturnsThis=function(){return this},o.thatReturnsArgument=function(e){return e},e.exports=o},function(e,t,n){"use strict";function o(e,t,n,o,i,a,l,s){if(r(t),!e){var u;if(void 0===t)u=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var c=[n,o,i,a,l,s],f=0;u=new Error(t.replace(/%s/g,function(){return c[f++]})),u.name="Invariant Violation"}throw u.framesToPop=1,u}}var r=function(e){};e.exports=o},function(e,t,n){(function(t){(function(){var n,o,r,i,a,l;"undefined"!=typeof performance&&null!==performance&&performance.now?e.exports=function(){return performance.now()}:"undefined"!=typeof t&&null!==t&&t.hrtime?(e.exports=function(){return(n()-a)/1e6},o=t.hrtime,n=function(){var e;return e=o(),1e9*e[0]+e[1]},i=n(),l=1e9*t.uptime(),a=i-l):Date.now?(e.exports=function(){return Date.now()-r},r=Date.now()):(e.exports=function(){return(new Date).getTime()-r},r=(new Date).getTime())}).call(this)}).call(t,n(10))},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}t.__esModule=!0;var a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},l=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),s=n(6),u=o(s),c=n(3),f=o(c),p=n(8),d=o(p),h=n(4),y=o(h),v=n(5),m=o(v),b=n(7),S=o(b),g=n(1),w=o(g),P=n(2),T=o(P),k=1e3/60,O=function(e){function t(n){var o=this;r(this,t),e.call(this,n),this.wasAnimating=!1,this.animationID=null,this.prevTime=0,this.accumulatedTime=0,this.unreadPropStyle=null,this.clearUnreadPropStyle=function(e){var t=!1,n=o.state,r=n.currentStyle,i=n.currentVelocity,l=n.lastIdealStyle,s=n.lastIdealVelocity;for(var u in e)if(Object.prototype.hasOwnProperty.call(e,u)){var c=e[u];"number"==typeof c&&(t||(t=!0,r=a({},r),i=a({},i),l=a({},l),s=a({},s)),r[u]=c,i[u]=0,l[u]=c,s[u]=0)}t&&o.setState({currentStyle:r,currentVelocity:i,lastIdealStyle:l,lastIdealVelocity:s})},this.startAnimationIfNecessary=function(){o.animationID=m.default(function(e){var t=o.props.style;if(S.default(o.state.currentStyle,t,o.state.currentVelocity))return o.wasAnimating&&o.props.onRest&&o.props.onRest(),o.animationID=null,o.wasAnimating=!1,void(o.accumulatedTime=0);o.wasAnimating=!0;var n=e||y.default(),r=n-o.prevTime;if(o.prevTime=n,o.accumulatedTime=o.accumulatedTime+r,o.accumulatedTime>10*k&&(o.accumulatedTime=0),0===o.accumulatedTime)return o.animationID=null,void o.startAnimationIfNecessary();var i=(o.accumulatedTime-Math.floor(o.accumulatedTime/k)*k)/k,a=Math.floor(o.accumulatedTime/k),l={},s={},u={},c={};for(var f in t)if(Object.prototype.hasOwnProperty.call(t,f)){var p=t[f];if("number"==typeof p)u[f]=p,c[f]=0,l[f]=p,s[f]=0;else{for(var h=o.state.lastIdealStyle[f],v=o.state.lastIdealVelocity[f],m=0;m<a;m++){var b=d.default(k/1e3,h,v,p.val,p.stiffness,p.damping,p.precision);h=b[0],v=b[1]}var g=d.default(k/1e3,h,v,p.val,p.stiffness,p.damping,p.precision),w=g[0],P=g[1];u[f]=h+(w-h)*i,c[f]=v+(P-v)*i,l[f]=h,s[f]=v}}o.animationID=null,o.accumulatedTime-=a*k,o.setState({currentStyle:u,currentVelocity:c,lastIdealStyle:l,lastIdealVelocity:s}),o.unreadPropStyle=null,o.startAnimationIfNecessary()})},this.state=this.defaultState()}return i(t,e),l(t,null,[{key:"propTypes",value:{defaultStyle:T.default.objectOf(T.default.number),style:T.default.objectOf(T.default.oneOfType([T.default.number,T.default.object])).isRequired,children:T.default.func.isRequired,onRest:T.default.func},enumerable:!0}]),t.prototype.defaultState=function(){var e=this.props,t=e.defaultStyle,n=e.style,o=t||f.default(n),r=u.default(o);return{currentStyle:o,currentVelocity:r,lastIdealStyle:o,lastIdealVelocity:r}},t.prototype.componentDidMount=function(){this.prevTime=y.default(),this.startAnimationIfNecessary()},t.prototype.componentWillReceiveProps=function(e){null!=this.unreadPropStyle&&this.clearUnreadPropStyle(this.unreadPropStyle),this.unreadPropStyle=e.style,null==this.animationID&&(this.prevTime=y.default(),this.startAnimationIfNecessary())},t.prototype.componentWillUnmount=function(){null!=this.animationID&&(m.default.cancel(this.animationID),this.animationID=null)},t.prototype.render=function(){var e=this.props.children(this.state.currentStyle);return e&&w.default.Children.only(e)},t}(w.default.Component);t.default=O,e.exports=t.default},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}function a(e,t,n){for(var o=0;o<e.length;o++)if(!g.default(e[o],t[o],n[o]))return!1;return!0}t.__esModule=!0;var l=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},s=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),u=n(6),c=o(u),f=n(3),p=o(f),d=n(8),h=o(d),y=n(4),v=o(y),m=n(5),b=o(m),S=n(7),g=o(S),w=n(1),P=o(w),T=n(2),k=o(T),O=1e3/60,M=function(e){function t(n){var o=this;r(this,t),e.call(this,n),this.animationID=null,this.prevTime=0,this.accumulatedTime=0,this.unreadPropStyles=null,this.clearUnreadPropStyle=function(e){for(var t=o.state,n=t.currentStyles,r=t.currentVelocities,i=t.lastIdealStyles,a=t.lastIdealVelocities,s=!1,u=0;u<e.length;u++){var c=e[u],f=!1;for(var p in c)if(Object.prototype.hasOwnProperty.call(c,p)){var d=c[p];"number"==typeof d&&(f||(f=!0,s=!0,n[u]=l({},n[u]),r[u]=l({},r[u]),i[u]=l({},i[u]),a[u]=l({},a[u])),n[u][p]=d,r[u][p]=0,i[u][p]=d,a[u][p]=0)}}s&&o.setState({currentStyles:n,currentVelocities:r,lastIdealStyles:i,lastIdealVelocities:a})},this.startAnimationIfNecessary=function(){o.animationID=b.default(function(e){
var t=o.props.styles(o.state.lastIdealStyles);if(a(o.state.currentStyles,t,o.state.currentVelocities))return o.animationID=null,void(o.accumulatedTime=0);var n=e||v.default(),r=n-o.prevTime;if(o.prevTime=n,o.accumulatedTime=o.accumulatedTime+r,o.accumulatedTime>10*O&&(o.accumulatedTime=0),0===o.accumulatedTime)return o.animationID=null,void o.startAnimationIfNecessary();for(var i=(o.accumulatedTime-Math.floor(o.accumulatedTime/O)*O)/O,l=Math.floor(o.accumulatedTime/O),s=[],u=[],c=[],f=[],p=0;p<t.length;p++){var d=t[p],y={},m={},b={},S={};for(var g in d)if(Object.prototype.hasOwnProperty.call(d,g)){var w=d[g];if("number"==typeof w)y[g]=w,m[g]=0,b[g]=w,S[g]=0;else{for(var P=o.state.lastIdealStyles[p][g],T=o.state.lastIdealVelocities[p][g],k=0;k<l;k++){var M=h.default(O/1e3,P,T,w.val,w.stiffness,w.damping,w.precision);P=M[0],T=M[1]}var x=h.default(O/1e3,P,T,w.val,w.stiffness,w.damping,w.precision),I=x[0],D=x[1];y[g]=P+(I-P)*i,m[g]=T+(D-T)*i,b[g]=P,S[g]=T}}c[p]=y,f[p]=m,s[p]=b,u[p]=S}o.animationID=null,o.accumulatedTime-=l*O,o.setState({currentStyles:c,currentVelocities:f,lastIdealStyles:s,lastIdealVelocities:u}),o.unreadPropStyles=null,o.startAnimationIfNecessary()})},this.state=this.defaultState()}return i(t,e),s(t,null,[{key:"propTypes",value:{defaultStyles:k.default.arrayOf(k.default.objectOf(k.default.number)),styles:k.default.func.isRequired,children:k.default.func.isRequired},enumerable:!0}]),t.prototype.defaultState=function(){var e=this.props,t=e.defaultStyles,n=e.styles,o=t||n().map(p.default),r=o.map(function(e){return c.default(e)});return{currentStyles:o,currentVelocities:r,lastIdealStyles:o,lastIdealVelocities:r}},t.prototype.componentDidMount=function(){this.prevTime=v.default(),this.startAnimationIfNecessary()},t.prototype.componentWillReceiveProps=function(e){null!=this.unreadPropStyles&&this.clearUnreadPropStyle(this.unreadPropStyles),this.unreadPropStyles=e.styles(this.state.lastIdealStyles),null==this.animationID&&(this.prevTime=v.default(),this.startAnimationIfNecessary())},t.prototype.componentWillUnmount=function(){null!=this.animationID&&(b.default.cancel(this.animationID),this.animationID=null)},t.prototype.render=function(){var e=this.props.children(this.state.currentStyles);return e&&P.default.Children.only(e)},t}(P.default.Component);t.default=M,e.exports=t.default},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}function a(e,t,n){var o=t;return null==o?e.map(function(e,t){return{key:e.key,data:e.data,style:n[t]}}):e.map(function(e,t){for(var r=0;r<o.length;r++)if(o[r].key===e.key)return{key:o[r].key,data:o[r].data,style:n[t]};return{key:e.key,data:e.data,style:n[t]}})}function l(e,t,n,o){if(o.length!==t.length)return!1;for(var r=0;r<o.length;r++)if(o[r].key!==t[r].key)return!1;for(var r=0;r<o.length;r++)if(!k.default(e[r],t[r].style,n[r]))return!1;return!0}function s(e,t,n,o,r,i,a,l,s){for(var u=b.default(o,r,function(e,o){var r=t(o);return null==r?(n({key:o.key,data:o.data}),null):k.default(i[e],r,a[e])?(n({key:o.key,data:o.data}),null):{key:o.key,data:o.data,style:r}}),c=[],f=[],d=[],h=[],y=0;y<u.length;y++){for(var v=u[y],m=null,S=0;S<o.length;S++)if(o[S].key===v.key){m=S;break}if(null==m){var g=e(v);c[y]=g,d[y]=g;var w=p.default(v.style);f[y]=w,h[y]=w}else c[y]=i[m],d[y]=l[m],f[y]=a[m],h[y]=s[m]}return[u,c,f,d,h]}t.__esModule=!0;var u=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},c=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),f=n(6),p=o(f),d=n(3),h=o(d),y=n(8),v=o(y),m=n(27),b=o(m),S=n(4),g=o(S),w=n(5),P=o(w),T=n(7),k=o(T),O=n(1),M=o(O),x=n(2),I=o(x),D=1e3/60,_=function(e){function t(n){var o=this;r(this,t),e.call(this,n),this.unmounting=!1,this.animationID=null,this.prevTime=0,this.accumulatedTime=0,this.unreadPropStyles=null,this.clearUnreadPropStyle=function(e){for(var t=s(o.props.willEnter,o.props.willLeave,o.props.didLeave,o.state.mergedPropsStyles,e,o.state.currentStyles,o.state.currentVelocities,o.state.lastIdealStyles,o.state.lastIdealVelocities),n=t[0],r=t[1],i=t[2],a=t[3],l=t[4],c=0;c<e.length;c++){var f=e[c].style,p=!1;for(var d in f)if(Object.prototype.hasOwnProperty.call(f,d)){var h=f[d];"number"==typeof h&&(p||(p=!0,r[c]=u({},r[c]),i[c]=u({},i[c]),a[c]=u({},a[c]),l[c]=u({},l[c]),n[c]={key:n[c].key,data:n[c].data,style:u({},n[c].style)}),r[c][d]=h,i[c][d]=0,a[c][d]=h,l[c][d]=0,n[c].style[d]=h)}}o.setState({currentStyles:r,currentVelocities:i,mergedPropsStyles:n,lastIdealStyles:a,lastIdealVelocities:l})},this.startAnimationIfNecessary=function(){o.unmounting||(o.animationID=P.default(function(e){if(!o.unmounting){var t=o.props.styles,n="function"==typeof t?t(a(o.state.mergedPropsStyles,o.unreadPropStyles,o.state.lastIdealStyles)):t;if(l(o.state.currentStyles,n,o.state.currentVelocities,o.state.mergedPropsStyles))return o.animationID=null,void(o.accumulatedTime=0);var r=e||g.default(),i=r-o.prevTime;if(o.prevTime=r,o.accumulatedTime=o.accumulatedTime+i,o.accumulatedTime>10*D&&(o.accumulatedTime=0),0===o.accumulatedTime)return o.animationID=null,void o.startAnimationIfNecessary();for(var u=(o.accumulatedTime-Math.floor(o.accumulatedTime/D)*D)/D,c=Math.floor(o.accumulatedTime/D),f=s(o.props.willEnter,o.props.willLeave,o.props.didLeave,o.state.mergedPropsStyles,n,o.state.currentStyles,o.state.currentVelocities,o.state.lastIdealStyles,o.state.lastIdealVelocities),p=f[0],d=f[1],h=f[2],y=f[3],m=f[4],b=0;b<p.length;b++){var S=p[b].style,w={},P={},T={},k={};for(var O in S)if(Object.prototype.hasOwnProperty.call(S,O)){var M=S[O];if("number"==typeof M)w[O]=M,P[O]=0,T[O]=M,k[O]=0;else{for(var x=y[b][O],I=m[b][O],_=0;_<c;_++){var j=v.default(D/1e3,x,I,M.val,M.stiffness,M.damping,M.precision);x=j[0],I=j[1]}var C=v.default(D/1e3,x,I,M.val,M.stiffness,M.damping,M.precision),z=C[0],E=C[1];w[O]=x+(z-x)*u,P[O]=I+(E-I)*u,T[O]=x,k[O]=I}}y[b]=T,m[b]=k,d[b]=w,h[b]=P}o.animationID=null,o.accumulatedTime-=c*D,o.setState({currentStyles:d,currentVelocities:h,lastIdealStyles:y,lastIdealVelocities:m,mergedPropsStyles:p}),o.unreadPropStyles=null,o.startAnimationIfNecessary()}}))},this.state=this.defaultState()}return i(t,e),c(t,null,[{key:"propTypes",value:{defaultStyles:I.default.arrayOf(I.default.shape({key:I.default.string.isRequired,data:I.default.any,style:I.default.objectOf(I.default.number).isRequired})),styles:I.default.oneOfType([I.default.func,I.default.arrayOf(I.default.shape({key:I.default.string.isRequired,data:I.default.any,style:I.default.objectOf(I.default.oneOfType([I.default.number,I.default.object])).isRequired}))]).isRequired,children:I.default.func.isRequired,willEnter:I.default.func,willLeave:I.default.func,didLeave:I.default.func},enumerable:!0},{key:"defaultProps",value:{willEnter:function(e){return h.default(e.style)},willLeave:function(){return null},didLeave:function(){}},enumerable:!0}]),t.prototype.defaultState=function(){var e=this.props,t=e.defaultStyles,n=e.styles,o=e.willEnter,r=e.willLeave,i=e.didLeave,a="function"==typeof n?n(t):n,l=void 0;l=null==t?a:t.map(function(e){for(var t=0;t<a.length;t++)if(a[t].key===e.key)return a[t];return e});var u=null==t?a.map(function(e){return h.default(e.style)}):t.map(function(e){return h.default(e.style)}),c=null==t?a.map(function(e){return p.default(e.style)}):t.map(function(e){return p.default(e.style)}),f=s(o,r,i,l,a,u,c,u,c),d=f[0],y=f[1],v=f[2],m=f[3],b=f[4];return{currentStyles:y,currentVelocities:v,lastIdealStyles:m,lastIdealVelocities:b,mergedPropsStyles:d}},t.prototype.componentDidMount=function(){this.prevTime=g.default(),this.startAnimationIfNecessary()},t.prototype.componentWillReceiveProps=function(e){this.unreadPropStyles&&this.clearUnreadPropStyle(this.unreadPropStyles);var t=e.styles;"function"==typeof t?this.unreadPropStyles=t(a(this.state.mergedPropsStyles,this.unreadPropStyles,this.state.lastIdealStyles)):this.unreadPropStyles=t,null==this.animationID&&(this.prevTime=g.default(),this.startAnimationIfNecessary())},t.prototype.componentWillUnmount=function(){this.unmounting=!0,null!=this.animationID&&(P.default.cancel(this.animationID),this.animationID=null)},t.prototype.render=function(){var e=a(this.state.mergedPropsStyles,this.unreadPropStyles,this.state.currentStyles),t=this.props.children(e);return t&&M.default.Children.only(t)},t}(M.default.Component);t.default=_,e.exports=t.default},function(e,t){"use strict";function n(e,t,n){for(var o={},r=0;r<e.length;r++)o[e[r].key]=r;for(var i={},r=0;r<t.length;r++)i[t[r].key]=r;for(var a=[],r=0;r<t.length;r++)a[r]=t[r];for(var r=0;r<e.length;r++)if(!Object.prototype.hasOwnProperty.call(i,e[r].key)){var l=n(r,e[r]);null!=l&&a.push(l)}return a.sort(function(e,n){var r=i[e.key],a=i[n.key],l=o[e.key],s=o[n.key];if(null!=r&&null!=a)return i[e.key]-i[n.key];if(null!=l&&null!=s)return o[e.key]-o[n.key];if(null!=r){for(var u=0;u<t.length;u++){var c=t[u].key;if(Object.prototype.hasOwnProperty.call(o,c)){if(r<i[c]&&s>o[c])return-1;if(r>i[c]&&s<o[c])return 1}}return 1}for(var u=0;u<t.length;u++){var c=t[u].key;if(Object.prototype.hasOwnProperty.call(o,c)){if(a<i[c]&&l>o[c])return 1;if(a>i[c]&&l<o[c])return-1}}return-1})}t.__esModule=!0,t.default=n,e.exports=t.default},function(e,t,n){"use strict";function o(){}t.__esModule=!0,t.default=o;e.exports=t.default},function(e,t,n){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){return i({},s,t,{val:e})}t.__esModule=!0;var i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e};t.default=r;var a=n(11),l=o(a),s=i({},l.default.noWobble,{precision:.01});e.exports=t.default},function(e,t,n){function o(e,t){for(var n=0;n<e.length;n++){var o=e[n],r=d[o.id];if(r){r.refs++;for(var i=0;i<r.parts.length;i++)r.parts[i](o.parts[i]);for(;i<o.parts.length;i++)r.parts.push(u(o.parts[i],t))}else{for(var a=[],i=0;i<o.parts.length;i++)a.push(u(o.parts[i],t));d[o.id]={id:o.id,refs:1,parts:a}}}}function r(e){for(var t=[],n={},o=0;o<e.length;o++){var r=e[o],i=r[0],a=r[1],l=r[2],s=r[3],u={css:a,media:l,sourceMap:s};n[i]?n[i].parts.push(u):t.push(n[i]={id:i,parts:[u]})}return t}function i(e,t){var n=v(),o=S[S.length-1];if("top"===e.insertAt)o?o.nextSibling?n.insertBefore(t,o.nextSibling):n.appendChild(t):n.insertBefore(t,n.firstChild),S.push(t);else{if("bottom"!==e.insertAt)throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");n.appendChild(t)}}function a(e){e.parentNode.removeChild(e);var t=S.indexOf(e);t>=0&&S.splice(t,1)}function l(e){var t=document.createElement("style");return t.type="text/css",i(e,t),t}function s(e){var t=document.createElement("link");return t.rel="stylesheet",i(e,t),t}function u(e,t){var n,o,r;if(t.singleton){var i=b++;n=m||(m=l(t)),o=c.bind(null,n,i,!1),r=c.bind(null,n,i,!0)}else e.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(n=s(t),o=p.bind(null,n),r=function(){a(n),n.href&&URL.revokeObjectURL(n.href)}):(n=l(t),o=f.bind(null,n),r=function(){a(n)});return o(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;o(e=t)}else r()}}function c(e,t,n,o){var r=n?"":o.css;if(e.styleSheet)e.styleSheet.cssText=g(t,r);else{var i=document.createTextNode(r),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(i,a[t]):e.appendChild(i)}}function f(e,t){var n=t.css,o=t.media;if(o&&e.setAttribute("media",o),e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}function p(e,t){var n=t.css,o=t.sourceMap;o&&(n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */");var r=new Blob([n],{type:"text/css"}),i=e.href;e.href=URL.createObjectURL(r),i&&URL.revokeObjectURL(i)}var d={},h=function(e){var t;return function(){return"undefined"==typeof t&&(t=e.apply(this,arguments)),t}},y=h(function(){return/msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())}),v=h(function(){return document.head||document.getElementsByTagName("head")[0]}),m=null,b=0,S=[];e.exports=function(e,t){t=t||{},"undefined"==typeof t.singleton&&(t.singleton=y()),"undefined"==typeof t.insertAt&&(t.insertAt="bottom");var n=r(e);return o(n,t),function(e){for(var i=[],a=0;a<n.length;a++){var l=n[a],s=d[l.id];s.refs--,i.push(s)}if(e){var u=r(e);o(u,t)}for(var a=0;a<i.length;a++){var s=i[a];if(0===s.refs){for(var c=0;c<s.parts.length;c++)s.parts[c]();delete d[s.id]}}}};var g=function(){var e=[];return function(t,n){return e[t]=n,e.filter(Boolean).join("\n")}}()},function(e,t,n){var o=n(16);"string"==typeof o&&(o=[[e.id,o,""]]);n(30)(o,{});o.locals&&(e.exports=o.locals)}])});
},{"react":6}],102:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactScrollbar = require('react-scrollbar');

var _reactScrollbar2 = _interopRequireDefault(_reactScrollbar);

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

require('./hover.sass');


function ScrolledInner(props) {
  return _react2.default.createElement(
    'div',
    { className: 'uber-grid-hover-inner' },
    _react2.default.createElement(
      _reactScrollbar2.default,
      null,
      _react2.default.createElement('div', { dangerouslySetInnerHTML: { __html: props.hover } })
    )
  );
}

function SimpleInner(props) {
  return _react2.default.createElement(
    'div',
    { className: 'uber-grid-hover-inner' },
    _react2.default.createElement('div', { dangerouslySetInnerHTML: { __html: props.hover } })
  );
}

function shouldUseScrolled(classes) {
  return !!(0, _arrayPrototype2.default)(classes, function (klass) {
    return !!(0, _arrayPrototype2.default)(['uber-grid-hover-position-center', 'uber-grid-hover-position-top-left', 'uber-grid-hover-position-top-right', 'uber-grid-hover-position-top-center'], function (klass2) {
      return klass2 === klass;
    });
  });
}

exports.default = function (props) {
  return _react2.default.createElement(
    'div',
    { className: props.hoverClasses, onClick: props.onClick },
    !shouldUseScrolled(props.hoverClasses) ? _react2.default.createElement(SimpleInner, props) : null,
    shouldUseScrolled(props.hoverClasses) ? _react2.default.createElement(ScrolledInner, props) : null
  );
};
},{"./hover.sass":113,"react":6,"react-scrollbar":78,"array.prototype.find":9}],244:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

exports.valign = valign;
exports.halign = halign;
exports.align = align;
exports.fit = fit;
exports.fill = fill;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function aspect(thing) {
  return thing.width / thing.height;
}
var prop = function prop(path) {
  return function (object) {
    return object[path];
  };
};
function resize(container, content, decision) {
  if (decision(aspect(container), aspect(content))) {
    return fitWidth(container, content);
  }
  return fitHeight(container, content);
}

function getHeight(container, content) {
  return container.width / aspect(content);
}

function getWidth(container, content) {
  return container.height * aspect(content);
}

function fitWidth(container, content) {
  return {
    width: container.width,
    height: getHeight(container, content)
  };
}

function fitHeight(container, content) {
  return {
    height: container.height,
    width: getWidth(container, content)
  };
}

function center(container, size, param, accessor) {
  return _extends({}, size, _defineProperty({}, param, (accessor(container) - accessor(size)) / 2));
}
function valign(container, size) {
  return center(container, size, 'top', prop('height'));
}

function halign(container, size) {
  return center(container, size, 'left', prop('width'));
}

function align(container, size) {
  if (!container || !size) {
    return null;
  }
  if (size.width > container.width) {
    return valign(container, size);
  }

  return halign(container, size);
}

function fit(container, content) {
  return resize(container, content, function (container, content) {
    return container < content;
  });
}

function fill(container, content) {
  return resize(container, content, function (container, content) {
    return container > content;
  });
}
},{}],166:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _calc = require('./src/calc');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _objectWithoutProperties(obj, keys) { var target = {}; for (var i in obj) { if (keys.indexOf(i) >= 0) continue; if (!Object.prototype.hasOwnProperty.call(obj, i)) continue; target[i] = obj[i]; } return target; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

function getImageStyle(container, size, opt) {
  if (!(container.height && size)) {
    return;
  }
  var func = opt.fit ? _calc.fit : _calc.fill;
  size = func(container, size);
  if (opt.valign) {
    size = (0, _calc.valign)(container, size);
  }
  if (opt.halign) {
    size = (0, _calc.halign)(container, size);
  }
  return size;
}

var Fit = function (_React$Component) {
  _inherits(Fit, _React$Component);

  function Fit(props) {
    _classCallCheck(this, Fit);

    var _this = _possibleConstructorReturn(this, (Fit.__proto__ || Object.getPrototypeOf(Fit)).call(this, props));

    _this.state = {
      width: null,
      height: null
    };
    _this.measure = _this.measure.bind(_this);
    _this.onLoad = _this.onLoad.bind(_this);
    return _this;
  }

  _createClass(Fit, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      window.addEventListener('resize', this.measure);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.measure);
    }
  }, {
    key: 'componentWillUpdate',
    value: function componentWillUpdate(nextProps, nextState) {
      if (nextProps.src !== this.props.src) {
        this.setState({ image: null });
      }
    }
  }, {
    key: 'measure',
    value: function measure() {
      var node = _reactDom2.default.findDOMNode(this);
      this.setState({
        width: node.clientWidth,
        height: node.clientHeight
      });
    }
  }, {
    key: 'onLoad',
    value: function onLoad(e) {
      this.measure();
      this.setState({
        image: {
          width: e.target.naturalWidth,
          height: e.target.naturalHeight
        }
      });
      if (this.props.onLoad) {
        this.props.onLoad(e);
      }
    }
  }, {
    key: 'render',
    value: function render() {
      var state = this.state;

      var _props = this.props,
          className = _props.className,
          fit = _props.fit,
          component = _props.component,
          valign = _props.valign,
          halign = _props.halign,
          props = _objectWithoutProperties(_props, ['className', 'fit', 'component', 'valign', 'halign']);

      return _react2.default.createElement(
        'div',
        { className: className },
        _react2.default.createElement(component, _extends({}, props, {
          style: getImageStyle(state, state.image, { fit: fit, valign: valign, halign: halign }),
          onLoad: this.onLoad
        }))
      );
    }
  }]);

  return Fit;
}(_react2.default.Component);

exports.default = Fit;


Fit.defaultProps = {
  fit: false,
  className: 'fit',
  component: 'img',
  valign: true,
  halign: true
};
},{"react":6,"react-dom":6,"./src/calc":244}],103:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _getPrototypeOf = require('babel-runtime/core-js/object/get-prototype-of');

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require('babel-runtime/helpers/possibleConstructorReturn');

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require('babel-runtime/helpers/inherits');

var _inherits3 = _interopRequireDefault(_inherits2);

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _fitFill = require('fit-fill');

var _fitFill2 = _interopRequireDefault(_fitFill);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

var _reactScrollbar = require('react-scrollbar');

var _reactScrollbar2 = _interopRequireDefault(_reactScrollbar);

require('react-scrollbar/dist/css/scrollArea.css');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

require('./content.sass');


function getLinkAttr(attr, props) {
  return (0, _extends3.default)({}, attr, {
    href: props.url,
    target: props.target
  });
}

function isText(text) {
  return text && text.trim();
}
function useScrollbar(title) {
  return title && title.position && !!title.position.match(/top\-/);
}

var Content = function (_React$Component) {
  (0, _inherits3.default)(Content, _React$Component);

  function Content() {
    (0, _classCallCheck3.default)(this, Content);
    return (0, _possibleConstructorReturn3.default)(this, (Content.__proto__ || (0, _getPrototypeOf2.default)(Content)).apply(this, arguments));
  }

  (0, _createClass3.default)(Content, [{
    key: 'shouldComponentUpdate',
    value: function shouldComponentUpdate() {
      return false;
    }
  }, {
    key: 'render',
    value: function render() {
      var props = this.props;
      var component = props.url && false ? 'a' : 'div';
      var attr = {
        className: 'uber-grid-cell-content'
      };
      if (component === 'a') {
        attr = getLinkAttr(attr, props);
      }
      attr.style = {
        width: props.size.width + "px",
        height: props.size.height + "px"
      };

      return _react2.default.createElement(
        'div',
        { className: 'uber-grid-cell-content', onClick: props.onClick },
        props.image ? _react2.default.createElement(_fitFill2.default, { src: props.image, className: 'uber-grid-cell-image', fit: false,
          alt: props.alt }) : null,
        props.title && isText(props.title.html) ? _react2.default.createElement(
          'div',
          { className: (0, _classnames2.default)('uber-grid-cell-title-wrapper', "uber-grid-position-" + props.title.position) },
          useScrollbar(props.title) ? _react2.default.createElement(
            _reactScrollbar2.default,
            { className: 'uber-grid-cell-title' },
            _react2.default.createElement('div', { dangerouslySetInnerHTML: { __html: props.title.html } })
          ) : null,
          !useScrollbar(props.title) ? _react2.default.createElement('div', { className: 'uber-grid-cell-title',
            dangerouslySetInnerHTML: { __html: props.title.html } }) : null
        ) : null
      );
    }
  }]);
  return Content;
}(_react2.default.Component);

exports.default = Content;
},{"babel-runtime/core-js/object/get-prototype-of":39,"babel-runtime/helpers/classCallCheck":40,"babel-runtime/helpers/createClass":42,"babel-runtime/helpers/possibleConstructorReturn":41,"babel-runtime/helpers/inherits":43,"babel-runtime/helpers/extends":27,"./content.sass":113,"react":6,"fit-fill":166,"classnames":122,"react-scrollbar":78,"react-scrollbar/dist/css/scrollArea.css":113}],104:[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require("react");

var _react2 = _interopRequireDefault(_react);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = function (props) {
  return _react2.default.createElement("div", { className: "uber-grid-cell-label",
    dangerouslySetInnerHTML: { __html: props.label } });
};
},{"react":6}],272:[function(require,module,exports) {
"use strict";

/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * 
 */

function makeEmptyFunction(arg) {
  return function () {
    return arg;
  };
}

/**
 * This function accepts and discards inputs; it has no side effects. This is
 * primarily useful idiomatically for overridable function endpoints which
 * always need to be callable, since JS lacks a null-call idiom ala Cocoa.
 */
var emptyFunction = function emptyFunction() {};

emptyFunction.thatReturns = makeEmptyFunction;
emptyFunction.thatReturnsFalse = makeEmptyFunction(false);
emptyFunction.thatReturnsTrue = makeEmptyFunction(true);
emptyFunction.thatReturnsNull = makeEmptyFunction(null);
emptyFunction.thatReturnsThis = function () {
  return this;
};
emptyFunction.thatReturnsArgument = function (arg) {
  return arg;
};

module.exports = emptyFunction;
},{}],273:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */

'use strict';

/**
 * Use invariant() to assert state which your program assumes to be true.
 *
 * Provide sprintf-style format (only %s is supported) and arguments
 * to provide information about what broke and what you were
 * expecting.
 *
 * The invariant message will be stripped in production, but the invariant
 * will remain to ensure logic does not differ in production.
 */

var validateFormat = function validateFormat(format) {};

if ('production' !== 'production') {
  validateFormat = function validateFormat(format) {
    if (format === undefined) {
      throw new Error('invariant requires an error message argument');
    }
  };
}

function invariant(condition, format, a, b, c, d, e, f) {
  validateFormat(format);

  if (!condition) {
    var error;
    if (format === undefined) {
      error = new Error('Minified exception occurred; use the non-minified dev environment ' + 'for the full error message and additional helpful warnings.');
    } else {
      var args = [a, b, c, d, e, f];
      var argIndex = 0;
      error = new Error(format.replace(/%s/g, function () {
        return args[argIndex++];
      }));
      error.name = 'Invariant Violation';
    }

    error.framesToPop = 1; // we don't care about invariant's own frame
    throw error;
  }
}

module.exports = invariant;
},{}],275:[function(require,module,exports) {
/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */

'use strict';

var emptyFunction = require('./emptyFunction');

/**
 * Similar to invariant but only logs a warning if the condition is not met.
 * This can be used to log issues in development environments in critical
 * paths. Removing the logging code for production environments will keep the
 * same logic and follow the same code paths.
 */

var warning = emptyFunction;

if ('production' !== 'production') {
  var printWarning = function printWarning(format) {
    for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    var argIndex = 0;
    var message = 'Warning: ' + format.replace(/%s/g, function () {
      return args[argIndex++];
    });
    if (typeof console !== 'undefined') {
      console.error(message);
    }
    try {
      // --- Welcome to debugging React ---
      // This error was thrown as a convenience so that you can use this stack
      // to find the callsite that caused this warning to fire.
      throw new Error(message);
    } catch (x) {}
  };

  warning = function warning(condition, format) {
    if (format === undefined) {
      throw new Error('`warning(condition, format, ...args)` requires a warning ' + 'message argument');
    }

    if (format.indexOf('Failed Composite propType: ') === 0) {
      return; // Ignore CompositeComponent proptype check.
    }

    if (!condition) {
      for (var _len2 = arguments.length, args = Array(_len2 > 2 ? _len2 - 2 : 0), _key2 = 2; _key2 < _len2; _key2++) {
        args[_key2 - 2] = arguments[_key2];
      }

      printWarning.apply(undefined, [format].concat(args));
    }
  };
}

module.exports = warning;
},{"./emptyFunction":272}],276:[function(require,module,exports) {
/*
object-assign
(c) Sindre Sorhus
@license MIT
*/

'use strict';
/* eslint-disable no-unused-vars */

var getOwnPropertySymbols = Object.getOwnPropertySymbols;
var hasOwnProperty = Object.prototype.hasOwnProperty;
var propIsEnumerable = Object.prototype.propertyIsEnumerable;

function toObject(val) {
	if (val === null || val === undefined) {
		throw new TypeError('Object.assign cannot be called with null or undefined');
	}

	return Object(val);
}

function shouldUseNative() {
	try {
		if (!Object.assign) {
			return false;
		}

		// Detect buggy property enumeration order in older V8 versions.

		// https://bugs.chromium.org/p/v8/issues/detail?id=4118
		var test1 = new String('abc'); // eslint-disable-line no-new-wrappers
		test1[5] = 'de';
		if (Object.getOwnPropertyNames(test1)[0] === '5') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test2 = {};
		for (var i = 0; i < 10; i++) {
			test2['_' + String.fromCharCode(i)] = i;
		}
		var order2 = Object.getOwnPropertyNames(test2).map(function (n) {
			return test2[n];
		});
		if (order2.join('') !== '0123456789') {
			return false;
		}

		// https://bugs.chromium.org/p/v8/issues/detail?id=3056
		var test3 = {};
		'abcdefghijklmnopqrst'.split('').forEach(function (letter) {
			test3[letter] = letter;
		});
		if (Object.keys(Object.assign({}, test3)).join('') !== 'abcdefghijklmnopqrst') {
			return false;
		}

		return true;
	} catch (err) {
		// We don't expect any of the above to throw, but better to be safe.
		return false;
	}
}

module.exports = shouldUseNative() ? Object.assign : function (target, source) {
	var from;
	var to = toObject(target);
	var symbols;

	for (var s = 1; s < arguments.length; s++) {
		from = Object(arguments[s]);

		for (var key in from) {
			if (hasOwnProperty.call(from, key)) {
				to[key] = from[key];
			}
		}

		if (getOwnPropertySymbols) {
			symbols = getOwnPropertySymbols(from);
			for (var i = 0; i < symbols.length; i++) {
				if (propIsEnumerable.call(from, symbols[i])) {
					to[symbols[i]] = from[symbols[i]];
				}
			}
		}
	}

	return to;
};
},{}],271:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

'use strict';

var ReactPropTypesSecret = 'SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED';

module.exports = ReactPropTypesSecret;

},{}],274:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

'use strict';

if ('production' !== 'production') {
  var invariant = require('fbjs/lib/invariant');
  var warning = require('fbjs/lib/warning');
  var ReactPropTypesSecret = require('./lib/ReactPropTypesSecret');
  var loggedTypeFailures = {};
}

/**
 * Assert that the values match with the type specs.
 * Error messages are memorized and will only be shown once.
 *
 * @param {object} typeSpecs Map of name to a ReactPropType
 * @param {object} values Runtime values that need to be type-checked
 * @param {string} location e.g. "prop", "context", "child context"
 * @param {string} componentName Name of the component for error messages.
 * @param {?Function} getStack Returns the component stack.
 * @private
 */
function checkPropTypes(typeSpecs, values, location, componentName, getStack) {
  if ('production' !== 'production') {
    for (var typeSpecName in typeSpecs) {
      if (typeSpecs.hasOwnProperty(typeSpecName)) {
        var error;
        // Prop type validation may throw. In case they do, we don't want to
        // fail the render phase where it didn't fail before. So we log it.
        // After these have been cleaned up, we'll let them throw.
        try {
          // This is intentionally an invariant that gets caught. It's the same
          // behavior as without this statement except with a better message.
          invariant(typeof typeSpecs[typeSpecName] === 'function', '%s: %s type `%s` is invalid; it must be a function, usually from ' + 'the `prop-types` package, but received `%s`.', componentName || 'React class', location, typeSpecName, typeof typeSpecs[typeSpecName]);
          error = typeSpecs[typeSpecName](values, typeSpecName, componentName, location, null, ReactPropTypesSecret);
        } catch (ex) {
          error = ex;
        }
        warning(!error || error instanceof Error, '%s: type specification of %s `%s` is invalid; the type checker ' + 'function must return `null` or an `Error` but returned a %s. ' + 'You may have forgotten to pass an argument to the type checker ' + 'creator (arrayOf, instanceOf, objectOf, oneOf, oneOfType, and ' + 'shape all require an argument).', componentName || 'React class', location, typeSpecName, typeof error);
        if (error instanceof Error && !(error.message in loggedTypeFailures)) {
          // Only monitor this failure once because there tends to be a lot of the
          // same error.
          loggedTypeFailures[error.message] = true;

          var stack = getStack ? getStack() : '';

          warning(false, 'Failed %s type: %s%s', location, error.message, stack != null ? stack : '');
        }
      }
    }
  }
}

module.exports = checkPropTypes;
},{"fbjs/lib/invariant":273,"fbjs/lib/warning":275,"./lib/ReactPropTypesSecret":271}],245:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

'use strict';

var emptyFunction = require('fbjs/lib/emptyFunction');
var invariant = require('fbjs/lib/invariant');
var warning = require('fbjs/lib/warning');
var assign = require('object-assign');

var ReactPropTypesSecret = require('./lib/ReactPropTypesSecret');
var checkPropTypes = require('./checkPropTypes');

module.exports = function (isValidElement, throwOnDirectAccess) {
  /* global Symbol */
  var ITERATOR_SYMBOL = typeof Symbol === 'function' && Symbol.iterator;
  var FAUX_ITERATOR_SYMBOL = '@@iterator'; // Before Symbol spec.

  /**
   * Returns the iterator method function contained on the iterable object.
   *
   * Be sure to invoke the function with the iterable as context:
   *
   *     var iteratorFn = getIteratorFn(myIterable);
   *     if (iteratorFn) {
   *       var iterator = iteratorFn.call(myIterable);
   *       ...
   *     }
   *
   * @param {?object} maybeIterable
   * @return {?function}
   */
  function getIteratorFn(maybeIterable) {
    var iteratorFn = maybeIterable && (ITERATOR_SYMBOL && maybeIterable[ITERATOR_SYMBOL] || maybeIterable[FAUX_ITERATOR_SYMBOL]);
    if (typeof iteratorFn === 'function') {
      return iteratorFn;
    }
  }

  /**
   * Collection of methods that allow declaration and validation of props that are
   * supplied to React components. Example usage:
   *
   *   var Props = require('ReactPropTypes');
   *   var MyArticle = React.createClass({
   *     propTypes: {
   *       // An optional string prop named "description".
   *       description: Props.string,
   *
   *       // A required enum prop named "category".
   *       category: Props.oneOf(['News','Photos']).isRequired,
   *
   *       // A prop named "dialog" that requires an instance of Dialog.
   *       dialog: Props.instanceOf(Dialog).isRequired
   *     },
   *     render: function() { ... }
   *   });
   *
   * A more formal specification of how these methods are used:
   *
   *   type := array|bool|func|object|number|string|oneOf([...])|instanceOf(...)
   *   decl := ReactPropTypes.{type}(.isRequired)?
   *
   * Each and every declaration produces a function with the same signature. This
   * allows the creation of custom validation functions. For example:
   *
   *  var MyLink = React.createClass({
   *    propTypes: {
   *      // An optional string or URI prop named "href".
   *      href: function(props, propName, componentName) {
   *        var propValue = props[propName];
   *        if (propValue != null && typeof propValue !== 'string' &&
   *            !(propValue instanceof URI)) {
   *          return new Error(
   *            'Expected a string or an URI for ' + propName + ' in ' +
   *            componentName
   *          );
   *        }
   *      }
   *    },
   *    render: function() {...}
   *  });
   *
   * @internal
   */

  var ANONYMOUS = '<<anonymous>>';

  // Important!
  // Keep this list in sync with production version in `./factoryWithThrowingShims.js`.
  var ReactPropTypes = {
    array: createPrimitiveTypeChecker('array'),
    bool: createPrimitiveTypeChecker('boolean'),
    func: createPrimitiveTypeChecker('function'),
    number: createPrimitiveTypeChecker('number'),
    object: createPrimitiveTypeChecker('object'),
    string: createPrimitiveTypeChecker('string'),
    symbol: createPrimitiveTypeChecker('symbol'),

    any: createAnyTypeChecker(),
    arrayOf: createArrayOfTypeChecker,
    element: createElementTypeChecker(),
    instanceOf: createInstanceTypeChecker,
    node: createNodeChecker(),
    objectOf: createObjectOfTypeChecker,
    oneOf: createEnumTypeChecker,
    oneOfType: createUnionTypeChecker,
    shape: createShapeTypeChecker,
    exact: createStrictShapeTypeChecker
  };

  /**
   * inlined Object.is polyfill to avoid requiring consumers ship their own
   * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/is
   */
  /*eslint-disable no-self-compare*/
  function is(x, y) {
    // SameValue algorithm
    if (x === y) {
      // Steps 1-5, 7-10
      // Steps 6.b-6.e: +0 != -0
      return x !== 0 || 1 / x === 1 / y;
    } else {
      // Step 6.a: NaN == NaN
      return x !== x && y !== y;
    }
  }
  /*eslint-enable no-self-compare*/

  /**
   * We use an Error-like object for backward compatibility as people may call
   * PropTypes directly and inspect their output. However, we don't use real
   * Errors anymore. We don't inspect their stack anyway, and creating them
   * is prohibitively expensive if they are created too often, such as what
   * happens in oneOfType() for any type before the one that matched.
   */
  function PropTypeError(message) {
    this.message = message;
    this.stack = '';
  }
  // Make `instanceof Error` still work for returned errors.
  PropTypeError.prototype = Error.prototype;

  function createChainableTypeChecker(validate) {
    if ('production' !== 'production') {
      var manualPropTypeCallCache = {};
      var manualPropTypeWarningCount = 0;
    }
    function checkType(isRequired, props, propName, componentName, location, propFullName, secret) {
      componentName = componentName || ANONYMOUS;
      propFullName = propFullName || propName;

      if (secret !== ReactPropTypesSecret) {
        if (throwOnDirectAccess) {
          // New behavior only for users of `prop-types` package
          invariant(false, 'Calling PropTypes validators directly is not supported by the `prop-types` package. ' + 'Use `PropTypes.checkPropTypes()` to call them. ' + 'Read more at http://fb.me/use-check-prop-types');
        } else if ('production' !== 'production' && typeof console !== 'undefined') {
          // Old behavior for people using React.PropTypes
          var cacheKey = componentName + ':' + propName;
          if (!manualPropTypeCallCache[cacheKey] &&
          // Avoid spamming the console because they are often not actionable except for lib authors
          manualPropTypeWarningCount < 3) {
            warning(false, 'You are manually calling a React.PropTypes validation ' + 'function for the `%s` prop on `%s`. This is deprecated ' + 'and will throw in the standalone `prop-types` package. ' + 'You may be seeing this warning due to a third-party PropTypes ' + 'library. See https://fb.me/react-warning-dont-call-proptypes ' + 'for details.', propFullName, componentName);
            manualPropTypeCallCache[cacheKey] = true;
            manualPropTypeWarningCount++;
          }
        }
      }
      if (props[propName] == null) {
        if (isRequired) {
          if (props[propName] === null) {
            return new PropTypeError('The ' + location + ' `' + propFullName + '` is marked as required ' + ('in `' + componentName + '`, but its value is `null`.'));
          }
          return new PropTypeError('The ' + location + ' `' + propFullName + '` is marked as required in ' + ('`' + componentName + '`, but its value is `undefined`.'));
        }
        return null;
      } else {
        return validate(props, propName, componentName, location, propFullName);
      }
    }

    var chainedCheckType = checkType.bind(null, false);
    chainedCheckType.isRequired = checkType.bind(null, true);

    return chainedCheckType;
  }

  function createPrimitiveTypeChecker(expectedType) {
    function validate(props, propName, componentName, location, propFullName, secret) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== expectedType) {
        // `propValue` being instance of, say, date/regexp, pass the 'object'
        // check, but we can offer a more precise error message here rather than
        // 'of type `object`'.
        var preciseType = getPreciseType(propValue);

        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + preciseType + '` supplied to `' + componentName + '`, expected ') + ('`' + expectedType + '`.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createAnyTypeChecker() {
    return createChainableTypeChecker(emptyFunction.thatReturnsNull);
  }

  function createArrayOfTypeChecker(typeChecker) {
    function validate(props, propName, componentName, location, propFullName) {
      if (typeof typeChecker !== 'function') {
        return new PropTypeError('Property `' + propFullName + '` of component `' + componentName + '` has invalid PropType notation inside arrayOf.');
      }
      var propValue = props[propName];
      if (!Array.isArray(propValue)) {
        var propType = getPropType(propValue);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected an array.'));
      }
      for (var i = 0; i < propValue.length; i++) {
        var error = typeChecker(propValue, i, componentName, location, propFullName + '[' + i + ']', ReactPropTypesSecret);
        if (error instanceof Error) {
          return error;
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createElementTypeChecker() {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      if (!isValidElement(propValue)) {
        var propType = getPropType(propValue);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected a single ReactElement.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createInstanceTypeChecker(expectedClass) {
    function validate(props, propName, componentName, location, propFullName) {
      if (!(props[propName] instanceof expectedClass)) {
        var expectedClassName = expectedClass.name || ANONYMOUS;
        var actualClassName = getClassName(props[propName]);
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + actualClassName + '` supplied to `' + componentName + '`, expected ') + ('instance of `' + expectedClassName + '`.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createEnumTypeChecker(expectedValues) {
    if (!Array.isArray(expectedValues)) {
      'production' !== 'production' ? warning(false, 'Invalid argument supplied to oneOf, expected an instance of array.') : void 0;
      return emptyFunction.thatReturnsNull;
    }

    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      for (var i = 0; i < expectedValues.length; i++) {
        if (is(propValue, expectedValues[i])) {
          return null;
        }
      }

      var valuesString = JSON.stringify(expectedValues);
      return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of value `' + propValue + '` ' + ('supplied to `' + componentName + '`, expected one of ' + valuesString + '.'));
    }
    return createChainableTypeChecker(validate);
  }

  function createObjectOfTypeChecker(typeChecker) {
    function validate(props, propName, componentName, location, propFullName) {
      if (typeof typeChecker !== 'function') {
        return new PropTypeError('Property `' + propFullName + '` of component `' + componentName + '` has invalid PropType notation inside objectOf.');
      }
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type ' + ('`' + propType + '` supplied to `' + componentName + '`, expected an object.'));
      }
      for (var key in propValue) {
        if (propValue.hasOwnProperty(key)) {
          var error = typeChecker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
          if (error instanceof Error) {
            return error;
          }
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createUnionTypeChecker(arrayOfTypeCheckers) {
    if (!Array.isArray(arrayOfTypeCheckers)) {
      'production' !== 'production' ? warning(false, 'Invalid argument supplied to oneOfType, expected an instance of array.') : void 0;
      return emptyFunction.thatReturnsNull;
    }

    for (var i = 0; i < arrayOfTypeCheckers.length; i++) {
      var checker = arrayOfTypeCheckers[i];
      if (typeof checker !== 'function') {
        warning(false, 'Invalid argument supplied to oneOfType. Expected an array of check functions, but ' + 'received %s at index %s.', getPostfixForTypeWarning(checker), i);
        return emptyFunction.thatReturnsNull;
      }
    }

    function validate(props, propName, componentName, location, propFullName) {
      for (var i = 0; i < arrayOfTypeCheckers.length; i++) {
        var checker = arrayOfTypeCheckers[i];
        if (checker(props, propName, componentName, location, propFullName, ReactPropTypesSecret) == null) {
          return null;
        }
      }

      return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` supplied to ' + ('`' + componentName + '`.'));
    }
    return createChainableTypeChecker(validate);
  }

  function createNodeChecker() {
    function validate(props, propName, componentName, location, propFullName) {
      if (!isNode(props[propName])) {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` supplied to ' + ('`' + componentName + '`, expected a ReactNode.'));
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createShapeTypeChecker(shapeTypes) {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type `' + propType + '` ' + ('supplied to `' + componentName + '`, expected `object`.'));
      }
      for (var key in shapeTypes) {
        var checker = shapeTypes[key];
        if (!checker) {
          continue;
        }
        var error = checker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
        if (error) {
          return error;
        }
      }
      return null;
    }
    return createChainableTypeChecker(validate);
  }

  function createStrictShapeTypeChecker(shapeTypes) {
    function validate(props, propName, componentName, location, propFullName) {
      var propValue = props[propName];
      var propType = getPropType(propValue);
      if (propType !== 'object') {
        return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` of type `' + propType + '` ' + ('supplied to `' + componentName + '`, expected `object`.'));
      }
      // We need to check all keys in case some are required but missing from
      // props.
      var allKeys = assign({}, props[propName], shapeTypes);
      for (var key in allKeys) {
        var checker = shapeTypes[key];
        if (!checker) {
          return new PropTypeError('Invalid ' + location + ' `' + propFullName + '` key `' + key + '` supplied to `' + componentName + '`.' + '\nBad object: ' + JSON.stringify(props[propName], null, '  ') + '\nValid keys: ' + JSON.stringify(Object.keys(shapeTypes), null, '  '));
        }
        var error = checker(propValue, key, componentName, location, propFullName + '.' + key, ReactPropTypesSecret);
        if (error) {
          return error;
        }
      }
      return null;
    }

    return createChainableTypeChecker(validate);
  }

  function isNode(propValue) {
    switch (typeof propValue) {
      case 'number':
      case 'string':
      case 'undefined':
        return true;
      case 'boolean':
        return !propValue;
      case 'object':
        if (Array.isArray(propValue)) {
          return propValue.every(isNode);
        }
        if (propValue === null || isValidElement(propValue)) {
          return true;
        }

        var iteratorFn = getIteratorFn(propValue);
        if (iteratorFn) {
          var iterator = iteratorFn.call(propValue);
          var step;
          if (iteratorFn !== propValue.entries) {
            while (!(step = iterator.next()).done) {
              if (!isNode(step.value)) {
                return false;
              }
            }
          } else {
            // Iterator will provide entry [k,v] tuples rather than values.
            while (!(step = iterator.next()).done) {
              var entry = step.value;
              if (entry) {
                if (!isNode(entry[1])) {
                  return false;
                }
              }
            }
          }
        } else {
          return false;
        }

        return true;
      default:
        return false;
    }
  }

  function isSymbol(propType, propValue) {
    // Native Symbol.
    if (propType === 'symbol') {
      return true;
    }

    // 19.4.3.5 Symbol.prototype[@@toStringTag] === 'Symbol'
    if (propValue['@@toStringTag'] === 'Symbol') {
      return true;
    }

    // Fallback for non-spec compliant Symbols which are polyfilled.
    if (typeof Symbol === 'function' && propValue instanceof Symbol) {
      return true;
    }

    return false;
  }

  // Equivalent of `typeof` but with special handling for array and regexp.
  function getPropType(propValue) {
    var propType = typeof propValue;
    if (Array.isArray(propValue)) {
      return 'array';
    }
    if (propValue instanceof RegExp) {
      // Old webkits (at least until Android 4.0) return 'function' rather than
      // 'object' for typeof a RegExp. We'll normalize this here so that /bla/
      // passes PropTypes.object.
      return 'object';
    }
    if (isSymbol(propType, propValue)) {
      return 'symbol';
    }
    return propType;
  }

  // This handles more types than `getPropType`. Only used for error messages.
  // See `createPrimitiveTypeChecker`.
  function getPreciseType(propValue) {
    if (typeof propValue === 'undefined' || propValue === null) {
      return '' + propValue;
    }
    var propType = getPropType(propValue);
    if (propType === 'object') {
      if (propValue instanceof Date) {
        return 'date';
      } else if (propValue instanceof RegExp) {
        return 'regexp';
      }
    }
    return propType;
  }

  // Returns a string that is postfixed to a warning about an invalid type.
  // For example, "undefined" or "of type array"
  function getPostfixForTypeWarning(value) {
    var type = getPreciseType(value);
    switch (type) {
      case 'array':
      case 'object':
        return 'an ' + type;
      case 'boolean':
      case 'date':
      case 'regexp':
        return 'a ' + type;
      default:
        return type;
    }
  }

  // Returns class name of the object, if any.
  function getClassName(propValue) {
    if (!propValue.constructor || !propValue.constructor.name) {
      return ANONYMOUS;
    }
    return propValue.constructor.name;
  }

  ReactPropTypes.checkPropTypes = checkPropTypes;
  ReactPropTypes.PropTypes = ReactPropTypes;

  return ReactPropTypes;
};
},{"fbjs/lib/emptyFunction":272,"fbjs/lib/invariant":273,"fbjs/lib/warning":275,"object-assign":276,"./lib/ReactPropTypesSecret":271,"./checkPropTypes":274}],246:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

'use strict';

var emptyFunction = require('fbjs/lib/emptyFunction');
var invariant = require('fbjs/lib/invariant');
var ReactPropTypesSecret = require('./lib/ReactPropTypesSecret');

module.exports = function() {
  function shim(props, propName, componentName, location, propFullName, secret) {
    if (secret === ReactPropTypesSecret) {
      // It is still safe when called from React.
      return;
    }
    invariant(
      false,
      'Calling PropTypes validators directly is not supported by the `prop-types` package. ' +
      'Use PropTypes.checkPropTypes() to call them. ' +
      'Read more at http://fb.me/use-check-prop-types'
    );
  };
  shim.isRequired = shim;
  function getShim() {
    return shim;
  };
  // Important!
  // Keep this list in sync with production version in `./factoryWithTypeCheckers.js`.
  var ReactPropTypes = {
    array: shim,
    bool: shim,
    func: shim,
    number: shim,
    object: shim,
    string: shim,
    symbol: shim,

    any: shim,
    arrayOf: getShim,
    element: shim,
    instanceOf: getShim,
    node: shim,
    objectOf: getShim,
    oneOf: getShim,
    oneOfType: getShim,
    shape: getShim,
    exact: getShim
  };

  ReactPropTypes.checkPropTypes = emptyFunction;
  ReactPropTypes.PropTypes = ReactPropTypes;

  return ReactPropTypes;
};

},{"fbjs/lib/emptyFunction":272,"fbjs/lib/invariant":273,"./lib/ReactPropTypesSecret":271}],185:[function(require,module,exports) {
/**
 * Copyright (c) 2013-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

if ('production' !== 'production') {
  var REACT_ELEMENT_TYPE = typeof Symbol === 'function' && Symbol.for && Symbol.for('react.element') || 0xeac7;

  var isValidElement = function (object) {
    return typeof object === 'object' && object !== null && object.$$typeof === REACT_ELEMENT_TYPE;
  };

  // By explicitly using `prop-types` you are opting into new development behavior.
  // http://fb.me/prop-types-in-prod
  var throwOnDirectAccess = true;
  module.exports = require('./factoryWithTypeCheckers')(isValidElement, throwOnDirectAccess);
} else {
  // By explicitly using `prop-types` you are opting into new production behavior.
  // http://fb.me/prop-types-in-prod
  module.exports = require('./factoryWithThrowingShims')();
}
},{"./factoryWithTypeCheckers":245,"./factoryWithThrowingShims":246}],140:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _objectWithoutProperties(obj, keys) { var target = {}; for (var i in obj) { if (keys.indexOf(i) >= 0) continue; if (!Object.prototype.hasOwnProperty.call(obj, i)) continue; target[i] = obj[i]; } return target; }

var IconBase = function IconBase(_ref, _ref2) {
  var children = _ref.children;
  var color = _ref.color;
  var size = _ref.size;
  var style = _ref.style;
  var width = _ref.width;
  var height = _ref.height;

  var props = _objectWithoutProperties(_ref, ['children', 'color', 'size', 'style', 'width', 'height']);

  var _ref2$reactIconBase = _ref2.reactIconBase;
  var reactIconBase = _ref2$reactIconBase === undefined ? {} : _ref2$reactIconBase;

  var computedSize = size || reactIconBase.size || '1em';
  return _react2.default.createElement('svg', _extends({
    children: children,
    fill: 'currentColor',
    preserveAspectRatio: 'xMidYMid meet',
    height: height || computedSize,
    width: width || computedSize
  }, reactIconBase, props, {
    style: _extends({
      verticalAlign: 'middle',
      color: color || reactIconBase.color
    }, reactIconBase.style || {}, style)
  }));
};

IconBase.propTypes = {
  color: _propTypes2.default.string,
  size: _propTypes2.default.oneOfType([_propTypes2.default.string, _propTypes2.default.number]),
  width: _propTypes2.default.oneOfType([_propTypes2.default.string, _propTypes2.default.number]),
  height: _propTypes2.default.oneOfType([_propTypes2.default.string, _propTypes2.default.number]),
  style: _propTypes2.default.object
};

IconBase.contextTypes = {
  reactIconBase: _propTypes2.default.shape(IconBase.propTypes)
};

exports.default = IconBase;
module.exports = exports['default'];
},{"react":6,"prop-types":185}],92:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaFacebook = function FaFacebook(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm29.4 0.3v5.9h-3.5q-1.9 0-2.6 0.8t-0.7 2.4v4.2h6.6l-0.9 6.6h-5.7v16.9h-6.8v-16.9h-5.7v-6.6h5.7v-4.9q0-4.1 2.3-6.4t6.2-2.3q3.3 0 5.1 0.3z' })
        )
    );
};

exports.default = FaFacebook;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],81:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaTwitter = function FaTwitter(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm37.7 9.1q-1.5 2.2-3.7 3.7 0.1 0.3 0.1 1 0 2.9-0.9 5.8t-2.6 5.5-4.1 4.7-5.7 3.3-7.2 1.2q-6.1 0-11.1-3.3 0.8 0.1 1.7 0.1 5 0 9-3-2.4-0.1-4.2-1.5t-2.6-3.5q0.8 0.1 1.4 0.1 1 0 1.9-0.3-2.5-0.5-4.1-2.5t-1.7-4.6v0q1.5 0.8 3.3 0.9-1.5-1-2.4-2.6t-0.8-3.4q0-2 0.9-3.7 2.7 3.4 6.6 5.4t8.3 2.2q-0.2-0.9-0.2-1.7 0-3 2.1-5.1t5.1-2.1q3.2 0 5.3 2.3 2.4-0.5 4.6-1.7-0.8 2.5-3.2 3.9 2.1-0.2 4.2-1.1z' })
        )
    );
};

exports.default = FaTwitter;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],93:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaGooglePlus = function FaGooglePlus(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm25.2 20.3q0 3.6-1.6 6.5t-4.3 4.4-6.5 1.6q-2.6 0-5-1t-4.1-2.7-2.7-4.1-1-5 1-5 2.7-4.1 4.1-2.7 5-1q5 0 8.6 3.3l-3.5 3.4q-2-2-5.1-2-2.1 0-4 1.1t-2.8 2.9-1.1 4.1 1.1 4.1 2.8 2.9 4 1.1q1.5 0 2.7-0.4t2-1 1.4-1.4 0.8-1.4 0.4-1.3h-7.3v-4.4h12.1q0.3 1.1 0.3 2.1z m15.1-2.1v3.6h-3.6v3.7h-3.7v-3.7h-3.7v-3.6h3.7v-3.7h3.7v3.7h3.6z' })
        )
    );
};

exports.default = FaGooglePlus;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],80:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaReddit = function FaReddit(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm24.4 26.1q0.4 0.3 0 0.6-1.3 1.4-4.4 1.4t-4.4-1.4q-0.4-0.3 0-0.6 0.1-0.2 0.3-0.2t0.3 0.2q1.1 1 3.8 1 2.7 0 3.8-1.1 0.1-0.1 0.3-0.1t0.3 0.1z m-6.8-4.1q0 0.8-0.6 1.4t-1.4 0.6-1.4-0.6-0.6-1.4q0-0.8 0.6-1.4t1.4-0.6 1.4 0.6 0.6 1.4z m8.8 0q0 0.8-0.6 1.4t-1.4 0.6-1.4-0.6-0.6-1.4 0.6-1.4 1.4-0.6 1.4 0.6 0.6 1.4z m5.6-2.7q0-1.1-0.8-1.8t-1.9-0.8-1.9 0.8q-2.9-2-6.9-2.2l1.4-6.3 4.4 1q0 0.8 0.6 1.4t1.4 0.6 1.4-0.6 0.6-1.4-0.6-1.4-1.4-0.6q-1.2 0-1.8 1.1l-4.9-1.1q-0.4-0.1-0.6 0.4l-1.5 6.9q-4 0.2-6.9 2.2-0.8-0.8-1.9-0.8-1.1 0-1.9 0.8t-0.8 1.8q0 0.8 0.4 1.5t1.1 0.9q-0.1 0.6-0.1 1.3 0 3.2 3.1 5.4t7.5 2.3q4.4 0 7.6-2.3t3.1-5.4q0-0.7-0.2-1.3 0.7-0.3 1.1-1t0.4-1.4z m8 0.7q0 4.1-1.6 7.8t-4.2 6.4-6.4 4.2-7.8 1.6-7.8-1.6-6.4-4.2-4.2-6.4-1.6-7.8 1.6-7.8 4.2-6.4 6.4-4.2 7.8-1.6 7.8 1.6 6.4 4.2 4.2 6.4 1.6 7.8z' })
        )
    );
};

exports.default = FaReddit;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],94:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaDigg = function FaDigg(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm6.4 8.1h3.9v19.1h-10.3v-13.6h6.4v-5.5z m0 15.9v-7.2h-2.4v7.2h2.4z m5.5-10.4v13.6h4v-13.6h-4z m0-5.5v3.9h4v-3.9h-4z m5.6 5.5h10.3v18.3h-10.3v-3.1h6.4v-1.6h-6.4v-13.6z m6.4 10.4v-7.2h-2.4v7.2h2.4z m5.5-10.4h10.4v18.3h-10.4v-3.1h6.4v-1.6h-6.4v-13.6z m6.4 10.4v-7.2h-2.4v7.2h2.4z' })
        )
    );
};

exports.default = FaDigg;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],82:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaStumbleupon = function FaStumbleupon(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm22.1 16.2v-2.5q0-0.8-0.7-1.5t-1.5-0.6-1.5 0.6-0.6 1.5v12.7q0 3.7-2.6 6.2t-6.3 2.6q-3.7 0-6.3-2.6t-2.6-6.3v-5.5h6.8v5.4q0 0.9 0.6 1.5t1.5 0.6 1.5-0.6 0.6-1.5v-12.8q0-3.6 2.7-6.1t6.2-2.5q3.7 0 6.3 2.5t2.6 6.1v2.8l-4 1.2z m11 4.6h6.8v5.5q0 3.7-2.6 6.3t-6.3 2.6q-3.7 0-6.3-2.6t-2.6-6.2v-5.6l2.7 1.3 4-1.2v5.6q0 0.9 0.6 1.5t1.5 0.6 1.5-0.6 0.7-1.5v-5.7z' })
        )
    );
};

exports.default = FaStumbleupon;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],84:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaDelicious = function FaDelicious(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm35.9 30.7v-10.7h-15.8v-15.7h-10.7q-2 0-3.5 1.4t-1.5 3.6v10.7h15.7v15.7h10.8q2 0 3.5-1.4t1.5-3.6z m1.4-21.4v21.4q0 2.7-1.9 4.6t-4.5 1.8h-21.5q-2.6 0-4.5-1.8t-1.9-4.6v-21.4q0-2.7 1.9-4.6t4.5-1.8h21.5q2.6 0 4.5 1.8t1.9 4.6z' })
        )
    );
};

exports.default = FaDelicious;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],83:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaPinterest = function FaPinterest(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm37.3 20q0 4.7-2.3 8.6t-6.3 6.2-8.6 2.3q-2.4 0-4.8-0.7 1.3-2 1.7-3.6 0.2-0.8 1.2-4.7 0.5 0.8 1.7 1.5t2.5 0.6q2.7 0 4.8-1.5t3.3-4.2 1.2-6.1q0-2.5-1.4-4.7t-3.8-3.7-5.7-1.4q-2.4 0-4.4 0.7t-3.4 1.7-2.5 2.4-1.5 2.9-0.4 3q0 2.4 0.8 4.1t2.7 2.5q0.6 0.3 0.8-0.5 0.1-0.1 0.2-0.6t0.2-0.7q0.1-0.5-0.3-1-1.1-1.3-1.1-3.3 0-3.4 2.3-5.8t6.1-2.5q3.4 0 5.3 1.9t1.9 4.7q0 3.8-1.6 6.5t-3.9 2.6q-1.3 0-2.2-0.9t-0.5-2.4q0.2-0.8 0.6-2.1t0.7-2.3 0.2-1.6q0-1.2-0.6-1.9t-1.7-0.7q-1.4 0-2.3 1.2t-1 3.2q0 1.6 0.6 2.7l-2.2 9.4q-0.4 1.5-0.3 3.9-4.6-2-7.5-6.3t-2.8-9.4q0-4.7 2.3-8.6t6.2-6.2 8.6-2.3 8.6 2.3 6.3 6.2 2.3 8.6z' })
        )
    );
};

exports.default = FaPinterest;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],85:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var FaVk = function FaVk(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm39.8 12.2q0.5 1.3-3.1 6.1-0.5 0.7-1.4 1.8-1.6 2-1.8 2.7-0.4 0.8 0.3 1.7 0.3 0.4 1.6 1.7h0.1l0 0q3 2.8 4 4.6 0.1 0.1 0.1 0.3t0.2 0.5 0 0.8-0.5 0.5-1.3 0.3l-5.3 0.1q-0.5 0.1-1.1-0.1t-1.1-0.5l-0.4-0.2q-0.7-0.5-1.5-1.4t-1.4-1.6-1.3-1.2-1.1-0.3q-0.1 0-0.2 0.1t-0.4 0.3-0.4 0.6-0.4 1.1-0.1 1.6q0 0.3-0.1 0.5t-0.1 0.4l-0.1 0.1q-0.4 0.4-1.1 0.5h-2.4q-1.5 0.1-3-0.4t-2.8-1.1-2.1-1.3-1.5-1.2l-0.5-0.5q-0.2-0.2-0.6-0.6t-1.4-1.9-2.2-3.2-2.6-4.4-2.7-5.6q-0.1-0.3-0.1-0.6t0-0.3l0.1-0.1q0.3-0.4 1.2-0.4l5.7-0.1q0.2 0.1 0.5 0.2t0.3 0.2l0.1 0q0.3 0.2 0.5 0.7 0.4 1 1 2.1t0.8 1.7l0.3 0.6q0.6 1.3 1.2 2.2t1 1.4 0.9 0.8 0.7 0.3 0.5-0.1q0.1 0 0.1-0.1t0.3-0.5 0.3-0.9 0.2-1.7 0-2.6q-0.1-0.9-0.2-1.5t-0.3-1l-0.1-0.2q-0.5-0.7-1.8-0.9-0.3-0.1 0.1-0.5 0.4-0.4 0.8-0.7 1.1-0.5 5-0.5 1.7 0.1 2.8 0.3 0.4 0.1 0.7 0.3t0.4 0.5 0.2 0.7 0.1 0.9 0 1.1-0.1 1.5 0 1.7q0 0.3 0 0.9t-0.1 1 0.1 0.8 0.3 0.8 0.4 0.6q0.2 0 0.4 0t0.5-0.2 0.8-0.7 1.1-1.4 1.4-2.2q1.2-2.2 2.2-4.7 0.1-0.2 0.2-0.4t0.3-0.2l0 0 0.1-0.1 0.3-0.1 0.4 0 6 0q0.8-0.1 1.3 0t0.7 0.4z' })
        )
    );
};

exports.default = FaVk;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],86:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdFileDownload = function MdFileDownload(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm8.4 30h23.2v3.4h-23.2v-3.4z m23.2-15l-11.6 11.6-11.6-11.6h6.6v-10h10v10h6.6z' })
        )
    );
};

exports.default = MdFileDownload;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],96:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdClose = function MdClose(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm31.6 10.7l-9.3 9.3 9.3 9.3-2.3 2.3-9.3-9.3-9.3 9.3-2.3-2.3 9.3-9.3-9.3-9.3 2.3-2.3 9.3 9.3 9.3-9.3z' })
        )
    );
};

exports.default = MdClose;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],87:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdFullscreen = function MdFullscreen(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm23.4 8.4h8.2v8.2h-3.2v-5h-5v-3.2z m5 20v-5h3.2v8.2h-8.2v-3.2h5z m-20-11.8v-8.2h8.2v3.2h-5v5h-3.2z m3.2 6.8v5h5v3.2h-8.2v-8.2h3.2z' })
        )
    );
};

exports.default = MdFullscreen;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],88:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdFullscreenExit = function MdFullscreenExit(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm26.6 13.4h5v3.2h-8.2v-8.2h3.2v5z m-3.2 18.2v-8.2h8.2v3.2h-5v5h-3.2z m-10-18.2v-5h3.2v8.2h-8.2v-3.2h5z m-5 13.2v-3.2h8.2v8.2h-3.2v-5h-5z' })
        )
    );
};

exports.default = MdFullscreenExit;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],89:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdShare = function MdShare(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm30 26.8c2.7 0 4.8 2.2 4.8 4.8s-2.1 5-4.8 5-4.8-2.3-4.8-5c0-0.3 0-0.7 0-1.1l-11.8-6.8c-0.9 0.8-2.1 1.3-3.4 1.3-2.7 0-5-2.3-5-5s2.3-5 5-5c1.3 0 2.5 0.5 3.4 1.3l11.8-6.8c-0.1-0.4-0.2-0.8-0.2-1.1 0-2.8 2.3-5 5-5s5 2.2 5 5-2.3 5-5 5c-1.3 0-2.5-0.6-3.4-1.4l-11.8 6.8c0.1 0.4 0.2 0.8 0.2 1.2s-0.1 0.8-0.2 1.2l11.9 6.8c0.9-0.7 2.1-1.2 3.3-1.2z' })
        )
    );
};

exports.default = MdShare;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],90:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdArrowBack = function MdArrowBack(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm33.4 18.4v3.2h-20.4l9.3 9.4-2.3 2.4-13.4-13.4 13.4-13.4 2.3 2.4-9.3 9.4h20.4z' })
        )
    );
};

exports.default = MdArrowBack;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],91:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactIconBase = require('react-icon-base');

var _reactIconBase2 = _interopRequireDefault(_reactIconBase);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MdArrowForward = function MdArrowForward(props) {
    return _react2.default.createElement(
        _reactIconBase2.default,
        _extends({ viewBox: '0 0 40 40' }, props),
        _react2.default.createElement(
            'g',
            null,
            _react2.default.createElement('path', { d: 'm20 6.6l13.4 13.4-13.4 13.4-2.3-2.4 9.3-9.4h-20.4v-3.2h20.4l-9.3-9.4z' })
        )
    );
};

exports.default = MdArrowForward;
module.exports = exports['default'];
},{"react":6,"react-icon-base":140}],153:[function(require,module,exports) {
'use strict';

module.exports = function () {
	var str = [].map.call(arguments, function (str) {
		return str.trim();
	}).filter(function (str) {
		return str.length;
	}).join('-');

	if (!str.length) {
		return '';
	}

	if (str.length === 1 || !/[_.\- ]+/.test(str)) {
		if (str[0] === str[0].toLowerCase() && str.slice(1) !== str.slice(1).toLowerCase()) {
			return str;
		}

		return str.toLowerCase();
	}

	return str.replace(/^[_.\- ]+/, '').toLowerCase().replace(/[_.\- ]+(\w|$)/g, function (m, p1) {
		return p1.toUpperCase();
	});
};
},{}],97:[function(require,module,exports) {
'use strict';
var camelCase = require('camelcase');

module.exports = function () {
	var cased = camelCase.apply(camelCase, arguments);
	return cased.charAt(0).toUpperCase() + cased.slice(1);
};

},{"camelcase":153}],152:[function(require,module,exports) {
var global = (1,eval)("this");
"use strict";

// Use the fastest means possible to execute a task in its own turn, with
// priority over other events including IO, animation, reflow, and redraw
// events in browsers.
//
// An exception thrown by a task will permanently interrupt the processing of
// subsequent tasks. The higher level `asap` function ensures that if an
// exception is thrown by a task, that the task queue will continue flushing as
// soon as possible, but if you use `rawAsap` directly, you are responsible to
// either ensure that no exceptions are thrown from your task, or to manually
// call `rawAsap.requestFlush` if an exception is thrown.
module.exports = rawAsap;
function rawAsap(task) {
    if (!queue.length) {
        requestFlush();
        flushing = true;
    }
    // Equivalent to push, but avoids a function call.
    queue[queue.length] = task;
}

var queue = [];
// Once a flush has been requested, no further calls to `requestFlush` are
// necessary until the next `flush` completes.
var flushing = false;
// `requestFlush` is an implementation-specific method that attempts to kick
// off a `flush` event as quickly as possible. `flush` will attempt to exhaust
// the event queue before yielding to the browser's own event loop.
var requestFlush;
// The position of the next task to execute in the task queue. This is
// preserved between calls to `flush` so that it can be resumed if
// a task throws an exception.
var index = 0;
// If a task schedules additional tasks recursively, the task queue can grow
// unbounded. To prevent memory exhaustion, the task queue will periodically
// truncate already-completed tasks.
var capacity = 1024;

// The flush function processes all tasks that have been scheduled with
// `rawAsap` unless and until one of those tasks throws an exception.
// If a task throws an exception, `flush` ensures that its state will remain
// consistent and will resume where it left off when called again.
// However, `flush` does not make any arrangements to be called again if an
// exception is thrown.
function flush() {
    while (index < queue.length) {
        var currentIndex = index;
        // Advance the index before calling the task. This ensures that we will
        // begin flushing on the next task the task throws an error.
        index = index + 1;
        queue[currentIndex].call();
        // Prevent leaking memory for long chains of recursive calls to `asap`.
        // If we call `asap` within tasks scheduled by `asap`, the queue will
        // grow, but to avoid an O(n) walk for every task we execute, we don't
        // shift tasks off the queue after they have been executed.
        // Instead, we periodically shift 1024 tasks off the queue.
        if (index > capacity) {
            // Manually shift all values starting at the index back to the
            // beginning of the queue.
            for (var scan = 0, newLength = queue.length - index; scan < newLength; scan++) {
                queue[scan] = queue[scan + index];
            }
            queue.length -= index;
            index = 0;
        }
    }
    queue.length = 0;
    index = 0;
    flushing = false;
}

// `requestFlush` is implemented using a strategy based on data collected from
// every available SauceLabs Selenium web driver worker at time of writing.
// https://docs.google.com/spreadsheets/d/1mG-5UYGup5qxGdEMWkhP6BWCz053NUb2E1QoUTU16uA/edit#gid=783724593

// Safari 6 and 6.1 for desktop, iPad, and iPhone are the only browsers that
// have WebKitMutationObserver but not un-prefixed MutationObserver.
// Must use `global` or `self` instead of `window` to work in both frames and web
// workers. `global` is a provision of Browserify, Mr, Mrs, or Mop.

/* globals self */
var scope = typeof global !== "undefined" ? global : self;
var BrowserMutationObserver = scope.MutationObserver || scope.WebKitMutationObserver;

// MutationObservers are desirable because they have high priority and work
// reliably everywhere they are implemented.
// They are implemented in all modern browsers.
//
// - Android 4-4.3
// - Chrome 26-34
// - Firefox 14-29
// - Internet Explorer 11
// - iPad Safari 6-7.1
// - iPhone Safari 7-7.1
// - Safari 6-7
if (typeof BrowserMutationObserver === "function") {
    requestFlush = makeRequestCallFromMutationObserver(flush);

// MessageChannels are desirable because they give direct access to the HTML
// task queue, are implemented in Internet Explorer 10, Safari 5.0-1, and Opera
// 11-12, and in web workers in many engines.
// Although message channels yield to any queued rendering and IO tasks, they
// would be better than imposing the 4ms delay of timers.
// However, they do not work reliably in Internet Explorer or Safari.

// Internet Explorer 10 is the only browser that has setImmediate but does
// not have MutationObservers.
// Although setImmediate yields to the browser's renderer, it would be
// preferrable to falling back to setTimeout since it does not have
// the minimum 4ms penalty.
// Unfortunately there appears to be a bug in Internet Explorer 10 Mobile (and
// Desktop to a lesser extent) that renders both setImmediate and
// MessageChannel useless for the purposes of ASAP.
// https://github.com/kriskowal/q/issues/396

// Timers are implemented universally.
// We fall back to timers in workers in most engines, and in foreground
// contexts in the following browsers.
// However, note that even this simple case requires nuances to operate in a
// broad spectrum of browsers.
//
// - Firefox 3-13
// - Internet Explorer 6-9
// - iPad Safari 4.3
// - Lynx 2.8.7
} else {
    requestFlush = makeRequestCallFromTimer(flush);
}

// `requestFlush` requests that the high priority event queue be flushed as
// soon as possible.
// This is useful to prevent an error thrown in a task from stalling the event
// queue if the exception handled by Node.js’s
// `process.on("uncaughtException")` or by a domain.
rawAsap.requestFlush = requestFlush;

// To request a high priority event, we induce a mutation observer by toggling
// the text of a text node between "1" and "-1".
function makeRequestCallFromMutationObserver(callback) {
    var toggle = 1;
    var observer = new BrowserMutationObserver(callback);
    var node = document.createTextNode("");
    observer.observe(node, {characterData: true});
    return function requestCall() {
        toggle = -toggle;
        node.data = toggle;
    };
}

// The message channel technique was discovered by Malte Ubl and was the
// original foundation for this library.
// http://www.nonblocking.io/2011/06/windownexttick.html

// Safari 6.0.5 (at least) intermittently fails to create message ports on a
// page's first load. Thankfully, this version of Safari supports
// MutationObservers, so we don't need to fall back in that case.

// function makeRequestCallFromMessageChannel(callback) {
//     var channel = new MessageChannel();
//     channel.port1.onmessage = callback;
//     return function requestCall() {
//         channel.port2.postMessage(0);
//     };
// }

// For reasons explained above, we are also unable to use `setImmediate`
// under any circumstances.
// Even if we were, there is another bug in Internet Explorer 10.
// It is not sufficient to assign `setImmediate` to `requestFlush` because
// `setImmediate` must be called *by name* and therefore must be wrapped in a
// closure.
// Never forget.

// function makeRequestCallFromSetImmediate(callback) {
//     return function requestCall() {
//         setImmediate(callback);
//     };
// }

// Safari 6.0 has a problem where timers will get lost while the user is
// scrolling. This problem does not impact ASAP because Safari 6.0 supports
// mutation observers, so that implementation is used instead.
// However, if we ever elect to use timers in Safari, the prevalent work-around
// is to add a scroll event listener that calls for a flush.

// `setTimeout` does not call the passed callback if the delay is less than
// approximately 7 in web workers in Firefox 8 through 18, and sometimes not
// even then.

function makeRequestCallFromTimer(callback) {
    return function requestCall() {
        // We dispatch a timeout with a specified delay of 0 for engines that
        // can reliably accommodate that request. This will usually be snapped
        // to a 4 milisecond delay, but once we're flushing, there's no delay
        // between events.
        var timeoutHandle = setTimeout(handleTimer, 0);
        // However, since this timer gets frequently dropped in Firefox
        // workers, we enlist an interval handle that will try to fire
        // an event 20 times per second until it succeeds.
        var intervalHandle = setInterval(handleTimer, 50);

        function handleTimer() {
            // Whichever timer succeeds will cancel both timers and
            // execute the callback.
            clearTimeout(timeoutHandle);
            clearInterval(intervalHandle);
            callback();
        }
    };
}

// This is for `asap.js` only.
// Its name will be periodically randomized to break any code that depends on
// its existence.
rawAsap.makeRequestCallFromTimer = makeRequestCallFromTimer;

// ASAP was originally a nextTick shim included in Q. This was factored out
// into this ASAP package. It was later adapted to RSVP which made further
// amendments. These decisions, particularly to marginalize MessageChannel and
// to capture the MutationObserver implementation in a closure, were integrated
// back into ASAP proper.
// https://github.com/tildeio/rsvp.js/blob/cddf7232546a9cf858524b75cde6f9edf72620a7/lib/rsvp/asap.js

},{}],95:[function(require,module,exports) {
"use strict";

// rawAsap provides everything we need except exception management.
var rawAsap = require("./raw");
// RawTasks are recycled to reduce GC churn.
var freeTasks = [];
// We queue errors to ensure they are thrown in right order (FIFO).
// Array-as-queue is good enough here, since we are just dealing with exceptions.
var pendingErrors = [];
var requestErrorThrow = rawAsap.makeRequestCallFromTimer(throwFirstError);

function throwFirstError() {
    if (pendingErrors.length) {
        throw pendingErrors.shift();
    }
}

/**
 * Calls a task as soon as possible after returning, in its own event, with priority
 * over other events like animation, reflow, and repaint. An error thrown from an
 * event will not interrupt, nor even substantially slow down the processing of
 * other events, but will be rather postponed to a lower priority event.
 * @param {{call}} task A callable object, typically a function that takes no
 * arguments.
 */
module.exports = asap;
function asap(task) {
    var rawTask;
    if (freeTasks.length) {
        rawTask = freeTasks.pop();
    } else {
        rawTask = new RawTask();
    }
    rawTask.task = task;
    rawAsap(rawTask);
}

// We wrap tasks with recyclable task objects.  A task object implements
// `call`, just like a function.
function RawTask() {
    this.task = null;
}

// The sole purpose of wrapping the task is to catch the exception and recycle
// the task object after its single use.
RawTask.prototype.call = function () {
    try {
        this.task.call();
    } catch (error) {
        if (asap.onerror) {
            // This hook exists purely for testing purposes.
            // Its name will be periodically randomized to break any code that
            // depends on its existence.
            asap.onerror(error);
        } else {
            // In a web browser, exceptions are not fatal. However, to avoid
            // slowing down the queue of pending tasks, we rethrow the error in a
            // lower priority turn.
            pendingErrors.push(error);
            requestErrorThrow();
        }
    } finally {
        this.task = null;
        freeTasks[freeTasks.length] = this;
    }
};

},{"./raw":152}],79:[function(require,module,exports) {
/*! atomicjs v1.0.0 | (c) 2015 @munkychop | github.com/munkychop/atomicjs */
!function() {
    "use strict";
    var exports = {}, parse = function(req) {
        var result;
        try {
            result = JSON.parse(req.responseText);
        } catch (e) {
            result = req.responseText;
        }
        return [ result, req ];
    }, xhr = function(httpMethod, url, data, contentType) {
        var contentTypeHeader = "json" === contentType ? "application/json" : "application/x-www-form-urlencoded";
        console.log('contentTypeHeader:', contentTypeHeader);
        var methods = {
            success: function() {},
            error: function() {}
        }, XHR = window.XMLHttpRequest || ActiveXObject, request = new XHR("MSXML2.XMLHTTP.3.0");
        request.open(httpMethod, url, !0), request.setRequestHeader("Content-type", contentTypeHeader),
        request.onreadystatechange = function() {
            4 === request.readyState && (request.status >= 200 && request.status < 300 ? methods.success.apply(methods, parse(request)) : methods.error.apply(methods, parse(request)));
        }, request.send(data);
        var callbacks = {
            success: function(callback) {
                return methods.success = callback, callbacks;
            },
            error: function(callback) {
                return methods.error = callback, callbacks;
            }
        };
        return callbacks;
    };
    exports.get = function(src) {
        return xhr("GET", src);
    }, exports.put = function(url, data, contentType) {
        return xhr("PUT", url, data, contentType);
    }, exports.post = function(url, data, contentType) {
        return xhr("POST", url, data, contentType);
    }, exports["delete"] = function(url) {
        return xhr("DELETE", url);
    }, "undefined" != typeof define && define.amd ? define(function() {
        return exports;
    }) : "undefined" != typeof module && module.exports ? module.exports = exports : window.atomic = exports;
}();

},{}],159:[function(require,module,exports) {
'use strict';

module.exports = function (x) {
	var type = typeof x;
	return x !== null && (type === 'object' || type === 'function');
};
},{}],98:[function(require,module,exports) {
'use strict';

const isObj = require('is-obj');

function getPathSegments(path) {
	const pathArr = path.split('.');
	const parts = [];

	for (let i = 0; i < pathArr.length; i++) {
		let p = pathArr[i];

		while (p[p.length - 1] === '\\' && pathArr[i + 1] !== undefined) {
			p = p.slice(0, -1) + '.';
			p += pathArr[++i];
		}

		parts.push(p);
	}

	return parts;
}

module.exports = {
	get: function (obj, path, value) {
		if (!isObj(obj) || typeof path !== 'string') {
			return value === undefined ? obj : value;
		}

		const pathArr = getPathSegments(path);

		for (let i = 0; i < pathArr.length; i++) {
			if (!Object.prototype.propertyIsEnumerable.call(obj, pathArr[i])) {
				return value;
			}

			obj = obj[pathArr[i]];

			if (obj === undefined || obj === null) {
				// `obj` is either `undefined` or `null` so we want to stop the loop, and
				// if this is not the last bit of the path, and
				// if it did't return `undefined`
				// it would return `null` if `obj` is `null`
				// but we want `get({foo: null}, 'foo.bar')` to equal `undefined`, or the supplied value, not `null`
				if (i !== pathArr.length - 1) {
					return value;
				}

				break;
			}
		}

		return obj;
	},
	set: function (obj, path, value) {
		if (!isObj(obj) || typeof path !== 'string') {
			return obj;
		}

		const root = obj;
		const pathArr = getPathSegments(path);

		for (let i = 0; i < pathArr.length; i++) {
			const p = pathArr[i];

			if (!isObj(obj[p])) {
				obj[p] = {};
			}

			if (i === pathArr.length - 1) {
				obj[p] = value;
			}

			obj = obj[p];
		}

		return root;
	},
	delete: function (obj, path) {
		if (!isObj(obj) || typeof path !== 'string') {
			return;
		}

		const pathArr = getPathSegments(path);

		for (let i = 0; i < pathArr.length; i++) {
			const p = pathArr[i];

			if (i === pathArr.length - 1) {
				delete obj[p];
				return;
			}

			obj = obj[p];

			if (!isObj(obj)) {
				return;
			}
		}
	},
	has: function (obj, path) {
		if (!isObj(obj) || typeof path !== 'string') {
			return false;
		}

		const pathArr = getPathSegments(path);

		for (let i = 0; i < pathArr.length; i++) {
			if (isObj(obj)) {
				if (!(pathArr[i] in obj)) {
					return false;
				}

				obj = obj[pathArr[i]];
			} else {
				return false;
			}
		}

		return true;
	}
};
},{"is-obj":159}],23:[function(require,module,exports) {
var global = (1,eval)("this");

'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _facebook = require('react-icons/lib/fa/facebook');

var _facebook2 = _interopRequireDefault2(_facebook);

var _twitter = require('react-icons/lib/fa/twitter');

var _twitter2 = _interopRequireDefault2(_twitter);

var _googlePlus = require('react-icons/lib/fa/google-plus');

var _googlePlus2 = _interopRequireDefault2(_googlePlus);

var _reddit = require('react-icons/lib/fa/reddit');

var _reddit2 = _interopRequireDefault2(_reddit);

var _digg = require('react-icons/lib/fa/digg');

var _digg2 = _interopRequireDefault2(_digg);

var _stumbleupon = require('react-icons/lib/fa/stumbleupon');

var _stumbleupon2 = _interopRequireDefault2(_stumbleupon);

var _delicious = require('react-icons/lib/fa/delicious');

var _delicious2 = _interopRequireDefault2(_delicious);

var _pinterest = require('react-icons/lib/fa/pinterest');

var _pinterest2 = _interopRequireDefault2(_pinterest);

var _vk = require('react-icons/lib/fa/vk');

var _vk2 = _interopRequireDefault2(_vk);

var _react = require('react');

var _react2 = _interopRequireDefault2(_react);

var _fileDownload = require('react-icons/lib/md/file-download');

var _fileDownload2 = _interopRequireDefault2(_fileDownload);

var _close = require('react-icons/lib/md/close');

var _close2 = _interopRequireDefault2(_close);

var _fullscreen = require('react-icons/lib/md/fullscreen');

var _fullscreen2 = _interopRequireDefault2(_fullscreen);

var _fullscreenExit = require('react-icons/lib/md/fullscreen-exit');

var _fullscreenExit2 = _interopRequireDefault2(_fullscreenExit);

var _share = require('react-icons/lib/md/share');

var _share2 = _interopRequireDefault2(_share);

var _reactScrollbar = require('react-scrollbar');

var _reactScrollbar2 = _interopRequireDefault2(_reactScrollbar);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault2(_reactDom);

var _arrowBack = require('react-icons/lib/md/arrow-back');

var _arrowBack2 = _interopRequireDefault2(_arrowBack);

var _arrowForward = require('react-icons/lib/md/arrow-forward');

var _arrowForward2 = _interopRequireDefault2(_arrowForward);

var _app = require('yaux/lib/app');

var _app2 = _interopRequireDefault2(_app);

function _interopRequireDefault2(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function unwrapExports(x) {
  return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
}

function createCommonjsModule(fn, module) {
  return module = { exports: {} }, fn(module, module.exports), module.exports;
}

// 7.1.4 ToInteger
var ceil = Math.ceil;
var floor = Math.floor;
var _toInteger = function (it) {
  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
};

// 7.2.1 RequireObjectCoercible(argument)
var _defined = function (it) {
  if (it == undefined) throw TypeError("Can't call method on  " + it);
  return it;
};

// true  -> String#at
// false -> String#codePointAt
var _stringAt = function (TO_STRING) {
  return function (that, pos) {
    var s = String(_defined(that));
    var i = _toInteger(pos);
    var l = s.length;
    var a, b;
    if (i < 0 || i >= l) return TO_STRING ? '' : undefined;
    a = s.charCodeAt(i);
    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff ? TO_STRING ? s.charAt(i) : a : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
  };
};

var _library = true;

var _global = createCommonjsModule(function (module) {
  // https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
  var global = module.exports = typeof window != 'undefined' && window.Math == Math ? window : typeof self != 'undefined' && self.Math == Math ? self
  // eslint-disable-next-line no-new-func
  : Function('return this')();
  if (typeof __g == 'number') __g = global; // eslint-disable-line no-undef
});

var _core = createCommonjsModule(function (module) {
  var core = module.exports = { version: '2.5.3' };
  if (typeof __e == 'number') __e = core; // eslint-disable-line no-undef
});
var _core_1 = _core.version;

var _aFunction = function (it) {
  if (typeof it != 'function') throw TypeError(it + ' is not a function!');
  return it;
};

// optional / simple context binding

var _ctx = function (fn, that, length) {
  _aFunction(fn);
  if (that === undefined) return fn;
  switch (length) {
    case 1:
      return function (a) {
        return fn.call(that, a);
      };
    case 2:
      return function (a, b) {
        return fn.call(that, a, b);
      };
    case 3:
      return function (a, b, c) {
        return fn.call(that, a, b, c);
      };
  }
  return function () /* ...args */{
    return fn.apply(that, arguments);
  };
};

var _isObject = function (it) {
  return typeof it === 'object' ? it !== null : typeof it === 'function';
};

var _anObject = function (it) {
  if (!_isObject(it)) throw TypeError(it + ' is not an object!');
  return it;
};

var _fails = function (exec) {
  try {
    return !!exec();
  } catch (e) {
    return true;
  }
};

// Thank's IE8 for his funny defineProperty
var _descriptors = !_fails(function () {
  return Object.defineProperty({}, 'a', { get: function () {
      return 7;
    } }).a != 7;
});

var document$1 = _global.document;
// typeof document.createElement is 'object' in old IE
var is = _isObject(document$1) && _isObject(document$1.createElement);
var _domCreate = function (it) {
  return is ? document$1.createElement(it) : {};
};

var _ie8DomDefine = !_descriptors && !_fails(function () {
  return Object.defineProperty(_domCreate('div'), 'a', { get: function () {
      return 7;
    } }).a != 7;
});

// 7.1.1 ToPrimitive(input [, PreferredType])

// instead of the ES6 spec version, we didn't implement @@toPrimitive case
// and the second argument - flag - preferred type is a string
var _toPrimitive = function (it, S) {
  if (!_isObject(it)) return it;
  var fn, val;
  if (S && typeof (fn = it.toString) == 'function' && !_isObject(val = fn.call(it))) return val;
  if (typeof (fn = it.valueOf) == 'function' && !_isObject(val = fn.call(it))) return val;
  if (!S && typeof (fn = it.toString) == 'function' && !_isObject(val = fn.call(it))) return val;
  throw TypeError("Can't convert object to primitive value");
};

var dP = Object.defineProperty;

var f = _descriptors ? Object.defineProperty : function defineProperty(O, P, Attributes) {
  _anObject(O);
  P = _toPrimitive(P, true);
  _anObject(Attributes);
  if (_ie8DomDefine) try {
    return dP(O, P, Attributes);
  } catch (e) {/* empty */}
  if ('get' in Attributes || 'set' in Attributes) throw TypeError('Accessors not supported!');
  if ('value' in Attributes) O[P] = Attributes.value;
  return O;
};

var _objectDp = {
  f: f
};

var _propertyDesc = function (bitmap, value) {
  return {
    enumerable: !(bitmap & 1),
    configurable: !(bitmap & 2),
    writable: !(bitmap & 4),
    value: value
  };
};

var _hide = _descriptors ? function (object, key, value) {
  return _objectDp.f(object, key, _propertyDesc(1, value));
} : function (object, key, value) {
  object[key] = value;
  return object;
};

var PROTOTYPE = 'prototype';

var $export = function (type, name, source) {
  var IS_FORCED = type & $export.F;
  var IS_GLOBAL = type & $export.G;
  var IS_STATIC = type & $export.S;
  var IS_PROTO = type & $export.P;
  var IS_BIND = type & $export.B;
  var IS_WRAP = type & $export.W;
  var exports = IS_GLOBAL ? _core : _core[name] || (_core[name] = {});
  var expProto = exports[PROTOTYPE];
  var target = IS_GLOBAL ? _global : IS_STATIC ? _global[name] : (_global[name] || {})[PROTOTYPE];
  var key, own, out;
  if (IS_GLOBAL) source = name;
  for (key in source) {
    // contains in native
    own = !IS_FORCED && target && target[key] !== undefined;
    if (own && key in exports) continue;
    // export native or passed
    out = own ? target[key] : source[key];
    // prevent global pollution for namespaces
    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
    // bind timers to global for call from export context
    : IS_BIND && own ? _ctx(out, _global)
    // wrap global constructors for prevent change them in library
    : IS_WRAP && target[key] == out ? function (C) {
      var F = function (a, b, c) {
        if (this instanceof C) {
          switch (arguments.length) {
            case 0:
              return new C();
            case 1:
              return new C(a);
            case 2:
              return new C(a, b);
          }return new C(a, b, c);
        }return C.apply(this, arguments);
      };
      F[PROTOTYPE] = C[PROTOTYPE];
      return F;
      // make static versions for prototype methods
    }(out) : IS_PROTO && typeof out == 'function' ? _ctx(Function.call, out) : out;
    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
    if (IS_PROTO) {
      (exports.virtual || (exports.virtual = {}))[key] = out;
      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
      if (type & $export.R && expProto && !expProto[key]) _hide(expProto, key, out);
    }
  }
};
// type bitmap
$export.F = 1; // forced
$export.G = 2; // global
$export.S = 4; // static
$export.P = 8; // proto
$export.B = 16; // bind
$export.W = 32; // wrap
$export.U = 64; // safe
$export.R = 128; // real proto method for `library`
var _export = $export;

var _redefine = _hide;

var hasOwnProperty = {}.hasOwnProperty;
var _has = function (it, key) {
  return hasOwnProperty.call(it, key);
};

var _iterators = {};

var toString = {}.toString;

var _cof = function (it) {
  return toString.call(it).slice(8, -1);
};

// fallback for non-array-like ES3 and non-enumerable old V8 strings

// eslint-disable-next-line no-prototype-builtins
var _iobject = Object('z').propertyIsEnumerable(0) ? Object : function (it) {
  return _cof(it) == 'String' ? it.split('') : Object(it);
};

// to indexed object, toObject with fallback for non-array-like ES3 strings


var _toIobject = function (it) {
  return _iobject(_defined(it));
};

// 7.1.15 ToLength

var min = Math.min;
var _toLength = function (it) {
  return it > 0 ? min(_toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
};

var max = Math.max;
var min$1 = Math.min;
var _toAbsoluteIndex = function (index, length) {
  index = _toInteger(index);
  return index < 0 ? max(index + length, 0) : min$1(index, length);
};

// false -> Array#indexOf
// true  -> Array#includes


var _arrayIncludes = function (IS_INCLUDES) {
  return function ($this, el, fromIndex) {
    var O = _toIobject($this);
    var length = _toLength(O.length);
    var index = _toAbsoluteIndex(fromIndex, length);
    var value;
    // Array#includes uses SameValueZero equality algorithm
    // eslint-disable-next-line no-self-compare
    if (IS_INCLUDES && el != el) while (length > index) {
      value = O[index++];
      // eslint-disable-next-line no-self-compare
      if (value != value) return true;
      // Array#indexOf ignores holes, Array#includes - not
    } else for (; length > index; index++) if (IS_INCLUDES || index in O) {
      if (O[index] === el) return IS_INCLUDES || index || 0;
    }return !IS_INCLUDES && -1;
  };
};

var SHARED = '__core-js_shared__';
var store = _global[SHARED] || (_global[SHARED] = {});
var _shared = function (key) {
  return store[key] || (store[key] = {});
};

var id = 0;
var px = Math.random();
var _uid = function (key) {
  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
};

var shared = _shared('keys');

var _sharedKey = function (key) {
  return shared[key] || (shared[key] = _uid(key));
};

var arrayIndexOf = _arrayIncludes(false);
var IE_PROTO = _sharedKey('IE_PROTO');

var _objectKeysInternal = function (object, names) {
  var O = _toIobject(object);
  var i = 0;
  var result = [];
  var key;
  for (key in O) if (key != IE_PROTO) _has(O, key) && result.push(key);
  // Don't enum bug & hidden keys
  while (names.length > i) if (_has(O, key = names[i++])) {
    ~arrayIndexOf(result, key) || result.push(key);
  }
  return result;
};

// IE 8- don't enum bug keys
var _enumBugKeys = 'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'.split(',');

// 19.1.2.14 / 15.2.3.14 Object.keys(O)


var _objectKeys = Object.keys || function keys(O) {
  return _objectKeysInternal(O, _enumBugKeys);
};

var _objectDps = _descriptors ? Object.defineProperties : function defineProperties(O, Properties) {
  _anObject(O);
  var keys = _objectKeys(Properties);
  var length = keys.length;
  var i = 0;
  var P;
  while (length > i) _objectDp.f(O, P = keys[i++], Properties[P]);
  return O;
};

var document$2 = _global.document;
var _html = document$2 && document$2.documentElement;

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])


var IE_PROTO$1 = _sharedKey('IE_PROTO');
var Empty = function () {/* empty */};
var PROTOTYPE$1 = 'prototype';

// Create object with fake `null` prototype: use iframe Object with cleared prototype
var createDict = function () {
  // Thrash, waste and sodomy: IE GC bug
  var iframe = _domCreate('iframe');
  var i = _enumBugKeys.length;
  var lt = '<';
  var gt = '>';
  var iframeDocument;
  iframe.style.display = 'none';
  _html.appendChild(iframe);
  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
  // createDict = iframe.contentWindow.Object;
  // html.removeChild(iframe);
  iframeDocument = iframe.contentWindow.document;
  iframeDocument.open();
  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
  iframeDocument.close();
  createDict = iframeDocument.F;
  while (i--) delete createDict[PROTOTYPE$1][_enumBugKeys[i]];
  return createDict();
};

var _objectCreate = Object.create || function create(O, Properties) {
  var result;
  if (O !== null) {
    Empty[PROTOTYPE$1] = _anObject(O);
    result = new Empty();
    Empty[PROTOTYPE$1] = null;
    // add "__proto__" for Object.getPrototypeOf polyfill
    result[IE_PROTO$1] = O;
  } else result = createDict();
  return Properties === undefined ? result : _objectDps(result, Properties);
};

var _wks = createCommonjsModule(function (module) {
  var store = _shared('wks');

  var Symbol = _global.Symbol;
  var USE_SYMBOL = typeof Symbol == 'function';

  var $exports = module.exports = function (name) {
    return store[name] || (store[name] = USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : _uid)('Symbol.' + name));
  };

  $exports.store = store;
});

var def = _objectDp.f;

var TAG = _wks('toStringTag');

var _setToStringTag = function (it, tag, stat) {
  if (it && !_has(it = stat ? it : it.prototype, TAG)) def(it, TAG, { configurable: true, value: tag });
};

var IteratorPrototype = {};

// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
_hide(IteratorPrototype, _wks('iterator'), function () {
  return this;
});

var _iterCreate = function (Constructor, NAME, next) {
  Constructor.prototype = _objectCreate(IteratorPrototype, { next: _propertyDesc(1, next) });
  _setToStringTag(Constructor, NAME + ' Iterator');
};

// 7.1.13 ToObject(argument)

var _toObject = function (it) {
  return Object(_defined(it));
};

// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)


var IE_PROTO$2 = _sharedKey('IE_PROTO');
var ObjectProto = Object.prototype;

var _objectGpo = Object.getPrototypeOf || function (O) {
  O = _toObject(O);
  if (_has(O, IE_PROTO$2)) return O[IE_PROTO$2];
  if (typeof O.constructor == 'function' && O instanceof O.constructor) {
    return O.constructor.prototype;
  }return O instanceof Object ? ObjectProto : null;
};

var ITERATOR = _wks('iterator');
var BUGGY = !([].keys && 'next' in [].keys()); // Safari has buggy iterators w/o `next`
var FF_ITERATOR = '@@iterator';
var KEYS = 'keys';
var VALUES = 'values';

var returnThis = function () {
  return this;
};

var _iterDefine = function (Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED) {
  _iterCreate(Constructor, NAME, next);
  var getMethod = function (kind) {
    if (!BUGGY && kind in proto) return proto[kind];
    switch (kind) {
      case KEYS:
        return function keys() {
          return new Constructor(this, kind);
        };
      case VALUES:
        return function values() {
          return new Constructor(this, kind);
        };
    }return function entries() {
      return new Constructor(this, kind);
    };
  };
  var TAG = NAME + ' Iterator';
  var DEF_VALUES = DEFAULT == VALUES;
  var VALUES_BUG = false;
  var proto = Base.prototype;
  var $native = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT];
  var $default = !BUGGY && $native || getMethod(DEFAULT);
  var $entries = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined;
  var $anyNative = NAME == 'Array' ? proto.entries || $native : $native;
  var methods, key, IteratorPrototype;
  // Fix native
  if ($anyNative) {
    IteratorPrototype = _objectGpo($anyNative.call(new Base()));
    if (IteratorPrototype !== Object.prototype && IteratorPrototype.next) {
      // Set @@toStringTag to native iterators
      _setToStringTag(IteratorPrototype, TAG, true);
      // fix for some old engines
      if (!_library && !_has(IteratorPrototype, ITERATOR)) _hide(IteratorPrototype, ITERATOR, returnThis);
    }
  }
  // fix Array#{values, @@iterator}.name in V8 / FF
  if (DEF_VALUES && $native && $native.name !== VALUES) {
    VALUES_BUG = true;
    $default = function values() {
      return $native.call(this);
    };
  }
  // Define iterator
  if ((!_library || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])) {
    _hide(proto, ITERATOR, $default);
  }
  // Plug for library
  _iterators[NAME] = $default;
  _iterators[TAG] = returnThis;
  if (DEFAULT) {
    methods = {
      values: DEF_VALUES ? $default : getMethod(VALUES),
      keys: IS_SET ? $default : getMethod(KEYS),
      entries: $entries
    };
    if (FORCED) for (key in methods) {
      if (!(key in proto)) _redefine(proto, key, methods[key]);
    } else _export(_export.P + _export.F * (BUGGY || VALUES_BUG), NAME, methods);
  }
  return methods;
};

var $at = _stringAt(true);

// 21.1.3.27 String.prototype[@@iterator]()
_iterDefine(String, 'String', function (iterated) {
  this._t = String(iterated); // target
  this._i = 0; // next index
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

var _iterStep = function (done, value) {
  return { value: value, done: !!done };
};

// 22.1.3.4 Array.prototype.entries()
// 22.1.3.13 Array.prototype.keys()
// 22.1.3.29 Array.prototype.values()
// 22.1.3.30 Array.prototype[@@iterator]()
var es6_array_iterator = _iterDefine(Array, 'Array', function (iterated, kind) {
  this._t = _toIobject(iterated); // target
  this._i = 0; // next index
  this._k = kind; // kind
  // 22.1.5.2.1 %ArrayIteratorPrototype%.next()
}, function () {
  var O = this._t;
  var kind = this._k;
  var index = this._i++;
  if (!O || index >= O.length) {
    this._t = undefined;
    return _iterStep(1);
  }
  if (kind == 'keys') return _iterStep(0, index);
  if (kind == 'values') return _iterStep(0, O[index]);
  return _iterStep(0, [index, O[index]]);
}, 'values');

// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
_iterators.Arguments = _iterators.Array;

var TO_STRING_TAG = _wks('toStringTag');

var DOMIterables = ('CSSRuleList,CSSStyleDeclaration,CSSValueList,ClientRectList,DOMRectList,DOMStringList,' + 'DOMTokenList,DataTransferItemList,FileList,HTMLAllCollection,HTMLCollection,HTMLFormElement,HTMLSelectElement,' + 'MediaList,MimeTypeArray,NamedNodeMap,NodeList,PaintRequestList,Plugin,PluginArray,SVGLengthList,SVGNumberList,' + 'SVGPathSegList,SVGPointList,SVGStringList,SVGTransformList,SourceBufferList,StyleSheetList,TextTrackCueList,' + 'TextTrackList,TouchList').split(',');

for (var i = 0; i < DOMIterables.length; i++) {
  var NAME = DOMIterables[i];
  var Collection = _global[NAME];
  var proto = Collection && Collection.prototype;
  if (proto && !proto[TO_STRING_TAG]) _hide(proto, TO_STRING_TAG, NAME);
  _iterators[NAME] = _iterators.Array;
}

// getting tag from 19.1.3.6 Object.prototype.toString()

var TAG$1 = _wks('toStringTag');
// ES3 wrong here
var ARG = _cof(function () {
  return arguments;
}()) == 'Arguments';

// fallback for IE11 Script Access Denied error
var tryGet = function (it, key) {
  try {
    return it[key];
  } catch (e) {/* empty */}
};

var _classof = function (it) {
  var O, T, B;
  return it === undefined ? 'Undefined' : it === null ? 'Null'
  // @@toStringTag case
  : typeof (T = tryGet(O = Object(it), TAG$1)) == 'string' ? T
  // builtinTag case
  : ARG ? _cof(O)
  // ES3 arguments fallback
  : (B = _cof(O)) == 'Object' && typeof O.callee == 'function' ? 'Arguments' : B;
};

var _anInstance = function (it, Constructor, name, forbiddenField) {
  if (!(it instanceof Constructor) || forbiddenField !== undefined && forbiddenField in it) {
    throw TypeError(name + ': incorrect invocation!');
  }return it;
};

// call something on iterator step with safe closing on error

var _iterCall = function (iterator, fn, value, entries) {
  try {
    return entries ? fn(_anObject(value)[0], value[1]) : fn(value);
    // 7.4.6 IteratorClose(iterator, completion)
  } catch (e) {
    var ret = iterator['return'];
    if (ret !== undefined) _anObject(ret.call(iterator));
    throw e;
  }
};

// check on default Array iterator

var ITERATOR$1 = _wks('iterator');
var ArrayProto = Array.prototype;

var _isArrayIter = function (it) {
  return it !== undefined && (_iterators.Array === it || ArrayProto[ITERATOR$1] === it);
};

var ITERATOR$2 = _wks('iterator');

var core_getIteratorMethod = _core.getIteratorMethod = function (it) {
  if (it != undefined) return it[ITERATOR$2] || it['@@iterator'] || _iterators[_classof(it)];
};

var _forOf = createCommonjsModule(function (module) {
  var BREAK = {};
  var RETURN = {};
  var exports = module.exports = function (iterable, entries, fn, that, ITERATOR) {
    var iterFn = ITERATOR ? function () {
      return iterable;
    } : core_getIteratorMethod(iterable);
    var f = _ctx(fn, that, entries ? 2 : 1);
    var index = 0;
    var length, step, iterator, result;
    if (typeof iterFn != 'function') throw TypeError(iterable + ' is not iterable!');
    // fast case for arrays with default iterator
    if (_isArrayIter(iterFn)) for (length = _toLength(iterable.length); length > index; index++) {
      result = entries ? f(_anObject(step = iterable[index])[0], step[1]) : f(iterable[index]);
      if (result === BREAK || result === RETURN) return result;
    } else for (iterator = iterFn.call(iterable); !(step = iterator.next()).done;) {
      result = _iterCall(iterator, f, step.value, entries);
      if (result === BREAK || result === RETURN) return result;
    }
  };
  exports.BREAK = BREAK;
  exports.RETURN = RETURN;
});

// 7.3.20 SpeciesConstructor(O, defaultConstructor)


var SPECIES = _wks('species');
var _speciesConstructor = function (O, D) {
  var C = _anObject(O).constructor;
  var S;
  return C === undefined || (S = _anObject(C)[SPECIES]) == undefined ? D : _aFunction(S);
};

// fast apply, http://jsperf.lnkit.com/fast-apply/5
var _invoke = function (fn, args, that) {
  var un = that === undefined;
  switch (args.length) {
    case 0:
      return un ? fn() : fn.call(that);
    case 1:
      return un ? fn(args[0]) : fn.call(that, args[0]);
    case 2:
      return un ? fn(args[0], args[1]) : fn.call(that, args[0], args[1]);
    case 3:
      return un ? fn(args[0], args[1], args[2]) : fn.call(that, args[0], args[1], args[2]);
    case 4:
      return un ? fn(args[0], args[1], args[2], args[3]) : fn.call(that, args[0], args[1], args[2], args[3]);
  }return fn.apply(that, args);
};

var process = _global.process;
var setTask = _global.setImmediate;
var clearTask = _global.clearImmediate;
var MessageChannel = _global.MessageChannel;
var Dispatch = _global.Dispatch;
var counter = 0;
var queue = {};
var ONREADYSTATECHANGE = 'onreadystatechange';
var defer, channel, port;
var run = function () {
  var id = +this;
  // eslint-disable-next-line no-prototype-builtins
  if (queue.hasOwnProperty(id)) {
    var fn = queue[id];
    delete queue[id];
    fn();
  }
};
var listener = function (event) {
  run.call(event.data);
};
// Node.js 0.9+ & IE10+ has setImmediate, otherwise:
if (!setTask || !clearTask) {
  setTask = function setImmediate(fn) {
    var args = [];
    var i = 1;
    while (arguments.length > i) args.push(arguments[i++]);
    queue[++counter] = function () {
      // eslint-disable-next-line no-new-func
      _invoke(typeof fn == 'function' ? fn : Function(fn), args);
    };
    defer(counter);
    return counter;
  };
  clearTask = function clearImmediate(id) {
    delete queue[id];
  };
  // Node.js 0.8-
  if (_cof(process) == 'process') {
    defer = function (id) {
      process.nextTick(_ctx(run, id, 1));
    };
    // Sphere (JS game engine) Dispatch API
  } else if (Dispatch && Dispatch.now) {
    defer = function (id) {
      Dispatch.now(_ctx(run, id, 1));
    };
    // Browsers with MessageChannel, includes WebWorkers
  } else if (MessageChannel) {
    channel = new MessageChannel();
    port = channel.port2;
    channel.port1.onmessage = listener;
    defer = _ctx(port.postMessage, port, 1);
    // Browsers with postMessage, skip WebWorkers
    // IE8 has postMessage, but it's sync & typeof its postMessage is 'object'
  } else if (_global.addEventListener && typeof postMessage == 'function' && !_global.importScripts) {
    defer = function (id) {
      _global.postMessage(id + '', '*');
    };
    _global.addEventListener('message', listener, false);
    // IE8-
  } else if (ONREADYSTATECHANGE in _domCreate('script')) {
    defer = function (id) {
      _html.appendChild(_domCreate('script'))[ONREADYSTATECHANGE] = function () {
        _html.removeChild(this);
        run.call(id);
      };
    };
    // Rest old browsers
  } else {
    defer = function (id) {
      setTimeout(_ctx(run, id, 1), 0);
    };
  }
}
var _task = {
  set: setTask,
  clear: clearTask
};

var macrotask = _task.set;
var Observer = _global.MutationObserver || _global.WebKitMutationObserver;
var process$1 = _global.process;
var Promise = _global.Promise;
var isNode = _cof(process$1) == 'process';

var _microtask = function () {
  var head, last, notify;

  var flush = function () {
    var parent, fn;
    if (isNode && (parent = process$1.domain)) parent.exit();
    while (head) {
      fn = head.fn;
      head = head.next;
      try {
        fn();
      } catch (e) {
        if (head) notify();else last = undefined;
        throw e;
      }
    }last = undefined;
    if (parent) parent.enter();
  };

  // Node.js
  if (isNode) {
    notify = function () {
      process$1.nextTick(flush);
    };
    // browsers with MutationObserver, except iOS Safari - https://github.com/zloirock/core-js/issues/339
  } else if (Observer && !(_global.navigator && _global.navigator.standalone)) {
    var toggle = true;
    var node = document.createTextNode('');
    new Observer(flush).observe(node, { characterData: true }); // eslint-disable-line no-new
    notify = function () {
      node.data = toggle = !toggle;
    };
    // environments with maybe non-completely correct, but existent Promise
  } else if (Promise && Promise.resolve) {
    var promise = Promise.resolve();
    notify = function () {
      promise.then(flush);
    };
    // for other environments - macrotask based on:
    // - setImmediate
    // - MessageChannel
    // - window.postMessag
    // - onreadystatechange
    // - setTimeout
  } else {
    notify = function () {
      // strange IE + webpack dev server bug - use .call(global)
      macrotask.call(_global, flush);
    };
  }

  return function (fn) {
    var task = { fn: fn, next: undefined };
    if (last) last.next = task;
    if (!head) {
      head = task;
      notify();
    }last = task;
  };
};

// 25.4.1.5 NewPromiseCapability(C)


function PromiseCapability(C) {
  var resolve, reject;
  this.promise = new C(function ($$resolve, $$reject) {
    if (resolve !== undefined || reject !== undefined) throw TypeError('Bad Promise constructor');
    resolve = $$resolve;
    reject = $$reject;
  });
  this.resolve = _aFunction(resolve);
  this.reject = _aFunction(reject);
}

var f$1 = function (C) {
  return new PromiseCapability(C);
};

var _newPromiseCapability = {
  f: f$1
};

var _perform = function (exec) {
  try {
    return { e: false, v: exec() };
  } catch (e) {
    return { e: true, v: e };
  }
};

var _promiseResolve = function (C, x) {
  _anObject(C);
  if (_isObject(x) && x.constructor === C) return x;
  var promiseCapability = _newPromiseCapability.f(C);
  var resolve = promiseCapability.resolve;
  resolve(x);
  return promiseCapability.promise;
};

var _redefineAll = function (target, src, safe) {
  for (var key in src) {
    if (safe && target[key]) target[key] = src[key];else _hide(target, key, src[key]);
  }return target;
};

var SPECIES$1 = _wks('species');

var _setSpecies = function (KEY) {
  var C = typeof _core[KEY] == 'function' ? _core[KEY] : _global[KEY];
  if (_descriptors && C && !C[SPECIES$1]) _objectDp.f(C, SPECIES$1, {
    configurable: true,
    get: function () {
      return this;
    }
  });
};

var ITERATOR$3 = _wks('iterator');
var SAFE_CLOSING = false;

try {
  var riter = [7][ITERATOR$3]();
  riter['return'] = function () {
    SAFE_CLOSING = true;
  };
} catch (e) {/* empty */}

var _iterDetect = function (exec, skipClosing) {
  if (!skipClosing && !SAFE_CLOSING) return false;
  var safe = false;
  try {
    var arr = [7];
    var iter = arr[ITERATOR$3]();
    iter.next = function () {
      return { done: safe = true };
    };
    arr[ITERATOR$3] = function () {
      return iter;
    };
    exec(arr);
  } catch (e) {/* empty */}
  return safe;
};

var task = _task.set;
var microtask = _microtask();

var PROMISE = 'Promise';
var TypeError$1 = _global.TypeError;
var process$2 = _global.process;
var $Promise = _global[PROMISE];
var isNode$1 = _classof(process$2) == 'process';
var empty = function () {/* empty */};
var Internal, newGenericPromiseCapability, OwnPromiseCapability, Wrapper;
var newPromiseCapability = newGenericPromiseCapability = _newPromiseCapability.f;

var USE_NATIVE = !!function () {
  try {
    // correct subclassing with @@species support
    var promise = $Promise.resolve(1);
    var FakePromise = (promise.constructor = {})[_wks('species')] = function (exec) {
      exec(empty, empty);
    };
    // unhandled rejections tracking support, NodeJS Promise without it fails @@species test
    return (isNode$1 || typeof PromiseRejectionEvent == 'function') && promise.then(empty) instanceof FakePromise;
  } catch (e) {/* empty */}
}();

// helpers
var isThenable = function (it) {
  var then;
  return _isObject(it) && typeof (then = it.then) == 'function' ? then : false;
};
var notify = function (promise, isReject) {
  if (promise._n) return;
  promise._n = true;
  var chain = promise._c;
  microtask(function () {
    var value = promise._v;
    var ok = promise._s == 1;
    var i = 0;
    var run = function (reaction) {
      var handler = ok ? reaction.ok : reaction.fail;
      var resolve = reaction.resolve;
      var reject = reaction.reject;
      var domain = reaction.domain;
      var result, then;
      try {
        if (handler) {
          if (!ok) {
            if (promise._h == 2) onHandleUnhandled(promise);
            promise._h = 1;
          }
          if (handler === true) result = value;else {
            if (domain) domain.enter();
            result = handler(value);
            if (domain) domain.exit();
          }
          if (result === reaction.promise) {
            reject(TypeError$1('Promise-chain cycle'));
          } else if (then = isThenable(result)) {
            then.call(result, resolve, reject);
          } else resolve(result);
        } else reject(value);
      } catch (e) {
        reject(e);
      }
    };
    while (chain.length > i) run(chain[i++]); // variable length - can't use forEach
    promise._c = [];
    promise._n = false;
    if (isReject && !promise._h) onUnhandled(promise);
  });
};
var onUnhandled = function (promise) {
  task.call(_global, function () {
    var value = promise._v;
    var unhandled = isUnhandled(promise);
    var result, handler, console;
    if (unhandled) {
      result = _perform(function () {
        if (isNode$1) {
          process$2.emit('unhandledRejection', value, promise);
        } else if (handler = _global.onunhandledrejection) {
          handler({ promise: promise, reason: value });
        } else if ((console = _global.console) && console.error) {
          console.error('Unhandled promise rejection', value);
        }
      });
      // Browsers should not trigger `rejectionHandled` event if it was handled here, NodeJS - should
      promise._h = isNode$1 || isUnhandled(promise) ? 2 : 1;
    }promise._a = undefined;
    if (unhandled && result.e) throw result.v;
  });
};
var isUnhandled = function (promise) {
  return promise._h !== 1 && (promise._a || promise._c).length === 0;
};
var onHandleUnhandled = function (promise) {
  task.call(_global, function () {
    var handler;
    if (isNode$1) {
      process$2.emit('rejectionHandled', promise);
    } else if (handler = _global.onrejectionhandled) {
      handler({ promise: promise, reason: promise._v });
    }
  });
};
var $reject = function (value) {
  var promise = this;
  if (promise._d) return;
  promise._d = true;
  promise = promise._w || promise; // unwrap
  promise._v = value;
  promise._s = 2;
  if (!promise._a) promise._a = promise._c.slice();
  notify(promise, true);
};
var $resolve = function (value) {
  var promise = this;
  var then;
  if (promise._d) return;
  promise._d = true;
  promise = promise._w || promise; // unwrap
  try {
    if (promise === value) throw TypeError$1("Promise can't be resolved itself");
    if (then = isThenable(value)) {
      microtask(function () {
        var wrapper = { _w: promise, _d: false }; // wrap
        try {
          then.call(value, _ctx($resolve, wrapper, 1), _ctx($reject, wrapper, 1));
        } catch (e) {
          $reject.call(wrapper, e);
        }
      });
    } else {
      promise._v = value;
      promise._s = 1;
      notify(promise, false);
    }
  } catch (e) {
    $reject.call({ _w: promise, _d: false }, e); // wrap
  }
};

// constructor polyfill
if (!USE_NATIVE) {
  // 25.4.3.1 Promise(executor)
  $Promise = function Promise(executor) {
    _anInstance(this, $Promise, PROMISE, '_h');
    _aFunction(executor);
    Internal.call(this);
    try {
      executor(_ctx($resolve, this, 1), _ctx($reject, this, 1));
    } catch (err) {
      $reject.call(this, err);
    }
  };
  // eslint-disable-next-line no-unused-vars
  Internal = function Promise(executor) {
    this._c = []; // <- awaiting reactions
    this._a = undefined; // <- checked in isUnhandled reactions
    this._s = 0; // <- state
    this._d = false; // <- done
    this._v = undefined; // <- value
    this._h = 0; // <- rejection state, 0 - default, 1 - handled, 2 - unhandled
    this._n = false; // <- notify
  };
  Internal.prototype = _redefineAll($Promise.prototype, {
    // 25.4.5.3 Promise.prototype.then(onFulfilled, onRejected)
    then: function then(onFulfilled, onRejected) {
      var reaction = newPromiseCapability(_speciesConstructor(this, $Promise));
      reaction.ok = typeof onFulfilled == 'function' ? onFulfilled : true;
      reaction.fail = typeof onRejected == 'function' && onRejected;
      reaction.domain = isNode$1 ? process$2.domain : undefined;
      this._c.push(reaction);
      if (this._a) this._a.push(reaction);
      if (this._s) notify(this, false);
      return reaction.promise;
    },
    // 25.4.5.1 Promise.prototype.catch(onRejected)
    'catch': function (onRejected) {
      return this.then(undefined, onRejected);
    }
  });
  OwnPromiseCapability = function () {
    var promise = new Internal();
    this.promise = promise;
    this.resolve = _ctx($resolve, promise, 1);
    this.reject = _ctx($reject, promise, 1);
  };
  _newPromiseCapability.f = newPromiseCapability = function (C) {
    return C === $Promise || C === Wrapper ? new OwnPromiseCapability(C) : newGenericPromiseCapability(C);
  };
}

_export(_export.G + _export.W + _export.F * !USE_NATIVE, { Promise: $Promise });
_setToStringTag($Promise, PROMISE);
_setSpecies(PROMISE);
Wrapper = _core[PROMISE];

// statics
_export(_export.S + _export.F * !USE_NATIVE, PROMISE, {
  // 25.4.4.5 Promise.reject(r)
  reject: function reject(r) {
    var capability = newPromiseCapability(this);
    var $$reject = capability.reject;
    $$reject(r);
    return capability.promise;
  }
});
_export(_export.S + _export.F * (_library || !USE_NATIVE), PROMISE, {
  // 25.4.4.6 Promise.resolve(x)
  resolve: function resolve(x) {
    return _promiseResolve(_library && this === Wrapper ? $Promise : this, x);
  }
});
_export(_export.S + _export.F * !(USE_NATIVE && _iterDetect(function (iter) {
  $Promise.all(iter)['catch'](empty);
})), PROMISE, {
  // 25.4.4.1 Promise.all(iterable)
  all: function all(iterable) {
    var C = this;
    var capability = newPromiseCapability(C);
    var resolve = capability.resolve;
    var reject = capability.reject;
    var result = _perform(function () {
      var values = [];
      var index = 0;
      var remaining = 1;
      _forOf(iterable, false, function (promise) {
        var $index = index++;
        var alreadyCalled = false;
        values.push(undefined);
        remaining++;
        C.resolve(promise).then(function (value) {
          if (alreadyCalled) return;
          alreadyCalled = true;
          values[$index] = value;
          --remaining || resolve(values);
        }, reject);
      });
      --remaining || resolve(values);
    });
    if (result.e) reject(result.v);
    return capability.promise;
  },
  // 25.4.4.4 Promise.race(iterable)
  race: function race(iterable) {
    var C = this;
    var capability = newPromiseCapability(C);
    var reject = capability.reject;
    var result = _perform(function () {
      _forOf(iterable, false, function (promise) {
        C.resolve(promise).then(capability.resolve, reject);
      });
    });
    if (result.e) reject(result.v);
    return capability.promise;
  }
});

_export(_export.P + _export.R, 'Promise', { 'finally': function (onFinally) {
    var C = _speciesConstructor(this, _core.Promise || _global.Promise);
    var isFunction = typeof onFinally == 'function';
    return this.then(isFunction ? function (x) {
      return _promiseResolve(C, onFinally()).then(function () {
        return x;
      });
    } : onFinally, isFunction ? function (e) {
      return _promiseResolve(C, onFinally()).then(function () {
        throw e;
      });
    } : onFinally);
  } });

// https://github.com/tc39/proposal-promise-try


_export(_export.S, 'Promise', { 'try': function (callbackfn) {
    var promiseCapability = _newPromiseCapability.f(this);
    var result = _perform(callbackfn);
    (result.e ? promiseCapability.reject : promiseCapability.resolve)(result.v);
    return promiseCapability.promise;
  } });

var promise = _core.Promise;

var promise$1 = createCommonjsModule(function (module) {
  module.exports = { "default": promise, __esModule: true };
});

var _Promise = unwrapExports(promise$1);

var f$2 = Object.getOwnPropertySymbols;

var _objectGops = {
  f: f$2
};

var f$3 = {}.propertyIsEnumerable;

var _objectPie = {
  f: f$3
};

// 19.1.2.1 Object.assign(target, source, ...)


var $assign = Object.assign;

// should work with symbols and should have deterministic property order (V8 bug)
var _objectAssign = !$assign || _fails(function () {
  var A = {};
  var B = {};
  // eslint-disable-next-line no-undef
  var S = Symbol();
  var K = 'abcdefghijklmnopqrst';
  A[S] = 7;
  K.split('').forEach(function (k) {
    B[k] = k;
  });
  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
}) ? function assign(target, source) {
  // eslint-disable-line no-unused-vars
  var T = _toObject(target);
  var aLen = arguments.length;
  var index = 1;
  var getSymbols = _objectGops.f;
  var isEnum = _objectPie.f;
  while (aLen > index) {
    var S = _iobject(arguments[index++]);
    var keys = getSymbols ? _objectKeys(S).concat(getSymbols(S)) : _objectKeys(S);
    var length = keys.length;
    var j = 0;
    var key;
    while (length > j) if (isEnum.call(S, key = keys[j++])) T[key] = S[key];
  }return T;
} : $assign;

// 19.1.3.1 Object.assign(target, source)


_export(_export.S + _export.F, 'Object', { assign: _objectAssign });

var assign = _core.Object.assign;

var assign$1 = createCommonjsModule(function (module) {
  module.exports = { "default": assign, __esModule: true };
});

unwrapExports(assign$1);

var _extends = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _assign2 = _interopRequireDefault(assign$1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  exports.default = _assign2.default || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };
});

var _extends$1 = unwrapExports(_extends);

var i18n = {
  toolbar: {
    download: 'Download',
    share: 'Share',
    fullscreen: {
      enter: 'Enter fullscreen',
      exit: 'Exit fullscreen'
    }
  }
};

// most Object methods by ES6 should accept primitives


var _objectSap = function (KEY, exec) {
  var fn = (_core.Object || {})[KEY] || Object[KEY];
  var exp = {};
  exp[KEY] = exec(fn);
  _export(_export.S + _export.F * _fails(function () {
    fn(1);
  }), 'Object', exp);
};

// 19.1.2.14 Object.keys(O)


_objectSap('keys', function () {
  return function keys(it) {
    return _objectKeys(_toObject(it));
  };
});

var keys = _core.Object.keys;

var keys$1 = createCommonjsModule(function (module) {
  module.exports = { "default": keys, __esModule: true };
});

var _Object$keys = unwrapExports(keys$1);

var services = {
  facebook: {
    url: '//www.facebook.com/share.php?v=4&src=bm&u=%url%',
    name: 'Facebook',
    component: _facebook2.default
  },
  twitter: {
    url: '//twitter.com/home?status=%url%',
    name: 'Twitter',
    component: _twitter2.default
  },
  googleplus: {
    url: '//plus.google.com/share?url=%url%',
    name: 'Google Plus',
    component: _googlePlus2.default
  },
  reddit: {
    url: '//reddit.com/submit?url=%url%',
    name: 'Reddit',
    component: _reddit2.default
  },
  digg: {
    url: '//digg.com/submit?phase=2&url=%url%',
    name: 'Digg',
    component: _digg2.default
  },
  stumbleupon: {
    url: 'http://www.stumbleupon.com/submit?url=%url%&title=%title%',
    name: 'Stumbleupon',
    component: _stumbleupon2.default
  },
  delicious: {
    url: '//delicious.com/post?url=%url%',
    name: 'Delicious',
    component: _delicious2.default
  },
  pinterest: {
    url: 'https://www.pinterest.com/pin/create/button/?url=%url%&media=%image_url%&description=%description%&title=%title%',
    name: 'Pinterest',
    component: _pinterest2.default
  },
  vk: {
    url: 'http://vk.com/share.php?url=%url%',
    name: 'VK',
    component: _vk2.default
  }
};
function getShareUrl(service, item) {
  var tags = {
    url: window.location.href,
    image_url: __guard__(item.urls, function (x) {
      return x.image;
    }),
    title: item.title,
    description: item.description || ''
  };
  return _Object$keys(tags).reduce(function (url, tag) {
    return url.replace('%' + tag + '%', encodeURIComponent(tags[tag]));
  }, service.url);
}

function __guard__(value, transform) {
  return typeof value !== 'undefined' && value !== null ? transform(value) : undefined;
}

function guessType(url) {
  if (url.match(/\.(jpg|jpeg|png|gif|bmp|jfif|tif|jpe)$/i)) {
    return 'image';
  }
  if (url.match(/(youtube\.com|youtu\.be|vimeo\.com|\.mp4$)/i)) {
    return 'video';
  }
  if (url.match(/\.(html?$|php$|google\.com\/maps\/embed)/i)) {
    return 'iframe';
  }
  return 'image';
}
function options(options) {
  options = _extends$1({
    services: services,
    toolbar: { share: true },
    i18n: i18n,
    activeIndex: 0,
    carousel: true,
    theme: 'black'
  }, options);
  options.items.forEach(function (item, index) {
    item.index = index;
    if (!item.type) {
      item.type = item.url ? guessType(item.url) : 'image';
    }
  });
  return options;
}

function getContentType(item) {
  if (item.type) {
    return item.type;
  }
  if (item.html) {
    return 'html';
  }
  return 'image';
}
function getCarousel(prop) {
  if (prop.items.length <= 1) {
    return false;
  }
  return prop.carousel && window.innerWidth > 768;
}

var find = require('array.prototype.find');

var prefix = function prefix(prop) {
  return ['moz', 'ms', 'webkit'].map(function (prefix) {
    return '' + prefix + prop;
  });
};
var fullscreen = {
  supports: function supports() {
    var el = document.documentElement;
    if (el.requestFullscreen) {
      return true;
    }
    return !!find(prefix('RequestFullScreen'), function (prefixed) {
      return !!el[prefixed];
    });
  },
  is: function is() {
    var _arr = ['fullscreenEnabled', 'webkitFullscreenEnabled', 'mozFullscreenEnabled', 'msFullscreenEnabled'];

    for (var _i = 0; _i < _arr.length; _i++) {
      var method = _arr[_i];
      if (document[method]) {
        return document[method];
      }
    }
    return null;
  },
  enter: function enter(el) {
    if (!el) {
      el = document.documentElement;
    }
    var method = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullScreen;
    return method.apply(el);
  },
  exit: function exit() {
    var el = document.documentElement;
    var method = el.exitFullscreen || el.mozCancelFullScreen || el.msExitFullscreen;
    if (method) {
      method.apply(el);
    }
    if (document.webkitExitFullscreen) {
      return document.webkitExitFullscreen();
    }
  }
};

/* global location */
var hash = null;
function clearHash() {
  if (window.history && window.history.pushState) {
    window.history.pushState('', '', window.location.pathname);
  } else {
    window.location.href = window.location.href.replace(/#.*$/, '#');
  }
}
var deeplink = {
  init: function init() {
    if (location.hash) {
      hash = location.hash;
    }
  },
  set: function set(item) {
    try {
      if (item.hash) {
        location.hash = item.hash;
      } else {
        location.hash = hash || '';
      }
    } catch (error) {}
  },
  reset: function reset() {
    try {
      if (hash) {
        location.hash = hash;
      } else {
        clearHash();
      }
    } catch (error) {}
    hash = null;
  }
};

function prev(state) {
  if (state.activeIndex > 0) {
    state.activeIndex -= 1;
  }
  deeplink.set(state.items[state.activeIndex]);
}
function next(state) {
  if (state.activeIndex < state.items.length - 1) {
    state.activeIndex += 1;
  }
  deeplink.set(state.items[state.activeIndex]);
}
function getItem(state, item) {
  return state.items[item.index];
}
var store$1 = {
  'share.open': function shareOpen(state) {
    state.toolbar.shareActive = true;
  },
  'share.close': function shareClose(state) {
    state.toolbar.shareActive = false;
  },
  next: next,
  prev: prev,
  'item.thumbnail.click': function itemThumbnailClick(state, item) {
    state.activeIndex = item.index;
    deeplink.set(state.items[state.activeIndex]);
  },
  'item.load': function itemLoad(state, item) {
    getItem(state, item).loaded = true;
  },
  'item.unload': function itemUnload(state, item) {
    getItem(state, item).loaded = false;
  },

  'item.thumbnail.load': function itemThumbnailLoad(state, item) {
    getItem(state, item).thumbnailLoaded = true;
  },
  'item.thumbnail.error': function itemThumbnailError(state, item) {
    getItem(state, item).thumbnailError = true;
  },

  'touch.start': function touchStart(state, position) {
    state.touch = {
      start: position
    };
  },
  'touch.move': function touchMove(state, position) {
    state.touch.offset = {
      x: position.x - state.touch.start.x,
      y: position.y - state.touch.start.y
    };
  },
  'touch.end': function touchEnd(state, position) {
    var threshold = window.innerWidth / 3;
    if (state.touch && state.touch.offset) {
      var offset = state.touch.offset.x;
      if (offset > threshold && state.activeIndex > 0) {
        prev(state);
      }
      if (offset < -threshold && state.activeIndex < state.items.length - 1) {
        next(state);
      }
    }
    delete state.touch;
  },
  'fullscreen.enter': function fullscreenEnter(state) {
    fullscreen.enter();
    state.toolbar.isFullscreen = true;
  },
  'fullscreen.exit': function fullscreenExit(state) {
    fullscreen.exit();
    state.toolbar.isFullscreen = false;
  },
  'carousel.resize': function carouselResize(state, size) {
    state.carousel = size;
  }
};

// 19.1.2.9 Object.getPrototypeOf(O)


_objectSap('getPrototypeOf', function () {
  return function getPrototypeOf(it) {
    return _objectGpo(_toObject(it));
  };
});

var getPrototypeOf = _core.Object.getPrototypeOf;

var getPrototypeOf$1 = createCommonjsModule(function (module) {
  module.exports = { "default": getPrototypeOf, __esModule: true };
});

var _Object$getPrototypeOf = unwrapExports(getPrototypeOf$1);

var classCallCheck = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  exports.default = function (instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  };
});

var _classCallCheck = unwrapExports(classCallCheck);

// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
_export(_export.S + _export.F * !_descriptors, 'Object', { defineProperty: _objectDp.f });

var $Object = _core.Object;
var defineProperty = function defineProperty(it, key, desc) {
  return $Object.defineProperty(it, key, desc);
};

var defineProperty$1 = createCommonjsModule(function (module) {
  module.exports = { "default": defineProperty, __esModule: true };
});

unwrapExports(defineProperty$1);

var createClass = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _defineProperty2 = _interopRequireDefault(defineProperty$1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

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
});

var _createClass = unwrapExports(createClass);

var f$4 = _wks;

var _wksExt = {
  f: f$4
};

var iterator = _wksExt.f('iterator');

var iterator$1 = createCommonjsModule(function (module) {
  module.exports = { "default": iterator, __esModule: true };
});

unwrapExports(iterator$1);

var _meta = createCommonjsModule(function (module) {
  var META = _uid('meta');

  var setDesc = _objectDp.f;
  var id = 0;
  var isExtensible = Object.isExtensible || function () {
    return true;
  };
  var FREEZE = !_fails(function () {
    return isExtensible(Object.preventExtensions({}));
  });
  var setMeta = function (it) {
    setDesc(it, META, { value: {
        i: 'O' + ++id, // object ID
        w: {} // weak collections IDs
      } });
  };
  var fastKey = function (it, create) {
    // return primitive with prefix
    if (!_isObject(it)) return typeof it == 'symbol' ? it : (typeof it == 'string' ? 'S' : 'P') + it;
    if (!_has(it, META)) {
      // can't set metadata to uncaught frozen object
      if (!isExtensible(it)) return 'F';
      // not necessary to add metadata
      if (!create) return 'E';
      // add missing metadata
      setMeta(it);
      // return object ID
    }return it[META].i;
  };
  var getWeak = function (it, create) {
    if (!_has(it, META)) {
      // can't set metadata to uncaught frozen object
      if (!isExtensible(it)) return true;
      // not necessary to add metadata
      if (!create) return false;
      // add missing metadata
      setMeta(it);
      // return hash weak collections IDs
    }return it[META].w;
  };
  // add metadata on freeze-family methods calling
  var onFreeze = function (it) {
    if (FREEZE && meta.NEED && isExtensible(it) && !_has(it, META)) setMeta(it);
    return it;
  };
  var meta = module.exports = {
    KEY: META,
    NEED: false,
    fastKey: fastKey,
    getWeak: getWeak,
    onFreeze: onFreeze
  };
});
var _meta_1 = _meta.KEY;
var _meta_2 = _meta.NEED;
var _meta_3 = _meta.fastKey;
var _meta_4 = _meta.getWeak;
var _meta_5 = _meta.onFreeze;

var defineProperty$3 = _objectDp.f;
var _wksDefine = function (name) {
  var $Symbol = _core.Symbol || (_core.Symbol = _library ? {} : _global.Symbol || {});
  if (name.charAt(0) != '_' && !(name in $Symbol)) defineProperty$3($Symbol, name, { value: _wksExt.f(name) });
};

// all enumerable object keys, includes symbols


var _enumKeys = function (it) {
  var result = _objectKeys(it);
  var getSymbols = _objectGops.f;
  if (getSymbols) {
    var symbols = getSymbols(it);
    var isEnum = _objectPie.f;
    var i = 0;
    var key;
    while (symbols.length > i) if (isEnum.call(it, key = symbols[i++])) result.push(key);
  }return result;
};

// 7.2.2 IsArray(argument)

var _isArray = Array.isArray || function isArray(arg) {
  return _cof(arg) == 'Array';
};

// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)

var hiddenKeys = _enumBugKeys.concat('length', 'prototype');

var f$5 = Object.getOwnPropertyNames || function getOwnPropertyNames(O) {
  return _objectKeysInternal(O, hiddenKeys);
};

var _objectGopn = {
  f: f$5
};

// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window

var gOPN = _objectGopn.f;
var toString$1 = {}.toString;

var windowNames = typeof window == 'object' && window && Object.getOwnPropertyNames ? Object.getOwnPropertyNames(window) : [];

var getWindowNames = function (it) {
  try {
    return gOPN(it);
  } catch (e) {
    return windowNames.slice();
  }
};

var f$6 = function getOwnPropertyNames(it) {
  return windowNames && toString$1.call(it) == '[object Window]' ? getWindowNames(it) : gOPN(_toIobject(it));
};

var _objectGopnExt = {
  f: f$6
};

var gOPD = Object.getOwnPropertyDescriptor;

var f$7 = _descriptors ? gOPD : function getOwnPropertyDescriptor(O, P) {
  O = _toIobject(O);
  P = _toPrimitive(P, true);
  if (_ie8DomDefine) try {
    return gOPD(O, P);
  } catch (e) {/* empty */}
  if (_has(O, P)) return _propertyDesc(!_objectPie.f.call(O, P), O[P]);
};

var _objectGopd = {
  f: f$7
};

// ECMAScript 6 symbols shim


var META = _meta.KEY;

var gOPD$1 = _objectGopd.f;
var dP$1 = _objectDp.f;
var gOPN$1 = _objectGopnExt.f;
var $Symbol = _global.Symbol;
var $JSON = _global.JSON;
var _stringify = $JSON && $JSON.stringify;
var PROTOTYPE$2 = 'prototype';
var HIDDEN = _wks('_hidden');
var TO_PRIMITIVE = _wks('toPrimitive');
var isEnum = {}.propertyIsEnumerable;
var SymbolRegistry = _shared('symbol-registry');
var AllSymbols = _shared('symbols');
var OPSymbols = _shared('op-symbols');
var ObjectProto$1 = Object[PROTOTYPE$2];
var USE_NATIVE$1 = typeof $Symbol == 'function';
var QObject = _global.QObject;
// Don't use setters in Qt Script, https://github.com/zloirock/core-js/issues/173
var setter = !QObject || !QObject[PROTOTYPE$2] || !QObject[PROTOTYPE$2].findChild;

// fallback for old Android, https://code.google.com/p/v8/issues/detail?id=687
var setSymbolDesc = _descriptors && _fails(function () {
  return _objectCreate(dP$1({}, 'a', {
    get: function () {
      return dP$1(this, 'a', { value: 7 }).a;
    }
  })).a != 7;
}) ? function (it, key, D) {
  var protoDesc = gOPD$1(ObjectProto$1, key);
  if (protoDesc) delete ObjectProto$1[key];
  dP$1(it, key, D);
  if (protoDesc && it !== ObjectProto$1) dP$1(ObjectProto$1, key, protoDesc);
} : dP$1;

var wrap = function (tag) {
  var sym = AllSymbols[tag] = _objectCreate($Symbol[PROTOTYPE$2]);
  sym._k = tag;
  return sym;
};

var isSymbol = USE_NATIVE$1 && typeof $Symbol.iterator == 'symbol' ? function (it) {
  return typeof it == 'symbol';
} : function (it) {
  return it instanceof $Symbol;
};

var $defineProperty = function defineProperty(it, key, D) {
  if (it === ObjectProto$1) $defineProperty(OPSymbols, key, D);
  _anObject(it);
  key = _toPrimitive(key, true);
  _anObject(D);
  if (_has(AllSymbols, key)) {
    if (!D.enumerable) {
      if (!_has(it, HIDDEN)) dP$1(it, HIDDEN, _propertyDesc(1, {}));
      it[HIDDEN][key] = true;
    } else {
      if (_has(it, HIDDEN) && it[HIDDEN][key]) it[HIDDEN][key] = false;
      D = _objectCreate(D, { enumerable: _propertyDesc(0, false) });
    }return setSymbolDesc(it, key, D);
  }return dP$1(it, key, D);
};
var $defineProperties = function defineProperties(it, P) {
  _anObject(it);
  var keys = _enumKeys(P = _toIobject(P));
  var i = 0;
  var l = keys.length;
  var key;
  while (l > i) $defineProperty(it, key = keys[i++], P[key]);
  return it;
};
var $create = function create(it, P) {
  return P === undefined ? _objectCreate(it) : $defineProperties(_objectCreate(it), P);
};
var $propertyIsEnumerable = function propertyIsEnumerable(key) {
  var E = isEnum.call(this, key = _toPrimitive(key, true));
  if (this === ObjectProto$1 && _has(AllSymbols, key) && !_has(OPSymbols, key)) return false;
  return E || !_has(this, key) || !_has(AllSymbols, key) || _has(this, HIDDEN) && this[HIDDEN][key] ? E : true;
};
var $getOwnPropertyDescriptor = function getOwnPropertyDescriptor(it, key) {
  it = _toIobject(it);
  key = _toPrimitive(key, true);
  if (it === ObjectProto$1 && _has(AllSymbols, key) && !_has(OPSymbols, key)) return;
  var D = gOPD$1(it, key);
  if (D && _has(AllSymbols, key) && !(_has(it, HIDDEN) && it[HIDDEN][key])) D.enumerable = true;
  return D;
};
var $getOwnPropertyNames = function getOwnPropertyNames(it) {
  var names = gOPN$1(_toIobject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (!_has(AllSymbols, key = names[i++]) && key != HIDDEN && key != META) result.push(key);
  }return result;
};
var $getOwnPropertySymbols = function getOwnPropertySymbols(it) {
  var IS_OP = it === ObjectProto$1;
  var names = gOPN$1(IS_OP ? OPSymbols : _toIobject(it));
  var result = [];
  var i = 0;
  var key;
  while (names.length > i) {
    if (_has(AllSymbols, key = names[i++]) && (IS_OP ? _has(ObjectProto$1, key) : true)) result.push(AllSymbols[key]);
  }return result;
};

// 19.4.1.1 Symbol([description])
if (!USE_NATIVE$1) {
  $Symbol = function Symbol() {
    if (this instanceof $Symbol) throw TypeError('Symbol is not a constructor!');
    var tag = _uid(arguments.length > 0 ? arguments[0] : undefined);
    var $set = function (value) {
      if (this === ObjectProto$1) $set.call(OPSymbols, value);
      if (_has(this, HIDDEN) && _has(this[HIDDEN], tag)) this[HIDDEN][tag] = false;
      setSymbolDesc(this, tag, _propertyDesc(1, value));
    };
    if (_descriptors && setter) setSymbolDesc(ObjectProto$1, tag, { configurable: true, set: $set });
    return wrap(tag);
  };
  _redefine($Symbol[PROTOTYPE$2], 'toString', function toString() {
    return this._k;
  });

  _objectGopd.f = $getOwnPropertyDescriptor;
  _objectDp.f = $defineProperty;
  _objectGopn.f = _objectGopnExt.f = $getOwnPropertyNames;
  _objectPie.f = $propertyIsEnumerable;
  _objectGops.f = $getOwnPropertySymbols;

  if (_descriptors && !_library) {
    _redefine(ObjectProto$1, 'propertyIsEnumerable', $propertyIsEnumerable, true);
  }

  _wksExt.f = function (name) {
    return wrap(_wks(name));
  };
}

_export(_export.G + _export.W + _export.F * !USE_NATIVE$1, { Symbol: $Symbol });

for (var es6Symbols =
// 19.4.2.2, 19.4.2.3, 19.4.2.4, 19.4.2.6, 19.4.2.8, 19.4.2.9, 19.4.2.10, 19.4.2.11, 19.4.2.12, 19.4.2.13, 19.4.2.14
'hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables'.split(','), j = 0; es6Symbols.length > j;) _wks(es6Symbols[j++]);

for (var wellKnownSymbols = _objectKeys(_wks.store), k = 0; wellKnownSymbols.length > k;) _wksDefine(wellKnownSymbols[k++]);

_export(_export.S + _export.F * !USE_NATIVE$1, 'Symbol', {
  // 19.4.2.1 Symbol.for(key)
  'for': function (key) {
    return _has(SymbolRegistry, key += '') ? SymbolRegistry[key] : SymbolRegistry[key] = $Symbol(key);
  },
  // 19.4.2.5 Symbol.keyFor(sym)
  keyFor: function keyFor(sym) {
    if (!isSymbol(sym)) throw TypeError(sym + ' is not a symbol!');
    for (var key in SymbolRegistry) if (SymbolRegistry[key] === sym) return key;
  },
  useSetter: function () {
    setter = true;
  },
  useSimple: function () {
    setter = false;
  }
});

_export(_export.S + _export.F * !USE_NATIVE$1, 'Object', {
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
$JSON && _export(_export.S + _export.F * (!USE_NATIVE$1 || _fails(function () {
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
    if (!_isObject(replacer) && it === undefined || isSymbol(it)) return; // IE8 returns string on undefined
    if (!_isArray(replacer)) replacer = function (key, value) {
      if (typeof $replacer == 'function') value = $replacer.call(this, key, value);
      if (!isSymbol(value)) return value;
    };
    args[1] = replacer;
    return _stringify.apply($JSON, args);
  }
});

// 19.4.3.4 Symbol.prototype[@@toPrimitive](hint)
$Symbol[PROTOTYPE$2][TO_PRIMITIVE] || _hide($Symbol[PROTOTYPE$2], TO_PRIMITIVE, $Symbol[PROTOTYPE$2].valueOf);
// 19.4.3.5 Symbol.prototype[@@toStringTag]
_setToStringTag($Symbol, 'Symbol');
// 20.2.1.9 Math[@@toStringTag]
_setToStringTag(Math, 'Math', true);
// 24.3.3 JSON[@@toStringTag]
_setToStringTag(_global.JSON, 'JSON', true);

_wksDefine('asyncIterator');

_wksDefine('observable');

var symbol = _core.Symbol;

var symbol$1 = createCommonjsModule(function (module) {
  module.exports = { "default": symbol, __esModule: true };
});

unwrapExports(symbol$1);

var _typeof_1 = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _iterator2 = _interopRequireDefault(iterator$1);

  var _symbol2 = _interopRequireDefault(symbol$1);

  var _typeof = typeof _symbol2.default === "function" && typeof _iterator2.default === "symbol" ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj;
  };

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  exports.default = typeof _symbol2.default === "function" && _typeof(_iterator2.default) === "symbol" ? function (obj) {
    return typeof obj === "undefined" ? "undefined" : _typeof(obj);
  } : function (obj) {
    return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default && obj !== _symbol2.default.prototype ? "symbol" : typeof obj === "undefined" ? "undefined" : _typeof(obj);
  };
});

unwrapExports(_typeof_1);

var possibleConstructorReturn = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _typeof3 = _interopRequireDefault(_typeof_1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

  exports.default = function (self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }

    return call && ((typeof call === "undefined" ? "undefined" : (0, _typeof3.default)(call)) === "object" || typeof call === "function") ? call : self;
  };
});

var _possibleConstructorReturn = unwrapExports(possibleConstructorReturn);

// Works with __proto__ only. Old v8 can't work with null proto objects.
/* eslint-disable no-proto */

var check = function (O, proto) {
  _anObject(O);
  if (!_isObject(proto) && proto !== null) throw TypeError(proto + ": can't set as prototype!");
};
var _setProto = {
  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
  function (test, buggy, set) {
    try {
      set = _ctx(Function.call, _objectGopd.f(Object.prototype, '__proto__').set, 2);
      set(test, []);
      buggy = !(test instanceof Array);
    } catch (e) {
      buggy = true;
    }
    return function setPrototypeOf(O, proto) {
      check(O, proto);
      if (buggy) O.__proto__ = proto;else set(O, proto);
      return O;
    };
  }({}, false) : undefined),
  check: check
};

// 19.1.3.19 Object.setPrototypeOf(O, proto)

_export(_export.S, 'Object', { setPrototypeOf: _setProto.set });

var setPrototypeOf = _core.Object.setPrototypeOf;

var setPrototypeOf$1 = createCommonjsModule(function (module) {
  module.exports = { "default": setPrototypeOf, __esModule: true };
});

unwrapExports(setPrototypeOf$1);

// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
_export(_export.S, 'Object', { create: _objectCreate });

var $Object$1 = _core.Object;
var create = function create(P, D) {
  return $Object$1.create(P, D);
};

var create$1 = createCommonjsModule(function (module) {
  module.exports = { "default": create, __esModule: true };
});

unwrapExports(create$1);

var inherits = createCommonjsModule(function (module, exports) {

  exports.__esModule = true;

  var _setPrototypeOf2 = _interopRequireDefault(setPrototypeOf$1);

  var _create2 = _interopRequireDefault(create$1);

  var _typeof3 = _interopRequireDefault(_typeof_1);

  function _interopRequireDefault(obj) {
    return obj && obj.__esModule ? obj : { default: obj };
  }

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
});

var _inherits = unwrapExports(inherits);

var classnames = require('classnames');

function ShareMenu(props) {
  return _react2.default.createElement('div', { className: classnames('reactbox-share-menu', { 'reactbox-share-menu--open': props.open }) }, _Object$keys(props.services).map(function (slug) {
    var service = props.services[slug];
    return _react2.default.createElement('a', { target: '_blank', className: 'reactbox-share-link',
      key: slug,
      onClick: function onClick(e) {
        e.preventDefault();
        props.dispatch('share.close');
      },
      href: getShareUrl(service, props.activeItem) }, service.icon ? _react2.default.createElement('img', { src: service.icon, alt: '' }) : null, !service.icon && !!service.component ? _react2.default.createElement(service.component) : null, service.name);
  }));
}

var hasFullscreen = fullscreen.supports();

function Tooltip(props) {
  return _react2.default.createElement('span', { className: 'reactbox-tooltip' }, props.children);
}

var Toolbar = function (_React$Component) {
  _inherits(Toolbar, _React$Component);

  function Toolbar(props) {
    _classCallCheck(this, Toolbar);

    var _this = _possibleConstructorReturn(this, (Toolbar.__proto__ || _Object$getPrototypeOf(Toolbar)).call(this, props));

    _this.state = { shareOpen: false };
    _this.onWindowClickWhenSharing = _this.onWindowClickWhenSharing.bind(_this);
    return _this;
  }

  _createClass(Toolbar, [{
    key: 'componentWillUpdate',
    value: function componentWillUpdate(newProps, newState) {
      if (newState.shareOpen && !this.state.shareOpen) {
        window.addEventListener('click', this.onWindowClickWhenSharing, true);
      }
      if (!newState.shareOpen && this.state.shareOpen) {
        window.removeEventListener('click', this.onWindowClickWhenSharing, true);
      }
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      if (this.state.shareOpen) {
        window.removeEventListener('click', this.onWindowClickWhenSharing, true);
      }
    }
  }, {
    key: 'onWindowClickWhenSharing',
    value: function onWindowClickWhenSharing() {
      this.props.dispatch('share.close');
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var activeItem = props.items[props.activeIndex];
      return _react2.default.createElement('div', { className: 'reactbox-toolbar' }, _react2.default.createElement('a', { href: '#',
        onClick: function onClick(e) {
          e.preventDefault();props.dispatch('unmount');
        },
        className: 'reactbox-toolbar-close reactbox-toolbar-link' }, _react2.default.createElement(_close2.default, null)), hasFullscreen && !props.toolbar.isFullscreen ? _react2.default.createElement('a', { href: '#',
        onClick: function onClick(e) {
          e.preventDefault();
          props.dispatch('fullscreen.enter');
        },
        className: 'reactbox-toolbar-fullscreen reactbox-toolbar-link' }, _react2.default.createElement(_fullscreen2.default, null), _react2.default.createElement('span', { className: 'reactbox-tooltip' }, props.i18n.toolbar.fullscreen.enter)) : null, hasFullscreen && props.toolbar.isFullscreen ? _react2.default.createElement('a', { href: '#',
        className: 'reactbox-toolbar-link reactbox-toolbar-exit-fullscreen',
        onClick: function onClick(e) {
          e.preventDefault();
          props.dispatch('fullscreen.exit');
        } }, _react2.default.createElement(_fullscreenExit2.default, null), _react2.default.createElement(Tooltip, null, props.i18n.toolbar.fullscreen.exit)) : null, activeItem && _Object$keys(props.services).length > 0 && props.toolbar.share ? _react2.default.createElement('div', { className: 'reactbox-toolbar-link reactbox-toolbar-share' }, _react2.default.createElement(_share2.default, {
        onClick: function onClick(e) {
          e.preventDefault();
          _this2.setState({ 'shareOpen': true });
          props.dispatch('share.open');
        } }), _react2.default.createElement(Tooltip, null, props.i18n.toolbar.share), props.toolbar.shareActive ? _react2.default.createElement(ShareMenu, { dispatch: props.dispatch, open: this.state.shareOpen,
        services: props.services, activeItem: activeItem }) : null) : null, activeItem.download ? _react2.default.createElement('a', { className: 'reactbox-toolbar-download reactbox-toolbar-link',
        download: true, href: activeItem.download,
        target: '_blank' }, _react2.default.createElement(_fileDownload2.default, null), _react2.default.createElement(Tooltip, null, props.i18n.toolbar.download)) : null);
    }
  }]);

  return Toolbar;
}(_react2.default.Component);

function Loading(props) {
  return _react2.default.createElement('div', { className: 'reactbox-loading' });
}

function getStyle(item) {
  if (!item.description || !item.description.trim()) {
    return 'none';
  }
  if (item.descriptionStyle === 'right' && window.innerWidth < 1024) {
    return 'bottom';
  }
  return item.descriptionStyle || 'mini';
}

var classnames$1 = require('classnames');

function Wrap(props) {
  return _react2.default.createElement('div', { className: 'reactbox-lightbox-item-description' }, _react2.default.createElement('div', { className: 'reactbox-lightbox-item-description-inner' }, props.children));
}

var Description = function (_React$Component) {
  _inherits(Description, _React$Component);

  function Description() {
    _classCallCheck(this, Description);

    return _possibleConstructorReturn(this, (Description.__proto__ || _Object$getPrototypeOf(Description)).apply(this, arguments));
  }

  _createClass(Description, [{
    key: 'shouldComponentUpdate',
    value: function shouldComponentUpdate() {
      return false;
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var item = props.item;
      var style = getStyle(item);
      var Scroll = style === 'bottom' ? Wrap : _reactScrollbar2.default;
      return _react2.default.createElement(Scroll, { className: classnames$1('reactbox-lightbox-item-description', { 'reactbox-description-light': style === 'right' && item.type == 'video' }),
        speed: 0.8,
        horizontal: false,
        contentClassName: 'reactbox-lightbox-item-description-inner' }, !!item.description ? _react2.default.createElement('div', { className: 'reactbox-lightbox-item-description-content',
        dangerouslySetInnerHTML: { __html: item.description } }) : null);
    }
  }]);

  return Description;
}(_react2.default.Component);

function includes(list, item) {
  return list.indexOf(item) !== -1;
}

var camelcase = require('uppercamelcase');

var defaultPrefixes = ['Moz', 'Webkit', 'O', 'MS'];
var prefixedKeys = {
  'transform': defaultPrefixes,
  'border-radius': defaultPrefixes,
  'transition': defaultPrefixes,
  'box-sizing': ['moz']
};
function mapObject(object, callback) {
  if (!object) {
    return object;
  }
  return _Object$keys(object).reduce(function (result, key) {
    result[key] = callback(object[key], key, object);
    return result;
  }, {});
}
function capitalize(str) {
  return str[0].toUpperCase() + str.substr(1);
}
function concatWith(suffix) {
  return function (str) {
    return str + suffix;
  };
}
function pixels(style) {
  return mapObject(style, concatWith('px'));
}
var css = {
  prefix: function prefix(styles) {
    return _Object$keys(styles).reduce(function (result, key) {
      var prefixes = prefixedKeys[key];
      if (prefixes) {
        result = prefixes.reduce(function (result, prefix) {
          result[prefix + capitalize(camelcase(key))] = styles[key];
          return result;
        }, result);
      }
      result[key] = styles[key];
      return result;
    }, {});
  },
  camelize: function camelize(styles) {
    return _Object$keys(styles).reduce(function (result, key) {
      if (includes(_Object$keys(prefixedKeys), key)) {
        result[camelcase(key)] = styles[key];
      } else {
        result[key] = styles[key];
      }
      return result;
    }, {});
  }
};

var classnames$2 = require('classnames');

function maybeApply(obj, func) {
  return func ? func(obj) : obj;
}

var Iframe = function (_React$Component) {
  _inherits(Iframe, _React$Component);

  function Iframe(props) {
    _classCallCheck(this, Iframe);

    var _this = _possibleConstructorReturn(this, (Iframe.__proto__ || _Object$getPrototypeOf(Iframe)).call(this, props));

    _this.state = { size: { width: 0, height: 0 } };
    _this.updateSize = _this.updateSize.bind(_this);
    return _this;
  }

  _createClass(Iframe, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.updateSize();
      window.addEventListener('resize', this.updateSize);
    }
  }, {
    key: 'updateSize',
    value: function updateSize() {
      var node = this.refs.this;
      this.setState({ size: { width: node.clientWidth, height: node.clientHeight } });
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.updateSize);
    }
  }, {
    key: 'render',
    value: function render() {
      var _this2 = this;

      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var style = pixels(maybeApply(this.state.size, props.resize));
      return _react2.default.createElement('div', { className: classnames$2('reactbox-lightbox-item-object', 'reactbox-object-iframe', props.className), ref: 'this' }, _react2.default.createElement('iframe', { src: props.src,
        style: style,
        onLoad: function onLoad() {
          props.dispatch('item.load', props.item);_this2.updateSize();
        } }));
    }
  }]);

  return Iframe;
}(_react2.default.Component);

function aspect(thing) {
  return thing.width / thing.height;
}

function fits(a, b) {
  return a.width > b.width && a.height > b.height;
}

function resize(container, content, decision) {
  if (decision(aspect(container), aspect(content))) {
    return fitWidth(container, content);
  } else {
    return fitHeight(container, content);
  }
}

function getHeight(container, content) {
  return container.width / aspect(content);
}

function getWidth(container, content) {
  return container.height * aspect(content);
}

function fitWidth(container, content) {
  return {
    width: container.width,
    height: getHeight(container, content)
  };
}

function fitHeight(container, content) {
  return {
    height: container.height,
    width: getWidth(container, content)
  };
}

function valign(container, size) {
  return _extends$1({}, size, { top: (container.height - size.height) / 2 });
}

function halign(container, size) {
  return _extends$1({}, size, { left: (container.width - size.width) / 2 });
}

function align(container, size) {
  if (!container || !size) {
    return null;
  }
  if (size.width < container.width && size.height < container.height) {
    return valign(container, halign(container, size));
  }
  if (size.width > container.width) {
    return valign(container, size);
  } else {
    return halign(container, size);
  }
}

function fit(container, content) {
  if (fits(container, content)) {
    return content;
  }
  return resize(container, content, function (container, content) {
    return container < content;
  });
}

function fill(container, content) {
  return resize(container, content, function (container, content) {
    return container > content;
  });
}

var asap = require('asap');

var onItemLoad = function onItemLoad(props) {
  return function (event) {
    props.item.size = {
      width: event.target.naturalWidth,
      height: event.target.naturalHeight
    };
    props.dispatch('item.load', props.item);
  };
};

function getImageStyle(state, item) {
  if (!item.size || !state || includes(['right', 'bottom'], getStyle(item))) {
    return;
  }
  if (includes(['none', 'mini'], getStyle(item))) {
    return valign(state, fit(state, item.size));
  }
  return fill(state, item.size);
}

var Image = function (_React$Component) {
  _inherits(Image, _React$Component);

  function Image(props) {
    _classCallCheck(this, Image);

    var _this = _possibleConstructorReturn(this, (Image.__proto__ || _Object$getPrototypeOf(Image)).call(this, props));

    _this.updateSize = _this.updateSize.bind(_this);
    return _this;
  }

  _createClass(Image, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.updateSize();
      window.addEventListener('resize', this.updateSize);
      if (!this.props.item.url) {
        asap(onItemLoad(this.props));
      }
    }
  }, {
    key: 'updateSize',
    value: function updateSize() {
      var node = this.refs.this;
      this.setState({
        width: node.clientWidth,
        height: node.clientHeight
      });
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.updateSize);
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var state = this.state;
      var item = props.item;
      return _react2.default.createElement('div', { className: 'reactbox-lightbox-item-object reactbox-object-image',
        ref: 'this' }, !!item.url ? _react2.default.createElement('img', { className: 'reactbox-lightbox-content-image',
        style: pixels(align(state, getImageStyle(state, item))),
        src: item.url,
        alt: item.alt,
        onLoad: onItemLoad(props)
      }) : null);
    }
  }]);

  return Image;
}(_react2.default.Component);

var find$1 = require('array.prototype.find');

function load(tag, id, srcAttr, srcVal, attr) {
  return new _Promise(function (resolve, reject) {
    var el = document.getElementById(id);
    if (el) {
      el.addEventListener('load', resolve);
      resolve();
    }
    el = document.createElement(tag);
    el.id = id;
    el[srcAttr] = srcVal;
    if (attr) {
      _Object$keys(attr).forEach(function (key) {
        el.setAttribute(key, attr[key]);
      });
    }
    document.head.appendChild(el);
    el.addEventListener('load', resolve);
    el.addEventListener('error', reject);
  });
}

var tests = {
  youtube: /(.*(\(\/\/)?(www\.)?youtube\.com\/watch\?v=)|(.*(\/\/)?(www\.)?youtu\.be\/.*)|((https?:)?(\/\/)?(www\.)?youtube\.com\/embed\/)/,
  vimeo: /(https?:)?(\/\/)?(www\.)?vimeo\.com\/\d+/,
  mp4: /\.mp4$/
};

var extractors = {
  youtube: function youtube(url) {
    var regex = void 0;
    if (url.match(regex = /.*(\(\/\/)?(www\.)?youtube\.com\/watch\?v=/)) {
      return url.replace(regex, '');
    }
    if (url.match(regex = /.*(\/\/)?(www\.)?youtu\.be\//)) {
      return url.replace(regex, '');
    }
    return url.replace(/(https?:)?(\/\/)?(www\.)?youtube\.com\/embed\//, '');
  },
  vimeo: function vimeo(url) {
    return url.replace(/(https?:)?(\/\/)?(www\.)?vimeo\.com\//, '');
  },
  mp4: function mp4(url) {
    return url;
  }
};

var formatters = {
  youtube: function youtube(id) {
    return 'https://youtube.com/embed/' + id;
  },
  vimeo: function vimeo(id) {
    return 'https://player.vimeo.com/video/' + id;
  },
  mp4: function mp4(id) {
    return id;
  }
};

function getSrc(item) {
  var url = item.url;
  var service = find$1(_Object$keys(tests), function (key) {
    return url.match(tests[key]);
  });
  var id = extractors[service](url);
  return formatters[service](id);
}

function _resize(size, style) {
  if (style === 'bottom') {
    return {
      width: size.width,
      height: size.height > 0 ? size.height : 483
    };
  }
  var standard = size.width / 16 * 9;
  if (size.height > standard) {
    var newSize = _extends$1({}, size, { height: standard });
    return style === 'right' ? newSize : valign(size, newSize);
  }
  return size;
}

function IframeVideo(props) {
  return _react2.default.createElement(Iframe, _extends$1({}, props, { src: getSrc(props.item), full: false,
    className: 'reactbox-object-video',
    vAlign: getStyle(props.item) !== 'right',
    resize: function resize(size) {
      return _resize(size, getStyle(props.item));
    },
    fitWidth: getStyle(props.item) === 'bottom' }));
}
function loadVideoJS(callback) {
  return _Promise.all(load('script', 'reactbox-video-js-loader', 'src', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/5.10.7/video.js'), load('link', 'reactbox-video-js-css', 'href', 'https://cdnjs.cloudflare.com/ajax/libs/video.js/5.10.7/video-js.min.css', { rel: 'stylesheet' }));
}

var VideoJSVideo = function (_React$Component) {
  _inherits(VideoJSVideo, _React$Component);

  function VideoJSVideo(props) {
    _classCallCheck(this, VideoJSVideo);

    var _this = _possibleConstructorReturn(this, (VideoJSVideo.__proto__ || _Object$getPrototypeOf(VideoJSVideo)).call(this, props));

    _this.state = { size: { width: 0, height: 0 } };
    _this.onResize = _this.onResize.bind(_this);
    return _this;
  }

  _createClass(VideoJSVideo, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      var _this2 = this;

      var props = this.props;
      loadVideoJS().then(function () {
        props.dispatch('item.load', props.item).then(function () {
          _this2.updateSize(function () {
            window.addEventListener('resize', _this2.onResize);
            loadVideoJS().then(function () {
              props.dispatch('item.load', props.item);
              var player = window.videojs(_this2.getVideoId());
              player.ready(function () {
                return _this2.setState({ player: player });
              });
            });
          });
        });
      });
    }
  }, {
    key: 'updateSize',
    value: function updateSize(callback) {
      var node = this.refs.this.parentElement;
      this.setState({
        size: {
          width: node.clientWidth,
          height: node.clientHeight
        }
      }, callback);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.onResize);
      if (this.state.player) {
        this.state.player.dispose();
      }
    }
  }, {
    key: 'onResize',
    value: function onResize() {
      this.updateSize();
    }
  }, {
    key: 'getVideoId',
    value: function getVideoId() {
      return 'reactbox-video-' + this.props.item.index;
    }
  }, {
    key: 'getIframeStyle',
    value: function getIframeStyle(item) {
      return this.state.size;
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var item = props.item;
      var iframeStyle = this.getIframeStyle(item);
      return _react2.default.createElement('div', { className: 'video-js-wrapper', style: iframeStyle, ref: 'this' }, _react2.default.createElement('video', { id: this.getVideoId(), controls: true, preload: 'auto',
        poster: item.thumbnail,
        style: { width: '100%', height: '100%' },
        className: 'video-js' }, _react2.default.createElement('source', { src: item.url })));
    }
  }]);

  return VideoJSVideo;
}(_react2.default.Component);

function Video(props) {
  if (props.item.url.match(tests.mp4)) {
    return _react2.default.createElement(VideoJSVideo, props);
  } else {
    return _react2.default.createElement(IframeVideo, props);
  }
}

var ajax$1 = require('atomicjs');

var Ajax = function (_React$Component) {
  _inherits(Ajax, _React$Component);

  function Ajax(props) {
    _classCallCheck(this, Ajax);

    var _this = _possibleConstructorReturn(this, (Ajax.__proto__ || _Object$getPrototypeOf(Ajax)).call(this, props));

    _this.state = { html: '' };
    _this.onAjaxLoaded = _this.onAjaxLoaded.bind(_this);
    _this.onAjaxError = _this.onAjaxError.bind(_this);
    return _this;
  }

  _createClass(Ajax, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      ajax$1.get(this.props.item.url).success(this.onAjaxLoaded).error(this.onAjaxError);
    }
  }, {
    key: 'onAjaxError',
    value: function onAjaxError() {
      this.props.dispatch('item.error', this.props.item);
    }
  }, {
    key: 'onAjaxLoaded',
    value: function onAjaxLoaded(html) {
      this.setState({ html: html });
      this.props.dispatch('item.load', this.props.item);
    }
  }, {
    key: 'render',
    value: function render() {
      return _react2.default.createElement('div', { className: 'reactbox-lightbox-item-object reactbox-lightbox-item-ajax-object',
        dangerouslySetInnerHTML: { __html: this.state.html } });
    }
  }]);

  return Ajax;
}(_react2.default.Component);

var Html = function (_React$Component) {
  _inherits(Html, _React$Component);

  function Html() {
    _classCallCheck(this, Html);

    return _possibleConstructorReturn(this, (Html.__proto__ || _Object$getPrototypeOf(Html)).apply(this, arguments));
  }

  _createClass(Html, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.props.dispatch('item.load', this.props.item);
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      return _react2.default.createElement('div', {
        className: 'reactbox-lightbox-item-object reactbox-lightbox-item-html-object',
        dangerouslySetInnerHTML: { __html: props.item.html } });
    }
  }]);

  return Html;
}(_react2.default.Component);

function iframe$1(props) {
  return _react2.default.createElement(Iframe, _extends$1({}, props, { src: props.item.url }));
}

var content = Object.freeze({
  image: Image,
  video: Video,
  ajax: Ajax,
  html: Html,
  iframe: iframe$1
});

var classnames$3 = require('classnames');

function getOffset(props) {
  return props.touch && props.touch.offset ? props.touch.offset : { x: 0, y: 0 };
}
function isActiveItem(item, props) {
  return item.index === props.activeIndex;
}
function isPreviousItem(item, props) {
  return item.index < props.activeIndex;
}
function isNextItem(item, props) {
  return item.index > props.activeIndex;
}
function getTransform(props) {
  var item = props.item;
  var metrics = props.metrics;
  var offset = getOffset(props);
  if (isActiveItem(props.item, props)) {
    return 'translate(' + offset.x + 'px, 0)';
  }
  if (isPreviousItem(item, props)) {
    return 'translate(' + (-metrics.width + offset.x) + 'px, 0)';
  }
  if (isNextItem(item, props)) {
    return 'translate(' + (metrics.width + offset.x) + 'px, 0)';
  }
}

var LightboxItem = function (_React$Component) {
  _inherits(LightboxItem, _React$Component);

  function LightboxItem(props) {
    _classCallCheck(this, LightboxItem);

    var _this = _possibleConstructorReturn(this, (LightboxItem.__proto__ || _Object$getPrototypeOf(LightboxItem)).call(this, props));

    _this.state = {};
    _this.updateSize = _this.updateSize.bind(_this);
    return _this;
  }

  _createClass(LightboxItem, [{
    key: 'calcStyle',
    value: function calcStyle() {
      var props = this.props;
      var metrics = props.metrics;
      if (!props.metrics) {
        return null;
      }
      return {
        transform: getTransform(props),
        left: 0,
        top: 0,
        width: metrics.width + 'px',
        height: metrics.height + 'px'
      };
    }
  }, {
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.updateSize();
      window.addEventListener('resize', this.updateSize);
      var _ = jQuery || $;
      _(window).trigger('lightbox:item:add', _reactDom2.default.findDOMNode(this));
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.updateSize);
      this.props.dispatch('item.unload', this.props.item);
      var _ = jQuery || $;
      _(window).trigger('lightbox:item:remove', _reactDom2.default.findDOMNode(this));
    }
  }, {
    key: 'updateSize',
    value: function updateSize() {
      var node = this.refs.this;
      this.setState({
        size: { width: node.clientWidth, height: node.clientHeight }
      });
    }
  }, {
    key: 'componentWillReceiveProps',
    value: function componentWillReceiveProps(props) {
      this.setState({
        animated: Math.abs(props.activeIndex - this.props.activeIndex) < 2 });
    }
  }, {
    key: 'getContentStyle',
    value: function getContentStyle() {
      if (!this.refs.content) {
        return null;
      }
      var offset = getCarousel(this.props) ? 130 : 24;
      if (getStyle(this.props.item) === 'bottom' && this.refs.content.offsetHeight < this.state.size.height - offset) {
        return { top: (this.state.size.height - offset + 54 - this.refs.content.offsetHeight) / 2 };
      }
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var item = props.item;
      var descriptionStyle = getStyle(item);
      var type = getContentType(item);
      var style = css.prefix(this.calcStyle());
      return _react2.default.createElement('div', { className: classnames$3('reactbox-lightbox-item', 'reactbox-description-' + descriptionStyle, 'reactbox-content-' + type, {
          'reactbox-lightbox-active': isActiveItem(item, props),
          'reactbox-lightbox-next': isNextItem(item, props),
          'reactbox-lightbox-prev': isPreviousItem(item, props),
          'reactbox-loaded': item.loaded,
          'reactbox-animated': this.state.animated
        }), style: style, ref: 'this' }, _react2.default.createElement('div', { className: 'reactbox-lightbox-item-content',
        style: this.getContentStyle(),
        ref: 'content' }, _react2.default.createElement(content[type], props), descriptionStyle !== 'none' ? _react2.default.createElement(Description, props) : null), !item.loaded ? _react2.default.createElement(Loading, props) : null);
    }
  }]);

  return LightboxItem;
}(_react2.default.Component);

var classnames$4 = require('classnames');

var Icons = function (_React$Component) {
  _inherits(Icons, _React$Component);

  function Icons() {
    _classCallCheck(this, Icons);

    return _possibleConstructorReturn(this, (Icons.__proto__ || _Object$getPrototypeOf(Icons)).apply(this, arguments));
  }

  _createClass(Icons, [{
    key: 'shouldComponentUpdate',
    value: function shouldComponentUpdate(nextProps) {
      return nextProps.activeIndex !== this.props.activeIndex;
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var prevClasses = classnames$4(['reactbox-prev'], { 'reactbox-disabled': props.activeIndex === 0 });
      var nextClasses = classnames$4(['reactbox-next', { 'reactbox-disabled': props.activeIndex >= props.items.length - 1 }]);
      return props.items.length > 1 ? _react2.default.createElement('div', { className: 'reactbox-prev-next' }, _react2.default.createElement('div', { className: prevClasses,
        onClick: function onClick() {
          return props.dispatch('prev');
        } }, _react2.default.createElement(_arrowBack2.default, { size: 100 })), _react2.default.createElement('div', { className: nextClasses,
        onClick: function onClick() {
          return props.dispatch('next');
        } }, _react2.default.createElement(_arrowForward2.default, { size: 100 }))) : null;
    }
  }]);

  return Icons;
}(_react2.default.Component);

var Lightbox = function (_React$Component2) {
  _inherits(Lightbox, _React$Component2);

  function Lightbox(props) {
    _classCallCheck(this, Lightbox);

    var _this2 = _possibleConstructorReturn(this, (Lightbox.__proto__ || _Object$getPrototypeOf(Lightbox)).call(this, props));

    _this2.state = {};
    _this2.calcMetrics = _this2.calcMetrics.bind(_this2);
    return _this2;
  }

  _createClass(Lightbox, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      window.addEventListener('resize', this.calcMetrics);
      this.calcMetrics();
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.calcMetrics);
    }
  }, {
    key: 'calcMetrics',
    value: function calcMetrics() {
      var node = this.refs.lightbox;
      this.setState({
        metrics: {
          left: node.offsetLeft,
          top: node.offsetTop,
          width: node.clientWidth,
          height: node.clientHeight
        }
      });
    }
  }, {
    key: 'render',
    value: function render() {
      var props = this.props;
      var metrics = this.state.metrics;
      var items = [props.items[props.activeIndex]];
      var activeIndex = props.activeIndex;
      if (activeIndex > 0) {
        items.unshift(props.items[activeIndex - 1]);
      }
      if (activeIndex < props.items.length - 1) {
        items.push(props.items[activeIndex + 1]);
      }
      return _react2.default.createElement('div', { className: 'reactbox-lightbox', ref: 'lightbox' }, _react2.default.createElement(Icons, { items: props.items, activeIndex: activeIndex,
        dispatch: props.dispatch }), !!metrics ? items.map(function (item, index) {
        return _react2.default.createElement(LightboxItem, _extends$1({}, props, { item: item, metrics: metrics,
          key: item.index }));
      }, this) : null);
    }
  }]);

  return Lightbox;
}(_react2.default.Component);

var classnames$5 = require('classnames');
var find$2 = require('array.prototype.find');
var property = require('dot-prop').get;

var onClick = function onClick(props) {
  return function (e) {
    e.preventDefault();
    props.dispatch('item.thumbnail.click', props.item);
  };
};

var onError = function onError(props) {
  return function (e) {
    return props.dispatch('item.thumbnail.error', props.item);
  };
};

var onLoad = function onLoad(props) {
  return function (e) {
    props.item.thumbnailSize = { width: e.target.naturalWidth,
      height: e.target.naturalHeight };
    props.dispatch('item.thumbnail.load', props.item);
  };
};

function thumbnailTransform(props) {
  return { transform: translate(props.left, props.top) };
}
function translate(x, y) {
  return 'translate(' + x + 'px, ' + (y || 0) + 'px)';
}

function Item(props) {
  var imageStyle = css.prefix(thumbnailTransform(props));
  var classes = classnames$5('reactbox-carousel-item', {
    'reactbox-active': props.item.index === props.activeIndex,
    'reactbox-loaded': props.item.thumbnailLoaded || props.item.thumbnailError,
    'reactbox-error': props.item.thumbnailError,
    'reactbox-animated': props.item.thumbnailLoaded || props.item.thumbnailError
  });
  var item = props.item;
  return _react2.default.createElement('div', { className: classes, onClick: onClick(props), style: imageStyle }, !item.error ? _react2.default.createElement('img', { src: item.thumbnail,
    onLoad: onLoad(props),
    onError: onError(props),
    alt: item.alt
  }) : null, item.error ? _react2.default.createElement(_close2.default, null) : null);
}

function getItemWidth(props, item) {
  if (!item.thumbnail || item.thumbnailError) {
    return 100;
  }
  if (!item.thumbnailSize) {
    return 0;
  }
  return props.carousel.height * item.thumbnailSize.width / item.thumbnailSize.height;
}

function getLeftForActive(props) {
  return window.innerWidth / 2 - getItemWidth(props, props.items[props.activeIndex]) / 2;
}

function visible(props) {
  var items = props.items;
  var current = items[props.activeIndex];
  var left = getLeftForActive(props);
  var visible = [{ item: current, left: left }];
  var windowWidth = window.innerWidth;

  if (current.index < items.length - 1) {
    for (var i = current.index + 1; i < items.length; i++) {
      var _item = items[i];
      left = left + getItemWidth(props, items[i - 1]) + 12;
      visible.push({ item: _item, left: left });
      if (!(_item.thumbnailSize && (_item.thumbnailLoaded || _item.thumbnailError)) || _item.left > windowWidth * 1.5) {
        break;
      }
    }
  }
  left = getLeftForActive(props);
  if (current.index > 0 && (current.thumbnailLoaded || current.thumbnailError)) {
    for (var _i = current.index - 1; _i >= 0; _i--) {
      var _item2 = items[_i];
      left = left - getItemWidth(props, items[_i]) - 12;
      visible.unshift({ item: _item2, left: left });
      if (!(_item2.thumbnailSize && (_item2.thumbnailLoaded || _item2.thumbnailError)) || _item2.left < -(windowWidth + getItemWidth(props, _item2))) {
        break;
      }
    }
  }
  return visible;
}

var Carousel = function (_React$Component) {
  _inherits(Carousel, _React$Component);

  function Carousel(props) {
    _classCallCheck(this, Carousel);

    var _this = _possibleConstructorReturn(this, (Carousel.__proto__ || _Object$getPrototypeOf(Carousel)).call(this, props));

    _this.onWindowResize = _this.onWindowResize.bind(_this);
    return _this;
  }

  _createClass(Carousel, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.onWindowResize();
      window.addEventListener('resize', this.onWindowResize);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.onWindowResize);
    }
  }, {
    key: 'onWindowResize',
    value: function onWindowResize() {
      var node = this.refs.carousel;
      this.props.dispatch('carousel.resize', { width: node.clientWidth, height: node.clientHeight });
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      return _react2.default.createElement('div', { className: 'reactbox-carousel', ref: 'carousel' }, props.carousel ? visible(props).map(function (item, index) {
        return _react2.default.createElement(Item, _extends$1({}, props, { item: item.item, key: item.item.index,
          left: item.left }));
      }, this) : null);
    }
  }]);

  return Carousel;
}(_react2.default.Component);

var classnames$6 = require('classnames');

var getReactboxClasses = function getReactboxClasses(props) {
  return classnames$6('reactbox', {
    'reactbox-horizontal': true,
    'reactbox-has-carousel': getCarousel(props)
  }, 'reactbox--theme-' + props.theme);
};

var Reactbox = function (_React$Component) {
  _inherits(Reactbox, _React$Component);

  function Reactbox(props) {
    _classCallCheck(this, Reactbox);

    var _this = _possibleConstructorReturn(this, (Reactbox.__proto__ || _Object$getPrototypeOf(Reactbox)).call(this, props));

    _this.state = { width: window.innerWidth };
    _this.onWindowResize = _this.onWindowResize.bind(_this);
    return _this;
  }

  _createClass(Reactbox, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      window.addEventListener('resize', this.onWindowResize);
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      window.removeEventListener('resize', this.onWindowResize);
    }
  }, {
    key: 'onWindowResize',
    value: function onWindowResize() {
      this.setState({ width: window.innerWidth });
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      return _react2.default.createElement('div', { className: getReactboxClasses(props) }, _react2.default.createElement(Toolbar, props), _react2.default.createElement(Lightbox, props), !!getCarousel(props) ? _react2.default.createElement(Carousel, props) : null);
    }
  }]);

  return Reactbox;
}(_react2.default.Component);

function Keyboard(dispatch) {
  var onKeyDown = function onKeyDown(e) {
    if (e.which === 27) {
      dispatch('unmount');
    }
    if (e.which === 37 || e.which === 38) {
      dispatch('prev');
    }
    if (e.which === 40 || e.which === 39) {
      return dispatch('next');
    }
  };

  return {
    enable: function enable() {
      return window.addEventListener('keydown', onKeyDown);
    },
    disable: function disable() {
      return window.removeEventListener('keydown', onKeyDown);
    }
  };
}

function pageToXY(touch) {
  return { x: touch.pageX, y: touch.pageY };
}
function Touch(dispatch) {
  var onTouchStart = function onTouchStart(e) {
    if (e.target.closest('.reactbox-toolbar-wrapper, .reactbox-prev, .reactbox-next')) {
      return;
    }
    return dispatch('touch.start', pageToXY(e.touches[0]));
  };
  var onTouchEnd = function onTouchEnd(e) {
    var original = e.changedTouches[0];
    if (original) {
      dispatch('touch.end', pageToXY(e.changedTouches[0]));
    }
  };
  var onTouchMove = function onTouchMove(e) {
    var touch = e.touches[0];
    dispatch('touch.move', pageToXY(touch));
  };

  return {
    enable: function enable() {
      window.addEventListener('touchstart', onTouchStart);
      window.addEventListener('touchend', onTouchEnd);
      window.addEventListener('touchmove', onTouchMove);
    },
    disable: function disable() {
      window.removeEventListener('touchstart', onTouchStart);
      window.removeEventListener('touchend', onTouchEnd);
      window.removeEventListener('touchmove', onTouchMove);
    }
  };
}

function propOrProps(prop, options$$1) {
  if (options$$1[prop]) {
    return [options$$1[prop]];
  }
  return options$$1[prop + 's'];
}
function isThenable$1(obj) {
  return typeof obj.then === 'function';
}
function createWrapper(options$$1) {
  var el = document.createElement('div');
  el.id = 'reactbox-wrapper';
  var extraClasses = propOrProps('extraClass', options$$1);
  if (extraClasses) {
    extraClasses.forEach(function (klass) {
      return el.classList.add(klass);
    });
  }
  return el;
}

function Reactbox$1(props) {
  return new _Promise(function (resolve, reject) {
    function show(props) {
      var el = createWrapper(props);
      document.body.appendChild(el);
      var overflow = document.documentElement.style.overflow;
      document.documentElement.style.overflow = 'hidden';
      var state = options(props);
      var app = new _app2.default(state, [store$1], el, Reactbox);
      var keyboard = Keyboard(app.store.dispatch);
      var touch = Touch(app.store.dispatch);
      var unmount = props.onUnmount;
      options.onUnmount = function (component) {
        document.documentElement.style.overflow = overflow;
        keyboard.disable();
        deeplink.reset();
        fullscreen.exit();
        touch.disable();
        if (unmount) {
          unmount(component);
        }
        _reactDom2.default.unmountComponentAtNode(el);
        el.parentNode.removeChild(el);
      };
      deeplink.init();
      deeplink.set(app.store.state.items[app.store.state.activeIndex]);
      keyboard.enable();
      touch.enable();
      app.store.dispatch('init');
      app.store.onDispatch = function (action, params) {
        if (action !== 'unmount') {
          return;
        }
        options.onUnmount();
        resolve(app.store.state.items[app.store.state.activeIndex]);
      };
    }
    if (isThenable$1(props)) {
      props.then(show);
    } else {
      show(props);
    }
  });
}

exports.default = Reactbox$1;
},{"react-icons/lib/fa/facebook":92,"react-icons/lib/fa/twitter":81,"react-icons/lib/fa/google-plus":93,"react-icons/lib/fa/reddit":80,"react-icons/lib/fa/digg":94,"react-icons/lib/fa/stumbleupon":82,"react-icons/lib/fa/delicious":84,"react-icons/lib/fa/pinterest":83,"react-icons/lib/fa/vk":85,"react":6,"react-icons/lib/md/file-download":86,"react-icons/lib/md/close":96,"react-icons/lib/md/fullscreen":87,"react-icons/lib/md/fullscreen-exit":88,"react-icons/lib/md/share":89,"react-scrollbar":78,"react-dom":6,"react-icons/lib/md/arrow-back":90,"react-icons/lib/md/arrow-forward":91,"yaux/lib/app":7,"array.prototype.find":9,"classnames":122,"uppercamelcase":97,"asap":95,"atomicjs":79,"dot-prop":98}],4:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

exports.default = lightbox;

var _reactbox = require('reactbox');

var _reactbox2 = _interopRequireDefault(_reactbox);

require('reactbox/reactbox.css');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var extractLightboxForCell = function extractLightboxForCell(cell) {
  return (0, _extends3.default)({}, cell.lightbox, {
    url: cell.url,
    alt: cell.alt
  });
};

var hasLightbox = function hasLightbox(cell) {
  return !!cell.lightbox;
};

function lightbox(items, activeIndex, options) {
  var activeItem = items[activeIndex];
  var displayable = items.filter(hasLightbox);
  activeIndex = displayable.indexOf(activeItem);

  if (activeIndex === -1) {
    items = [activeItem].map(extractLightboxForCell);
    activeIndex = 0;
  } else {
    items = displayable.map(extractLightboxForCell);
  }
  (0, _reactbox2.default)((0, _extends3.default)({ items: items, activeIndex: activeIndex }, options));
}
},{"babel-runtime/helpers/extends":27,"reactbox":23,"reactbox/reactbox.css":113}],36:[function(require,module,exports) {
'use strict';

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _getPrototypeOf = require('babel-runtime/core-js/object/get-prototype-of');

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require('babel-runtime/helpers/possibleConstructorReturn');

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require('babel-runtime/helpers/inherits');

var _inherits3 = _interopRequireDefault(_inherits2);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

var _hover = require('./hover');

var _hover2 = _interopRequireDefault(_hover);

var _content = require('./content');

var _content2 = _interopRequireDefault(_content);

var _caption = require('./caption');

var _caption2 = _interopRequireDefault(_caption);

var _lightbox = require('../lightbox');

var _lightbox2 = _interopRequireDefault(_lightbox);

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

require('./cell.sass');


function hasLightbox(props) {
  return !!props.lightbox;
}
function findIndex(list, predicate) {
  return list.indexOf((0, _arrayPrototype2.default)(list, predicate));
}
function sendGoogleAnalytics(props) {
  if (typeof ga === 'undefined') {
    return;
  }
  ga('send', 'event', 'link', 'click', props.url, { nonInteraction: true });
}
function linkable(props) {
  return hasLightbox(props) || props.url;
}
var onLinkClick = function onLinkClick(props) {
  return function (e) {
    if (e.target.tagName === 'A') {
      return true;
    }
    if (hasLightbox(props)) {
      e.preventDefault();
      sendGoogleAnalytics(props);
      var cells = props.filteredCells;
      (0, _lightbox2.default)(cells, findIndex(cells, function (cell) {
        return cell.index === props.index;
      }), props.config.lightbox);
    } else if (props.url) {
      e.preventDefault();
      sendGoogleAnalytics(props);
      if (props.target === '_blank') {
        window.open(props.url);
      } else {
        window.location = props.url;
      }
    }

    e.preventDefault();
  };
};

function getSize(props) {
  return props.sizes[props.cellLayout];
}

module.exports = function (_React$Component) {
  (0, _inherits3.default)(Cell, _React$Component);

  function Cell(props) {
    (0, _classCallCheck3.default)(this, Cell);

    var _this = (0, _possibleConstructorReturn3.default)(this, (Cell.__proto__ || (0, _getPrototypeOf2.default)(Cell)).call(this, props));

    _this.state = {};
    if (!_this.props.mounted) {
      _this.state.mounted = true;
    }
    _this.setEnterActive = _this.setEnterActive.bind(_this);
    return _this;
  }

  (0, _createClass3.default)(Cell, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      if (this.props.mounted) {
        setTimeout(this.setEnterActive, 0);
      }
    }
  }, {
    key: 'measure',
    value: function measure() {
      var props = this.props;
      var self = this.refs.this;
      if (props.label || props.settings.border > 0 || true) {
        return {
          width: self.offsetWidth,
          height: self.offsetHeight
        };
      }
      return getSize(props);
    }
  }, {
    key: 'setEnterActive',
    value: function setEnterActive() {
      var node = _reactDom2.default.findDOMNode(this);
      var enter = node.classList.contains('uber-grid-enter');
      var active = node.classList.contains('uber-grid-enter-active');
      this.setState({ mounted: true }, function () {
        if (enter) {
          node.classList.add('uber-grid-enter');
        }
        if (active) {
          node.classList.add('uber-grid-enter-active');
        }
      }.bind(this));
    }
  }, {
    key: 'render',
    value: function render() {
      var props = (0, _extends3.default)({}, this.props);
      var state = this.state;
      var className = (0, _classnames2.default)(props.className, {
        'uber-grid-animated': state.mounted,
        'uber-grid-has-hover': !!props.hover,
        'uber-grid-has-link': !!props.url,
        'uber-grid-linkable': linkable(props)
      });
      props.size = getSize(this.props);
      var outerClasses = (0, _classnames2.default)('uber-grid-cell-outer', {
        'uber-grid-animated': this.props.mounted && this.state.mounted
      });

      return _react2.default.createElement(
        'div',
        { className: outerClasses, style: props.style, ref: 'this' },
        _react2.default.createElement(
          'div',
          { className: className, id: props.id,
            style: { width: props.size.width + "px" } },
          !!props.url && !hasLightbox(props) ? _react2.default.createElement('a', { href: props.url, className: 'uber-grid-cell-link' }) : null,
          _react2.default.createElement(
            'div',
            { className: 'uber-grid-cell-wrapper',
              style: { width: props.size.width + "px",
                height: props.size.height + "px" } },
            _react2.default.createElement(_content2.default, (0, _extends3.default)({}, props, { onClick: onLinkClick(props) })),
            props.hover ? _react2.default.createElement(_hover2.default, (0, _extends3.default)({}, props, { onClick: onLinkClick(props) })) : null
          ),
          props.label && props.label.trim() ? _react2.default.createElement(_caption2.default, props) : null
        )
      );
    }
  }]);
  return Cell;
}(_react2.default.Component);
},{"babel-runtime/helpers/extends":27,"babel-runtime/core-js/object/get-prototype-of":39,"babel-runtime/helpers/classCallCheck":40,"babel-runtime/helpers/createClass":42,"babel-runtime/helpers/possibleConstructorReturn":41,"babel-runtime/helpers/inherits":43,"./cell.sass":113,"react":6,"react-dom":6,"classnames":122,"./hover":102,"./content":103,"./caption":104,"../lightbox":4,"array.prototype.find":9}],62:[function(require,module,exports) {
/* eslint-disable no-undefined,no-param-reassign,no-shadow */

/**
 * Throttle execution of a function. Especially useful for rate limiting
 * execution of handlers on events like resize and scroll.
 *
 * @param  {Number}    delay          A zero-or-greater delay in milliseconds. For event callbacks, values around 100 or 250 (or even higher) are most useful.
 * @param  {Boolean}   noTrailing     Optional, defaults to false. If noTrailing is true, callback will only execute every `delay` milliseconds while the
 *                                    throttled-function is being called. If noTrailing is false or unspecified, callback will be executed one final time
 *                                    after the last throttled-function call. (After the throttled-function has not been called for `delay` milliseconds,
 *                                    the internal counter is reset)
 * @param  {Function}  callback       A function to be executed after delay milliseconds. The `this` context and all arguments are passed through, as-is,
 *                                    to `callback` when the throttled-function is executed.
 * @param  {Boolean}   debounceMode   If `debounceMode` is true (at begin), schedule `clear` to execute after `delay` ms. If `debounceMode` is false (at end),
 *                                    schedule `callback` to execute after `delay` ms.
 *
 * @return {Function}  A new, throttled, function.
 */
module.exports = function (delay, noTrailing, callback, debounceMode) {

	// After wrapper has stopped being called, this timeout ensures that
	// `callback` is executed at the proper times in `throttle` and `end`
	// debounce modes.
	var timeoutID;

	// Keep track of the last time `callback` was executed.
	var lastExec = 0;

	// `noTrailing` defaults to falsy.
	if (typeof noTrailing !== 'boolean') {
		debounceMode = callback;
		callback = noTrailing;
		noTrailing = undefined;
	}

	// The `wrapper` function encapsulates all of the throttling / debouncing
	// functionality and when executed will limit the rate at which `callback`
	// is executed.
	function wrapper() {

		var self = this;
		var elapsed = Number(new Date()) - lastExec;
		var args = arguments;

		// Execute `callback` and update the `lastExec` timestamp.
		function exec() {
			lastExec = Number(new Date());
			callback.apply(self, args);
		}

		// If `debounceMode` is true (at begin) this is used to clear the flag
		// to allow future `callback` executions.
		function clear() {
			timeoutID = undefined;
		}

		if (debounceMode && !timeoutID) {
			// Since `wrapper` is being called for the first time and
			// `debounceMode` is true (at begin), execute `callback`.
			exec();
		}

		// Clear any existing timeout.
		if (timeoutID) {
			clearTimeout(timeoutID);
		}

		if (debounceMode === undefined && elapsed > delay) {
			// In throttle mode, if `delay` time has been exceeded, execute
			// `callback`.
			exec();
		} else if (noTrailing !== true) {
			// In trailing throttle mode, since `delay` time has not been
			// exceeded, schedule `callback` to execute `delay` ms after most
			// recent execution.
			//
			// If `debounceMode` is true (at begin), schedule `clear` to execute
			// after `delay` ms.
			//
			// If `debounceMode` is false (at end), schedule `callback` to
			// execute after `delay` ms.
			timeoutID = setTimeout(debounceMode ? clear : exec, debounceMode === undefined ? delay - elapsed : delay);
		}
	}

	// Return the wrapper function.
	return wrapper;
};
},{}],44:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ResizeSensor = undefined;

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/* global jQuery, Elements */
// Only used for the dirty checking, so the event callback count is limted to max 1 call per fps per sensor.
// In combination with the event based resize sensor this saves cpu time, because the sensor is too fast and
// would generate too many unnecessary events.
var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || function (fn) {
  return window.setTimeout(fn, 20);
};

/**
 * Iterate over each of the provided element(s).
 *
 * @param {HTMLElement|HTMLElement[]} elements
 * @param {Function}                  callback
 */
function forEachElement(elements, callback) {
  var elementsType = Object.prototype.toString.call(elements);
  var isCollectionTyped = elementsType === '[object Array]' || elementsType === '[object NodeList]' || elementsType === '[object HTMLCollection]' || typeof jQuery !== 'undefined' && elements instanceof jQuery || typeof Elements !== 'undefined' && elements instanceof Elements // mootools
  ;
  var i = 0;
  var j = elements.length;
  if (isCollectionTyped) {
    for (; i < j; i++) {
      callback(elements[i]);
    }
  } else {
    callback(elements);
  }
}

/**
 * Class for dimension change detection.
 *
 * @param {Element|Element[]|Elements|jQuery} element
 * @param {Function} callback
 *
 * @constructor
 */
var ResizeSensor = function ResizeSensor(element, callback) {
  /**
   *
   * @constructor
   */
  function EventQueue() {
    var q = [];
    this.add = function (ev) {
      q.push(ev);
    };

    var i, j;
    this.call = function () {
      for (i = 0, j = q.length; i < j; i++) {
        q[i].call();
      }
    };

    this.remove = function (ev) {
      var newQueue = [];
      for (i = 0, j = q.length; i < j; i++) {
        if (q[i] !== ev) newQueue.push(q[i]);
      }
      q = newQueue;
    };

    this.length = function () {
      return q.length;
    };
  }

  /**
   * @param {HTMLElement} element
   * @param {String}      prop
   * @returns {String|Number}
   */
  function getComputedStyle(element, prop) {
    if (element.currentStyle) {
      return element.currentStyle[prop];
    } else if (window.getComputedStyle) {
      return window.getComputedStyle(element, null).getPropertyValue(prop);
    } else {
      return element.style[prop];
    }
  }

  /**
   *
   * @param {HTMLElement} element
   * @param {Function}    resized
   */
  function attachResizeEvent(element, resized) {
    if (!element.resizedAttached) {
      element.resizedAttached = new EventQueue();
      element.resizedAttached.add(resized);
    } else if (element.resizedAttached) {
      element.resizedAttached.add(resized);
      return;
    }

    element.resizeSensor = document.createElement('div');
    element.resizeSensor.className = 'resize-sensor';
    var style = 'position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;';
    var styleChild = 'position: absolute; left: 0; top: 0; transition: 0s;';

    element.resizeSensor.style.cssText = style;
    element.resizeSensor.innerHTML = '<div class="resize-sensor-expand" style="' + style + '">' + '<div style="' + styleChild + '"></div>' + '</div>' + '<div class="resize-sensor-shrink" style="' + style + '">' + '<div style="' + styleChild + ' width: 200%; height: 200%"></div>' + '</div>';
    element.appendChild(element.resizeSensor);

    if (getComputedStyle(element, 'position') === 'static') {
      element.style.position = 'relative';
    }

    var expand = element.resizeSensor.childNodes[0];
    var expandChild = expand.childNodes[0];
    var shrink = element.resizeSensor.childNodes[1];

    var reset = function reset() {
      expandChild.style.width = 100000 + 'px';
      expandChild.style.height = 100000 + 'px';

      expand.scrollLeft = 100000;
      expand.scrollTop = 100000;

      shrink.scrollLeft = 100000;
      shrink.scrollTop = 100000;
    };

    reset();
    var dirty = false;

    var dirtyChecking = function dirtyChecking() {
      if (!element.resizedAttached) return;

      if (dirty) {
        element.resizedAttached.call();
        dirty = false;
      }

      requestAnimationFrame(dirtyChecking);
    };

    requestAnimationFrame(dirtyChecking);
    var lastWidth, lastHeight;
    var cachedWidth, cachedHeight; // useful to not query offsetWidth twice

    var onScroll = function onScroll() {
      if ((cachedWidth = element.offsetWidth) !== lastWidth || (cachedHeight = element.offsetHeight) !== lastHeight) {
        dirty = true;

        lastWidth = cachedWidth;
        lastHeight = cachedHeight;
      }
      reset();
    };

    var addEvent = function addEvent(el, name, cb) {
      if (el.attachEvent) {
        el.attachEvent('on' + name, cb);
      } else {
        el.addEventListener(name, cb);
      }
    };

    addEvent(expand, 'scroll', onScroll);
    addEvent(shrink, 'scroll', onScroll);
  }

  forEachElement(element, function (elem) {
    attachResizeEvent(elem, callback);
  });

  this.detach = function (ev) {
    ResizeSensor.detach(element, ev);
  };
};

ResizeSensor.detach = function (element, ev) {
  forEachElement(element, function (elem) {
    if (elem.resizedAttached && typeof ev === 'function') {
      elem.resizedAttached.remove(ev);
      if (elem.resizedAttached.length()) return;
    }
    if (elem.resizeSensor) {
      elem.removeChild(elem.resizeSensor);
      delete elem.resizeSensor;
      delete elem.resizedAttached;
    }
  });
};

var classCallCheck = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};

var createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor;
  };
}();

var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var inherits = function (subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      enumerable: false,
      writable: true,
      configurable: true
    }
  });
  if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
};

var objectWithoutProperties = function (obj, keys) {
  var target = {};

  for (var i in obj) {
    if (keys.indexOf(i) >= 0) continue;
    if (!Object.prototype.hasOwnProperty.call(obj, i)) continue;
    target[i] = obj[i];
  }

  return target;
};

var possibleConstructorReturn = function (self, call) {
  if (!self) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return call && (typeof call === "object" || typeof call === "function") ? call : self;
};

var Item = function (_React$Component) {
  inherits(Item, _React$Component);

  function Item(props) {
    classCallCheck(this, Item);

    var _this = possibleConstructorReturn(this, (Item.__proto__ || Object.getPrototypeOf(Item)).call(this, props));

    _this.onResize = _this.onResize.bind(_this);
    return _this;
  }

  createClass(Item, [{
    key: 'measure',
    value: function measure() {
      var childProps = this.props.children.props;
      if (childProps.width && childProps.height) {
        return { width: childProps.width, height: childProps.height };
      }
      if (this.refs.item.measure) {
        return this.refs.item.measure();
      }
      var node = _reactDom2.default.findDOMNode(this);
      return {
        width: Math.floor(node.offsetWidth),
        height: Math.floor(node.offsetHeight)
      };
    }
  }, {
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.props.onMount(this);
      if (this.props.layout === 'binpack') {
        new ResizeSensor(_reactDom2.default.findDOMNode(this), this.onResize);
      }
    }
  }, {
    key: 'onResize',
    value: function onResize() {
      if (this.props.onResize) {
        this.props.onResize(this);
      }
      if (this.props.children.onResize) {
        this.props.children.onResize(this);
      }
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      this.props.onUnMount(this);
      if (this.props.layout === 'binpack') {
        ResizeSensor.detach(_reactDom2.default.findDOMNode(this), this.onResize);
      }
    }
  }, {
    key: 'render',
    value: function render() {
      var props = _extends({}, this.props, {
        visible: !!this.props.rect,
        rect: this.props.rect,
        ref: 'item'
      });
      if (props.rect) {
        var transform = 'translate(' + props.rect.x + 'px, ' + props.rect.y + 'px)';
        if (props.style && props.style.transform) {
          transform = transform + ' ' + props.style.transform;
        }
        props.style = _extends({}, props.style, {
          transform: transform,
          WebkitTransform: transform,
          OTransform: transform,
          MsTransform: transform,
          MozTransform: transform
        });
        if (this.props.layout !== 'binpack') {
          props.style.width = props.rect.width + 'px';
          props.style.height = props.rect.height + 'px';
        }
      }
      return _react2.default.cloneElement(props.children, props);
    }
  }]);
  return Item;
}(_react2.default.Component);

function contains(container, rect) {
  var otherWidth = rect.width || 0;
  var otherHeight = rect.height || 0;
  return container.x <= rect.x && container.y <= rect.y && container.x + container.width >= rect.x + otherWidth && container.y + container.height >= rect.y + otherHeight;
}

function merge(rects) {
  for (var i = 0; i < rects.length; i++) {
    var rect = rects[i];
    var j = 0;
    var compareRect = rects[i + j];
    while (compareRect) {
      if (compareRect === rect) {
        j++;
      } else if (contains(compareRect, rect)) {
        rects.splice(i, 1);
        rect = rects[i];
        compareRect = null;
        continue;
      } else if (contains(rect, compareRect)) {
        // remove compareRect
        rects.splice(i + j, 1);
      } else {
        j++;
      }
      compareRect = rects[i + j];
    }
  }
}

function overlaps(a, b) {
  var aRight = a.x + a.width;
  var aBottom = a.y + a.height;
  var bRight = b.x + b.width;
  var bBottom = b.y + b.height;

  return a.x < bRight && aRight > b.x && a.y < bBottom && aBottom > b.y;
}

function subtract(a, b, gap) {
  var free = [];

  var aRight = a.x + a.width;
  var aBottom = a.y + a.height;
  var bRight = b.x + b.width;
  var bBottom = b.y + b.height;

  if (gap === undefined) {
    gap = 0;
  }

  // top
  if (a.y < b.y) {
    free.push({
      x: a.x,
      y: a.y,
      width: a.width,
      height: b.y - a.y - gap
    });
  }

  // right
  if (aRight > bRight) {
    free.push({
      x: bRight + gap,
      y: a.y,
      width: aRight - bRight - gap,
      height: a.height
    });
  }

  // bottom
  if (aBottom > bBottom) {
    free.push({
      x: a.x,
      y: bBottom + gap,
      width: a.width,
      height: aBottom - bBottom - gap
    });
  }

  // left
  if (a.x < b.x) {
    free.push({
      x: a.x,
      y: a.y,
      width: b.x - a.x - gap,
      height: a.height
    });
  }
  return free;
}

function fits(a, b) {
  return a.width >= b.width && a.height >= b.height;
}

var find = require('array.prototype.find');

function getStrategy(rtl) {
  return rtl ? {
    sorter: function sorter(a, b) {
      return a.y - b.y || a.x - b.x;
    },
    place: function place(positioned, space) {
      positioned.x = space.x + space.width - positioned.width, positioned.y = space.y;
    }
  } : {
    sorter: function sorter(a, b) {
      return a.y - b.y || a.x - b.x;
    },
    place: function place(positioned, space) {
      positioned.x = space.x, positioned.y = space.y;
    }
  };
}

function pack(size, items, gap, rtl) {
  if (gap === undefined) {
    gap = 0;
  }
  var spaces = [{
    x: 0,
    y: 0,
    width: size.width || Infinity,
    height: size.height || Infinity
  }];
  var strategy = getStrategy(rtl);
  return items.map(function (item) {
    var positioned = {
      width: item.width || 0,
      height: item.height || 0
    };
    var space = find(spaces, function (space) {
      return fits(space, positioned);
    });
    if (space) {
      strategy.place(positioned, space);
      var overlapping = spaces.filter(function (space) {
        return overlaps(positioned, space);
      });
      overlapping.forEach(function (space) {
        spaces.splice(spaces.indexOf(space), 1);
        spaces.push.apply(spaces, subtract(space, positioned, gap));
      });
      merge(spaces);
      spaces.sort(strategy.sorter);
    }
    return positioned;
  });
}

var _extends$1 = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

function parse(options) {
  var defaults$$1 = {
    gap: 0,
    items: []
  };
  options = _extends$1({}, defaults$$1, options);
  var cleanWidth = options.width - options.columns * options.gap;
  if (!options.size) {
    options.size = {
      width: cleanWidth / options.columns,
      height: cleanWidth / options.columns / 1.5
    };
  } else if (options.fluid) {
    if (!options.columns) {
      options.columns = Math.ceil(cleanWidth / options.size.width);
    }
    var factor = options.columns / (cleanWidth / options.size.width);
    options.size.width = Math.floor(options.size.width / factor);
    if (options.size.height) {
      options.size.height = Math.floor(options.size.height / factor);
    }
  } else if (!options.width) {
    options.width = options.columns * options.size.width + (options.columns - 1) * options.gap;
  }
  return options;
}

function grid(options) {
  options = parse(options);
  var width = (options.width + options.gap) / options.columns - options.gap;
  var height = options.size.height * (width / options.size.width);
  return options.items.map(function (item, index) {
    var column = index % options.columns;
    var row = Math.floor(index / options.columns);
    return {
      x: column * (width + options.gap),
      y: row * (height + options.gap),
      width: width,
      height: height
    };
  });
}

/**
 * Array.prototype.filter() - Polyfill
 *
 * @ref https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter
 */

(function () {
  if (!Array.prototype.filter) {
    Array.prototype.filter = function (fun /*, thisArg*/) {

      if (this === void 0 || this === null) {
        throw new TypeError();
      }

      var t = Object(this);
      var len = t.length >>> 0;
      if (typeof fun !== 'function') {
        throw new TypeError();
      }

      var res = [];
      var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
      for (var i = 0; i < len; i++) {
        if (i in t) {
          var val = t[i];

          // NOTE: Technically this should Object.defineProperty at
          //       the next index, as push can be affected by
          //       properties on Object.prototype and Array.prototype.
          //       But that method's new, and collisions should be
          //       rare, so use the more-compatible alternative.
          if (fun.call(thisArg, val, i, t)) {
            res.push(val);
          }
        }
      }

      return res;
    };
  }
})();

function create(top) {
  return {
    items: [],
    width: 0,
    top: top
  };
}

function parse$1(options) {
  return _extends$1({
    items: [],
    gap: 0,
    height: 200,
    incomplete: true
  }, options);
}

function shrink(row, options) {
  var x = 0;
  var gaps = (row.items.length - 1) * options.gap;
  var cleanWidth = row.width - gaps;
  var availableCleanWidth = options.width - gaps;
  var factor = cleanWidth / availableCleanWidth;
  var height = Math.floor(options.height / factor);
  row.items.forEach(function (item, index) {
    item.height = height;
    item.x = x;
    if (index !== row.items.length - 1) {
      item.width = Math.floor(item.width / factor);
      x += item.width + options.gap;
    } else {
      item.width = options.width - x;
    }
  });
  return height;
}

function rows(options) {
  options = parse$1(options);
  var row = create(0);
  var items = options.items.map(function (item) {
    item = {
      width: Math.floor(item.width / item.height * options.height),
      height: options.height,
      x: row.width,
      y: row.top
    };
    row.width += item.width + options.gap;
    row.items.push(item);
    if (row.width - options.gap > options.width) {
      row = create(row.top + shrink(row, options) + options.gap);
    }
    return item;
  });
  if (row.width < options.width && !options.incomplete) {
    items = filter(items, function (item) {
      return item.y !== row.height;
    });
  }
  return items;
}

function range(a, b) {
  var result = [];
  for (var i = a; i <= b; i++) {
    result.push(i);
  }
  return result;
}

function build(options) {
  var heights = range(0, options.columns - 1).map(function () {
    return 0;
  });
  var columns = range(0, options.columns - 1).map(function () {
    return [];
  });
  var width = (options.width + options.gap) / options.columns - options.gap;
  var items = options.items.map(function (item, index) {
    var column = index % options.columns;
    var aspect = item.width / item.height;
    var height = isNaN(aspect) ? 0 : Math.floor(width / aspect);
    var positioned = {
      x: column * (width + options.gap),
      y: heights[column],
      width: width,
      height: height
    };
    heights[column] += height + options.gap;
    columns[column].push(positioned);
    return positioned;
  });
  return {
    heights: heights,
    columns: columns,
    items: items
  };
}

function extreme(built, func) {
  var val = func.apply(null, built.heights);
  return built.columns[built.heights.indexOf(val)];
}

function equalize(built, options) {
  while (true) {
    var lowest = extreme(built, Math.min);
    var highest = extreme(built, Math.max);
    var lastInHighest = highest.pop();
    var lastInLowest = lowest[lowest.length - 1];
    var lowestHeight = built.heights[built.columns.indexOf(lowest)];
    var highestHeight = built.heights[built.columns.indexOf(highest)];
    if (lowest === highest || !lastInHighest || !lastInLowest || lowestHeight + lastInHighest.height >= highestHeight) {
      return built.items;
    }
    lowest.push(lastInHighest);
    lastInHighest.x = lastInLowest.x;
    lastInHighest.y = lastInLowest.y + lastInLowest.height + options.gap;
    built.heights[built.columns.indexOf(highest)] -= lastInHighest.height;
    built.heights[built.columns.indexOf(lowest)] += lastInHighest.height;
  }
}

function columns(options) {
  options = parse(options);
  return equalize(build(options), options);
}

var layouts = { rows: rows, columns: columns, grid: grid };

function getGap(gap, width) {
  if (typeof gap == 'number') {
    return gap;
  }
  if (gap && typeof gap === 'string' && /%$/.test(gap)) {
    return width / 100 * parseInt(gap);
  }
  if (gap && typeof gap === 'string') {
    return parseInt(gap);
  }
  return gap;
}
var runBinpack = function runBinpack(options) {
  return pack({ width: options.width, height: Infinity }, options.items, options.gap, options.rtl);
};
var isBinpack = function isBinpack(layout) {
  return layout === 'binpack' || !layout;
};
function pack$1(options) {
  options.gap = getGap(options.gap, options.width);
  return isBinpack(options.layout) ? runBinpack(options) : layouts[options.layout](options);
}

var throttle = require('throttle-debounce/throttle');

var add = function add(a) {
  return function (b) {
    return a + b;
  };
};
var sub = function sub(a) {
  return function (b) {
    return a - b;
  };
};
function array(thing) {
  var length = thing.length;
  var result = [];
  for (var i = 0; i < thing.length; i++) {
    result.push(thing[i]);
  }
  return result;
}
function measure(component) {
  if (component.measure) {
    return component.measure();
  }
  var node = _reactDom2.default.findDOMNode(component);
  return {
    width: Math.floor(node.offsetWidth),
    height: Math.floor(node.offsetHeight)
  };
}

function getHeight(rects) {
  return rects.reduce(function (height, rect) {
    if (rect.y === undefined) {
      return height;
    }
    return Math.max(height, rect.y + rect.height);
  }, 0);
}

function getWidth(rects) {
  var max = rects.reduce(function (width, rect) {
    if (rect.x === undefined) {
      return width;
    }
    return Math.max(width, rect.x + rect.width);
  }, 0);
  return max - rects.reduce(function (width, rect) {
    if (rect.x === undefined) {
      return width;
    }
    return Math.min(width, rect.x);
  }, max);
}

var Gallery = function (_React$Component) {
  inherits(Gallery, _React$Component);

  function Gallery(props) {
    classCallCheck(this, Gallery);

    var _this = possibleConstructorReturn(this, (Gallery.__proto__ || Object.getPrototypeOf(Gallery)).call(this, props));

    _this.state = {
      size: null,
      sizes: {},
      children: {},
      mounted: false,
      shouldReactResize: false
    };
    _this.resetSizes = throttle(props.throttle, _this.resetSizes.bind(_this));
    _this.onItemMount = _this.onItemMount.bind(_this);
    _this.onItemUnMount = _this.onItemUnMount.bind(_this);
    _this.onItemChange = _this.onItemChange.bind(_this);
    _this.onResize = _this.onResize.bind(_this);
    _this.watchResize = _this.watchResize.bind(_this);
    return _this;
  }

  createClass(Gallery, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      this.setState({
        size: measure(this),
        mounted: true
      }, this.watchResize);
    }
  }, {
    key: 'watchResize',
    value: function watchResize() {
      // eslint-disable-next-line no-new
      new ResizeSensor(_reactDom2.default.findDOMNode(this), this.onResize);
    }
  }, {
    key: 'onResize',
    value: function onResize() {
      if (this.state.shouldReactResize) {
        if (this.props.onResize) {
          this.props.onResize(this);
        }
        this.resetSizes();
      }
      this.setState({ shouldReactResize: true });
    }
  }, {
    key: 'shouldComponentUpdate',
    value: function shouldComponentUpdate(nextProps, nextState) {
      if (nextState.shouldReactResize === true && !this.state.shouldReactResize) {
        return false;
      }
      return true;
    }
  }, {
    key: 'componentWillUnmount',
    value: function componentWillUnmount() {
      ResizeSensor.detach(this.el, this.onResize);
    }
  }, {
    key: 'hasChanges',
    value: function hasChanges(sizes, oldSizes) {
      var oldKeys = Object.keys(oldSizes);
      var keys = Object.keys(sizes);
      if (oldKeys.length !== keys.length) {
        return true;
      }
      for (var i = 0; i < keys.length; i++) {
        var oldSize = oldSizes[oldKeys[i]];
        var size = sizes[keys[i]];
        if (size.width !== oldSize.width || size.height !== oldSize.height) {
          return true;
        }
      }
      return false;
    }
  }, {
    key: 'resetSizes',
    value: function resetSizes() {
      var _this2 = this;

      var state = this.state;
      var sizes = Object.keys(state.children).reduce(function (sizes, key) {
        var size = measure(state.children[key]);
        sizes[key] = size;
        return sizes;
      }, {});
      var size = measure(this);
      var hasChanges = !state.size || state.size.width !== size.width || state.size.height !== size.height || this.hasChanges(sizes, state.sizes);
      if (hasChanges) {
        this.setState({
          sizes: sizes,
          size: size,
          mounted: true
        }, function () {
          if (_this2.props.onLayout) {
            _this2.props.onLayout(_this2);
          }
        });
      } else if (!this.state.mounted) {
        this.setState({ mounted: true });
      }
    }
  }, {
    key: 'onItemChange',
    value: function onItemChange(item) {
      var sizes = this.state.sizes;
      sizes[item] = measure(item);
      this.setState({ sizes: sizes });
    }
  }, {
    key: 'onItemMount',
    value: function onItemMount(item) {
      var sizes = this.state.sizes;
      var children = this.state.children;
      children[item.props['gallery-key']] = item;
      sizes[item.props['gallery-key']] = measure(item);
      this.setState({ sizes: sizes });
    }
  }, {
    key: 'onItemUnMount',
    value: function onItemUnMount(item) {
      delete this.state.sizes[item.props['gallery-key']];
      var children = this.state.children;
      delete children[item.props['gallery-key']];
      this.setState({ sizes: this.state.sizes, children: children });
    }
  }, {
    key: 'render',
    value: function render() {
      var _this3 = this;

      var state = this.state;
      var propsClone = _extends({
        wrapper: 'ul',
        className: 'react-gallery'
      }, this.props);
      // eslint-disable-next-line no-unused-vars
      var component = propsClone.component,
          wrapper = propsClone.wrapper,
          columns = propsClone.columns,
          center = propsClone.center,
          onLayout = propsClone.onLayout,
          onResize = propsClone.onResize,
          throttle = propsClone.throttle,
          gap = propsClone.gap,
          layout = propsClone.layout,
          rowHeight = propsClone.rowHeight,
          columnWidth = propsClone.columnWidth,
          centered = propsClone.centered,
          rtl = propsClone.rtl,
          props = objectWithoutProperties(propsClone, ['component', 'wrapper', 'columns', 'center', 'onLayout', 'onResize', 'throttle', 'gap', 'layout', 'rowHeight', 'columnWidth', 'centered', 'rtl']);

      var visible, rects, options;
      if (this.props.children) {
        if (state.size) {
          visible = array(props.children);
          rects = visible.map(function (item, index) {
            return state.sizes[item.key] || { width: 0, height: 0 };
          });
          var _height = Infinity;
          if (layout === 'rows') {
            _height = propsClone.rowHeight;
          }
          options = {
            width: state.size.width,
            height: _height,
            items: rects,
            gap: gap || 0,
            columns: columns,
            layout: layout,
            size: {
              height: rowHeight,
              width: columnWidth
            },
            rtl: rtl
          };
          rects = pack$1(options);
          if (centered) {
            var width = getWidth(rects);
            var offset = (state.size.width - width) / 2;
            var f = rtl ? sub(offset) : add(offset);
            rects.forEach(function (rect) {
              rect.x = f(rect.x);
            });
          }
        } else {
          visible = array(props.children);
          rects = [];
        }
      } else {
        visible = [];
        rects = [];
      }
      if (component) {
        props.component = component;
      }
      var height = getHeight(rects);
      return _react2.default.createElement(wrapper || component, _extends({}, props, { style: { height: height } }), visible.map(function (child, index) {
        return _react2.default.createElement(Item, { key: child.key,
          'gallery-key': child.key,
          rect: rects[index],
          layout: layout,
          onMount: _this3.onItemMount,
          onUnMount: _this3.onItemUnMount,
          onResize: _this3.resetSizes }, child);
      }));
    }
  }]);
  return Gallery;
}(_react2.default.Component);

Gallery.defaultProps = {
  throttle: 50,
  layout: 'binpack'
};

exports.default = Gallery;
exports.ResizeSensor = ResizeSensor;
},{"react":6,"react-dom":6,"array.prototype.find":9,"throttle-debounce/throttle":62}],265:[function(require,module,exports) {
// call something on iterator step with safe closing on error
var anObject = require('./_an-object');
module.exports = function (iterator, fn, value, entries) {
  try {
    return entries ? fn(anObject(value)[0], value[1]) : fn(value);
  // 7.4.6 IteratorClose(iterator, completion)
  } catch (e) {
    var ret = iterator['return'];
    if (ret !== undefined) anObject(ret.call(iterator));
    throw e;
  }
};

},{"./_an-object":110}],266:[function(require,module,exports) {
// check on default Array iterator
var Iterators = require('./_iterators');
var ITERATOR = require('./_wks')('iterator');
var ArrayProto = Array.prototype;

module.exports = function (it) {
  return it !== undefined && (Iterators.Array === it || ArrayProto[ITERATOR] === it);
};

},{"./_iterators":137,"./_wks":138}],268:[function(require,module,exports) {
'use strict';
var $defineProperty = require('./_object-dp');
var createDesc = require('./_property-desc');

module.exports = function (object, index, value) {
  if (index in object) $defineProperty.f(object, index, createDesc(0, value));
  else object[index] = value;
};

},{"./_object-dp":169,"./_property-desc":199}],269:[function(require,module,exports) {
var ITERATOR = require('./_wks')('iterator');
var SAFE_CLOSING = false;

try {
  var riter = [7][ITERATOR]();
  riter['return'] = function () { SAFE_CLOSING = true; };
  // eslint-disable-next-line no-throw-literal
  Array.from(riter, function () { throw 2; });
} catch (e) { /* empty */ }

module.exports = function (exec, skipClosing) {
  if (!skipClosing && !SAFE_CLOSING) return false;
  var safe = false;
  try {
    var arr = [7];
    var iter = arr[ITERATOR]();
    iter.next = function () { return { done: safe = true }; };
    arr[ITERATOR] = function () { return iter; };
    exec(arr);
  } catch (e) { /* empty */ }
  return safe;
};

},{"./_wks":138}],249:[function(require,module,exports) {
'use strict';
var ctx = require('./_ctx');
var $export = require('./_export');
var toObject = require('./_to-object');
var call = require('./_iter-call');
var isArrayIter = require('./_is-array-iter');
var toLength = require('./_to-length');
var createProperty = require('./_create-property');
var getIterFn = require('./core.get-iterator-method');

$export($export.S + $export.F * !require('./_iter-detect')(function (iter) { Array.from(iter); }), 'Array', {
  // 22.1.2.1 Array.from(arrayLike, mapfn = undefined, thisArg = undefined)
  from: function from(arrayLike /* , mapfn = undefined, thisArg = undefined */) {
    var O = toObject(arrayLike);
    var C = typeof this == 'function' ? this : Array;
    var aLen = arguments.length;
    var mapfn = aLen > 1 ? arguments[1] : undefined;
    var mapping = mapfn !== undefined;
    var index = 0;
    var iterFn = getIterFn(O);
    var length, result, step, iterator;
    if (mapping) mapfn = ctx(mapfn, aLen > 2 ? arguments[2] : undefined, 2);
    // if object isn't iterable or it's array with default iterator - use simple case
    if (iterFn != undefined && !(C == Array && isArrayIter(iterFn))) {
      for (iterator = iterFn.call(O), result = new C(); !(step = iterator.next()).done; index++) {
        createProperty(result, index, mapping ? call(iterator, mapfn, [step.value, index], true) : step.value);
      }
    } else {
      length = toLength(O.length);
      for (result = new C(length); length > index; index++) {
        createProperty(result, index, mapping ? mapfn(O[index], index) : O[index]);
      }
    }
    result.length = index;
    return result;
  }
});

},{"./_ctx":224,"./_export":167,"./_to-object":127,"./_iter-call":265,"./_is-array-iter":266,"./_to-length":267,"./_create-property":268,"./core.get-iterator-method":111,"./_iter-detect":269}],175:[function(require,module,exports) {
require('../../modules/es6.string.iterator');
require('../../modules/es6.array.from');
module.exports = require('../../modules/_core').Array.from;

},{"../../modules/es6.string.iterator":64,"../../modules/es6.array.from":249,"../../modules/_core":67}],105:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/array/from"), __esModule: true };
},{"core-js/library/fn/array/from":175}],37:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _from = require('babel-runtime/core-js/array/from');

var _from2 = _interopRequireDefault(_from);

exports.default = Pagination;

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function Pages(props) {
  var pages = (0, _from2.default)(new Array(props.count).keys());
  return _react2.default.createElement(
    'div',
    { className: 'uber-grid-pagination' },
    pages.map(function (page) {
      return _react2.default.createElement(
        'div',
        { className: (0, _classnames2.default)('uber-grid-pagination-page', { 'uber-grid-current': page === props.page }), key: page },
        _react2.default.createElement(
          'a',
          { href: 'ubergrid-page-' + (page + 1),
            onClick: function onClick(e) {
              e.preventDefault();
              props.dispatch('paginate', page);
            } },
          page + 1
        )
      );
    })
  );
}

function LoadMore(props) {
  return props.visibleCells.length < props.filteredCells.length ? _react2.default.createElement(
    'div',
    { className: 'uber-grid-pagination' },
    _react2.default.createElement(
      'div',
      null,
      _react2.default.createElement(
        'a',
        { className: 'uber-grid-load-more', href: '#load-more',
          onClick: function onClick(e) {
            e.preventDefault();props.dispatch('loadMore');
          } },
        props.config.pagination.load_more
      )
    )
  ) : null;
}

function Pagination(props) {
  var pageCount = Math.ceil(props.filteredCells.length / props.config.pagination.per_page);
  if (!props.config.pagination.enable || pageCount < 2) {
    return null;
  }
  if (props.config.pagination.style == 'pagination') return _react2.default.createElement(Pages, (0, _extends3.default)({ count: pageCount }, props));else return _react2.default.createElement(LoadMore, props);
}
},{"babel-runtime/helpers/extends":27,"babel-runtime/core-js/array/from":105,"react":6,"classnames":122}],183:[function(require,module,exports) {
'use strict';

function inChildren(children, child) {
  var found = 0;
  children.forEach(function (c) {
    if (found) {
      return;
    }
    found = c.key === child.key;
  });
  return found;
}

module.exports = {
  inChildren: inChildren,

  isShownInChildren: function isShownInChildren(children, child, showProp) {
    var found = 0;
    children.forEach(function (c) {
      if (found) {
        return;
      }
      found = c.key === child.key && c.props[showProp];
    });
    return found;
  },

  inChildrenByKey: function inChildrenByKey(children, key) {
    var found = 0;
    children.forEach(function (c) {
      if (found) {
        return;
      }
      found = c.key === key;
    });
    return found;
  },

  isShownInChildrenByKey: function isShownInChildrenByKey(children, key, showProp) {
    var found = 0;
    children.forEach(function (c) {
      if (found) {
        return;
      }
      found = c.key === key && c.props[showProp];
    });
    return found;
  },

  mergeChildMappings: function mergeChildMappings(prev, next) {
    var ret = [];

    // For each key of `next`, the list of keys to insert before that key in
    // the combined list
    var nextChildrenPending = {};
    var pendingChildren = [];
    prev.forEach(function (c) {
      if (inChildren(next, c)) {
        if (pendingChildren.length) {
          nextChildrenPending[c.key] = pendingChildren;
          pendingChildren = [];
        }
      } else {
        pendingChildren.push(c);
      }
    });

    next.forEach(function (c) {
      if (nextChildrenPending.hasOwnProperty(c.key)) {
        ret = ret.concat(nextChildrenPending[c.key]);
      }
      ret.push(c);
    });

    ret = ret.concat(pendingChildren);

    return ret;
  }
};
},{}],230:[function(require,module,exports) {
'use strict';

var SPACE = ' ';
var RE_CLASS = /[\n\t\r]/g;

var norm = function norm(elemClass) {
  return (SPACE + elemClass + SPACE).replace(RE_CLASS, SPACE);
};

module.exports = {
  addClass: function addClass(elem, className) {
    elem.className += ' ' + className;
  },

  removeClass: function removeClass(elem, needle) {
    var elemClass = elem.className.trim();
    var className = norm(elemClass);
    needle = needle.trim();
    needle = SPACE + needle + SPACE;
    // 一个 cls 有可能多次出现：'link link2 link link3 link'
    while (className.indexOf(needle) >= 0) {
      className = className.replace(needle, SPACE);
    }
    elem.className = className.trim();
  }
};
},{}],231:[function(require,module,exports) {
/**
 * Copyright 2013-2014, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @providesModule ReactTransitionEvents
 */

'use strict';
/**
 * EVENT_NAME_MAP is used to determine which event fired when a
 * transition/animation ends, based on the style property used to
 * define that event.
 */
var EVENT_NAME_MAP = {
  transitionend: {
    transition: 'transitionend',
    WebkitTransition: 'webkitTransitionEnd',
    MozTransition: 'mozTransitionEnd',
    OTransition: 'oTransitionEnd',
    msTransition: 'MSTransitionEnd'
  },

  animationend: {
    animation: 'animationend',
    WebkitAnimation: 'webkitAnimationEnd',
    MozAnimation: 'mozAnimationEnd',
    OAnimation: 'oAnimationEnd',
    msAnimation: 'MSAnimationEnd'
  }
};

var endEvents = [];

function detectEvents() {
  var testEl = document.createElement('div');
  var style = testEl.style;

  // On some platforms, in particular some releases of Android 4.x,
  // the un-prefixed "animation" and "transition" properties are defined on the
  // style object but the events that fire will still be prefixed, so we need
  // to check if the un-prefixed events are useable, and if not remove them
  // from the map
  if (!('AnimationEvent' in window)) {
    delete EVENT_NAME_MAP.animationend.animation;
  }

  if (!('TransitionEvent' in window)) {
    delete EVENT_NAME_MAP.transitionend.transition;
  }

  for (var baseEventName in EVENT_NAME_MAP) {
    var baseEvents = EVENT_NAME_MAP[baseEventName];
    for (var styleName in baseEvents) {
      if (styleName in style) {
        endEvents.push(baseEvents[styleName]);
        break;
      }
    }
  }
}

if (typeof window !== 'undefined') {
  detectEvents();
}

// We use the raw {add|remove}EventListener() call because EventListener
// does not know how to remove event listeners and we really should
// clean up. Also, these events are not triggered in older browsers
// so we should be A-OK here.

function addEventListener(node, eventName, eventListener) {
  node.addEventListener(eventName, eventListener, false);
}

function removeEventListener(node, eventName, eventListener) {
  node.removeEventListener(eventName, eventListener, false);
}

var ReactTransitionEvents = {
  addEndEventListener: function addEndEventListener(node, eventListener) {
    if (endEvents.length === 0) {
      // If CSS transitions are not supported, trigger an "end animation"
      // event immediately.
      window.setTimeout(eventListener, 0);
      return;
    }
    endEvents.forEach(function (endEvent) {
      addEventListener(node, endEvent, eventListener);
    });
  },

  endEvents: endEvents,

  removeEndEventListener: function removeEndEventListener(node, eventListener) {
    if (endEvents.length === 0) {
      return;
    }
    endEvents.forEach(function (endEvent) {
      removeEventListener(node, endEvent, eventListener);
    });
  }
};

module.exports = ReactTransitionEvents;
},{}],184:[function(require,module,exports) {
/**
 * Copyright 2013-2014, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 * @typechecks
 * @providesModule ReactCSSTransitionGroupChild
 */

'use strict';

var React = require('react');
var ReactDOM = require('react-dom');

var CSSCore = require('./CSSCore');
var ReactTransitionEvents = require('./ReactTransitionEvents');

var TICK = 17;

var ReactCSSTransitionGroupChild = React.createClass({
  displayName: 'ReactCSSTransitionGroupChild',

  transition: function transition(animationType, finishCallback) {
    var _this = this;

    var node = ReactDOM.findDOMNode(this);
    var className = this.props.name + '-' + animationType;
    var activeClassName = className + '-active';

    if (this.endListener) {
      this.endListener();
    }

    this.endListener = function (e) {
      if (e && e.target !== node) {
        return;
      }

      CSSCore.removeClass(node, className);
      CSSCore.removeClass(node, activeClassName);

      ReactTransitionEvents.removeEndEventListener(node, _this.endListener);
      _this.endListener = null;

      // Usually this optional callback is used for informing an owner of
      // a leave animation and telling it to remove the child.
      if (finishCallback) {
        finishCallback();
      }
    };

    ReactTransitionEvents.addEndEventListener(node, this.endListener);

    CSSCore.addClass(node, className);

    // Need to do this to actually trigger a transition.
    this.queueClass(activeClassName);
  },

  queueClass: function queueClass(className) {
    this.classNameQueue.push(className);

    if (!this.timeout) {
      this.timeout = setTimeout(this.flushClassNameQueue, TICK);
    }
  },

  stop: function stop() {
    //console.log('force stop')
    if (this.timeout) {
      clearTimeout(this.timeout);
      this.classNameQueue.length = 0;
      this.timeout = null;
    }
    if (this.endListener) {
      this.endListener();
    }
  },

  flushClassNameQueue: function flushClassNameQueue() {
    if (this.isMounted()) {
      this.classNameQueue.forEach(CSSCore.addClass.bind(CSSCore, ReactDOM.findDOMNode(this)));
    }
    this.classNameQueue.length = 0;
    this.timeout = null;
  },

  componentWillMount: function componentWillMount() {
    this.classNameQueue = [];
  },

  componentWillUnmount: function componentWillUnmount() {
    if (this.timeout) {
      clearTimeout(this.timeout);
    }
  },

  componentWillEnter: function componentWillEnter(done) {
    if (this.props.enter) {
      this.transition('enter', done);
    } else {
      done();
    }
  },

  componentWillLeave: function componentWillLeave(done) {
    if (this.props.leave) {
      this.transition('leave', done);
    } else {
      done();
    }
  },

  render: function render() {
    return this.props.children;
  }
});

module.exports = ReactCSSTransitionGroupChild;
},{"react":6,"react-dom":6,"./CSSCore":230,"./ReactTransitionEvents":231}],107:[function(require,module,exports) {
'use strict';

var React = require('react');
var ReactTransitionChildMapping = require('./ReactTransitionChildMapping');
var CSSTransitionGroupChild = require('./CSSTransitionGroupChild');

var CSSTransitionGroup = React.createClass({
  displayName: 'CSSTransitionGroup',

  protoTypes: {
    component: React.PropTypes.any,
    transitionName: React.PropTypes.string.isRequired,
    transitionEnter: React.PropTypes.bool,
    transitionLeave: React.PropTypes.bool
  },

  getDefaultProps: function getDefaultProps() {
    return {
      component: 'span',
      transitionEnter: true,
      transitionLeave: true
    };
  },

  getInitialState: function getInitialState() {
    var ret = [];
    React.Children.forEach(this.props.children, function (c) {
      ret.push(c);
    });
    return {
      children: ret
    };
  },

  componentWillMount: function componentWillMount() {
    this.currentlyTransitioningKeys = {};
    this.keysToEnter = [];
    this.keysToLeave = [];
    this._refs = {};
  },

  componentWillReceiveProps: function componentWillReceiveProps(nextProps) {
    var _this2 = this;

    var nextChildMapping = [];
    var showProp = this.props.showProp;
    var exclusive = this.props.exclusive;

    React.Children.forEach(nextProps.children, function (c) {
      nextChildMapping.push(c);
    });

    // // last props children if exclusive
    var prevChildMapping = exclusive ? this.props.children : this.state.children;

    var newChildren = ReactTransitionChildMapping.mergeChildMappings(prevChildMapping, nextChildMapping);

    if (showProp) {
      newChildren = newChildren.map(function (c) {
        if (!c.props[showProp] && ReactTransitionChildMapping.isShownInChildren(prevChildMapping, c, showProp)) {
          var newProps = {};
          newProps[showProp] = true;
          c = React.cloneElement(c, newProps);
        }
        return c;
      });
    }

    if (exclusive) {
      // make middle state children invalid
      // restore to last props children
      newChildren.forEach(function (c) {
        _this2.stop(c.key);
      });
    }

    this.setState({
      children: newChildren
    });

    nextChildMapping.forEach(function (c) {
      var key = c.key;
      var hasPrev = prevChildMapping && ReactTransitionChildMapping.inChildren(prevChildMapping, c);
      if (showProp) {
        if (hasPrev) {
          var showInPrev = ReactTransitionChildMapping.isShownInChildren(prevChildMapping, c, showProp);
          var showInNow = c.props[showProp];
          if (!showInPrev && showInNow && !_this2.currentlyTransitioningKeys[key]) {
            _this2.keysToEnter.push(key);
          }
        }
      } else if (!hasPrev && !_this2.currentlyTransitioningKeys[key]) {
        _this2.keysToEnter.push(key);
      }
    });

    prevChildMapping.forEach(function (c) {
      var key = c.key;
      var hasNext = nextChildMapping && ReactTransitionChildMapping.inChildren(nextChildMapping, c);
      if (showProp) {
        if (hasNext) {
          var showInNext = ReactTransitionChildMapping.isShownInChildren(nextChildMapping, c, showProp);
          var showInNow = c.props[showProp];
          if (!showInNext && showInNow && !_this2.currentlyTransitioningKeys[key]) {
            _this2.keysToLeave.push(key);
          }
        }
      } else if (!hasNext && !_this2.currentlyTransitioningKeys[key]) {
        _this2.keysToLeave.push(key);
      }
    });
  },

  performEnter: function performEnter(key) {
    this.currentlyTransitioningKeys[key] = true;
    var component = this._refs[key];
    if (component.componentWillEnter) {
      component.componentWillEnter(this._handleDoneEntering.bind(this, key));
    } else {
      this._handleDoneEntering(key);
    }
  },

  _handleDoneEntering: function _handleDoneEntering(key) {
    //console.log('_handleDoneEntering, ', key);
    delete this.currentlyTransitioningKeys[key];
    var currentChildMapping = this.props.children;
    var showProp = this.props.showProp;
    if (!currentChildMapping || !showProp && !ReactTransitionChildMapping.inChildrenByKey(currentChildMapping, key) || showProp && !ReactTransitionChildMapping.isShownInChildrenByKey(currentChildMapping, key, showProp)) {
      // This was removed before it had fully entered. Remove it.
      //console.log('releave ',key);
      this.performLeave(key);
    } else {
      this.setState({ children: currentChildMapping });
    }
  },

  stop: function stop(key) {
    delete this.currentlyTransitioningKeys[key];
    var component = this._refs[key];
    if (component) {
      component.stop();
    }
  },

  performLeave: function performLeave(key) {
    this.currentlyTransitioningKeys[key] = true;

    var component = this._refs[key];
    if (component.componentWillLeave) {
      component.componentWillLeave(this._handleDoneLeaving.bind(this, key));
    } else {
      // Note that this is somewhat dangerous b/c it calls setState()
      // again, effectively mutating the component before all the work
      // is done.
      this._handleDoneLeaving(key);
    }
  },

  _handleDoneLeaving: function _handleDoneLeaving(key) {
    //console.log('_handleDoneLeaving, ', key);
    delete this.currentlyTransitioningKeys[key];
    var showProp = this.props.showProp;
    var currentChildMapping = this.props.children;
    if (showProp && currentChildMapping && ReactTransitionChildMapping.isShownInChildrenByKey(currentChildMapping, key, showProp)) {
      this.performEnter(key);
    } else if (!showProp && currentChildMapping && ReactTransitionChildMapping.inChildrenByKey(currentChildMapping, key)) {
      // This entered again before it fully left. Add it again.
      //console.log('reenter ',key);
      this.performEnter(key);
    } else {
      this.setState({ children: currentChildMapping });
    }
  },

  componentDidUpdate: function componentDidUpdate() {
    var keysToEnter = this.keysToEnter;
    this.keysToEnter = [];
    keysToEnter.forEach(this.performEnter);
    var keysToLeave = this.keysToLeave;
    this.keysToLeave = [];
    keysToLeave.forEach(this.performLeave);
  },

  render: function render() {
    var _this = this;
    var props = this.props;
    var children = this.state.children.map(function (child) {
      return React.createElement(
        CSSTransitionGroupChild,
        {
          key: child.key,
          ref: function (c) {
            _this._refs[child.key] = c;
          },
          name: props.transitionName,
          enter: props.transitionEnter,
          leave: props.transitionLeave },
        child
      );
    });
    var Component = this.props.component;
    return React.createElement(
      Component,
      this.props,
      children
    );
  }
});
module.exports = CSSTransitionGroup;
},{"react":6,"./ReactTransitionChildMapping":183,"./CSSTransitionGroupChild":184}],73:[function(require,module,exports) {
'use strict';

module.exports = require('./CSSTransitionGroup');
},{"./CSSTransitionGroup":107}],57:[function(require,module,exports) {
module.exports = require('rc-css-transition-group-modern');

},{"rc-css-transition-group-modern":73}],45:[function(require,module,exports) {
module.exports = require('react/lib/ReactCSSTransitionGroup');
},{"react/lib/ReactCSSTransitionGroup":57}],47:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
/* global jQuery, Elements */
// Only used for the dirty checking, so the event callback count is limted to max 1 call per fps per sensor.
// In combination with the event based resize sensor this saves cpu time, because the sensor is too fast and
// would generate too many unnecessary events.
var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || function (fn) {
  return window.setTimeout(fn, 20);
};

/**
 * Iterate over each of the provided element(s).
 *
 * @param {HTMLElement|HTMLElement[]} elements
 * @param {Function}                  callback
 */
function forEachElement(elements, callback) {
  var elementsType = Object.prototype.toString.call(elements);
  var isCollectionTyped = elementsType === '[object Array]' || elementsType === '[object NodeList]' || elementsType === '[object HTMLCollection]' || typeof jQuery !== 'undefined' && elements instanceof jQuery || typeof Elements !== 'undefined' && elements instanceof Elements // mootools
  ;
  var i = 0;
  var j = elements.length;
  if (isCollectionTyped) {
    for (; i < j; i++) {
      callback(elements[i]);
    }
  } else {
    callback(elements);
  }
}

/**
 * Class for dimension change detection.
 *
 * @param {Element|Element[]|Elements|jQuery} element
 * @param {Function} callback
 *
 * @constructor
 */
var ResizeSensor = function (element, callback) {
  /**
   *
   * @constructor
   */
  function EventQueue() {
    var q = [];
    this.add = function (ev) {
      q.push(ev);
    };

    var i, j;
    this.call = function () {
      for (i = 0, j = q.length; i < j; i++) {
        q[i].call();
      }
    };

    this.remove = function (ev) {
      var newQueue = [];
      for (i = 0, j = q.length; i < j; i++) {
        if (q[i] !== ev) newQueue.push(q[i]);
      }
      q = newQueue;
    };

    this.length = function () {
      return q.length;
    };
  }

  /**
   * @param {HTMLElement} element
   * @param {String}      prop
   * @returns {String|Number}
   */
  function getComputedStyle(element, prop) {
    if (element.currentStyle) {
      return element.currentStyle[prop];
    } else if (window.getComputedStyle) {
      return window.getComputedStyle(element, null).getPropertyValue(prop);
    } else {
      return element.style[prop];
    }
  }

  /**
   *
   * @param {HTMLElement} element
   * @param {Function}    resized
   */
  function attachResizeEvent(element, resized) {
    if (!element.resizedAttached) {
      element.resizedAttached = new EventQueue();
      element.resizedAttached.add(resized);
    } else if (element.resizedAttached) {
      element.resizedAttached.add(resized);
      return;
    }

    element.resizeSensor = document.createElement('div');
    element.resizeSensor.className = 'resize-sensor';
    var style = 'position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;';
    var styleChild = 'position: absolute; left: 0; top: 0; transition: 0s;';

    element.resizeSensor.style.cssText = style;
    element.resizeSensor.innerHTML = '<div class="resize-sensor-expand" style="' + style + '">' + '<div style="' + styleChild + '"></div>' + '</div>' + '<div class="resize-sensor-shrink" style="' + style + '">' + '<div style="' + styleChild + ' width: 200%; height: 200%"></div>' + '</div>';
    element.appendChild(element.resizeSensor);

    if (getComputedStyle(element, 'position') === 'static') {
      element.style.position = 'relative';
    }

    var expand = element.resizeSensor.childNodes[0];
    var expandChild = expand.childNodes[0];
    var shrink = element.resizeSensor.childNodes[1];

    var reset = function () {
      expandChild.style.width = 100000 + 'px';
      expandChild.style.height = 100000 + 'px';

      expand.scrollLeft = 100000;
      expand.scrollTop = 100000;

      shrink.scrollLeft = 100000;
      shrink.scrollTop = 100000;
    };

    reset();
    var dirty = false;

    var dirtyChecking = function () {
      if (!element.resizedAttached) return;

      if (dirty) {
        element.resizedAttached.call();
        dirty = false;
      }

      requestAnimationFrame(dirtyChecking);
    };

    requestAnimationFrame(dirtyChecking);
    var lastWidth, lastHeight;
    var cachedWidth, cachedHeight; // useful to not query offsetWidth twice

    var onScroll = function () {
      if ((cachedWidth = element.offsetWidth) !== lastWidth || (cachedHeight = element.offsetHeight) !== lastHeight) {
        dirty = true;

        lastWidth = cachedWidth;
        lastHeight = cachedHeight;
      }
      reset();
    };

    var addEvent = function (el, name, cb) {
      if (el.attachEvent) {
        el.attachEvent('on' + name, cb);
      } else {
        el.addEventListener(name, cb);
      }
    };

    addEvent(expand, 'scroll', onScroll);
    addEvent(shrink, 'scroll', onScroll);
  }

  forEachElement(element, function (elem) {
    attachResizeEvent(elem, callback);
  });

  this.detach = function (ev) {
    ResizeSensor.detach(element, ev);
  };
};

ResizeSensor.detach = function (element, ev) {
  forEachElement(element, function (elem) {
    if (elem.resizedAttached && typeof ev === 'function') {
      elem.resizedAttached.remove(ev);
      if (elem.resizedAttached.length()) return;
    }
    if (elem.resizeSensor) {
      elem.removeChild(elem.resizeSensor);
      delete elem.resizeSensor;
      delete elem.resizedAttached;
    }
  });
};

exports.default = ResizeSensor;
},{}],133:[function(require,module,exports) {
// 19.1.2.14 Object.keys(O)
var toObject = require('./_to-object');
var $keys = require('./_object-keys');

require('./_object-sap')('keys', function () {
  return function keys(it) {
    return $keys(toObject(it));
  };
});

},{"./_to-object":127,"./_object-keys":178,"./_object-sap":129}],72:[function(require,module,exports) {
require('../../modules/es6.object.keys');
module.exports = require('../../modules/_core').Object.keys;

},{"../../modules/es6.object.keys":133,"../../modules/_core":67}],56:[function(require,module,exports) {
module.exports = { "default": require("core-js/library/fn/object/keys"), __esModule: true };
},{"core-js/library/fn/object/keys":72}],38:[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.getSettings = undefined;

var _keys = require("babel-runtime/core-js/object/keys");

var _keys2 = _interopRequireDefault(_keys);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function getRatio(size) {
  return size.width / size.height;
}
function isLarge(width) {
  return width > 768;
}
function isMedium(width) {
  return width > 440;
}

function isSmall(width) {
  return width <= 440;
}

function chooseSettings(config) {
  var windowWidth = window.innerWidth;
  if (isLarge(windowWidth)) {
    return {
      width: config.size.width,
      height: config.size.height,
      gutter: config.gutter,
      border: config.cell_border,
      columns: config.columns
    };
  } else if (isMedium(windowWidth)) {
    return {
      width: config.size768.width,
      height: config.size768.width / getRatio(config.size768),
      gutter: config.gutter_768,
      border: config.cell_border_768,
      columns: config.columns_768
    };
  } else {
    return {
      width: config.size440.width,
      height: config.size440.width / getRatio(config.size440),
      gutter: config.gutter_440,
      border: config.cell_border_440,
      columns: config.columns_440
    };
  }
}

function nanOrNull(a) {
  var b = parseInt(a);
  if (isNaN(b)) return 0;
  return b;
}
function getSettingsDefaults(settings) {
  return (0, _keys2.default)(settings).reduce(function (result, key) {
    result[key] = nanOrNull(settings[key]);
    return result;
  }, {});
}
function getSettings(config) {
  return getSettingsDefaults(chooseSettings(config));
}
exports.getSettings = getSettings;
},{"babel-runtime/core-js/object/keys":56}],17:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = require('babel-runtime/helpers/extends');

var _extends3 = _interopRequireDefault(_extends2);

var _getPrototypeOf = require('babel-runtime/core-js/object/get-prototype-of');

var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);

var _classCallCheck2 = require('babel-runtime/helpers/classCallCheck');

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = require('babel-runtime/helpers/createClass');

var _createClass3 = _interopRequireDefault(_createClass2);

var _possibleConstructorReturn2 = require('babel-runtime/helpers/possibleConstructorReturn');

var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);

var _inherits2 = require('babel-runtime/helpers/inherits');

var _inherits3 = _interopRequireDefault(_inherits2);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _filters = require('./filters');

var _filters2 = _interopRequireDefault(_filters);

var _cell = require('./cell');

var _cell2 = _interopRequireDefault(_cell);

var _reactGalleryLayout = require('react-gallery-layout');

var _reactGalleryLayout2 = _interopRequireDefault(_reactGalleryLayout);

var _pagination = require('./pagination');

var _pagination2 = _interopRequireDefault(_pagination);

var _reactAddonsCssTransitionGroup = require('react-addons-css-transition-group');

var _reactAddonsCssTransitionGroup2 = _interopRequireDefault(_reactAddonsCssTransitionGroup);

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

var _resize = require('react-gallery-layout/src/resize');

var _resize2 = _interopRequireDefault(_resize);

var _settings = require('./settings');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function asap(callback) {
  setTimeout(callback, 0);
}
var isRTL = function isRTL() {
  return document.body.classList.contains('rtl');
};

function getGap(config) {
  var gap = undefined;
  if (window.innerWidth > 768) {
    gap = parseInt(config.gutter);
  } else if (window.width > 440) {
    gap = parseInt(config.gutter_768);
  } else {
    gap = parseInt(config.gutter_440);
  }
  if (isNaN(gap)) {
    return 0;
  }
  return gap;
}

function doubleWidth(settings) {
  return settings.width * 2 + settings.gutter + settings.border * 2;
}

var getWidth = function getWidth(stateWidth, configWidth) {
  var maxWidth = parseInt(configWidth);
  if (!isNaN(maxWidth)) {
    return Math.min(stateWidth, maxWidth);
  } else {
    return stateWidth;
  }
};

function getDoubled(size, gutter, border) {
  return size * 2 + gutter + border * 2;
}
function getSizes(config, state, settings) {
  var windowWidth = window.innerWidth;
  var aspectRatio = settings.width / settings.height;
  var autosize = config.autosize || doubleWidth(settings) > state.width;
  var width = getWidth(state.width, config.max_width);
  if (settings.columns === 0) settings.columns = null;

  if (autosize || settings.columns) {
    if (!settings.columns) {
      settings.columns = Math.ceil((width + settings.gutter) / (settings.width + settings.gutter + settings.border * 2));
    }
    settings.width = Math.floor((width + settings.gutter) / settings.columns) - settings.gutter - settings.border * 2;
    if (settings.columns == 2 && settings.width * 2 + settings.border * 2 + settings.gutter > width) {
      settings.width = (settings.width - settings.gutter + settings.border * 2) / 2;
    }
  }
  settings.height = Math.floor(settings.width / aspectRatio);
  settings.doubleWidth = getDoubled(settings.width, settings.gutter, settings.border);
  settings.doubleHeight = getDoubled(settings.height, settings.gutter, settings.border);
  return {
    r1c1: {
      width: settings.width,
      height: settings.height
    },
    r1c2: {
      width: settings.doubleWidth,
      height: settings.height
    },
    r2c1: {
      width: settings.width,
      height: settings.doubleHeight
    },
    r2c2: {
      width: settings.doubleWidth,
      height: settings.doubleHeight
    }
  };
}

function getStyle(props) {
  var max = props.config.max_width;
  if (max && !isNaN(parseInt(max))) {
    return {
      maxWidth: parseInt(max) + "px"
    };
  }
}

var App = function (_React$Component) {
  (0, _inherits3.default)(App, _React$Component);

  function App(props) {
    (0, _classCallCheck3.default)(this, App);

    var _this = (0, _possibleConstructorReturn3.default)(this, (App.__proto__ || (0, _getPrototypeOf2.default)(App)).call(this, props));

    _this.state = {
      mounted: false
    };
    _this.updateWidth = _this.updateWidth.bind(_this);
    return _this;
  }

  (0, _createClass3.default)(App, [{
    key: 'componentDidMount',
    value: function componentDidMount() {
      var _this2 = this;

      this.updateWidth();

      asap(function () {
        _this2.setState({ mounted: true });
      }.bind(this));
      new _resize2.default(_reactDom2.default.findDOMNode(this).parentNode, function () {
        _this2.updateWidth();
        setTimeout(_this2.updateWidth, 1700);
      });
      _reactDom2.default.findDOMNode(this).parentElement.style.opacity = 1;
    }
  }, {
    key: 'updateWidth',
    value: function updateWidth() {
      this.setState({
        width: _reactDom2.default.findDOMNode(this).offsetWidth
      });
    }
  }, {
    key: 'render',
    value: function render() {
      var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : this.props;

      var state = this.state;
      var classNames = (0, _classnames2.default)(props.className, "uber-grid-initialized", "uber-grid-effect-" + props.hoverEffect);
      var settings = (0, _settings.getSettings)(props.config);
      var sizes = getSizes(props.config, state, settings);
      return _react2.default.createElement(
        'div',
        { className: classNames,
          style: { opacity: state.mounted ? '1' : '0' } },
        props.filters ? _react2.default.createElement(_filters2.default, props) : null,
        _react2.default.createElement(
          'div',
          { className: 'uber-grid-cells-wrapper', style: getStyle(props) },
          _react2.default.createElement(
            _reactGalleryLayout2.default,
            { wrapper: _reactAddonsCssTransitionGroup2.default,
              transitionName: 'uber-grid',
              component: 'div',
              className: 'uber-grid-cells',
              transitionEnterTimeout: 600,
              transitionLeaveTimeout: 600,
              id: props.id,
              gap: getGap(props.config),
              columns: props.config.columns,
              ref: 'gallery',
              rtl: isRTL(),
              centered: true },
            props.visibleCells.map(function (cell, index) {
              return _react2.default.createElement(_cell2.default, (0, _extends3.default)({}, props, cell, { key: cell.index, sizes: sizes,
                settings: settings,
                mounted: state.mounted, cellLayout: cell.layout }));
            }, this)
          )
        ),
        _react2.default.createElement(_pagination2.default, props)
      );
    }
  }]);
  return App;
}(_react2.default.Component);

exports.default = App;
},{"babel-runtime/helpers/extends":27,"babel-runtime/core-js/object/get-prototype-of":39,"babel-runtime/helpers/classCallCheck":40,"babel-runtime/helpers/createClass":42,"babel-runtime/helpers/possibleConstructorReturn":41,"babel-runtime/helpers/inherits":43,"react":6,"react-dom":6,"./filters":35,"./cell":36,"react-gallery-layout":44,"./pagination":37,"react-addons-css-transition-group":45,"classnames":122,"react-gallery-layout/src/resize":47,"./settings":38}],5:[function(require,module,exports) {
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _filters = require('./filters');

function f(state) {
  if (state.filter && state.filter !== '_') {
    state.filteredCells = (0, _filters.filter)(state.cells, state.filter);
  } else {
    state.filteredCells = [].concat(state.cells);
  }
  if (state.config.pagination.enable) {
    var pageSize = parseInt(state.config.pagination.per_page);
    if (state.config.pagination.style === 'load-more') {
      return state.visibleCells = state.filteredCells.slice(0, (state.page + 1) * pageSize);
    } else {
      return state.visibleCells = state.filteredCells.slice(state.page * pageSize, (state.page + 1) * pageSize);
    }
  } else {
    return state.visibleCells = [].concat(state.filteredCells);
  }
};

exports.default = {
  init: function init(state) {
    f(state);
  },
  filter: function filter(state, newFilter) {
    state.filter = newFilter;
    state.page = 0;
    return f(state);
  },
  paginate: function paginate(state, page) {
    state.page = page;
    return f(state);
  },
  loadMore: function loadMore(state) {
    state.page++;
    return f(state);
  }
};
},{"./filters":19}],1:[function(require,module,exports) {
'use strict';

require('array.prototype.filter');

var _collect = require('./collect');

var _collect2 = _interopRequireDefault(_collect);

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactDom = require('react-dom');

var _reactDom2 = _interopRequireDefault(_reactDom);

var _app = require('yaux/lib/app');

var _app2 = _interopRequireDefault(_app);

var _components = require('./components');

var _components2 = _interopRequireDefault(_components);

var _lightbox = require('./lightbox');

var _lightbox2 = _interopRequireDefault(_lightbox);

var _store = require('./store');

var _store2 = _interopRequireDefault(_store);

var _arrayPrototype = require('array.prototype.find');

var _arrayPrototype2 = _interopRequireDefault(_arrayPrototype);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function optionsFrom(cells, slug) {
  var cell = (0, _arrayPrototype2.default)(cells, function (item) {
    return item.slug == slug;
  });
  if (!cell) {
    return null;
  }
  return [cells, cells.indexOf(cell)];
}

window.ubergrid = function (el, config) {
  var state = (0, _collect2.default)(el, config);
  var app = new _app2.default(state, [_store2.default], el, _components2.default);
  app.store.dispatch('init');
  if (typeof jQuery !== 'undefined' || typeof window.jQuery !== 'undefined') {
    (jQuery || window.jQuery)(window).trigger('ubergrid:init', el);
  }
  if (window.location.hash) {
    var parts = window.location.hash.replace(/^#/, '').split('/');
    if (parts[0] === state.slug) {
      var slug = parts[1];
      var opt = optionsFrom(app.store.state.filteredCells, slug);
      if (!opt) {
        opt = optionsFrom(app.store.state.cells, slug);
      }
      if (opt) {
        (0, _lightbox2.default)(opt[0], opt[1], config.lightbox);
      }
    }
  }
};
},{"array.prototype.filter":8,"./collect":3,"react":6,"react-dom":6,"yaux/lib/app":7,"./components":17,"./lightbox":4,"./store":5,"array.prototype.find":9}]},{},[1])
//# sourceMappingURL=/uber-grid.js.map