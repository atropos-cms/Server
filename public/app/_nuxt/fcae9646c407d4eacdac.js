(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{425:function(t,e,n){"use strict";var r=n(2);e.a=r.a.extend({props:{value:{type:Object,required:!0,default:function(){return{}}},loading:{type:Boolean,required:!1,default:!1},isEdit:{type:Boolean,required:!1,default:!1}},computed:{model:{get:function(){return this.value},set:function(t){this.$emit("input",t)}}}})},430:function(t,e,n){"use strict";var r=n(431),o=n.n(r),c=n(432),l=n.n(c),h=n(433),v=n.n(h);o.a.extend(l.a),o.a.extend(v.a),e.a=o.a},431:function(t,e,n){t.exports=function(){"use strict";var t="millisecond",e="second",n="minute",r="hour",i="day",s="week",u="month",o="quarter",a="year",c=/^(\d{4})-?(\d{1,2})-?(\d{0,2})[^0-9]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?.?(\d{1,3})?$/,l=/\[([^\]]+)]|Y{2,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,h=function(t,e,n){var r=String(t);return!r||r.length>=e?t:""+Array(e+1-r.length).join(n)+t},v={s:h,z:function(t){var e=-t.utcOffset(),n=Math.abs(e),r=Math.floor(n/60),i=n%60;return(e<=0?"+":"-")+h(r,2,"0")+":"+h(i,2,"0")},m:function(t,e){var n=12*(e.year()-t.year())+(e.month()-t.month()),r=t.clone().add(n,u),i=e-r<0,s=t.clone().add(n+(i?-1:1),u);return Number(-(n+(e-r)/(i?r-s:s-r))||0)},a:function(t){return t<0?Math.ceil(t)||0:Math.floor(t)},p:function(c){return{M:u,y:a,w:s,d:i,h:r,m:n,s:e,ms:t,Q:o}[c]||String(c||"").toLowerCase().replace(/s$/,"")},u:function(t){return void 0===t}},d={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_")},f="en",m={};m[f]=d;var y=function(t){return t instanceof M},$=function(t,e,n){var r;if(!t)return f;if("string"==typeof t)m[t]&&(r=t),e&&(m[t]=e,r=t);else{var i=t.name;m[i]=t,r=i}return n||(f=r),r},g=function(t,e,n){if(y(t))return t.clone();var r=e?"string"==typeof e?{format:e,pl:n}:e:{};return r.date=t,new M(r)},x=v;x.l=$,x.i=y,x.w=function(t,e){return g(t,{locale:e.$L,utc:e.$u,$offset:e.$offset})};var M=function(){function h(t){this.$L=this.$L||$(t.locale,null,!0),this.parse(t)}var v=h.prototype;return v.parse=function(t){this.$d=function(t){var e=t.date,n=t.utc;if(null===e)return new Date(NaN);if(x.u(e))return new Date;if(e instanceof Date)return new Date(e);if("string"==typeof e&&!/Z$/i.test(e)){var r=e.match(c);if(r)return n?new Date(Date.UTC(r[1],r[2]-1,r[3]||1,r[4]||0,r[5]||0,r[6]||0,r[7]||0)):new Date(r[1],r[2]-1,r[3]||1,r[4]||0,r[5]||0,r[6]||0,r[7]||0)}return new Date(e)}(t),this.init()},v.init=function(){var t=this.$d;this.$y=t.getFullYear(),this.$M=t.getMonth(),this.$D=t.getDate(),this.$W=t.getDay(),this.$H=t.getHours(),this.$m=t.getMinutes(),this.$s=t.getSeconds(),this.$ms=t.getMilliseconds()},v.$utils=function(){return x},v.isValid=function(){return!("Invalid Date"===this.$d.toString())},v.isSame=function(t,e){var n=g(t);return this.startOf(e)<=n&&n<=this.endOf(e)},v.isAfter=function(t,e){return g(t)<this.startOf(e)},v.isBefore=function(t,e){return this.endOf(e)<g(t)},v.$g=function(t,e,n){return x.u(t)?this[e]:this.set(n,t)},v.year=function(t){return this.$g(t,"$y",a)},v.month=function(t){return this.$g(t,"$M",u)},v.day=function(t){return this.$g(t,"$W",i)},v.date=function(t){return this.$g(t,"$D","date")},v.hour=function(t){return this.$g(t,"$H",r)},v.minute=function(t){return this.$g(t,"$m",n)},v.second=function(t){return this.$g(t,"$s",e)},v.millisecond=function(e){return this.$g(e,"$ms",t)},v.unix=function(){return Math.floor(this.valueOf()/1e3)},v.valueOf=function(){return this.$d.getTime()},v.startOf=function(t,o){var c=this,l=!!x.u(o)||o,h=x.p(t),v=function(t,e){var n=x.w(c.$u?Date.UTC(c.$y,e,t):new Date(c.$y,e,t),c);return l?n:n.endOf(i)},d=function(t,e){return x.w(c.toDate()[t].apply(c.toDate(),(l?[0,0,0,0]:[23,59,59,999]).slice(e)),c)},f=this.$W,m=this.$M,y=this.$D,$="set"+(this.$u?"UTC":"");switch(h){case a:return l?v(1,0):v(31,11);case u:return l?v(1,m):v(0,m+1);case s:var g=this.$locale().weekStart||0,M=(f<g?f+7:f)-g;return v(l?y-M:y+(6-M),m);case i:case"date":return d($+"Hours",0);case r:return d($+"Minutes",1);case n:return d($+"Seconds",2);case e:return d($+"Milliseconds",3);default:return this.clone()}},v.endOf=function(t){return this.startOf(t,!1)},v.$set=function(s,o){var c,l=x.p(s),h="set"+(this.$u?"UTC":""),v=(c={},c[i]=h+"Date",c.date=h+"Date",c[u]=h+"Month",c[a]=h+"FullYear",c[r]=h+"Hours",c[n]=h+"Minutes",c[e]=h+"Seconds",c[t]=h+"Milliseconds",c)[l],d=l===i?this.$D+(o-this.$W):o;if(l===u||l===a){var f=this.clone().set("date",1);f.$d[v](d),f.init(),this.$d=f.set("date",Math.min(this.$D,f.daysInMonth())).toDate()}else v&&this.$d[v](d);return this.init(),this},v.set=function(t,e){return this.clone().$set(t,e)},v.get=function(t){return this[x.p(t)]()},v.add=function(t,o){var c,l=this;t=Number(t);var h=x.p(o),v=function(e){var n=g(l);return x.w(n.date(n.date()+Math.round(e*t)),l)};if(h===u)return this.set(u,this.$M+t);if(h===a)return this.set(a,this.$y+t);if(h===i)return v(1);if(h===s)return v(7);var d=(c={},c[n]=6e4,c[r]=36e5,c[e]=1e3,c)[h]||1,f=this.$d.getTime()+t*d;return x.w(f,this)},v.subtract=function(t,e){return this.add(-1*t,e)},v.format=function(t){var e=this;if(!this.isValid())return"Invalid Date";var n=t||"YYYY-MM-DDTHH:mm:ssZ",r=x.z(this),i=this.$locale(),s=this.$H,u=this.$m,o=this.$M,a=i.weekdays,c=i.months,h=function(t,r,i,s){return t&&(t[r]||t(e,n))||i[r].substr(0,s)},v=function(t){return x.s(s%12||12,t,"0")},d=i.meridiem||function(t,e,n){var r=t<12?"AM":"PM";return n?r.toLowerCase():r},f={YY:String(this.$y).slice(-2),YYYY:this.$y,M:o+1,MM:x.s(o+1,2,"0"),MMM:h(i.monthsShort,o,c,3),MMMM:c[o]||c(this,n),D:this.$D,DD:x.s(this.$D,2,"0"),d:String(this.$W),dd:h(i.weekdaysMin,this.$W,a,2),ddd:h(i.weekdaysShort,this.$W,a,3),dddd:a[this.$W],H:String(s),HH:x.s(s,2,"0"),h:v(1),hh:v(2),a:d(s,u,!0),A:d(s,u,!1),m:String(u),mm:x.s(u,2,"0"),s:String(this.$s),ss:x.s(this.$s,2,"0"),SSS:x.s(this.$ms,3,"0"),Z:r};return n.replace(l,(function(t,e){return e||f[t]||r.replace(":","")}))},v.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},v.diff=function(t,c,l){var h,v=x.p(c),d=g(t),f=6e4*(d.utcOffset()-this.utcOffset()),m=this-d,y=x.m(this,d);return y=(h={},h[a]=y/12,h[u]=y,h[o]=y/3,h[s]=(m-f)/6048e5,h[i]=(m-f)/864e5,h[r]=m/36e5,h[n]=m/6e4,h[e]=m/1e3,h)[v]||m,l?y:x.a(y)},v.daysInMonth=function(){return this.endOf(u).$D},v.$locale=function(){return m[this.$L]},v.locale=function(t,e){if(!t)return this.$L;var n=this.clone(),r=$(t,e,!0);return r&&(n.$L=r),n},v.clone=function(){return x.w(this.$d,this)},v.toDate=function(){return new Date(this.valueOf())},v.toJSON=function(){return this.isValid()?this.toISOString():null},v.toISOString=function(){return this.$d.toISOString()},v.toString=function(){return this.$d.toUTCString()},h}();return g.prototype=M.prototype,g.extend=function(t,e){return t(e,M,g),g},g.locale=$,g.isDayjs=y,g.unix=function(t){return g(1e3*t)},g.en=m[f],g.Ls=m,g}()},432:function(t,e,n){t.exports=function(){"use strict";return function(t,e,n){var r=e.prototype,o=r.format,c={LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"};n.en.formats=c,r.format=function(t){void 0===t&&(t="YYYY-MM-DDTHH:mm:ssZ");var e=this.$locale().formats,n=void 0===e?{}:e,r=t.replace(/(\[[^\]]+])|(LTS?|l{1,4}|L{1,4})/g,(function(t,e,r){var o=r&&r.toUpperCase();return e||n[r]||c[r]||n[o].replace(/(\[[^\]]+])|(MMMM|MM|DD|dddd)/g,(function(t,e,n){return e||n.slice(1)}))}));return o.call(this,r)}}}()},433:function(t,e,n){t.exports=function(){"use strict";return function(t,e,n){var r=e.prototype;n.en.relativeTime={future:"in %s",past:"%s ago",s:"a few seconds",m:"a minute",mm:"%d minutes",h:"an hour",hh:"%d hours",d:"a day",dd:"%d days",M:"a month",MM:"%d months",y:"a year",yy:"%d years"};var o=function(t,e,r,o){for(var c,i,u,a=r.$locale().relativeTime,l=[{l:"s",r:44,d:"second"},{l:"m",r:89},{l:"mm",r:44,d:"minute"},{l:"h",r:89},{l:"hh",r:21,d:"hour"},{l:"d",r:35},{l:"dd",r:25,d:"day"},{l:"M",r:45},{l:"MM",r:10,d:"month"},{l:"y",r:17},{l:"yy",d:"year"}],s=l.length,h=0;h<s;h+=1){var v=l[h];v.d&&(c=o?n(t).diff(r,v.d,!0):r.diff(t,v.d,!0));var d=Math.round(Math.abs(c));if(u=c>0,d<=v.r||!v.r){1===d&&h>0&&(v=l[h-1]);var f=a[v.l];i="string"==typeof f?f.replace("%d",d):f(d,e,v.l,u);break}}return e?i:(u?a.future:a.past).replace("%s",i)};r.to=function(t,e){return o(t,e,this,!0)},r.from=function(t,e){return o(t,e,this)};var c=function(t){return t.$u?n.utc():n()};r.toNow=function(t){return this.to(c(this),t)},r.fromNow=function(t){return this.from(c(this),t)}}}()},447:function(t,e,n){var content=n(448);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,n(16).default)("197fcea4",content,!0,{sourceMap:!1})},448:function(t,e,n){(e=n(15)(!1)).push([t.i,'.v-chip:not(.v-chip--outlined).accent,.v-chip:not(.v-chip--outlined).error,.v-chip:not(.v-chip--outlined).info,.v-chip:not(.v-chip--outlined).primary,.v-chip:not(.v-chip--outlined).secondary,.v-chip:not(.v-chip--outlined).success,.v-chip:not(.v-chip--outlined).warning{color:#fff}.theme--light.v-chip{border-color:rgba(0,0,0,.12);color:rgba(0,0,0,.87)}.theme--light.v-chip:not(.v-chip--active){background:#e0e0e0}.theme--light.v-chip:hover:before{opacity:.04}.theme--light.v-chip--active:before,.theme--light.v-chip--active:hover:before,.theme--light.v-chip:focus:before{opacity:.12}.theme--light.v-chip--active:focus:before{opacity:.16}.theme--dark.v-chip{border-color:hsla(0,0%,100%,.12);color:#fff}.theme--dark.v-chip:not(.v-chip--active){background:#555}.theme--dark.v-chip:hover:before{opacity:.08}.theme--dark.v-chip--active:before,.theme--dark.v-chip--active:hover:before,.theme--dark.v-chip:focus:before{opacity:.24}.theme--dark.v-chip--active:focus:before{opacity:.32}.v-chip{align-items:center;cursor:default;display:inline-flex;line-height:20px;max-width:100%;outline:none;overflow:hidden;padding:0 12px;position:relative;text-decoration:none;transition-duration:.28s;transition-property:box-shadow,opacity;transition-timing-function:cubic-bezier(.4,0,.2,1);vertical-align:middle;white-space:nowrap}.v-chip:before{background-color:currentColor;bottom:0;border-radius:inherit;content:"";left:0;opacity:0;position:absolute;pointer-events:none;right:0;top:0}.v-chip .v-avatar{height:24px!important;min-width:24px!important;width:24px!important}.v-chip .v-icon{font-size:24px}.v-application--is-ltr .v-chip .v-avatar--left,.v-application--is-ltr .v-chip .v-icon--left{margin-left:-6px;margin-right:8px}.v-application--is-ltr .v-chip .v-avatar--right,.v-application--is-ltr .v-chip .v-icon--right,.v-application--is-rtl .v-chip .v-avatar--left,.v-application--is-rtl .v-chip .v-icon--left{margin-left:8px;margin-right:-6px}.v-application--is-rtl .v-chip .v-avatar--right,.v-application--is-rtl .v-chip .v-icon--right{margin-left:-6px;margin-right:8px}.v-chip:not(.v-chip--no-color) .v-icon{color:inherit}.v-chip .v-chip__close.v-icon{font-size:18px;max-height:18px;max-width:18px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-application--is-ltr .v-chip .v-chip__close.v-icon.v-icon--right{margin-right:-4px}.v-application--is-rtl .v-chip .v-chip__close.v-icon.v-icon--right{margin-left:-4px}.v-chip .v-chip__close.v-icon:active,.v-chip .v-chip__close.v-icon:focus,.v-chip .v-chip__close.v-icon:hover{opacity:.72}.v-chip .v-chip__content{align-items:center;display:inline-flex;height:100%;max-width:100%}.v-chip--active .v-icon{color:inherit}.v-chip--link:before{transition:opacity .3s cubic-bezier(.25,.8,.5,1)}.v-chip--link:focus:before{opacity:.32}.v-chip--clickable{cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-chip--clickable:active{box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}.v-chip--disabled{opacity:.4;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-chip__filter{max-width:24px}.v-chip__filter.v-icon{color:inherit}.v-chip__filter.expand-x-transition-enter,.v-chip__filter.expand-x-transition-leave-active{margin:0}.v-chip--pill .v-chip__filter{margin-right:0 16px 0 0}.v-chip--pill .v-avatar{height:32px!important;width:32px!important}.v-application--is-ltr .v-chip--pill .v-avatar--left{margin-left:-12px}.v-application--is-ltr .v-chip--pill .v-avatar--right,.v-application--is-rtl .v-chip--pill .v-avatar--left{margin-right:-12px}.v-application--is-rtl .v-chip--pill .v-avatar--right{margin-left:-12px}.v-chip--label{border-radius:4px!important}.v-chip.v-chip--outlined{border-width:thin;border-style:solid}.v-chip.v-chip--outlined:not(.v-chip--active):before{opacity:0}.v-chip.v-chip--outlined.v-chip--active:before{opacity:.08}.v-chip.v-chip--outlined .v-icon{color:inherit}.v-chip.v-chip--outlined.v-chip.v-chip{background-color:transparent!important}.v-chip.v-chip--selected{background:transparent}.v-chip.v-chip--selected:after{opacity:.28}.v-chip.v-size--x-small{border-radius:8px;font-size:10px;height:16px}.v-chip.v-size--small{border-radius:12px;font-size:12px;height:24px}.v-chip.v-size--default{border-radius:16px;font-size:14px;height:32px}.v-chip.v-size--large{border-radius:27px;font-size:16px;height:54px}.v-chip.v-size--x-large{border-radius:33px;font-size:18px;height:66px}',""]),t.exports=e},453:function(t,e,n){"use strict";n(14),n(12),n(8),n(7),n(13);var r=n(23),o=n(3),c=(n(447),n(10)),l=n(96),h=n(61),v=n(27),d=n(115),f=n(21),m=n(32),y=n(53),$=n(119),x=n(11);function M(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,n)}return e}function _(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?M(source,!0).forEach((function(e){Object(o.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):M(source).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}e.a=Object(c.a)(v.a,$.a,y.a,f.a,Object(d.a)("chipGroup"),Object(m.b)("inputValue")).extend({name:"v-chip",props:{active:{type:Boolean,default:!0},activeClass:{type:String,default:function(){return this.chipGroup?this.chipGroup.activeClass:""}},close:Boolean,closeIcon:{type:String,default:"$delete"},disabled:Boolean,draggable:Boolean,filter:Boolean,filterIcon:{type:String,default:"$complete"},label:Boolean,link:Boolean,outlined:Boolean,pill:Boolean,tag:{type:String,default:"span"},textColor:String,value:null},data:function(){return{proxyClass:"v-chip--active"}},computed:{classes:function(){return _({"v-chip":!0},y.a.options.computed.classes.call(this),{"v-chip--clickable":this.isClickable,"v-chip--disabled":this.disabled,"v-chip--draggable":this.draggable,"v-chip--label":this.label,"v-chip--link":this.isLink,"v-chip--no-color":!this.color,"v-chip--outlined":this.outlined,"v-chip--pill":this.pill,"v-chip--removable":this.hasClose},this.themeClasses,{},this.sizeableClasses,{},this.groupClasses)},hasClose:function(){return Boolean(this.close)},isClickable:function(){return Boolean(y.a.options.computed.isClickable.call(this)||this.chipGroup)}},created:function(){var t=this;[["outline","outlined"],["selected","input-value"],["value","active"],["@input","@active.sync"]].forEach((function(e){var n=Object(r.a)(e,2),o=n[0],c=n[1];t.$attrs.hasOwnProperty(o)&&Object(x.a)(o,c,t)}))},methods:{click:function(t){this.$emit("click",t),this.chipGroup&&this.toggle()},genFilter:function(){var t=[];return this.isActive&&t.push(this.$createElement(h.a,{staticClass:"v-chip__filter",props:{left:!0}},this.filterIcon)),this.$createElement(l.b,t)},genClose:function(){var t=this;return this.$createElement(h.a,{staticClass:"v-chip__close",props:{right:!0},on:{click:function(e){e.stopPropagation(),e.preventDefault(),t.$emit("click:close"),t.$emit("update:active",!1)}}},this.closeIcon)},genContent:function(){return this.$createElement("span",{staticClass:"v-chip__content"},[this.filter&&this.genFilter(),this.$slots.default,this.hasClose&&this.genClose()])}},render:function(t){var e=[this.genContent()],n=this.generateRouteLink(),r=n.tag,data=n.data;data.attrs=_({},data.attrs,{draggable:this.draggable?"true":void 0,tabindex:this.chipGroup&&!this.disabled?0:data.attrs.tabindex}),data.directives.push({name:"show",value:this.active}),data=this.setBackgroundColor(this.color,data);var o=this.textColor||this.outlined&&this.color;return t(r,this.setTextColor(o,data),e)}})},499:function(t,e,n){"use strict";n.r(e);var r=n(47),o=n(430),c=n(425),l=Object(r.a)(c.a).extend({data:function(){return{img:!1}},computed:{loginAt:function(){return this.model.loginAt?Object(o.a)(this.model.loginAt).fromNow():null},createdAt:function(){return this.model.createdAt?Object(o.a)(this.model.createdAt).format("LL"):null}}}),h=n(22),v=n(26),d=n.n(v),f=n(183),m=n(177),y=n(453),component=Object(h.a)(l,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-card",[n("div",{staticClass:"d-flex flex-md-column pa-4"},[n("div",{staticClass:"d-flex justify-center align-center"},[n("v-avatar",{attrs:{size:t.$vuetify.breakpoint.lgAndUp?196:96,color:"blue-grey lighten-5"}},[t.img?n("img",{attrs:{src:"https://vuetifyjs.com/apple-touch-icon-180x180.png",alt:"avatar"}}):n("span",{staticClass:"display-2 grey--text text--darken-3"},[t._v(t._s(t.model.initials))])])],1),t._v(" "),n("div",{staticClass:"ml-4 ml-md-0 mt-md-4"},[n("div",[n("div",{staticClass:"title"},[t._v("\n          "+t._s(t.model.firstName)+" "+t._s(t.model.lastName)+"\n        ")]),t._v(" "),n("div",[t._v(t._s(t.model.email))])]),t._v(" "),n("div",{staticClass:"mt-2 mt-md-4"},t._l(t.model.groups,(function(e){return n("v-chip",{key:e.id,staticClass:"mr-2",attrs:{label:"",small:""}},[t._v("\n          "+t._s(e.name)+"\n        ")])})),1),t._v(" "),n("div",{staticClass:"mt-2 mt-md-6"},[n("div",{staticClass:"caption muted--text"},[t._v("\n          "+t._s(t.$t("user.loginAt",{date:t.loginAt}))+"\n        ")]),t._v(" "),n("div",{staticClass:"caption muted--text"},[t._v("\n          "+t._s(t.$t("general.createdAt",{date:t.createdAt}))+"\n        ")])])])])])}),[],!1,null,null,null);e.default=component.exports;d()(component,{VAvatar:f.a,VCard:m.a,VChip:y.a})}}]);