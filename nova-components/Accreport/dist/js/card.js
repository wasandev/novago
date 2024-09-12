/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'Accreport',
  props: {
    card: Object
  },
  methods: {
    link: function link(path) {
      return "".concat(path);
    }
  },
  computed: {
    report1: function report1() {
      return this.link('/app/resources/order_headers/lens/order-billing-cash');
    },
    report2: function report2() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-bill-by-day');
    },
    report3: function report3() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-by-day');
    },
    report4: function report4() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-by-branchrc');
    },
    report5: function report5() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cancel-by-day');
    },
    report6: function report6() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cash-by-day');
    },
    report7: function report7() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cr-by-day');
    },
    report8: function report8() {
      return this.link('/app/resources/waybills/lens/waybill-confirmed-per-day');
    },
    report9: function report9() {
      return this.link('/app/resources/cars/lens/accounts-carreceive-report-by-day');
    },
    report10: function report10() {
      return this.link('/app/resources/cars/lens/accounts-carpayment-report-by-day');
    },
    report11: function report11() {
      return this.link('/app/resources/cars/lens/cars-carcard-report');
    },
    report12: function report12() {
      return this.link('/app/resources/cars/lens/cars-summary-report');
    },
    report13: function report13() {
      return this.link('/app/resources/vendors/lens/carpay-tax');
    },
    report14: function report14() {
      return this.link('/app/resources/waybills/lens/waybill-confirmed-per-month');
    },
    report15: function report15() {
      return this.link('/app/resources/ar_customers/lens/ar-outstanding-report');
    },
    report16: function report16() {
      return this.link('/app/resources/ar_customers/lens/ar-receipt-report');
    },
    report17: function report17() {
      return this.link('/app/resources/ar_customers/lens/ar-card-report');
    },
    report18: function report18() {
      return this.link('/app/resources/ar_customers/lens/ar-summary-report');
    },
    report19: function report19() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-bydate');
    },
    report20: function report20() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-receipt');
    },
    report21: function report21() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-report');
    }
  }
});

/***/ }),

/***/ "../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);

