/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/forum.js":
/*!*******************************!*\
  !*** ./resources/js/forum.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("document.addEventListener(\"DOMContentLoaded\", function () {\n  var url = window.location.href;\n  var lastSegment = url.split(\"/\").pop();\n\n  if (lastSegment == \"board\") {\n    document.getElementById(\"news\").classList.add(\"toggle-out\");\n    document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  } else if (lastSegment == \"newsfeed\") {\n    document.getElementById(\"boards\").classList.add(\"toggle-out\");\n    document.getElementById(\"newsfeedTab\").classList.add(\"underline-tab\");\n  } else {\n    document.getElementById(\"news\").classList.add(\"toggle-out\");\n    document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  }\n});\ndocument.getElementById(\"boardTab\").addEventListener(\"click\", function () {\n  document.getElementById(\"news\").classList.add(\"toggle-out\");\n  document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  document.getElementById(\"boards\").classList.remove(\"toggle-out\");\n  document.getElementById(\"newsfeedTab\").classList.remove(\"underline-tab\");\n});\ndocument.getElementById(\"newsfeedTab\").addEventListener(\"click\", function () {\n  document.getElementById(\"news\").classList.remove(\"toggle-out\");\n  document.getElementById(\"boardTab\").classList.remove(\"underline-tab\");\n  document.getElementById(\"boards\").classList.add(\"toggle-out\");\n  document.getElementById(\"newsfeedTab\").classList.add(\"underline-tab\");\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZm9ydW0uanM/YjAyOCJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ1cmwiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJsYXN0U2VnbWVudCIsInNwbGl0IiwicG9wIiwiZ2V0RWxlbWVudEJ5SWQiLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiXSwibWFwcGluZ3MiOiJBQUFBQSxRQUFRLENBQUNDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFNO0FBQ2hELE1BQUlDLEdBQUcsR0FBR0MsTUFBTSxDQUFDQyxRQUFQLENBQWdCQyxJQUExQjtBQUNBLE1BQUlDLFdBQVcsR0FBR0osR0FBRyxDQUFDSyxLQUFKLENBQVUsR0FBVixFQUFlQyxHQUFmLEVBQWxCOztBQUVBLE1BQUdGLFdBQVcsSUFBSSxPQUFsQixFQUEwQjtBQUN0Qk4sWUFBUSxDQUFDUyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxTQUFoQyxDQUEwQ0MsR0FBMUMsQ0FBOEMsWUFBOUM7QUFDQVgsWUFBUSxDQUFDUyxjQUFULENBQXdCLFVBQXhCLEVBQW9DQyxTQUFwQyxDQUE4Q0MsR0FBOUMsQ0FBa0QsZUFBbEQ7QUFDSCxHQUhELE1BR08sSUFBR0wsV0FBVyxJQUFJLFVBQWxCLEVBQTZCO0FBQ2hDTixZQUFRLENBQUNTLGNBQVQsQ0FBd0IsUUFBeEIsRUFBa0NDLFNBQWxDLENBQTRDQyxHQUE1QyxDQUFnRCxZQUFoRDtBQUNBWCxZQUFRLENBQUNTLGNBQVQsQ0FBd0IsYUFBeEIsRUFBdUNDLFNBQXZDLENBQWlEQyxHQUFqRCxDQUFxRCxlQUFyRDtBQUNILEdBSE0sTUFHQTtBQUNIWCxZQUFRLENBQUNTLGNBQVQsQ0FBd0IsTUFBeEIsRUFBZ0NDLFNBQWhDLENBQTBDQyxHQUExQyxDQUE4QyxZQUE5QztBQUNBWCxZQUFRLENBQUNTLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NDLFNBQXBDLENBQThDQyxHQUE5QyxDQUFrRCxlQUFsRDtBQUNIO0FBQ0osQ0FkRDtBQWdCQVgsUUFBUSxDQUFDUyxjQUFULENBQXdCLFVBQXhCLEVBQW9DUixnQkFBcEMsQ0FBcUQsT0FBckQsRUFBOEQsWUFBVztBQUNyRUQsVUFBUSxDQUFDUyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxTQUFoQyxDQUEwQ0MsR0FBMUMsQ0FBOEMsWUFBOUM7QUFDQVgsVUFBUSxDQUFDUyxjQUFULENBQXdCLFVBQXhCLEVBQW9DQyxTQUFwQyxDQUE4Q0MsR0FBOUMsQ0FBa0QsZUFBbEQ7QUFDQVgsVUFBUSxDQUFDUyxjQUFULENBQXdCLFFBQXhCLEVBQWtDQyxTQUFsQyxDQUE0Q0UsTUFBNUMsQ0FBbUQsWUFBbkQ7QUFDQVosVUFBUSxDQUFDUyxjQUFULENBQXdCLGFBQXhCLEVBQXVDQyxTQUF2QyxDQUFpREUsTUFBakQsQ0FBd0QsZUFBeEQ7QUFDRCxDQUxIO0FBT0VaLFFBQVEsQ0FBQ1MsY0FBVCxDQUF3QixhQUF4QixFQUF1Q1IsZ0JBQXZDLENBQXdELE9BQXhELEVBQWlFLFlBQVc7QUFDMUVELFVBQVEsQ0FBQ1MsY0FBVCxDQUF3QixNQUF4QixFQUFnQ0MsU0FBaEMsQ0FBMENFLE1BQTFDLENBQWlELFlBQWpEO0FBQ0FaLFVBQVEsQ0FBQ1MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ0MsU0FBcEMsQ0FBOENFLE1BQTlDLENBQXFELGVBQXJEO0FBQ0FaLFVBQVEsQ0FBQ1MsY0FBVCxDQUF3QixRQUF4QixFQUFrQ0MsU0FBbEMsQ0FBNENDLEdBQTVDLENBQWdELFlBQWhEO0FBQ0FYLFVBQVEsQ0FBQ1MsY0FBVCxDQUF3QixhQUF4QixFQUF1Q0MsU0FBdkMsQ0FBaURDLEdBQWpELENBQXFELGVBQXJEO0FBQ0QsQ0FMRCIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9mb3J1bS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsICgpID0+IHtcclxuICAgIGxldCB1cmwgPSB3aW5kb3cubG9jYXRpb24uaHJlZjtcclxuICAgIGxldCBsYXN0U2VnbWVudCA9IHVybC5zcGxpdChcIi9cIikucG9wKCk7XHJcblxyXG4gICAgaWYobGFzdFNlZ21lbnQgPT0gXCJib2FyZFwiKXtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm5ld3NcIikuY2xhc3NMaXN0LmFkZChcInRvZ2dsZS1vdXRcIik7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJib2FyZFRhYlwiKS5jbGFzc0xpc3QuYWRkKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICAgIH0gZWxzZSBpZihsYXN0U2VnbWVudCA9PSBcIm5ld3NmZWVkXCIpe1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRzXCIpLmNsYXNzTGlzdC5hZGQoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV3c2ZlZWRUYWJcIikuY2xhc3NMaXN0LmFkZChcInVuZGVybGluZS10YWJcIik7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV3c1wiKS5jbGFzc0xpc3QuYWRkKFwidG9nZ2xlLW91dFwiKTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJvYXJkVGFiXCIpLmNsYXNzTGlzdC5hZGQoXCJ1bmRlcmxpbmUtdGFiXCIpO1xyXG4gICAgfVxyXG59KTtcclxuXHJcbmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRUYWJcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uKCkge1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzXCIpLmNsYXNzTGlzdC5hZGQoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJib2FyZFRhYlwiKS5jbGFzc0xpc3QuYWRkKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRzXCIpLmNsYXNzTGlzdC5yZW1vdmUoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzZmVlZFRhYlwiKS5jbGFzc0xpc3QucmVtb3ZlKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICB9KTtcclxuXHJcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzZmVlZFRhYlwiKS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZnVuY3Rpb24oKSB7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm5ld3NcIikuY2xhc3NMaXN0LnJlbW92ZShcInRvZ2dsZS1vdXRcIik7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJvYXJkVGFiXCIpLmNsYXNzTGlzdC5yZW1vdmUoXCJ1bmRlcmxpbmUtdGFiXCIpO1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJib2FyZHNcIikuY2xhc3NMaXN0LmFkZChcInRvZ2dsZS1vdXRcIik7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm5ld3NmZWVkVGFiXCIpLmNsYXNzTGlzdC5hZGQoXCJ1bmRlcmxpbmUtdGFiXCIpO1xyXG4gIH0pO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/forum.js\n");

/***/ }),

/***/ 7:
/*!*************************************!*\
  !*** multi ./resources/js/forum.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Knut\WAF\MyLaravelProjects\Cassandra\resources\js\forum.js */"./resources/js/forum.js");


/***/ })

/******/ });