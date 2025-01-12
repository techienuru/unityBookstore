# Bookstore Management System

The **Bookstore Management System** is an online platform designed to manage an online bookstore effectively. The application enables guests to browse, reserve, and purchase books effortlessly, while offering the admin comprehensive tools to manage inventory, monitor sales, and handle user data.

---

## Key Features

### For Guests:

- **No Account Required:** Guests can browse, add books to their wishlist or cart, and make purchases without creating an account.
- **Unique User Tracking:** The system generates a unique ID for each guest, valid for 6 months, to track their activity across sessions.
- **Flexible Purchase Options:**
  - **Online Purchase:** Guests can pay online via Paystack and download soft copies of books immediately.
  - **Book for Pickup:** Guests can reserve books online for collection at the physical store.
- **Wishlist & Cart:** Guests can save books for later or prepare for checkout with an intuitive wishlist and cart system.

### For Admins:

- **Book Management:** Add, update, or delete books in the catalog.
- **Category Management:** Organize books into manageable categories.
- **Transaction Tracking:** View all completed transactions and track books sold.
- **Pickup Management:** Monitor and manage books reserved for physical pickup.
- **File Uploads:** Upload soft copies of books for online purchase.

---

## What Sets It Apart

- **Guest-Centric Design:** No account creation needed, reducing barriers to purchase.
- **Secure Online Payments:** Paystack API integration ensures smooth and secure payment processing.

---

### Security and Validation

- Input validation: All fields are sanitized using JS to prevent invalid or malicious input.

---

## Technologies Used

### Front-End:

- **HTML5**
- **CSS3**
- **Bootstrap**
- **JavaScript**

### Back-End:

- **PHP**
- **MySQL**
- **Paystack API**
- **XAMPP**

---

## Admin Login Details

- **Email/Username:** `jb@gmail.com` or `jb`
- **Password:** `1`

---

## Guest Information

- Guests do not require login credentials.
- A unique ID (valid for 6 months) is created for each guest, stored locally on their device.
- Wishlist and cart data are accessible only on the device where the unique ID was created.

---

## How to Use

### For Guests:

1. Browse the catalog to find books of interest.
2. Add books to your wishlist or cart.
3. Choose to:
   - Pay online and download soft copies.
   - Reserve books for physical pickup.

### For Admins:

1. Log in to the dashboard using admin credentials.
2. Add, update, or delete books and categories.
3. Track transactions and manage reservations for pickup.

---

## Future Enhancements

- Add user reviews and ratings for books.
- Implement multi-language support for a global audience.
- Introduce discount codes and bulk purchase discounts.

---

## Contributing

Contributions are welcome! Fork the repository, make your changes, and submit a pull request.

---

## Acknowledgments

- **Paystack:** For secure and reliable payment integration.
- **ThemeWagon:** For responsive and customizable design templates.
