$(document).ready(main);
var contador =1;
/******************************************************
 *  Method that permit open bar menu options 
 ******************************************************/
function main(){
    $('.menu_bar').click(function(){
        if(contador===1){
            $('nav').animate({
                left:'0'
            });
            contador=0;
        }else{
             $('nav').animate({
                left:'-100%'
             }); 
             contador=1;
        }
     });
}
/******************************************************
 *  Method that permit close bar menu options
 ******************************************************/
function menuClose(){
  $('nav').animate({ left:'-100%' }); 
  contador=1; 
}

