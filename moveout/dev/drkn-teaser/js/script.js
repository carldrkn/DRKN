/*! jQuery v1.11.2 | (c) 2005, 2014 jQuery Foundation, Inc. | jquery.org/license */
!function(a,b){"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){var c=[],d=c.slice,e=c.concat,f=c.push,g=c.indexOf,h={},i=h.toString,j=h.hasOwnProperty,k={},l="1.11.2",m=function(a,b){return new m.fn.init(a,b)},n=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,o=/^-ms-/,p=/-([\da-z])/gi,q=function(a,b){return b.toUpperCase()};m.fn=m.prototype={jquery:l,constructor:m,selector:"",length:0,toArray:function(){return d.call(this)},get:function(a){return null!=a?0>a?this[a+this.length]:this[a]:d.call(this)},pushStack:function(a){var b=m.merge(this.constructor(),a);return b.prevObject=this,b.context=this.context,b},each:function(a,b){return m.each(this,a,b)},map:function(a){return this.pushStack(m.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(d.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(0>a?b:0);return this.pushStack(c>=0&&b>c?[this[c]]:[])},end:function(){return this.prevObject||this.constructor(null)},push:f,sort:c.sort,splice:c.splice},m.extend=m.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||m.isFunction(g)||(g={}),h===i&&(g=this,h--);i>h;h++)if(null!=(e=arguments[h]))for(d in e)a=g[d],c=e[d],g!==c&&(j&&c&&(m.isPlainObject(c)||(b=m.isArray(c)))?(b?(b=!1,f=a&&m.isArray(a)?a:[]):f=a&&m.isPlainObject(a)?a:{},g[d]=m.extend(j,f,c)):void 0!==c&&(g[d]=c));return g},m.extend({expando:"jQuery"+(l+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===m.type(a)},isArray:Array.isArray||function(a){return"array"===m.type(a)},isWindow:function(a){return null!=a&&a==a.window},isNumeric:function(a){return!m.isArray(a)&&a-parseFloat(a)+1>=0},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},isPlainObject:function(a){var b;if(!a||"object"!==m.type(a)||a.nodeType||m.isWindow(a))return!1;try{if(a.constructor&&!j.call(a,"constructor")&&!j.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(c){return!1}if(k.ownLast)for(b in a)return j.call(a,b);for(b in a);return void 0===b||j.call(a,b)},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?h[i.call(a)]||"object":typeof a},globalEval:function(b){b&&m.trim(b)&&(a.execScript||function(b){a.eval.call(a,b)})(b)},camelCase:function(a){return a.replace(o,"ms-").replace(p,q)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()},each:function(a,b,c){var d,e=0,f=a.length,g=r(a);if(c){if(g){for(;f>e;e++)if(d=b.apply(a[e],c),d===!1)break}else for(e in a)if(d=b.apply(a[e],c),d===!1)break}else if(g){for(;f>e;e++)if(d=b.call(a[e],e,a[e]),d===!1)break}else for(e in a)if(d=b.call(a[e],e,a[e]),d===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(n,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(r(Object(a))?m.merge(c,"string"==typeof a?[a]:a):f.call(c,a)),c},inArray:function(a,b,c){var d;if(b){if(g)return g.call(b,a,c);for(d=b.length,c=c?0>c?Math.max(0,d+c):c:0;d>c;c++)if(c in b&&b[c]===a)return c}return-1},merge:function(a,b){var c=+b.length,d=0,e=a.length;while(c>d)a[e++]=b[d++];if(c!==c)while(void 0!==b[d])a[e++]=b[d++];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;g>f;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,f=0,g=a.length,h=r(a),i=[];if(h)for(;g>f;f++)d=b(a[f],f,c),null!=d&&i.push(d);else for(f in a)d=b(a[f],f,c),null!=d&&i.push(d);return e.apply([],i)},guid:1,proxy:function(a,b){var c,e,f;return"string"==typeof b&&(f=a[b],b=a,a=f),m.isFunction(a)?(c=d.call(arguments,2),e=function(){return a.apply(b||this,c.concat(d.call(arguments)))},e.guid=a.guid=a.guid||m.guid++,e):void 0},now:function(){return+new Date},support:k}),m.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(a,b){h["[object "+b+"]"]=b.toLowerCase()});function r(a){var b=a.length,c=m.type(a);return"function"===c||m.isWindow(a)?!1:1===a.nodeType&&b?!0:"array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a}var s=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=hb(),z=hb(),A=hb(),B=function(a,b){return a===b&&(l=!0),0},C=1<<31,D={}.hasOwnProperty,E=[],F=E.pop,G=E.push,H=E.push,I=E.slice,J=function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},K="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",L="[\\x20\\t\\r\\n\\f]",M="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",N=M.replace("w","w#"),O="\\["+L+"*("+M+")(?:"+L+"*([*^$|!~]?=)"+L+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+N+"))|)"+L+"*\\]",P=":("+M+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+O+")*)|.*)\\)|)",Q=new RegExp(L+"+","g"),R=new RegExp("^"+L+"+|((?:^|[^\\\\])(?:\\\\.)*)"+L+"+$","g"),S=new RegExp("^"+L+"*,"+L+"*"),T=new RegExp("^"+L+"*([>+~]|"+L+")"+L+"*"),U=new RegExp("="+L+"*([^\\]'\"]*?)"+L+"*\\]","g"),V=new RegExp(P),W=new RegExp("^"+N+"$"),X={ID:new RegExp("^#("+M+")"),CLASS:new RegExp("^\\.("+M+")"),TAG:new RegExp("^("+M.replace("w","w*")+")"),ATTR:new RegExp("^"+O),PSEUDO:new RegExp("^"+P),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+L+"*(even|odd|(([+-]|)(\\d*)n|)"+L+"*(?:([+-]|)"+L+"*(\\d+)|))"+L+"*\\)|)","i"),bool:new RegExp("^(?:"+K+")$","i"),needsContext:new RegExp("^"+L+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+L+"*((?:-\\d)?\\d*)"+L+"*\\)|)(?=[^-]|$)","i")},Y=/^(?:input|select|textarea|button)$/i,Z=/^h\d$/i,$=/^[^{]+\{\s*\[native \w/,_=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ab=/[+~]/,bb=/'|\\/g,cb=new RegExp("\\\\([\\da-f]{1,6}"+L+"?|("+L+")|.)","ig"),db=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:0>d?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},eb=function(){m()};try{H.apply(E=I.call(v.childNodes),v.childNodes),E[v.childNodes.length].nodeType}catch(fb){H={apply:E.length?function(a,b){G.apply(a,I.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function gb(a,b,d,e){var f,h,j,k,l,o,r,s,w,x;if((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,d=d||[],k=b.nodeType,"string"!=typeof a||!a||1!==k&&9!==k&&11!==k)return d;if(!e&&p){if(11!==k&&(f=_.exec(a)))if(j=f[1]){if(9===k){if(h=b.getElementById(j),!h||!h.parentNode)return d;if(h.id===j)return d.push(h),d}else if(b.ownerDocument&&(h=b.ownerDocument.getElementById(j))&&t(b,h)&&h.id===j)return d.push(h),d}else{if(f[2])return H.apply(d,b.getElementsByTagName(a)),d;if((j=f[3])&&c.getElementsByClassName)return H.apply(d,b.getElementsByClassName(j)),d}if(c.qsa&&(!q||!q.test(a))){if(s=r=u,w=b,x=1!==k&&a,1===k&&"object"!==b.nodeName.toLowerCase()){o=g(a),(r=b.getAttribute("id"))?s=r.replace(bb,"\\$&"):b.setAttribute("id",s),s="[id='"+s+"'] ",l=o.length;while(l--)o[l]=s+rb(o[l]);w=ab.test(a)&&pb(b.parentNode)||b,x=o.join(",")}if(x)try{return H.apply(d,w.querySelectorAll(x)),d}catch(y){}finally{r||b.removeAttribute("id")}}}return i(a.replace(R,"$1"),b,d,e)}function hb(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ib(a){return a[u]=!0,a}function jb(a){var b=n.createElement("div");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function kb(a,b){var c=a.split("|"),e=a.length;while(e--)d.attrHandle[c[e]]=b}function lb(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&(~b.sourceIndex||C)-(~a.sourceIndex||C);if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function mb(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function nb(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function ob(a){return ib(function(b){return b=+b,ib(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function pb(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=gb.support={},f=gb.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return b?"HTML"!==b.nodeName:!1},m=gb.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=g.documentElement,e=g.defaultView,e&&e!==e.top&&(e.addEventListener?e.addEventListener("unload",eb,!1):e.attachEvent&&e.attachEvent("onunload",eb)),p=!f(g),c.attributes=jb(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=jb(function(a){return a.appendChild(g.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=$.test(g.getElementsByClassName),c.getById=jb(function(a){return o.appendChild(a).id=u,!g.getElementsByName||!g.getElementsByName(u).length}),c.getById?(d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c&&c.parentNode?[c]:[]}},d.filter.ID=function(a){var b=a.replace(cb,db);return function(a){return a.getAttribute("id")===b}}):(delete d.find.ID,d.filter.ID=function(a){var b=a.replace(cb,db);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){return p?b.getElementsByClassName(a):void 0},r=[],q=[],(c.qsa=$.test(g.querySelectorAll))&&(jb(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\f]' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+L+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+L+"*(?:value|"+K+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),jb(function(a){var b=g.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+L+"*[*^$|!~]?="),a.querySelectorAll(":enabled").length||q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=$.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&jb(function(a){c.disconnectedMatch=s.call(a,"div"),s.call(a,"[s!='']:x"),r.push("!=",P)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=$.test(o.compareDocumentPosition),t=b||$.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===g||a.ownerDocument===v&&t(v,a)?-1:b===g||b.ownerDocument===v&&t(v,b)?1:k?J(k,a)-J(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,h=[a],i=[b];if(!e||!f)return a===g?-1:b===g?1:e?-1:f?1:k?J(k,a)-J(k,b):0;if(e===f)return lb(a,b);c=a;while(c=c.parentNode)h.unshift(c);c=b;while(c=c.parentNode)i.unshift(c);while(h[d]===i[d])d++;return d?lb(h[d],i[d]):h[d]===v?-1:i[d]===v?1:0},g):n},gb.matches=function(a,b){return gb(a,null,null,b)},gb.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(U,"='$1']"),!(!c.matchesSelector||!p||r&&r.test(b)||q&&q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return gb(b,n,null,[a]).length>0},gb.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},gb.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&D.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},gb.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},gb.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=gb.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=gb.selectors={cacheLength:50,createPseudo:ib,match:X,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(cb,db),a[3]=(a[3]||a[4]||a[5]||"").replace(cb,db),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||gb.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&gb.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return X.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&V.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(cb,db).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+L+")"+a+"("+L+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=gb.attr(d,a);return null==e?"!="===b:b?(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(Q," ")+" ").indexOf(c)>-1:"|="===b?e===c||e.slice(0,c.length+1)===c+"-":!1):!0}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h;if(q){if(f){while(p){l=b;while(l=l[p])if(h?l.nodeName.toLowerCase()===r:1===l.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){k=q[u]||(q[u]={}),j=k[a]||[],n=j[0]===w&&j[1],m=j[0]===w&&j[2],l=n&&q.childNodes[n];while(l=++n&&l&&l[p]||(m=n=0)||o.pop())if(1===l.nodeType&&++m&&l===b){k[a]=[w,n,m];break}}else if(s&&(j=(b[u]||(b[u]={}))[a])&&j[0]===w)m=j[1];else while(l=++n&&l&&l[p]||(m=n=0)||o.pop())if((h?l.nodeName.toLowerCase()===r:1===l.nodeType)&&++m&&(s&&((l[u]||(l[u]={}))[a]=[w,m]),l===b))break;return m-=e,m===d||m%d===0&&m/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||gb.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ib(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=J(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ib(function(a){var b=[],c=[],d=h(a.replace(R,"$1"));return d[u]?ib(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ib(function(a){return function(b){return gb(a,b).length>0}}),contains:ib(function(a){return a=a.replace(cb,db),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ib(function(a){return W.test(a||"")||gb.error("unsupported lang: "+a),a=a.replace(cb,db).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:function(a){return a.disabled===!1},disabled:function(a){return a.disabled===!0},checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return Z.test(a.nodeName)},input:function(a){return Y.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:ob(function(){return[0]}),last:ob(function(a,b){return[b-1]}),eq:ob(function(a,b,c){return[0>c?c+b:c]}),even:ob(function(a,b){for(var c=0;b>c;c+=2)a.push(c);return a}),odd:ob(function(a,b){for(var c=1;b>c;c+=2)a.push(c);return a}),lt:ob(function(a,b,c){for(var d=0>c?c+b:c;--d>=0;)a.push(d);return a}),gt:ob(function(a,b,c){for(var d=0>c?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=mb(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=nb(b);function qb(){}qb.prototype=d.filters=d.pseudos,d.setFilters=new qb,g=gb.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){(!c||(e=S.exec(h)))&&(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=T.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(R," ")}),h=h.slice(c.length));for(g in d.filter)!(e=X[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?gb.error(a):z(a,i).slice(0)};function rb(a){for(var b=0,c=a.length,d="";c>b;b++)d+=a[b].value;return d}function sb(a,b,c){var d=b.dir,e=c&&"parentNode"===d,f=x++;return b.first?function(b,c,f){while(b=b[d])if(1===b.nodeType||e)return a(b,c,f)}:function(b,c,g){var h,i,j=[w,f];if(g){while(b=b[d])if((1===b.nodeType||e)&&a(b,c,g))return!0}else while(b=b[d])if(1===b.nodeType||e){if(i=b[u]||(b[u]={}),(h=i[d])&&h[0]===w&&h[1]===f)return j[2]=h[2];if(i[d]=j,j[2]=a(b,c,g))return!0}}}function tb(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function ub(a,b,c){for(var d=0,e=b.length;e>d;d++)gb(a,b[d],c);return c}function vb(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;i>h;h++)(f=a[h])&&(!c||c(f,d,e))&&(g.push(f),j&&b.push(h));return g}function wb(a,b,c,d,e,f){return d&&!d[u]&&(d=wb(d)),e&&!e[u]&&(e=wb(e,f)),ib(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||ub(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:vb(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=vb(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?J(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=vb(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):H.apply(g,r)})}function xb(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=sb(function(a){return a===b},h,!0),l=sb(function(a){return J(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];f>i;i++)if(c=d.relative[a[i].type])m=[sb(tb(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;f>e;e++)if(d.relative[a[e].type])break;return wb(i>1&&tb(m),i>1&&rb(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(R,"$1"),c,e>i&&xb(a.slice(i,e)),f>e&&xb(a=a.slice(e)),f>e&&rb(a))}m.push(c)}return tb(m)}function yb(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,m,o,p=0,q="0",r=f&&[],s=[],t=j,u=f||e&&d.find.TAG("*",k),v=w+=null==t?1:Math.random()||.1,x=u.length;for(k&&(j=g!==n&&g);q!==x&&null!=(l=u[q]);q++){if(e&&l){m=0;while(o=a[m++])if(o(l,g,h)){i.push(l);break}k&&(w=v)}c&&((l=!o&&l)&&p--,f&&r.push(l))}if(p+=q,c&&q!==p){m=0;while(o=b[m++])o(r,s,g,h);if(f){if(p>0)while(q--)r[q]||s[q]||(s[q]=F.call(i));s=vb(s)}H.apply(i,s),k&&!f&&s.length>0&&p+b.length>1&&gb.uniqueSort(i)}return k&&(w=v,j=t),r};return c?ib(f):f}return h=gb.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=xb(b[c]),f[u]?d.push(f):e.push(f);f=A(a,yb(e,d)),f.selector=a}return f},i=gb.select=function(a,b,e,f){var i,j,k,l,m,n="function"==typeof a&&a,o=!f&&g(a=n.selector||a);if(e=e||[],1===o.length){if(j=o[0]=o[0].slice(0),j.length>2&&"ID"===(k=j[0]).type&&c.getById&&9===b.nodeType&&p&&d.relative[j[1].type]){if(b=(d.find.ID(k.matches[0].replace(cb,db),b)||[])[0],!b)return e;n&&(b=b.parentNode),a=a.slice(j.shift().value.length)}i=X.needsContext.test(a)?0:j.length;while(i--){if(k=j[i],d.relative[l=k.type])break;if((m=d.find[l])&&(f=m(k.matches[0].replace(cb,db),ab.test(j[0].type)&&pb(b.parentNode)||b))){if(j.splice(i,1),a=f.length&&rb(j),!a)return H.apply(e,f),e;break}}}return(n||h(a,o))(f,b,!p,e,ab.test(a)&&pb(b.parentNode)||b),e},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=jb(function(a){return 1&a.compareDocumentPosition(n.createElement("div"))}),jb(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||kb("type|href|height|width",function(a,b,c){return c?void 0:a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&jb(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||kb("value",function(a,b,c){return c||"input"!==a.nodeName.toLowerCase()?void 0:a.defaultValue}),jb(function(a){return null==a.getAttribute("disabled")})||kb(K,function(a,b,c){var d;return c?void 0:a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),gb}(a);m.find=s,m.expr=s.selectors,m.expr[":"]=m.expr.pseudos,m.unique=s.uniqueSort,m.text=s.getText,m.isXMLDoc=s.isXML,m.contains=s.contains;var t=m.expr.match.needsContext,u=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,v=/^.[^:#\[\.,]*$/;function w(a,b,c){if(m.isFunction(b))return m.grep(a,function(a,d){return!!b.call(a,d,a)!==c});if(b.nodeType)return m.grep(a,function(a){return a===b!==c});if("string"==typeof b){if(v.test(b))return m.filter(b,a,c);b=m.filter(b,a)}return m.grep(a,function(a){return m.inArray(a,b)>=0!==c})}m.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?m.find.matchesSelector(d,a)?[d]:[]:m.find.matches(a,m.grep(b,function(a){return 1===a.nodeType}))},m.fn.extend({find:function(a){var b,c=[],d=this,e=d.length;if("string"!=typeof a)return this.pushStack(m(a).filter(function(){for(b=0;e>b;b++)if(m.contains(d[b],this))return!0}));for(b=0;e>b;b++)m.find(a,d[b],c);return c=this.pushStack(e>1?m.unique(c):c),c.selector=this.selector?this.selector+" "+a:a,c},filter:function(a){return this.pushStack(w(this,a||[],!1))},not:function(a){return this.pushStack(w(this,a||[],!0))},is:function(a){return!!w(this,"string"==typeof a&&t.test(a)?m(a):a||[],!1).length}});var x,y=a.document,z=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,A=m.fn.init=function(a,b){var c,d;if(!a)return this;if("string"==typeof a){if(c="<"===a.charAt(0)&&">"===a.charAt(a.length-1)&&a.length>=3?[null,a,null]:z.exec(a),!c||!c[1]&&b)return!b||b.jquery?(b||x).find(a):this.constructor(b).find(a);if(c[1]){if(b=b instanceof m?b[0]:b,m.merge(this,m.parseHTML(c[1],b&&b.nodeType?b.ownerDocument||b:y,!0)),u.test(c[1])&&m.isPlainObject(b))for(c in b)m.isFunction(this[c])?this[c](b[c]):this.attr(c,b[c]);return this}if(d=y.getElementById(c[2]),d&&d.parentNode){if(d.id!==c[2])return x.find(a);this.length=1,this[0]=d}return this.context=y,this.selector=a,this}return a.nodeType?(this.context=this[0]=a,this.length=1,this):m.isFunction(a)?"undefined"!=typeof x.ready?x.ready(a):a(m):(void 0!==a.selector&&(this.selector=a.selector,this.context=a.context),m.makeArray(a,this))};A.prototype=m.fn,x=m(y);var B=/^(?:parents|prev(?:Until|All))/,C={children:!0,contents:!0,next:!0,prev:!0};m.extend({dir:function(a,b,c){var d=[],e=a[b];while(e&&9!==e.nodeType&&(void 0===c||1!==e.nodeType||!m(e).is(c)))1===e.nodeType&&d.push(e),e=e[b];return d},sibling:function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c}}),m.fn.extend({has:function(a){var b,c=m(a,this),d=c.length;return this.filter(function(){for(b=0;d>b;b++)if(m.contains(this,c[b]))return!0})},closest:function(a,b){for(var c,d=0,e=this.length,f=[],g=t.test(a)||"string"!=typeof a?m(a,b||this.context):0;e>d;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&m.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?m.unique(f):f)},index:function(a){return a?"string"==typeof a?m.inArray(this[0],m(a)):m.inArray(a.jquery?a[0]:a,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(m.unique(m.merge(this.get(),m(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function D(a,b){do a=a[b];while(a&&1!==a.nodeType);return a}m.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return m.dir(a,"parentNode")},parentsUntil:function(a,b,c){return m.dir(a,"parentNode",c)},next:function(a){return D(a,"nextSibling")},prev:function(a){return D(a,"previousSibling")},nextAll:function(a){return m.dir(a,"nextSibling")},prevAll:function(a){return m.dir(a,"previousSibling")},nextUntil:function(a,b,c){return m.dir(a,"nextSibling",c)},prevUntil:function(a,b,c){return m.dir(a,"previousSibling",c)},siblings:function(a){return m.sibling((a.parentNode||{}).firstChild,a)},children:function(a){return m.sibling(a.firstChild)},contents:function(a){return m.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:m.merge([],a.childNodes)}},function(a,b){m.fn[a]=function(c,d){var e=m.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=m.filter(d,e)),this.length>1&&(C[a]||(e=m.unique(e)),B.test(a)&&(e=e.reverse())),this.pushStack(e)}});var E=/\S+/g,F={};function G(a){var b=F[a]={};return m.each(a.match(E)||[],function(a,c){b[c]=!0}),b}m.Callbacks=function(a){a="string"==typeof a?F[a]||G(a):m.extend({},a);var b,c,d,e,f,g,h=[],i=!a.once&&[],j=function(l){for(c=a.memory&&l,d=!0,f=g||0,g=0,e=h.length,b=!0;h&&e>f;f++)if(h[f].apply(l[0],l[1])===!1&&a.stopOnFalse){c=!1;break}b=!1,h&&(i?i.length&&j(i.shift()):c?h=[]:k.disable())},k={add:function(){if(h){var d=h.length;!function f(b){m.each(b,function(b,c){var d=m.type(c);"function"===d?a.unique&&k.has(c)||h.push(c):c&&c.length&&"string"!==d&&f(c)})}(arguments),b?e=h.length:c&&(g=d,j(c))}return this},remove:function(){return h&&m.each(arguments,function(a,c){var d;while((d=m.inArray(c,h,d))>-1)h.splice(d,1),b&&(e>=d&&e--,f>=d&&f--)}),this},has:function(a){return a?m.inArray(a,h)>-1:!(!h||!h.length)},empty:function(){return h=[],e=0,this},disable:function(){return h=i=c=void 0,this},disabled:function(){return!h},lock:function(){return i=void 0,c||k.disable(),this},locked:function(){return!i},fireWith:function(a,c){return!h||d&&!i||(c=c||[],c=[a,c.slice?c.slice():c],b?i.push(c):j(c)),this},fire:function(){return k.fireWith(this,arguments),this},fired:function(){return!!d}};return k},m.extend({Deferred:function(a){var b=[["resolve","done",m.Callbacks("once memory"),"resolved"],["reject","fail",m.Callbacks("once memory"),"rejected"],["notify","progress",m.Callbacks("memory")]],c="pending",d={state:function(){return c},always:function(){return e.done(arguments).fail(arguments),this},then:function(){var a=arguments;return m.Deferred(function(c){m.each(b,function(b,f){var g=m.isFunction(a[b])&&a[b];e[f[1]](function(){var a=g&&g.apply(this,arguments);a&&m.isFunction(a.promise)?a.promise().done(c.resolve).fail(c.reject).progress(c.notify):c[f[0]+"With"](this===d?c.promise():this,g?[a]:arguments)})}),a=null}).promise()},promise:function(a){return null!=a?m.extend(a,d):d}},e={};return d.pipe=d.then,m.each(b,function(a,f){var g=f[2],h=f[3];d[f[1]]=g.add,h&&g.add(function(){c=h},b[1^a][2].disable,b[2][2].lock),e[f[0]]=function(){return e[f[0]+"With"](this===e?d:this,arguments),this},e[f[0]+"With"]=g.fireWith}),d.promise(e),a&&a.call(e,e),e},when:function(a){var b=0,c=d.call(arguments),e=c.length,f=1!==e||a&&m.isFunction(a.promise)?e:0,g=1===f?a:m.Deferred(),h=function(a,b,c){return function(e){b[a]=this,c[a]=arguments.length>1?d.call(arguments):e,c===i?g.notifyWith(b,c):--f||g.resolveWith(b,c)}},i,j,k;if(e>1)for(i=new Array(e),j=new Array(e),k=new Array(e);e>b;b++)c[b]&&m.isFunction(c[b].promise)?c[b].promise().done(h(b,k,c)).fail(g.reject).progress(h(b,j,i)):--f;return f||g.resolveWith(k,c),g.promise()}});var H;m.fn.ready=function(a){return m.ready.promise().done(a),this},m.extend({isReady:!1,readyWait:1,holdReady:function(a){a?m.readyWait++:m.ready(!0)},ready:function(a){if(a===!0?!--m.readyWait:!m.isReady){if(!y.body)return setTimeout(m.ready);m.isReady=!0,a!==!0&&--m.readyWait>0||(H.resolveWith(y,[m]),m.fn.triggerHandler&&(m(y).triggerHandler("ready"),m(y).off("ready")))}}});function I(){y.addEventListener?(y.removeEventListener("DOMContentLoaded",J,!1),a.removeEventListener("load",J,!1)):(y.detachEvent("onreadystatechange",J),a.detachEvent("onload",J))}function J(){(y.addEventListener||"load"===event.type||"complete"===y.readyState)&&(I(),m.ready())}m.ready.promise=function(b){if(!H)if(H=m.Deferred(),"complete"===y.readyState)setTimeout(m.ready);else if(y.addEventListener)y.addEventListener("DOMContentLoaded",J,!1),a.addEventListener("load",J,!1);else{y.attachEvent("onreadystatechange",J),a.attachEvent("onload",J);var c=!1;try{c=null==a.frameElement&&y.documentElement}catch(d){}c&&c.doScroll&&!function e(){if(!m.isReady){try{c.doScroll("left")}catch(a){return setTimeout(e,50)}I(),m.ready()}}()}return H.promise(b)};var K="undefined",L;for(L in m(k))break;k.ownLast="0"!==L,k.inlineBlockNeedsLayout=!1,m(function(){var a,b,c,d;c=y.getElementsByTagName("body")[0],c&&c.style&&(b=y.createElement("div"),d=y.createElement("div"),d.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",c.appendChild(d).appendChild(b),typeof b.style.zoom!==K&&(b.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",k.inlineBlockNeedsLayout=a=3===b.offsetWidth,a&&(c.style.zoom=1)),c.removeChild(d))}),function(){var a=y.createElement("div");if(null==k.deleteExpando){k.deleteExpando=!0;try{delete a.test}catch(b){k.deleteExpando=!1}}a=null}(),m.acceptData=function(a){var b=m.noData[(a.nodeName+" ").toLowerCase()],c=+a.nodeType||1;return 1!==c&&9!==c?!1:!b||b!==!0&&a.getAttribute("classid")===b};var M=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,N=/([A-Z])/g;function O(a,b,c){if(void 0===c&&1===a.nodeType){var d="data-"+b.replace(N,"-$1").toLowerCase();if(c=a.getAttribute(d),"string"==typeof c){try{c="true"===c?!0:"false"===c?!1:"null"===c?null:+c+""===c?+c:M.test(c)?m.parseJSON(c):c}catch(e){}m.data(a,b,c)}else c=void 0}return c}function P(a){var b;for(b in a)if(("data"!==b||!m.isEmptyObject(a[b]))&&"toJSON"!==b)return!1;
return!0}function Q(a,b,d,e){if(m.acceptData(a)){var f,g,h=m.expando,i=a.nodeType,j=i?m.cache:a,k=i?a[h]:a[h]&&h;if(k&&j[k]&&(e||j[k].data)||void 0!==d||"string"!=typeof b)return k||(k=i?a[h]=c.pop()||m.guid++:h),j[k]||(j[k]=i?{}:{toJSON:m.noop}),("object"==typeof b||"function"==typeof b)&&(e?j[k]=m.extend(j[k],b):j[k].data=m.extend(j[k].data,b)),g=j[k],e||(g.data||(g.data={}),g=g.data),void 0!==d&&(g[m.camelCase(b)]=d),"string"==typeof b?(f=g[b],null==f&&(f=g[m.camelCase(b)])):f=g,f}}function R(a,b,c){if(m.acceptData(a)){var d,e,f=a.nodeType,g=f?m.cache:a,h=f?a[m.expando]:m.expando;if(g[h]){if(b&&(d=c?g[h]:g[h].data)){m.isArray(b)?b=b.concat(m.map(b,m.camelCase)):b in d?b=[b]:(b=m.camelCase(b),b=b in d?[b]:b.split(" ")),e=b.length;while(e--)delete d[b[e]];if(c?!P(d):!m.isEmptyObject(d))return}(c||(delete g[h].data,P(g[h])))&&(f?m.cleanData([a],!0):k.deleteExpando||g!=g.window?delete g[h]:g[h]=null)}}}m.extend({cache:{},noData:{"applet ":!0,"embed ":!0,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(a){return a=a.nodeType?m.cache[a[m.expando]]:a[m.expando],!!a&&!P(a)},data:function(a,b,c){return Q(a,b,c)},removeData:function(a,b){return R(a,b)},_data:function(a,b,c){return Q(a,b,c,!0)},_removeData:function(a,b){return R(a,b,!0)}}),m.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=m.data(f),1===f.nodeType&&!m._data(f,"parsedAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=m.camelCase(d.slice(5)),O(f,d,e[d])));m._data(f,"parsedAttrs",!0)}return e}return"object"==typeof a?this.each(function(){m.data(this,a)}):arguments.length>1?this.each(function(){m.data(this,a,b)}):f?O(f,a,m.data(f,a)):void 0},removeData:function(a){return this.each(function(){m.removeData(this,a)})}}),m.extend({queue:function(a,b,c){var d;return a?(b=(b||"fx")+"queue",d=m._data(a,b),c&&(!d||m.isArray(c)?d=m._data(a,b,m.makeArray(c)):d.push(c)),d||[]):void 0},dequeue:function(a,b){b=b||"fx";var c=m.queue(a,b),d=c.length,e=c.shift(),f=m._queueHooks(a,b),g=function(){m.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return m._data(a,c)||m._data(a,c,{empty:m.Callbacks("once memory").add(function(){m._removeData(a,b+"queue"),m._removeData(a,c)})})}}),m.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?m.queue(this[0],a):void 0===b?this:this.each(function(){var c=m.queue(this,a,b);m._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&m.dequeue(this,a)})},dequeue:function(a){return this.each(function(){m.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=m.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=m._data(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}});var S=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,T=["Top","Right","Bottom","Left"],U=function(a,b){return a=b||a,"none"===m.css(a,"display")||!m.contains(a.ownerDocument,a)},V=m.access=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===m.type(c)){e=!0;for(h in c)m.access(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,m.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(m(a),c)})),b))for(;i>h;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f},W=/^(?:checkbox|radio)$/i;!function(){var a=y.createElement("input"),b=y.createElement("div"),c=y.createDocumentFragment();if(b.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",k.leadingWhitespace=3===b.firstChild.nodeType,k.tbody=!b.getElementsByTagName("tbody").length,k.htmlSerialize=!!b.getElementsByTagName("link").length,k.html5Clone="<:nav></:nav>"!==y.createElement("nav").cloneNode(!0).outerHTML,a.type="checkbox",a.checked=!0,c.appendChild(a),k.appendChecked=a.checked,b.innerHTML="<textarea>x</textarea>",k.noCloneChecked=!!b.cloneNode(!0).lastChild.defaultValue,c.appendChild(b),b.innerHTML="<input type='radio' checked='checked' name='t'/>",k.checkClone=b.cloneNode(!0).cloneNode(!0).lastChild.checked,k.noCloneEvent=!0,b.attachEvent&&(b.attachEvent("onclick",function(){k.noCloneEvent=!1}),b.cloneNode(!0).click()),null==k.deleteExpando){k.deleteExpando=!0;try{delete b.test}catch(d){k.deleteExpando=!1}}}(),function(){var b,c,d=y.createElement("div");for(b in{submit:!0,change:!0,focusin:!0})c="on"+b,(k[b+"Bubbles"]=c in a)||(d.setAttribute(c,"t"),k[b+"Bubbles"]=d.attributes[c].expando===!1);d=null}();var X=/^(?:input|select|textarea)$/i,Y=/^key/,Z=/^(?:mouse|pointer|contextmenu)|click/,$=/^(?:focusinfocus|focusoutblur)$/,_=/^([^.]*)(?:\.(.+)|)$/;function ab(){return!0}function bb(){return!1}function cb(){try{return y.activeElement}catch(a){}}m.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,n,o,p,q,r=m._data(a);if(r){c.handler&&(i=c,c=i.handler,e=i.selector),c.guid||(c.guid=m.guid++),(g=r.events)||(g=r.events={}),(k=r.handle)||(k=r.handle=function(a){return typeof m===K||a&&m.event.triggered===a.type?void 0:m.event.dispatch.apply(k.elem,arguments)},k.elem=a),b=(b||"").match(E)||[""],h=b.length;while(h--)f=_.exec(b[h])||[],o=q=f[1],p=(f[2]||"").split(".").sort(),o&&(j=m.event.special[o]||{},o=(e?j.delegateType:j.bindType)||o,j=m.event.special[o]||{},l=m.extend({type:o,origType:q,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&m.expr.match.needsContext.test(e),namespace:p.join(".")},i),(n=g[o])||(n=g[o]=[],n.delegateCount=0,j.setup&&j.setup.call(a,d,p,k)!==!1||(a.addEventListener?a.addEventListener(o,k,!1):a.attachEvent&&a.attachEvent("on"+o,k))),j.add&&(j.add.call(a,l),l.handler.guid||(l.handler.guid=c.guid)),e?n.splice(n.delegateCount++,0,l):n.push(l),m.event.global[o]=!0);a=null}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,n,o,p,q,r=m.hasData(a)&&m._data(a);if(r&&(k=r.events)){b=(b||"").match(E)||[""],j=b.length;while(j--)if(h=_.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o){l=m.event.special[o]||{},o=(d?l.delegateType:l.bindType)||o,n=k[o]||[],h=h[2]&&new RegExp("(^|\\.)"+p.join("\\.(?:.*\\.|)")+"(\\.|$)"),i=f=n.length;while(f--)g=n[f],!e&&q!==g.origType||c&&c.guid!==g.guid||h&&!h.test(g.namespace)||d&&d!==g.selector&&("**"!==d||!g.selector)||(n.splice(f,1),g.selector&&n.delegateCount--,l.remove&&l.remove.call(a,g));i&&!n.length&&(l.teardown&&l.teardown.call(a,p,r.handle)!==!1||m.removeEvent(a,o,r.handle),delete k[o])}else for(o in k)m.event.remove(a,o+b[j],c,d,!0);m.isEmptyObject(k)&&(delete r.handle,m._removeData(a,"events"))}},trigger:function(b,c,d,e){var f,g,h,i,k,l,n,o=[d||y],p=j.call(b,"type")?b.type:b,q=j.call(b,"namespace")?b.namespace.split("."):[];if(h=l=d=d||y,3!==d.nodeType&&8!==d.nodeType&&!$.test(p+m.event.triggered)&&(p.indexOf(".")>=0&&(q=p.split("."),p=q.shift(),q.sort()),g=p.indexOf(":")<0&&"on"+p,b=b[m.expando]?b:new m.Event(p,"object"==typeof b&&b),b.isTrigger=e?2:3,b.namespace=q.join("."),b.namespace_re=b.namespace?new RegExp("(^|\\.)"+q.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=d),c=null==c?[b]:m.makeArray(c,[b]),k=m.event.special[p]||{},e||!k.trigger||k.trigger.apply(d,c)!==!1)){if(!e&&!k.noBubble&&!m.isWindow(d)){for(i=k.delegateType||p,$.test(i+p)||(h=h.parentNode);h;h=h.parentNode)o.push(h),l=h;l===(d.ownerDocument||y)&&o.push(l.defaultView||l.parentWindow||a)}n=0;while((h=o[n++])&&!b.isPropagationStopped())b.type=n>1?i:k.bindType||p,f=(m._data(h,"events")||{})[b.type]&&m._data(h,"handle"),f&&f.apply(h,c),f=g&&h[g],f&&f.apply&&m.acceptData(h)&&(b.result=f.apply(h,c),b.result===!1&&b.preventDefault());if(b.type=p,!e&&!b.isDefaultPrevented()&&(!k._default||k._default.apply(o.pop(),c)===!1)&&m.acceptData(d)&&g&&d[p]&&!m.isWindow(d)){l=d[g],l&&(d[g]=null),m.event.triggered=p;try{d[p]()}catch(r){}m.event.triggered=void 0,l&&(d[g]=l)}return b.result}},dispatch:function(a){a=m.event.fix(a);var b,c,e,f,g,h=[],i=d.call(arguments),j=(m._data(this,"events")||{})[a.type]||[],k=m.event.special[a.type]||{};if(i[0]=a,a.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,a)!==!1){h=m.event.handlers.call(this,a,j),b=0;while((f=h[b++])&&!a.isPropagationStopped()){a.currentTarget=f.elem,g=0;while((e=f.handlers[g++])&&!a.isImmediatePropagationStopped())(!a.namespace_re||a.namespace_re.test(e.namespace))&&(a.handleObj=e,a.data=e.data,c=((m.event.special[e.origType]||{}).handle||e.handler).apply(f.elem,i),void 0!==c&&(a.result=c)===!1&&(a.preventDefault(),a.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,a),a.result}},handlers:function(a,b){var c,d,e,f,g=[],h=b.delegateCount,i=a.target;if(h&&i.nodeType&&(!a.button||"click"!==a.type))for(;i!=this;i=i.parentNode||this)if(1===i.nodeType&&(i.disabled!==!0||"click"!==a.type)){for(e=[],f=0;h>f;f++)d=b[f],c=d.selector+" ",void 0===e[c]&&(e[c]=d.needsContext?m(c,this).index(i)>=0:m.find(c,this,null,[i]).length),e[c]&&e.push(d);e.length&&g.push({elem:i,handlers:e})}return h<b.length&&g.push({elem:this,handlers:b.slice(h)}),g},fix:function(a){if(a[m.expando])return a;var b,c,d,e=a.type,f=a,g=this.fixHooks[e];g||(this.fixHooks[e]=g=Z.test(e)?this.mouseHooks:Y.test(e)?this.keyHooks:{}),d=g.props?this.props.concat(g.props):this.props,a=new m.Event(f),b=d.length;while(b--)c=d[b],a[c]=f[c];return a.target||(a.target=f.srcElement||y),3===a.target.nodeType&&(a.target=a.target.parentNode),a.metaKey=!!a.metaKey,g.filter?g.filter(a,f):a},props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){return null==a.which&&(a.which=null!=b.charCode?b.charCode:b.keyCode),a}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,b){var c,d,e,f=b.button,g=b.fromElement;return null==a.pageX&&null!=b.clientX&&(d=a.target.ownerDocument||y,e=d.documentElement,c=d.body,a.pageX=b.clientX+(e&&e.scrollLeft||c&&c.scrollLeft||0)-(e&&e.clientLeft||c&&c.clientLeft||0),a.pageY=b.clientY+(e&&e.scrollTop||c&&c.scrollTop||0)-(e&&e.clientTop||c&&c.clientTop||0)),!a.relatedTarget&&g&&(a.relatedTarget=g===a.target?b.toElement:g),a.which||void 0===f||(a.which=1&f?1:2&f?3:4&f?2:0),a}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==cb()&&this.focus)try{return this.focus(),!1}catch(a){}},delegateType:"focusin"},blur:{trigger:function(){return this===cb()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return m.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):void 0},_default:function(a){return m.nodeName(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}},simulate:function(a,b,c,d){var e=m.extend(new m.Event,c,{type:a,isSimulated:!0,originalEvent:{}});d?m.event.trigger(e,null,b):m.event.dispatch.call(b,e),e.isDefaultPrevented()&&c.preventDefault()}},m.removeEvent=y.removeEventListener?function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c,!1)}:function(a,b,c){var d="on"+b;a.detachEvent&&(typeof a[d]===K&&(a[d]=null),a.detachEvent(d,c))},m.Event=function(a,b){return this instanceof m.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?ab:bb):this.type=a,b&&m.extend(this,b),this.timeStamp=a&&a.timeStamp||m.now(),void(this[m.expando]=!0)):new m.Event(a,b)},m.Event.prototype={isDefaultPrevented:bb,isPropagationStopped:bb,isImmediatePropagationStopped:bb,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=ab,a&&(a.preventDefault?a.preventDefault():a.returnValue=!1)},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=ab,a&&(a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=ab,a&&a.stopImmediatePropagation&&a.stopImmediatePropagation(),this.stopPropagation()}},m.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){m.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return(!e||e!==d&&!m.contains(d,e))&&(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),k.submitBubbles||(m.event.special.submit={setup:function(){return m.nodeName(this,"form")?!1:void m.event.add(this,"click._submit keypress._submit",function(a){var b=a.target,c=m.nodeName(b,"input")||m.nodeName(b,"button")?b.form:void 0;c&&!m._data(c,"submitBubbles")&&(m.event.add(c,"submit._submit",function(a){a._submit_bubble=!0}),m._data(c,"submitBubbles",!0))})},postDispatch:function(a){a._submit_bubble&&(delete a._submit_bubble,this.parentNode&&!a.isTrigger&&m.event.simulate("submit",this.parentNode,a,!0))},teardown:function(){return m.nodeName(this,"form")?!1:void m.event.remove(this,"._submit")}}),k.changeBubbles||(m.event.special.change={setup:function(){return X.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(m.event.add(this,"propertychange._change",function(a){"checked"===a.originalEvent.propertyName&&(this._just_changed=!0)}),m.event.add(this,"click._change",function(a){this._just_changed&&!a.isTrigger&&(this._just_changed=!1),m.event.simulate("change",this,a,!0)})),!1):void m.event.add(this,"beforeactivate._change",function(a){var b=a.target;X.test(b.nodeName)&&!m._data(b,"changeBubbles")&&(m.event.add(b,"change._change",function(a){!this.parentNode||a.isSimulated||a.isTrigger||m.event.simulate("change",this.parentNode,a,!0)}),m._data(b,"changeBubbles",!0))})},handle:function(a){var b=a.target;return this!==b||a.isSimulated||a.isTrigger||"radio"!==b.type&&"checkbox"!==b.type?a.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return m.event.remove(this,"._change"),!X.test(this.nodeName)}}),k.focusinBubbles||m.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){m.event.simulate(b,a.target,m.event.fix(a),!0)};m.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=m._data(d,b);e||d.addEventListener(a,c,!0),m._data(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=m._data(d,b)-1;e?m._data(d,b,e):(d.removeEventListener(a,c,!0),m._removeData(d,b))}}}),m.fn.extend({on:function(a,b,c,d,e){var f,g;if("object"==typeof a){"string"!=typeof b&&(c=c||b,b=void 0);for(f in a)this.on(f,b,c,a[f],e);return this}if(null==c&&null==d?(d=b,c=b=void 0):null==d&&("string"==typeof b?(d=c,c=void 0):(d=c,c=b,b=void 0)),d===!1)d=bb;else if(!d)return this;return 1===e&&(g=d,d=function(a){return m().off(a),g.apply(this,arguments)},d.guid=g.guid||(g.guid=m.guid++)),this.each(function(){m.event.add(this,a,d,c,b)})},one:function(a,b,c,d){return this.on(a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,m(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return(b===!1||"function"==typeof b)&&(c=b,b=void 0),c===!1&&(c=bb),this.each(function(){m.event.remove(this,a,c,b)})},trigger:function(a,b){return this.each(function(){m.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];return c?m.event.trigger(a,b,c,!0):void 0}});function db(a){var b=eb.split("|"),c=a.createDocumentFragment();if(c.createElement)while(b.length)c.createElement(b.pop());return c}var eb="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",fb=/ jQuery\d+="(?:null|\d+)"/g,gb=new RegExp("<(?:"+eb+")[\\s/>]","i"),hb=/^\s+/,ib=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,jb=/<([\w:]+)/,kb=/<tbody/i,lb=/<|&#?\w+;/,mb=/<(?:script|style|link)/i,nb=/checked\s*(?:[^=]|=\s*.checked.)/i,ob=/^$|\/(?:java|ecma)script/i,pb=/^true\/(.*)/,qb=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,rb={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:k.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]},sb=db(y),tb=sb.appendChild(y.createElement("div"));rb.optgroup=rb.option,rb.tbody=rb.tfoot=rb.colgroup=rb.caption=rb.thead,rb.th=rb.td;function ub(a,b){var c,d,e=0,f=typeof a.getElementsByTagName!==K?a.getElementsByTagName(b||"*"):typeof a.querySelectorAll!==K?a.querySelectorAll(b||"*"):void 0;if(!f)for(f=[],c=a.childNodes||a;null!=(d=c[e]);e++)!b||m.nodeName(d,b)?f.push(d):m.merge(f,ub(d,b));return void 0===b||b&&m.nodeName(a,b)?m.merge([a],f):f}function vb(a){W.test(a.type)&&(a.defaultChecked=a.checked)}function wb(a,b){return m.nodeName(a,"table")&&m.nodeName(11!==b.nodeType?b:b.firstChild,"tr")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function xb(a){return a.type=(null!==m.find.attr(a,"type"))+"/"+a.type,a}function yb(a){var b=pb.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function zb(a,b){for(var c,d=0;null!=(c=a[d]);d++)m._data(c,"globalEval",!b||m._data(b[d],"globalEval"))}function Ab(a,b){if(1===b.nodeType&&m.hasData(a)){var c,d,e,f=m._data(a),g=m._data(b,f),h=f.events;if(h){delete g.handle,g.events={};for(c in h)for(d=0,e=h[c].length;e>d;d++)m.event.add(b,c,h[c][d])}g.data&&(g.data=m.extend({},g.data))}}function Bb(a,b){var c,d,e;if(1===b.nodeType){if(c=b.nodeName.toLowerCase(),!k.noCloneEvent&&b[m.expando]){e=m._data(b);for(d in e.events)m.removeEvent(b,d,e.handle);b.removeAttribute(m.expando)}"script"===c&&b.text!==a.text?(xb(b).text=a.text,yb(b)):"object"===c?(b.parentNode&&(b.outerHTML=a.outerHTML),k.html5Clone&&a.innerHTML&&!m.trim(b.innerHTML)&&(b.innerHTML=a.innerHTML)):"input"===c&&W.test(a.type)?(b.defaultChecked=b.checked=a.checked,b.value!==a.value&&(b.value=a.value)):"option"===c?b.defaultSelected=b.selected=a.defaultSelected:("input"===c||"textarea"===c)&&(b.defaultValue=a.defaultValue)}}m.extend({clone:function(a,b,c){var d,e,f,g,h,i=m.contains(a.ownerDocument,a);if(k.html5Clone||m.isXMLDoc(a)||!gb.test("<"+a.nodeName+">")?f=a.cloneNode(!0):(tb.innerHTML=a.outerHTML,tb.removeChild(f=tb.firstChild)),!(k.noCloneEvent&&k.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||m.isXMLDoc(a)))for(d=ub(f),h=ub(a),g=0;null!=(e=h[g]);++g)d[g]&&Bb(e,d[g]);if(b)if(c)for(h=h||ub(a),d=d||ub(f),g=0;null!=(e=h[g]);g++)Ab(e,d[g]);else Ab(a,f);return d=ub(f,"script"),d.length>0&&zb(d,!i&&ub(a,"script")),d=h=e=null,f},buildFragment:function(a,b,c,d){for(var e,f,g,h,i,j,l,n=a.length,o=db(b),p=[],q=0;n>q;q++)if(f=a[q],f||0===f)if("object"===m.type(f))m.merge(p,f.nodeType?[f]:f);else if(lb.test(f)){h=h||o.appendChild(b.createElement("div")),i=(jb.exec(f)||["",""])[1].toLowerCase(),l=rb[i]||rb._default,h.innerHTML=l[1]+f.replace(ib,"<$1></$2>")+l[2],e=l[0];while(e--)h=h.lastChild;if(!k.leadingWhitespace&&hb.test(f)&&p.push(b.createTextNode(hb.exec(f)[0])),!k.tbody){f="table"!==i||kb.test(f)?"<table>"!==l[1]||kb.test(f)?0:h:h.firstChild,e=f&&f.childNodes.length;while(e--)m.nodeName(j=f.childNodes[e],"tbody")&&!j.childNodes.length&&f.removeChild(j)}m.merge(p,h.childNodes),h.textContent="";while(h.firstChild)h.removeChild(h.firstChild);h=o.lastChild}else p.push(b.createTextNode(f));h&&o.removeChild(h),k.appendChecked||m.grep(ub(p,"input"),vb),q=0;while(f=p[q++])if((!d||-1===m.inArray(f,d))&&(g=m.contains(f.ownerDocument,f),h=ub(o.appendChild(f),"script"),g&&zb(h),c)){e=0;while(f=h[e++])ob.test(f.type||"")&&c.push(f)}return h=null,o},cleanData:function(a,b){for(var d,e,f,g,h=0,i=m.expando,j=m.cache,l=k.deleteExpando,n=m.event.special;null!=(d=a[h]);h++)if((b||m.acceptData(d))&&(f=d[i],g=f&&j[f])){if(g.events)for(e in g.events)n[e]?m.event.remove(d,e):m.removeEvent(d,e,g.handle);j[f]&&(delete j[f],l?delete d[i]:typeof d.removeAttribute!==K?d.removeAttribute(i):d[i]=null,c.push(f))}}}),m.fn.extend({text:function(a){return V(this,function(a){return void 0===a?m.text(this):this.empty().append((this[0]&&this[0].ownerDocument||y).createTextNode(a))},null,a,arguments.length)},append:function(){return this.domManip(arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=wb(this,a);b.appendChild(a)}})},prepend:function(){return this.domManip(arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=wb(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return this.domManip(arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return this.domManip(arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},remove:function(a,b){for(var c,d=a?m.filter(a,this):this,e=0;null!=(c=d[e]);e++)b||1!==c.nodeType||m.cleanData(ub(c)),c.parentNode&&(b&&m.contains(c.ownerDocument,c)&&zb(ub(c,"script")),c.parentNode.removeChild(c));return this},empty:function(){for(var a,b=0;null!=(a=this[b]);b++){1===a.nodeType&&m.cleanData(ub(a,!1));while(a.firstChild)a.removeChild(a.firstChild);a.options&&m.nodeName(a,"select")&&(a.options.length=0)}return this},clone:function(a,b){return a=null==a?!1:a,b=null==b?a:b,this.map(function(){return m.clone(this,a,b)})},html:function(a){return V(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a)return 1===b.nodeType?b.innerHTML.replace(fb,""):void 0;if(!("string"!=typeof a||mb.test(a)||!k.htmlSerialize&&gb.test(a)||!k.leadingWhitespace&&hb.test(a)||rb[(jb.exec(a)||["",""])[1].toLowerCase()])){a=a.replace(ib,"<$1></$2>");try{for(;d>c;c++)b=this[c]||{},1===b.nodeType&&(m.cleanData(ub(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=arguments[0];return this.domManip(arguments,function(b){a=this.parentNode,m.cleanData(ub(this)),a&&a.replaceChild(b,this)}),a&&(a.length||a.nodeType)?this:this.remove()},detach:function(a){return this.remove(a,!0)},domManip:function(a,b){a=e.apply([],a);var c,d,f,g,h,i,j=0,l=this.length,n=this,o=l-1,p=a[0],q=m.isFunction(p);if(q||l>1&&"string"==typeof p&&!k.checkClone&&nb.test(p))return this.each(function(c){var d=n.eq(c);q&&(a[0]=p.call(this,c,d.html())),d.domManip(a,b)});if(l&&(i=m.buildFragment(a,this[0].ownerDocument,!1,this),c=i.firstChild,1===i.childNodes.length&&(i=c),c)){for(g=m.map(ub(i,"script"),xb),f=g.length;l>j;j++)d=i,j!==o&&(d=m.clone(d,!0,!0),f&&m.merge(g,ub(d,"script"))),b.call(this[j],d,j);if(f)for(h=g[g.length-1].ownerDocument,m.map(g,yb),j=0;f>j;j++)d=g[j],ob.test(d.type||"")&&!m._data(d,"globalEval")&&m.contains(h,d)&&(d.src?m._evalUrl&&m._evalUrl(d.src):m.globalEval((d.text||d.textContent||d.innerHTML||"").replace(qb,"")));i=c=null}return this}}),m.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){m.fn[a]=function(a){for(var c,d=0,e=[],g=m(a),h=g.length-1;h>=d;d++)c=d===h?this:this.clone(!0),m(g[d])[b](c),f.apply(e,c.get());return this.pushStack(e)}});var Cb,Db={};function Eb(b,c){var d,e=m(c.createElement(b)).appendTo(c.body),f=a.getDefaultComputedStyle&&(d=a.getDefaultComputedStyle(e[0]))?d.display:m.css(e[0],"display");return e.detach(),f}function Fb(a){var b=y,c=Db[a];return c||(c=Eb(a,b),"none"!==c&&c||(Cb=(Cb||m("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement),b=(Cb[0].contentWindow||Cb[0].contentDocument).document,b.write(),b.close(),c=Eb(a,b),Cb.detach()),Db[a]=c),c}!function(){var a;k.shrinkWrapBlocks=function(){if(null!=a)return a;a=!1;var b,c,d;return c=y.getElementsByTagName("body")[0],c&&c.style?(b=y.createElement("div"),d=y.createElement("div"),d.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",c.appendChild(d).appendChild(b),typeof b.style.zoom!==K&&(b.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",b.appendChild(y.createElement("div")).style.width="5px",a=3!==b.offsetWidth),c.removeChild(d),a):void 0}}();var Gb=/^margin/,Hb=new RegExp("^("+S+")(?!px)[a-z%]+$","i"),Ib,Jb,Kb=/^(top|right|bottom|left)$/;a.getComputedStyle?(Ib=function(b){return b.ownerDocument.defaultView.opener?b.ownerDocument.defaultView.getComputedStyle(b,null):a.getComputedStyle(b,null)},Jb=function(a,b,c){var d,e,f,g,h=a.style;return c=c||Ib(a),g=c?c.getPropertyValue(b)||c[b]:void 0,c&&(""!==g||m.contains(a.ownerDocument,a)||(g=m.style(a,b)),Hb.test(g)&&Gb.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f)),void 0===g?g:g+""}):y.documentElement.currentStyle&&(Ib=function(a){return a.currentStyle},Jb=function(a,b,c){var d,e,f,g,h=a.style;return c=c||Ib(a),g=c?c[b]:void 0,null==g&&h&&h[b]&&(g=h[b]),Hb.test(g)&&!Kb.test(b)&&(d=h.left,e=a.runtimeStyle,f=e&&e.left,f&&(e.left=a.currentStyle.left),h.left="fontSize"===b?"1em":g,g=h.pixelLeft+"px",h.left=d,f&&(e.left=f)),void 0===g?g:g+""||"auto"});function Lb(a,b){return{get:function(){var c=a();if(null!=c)return c?void delete this.get:(this.get=b).apply(this,arguments)}}}!function(){var b,c,d,e,f,g,h;if(b=y.createElement("div"),b.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",d=b.getElementsByTagName("a")[0],c=d&&d.style){c.cssText="float:left;opacity:.5",k.opacity="0.5"===c.opacity,k.cssFloat=!!c.cssFloat,b.style.backgroundClip="content-box",b.cloneNode(!0).style.backgroundClip="",k.clearCloneStyle="content-box"===b.style.backgroundClip,k.boxSizing=""===c.boxSizing||""===c.MozBoxSizing||""===c.WebkitBoxSizing,m.extend(k,{reliableHiddenOffsets:function(){return null==g&&i(),g},boxSizingReliable:function(){return null==f&&i(),f},pixelPosition:function(){return null==e&&i(),e},reliableMarginRight:function(){return null==h&&i(),h}});function i(){var b,c,d,i;c=y.getElementsByTagName("body")[0],c&&c.style&&(b=y.createElement("div"),d=y.createElement("div"),d.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",c.appendChild(d).appendChild(b),b.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",e=f=!1,h=!0,a.getComputedStyle&&(e="1%"!==(a.getComputedStyle(b,null)||{}).top,f="4px"===(a.getComputedStyle(b,null)||{width:"4px"}).width,i=b.appendChild(y.createElement("div")),i.style.cssText=b.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",i.style.marginRight=i.style.width="0",b.style.width="1px",h=!parseFloat((a.getComputedStyle(i,null)||{}).marginRight),b.removeChild(i)),b.innerHTML="<table><tr><td></td><td>t</td></tr></table>",i=b.getElementsByTagName("td"),i[0].style.cssText="margin:0;border:0;padding:0;display:none",g=0===i[0].offsetHeight,g&&(i[0].style.display="",i[1].style.display="none",g=0===i[0].offsetHeight),c.removeChild(d))}}}(),m.swap=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e};var Mb=/alpha\([^)]*\)/i,Nb=/opacity\s*=\s*([^)]*)/,Ob=/^(none|table(?!-c[ea]).+)/,Pb=new RegExp("^("+S+")(.*)$","i"),Qb=new RegExp("^([+-])=("+S+")","i"),Rb={position:"absolute",visibility:"hidden",display:"block"},Sb={letterSpacing:"0",fontWeight:"400"},Tb=["Webkit","O","Moz","ms"];function Ub(a,b){if(b in a)return b;var c=b.charAt(0).toUpperCase()+b.slice(1),d=b,e=Tb.length;while(e--)if(b=Tb[e]+c,b in a)return b;return d}function Vb(a,b){for(var c,d,e,f=[],g=0,h=a.length;h>g;g++)d=a[g],d.style&&(f[g]=m._data(d,"olddisplay"),c=d.style.display,b?(f[g]||"none"!==c||(d.style.display=""),""===d.style.display&&U(d)&&(f[g]=m._data(d,"olddisplay",Fb(d.nodeName)))):(e=U(d),(c&&"none"!==c||!e)&&m._data(d,"olddisplay",e?c:m.css(d,"display"))));for(g=0;h>g;g++)d=a[g],d.style&&(b&&"none"!==d.style.display&&""!==d.style.display||(d.style.display=b?f[g]||"":"none"));return a}function Wb(a,b,c){var d=Pb.exec(b);return d?Math.max(0,d[1]-(c||0))+(d[2]||"px"):b}function Xb(a,b,c,d,e){for(var f=c===(d?"border":"content")?4:"width"===b?1:0,g=0;4>f;f+=2)"margin"===c&&(g+=m.css(a,c+T[f],!0,e)),d?("content"===c&&(g-=m.css(a,"padding"+T[f],!0,e)),"margin"!==c&&(g-=m.css(a,"border"+T[f]+"Width",!0,e))):(g+=m.css(a,"padding"+T[f],!0,e),"padding"!==c&&(g+=m.css(a,"border"+T[f]+"Width",!0,e)));return g}function Yb(a,b,c){var d=!0,e="width"===b?a.offsetWidth:a.offsetHeight,f=Ib(a),g=k.boxSizing&&"border-box"===m.css(a,"boxSizing",!1,f);if(0>=e||null==e){if(e=Jb(a,b,f),(0>e||null==e)&&(e=a.style[b]),Hb.test(e))return e;d=g&&(k.boxSizingReliable()||e===a.style[b]),e=parseFloat(e)||0}return e+Xb(a,b,c||(g?"border":"content"),d,f)+"px"}m.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=Jb(a,"opacity");return""===c?"1":c}}}},cssNumber:{columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":k.cssFloat?"cssFloat":"styleFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=m.camelCase(b),i=a.style;if(b=m.cssProps[h]||(m.cssProps[h]=Ub(i,h)),g=m.cssHooks[b]||m.cssHooks[h],void 0===c)return g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:i[b];if(f=typeof c,"string"===f&&(e=Qb.exec(c))&&(c=(e[1]+1)*e[2]+parseFloat(m.css(a,b)),f="number"),null!=c&&c===c&&("number"!==f||m.cssNumber[h]||(c+="px"),k.clearCloneStyle||""!==c||0!==b.indexOf("background")||(i[b]="inherit"),!(g&&"set"in g&&void 0===(c=g.set(a,c,d)))))try{i[b]=c}catch(j){}}},css:function(a,b,c,d){var e,f,g,h=m.camelCase(b);return b=m.cssProps[h]||(m.cssProps[h]=Ub(a.style,h)),g=m.cssHooks[b]||m.cssHooks[h],g&&"get"in g&&(f=g.get(a,!0,c)),void 0===f&&(f=Jb(a,b,d)),"normal"===f&&b in Sb&&(f=Sb[b]),""===c||c?(e=parseFloat(f),c===!0||m.isNumeric(e)?e||0:f):f}}),m.each(["height","width"],function(a,b){m.cssHooks[b]={get:function(a,c,d){return c?Ob.test(m.css(a,"display"))&&0===a.offsetWidth?m.swap(a,Rb,function(){return Yb(a,b,d)}):Yb(a,b,d):void 0},set:function(a,c,d){var e=d&&Ib(a);return Wb(a,c,d?Xb(a,b,d,k.boxSizing&&"border-box"===m.css(a,"boxSizing",!1,e),e):0)}}}),k.opacity||(m.cssHooks.opacity={get:function(a,b){return Nb.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":b?"1":""},set:function(a,b){var c=a.style,d=a.currentStyle,e=m.isNumeric(b)?"alpha(opacity="+100*b+")":"",f=d&&d.filter||c.filter||"";c.zoom=1,(b>=1||""===b)&&""===m.trim(f.replace(Mb,""))&&c.removeAttribute&&(c.removeAttribute("filter"),""===b||d&&!d.filter)||(c.filter=Mb.test(f)?f.replace(Mb,e):f+" "+e)}}),m.cssHooks.marginRight=Lb(k.reliableMarginRight,function(a,b){return b?m.swap(a,{display:"inline-block"},Jb,[a,"marginRight"]):void 0}),m.each({margin:"",padding:"",border:"Width"},function(a,b){m.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];4>d;d++)e[a+T[d]+b]=f[d]||f[d-2]||f[0];return e}},Gb.test(a)||(m.cssHooks[a+b].set=Wb)}),m.fn.extend({css:function(a,b){return V(this,function(a,b,c){var d,e,f={},g=0;if(m.isArray(b)){for(d=Ib(a),e=b.length;e>g;g++)f[b[g]]=m.css(a,b[g],!1,d);return f}return void 0!==c?m.style(a,b,c):m.css(a,b)},a,b,arguments.length>1)},show:function(){return Vb(this,!0)},hide:function(){return Vb(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){U(this)?m(this).show():m(this).hide()})}});function Zb(a,b,c,d,e){return new Zb.prototype.init(a,b,c,d,e)
}m.Tween=Zb,Zb.prototype={constructor:Zb,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||"swing",this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(m.cssNumber[c]?"":"px")},cur:function(){var a=Zb.propHooks[this.prop];return a&&a.get?a.get(this):Zb.propHooks._default.get(this)},run:function(a){var b,c=Zb.propHooks[this.prop];return this.pos=b=this.options.duration?m.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):Zb.propHooks._default.set(this),this}},Zb.prototype.init.prototype=Zb.prototype,Zb.propHooks={_default:{get:function(a){var b;return null==a.elem[a.prop]||a.elem.style&&null!=a.elem.style[a.prop]?(b=m.css(a.elem,a.prop,""),b&&"auto"!==b?b:0):a.elem[a.prop]},set:function(a){m.fx.step[a.prop]?m.fx.step[a.prop](a):a.elem.style&&(null!=a.elem.style[m.cssProps[a.prop]]||m.cssHooks[a.prop])?m.style(a.elem,a.prop,a.now+a.unit):a.elem[a.prop]=a.now}}},Zb.propHooks.scrollTop=Zb.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},m.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2}},m.fx=Zb.prototype.init,m.fx.step={};var $b,_b,ac=/^(?:toggle|show|hide)$/,bc=new RegExp("^(?:([+-])=|)("+S+")([a-z%]*)$","i"),cc=/queueHooks$/,dc=[ic],ec={"*":[function(a,b){var c=this.createTween(a,b),d=c.cur(),e=bc.exec(b),f=e&&e[3]||(m.cssNumber[a]?"":"px"),g=(m.cssNumber[a]||"px"!==f&&+d)&&bc.exec(m.css(c.elem,a)),h=1,i=20;if(g&&g[3]!==f){f=f||g[3],e=e||[],g=+d||1;do h=h||".5",g/=h,m.style(c.elem,a,g+f);while(h!==(h=c.cur()/d)&&1!==h&&--i)}return e&&(g=c.start=+g||+d||0,c.unit=f,c.end=e[1]?g+(e[1]+1)*e[2]:+e[2]),c}]};function fc(){return setTimeout(function(){$b=void 0}),$b=m.now()}function gc(a,b){var c,d={height:a},e=0;for(b=b?1:0;4>e;e+=2-b)c=T[e],d["margin"+c]=d["padding"+c]=a;return b&&(d.opacity=d.width=a),d}function hc(a,b,c){for(var d,e=(ec[b]||[]).concat(ec["*"]),f=0,g=e.length;g>f;f++)if(d=e[f].call(c,b,a))return d}function ic(a,b,c){var d,e,f,g,h,i,j,l,n=this,o={},p=a.style,q=a.nodeType&&U(a),r=m._data(a,"fxshow");c.queue||(h=m._queueHooks(a,"fx"),null==h.unqueued&&(h.unqueued=0,i=h.empty.fire,h.empty.fire=function(){h.unqueued||i()}),h.unqueued++,n.always(function(){n.always(function(){h.unqueued--,m.queue(a,"fx").length||h.empty.fire()})})),1===a.nodeType&&("height"in b||"width"in b)&&(c.overflow=[p.overflow,p.overflowX,p.overflowY],j=m.css(a,"display"),l="none"===j?m._data(a,"olddisplay")||Fb(a.nodeName):j,"inline"===l&&"none"===m.css(a,"float")&&(k.inlineBlockNeedsLayout&&"inline"!==Fb(a.nodeName)?p.zoom=1:p.display="inline-block")),c.overflow&&(p.overflow="hidden",k.shrinkWrapBlocks()||n.always(function(){p.overflow=c.overflow[0],p.overflowX=c.overflow[1],p.overflowY=c.overflow[2]}));for(d in b)if(e=b[d],ac.exec(e)){if(delete b[d],f=f||"toggle"===e,e===(q?"hide":"show")){if("show"!==e||!r||void 0===r[d])continue;q=!0}o[d]=r&&r[d]||m.style(a,d)}else j=void 0;if(m.isEmptyObject(o))"inline"===("none"===j?Fb(a.nodeName):j)&&(p.display=j);else{r?"hidden"in r&&(q=r.hidden):r=m._data(a,"fxshow",{}),f&&(r.hidden=!q),q?m(a).show():n.done(function(){m(a).hide()}),n.done(function(){var b;m._removeData(a,"fxshow");for(b in o)m.style(a,b,o[b])});for(d in o)g=hc(q?r[d]:0,d,n),d in r||(r[d]=g.start,q&&(g.end=g.start,g.start="width"===d||"height"===d?1:0))}}function jc(a,b){var c,d,e,f,g;for(c in a)if(d=m.camelCase(c),e=b[d],f=a[c],m.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=m.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function kc(a,b,c){var d,e,f=0,g=dc.length,h=m.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=$b||fc(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;i>g;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),1>f&&i?c:(h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:m.extend({},b),opts:m.extend(!0,{specialEasing:{}},c),originalProperties:b,originalOptions:c,startTime:$b||fc(),duration:c.duration,tweens:[],createTween:function(b,c){var d=m.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;d>c;c++)j.tweens[c].run(1);return b?h.resolveWith(a,[j,b]):h.rejectWith(a,[j,b]),this}}),k=j.props;for(jc(k,j.opts.specialEasing);g>f;f++)if(d=dc[f].call(j,a,k,j.opts))return d;return m.map(k,hc,j),m.isFunction(j.opts.start)&&j.opts.start.call(a,j),m.fx.timer(m.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always)}m.Animation=m.extend(kc,{tweener:function(a,b){m.isFunction(a)?(b=a,a=["*"]):a=a.split(" ");for(var c,d=0,e=a.length;e>d;d++)c=a[d],ec[c]=ec[c]||[],ec[c].unshift(b)},prefilter:function(a,b){b?dc.unshift(a):dc.push(a)}}),m.speed=function(a,b,c){var d=a&&"object"==typeof a?m.extend({},a):{complete:c||!c&&b||m.isFunction(a)&&a,duration:a,easing:c&&b||b&&!m.isFunction(b)&&b};return d.duration=m.fx.off?0:"number"==typeof d.duration?d.duration:d.duration in m.fx.speeds?m.fx.speeds[d.duration]:m.fx.speeds._default,(null==d.queue||d.queue===!0)&&(d.queue="fx"),d.old=d.complete,d.complete=function(){m.isFunction(d.old)&&d.old.call(this),d.queue&&m.dequeue(this,d.queue)},d},m.fn.extend({fadeTo:function(a,b,c,d){return this.filter(U).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=m.isEmptyObject(a),f=m.speed(b,c,d),g=function(){var b=kc(this,m.extend({},a),f);(e||m._data(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=m.timers,g=m._data(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&cc.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));(b||!c)&&m.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=m._data(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=m.timers,g=d?d.length:0;for(c.finish=!0,m.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;g>b;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),m.each(["toggle","show","hide"],function(a,b){var c=m.fn[b];m.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(gc(b,!0),a,d,e)}}),m.each({slideDown:gc("show"),slideUp:gc("hide"),slideToggle:gc("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){m.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),m.timers=[],m.fx.tick=function(){var a,b=m.timers,c=0;for($b=m.now();c<b.length;c++)a=b[c],a()||b[c]!==a||b.splice(c--,1);b.length||m.fx.stop(),$b=void 0},m.fx.timer=function(a){m.timers.push(a),a()?m.fx.start():m.timers.pop()},m.fx.interval=13,m.fx.start=function(){_b||(_b=setInterval(m.fx.tick,m.fx.interval))},m.fx.stop=function(){clearInterval(_b),_b=null},m.fx.speeds={slow:600,fast:200,_default:400},m.fn.delay=function(a,b){return a=m.fx?m.fx.speeds[a]||a:a,b=b||"fx",this.queue(b,function(b,c){var d=setTimeout(b,a);c.stop=function(){clearTimeout(d)}})},function(){var a,b,c,d,e;b=y.createElement("div"),b.setAttribute("className","t"),b.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",d=b.getElementsByTagName("a")[0],c=y.createElement("select"),e=c.appendChild(y.createElement("option")),a=b.getElementsByTagName("input")[0],d.style.cssText="top:1px",k.getSetAttribute="t"!==b.className,k.style=/top/.test(d.getAttribute("style")),k.hrefNormalized="/a"===d.getAttribute("href"),k.checkOn=!!a.value,k.optSelected=e.selected,k.enctype=!!y.createElement("form").enctype,c.disabled=!0,k.optDisabled=!e.disabled,a=y.createElement("input"),a.setAttribute("value",""),k.input=""===a.getAttribute("value"),a.value="t",a.setAttribute("type","radio"),k.radioValue="t"===a.value}();var lc=/\r/g;m.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=m.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,m(this).val()):a,null==e?e="":"number"==typeof e?e+="":m.isArray(e)&&(e=m.map(e,function(a){return null==a?"":a+""})),b=m.valHooks[this.type]||m.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=m.valHooks[e.type]||m.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(lc,""):null==c?"":c)}}}),m.extend({valHooks:{option:{get:function(a){var b=m.find.attr(a,"value");return null!=b?b:m.trim(m.text(a))}},select:{get:function(a){for(var b,c,d=a.options,e=a.selectedIndex,f="select-one"===a.type||0>e,g=f?null:[],h=f?e+1:d.length,i=0>e?h:f?e:0;h>i;i++)if(c=d[i],!(!c.selected&&i!==e||(k.optDisabled?c.disabled:null!==c.getAttribute("disabled"))||c.parentNode.disabled&&m.nodeName(c.parentNode,"optgroup"))){if(b=m(c).val(),f)return b;g.push(b)}return g},set:function(a,b){var c,d,e=a.options,f=m.makeArray(b),g=e.length;while(g--)if(d=e[g],m.inArray(m.valHooks.option.get(d),f)>=0)try{d.selected=c=!0}catch(h){d.scrollHeight}else d.selected=!1;return c||(a.selectedIndex=-1),e}}}}),m.each(["radio","checkbox"],function(){m.valHooks[this]={set:function(a,b){return m.isArray(b)?a.checked=m.inArray(m(a).val(),b)>=0:void 0}},k.checkOn||(m.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})});var mc,nc,oc=m.expr.attrHandle,pc=/^(?:checked|selected)$/i,qc=k.getSetAttribute,rc=k.input;m.fn.extend({attr:function(a,b){return V(this,m.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){m.removeAttr(this,a)})}}),m.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(a&&3!==f&&8!==f&&2!==f)return typeof a.getAttribute===K?m.prop(a,b,c):(1===f&&m.isXMLDoc(a)||(b=b.toLowerCase(),d=m.attrHooks[b]||(m.expr.match.bool.test(b)?nc:mc)),void 0===c?d&&"get"in d&&null!==(e=d.get(a,b))?e:(e=m.find.attr(a,b),null==e?void 0:e):null!==c?d&&"set"in d&&void 0!==(e=d.set(a,c,b))?e:(a.setAttribute(b,c+""),c):void m.removeAttr(a,b))},removeAttr:function(a,b){var c,d,e=0,f=b&&b.match(E);if(f&&1===a.nodeType)while(c=f[e++])d=m.propFix[c]||c,m.expr.match.bool.test(c)?rc&&qc||!pc.test(c)?a[d]=!1:a[m.camelCase("default-"+c)]=a[d]=!1:m.attr(a,c,""),a.removeAttribute(qc?c:d)},attrHooks:{type:{set:function(a,b){if(!k.radioValue&&"radio"===b&&m.nodeName(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}}}),nc={set:function(a,b,c){return b===!1?m.removeAttr(a,c):rc&&qc||!pc.test(c)?a.setAttribute(!qc&&m.propFix[c]||c,c):a[m.camelCase("default-"+c)]=a[c]=!0,c}},m.each(m.expr.match.bool.source.match(/\w+/g),function(a,b){var c=oc[b]||m.find.attr;oc[b]=rc&&qc||!pc.test(b)?function(a,b,d){var e,f;return d||(f=oc[b],oc[b]=e,e=null!=c(a,b,d)?b.toLowerCase():null,oc[b]=f),e}:function(a,b,c){return c?void 0:a[m.camelCase("default-"+b)]?b.toLowerCase():null}}),rc&&qc||(m.attrHooks.value={set:function(a,b,c){return m.nodeName(a,"input")?void(a.defaultValue=b):mc&&mc.set(a,b,c)}}),qc||(mc={set:function(a,b,c){var d=a.getAttributeNode(c);return d||a.setAttributeNode(d=a.ownerDocument.createAttribute(c)),d.value=b+="","value"===c||b===a.getAttribute(c)?b:void 0}},oc.id=oc.name=oc.coords=function(a,b,c){var d;return c?void 0:(d=a.getAttributeNode(b))&&""!==d.value?d.value:null},m.valHooks.button={get:function(a,b){var c=a.getAttributeNode(b);return c&&c.specified?c.value:void 0},set:mc.set},m.attrHooks.contenteditable={set:function(a,b,c){mc.set(a,""===b?!1:b,c)}},m.each(["width","height"],function(a,b){m.attrHooks[b]={set:function(a,c){return""===c?(a.setAttribute(b,"auto"),c):void 0}}})),k.style||(m.attrHooks.style={get:function(a){return a.style.cssText||void 0},set:function(a,b){return a.style.cssText=b+""}});var sc=/^(?:input|select|textarea|button|object)$/i,tc=/^(?:a|area)$/i;m.fn.extend({prop:function(a,b){return V(this,m.prop,a,b,arguments.length>1)},removeProp:function(a){return a=m.propFix[a]||a,this.each(function(){try{this[a]=void 0,delete this[a]}catch(b){}})}}),m.extend({propFix:{"for":"htmlFor","class":"className"},prop:function(a,b,c){var d,e,f,g=a.nodeType;if(a&&3!==g&&8!==g&&2!==g)return f=1!==g||!m.isXMLDoc(a),f&&(b=m.propFix[b]||b,e=m.propHooks[b]),void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){var b=m.find.attr(a,"tabindex");return b?parseInt(b,10):sc.test(a.nodeName)||tc.test(a.nodeName)&&a.href?0:-1}}}}),k.hrefNormalized||m.each(["href","src"],function(a,b){m.propHooks[b]={get:function(a){return a.getAttribute(b,4)}}}),k.optSelected||(m.propHooks.selected={get:function(a){var b=a.parentNode;return b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex),null}}),m.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){m.propFix[this.toLowerCase()]=this}),k.enctype||(m.propFix.enctype="encoding");var uc=/[\t\r\n\f]/g;m.fn.extend({addClass:function(a){var b,c,d,e,f,g,h=0,i=this.length,j="string"==typeof a&&a;if(m.isFunction(a))return this.each(function(b){m(this).addClass(a.call(this,b,this.className))});if(j)for(b=(a||"").match(E)||[];i>h;h++)if(c=this[h],d=1===c.nodeType&&(c.className?(" "+c.className+" ").replace(uc," "):" ")){f=0;while(e=b[f++])d.indexOf(" "+e+" ")<0&&(d+=e+" ");g=m.trim(d),c.className!==g&&(c.className=g)}return this},removeClass:function(a){var b,c,d,e,f,g,h=0,i=this.length,j=0===arguments.length||"string"==typeof a&&a;if(m.isFunction(a))return this.each(function(b){m(this).removeClass(a.call(this,b,this.className))});if(j)for(b=(a||"").match(E)||[];i>h;h++)if(c=this[h],d=1===c.nodeType&&(c.className?(" "+c.className+" ").replace(uc," "):"")){f=0;while(e=b[f++])while(d.indexOf(" "+e+" ")>=0)d=d.replace(" "+e+" "," ");g=a?m.trim(d):"",c.className!==g&&(c.className=g)}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):this.each(m.isFunction(a)?function(c){m(this).toggleClass(a.call(this,c,this.className,b),b)}:function(){if("string"===c){var b,d=0,e=m(this),f=a.match(E)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else(c===K||"boolean"===c)&&(this.className&&m._data(this,"__className__",this.className),this.className=this.className||a===!1?"":m._data(this,"__className__")||"")})},hasClass:function(a){for(var b=" "+a+" ",c=0,d=this.length;d>c;c++)if(1===this[c].nodeType&&(" "+this[c].className+" ").replace(uc," ").indexOf(b)>=0)return!0;return!1}}),m.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){m.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),m.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)},bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)}});var vc=m.now(),wc=/\?/,xc=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;m.parseJSON=function(b){if(a.JSON&&a.JSON.parse)return a.JSON.parse(b+"");var c,d=null,e=m.trim(b+"");return e&&!m.trim(e.replace(xc,function(a,b,e,f){return c&&b&&(d=0),0===d?a:(c=e||b,d+=!f-!e,"")}))?Function("return "+e)():m.error("Invalid JSON: "+b)},m.parseXML=function(b){var c,d;if(!b||"string"!=typeof b)return null;try{a.DOMParser?(d=new DOMParser,c=d.parseFromString(b,"text/xml")):(c=new ActiveXObject("Microsoft.XMLDOM"),c.async="false",c.loadXML(b))}catch(e){c=void 0}return c&&c.documentElement&&!c.getElementsByTagName("parsererror").length||m.error("Invalid XML: "+b),c};var yc,zc,Ac=/#.*$/,Bc=/([?&])_=[^&]*/,Cc=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Dc=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Ec=/^(?:GET|HEAD)$/,Fc=/^\/\//,Gc=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,Hc={},Ic={},Jc="*/".concat("*");try{zc=location.href}catch(Kc){zc=y.createElement("a"),zc.href="",zc=zc.href}yc=Gc.exec(zc.toLowerCase())||[];function Lc(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(E)||[];if(m.isFunction(c))while(d=f[e++])"+"===d.charAt(0)?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function Mc(a,b,c,d){var e={},f=a===Ic;function g(h){var i;return e[h]=!0,m.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function Nc(a,b){var c,d,e=m.ajaxSettings.flatOptions||{};for(d in b)void 0!==b[d]&&((e[d]?a:c||(c={}))[d]=b[d]);return c&&m.extend(!0,a,c),a}function Oc(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===e&&(e=a.mimeType||b.getResponseHeader("Content-Type"));if(e)for(g in h)if(h[g]&&h[g].test(e)){i.unshift(g);break}if(i[0]in c)f=i[0];else{for(g in c){if(!i[0]||a.converters[g+" "+i[0]]){f=g;break}d||(d=g)}f=f||d}return f?(f!==i[0]&&i.unshift(f),c[f]):void 0}function Pc(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}m.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:zc,type:"GET",isLocal:Dc.test(yc[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Jc,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":m.parseJSON,"text xml":m.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?Nc(Nc(a,m.ajaxSettings),b):Nc(m.ajaxSettings,a)},ajaxPrefilter:Lc(Hc),ajaxTransport:Lc(Ic),ajax:function(a,b){"object"==typeof a&&(b=a,a=void 0),b=b||{};var c,d,e,f,g,h,i,j,k=m.ajaxSetup({},b),l=k.context||k,n=k.context&&(l.nodeType||l.jquery)?m(l):m.event,o=m.Deferred(),p=m.Callbacks("once memory"),q=k.statusCode||{},r={},s={},t=0,u="canceled",v={readyState:0,getResponseHeader:function(a){var b;if(2===t){if(!j){j={};while(b=Cc.exec(f))j[b[1].toLowerCase()]=b[2]}b=j[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return 2===t?f:null},setRequestHeader:function(a,b){var c=a.toLowerCase();return t||(a=s[c]=s[c]||a,r[a]=b),this},overrideMimeType:function(a){return t||(k.mimeType=a),this},statusCode:function(a){var b;if(a)if(2>t)for(b in a)q[b]=[q[b],a[b]];else v.always(a[v.status]);return this},abort:function(a){var b=a||u;return i&&i.abort(b),x(0,b),this}};if(o.promise(v).complete=p.add,v.success=v.done,v.error=v.fail,k.url=((a||k.url||zc)+"").replace(Ac,"").replace(Fc,yc[1]+"//"),k.type=b.method||b.type||k.method||k.type,k.dataTypes=m.trim(k.dataType||"*").toLowerCase().match(E)||[""],null==k.crossDomain&&(c=Gc.exec(k.url.toLowerCase()),k.crossDomain=!(!c||c[1]===yc[1]&&c[2]===yc[2]&&(c[3]||("http:"===c[1]?"80":"443"))===(yc[3]||("http:"===yc[1]?"80":"443")))),k.data&&k.processData&&"string"!=typeof k.data&&(k.data=m.param(k.data,k.traditional)),Mc(Hc,k,b,v),2===t)return v;h=m.event&&k.global,h&&0===m.active++&&m.event.trigger("ajaxStart"),k.type=k.type.toUpperCase(),k.hasContent=!Ec.test(k.type),e=k.url,k.hasContent||(k.data&&(e=k.url+=(wc.test(e)?"&":"?")+k.data,delete k.data),k.cache===!1&&(k.url=Bc.test(e)?e.replace(Bc,"$1_="+vc++):e+(wc.test(e)?"&":"?")+"_="+vc++)),k.ifModified&&(m.lastModified[e]&&v.setRequestHeader("If-Modified-Since",m.lastModified[e]),m.etag[e]&&v.setRequestHeader("If-None-Match",m.etag[e])),(k.data&&k.hasContent&&k.contentType!==!1||b.contentType)&&v.setRequestHeader("Content-Type",k.contentType),v.setRequestHeader("Accept",k.dataTypes[0]&&k.accepts[k.dataTypes[0]]?k.accepts[k.dataTypes[0]]+("*"!==k.dataTypes[0]?", "+Jc+"; q=0.01":""):k.accepts["*"]);for(d in k.headers)v.setRequestHeader(d,k.headers[d]);if(k.beforeSend&&(k.beforeSend.call(l,v,k)===!1||2===t))return v.abort();u="abort";for(d in{success:1,error:1,complete:1})v[d](k[d]);if(i=Mc(Ic,k,b,v)){v.readyState=1,h&&n.trigger("ajaxSend",[v,k]),k.async&&k.timeout>0&&(g=setTimeout(function(){v.abort("timeout")},k.timeout));try{t=1,i.send(r,x)}catch(w){if(!(2>t))throw w;x(-1,w)}}else x(-1,"No Transport");function x(a,b,c,d){var j,r,s,u,w,x=b;2!==t&&(t=2,g&&clearTimeout(g),i=void 0,f=d||"",v.readyState=a>0?4:0,j=a>=200&&300>a||304===a,c&&(u=Oc(k,v,c)),u=Pc(k,u,v,j),j?(k.ifModified&&(w=v.getResponseHeader("Last-Modified"),w&&(m.lastModified[e]=w),w=v.getResponseHeader("etag"),w&&(m.etag[e]=w)),204===a||"HEAD"===k.type?x="nocontent":304===a?x="notmodified":(x=u.state,r=u.data,s=u.error,j=!s)):(s=x,(a||!x)&&(x="error",0>a&&(a=0))),v.status=a,v.statusText=(b||x)+"",j?o.resolveWith(l,[r,x,v]):o.rejectWith(l,[v,x,s]),v.statusCode(q),q=void 0,h&&n.trigger(j?"ajaxSuccess":"ajaxError",[v,k,j?r:s]),p.fireWith(l,[v,x]),h&&(n.trigger("ajaxComplete",[v,k]),--m.active||m.event.trigger("ajaxStop")))}return v},getJSON:function(a,b,c){return m.get(a,b,c,"json")},getScript:function(a,b){return m.get(a,void 0,b,"script")}}),m.each(["get","post"],function(a,b){m[b]=function(a,c,d,e){return m.isFunction(c)&&(e=e||d,d=c,c=void 0),m.ajax({url:a,type:b,dataType:e,data:c,success:d})}}),m._evalUrl=function(a){return m.ajax({url:a,type:"GET",dataType:"script",async:!1,global:!1,"throws":!0})},m.fn.extend({wrapAll:function(a){if(m.isFunction(a))return this.each(function(b){m(this).wrapAll(a.call(this,b))});if(this[0]){var b=m(a,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstChild&&1===a.firstChild.nodeType)a=a.firstChild;return a}).append(this)}return this},wrapInner:function(a){return this.each(m.isFunction(a)?function(b){m(this).wrapInner(a.call(this,b))}:function(){var b=m(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=m.isFunction(a);return this.each(function(c){m(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){m.nodeName(this,"body")||m(this).replaceWith(this.childNodes)}).end()}}),m.expr.filters.hidden=function(a){return a.offsetWidth<=0&&a.offsetHeight<=0||!k.reliableHiddenOffsets()&&"none"===(a.style&&a.style.display||m.css(a,"display"))},m.expr.filters.visible=function(a){return!m.expr.filters.hidden(a)};var Qc=/%20/g,Rc=/\[\]$/,Sc=/\r?\n/g,Tc=/^(?:submit|button|image|reset|file)$/i,Uc=/^(?:input|select|textarea|keygen)/i;function Vc(a,b,c,d){var e;if(m.isArray(b))m.each(b,function(b,e){c||Rc.test(a)?d(a,e):Vc(a+"["+("object"==typeof e?b:"")+"]",e,c,d)});else if(c||"object"!==m.type(b))d(a,b);else for(e in b)Vc(a+"["+e+"]",b[e],c,d)}m.param=function(a,b){var c,d=[],e=function(a,b){b=m.isFunction(b)?b():null==b?"":b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};if(void 0===b&&(b=m.ajaxSettings&&m.ajaxSettings.traditional),m.isArray(a)||a.jquery&&!m.isPlainObject(a))m.each(a,function(){e(this.name,this.value)});else for(c in a)Vc(c,a[c],b,e);return d.join("&").replace(Qc,"+")},m.fn.extend({serialize:function(){return m.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=m.prop(this,"elements");return a?m.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!m(this).is(":disabled")&&Uc.test(this.nodeName)&&!Tc.test(a)&&(this.checked||!W.test(a))}).map(function(a,b){var c=m(this).val();return null==c?null:m.isArray(c)?m.map(c,function(a){return{name:b.name,value:a.replace(Sc,"\r\n")}}):{name:b.name,value:c.replace(Sc,"\r\n")}}).get()}}),m.ajaxSettings.xhr=void 0!==a.ActiveXObject?function(){return!this.isLocal&&/^(get|post|head|put|delete|options)$/i.test(this.type)&&Zc()||$c()}:Zc;var Wc=0,Xc={},Yc=m.ajaxSettings.xhr();a.attachEvent&&a.attachEvent("onunload",function(){for(var a in Xc)Xc[a](void 0,!0)}),k.cors=!!Yc&&"withCredentials"in Yc,Yc=k.ajax=!!Yc,Yc&&m.ajaxTransport(function(a){if(!a.crossDomain||k.cors){var b;return{send:function(c,d){var e,f=a.xhr(),g=++Wc;if(f.open(a.type,a.url,a.async,a.username,a.password),a.xhrFields)for(e in a.xhrFields)f[e]=a.xhrFields[e];a.mimeType&&f.overrideMimeType&&f.overrideMimeType(a.mimeType),a.crossDomain||c["X-Requested-With"]||(c["X-Requested-With"]="XMLHttpRequest");for(e in c)void 0!==c[e]&&f.setRequestHeader(e,c[e]+"");f.send(a.hasContent&&a.data||null),b=function(c,e){var h,i,j;if(b&&(e||4===f.readyState))if(delete Xc[g],b=void 0,f.onreadystatechange=m.noop,e)4!==f.readyState&&f.abort();else{j={},h=f.status,"string"==typeof f.responseText&&(j.text=f.responseText);try{i=f.statusText}catch(k){i=""}h||!a.isLocal||a.crossDomain?1223===h&&(h=204):h=j.text?200:404}j&&d(h,i,j,f.getAllResponseHeaders())},a.async?4===f.readyState?setTimeout(b):f.onreadystatechange=Xc[g]=b:b()},abort:function(){b&&b(void 0,!0)}}}});function Zc(){try{return new a.XMLHttpRequest}catch(b){}}function $c(){try{return new a.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}}m.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/(?:java|ecma)script/},converters:{"text script":function(a){return m.globalEval(a),a}}}),m.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET",a.global=!1)}),m.ajaxTransport("script",function(a){if(a.crossDomain){var b,c=y.head||m("head")[0]||y.documentElement;return{send:function(d,e){b=y.createElement("script"),b.async=!0,a.scriptCharset&&(b.charset=a.scriptCharset),b.src=a.url,b.onload=b.onreadystatechange=function(a,c){(c||!b.readyState||/loaded|complete/.test(b.readyState))&&(b.onload=b.onreadystatechange=null,b.parentNode&&b.parentNode.removeChild(b),b=null,c||e(200,"success"))},c.insertBefore(b,c.firstChild)},abort:function(){b&&b.onload(void 0,!0)}}}});var _c=[],ad=/(=)\?(?=&|$)|\?\?/;m.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=_c.pop()||m.expando+"_"+vc++;return this[a]=!0,a}}),m.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(ad.test(b.url)?"url":"string"==typeof b.data&&!(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&ad.test(b.data)&&"data");return h||"jsonp"===b.dataTypes[0]?(e=b.jsonpCallback=m.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(ad,"$1"+e):b.jsonp!==!1&&(b.url+=(wc.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||m.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,_c.push(e)),g&&m.isFunction(f)&&f(g[0]),g=f=void 0}),"script"):void 0}),m.parseHTML=function(a,b,c){if(!a||"string"!=typeof a)return null;"boolean"==typeof b&&(c=b,b=!1),b=b||y;var d=u.exec(a),e=!c&&[];return d?[b.createElement(d[1])]:(d=m.buildFragment([a],b,e),e&&e.length&&m(e).remove(),m.merge([],d.childNodes))};var bd=m.fn.load;m.fn.load=function(a,b,c){if("string"!=typeof a&&bd)return bd.apply(this,arguments);var d,e,f,g=this,h=a.indexOf(" ");return h>=0&&(d=m.trim(a.slice(h,a.length)),a=a.slice(0,h)),m.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(f="POST"),g.length>0&&m.ajax({url:a,type:f,dataType:"html",data:b}).done(function(a){e=arguments,g.html(d?m("<div>").append(m.parseHTML(a)).find(d):a)}).complete(c&&function(a,b){g.each(c,e||[a.responseText,b,a])}),this},m.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){m.fn[b]=function(a){return this.on(b,a)}}),m.expr.filters.animated=function(a){return m.grep(m.timers,function(b){return a===b.elem}).length};var cd=a.document.documentElement;function dd(a){return m.isWindow(a)?a:9===a.nodeType?a.defaultView||a.parentWindow:!1}m.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=m.css(a,"position"),l=m(a),n={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=m.css(a,"top"),i=m.css(a,"left"),j=("absolute"===k||"fixed"===k)&&m.inArray("auto",[f,i])>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),m.isFunction(b)&&(b=b.call(a,c,h)),null!=b.top&&(n.top=b.top-h.top+g),null!=b.left&&(n.left=b.left-h.left+e),"using"in b?b.using.call(a,n):l.css(n)}},m.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){m.offset.setOffset(this,a,b)});var b,c,d={top:0,left:0},e=this[0],f=e&&e.ownerDocument;if(f)return b=f.documentElement,m.contains(b,e)?(typeof e.getBoundingClientRect!==K&&(d=e.getBoundingClientRect()),c=dd(f),{top:d.top+(c.pageYOffset||b.scrollTop)-(b.clientTop||0),left:d.left+(c.pageXOffset||b.scrollLeft)-(b.clientLeft||0)}):d},position:function(){if(this[0]){var a,b,c={top:0,left:0},d=this[0];return"fixed"===m.css(d,"position")?b=d.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),m.nodeName(a[0],"html")||(c=a.offset()),c.top+=m.css(a[0],"borderTopWidth",!0),c.left+=m.css(a[0],"borderLeftWidth",!0)),{top:b.top-c.top-m.css(d,"marginTop",!0),left:b.left-c.left-m.css(d,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent||cd;while(a&&!m.nodeName(a,"html")&&"static"===m.css(a,"position"))a=a.offsetParent;return a||cd})}}),m.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(a,b){var c=/Y/.test(b);m.fn[a]=function(d){return V(this,function(a,d,e){var f=dd(a);return void 0===e?f?b in f?f[b]:f.document.documentElement[d]:a[d]:void(f?f.scrollTo(c?m(f).scrollLeft():e,c?e:m(f).scrollTop()):a[d]=e)},a,d,arguments.length,null)}}),m.each(["top","left"],function(a,b){m.cssHooks[b]=Lb(k.pixelPosition,function(a,c){return c?(c=Jb(a,b),Hb.test(c)?m(a).position()[b]+"px":c):void 0})}),m.each({Height:"height",Width:"width"},function(a,b){m.each({padding:"inner"+a,content:b,"":"outer"+a},function(c,d){m.fn[d]=function(d,e){var f=arguments.length&&(c||"boolean"!=typeof d),g=c||(d===!0||e===!0?"margin":"border");return V(this,function(b,c,d){var e;return m.isWindow(b)?b.document.documentElement["client"+a]:9===b.nodeType?(e=b.documentElement,Math.max(b.body["scroll"+a],e["scroll"+a],b.body["offset"+a],e["offset"+a],e["client"+a])):void 0===d?m.css(b,c,g):m.style(b,c,d,g)},b,f?d:void 0,f,null)}})}),m.fn.size=function(){return this.length},m.fn.andSelf=m.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return m});var ed=a.jQuery,fd=a.$;return m.noConflict=function(b){return a.$===m&&(a.$=fd),b&&a.jQuery===m&&(a.jQuery=ed),m},typeof b===K&&(a.jQuery=a.$=m),m});
/*
 * Copyright 2015 Small Batch, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
/* Web Font Loader v1.5.10 - (c) Adobe Systems, Google. License: Apache 2.0 */
;(function(window,document,undefined){var k=this;function l(a,b){var c=a.split("."),d=k;c[0]in d||!d.execScript||d.execScript("var "+c[0]);for(var e;c.length&&(e=c.shift());)c.length||void 0===b?d=d[e]?d[e]:d[e]={}:d[e]=b}function aa(a,b,c){return a.call.apply(a.bind,arguments)}
	function ba(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}}function n(a,b,c){n=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?aa:ba;return n.apply(null,arguments)}var q=Date.now||function(){return+new Date};function s(a,b){this.K=a;this.w=b||a;this.D=this.w.document}s.prototype.createElement=function(a,b,c){a=this.D.createElement(a);if(b)for(var d in b)b.hasOwnProperty(d)&&("style"==d?a.style.cssText=b[d]:a.setAttribute(d,b[d]));c&&a.appendChild(this.D.createTextNode(c));return a};function t(a,b,c){a=a.D.getElementsByTagName(b)[0];a||(a=document.documentElement);a&&a.lastChild&&a.insertBefore(c,a.lastChild)}function ca(a,b){function c(){a.D.body?b():setTimeout(c,0)}c()}
	function u(a,b,c){b=b||[];c=c||[];for(var d=a.className.split(/\s+/),e=0;e<b.length;e+=1){for(var f=!1,g=0;g<d.length;g+=1)if(b[e]===d[g]){f=!0;break}f||d.push(b[e])}b=[];for(e=0;e<d.length;e+=1){f=!1;for(g=0;g<c.length;g+=1)if(d[e]===c[g]){f=!0;break}f||b.push(d[e])}a.className=b.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"")}function v(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;d<e;d++)if(c[d]==b)return!0;return!1}
	function w(a){var b=a.w.location.protocol;"about:"==b&&(b=a.K.location.protocol);return"https:"==b?"https:":"http:"}function x(a,b){var c=a.createElement("link",{rel:"stylesheet",href:b}),d=!1;c.onload=function(){d||(d=!0)};c.onerror=function(){d||(d=!0)};t(a,"head",c)}
	function y(a,b,c,d){var e=a.D.getElementsByTagName("head")[0];if(e){var f=a.createElement("script",{src:b}),g=!1;f.onload=f.onreadystatechange=function(){g||this.readyState&&"loaded"!=this.readyState&&"complete"!=this.readyState||(g=!0,c&&c(null),f.onload=f.onreadystatechange=null,"HEAD"==f.parentNode.tagName&&e.removeChild(f))};e.appendChild(f);window.setTimeout(function(){g||(g=!0,c&&c(Error("Script load timeout")))},d||5E3);return f}return null};function z(a,b,c,d){this.R=a;this.Z=b;this.Ba=c;this.ra=d}l("webfont.BrowserInfo",z);z.prototype.sa=function(){return this.R};z.prototype.hasWebFontSupport=z.prototype.sa;z.prototype.ta=function(){return this.Z};z.prototype.hasWebKitFallbackBug=z.prototype.ta;z.prototype.ua=function(){return this.Ba};z.prototype.hasWebKitMetricsBug=z.prototype.ua;z.prototype.qa=function(){return this.ra};z.prototype.hasNativeFontLoading=z.prototype.qa;function A(a,b,c,d){this.c=null!=a?a:null;this.g=null!=b?b:null;this.B=null!=c?c:null;this.e=null!=d?d:null}var da=/^([0-9]+)(?:[\._-]([0-9]+))?(?:[\._-]([0-9]+))?(?:[\._+-]?(.*))?$/;A.prototype.compare=function(a){return this.c>a.c||this.c===a.c&&this.g>a.g||this.c===a.c&&this.g===a.g&&this.B>a.B?1:this.c<a.c||this.c===a.c&&this.g<a.g||this.c===a.c&&this.g===a.g&&this.B<a.B?-1:0};A.prototype.toString=function(){return[this.c,this.g||"",this.B||"",this.e||""].join("")};
	function B(a){a=da.exec(a);var b=null,c=null,d=null,e=null;a&&(null!==a[1]&&a[1]&&(b=parseInt(a[1],10)),null!==a[2]&&a[2]&&(c=parseInt(a[2],10)),null!==a[3]&&a[3]&&(d=parseInt(a[3],10)),null!==a[4]&&a[4]&&(e=/^[0-9]+$/.test(a[4])?parseInt(a[4],10):a[4]));return new A(b,c,d,e)};function C(a,b,c,d,e,f,g,h){this.P=a;this.ja=c;this.ya=e;this.ia=g;this.m=h}l("webfont.UserAgent",C);C.prototype.getName=function(){return this.P};C.prototype.getName=C.prototype.getName;C.prototype.oa=function(){return this.ja};C.prototype.getEngine=C.prototype.oa;C.prototype.pa=function(){return this.ya};C.prototype.getPlatform=C.prototype.pa;C.prototype.na=function(){return this.ia};C.prototype.getDocumentMode=C.prototype.na;C.prototype.ma=function(){return this.m};C.prototype.getBrowserInfo=C.prototype.ma;function D(a,b){this.a=a;this.k=b}var ea=new C("Unknown",0,"Unknown",0,"Unknown",0,void 0,new z(!1,!1,!1,!1));
	D.prototype.parse=function(){var a;if(-1!=this.a.indexOf("MSIE")||-1!=this.a.indexOf("Trident/")){a=E(this);var b=B(F(this)),c=null,d=null,e=G(this.a,/Trident\/([\d\w\.]+)/,1),f=H(this.k),c=-1!=this.a.indexOf("MSIE")?B(G(this.a,/MSIE ([\d\w\.]+)/,1)):B(G(this.a,/rv:([\d\w\.]+)/,1));""!=e?(d="Trident",B(e)):d="Unknown";a=new C("MSIE",0,d,0,a,0,f,new z("Windows"==a&&6<=c.c||"Windows Phone"==a&&8<=b.c,!1,!1,!!this.k.fonts))}else if(-1!=this.a.indexOf("Opera"))a:if(a="Unknown",c=B(G(this.a,/Presto\/([\d\w\.]+)/,
			1)),B(F(this)),b=H(this.k),null!==c.c?a="Presto":(-1!=this.a.indexOf("Gecko")&&(a="Gecko"),B(G(this.a,/rv:([^\)]+)/,1))),-1!=this.a.indexOf("Opera Mini/"))c=B(G(this.a,/Opera Mini\/([\d\.]+)/,1)),a=new C("OperaMini",0,a,0,E(this),0,b,new z(!1,!1,!1,!!this.k.fonts));else{if(-1!=this.a.indexOf("Version/")&&(c=B(G(this.a,/Version\/([\d\.]+)/,1)),null!==c.c)){a=new C("Opera",0,a,0,E(this),0,b,new z(10<=c.c,!1,!1,!!this.k.fonts));break a}c=B(G(this.a,/Opera[\/ ]([\d\.]+)/,1));a=null!==c.c?new C("Opera",
		0,a,0,E(this),0,b,new z(10<=c.c,!1,!1,!!this.k.fonts)):new C("Opera",0,a,0,E(this),0,b,new z(!1,!1,!1,!!this.k.fonts))}else/OPR\/[\d.]+/.test(this.a)?a=I(this):/AppleWeb(K|k)it/.test(this.a)?a=I(this):-1!=this.a.indexOf("Gecko")?(a="Unknown",b=new A,B(F(this)),b=!1,-1!=this.a.indexOf("Firefox")?(a="Firefox",b=B(G(this.a,/Firefox\/([\d\w\.]+)/,1)),b=3<=b.c&&5<=b.g):-1!=this.a.indexOf("Mozilla")&&(a="Mozilla"),c=B(G(this.a,/rv:([^\)]+)/,1)),b||(b=1<c.c||1==c.c&&9<c.g||1==c.c&&9==c.g&&2<=c.B),a=new C(a,
		0,"Gecko",0,E(this),0,H(this.k),new z(b,!1,!1,!!this.k.fonts))):a=ea;return a};function E(a){var b=G(a.a,/(iPod|iPad|iPhone|Android|Windows Phone|BB\d{2}|BlackBerry)/,1);if(""!=b)return/BB\d{2}/.test(b)&&(b="BlackBerry"),b;a=G(a.a,/(Linux|Mac_PowerPC|Macintosh|Windows|CrOS|PlayStation|CrKey)/,1);return""!=a?("Mac_PowerPC"==a?a="Macintosh":"PlayStation"==a&&(a="Linux"),a):"Unknown"}
	function F(a){var b=G(a.a,/(OS X|Windows NT|Android) ([^;)]+)/,2);if(b||(b=G(a.a,/Windows Phone( OS)? ([^;)]+)/,2))||(b=G(a.a,/(iPhone )?OS ([\d_]+)/,2)))return b;if(b=G(a.a,/(?:Linux|CrOS|CrKey) ([^;)]+)/,1))for(var b=b.split(/\s/),c=0;c<b.length;c+=1)if(/^[\d\._]+$/.test(b[c]))return b[c];return(a=G(a.a,/(BB\d{2}|BlackBerry).*?Version\/([^\s]*)/,2))?a:"Unknown"}
	function I(a){var b=E(a),c=B(F(a)),d=B(G(a.a,/AppleWeb(?:K|k)it\/([\d\.\+]+)/,1)),e="Unknown",f=new A,f="Unknown",g=!1;/OPR\/[\d.]+/.test(a.a)?e="Opera":-1!=a.a.indexOf("Chrome")||-1!=a.a.indexOf("CrMo")||-1!=a.a.indexOf("CriOS")?e="Chrome":/Silk\/\d/.test(a.a)?e="Silk":"BlackBerry"==b||"Android"==b?e="BuiltinBrowser":-1!=a.a.indexOf("PhantomJS")?e="PhantomJS":-1!=a.a.indexOf("Safari")?e="Safari":-1!=a.a.indexOf("AdobeAIR")?e="AdobeAIR":-1!=a.a.indexOf("PlayStation")&&(e="BuiltinBrowser");"BuiltinBrowser"==
	e?f="Unknown":"Silk"==e?f=G(a.a,/Silk\/([\d\._]+)/,1):"Chrome"==e?f=G(a.a,/(Chrome|CrMo|CriOS)\/([\d\.]+)/,2):-1!=a.a.indexOf("Version/")?f=G(a.a,/Version\/([\d\.\w]+)/,1):"AdobeAIR"==e?f=G(a.a,/AdobeAIR\/([\d\.]+)/,1):"Opera"==e?f=G(a.a,/OPR\/([\d.]+)/,1):"PhantomJS"==e&&(f=G(a.a,/PhantomJS\/([\d.]+)/,1));f=B(f);g="AdobeAIR"==e?2<f.c||2==f.c&&5<=f.g:"BlackBerry"==b?10<=c.c:"Android"==b?2<c.c||2==c.c&&1<c.g:526<=d.c||525<=d.c&&13<=d.g;return new C(e,0,"AppleWebKit",0,b,0,H(a.k),new z(g,536>d.c||536==
	d.c&&11>d.g,"iPhone"==b||"iPad"==b||"iPod"==b||"Macintosh"==b,!!a.k.fonts))}function G(a,b,c){return(a=a.match(b))&&a[c]?a[c]:""}function H(a){if(a.documentMode)return a.documentMode};function J(a){this.xa=a||"-"}J.prototype.e=function(a){for(var b=[],c=0;c<arguments.length;c++)b.push(arguments[c].replace(/[\W_]+/g,"").toLowerCase());return b.join(this.xa)};function K(a,b){this.P=a;this.$=4;this.Q="n";var c=(b||"n4").match(/^([nio])([1-9])$/i);c&&(this.Q=c[1],this.$=parseInt(c[2],10))}K.prototype.getName=function(){return this.P};function L(a){return a.Q+a.$}function fa(a){var b=4,c="n",d=null;a&&((d=a.match(/(normal|oblique|italic)/i))&&d[1]&&(c=d[1].substr(0,1).toLowerCase()),(d=a.match(/([1-9]00|normal|bold)/i))&&d[1]&&(/bold/i.test(d[1])?b=7:/[1-9]00/.test(d[1])&&(b=parseInt(d[1].substr(0,1),10))));return c+b};function ga(a,b,c,d,e){this.d=a;this.p=b;this.T=c;this.j="wf";this.h=new J("-");this.ha=!1!==d;this.C=!1!==e}function M(a){if(a.C){var b=v(a.p,a.h.e(a.j,"active")),c=[],d=[a.h.e(a.j,"loading")];b||c.push(a.h.e(a.j,"inactive"));u(a.p,c,d)}N(a,"inactive")}function N(a,b,c){if(a.ha&&a.T[b])if(c)a.T[b](c.getName(),L(c));else a.T[b]()};function ha(){this.A={}};function O(a,b){this.d=a;this.H=b;this.t=this.d.createElement("span",{"aria-hidden":"true"},this.H)}
	function P(a,b){var c=a.t,d;d=[];for(var e=b.P.split(/,\s*/),f=0;f<e.length;f++){var g=e[f].replace(/['"]/g,"");-1==g.indexOf(" ")?d.push(g):d.push("'"+g+"'")}d=d.join(",");e="normal";"o"===b.Q?e="oblique":"i"===b.Q&&(e="italic");c.style.cssText="display:block;position:absolute;top:0px;left:0px;visibility:hidden;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:"+d+";"+("font-style:"+e+";font-weight:"+(b.$+"00")+";")}
	function Q(a){t(a.d,"body",a.t)}O.prototype.remove=function(){var a=this.t;a.parentNode&&a.parentNode.removeChild(a)};function ja(a,b,c,d,e,f,g,h){this.aa=a;this.va=b;this.d=c;this.s=d;this.H=h||"BESbswy";this.m=e;this.J={};this.Y=f||3E3;this.da=g||null;this.G=this.F=null;a=new O(this.d,this.H);Q(a);for(var p in R)R.hasOwnProperty(p)&&(P(a,new K(R[p],L(this.s))),this.J[R[p]]=a.t.offsetWidth);a.remove()}var R={Ea:"serif",Da:"sans-serif",Ca:"monospace"};
	ja.prototype.start=function(){this.F=new O(this.d,this.H);Q(this.F);this.G=new O(this.d,this.H);Q(this.G);this.za=q();P(this.F,new K(this.s.getName()+",serif",L(this.s)));P(this.G,new K(this.s.getName()+",sans-serif",L(this.s)));ka(this)};function la(a,b,c){for(var d in R)if(R.hasOwnProperty(d)&&b===a.J[R[d]]&&c===a.J[R[d]])return!0;return!1}
	function ka(a){var b=a.F.t.offsetWidth,c=a.G.t.offsetWidth;b===a.J.serif&&c===a.J["sans-serif"]||a.m.Z&&la(a,b,c)?q()-a.za>=a.Y?a.m.Z&&la(a,b,c)&&(null===a.da||a.da.hasOwnProperty(a.s.getName()))?S(a,a.aa):S(a,a.va):ma(a):S(a,a.aa)}function ma(a){setTimeout(n(function(){ka(this)},a),25)}function S(a,b){a.F.remove();a.G.remove();b(a.s)};function T(a,b,c,d){this.d=b;this.u=c;this.U=0;this.fa=this.ca=!1;this.Y=d;this.m=a.m}function na(a,b,c,d,e){c=c||{};if(0===b.length&&e)M(a.u);else for(a.U+=b.length,e&&(a.ca=e),e=0;e<b.length;e++){var f=b[e],g=c[f.getName()],h=a.u,p=f;h.C&&u(h.p,[h.h.e(h.j,p.getName(),L(p).toString(),"loading")]);N(h,"fontloading",p);h=null;h=new ja(n(a.ka,a),n(a.la,a),a.d,f,a.m,a.Y,d,g);h.start()}}
	T.prototype.ka=function(a){var b=this.u;b.C&&u(b.p,[b.h.e(b.j,a.getName(),L(a).toString(),"active")],[b.h.e(b.j,a.getName(),L(a).toString(),"loading"),b.h.e(b.j,a.getName(),L(a).toString(),"inactive")]);N(b,"fontactive",a);this.fa=!0;oa(this)};
	T.prototype.la=function(a){var b=this.u;if(b.C){var c=v(b.p,b.h.e(b.j,a.getName(),L(a).toString(),"active")),d=[],e=[b.h.e(b.j,a.getName(),L(a).toString(),"loading")];c||d.push(b.h.e(b.j,a.getName(),L(a).toString(),"inactive"));u(b.p,d,e)}N(b,"fontinactive",a);oa(this)};function oa(a){0==--a.U&&a.ca&&(a.fa?(a=a.u,a.C&&u(a.p,[a.h.e(a.j,"active")],[a.h.e(a.j,"loading"),a.h.e(a.j,"inactive")]),N(a,"active")):M(a.u))};function U(a){this.K=a;this.v=new ha;this.Aa=new D(a.navigator.userAgent,a.document);this.a=this.Aa.parse();this.V=this.W=0;this.M=this.N=!0}
	U.prototype.load=function(a){var b=a.context||this.K;this.d=new s(this.K,b);this.N=!1!==a.events;this.M=!1!==a.classes;var b=new ga(this.d,b.document.documentElement,a,this.N,this.M),c=[],d=a.timeout;b.C&&u(b.p,[b.h.e(b.j,"loading")]);N(b,"loading");var c=this.v,e=this.d,f=[],g;for(g in a)if(a.hasOwnProperty(g)){var h=c.A[g];h&&f.push(h(a[g],e))}c=f;this.V=this.W=c.length;a=new T(this.a,this.d,b,d);g=0;for(d=c.length;g<d;g++)e=c[g],e.L(this.a,n(this.wa,this,e,b,a))};
	U.prototype.wa=function(a,b,c,d){var e=this;d?a.load(function(a,b,d){pa(e,c,a,b,d)}):(a=0==--this.W,this.V--,a&&0==this.V?M(b):(this.M||this.N)&&na(c,[],{},null,a))};function pa(a,b,c,d,e){var f=0==--a.W;(a.M||a.N)&&setTimeout(function(){na(b,c,d||null,e||null,f)},0)};function qa(a,b,c){this.S=a?a:b+ra;this.q=[];this.X=[];this.ga=c||""}var ra="//fonts.googleapis.com/css";qa.prototype.e=function(){if(0==this.q.length)throw Error("No fonts to load!");if(-1!=this.S.indexOf("kit="))return this.S;for(var a=this.q.length,b=[],c=0;c<a;c++)b.push(this.q[c].replace(/ /g,"+"));a=this.S+"?family="+b.join("%7C");0<this.X.length&&(a+="&subset="+this.X.join(","));0<this.ga.length&&(a+="&text="+encodeURIComponent(this.ga));return a};function sa(a){this.q=a;this.ea=[];this.O={}}
	var ta={latin:"BESbswy",cyrillic:"&#1081;&#1103;&#1046;",greek:"&#945;&#946;&#931;",khmer:"&#x1780;&#x1781;&#x1782;",Hanuman:"&#x1780;&#x1781;&#x1782;"},ua={thin:"1",extralight:"2","extra-light":"2",ultralight:"2","ultra-light":"2",light:"3",regular:"4",book:"4",medium:"5","semi-bold":"6",semibold:"6","demi-bold":"6",demibold:"6",bold:"7","extra-bold":"8",extrabold:"8","ultra-bold":"8",ultrabold:"8",black:"9",heavy:"9",l:"3",r:"4",b:"7"},va={i:"i",italic:"i",n:"n",normal:"n"},wa=/^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$/;
	sa.prototype.parse=function(){for(var a=this.q.length,b=0;b<a;b++){var c=this.q[b].split(":"),d=c[0].replace(/\+/g," "),e=["n4"];if(2<=c.length){var f;var g=c[1];f=[];if(g)for(var g=g.split(","),h=g.length,p=0;p<h;p++){var m;m=g[p];if(m.match(/^[\w-]+$/)){m=wa.exec(m.toLowerCase());var r=void 0;if(null==m)r="";else{r=void 0;r=m[1];if(null==r||""==r)r="4";else var ia=ua[r],r=ia?ia:isNaN(r)?"4":r.substr(0,1);m=m[2];r=[null==m||""==m?"n":va[m],r].join("")}m=r}else m="";m&&f.push(m)}0<f.length&&(e=f);
		3==c.length&&(c=c[2],f=[],c=c?c.split(","):f,0<c.length&&(c=ta[c[0]])&&(this.O[d]=c))}this.O[d]||(c=ta[d])&&(this.O[d]=c);for(c=0;c<e.length;c+=1)this.ea.push(new K(d,e[c]))}};function V(a,b){this.a=(new D(navigator.userAgent,document)).parse();this.d=a;this.f=b}var xa={Arimo:!0,Cousine:!0,Tinos:!0};V.prototype.L=function(a,b){b(a.m.R)};V.prototype.load=function(a){var b=this.d;"MSIE"==this.a.getName()&&1!=this.f.blocking?ca(b,n(this.ba,this,a)):this.ba(a)};
	V.prototype.ba=function(a){for(var b=this.d,c=new qa(this.f.api,w(b),this.f.text),d=this.f.families,e=d.length,f=0;f<e;f++){var g=d[f].split(":");3==g.length&&c.X.push(g.pop());var h="";2==g.length&&""!=g[1]&&(h=":");c.q.push(g.join(h))}d=new sa(d);d.parse();x(b,c.e());a(d.ea,d.O,xa)};function W(a,b){this.d=a;this.f=b;this.o=[]}W.prototype.I=function(a){var b=this.d;return w(this.d)+(this.f.api||"//f.fontdeck.com/s/css/js/")+(b.w.location.hostname||b.K.location.hostname)+"/"+a+".js"};
	W.prototype.L=function(a,b){var c=this.f.id,d=this.d.w,e=this;c?(d.__webfontfontdeckmodule__||(d.__webfontfontdeckmodule__={}),d.__webfontfontdeckmodule__[c]=function(a,c){for(var d=0,p=c.fonts.length;d<p;++d){var m=c.fonts[d];e.o.push(new K(m.name,fa("font-weight:"+m.weight+";font-style:"+m.style)))}b(a)},y(this.d,this.I(c),function(a){a&&b(!1)})):b(!1)};W.prototype.load=function(a){a(this.o)};function X(a,b){this.d=a;this.f=b;this.o=[]}X.prototype.I=function(a){var b=w(this.d);return(this.f.api||b+"//use.typekit.net")+"/"+a+".js"};X.prototype.L=function(a,b){var c=this.f.id,d=this.d.w,e=this;c?y(this.d,this.I(c),function(a){if(a)b(!1);else{if(d.Typekit&&d.Typekit.config&&d.Typekit.config.fn){a=d.Typekit.config.fn;for(var c=0;c<a.length;c+=2)for(var h=a[c],p=a[c+1],m=0;m<p.length;m++)e.o.push(new K(h,p[m]));try{d.Typekit.load({events:!1,classes:!1})}catch(r){}}b(!0)}},2E3):b(!1)};
	X.prototype.load=function(a){a(this.o)};function Y(a,b){this.d=a;this.f=b;this.o=[]}Y.prototype.L=function(a,b){var c=this,d=c.f.projectId,e=c.f.version;if(d){var f=c.d.w;y(this.d,c.I(d,e),function(e){if(e)b(!1);else{if(f["__mti_fntLst"+d]&&(e=f["__mti_fntLst"+d]()))for(var h=0;h<e.length;h++)c.o.push(new K(e[h].fontfamily));b(a.m.R)}}).id="__MonotypeAPIScript__"+d}else b(!1)};Y.prototype.I=function(a,b){var c=w(this.d),d=(this.f.api||"fast.fonts.net/jsapi").replace(/^.*http(s?):(\/\/)?/,"");return c+"//"+d+"/"+a+".js"+(b?"?v="+b:"")};
	Y.prototype.load=function(a){a(this.o)};function Z(a,b){this.d=a;this.f=b}Z.prototype.load=function(a){var b,c,d=this.f.urls||[],e=this.f.families||[],f=this.f.testStrings||{};b=0;for(c=d.length;b<c;b++)x(this.d,d[b]);d=[];b=0;for(c=e.length;b<c;b++){var g=e[b].split(":");if(g[1])for(var h=g[1].split(","),p=0;p<h.length;p+=1)d.push(new K(g[0],h[p]));else d.push(new K(g[0]))}a(d,f)};Z.prototype.L=function(a,b){return b(a.m.R)};var $=new U(k);$.v.A.custom=function(a,b){return new Z(b,a)};$.v.A.fontdeck=function(a,b){return new W(b,a)};$.v.A.monotype=function(a,b){return new Y(b,a)};$.v.A.typekit=function(a,b){return new X(b,a)};$.v.A.google=function(a,b){return new V(b,a)};k.WebFont||(k.WebFont={},k.WebFont.load=n($.load,$),k.WebFontConfig&&$.load(k.WebFontConfig));})(this,document);
/*!
 * imagesLoaded PACKAGED v3.1.8
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */


/*!
 * EventEmitter v4.2.6 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */

(function () {


	/**
	 * Class for managing events.
	 * Can be extended to provide event functionality in other classes.
	 *
	 * @class EventEmitter Manages event registering and emitting.
	 */
	function EventEmitter() {}

	// Shortcuts to improve speed and size
	var proto = EventEmitter.prototype;
	var exports = this;
	var originalGlobalValue = exports.EventEmitter;

	/**
	 * Finds the index of the listener for the event in it's storage array.
	 *
	 * @param {Function[]} listeners Array of listeners to search through.
	 * @param {Function} listener Method to look for.
	 * @return {Number} Index of the specified listener, -1 if not found
	 * @api private
	 */
	function indexOfListener(listeners, listener) {
		var i = listeners.length;
		while (i--) {
			if (listeners[i].listener === listener) {
				return i;
			}
		}

		return -1;
	}

	/**
	 * Alias a method while keeping the context correct, to allow for overwriting of target method.
	 *
	 * @param {String} name The name of the target method.
	 * @return {Function} The aliased method
	 * @api private
	 */
	function alias(name) {
		return function aliasClosure() {
			return this[name].apply(this, arguments);
		};
	}

	/**
	 * Returns the listener array for the specified event.
	 * Will initialise the event object and listener arrays if required.
	 * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
	 * Each property in the object response is an array of listener functions.
	 *
	 * @param {String|RegExp} evt Name of the event to return the listeners from.
	 * @return {Function[]|Object} All listener functions for the event.
	 */
	proto.getListeners = function getListeners(evt) {
		var events = this._getEvents();
		var response;
		var key;

		// Return a concatenated array of all matching events if
		// the selector is a regular expression.
		if (typeof evt === 'object') {
			response = {};
			for (key in events) {
				if (events.hasOwnProperty(key) && evt.test(key)) {
					response[key] = events[key];
				}
			}
		}
		else {
			response = events[evt] || (events[evt] = []);
		}

		return response;
	};

	/**
	 * Takes a list of listener objects and flattens it into a list of listener functions.
	 *
	 * @param {Object[]} listeners Raw listener objects.
	 * @return {Function[]} Just the listener functions.
	 */
	proto.flattenListeners = function flattenListeners(listeners) {
		var flatListeners = [];
		var i;

		for (i = 0; i < listeners.length; i += 1) {
			flatListeners.push(listeners[i].listener);
		}

		return flatListeners;
	};

	/**
	 * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
	 *
	 * @param {String|RegExp} evt Name of the event to return the listeners from.
	 * @return {Object} All listener functions for an event in an object.
	 */
	proto.getListenersAsObject = function getListenersAsObject(evt) {
		var listeners = this.getListeners(evt);
		var response;

		if (listeners instanceof Array) {
			response = {};
			response[evt] = listeners;
		}

		return response || listeners;
	};

	/**
	 * Adds a listener function to the specified event.
	 * The listener will not be added if it is a duplicate.
	 * If the listener returns true then it will be removed after it is called.
	 * If you pass a regular expression as the event name then the listener will be added to all events that match it.
	 *
	 * @param {String|RegExp} evt Name of the event to attach the listener to.
	 * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.addListener = function addListener(evt, listener) {
		var listeners = this.getListenersAsObject(evt);
		var listenerIsWrapped = typeof listener === 'object';
		var key;

		for (key in listeners) {
			if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
				listeners[key].push(listenerIsWrapped ? listener : {
					listener: listener,
					once: false
				});
			}
		}

		return this;
	};

	/**
	 * Alias of addListener
	 */
	proto.on = alias('addListener');

	/**
	 * Semi-alias of addListener. It will add a listener that will be
	 * automatically removed after it's first execution.
	 *
	 * @param {String|RegExp} evt Name of the event to attach the listener to.
	 * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.addOnceListener = function addOnceListener(evt, listener) {
		return this.addListener(evt, {
			listener: listener,
			once: true
		});
	};

	/**
	 * Alias of addOnceListener.
	 */
	proto.once = alias('addOnceListener');

	/**
	 * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
	 * You need to tell it what event names should be matched by a regex.
	 *
	 * @param {String} evt Name of the event to create.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.defineEvent = function defineEvent(evt) {
		this.getListeners(evt);
		return this;
	};

	/**
	 * Uses defineEvent to define multiple events.
	 *
	 * @param {String[]} evts An array of event names to define.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.defineEvents = function defineEvents(evts) {
		for (var i = 0; i < evts.length; i += 1) {
			this.defineEvent(evts[i]);
		}
		return this;
	};

	/**
	 * Removes a listener function from the specified event.
	 * When passed a regular expression as the event name, it will remove the listener from all events that match it.
	 *
	 * @param {String|RegExp} evt Name of the event to remove the listener from.
	 * @param {Function} listener Method to remove from the event.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.removeListener = function removeListener(evt, listener) {
		var listeners = this.getListenersAsObject(evt);
		var index;
		var key;

		for (key in listeners) {
			if (listeners.hasOwnProperty(key)) {
				index = indexOfListener(listeners[key], listener);

				if (index !== -1) {
					listeners[key].splice(index, 1);
				}
			}
		}

		return this;
	};

	/**
	 * Alias of removeListener
	 */
	proto.off = alias('removeListener');

	/**
	 * Adds listeners in bulk using the manipulateListeners method.
	 * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
	 * You can also pass it a regular expression to add the array of listeners to all events that match it.
	 * Yeah, this function does quite a bit. That's probably a bad thing.
	 *
	 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
	 * @param {Function[]} [listeners] An optional array of listener functions to add.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.addListeners = function addListeners(evt, listeners) {
		// Pass through to manipulateListeners
		return this.manipulateListeners(false, evt, listeners);
	};

	/**
	 * Removes listeners in bulk using the manipulateListeners method.
	 * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	 * You can also pass it an event name and an array of listeners to be removed.
	 * You can also pass it a regular expression to remove the listeners from all events that match it.
	 *
	 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
	 * @param {Function[]} [listeners] An optional array of listener functions to remove.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.removeListeners = function removeListeners(evt, listeners) {
		// Pass through to manipulateListeners
		return this.manipulateListeners(true, evt, listeners);
	};

	/**
	 * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
	 * The first argument will determine if the listeners are removed (true) or added (false).
	 * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	 * You can also pass it an event name and an array of listeners to be added/removed.
	 * You can also pass it a regular expression to manipulate the listeners of all events that match it.
	 *
	 * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
	 * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
	 * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
		var i;
		var value;
		var single = remove ? this.removeListener : this.addListener;
		var multiple = remove ? this.removeListeners : this.addListeners;

		// If evt is an object then pass each of it's properties to this method
		if (typeof evt === 'object' && !(evt instanceof RegExp)) {
			for (i in evt) {
				if (evt.hasOwnProperty(i) && (value = evt[i])) {
					// Pass the single listener straight through to the singular method
					if (typeof value === 'function') {
						single.call(this, i, value);
					}
					else {
						// Otherwise pass back to the multiple function
						multiple.call(this, i, value);
					}
				}
			}
		}
		else {
			// So evt must be a string
			// And listeners must be an array of listeners
			// Loop over it and pass each one to the multiple method
			i = listeners.length;
			while (i--) {
				single.call(this, evt, listeners[i]);
			}
		}

		return this;
	};

	/**
	 * Removes all listeners from a specified event.
	 * If you do not specify an event then all listeners will be removed.
	 * That means every event will be emptied.
	 * You can also pass a regex to remove all events that match it.
	 *
	 * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.removeEvent = function removeEvent(evt) {
		var type = typeof evt;
		var events = this._getEvents();
		var key;

		// Remove different things depending on the state of evt
		if (type === 'string') {
			// Remove all listeners for the specified event
			delete events[evt];
		}
		else if (type === 'object') {
			// Remove all events matching the regex.
			for (key in events) {
				if (events.hasOwnProperty(key) && evt.test(key)) {
					delete events[key];
				}
			}
		}
		else {
			// Remove all listeners in all events
			delete this._events;
		}

		return this;
	};

	/**
	 * Alias of removeEvent.
	 *
	 * Added to mirror the node API.
	 */
	proto.removeAllListeners = alias('removeEvent');

	/**
	 * Emits an event of your choice.
	 * When emitted, every listener attached to that event will be executed.
	 * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
	 * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
	 * So they will not arrive within the array on the other side, they will be separate.
	 * You can also pass a regular expression to emit to all events that match it.
	 *
	 * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	 * @param {Array} [args] Optional array of arguments to be passed to each listener.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.emitEvent = function emitEvent(evt, args) {
		var listeners = this.getListenersAsObject(evt);
		var listener;
		var i;
		var key;
		var response;

		for (key in listeners) {
			if (listeners.hasOwnProperty(key)) {
				i = listeners[key].length;

				while (i--) {
					// If the listener returns true then it shall be removed from the event
					// The function is executed either with a basic call or an apply if there is an args array
					listener = listeners[key][i];

					if (listener.once === true) {
						this.removeListener(evt, listener.listener);
					}

					response = listener.listener.apply(this, args || []);

					if (response === this._getOnceReturnValue()) {
						this.removeListener(evt, listener.listener);
					}
				}
			}
		}

		return this;
	};

	/**
	 * Alias of emitEvent
	 */
	proto.trigger = alias('emitEvent');

	/**
	 * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
	 * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
	 *
	 * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	 * @param {...*} Optional additional arguments to be passed to each listener.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.emit = function emit(evt) {
		var args = Array.prototype.slice.call(arguments, 1);
		return this.emitEvent(evt, args);
	};

	/**
	 * Sets the current value to check against when executing listeners. If a
	 * listeners return value matches the one set here then it will be removed
	 * after execution. This value defaults to true.
	 *
	 * @param {*} value The new value to check for when executing listeners.
	 * @return {Object} Current instance of EventEmitter for chaining.
	 */
	proto.setOnceReturnValue = function setOnceReturnValue(value) {
		this._onceReturnValue = value;
		return this;
	};

	/**
	 * Fetches the current value to check against when executing listeners. If
	 * the listeners return value matches this one then it should be removed
	 * automatically. It will return true by default.
	 *
	 * @return {*|Boolean} The current value to check for or the default, true.
	 * @api private
	 */
	proto._getOnceReturnValue = function _getOnceReturnValue() {
		if (this.hasOwnProperty('_onceReturnValue')) {
			return this._onceReturnValue;
		}
		else {
			return true;
		}
	};

	/**
	 * Fetches the events object and creates one if required.
	 *
	 * @return {Object} The events storage object.
	 * @api private
	 */
	proto._getEvents = function _getEvents() {
		return this._events || (this._events = {});
	};

	/**
	 * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
	 *
	 * @return {Function} Non conflicting EventEmitter class.
	 */
	EventEmitter.noConflict = function noConflict() {
		exports.EventEmitter = originalGlobalValue;
		return EventEmitter;
	};

	// Expose the class either via AMD, CommonJS or the global object
	if (typeof define === 'function' && define.amd) {
		define('eventEmitter/EventEmitter',[],function () {
			return EventEmitter;
		});
	}
	else if (typeof module === 'object' && module.exports){
		module.exports = EventEmitter;
	}
	else {
		this.EventEmitter = EventEmitter;
	}
}.call(this));

/*!
 * eventie v1.0.4
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 */

/*jshint browser: true, undef: true, unused: true */
/*global define: false */

( function( window ) {



	var docElem = document.documentElement;

	var bind = function() {};

	function getIEEvent( obj ) {
		var event = window.event;
		// add event.target
		event.target = event.target || event.srcElement || obj;
		return event;
	}

	if ( docElem.addEventListener ) {
		bind = function( obj, type, fn ) {
			obj.addEventListener( type, fn, false );
		};
	} else if ( docElem.attachEvent ) {
		bind = function( obj, type, fn ) {
			obj[ type + fn ] = fn.handleEvent ?
				function() {
					var event = getIEEvent( obj );
					fn.handleEvent.call( fn, event );
				} :
				function() {
					var event = getIEEvent( obj );
					fn.call( obj, event );
				};
			obj.attachEvent( "on" + type, obj[ type + fn ] );
		};
	}

	var unbind = function() {};

	if ( docElem.removeEventListener ) {
		unbind = function( obj, type, fn ) {
			obj.removeEventListener( type, fn, false );
		};
	} else if ( docElem.detachEvent ) {
		unbind = function( obj, type, fn ) {
			obj.detachEvent( "on" + type, obj[ type + fn ] );
			try {
				delete obj[ type + fn ];
			} catch ( err ) {
				// can't delete window object properties
				obj[ type + fn ] = undefined;
			}
		};
	}

	var eventie = {
		bind: bind,
		unbind: unbind
	};

// transport
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( 'eventie/eventie',eventie );
	} else {
		// browser global
		window.eventie = eventie;
	}

})( this );

/*!
 * imagesLoaded v3.1.8
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

( function( window, factory ) {
	// universal module definition

	/*global define: false, module: false, require: false */

	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( [
			'eventEmitter/EventEmitter',
			'eventie/eventie'
		], function( EventEmitter, eventie ) {
			return factory( window, EventEmitter, eventie );
		});
	} else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = factory(
			window,
			require('wolfy87-eventemitter'),
			require('eventie')
		);
	} else {
		// browser global
		window.imagesLoaded = factory(
			window,
			window.EventEmitter,
			window.eventie
		);
	}

})( window,

// --------------------------  factory -------------------------- //

	function factory( window, EventEmitter, eventie ) {



		var $ = window.jQuery;
		var console = window.console;
		var hasConsole = typeof console !== 'undefined';

// -------------------------- helpers -------------------------- //

// extend objects
		function extend( a, b ) {
			for ( var prop in b ) {
				a[ prop ] = b[ prop ];
			}
			return a;
		}

		var objToString = Object.prototype.toString;
		function isArray( obj ) {
			return objToString.call( obj ) === '[object Array]';
		}

// turn element or nodeList into an array
		function makeArray( obj ) {
			var ary = [];
			if ( isArray( obj ) ) {
				// use object if already an array
				ary = obj;
			} else if ( typeof obj.length === 'number' ) {
				// convert nodeList to array
				for ( var i=0, len = obj.length; i < len; i++ ) {
					ary.push( obj[i] );
				}
			} else {
				// array of single index
				ary.push( obj );
			}
			return ary;
		}

		// -------------------------- imagesLoaded -------------------------- //

		/**
		 * @param {Array, Element, NodeList, String} elem
		 * @param {Object or Function} options - if function, use as callback
		 * @param {Function} onAlways - callback function
		 */
		function ImagesLoaded( elem, options, onAlways ) {
			// coerce ImagesLoaded() without new, to be new ImagesLoaded()
			if ( !( this instanceof ImagesLoaded ) ) {
				return new ImagesLoaded( elem, options );
			}
			// use elem as selector string
			if ( typeof elem === 'string' ) {
				elem = document.querySelectorAll( elem );
			}

			this.elements = makeArray( elem );
			this.options = extend( {}, this.options );

			if ( typeof options === 'function' ) {
				onAlways = options;
			} else {
				extend( this.options, options );
			}

			if ( onAlways ) {
				this.on( 'always', onAlways );
			}

			this.getImages();

			if ( $ ) {
				// add jQuery Deferred object
				this.jqDeferred = new $.Deferred();
			}

			// HACK check async to allow time to bind listeners
			var _this = this;
			setTimeout( function() {
				_this.check();
			});
		}

		ImagesLoaded.prototype = new EventEmitter();

		ImagesLoaded.prototype.options = {};

		ImagesLoaded.prototype.getImages = function() {
			this.images = [];

			// filter & find items if we have an item selector
			for ( var i=0, len = this.elements.length; i < len; i++ ) {
				var elem = this.elements[i];
				// filter siblings
				if ( elem.nodeName === 'IMG' ) {
					this.addImage( elem );
				}
				// find children
				// no non-element nodes, #143
				var nodeType = elem.nodeType;
				if ( !nodeType || !( nodeType === 1 || nodeType === 9 || nodeType === 11 ) ) {
					continue;
				}
				var childElems = elem.querySelectorAll('img');
				// concat childElems to filterFound array
				for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
					var img = childElems[j];
					this.addImage( img );
				}
			}
		};

		/**
		 * @param {Image} img
		 */
		ImagesLoaded.prototype.addImage = function( img ) {
			var loadingImage = new LoadingImage( img );
			this.images.push( loadingImage );
		};

		ImagesLoaded.prototype.check = function() {
			var _this = this;
			var checkedCount = 0;
			var length = this.images.length;
			this.hasAnyBroken = false;
			// complete if no images
			if ( !length ) {
				this.complete();
				return;
			}

			function onConfirm( image, message ) {
				if ( _this.options.debug && hasConsole ) {
					console.log( 'confirm', image, message );
				}

				_this.progress( image );
				checkedCount++;
				if ( checkedCount === length ) {
					_this.complete();
				}
				return true; // bind once
			}

			for ( var i=0; i < length; i++ ) {
				var loadingImage = this.images[i];
				loadingImage.on( 'confirm', onConfirm );
				loadingImage.check();
			}
		};

		ImagesLoaded.prototype.progress = function( image ) {
			this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
			// HACK - Chrome triggers event before object properties have changed. #83
			var _this = this;
			setTimeout( function() {
				_this.emit( 'progress', _this, image );
				if ( _this.jqDeferred && _this.jqDeferred.notify ) {
					_this.jqDeferred.notify( _this, image );
				}
			});
		};

		ImagesLoaded.prototype.complete = function() {
			var eventName = this.hasAnyBroken ? 'fail' : 'done';
			this.isComplete = true;
			var _this = this;
			// HACK - another setTimeout so that confirm happens after progress
			setTimeout( function() {
				_this.emit( eventName, _this );
				_this.emit( 'always', _this );
				if ( _this.jqDeferred ) {
					var jqMethod = _this.hasAnyBroken ? 'reject' : 'resolve';
					_this.jqDeferred[ jqMethod ]( _this );
				}
			});
		};

		// -------------------------- jquery -------------------------- //

		if ( $ ) {
			$.fn.imagesLoaded = function( options, callback ) {
				var instance = new ImagesLoaded( this, options, callback );
				return instance.jqDeferred.promise( $(this) );
			};
		}


		// --------------------------  -------------------------- //

		function LoadingImage( img ) {
			this.img = img;
		}

		LoadingImage.prototype = new EventEmitter();

		LoadingImage.prototype.check = function() {
			// first check cached any previous images that have same src
			var resource = cache[ this.img.src ] || new Resource( this.img.src );
			if ( resource.isConfirmed ) {
				this.confirm( resource.isLoaded, 'cached was confirmed' );
				return;
			}

			// If complete is true and browser supports natural sizes,
			// try to check for image status manually.
			if ( this.img.complete && this.img.naturalWidth !== undefined ) {
				// report based on naturalWidth
				this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
				return;
			}

			// If none of the checks above matched, simulate loading on detached element.
			var _this = this;
			resource.on( 'confirm', function( resrc, message ) {
				_this.confirm( resrc.isLoaded, message );
				return true;
			});

			resource.check();
		};

		LoadingImage.prototype.confirm = function( isLoaded, message ) {
			this.isLoaded = isLoaded;
			this.emit( 'confirm', this, message );
		};

		// -------------------------- Resource -------------------------- //

		// Resource checks each src, only once
		// separate class from LoadingImage to prevent memory leaks. See #115

		var cache = {};

		function Resource( src ) {
			this.src = src;
			// add to cache
			cache[ src ] = this;
		}

		Resource.prototype = new EventEmitter();

		Resource.prototype.check = function() {
			// only trigger checking once
			if ( this.isChecked ) {
				return;
			}
			// simulate loading on detached element
			var proxyImage = new Image();
			eventie.bind( proxyImage, 'load', this );
			eventie.bind( proxyImage, 'error', this );
			proxyImage.src = this.src;
			// set flag
			this.isChecked = true;
		};

		// ----- events ----- //

		// trigger specified handler for event type
		Resource.prototype.handleEvent = function( event ) {
			var method = 'on' + event.type;
			if ( this[ method ] ) {
				this[ method ]( event );
			}
		};

		Resource.prototype.onload = function( event ) {
			this.confirm( true, 'onload' );
			this.unbindProxyEvents( event );
		};

		Resource.prototype.onerror = function( event ) {
			this.confirm( false, 'onerror' );
			this.unbindProxyEvents( event );
		};

		// ----- confirm ----- //

		Resource.prototype.confirm = function( isLoaded, message ) {
			this.isConfirmed = true;
			this.isLoaded = isLoaded;
			this.emit( 'confirm', this, message );
		};

		Resource.prototype.unbindProxyEvents = function( event ) {
			eventie.unbind( event.target, 'load', this );
			eventie.unbind( event.target, 'error', this );
		};

		// -----  ----- //

		return ImagesLoaded;

	});//! moment.js
