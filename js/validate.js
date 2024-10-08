function validateEmail(email) {
  var regex = /^[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;

  if (email.match(regex)) {
    return true;
  } else {
    alert("Email is not in proper format.");
    return false;
  }
}

function validatePassword(password) {
  if (password.length < 8) {
    alert("Password must be 8 characters or more");
    return false;
  }
  return true;
}

function validateForm() {
  var email = $("#email").val();
  var password = $("#password").val();

  return validateEmail(email) && validatePassword(password);
}
