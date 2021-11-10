<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles --> 
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      

        <style>
          .radio-toolbar {
  margin: 10px 0px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    padding: 10px 15px;
    font-family: sans-serif, Arial;
    font-size: 12px;
    color:#CCCCCC;
    border: 1px solid #CCCCCC;
    cursor:pointer;
}


.radio-toolbar input[type="radio"]:focus + label {
    border-color: #222222;
}

.radio-toolbar input[type="radio"]:checked + label {
    border-color: #222222;
    border: 2px solid #222222;
}


img {
  max-width: 100%;
  display: block;
}

.cart-btn {
  display: flex;
  justify-content: flex-end;
}

#cart {
  position: relative;
  cursor: pointer;
}

.cart-quantity {
  position: absolute;
  right: 0;
  padding: 0px 5px;
}

.items-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  margin-top: 1em
}

.card {
  margin: 1em;
  position: relative;
  overflow: hidden; 
  text-align: center
}

.card:hover .add-to-cart {
  transform: translateX(0);
}

.product-image {
  margin-bottom: 1em
}

.add-to-cart {
  background-color: white;
    color: black;
    position: absolute;
    right: 32.5%;
    top: 70%;
    float: right;
    padding: 5px 20px;
    outline: none;
    border: 2px solid #222222;
    cursor: pointer;
    font-weight: bolder;
    font-size: 1.2rem;
    width: 15%;
    margin: 0;
}

.product-price {
  padding-top: 1em;
}

.cart-modal-overlay {
  position: fixed;
  width: 100vw;
  height: 100%;
  z-index: 2;
  transform: translateX(-200%);
  transition: .5s ease-out;
  overflow: hidden;
}

.cart-modal {
    width: 20%;
    background-color: white;
    top: 5.5%;
    right: 0%;
    display: block;
    left: 67%;
    position: relative;
    border: 1px solid #CCCCCC;
}

#close-btn {
  font-size: 1.5rem;
  float: right;
  margin: .5em 2em 0 0;
  color: white;
  cursor: pointer;
}

.cart-is-empty {
  color: white;
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 1em;
  display: none;
  
}

.total {
  text-align: center;
  margin: 2em 0 2em 0;
}

.cart-total {
  color: white;
}

.total-price {
  color: white;
  font-size: 2rem;
  display: block;
}

.purchase-btn {
  font-size: 1rem;
  font-weight: bolder;
  background-color: green;
  color: white;
  padding: 1em 2em;
  border-radius: 10px;
  outline: none;
  border: none;
  cursor: pointer;
  margin: 2em 0 1em 0;
}

.product-rows {
  margin-top: 1em;
  width: 100%;
  margin-left: 20px;
  margin-right: auto;
  
}

.product-row {
  display: block;
  align-items: center;
}

.cart-image {
  width: 5rem;
  margin: 0 0 1em 0;
}

.cart-text {
  color: #222222;
}

.product-quantity {
  width: 1.3rem;
  background: transparent;
  overflow-y: hidden;
  overflow-x: hidden;
}

.remove-btn {
  padding: 5px 10px;
  background-color: red;
  color: white;
  outline: none;
  border: none;
  cursor: pointer;
  font-weight: bolder;
  font-size: 1rem;
}

.remove-btn:active {
  transform: translateY(5px);
}

@media (max-width: 1000px){
  .cart-modal {
    width: 100vw;
  } 
  
  .product-row {
    flex-direction: column;
    text-align: center;
    margin-bottom: 2em;
  }
  
  .remove-btn {
    margin: 0
  }
  
  .product-quantity {
    margin: .5em 0 .5em 0
  }
  @media (max-width: 480px) {
    .add-to-cart {
    background-color: white;
    color: black;
    position: relative;
    right: 0;
    top: 0;
    float: right;
    padding: 5px 20px;
    outline: none;
    border: 2px solid #222222;
    cursor: pointer;
    font-weight: bolder;
    width: 50%;
    font-size: 1.2rem;
    margin: 0 15px;
    }
    .cart-quantity {
    position: relative;
    right: 0;
    padding: 0pxpx;
    }
  }
}



</style>

</head>


   <!--  cart modal  -->
  <div class="cart-modal-overlay">
  
    <div class="cart-modal">
      <i id="close-btn" class="fas fa-times"></i>
        <h1 class="cart-is-empty">Cart is empty</h1>
      
        <div class="product-rows">
        </div>
        
        <div class="total">
          <h1 class="cart-total">TOTAL</h1>
            <span class="total-price">$0</span>
              <button class="purchase-btn">PURCHASE</button>
        </div>
        
      </div>
      
    </div>
