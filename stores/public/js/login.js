function showRegister() {
  document.getElementById("login-box").style.display = "none";
  document.getElementById("register-box").style.display = "block";
}
function showLogin() {
  document.getElementById("register-box").style.display = "none";
  document.getElementById("login-box").style.display = "block";
}

function register() {
  const name = document.getElementById("reg-name").value;
  const email = document.getElementById("reg-email").value;
  const password = document.getElementById("reg-password").value;

  if (!name || !email || !password) {
    alert("Vui lòng nhập đầy đủ thông tin!");
    return;
  }

  localStorage.setItem("user", JSON.stringify({ name, email, password }));
  alert("Đăng ký thành công!");
  showLogin();
}

function login() {
  const email = document.getElementById("login-email").value;
  const password = document.getElementById("login-password").value;
  const user = JSON.parse(localStorage.getItem("user"));

  if (!user) {
    alert("Không tìm thấy tài khoản, vui lòng đăng ký!");
    return;
  }

  if (email === user.email && password === user.password) {
    alert("Đăng nhập thành công!");
  } else {
    alert("Email hoặc mật khẩu không đúng!");
  }
}
