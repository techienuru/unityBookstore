const minusButtons = document.querySelectorAll(".js-minus-quantity");
const plusButtons = document.querySelectorAll(".js-plus-quantity");
const updateCartLinks = document.querySelectorAll(".js-update-quantity");
const removeFromCartLinks = document.querySelectorAll(".js-remove");

// Adding 'Quantity' value when "-" button is clicked & Updating total
minusButtons.forEach((minusButton) => {
  minusButton.addEventListener("click", () => {
    cartId = minusButton.dataset["cartId"];
    const quantityInputBox = document.querySelector(
      `.js-quantity-value-${cartId}`
    );
    quantityValue = parseInt(quantityInputBox.value);
    if (quantityValue >= 0) {
      quantityValue--;
      quantityInputBox.value = quantityValue;
    }
    changeTotalValue();
  });
});

// Adding 'Quantity' value when "+" button is clicked & Updating total
plusButtons.forEach((plusButton) => {
  plusButton.addEventListener("click", () => {
    cartId = plusButton.dataset["cartId"];
    const quantityInputBox = document.querySelector(
      `.js-quantity-value-${cartId}`
    );
    quantityValue = parseInt(quantityInputBox.value);
    quantityValue++;
    quantityInputBox.value = quantityValue;
    changeTotalValue();
  });
});

function changeTotalValue() {
  let priceValue = document.querySelector(
    `.js-price-value-${cartId}`
  ).innerHTML;
  const totalValue = document.querySelector(`.js-total-value-${cartId}`);
  priceValue = priceValue.substring(1);
  priceValue = parseInt(priceValue);

  totalValue.innerHTML = `$${priceValue * quantityValue}`;
}

// Updating Cart Item when ✅ is clicked
updateCartLinks.forEach((updateCartLink) => {
  updateCartLink.addEventListener("click", () => {
    const cartId = updateCartLink.dataset["cartId"];
    const quantity = parseInt(
      document.querySelector(`.js-quantity-value-${cartId}`).value
    );
    const total = parseInt(
      document.querySelector(`.js-total-value-${cartId}`).innerHTML.substring(1)
    );
    updateCartLink.href = `./update-cart?cart_id=${cartId}&quantity=${quantity}&total=${total}`;
  });
});

// Removing Cart Item when is ❌ clicked
removeFromCartLinks.forEach((removeFromCartLink) => {
  removeFromCartLink.addEventListener("click", () => {
    const cartId = removeFromCartLink.dataset["cartId"];
    if (confirm("This action is irreversible!")) {
      removeFromCartLink.href = `./delete-from-cart?cart_id=${cartId}`;
    }
  });
});

// Proceeding User to book-for-pickup.php when "Book For Pickup" button is clicked
// let bookForPickupButton = document.querySelector(".js-book-for-pickup");

// bookForPickupButton.addEventListener("click", () => {
//   const bookForPickupButtonsLink = bookForPickupButton.href;
//   bookForPickupButton.removeAttribute("href");
//   if (
//     confirm(
//       "You are about to book all the books in your cart for pickup.\n\n" +
//         "Remember that you will need to visit the bookstore to pick up your items.\n\n" +
//         "Do you wish to proceed?"
//     )
//   ) {
//     bookForPickupButton.href = bookForPickupButtonsLink;
//   }
// });
