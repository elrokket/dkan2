(this.webpackJsonpapp=this.webpackJsonpapp||[]).push([[0],{175:function(t,e,a){t.exports=a(453)},180:function(t,e,a){},453:function(t,e,a){"use strict";a.r(e);var n=a(1),o=a.n(n),r=a(174),s=a.n(r),c=(a(180),a(73)),i=a.n(c),u=a(105),m=a(104),p=a.n(m),f=a(435);var l=function(){var t=Object(n.useState)({}),e=Object(u.a)(t,2),a=e[0],r=e[1],s=Object(n.useState)({}),c=Object(u.a)(s,2),m=c[0],l=c[1];function h(){var t=new URLSearchParams(window.location.search).getAll("id");return t.length>0?t[0]:null}return Object(n.useEffect)((function(){!function(){var t,e,a;i.a.async((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,i.a.awrap(f.get("/api/1/metastore/schemas/dataset"));case 2:if(t=n.sent,r(t.data),!(e=h())){n.next=10;break}return n.next=8,i.a.awrap(f.get("/api/1/metastore/schemas/dataset/items/"+e));case 8:a=n.sent,l(a.data);case 10:case"end":return n.stop()}}))}()}),[]),o.a.createElement(p.a,{schema:a,formData:m,onSubmit:function(t){!function(t){var e=h();e?f.put("/api/1/metastore/schemas/dataset/items/"+e,t.formData):f.post("/api/1/metastore/schemas/dataset/items",t.formData)}(t)},onError:function(t){console.log(t)}})};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));s.a.render(o.a.createElement(l,null),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(t){t.unregister()}))}},[[175,1,2]]]);
//# sourceMappingURL=main.2314b2f0.chunk.js.map