var _hoisted_1 = {
  "class": "my-component-scoped flex justify-center items-centers"
};
var _hoisted_2 = {
  "class": "w-full"
};
var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", {
  "class": "text-90 leading-tight mb-8"
}, " รวม Link รายงานต่างๆ ", -1 /* HOISTED */);
var _hoisted_4 = {
  "class": "w-full flex flex-wrap"
};
var _hoisted_5 = {
  "class": "item-center w-1/2"
};
var _hoisted_6 = ["href"];
var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_8 = {
  "class": "mt-3"
};
var _hoisted_9 = {
  "class": "item-center w-1/2"
};
var _hoisted_10 = ["href"];
var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  fill: "bg-blue-500",
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_12 = {
  "class": "mt-3"
};
var _hoisted_13 = {
  "class": "w-full flex flex-wrap"
};
var _hoisted_14 = {
  "class": "align-top w-1/2"
};
var _hoisted_15 = ["href"];
var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_17 = {
  "class": "mt-3"
};
var _hoisted_18 = {
  "class": "align-top w-1/2"
};
var _hoisted_19 = ["href"];
var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_21 = {
  "class": "mt-3"
};
var _hoisted_22 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_23 = {
  "class": "align-top w-1/2"
};
var _hoisted_24 = ["href"];
var _hoisted_25 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_26 = {
  "class": "mt-3"
};
var _hoisted_27 = {
  "class": "align-top w-1/2"
};
var _hoisted_28 = ["href"];
var _hoisted_29 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_30 = {
  "class": "mt-3"
};
var _hoisted_31 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_32 = {
  "class": "align-top w-1/2"
};
var _hoisted_33 = ["href"];
var _hoisted_34 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_35 = {
  "class": "mt-3"
};
var _hoisted_36 = {
  "class": "align-top w-1/2"
};
var _hoisted_37 = ["href"];
var _hoisted_38 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_39 = {
  "class": "mt-3"
};
var _hoisted_40 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_41 = {
  "class": "align-top w-1/2"
};
var _hoisted_42 = ["href"];
var _hoisted_43 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_44 = {
  "class": "mt-3"
};
var _hoisted_45 = {
  "class": "align-top w-1/2"
};
var _hoisted_46 = ["href"];
var _hoisted_47 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_48 = {
  "class": "mt-3"
};
var _hoisted_49 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_50 = {
  "class": "align-top w-1/2"
};
var _hoisted_51 = ["href"];
var _hoisted_52 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_53 = {
  "class": "mt-3"
};
var _hoisted_54 = {
  "class": "align-top w-1/2"
};
var _hoisted_55 = ["href"];
var _hoisted_56 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_57 = {
  "class": "mt-3"
};
var _hoisted_58 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_59 = {
  "class": "align-top w-1/2"
};
var _hoisted_60 = ["href"];
var _hoisted_61 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_62 = {
  "class": "mt-3"
};
var _hoisted_63 = {
  "class": "align-top w-1/2"
};
var _hoisted_64 = ["href"];
var _hoisted_65 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_66 = {
  "class": "mt-3"
};
var _hoisted_67 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_68 = {
  "class": "align-top w-1/2"
};
var _hoisted_69 = ["href"];
var _hoisted_70 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_71 = {
  "class": "mt-3"
};
var _hoisted_72 = {
  "class": "align-top w-1/2"
};
var _hoisted_73 = ["href"];
var _hoisted_74 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_75 = {
  "class": "mt-3"
};
var _hoisted_76 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_77 = {
  "class": "align-top w-1/2"
};
var _hoisted_78 = ["href"];
var _hoisted_79 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_80 = {
  "class": "mt-3"
};
var _hoisted_81 = {
  "class": "align-top w-1/2"
};
var _hoisted_82 = ["href"];
var _hoisted_83 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_84 = {
  "class": "mt-3"
};
var _hoisted_85 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_86 = {
  "class": "align-top w-1/2"
};
var _hoisted_87 = ["href"];
var _hoisted_88 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_89 = {
  "class": "mt-3"
};
var _hoisted_90 = {
  "class": "align-top w-1/2"
};
var _hoisted_91 = ["href"];
var _hoisted_92 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_93 = {
  "class": "mt-3"
};
var _hoisted_94 = {
  "class": "w-full flex flex-wrap",
  cellpadding: "10",
  cellspacing: "10"
};
var _hoisted_95 = {
  "class": "align-top w-1/2"
};
var _hoisted_96 = ["href"];
var _hoisted_97 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "flex justify-center w-11 flex-no-shrink mr-6"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "fill-blue-500 hover:fill-gray-950",
  xmlns: "http://www.w3.org/2000/svg",
  width: "60",
  height: "60",
  viewBox: "0 0 20 20"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  d: "M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"
})])], -1 /* HOISTED */);
var _hoisted_98 = {
  "class": "mt-3"
};
var _hoisted_99 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "align-top w-1/2"
}, null, -1 /* HOISTED */);
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_heading = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("heading");
  var _component_card = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("card", true);
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
    "class": "flex mb-3 text-bold text-blue-500"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Quick Reports Menu")];
    }),
    _: 1 /* STABLE */
  }), _hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report1,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานเงินสดรับ ตามพนักงาน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_6)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report2,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรายการขนส่งประจำวัน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_10)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report3,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานยอดค่าขนส่งตามวัน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_15)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report4,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานยอดค่าขนส่งตามสาขาปลายทาง")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_19)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report5,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรายการยกเลิกใบรับส่ง")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_24)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report6,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานขายสดประจำวัน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_28)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report7,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_34, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานขายเชื่อประจำวัน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_33)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report8,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรถออกประจำวัน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_37)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report9,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_43, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานสรุปรับเงินรถ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_42)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report10,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_47, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานสรุปจ่ายเงินรถ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_46)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report11,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_52, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานบัญชีคุมรถบรรทุก")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_51)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report12,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_56, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานสรุปยอดคงเหลือรถ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_55)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report13,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_61, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานภาษีหัก ณ ที่จ่ายรถ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_60)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report14,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_65, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรถออกประจำเดือน")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_64)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report15,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_70, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานลูกหนี้ค้างชำระ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_69)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report16,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_74, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรับชำระหนี้ลูกหนี้การค้า")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_73)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report17,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_79, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานทะเบียนคุมลูกหนี้")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_78)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report18,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_83, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานสรุปยอดลูกหนี้การค้า")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_82)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_86, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report19,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_88, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานตั้งหนี้ลูกหนี้สาขา")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_87)];
    }),
    _: 1 /* STABLE */
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_90, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report20,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_92, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_93, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานรับชำระหนี้ลูกหนี้สาขา")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_91)];
    }),
    _: 1 /* STABLE */
  })])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_card, {
    "class": "p-2 m-2"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        href: $options.report21,
        "class": "no-underline dim flex p-6 hover:text-blue-500"
      }, [_hoisted_97, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_98, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_heading, {
        level: 3,
        "class": "mb-3 font-bold"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("รายงานลูกหนี้สาขาค้างชำระ")];
        }),
        _: 1 /* STABLE */
      })])], 8 /* PROPS */, _hoisted_96)];
    }),
    _: 1 /* STABLE */
  })]), _hoisted_99]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" </card> ")])]);
}

