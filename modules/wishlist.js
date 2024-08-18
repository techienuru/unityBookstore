export let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

// Checks if book is already in Wishlist
export function checkBookinWishlist(button) {
  let bookId = button.dataset["addToWishlistId"];
  let addToWishlistButtonIcon = document.querySelector(`.js-icon-${bookId}`);
  let isWishlistExist = scanWishlist(bookId);
  if (isWishlistExist) {
    addToWishlistButtonIcon.style.color = "red";
    button.classList.add("wishlist-added");
  }
}
let isAddedTimeoutRunning;
function showSuccessMessage() {
  let successMessageWrapper = document.querySelector(".js-success-message");
  successMessageWrapper.innerHTML =
    '<p class="text-white bg-success p-3">✅Added to wishlist</p>';
  if (!isAddedTimeoutRunning && isRemovedTimeoutRunning) {
    isAddedTimeoutRunning = setTimeout(() => {
      successMessageWrapper.innerHTML = "";
    }, 1000);
  } else {
    clearTimeout(isAddedTimeoutRunning);
    clearTimeout(isRemovedTimeoutRunning);
    isAddedTimeoutRunning = setTimeout(() => {
      successMessageWrapper.innerHTML = "";
    }, 1000);
  }
}

let isRemovedTimeoutRunning;
function showRemoveMessage() {
  let successMessageWrapper = document.querySelector(".js-success-message");
  successMessageWrapper.innerHTML =
    '<p class="text-white bg-danger p-3">❌Removed from wishlist</p>';
  if (!isRemovedTimeoutRunning && !isAddedTimeoutRunning) {
    isRemovedTimeoutRunning = setTimeout(() => {
      successMessageWrapper.innerHTML = "";
    }, 1000);
  } else {
    clearTimeout(isRemovedTimeoutRunning);
    clearTimeout(isAddedTimeoutRunning);
    isRemovedTimeoutRunning = setTimeout(() => {
      successMessageWrapper.innerHTML = "";
    }, 1000);
  }
}

export function scanWishlist(bookId) {
  let wishlistValue = false;
  wishlist.forEach((value) => {
    if (value.bookId == bookId) {
      wishlistValue = value.bookId;
    }
  });
  return wishlistValue;
}

export function removeFromWishlist(bookId) {
  wishlist.forEach((value, index) => {
    if (value.bookId == bookId) {
      wishlist.splice(index, 1);
    }
  });
}

export function processMessage(button, addToWishlistButtonIcon) {
  if (!button.classList.contains("wishlist-added")) {
    addToWishlistButtonIcon.style.color = "red";
    showSuccessMessage();
    button.classList.add("wishlist-added");
  } else {
    addToWishlistButtonIcon.style.color = "";
    showRemoveMessage();
    button.classList.remove("wishlist-added");
  }
}

export function updateLocalStorage(key, value) {
  localStorage.setItem(key, JSON.stringify(value));
}
export function renderWishlistNumber() {
  let wishlistContent = document.querySelector(".js-wishlist-content");
  let totalWishlist = 0;
  wishlist.forEach(() => {
    totalWishlist++;
  });
  wishlistContent.innerHTML = totalWishlist;
}

export function renderWishlist(wishlist) {
  let wishlists = "";
  wishlist.forEach((value) => {
    const bookId = value.bookId;
    const title = value.title;
    const author = value.author;
    const image = value.image;
    const price = value.price;
    const discountedPrice = price - 350;
    wishlists += `<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" style="height: 300px;">
                                <img class="w-100 h-100 img-fluid" src="admin/pages/${image}" alt="" style="object-fit: cover;">
                                <div class="product-action">
                                    <button class="btn btn-outline-dark btn-square js-add-to-wishlist"  title="Add to wishlist" data-add-to-wishlist-id="${bookId}" data-add-to-wishlist-title="${title}" data-add-to-wishlist-author="${author}" data-add-to-wishlist-image="${image}" data-add-to-wishlist-price="${price}">
                                        <i class="far fa-heart js-icon-${bookId}"></i>
                                    </button>
                                    <a class="btn btn-outline-dark btn-square" href="./wishlist?add_to_cart=${bookId}"> 
                                        <i class="fa fa-shopping-cart" title="Add to cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center py-4" style="height: 150px;">
                                <a class="h6 text-decoration-none text-wrap" href="./books?books_id=${bookId}">${title}</a>
                                <br>
                                <small class="badge badge-primary">By ${author}</small>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$${discountedPrice}</h5>
                                    <h6 class="text-muted ml-2"><del>$${price}</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>`;
  });
  document.querySelector(".js-wishlists").innerHTML = wishlists;
}
