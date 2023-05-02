<?php 
// connect to mysql database
include("database.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Forum</title>
</head>
<body>
<a href="index.php"><button class="home-button">Home</button></a>
<a href="loogin.php"><button class="home-button">Login</button></a>


	<header>
		<h1>My Forum</h1>
		<nav>
			<ul>
				<li><button onclick="showEntrepriseSection()">Entreprise</button></li>
				<li><button onclick="showInfluenceurSection()">Influenceur</button></li>
			</ul>
		</nav>
	</header>
	<main>
  <section id="entreprise-section">
    <h2>Entreprise Forum</h2>
    <p>Welcome to the Entreprise Forum.here u can signup as entreprise .</p>
    <form action="submit.php" method="post" enctype="multipart/form-data">
        <!-- The name of the mark  -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br>

        <!-- The logo of the mark  -->
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo"><br>

        <!-- chifre d'affaire de la marque -->
        <label for="ca">Chiffre d'affaire en MAD:</label>
        <input type="number" id="ca" name="ca"><br>

        <!-- The email for the mark -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <div class="password-container">
            <input type="password" placeholder="Password..." id="password" name="password">
            <i class="fa-solid fa-eye" id="eye"></i>
        </div>
        <style>
          .password-container{
                width: 400px;
                position: relative;
              }
              .password-container input[type="password"],
              .password-container input[type="text"]{
                width: 100%;
                padding: 12px 36px 12px 12px;
                box-sizing: border-box;
              }
              .fa-eye{
                position: absolute;
                top: 28%;
                right: 4%;
                cursor: pointer;
                color: lightgray;
              }
        </style>
        <script>
          const passwordInput = document.querySelector("#password")
          const eye = document.querySelector("#eye")

          eye.addEventListener("click", function(){
              this.classList.toggle("fa-eye-slash")
              const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
              passwordInput.setAttribute("type", type)
            }
            )
        </script>

        <div class="password-repeat-container">
            <input type="password" placeholder="Repeat Password..." id="confirm_password" name="password_confirm">
            <i class="fa-solid fa-eye" id="eye2"></i>
        </div>
        <style>
          .password-repeat-container{
                width: 400px;
                position: relative;
              }
              .password-repeat-container input[type="password"],
              .password-repeat-container input[type="text"]{
                width: 100%;
                padding: 12px 36px 12px 12px;
                box-sizing: border-box;
              }
              .fa-eye{
                position: absolute;
                top: 28%;
                right: 4%;
                cursor: pointer;
                color: lightgray;
              }
        </style>
        <script>
          // script for the password repeat input field to show the password
          const passwordRepeatInput = document.querySelector("#confirm_password")
          const eye2 = document.querySelector("#eye2")
          eye2.addEventListener("click", function(){
              this.classList.toggle("fa-eye-slash")
              const type = passwordRepeatInput.getAttribute("type") === "password" ? "text" : "password"
              passwordRepeatInput.setAttribute("type", type)
            }
            )
        </script>




        <script>
          var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    password.style.borderColor = "red";
    confirm_password.style.borderColor = "red";
    
  } else {
    confirm_password.setCustomValidity('');
    password.style.borderColor = "green";
    confirm_password.style.borderColor = "green";

  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
        </script>

        <!-- Submit the form  -->
        <input type="submit" value="Submit Post">
    </form>
</section>

			<div class="posts">
				<!-- Display posts from database using PHP -->
			</div>
		</section>
		<section id="influenceur-section" style="display:none">
			<h2>Influenceur</h2>
      <p>Welcome to the influenceur Forum ,here u can signup as a influenceur</p>
			<form action="submitinf.php" method="post" enctype="multipart/form-data">
				<!-- ask for the name first name age ,and the social media account..... -->
        <label for="Lastname">Last Name:</label>
        <input type="text" id="Lastname" name="Lastname"><br>
        <label for="Firstname">First Name:</label>
        <input type="text" id="Firstname" name="Firstname"><br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <!-- passwords like the entreprise -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <div class="password-container">
            <input type="password" placeholder="Password..." id="password" name="password">
            <i class="fa-solid fa-eye" id="eye"></i>
        </div>
        <!-- the recheck password  -->
        <div class="password-repeat-container">
            <input type="password" placeholder="Repeat Password..." id="confirm_password" name="password_confirm">
            <i class="fa-solid fa-eye" id="eye2"></i>
        </div>
        <!-- script to check if the two password match -->
        <script>
          var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
    password.style.borderColor = "red";
    confirm_password.style.borderColor = "red";
  } else {
    confirm_password.setCustomValidity('');
    password.style.borderColor = "green";
    confirm_password.style.borderColor = "green";
  }
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
        </script>
        <!-- Submit the form  -->
        <input type="submit" value="Submit Post">
			</form>
			<div class="posts">
				<!-- Display posts from database using PHP -->
			</div>
		</section>
	</main>
	<footer>
		<p>&copy; 2023 My Forum</p>
	</footer>
	<script>
		function showEntrepriseSection() {
			document.getElementById("entreprise-section").style.display = "block";
			document.getElementById("influenceur-section").style.display = "none";
		}

		function showInfluenceurSection() {
			document.getElementById("entreprise-section").style.display = "none";
			document.getElementById("influenceur-section").style.display = "block";
		}
	</script>
</body>
</html>

<style>
	/* Global styles */
* {
  box-sizing: border-box;
  font-family: 'Helvetica Neue', sans-serif;
  margin: 0;
  padding: 0;
}

body {
  background-color: #f2f2f2;
}

header {
  background-color: #333;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
}

nav li {
  margin-left: 20px;
}

nav button {
  background-color: #fff;
  color: #333;
  border: none;
  padding: 10px 20px;
  border-radius: 20px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

nav button:hover {
  background-color: #e6e6e6;
}

main {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 50px;
}

section {
  background-color: #fff;
  border-radius: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  padding: 50px;
  margin: 20px;
  width: 100%;
  max-width: 800px;
  display: none;
}

section h2 {
  font-size: 36px;
  margin-bottom: 20px;
}

section p {
  font-size: 18px;
  margin-bottom: 40px;
}

section form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

section label {
  font-size: 18px;
  margin-bottom: 10px;
  font-weight: bold;
}

section input,
section textarea {
  padding: 10px;
  border-radius: 10px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
  width: 100%;
  max-width: 400px;
}

section input[type="submit"],
section button[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 20px;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

section input[type="submit"]:hover,
section button[type="submit"]:hover {
  background-color: #666;
}

section .posts {
  margin-top: 40px;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

/* Media queries */
@media only screen and (max-width: 600px) {
  section {
    padding: 30px;
  }

  section h2 {
    font-size: 24px;
    margin-bottom: 10px;
  }

  section p {
    font-size: 16px;
    margin-bottom: 30px;
  }

  section input,
  section textarea {
    max-width: 300px;
  }
}
.home-button {
  background-color: #0077cc;
  border: none;
  color: #ffffff;
  font-size: 16px;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 20px 0;
  border-radius: 4px;
}

.home-button:hover {
  background-color: #005fa3;
  cursor: pointer;
}



</style>