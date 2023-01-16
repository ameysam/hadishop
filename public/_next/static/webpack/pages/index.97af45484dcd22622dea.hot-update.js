webpackHotUpdate_N_E("pages/index",{

/***/ "./layouts/mainlayout.js":
/*!*******************************!*\
  !*** ./layouts/mainlayout.js ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return MainLayout; });\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _pages_footer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../pages/footer */ \"./pages/footer.js\");\n/* harmony import */ var next_link__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! next/link */ \"./node_modules/next/link.js\");\n/* harmony import */ var next_link__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(next_link__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react_toastify__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-toastify */ \"./node_modules/react-toastify/dist/react-toastify.esm.js\");\n/* harmony import */ var _state_globalState__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../state/globalState */ \"./state/globalState.js\");\n/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-bootstrap */ \"./node_modules/react-bootstrap/esm/index.js\");\nvar _jsxFileName = \"/var/www/html/meetings-introdunction/layouts/mainlayout.js\",\n    _s = $RefreshSig$();\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement;\n\n\n\n\n\n\n\nfunction MainLayout(_ref) {\n  _s();\n\n  var children = _ref.children;\n  var section = Object(react__WEBPACK_IMPORTED_MODULE_0__[\"useRef\"])(null);\n\n  var scrollToRef = function scrollToRef() {\n    var ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;\n\n    if (true) {\n      if (document.getElementById(ref)) {\n        window.scrollTo({\n          top: document.getElementById(ref).offsetTop,\n          behavior: 'smooth'\n        });\n      } else {\n        switch (ref) {\n          case 'features-section':\n            window.location = \"./\";\n            break;\n\n          case 'blog-section':\n            window.location = './contact_us';\n            break;\n\n          default:\n            window.location = './';\n            break;\n        }\n      } // window.scrollTo({top: document.getElementById(ref).offsetTop.top, behavior: 'smooth'});\n\n    }\n  };\n\n  function scrollToSection(section) {\n    window.scrollTo({\n      top: document.getElementById(section).offsetTop.top,\n      behavior: 'smooth'\n    }); // if (typeof window !== \"undefined\") {\n    //     window.scrollTo({top: document.getElementById(section).offsetTop.top, behavior: 'smooth'});\n    // } \n  }\n\n  var executeScroll = function executeScroll(section) {\n    return scrollToSection(section);\n  };\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__[\"useState\"])(false),\n      expanded = _useState[0],\n      setExpanded = _useState[1];\n\n  return __jsx(_state_globalState__WEBPACK_IMPORTED_MODULE_4__[\"StateProvider\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 48,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    id: \"app\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 49,\n      columnNumber: 13\n    }\n  }, __jsx(react_toastify__WEBPACK_IMPORTED_MODULE_3__[\"ToastContainer\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 51,\n      columnNumber: 17\n    }\n  }), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"./\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 53,\n      columnNumber: 17\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link site-logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 54,\n      columnNumber: 21\n    }\n  }, __jsx(\"img\", {\n    className: \"medium-up\",\n    src: \"/image/theme/logo.png\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 56,\n      columnNumber: 29\n    }\n  }), __jsx(\"img\", {\n    className: \"small-only\",\n    src: \"/image/theme/logo.png\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 57,\n      columnNumber: 29\n    }\n  }))), __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"], {\n    bg: \"light\",\n    expand: \"lg\",\n    className: \"navbar navbar-expand-lg navbar-light bg-white\",\n    expanded: expanded,\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 61,\n      columnNumber: 17\n    }\n  }, __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"].Toggle, {\n    \"aria-controls\": \"basic-navbar-nav\",\n    onClick: function onClick() {\n      return setExpanded(expanded ? false : \"expanded\");\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 63,\n      columnNumber: 21\n    }\n  }), __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"].Collapse, {\n    id: \"basic-navbar-nav\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 65,\n      columnNumber: 21\n    }\n  }, __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Nav\"], {\n    className: \"nav-menu\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 66,\n      columnNumber: 25\n    }\n  }, __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#home-section\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 67,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 68,\n      columnNumber: 33\n    }\n  }, \"\\u062E\\u0627\\u0646\\u0647\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#main-features\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 71,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 72,\n      columnNumber: 33\n    }\n  }, \"\\u0648\\u06CC\\u0698\\u06AF\\u06CC\\u200C\\u0647\\u0627\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#main-price-section\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 74,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 75,\n      columnNumber: 33\n    }\n  }, \"\\u0642\\u06CC\\u0645\\u062A\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"##blog-section\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 78,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 79,\n      columnNumber: 33\n    }\n  }, \"\\u0628\\u0644\\u0627\\u06AF\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"/contact_us\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 82,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 83,\n      columnNumber: 33\n    }\n  }, __jsx(\"span\", {\n    className: \"btn btn-info btn-sm \",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 85,\n      columnNumber: 41\n    }\n  }, \"\\u062F\\u0631\\u062E\\u0648\\u0627\\u0633\\u062A \\u062F\\u0645\\u0648\")))))), children, __jsx(_pages_footer__WEBPACK_IMPORTED_MODULE_1__[\"default\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 96,\n      columnNumber: 17\n    }\n  })));\n}\n\n_s(MainLayout, \"bir+PkRMmkL1TzOqk1Lnw5yC1L0=\");\n\n_c = MainLayout;\n\nvar _c;\n\n$RefreshReg$(_c, \"MainLayout\");\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9fTl9FLy4vbGF5b3V0cy9tYWlubGF5b3V0LmpzPzVjNGIiXSwibmFtZXMiOlsiTWFpbkxheW91dCIsImNoaWxkcmVuIiwic2VjdGlvbiIsInVzZVJlZiIsInNjcm9sbFRvUmVmIiwicmVmIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIndpbmRvdyIsInNjcm9sbFRvIiwidG9wIiwib2Zmc2V0VG9wIiwiYmVoYXZpb3IiLCJsb2NhdGlvbiIsInNjcm9sbFRvU2VjdGlvbiIsImV4ZWN1dGVTY3JvbGwiLCJ1c2VTdGF0ZSIsImV4cGFuZGVkIiwic2V0RXhwYW5kZWQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFJZSxTQUFTQSxVQUFULE9BQWtDO0FBQUE7O0FBQUEsTUFBWkMsUUFBWSxRQUFaQSxRQUFZO0FBQzdDLE1BQU1DLE9BQU8sR0FBR0Msb0RBQU0sQ0FBQyxJQUFELENBQXRCOztBQUVBLE1BQU1DLFdBQVcsR0FBRyxTQUFkQSxXQUFjLEdBQWE7QUFBQSxRQUFaQyxHQUFZLHVFQUFOLENBQU07O0FBQzdCLGNBQW1DO0FBQy9CLFVBQUlDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QkYsR0FBeEIsQ0FBSixFQUFrQztBQUM5QkcsY0FBTSxDQUFDQyxRQUFQLENBQWdCO0FBQUNDLGFBQUcsRUFBRUosUUFBUSxDQUFDQyxjQUFULENBQXdCRixHQUF4QixFQUE2Qk0sU0FBbkM7QUFBOENDLGtCQUFRLEVBQUU7QUFBeEQsU0FBaEI7QUFDSCxPQUZELE1BRU87QUFDSCxnQkFBUVAsR0FBUjtBQUNJLGVBQUssa0JBQUw7QUFDSUcsa0JBQU0sQ0FBQ0ssUUFBUCxHQUFrQixJQUFsQjtBQUNBOztBQUNKLGVBQUssY0FBTDtBQUNJTCxrQkFBTSxDQUFDSyxRQUFQLEdBQWtCLGNBQWxCO0FBQ0E7O0FBQ0o7QUFDSUwsa0JBQU0sQ0FBQ0ssUUFBUCxHQUFrQixJQUFsQjtBQUNB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QTtBQUFBO0FBQUE7QUFBQTtBQUFBLEtBQ0k7QUFBRyxXQUFPLEVBQUU7QUFBQSxhQUFNQSxXQUFXLENBQUMsS0FBRCxDQUFqQjtBQUFBLEtBQVo7QUFDSSxhQUFTLEVBQUMsVUFEZDtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLGdDQURKLENBUkosRUFZSSxNQUFDLGdEQUFEO0FBQU0sUUFBSSxFQUFDLGdCQUFYO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsS0FDSTtBQUFHLFdBQU8sRUFBRTtBQUFBLGFBQU1BLFdBQVcsQ0FBQyxLQUFELENBQWpCO0FBQUEsS0FBWjtBQUNJLGFBQVMsRUFBQyxVQURkO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsZ0NBREosQ0FaSixFQWdCSSxNQUFDLGdEQUFEO0FBQU0sUUFBSSxFQUFDLGFBQVg7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxLQUNJO0FBQUcsV0FBTyxFQUFFO0FBQUEsYUFBTUEsV0FBVyxDQUFDLEtBQUQsQ0FBakI7QUFBQSxLQUFaO0FBQ0ksYUFBUyxFQUFDLFVBRGQ7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxLQUVRO0FBQU0sYUFBUyxFQUFDLHNCQUFoQjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLHFFQUZSLENBREosQ0FoQkosQ0FESixDQUpKLENBWkosRUE2Q0tqQixRQTdDTCxFQStDSSxNQUFDLHFEQUFEO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsSUEvQ0osQ0FESixDQURKO0FBd0RIOztHQTNGdUJELFU7O0tBQUFBLFUiLCJmaWxlIjoiLi9sYXlvdXRzL21haW5sYXlvdXQuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgUmVhY3QsIHsgdXNlU3RhdGUsIHVzZVJlZiB9IGZyb20gXCJyZWFjdFwiO1xuaW1wb3J0IEZvb3RlciBmcm9tICcuLi9wYWdlcy9mb290ZXInXG5pbXBvcnQgTGluayBmcm9tICduZXh0L2xpbmsnXG5cbmltcG9ydCB7IFRvYXN0Q29udGFpbmVyIH0gZnJvbSAncmVhY3QtdG9hc3RpZnknO1xuaW1wb3J0IHsgU3RhdGVQcm92aWRlciB9IGZyb20gJy4uL3N0YXRlL2dsb2JhbFN0YXRlJ1xuaW1wb3J0IHsgTmF2YmFyIH0gZnJvbSAncmVhY3QtYm9vdHN0cmFwJ1xuaW1wb3J0IHsgTmF2IH0gZnJvbSAncmVhY3QtYm9vdHN0cmFwJ1xuXG5cblxuZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gTWFpbkxheW91dCh7IGNoaWxkcmVuIH0pIHtcbiAgICBjb25zdCBzZWN0aW9uID0gdXNlUmVmKG51bGwpO1xuICAgIFxuICAgIGNvbnN0IHNjcm9sbFRvUmVmID0gKHJlZiA9IDApID0+IHsgXG4gICAgICAgIGlmICh0eXBlb2Ygd2luZG93ICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgICAgICBpZiAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQocmVmKSkge1xuICAgICAgICAgICAgICAgIHdpbmRvdy5zY3JvbGxUbyh7dG9wOiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChyZWYpLm9mZnNldFRvcCwgYmVoYXZpb3I6ICdzbW9vdGgnfSk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIHN3aXRjaCAocmVmKSB7XG4gICAgICAgICAgICAgICAgICAgIGNhc2UgJ2ZlYXR1cmVzLXNlY3Rpb24nOlxuICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uID0gXCIuL1wiO1xuICAgICAgICAgICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICAgICAgICAgIGNhc2UgJ2Jsb2ctc2VjdGlvbic6XG4gICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24gPSAnLi9jb250YWN0X3VzJ1xuICAgICAgICAgICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICAgICAgICAgIGRlZmF1bHQ6XG4gICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24gPSAnLi8nXG4gICAgICAgICAgICAgICAgICAgICAgICBicmVhaztcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAvLyB3aW5kb3cuc2Nyb2xsVG8oe3RvcDogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQocmVmKS5vZmZzZXRUb3AudG9wLCBiZWhhdmlvcjogJ3Ntb290aCd9KTtcbiAgICAgICAgfVxuICAgIH1cbiAgICBcbiAgICBmdW5jdGlvbiBzY3JvbGxUb1NlY3Rpb24gKCBzZWN0aW9uICkge1xuICAgICAgICB3aW5kb3cuc2Nyb2xsVG8oe3RvcDogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoc2VjdGlvbikub2Zmc2V0VG9wLnRvcCwgYmVoYXZpb3I6ICdzbW9vdGgnfSk7XG4gICAgICAgIC8vIGlmICh0eXBlb2Ygd2luZG93ICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgIC8vICAgICB3aW5kb3cuc2Nyb2xsVG8oe3RvcDogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoc2VjdGlvbikub2Zmc2V0VG9wLnRvcCwgYmVoYXZpb3I6ICdzbW9vdGgnfSk7XG4gICAgICAgIC8vIH0gXG4gICAgfVxuXG4gICAgY29uc3QgZXhlY3V0ZVNjcm9sbCA9ICggc2VjdGlvbiApID0+IHNjcm9sbFRvU2VjdGlvbiggc2VjdGlvbiApXG5cbiAgICBjb25zdCBbZXhwYW5kZWQsIHNldEV4cGFuZGVkXSA9IHVzZVN0YXRlKGZhbHNlKTtcblxuICAgIHJldHVybiAoXG4gICAgICAgIDxTdGF0ZVByb3ZpZGVyPlxuICAgICAgICAgICAgPGRpdiBpZD1cImFwcFwiPlxuXG4gICAgICAgICAgICAgICAgPFRvYXN0Q29udGFpbmVyIC8+XG5cbiAgICAgICAgICAgICAgICA8TGluayBocmVmPVwiLi9cIj5cbiAgICAgICAgICAgICAgICAgICAgPGEgb25DbGljaz17KCkgPT4gc2V0RXhwYW5kZWQoZmFsc2UpfVxuICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lPVwibmF2LWxpbmsgc2l0ZS1sb2dvXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGltZyBjbGFzc05hbWU9XCJtZWRpdW0tdXBcIiBzcmM9XCIvaW1hZ2UvdGhlbWUvbG9nby5wbmdcIiAvPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpbWcgY2xhc3NOYW1lPVwic21hbGwtb25seVwiIHNyYz1cIi9pbWFnZS90aGVtZS9sb2dvLnBuZ1wiIC8+XG4gICAgICAgICAgICAgICAgICAgIDwvYT5cbiAgICAgICAgICAgICAgICA8L0xpbms+XG5cbiAgICAgICAgICAgICAgICA8TmF2YmFyIGJnPVwibGlnaHRcIiBleHBhbmQ9XCJsZ1wiIGNsYXNzTmFtZT1cIm5hdmJhciBuYXZiYXItZXhwYW5kLWxnIG5hdmJhci1saWdodCBiZy13aGl0ZVwiXG4gICAgICAgICAgICAgICAgICAgIGV4cGFuZGVkPXtleHBhbmRlZH0+XG4gICAgICAgICAgICAgICAgICAgIDxOYXZiYXIuVG9nZ2xlIGFyaWEtY29udHJvbHM9XCJiYXNpYy1uYXZiYXItbmF2XCJcbiAgICAgICAgICAgICAgICAgICAgICAgIG9uQ2xpY2s9eygpID0+IHNldEV4cGFuZGVkKGV4cGFuZGVkID8gZmFsc2UgOiBcImV4cGFuZGVkXCIpfSAvPlxuICAgICAgICAgICAgICAgICAgICA8TmF2YmFyLkNvbGxhcHNlIGlkPVwiYmFzaWMtbmF2YmFyLW5hdlwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgPE5hdiBjbGFzc05hbWU9J25hdi1tZW51Jz5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8TGluayBocmVmPVwiI2hvbWUtc2VjdGlvblwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YSBvbkNsaWNrPXsoKSA9PiBzZXRFeHBhbmRlZChmYWxzZSl9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU9XCJuYXYtbGlua1wiPtiu2KfZhtmHPC9hPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvTGluaz5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8TGluayBocmVmPVwiI21haW4tZmVhdHVyZXNcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgY2xhc3NOYW1lPVwibmF2LWxpbmtcIj7ZiNuM2pjar9uMJnp3bmo72YfYpzwvYT5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L0xpbms+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPExpbmsgaHJlZj1cIiNtYWluLXByaWNlLXNlY3Rpb25cIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgb25DbGljaz17KCkgPT4gc2V0RXhwYW5kZWQoZmFsc2UpfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lPVwibmF2LWxpbmtcIj7ZgtuM2YXYqjwvYT5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L0xpbms+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPExpbmsgaHJlZj1cIiMjYmxvZy1zZWN0aW9uXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIG9uQ2xpY2s9eygpID0+IHNldEV4cGFuZGVkKGZhbHNlKX1cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzTmFtZT1cIm5hdi1saW5rXCI+2KjZhNin2q88L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxMaW5rIGhyZWY9XCIvY29udGFjdF91c1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YSBvbkNsaWNrPXsoKSA9PiBzZXRFeHBhbmRlZChmYWxzZSl9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU9XCJuYXYtbGlua1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzTmFtZT1cImJ0biBidG4taW5mbyBidG4tc20gXCI+2K/Ysdiu2YjYp9iz2Kog2K/ZhdmIPC9zcGFuPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9OYXY+XG4gICAgICAgICAgICAgICAgICAgIDwvTmF2YmFyLkNvbGxhcHNlPlxuXG4gICAgICAgICAgICAgICAgPC9OYXZiYXI+XG5cblxuICAgICAgICAgICAgICAgIHtjaGlsZHJlbn1cblxuICAgICAgICAgICAgICAgIDxGb290ZXIgLz5cblxuICAgICAgICAgICAgPC9kaXY+XG5cbiAgICAgICAgPC9TdGF0ZVByb3ZpZGVyPlxuXG4gICAgKVxufVxuXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./layouts/mainlayout.js\n");

/***/ })

})