/***/ }),

/***/ "./resources/js/card.js":
/*!******************************!*\
  !*** ./resources/js/card.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_Card__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/Card */ "./resources/js/components/Card.vue");

Nova.booting(function (app, store) {
  app.component('accreport', _components_Card__WEBPACK_IMPORTED_MODULE_0__["default"]);
});

/***/ }),

/***/ "./resources/css/card.css":
/*!********************************!*\
  !*** ./resources/css/card.css ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "../../node_modules/vue-loader/dist/exportHelper.js":
/*!**********************************************************!*\
  !*** ../../node_modules/vue-loader/dist/exportHelper.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, exports) => {


Object.defineProperty(exports, "__esModule", ({ value: true }));
// runtime helper for setting properties on components
// in a tree-shakable way
exports["default"] = (sfc, props) => {
    const target = sfc.__vccOpts || sfc;
    for (const [key, val] of props) {
        target[key] = val;
    }
    return target;
};


/***/ }),

/***/ "./resources/js/components/Card.vue":
/*!******************************************!*\
  !*** ./resources/js/components/Card.vue ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Card_vue_vue_type_template_id_b9bc2c0a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Card.vue?vue&type=template&id=b9bc2c0a */ "./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a");
/* harmony import */ var _Card_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Card.vue?vue&type=script&lang=js */ "./resources/js/components/Card.vue?vue&type=script&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "../../node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Card_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Card_vue_vue_type_template_id_b9bc2c0a__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/Card.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/Card.vue?vue&type=script&lang=js":
/*!******************************************************************!*\
  !*** ./resources/js/components/Card.vue?vue&type=script&lang=js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Card_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Card_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Card.vue?vue&type=script&lang=js */ "../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a":
/*!************************************************************************!*\
  !*** ./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Card_vue_vue_type_template_id_b9bc2c0a__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Card_vue_vue_type_template_id_b9bc2c0a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Card.vue?vue&type=template&id=b9bc2c0a */ "../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/Card.vue?vue&type=template&id=b9bc2c0a");


/***/ }),

/***/ "vue":
/*!**********************!*\
  !*** external "Vue" ***!
  \**********************/
/***/ ((module) => {

module.exports = Vue;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/card": 0,
/******/ 			"css/card": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkwasan_accreport"] = self["webpackChunkwasan_accreport"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/card"], () => (__webpack_require__("./resources/js/card.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/card"], () => (__webpack_require__("./resources/css/card.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;