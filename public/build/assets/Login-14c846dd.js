import{d as k,i as h,j as w,v,o as n,g as y,T as x,c as u,w as i,a,u as s,Z as V,t as B,h as c,b as l,k as C,e as p,n as $,f as P}from"./app-ad91e6bf.js";import{_ as N}from"./GuestLayout.vue_vue_type_script_setup_true_lang-b65d5e1a.js";import{_ as f,a as g,b as _}from"./TextInput.vue_vue_type_script_setup_true_lang-665d2eea.js";import{P as U}from"./PrimaryButton-893f5f48.js";import"./ApplicationLogo-5ba54249.js";import"./_plugin-vue_export-helper-c27b6911.js";const q=["value"],L=k({__name:"Checkbox",props:{checked:{type:Boolean},value:{}},emits:["update:checked"],setup(m,{emit:e}){const d=m,r=h({get(){return d.checked},set(o){e("update:checked",o)}});return(o,t)=>w((n(),y("input",{type:"checkbox",value:o.value,"onUpdate:modelValue":t[0]||(t[0]=b=>r.value=b),class:"rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"},null,8,q)),[[v,r.value]])}}),R={key:0,class:"mb-4 font-medium text-sm text-green-600"},S=["onSubmit"],j={class:"mt-4"},D={class:"block mt-4"},E={class:"flex items-center"},F=l("span",{class:"ml-2 text-sm text-gray-600 dark:text-gray-400"},"Remember me",-1),M={class:"flex items-center justify-end mt-4"},I=k({__name:"Login",props:{canResetPassword:{type:Boolean},status:{}},setup(m){const e=x({email:"",password:"",remember:!1}),d=()=>{e.post(route("login"),{onFinish:()=>{e.reset("password")}})};return(r,o)=>(n(),u(N,null,{default:i(()=>[a(s(V),{title:"Log in"}),r.status?(n(),y("div",R,B(r.status),1)):c("",!0),l("form",{onSubmit:P(d,["prevent"])},[l("div",null,[a(f,{for:"email",value:"Email"}),a(g,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[0]||(o[0]=t=>s(e).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(_,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),l("div",j,[a(f,{for:"password",value:"Password"}),a(g,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[1]||(o[1]=t=>s(e).password=t),required:"",autocomplete:"current-password"},null,8,["modelValue"]),a(_,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),l("div",D,[l("label",E,[a(L,{name:"remember",checked:s(e).remember,"onUpdate:checked":o[2]||(o[2]=t=>s(e).remember=t)},null,8,["checked"]),F])]),l("div",M,[r.canResetPassword?(n(),u(s(C),{key:0,href:r.route("password.request"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:i(()=>[p(" Forgot your password? ")]),_:1},8,["href"])):c("",!0),a(U,{class:$(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:i(()=>[p(" Log in ")]),_:1},8,["class","disabled"])])],40,S)]),_:1}))}});export{I as default};