//! version : 2.10.2
//! authors : Tim Wood, Iskren Chernev, Moment.js contributors
//! license : MIT
//! momentjs.com

(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
		typeof define === 'function' && define.amd ? define(factory) :
			global.moment = factory()
}(this, function () { 'use strict';

	var hookCallback;

	function utils_hooks__hooks () {
		return hookCallback.apply(null, arguments);
	}

	// This is done to register the method called with moment()
	// without creating circular dependencies.
	function setHookCallback (callback) {
		hookCallback = callback;
	}

	function defaultParsingFlags() {
		// We need to deep clone this object.
		return {
			empty           : false,
			unusedTokens    : [],
			unusedInput     : [],
			overflow        : -2,
			charsLeftOver   : 0,
			nullInput       : false,
			invalidMonth    : null,
			invalidFormat   : false,
			userInvalidated : false,
			iso             : false
		};
	}

	function isArray(input) {
		return Object.prototype.toString.call(input) === '[object Array]';
	}

	function isDate(input) {
		return Object.prototype.toString.call(input) === '[object Date]' || input instanceof Date;
	}

	function map(arr, fn) {
		var res = [], i;
		for (i = 0; i < arr.length; ++i) {
			res.push(fn(arr[i], i));
		}
		return res;
	}

	function hasOwnProp(a, b) {
		return Object.prototype.hasOwnProperty.call(a, b);
	}

	function extend(a, b) {
		for (var i in b) {
			if (hasOwnProp(b, i)) {
				a[i] = b[i];
			}
		}

		if (hasOwnProp(b, 'toString')) {
			a.toString = b.toString;
		}

		if (hasOwnProp(b, 'valueOf')) {
			a.valueOf = b.valueOf;
		}

		return a;
	}

	function create_utc__createUTC (input, format, locale, strict) {
		return createLocalOrUTC(input, format, locale, strict, true).utc();
	}

	function valid__isValid(m) {
		if (m._isValid == null) {
			m._isValid = !isNaN(m._d.getTime()) &&
			m._pf.overflow < 0 &&
			!m._pf.empty &&
			!m._pf.invalidMonth &&
			!m._pf.nullInput &&
			!m._pf.invalidFormat &&
			!m._pf.userInvalidated;

			if (m._strict) {
				m._isValid = m._isValid &&
				m._pf.charsLeftOver === 0 &&
				m._pf.unusedTokens.length === 0 &&
				m._pf.bigHour === undefined;
			}
		}
		return m._isValid;
	}

	function valid__createInvalid (flags) {
		var m = create_utc__createUTC(NaN);
		if (flags != null) {
			extend(m._pf, flags);
		}
		else {
			m._pf.userInvalidated = true;
		}

		return m;
	}

	var momentProperties = utils_hooks__hooks.momentProperties = [];

	function copyConfig(to, from) {
		var i, prop, val;

		if (typeof from._isAMomentObject !== 'undefined') {
			to._isAMomentObject = from._isAMomentObject;
		}
		if (typeof from._i !== 'undefined') {
			to._i = from._i;
		}
		if (typeof from._f !== 'undefined') {
			to._f = from._f;
		}
		if (typeof from._l !== 'undefined') {
			to._l = from._l;
		}
		if (typeof from._strict !== 'undefined') {
			to._strict = from._strict;
		}
		if (typeof from._tzm !== 'undefined') {
			to._tzm = from._tzm;
		}
		if (typeof from._isUTC !== 'undefined') {
			to._isUTC = from._isUTC;
		}
		if (typeof from._offset !== 'undefined') {
			to._offset = from._offset;
		}
		if (typeof from._pf !== 'undefined') {
			to._pf = from._pf;
		}
		if (typeof from._locale !== 'undefined') {
			to._locale = from._locale;
		}

		if (momentProperties.length > 0) {
			for (i in momentProperties) {
				prop = momentProperties[i];
				val = from[prop];
				if (typeof val !== 'undefined') {
					to[prop] = val;
				}
			}
		}

		return to;
	}

	var updateInProgress = false;

	// Moment prototype object
	function Moment(config) {
		copyConfig(this, config);
		this._d = new Date(+config._d);
		// Prevent infinite loop in case updateOffset creates new moment
		// objects.
		if (updateInProgress === false) {
			updateInProgress = true;
			utils_hooks__hooks.updateOffset(this);
			updateInProgress = false;
		}
	}

	function isMoment (obj) {
		return obj instanceof Moment || (obj != null && hasOwnProp(obj, '_isAMomentObject'));
	}

	function toInt(argumentForCoercion) {
		var coercedNumber = +argumentForCoercion,
			value = 0;

		if (coercedNumber !== 0 && isFinite(coercedNumber)) {
			if (coercedNumber >= 0) {
				value = Math.floor(coercedNumber);
			} else {
				value = Math.ceil(coercedNumber);
			}
		}

		return value;
	}

	function compareArrays(array1, array2, dontConvert) {
		var len = Math.min(array1.length, array2.length),
			lengthDiff = Math.abs(array1.length - array2.length),
			diffs = 0,
			i;
		for (i = 0; i < len; i++) {
			if ((dontConvert && array1[i] !== array2[i]) ||
				(!dontConvert && toInt(array1[i]) !== toInt(array2[i]))) {
				diffs++;
			}
		}
		return diffs + lengthDiff;
	}

	function Locale() {
	}

	var locales = {};
	var globalLocale;

	function normalizeLocale(key) {
		return key ? key.toLowerCase().replace('_', '-') : key;
	}

	// pick the locale from the array
	// try ['en-au', 'en-gb'] as 'en-au', 'en-gb', 'en', as in move through the list trying each
	// substring from most specific to least, but move to the next array item if it's a more specific variant than the current root
	function chooseLocale(names) {
		var i = 0, j, next, locale, split;

		while (i < names.length) {
			split = normalizeLocale(names[i]).split('-');
			j = split.length;
			next = normalizeLocale(names[i + 1]);
			next = next ? next.split('-') : null;
			while (j > 0) {
				locale = loadLocale(split.slice(0, j).join('-'));
				if (locale) {
					return locale;
				}
				if (next && next.length >= j && compareArrays(split, next, true) >= j - 1) {
					//the next array item is better than a shallower substring of this one
					break;
				}
				j--;
			}
			i++;
		}
		return null;
	}

	function loadLocale(name) {
		var oldLocale = null;
		// TODO: Find a better way to register and load all the locales in Node
		if (!locales[name] && typeof module !== 'undefined' &&
			module && module.exports) {
			try {
				oldLocale = globalLocale._abbr;
				require('./locale/' + name);
				// because defineLocale currently also sets the global locale, we
				// want to undo that for lazy loaded locales
				locale_locales__getSetGlobalLocale(oldLocale);
			} catch (e) { }
		}
		return locales[name];
	}

	// This function will load locale and then set the global locale.  If
	// no arguments are passed in, it will simply return the current global
	// locale key.
	function locale_locales__getSetGlobalLocale (key, values) {
		var data;
		if (key) {
			if (typeof values === 'undefined') {
				data = locale_locales__getLocale(key);
			}
			else {
				data = defineLocale(key, values);
			}

			if (data) {
				// moment.duration._locale = moment._locale = data;
				globalLocale = data;
			}
		}

		return globalLocale._abbr;
	}

	function defineLocale (name, values) {
		if (values !== null) {
			values.abbr = name;
			if (!locales[name]) {
				locales[name] = new Locale();
			}
			locales[name].set(values);

			// backwards compat for now: also set the locale
			locale_locales__getSetGlobalLocale(name);

			return locales[name];
		} else {
			// useful for testing
			delete locales[name];
			return null;
		}
	}

	// returns locale data
	function locale_locales__getLocale (key) {
		var locale;

		if (key && key._locale && key._locale._abbr) {
			key = key._locale._abbr;
		}

		if (!key) {
			return globalLocale;
		}

		if (!isArray(key)) {
			//short-circuit everything else
			locale = loadLocale(key);
			if (locale) {
				return locale;
			}
			key = [key];
		}

		return chooseLocale(key);
	}

	var aliases = {};

	function addUnitAlias (unit, shorthand) {
		var lowerCase = unit.toLowerCase();
		aliases[lowerCase] = aliases[lowerCase + 's'] = aliases[shorthand] = unit;
	}

	function normalizeUnits(units) {
		return typeof units === 'string' ? aliases[units] || aliases[units.toLowerCase()] : undefined;
	}

	function normalizeObjectUnits(inputObject) {
		var normalizedInput = {},
			normalizedProp,
			prop;

		for (prop in inputObject) {
			if (hasOwnProp(inputObject, prop)) {
				normalizedProp = normalizeUnits(prop);
				if (normalizedProp) {
					normalizedInput[normalizedProp] = inputObject[prop];
				}
			}
		}

		return normalizedInput;
	}

	function makeGetSet (unit, keepTime) {
		return function (value) {
			if (value != null) {
				get_set__set(this, unit, value);
				utils_hooks__hooks.updateOffset(this, keepTime);
				return this;
			} else {
				return get_set__get(this, unit);
			}
		};
	}

	function get_set__get (mom, unit) {
		return mom._d['get' + (mom._isUTC ? 'UTC' : '') + unit]();
	}

	function get_set__set (mom, unit, value) {
		return mom._d['set' + (mom._isUTC ? 'UTC' : '') + unit](value);
	}

	// MOMENTS

	function getSet (units, value) {
		var unit;
		if (typeof units === 'object') {
			for (unit in units) {
				this.set(unit, units[unit]);
			}
		} else {
			units = normalizeUnits(units);
			if (typeof this[units] === 'function') {
				return this[units](value);
			}
		}
		return this;
	}

	function zeroFill(number, targetLength, forceSign) {
		var output = '' + Math.abs(number),
			sign = number >= 0;

		while (output.length < targetLength) {
			output = '0' + output;
		}
		return (sign ? (forceSign ? '+' : '') : '-') + output;
	}

	var formattingTokens = /(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,4}|x|X|zz?|ZZ?|.)/g;

	var localFormattingTokens = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g;

	var formatFunctions = {};

	var formatTokenFunctions = {};

	// token:    'M'
	// padded:   ['MM', 2]
	// ordinal:  'Mo'
	// callback: function () { this.month() + 1 }
	function addFormatToken (token, padded, ordinal, callback) {
		var func = callback;
		if (typeof callback === 'string') {
			func = function () {
				return this[callback]();
			};
		}
		if (token) {
			formatTokenFunctions[token] = func;
		}
		if (padded) {
			formatTokenFunctions[padded[0]] = function () {
				return zeroFill(func.apply(this, arguments), padded[1], padded[2]);
			};
		}
		if (ordinal) {
			formatTokenFunctions[ordinal] = function () {
				return this.localeData().ordinal(func.apply(this, arguments), token);
			};
		}
	}

	function removeFormattingTokens(input) {
		if (input.match(/\[[\s\S]/)) {
			return input.replace(/^\[|\]$/g, '');
		}
		return input.replace(/\\/g, '');
	}

	function makeFormatFunction(format) {
		var array = format.match(formattingTokens), i, length;

		for (i = 0, length = array.length; i < length; i++) {
			if (formatTokenFunctions[array[i]]) {
				array[i] = formatTokenFunctions[array[i]];
			} else {
				array[i] = removeFormattingTokens(array[i]);
			}
		}

		return function (mom) {
			var output = '';
			for (i = 0; i < length; i++) {
				output += array[i] instanceof Function ? array[i].call(mom, format) : array[i];
			}
			return output;
		};
	}

	// format date using native date object
	function formatMoment(m, format) {
		if (!m.isValid()) {
			return m.localeData().invalidDate();
		}

		format = expandFormat(format, m.localeData());

		if (!formatFunctions[format]) {
			formatFunctions[format] = makeFormatFunction(format);
		}

		return formatFunctions[format](m);
	}

	function expandFormat(format, locale) {
		var i = 5;

		function replaceLongDateFormatTokens(input) {
			return locale.longDateFormat(input) || input;
		}

		localFormattingTokens.lastIndex = 0;
		while (i >= 0 && localFormattingTokens.test(format)) {
			format = format.replace(localFormattingTokens, replaceLongDateFormatTokens);
			localFormattingTokens.lastIndex = 0;
			i -= 1;
		}

		return format;
	}

	var match1         = /\d/;            //       0 - 9
	var match2         = /\d\d/;          //      00 - 99
	var match3         = /\d{3}/;         //     000 - 999
	var match4         = /\d{4}/;         //    0000 - 9999
	var match6         = /[+-]?\d{6}/;    // -999999 - 999999
	var match1to2      = /\d\d?/;         //       0 - 99
	var match1to3      = /\d{1,3}/;       //       0 - 999
	var match1to4      = /\d{1,4}/;       //       0 - 9999
	var match1to6      = /[+-]?\d{1,6}/;  // -999999 - 999999

	var matchUnsigned  = /\d+/;           //       0 - inf
	var matchSigned    = /[+-]?\d+/;      //    -inf - inf

	var matchOffset    = /Z|[+-]\d\d:?\d\d/gi; // +00:00 -00:00 +0000 -0000 or Z

	var matchTimestamp = /[+-]?\d+(\.\d{1,3})?/; // 123456789 123456789.123

	// any word (or two) characters or numbers including two/three word month in arabic.
	var matchWord = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i;

	var regexes = {};

	function addRegexToken (token, regex, strictRegex) {
		regexes[token] = typeof regex === 'function' ? regex : function (isStrict) {
			return (isStrict && strictRegex) ? strictRegex : regex;
		};
	}

	function getParseRegexForToken (token, config) {
		if (!hasOwnProp(regexes, token)) {
			return new RegExp(unescapeFormat(token));
		}

		return regexes[token](config._strict, config._locale);
	}

	// Code from http://stackoverflow.com/questions/3561493/is-there-a-regexp-escape-function-in-javascript
	function unescapeFormat(s) {
		return s.replace('\\', '').replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (matched, p1, p2, p3, p4) {
			return p1 || p2 || p3 || p4;
		}).replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
	}

	var tokens = {};

	function addParseToken (token, callback) {
		var i, func = callback;
		if (typeof token === 'string') {
			token = [token];
		}
		if (typeof callback === 'number') {
			func = function (input, array) {
				array[callback] = toInt(input);
			};
		}
		for (i = 0; i < token.length; i++) {
			tokens[token[i]] = func;
		}
	}

	function addWeekParseToken (token, callback) {
		addParseToken(token, function (input, array, config, token) {
			config._w = config._w || {};
			callback(input, config._w, config, token);
		});
	}

	function addTimeToArrayFromToken(token, input, config) {
		if (input != null && hasOwnProp(tokens, token)) {
			tokens[token](input, config._a, config, token);
		}
	}

	var YEAR = 0;
	var MONTH = 1;
	var DATE = 2;
	var HOUR = 3;
	var MINUTE = 4;
	var SECOND = 5;
	var MILLISECOND = 6;

	function daysInMonth(year, month) {
		return new Date(Date.UTC(year, month + 1, 0)).getUTCDate();
	}

	// FORMATTING

	addFormatToken('M', ['MM', 2], 'Mo', function () {
		return this.month() + 1;
	});

	addFormatToken('MMM', 0, 0, function (format) {
		return this.localeData().monthsShort(this, format);
	});

	addFormatToken('MMMM', 0, 0, function (format) {
		return this.localeData().months(this, format);
	});

	// ALIASES

	addUnitAlias('month', 'M');

	// PARSING

	addRegexToken('M',    match1to2);
	addRegexToken('MM',   match1to2, match2);
	addRegexToken('MMM',  matchWord);
	addRegexToken('MMMM', matchWord);

	addParseToken(['M', 'MM'], function (input, array) {
		array[MONTH] = toInt(input) - 1;
	});

	addParseToken(['MMM', 'MMMM'], function (input, array, config, token) {
		var month = config._locale.monthsParse(input, token, config._strict);
		// if we didn't find a month name, mark the date as invalid.
		if (month != null) {
			array[MONTH] = month;
		} else {
			config._pf.invalidMonth = input;
		}
	});

	// LOCALES

	var defaultLocaleMonths = 'January_February_March_April_May_June_July_August_September_October_November_December'.split('_');
	function localeMonths (m) {
		return this._months[m.month()];
	}

	var defaultLocaleMonthsShort = 'Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_');
	function localeMonthsShort (m) {
		return this._monthsShort[m.month()];
	}

	function localeMonthsParse (monthName, format, strict) {
		var i, mom, regex;

		if (!this._monthsParse) {
			this._monthsParse = [];
			this._longMonthsParse = [];
			this._shortMonthsParse = [];
		}

		for (i = 0; i < 12; i++) {
			// make the regex if we don't have it already
			mom = create_utc__createUTC([2000, i]);
			if (strict && !this._longMonthsParse[i]) {
				this._longMonthsParse[i] = new RegExp('^' + this.months(mom, '').replace('.', '') + '$', 'i');
				this._shortMonthsParse[i] = new RegExp('^' + this.monthsShort(mom, '').replace('.', '') + '$', 'i');
			}
			if (!strict && !this._monthsParse[i]) {
				regex = '^' + this.months(mom, '') + '|^' + this.monthsShort(mom, '');
				this._monthsParse[i] = new RegExp(regex.replace('.', ''), 'i');
			}
			// test the regex
			if (strict && format === 'MMMM' && this._longMonthsParse[i].test(monthName)) {
				return i;
			} else if (strict && format === 'MMM' && this._shortMonthsParse[i].test(monthName)) {
				return i;
			} else if (!strict && this._monthsParse[i].test(monthName)) {
				return i;
			}
		}
	}

	// MOMENTS

	function setMonth (mom, value) {
		var dayOfMonth;

		// TODO: Move this out of here!
		if (typeof value === 'string') {
			value = mom.localeData().monthsParse(value);
			// TODO: Another silent failure?
			if (typeof value !== 'number') {
				return mom;
			}
		}

		dayOfMonth = Math.min(mom.date(), daysInMonth(mom.year(), value));
		mom._d['set' + (mom._isUTC ? 'UTC' : '') + 'Month'](value, dayOfMonth);
		return mom;
	}

	function getSetMonth (value) {
		if (value != null) {
			setMonth(this, value);
			utils_hooks__hooks.updateOffset(this, true);
			return this;
		} else {
			return get_set__get(this, 'Month');
		}
	}

	function getDaysInMonth () {
		return daysInMonth(this.year(), this.month());
	}

	function checkOverflow (m) {
		var overflow;
		var a = m._a;

		if (a && m._pf.overflow === -2) {
			overflow =
				a[MONTH]       < 0 || a[MONTH]       > 11  ? MONTH :
					a[DATE]        < 1 || a[DATE]        > daysInMonth(a[YEAR], a[MONTH]) ? DATE :
						a[HOUR]        < 0 || a[HOUR]        > 24 || (a[HOUR] === 24 && (a[MINUTE] !== 0 || a[SECOND] !== 0 || a[MILLISECOND] !== 0)) ? HOUR :
							a[MINUTE]      < 0 || a[MINUTE]      > 59  ? MINUTE :
								a[SECOND]      < 0 || a[SECOND]      > 59  ? SECOND :
									a[MILLISECOND] < 0 || a[MILLISECOND] > 999 ? MILLISECOND :
										-1;

			if (m._pf._overflowDayOfYear && (overflow < YEAR || overflow > DATE)) {
				overflow = DATE;
			}

			m._pf.overflow = overflow;
		}

		return m;
	}

	function warn(msg) {
		if (utils_hooks__hooks.suppressDeprecationWarnings === false && typeof console !== 'undefined' && console.warn) {
			console.warn('Deprecation warning: ' + msg);
		}
	}

	function deprecate(msg, fn) {
		var firstTime = true;
		return extend(function () {
			if (firstTime) {
				warn(msg);
				firstTime = false;
			}
			return fn.apply(this, arguments);
		}, fn);
	}

	var deprecations = {};

	function deprecateSimple(name, msg) {
		if (!deprecations[name]) {
			warn(msg);
			deprecations[name] = true;
		}
	}

	utils_hooks__hooks.suppressDeprecationWarnings = false;

	var from_string__isoRegex = /^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/;

	var isoDates = [
		['YYYYYY-MM-DD', /[+-]\d{6}-\d{2}-\d{2}/],
		['YYYY-MM-DD', /\d{4}-\d{2}-\d{2}/],
		['GGGG-[W]WW-E', /\d{4}-W\d{2}-\d/],
		['GGGG-[W]WW', /\d{4}-W\d{2}/],
		['YYYY-DDD', /\d{4}-\d{3}/]
	];

	// iso time formats and regexes
	var isoTimes = [
		['HH:mm:ss.SSSS', /(T| )\d\d:\d\d:\d\d\.\d+/],
		['HH:mm:ss', /(T| )\d\d:\d\d:\d\d/],
		['HH:mm', /(T| )\d\d:\d\d/],
		['HH', /(T| )\d\d/]
	];

	var aspNetJsonRegex = /^\/?Date\((\-?\d+)/i;

	// date from iso format
	function configFromISO(config) {
		var i, l,
			string = config._i,
			match = from_string__isoRegex.exec(string);

		if (match) {
			config._pf.iso = true;
			for (i = 0, l = isoDates.length; i < l; i++) {
				if (isoDates[i][1].exec(string)) {
					// match[5] should be 'T' or undefined
					config._f = isoDates[i][0] + (match[6] || ' ');
					break;
				}
			}
			for (i = 0, l = isoTimes.length; i < l; i++) {
				if (isoTimes[i][1].exec(string)) {
					config._f += isoTimes[i][0];
					break;
				}
			}
			if (string.match(matchOffset)) {
				config._f += 'Z';
			}
			configFromStringAndFormat(config);
		} else {
			config._isValid = false;
		}
	}

	// date from iso format or fallback
	function configFromString(config) {
		var matched = aspNetJsonRegex.exec(config._i);

		if (matched !== null) {
			config._d = new Date(+matched[1]);
			return;
		}

		configFromISO(config);
		if (config._isValid === false) {
			delete config._isValid;
			utils_hooks__hooks.createFromInputFallback(config);
		}
	}

	utils_hooks__hooks.createFromInputFallback = deprecate(
		'moment construction falls back to js Date. This is ' +
		'discouraged and will be removed in upcoming major ' +
		'release. Please refer to ' +
		'https://github.com/moment/moment/issues/1407 for more info.',
		function (config) {
			config._d = new Date(config._i + (config._useUTC ? ' UTC' : ''));
		}
	);

	function createDate (y, m, d, h, M, s, ms) {
		//can't just apply() to create a date:
		//http://stackoverflow.com/questions/181348/instantiating-a-javascript-object-by-calling-prototype-constructor-apply
		var date = new Date(y, m, d, h, M, s, ms);

		//the date constructor doesn't accept years < 1970
		if (y < 1970) {
			date.setFullYear(y);
		}
		return date;
	}

	function createUTCDate (y) {
		var date = new Date(Date.UTC.apply(null, arguments));
		if (y < 1970) {
			date.setUTCFullYear(y);
		}
		return date;
	}

	addFormatToken(0, ['YY', 2], 0, function () {
		return this.year() % 100;
	});

	addFormatToken(0, ['YYYY',   4],       0, 'year');
	addFormatToken(0, ['YYYYY',  5],       0, 'year');
	addFormatToken(0, ['YYYYYY', 6, true], 0, 'year');

	// ALIASES

	addUnitAlias('year', 'y');

	// PARSING

	addRegexToken('Y',      matchSigned);
	addRegexToken('YY',     match1to2, match2);
	addRegexToken('YYYY',   match1to4, match4);
	addRegexToken('YYYYY',  match1to6, match6);
	addRegexToken('YYYYYY', match1to6, match6);

	addParseToken(['YYYY', 'YYYYY', 'YYYYYY'], YEAR);
	addParseToken('YY', function (input, array) {
		array[YEAR] = utils_hooks__hooks.parseTwoDigitYear(input);
	});

	// HELPERS

	function daysInYear(year) {
		return isLeapYear(year) ? 366 : 365;
	}

	function isLeapYear(year) {
		return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
	}

	// HOOKS

	utils_hooks__hooks.parseTwoDigitYear = function (input) {
		return toInt(input) + (toInt(input) > 68 ? 1900 : 2000);
	};

	// MOMENTS

	var getSetYear = makeGetSet('FullYear', false);

	function getIsLeapYear () {
		return isLeapYear(this.year());
	}

	addFormatToken('w', ['ww', 2], 'wo', 'week');
	addFormatToken('W', ['WW', 2], 'Wo', 'isoWeek');

	// ALIASES

	addUnitAlias('week', 'w');
	addUnitAlias('isoWeek', 'W');

	// PARSING

	addRegexToken('w',  match1to2);
	addRegexToken('ww', match1to2, match2);
	addRegexToken('W',  match1to2);
	addRegexToken('WW', match1to2, match2);

	addWeekParseToken(['w', 'ww', 'W', 'WW'], function (input, week, config, token) {
		week[token.substr(0, 1)] = toInt(input);
	});

	// HELPERS

	// firstDayOfWeek       0 = sun, 6 = sat
	//                      the day of the week that starts the week
	//                      (usually sunday or monday)
	// firstDayOfWeekOfYear 0 = sun, 6 = sat
	//                      the first week is the week that contains the first
	//                      of this day of the week
	//                      (eg. ISO weeks use thursday (4))
	function weekOfYear(mom, firstDayOfWeek, firstDayOfWeekOfYear) {
		var end = firstDayOfWeekOfYear - firstDayOfWeek,
			daysToDayOfWeek = firstDayOfWeekOfYear - mom.day(),
			adjustedMoment;


		if (daysToDayOfWeek > end) {
			daysToDayOfWeek -= 7;
		}

		if (daysToDayOfWeek < end - 7) {
			daysToDayOfWeek += 7;
		}

		adjustedMoment = local__createLocal(mom).add(daysToDayOfWeek, 'd');
		return {
			week: Math.ceil(adjustedMoment.dayOfYear() / 7),
			year: adjustedMoment.year()
		};
	}

	// LOCALES

	function localeWeek (mom) {
		return weekOfYear(mom, this._week.dow, this._week.doy).week;
	}

	var defaultLocaleWeek = {
		dow : 0, // Sunday is the first day of the week.
		doy : 6  // The week that contains Jan 1st is the first week of the year.
	};

	function localeFirstDayOfWeek () {
		return this._week.dow;
	}

	function localeFirstDayOfYear () {
		return this._week.doy;
	}

	// MOMENTS

	function getSetWeek (input) {
		var week = this.localeData().week(this);
		return input == null ? week : this.add((input - week) * 7, 'd');
	}

	function getSetISOWeek (input) {
		var week = weekOfYear(this, 1, 4).week;
		return input == null ? week : this.add((input - week) * 7, 'd');
	}

	addFormatToken('DDD', ['DDDD', 3], 'DDDo', 'dayOfYear');

	// ALIASES

	addUnitAlias('dayOfYear', 'DDD');

	// PARSING

	addRegexToken('DDD',  match1to3);
	addRegexToken('DDDD', match3);
	addParseToken(['DDD', 'DDDD'], function (input, array, config) {
		config._dayOfYear = toInt(input);
	});

	// HELPERS

	//http://en.wikipedia.org/wiki/ISO_week_date#Calculating_a_date_given_the_year.2C_week_number_and_weekday
	function dayOfYearFromWeeks(year, week, weekday, firstDayOfWeekOfYear, firstDayOfWeek) {
		var d = createUTCDate(year, 0, 1).getUTCDay();
		var daysToAdd;
		var dayOfYear;

		d = d === 0 ? 7 : d;
		weekday = weekday != null ? weekday : firstDayOfWeek;
		daysToAdd = firstDayOfWeek - d + (d > firstDayOfWeekOfYear ? 7 : 0) - (d < firstDayOfWeek ? 7 : 0);
		dayOfYear = 7 * (week - 1) + (weekday - firstDayOfWeek) + daysToAdd + 1;

		return {
			year      : dayOfYear > 0 ? year      : year - 1,
			dayOfYear : dayOfYear > 0 ? dayOfYear : daysInYear(year - 1) + dayOfYear
		};
	}

	// MOMENTS

	function getSetDayOfYear (input) {
		var dayOfYear = Math.round((this.clone().startOf('day') - this.clone().startOf('year')) / 864e5) + 1;
		return input == null ? dayOfYear : this.add((input - dayOfYear), 'd');
	}

	// Pick the first defined of two or three arguments.
	function defaults(a, b, c) {
		if (a != null) {
			return a;
		}
		if (b != null) {
			return b;
		}
		return c;
	}

	function currentDateArray(config) {
		var now = new Date();
		if (config._useUTC) {
			return [now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate()];
		}
		return [now.getFullYear(), now.getMonth(), now.getDate()];
	}

	// convert an array to a date.
	// the array should mirror the parameters below
	// note: all values past the year are optional and will default to the lowest possible value.
	// [year, month, day , hour, minute, second, millisecond]
	function configFromArray (config) {
		var i, date, input = [], currentDate, yearToUse;

		if (config._d) {
			return;
		}

		currentDate = currentDateArray(config);

		//compute day of the year from weeks and weekdays
		if (config._w && config._a[DATE] == null && config._a[MONTH] == null) {
			dayOfYearFromWeekInfo(config);
		}

		//if the day of the year is set, figure out what it is
		if (config._dayOfYear) {
			yearToUse = defaults(config._a[YEAR], currentDate[YEAR]);

			if (config._dayOfYear > daysInYear(yearToUse)) {
				config._pf._overflowDayOfYear = true;
			}

			date = createUTCDate(yearToUse, 0, config._dayOfYear);
			config._a[MONTH] = date.getUTCMonth();
			config._a[DATE] = date.getUTCDate();
		}

		// Default to current date.
		// * if no year, month, day of month are given, default to today
		// * if day of month is given, default month and year
		// * if month is given, default only year
		// * if year is given, don't default anything
		for (i = 0; i < 3 && config._a[i] == null; ++i) {
			config._a[i] = input[i] = currentDate[i];
		}

		// Zero out whatever was not defaulted, including time
		for (; i < 7; i++) {
			config._a[i] = input[i] = (config._a[i] == null) ? (i === 2 ? 1 : 0) : config._a[i];
		}

		// Check for 24:00:00.000
		if (config._a[HOUR] === 24 &&
			config._a[MINUTE] === 0 &&
			config._a[SECOND] === 0 &&
			config._a[MILLISECOND] === 0) {
			config._nextDay = true;
			config._a[HOUR] = 0;
		}

		config._d = (config._useUTC ? createUTCDate : createDate).apply(null, input);
		// Apply timezone offset from input. The actual utcOffset can be changed
		// with parseZone.
		if (config._tzm != null) {
			config._d.setUTCMinutes(config._d.getUTCMinutes() - config._tzm);
		}

		if (config._nextDay) {
			config._a[HOUR] = 24;
		}
	}

	function dayOfYearFromWeekInfo(config) {
		var w, weekYear, week, weekday, dow, doy, temp;

		w = config._w;
		if (w.GG != null || w.W != null || w.E != null) {
			dow = 1;
			doy = 4;

			// TODO: We need to take the current isoWeekYear, but that depends on
			// how we interpret now (local, utc, fixed offset). So create
			// a now version of current config (take local/utc/offset flags, and
			// create now).
			weekYear = defaults(w.GG, config._a[YEAR], weekOfYear(local__createLocal(), 1, 4).year);
			week = defaults(w.W, 1);
			weekday = defaults(w.E, 1);
		} else {
			dow = config._locale._week.dow;
			doy = config._locale._week.doy;

			weekYear = defaults(w.gg, config._a[YEAR], weekOfYear(local__createLocal(), dow, doy).year);
			week = defaults(w.w, 1);

			if (w.d != null) {
				// weekday -- low day numbers are considered next week
				weekday = w.d;
				if (weekday < dow) {
					++week;
				}
			} else if (w.e != null) {
				// local weekday -- counting starts from begining of week
				weekday = w.e + dow;
			} else {
				// default to begining of week
				weekday = dow;
			}
		}
		temp = dayOfYearFromWeeks(weekYear, week, weekday, doy, dow);

		config._a[YEAR] = temp.year;
		config._dayOfYear = temp.dayOfYear;
	}

	utils_hooks__hooks.ISO_8601 = function () {};

	// date from string and format string
	function configFromStringAndFormat(config) {
		// TODO: Move this to another part of the creation flow to prevent circular deps
		if (config._f === utils_hooks__hooks.ISO_8601) {
			configFromISO(config);
			return;
		}

		config._a = [];
		config._pf.empty = true;

		// This array is used to make a Date, either with `new Date` or `Date.UTC`
		var string = '' + config._i,
			i, parsedInput, tokens, token, skipped,
			stringLength = string.length,
			totalParsedInputLength = 0;

		tokens = expandFormat(config._f, config._locale).match(formattingTokens) || [];

		for (i = 0; i < tokens.length; i++) {
			token = tokens[i];
			parsedInput = (string.match(getParseRegexForToken(token, config)) || [])[0];
			if (parsedInput) {
				skipped = string.substr(0, string.indexOf(parsedInput));
				if (skipped.length > 0) {
					config._pf.unusedInput.push(skipped);
				}
				string = string.slice(string.indexOf(parsedInput) + parsedInput.length);
				totalParsedInputLength += parsedInput.length;
			}
			// don't parse if it's not a known token
			if (formatTokenFunctions[token]) {
				if (parsedInput) {
					config._pf.empty = false;
				}
				else {
					config._pf.unusedTokens.push(token);
				}
				addTimeToArrayFromToken(token, parsedInput, config);
			}
			else if (config._strict && !parsedInput) {
				config._pf.unusedTokens.push(token);
			}
		}

		// add remaining unparsed input length to the string
		config._pf.charsLeftOver = stringLength - totalParsedInputLength;
		if (string.length > 0) {
			config._pf.unusedInput.push(string);
		}

		// clear _12h flag if hour is <= 12
		if (config._pf.bigHour === true && config._a[HOUR] <= 12) {
			config._pf.bigHour = undefined;
		}
		// handle meridiem
		config._a[HOUR] = meridiemFixWrap(config._locale, config._a[HOUR], config._meridiem);

		configFromArray(config);
		checkOverflow(config);
	}


	function meridiemFixWrap (locale, hour, meridiem) {
		var isPm;

		if (meridiem == null) {
			// nothing to do
			return hour;
		}
		if (locale.meridiemHour != null) {
			return locale.meridiemHour(hour, meridiem);
		} else if (locale.isPM != null) {
			// Fallback
			isPm = locale.isPM(meridiem);
			if (isPm && hour < 12) {
				hour += 12;
			}
			if (!isPm && hour === 12) {
				hour = 0;
			}
			return hour;
		} else {
			// this is not supposed to happen
			return hour;
		}
	}

	function configFromStringAndArray(config) {
		var tempConfig,
			bestMoment,

			scoreToBeat,
			i,
			currentScore;

		if (config._f.length === 0) {
			config._pf.invalidFormat = true;
			config._d = new Date(NaN);
			return;
		}

		for (i = 0; i < config._f.length; i++) {
			currentScore = 0;
			tempConfig = copyConfig({}, config);
			if (config._useUTC != null) {
				tempConfig._useUTC = config._useUTC;
			}
			tempConfig._pf = defaultParsingFlags();
			tempConfig._f = config._f[i];
			configFromStringAndFormat(tempConfig);

			if (!valid__isValid(tempConfig)) {
				continue;
			}

			// if there is any input that was not parsed add a penalty for that format
			currentScore += tempConfig._pf.charsLeftOver;

			//or tokens
			currentScore += tempConfig._pf.unusedTokens.length * 10;

			tempConfig._pf.score = currentScore;

			if (scoreToBeat == null || currentScore < scoreToBeat) {
				scoreToBeat = currentScore;
				bestMoment = tempConfig;
			}
		}

		extend(config, bestMoment || tempConfig);
	}

	function configFromObject(config) {
		if (config._d) {
			return;
		}

		var i = normalizeObjectUnits(config._i);
		config._a = [i.year, i.month, i.day || i.date, i.hour, i.minute, i.second, i.millisecond];

		configFromArray(config);
	}

	function createFromConfig (config) {
		var input = config._i,
			format = config._f,
			res;

		config._locale = config._locale || locale_locales__getLocale(config._l);

		if (input === null || (format === undefined && input === '')) {
			return valid__createInvalid({nullInput: true});
		}

		if (typeof input === 'string') {
			config._i = input = config._locale.preparse(input);
		}

		if (isMoment(input)) {
			return new Moment(checkOverflow(input));
		} else if (isArray(format)) {
			configFromStringAndArray(config);
		} else if (format) {
			configFromStringAndFormat(config);
		} else {
			configFromInput(config);
		}

		res = new Moment(checkOverflow(config));
		if (res._nextDay) {
			// Adding is smart enough around DST
			res.add(1, 'd');
			res._nextDay = undefined;
		}

		return res;
	}

	function configFromInput(config) {
		var input = config._i;
		if (input === undefined) {
			config._d = new Date();
		} else if (isDate(input)) {
			config._d = new Date(+input);
		} else if (typeof input === 'string') {
			configFromString(config);
		} else if (isArray(input)) {
			config._a = map(input.slice(0), function (obj) {
				return parseInt(obj, 10);
			});
			configFromArray(config);
		} else if (typeof(input) === 'object') {
			configFromObject(config);
		} else if (typeof(input) === 'number') {
			// from milliseconds
			config._d = new Date(input);
		} else {
			utils_hooks__hooks.createFromInputFallback(config);
		}
	}

	function createLocalOrUTC (input, format, locale, strict, isUTC) {
		var c = {};

		if (typeof(locale) === 'boolean') {
			strict = locale;
			locale = undefined;
		}
		// object construction must be done this way.
		// https://github.com/moment/moment/issues/1423
		c._isAMomentObject = true;
		c._useUTC = c._isUTC = isUTC;
		c._l = locale;
		c._i = input;
		c._f = format;
		c._strict = strict;
		c._pf = defaultParsingFlags();

		return createFromConfig(c);
	}

	function local__createLocal (input, format, locale, strict) {
		return createLocalOrUTC(input, format, locale, strict, false);
	}

	var prototypeMin = deprecate(
		'moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548',
		function () {
			var other = local__createLocal.apply(null, arguments);
			return other < this ? this : other;
		}
	);

	var prototypeMax = deprecate(
		'moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548',
		function () {
			var other = local__createLocal.apply(null, arguments);
			return other > this ? this : other;
		}
	);

	// Pick a moment m from moments so that m[fn](other) is true for all
	// other. This relies on the function fn to be transitive.
	//
	// moments should either be an array of moment objects or an array, whose
	// first element is an array of moment objects.
	function pickBy(fn, moments) {
		var res, i;
		if (moments.length === 1 && isArray(moments[0])) {
			moments = moments[0];
		}
		if (!moments.length) {
			return local__createLocal();
		}
		res = moments[0];
		for (i = 1; i < moments.length; ++i) {
			if (moments[i][fn](res)) {
				res = moments[i];
			}
		}
		return res;
	}

	// TODO: Use [].sort instead?
	function min () {
		var args = [].slice.call(arguments, 0);

		return pickBy('isBefore', args);
	}

	function max () {
		var args = [].slice.call(arguments, 0);

		return pickBy('isAfter', args);
	}

	function Duration (duration) {
		var normalizedInput = normalizeObjectUnits(duration),
			years = normalizedInput.year || 0,
			quarters = normalizedInput.quarter || 0,
			months = normalizedInput.month || 0,
			weeks = normalizedInput.week || 0,
			days = normalizedInput.day || 0,
			hours = normalizedInput.hour || 0,
			minutes = normalizedInput.minute || 0,
			seconds = normalizedInput.second || 0,
			milliseconds = normalizedInput.millisecond || 0;

		// representation for dateAddRemove
		this._milliseconds = +milliseconds +
		seconds * 1e3 + // 1000
		minutes * 6e4 + // 1000 * 60
		hours * 36e5; // 1000 * 60 * 60
		// Because of dateAddRemove treats 24 hours as different from a
		// day when working around DST, we need to store them separately
		this._days = +days +
		weeks * 7;
		// It is impossible translate months into days without knowing
		// which months you are are talking about, so we have to store
		// it separately.
		this._months = +months +
		quarters * 3 +
		years * 12;

		this._data = {};

		this._locale = locale_locales__getLocale();

		this._bubble();
	}

	function isDuration (obj) {
		return obj instanceof Duration;
	}

	function offset (token, separator) {
		addFormatToken(token, 0, 0, function () {
			var offset = this.utcOffset();
			var sign = '+';
			if (offset < 0) {
				offset = -offset;
				sign = '-';
			}
			return sign + zeroFill(~~(offset / 60), 2) + separator + zeroFill(~~(offset) % 60, 2);
		});
	}

	offset('Z', ':');
	offset('ZZ', '');

	// PARSING

	addRegexToken('Z',  matchOffset);
	addRegexToken('ZZ', matchOffset);
	addParseToken(['Z', 'ZZ'], function (input, array, config) {
		config._useUTC = true;
		config._tzm = offsetFromString(input);
	});

	// HELPERS

	// timezone chunker
	// '+10:00' > ['10',  '00']
	// '-1530'  > ['-15', '30']
	var chunkOffset = /([\+\-]|\d\d)/gi;

	function offsetFromString(string) {
		var matches = ((string || '').match(matchOffset) || []);
		var chunk   = matches[matches.length - 1] || [];
		var parts   = (chunk + '').match(chunkOffset) || ['-', 0, 0];
		var minutes = +(parts[1] * 60) + toInt(parts[2]);

		return parts[0] === '+' ? minutes : -minutes;
	}

	// Return a moment from input, that is local/utc/zone equivalent to model.
	function cloneWithOffset(input, model) {
		var res, diff;
		if (model._isUTC) {
			res = model.clone();
			diff = (isMoment(input) || isDate(input) ? +input : +local__createLocal(input)) - (+res);
			// Use low-level api, because this fn is low-level api.
			res._d.setTime(+res._d + diff);
			utils_hooks__hooks.updateOffset(res, false);
			return res;
		} else {
			return local__createLocal(input).local();
		}
		return model._isUTC ? local__createLocal(input).zone(model._offset || 0) : local__createLocal(input).local();
	}

	function getDateOffset (m) {
		// On Firefox.24 Date#getTimezoneOffset returns a floating point.
		// https://github.com/moment/moment/pull/1871
		return -Math.round(m._d.getTimezoneOffset() / 15) * 15;
	}

	// HOOKS

	// This function will be called whenever a moment is mutated.
	// It is intended to keep the offset in sync with the timezone.
	utils_hooks__hooks.updateOffset = function () {};

	// MOMENTS

	// keepLocalTime = true means only change the timezone, without
	// affecting the local hour. So 5:31:26 +0300 --[utcOffset(2, true)]-->
	// 5:31:26 +0200 It is possible that 5:31:26 doesn't exist with offset
	// +0200, so we adjust the time as needed, to be valid.
	//
	// Keeping the time actually adds/subtracts (one hour)
	// from the actual represented time. That is why we call updateOffset
	// a second time. In case it wants us to change the offset again
	// _changeInProgress == true case, then we have to adjust, because
	// there is no such time in the given timezone.
	function getSetOffset (input, keepLocalTime) {
		var offset = this._offset || 0,
			localAdjust;
		if (input != null) {
			if (typeof input === 'string') {
				input = offsetFromString(input);
			}
			if (Math.abs(input) < 16) {
				input = input * 60;
			}
			if (!this._isUTC && keepLocalTime) {
				localAdjust = getDateOffset(this);
			}
			this._offset = input;
			this._isUTC = true;
			if (localAdjust != null) {
				this.add(localAdjust, 'm');
			}
			if (offset !== input) {
				if (!keepLocalTime || this._changeInProgress) {
					add_subtract__addSubtract(this, create__createDuration(input - offset, 'm'), 1, false);
				} else if (!this._changeInProgress) {
					this._changeInProgress = true;
					utils_hooks__hooks.updateOffset(this, true);
					this._changeInProgress = null;
				}
			}
			return this;
		} else {
			return this._isUTC ? offset : getDateOffset(this);
		}
	}

	function getSetZone (input, keepLocalTime) {
		if (input != null) {
			if (typeof input !== 'string') {
				input = -input;
			}

			this.utcOffset(input, keepLocalTime);

			return this;
		} else {
			return -this.utcOffset();
		}
	}

	function setOffsetToUTC (keepLocalTime) {
		return this.utcOffset(0, keepLocalTime);
	}

	function setOffsetToLocal (keepLocalTime) {
		if (this._isUTC) {
			this.utcOffset(0, keepLocalTime);
			this._isUTC = false;

			if (keepLocalTime) {
				this.subtract(getDateOffset(this), 'm');
			}
		}
		return this;
	}

	function setOffsetToParsedOffset () {
		if (this._tzm) {
			this.utcOffset(this._tzm);
		} else if (typeof this._i === 'string') {
			this.utcOffset(offsetFromString(this._i));
		}
		return this;
	}

	function hasAlignedHourOffset (input) {
		if (!input) {
			input = 0;
		}
		else {
			input = local__createLocal(input).utcOffset();
		}

		return (this.utcOffset() - input) % 60 === 0;
	}

	function isDaylightSavingTime () {
		return (
		this.utcOffset() > this.clone().month(0).utcOffset() ||
		this.utcOffset() > this.clone().month(5).utcOffset()
		);
	}

	function isDaylightSavingTimeShifted () {
		if (this._a) {
			var other = this._isUTC ? create_utc__createUTC(this._a) : local__createLocal(this._a);
			return this.isValid() && compareArrays(this._a, other.toArray()) > 0;
		}

		return false;
	}

	function isLocal () {
		return !this._isUTC;
	}

	function isUtcOffset () {
		return this._isUTC;
	}

	function isUtc () {
		return this._isUTC && this._offset === 0;
	}

	var aspNetRegex = /(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/;

	// from http://docs.closure-library.googlecode.com/git/closure_goog_date_date.js.source.html
	// somewhat more in line with 4.4.3.2 2004 spec, but allows decimal anywhere
	var create__isoRegex = /^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/;

	function create__createDuration (input, key) {
		var duration = input,
		// matching against regexp is expensive, do it on demand
			match = null,
			sign,
			ret,
			diffRes;

		if (isDuration(input)) {
			duration = {
				ms : input._milliseconds,
				d  : input._days,
				M  : input._months
			};
		} else if (typeof input === 'number') {
			duration = {};
			if (key) {
				duration[key] = input;
			} else {
				duration.milliseconds = input;
			}
		} else if (!!(match = aspNetRegex.exec(input))) {
			sign = (match[1] === '-') ? -1 : 1;
			duration = {
				y  : 0,
				d  : toInt(match[DATE])        * sign,
				h  : toInt(match[HOUR])        * sign,
				m  : toInt(match[MINUTE])      * sign,
				s  : toInt(match[SECOND])      * sign,
				ms : toInt(match[MILLISECOND]) * sign
			};
		} else if (!!(match = create__isoRegex.exec(input))) {
			sign = (match[1] === '-') ? -1 : 1;
			duration = {
				y : parseIso(match[2], sign),
				M : parseIso(match[3], sign),
				d : parseIso(match[4], sign),
				h : parseIso(match[5], sign),
				m : parseIso(match[6], sign),
				s : parseIso(match[7], sign),
				w : parseIso(match[8], sign)
			};
		} else if (duration == null) {// checks for null or undefined
			duration = {};
		} else if (typeof duration === 'object' && ('from' in duration || 'to' in duration)) {
			diffRes = momentsDifference(local__createLocal(duration.from), local__createLocal(duration.to));

			duration = {};
			duration.ms = diffRes.milliseconds;
			duration.M = diffRes.months;
		}

		ret = new Duration(duration);

		if (isDuration(input) && hasOwnProp(input, '_locale')) {
			ret._locale = input._locale;
		}

		return ret;
	}

	create__createDuration.fn = Duration.prototype;

	function parseIso (inp, sign) {
		// We'd normally use ~~inp for this, but unfortunately it also
		// converts floats to ints.
		// inp may be undefined, so careful calling replace on it.
		var res = inp && parseFloat(inp.replace(',', '.'));
		// apply sign while we're at it
		return (isNaN(res) ? 0 : res) * sign;
	}

	function positiveMomentsDifference(base, other) {
		var res = {milliseconds: 0, months: 0};

		res.months = other.month() - base.month() +
		(other.year() - base.year()) * 12;
		if (base.clone().add(res.months, 'M').isAfter(other)) {
			--res.months;
		}

		res.milliseconds = +other - +(base.clone().add(res.months, 'M'));

		return res;
	}

	function momentsDifference(base, other) {
		var res;
		other = cloneWithOffset(other, base);
		if (base.isBefore(other)) {
			res = positiveMomentsDifference(base, other);
		} else {
			res = positiveMomentsDifference(other, base);
			res.milliseconds = -res.milliseconds;
			res.months = -res.months;
		}

		return res;
	}

	function createAdder(direction, name) {
		return function (val, period) {
			var dur, tmp;
			//invert the arguments, but complain about it
			if (period !== null && !isNaN(+period)) {
				deprecateSimple(name, 'moment().' + name  + '(period, number) is deprecated. Please use moment().' + name + '(number, period).');
				tmp = val; val = period; period = tmp;
			}

			val = typeof val === 'string' ? +val : val;
			dur = create__createDuration(val, period);
			add_subtract__addSubtract(this, dur, direction);
			return this;
		};
	}

	function add_subtract__addSubtract (mom, duration, isAdding, updateOffset) {
		var milliseconds = duration._milliseconds,
			days = duration._days,
			months = duration._months;
		updateOffset = updateOffset == null ? true : updateOffset;

		if (milliseconds) {
			mom._d.setTime(+mom._d + milliseconds * isAdding);
		}
		if (days) {
			get_set__set(mom, 'Date', get_set__get(mom, 'Date') + days * isAdding);
		}
		if (months) {
			setMonth(mom, get_set__get(mom, 'Month') + months * isAdding);
		}
		if (updateOffset) {
			utils_hooks__hooks.updateOffset(mom, days || months);
		}
	}

	var add_subtract__add      = createAdder(1, 'add');
	var add_subtract__subtract = createAdder(-1, 'subtract');

	function moment_calendar__calendar (time) {
		// We want to compare the start of today, vs this.
		// Getting start-of-today depends on whether we're local/utc/offset or not.
		var now = time || local__createLocal(),
			sod = cloneWithOffset(now, this).startOf('day'),
			diff = this.diff(sod, 'days', true),
			format = diff < -6 ? 'sameElse' :
				diff < -1 ? 'lastWeek' :
					diff < 0 ? 'lastDay' :
						diff < 1 ? 'sameDay' :
							diff < 2 ? 'nextDay' :
								diff < 7 ? 'nextWeek' : 'sameElse';
		return this.format(this.localeData().calendar(format, this, local__createLocal(now)));
	}

	function clone () {
		return new Moment(this);
	}

	function isAfter (input, units) {
		var inputMs;
		units = normalizeUnits(typeof units !== 'undefined' ? units : 'millisecond');
		if (units === 'millisecond') {
			input = isMoment(input) ? input : local__createLocal(input);
			return +this > +input;
		} else {
			inputMs = isMoment(input) ? +input : +local__createLocal(input);
			return inputMs < +this.clone().startOf(units);
		}
	}

	function isBefore (input, units) {
		var inputMs;
		units = normalizeUnits(typeof units !== 'undefined' ? units : 'millisecond');
		if (units === 'millisecond') {
			input = isMoment(input) ? input : local__createLocal(input);
			return +this < +input;
		} else {
			inputMs = isMoment(input) ? +input : +local__createLocal(input);
			return +this.clone().endOf(units) < inputMs;
		}
	}

	function isBetween (from, to, units) {
		return this.isAfter(from, units) && this.isBefore(to, units);
	}

	function isSame (input, units) {
		var inputMs;
		units = normalizeUnits(units || 'millisecond');
		if (units === 'millisecond') {
			input = isMoment(input) ? input : local__createLocal(input);
			return +this === +input;
		} else {
			inputMs = +local__createLocal(input);
			return +(this.clone().startOf(units)) <= inputMs && inputMs <= +(this.clone().endOf(units));
		}
	}

	function absFloor (number) {
		if (number < 0) {
			return Math.ceil(number);
		} else {
			return Math.floor(number);
		}
	}

	function diff (input, units, asFloat) {
		var that = cloneWithOffset(input, this),
			zoneDelta = (that.utcOffset() - this.utcOffset()) * 6e4,
			delta, output;

		units = normalizeUnits(units);

		if (units === 'year' || units === 'month' || units === 'quarter') {
			output = monthDiff(this, that);
			if (units === 'quarter') {
				output = output / 3;
			} else if (units === 'year') {
				output = output / 12;
			}
		} else {
			delta = this - that;
			output = units === 'second' ? delta / 1e3 : // 1000
				units === 'minute' ? delta / 6e4 : // 1000 * 60
					units === 'hour' ? delta / 36e5 : // 1000 * 60 * 60
						units === 'day' ? (delta - zoneDelta) / 864e5 : // 1000 * 60 * 60 * 24, negate dst
							units === 'week' ? (delta - zoneDelta) / 6048e5 : // 1000 * 60 * 60 * 24 * 7, negate dst
								delta;
		}
		return asFloat ? output : absFloor(output);
	}

	function monthDiff (a, b) {
		// difference in months
		var wholeMonthDiff = ((b.year() - a.year()) * 12) + (b.month() - a.month()),
		// b is in (anchor - 1 month, anchor + 1 month)
			anchor = a.clone().add(wholeMonthDiff, 'months'),
			anchor2, adjust;

		if (b - anchor < 0) {
			anchor2 = a.clone().add(wholeMonthDiff - 1, 'months');
			// linear across the month
			adjust = (b - anchor) / (anchor - anchor2);
		} else {
			anchor2 = a.clone().add(wholeMonthDiff + 1, 'months');
			// linear across the month
			adjust = (b - anchor) / (anchor2 - anchor);
		}

		return -(wholeMonthDiff + adjust);
	}

	utils_hooks__hooks.defaultFormat = 'YYYY-MM-DDTHH:mm:ssZ';

	function toString () {
		return this.clone().locale('en').format('ddd MMM DD YYYY HH:mm:ss [GMT]ZZ');
	}

	function moment_format__toISOString () {
		var m = this.clone().utc();
		if (0 < m.year() && m.year() <= 9999) {
			if ('function' === typeof Date.prototype.toISOString) {
				// native implementation is ~50x faster, use it when we can
				return this.toDate().toISOString();
			} else {
				return formatMoment(m, 'YYYY-MM-DD[T]HH:mm:ss.SSS[Z]');
			}
		} else {
			return formatMoment(m, 'YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]');
		}
	}

	function format (inputString) {
		var output = formatMoment(this, inputString || utils_hooks__hooks.defaultFormat);
		return this.localeData().postformat(output);
	}

	function from (time, withoutSuffix) {
		return create__createDuration({to: this, from: time}).locale(this.locale()).humanize(!withoutSuffix);
	}

	function fromNow (withoutSuffix) {
		return this.from(local__createLocal(), withoutSuffix);
	}

	function locale (key) {
		var newLocaleData;

		if (key === undefined) {
			return this._locale._abbr;
		} else {
			newLocaleData = locale_locales__getLocale(key);
			if (newLocaleData != null) {
				this._locale = newLocaleData;
			}
			return this;
		}
	}

	var lang = deprecate(
		'moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.',
		function (key) {
			if (key === undefined) {
				return this.localeData();
			} else {
				return this.locale(key);
			}
		}
	);

	function localeData () {
		return this._locale;
	}

	function startOf (units) {
		units = normalizeUnits(units);
		// the following switch intentionally omits break keywords
		// to utilize falling through the cases.
		switch (units) {
			case 'year':
				this.month(0);
			/* falls through */
			case 'quarter':
			case 'month':
				this.date(1);
			/* falls through */
			case 'week':
			case 'isoWeek':
			case 'day':
				this.hours(0);
			/* falls through */
			case 'hour':
				this.minutes(0);
			/* falls through */
			case 'minute':
				this.seconds(0);
			/* falls through */
			case 'second':
				this.milliseconds(0);
		}

		// weeks are a special case
		if (units === 'week') {
			this.weekday(0);
		}
		if (units === 'isoWeek') {
			this.isoWeekday(1);
		}

		// quarters are also special
		if (units === 'quarter') {
			this.month(Math.floor(this.month() / 3) * 3);
		}

		return this;
	}

	function endOf (units) {
		units = normalizeUnits(units);
		if (units === undefined || units === 'millisecond') {
			return this;
		}
		return this.startOf(units).add(1, (units === 'isoWeek' ? 'week' : units)).subtract(1, 'ms');
	}

	function to_type__valueOf () {
		return +this._d - ((this._offset || 0) * 60000);
	}

	function unix () {
		return Math.floor(+this / 1000);
	}

	function toDate () {
		return this._offset ? new Date(+this) : this._d;
	}

	function toArray () {
		var m = this;
		return [m.year(), m.month(), m.date(), m.hour(), m.minute(), m.second(), m.millisecond()];
	}

	function moment_valid__isValid () {
		return valid__isValid(this);
	}

	function parsingFlags () {
		return extend({}, this._pf);
	}

	function invalidAt () {
		return this._pf.overflow;
	}

	addFormatToken(0, ['gg', 2], 0, function () {
		return this.weekYear() % 100;
	});

	addFormatToken(0, ['GG', 2], 0, function () {
		return this.isoWeekYear() % 100;
	});

	function addWeekYearFormatToken (token, getter) {
		addFormatToken(0, [token, token.length], 0, getter);
	}

	addWeekYearFormatToken('gggg',     'weekYear');
	addWeekYearFormatToken('ggggg',    'weekYear');
	addWeekYearFormatToken('GGGG',  'isoWeekYear');
	addWeekYearFormatToken('GGGGG', 'isoWeekYear');

	// ALIASES

	addUnitAlias('weekYear', 'gg');
	addUnitAlias('isoWeekYear', 'GG');

	// PARSING

	addRegexToken('G',      matchSigned);
	addRegexToken('g',      matchSigned);
	addRegexToken('GG',     match1to2, match2);
	addRegexToken('gg',     match1to2, match2);
	addRegexToken('GGGG',   match1to4, match4);
	addRegexToken('gggg',   match1to4, match4);
	addRegexToken('GGGGG',  match1to6, match6);
	addRegexToken('ggggg',  match1to6, match6);

	addWeekParseToken(['gggg', 'ggggg', 'GGGG', 'GGGGG'], function (input, week, config, token) {
		week[token.substr(0, 2)] = toInt(input);
	});

	addWeekParseToken(['gg', 'GG'], function (input, week, config, token) {
		week[token] = utils_hooks__hooks.parseTwoDigitYear(input);
	});

	// HELPERS

	function weeksInYear(year, dow, doy) {
		return weekOfYear(local__createLocal([year, 11, 31 + dow - doy]), dow, doy).week;
	}

	// MOMENTS

	function getSetWeekYear (input) {
		var year = weekOfYear(this, this.localeData()._week.dow, this.localeData()._week.doy).year;
		return input == null ? year : this.add((input - year), 'y');
	}

	function getSetISOWeekYear (input) {
		var year = weekOfYear(this, 1, 4).year;
		return input == null ? year : this.add((input - year), 'y');
	}

	function getISOWeeksInYear () {
		return weeksInYear(this.year(), 1, 4);
	}

	function getWeeksInYear () {
		var weekInfo = this.localeData()._week;
		return weeksInYear(this.year(), weekInfo.dow, weekInfo.doy);
	}

	addFormatToken('Q', 0, 0, 'quarter');

	// ALIASES

	addUnitAlias('quarter', 'Q');

	// PARSING

	addRegexToken('Q', match1);
	addParseToken('Q', function (input, array) {
		array[MONTH] = (toInt(input) - 1) * 3;
	});

	// MOMENTS

	function getSetQuarter (input) {
		return input == null ? Math.ceil((this.month() + 1) / 3) : this.month((input - 1) * 3 + this.month() % 3);
	}

	addFormatToken('D', ['DD', 2], 'Do', 'date');

	// ALIASES

	addUnitAlias('date', 'D');

	// PARSING

	addRegexToken('D',  match1to2);
	addRegexToken('DD', match1to2, match2);
	addRegexToken('Do', function (isStrict, locale) {
		return isStrict ? locale._ordinalParse : locale._ordinalParseLenient;
	});

	addParseToken(['D', 'DD'], DATE);
	addParseToken('Do', function (input, array) {
		array[DATE] = toInt(input.match(match1to2)[0], 10);
	});

	// MOMENTS

	var getSetDayOfMonth = makeGetSet('Date', true);

	addFormatToken('d', 0, 'do', 'day');

	addFormatToken('dd', 0, 0, function (format) {
		return this.localeData().weekdaysMin(this, format);
	});

	addFormatToken('ddd', 0, 0, function (format) {
		return this.localeData().weekdaysShort(this, format);
	});

	addFormatToken('dddd', 0, 0, function (format) {
		return this.localeData().weekdays(this, format);
	});

	addFormatToken('e', 0, 0, 'weekday');
	addFormatToken('E', 0, 0, 'isoWeekday');

	// ALIASES

	addUnitAlias('day', 'd');
	addUnitAlias('weekday', 'e');
	addUnitAlias('isoWeekday', 'E');

	// PARSING

	addRegexToken('d',    match1to2);
	addRegexToken('e',    match1to2);
	addRegexToken('E',    match1to2);
	addRegexToken('dd',   matchWord);
	addRegexToken('ddd',  matchWord);
	addRegexToken('dddd', matchWord);

	addWeekParseToken(['dd', 'ddd', 'dddd'], function (input, week, config) {
		var weekday = config._locale.weekdaysParse(input);
		// if we didn't get a weekday name, mark the date as invalid
		if (weekday != null) {
			week.d = weekday;
		} else {
			config._pf.invalidWeekday = input;
		}
	});

	addWeekParseToken(['d', 'e', 'E'], function (input, week, config, token) {
		week[token] = toInt(input);
	});

	// HELPERS

	function parseWeekday(input, locale) {
		if (typeof input === 'string') {
			if (!isNaN(input)) {
				input = parseInt(input, 10);
			}
			else {
				input = locale.weekdaysParse(input);
				if (typeof input !== 'number') {
					return null;
				}
			}
		}
		return input;
	}

	// LOCALES

	var defaultLocaleWeekdays = 'Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday'.split('_');
	function localeWeekdays (m) {
		return this._weekdays[m.day()];
	}

	var defaultLocaleWeekdaysShort = 'Sun_Mon_Tue_Wed_Thu_Fri_Sat'.split('_');
	function localeWeekdaysShort (m) {
		return this._weekdaysShort[m.day()];
	}

	var defaultLocaleWeekdaysMin = 'Su_Mo_Tu_We_Th_Fr_Sa'.split('_');
	function localeWeekdaysMin (m) {
		return this._weekdaysMin[m.day()];
	}

	function localeWeekdaysParse (weekdayName) {
		var i, mom, regex;

		if (!this._weekdaysParse) {
			this._weekdaysParse = [];
		}

		for (i = 0; i < 7; i++) {
			// make the regex if we don't have it already
			if (!this._weekdaysParse[i]) {
				mom = local__createLocal([2000, 1]).day(i);
				regex = '^' + this.weekdays(mom, '') + '|^' + this.weekdaysShort(mom, '') + '|^' + this.weekdaysMin(mom, '');
				this._weekdaysParse[i] = new RegExp(regex.replace('.', ''), 'i');
			}
			// test the regex
			if (this._weekdaysParse[i].test(weekdayName)) {
				return i;
			}
		}
	}

	// MOMENTS

	function getSetDayOfWeek (input) {
		var day = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
		if (input != null) {
			input = parseWeekday(input, this.localeData());
			return this.add(input - day, 'd');
		} else {
			return day;
		}
	}

	function getSetLocaleDayOfWeek (input) {
		var weekday = (this.day() + 7 - this.localeData()._week.dow) % 7;
		return input == null ? weekday : this.add(input - weekday, 'd');
	}

	function getSetISODayOfWeek (input) {
		// behaves the same as moment#day except
		// as a getter, returns 7 instead of 0 (1-7 range instead of 0-6)
		// as a setter, sunday should belong to the previous week.
		return input == null ? this.day() || 7 : this.day(this.day() % 7 ? input : input - 7);
	}

	addFormatToken('H', ['HH', 2], 0, 'hour');
	addFormatToken('h', ['hh', 2], 0, function () {
		return this.hours() % 12 || 12;
	});

	function meridiem (token, lowercase) {
		addFormatToken(token, 0, 0, function () {
			return this.localeData().meridiem(this.hours(), this.minutes(), lowercase);
		});
	}

	meridiem('a', true);
	meridiem('A', false);

	// ALIASES

	addUnitAlias('hour', 'h');

	// PARSING

	function matchMeridiem (isStrict, locale) {
		return locale._meridiemParse;
	}

	addRegexToken('a',  matchMeridiem);
	addRegexToken('A',  matchMeridiem);
	addRegexToken('H',  match1to2);
	addRegexToken('h',  match1to2);
	addRegexToken('HH', match1to2, match2);
	addRegexToken('hh', match1to2, match2);

	addParseToken(['H', 'HH'], HOUR);
	addParseToken(['a', 'A'], function (input, array, config) {
		config._isPm = config._locale.isPM(input);
		config._meridiem = input;
	});
	addParseToken(['h', 'hh'], function (input, array, config) {
		array[HOUR] = toInt(input);
		config._pf.bigHour = true;
	});

	// LOCALES

	function localeIsPM (input) {
		// IE8 Quirks Mode & IE7 Standards Mode do not allow accessing strings like arrays
		// Using charAt should be more compatible.
		return ((input + '').toLowerCase().charAt(0) === 'p');
	}

	var defaultLocaleMeridiemParse = /[ap]\.?m?\.?/i;
	function localeMeridiem (hours, minutes, isLower) {
		if (hours > 11) {
			return isLower ? 'pm' : 'PM';
		} else {
			return isLower ? 'am' : 'AM';
		}
	}


	// MOMENTS

	// Setting the hour should keep the time, because the user explicitly
	// specified which hour he wants. So trying to maintain the same hour (in
	// a new timezone) makes sense. Adding/subtracting hours does not follow
	// this rule.
	var getSetHour = makeGetSet('Hours', true);

	addFormatToken('m', ['mm', 2], 0, 'minute');

	// ALIASES

	addUnitAlias('minute', 'm');

	// PARSING

	addRegexToken('m',  match1to2);
	addRegexToken('mm', match1to2, match2);
	addParseToken(['m', 'mm'], MINUTE);

	// MOMENTS

	var getSetMinute = makeGetSet('Minutes', false);

	addFormatToken('s', ['ss', 2], 0, 'second');

	// ALIASES

	addUnitAlias('second', 's');

	// PARSING

	addRegexToken('s',  match1to2);
	addRegexToken('ss', match1to2, match2);
	addParseToken(['s', 'ss'], SECOND);

	// MOMENTS

	var getSetSecond = makeGetSet('Seconds', false);

	addFormatToken('S', 0, 0, function () {
		return ~~(this.millisecond() / 100);
	});

	addFormatToken(0, ['SS', 2], 0, function () {
		return ~~(this.millisecond() / 10);
	});

	function millisecond__milliseconds (token) {
		addFormatToken(0, [token, 3], 0, 'millisecond');
	}

	millisecond__milliseconds('SSS');
	millisecond__milliseconds('SSSS');

	// ALIASES

	addUnitAlias('millisecond', 'ms');

	// PARSING

	addRegexToken('S',    match1to3, match1);
	addRegexToken('SS',   match1to3, match2);
	addRegexToken('SSS',  match1to3, match3);
	addRegexToken('SSSS', matchUnsigned);
	addParseToken(['S', 'SS', 'SSS', 'SSSS'], function (input, array) {
		array[MILLISECOND] = toInt(('0.' + input) * 1000);
	});

	// MOMENTS

	var getSetMillisecond = makeGetSet('Milliseconds', false);

	addFormatToken('z',  0, 0, 'zoneAbbr');
	addFormatToken('zz', 0, 0, 'zoneName');

	// MOMENTS

	function getZoneAbbr () {
		return this._isUTC ? 'UTC' : '';
	}

	function getZoneName () {
		return this._isUTC ? 'Coordinated Universal Time' : '';
	}

	var momentPrototype__proto = Moment.prototype;

	momentPrototype__proto.add          = add_subtract__add;
	momentPrototype__proto.calendar     = moment_calendar__calendar;
	momentPrototype__proto.clone        = clone;
	momentPrototype__proto.diff         = diff;
	momentPrototype__proto.endOf        = endOf;
	momentPrototype__proto.format       = format;
	momentPrototype__proto.from         = from;
	momentPrototype__proto.fromNow      = fromNow;
	momentPrototype__proto.get          = getSet;
	momentPrototype__proto.invalidAt    = invalidAt;
	momentPrototype__proto.isAfter      = isAfter;
	momentPrototype__proto.isBefore     = isBefore;
	momentPrototype__proto.isBetween    = isBetween;
	momentPrototype__proto.isSame       = isSame;
	momentPrototype__proto.isValid      = moment_valid__isValid;
	momentPrototype__proto.lang         = lang;
	momentPrototype__proto.locale       = locale;
	momentPrototype__proto.localeData   = localeData;
	momentPrototype__proto.max          = prototypeMax;
	momentPrototype__proto.min          = prototypeMin;
	momentPrototype__proto.parsingFlags = parsingFlags;
	momentPrototype__proto.set          = getSet;
	momentPrototype__proto.startOf      = startOf;
	momentPrototype__proto.subtract     = add_subtract__subtract;
	momentPrototype__proto.toArray      = toArray;
	momentPrototype__proto.toDate       = toDate;
	momentPrototype__proto.toISOString  = moment_format__toISOString;
	momentPrototype__proto.toJSON       = moment_format__toISOString;
	momentPrototype__proto.toString     = toString;
	momentPrototype__proto.unix         = unix;
	momentPrototype__proto.valueOf      = to_type__valueOf;

	// Year
	momentPrototype__proto.year       = getSetYear;
	momentPrototype__proto.isLeapYear = getIsLeapYear;

	// Week Year
	momentPrototype__proto.weekYear    = getSetWeekYear;
	momentPrototype__proto.isoWeekYear = getSetISOWeekYear;

	// Quarter
	momentPrototype__proto.quarter = momentPrototype__proto.quarters = getSetQuarter;

	// Month
	momentPrototype__proto.month       = getSetMonth;
	momentPrototype__proto.daysInMonth = getDaysInMonth;

	// Week
	momentPrototype__proto.week           = momentPrototype__proto.weeks        = getSetWeek;
	momentPrototype__proto.isoWeek        = momentPrototype__proto.isoWeeks     = getSetISOWeek;
	momentPrototype__proto.weeksInYear    = getWeeksInYear;
	momentPrototype__proto.isoWeeksInYear = getISOWeeksInYear;

	// Day
	momentPrototype__proto.date       = getSetDayOfMonth;
	momentPrototype__proto.day        = momentPrototype__proto.days             = getSetDayOfWeek;
	momentPrototype__proto.weekday    = getSetLocaleDayOfWeek;
	momentPrototype__proto.isoWeekday = getSetISODayOfWeek;
	momentPrototype__proto.dayOfYear  = getSetDayOfYear;

	// Hour
	momentPrototype__proto.hour = momentPrototype__proto.hours = getSetHour;

	// Minute
	momentPrototype__proto.minute = momentPrototype__proto.minutes = getSetMinute;

	// Second
	momentPrototype__proto.second = momentPrototype__proto.seconds = getSetSecond;

	// Millisecond
	momentPrototype__proto.millisecond = momentPrototype__proto.milliseconds = getSetMillisecond;

	// Offset
	momentPrototype__proto.utcOffset            = getSetOffset;
	momentPrototype__proto.utc                  = setOffsetToUTC;
	momentPrototype__proto.local                = setOffsetToLocal;
	momentPrototype__proto.parseZone            = setOffsetToParsedOffset;
	momentPrototype__proto.hasAlignedHourOffset = hasAlignedHourOffset;
	momentPrototype__proto.isDST                = isDaylightSavingTime;
	momentPrototype__proto.isDSTShifted         = isDaylightSavingTimeShifted;
	momentPrototype__proto.isLocal              = isLocal;
	momentPrototype__proto.isUtcOffset          = isUtcOffset;
	momentPrototype__proto.isUtc                = isUtc;
	momentPrototype__proto.isUTC                = isUtc;

	// Timezone
	momentPrototype__proto.zoneAbbr = getZoneAbbr;
	momentPrototype__proto.zoneName = getZoneName;

	// Deprecations
	momentPrototype__proto.dates  = deprecate('dates accessor is deprecated. Use date instead.', getSetDayOfMonth);
	momentPrototype__proto.months = deprecate('months accessor is deprecated. Use month instead', getSetMonth);
	momentPrototype__proto.years  = deprecate('years accessor is deprecated. Use year instead', getSetYear);
	momentPrototype__proto.zone   = deprecate('moment().zone is deprecated, use moment().utcOffset instead. https://github.com/moment/moment/issues/1779', getSetZone);

	var momentPrototype = momentPrototype__proto;

	function moment__createUnix (input) {
		return local__createLocal(input * 1000);
	}

	function moment__createInZone () {
		return local__createLocal.apply(null, arguments).parseZone();
	}

	var defaultCalendar = {
		sameDay : '[Today at] LT',
		nextDay : '[Tomorrow at] LT',
		nextWeek : 'dddd [at] LT',
		lastDay : '[Yesterday at] LT',
		lastWeek : '[Last] dddd [at] LT',
		sameElse : 'L'
	};

	function locale_calendar__calendar (key, mom, now) {
		var output = this._calendar[key];
		return typeof output === 'function' ? output.call(mom, now) : output;
	}

	var defaultLongDateFormat = {
		LTS  : 'h:mm:ss A',
		LT   : 'h:mm A',
		L    : 'MM/DD/YYYY',
		LL   : 'MMMM D, YYYY',
		LLL  : 'MMMM D, YYYY LT',
		LLLL : 'dddd, MMMM D, YYYY LT'
	};

	function longDateFormat (key) {
		var output = this._longDateFormat[key];
		if (!output && this._longDateFormat[key.toUpperCase()]) {
			output = this._longDateFormat[key.toUpperCase()].replace(/MMMM|MM|DD|dddd/g, function (val) {
				return val.slice(1);
			});
			this._longDateFormat[key] = output;
		}
		return output;
	}

	var defaultInvalidDate = 'Invalid date';

	function invalidDate () {
		return this._invalidDate;
	}

	var defaultOrdinal = '%d';
	var defaultOrdinalParse = /\d{1,2}/;

	function ordinal (number) {
		return this._ordinal.replace('%d', number);
	}

	function preParsePostFormat (string) {
		return string;
	}

	var defaultRelativeTime = {
		future : 'in %s',
		past   : '%s ago',
		s  : 'a few seconds',
		m  : 'a minute',
		mm : '%d minutes',
		h  : 'an hour',
		hh : '%d hours',
		d  : 'a day',
		dd : '%d days',
		M  : 'a month',
		MM : '%d months',
		y  : 'a year',
		yy : '%d years'
	};

	function relative__relativeTime (number, withoutSuffix, string, isFuture) {
		var output = this._relativeTime[string];
		return (typeof output === 'function') ?
			output(number, withoutSuffix, string, isFuture) :
			output.replace(/%d/i, number);
	}

	function pastFuture (diff, output) {
		var format = this._relativeTime[diff > 0 ? 'future' : 'past'];
		return typeof format === 'function' ? format(output) : format.replace(/%s/i, output);
	}

	function locale_set__set (config) {
		var prop, i;
		for (i in config) {
			prop = config[i];
			if (typeof prop === 'function') {
				this[i] = prop;
			} else {
				this['_' + i] = prop;
			}
		}
		// Lenient ordinal parsing accepts just a number in addition to
		// number + (possibly) stuff coming from _ordinalParseLenient.
		this._ordinalParseLenient = new RegExp(this._ordinalParse.source + '|' + /\d{1,2}/.source);
	}

	var prototype__proto = Locale.prototype;

	prototype__proto._calendar       = defaultCalendar;
	prototype__proto.calendar        = locale_calendar__calendar;
	prototype__proto._longDateFormat = defaultLongDateFormat;
	prototype__proto.longDateFormat  = longDateFormat;
	prototype__proto._invalidDate    = defaultInvalidDate;
	prototype__proto.invalidDate     = invalidDate;
	prototype__proto._ordinal        = defaultOrdinal;
	prototype__proto.ordinal         = ordinal;
	prototype__proto._ordinalParse   = defaultOrdinalParse;
	prototype__proto.preparse        = preParsePostFormat;
	prototype__proto.postformat      = preParsePostFormat;
	prototype__proto._relativeTime   = defaultRelativeTime;
	prototype__proto.relativeTime    = relative__relativeTime;
	prototype__proto.pastFuture      = pastFuture;
	prototype__proto.set             = locale_set__set;

	// Month
	prototype__proto.months       =        localeMonths;
	prototype__proto._months      = defaultLocaleMonths;
	prototype__proto.monthsShort  =        localeMonthsShort;
	prototype__proto._monthsShort = defaultLocaleMonthsShort;
	prototype__proto.monthsParse  =        localeMonthsParse;

	// Week
	prototype__proto.week = localeWeek;
	prototype__proto._week = defaultLocaleWeek;
	prototype__proto.firstDayOfYear = localeFirstDayOfYear;
	prototype__proto.firstDayOfWeek = localeFirstDayOfWeek;

	// Day of Week
	prototype__proto.weekdays       =        localeWeekdays;
	prototype__proto._weekdays      = defaultLocaleWeekdays;
	prototype__proto.weekdaysMin    =        localeWeekdaysMin;
	prototype__proto._weekdaysMin   = defaultLocaleWeekdaysMin;
	prototype__proto.weekdaysShort  =        localeWeekdaysShort;
	prototype__proto._weekdaysShort = defaultLocaleWeekdaysShort;
	prototype__proto.weekdaysParse  =        localeWeekdaysParse;

	// Hours
	prototype__proto.isPM = localeIsPM;
	prototype__proto._meridiemParse = defaultLocaleMeridiemParse;
	prototype__proto.meridiem = localeMeridiem;

	function lists__get (format, index, field, setter) {
		var locale = locale_locales__getLocale();
		var utc = create_utc__createUTC().set(setter, index);
		return locale[field](utc, format);
	}

	function list (format, index, field, count, setter) {
		if (typeof format === 'number') {
			index = format;
			format = undefined;
		}

		format = format || '';

		if (index != null) {
			return lists__get(format, index, field, setter);
		}

		var i;
		var out = [];
		for (i = 0; i < count; i++) {
			out[i] = lists__get(format, i, field, setter);
		}
		return out;
	}

	function lists__listMonths (format, index) {
		return list(format, index, 'months', 12, 'month');
	}

	function lists__listMonthsShort (format, index) {
		return list(format, index, 'monthsShort', 12, 'month');
	}

	function lists__listWeekdays (format, index) {
		return list(format, index, 'weekdays', 7, 'day');
	}

	function lists__listWeekdaysShort (format, index) {
		return list(format, index, 'weekdaysShort', 7, 'day');
	}

	function lists__listWeekdaysMin (format, index) {
		return list(format, index, 'weekdaysMin', 7, 'day');
	}

	locale_locales__getSetGlobalLocale('en', {
		ordinalParse: /\d{1,2}(th|st|nd|rd)/,
		ordinal : function (number) {
			var b = number % 10,
				output = (toInt(number % 100 / 10) === 1) ? 'th' :
					(b === 1) ? 'st' :
						(b === 2) ? 'nd' :
							(b === 3) ? 'rd' : 'th';
			return number + output;
		}
	});

	// Side effect imports
	utils_hooks__hooks.lang = deprecate('moment.lang is deprecated. Use moment.locale instead.', locale_locales__getSetGlobalLocale);
	utils_hooks__hooks.langData = deprecate('moment.langData is deprecated. Use moment.localeData instead.', locale_locales__getLocale);

	var mathAbs = Math.abs;

	function duration_abs__abs () {
		var data           = this._data;

		this._milliseconds = mathAbs(this._milliseconds);
		this._days         = mathAbs(this._days);
		this._months       = mathAbs(this._months);

		data.milliseconds  = mathAbs(data.milliseconds);
		data.seconds       = mathAbs(data.seconds);
		data.minutes       = mathAbs(data.minutes);
		data.hours         = mathAbs(data.hours);
		data.months        = mathAbs(data.months);
		data.years         = mathAbs(data.years);

		return this;
	}

	function duration_add_subtract__addSubtract (duration, input, value, direction) {
		var other = create__createDuration(input, value);

		duration._milliseconds += direction * other._milliseconds;
		duration._days         += direction * other._days;
		duration._months       += direction * other._months;

		return duration._bubble();
	}

	// supports only 2.0-style add(1, 's') or add(duration)
	function duration_add_subtract__add (input, value) {
		return duration_add_subtract__addSubtract(this, input, value, 1);
	}

	// supports only 2.0-style subtract(1, 's') or subtract(duration)
	function duration_add_subtract__subtract (input, value) {
		return duration_add_subtract__addSubtract(this, input, value, -1);
	}

	function bubble () {
		var milliseconds = this._milliseconds;
		var days         = this._days;
		var months       = this._months;
		var data         = this._data;
		var seconds, minutes, hours, years = 0;

		// The following code bubbles up values, see the tests for
		// examples of what that means.
		data.milliseconds = milliseconds % 1000;

		seconds           = absFloor(milliseconds / 1000);
		data.seconds      = seconds % 60;

		minutes           = absFloor(seconds / 60);
		data.minutes      = minutes % 60;

		hours             = absFloor(minutes / 60);
		data.hours        = hours % 24;

		days += absFloor(hours / 24);

		// Accurately convert days to years, assume start from year 0.
		years = absFloor(daysToYears(days));
		days -= absFloor(yearsToDays(years));

		// 30 days to a month
		// TODO (iskren): Use anchor date (like 1st Jan) to compute this.
		months += absFloor(days / 30);
		days   %= 30;

		// 12 months -> 1 year
		years  += absFloor(months / 12);
		months %= 12;

		data.days   = days;
		data.months = months;
		data.years  = years;

		return this;
	}

	function daysToYears (days) {
		// 400 years have 146097 days (taking into account leap year rules)
		return days * 400 / 146097;
	}

	function yearsToDays (years) {
		// years * 365 + absFloor(years / 4) -
		//     absFloor(years / 100) + absFloor(years / 400);
		return years * 146097 / 400;
	}

	function as (units) {
		var days;
		var months;
		var milliseconds = this._milliseconds;

		units = normalizeUnits(units);

		if (units === 'month' || units === 'year') {
			days   = this._days   + milliseconds / 864e5;
			months = this._months + daysToYears(days) * 12;
			return units === 'month' ? months : months / 12;
		} else {
			// handle milliseconds separately because of floating point math errors (issue #1867)
			days = this._days + Math.round(yearsToDays(this._months / 12));
			switch (units) {
				case 'week'   : return days / 7            + milliseconds / 6048e5;
				case 'day'    : return days                + milliseconds / 864e5;
				case 'hour'   : return days * 24           + milliseconds / 36e5;
				case 'minute' : return days * 24 * 60      + milliseconds / 6e4;
				case 'second' : return days * 24 * 60 * 60 + milliseconds / 1000;
				// Math.floor prevents floating point math errors here
				case 'millisecond': return Math.floor(days * 24 * 60 * 60 * 1000) + milliseconds;
				default: throw new Error('Unknown unit ' + units);
			}
		}
	}

	// TODO: Use this.as('ms')?
	function duration_as__valueOf () {
		return (
		this._milliseconds +
		this._days * 864e5 +
		(this._months % 12) * 2592e6 +
		toInt(this._months / 12) * 31536e6
		);
	}

	function makeAs (alias) {
		return function () {
			return this.as(alias);
		};
	}

	var asMilliseconds = makeAs('ms');
	var asSeconds      = makeAs('s');
	var asMinutes      = makeAs('m');
	var asHours        = makeAs('h');
	var asDays         = makeAs('d');
	var asWeeks        = makeAs('w');
	var asMonths       = makeAs('M');
	var asYears        = makeAs('y');

	function duration_get__get (units) {
		units = normalizeUnits(units);
		return this[units + 's']();
	}

	function makeGetter(name) {
		return function () {
			return this._data[name];
		};
	}

	var duration_get__milliseconds = makeGetter('milliseconds');
	var seconds      = makeGetter('seconds');
	var minutes      = makeGetter('minutes');
	var hours        = makeGetter('hours');
	var days         = makeGetter('days');
	var months       = makeGetter('months');
	var years        = makeGetter('years');

	function weeks () {
		return absFloor(this.days() / 7);
	}

	var round = Math.round;
	var thresholds = {
		s: 45,  // seconds to minute
		m: 45,  // minutes to hour
		h: 22,  // hours to day
		d: 26,  // days to month
		M: 11   // months to year
	};

	// helper function for moment.fn.from, moment.fn.fromNow, and moment.duration.fn.humanize
	function substituteTimeAgo(string, number, withoutSuffix, isFuture, locale) {
		return locale.relativeTime(number || 1, !!withoutSuffix, string, isFuture);
	}

	function duration_humanize__relativeTime (posNegDuration, withoutSuffix, locale) {
		var duration = create__createDuration(posNegDuration).abs();
		var seconds  = round(duration.as('s'));
		var minutes  = round(duration.as('m'));
		var hours    = round(duration.as('h'));
		var days     = round(duration.as('d'));
		var months   = round(duration.as('M'));
		var years    = round(duration.as('y'));

		var a = seconds < thresholds.s && ['s', seconds]  ||
			minutes === 1          && ['m']           ||
			minutes < thresholds.m && ['mm', minutes] ||
			hours   === 1          && ['h']           ||
			hours   < thresholds.h && ['hh', hours]   ||
			days    === 1          && ['d']           ||
			days    < thresholds.d && ['dd', days]    ||
			months  === 1          && ['M']           ||
			months  < thresholds.M && ['MM', months]  ||
			years   === 1          && ['y']           || ['yy', years];

		a[2] = withoutSuffix;
		a[3] = +posNegDuration > 0;
		a[4] = locale;
		return substituteTimeAgo.apply(null, a);
	}

	// This function allows you to set a threshold for relative time strings
	function duration_humanize__getSetRelativeTimeThreshold (threshold, limit) {
		if (thresholds[threshold] === undefined) {
			return false;
		}
		if (limit === undefined) {
			return thresholds[threshold];
		}
		thresholds[threshold] = limit;
		return true;
	}

	function humanize (withSuffix) {
		var locale = this.localeData();
		var output = duration_humanize__relativeTime(this, !withSuffix, locale);

		if (withSuffix) {
			output = locale.pastFuture(+this, output);
		}

		return locale.postformat(output);
	}

	var iso_string__abs = Math.abs;

	function iso_string__toISOString() {
		// inspired by https://github.com/dordille/moment-isoduration/blob/master/moment.isoduration.js
		var Y = iso_string__abs(this.years());
		var M = iso_string__abs(this.months());
		var D = iso_string__abs(this.days());
		var h = iso_string__abs(this.hours());
		var m = iso_string__abs(this.minutes());
		var s = iso_string__abs(this.seconds() + this.milliseconds() / 1000);
		var total = this.asSeconds();

		if (!total) {
			// this is the same as C#'s (Noda) and python (isodate)...
			// but not other JS (goog.date)
			return 'P0D';
		}

		return (total < 0 ? '-' : '') +
			'P' +
			(Y ? Y + 'Y' : '') +
			(M ? M + 'M' : '') +
			(D ? D + 'D' : '') +
			((h || m || s) ? 'T' : '') +
			(h ? h + 'H' : '') +
			(m ? m + 'M' : '') +
			(s ? s + 'S' : '');
	}

	var duration_prototype__proto = Duration.prototype;

	duration_prototype__proto.abs            = duration_abs__abs;
	duration_prototype__proto.add            = duration_add_subtract__add;
	duration_prototype__proto.subtract       = duration_add_subtract__subtract;
	duration_prototype__proto.as             = as;
	duration_prototype__proto.asMilliseconds = asMilliseconds;
	duration_prototype__proto.asSeconds      = asSeconds;
	duration_prototype__proto.asMinutes      = asMinutes;
	duration_prototype__proto.asHours        = asHours;
	duration_prototype__proto.asDays         = asDays;
	duration_prototype__proto.asWeeks        = asWeeks;
	duration_prototype__proto.asMonths       = asMonths;
	duration_prototype__proto.asYears        = asYears;
	duration_prototype__proto.valueOf        = duration_as__valueOf;
	duration_prototype__proto._bubble        = bubble;
	duration_prototype__proto.get            = duration_get__get;
	duration_prototype__proto.milliseconds   = duration_get__milliseconds;
	duration_prototype__proto.seconds        = seconds;
	duration_prototype__proto.minutes        = minutes;
	duration_prototype__proto.hours          = hours;
	duration_prototype__proto.days           = days;
	duration_prototype__proto.weeks          = weeks;
	duration_prototype__proto.months         = months;
	duration_prototype__proto.years          = years;
	duration_prototype__proto.humanize       = humanize;
	duration_prototype__proto.toISOString    = iso_string__toISOString;
	duration_prototype__proto.toString       = iso_string__toISOString;
	duration_prototype__proto.toJSON         = iso_string__toISOString;
	duration_prototype__proto.locale         = locale;
	duration_prototype__proto.localeData     = localeData;

	// Deprecations
	duration_prototype__proto.toIsoString = deprecate('toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)', iso_string__toISOString);
	duration_prototype__proto.lang = lang;

	// Side effect imports

	addFormatToken('X', 0, 0, 'unix');
	addFormatToken('x', 0, 0, 'valueOf');

	// PARSING

	addRegexToken('x', matchSigned);
	addRegexToken('X', matchTimestamp);
	addParseToken('X', function (input, array, config) {
		config._d = new Date(parseFloat(input, 10) * 1000);
	});
	addParseToken('x', function (input, array, config) {
		config._d = new Date(toInt(input));
	});

	// Side effect imports


	utils_hooks__hooks.version = '2.10.2';

	setHookCallback(local__createLocal);

	utils_hooks__hooks.fn                    = momentPrototype;
	utils_hooks__hooks.min                   = min;
	utils_hooks__hooks.max                   = max;
	utils_hooks__hooks.utc                   = create_utc__createUTC;
	utils_hooks__hooks.unix                  = moment__createUnix;
	utils_hooks__hooks.months                = lists__listMonths;
	utils_hooks__hooks.isDate                = isDate;
	utils_hooks__hooks.locale                = locale_locales__getSetGlobalLocale;
	utils_hooks__hooks.invalid               = valid__createInvalid;
	utils_hooks__hooks.duration              = create__createDuration;
	utils_hooks__hooks.isMoment              = isMoment;
	utils_hooks__hooks.weekdays              = lists__listWeekdays;
	utils_hooks__hooks.parseZone             = moment__createInZone;
	utils_hooks__hooks.localeData            = locale_locales__getLocale;
	utils_hooks__hooks.isDuration            = isDuration;
	utils_hooks__hooks.monthsShort           = lists__listMonthsShort;
	utils_hooks__hooks.weekdaysMin           = lists__listWeekdaysMin;
	utils_hooks__hooks.defineLocale          = defineLocale;
	utils_hooks__hooks.weekdaysShort         = lists__listWeekdaysShort;
	utils_hooks__hooks.normalizeUnits        = normalizeUnits;
	utils_hooks__hooks.relativeTimeThreshold = duration_humanize__getSetRelativeTimeThreshold;

	var _moment = utils_hooks__hooks;

	return _moment;

}));/**
 * Header fix
 */
