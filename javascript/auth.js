const connectForm = document.getElementById("formSignUp");

connectForm.addEventListener("submit", (e) => {
  //on empeche la page de submit le formulaire directement
  //e.preventDefault();

  let pwd = document.getElementById("pwd");
  let cpwd = document.getElementById("cpwd");
  let pwdError = document.getElementById("pwdError");
  if(pwd.value != cpwd.value)
  {
      e.preventDefault();
      console.log("erreur : "  + pwd.value + cpwd.value)
      pwdError.style = "Display: flex";
      return;
  }
  else
  {
      pwdError.style = "Display: none";
      let sbc = document.getElementById("sbc");
      connectForm.requestSubmit(sbc);
  }
});

function show_PasswordI() {
    var pwd = document.getElementById("pwd");
    var cpwd = document.getElementById("cpwd");
    if (pwd.type === "password") {
      pwd.type = "text";
      cpwd.type = "text";
    } else {
      pwd.type = "password";
      cpwd.type = "password";
    }
}

function show_PasswordC() {
  var pwd = document.getElementById("mdp");
  if (pwd.type === "password") {
    pwd.type = "text";
  } else {
    pwd.type = "password";
  }
}