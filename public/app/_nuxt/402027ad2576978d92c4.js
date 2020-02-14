(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{426:function(e,t,n){"use strict";n(8),n(7),n(63),n(55);var r=n(20),o=n(2),l=n(156),c=n.n(l),d=n(76),m=n(97),f={query:null,variables:null,callback:function(){return{}}};t.a=o.a.extend({data:function(){return{saving:!1}},methods:{saveModel:function(e,t){var n=this,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:f;return this.saveCallback((function(){return n._wrappedSaveModel(e,t,r)}))},saveCallback:function(e){var t=this;return Object(r.a)(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,t.saving=!0,t.$emit("update:loading",!0),d.a.reset(),n.next=6,Promise.all([e(),c.a.set(600)]);case 6:n.next=14;break;case 8:return n.prev=8,n.t0=n.catch(0),n.next=12,c.a.set(300);case 12:throw d.a.catchValidationErrors(n.t0),new m.a;case 14:return n.prev=14,t.$emit("update:loading",!1),t.saving=!1,n.finish(14);case 18:case"end":return n.stop()}}),n,null,[[0,8,14,18]])})))()},_wrappedSaveModel:function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:f;return this.$apollo.mutate({mutation:e,variables:t,update:function(e,t){var data=t.data;if(n.query&&n.callback){var r=e.readQuery({query:n.query,variables:n.variables});if(r){var o=n.callback(r,data);e.writeQuery({query:n.query,data:o})}}}})}}})},428:function(e,t,n){"use strict";var r=n(2),o=n(195),l=n.n(o);t.a=r.a.extend({props:{value:{type:Object,required:!0,default:function(){return{}}},loading:{type:Boolean,required:!1,default:!1},isEdit:{type:Boolean,required:!1,default:!1}},data:function(){return{model:l.a.cloneDeep(this.value)}},watch:{loading:function(e,t){t&&!e&&this.updateModel()}},methods:{updateModel:function(){this.model=l.a.cloneDeep(this.value)}}})},436:function(e,t,n){"use strict";n(14),n(12),n(13);var r=n(3),o=(n(62),n(8),n(7),n(256),n(35),n(39),n(10)),l=n(83),c=n(114);function d(object,e){var t=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),t.push.apply(t,n)}return t}function m(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?d(source,!0).forEach((function(t){Object(r.a)(e,t,source[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):d(source).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(source,t))}))}return e}t.a=Object(o.a)(l.a,Object(c.b)("form")).extend({name:"v-form",inheritAttrs:!1,props:{lazyValidation:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(e){var t=Object.values(e).includes(!0);this.$emit("input",!t)},deep:!0,immediate:!0}},methods:{watchInput:function(input){var e=this,t=function(input){return input.$watch("hasError",(function(t){e.$set(e.errorBag,input._uid,t)}),{immediate:!0})},n={_uid:input._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?n.shouldValidate=input.$watch("shouldValidate",(function(r){r&&(e.errorBag.hasOwnProperty(input._uid)||(n.valid=t(input)))})):n.valid=t(input),n},validate:function(){return 0===this.inputs.filter((function(input){return!input.validate(!0)})).length},reset:function(){this.inputs.forEach((function(input){return input.reset()})),this.resetErrorBag()},resetErrorBag:function(){var e=this;this.lazyValidation&&setTimeout((function(){e.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(input){return input.resetValidation()})),this.resetErrorBag()},register:function(input){this.inputs.push(input),this.watchers.push(this.watchInput(input))},unregister:function(input){var e=this.inputs.find((function(i){return i._uid===input._uid}));if(e){var t=this.watchers.find((function(i){return i._uid===e._uid}));t&&(t.valid(),t.shouldValidate()),this.watchers=this.watchers.filter((function(i){return i._uid!==e._uid})),this.inputs=this.inputs.filter((function(i){return i._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(e){var t=this;return e("form",{staticClass:"v-form",attrs:m({novalidate:!0},this.attrs$),on:{submit:function(e){return t.$emit("submit",e)}}},this.$slots.default)}})},469:function(e,t){var n={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"updateMe"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"data"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"UpdateOrCreateUserInput"}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"updateMe"},arguments:[{kind:"Argument",name:{kind:"Name",value:"data"},value:{kind:"Variable",name:{kind:"Name",value:"data"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"firstName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"lastName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"initials"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"email"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"street"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"postcode"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"city"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"country"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:186}};n.loc.source={body:"mutation updateMe($data: UpdateOrCreateUserInput!) {\n  updateMe(data: $data) {\n    id\n    firstName\n    lastName\n    initials\n    email\n    street\n    postcode\n    city\n    country\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,t){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==t)return element}}n.definitions.forEach((function(e){if(e.name){var t=new Set;!function e(t,n){if("FragmentSpread"===t.kind)n.add(t.name.value);else if("VariableDefinition"===t.kind){var r=t.type;"NamedType"===r.kind&&n.add(r.name.value)}t.selectionSet&&t.selectionSet.selections.forEach((function(t){e(t,n)})),t.variableDefinitions&&t.variableDefinitions.forEach((function(t){e(t,n)})),t.definitions&&t.definitions.forEach((function(t){e(t,n)}))}(e,t),r[e.name.value]=t}})),e.exports=n,e.exports.updateMe=function(e,t){var n={kind:e.kind,definitions:[o(e,t)]};e.hasOwnProperty("loc")&&(n.loc=e.loc);var l=r[t]||new Set,c=new Set,d=new Set;for(l.forEach((function(e){d.add(e)}));d.size>0;){var m=d;d=new Set,m.forEach((function(e){c.has(e)||(c.add(e),(r[e]||new Set).forEach((function(e){d.add(e)})))}))}return c.forEach((function(t){var r=o(e,t);r&&n.definitions.push(r)})),n}(n,"updateMe")},488:function(e,t,n){"use strict";n.r(t);n(14),n(12),n(8),n(7),n(13);var r=n(3),o=n(47),l=n(428),c=n(426),d=n(469),m=n.n(d),f=n(118),v=n.n(f);function h(object,e){var t=Object.keys(object);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(object);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),t.push.apply(t,n)}return t}function y(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?h(source,!0).forEach((function(t){Object(r.a)(e,t,source[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):h(source).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(source,t))}))}return e}var k=Object(o.a)(l.a,c.a).extend({methods:{submit:function(){this.saveModel(m.a,{data:{first_name:this.model.first_name,last_name:this.model.last_name,email:this.model.email,postcode:this.model.postcode,city:this.model.city,country:this.model.country}},{query:v.a,callback:function(e,data){return{me:y({},e.me,{},data.updateMe)}}}).then(this.updateModel)}}}),w=n(22),O=n(26),N=n.n(O),$=n(198),_=n(177),j=n(49),x=n(415),E=n(436),S=n(418),V=n(445),component=Object(w.a)(k,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-card",{attrs:{loading:e.loading}},[n("v-card-title",[e._v("\n    "+e._s(e.$t("user.personalInfo"))+"\n  ")]),e._v(" "),n("v-form",{ref:"form",staticClass:"pa-4"},[n("v-row",[n("v-col",{attrs:{cols:"12",md:"6"}},[n("v-text-field",{attrs:{"error-messages":e.$v("firstName","user.firstName"),label:e.$t("user.firstName")},model:{value:e.model.firstName,callback:function(t){e.$set(e.model,"firstName",t)},expression:"model.firstName"}})],1),e._v(" "),n("v-col",{attrs:{cols:"12",md:"6"}},[n("v-text-field",{attrs:{"error-messages":e.$v("lastName","user.lastName"),label:e.$t("user.lastName")},model:{value:e.model.lastName,callback:function(t){e.$set(e.model,"lastName",t)},expression:"model.lastName"}})],1),e._v(" "),n("v-col",{attrs:{cols:"12"}},[n("v-text-field",{attrs:{"error-messages":e.$v("email","user.email"),label:e.$t("user.email")},model:{value:e.model.email,callback:function(t){e.$set(e.model,"email",t)},expression:"model.email"}})],1),e._v(" "),n("v-col",{attrs:{cols:"12",md:"6"}},[n("v-text-field",{attrs:{"error-messages":e.$v("postcode","user.postcode"),label:e.$t("user.postcode")},model:{value:e.model.postcode,callback:function(t){e.$set(e.model,"postcode",t)},expression:"model.postcode"}})],1),e._v(" "),n("v-col",{attrs:{cols:"12",md:"6"}},[n("v-text-field",{attrs:{"error-messages":e.$v("city","user.city"),label:e.$t("user.city")},model:{value:e.model.city,callback:function(t){e.$set(e.model,"city",t)},expression:"model.city"}})],1),e._v(" "),n("v-col",{attrs:{cols:"12"}},[n("v-text-field",{attrs:{"error-messages":e.$v("country","user.country"),label:e.$t("user.country")},model:{value:e.model.country,callback:function(t){e.$set(e.model,"country",t)},expression:"model.country"}})],1)],1),e._v(" "),n("v-btn",{attrs:{color:"primary",loading:e.saving},on:{click:e.submit}},[e._v("\n      "+e._s(e.$t("general.save"))+"\n    ")])],1)],1)}),[],!1,null,null,null);t.default=component.exports;N()(component,{VBtn:$.a,VCard:_.a,VCardTitle:j.c,VCol:x.a,VForm:E.a,VRow:S.a,VTextField:V.a})}}]);