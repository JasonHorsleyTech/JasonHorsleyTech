import{d as p,T as c,c as w,w as n,o as _,a as o,u as s,Z as g,b as t,e as d,k as V,n as y,f as v}from"./app-69927720.js";import{_ as b}from"./GuestLayout.vue_vue_type_script_setup_true_lang-1171d4f9.js";import{_ as l,a as m,b as i}from"./TextInput.vue_vue_type_script_setup_true_lang-361cd036.js";import{P as k}from"./PrimaryButton-e14899fe.js";import"./ApplicationLogo-5ba54249.js";import"./_plugin-vue_export-helper-c27b6911.js";const x=["onSubmit"],h={class:"mt-4"},q={class:"mt-4"},B={class:"mt-4"},C={class:"flex items-center justify-end mt-4"},j=p({__name:"Register",setup(N){const e=c({name:"",email:"",password:"",password_confirmation:""}),u=()=>{e.post(route("register"),{onFinish:()=>{e.reset("password","password_confirmation")}})};return(f,a)=>(_(),w(b,null,{default:n(()=>[o(s(g),{title:"Register"}),t("form",{onSubmit:v(u,["prevent"])},[t("div",null,[o(l,{for:"name",value:"Name"}),o(m,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).name=r),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),t("div",h,[o(l,{for:"email",value:"Email"}),o(m,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).email=r),required:"",autocomplete:"username"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",q,[o(l,{for:"password",value:"Password"}),o(m,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[2]||(a[2]=r=>s(e).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",B,[o(l,{for:"password_confirmation",value:"Confirm Password"}),o(m,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=r=>s(e).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),t("div",C,[o(s(V),{href:f.route("login"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:n(()=>[d(" Already registered? ")]),_:1},8,["href"]),o(k,{class:y(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>[d(" Register ")]),_:1},8,["class","disabled"])])],40,x)]),_:1}))}});export{j as default};