let darkModebtn = document.querySelector('#btnDarkMode')
var headerLoja = document.querySelector('#header-loja');
if (headerLoja){
    headerLoja.style.backgroundColor = '#f9f9f9'; 
}
    
darkModebtn.onclick = () =>
{
   var element = document.body;
   var textHome = document.querySelector('.text');
   var input1 = document.querySelector('.search');
   var input2 = document.querySelector('.location');
   var header = document.querySelector('.header');
   var categorias = document.querySelector('.categorias');
   var logoDelM = document.querySelector('#logoDelM');
   var inputContato = document.querySelector('#tipo-contato');
   var qrCode = document.querySelector('#qr-code'); 

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

    if (headerLoja){
        headerLoja.style.backgroundColor = '#000';
    }

    if (darkModebtn.checked){
      document.querySelector('#logo').src = './images/LogoDark.svg';
      if (logoDelM){
        logoDelM.src = './images/DeliveryMuch LogoDark.svg';
      }
      if (inputContato){
        inputContato.style.color = '#ddd';
      }
      if (qrCode){
        qrCode.src = './images/codigo-qr.png';
      }
      
   }
    else {
      darkModebtn.checked = false;
      document.querySelector('#logo').src = './images/LogoLight.png';
      if (headerLoja){
        headerLoja.style.backgroundColor = '#f9f9f9';
      }
      if (qrCode){
        qrCode.src = './images/codigo-qr-light.png';
      }
      if (inputContato){
        inputContato.style.color = '#323232';
      }
      if (logoDelM){
        logoDelM.src = './images/DeliveryMuch LogoLight.svg';
      }
   }
}