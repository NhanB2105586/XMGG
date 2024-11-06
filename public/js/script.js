document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.getElementById("quantityInput");
  const decrementButton = document.getElementById("button-decrement");
  const incrementButton = document.getElementById("button-increment");

  decrementButton.addEventListener("click", () => {
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
      quantity=quantity-1;
      quantityInput.value = quantity;
    }
  });

  incrementButton.addEventListener("click", () => {
    let quantity = parseInt(quantityInput.value);
    quantity=quantity+1;
    quantityInput.value = quantity;
  });
});
