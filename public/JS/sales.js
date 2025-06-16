/* =============================== */
/* File: public/js/sales.js         */
/* =============================== */
document.addEventListener('DOMContentLoaded', () => {
  const orderButtons = document.querySelectorAll('.order-btn');
  const modal = document.querySelector('.modal');
  const toast = document.getElementById('toast');
  const confirmBtn = document.getElementById('confirmOrder');
  const cancelBtn = document.getElementById('cancelOrder');

  let selectedQty = 0;
  let selectedProduct = '';

  orderButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.card');
      const qtyInput = card.querySelector('.qty-input');
      const stock = parseInt(card.querySelector('.stock').textContent);
      const product = card.querySelector('h2').textContent;

      const qty = parseInt(qtyInput.value);
      if (!qty || qty <= 0) {
        alert('Please enter a valid quantity.');
        return;
      }

      if (qty > stock) {
        alert('Not enough stock available.');
        return;
      }

      selectedQty = qty;
      selectedProduct = product;
      modal.classList.remove('hidden');
    });
  });

  confirmBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    showToast(`${selectedQty} x ${selectedProduct} ordered!`);
    // TODO: AJAX to backend or form submission
  });

  cancelBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  function showToast(message) {
    toast.textContent = message;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
  }
});
