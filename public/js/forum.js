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

eval("// forum.js manages the board and newsfeed tabs by remving and adding classes that either show or hide the required tabs\ndocument.addEventListener(\"DOMContentLoaded\", function () {\n  var url = window.location.href;\n  var lastSegment = url.split(\"/\").pop();\n\n  if (lastSegment == \"board\") {\n    document.getElementById(\"news\").classList.add(\"toggle-out\");\n    document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  } else if (lastSegment == \"newsfeed\") {\n    document.getElementById(\"boards\").classList.add(\"toggle-out\");\n    document.getElementById(\"newsfeedTab\").classList.add(\"underline-tab\");\n  } else {\n    document.getElementById(\"news\").classList.add(\"toggle-out\");\n    document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  }\n});\ndocument.getElementById(\"boardTab\").addEventListener(\"click\", function () {\n  document.getElementById(\"news\").classList.add(\"toggle-out\");\n  document.getElementById(\"boardTab\").classList.add(\"underline-tab\");\n  document.getElementById(\"boards\").classList.remove(\"toggle-out\");\n  document.getElementById(\"newsfeedTab\").classList.remove(\"underline-tab\");\n});\ndocument.getElementById(\"newsfeedTab\").addEventListener(\"click\", function () {\n  document.getElementById(\"news\").classList.remove(\"toggle-out\");\n  document.getElementById(\"boardTab\").classList.remove(\"underline-tab\");\n  document.getElementById(\"boards\").classList.add(\"toggle-out\");\n  document.getElementById(\"newsfeedTab\").classList.add(\"underline-tab\");\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZm9ydW0uanM/YjAyOCJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJ1cmwiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsImhyZWYiLCJsYXN0U2VnbWVudCIsInNwbGl0IiwicG9wIiwiZ2V0RWxlbWVudEJ5SWQiLCJjbGFzc0xpc3QiLCJhZGQiLCJyZW1vdmUiXSwibWFwcGluZ3MiOiJBQUFBO0FBRUFBLFFBQVEsQ0FBQ0MsZ0JBQVQsQ0FBMEIsa0JBQTFCLEVBQThDLFlBQU07QUFDaEQsTUFBSUMsR0FBRyxHQUFHQyxNQUFNLENBQUNDLFFBQVAsQ0FBZ0JDLElBQTFCO0FBQ0EsTUFBSUMsV0FBVyxHQUFHSixHQUFHLENBQUNLLEtBQUosQ0FBVSxHQUFWLEVBQWVDLEdBQWYsRUFBbEI7O0FBRUEsTUFBR0YsV0FBVyxJQUFJLE9BQWxCLEVBQTBCO0FBQ3RCTixZQUFRLENBQUNTLGNBQVQsQ0FBd0IsTUFBeEIsRUFBZ0NDLFNBQWhDLENBQTBDQyxHQUExQyxDQUE4QyxZQUE5QztBQUNBWCxZQUFRLENBQUNTLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NDLFNBQXBDLENBQThDQyxHQUE5QyxDQUFrRCxlQUFsRDtBQUNILEdBSEQsTUFHTyxJQUFHTCxXQUFXLElBQUksVUFBbEIsRUFBNkI7QUFDaENOLFlBQVEsQ0FBQ1MsY0FBVCxDQUF3QixRQUF4QixFQUFrQ0MsU0FBbEMsQ0FBNENDLEdBQTVDLENBQWdELFlBQWhEO0FBQ0FYLFlBQVEsQ0FBQ1MsY0FBVCxDQUF3QixhQUF4QixFQUF1Q0MsU0FBdkMsQ0FBaURDLEdBQWpELENBQXFELGVBQXJEO0FBQ0gsR0FITSxNQUdBO0FBQ0hYLFlBQVEsQ0FBQ1MsY0FBVCxDQUF3QixNQUF4QixFQUFnQ0MsU0FBaEMsQ0FBMENDLEdBQTFDLENBQThDLFlBQTlDO0FBQ0FYLFlBQVEsQ0FBQ1MsY0FBVCxDQUF3QixVQUF4QixFQUFvQ0MsU0FBcEMsQ0FBOENDLEdBQTlDLENBQWtELGVBQWxEO0FBQ0g7QUFDSixDQWREO0FBZ0JBWCxRQUFRLENBQUNTLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NSLGdCQUFwQyxDQUFxRCxPQUFyRCxFQUE4RCxZQUFXO0FBQ3JFRCxVQUFRLENBQUNTLGNBQVQsQ0FBd0IsTUFBeEIsRUFBZ0NDLFNBQWhDLENBQTBDQyxHQUExQyxDQUE4QyxZQUE5QztBQUNBWCxVQUFRLENBQUNTLGNBQVQsQ0FBd0IsVUFBeEIsRUFBb0NDLFNBQXBDLENBQThDQyxHQUE5QyxDQUFrRCxlQUFsRDtBQUNBWCxVQUFRLENBQUNTLGNBQVQsQ0FBd0IsUUFBeEIsRUFBa0NDLFNBQWxDLENBQTRDRSxNQUE1QyxDQUFtRCxZQUFuRDtBQUNBWixVQUFRLENBQUNTLGNBQVQsQ0FBd0IsYUFBeEIsRUFBdUNDLFNBQXZDLENBQWlERSxNQUFqRCxDQUF3RCxlQUF4RDtBQUNELENBTEg7QUFPRVosUUFBUSxDQUFDUyxjQUFULENBQXdCLGFBQXhCLEVBQXVDUixnQkFBdkMsQ0FBd0QsT0FBeEQsRUFBaUUsWUFBVztBQUMxRUQsVUFBUSxDQUFDUyxjQUFULENBQXdCLE1BQXhCLEVBQWdDQyxTQUFoQyxDQUEwQ0UsTUFBMUMsQ0FBaUQsWUFBakQ7QUFDQVosVUFBUSxDQUFDUyxjQUFULENBQXdCLFVBQXhCLEVBQW9DQyxTQUFwQyxDQUE4Q0UsTUFBOUMsQ0FBcUQsZUFBckQ7QUFDQVosVUFBUSxDQUFDUyxjQUFULENBQXdCLFFBQXhCLEVBQWtDQyxTQUFsQyxDQUE0Q0MsR0FBNUMsQ0FBZ0QsWUFBaEQ7QUFDQVgsVUFBUSxDQUFDUyxjQUFULENBQXdCLGFBQXhCLEVBQXVDQyxTQUF2QyxDQUFpREMsR0FBakQsQ0FBcUQsZUFBckQ7QUFDRCxDQUxEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2ZvcnVtLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZm9ydW0uanMgbWFuYWdlcyB0aGUgYm9hcmQgYW5kIG5ld3NmZWVkIHRhYnMgYnkgcmVtdmluZyBhbmQgYWRkaW5nIGNsYXNzZXMgdGhhdCBlaXRoZXIgc2hvdyBvciBoaWRlIHRoZSByZXF1aXJlZCB0YWJzXHJcblxyXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCAoKSA9PiB7XHJcbiAgICBsZXQgdXJsID0gd2luZG93LmxvY2F0aW9uLmhyZWY7XHJcbiAgICBsZXQgbGFzdFNlZ21lbnQgPSB1cmwuc3BsaXQoXCIvXCIpLnBvcCgpO1xyXG5cclxuICAgIGlmKGxhc3RTZWdtZW50ID09IFwiYm9hcmRcIil7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzXCIpLmNsYXNzTGlzdC5hZGQoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRUYWJcIikuY2xhc3NMaXN0LmFkZChcInVuZGVybGluZS10YWJcIik7XHJcbiAgICB9IGVsc2UgaWYobGFzdFNlZ21lbnQgPT0gXCJuZXdzZmVlZFwiKXtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJvYXJkc1wiKS5jbGFzc0xpc3QuYWRkKFwidG9nZ2xlLW91dFwiKTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm5ld3NmZWVkVGFiXCIpLmNsYXNzTGlzdC5hZGQoXCJ1bmRlcmxpbmUtdGFiXCIpO1xyXG4gICAgfSBlbHNlIHtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcIm5ld3NcIikuY2xhc3NMaXN0LmFkZChcInRvZ2dsZS1vdXRcIik7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJib2FyZFRhYlwiKS5jbGFzc0xpc3QuYWRkKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICAgIH1cclxufSk7XHJcblxyXG5kb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJvYXJkVGFiXCIpLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbigpIHtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV3c1wiKS5jbGFzc0xpc3QuYWRkKFwidG9nZ2xlLW91dFwiKTtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRUYWJcIikuY2xhc3NMaXN0LmFkZChcInVuZGVybGluZS10YWJcIik7XHJcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImJvYXJkc1wiKS5jbGFzc0xpc3QucmVtb3ZlKFwidG9nZ2xlLW91dFwiKTtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV3c2ZlZWRUYWJcIikuY2xhc3NMaXN0LnJlbW92ZShcInVuZGVybGluZS10YWJcIik7XHJcbiAgfSk7XHJcblxyXG4gIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibmV3c2ZlZWRUYWJcIikuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uKCkge1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzXCIpLmNsYXNzTGlzdC5yZW1vdmUoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJib2FyZFRhYlwiKS5jbGFzc0xpc3QucmVtb3ZlKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYm9hcmRzXCIpLmNsYXNzTGlzdC5hZGQoXCJ0b2dnbGUtb3V0XCIpO1xyXG4gICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJuZXdzZmVlZFRhYlwiKS5jbGFzc0xpc3QuYWRkKFwidW5kZXJsaW5lLXRhYlwiKTtcclxuICB9KTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/forum.js\n");

/***/ }),

/***/ 7:
/*!*************************************!*\
  !*** multi ./resources/js/forum.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\YEAR 3\project\Cassandra\resources\js\forum.js */"./resources/js/forum.js");


/***/ })

/******/ });