<!--   end of cart modal -->


<div class="2xl:container xl:container lg:container md:container sm:container mx-auto 2xl:px-8 xl:px-8 lg:px-8 md:px-6 sm:px-4 pt-5">
  <!-- Cart Header class="fas fa-shopping-cart" -->
    <div style="background-color:#F6F6F7; color:#888888;" class="text-right 2xl:px-16 xl:px-16 lg:px-16 md:px-16 sm:px-0 px-0 text-xs p-2 2xl:pr-40 xl:pr-40 lg:pr-40 md:pr-40 sm:pr-4 pr-4">
      <div class="cart-btn">
        <p id="cart" class="2xl:inline-block xl:inline-block lg:inline-block md:inline-block sm:hidden hidden text-xs">My Cart (&nbsp;
          <span class="cart-quantity px-2">0</span>&nbsp;)</p>
          <!-- Mobile Cart View -->
          <p><span class="2xl:hidden xl:hidden lg:hidden md:hidden sm:inline-flex inline-flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" /></svg>
            <span class="cart-quantity">(&nbsp;0&nbsp;)</span>
          </p>
      </div>
    </div>

            <!--  products  -->

            <div class="items-container">
              <div class="card-1 card">
                <div class="grid 2xl:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-1">
                  <div class="col-span-1">
                    <img src="{{ asset('images/img.png') }}" alt="..." class="product-image m-auto object-center">
                  </div>

                    <div class="col-span-1 text-left 2xl:w-9/12 xl:w-9/12 lg:w-9/12 md:w-9/12 sm:w-full">
                      <div class="2xl:mx-8 xl:mx-8 lg:mx-8 md:mx-6 sm:mx-4 mx-4">
                        <h2 style="color:#222222;" class="font-semibold text-2xl pt-2 pb-5"><span class="product-name">Classic Tee</h2>
                          <hr style="color:#CCCCCC;" class="2xl:block xl:block lg:block md:block sm:hidden hidden">
                          <p style="color:#222222;" class="font-bold py-2 text-sm"><span class="product-price">$75.00</span></p>
                          <hr style="color:#CCCCCC;" class="2xl:block xl:block lg:block md:block sm:hidden hidden">
                          <p style="color:#888888;" class="pt-5 text-sm">dolor sit amet, consectetuer adipiscing elit.
                            Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                            sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                            Proin pharetra nonummy pede. Mauris et orci. Aenean nec lorem. In porttitor.
                            Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc.
                            Mauris eget neque at sem venenatis eleifend. Ut nonummy.</p>
                            <div class="pt-10">
                              <label style="color:#888888;" class="uppercase font-semibold text-xs inline-block">Size<p style="color:#C90000;" class="inline-block">* </p><span id="result" class="inline-block font-bold text-black mx-1"></span></label>
                            </div>
                            <div class="radio-toolbar">
                              <input type="radio" id="radioS" name="product-size" value="S" onclick="displayRadioValue()">
                              <label for="radioS">S</label>
                          
                              <input type="radio" id="radioM" name="product-size" value="M" onclick="displayRadioValue()">
                              <label for="radioM">M</label>
                          
                              <input type="radio" id="radioL" name="product-size" value="L" onclick="displayRadioValue()">
                              <label for="radioL">L</label> 
                            </div>
                        </div>
                      </div>
                            <button class="bg-transparent hover:bg-black hover:text-white font-semibold py-2 px-4 border-2 border-black add-to-cart">Add to cart</button>
              
                  </div>
                </div>
              </div>
            </div>
      <!--  end of products  -->
</div>
        

  
</body>
</html>


<script>
  // Sizes
  function displayRadioValue() {
      var ele = document.getElementsByName('product-size')
        
      for(i = 0; i < ele.length; i++) {
          if(ele[i].checked)
          document.getElementById("result").innerHTML
                  = ele[i].value;
      }
  }

// open cart modal
const cart = document.querySelector('#cart');
const cartModalOverlay = document.querySelector('.cart-modal-overlay');

cart.addEventListener('click', () => {
  if (cartModalOverlay.style.transform === 'translateY(-200%)'){
    cartModalOverlay.style.transform = 'translateY(0)';
  } else {
    cartModalOverlay.style.transform = 'translateY(-200%)';
  }
})
// end of open cart modal

// close cart modal
const closeBtn = document.querySelector ('#close-btn');

