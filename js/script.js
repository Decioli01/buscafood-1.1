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
//verifica se o valor da avaliação é igual a zero ou não
function avaliacao() {
   let estrelas = document.querySelector('input[name=estrela]:checked').value;
   let estrelas_mobile = document.querySelector('input[name=estrela-mobile]:checked').value;

   if (estrelas === '' && estrelas_mobile === '') {
      alert('Necessário selecionar pelo menos uma estrela!');
  }
  
}