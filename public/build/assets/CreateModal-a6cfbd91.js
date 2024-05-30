import{d as F,m as O,T,p as U,l as B,o as m,c as D,w as d,b as c,u as e,a as t,f as y,q as I,s as p,v as g,n as f,e as _,t as b,h as x,x as N,y as j}from"./app-8d0782cb.js";import{s as E}from"./vue-multiselect-6f44508e.js";import{w as z,e as a,v as q}from"./Index-1229535b.js";import{_ as G}from"./_plugin-vue_export-helper-c27b6911.js";import{h as w,G as $,V as H,U as P,S as W}from"./transition-84619d3a.js";import"./micro-task-cadf959b.js";const l=n=>(N("data-v-2c75ef88"),n=n(),j(),n),J=l(()=>t("div",{class:"fixed inset-0 bg-black/25"},null,-1)),K={class:"fixed inset-0 overflow-y-auto"},L={class:"flex min-h-full items-center justify-center p-4 text-center"},Q=["onSubmit"],R={class:"grid gap-4 mb-4 grid-cols-2"},X={class:"col-span-2"},Y=l(()=>t("label",{for:"title",class:"block mb-2 text-xs font-medium text-gray-500 dark:text-white"},"Title",-1)),Z={key:0,class:"text-xs text-red-500 mt-1"},ee={class:"col-span-2"},te=l(()=>t("label",{for:"client",class:"block mb-2 text-xs font-medium text-gray-500 dark:text-white"},"Client",-1)),oe={key:0,class:"text-xs text-red-500 mt-1"},ae={class:"col-span-2 sm:col-span-1"},se=l(()=>t("label",{for:"start_time",class:"block mb-2 text-xs font-medium text-gray-500 dark:text-white"},"Start Date",-1)),re={key:0,class:"text-xs text-red-500 mt-1"},ie={class:"col-span-2 sm:col-span-1"},de=l(()=>t("label",{for:"end_time",class:"block mb-2 text-xs font-medium text-gray-500 dark:text-white"},"End Date",-1)),le={key:0,class:"text-xs text-red-500 mt-1"},ne={class:"col-span-2"},ce=l(()=>t("label",{for:"description",class:"block mb-2 text-xs font-medium text-gray-500 dark:text-white"},"Description",-1)),me=l(()=>t("button",{type:"submit",class:"text-white inline-flex items-center bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"},[t("svg",{class:"me-1 -ms-1 w-5 h-5",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[t("path",{"fill-rule":"evenodd",d:"M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z","clip-rule":"evenodd"})]),y(" Add Event ")],-1)),ue={__name:"CreateModal",props:{isCreateModalOpen:Boolean,calendarOptions:Object,selectedClient:Object,fetchAllAppointments:Function,fetchAllClients:Function,searchClients:Function,matchingClients:Object},emits:["closeCreateModal"],setup(n,{emit:C}){const i=F([]),v=O(),V=C,u=n,o=T({title:"",client_id:"",start_time:"",end_time:"",description:""}),M=()=>{o.title="",o.client_id="",o.start_time="",o.end_time="",o.description="",i.value=null},S=()=>{V("closeCreateModal"),a.value={},i.value=null},A=async()=>{if(q(o),Object.keys(a.value).length>0){v.error("Please correct the errors in the form.");return}const h={title:o.title,client_id:i.value.id,start_time:o.start_time,end_time:o.end_time,description:o.description};await axios.post("/appointments/create",h),u.fetchAllAppointments(),S(),M(),v.success("Appointment created successfully!")},k=()=>{i.value&&(a.value.client_id=[],o.client_id=i.value.id)};return U(i,()=>{i.value&&k()}),B(async()=>{await u.fetchAllClients(),z(o)}),(h,s)=>(m(),D(e(W),{appear:"",show:n.isCreateModalOpen,as:"template"},{default:d(()=>[c(e(P),{as:"div",onClose:s[5]||(s[5]=r=>h.$emit("closeCreateModal")),class:"relative z-10"},{default:d(()=>[c(e(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:d(()=>[J]),_:1}),t("div",K,[t("div",L,[c(e(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:d(()=>[c(e($),{class:"w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"},{default:d(()=>[c(e(H),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:d(()=>[y(" Add New Event ")]),_:1}),t("form",{onSubmit:I(A,["prevent"]),class:"py-5"},[t("div",R,[t("div",X,[Y,p(t("input",{"onUpdate:modelValue":s[0]||(s[0]=r=>e(o).title=r),type:"text",name:"title",id:"title",class:f(["bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500",e(a).title?"border-red-500":"border-gray-300"]),placeholder:"Type event title"},null,2),[[g,e(o).title]]),e(a).title?(m(),_("div",Z,b(e(a).title),1)):x("",!0)]),t("div",ee,[te,c(e(E),{modelValue:i.value,"onUpdate:modelValue":s[1]||(s[1]=r=>i.value=r),options:u.matchingClients,multiple:!1,"clear-on-select":!0,placeholder:"Type to search",label:"name","track-by":"id",onSearchChange:u.searchClients,onInput:k,class:f({error:e(a).client_id})},{noUser:d(()=>[y(" Oops! No users found. Try a different search query. ")]),_:1},8,["modelValue","options","onSearchChange","class"]),e(a).client_id?(m(),_("div",oe,b(e(a).client_id),1)):x("",!0)]),t("div",ae,[se,p(t("input",{"onUpdate:modelValue":s[2]||(s[2]=r=>e(o).start_time=r),type:"datetime-local",name:"start_time",id:"start_time",class:f(["bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500",e(a).start_time?"border-red-500":"border-gray-300"])},null,2),[[g,e(o).start_time]]),e(a).start_time?(m(),_("div",re,b(e(a).start_time),1)):x("",!0)]),t("div",ie,[de,p(t("input",{"onUpdate:modelValue":s[3]||(s[3]=r=>e(o).end_time=r),type:"datetime-local",name:"end_time",id:"end_time",class:f(["bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500",e(a).end_time?"border-red-500":"border-gray-300"])},null,2),[[g,e(o).end_time]]),e(a).end_time?(m(),_("div",le,b(e(a).end_time),1)):x("",!0)]),t("div",ne,[ce,p(t("textarea",{"onUpdate:modelValue":s[4]||(s[4]=r=>e(o).description=r),id:"description",rows:"4",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500",placeholder:"Write event description here"},null,512),[[g,e(o).description]])])]),me],40,Q)]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]))}},he=G(ue,[["__scopeId","data-v-2c75ef88"]]);export{he as default};