$(function(){

	var $left_side = $('.left-side'),
		$right_side = $('.right-side');

	$(window).bind('resize', function(){
		$right_side.css('height', $left_side.height());
	});
});

/**
 * Flash of unstyled content fix
 */
$(function(){
	$('img').imagesLoaded(function(){
		$('body').css('opacity', 1);
	});

	WebFont.load({
		custom: {
			families: ['AkzidenzGrotesk']
		}
	});
});

/**
 * Share buttons
 */
$(function(){
	$('.share-buttons a').click(function(e){

		var name = $(this).data('name');
		ga('send', 'event', 'social', 'click', name + '-share');

		if ( this.name == 'facebook' ) {
			e.preventDefault();

			FB.ui({
				method: 'share',
				href: 'https://developers.facebook.com/docs/'
			}, function(response){});

			return;
		}

		var popup = window.open( $(this).attr('href'), 'share-dialog', 'width=626,height=436');

		if ( popup )
			e.preventDefault();

	});
});


/**
 * Follow buttons
 */
$(function(){
	$('.follow a').click(function(e){
		ga('send', 'event', 'social', 'click', $(this).data('name') + '-follow');
	});
});

/**
 *  Timer
 */
$(function(){

	var request_frame = window.requestAnimationFrame ?
		function(callback){
			window.requestAnimationFrame(callback);
		}
		:
		function(callback) {
			setTimeout(callback, 1)
		};

	function pad(n, width, z) {
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}

	var end = moment('2015-05-09T18:00:00+02:00');

	request_frame(function step(){

		var now = moment(),
			days = end.diff(now, 'days'),
			hours = end.diff(now, 'hours'),
			minutes = end.diff(now, 'minutes'),
			seconds = end.diff(now, 'seconds'),
			milliseconds = end.diff(now, 'milliseconds');

		milliseconds -= seconds * 1000;
		seconds -= minutes * 60;
		minutes -= hours * 60;
		hours -= days * 24;

		days = 0 < days ? days : 0;
		hours = 0 < hours ? hours : 0;
		minutes = 0 < minutes ? minutes : 0;
		seconds = 0 < seconds ? seconds : 0;
		milliseconds = 0 < milliseconds ? milliseconds : 0;

		milliseconds = pad(milliseconds, 3);
		seconds = '' + pad(seconds, 2);
		minutes = '' + pad(minutes, 2);
		hours = '' + pad(hours, 2);

		var str =
			( days ? days + ':' : '') +
			hours + ':' + minutes + ':' + seconds + ':' + milliseconds;

		$('.countdown').html( str );

		request_frame(step);

	});

});

