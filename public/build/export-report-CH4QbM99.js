document.addEventListener("DOMContentLoaded",function(){const n=document.getElementById("export-button"),o=document.getElementById("report-options"),c=()=>{o.style.display="flex"},r=()=>{o.style.display="none"};n.addEventListener("mouseenter",c),n.addEventListener("mouseleave",()=>{setTimeout(r,3e3)});const t=()=>{const e=document.getElementById("date_transfer")?document.getElementById("date_transfer").value:null,d=document.getElementById("start_date")?document.getElementById("start_date").value:null,a=document.getElementById("end_date")?document.getElementById("end_date").value:null;return e?`date=${e}`:d&&a?`start_date=${d}&end_date=${a}`:""};document.getElementById("export-pdf").addEventListener("click",function(){const e=t();window.location.href=`/finances/export-pdf?${e}`}),document.getElementById("export-csv").addEventListener("click",function(){const e=t();window.location.href=`/finances/export-csv?${e}`}),document.getElementById("export-excel").addEventListener("click",function(){const e=t();window.location.href=`/finances/export-excel?${e}`}),document.getElementById("print-report").addEventListener("click",function(){const e=t();window.location.href=`/finances/print?${e}`})});