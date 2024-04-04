const updateCart = (cart, productName, price, quantity, operation) => {
    if (operation === 'add') {
      const productIndex = cart.findIndex((product) => product.name === productName);
      if (productIndex !== -1) {
        cart[productIndex].quantity += quantity;
      } else {
        cart.push({ name: productName, price, quantity });
      }
    } else {
      cart = cart.filter((product) => product.name !== productName);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateMiniCart();
  };
  
  const updateMiniCart = () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartHtml = cart.reduce((html, product) => {
      return html += `<div>${product.name} - ${product.quantity} x $${product.price} = $${product.quantity * product.price}</div>`;
    }, '');
  
    document.getElementById('mini-cart-preview').innerHTML = cartHtml;
  };
  
  const loadCart = () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    updateMiniCart();
    return cart;
  };
  
  export { updateCart, loadCart };