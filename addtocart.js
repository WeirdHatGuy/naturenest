
function addToCart(productId, productName, price) {
    const xhr = new XMLHttpRequest();
  
    xhr.open("POST", "addToCart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (this.status === 200) {
        const response = JSON.parse(this.responseText);
        if (response.status === 'success') {
          // Update the UI by changing the 'Add to Cart' button to 'Added to Cart'
          const button = document.querySelector(`button[data-product-id="${productId}"]`);
          if (button) {
            button.textContent = 'Added to Cart';
            button.removeAttribute('data-product-id');
            button.removeAttribute('data-product-name');
            button.removeAttribute('data-price');
            button.classList.remove('add-to-cart');
            button.classList.add('added-to-cart');
          }
  
          // Fetch the updated cart from the server
          fetchCart();
  
          // Add the console.log statement
          console.log('Product added to cart:', response);
        }
      }
    };
  
    // Add the console.log statement
    console.log('AJAX request sent to addToCart.php');
  
    xhr.send(`productId=${productId}&productName=${productName}&price=${price}&addToCart=true`);
  }
  
  function fetchCart() {
    const xhr = new XMLHttpRequest();
  
    xhr.open("GET", "fetchCart.php", true);
    xhr.onload = function () {
      if (this.status === 200) {
        const cart = JSON.parse(this.responseText);
        // Update the 'Cart' navbar link with the number of items in the cart
        const cartLink = document.querySelector('.navbar .cart-link');
        if (cartLink) {
          cartLink.textContent = `Cart (${cart.items.length})`;
        }
  
        // Update the cart table
        const cartTableBody = document.querySelector('#cart-items');
        if (cartTableBody) {
          cartTableBody.innerHTML = '';
          let total = 0;
          cart.items.forEach(item => {
            const row = document.createElement('tr');
            row.dataset.product = item.productId;
            row.innerHTML = `
              <td>${item.productName}</td>
              <td>$${item.price}</td>
              <td>${item.quantity}</td>
              <td>$${(item.price * item.quantity).toFixed(2)}</td>
              <td><button class="btn btn-danger remove-from-cart" data-product-id="${item.productId}">Remove</button></td>
            `;
            total += item.price * item.quantity;
            cartTableBody.appendChild(row);
          });
          document.querySelector('#cart-total').textContent = `Total: $${total.toFixed(2)}`;
        }
      }
    };
    xhr.send();
  }

  document.addEventListener('click', function (event) {
    if (event.target.matches('.add-to-cart')) {
      const productId = event.target.dataset.productId;
      const productName = event.target.dataset.productName;
      const price = event.target.dataset.price;
  
      event.target.removeAttribute('data-product-id');
      event.target.removeAttribute('data-product-name');
      event.target.removeAttribute('data-price');
      event.target.classList.remove('add-to-cart');
      event.target.classList.add('added-to-cart');
  
      addToCart(productId, productName, price);
    }
  });
  
  document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
      button.addEventListener('click', () => {
        const productId = button.dataset.productId;
        const productName = button.dataset.productName;
        const price = button.dataset.price;
        addToCart(productId, productName, price);
      });
    });
  
    fetchCart();
  
    document.body.addEventListener('click', (event) => {
      if (event.target.matches('.remove-from-cart')) {
        const productId = event.target.dataset.productId;
        removeFromCart(productId);
      }
    });
  });
  
  function removeFromCart(productId) {
    const xhr = new XMLHttpRequest();
  
    xhr.open("POST", "removeFromCart.php", true);
  
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`productId=${productId}`);
  
    // Update the UI by removing the row from the cart table
    const cartItem = document.querySelector(`tr[data-product="${productId}"]`);
    if (cartItem) {
      cartItem.remove();
    }
  
    // Update the total
    const cartTotal = document.getElementById("cart-total");
    const total = Array.from(document.querySelectorAll("tfoot th")).reduce(
      (acc, th) => acc + parseFloat(th.innerText.replace("$", "")),
      0
    );
    cartTotal.innerText = "Total: $" + total.toFixed(2);
  }