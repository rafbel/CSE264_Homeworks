YUI.add("moodle-core-event",function(e,t){var n="moodle-core-event";M.core=M.core||{},M.core.event=M.core.event||{FILTER_CONTENT_UPDATED:"filter-content-updated"},M.core.globalEvents=M.core.globalEvents||{FORM_ERROR:"form_error"};var r={emitFacade:!0,defaultFn:function(e){},preventedFn:function(e){},stoppedFn:function(e){}},i;for(i in M.core.event)M.core.event.hasOwnProperty(i)&&e.getEvent(M.core.event[i])===null&&e.publish(M.core.event[i],r);for(i in M.core.globalEvents)M.core.globalEvents.hasOwnProperty(i)&&e.Global.getEvent(M.core.globalEvents[i])===null&&e.Global.publish(M.core.globalEvents[i],e.merge(r,{broadcast:!0}))},"@VERSION@",{requires:["event-custom"]});
/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("event-touch",function(e,t){var n="scale",r="rotation",i="identifier",s=e.config.win,o={};e.DOMEventFacade.prototype._touch=function(t,s,o){var u,a,f,l,c;if(t.touches){this.touches=[],c={};for(u=0,a=t.touches.length;u<a;++u)l=t.touches[u],c[e.stamp(l)]=this.touches[u]=new e.DOMEventFacade(l,s,o)}if(t.targetTouches){this.targetTouches=[];for(u=0,a=t.targetTouches.length;u<a;++u)l=t.targetTouches[u],f=c&&c[e.stamp(l,!0)],this.targetTouches[u]=f||new e.DOMEventFacade(l,s,o)}if(t.changedTouches){this.changedTouches=[];for(u=0,a=t.changedTouches.length;u<a;++u)l=t.changedTouches[u],f=c&&c[e.stamp(l,!0)],this.changedTouches[u]=f||new e.DOMEventFacade(l,s,o)}n in t&&(this[n]=t[n]),r in t&&(this[r]=t[r]),i in t&&(this[i]=t[i])},e.Node.DOM_EVENTS&&e.mix(e.Node.DOM_EVENTS,{touchstart:1,touchmove:1,touchend:1,touchcancel:1,gesturestart:1,gesturechange:1,gestureend:1,MSPointerDown:1,MSPointerUp:1,MSPointerMove:1,MSPointerCancel:1,pointerdown:1,pointerup:1,pointermove:1,pointercancel:1}),s&&"ontouchstart"in s&&!(e.UA.chrome&&e.UA.chrome<6)?(o.start=["touchstart","mousedown"],o.end=["touchend","mouseup"],o.move=["touchmove","mousemove"],o.cancel=["touchcancel","mousecancel"]):s&&s.PointerEvent?(o.start="pointerdown",o.end="pointerup",o.move="pointermove",o.cancel="pointercancel"):s&&"msPointerEnabled"in s.navigator?(o.start="MSPointerDown",o.end="MSPointerUp",o.move="MSPointerMove",o.cancel="MSPointerCancel"):(o.start="mousedown",o.end="mouseup",o.move="mousemove",o.cancel="mousecancel"),e.Event._GESTURE_MAP=o},"3.17.2",{requires:["node-base"]});
/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("event-flick",function(e,t){var n=e.Event._GESTURE_MAP,r={start:n.start,end:n.end,move:n.move},i="start",s="end",o="move",u="ownerDocument",a="minVelocity",f="minDistance",l="preventDefault",c="_fs",h="_fsh",p="_feh",d="_fmh",v="nodeType";e.Event.define("flick",{on:function(e,t,n){var s=e.on(r[i],this._onStart,this,e,t,n);t[h]=s},detach:function(e,t,n){var r=t[h],i=t[p];r&&(r.detach(),t[h]=null),i&&(i.detach(),t[p]=null)},processArgs:function(t){var n=t.length>3?e.merge(t.splice(3,1)[0]):{};return a in n||(n[a]=this.MIN_VELOCITY),f in n||(n[f]=this.MIN_DISTANCE),l in n||(n[l]=this.PREVENT_DEFAULT),n},_onStart:function(t,n,i,a){var f=!0,l,h,m,g=i._extra.preventDefault,y=t;t.touches&&(f=t.touches.length===1,t=t.touches[0]),f&&(g&&(!g.call||g(t))&&y.preventDefault(),t.flick={time:(new Date).getTime()},i[c]=t,l=i[p],m=n.get(v)===9?n:n.get(u),l||(l=m.on(r[s],e.bind(this._onEnd,this),null,n,i,a),i[p]=l),i[d]=m.once(r[o],e.bind(this._onMove,this),null,n,i,a))},_onMove:function(e,t,n,r){var i=n[c];i&&i.flick&&(i.flick.time=(new Date).getTime())},_onEnd:function(e,t,n,r){var i=(new Date).getTime(),s=n[c],o=!!s,u=e,h,p,v,m,g,y,b,w,E=n[d];E&&(E.detach(),delete n[d]),o&&(e.changedTouches&&(e.changedTouches.length===1&&e.touches.length===0?u=e.changedTouches[0]:o=!1),o&&(m=n._extra,v=m[l],v&&(!v.call||v(e))&&e.preventDefault(),h=s.flick.time,i=(new Date).getTime(),p=i-h,g=[u.pageX-s.pageX,u.pageY-s.pageY],m.axis?w=m.axis:w=Math.abs(g[0])>=Math.abs(g[1])?"x":"y",y=g[w==="x"?0:1],b=p!==0?y/p:0,isFinite(b)&&Math.abs(y)>=m[f]&&Math.abs(b)>=m[a]&&(e.type="flick",e.flick={time:p,distance:y,velocity:b,axis:w,start:s},r.fire(e)),n[c]=null))},MIN_VELOCITY:0,MIN_DISTANCE:0,PREVENT_DEFAULT:!1})},"3.17.2",{requires:["node-base","event-touch","event-synthetic"]});
/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("event-move",function(e,t){var n=e.Event._GESTURE_MAP,r={start:n.start,end:n.end,move:n.move},i="start",s="move",o="end",u="gesture"+s,a=u+o,f=u+i,l="_msh",c="_mh",h="_meh",p="_dmsh",d="_dmh",v="_dmeh",m="_ms",g="_m",y="minTime",b="minDistance",w="preventDefault",E="button",S="ownerDocument",x="currentTarget",T="target",N="nodeType",C=e.config.win&&"msPointerEnabled"in e.config.win.navigator,k="msTouchActionCount",L="msInitTouchAction",A=function(t,n,r){var i=r?4:3,s=n.length>i?e.merge(n.splice(i,1)[0]):{};return w in s||(s[w]=t.PREVENT_DEFAULT),s},O=function(e,t){return t._extra.root||e.get(N)===9?e:e.get(S)},M=function(t){var n=t.getDOMNode();return t.compareTo(e.config.doc)&&n.documentElement?n.documentElement:!1},_=function(e,t,n){e.pageX=t.pageX,e.pageY=t.pageY,e.screenX=t.screenX,e.screenY=t.screenY,e.clientX=t.clientX,e.clientY=t.clientY,e[T]=e[T]||t[T],e[x]=e[x]||t[x],e[E]=n&&n[E]||1},D=function(t){var n=M(t)||t.getDOMNode(),r=t.getData(k);C&&(r||(r=0,t.setData(L,n.style.msTouchAction)),n.style.msTouchAction=e.Event._DEFAULT_TOUCH_ACTION,r++,t.setData(k,r))},P=function(e){var t=M(e)||e.getDOMNode(),n=e.getData(k),r=e.getData(L);C&&(n--,e.setData(k,n),n===0&&t.style.msTouchAction!==r&&(t.style.msTouchAction=r))},H=function(e,t){t&&(!t.call||t(e))&&e.preventDefault()},B=e.Event.define;e.Event._DEFAULT_TOUCH_ACTION="none",B(f,{on:function(e,t,n){D(e),t[l]=e.on(r[i],this._onStart,this,e,t,n)},delegate:function(e,t,n,s){var o=this;t[p]=e.delegate(r[i],function(r){o._onStart(r,e,t,n,!0)},s)},detachDelegate:function(e,t,n,r){var i=t[p];i&&(i.detach(),t[p]=null),P(e)},detach:function(e,t,n){var r=t[l];r&&(r.detach(),t[l]=null),P(e)},processArgs:function(e,t){var n=A(this,e,t);return y in n||(n[y]=this.MIN_TIME),b in n||(n[b]=this.MIN_DISTANCE),n},_onStart:function(t,n,i,u,a){a&&(n=t[x]);var f=i._extra,l=!0,c=f[y],h=f[b],p=f.button,d=f[w],v=O(n,i),m;t.touches?t.touches.length===1?_(t,t.touches[0],f):l=!1:l=p===undefined||p===t.button,l&&(H(t,d),c===0||h===0?this._start(t,n,u,f):(m=[t.pageX,t.pageY],c>0&&(f._ht=e.later(c,this,this._start,[t,n,u,f]),f._hme=v.on(r[o],e.bind(function(){this._cancel(f)},this))),h>0&&(f._hm=v.on(r[s],e.bind(function(e){(Math.abs(e.pageX-m[0])>h||Math.abs(e.pageY-m[1])>h)&&this._start(t,n,u,f)},this)))))},_cancel:function(e){e._ht&&(e._ht.cancel(),e._ht=null),e._hme&&(e._hme.detach(),e._hme=null),e._hm&&(e._hm.detach(),e._hm=null)},_start:function(e,t,n,r){r&&this._cancel(r),e.type=f,t.setData(m,e),n.fire(e)},MIN_TIME:0,MIN_DISTANCE:0,PREVENT_DEFAULT:!1}),B(u,{on:function(e,t,n){D(e);var i=O(e,t,r[s]),o=i.on(r[s],this._onMove,this,e,t,n);t[c]=o},delegate:function(e,t,n,i){var o=this;t[d]=e.delegate(r[s],function(r){o._onMove(r,e,t,n,!0)},i)},detach:function(e,t,n){var r=t[c];r&&(r.detach(),t[c]=null),P(e)},detachDelegate:function(e,t,n,r){var i=t[d];i&&(i.detach(),t[d]=null),P(e)},processArgs:function(e,t){return A(this,e,t)},_onMove:function(e,t,n,r,i){i&&(t=e[x]);var s=n._extra.standAlone||t.getData(m),o=n._extra.preventDefault;s&&(e.touches&&(e.touches.length===1?_(e,e.touches[0]):s=!1),s&&(H(e,o),e.type=u,r.fire(e)))},PREVENT_DEFAULT:!1}),B(a,{on:function(e,t,n){D(e);var i=O(e,t),s=i.on(r[o],this._onEnd,this,e,t,n);t[h]=s},delegate:function(e,t,n,i){var s=this;t[v]=e.delegate(r[o],function(r){s._onEnd(r,e,t,n,!0)},i)},detachDelegate:function(e,t,n,r){var i=t[v];i&&(i.detach(),t[v]=null),P(e)},detach:function(e,t,n){var r=t[h];r&&(r.detach(),t[h]=null),P(e)},processArgs:function(e,t){return A(this,e,t)},_onEnd:function(e,t,n,r,i){i&&(t=e[x]);var s=n._extra.standAlone||t.getData(g)||t.getData(m),o=n._extra.preventDefault;s&&(e.changedTouches&&(e.changedTouches.length===1?_(e,e.changedTouches[0]):s=!1),s&&(H(e,o),e.type=a,r.fire(e),t.clearData(m),t.clearData(g)))},PREVENT_DEFAULT:!1})},"3.17.2",{requires:["node-base","event-touch","event-synthetic"]});
/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("dd-gestures",function(e,t){e.DD.Drag.START_EVENT="gesturemovestart",e.DD.Drag.prototype._prep=function(){this._dragThreshMet=!1;var t=this.get("node"),n=e.DD.DDM;t.addClass(n.CSS_PREFIX+"-draggable"),t.on(e.DD.Drag.START_EVENT,e.bind(this._handleMouseDownEvent,this),{minDistance:this.get("clickPixelThresh"),minTime:this.get("clickTimeThresh")}),t.on("gesturemoveend",e.bind(this._handleMouseUp,this),{standAlone:!0}),t.on("dragstart",e.bind(this._fixDragStart,this))};var n=e.DD.Drag.prototype._unprep;e.DD.Drag.prototype._unprep=function(){var e=this.get("node");n.call(this),e.detachAll("gesturemoveend")},e.DD.DDM._setupListeners=function(){var t=e.DD.DDM;this._createPG(),this._active=!0,e.one(e.config.doc).on("gesturemove",e.throttle(e.bind(t._move,t),t.get("throttleTime")),{standAlone:!0})}},"3.17.2",{requires:["dd-drag","event-synthetic","event-gestures"]});
/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("plugin",function(e,t){function n(t){!this.hasImpl||!this.hasImpl(e.Plugin.Base)?n.superclass.constructor.apply(this,arguments):n.prototype.initializer.apply(this,arguments)}n.ATTRS={host:{writeOnce:!0}},n.NAME="plugin",n.NS="plugin",e.extend(n,e.Base,{_handles:null,initializer:function(e){this._handles=[]},destructor:function(){if(this._handles)for(var e=0,t=this._handles.length;e<t;e++)this._handles[e].detach()},doBefore:function(e,t,n){var r=this.get("host"),i;return e in r?i=this.beforeHostMethod(e,t,n):r.on&&(i=this.onHostEvent(e,t,n)),i},doAfter:function(e,t,n){var r=this.get("host"),i;return e in r?i=this.afterHostMethod(e,t,n):r.after&&(i=this.afterHostEvent(e,t,n)),i},onHostEvent:function(e,t,n){var r=this.get("host").on(e,t,n||this);return this._handles.push(r),r},onceHostEvent:function(e,t,n){var r=this.get("host").once(e,t,n||this);return this._handles.push(r),r},afterHostEvent:function(e,t,n){var r=this.get("host").after(e,t,n||this);return this._handles.push(r),r},onceAfterHostEvent:function(e,t,n){var r=this.get("host").onceAfter(e,t,n||this);return this._handles.push(r),r},beforeHostMethod:function(t,n,r){var i=e.Do.before(n,this.get("host"),t,r||this);return this._handles.push(i),i},afterHostMethod:function(t,n,r){var i=e.Do.after(n,this.get("host"),t,r||this);return this._handles.push(i),i},toString:function(){return this.constructor.NAME+"["+this.constructor.NS+"]"}}),e.namespace("Plugin").Base=n},"3.17.2",{requires:["base-base"]});
YUI.add("moodle-core-lockscroll",function(e,t){e.namespace("M.core").LockScroll=e.Base.create("lockScroll",e.Plugin.Base,[],{_enabled:!1,destructor:function(){this.disableScrollLock()},enableScrollLock:function(t){if(this.isActive())return;var n=this.get("host").get("boundingBox").get("region").height,r=e.config.win.innerHeight||e.config.doc.documentElement.clientHeight||0;if(!t&&n>r-10)return;this._enabled=!0;var i=e.one(e.config.doc.body),s=i.getComputedStyle("width");i.addClass("lockscroll");var o=parseInt(i.getAttribute("data-activeScrollLocks"),10)||0,u=o+1;return i.setAttribute("data-activeScrollLocks",u),o===0&&i.setStyle("maxWidth",s),this},disableScrollLock:function(){if(this.isActive()){this._enabled=!1;var t=e.one(e.config.doc.body),n=parseInt(t.getAttribute("data-activeScrollLocks"),10)||1,r=n-1;n===1&&(t.removeClass("lockscroll"),t.setStyle("maxWidth",null)),t.setAttribute("data-activeScrollLocks",n-1)}return this},isActive:function(){return this._enabled}},{NS:"lockScroll",ATTRS:{}})},"@VERSION@",{requires:["plugin","base-build"]});
YUI.add("moodle-core-notification-alert",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle alert",l;l=function(e){e.closeButton=!1,l.superclass.constructor.apply(this,[e])},e.extend(l,M.core.notification.info,{_closeEvents:null,initializer:function(){this._closeEvents=[],this.publish("complete");var t=e.Node.create('<input type="button" id="id_yuialertconfirm-'+this.get("COUNT")+'" value="'+this.get(i)+'" />'),n=e.Node.create('<div class="confirmation-dialogue"></div>').append(e.Node.create('<div class="confirmation-message">'+this.get("message")+"</div>")).append(e.Node.create('<div class="confirmation-buttons"></div>').append(t));this.get(r).addClass("moodle-dialogue-confirm"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+this.get("COUNT")+'-header-text">'+this.get(o)+"</h1>",e.WidgetStdMod.REPLACE),this._closeEvents.push(e.on("key",this.submit,window,"down:13",this),t.on("click",this.submit,this));var s=this.get("boundingBox").one(".closebutton");s&&this._closeEvents.push(s.on("click",this.submit,this))},submit:function(){(new e.EventHandle(this._closeEvents)).detach(),this.fire("complete"),this.hide(),this.destroy()}},{NAME:f,CSS_PREFIX:n,ATTRS:{title:{validator:e.Lang.isString,value:"Alert"},message:{validator:e.Lang.isString,value:"Confirm"},yesLabel:{validator:e.Lang.isString,setter:function(e){return e||(e="Ok"),e},value:"Ok"}}}),M.core.alert=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-core-notification-exception",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle exception",l;l=function(t){var n=e.mix({},t);n.width=n.width||M.cfg.developerdebug?Math.floor(e.one(document.body).get("winWidth")/3)+"px":null,n.closeButton=!0;var r=["message","name","fileName","lineNumber","stack"];e.Array.each(r,function(e){n[e]=t[e]}),l.superclass.constructor.apply(this,[n])},e.extend(l,M.core.notification.info,{_hideTimeout:null,_keypress:null,initializer:function(t){var n,i=this,s=this.get("hideTimeoutDelay");this.get(r).addClass("moodle-dialogue-exception"),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+t.COUNT+'-header-text">'+e.Escape.html(t.name)+"</h1>",e.WidgetStdMod.REPLACE),n=e.Node.create('<div class="moodle-exception"></div>').append(e.Node.create('<div class="moodle-exception-message">'+e.Escape.html(this.get("message"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-filename"><label>File:</label> '+e.Escape.html(this.get("fileName"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-linenumber"><label>Line:</label> '+e.Escape.html(this.get("lineNumber"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+this.get("stack")+"</pre></div>")),M.cfg.developerdebug&&n.all(".moodle-exception-param").removeClass("hidden"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),s&&(this._hideTimeout=setTimeout(function(){i.hide()},s)),this.after("visibleChange",this.visibilityChanged,this),this._keypress=e.on("key",this.hide,window,"down:13,27",this),this.centerDialogue()},visibilityChanged:function(e){if(e.attrName==="visible"&&e.prevVal&&!e.newVal){this._keypress&&this._keypress.detach();var t=this;setTimeout(function(){t.destroy()},1e3)}}},{NAME:f,CSS_PREFIX:n,ATTRS:{message:{value:""},name:{value:""},fileName:{value:""},lineNumber:{value:""},stack:{setter:function(t){var n=e.Escape.html(t).split("\n"),r=new RegExp("^(.+)@("+M.cfg.wwwroot+")?(.{0,75}).*:(\\d+)$"),i;for(i in n)n[i]=n[i].replace(r,"<div class='stacktrace-line'>ln: $4</div><div class='stacktrace-file'>$3</div><div class='stacktrace-call'>$1</div>");return n.join("")},value:""},hideTimeoutDelay:{validator:e.Lang.isNumber,value:null}}}),M.core.exception=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-core-notification-ajaxexception",function(e,t){var n,r,i,s,o,u,a;n="moodle-dialogue",r="notificationBase",i="yesLabel",s="noLabel",o="title",u="question",a={BASE:"moodle-dialogue-base",WRAP:"moodle-dialogue-wrap",HEADER:"moodle-dialogue-hd",BODY:"moodle-dialogue-bd",CONTENT:"moodle-dialogue-content",FOOTER:"moodle-dialogue-ft",HIDDEN:"hidden",LIGHTBOX:"moodle-dialogue-lightbox"},M.core=M.core||{};var f="Moodle AJAX exception",l;l=function(e){e.name=e.name||"Error",e.closeButton=!0,l.superclass.constructor.apply(this,[e])},e.extend(l,M.core.notification.info,{_keypress:null,initializer:function(t){var n,i=this,s=this.get("hideTimeoutDelay");this.get(r).addClass("moodle-dialogue-exception"),this.setStdModContent(e.WidgetStdMod.HEADER,'<h1 id="moodle-dialogue-'+this.get("COUNT")+'-header-text">'+e.Escape.html(t.name)+"</h1>",e.WidgetStdMod.REPLACE),n=e.Node.create('<div class="moodle-ajaxexception"></div>').append(e.Node.create('<div class="moodle-exception-message">'+e.Escape.html(this.get("error"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-debuginfo"><label>URL:</label> '+this.get("reproductionlink")+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-debuginfo"><label>Debug info:</label> '+e.Escape.html(this.get("debuginfo"))+"</div>")).append(e.Node.create('<div class="moodle-exception-param hidden param-stacktrace"><label>Stack trace:</label> <pre>'+e.Escape.html(this.get("stacktrace"))+"</pre></div>")),M.cfg.developerdebug&&n.all(".moodle-exception-param").removeClass("hidden"),this.setStdModContent(e.WidgetStdMod.BODY,n,e.WidgetStdMod.REPLACE),s&&(this._hideTimeout=setTimeout(function(){i.hide()},s)),this.after("visibleChange",this.visibilityChanged,this),this._keypress=e.on("key",this.hide,window,"down:13, 27",this),this.centerDialogue()},visibilityChanged:function(e){if(e.attrName==="visible"&&e.prevVal&&!e.newVal){var t=this;this._keypress.detach(),setTimeout(function(){t.destroy()},1e3)}}},{NAME:f,CSS_PREFIX:n,ATTRS:{error:{validator:e.Lang.isString,value:M.util.get_string("unknownerror","moodle")},debuginfo:{value:null},stacktrace:{value:null},reproductionlink:{setter:function(t){return t!==null&&(t=e.Escape.html(t),t='<a href="'+t+'">'+t.replace(M.cfg.wwwroot,"")+"</a>"),t},value:null},hideTimeoutDelay:{validator:e.Lang.isNumber,value:null}}}),M.core.ajaxException=l},"@VERSION@",{requires:["moodle-core-notification-dialogue"]});
YUI.add("moodle-filter_glossary-autolinker",function(e,t){var n="Glossary filter autolinker",r="width",i="height",s="menubar",o="location",u="scrollbars",a="resizable",f="toolbar",l="status",c="directories",h="fullscreen",p="dependent",d;d=function(){d.superclass.constructor.apply(this,arguments)},e.extend(d,e.Base,{overlay:null,alertpanels:{},initializer:function(){var t=this;e.delegate("click",function(n){n.preventDefault();var r="",i=e.Node.create('<div id="glossaryfilteroverlayprogress"><img src="'+M.cfg.loadingicon+'" class="spinner" /></div>'),s=new e.Overlay({headerContent:r,bodyContent:i}),o,u;t.overlay=s,s.render(e.one(document.body)),o=this.getAttribute("href").replace("showentry.php","showentry_ajax.php"),u={method:"get",context:t,on:{success:function(e,t){this.display_callback(t.responseText)},failure:function(e,t){var n=t.statusText;M.cfg.developerdebug&&(t.statusText+=" ("+o+")"),this.display_callback("bodyContent",n)}}},e.io(o,u)},e.one(document.body),"a.glossary.autolink.concept")},display_callback:function(t){var n,r,i,s,o,u,a=this;try{n=e.JSON.parse(t);if(n.success){this.overlay.hide();for(r in n.entries)o=n.entries[r].definition+n.entries[r].attachments,i=new M.core.alert({title:n.entries[r].concept,draggable:!0,message:o,modal:!1,yesLabel:M.util.get_string("ok","moodle")}),e.fire(M.core.event.FILTER_CONTENT_UPDATED,{nodes:new e.NodeList(i.get("boundingBox"))}),e.Node.one("#id_yuialertconfirm-"+i.get("COUNT")).focus(),s="#moodle-dialogue-"+i.get("COUNT"),i.on("complete",this._deletealertpanel(a.alertpanels,s)),e.Object.isEmpty(this.alertpanels)||(u=this._getLatestWindowPosition(),e.Node.one(s).setXY([u[0]+10,u[1]+10])),this.alertpanels[s]=e.Node.one(s).getXY();return!0}n.error&&new M.core.ajaxException(n)}catch(f){new M.core.exception(f)}return!1},_getLatestWindowPosition:function(){var t=[0,0];return e.Object.each(this.alertpanels,function(e){e[0]>t[0]&&(t=e)}),t},_deletealertpanel:function(e,t){delete e[t]}},{NAME:n,ATTRS:{url:{validator:e.Lang.isString,value:M.cfg.wwwroot+"/mod/glossary/showentry.php"},name:{validator:e.Lang.isString,value:"glossaryconcept"},options:{getter:function(){return{width:this.get(r),height:this.get(i),menubar:this.get(s),location:this.get(o),scrollbars:this.get(u),resizable:this.get(a),toolbar:this.get(f),status:this.get(l),directories:this.get(c),fullscreen:this.get(h),dependent:this.get(p)}},readOnly:!0},width:{value:600},height:{value:450},menubar:{value:!1},location:{value:!1},scrollbars:{value:!0},resizable:{value:!0},toolbar:{value:!0},status:{value:!0},directories:{value:!1},fullscreen:{value:!1},dependent:{value:!0}}}),M.filter_glossary=M.filter_glossary||{},M.filter_glossary.init_filter_autolinking=function(e){return new d(e)}},"@VERSION@",{requires:["base","node","io-base","json-parse","event-delegate","overlay","moodle-core-event","moodle-core-notification-alert","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]});
