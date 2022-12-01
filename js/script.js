let menuBtn = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// Ao clicar no icone 'menu-hamburger', o icone muda para o 'X' e o menu se espande revelando os itens;
// Só ocorre quando está em dispositivo mobile;
menuBtn.onclick = () =>{
   menuBtn.classList.toggle('fa-times');
   navbar.classList.toggle('active');
}

// Ao rolar a tela, o menu se encolhe e troca o icone 'X' pelo icone de 'menu-hamburguer';
// Só ocorre quando está em dispositivo mobile;
window.onscroll = () =>{
   menuBtn.classList.remove('fa-times');
   navbar.classList.remove('active');
}

let darkModebtn = document.querySelector('#btnDarkMode')

darkModebtn.onclick = () =>
{
   var element = document.body;
   var textHome = document.querySelector('.text');
   var input1 = document.querySelector('.search');
   var input2 = document.querySelector('.location');
   var header = document.querySelector('.header');
          
   header.classList.toggle("dark-mode")
   textHome.classList.toggle("textDarkMode");
   input1.classList.toggle("darkBox");
   input2.classList.toggle("darkBox");
   element.classList.toggle("dark-mode");

   if (darkModebtn.checked){
      document.querySelector('#logo').src = './images/LogoDark.svg';
   }
   else {
      document.querySelector('#logo').src = './images/LogoLight.png';
   }
}


