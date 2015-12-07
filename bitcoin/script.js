(function ($) {
$(document).ready(function(){


$("form#main-form" ).submit(function( event ) {

  var coins = parseFloat($("#main-form #qty").val());
  var action = $("#main-form #action").val();  

  if(!coins) {
    alert("Pleaes enter a number of Bitcoins you would like to buy/sell.");  
    return false;         
  }  
  
  if(action == 'buy' && (coins > ask_limit)) {
    alert("There are not that many Bitcoins available to buy. Please enter a lower number.");  
    return false; 
  } else if (action == 'sell' && coins > bid_limit) {
    alert("There are not that many Bitcoins available.");  
    return false;     
  }
  
  return true;

});


});
})(jQuery);