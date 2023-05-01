<!-- we create the login page  -->
<!-- we have two type of user entreprise and influenceur each have a forumm to login in  -->
<!-- we have a link to the signup page  -->
<!-- Login page HTML code here -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <link rel="stylesheet" href="./css/loogin.css">
    <!-- link for icons from "font Awesome" website -->
    <script src="https://kit.fontawesome.com/8b4b4337c0.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">

<div class="error">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                </div> <br>
  
        <div class="choice">
		<p> Je suis :</p>
        <button onclick="showEntrepriseSection()">Entreprise</button>
		<button onclick="showInfluenceurSection()">Influenceur</button>		   

        </div>
<section id="entreprise" style="display: block;">
        <div class="forme">
            <h1> Entreprise</h1>
            <form action="longinentre.php" method="POST">
                <div class="input-group">
                    <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password"  name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="btn-field">
                <button type="submit" name="login">Login</button>
                </div>
                <div class="signuplink">
                <p>Don't have account ? <a href="signup.php"> Sign Up</a></p>
                </div>
            </form>
        </div>
</section>
<section id="influenceur">
        <div class="forme">
            <h1>Influenceur</h1>
            <form action="logininf.php" method="POST">
                <div class="input-group">
                    <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email"name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password"  name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="btn-field">
                <button type="submit" name="login">Login</button>
                </div>
                <div class="signuplink">
                <p>Don't have account ? <a href="signup.php"> Sign Up</a></p>
                </div>
            </form>
        </div>
</section>

<!-- script to show the forum  -->
<script>
    //make the entreprise section visible by default and the influenceur section hidden ,on click on the influenceur button the influenceur section will be visible and the entreprise section hidden and the button will be disabled
    document.getElementById("influenceur").style.display = "none";
    function showEntrepriseSection() {
        document.getElementById("influenceur").style.display = "none";
        document.getElementById("entreprise").style.display = "block";
        document.getElementById("influenceurButton").disabled = false;
        document.getElementById("entrepriseButton").disabled = true;
    }
    function showInfluenceurSection() {
        document.getElementById("influenceur").style.display = "block";
        document.getElementById("entreprise").style.display = "none";
        document.getElementById("influenceurButton").disabled = true;
        document.getElementById("entrepriseButton").disabled = false;
    }	
	</script>
 </div>
</body>
</html>
