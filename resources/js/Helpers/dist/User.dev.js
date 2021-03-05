"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _AppStorage = _interopRequireDefault(require("./AppStorage"));

var _Token = _interopRequireDefault(require("./Token"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var User =
/*#__PURE__*/
function () {
  function User() {
    _classCallCheck(this, User);
  }

  _createClass(User, [{
    key: "responseAfterLogin",
    value: function responseAfterLogin(response) {
      var token = response.data.access_token;
      var name = response.data.name;

      if (_Token["default"].isValid(token)) {
        _AppStorage["default"].store(token, name);
      }
    }
  }, {
    key: "hasToken",
    value: function hasToken() {
      var storeToken = localStorage.getItem('token');

      if (storeToken) {
        return _Token["default"].isValid(storeToken) ? true : false;
      }

      return false;
    }
  }, {
    key: "loggedIn",
    value: function loggedIn() {
      return this.hasToken();
    }
  }, {
    key: "logout",
    value: function logout() {
      _AppStorage["default"].clear();

      this.$router.push({
        name: '/'
      });
    }
  }, {
    key: "name",
    value: function name() {
      if (this.loggedIn()) {
        return localStorage.getItem('user');
      }
    }
  }, {
    key: "id",
    value: function id() {
      if (this.loggedIn) {
        var payload = _Token["default"].payload(localStorage.getItem('token'));

        return payload.sub;
      }

      return false;
    }
  }]);

  return User;
}();

var _default = User = new User();

exports["default"] = _default;