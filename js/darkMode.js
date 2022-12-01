let darkModebtn = document.querySelector('#btnDarkMode')

darkModebtn.onclick = () =>
{
   var element = document.body;
   var textHome = document.querySelector('.text');
   var input1 = document.querySelector('.search');
   var input2 = document.querySelector('.location');
   var header = document.querySelector('.header');
   var categorias = document.querySelector('.categorias');
   
   if (header){
        header.classList.toggle("dark-mode")
    }
    if (textHome){
        textHome.classList.toggle("textDarkMode");
    }
    if (input1){
        input1.classList.toggle("darkBox");
    }
    if (input2){
        input2.classList.toggle("darkBox");
    }
    if (categorias){
        categorias.classList.toggle("dark-modeCat");
    }
   element.classList.toggle("dark-mode");

   if (darkModebtn.checked){

      document.querySelector('#logo').src = './images/LogoDark.svg';
      document.querySelector('#logoDelM').src = './images/DeliveryMuch LogoDark.svg';
   }
   else {
      darkModebtn.checked = false;
      document.querySelector('#logo').src = './images/LogoLight.png';
      document.querySelector('#logoDelM').src = './images/DeliveryMuch LogoLight.svg';
   }
}