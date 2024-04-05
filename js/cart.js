const button = document.querySelectorAll('.add-to-cart-button');
button.forEach(button => button.addEventListener('click', function() {
  const productId = button.dataset.productId;
  const quantity = 1;
  addToCart(productId, quantity);
}));

const cart = [];
const cartItemsEl = document.getElementById('cart-items');
const totalPriceEl = document.getElementById('total-price');

function addToCart(productId, quantity) {
  const productIndex = cart.findIndex(item => item.productId === productId);
  if (productIndex === -1) {
    // If the product is not already in the cart, add it
    cart.push({ productId, quantity });
  } else {
    // If the product is already in the cart, update the quantity
    cart[productIndex].quantity += quantity;
  }
  // Calculate the total price
  let totalPrice = 0;
  cart.forEach(item => {
    const product = products.find(p => p.id === item.productId);
    totalPrice += product.price * item.quantity;
  });
  totalPriceEl.textContent = `$${totalPrice.toFixed(2)}`;
  // Display the updated cart
  displayCart();
}

function displayCart() {
  cartItemsEl.innerHTML = '';
  cart.forEach(item => {
    const product = products.find(p => p.id === item.productId);
    const cartItemHtml = `
      <tr data-cart-item-id="${item.id}">
        <td>
          <img src="${product.image}" alt="${product.name}" width="100">
          ${product.name}
        </td>
        <td>$${product.price.toFixed(2)}</td>
        <td>${item.quantity}</td>
        <td>$${(product.price * item.quantity).toFixed(2)}</td>
      </tr>
    `;
    cartItemsEl.innerHTML += cartItemHtml;
  });
}

// Add event listeners to each "Add to Cart" button
const buttons = document.querySelectorAll('.add-to-cart-button');
buttons.forEach(button => button.addEventListener('click', function() {
  const productId = button.dataset.productId;
  const quantity = 1;
  addToCart(productId, quantity);
}));

// Load theproducts from the server
fetch('products.json')
  .then(response => response.json())
  .then(data => {
    products = data;
    displayCart();
  });