/**
 * Newsletter dialog
 */
$(function(){

	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}

	var $dialog = $('.newsletter-dialog');

	$('.toggle-dialog').click(function(e){
		e.preventDefault();
		$dialog[ !$dialog.is('.active') ? 'addClass' : 'removeClass' ]('active');
	});

	$('body, iframe').click(function(e){
		var $target = $(e.target);
		if ( $target.is('.close-dialog') || (!$target.closest($dialog).length && !$target.is('.toggle-dialog') ) ) {
			$dialog.removeClass('active');
		}
	});

	var $error_msg = $('.form-error');
	var $input = $('.newsletter-dialog input[type="text"]');
	$('.newsletter-dialog .button').click(function(){

		if ( !validateEmail( $input.val() ) ) {
			$error_msg.show();
			return;
		}

		$error_msg.hide();

		$.ajax({
			type: "POST",
			url: 'drkn-teaser/signup',
			data: {email: $input.val()},
			success: function(){
				ga('send', 'event', 'newsletter', 'click', 'newsletter-signup');

				$('.newsletter-dialog').html('You have signed up');
				$(window).trigger('resize');
			}
		});

	});

	$(window).bind('resize', function(){
		return;
		$dialog.css({
			marginLeft: Math.floor( - $dialog.outerWidth() / 2 ),
			marginTop: - $dialog.height() / 2
		});
	});
});

