function changeQty(amount) {
  let qtySpan = document.getElementById("qty");
  let inputQty = document.getElementById("input-qty");

  let currentQty = parseInt(qtySpan.innerText);
  currentQty += amount;

  if (currentQty < 1) currentQty = 1; // không cho số âm

  qtySpan.innerText = currentQty;
  inputQty.value = currentQty; // cập nhật hidden input
}

function changeCartQty(cartKey, change) {
  let qtyInput = document.getElementById("input-qty-" + cartKey);
  let display = document.getElementById("qty-display-" + cartKey);

  let newQty = parseInt(qtyInput.value) + change;
  if (newQty < 1) newQty = 1;

  // Cập nhật giao diện
  qtyInput.value = newQty;
  display.innerText = newQty;

  // Gửi cập nhật lên server
  fetch("index.php?action=cart_update", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "cart_key=" + cartKey + "&quantity=" + newQty,
  })
    .then((res) => res.text())
    .then((data) => {
      console.log("Server updated:", data);
      // Reload để cập nhật tổng tiền
      location.reload();
    });
}
