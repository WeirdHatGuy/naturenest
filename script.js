const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

loginBtn.addEventListener('click', function() {
  // Find the closest form and submit it
  this.closest('form').submit();
});

registerBtn.addEventListener('click', function() {
  // Find the closest form and submit it
  this.closest('form').submit();
});