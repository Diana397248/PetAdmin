import{o as s,e as a,a as t,F as i,g as c,t as o}from"./app-8d0782cb.js";const r={class:"px-4 py-5 sm:p-6"},n={key:0,class:"text-center text-gray-500 py-4"},d={key:1,class:"min-w-full divide-y divide-gray-300"},p=t("thead",null,[t("tr",null,[t("th",{scope:"col",class:"py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"},"Condition"),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"},"Diagnosis"),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-sm font-semibold text-gray-900"},"Treatment"),t("th",{scope:"col",class:"py-3.5 text-right text-sm font-semibold text-gray-900"},"Notes")])],-1),m={class:"divide-y divide-gray-200"},x={class:"whitespace-normal py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"},y={class:"whitespace-normal px-3 py-4 text-sm text-gray-500"},_={class:"whitespace-normal px-3 py-4 text-sm text-gray-500"},h={class:"relative whitespace-normal py-4 pl-3 pr-4 text-right text-sm sm:pr-0 text-gray-500"},b={__name:"MedicalHistory",props:{pet:{type:Object,required:!0}},setup(l){return(g,u)=>(s(),a("div",r,[l.pet.medical_history.length===0?(s(),a("p",n,"No medical history found.")):(s(),a("table",d,[p,t("tbody",m,[(s(!0),a(i,null,c(l.pet.medical_history,e=>(s(),a("tr",{key:e.id},[t("td",x,o(e.condition),1),t("td",y,o(e.diagnosis_date),1),t("td",_,o(e.treatment),1),t("td",h,o(e.notes),1)]))),128))])]))]))}};export{b as default};
