"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Token =
/*#__PURE__*/
function () {
  function Token() {
    _classCallCheck(this, Token);
  }

  _createClass(Token, [{
    key: "isValid",
    value: function isValid(token) {
      var payload = this.payload(token);

      if (payload) {
        return payload.iss == "http://inventory.org/api/auth/login" || "http://inventory.org/api/auth/register" ? true : false;
      }

      return false;
    }
  }, {
    key: "payload",
    value: function payload(token) {
      var payload = token.split('.')[1];
      return this.decode(payload);
    }
  }, {
    key: "decode",
    value: function decode(payload) {
      return JSON.parse(atob(payload));
    }
  }]);

  return Token;
}();

var _default = Token = new Token();

exports["default"] = _default;