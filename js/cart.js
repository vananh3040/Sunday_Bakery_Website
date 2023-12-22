 
  function decreaseNumber(indec,itemprice) {
    var itemval = document.getElementById(indec);
    var itemprice = document.getElementById(itemprice);
    //console.log(itemval.value);
    if(itemval.value<=0){
      itemval.value = 0;
      itemval.style.background ='red';
      itemval.style.color = '#fff';
      } else{  
        itemval.style.color = '#fff '; 
        itemval.style.color = '#000';
        itemval.value = parseInt(itemval.value) -1;
        itemprice.innerHTML = parseInt(itemprice.innerHTML) - 15;
      }
  }
  function increaseNumber(indec, itemprice) {
    var itemval = document.getElementById(indec);
    var itemprice = document.getElementById(itemprice);
    //console.log(itemval.value);
    if(itemval.value>=5){
      itemval.value = 5;
      alert('max 5 allowed');
      itemval.style.background ='red';
      itemval.style.color = '#fff';
      } else{
        itemval.value = parseInt(itemval.value) + 1;
        itemprice.innerHTML = parseInt(itemprice.innerHTML)+15;
      }
  }
 