closeBtn.addEventListener('click', () => {
  cartModalOverlay.style.transform = 'translateY(-200%)';
});

cartModalOverlay.addEventListener('click', (e) => {
  if (e.target.classList.contains('cart-modal-overlay')){
    cartModalOverlay.style.transform = 'translateY(-200%)'
  }
})
// end of close cart modal

// add products to cart
const addToCart = document.getElementsByClassName('add-to-cart');
const productRow = document.getElementsByClassName('product-row');

for (var i = 0; i < addToCart.length; i++) {
  button = addToCart[i];
  button.addEventListener('click', addToCartClicked)
}

function addToCartClicked (event) {
  button = event.target;
  var cartItem = button.parentElement;
  var name = cartItem.getElementsByClassName('product-name')[0].innerText;
  var price = cartItem.getElementsByClassName('product-price')[0].innerText;
  var imageSrc = cartItem.getElementsByClassName('product-image')[0].src;
  var size = document.getElementById("result").innerHTML;
  addItemToCart (name, price, imageSrc, size);
  updateCartPrice()
}

function addItemToCart (name, price, imageSrc, size) {
  var productRow = document.createElement('div');
  productRow.classList.add('product-row');
  var productRows = document.getElementsByClassName('product-rows')[0];
  var cartImage = document.getElementsByClassName('cart-image');
  
  for (var i = 0; i > cartImage.length; i++){
    if (cartImage[i].src == imageSrc){
      alert ('This item has already been added to the cart.')
      return;
    }
  }

  
  var cartRowItems = `
    <div class="product-row">
      <div class="grid grid-cols-3 gap-0">
        <div class="col-span-1 mr-4 w-full">
          <img class="cart-image object-center" src="${imageSrc}" alt="">
        </div>
        <div class="col-span-2 ml-8 w-full mt-3">
          <p class="text-xs">${name}</p>
          <input class="product-quantity text-xs" value="1">x
          <span class="cart-price text-xs">${price}</span>
          <p class="text-xs">Size: <span class="text-xs">${size}</span></p>
          <button class="remove-btn mt-4">Remove</button>
        </div>
      </div>
    </div>
      `
  productRow.innerHTML = cartRowItems;
  productRows.append(productRow);
  productRow.getElementsByClassName('remove-btn')[0].addEventListener('click', removeItem)
  productRow.getElementsByClassName('product-quantity')[0].addEventListener('change', changeQuantity)
  updateCartPrice()
}
// end of add products to cart

// Remove products from cart
const removeBtn = document.getElementsByClassName('remove-btn');
for (var i = 0; i < removeBtn.length; i++) {
  button = removeBtn[i]
  button.addEventListener('click', removeItem)
}

function removeItem (event) {
  btnClicked = event.target
  btnClicked.parentElement.parentElement.remove()
  updateCartPrice()
}

// update quantity input
var quantityInput = document.getElementsByClassName('product-quantity')[0];

for (var i = 0; i < quantityInput; i++){
  input = quantityInput[i]
  input.addEventListener('change', changeQuantity)
}

function changeQuantity(event) {
  var input = event.target
  if (isNaN(input.value) || input.value <= 0){
    input.value = 1
  }
  updateCartPrice()
}
// end of update quantity input

// update total price
function updateCartPrice() {
  var total = 0
  for (var i = 0; i < productRow.length; i += 2) {
    cartRow = productRow[i]
  var priceElement = cartRow.getElementsByClassName('cart-price')[0]
  var quantityElement = cartRow.getElementsByClassName('product-quantity')[0]
  var price = parseFloat(priceElement.innerText.replace('$', ''))
  var quantity = quantityElement.value
  total = total + (price * quantity )
    
  }
  document.getElementsByClassName('total-price')[0].innerText =  '$' + total

document.getElementsByClassName('cart-quantity')[0].textContent = i /= 2
}
// end of update total price

// purchase items
const purchaseBtn = document.querySelector('.purchase-btn');

const closeCartModal = document.querySelector('.cart-modal');

purchaseBtn.addEventListener('click', purchaseBtnClicked)

function purchaseBtnClicked () {
  alert ('Thank you for your purchase.');
  cartModalOverlay.style.transform= 'translateY(-100%)'
 var cartItems = document.getElementsByClassName('product-rows')[0]
 while (cartItems.hasChildNodes()) {
   cartItems.removeChild(cartItems.firstChild)
   
 }
  updateCartPrice()
}
// end of purchase items

//alert user if cart is empty 



</script>