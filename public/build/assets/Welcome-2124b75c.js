import{o as a,g as o,b as s,d as w,r as i,l as x,B as m,i as $,x as b,c as y,t as v,h as L,j as B,C as F,F as M,D as C,w as _,a as p,u as g,Z as D}from"./app-ad91e6bf.js";import{_ as I}from"./GuestLayout.vue_vue_type_script_setup_true_lang-b65d5e1a.js";import{M as R,g as T,_ as V}from"./generateGithubLink-77a47489.js";import{_ as E}from"./_plugin-vue_export-helper-c27b6911.js";import"./ApplicationLogo-5ba54249.js";const H={},N={class:"place-self-center grid gap-2 place-content-center dark:text-white animate-pulse"},S=s("div",{class:"aspect-square"},[s("img",{class:"h-24 w-24",src:"/images/JasonHorsleyTechLogo.png"})],-1),j=s("p",{class:"text-center"},"Loading",-1),U=[S,j];function W(h,l){return a(),o("div",N,U)}const q=E(H,[["render",W]]),G={class:"shadow-xl rounded-lg border bg-[#EDF2F7] dark:border-[#4B5563] dark:bg-[#EDF2F7]/20 md:w-[36rem]"},J=["innerHTML"],P={class:"flex flex-row justify-end py-4"},Y={key:0},Z=s("span",null," This is the resume I sent you, but I'll let you peak at the others too. ",-1),z=s("option",{value:"null",disabled:"",selected:""}," Select a different resume ",-1),A=["value"],K=w({__name:"Resume",setup(h){const l=new R,n=i(null),u=i([]),d=i(null);x(async()=>{const t=await m.get("/api/professional/resumes");u.value=t.data.resumes;const{data:e}=await m.get("/api/professional/resume");n.value=e.resume,c.value=e.resume.id,d.value=e.company_name});const f=$(()=>n.value===null?null:l.render(n.value.content)),c=i(null);b(c,t=>{var e;t!==null&&t!==((e=n.value)==null?void 0:e.id)&&k(t)});const k=async t=>{n.value=null;const{data:e}=await m.get(`/api/professional/resumes/${t}`);n.value=e};return(t,e)=>(a(),o("div",null,[s("div",G,[f.value?(a(),o("div",{key:1,class:"prose dark:prose-invert min-h-[32rem] p-4",innerHTML:f.value},null,8,J)):(a(),y(q,{key:0}))]),s("div",P,[d.value?(a(),o("div",Y,[s("span",null,"Pssst! You're "+v(d.value)+" right?",1),Z])):L("",!0),B(s("select",{"onUpdate:modelValue":e[0]||(e[0]=r=>c.value=r)},[z,(a(!0),o(M,null,C(u.value,r=>(a(),o("option",{key:r.id,value:r.id},v(r.name),9,A))),128))],512),[[F,c.value]])])]))}}),O={class:"grid place-content-center md:w-[36rem] min-h-screen gap-4 py-4"},Q={class:"md:w-[36rem] p-4"},ne=w({__name:"Welcome",setup(h){const l=T(import.meta.url);return(n,u)=>(a(),y(I,null,{header:_(()=>[p(g(D),{title:"Welcome"})]),footer:_(()=>[s("div",Q,[p(V,{url:g(l)},null,8,["url"])])]),default:_(()=>[s("div",O,[p(K)])]),_:1}))}});export{ne as default};