let formElement = document.querySelector(".js-form");
// passwordInputBox.addEventListener("mouseleave", () => {
//     console.log('Wrong');
// });

formElement.addEventListener("submit", (event) => {
  let isValid = true;

  //   Validating First Name
  const firstnameInputBoxValue = document.querySelector(
    ".js-firstname > input"
  ).value;
  const firstnameError = document.querySelector(".js-firstname > small");

  if (!/^[a-zA-Z]+$/.test(firstnameInputBoxValue)) {
    firstnameError.innerText = "Only alphabets please!";
    isValid = false;
  } else {
    firstnameError.innerText = "";
  }

  //   Validating Last Name
  const lastnameInputBoxValue = document.querySelector(
    ".js-lastname > input"
  ).value;
  const lastnameError = document.querySelector(".js-lastname > small");

  if (!/^[a-zA-Z]+$/.test(lastnameInputBoxValue)) {
    lastnameError.innerText = "Only alphabets please!";
    isValid = false;
  } else {
    lastnameError.innerText = "";
  }

  //   Validating Username
  const usernameInputBoxValue = document.querySelector(
    ".js-username > input"
  ).value;
  const usernameError = document.querySelector(".js-username > small");

  if (!/^[a-zA-Z0-9-_+=]+$/.test(usernameInputBoxValue)) {
    usernameError.innerText = "Only alphabets & numbers please!";
    isValid = false;
  } else {
    usernameError.innerText = "";
  }

  //   Validating Email Address
  const emailInputBoxValue = document.querySelector(".js-email > input").value;
  const emailError = document.querySelector(".js-email > small");
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(emailInputBoxValue)) {
    emailError.innerText = "Invalid email format!";
    isValid = false;
  } else {
    emailError.innerText = "";
  }

  //   Checking is Password & Confirm Password are the same
  const passwordInputBoxValue = document.querySelector(
    ".js-password > input"
  ).value;
  const passwordError = document.querySelector(".js-password > small");

  const cpasswordInputBoxValue = document.querySelector(
    ".js-cpassword > input"
  ).value;
  const cpasswordError = document.querySelector(".js-cpassword > small");

  if (passwordInputBoxValue !== cpasswordInputBoxValue) {
    passwordError.innerText = "Password mismatch!";
    cpasswordError.innerText = "Password mismatch!";
    isValid = false;
  } else {
    passwordError.innerText = "";
    cpasswordError.innerText = "";
  }

  if (!isValid) {
    event.preventDefault();
  }
});
