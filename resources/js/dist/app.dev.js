"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _vue = _interopRequireDefault(require("vue"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _User = _interopRequireDefault(require("./Helpers/User"));

var _routes = require("./routes");

var _vueSnotify = _interopRequireWildcard(require("vue-snotify"));

var _vueProgressbar = _interopRequireDefault(require("vue-progressbar"));

var _vform = require("vform");

var _laravelVueDatatable = _interopRequireDefault(require("laravel-vue-datatable"));

function _getRequireWildcardCache() { if (typeof WeakMap !== "function") return null; var cache = new WeakMap(); _getRequireWildcardCache = function _getRequireWildcardCache() { return cache; }; return cache; }

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

require('./bootstrap');

_vue["default"].use(_vueRouter["default"]); // Import User Class


window.User = _User["default"]; // Routes Import

var router = new _vueRouter["default"]({
  routes: _routes.routes,
  mode: 'history'
}); // Snotify Plugin Import Here

var SnotifyOptions = {
  toast: {
    position: _vueSnotify.SnotifyPosition.rightTop
  }
};

_vue["default"].use(_vueSnotify["default"], SnotifyOptions); // Progress Bar Plugin Import Here


var VueProgressBarOptions = {
  color: '#00C853',
  failedColor: '#D80000',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
};

_vue["default"].use(_vueProgressbar["default"], VueProgressBarOptions); // VForm Plugin Import Here


window.Form = _vform.Form;

_vue["default"].component(_vform.HasError.name, _vform.HasError);

_vue["default"].component(_vform.AlertError.name, _vform.AlertError); // Laravel Vue Datatable Import Here


_vue["default"].use(_laravelVueDatatable["default"]);

_vue["default"].component('navbar-component', require('./components/pages/partials/navbar.vue')["default"]);

_vue["default"].component('aside-component', require('./components/pages/partials/aside.vue')["default"]);

_vue["default"].component('footer-component', require('./components/pages/partials/footer.vue')["default"]);

_vue["default"].component('pagination-component', require('./components/pages/partials/pagination.vue')["default"]);

_vue["default"].component('loading-component', require('./components/pages/partials/LoadingComponent.vue')["default"]);

var app = new _vue["default"]({
  el: '#app',
  router: router
});