(this["webpackJsonpmy-app"]=this["webpackJsonpmy-app"]||[]).push([[0],{24:function(n,t,e){"use strict";e.r(t);var r=e(1),c=e(0),o=e.n(c),i=e(12),a=e.n(i),u=e(10),d=e(16),l=e(7),j=e(2),s=e(3);function f(){var n=Object(j.a)(["\n  color: #8c495e;\n  background: #d1d1c2;\n  margin-left: 20px;\n  cursor: pointer;\n"]);return f=function(){return n},n}function b(){var n=Object(j.a)(["\n  width: 300px;\n  padding: 5px;\n  border: 0px;\n"]);return b=function(){return n},n}function p(){var n=Object(j.a)(["\n  margin-bottom: 30px;\n"]);return p=function(){return n},n}var h=s.a.div(p()),x=s.a.input(b()),v=s.a.button(f());var O=function(n){var t=n.value,e=n.handleButtonClick,c=n.handleInputChange;return Object(r.jsxs)(h,{children:[Object(r.jsx)(x,{placeholder:"\u563f\u563f\uff01\u6709\u4ec0\u9ebc\u8981\u6211\u5e6b\u5fd9\u8a18\u7684\u55ce\uff1f",value:t,onChange:c}),Object(r.jsx)(v,{onClick:function(){return e()},children:"\u6309\u6211\uff01"})]})};function g(){var n=Object(j.a)(["\n  color: #8c495e;\n  background: #d1d1c2;\n  margin-left: 20px;\n  cursor: pointer;\n"]);return g=function(){return n},n}function m(){var n=Object(j.a)(["\n  color: #8c495e;\n  ","\n"]);return m=function(){return n},n}function D(){var n=Object(j.a)(["\n  color: #8c495e;\n  border: 1px solid;\n  font-size: 10px;\n  border-radius: 3px;\n  cursor: pointer;\n  padding: 3px 2px;\n"]);return D=function(){return n},n}function C(){var n=Object(j.a)(["\n  display: flex;\n  justify-content: space-between;\n  padding: 5px;\n"]);return C=function(){return n},n}function k(){var n=Object(j.a)(["\n  text-align: center;\n  margin: 10px;\n"]);return k=function(){return n},n}var F=s.a.div(k()),T=s.a.div(C()),w=s.a.div(D()),y=s.a.div(m(),(function(n){return n.isDone&&"\n    text-decoration:line-through;\n  "})),I=s.a.button(g());var S=function(n){var t=n.todo,e=n.handleDeleteTodo,c=n.handleToggleDone;return Object(r.jsx)(F,{children:Object(r.jsxs)(T,{children:[Object(r.jsx)(w,{onClick:function(){c(t.id)},children:t.isDone?"\u5df2\u5b8c\u6210!":"\u5f85\u57f7\u884c!"}),Object(r.jsx)(y,{isDone:t.isDone,children:t.content}),Object(r.jsx)("div",{children:Object(r.jsx)(I,{onClick:function(){e(t.id)},children:"\u522a\u9664"})})]})})};function B(){var n=Object(j.a)(["\n  background: #74a38c;\n  color: #d1d1c2;\n  margin: 10px;\n  cursor: pointer;\n  &:hover {\n    color: white;\n  }\n"]);return B=function(){return n},n}function Y(){var n=Object(j.a)([""]);return Y=function(){return n},n}function A(){var n=Object(j.a)(["\n  margin: 0px auto;\n"]);return A=function(){return n},n}var L=s.a.div(A()),N=s.a.div(Y()),z=s.a.button(B());var J=function(n){var t=n.handleFilterAll,e=n.handleFilterNotYet,c=n.handleFilterDone,o=n.handleCleanUp;return Object(r.jsx)(L,{children:Object(r.jsxs)(N,{children:[Object(r.jsx)(z,{onClick:t,children:"\u5168\u90e8"}),Object(r.jsx)(z,{onClick:e,children:"\u9084\u6c92\u505a"}),Object(r.jsx)(z,{onClick:c,children:"\u505a\u5b8c\u7684"}),Object(r.jsx)(z,{onClick:o,children:"\u6e05\u5149\u5149"})]})})};function P(){var n=Object(j.a)(["\n  color: #8c495e;\n  padding: 10px;\n  font-size: 30px;\n  font-family: monospace;\n"]);return P=function(){return n},n}function U(){var n=Object(j.a)(["\n  margin: 50px auto;\n  background: #d1d1c2;\n  width: 450px;\n  border: 3px solid #74a38c;\n  text-align: center;\n"]);return U=function(){return n},n}var E=s.a.div(U()),M=s.a.div(P()),q=3;var G=function(){var n=o.a.useState(""),t=Object(l.a)(n,2),e=t[0],c=t[1],i=o.a.useState([{id:2,content:"abc",isDone:!0},{id:1,content:"\u600e\u9ebc\u8fa6",isDone:!1}]),a=Object(l.a)(i,2),j=a[0],s=a[1],f=o.a.useState("all"),b=Object(l.a)(f,2),p=b[0],h=b[1],x=function(n){s(j.filter((function(t){return t.id!==n})))},v=function(n){s(j.map((function(t){return t.id!==n?t:Object(u.a)(Object(u.a)({},t),{},{isDone:!t.isDone})})))};return Object(r.jsx)("div",{className:"App",children:Object(r.jsxs)(E,{children:[Object(r.jsx)(M,{children:"I am TodoList"}),Object(r.jsx)(O,{handleButtonClick:function(){s([{id:q,content:e,isDone:!1}].concat(Object(d.a)(j))),q++,c("")},handleInputChange:function(n){c(n.target.value)},value:e}),j.filter((function(n){return"all"===p||("completed"===p?n.isDone:"notYet"===p?!n.isDone:void 0)})).map((function(n){return Object(r.jsx)(S,{todo:n,handleDeleteTodo:x,handleToggleDone:v},n.id)})),Object(r.jsx)(J,{handleFilterAll:function(){h("all")},handleFilterNotYet:function(){h("notYet")},handleFilterDone:function(){h("completed")},handleCleanUp:function(){s([])}})]})})},H=function(n){n&&n instanceof Function&&e.e(3).then(e.bind(null,25)).then((function(t){var e=t.getCLS,r=t.getFID,c=t.getFCP,o=t.getLCP,i=t.getTTFB;e(n),r(n),c(n),o(n),i(n)}))};a.a.render(Object(r.jsx)(o.a.StrictMode,{children:Object(r.jsx)(G,{})}),document.getElementById("root")),H()}},[[24,1,2]]]);
//# sourceMappingURL=main.6f8f9fc2.chunk.js.map