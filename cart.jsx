import React, { useState, useEffect } from 'react';

const Cart = () => {
  const [cart, setCart] = useState([]);

  useEffect(() => {
    const fetchCart = async () => {
      const response = await fetch('cart.json');
      const json = await response.json();
      setCart(json);
    };
    fetchCart();
  }, []);

  const addToCart = async (productName, price, quantity) => {
    const response = await fetch('addToCart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `action=add&productName=${productName}&price=${price}&quantity=${quantity}`
    });
    const json = await response.json();
    setCart(json);
  };

  return (
    <div>
      {cart.map(product => (
        <div>
          <p>{product.name} - {product.quantity} x $ {product.price} = $ {product.quantity * product.price}</p>
        </div>
      ))}
      <button onClick={() => addToCart('Bell Pepper', 120, 1)}>
        Add Bell Pepper
      </button>
    </div>
  );
};

export default Cart;