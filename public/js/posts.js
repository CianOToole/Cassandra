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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/posts.js":
/*!*******************************!*\
  !*** ./resources/js/posts.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// quote passes the id on the clicked button (determined by the post id) \n// each post share in their class the id nmb which we fetch to get the textContent of the p element \n// then, we fetch the text area to prompt the textContent in it to quote \nfunction quote(id) {\n  var posts_cnt = document.getElementsByClassName(id);\n  var text = posts_cnt[0].textContent;\n  console.log(text);\n  var post_txt = document.getElementById('post_txt');\n  post_txt.innerHTML += text;\n}\n\nfunction editPost(id, action) {\n  var posts_cnt = document.getElementsByClassName(id);\n  var text = posts_cnt[0].textContent;\n  var post_txt = document.getElementById('post_txt');\n  post_txt.innerHTML += text;\n  $(\"#form_post_put\").attr(\"value\", \"PUT\");\n  console.log(action);\n  $(\"#form_post\").attr(\"action\", action);\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcG9zdHMuanM/MGE1NiJdLCJuYW1lcyI6WyJxdW90ZSIsImlkIiwicG9zdHNfY250IiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwidGV4dCIsInRleHRDb250ZW50IiwiY29uc29sZSIsImxvZyIsInBvc3RfdHh0IiwiZ2V0RWxlbWVudEJ5SWQiLCJpbm5lckhUTUwiLCJlZGl0UG9zdCIsImFjdGlvbiIsIiQiLCJhdHRyIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFFSSxTQUFTQSxLQUFULENBQWVDLEVBQWYsRUFBa0I7QUFDZCxNQUFJQyxTQUFTLEdBQUdDLFFBQVEsQ0FBQ0Msc0JBQVQsQ0FBZ0NILEVBQWhDLENBQWhCO0FBQ0EsTUFBSUksSUFBSSxHQUFHSCxTQUFTLENBQUMsQ0FBRCxDQUFULENBQWFJLFdBQXhCO0FBQ0FDLFNBQU8sQ0FBQ0MsR0FBUixDQUFZSCxJQUFaO0FBQ0EsTUFBSUksUUFBUSxHQUFHTixRQUFRLENBQUNPLGNBQVQsQ0FBd0IsVUFBeEIsQ0FBZjtBQUNBRCxVQUFRLENBQUNFLFNBQVQsSUFBc0JOLElBQXRCO0FBQ0g7O0FBRUQsU0FBU08sUUFBVCxDQUFrQlgsRUFBbEIsRUFBc0JZLE1BQXRCLEVBQTZCO0FBQ3pCLE1BQUlYLFNBQVMsR0FBR0MsUUFBUSxDQUFDQyxzQkFBVCxDQUFnQ0gsRUFBaEMsQ0FBaEI7QUFDQSxNQUFJSSxJQUFJLEdBQUdILFNBQVMsQ0FBQyxDQUFELENBQVQsQ0FBYUksV0FBeEI7QUFDQSxNQUFJRyxRQUFRLEdBQUdOLFFBQVEsQ0FBQ08sY0FBVCxDQUF3QixVQUF4QixDQUFmO0FBQ0FELFVBQVEsQ0FBQ0UsU0FBVCxJQUFzQk4sSUFBdEI7QUFFQVMsR0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0JDLElBQXBCLENBQXlCLE9BQXpCLEVBQWtDLEtBQWxDO0FBRUFSLFNBQU8sQ0FBQ0MsR0FBUixDQUFZSyxNQUFaO0FBRUFDLEdBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JDLElBQWhCLENBQXFCLFFBQXJCLEVBQStCRixNQUEvQjtBQUVDIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3Bvc3RzLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gcXVvdGUgcGFzc2VzIHRoZSBpZCBvbiB0aGUgY2xpY2tlZCBidXR0b24gKGRldGVybWluZWQgYnkgdGhlIHBvc3QgaWQpIFxyXG4vLyBlYWNoIHBvc3Qgc2hhcmUgaW4gdGhlaXIgY2xhc3MgdGhlIGlkIG5tYiB3aGljaCB3ZSBmZXRjaCB0byBnZXQgdGhlIHRleHRDb250ZW50IG9mIHRoZSBwIGVsZW1lbnQgXHJcbi8vIHRoZW4sIHdlIGZldGNoIHRoZSB0ZXh0IGFyZWEgdG8gcHJvbXB0IHRoZSB0ZXh0Q29udGVudCBpbiBpdCB0byBxdW90ZSBcclxuXHJcbiAgICBmdW5jdGlvbiBxdW90ZShpZCl7XHJcbiAgICAgICAgdmFyIHBvc3RzX2NudCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoaWQpO1xyXG4gICAgICAgIHZhciB0ZXh0ID0gcG9zdHNfY250WzBdLnRleHRDb250ZW50OyAgICAgICAgXHJcbiAgICAgICAgY29uc29sZS5sb2codGV4dCk7XHJcbiAgICAgICAgdmFyIHBvc3RfdHh0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3RfdHh0Jyk7XHJcbiAgICAgICAgcG9zdF90eHQuaW5uZXJIVE1MICs9IHRleHQ7XHJcbiAgICB9XHJcblxyXG4gICAgZnVuY3Rpb24gZWRpdFBvc3QoaWQsIGFjdGlvbil7XHJcbiAgICAgICAgdmFyIHBvc3RzX2NudCA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoaWQpO1xyXG4gICAgICAgIHZhciB0ZXh0ID0gcG9zdHNfY250WzBdLnRleHRDb250ZW50OyAgICAgIFxyXG4gICAgICAgIHZhciBwb3N0X3R4dCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwb3N0X3R4dCcpO1xyXG4gICAgICAgIHBvc3RfdHh0LmlubmVySFRNTCArPSB0ZXh0O1xyXG5cclxuICAgICAgICAkKFwiI2Zvcm1fcG9zdF9wdXRcIikuYXR0cihcInZhbHVlXCIsIFwiUFVUXCIpO1xyXG4gICAgICAgIFxyXG4gICAgICAgIGNvbnNvbGUubG9nKGFjdGlvbik7XHJcbiAgICAgICAgXHJcbiAgICAgICAgJChcIiNmb3JtX3Bvc3RcIikuYXR0cihcImFjdGlvblwiLCBhY3Rpb24pO1xyXG5cclxuICAgICAgICB9Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/posts.js\n");

/***/ }),

/***/ 6:
/*!*************************************!*\
  !*** multi ./resources/js/posts.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Knut\WAF\MyLaravelProjects\Cassandra\resources\js\posts.js */"./resources/js/posts.js");


/***/ })

/******/ });