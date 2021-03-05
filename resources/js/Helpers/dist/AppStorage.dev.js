"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var AppStorage =
/*#__PURE__*/
function () {
  function AppStorage() {
    _classCallCheck(this, AppStorage);
  }

  _createClass(AppStorage, [{
    key: "storeToken",
    value: function storeToken(token) {
      localStorage.setItem('token', token);
    }
  }, {
    key: "storeUser",
    value: function storeUser(user) {
      localStorage.setItem('user', user);
    }
  }, {
    key: "store",
    value: function store(token, user) {
      this.storeToken(token);
      this.storeUser(user);
    }
  }, {
    key: "clear",
    value: function clear() {
      localStorage.removeItem('token', token);
      localStorage.removeItem('user', user);
    }
  }, {
    key: "getToken",
    value: function getToken() {
      localStorage.getToken('token');
    }
  }, {
    key: "getUser",
    value: function getUser() {
      localStorage.getToken('user');
    }
  }]);

  return AppStorage;
}();

var _default = AppStorage = new AppStorage();

exports["default"] = _default;