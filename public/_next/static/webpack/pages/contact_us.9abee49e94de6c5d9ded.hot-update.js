webpackHotUpdate_N_E("pages/contact_us",{

/***/ "./state/globalState.js":
/*!******************************!*\
  !*** ./state/globalState.js ***!
  \******************************/
/*! exports provided: StateProvider, setUserGlobal, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"StateProvider\", function() { return StateProvider; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"setUserGlobal\", function() { return setUserGlobal; });\n/* harmony import */ var _babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/esm/defineProperty */ \"./node_modules/@babel/runtime/helpers/esm/defineProperty.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _API_card__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../API/card */ \"./API/card.js\");\n/* harmony import */ var _globalActions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./globalActions */ \"./state/globalActions.js\");\n\n\nvar _jsxFileName = \"/var/www/html/meetings-introdunction/state/globalState.js\",\n    _s = $RefreshSig$();\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_1___default.a.createElement;\n\nfunction _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === \"undefined\" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === \"number\") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError(\"Invalid attempt to iterate non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it[\"return\"] != null) it[\"return\"](); } finally { if (didErr) throw err; } } }; }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }\n\nfunction _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { Object(_babel_runtime_helpers_esm_defineProperty__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }\n\n// https://www.codementor.io/@mohitprakash/state-management-with-react-context-hooks-146isj3itf\n\n\n\nvar initialState = {\n  basket: {},\n  ModalStatus: '',\n  user: {}\n};\n\nvar load = function load() {\n  var persist = window.localStorage.getItem('kalapich-persist');\n  if (persist) persist = JSON.parse(persist);else return initialState;\n  if (persist.basket) return persist;else return initialState;\n};\n\nvar ToBeSaved = {};\n\nfunction save(state_) {\n  ToBeSaved.last = state_;\n  setTimeout(function () {\n    window.localStorage.setItem('kalapich-persist', JSON.stringify(ToBeSaved.last));\n  }, 50);\n}\n\nvar setUserGlobal = function setUserGlobal(user) {\n  console.log('dummy setUserGlobal should not be called');\n};\n\nif (true) initialState = load();\nvar stateContext = /*#__PURE__*/Object(react__WEBPACK_IMPORTED_MODULE_1__[\"createContext\"])(initialState);\n\nvar getLastState = function getLastState() {\n  return initialState;\n}; // dummy getLastState\n\n\nfunction StateProvider(props) {\n  _s();\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_1__[\"useState\"])(initialState.basket),\n      basket = _useState[0],\n      setBasket = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_1__[\"useState\"])(initialState.ModalStatus),\n      ModalStatus = _useState2[0],\n      setModalStatus = _useState2[1];\n\n  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_1__[\"useState\"])(initialState.user),\n      user = _useState3[0],\n      setUser = _useState3[1];\n\n  setUserGlobal = function setUserGlobal(user2) {\n    Object(_globalActions__WEBPACK_IMPORTED_MODULE_3__[\"default\"])(dispatch).mountBasket();\n    setTimeout(function () {\n      dispatch({\n        type: 'set_user',\n        payload: user2\n      });\n    }, 1000); // for saving to local storage\n  };\n\n  var state = {\n    basket: basket,\n    ModalStatus: ModalStatus,\n    user: user\n  };\n\n  getLastState = function getLastState() {\n    return state;\n  };\n  /* *********  Reducer begin  ********* */\n\n\n  var dispatch = function dispatch(action) {\n    console.log('ACTION: ' + action.type + ' ', {\n      action: action,\n      state: state\n    });\n    var nextState = state;\n    var product;\n    var basket2;\n\n    switch (action.type) {\n      case 'set_user':\n        setUser(action.payload);\n        nextState = _objectSpread(_objectSpread({}, state), {}, {\n          user: action.payload\n        });\n        break;\n\n      case 'logout':\n        setUser({});\n        setBasket({});\n        window.localStorage.clear();\n        nextState = _objectSpread(_objectSpread({}, state), {}, {\n          basket: {},\n          user: {}\n        });\n        break;\n\n      case \"Add_To_Basket\":\n        //const { basket } = state\n        basket2 = _objectSpread({}, getLastState().basket); // shallow copy\n\n        product = action.payload;\n        if (basket2[product.id]) basket2[product.id].count += 1;else basket2[product.id] = {\n          product: product,\n          count: 1\n        };\n        nextState = _objectSpread(_objectSpread({}, state), {}, {\n          basket: basket2\n        });\n        setBasket(basket2);\n        break;\n\n      case 'clear_Basket':\n        nextState = _objectSpread(_objectSpread({}, state), {}, {\n          basket: {}\n        });\n        setBasket({});\n        break;\n\n      case 'dec_from_Basket':\n        product = action.payload;\n        basket2 = _objectSpread({}, getLastState().basket); // shallow copy\n\n        console.log(basket2[product.id]);\n        if (basket2[product.id]) if (basket2[product.id].count > 1) basket2[product.id].count -= 1;else delete basket2[product.id];\n        nextState = _objectSpread(_objectSpread({}, state), {}, {\n          basket: basket2\n        });\n        setBasket(basket2);\n        break;\n\n      case 'mount_Basket':\n        Object(_API_card__WEBPACK_IMPORTED_MODULE_2__[\"getCard\"])().then(function (resp) {\n          var newBasket = {};\n\n          if (resp.code == 200) {\n            var _iterator = _createForOfIteratorHelper(resp.data),\n                _step;\n\n            try {\n              for (_iterator.s(); !(_step = _iterator.n()).done;) {\n                var prod = _step.value;\n                newBasket[prod.id] = {\n                  product: prod,\n                  count: prod.count\n                };\n              }\n            } catch (err) {\n              _iterator.e(err);\n            } finally {\n              _iterator.f();\n            }\n\n            setBasket(newBasket);\n            setTimeout(function () {\n              return save(_objectSpread(_objectSpread({}, state), {}, {\n                basket: newBasket\n              }));\n            }, 150);\n          } else {\n            console.log('action api err 795423');\n          }\n        })[\"catch\"](function (err) {\n          console.log('action api err 6756754');\n        });\n        break;\n\n      case 'open_login_modal':\n        setModalStatus('login');\n        break;\n\n      case 'set_modal':\n        setModalStatus(action.payload);\n        break;\n\n      default:\n        console.log('No action found for: ' + action.type, {\n          action: action\n        });\n        nextState = state;\n    }\n\n    nextState.ModalStatus = ''; //nextState.userInfo = nextState.user?.mobile\n\n    save(nextState);\n  };\n  /* *********  Reducer end  ********* */\n\n\n  return __jsx(stateContext.Provider, {\n    value: {\n      state: state,\n      dispatch: dispatch\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 178,\n      columnNumber: 9\n    }\n  }, props.children);\n}\n\n_s(StateProvider, \"dR1UtaZ91ODIjvNlhCfQO054xMA=\");\n\n_c = StateProvider;\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (stateContext);\n\nvar _c;\n\n$RefreshReg$(_c, \"StateProvider\");\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9fTl9FLy4vc3RhdGUvZ2xvYmFsU3RhdGUuanM/NzVmYSJdLCJuYW1lcyI6WyJpbml0aWFsU3RhdGUiLCJiYXNrZXQiLCJNb2RhbFN0YXR1cyIsInVzZXIiLCJsb2FkIiwicGVyc2lzdCIsIndpbmRvdyIsImxvY2FsU3RvcmFnZSIsImdldEl0ZW0iLCJKU09OIiwicGFyc2UiLCJUb0JlU2F2ZWQiLCJzYXZlIiwic3RhdGVfIiwibGFzdCIsInNldFRpbWVvdXQiLCJzZXRJdGVtIiwic3RyaW5naWZ5Iiwic2V0VXNlckdsb2JhbCIsImNvbnNvbGUiLCJsb2ciLCJzdGF0ZUNvbnRleHQiLCJjcmVhdGVDb250ZXh0IiwiZ2V0TGFzdFN0YXRlIiwiU3RhdGVQcm92aWRlciIsInByb3BzIiwidXNlU3RhdGUiLCJzZXRCYXNrZXQiLCJzZXRNb2RhbFN0YXR1cyIsInNldFVzZXIiLCJ1c2VyMiIsIkFjdGlvbnMiLCJkaXNwYXRjaCIsIm1vdW50QmFza2V0IiwidHlwZSIsInBheWxvYWQiLCJzdGF0ZSIsImFjdGlvbiIsIm5leHRTdGF0ZSIsInByb2R1Y3QiLCJiYXNrZXQyIiwiY2xlYXIiLCJpZCIsImNvdW50IiwiZ2V0Q2FyZCIsInRoZW4iLCJyZXNwIiwibmV3QmFza2V0IiwiY29kZSIsImRhdGEiLCJwcm9kIiwiZXJyIiwiY2hpbGRyZW4iXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFFQTtBQUVBO0FBRUE7QUFFQTtBQUdBLElBQUlBLFlBQVksR0FBRztBQUNmQyxRQUFNLEVBQUUsRUFETztBQUVmQyxhQUFXLEVBQUUsRUFGRTtBQUdmQyxNQUFJLEVBQUU7QUFIUyxDQUFuQjs7QUFNQSxJQUFNQyxJQUFJLEdBQUcsU0FBUEEsSUFBTyxHQUFNO0FBQ2YsTUFBSUMsT0FBTyxHQUFHQyxNQUFNLENBQUNDLFlBQVAsQ0FBb0JDLE9BQXBCLENBQTRCLGtCQUE1QixDQUFkO0FBQ0EsTUFBSUgsT0FBSixFQUNJQSxPQUFPLEdB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N0MsRUFBbUQ7QUFBRUcsZ0JBQU0sRUFBTkE7QUFBRixTQUFuRDtBQUNBQyxpQkFBUyxHQUFHRixLQUFaO0FBcEZSOztBQXVGQUUsYUFBUyxDQUFDcEMsV0FBVixHQUF3QixFQUF4QixDQTdGeUIsQ0E4RnpCOztBQUNBVSxRQUFJLENBQUMwQixTQUFELENBQUo7QUFFSCxHQWpHRDtBQW1HQTs7O0FBR0EsU0FDSSxNQUFDLFlBQUQsQ0FBYyxRQUFkO0FBQXVCLFNBQUssRUFBRTtBQUFFRixXQUFLLEVBQUxBLEtBQUY7QUFBU0osY0FBUSxFQUFSQTtBQUFULEtBQTlCO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsS0FDS1AsS0FBSyxDQUFDMkIsUUFEWCxDQURKO0FBS0g7O0dBL0hRNUIsYTs7S0FBQUEsYTtBQWtJVDtBQUllSCwyRUFBZiIsImZpbGUiOiIuL3N0YXRlL2dsb2JhbFN0YXRlLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXG5cbi8vIGh0dHBzOi8vd3d3LmNvZGVtZW50b3IuaW8vQG1vaGl0cHJha2FzaC9zdGF0ZS1tYW5hZ2VtZW50LXdpdGgtcmVhY3QtY29udGV4dC1ob29rcy0xNDZpc2ozaXRmXG5cbmltcG9ydCBSZWFjdCwgeyBjcmVhdGVDb250ZXh0LCB1c2VTdGF0ZSB9IGZyb20gXCJyZWFjdFwiO1xuXG5pbXBvcnQgeyBnZXRDYXJkIH0gZnJvbSAnLi4vQVBJL2NhcmQnXG5cbmltcG9ydCBBY3Rpb25zIGZyb20gJy4vZ2xvYmFsQWN0aW9ucydcblxuXG5sZXQgaW5pdGlhbFN0YXRlID0ge1xuICAgIGJhc2tldDoge30sXG4gICAgTW9kYWxTdGF0dXM6ICcnLFxuICAgIHVzZXI6IHt9LFxufVxuXG5jb25zdCBsb2FkID0gKCkgPT4ge1xuICAgIGxldCBwZXJzaXN0ID0gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKCdrYWxhcGljaC1wZXJzaXN0JylcbiAgICBpZiAocGVyc2lzdClcbiAgICAgICAgcGVyc2lzdCA9IEpTT04ucGFyc2UocGVyc2lzdClcbiAgICBlbHNlXG4gICAgICAgIHJldHVybiBpbml0aWFsU3RhdGVcblxuICAgIGlmIChwZXJzaXN0LmJhc2tldClcbiAgICAgICAgcmV0dXJuIHBlcnNpc3RcbiAgICBlbHNlXG4gICAgICAgIHJldHVybiBpbml0aWFsU3RhdGVcbn1cblxuXG5jb25zdCBUb0JlU2F2ZWQgPSB7fVxuZnVuY3Rpb24gc2F2ZShzdGF0ZV8pIHtcbiAgICBUb0JlU2F2ZWQubGFzdCA9IHN0YXRlX1xuICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oJ2thbGFwaWNoLXBlcnNpc3QnLCBKU09OLnN0cmluZ2lmeShUb0JlU2F2ZWQubGFzdCkpXG4gICAgfSwgNTApXG59XG5cblxubGV0IHNldFVzZXJHbG9iYWwgPSAodXNlcikgPT4ge1xuICAgIGNvbnNvbGUubG9nKCdkdW1teSBzZXRVc2VyR2xvYmFsIHNob3VsZCBub3QgYmUgY2FsbGVkJylcbn1cblxuXG5cbmlmICh0eXBlb2Ygd2luZG93ICE9PSAndW5kZWZpbmVkJylcbiAgICBpbml0aWFsU3RhdGUgPSBsb2FkKClcblxuY29uc3Qgc3RhdGVDb250ZXh0ID0gY3JlYXRlQ29udGV4dChpbml0aWFsU3RhdGUpO1xuXG5sZXQgZ2V0TGFzdFN0YXRlID0gKCkgPT4gaW5pdGlhbFN0YXRlIC8vIGR1bW15IGdldExhc3RTdGF0ZVxuXG5cbmZ1bmN0aW9uIFN0YXRlUHJvdmlkZXIocHJvcHMpIHtcblxuICAgIGNvbnN0IFtiYXNrZXQsIHNldEJhc2tldF0gPSB1c2VTdGF0ZShpbml0aWFsU3RhdGUuYmFza2V0KVxuICAgIGNvbnN0IFtNb2RhbFN0YXR1cywgc2V0TW9kYWxTdGF0dXNdID0gdXNlU3RhdGUoaW5pdGlhbFN0YXRlLk1vZGFsU3RhdHVzKVxuICAgIGNvbnN0IFt1c2VyLCBzZXRVc2VyXSA9IHVzZVN0YXRlKGluaXRpYWxTdGF0ZS51c2VyKVxuXG4gICAgc2V0VXNlckdsb2JhbCA9ICh1c2VyMikgPT4ge1xuXG4gICAgICAgIEFjdGlvbnMoZGlzcGF0Y2gpLm1vdW50QmFza2V0KClcbiAgICAgICAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgICAgICBkaXNwYXRjaCh7IHR5cGU6ICdzZXRfdXNlcicsIHBheWxvYWQ6IHVzZXIyIH0pXG4gICAgICAgIH0sIDEwMDApIC8vIGZvciBzYXZpbmcgdG8gbG9jYWwgc3RvcmFnZVxuXG4gICAgfVxuXG4gICAgY29uc3Qgc3RhdGUgPSB7IGJhc2tldCwgTW9kYWxTdGF0dXMsIHVzZXIgfVxuICAgIGdldExhc3RTdGF0ZSA9ICgpID0+IHN0YXRlXG5cbiAgICAvKiAqKioqKioqKiogIFJlZHVjZXIgYmVnaW4gICoqKioqKioqKiAqL1xuXG4gICAgY29uc3QgZGlzcGF0Y2ggPSAoYWN0aW9uKSA9PiB7XG5cbiAgICAgICAgY29uc29sZS5sb2coJ0FDVElPTjogJyArIGFjdGlvbi50eXBlICsgJyAnLCB7IGFjdGlvbiwgc3RhdGUgfSlcbiAgICAgICAgbGV0IG5leHRTdGF0ZSA9IHN0YXRlXG4gICAgICAgIGxldCBwcm9kdWN0XG4gICAgICAgIGxldCBiYXNrZXQyXG4gICAgICAgIHN3aXRjaCAoYWN0aW9uLnR5cGUpIHtcbiAgICAgICAgICAgIGNhc2UgJ3NldF91c2VyJzpcbiAgICAgICAgICAgICAgICBzZXRVc2VyKGFjdGlvbi5wYXlsb2FkKVxuICAgICAgICAgICAgICAgIG5leHRTdGF0ZSA9IHtcbiAgICAgICAgICAgICAgICAgICAgLi4uc3RhdGUsXG4gICAgICAgICAgICAgICAgICAgIHVzZXI6IGFjdGlvbi5wYXlsb2FkXG4gICAgICAgICAgICAgICAgfTtcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ2xvZ291dCc6XG4gICAgICAgICAgICAgICAgc2V0VXNlcih7fSlcbiAgICAgICAgICAgICAgICBzZXRCYXNrZXQoe30pXG4gICAgICAgICAgICAgICAgd2luZG93LmxvY2FsU3RvcmFnZS5jbGVhcigpXG4gICAgICAgICAgICAgICAgbmV4dFN0YXRlID0ge1xuICAgICAgICAgICAgICAgICAgICAuLi5zdGF0ZSxcbiAgICAgICAgICAgICAgICAgICAgYmFza2V0OiB7fSxcbiAgICAgICAgICAgICAgICAgICAgdXNlcjoge31cbiAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSBcIkFkZF9Ub19CYXNrZXRcIjpcblxuICAgICAgICAgICAgICAgIC8vY29uc3QgeyBiYXNrZXQgfSA9IHN0YXRlXG4gICAgICAgICAgICAgICAgYmFza2V0MiA9IHsgLi4uZ2V0TGFzdFN0YXRlKCkuYmFza2V0IH0gLy8gc2hhbGxvdyBjb3B5XG4gICAgICAgICAgICAgICAgcHJvZHVjdCA9IGFjdGlvbi5wYXlsb2FkXG4gICAgICAgICAgICAgICAgaWYgKGJhc2tldDJbcHJvZHVjdC5pZF0pXG4gICAgICAgICAgICAgICAgICAgIGJhc2tldDJbcHJvZHVjdC5pZF0uY291bnQgKz0gMVxuICAgICAgICAgICAgICAgIGVsc2VcbiAgICAgICAgICAgICAgICAgICAgYmFza2V0Mltwcm9kdWN0LmlkXSA9IHsgcHJvZHVjdCwgY291bnQ6IDEgfVxuICAgICAgICAgICAgICAgIG5leHRTdGF0ZSA9IHtcbiAgICAgICAgICAgICAgICAgICAgLi4uc3RhdGUsXG4gICAgICAgICAgICAgICAgICAgIGJhc2tldDogYmFza2V0MlxuICAgICAgICAgICAgICAgIH07XG4gICAgICAgICAgICAgICAgc2V0QmFza2V0KGJhc2tldDIpXG4gICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICBjYXNlICdjbGVhcl9CYXNrZXQnOlxuICAgICAgICAgICAgICAgIG5leHRTdGF0ZSA9IHtcbiAgICAgICAgICAgICAgICAgICAgLi4uc3RhdGUsXG4gICAgICAgICAgICAgICAgICAgIGJhc2tldDoge31cbiAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIHNldEJhc2tldCh7fSlcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGNhc2UgJ2RlY19mcm9tX0Jhc2tldCc6XG4gICAgICAgICAgICAgICAgcHJvZHVjdCA9IGFjdGlvbi5wYXlsb2FkXG5cbiAgICAgICAgICAgICAgICBiYXNrZXQyID0geyAuLi5nZXRMYXN0U3RhdGUoKS5iYXNrZXQgfSAvLyBzaGFsbG93IGNvcHlcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhiYXNrZXQyW3Byb2R1Y3QuaWRdKVxuICAgICAgICAgICAgICAgIGlmIChiYXNrZXQyW3Byb2R1Y3QuaWRdKVxuICAgICAgICAgICAgICAgICAgICBpZiAoYmFza2V0Mltwcm9kdWN0LmlkXS5jb3VudCA+IDEpXG4gICAgICAgICAgICAgICAgICAgICAgICBiYXNrZXQyW3Byb2R1Y3QuaWRdLmNvdW50IC09IDFcbiAgICAgICAgICAgICAgICAgICAgZWxzZVxuICAgICAgICAgICAgICAgICAgICAgICAgZGVsZXRlIGJhc2tldDJbcHJvZHVjdC5pZF1cbiAgICAgICAgICAgICAgICBuZXh0U3RhdGUgPSB7XG4gICAgICAgICAgICAgICAgICAgIC4uLnN0YXRlLFxuICAgICAgICAgICAgICAgICAgICBiYXNrZXQ6IGJhc2tldDJcbiAgICAgICAgICAgICAgICB9O1xuICAgICAgICAgICAgICAgIHNldEJhc2tldChiYXNrZXQyKVxuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAnbW91bnRfQmFza2V0JzpcbiAgICAgICAgICAgICAgICBnZXRDYXJkKCkudGhlbigocmVzcCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBjb25zdCBuZXdCYXNrZXQgPSB7fVxuICAgICAgICAgICAgICAgICAgICBpZiAocmVzcC5jb2RlID09IDIwMCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgZm9yIChjb25zdCBwcm9kIG9mIHJlc3AuZGF0YSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG5ld0Jhc2tldFtwcm9kLmlkXSA9IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgcHJvZHVjdDogcHJvZCxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY291bnQ6IHByb2QuY291bnQsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgc2V0QmFza2V0KG5ld0Jhc2tldClcbiAgICAgICAgICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4gc2F2ZSh7IC4uLnN0YXRlLCBiYXNrZXQ6IG5ld0Jhc2tldCB9KSwgMTUwKVxuICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ2FjdGlvbiBhcGkgZXJyIDc5NTQyMycpXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICB9KS5jYXRjaCgoZXJyKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKCdhY3Rpb24gYXBpIGVyciA2NzU2NzU0JylcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgY2FzZSAnb3Blbl9sb2dpbl9tb2RhbCc6XG4gICAgICAgICAgICAgICAgc2V0TW9kYWxTdGF0dXMoJ2xvZ2luJylcbiAgICAgICAgICAgICAgICBicmVhaztcblxuICAgICAgICAgICAgY2FzZSAnc2V0X21vZGFsJzpcbiAgICAgICAgICAgICAgICBzZXRNb2RhbFN0YXR1cyhhY3Rpb24ucGF5bG9hZClcbiAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgIGRlZmF1bHQ6XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ05vIGFjdGlvbiBmb3VuZCBmb3I6ICcgKyBhY3Rpb24udHlwZSwgeyBhY3Rpb24gfSlcbiAgICAgICAgICAgICAgICBuZXh0U3RhdGUgPSBzdGF0ZVxuXG4gICAgICAgIH1cbiAgICAgICAgbmV4dFN0YXRlLk1vZGFsU3RhdHVzID0gJydcbiAgICAgICAgLy9uZXh0U3RhdGUudXNlckluZm8gPSBuZXh0U3RhdGUudXNlcj8ubW9iaWxlXG4gICAgICAgIHNhdmUobmV4dFN0YXRlKVxuXG4gICAgfVxuXG4gICAgLyogKioqKioqKioqICBSZWR1Y2VyIGVuZCAgKioqKioqKioqICovXG5cblxuICAgIHJldHVybiAoXG4gICAgICAgIDxzdGF0ZUNvbnRleHQuUHJvdmlkZXIgdmFsdWU9e3sgc3RhdGUsIGRpc3BhdGNoIH19PlxuICAgICAgICAgICAge3Byb3BzLmNoaWxkcmVufVxuICAgICAgICA8L3N0YXRlQ29udGV4dC5Qcm92aWRlciA+XG4gICAgKVxufVxuXG5cbmV4cG9ydCB7XG4gICAgU3RhdGVQcm92aWRlcixcbiAgICBzZXRVc2VyR2xvYmFsXG59O1xuZXhwb3J0IGRlZmF1bHQgc3RhdGVDb250ZXh0XG5cbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./state/globalState.js\n");

/***/ })

})