(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/Chat"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Chat.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Chat.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// https://pusher.com/tutorials/chat-laravel
var vm;

function chatScrollDown() {
  var container = document.querySelector(".panel-body");
  container.scrollTop = container.scrollHeight;
}

/* harmony default export */ __webpack_exports__["default"] = ({
  created: function created() {
    vm = this;
    this.fetchMessages();
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data: function data() {
    return {
      newMessage: "",
      messages: []
    };
  },
  methods: {
    fetchMessages: function fetchMessages() {
      var _this = this;

      axios.get("/messages").then(function (response) {
        _this.messages = response.data;
      }).then(function () {
        chatScrollDown();
      });
    },
    sendMessage: function sendMessage() {
      var _this2 = this;

      if (this.newMessage.length === 0) return;
      var message = {
        user: this.user,
        message: this.newMessage
      };
      this.messages.push(message);
      axios.post("/messages", message).then(function (response) {
        _this2.newMessage = "";
        chatScrollDown();
      });
    }
  },
  directives: {
    profilePicture: function profilePicture(el, binding) {
      var url = binding.value.profile_picture ? "http://127.0.0.1:8000/storage/".concat(binding.value.profile_picture) : "https://ui-avatars.com/api/?name=".concat(binding.value.name, "&color=7F9CF5&background=EBF4FF");
      el.src = url;
    }
  },
  computed: {
    mergedMessages: function mergedMessages() {
      var messages = this.messages;
      var newMessagesArray = [];
      var mergedMessagesArray = [];
      messages.forEach(function (message, i) {
        mergedMessagesArray.push(message.message);

        try {
          if (message.user.id !== messages[i + 1].user.id) {
            newMessagesArray.push({
              user: message.user,
              messages: mergedMessagesArray
            });
            mergedMessagesArray = [];
          }
        } catch (error) {
          newMessagesArray.push({
            user: message.user,
            messages: mergedMessagesArray
          });
        }
      });
      return newMessagesArray;
    }
  }
});
Echo["private"]("chat").listen("MessageSent", function (e) {
  function pushMessage() {
    return _pushMessage.apply(this, arguments);
  }

  function _pushMessage() {
    _pushMessage = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              vm.messages.push({
                message: e.message.message,
                user: e.user
              });

            case 1:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));
    return _pushMessage.apply(this, arguments);
  }

  _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
    var elem;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return pushMessage();

          case 2:
            // Scrolls the chat for you if you were at the most recent message
            elem = $(".panel-body");

            if (elem[0].scrollHeight - elem.scrollTop() <= elem.outerHeight() + 100) {
              chatScrollDown();
            }

          case 4:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }))();
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "panel panel-default" }, [
    _c("div", { staticClass: "panel-body mb-3" }, [
      _c(
        "ul",
        { staticClass: "chat" },
        _vm._l(_vm.mergedMessages, function(message) {
          return _c("li", { key: message.id, staticClass: "left clearfix" }, [
            _c("div", { staticClass: "chat-body clearfix d-flex" }, [
              _c("div", [
                _c("img", {
                  directives: [
                    {
                      name: "profile-picture",
                      rawName: "v-profile-picture",
                      value: message.user,
                      expression: "message.user"
                    }
                  ],
                  staticClass: "rounded-circle mr-2",
                  attrs: { alt: "Profile picture", height: "32", width: "32" }
                })
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "header" },
                [
                  _c("strong", { staticClass: "primary-font" }, [
                    _vm._v(_vm._s(message.user.name))
                  ]),
                  _vm._v(" "),
                  _vm._l(message.messages, function(m) {
                    return _c("p", { key: m.id }, [_vm._v(_vm._s(m))])
                  })
                ],
                2
              )
            ])
          ])
        }),
        0
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "panel-footer" }, [
      _c("div", { staticClass: "input-group" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.newMessage,
              expression: "newMessage"
            }
          ],
          staticClass: "form-control input-sm",
          attrs: {
            id: "btn-input",
            type: "text",
            name: "message",
            placeholder: "Type your message here..."
          },
          domProps: { value: _vm.newMessage },
          on: {
            keyup: function($event) {
              if (
                !$event.type.indexOf("key") &&
                _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
              ) {
                return null
              }
              return _vm.sendMessage($event)
            },
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.newMessage = $event.target.value
            }
          }
        }),
        _vm._v(" "),
        _c("span", { staticClass: "input-group-btn" }, [
          _c(
            "button",
            {
              staticClass: "btn btn-watermelon",
              attrs: { id: "btn-chat" },
              on: { click: _vm.sendMessage }
            },
            [_vm._v("Send")]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Chat.vue":
/*!******************************************!*\
  !*** ./resources/js/components/Chat.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Chat.vue?vue&type=template&id=0d66c37a& */ "./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a&");
/* harmony import */ var _Chat_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Chat.vue?vue&type=script&lang=js& */ "./resources/js/components/Chat.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Chat_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Chat.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Chat.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./resources/js/components/Chat.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Chat_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Chat.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Chat.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Chat_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Chat.vue?vue&type=template&id=0d66c37a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Chat.vue?vue&type=template&id=0d66c37a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Chat_vue_vue_type_template_id_0d66c37a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);