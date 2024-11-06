//Tăng giảm số lượng sản phẩm
const quantityInput = document.getElementById("quantityInput");
const decrementButton = document.getElementById("button-decrement");
const incrementButton = document.getElementById("button-increment");
decrementButton.addEventListener("click", () => {
  let quantity = parseInt(quantityInput.value);
  if (quantity > 1) {
    quantity--;
    quantityInput.value = quantity;
  }
});
incrementButton.addEventListener("click", () => {
  let quantity = parseInt(quantityInput.value);
  quantity++;
  quantityInput.value = quantity;
});

document.addEventListener("click", function (event) {
  if (event.target.classList.contains("btn-detail-product")) {
    const detailLink = document.querySelector(".detailLink");
    const detailUrl = "/chitietsanpham.php";
    detailLink.href = detailUrl;
    detailLink.click();
  }
});


