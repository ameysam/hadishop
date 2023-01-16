webpackHotUpdate_N_E("pages/index",{

/***/ "./layouts/mainlayout.js":
/*!*******************************!*\
  !*** ./layouts/mainlayout.js ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return MainLayout; });\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _pages_footer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../pages/footer */ \"./pages/footer.js\");\n/* harmony import */ var next_link__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! next/link */ \"./node_modules/next/link.js\");\n/* harmony import */ var next_link__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(next_link__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react_toastify__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-toastify */ \"./node_modules/react-toastify/dist/react-toastify.esm.js\");\n/* harmony import */ var _state_globalState__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../state/globalState */ \"./state/globalState.js\");\n/* harmony import */ var react_bootstrap__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-bootstrap */ \"./node_modules/react-bootstrap/esm/index.js\");\nvar _jsxFileName = \"/var/www/html/meetings-introdunction/layouts/mainlayout.js\",\n    _s = $RefreshSig$();\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement;\n\n\n\n\n\n\n\nfunction MainLayout(_ref) {\n  _s();\n\n  var children = _ref.children;\n  var section = Object(react__WEBPACK_IMPORTED_MODULE_0__[\"useRef\"])(null);\n\n  var scrollToRef = function scrollToRef() {\n    var ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;\n\n    if (true) {\n      if (document.getElementById(ref)) {\n        window.scrollTo({\n          top: document.getElementById(ref).offsetTop,\n          behavior: 'smooth'\n        });\n      } else {\n        switch (ref) {\n          case 'features-section':\n            window.location = \"./\";\n            break;\n\n          case 'blog-section':\n            window.location = './contact_us';\n            break;\n\n          default:\n            window.location = './';\n            break;\n        }\n      } // window.scrollTo({top: document.getElementById(ref).offsetTop.top, behavior: 'smooth'});\n\n    }\n  };\n\n  function scrollToSection(section) {\n    window.scrollTo({\n      top: document.getElementById(section).offsetTop.top,\n      behavior: 'smooth'\n    }); // if (typeof window !== \"undefined\") {\n    //     window.scrollTo({top: document.getElementById(section).offsetTop.top, behavior: 'smooth'});\n    // } \n  }\n\n  var executeScroll = function executeScroll(section) {\n    return scrollToSection(section);\n  };\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_0__[\"useState\"])(false),\n      expanded = _useState[0],\n      setExpanded = _useState[1];\n\n  return __jsx(_state_globalState__WEBPACK_IMPORTED_MODULE_4__[\"StateProvider\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 48,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    id: \"app\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 49,\n      columnNumber: 13\n    }\n  }, __jsx(react_toastify__WEBPACK_IMPORTED_MODULE_3__[\"ToastContainer\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 51,\n      columnNumber: 17\n    }\n  }), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"./\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 53,\n      columnNumber: 17\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link site-logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 54,\n      columnNumber: 21\n    }\n  }, __jsx(\"img\", {\n    className: \"medium-up\",\n    src: \"/image/theme/logo.png\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 56,\n      columnNumber: 29\n    }\n  }), __jsx(\"img\", {\n    className: \"small-only\",\n    src: \"/image/theme/logo.png\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 57,\n      columnNumber: 29\n    }\n  }))), __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"], {\n    bg: \"light\",\n    expand: \"lg\",\n    className: \"navbar navbar-expand-lg navbar-light bg-white\",\n    expanded: expanded,\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 61,\n      columnNumber: 17\n    }\n  }, __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"].Toggle, {\n    \"aria-controls\": \"basic-navbar-nav\",\n    onClick: function onClick() {\n      return setExpanded(expanded ? false : \"expanded\");\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 63,\n      columnNumber: 21\n    }\n  }), __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Navbar\"].Collapse, {\n    id: \"basic-navbar-nav\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 65,\n      columnNumber: 21\n    }\n  }, __jsx(react_bootstrap__WEBPACK_IMPORTED_MODULE_5__[\"Nav\"], {\n    className: \"nav-menu\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 66,\n      columnNumber: 25\n    }\n  }, __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"/\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 67,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 68,\n      columnNumber: 33\n    }\n  }, \"\\u062E\\u0627\\u0646\\u0647\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#main-features\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 70,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 71,\n      columnNumber: 33\n    }\n  }, \"\\u0648\\u06CC\\u0698\\u06AF\\u06CC\\u200C\\u0647\\u0627\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#main-price-section\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 73,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 74,\n      columnNumber: 33\n    }\n  }, \"\\u0642\\u06CC\\u0645\\u062A\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"#blog-section\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 77,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 78,\n      columnNumber: 33\n    }\n  }, \"\\u0628\\u0644\\u0627\\u06AF\")), __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"/contact_us\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 81,\n      columnNumber: 29\n    }\n  }, __jsx(\"a\", {\n    onClick: function onClick() {\n      return setExpanded(false);\n    },\n    className: \"nav-link\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 82,\n      columnNumber: 33\n    }\n  }, __jsx(\"span\", {\n    className: \"btn btn-info btn-sm \",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 84,\n      columnNumber: 41\n    }\n  }, \"\\u062F\\u0631\\u062E\\u0648\\u0627\\u0633\\u062A \\u062F\\u0645\\u0648\"))))), __jsx(\"div\", {\n    className: \"login-register text-left ml-2\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 90,\n      columnNumber: 21\n    }\n  }, __jsx(next_link__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    href: \"\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 91,\n      columnNumber: 25\n    }\n  }, __jsx(\"a\", {\n    className: \"btn btn-success\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 92,\n      columnNumber: 29\n    }\n  }, \"\\u0648\\u0631\\u0648\\u062F\")))), children, __jsx(_pages_footer__WEBPACK_IMPORTED_MODULE_1__[\"default\"], {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 101,\n      columnNumber: 17\n    }\n  })));\n}\n\n_s(MainLayout, \"bir+PkRMmkL1TzOqk1Lnw5yC1L0=\");\n\n_c = MainLayout;\n\nvar _c;\n\n$RefreshReg$(_c, \"MainLayout\");\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9fTl9FLy4vbGF5b3V0cy9tYWlubGF5b3V0LmpzPzVjNGIiXSwibmFtZXMiOlsiTWFpbkxheW91dCIsImNoaWxkcmVuIiwic2VjdGlvbiIsInVzZVJlZiIsInNjcm9sbFRvUmVmIiwicmVmIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIndpbmRvdyIsInNjcm9sbFRvIiwidG9wIiwib2Zmc2V0VG9wIiwiYmVoYXZpb3IiLCJsb2NhdGlvbiIsInNjcm9sbFRvU2VjdGlvbiIsImV4ZWN1dGVTY3JvbGwiLCJ1c2VTdGF0ZSIsImV4cGFuZGVkIiwic2V0RXhwYW5kZWQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFJZSxTQUFTQSxVQUFULE9BQWtDO0FBQUE7O0FBQUEsTUFBWkMsUUFBWSxRQUFaQSxRQUFZO0FBQzdDLE1BQU1DLE9BQU8sR0FBR0Msb0RBQU0sQ0FBQyxJQUFELENBQXRCOztBQUVBLE1BQU1DLFdBQVcsR0FBRyxTQUFkQSxXQUFjLEdBQWE7QUFBQSxRQUFaQyxHQUFZLHVFQUFOLENBQU07O0FBQzdCLGNBQW1DO0FBQy9CLFVBQUlDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QkYsR0FBeEIsQ0FBSixFQUFrQztBQUM5QkcsY0FBTSxDQUFDQyxRQUFQLENBQWdCO0FBQUNDLGFBQUcsRUFBRUosUUFBUSxDQUFDQyxjQUFULENBQXdCRixHQUF4QixFQUE2Qk0sU0FBbkM7QUFBOENDLGtCQUFRLEVBQUU7QUFBeEQsU0FBaEI7QUFDSCxPQUZELE1BRU87QUFDSCxnQkFBUVAsR0FBUjtBQUNJLGVBQUssa0JBQUw7QUFDSUcsa0JBQU0sQ0FBQ0ssUUFBUCxHQUFrQixJQUFsQjtBQUNBOztBQUNKLGVBQUssY0FBTDtBQUNJTCxrQkFBTSxDQUFDSyxRQUFQLEdBQWtCLGNBQWxCO0FBQ0E7O0FBQ0o7QUFDSUwsa0JBQU0sQ0FBQ0ssUUFBUCxHQUFrQixJQUFsQjtBQUNB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Ii4vbGF5b3V0cy9tYWlubGF5b3V0LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFJlYWN0LCB7IHVzZVN0YXRlLCB1c2VSZWYgfSBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCBGb290ZXIgZnJvbSAnLi4vcGFnZXMvZm9vdGVyJ1xuaW1wb3J0IExpbmsgZnJvbSAnbmV4dC9saW5rJ1xuXG5pbXBvcnQgeyBUb2FzdENvbnRhaW5lciB9IGZyb20gJ3JlYWN0LXRvYXN0aWZ5JztcbmltcG9ydCB7IFN0YXRlUHJvdmlkZXIgfSBmcm9tICcuLi9zdGF0ZS9nbG9iYWxTdGF0ZSdcbmltcG9ydCB7IE5hdmJhciB9IGZyb20gJ3JlYWN0LWJvb3RzdHJhcCdcbmltcG9ydCB7IE5hdiB9IGZyb20gJ3JlYWN0LWJvb3RzdHJhcCdcblxuXG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uIE1haW5MYXlvdXQoeyBjaGlsZHJlbiB9KSB7XG4gICAgY29uc3Qgc2VjdGlvbiA9IHVzZVJlZihudWxsKTtcbiAgICBcbiAgICBjb25zdCBzY3JvbGxUb1JlZiA9IChyZWYgPSAwKSA9PiB7IFxuICAgICAgICBpZiAodHlwZW9mIHdpbmRvdyAhPT0gXCJ1bmRlZmluZWRcIikge1xuICAgICAgICAgICAgaWYgKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKHJlZikpIHtcbiAgICAgICAgICAgICAgICB3aW5kb3cuc2Nyb2xsVG8oe3RvcDogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQocmVmKS5vZmZzZXRUb3AsIGJlaGF2aW9yOiAnc21vb3RoJ30pO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBzd2l0Y2ggKHJlZikge1xuICAgICAgICAgICAgICAgICAgICBjYXNlICdmZWF0dXJlcy1zZWN0aW9uJzpcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9IFwiLi9cIjtcbiAgICAgICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgICAgICBjYXNlICdibG9nLXNlY3Rpb24nOlxuICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uID0gJy4vY29udGFjdF91cydcbiAgICAgICAgICAgICAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgICAgICAgICAgICBkZWZhdWx0OlxuICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uID0gJy4vJ1xuICAgICAgICAgICAgICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgLy8gd2luZG93LnNjcm9sbFRvKHt0b3A6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKHJlZikub2Zmc2V0VG9wLnRvcCwgYmVoYXZpb3I6ICdzbW9vdGgnfSk7XG4gICAgICAgIH1cbiAgICB9XG4gICAgXG4gICAgZnVuY3Rpb24gc2Nyb2xsVG9TZWN0aW9uICggc2VjdGlvbiApIHtcbiAgICAgICAgd2luZG93LnNjcm9sbFRvKHt0b3A6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKHNlY3Rpb24pLm9mZnNldFRvcC50b3AsIGJlaGF2aW9yOiAnc21vb3RoJ30pO1xuICAgICAgICAvLyBpZiAodHlwZW9mIHdpbmRvdyAhPT0gXCJ1bmRlZmluZWRcIikge1xuICAgICAgICAvLyAgICAgd2luZG93LnNjcm9sbFRvKHt0b3A6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKHNlY3Rpb24pLm9mZnNldFRvcC50b3AsIGJlaGF2aW9yOiAnc21vb3RoJ30pO1xuICAgICAgICAvLyB9IFxuICAgIH1cblxuICAgIGNvbnN0IGV4ZWN1dGVTY3JvbGwgPSAoIHNlY3Rpb24gKSA9PiBzY3JvbGxUb1NlY3Rpb24oIHNlY3Rpb24gKVxuXG4gICAgY29uc3QgW2V4cGFuZGVkLCBzZXRFeHBhbmRlZF0gPSB1c2VTdGF0ZShmYWxzZSk7XG5cbiAgICByZXR1cm4gKFxuICAgICAgICA8U3RhdGVQcm92aWRlcj5cbiAgICAgICAgICAgIDxkaXYgaWQ9XCJhcHBcIj5cblxuICAgICAgICAgICAgICAgIDxUb2FzdENvbnRhaW5lciAvPlxuXG4gICAgICAgICAgICAgICAgPExpbmsgaHJlZj1cIi4vXCI+XG4gICAgICAgICAgICAgICAgICAgIDxhIG9uQ2xpY2s9eygpID0+IHNldEV4cGFuZGVkKGZhbHNlKX1cbiAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzTmFtZT1cIm5hdi1saW5rIHNpdGUtbG9nb1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpbWcgY2xhc3NOYW1lPVwibWVkaXVtLXVwXCIgc3JjPVwiL2ltYWdlL3RoZW1lL2xvZ28ucG5nXCIgLz5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW1nIGNsYXNzTmFtZT1cInNtYWxsLW9ubHlcIiBzcmM9XCIvaW1hZ2UvdGhlbWUvbG9nby5wbmdcIiAvPlxuICAgICAgICAgICAgICAgICAgICA8L2E+XG4gICAgICAgICAgICAgICAgPC9MaW5rPlxuXG4gICAgICAgICAgICAgICAgPE5hdmJhciBiZz1cImxpZ2h0XCIgZXhwYW5kPVwibGdcIiBjbGFzc05hbWU9XCJuYXZiYXIgbmF2YmFyLWV4cGFuZC1sZyBuYXZiYXItbGlnaHQgYmctd2hpdGVcIlxuICAgICAgICAgICAgICAgICAgICBleHBhbmRlZD17ZXhwYW5kZWR9PlxuICAgICAgICAgICAgICAgICAgICA8TmF2YmFyLlRvZ2dsZSBhcmlhLWNvbnRyb2xzPVwiYmFzaWMtbmF2YmFyLW5hdlwiXG4gICAgICAgICAgICAgICAgICAgICAgICBvbkNsaWNrPXsoKSA9PiBzZXRFeHBhbmRlZChleHBhbmRlZCA/IGZhbHNlIDogXCJleHBhbmRlZFwiKX0gLz5cbiAgICAgICAgICAgICAgICAgICAgPE5hdmJhci5Db2xsYXBzZSBpZD1cImJhc2ljLW5hdmJhci1uYXZcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxOYXYgY2xhc3NOYW1lPSduYXYtbWVudSc+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPExpbmsgaHJlZj1cIi9cIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGEgY2xhc3NOYW1lPVwibmF2LWxpbmtcIj7Yrtin2YbZhzwvYT5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L0xpbms+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPExpbmsgaHJlZj1cIiNtYWluLWZlYXR1cmVzXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIGNsYXNzTmFtZT1cIm5hdi1saW5rXCI+2YjbjNqY2q/bjCZ6d25qO9mH2Kc8L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxMaW5rIGhyZWY9XCIjbWFpbi1wcmljZS1zZWN0aW9uXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIG9uQ2xpY2s9eygpID0+IHNldEV4cGFuZGVkKGZhbHNlKX1cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzTmFtZT1cIm5hdi1saW5rXCI+2YLbjNmF2Ko8L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxMaW5rIGhyZWY9XCIjYmxvZy1zZWN0aW9uXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIG9uQ2xpY2s9eygpID0+IHNldEV4cGFuZGVkKGZhbHNlKX1cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzTmFtZT1cIm5hdi1saW5rXCI+2KjZhNin2q88L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxMaW5rIGhyZWY9XCIvY29udGFjdF91c1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YSBvbkNsaWNrPXsoKSA9PiBzZXRFeHBhbmRlZChmYWxzZSl9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjbGFzc05hbWU9XCJuYXYtbGlua1wiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzTmFtZT1cImJ0biBidG4taW5mbyBidG4tc20gXCI+2K/Ysdiu2YjYp9iz2Kog2K/ZhdmIPC9zcGFuPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9MaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9OYXY+XG4gICAgICAgICAgICAgICAgICAgIDwvTmF2YmFyLkNvbGxhcHNlPlxuXG4gICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9naW4tcmVnaXN0ZXIgdGV4dC1sZWZ0IG1sLTJcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxMaW5rIGhyZWY9XCJcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YSBjbGFzc05hbWU9XCJidG4gYnRuLXN1Y2Nlc3NcIj7ZiNix2YjYrzwvYT5cbiAgICAgICAgICAgICAgICAgICAgICAgIDwvTGluaz5cbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgPC9OYXZiYXI+XG5cblxuXG4gICAgICAgICAgICAgICAge2NoaWxkcmVufVxuXG4gICAgICAgICAgICAgICAgPEZvb3RlciAvPlxuXG4gICAgICAgICAgICA8L2Rpdj5cblxuICAgICAgICA8L1N0YXRlUHJvdmlkZXI+XG5cbiAgICApXG59XG5cbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./layouts/mainlayout.js\n");

/***/ })

})