/**
 * Code dialog
 */
$(function(){

	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}

	var $dialog = $('.code-dialog');

	var $toggle = $('.toggle-code').click(function(e){
		e.preventDefault();
		$dialog[ !$dialog.is('.active') ? 'addClass' : 'removeClass' ]('active');

		if ( $dialog.is('.active') ) {

			$dialog.css({
				left: ( $toggle.offset().left + (  $toggle.width() - $dialog.width() ) / 2 ) - 14
			});

		}
	});

	$('body, iframe').click(function(e){
		var $target = $(e.target);
		if ( $target.is('.close-code-dialog') || (!$target.closest($dialog).length && !$target.is('.toggle-code') ) ) {
			$dialog.removeClass('active');
		}
	});

	var $error_msg = $('.form-code-error.email');
	var $code_error_msg = $('.form-code-error.code');
	var $code = $('.code-dialog input[type="text"]').first();
	var $email = $('.code-dialog input[type="text"]').last();
	$('.code-dialog .button').click(function(){

		if ( !validateEmail( $email.val() ) ) {
			$error_msg.show();
			return;
		}
		else
			$error_msg.hide();

		$error_msg.hide();

		$.ajax({
			type: "POST",
			url: 'drkn-teaser/red-pill',
			data: {
				email: $email.val(),
				code: $code.val()
			},
			success: function( response ){
				console.log('response', response);
				if ( response )
					window.location.reload();
				else
					$code_error_msg.show();
				//$('.code-dialog').html('You have signed up');
				//$(window).trigger('resize');
			}
		});

	});

	$(window).bind('resize', function(){
		return;
		$dialog.css({
			marginLeft: Math.floor( - $dialog.outerWidth() / 2 ),
			marginTop: - $dialog.height() / 2
		});
	});
});

