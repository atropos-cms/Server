(window.webpackJsonp=window.webpackJsonp||[]).push([[19,18],{425:function(e,n,t){"use strict";var r=t(2);n.a=r.a.extend({props:{value:{type:Object,required:!0,default:function(){return{}}},loading:{type:Boolean,required:!1,default:!1},isEdit:{type:Boolean,required:!1,default:!1}},computed:{model:{get:function(){return this.value},set:function(e){this.$emit("input",e)}}}})},426:function(e,n,t){"use strict";t(8),t(7),t(63),t(55);var r=t(20),o=t(2),d=t(156),l=t.n(d),c=t(76),m=t(97),f={query:null,variables:null,callback:function(){return{}}};n.a=o.a.extend({data:function(){return{saving:!1}},methods:{saveModel:function(e,n){var t=this,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:f;return this.saveCallback((function(){return t._wrappedSaveModel(e,n,r)}))},saveCallback:function(e){var n=this;return Object(r.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,n.saving=!0,n.$emit("update:loading",!0),c.a.reset(),t.next=6,Promise.all([e(),l.a.set(600)]);case 6:t.next=14;break;case 8:return t.prev=8,t.t0=t.catch(0),t.next=12,l.a.set(300);case 12:throw c.a.catchValidationErrors(t.t0),new m.a;case 14:return t.prev=14,n.$emit("update:loading",!1),n.saving=!1,t.finish(14);case 18:case"end":return t.stop()}}),t,null,[[0,8,14,18]])})))()},_wrappedSaveModel:function(e,n){var t=arguments.length>2&&void 0!==arguments[2]?arguments[2]:f;return this.$apollo.mutate({mutation:e,variables:n,update:function(e,n){var data=n.data;if(t.query&&t.callback){var r=e.readQuery({query:t.query,variables:t.variables});if(r){var o=t.callback(r,data);e.writeQuery({query:t.query,data:o})}}}})}}})},428:function(e,n,t){"use strict";var r=t(2),o=t(195),d=t.n(o);n.a=r.a.extend({props:{value:{type:Object,required:!0,default:function(){return{}}},loading:{type:Boolean,required:!1,default:!1},isEdit:{type:Boolean,required:!1,default:!1}},data:function(){return{model:d.a.cloneDeep(this.value)}},watch:{loading:function(e,n){n&&!e&&this.updateModel()}},methods:{updateModel:function(){this.model=d.a.cloneDeep(this.value)}}})},430:function(e,n,t){"use strict";var r=t(431),o=t.n(r),d=t(432),l=t.n(d),c=t(433),m=t.n(c);o.a.extend(l.a),o.a.extend(m.a),n.a=o.a},439:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"query",name:{kind:"Name",value:"Users"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"first"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"Int"}}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"page"}},type:{kind:"NamedType",name:{kind:"Name",value:"Int"}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"search"}},type:{kind:"NamedType",name:{kind:"Name",value:"String"}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"orderBy"}},type:{kind:"ListType",type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"UsersOrderByOrderByClause"}}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"users"},arguments:[{kind:"Argument",name:{kind:"Name",value:"first"},value:{kind:"Variable",name:{kind:"Name",value:"first"}}},{kind:"Argument",name:{kind:"Name",value:"page"},value:{kind:"Variable",name:{kind:"Name",value:"page"}}},{kind:"Argument",name:{kind:"Name",value:"search"},value:{kind:"Variable",name:{kind:"Name",value:"search"}}},{kind:"Argument",name:{kind:"Name",value:"orderBy"},value:{kind:"Variable",name:{kind:"Name",value:"orderBy"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"paginatorInfo"},arguments:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"count"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"currentPage"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"total"},arguments:[],directives:[]}]}},{kind:"Field",name:{kind:"Name",value:"data"},arguments:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"firstName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"lastName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"fullName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"email"},arguments:[],directives:[]}]}}]}}]}}],loc:{start:0,end:328}};t.loc.source={body:"query Users($first: Int!, $page: Int, $search: String, $orderBy: [UsersOrderByOrderByClause!]) {\n  users(first: $first, page: $page, search: $search, orderBy: $orderBy) {\n    paginatorInfo {\n      count\n      currentPage\n      total\n    }\n    data {\n      id\n      firstName\n      lastName\n      fullName\n      email\n    }\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.Users=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"Users")},444:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"updateGroup"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"data"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"UpdateOrCreateGroupInput"}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"updateGroup"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}},{kind:"Argument",name:{kind:"Name",value:"data"},value:{kind:"Variable",name:{kind:"Name",value:"data"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"name"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"description"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:142}};t.loc.source={body:"mutation updateGroup($id: ID!, $data: UpdateOrCreateGroupInput!) {\n  updateGroup(id: $id, data: $data) {\n    id\n    name\n    description\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.updateGroup=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"updateGroup")},446:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"deleteGroup"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"deleteGroup"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:70}};t.loc.source={body:"mutation deleteGroup($id: ID!) {\n  deleteGroup(id: $id) {\n    id\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.deleteGroup=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"deleteGroup")},454:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"query",name:{kind:"Name",value:"Group"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"group"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"name"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"description"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"createdAt"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"updatedAt"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"members"},arguments:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"fullName"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"email"},arguments:[],directives:[]}]}},{kind:"Field",name:{kind:"Name",value:"permissions"},arguments:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]}]}}]}}]}}],loc:{start:0,end:198}};t.loc.source={body:"query Role($id: ID!) { \n  group(id: $id) {\n    id\n    name\n    description\n    createdAt\n    updatedAt\n    members {\n      id\n      fullName\n      email\n    }\n    permissions {\n      id\n    }\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.Group=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"Group")},457:function(e,n,t){"use strict";t.r(n);var r=t(47),o=t(425),d=Object(r.a)(o.a).extend({}),l=t(22),c=t(26),m=t.n(c),f=t(415),v=t(416),k=t(418),h=t(445),component=Object(l.a)(d,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-container",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-text-field",{attrs:{"error-messages":e.$v("data.name","group.name"),label:e.$t("group.name"),autofocus:""},model:{value:e.model.name,callback:function(n){e.$set(e.model,"name",n)},expression:"model.name"}})],1)],1)],1)}),[],!1,null,null,null);n.default=component.exports;m()(component,{VCol:f.a,VContainer:v.a,VRow:k.a,VTextField:h.a})},458:function(e,n,t){"use strict";t.r(n);t(258);var r=t(47),o=t(439),d=t.n(o),l=t(425),c=Object(r.a)(l.a).extend({data:function(){return{search:"",users:[]}},mounted:function(){this.model={selected:[]}},apollo:{users:{query:d.a,variables:function(){return{first:100,orderBy:[{field:"firstName",order:"ASC"}],search:this.search||void 0,page:1}},update:function(data){return data.users.data}}},methods:{remove:function(e){var n=this.model.selected.indexOf(e.id);n>=0&&this.model.selected.splice(n,1)}}}),m=t(22),f=t(26),v=t.n(f),k=t(485),h=t(453),y=t(415),N=t(416),S=t(17),w=t(418),component=Object(m.a)(c,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-container",[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-autocomplete",{staticClass:"mx-4",attrs:{loading:e.$apollo.queries.users.loading,items:e.users,"search-input":e.search,label:e.$t("group.findAUser"),"auto-select-first":"","cache-items":"",flat:"","hide-no-data":"","hide-details":"","item-text":"fullName","item-value":"id",multiple:""},on:{"update:searchInput":function(n){e.search=n},"update:search-input":function(n){e.search=n}},scopedSlots:e._u([{key:"selection",fn:function(n){var r=n.attr,o=n.item,select=n.select,d=n.selected;return[t("v-chip",e._b({attrs:{"input-value":d,close:""},on:{click:select,"click:close":function(n){return e.remove(o)}}},"v-chip",r,!1),[e._v("\n            "+e._s(o.fullName)+"\n          ")])]}},{key:"item",fn:function(n){var r=n.item;return[[t("v-list-item-content",[t("v-list-item-title",[e._v(e._s(r.fullName))])],1)]]}}]),model:{value:e.model.selected,callback:function(n){e.$set(e.model,"selected",n)},expression:"model.selected"}})],1)],1)],1)}),[],!1,null,null,null);n.default=component.exports;v()(component,{VAutocomplete:k.a,VChip:h.a,VCol:y.a,VContainer:N.a,VListItemContent:S.a,VListItemTitle:S.c,VRow:w.a})},477:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"addGroupMembers"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"members"}},type:{kind:"NonNullType",type:{kind:"ListType",type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"addGroupMembers"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}},{kind:"Argument",name:{kind:"Name",value:"members"},value:{kind:"Variable",name:{kind:"Name",value:"members"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:115}};t.loc.source={body:"mutation addGroupMembers($id: ID!, $members: [ID!]!) {\n  addGroupMembers(id: $id, members: $members) {\n    id\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.addGroupMembers=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"addGroupMembers")},478:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"removeGroupMembers"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"members"}},type:{kind:"NonNullType",type:{kind:"ListType",type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"removeGroupMembers"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}},{kind:"Argument",name:{kind:"Name",value:"members"},value:{kind:"Variable",name:{kind:"Name",value:"members"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:121}};t.loc.source={body:"mutation removeGroupMembers($id: ID!, $members: [ID!]!) {\n  removeGroupMembers(id: $id, members: $members) {\n    id\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.removeGroupMembers=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"removeGroupMembers")},479:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"mutation",name:{kind:"Name",value:"syncGroupPermissions"},variableDefinitions:[{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"id"}},type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}},directives:[]},{kind:"VariableDefinition",variable:{kind:"Variable",name:{kind:"Name",value:"permissions"}},type:{kind:"NonNullType",type:{kind:"ListType",type:{kind:"NonNullType",type:{kind:"NamedType",name:{kind:"Name",value:"ID"}}}}},directives:[]}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"syncGroupPermissions"},arguments:[{kind:"Argument",name:{kind:"Name",value:"id"},value:{kind:"Variable",name:{kind:"Name",value:"id"}}},{kind:"Argument",name:{kind:"Name",value:"permissions"},value:{kind:"Variable",name:{kind:"Name",value:"permissions"}}}],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:137}};t.loc.source={body:"mutation syncGroupPermissions($id: ID!, $permissions: [ID!]!) {\n  syncGroupPermissions(id: $id, permissions: $permissions) {\n    id\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.syncGroupPermissions=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"syncGroupPermissions")},480:function(e,n){var t={kind:"Document",definitions:[{kind:"OperationDefinition",operation:"query",name:{kind:"Name",value:"Permissions"},variableDefinitions:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"permissions"},arguments:[],directives:[],selectionSet:{kind:"SelectionSet",selections:[{kind:"Field",name:{kind:"Name",value:"id"},arguments:[],directives:[]},{kind:"Field",name:{kind:"Name",value:"name"},arguments:[],directives:[]}]}}]}}],loc:{start:0,end:57}};t.loc.source={body:"query Permissions {\n  permissions {\n    id\n    name\n  }\n}",name:"GraphQL request",locationOffset:{line:1,column:1}};var r={};function o(e,n){for(var i=0;i<e.definitions.length;i++){var element=e.definitions[i];if(element.name&&element.name.value==n)return element}}t.definitions.forEach((function(e){if(e.name){var n=new Set;!function e(n,t){if("FragmentSpread"===n.kind)t.add(n.name.value);else if("VariableDefinition"===n.kind){var r=n.type;"NamedType"===r.kind&&t.add(r.name.value)}n.selectionSet&&n.selectionSet.selections.forEach((function(n){e(n,t)})),n.variableDefinitions&&n.variableDefinitions.forEach((function(n){e(n,t)})),n.definitions&&n.definitions.forEach((function(n){e(n,t)}))}(e,n),r[e.name.value]=n}})),e.exports=t,e.exports.Permissions=function(e,n){var t={kind:e.kind,definitions:[o(e,n)]};e.hasOwnProperty("loc")&&(t.loc=e.loc);var d=r[n]||new Set,l=new Set,c=new Set;for(d.forEach((function(e){c.add(e)}));c.size>0;){var m=c;c=new Set,m.forEach((function(e){l.has(e)||(l.add(e),(r[e]||new Set).forEach((function(e){c.add(e)})))}))}return l.forEach((function(n){var r=o(e,n);r&&t.definitions.push(r)})),t}(t,"Permissions")},492:function(e,n,t){"use strict";t.r(n);t(14),t(12),t(8),t(7),t(13);var r=t(3),o=(t(50),t(47)),d=t(428),l=t(426),c=t(444),m=t.n(c),f=t(454),v=t.n(f);function k(object,e){var n=Object.keys(object);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(object);e&&(t=t.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),n.push.apply(n,t)}return n}function h(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?k(source,!0).forEach((function(n){Object(r.a)(e,n,source[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):k(source).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(source,n))}))}return e}var y=Object(o.a)(d.a,l.a).extend({methods:{submit:function(){var e=this;this.saveModel(m.a,{id:this.model.id,data:{name:this.model.name,description:this.model.description}},{query:v.a,variables:{id:this.model.id},callback:function(e,data){return{user:h({},e.group,{},data.updateGroup)}}}).then(this.updateModel).then((function(){return e.$emit("refreshGroup")}))}}}),N=t(22),S=t(26),w=t.n(S),V=t(198),x=t(415),D=t(472),E=t(473),O=t(474),$=t(436),_=t(418),G=t(531),component=Object(N.a)(y,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-expansion-panel",[t("v-expansion-panel-header",[e._v("\n    "+e._s(e.$t("group.groupInfo"))+"\n  ")]),e._v(" "),t("v-expansion-panel-content",[t("v-form",{ref:"form"},[t("v-row",[t("v-col",{attrs:{cols:"12"}},[t("v-textarea",{attrs:{"error-messages":e.$v("data.description","group.description",{max:1e3}),label:e.$t("group.description"),"auto-grow":"",counter:"",rows:2},model:{value:e.model.description,callback:function(n){e.$set(e.model,"description",n)},expression:"model.description"}})],1)],1),e._v(" "),t("div",{staticClass:"d-flex"},[t("div",{staticClass:"flex-grow-1"}),e._v(" "),t("v-btn",{attrs:{color:"primary",loading:e.saving},on:{click:e.submit}},[e._v("\n          "+e._s(e.$t("general.save"))+"\n        ")])],1)],1)],1)],1)}),[],!1,null,null,null);n.default=component.exports;w()(component,{VBtn:V.a,VCol:x.a,VExpansionPanel:D.a,VExpansionPanelContent:E.a,VExpansionPanelHeader:O.a,VForm:$.a,VRow:_.a,VTextarea:G.a})},493:function(e,n,t){"use strict";t.r(n);t(55);var r=t(20),o=t(47),d=t(457),l=t(430),c=t(425),m=t(444),f=t.n(m),v=t(446),k=t.n(v),h=t(116),y=Object(o.a)(c.a).extend({data:function(){return{item:1,items:[{text:"Real-Time",icon:"mdi-clock"},{text:"Audience",icon:"mdi-account"},{text:"Conversions",icon:"mdi-flag"}]}},computed:{createdAt:function(){return this.model.createdAt?Object(l.a)(this.model.createdAt).format("LL"):null},updatedAt:function(){return this.model.updatedAt?Object(l.a)(this.model.updatedAt).format("LL"):null}},methods:{renameGroup:function(){var e=this;return Object(r.a)(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,e.$dialog({title:e.$t("messages.renameGroupTitle"),component:d.default,preset:h.a.Save,action:function(n){return e.$apollo.mutate({mutation:f.a,variables:{id:e.model.id,data:n}})}});case 2:case"end":return n.stop()}}),n)})))()},deleteGroup:function(){var e=this;return Object(r.a)(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,e.$confirm({title:e.$t("messages.deleteGroupTitle"),message:e.$t("messages.deleteGroupMessage",e.model),preset:h.a.Delete,action:function(){return e.$apollo.mutate({mutation:k.a,variables:{id:e.model.id}}).then((function(){e.$router.push("/groups")}))}});case 2:case"end":return n.stop()}}),n)})))()}}}),N=t(22),S=t(26),w=t.n(S),V=t(177),x=t(403),D=t(179),E=t(180),O=t(106),$=t(17),_=t(184),G=t(89),component=Object(N.a)(y,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-card",[t("div",{staticClass:"d-flex flex-md-column pa-4"},[t("div",{},[t("div",{staticClass:"title"},[e._v("\n        "+e._s(e.model.name)+"\n      ")]),e._v(" "),t("div",[e._v(e._s(e.model.email))]),e._v(" "),e.updatedAt?t("div",{staticClass:"mt-3 caption muted--text"},[e._v("\n        "+e._s(e.$t("general.updatedAt",{date:e.updatedAt}))+"\n      ")]):e._e(),e._v(" "),t("div",{staticClass:"caption muted--text"},[e._v("\n        "+e._s(e.$t("general.createdAt",{date:e.createdAt}))+"\n      ")])])]),e._v(" "),t("v-divider"),e._v(" "),t("v-list",[t("v-list-item-group",[t("v-list-item",{on:{click:e.renameGroup}},[t("v-list-item-icon",[t("v-icon",[e._v("edit")])],1),e._v(" "),t("v-list-item-content",[t("v-list-item-title",[e._v(e._s(e.$t("group.renameGroup")))])],1)],1),e._v(" "),t("v-list-item",{on:{click:e.deleteGroup}},[t("v-list-item-icon",[t("v-icon",[e._v("delete")])],1),e._v(" "),t("v-list-item-content",[t("v-list-item-title",[e._v(e._s(e.$t("group.deleteGroup")))])],1)],1)],1)],1)],1)}),[],!1,null,null,null);n.default=component.exports;w()(component,{VCard:V.a,VDivider:x.a,VIcon:D.a,VList:E.a,VListItem:O.a,VListItemContent:$.a,VListItemGroup:_.a,VListItemIcon:G.a,VListItemTitle:$.c})},494:function(e,n,t){"use strict";t.r(n);t(50),t(55);var r=t(20),o=t(47),d=t(458),l=t(85),c=t(428),m=t(426),f=t(477),v=t.n(f),k=t(478),h=t.n(k),y=t(116),N=Object(o.a)(c.a,m.a).extend({data:function(){return{headers:[{text:l.b.t("user.fullName"),value:"fullName"},{text:l.b.t("user.email"),value:"email"},{text:l.b.t("general.actions"),value:"action",align:"right",sortable:!1}],search:"",options:{sortBy:["full_name"],sortDesc:[!1]}}},methods:{addMember:function(){var e=this;return Object(r.a)(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,e.$dialog({title:e.$t("messages.addMemberToGroupTitle",e.model),component:d.default,preset:y.a.Save,action:function(n){return e.$apollo.mutate({mutation:v.a,variables:{id:e.model.id,members:n.selected}}).then((function(){return e.$emit("refreshGroup")}))}});case 2:case"end":return n.stop()}}),n)})))()},removeMember:function(e){var n=this;return Object(r.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,n.$confirm({title:n.$t("messages.removeMemberToGroupTitle",{full_name:e.fullName,name:n.model.name}),message:n.$t("messages.removeMemberToGroupMessage",e),preset:y.a.Remove,action:function(){return n.$apollo.mutate({mutation:h.a,variables:{id:n.model.id,members:[e.id]}}).then((function(){return n.$emit("refreshGroup")}))}});case 2:case"end":return t.stop()}}),t)})))()}}}),S=t(22),w=t(26),V=t.n(w),x=t(198),D=t(415),E=t(557),O=t(472),$=t(473),_=t(474),G=t(179),T=t(418),P=t(445),component=Object(S.a)(N,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-expansion-panel",[t("v-expansion-panel-header",[e._v("\n    "+e._s(e.$t("group.members"))+"\n  ")]),e._v(" "),t("v-expansion-panel-content",[t("v-row",[t("v-col",{attrs:{cols:"2"}},[t("v-btn",{attrs:{fab:"",left:"",color:"secondary"},on:{click:e.addMember}},[t("v-icon",[e._v("mdi-plus")])],1)],1),e._v(" "),t("v-col",{attrs:{cols:"10"}},[t("v-text-field",{attrs:{"append-icon":"search",label:e.$t("general.search"),"single-line":"","hide-details":""},model:{value:e.search,callback:function(n){e.search=n},expression:"search"}})],1)],1),e._v(" "),t("v-data-table",{attrs:{headers:e.headers,items:e.model.members,options:e.options,search:e.search,"footer-props":{itemsPerPageOptions:[10,50,100]},"item-key":"id"},on:{"update:options":function(n){e.options=n}},scopedSlots:e._u([{key:"item.action",fn:function(n){var r=n.item;return[t("v-icon",{attrs:{small:""},on:{click:function(n){return e.removeMember(r)}}},[e._v("\n          delete\n        ")])]}}])})],1)],1)}),[],!1,null,null,null);n.default=component.exports;V()(component,{VBtn:x.a,VCol:D.a,VDataTable:E.a,VExpansionPanel:O.a,VExpansionPanelContent:$.a,VExpansionPanelHeader:_.a,VIcon:G.a,VRow:T.a,VTextField:P.a})},495:function(e,n,t){"use strict";t.r(n);t(14),t(12),t(8),t(7),t(13),t(62);var r=t(3),o=t(47),d=t(428),l=t(426),c=t(479),m=t.n(c),f=t(480),v=t.n(f);function k(object,e){var n=Object.keys(object);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(object);e&&(t=t.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),n.push.apply(n,t)}return n}var h=Object(o.a)(d.a,l.a).extend({data:function(){return{permissions:[],saving:!1}},apollo:{permissions:{query:v.a}},computed:{mapPermissions:function(){var e=this.model&&this.model.permissions||[];return this.permissions.map((function(p){return function(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?k(source,!0).forEach((function(n){Object(r.a)(e,n,source[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):k(source).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(source,n))}))}return e}({},p,{active:!!e.find((function(e){return e.id===p.id}))})}))}},methods:{togglePermission:function(e,n){if(e)return this.model.permissions.push(n);this.model.permissions=this.model.permissions.filter((function(p){return p.id!==n.id}))},submit:function(){var e=this,n=this.model.permissions.map((function(p){return p.id}));this.saveCallback((function(){return e.$apollo.mutate({mutation:m.a,variables:{id:e.model.id,permissions:n}})}))}}}),y=t(22),N=t(26),S=t.n(N),w=t(198),V=t(415),x=t(472),D=t(473),E=t(474),O=t(418),$=t(482),component=Object(y.a)(h,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-expansion-panel",[t("v-expansion-panel-header",[e._v("\n    "+e._s(e.$t("group.permissions"))+"\n  ")]),e._v(" "),t("v-expansion-panel-content",[e._l(e.mapPermissions,(function(n){return t("v-row",{key:n.id,attrs:{align:"center"}},[t("v-col",{attrs:{cols:"4"}},[t("v-switch",{attrs:{"input-value":n.active,label:n.name},on:{change:function(t){return e.togglePermission(t,n)}}})],1),e._v(" "),t("v-col",{staticClass:"muted--text",attrs:{cols:"8"}},[e._v("\n        "+e._s(n.id)+"\n      ")])],1)})),e._v(" "),t("div",{staticClass:"d-flex"},[t("div",{staticClass:"flex-grow-1"}),e._v(" "),t("v-btn",{attrs:{color:"primary",loading:e.saving},on:{click:e.submit}},[e._v("\n        "+e._s(e.$t("general.save"))+"\n      ")])],1)],2)],1)}),[],!1,null,null,null);n.default=component.exports;S()(component,{VBtn:w.a,VCol:V.a,VExpansionPanel:x.a,VExpansionPanelContent:D.a,VExpansionPanelHeader:E.a,VRow:O.a,VSwitch:$.a})},563:function(e,n,t){"use strict";t.r(n);var r=t(2),o=t(493),d=t(492),l=t(494),c=t(495),m=t(454),f=t.n(m),v=r.a.extend({components:{Info:o.default,GroupInfo:d.default,Members:l.default,Permissions:c.default},data:function(){return{img:!1,group:{}}},apollo:{group:{query:f.a,variables:function(){return{id:this.$route.params.id}}}},methods:{refreshGroup:function(){this.$apollo.queries.group.refresh()}}}),k=t(22),h=t(26),y=t.n(h),N=t(415),S=t(555),w=t(418),component=Object(k.a)(v,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("v-row",[t("v-col",{attrs:{cols:"12",md:"4"}},[t("info",{attrs:{value:e.group}})],1),e._v(" "),t("v-col",[t("v-expansion-panels",{attrs:{value:2}},[t("group-info",{attrs:{value:e.group,loading:e.$apollo.queries.group.loading},on:{refreshGroup:e.refreshGroup}}),e._v(" "),t("members",{staticClass:"mt-6",attrs:{value:e.group,loading:e.$apollo.queries.group.loading},on:{refreshGroup:e.refreshGroup}}),e._v(" "),t("permissions",{staticClass:"mt-6",attrs:{value:e.group,loading:e.$apollo.queries.group.loading},on:{refreshGroup:e.refreshGroup}})],1)],1)],1)}),[],!1,null,null,null);n.default=component.exports;y()(component,{VCol:N.a,VExpansionPanels:S.a,VRow:w.a})}}]);
