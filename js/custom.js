import {
  scanWishlist,
  wishlist,
  removeFromWishlist,
  processMessage,
  updateLocalStorage,
  renderWishlistNumber,
  checkBookinWishlist,
  renderWishlist,
} from "../modules/wishlist.js";

let currentpagePathname = window.location.pathname;
console.log(currentpagePathname);

if (
  currentpagePathname ==
  "/my-projects/final-year-project/unityBookshop/wishlist"
) {
  // Displaying wishlists on wishlist.php page
  renderWishlist(wishlist);
}

renderWishlistNumber();

let addToWishlistButton = document.querySelectorAll(".js-add-to-wishlist");

addToWishlistButton.forEach((button) => {
  checkBookinWishlist(button);
  button.addEventListener("click", () => {
    let bookId = button.dataset["addToWishlistId"];
    let title = button.dataset["addToWishlistTitle"];
    let author = button.dataset["addToWishlistAuthor"];
    let image = button.dataset["addToWishlistImage"];
    let price = button.dataset["addToWishlistPrice"];
    let discountedPrice = price - 350;

    let addToWishlistButtonIcon = document.querySelector(`.js-icon-${bookId}`);

    let wishlistItem = {
      bookId: bookId,
      title: `${title}`,
      author: `${author}`,
      image: `${image}`,
      price: price,
      discountedPrice: discountedPrice,
    };

    let isWishlistExist = scanWishlist(bookId);
    if (!isWishlistExist) {
      wishlist.push(wishlistItem);
      processMessage(button, addToWishlistButtonIcon);
      updateLocalStorage("wishlist", wishlist);
      renderWishlistNumber();
    } else {
      removeFromWishlist(bookId);
      processMessage(button, addToWishlistButtonIcon);
      updateLocalStorage("wishlist", wishlist);
      renderWishlistNumber();
    }
  });
});