/**
 * Video embed 
 */

$(function(){
	
	var $window = $(window),
		$header = $('header'),
		$container = $('article');

	$window.bind('resize', function(){

		var width = $window.width(),
			height = $window.height(),
			header_height = $header.outerHeight(),
			max_height = $window.height() - header_height;

		var video_width = width,
			video_height = width * 0.5625;

		if ( max_height < video_height )
			video_width = max_height / 0.5625,
			video_height = max_height;

		var top = ( height - video_height ) / 2;

		if ( top < header_height )
			top = header_height;

		//console.log('max_height', max_height);
		//console.log('width', width);
		//console.log('video_width', video_width);

		$container.css({
			width: video_width,
			height: video_height,
			top: top - header_height,
			left: ( width - video_width ) / 2
		});

	}).trigger('resize');

	var i = 0;
	var interval_id = setInterval(function(){
		i++;
		if ( 50 < i )
			clearInterval(interval_id);
		$window.trigger('resize');
		//console.log('trigger');
	}, 100);

});

/*
 *
 */
$(function(){

	$(window).bind('resize', function(){

		var $code = $('.toggle-code');
		if ( $(window).width() < 650 ) {
			$code.attr('style', '').css({
				display: 'block',
				margin: 0,
				textAlign: 'center',
				position: 'relative',
				width: $(window).width()
			});
		}
		else {
			$code.css({
				'position': 'absolute',
				'white-space': 'pre',
				'margin':  0,
				'top': '44px',
				'left': '50%',
				'marginLeft': (-$code.width() / 2) + ( ( $('.left-side').width() - $('.right-side').width() ) / 2 )
			});
		}

	}).trigger('resize');

});
