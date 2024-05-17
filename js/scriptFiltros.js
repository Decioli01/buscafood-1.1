let filtroBtn = document.querySelector('#btn-filtros');
let filtroBtnIcon = document.querySelector('.fa-filter');
let abaFiltros = document.querySelector('.filtros');

filtroBtn.onclick = () =>{
    filtroBtnIcon.classList.toggle('fa-times');
    abaFiltros.classList.toggle('active');
 }
 window.onscroll = () =>{
    filtroBtnIcon.classList.remove('fa-times');
    abaFiltros.classList.remove('active');
 }