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
    
        <!-- page de css -->

    <link rel="stylesheet" href="./css/loogin.css">

        <!--pour utiliser les icon de fontawsome en ligne -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- link for icons from "font Awesome" website -->
    <script src="https://kit.fontawesome.com/8b4b4337c0.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <!-- influenceur ou entreprise -->
  
        <div class="choice">
		<p> Je suis :</p>
        <!-- si on clique montrer la section de l'entreprise-->
        <button onclick="showEntrepriseSection()">Entreprise</button>
         <!-- si on clique montrer la section de l'influenceur-->
		<button onclick="showInfluenceurSection()">Influenceur</button>		   
        </div>
<br>
<br>
<!--si je suis entreprise -->
<section id="entreprise" style="display: block;">
        <div class="forme">
            <h1> Entreprise</h1>
            <!-- montrer les erreurs ici-->
            <div id="error" >
                <?php if (isset($_GET['error'])) {?>
                     <!-- ecrire l'erreur dans la balise p -->
                    <p><?php echo $_GET['error']; ?></p>
                    <script>
                    /*changer display:none à display:flex */
                    document.getElementById("error").style.display = "flex";
                    </script>
                <?php } ?>
            </div>
            <!-- les info seront envoyé à la page loginentre.php par POST-->
            <form action="loginentre.php" method="POST">
                <div class="input-group">
                    <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input id="pw1" type="password"  name="password" placeholder="Password" required>
                    <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->
                    <i class="fas fa-eye" id="eye1" onclick="showpw('#pw1' , '#eye1')"></i>

                    </div>
                </div>
                <div class="btn-field">
                <button type="submit" name="login">Login</button>
                </div>
                <div class="signuplink">
                <p>Vous n'avez pas encore de compte ? <a href="signup.php"> Cr&eacuteez-en un</a></p>
                </div>
            </form>
        </div>
</section>
<!--si je suis influenceur -->
<section id="influenceur">
        <div class="forme">
            <h1>Influenceur</h1>
            <div id="error" >
                <?php if (isset($_GET['error'])) {?>
                    <!-- ecrire l'erreur dans la balise p -->

                    <p><?php echo $_GET['error']; ?></p>
                    <!-- changer display:none à display:flex -->
                    <script>document.getElementById("error").style.display = "flex";</script>
                <?php } ?>
            </div>

             <!-- les info seront envoyé à la page logininf.php par POST-->
            <form action="logininf.php" method="POST">
                <div class="input-group">
                    <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email"name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input id="pw2" type="password"  name="password" placeholder="Password" required>
                    <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->
                     <i class="fas fa-eye" id="eye2" onclick="showpw('#pw2' , '#eye2')"></i>
                    </div>
                </div>
                <div class="btn-field">
                <button type="submit" name="login">Login</button>
                </div>
                <div class="signuplink">
                <p>Vous n'avez pas encore de compte ? <a href="signup.php"> Cr&eacuteez-en un</a></p>
                </div>
            </form>
        </div>
</section>
<!-- script pour montrer la section entreprise ou influenceur  -->
<script>
    /*la section entreprise est visible par defaut et la section de l'influenceur est cachée ,on clique sur le bouton influenceur et la section de l'influenceur va apparaitre et la section de l'entreprise sera caché */

    /*l'element dont l'id est influenceur va etre invisible par defaut*/
    document.getElementById("influenceur").style.display = "none";


    function showEntrepriseSection() {
        /*l'element dont l'id est influenceur va etre invisible */
        document.getElementById("influenceur").style.display = "none";
         /*l'element dont l'id est entreprise va etre visible */
        document.getElementById("entreprise").style.display = "block";
        /*disable the button */
        document.getElementById("influenceurButton").disabled = false;

        /*enable the button */

        document.getElementById("entrepriseButton").disabled = true;
    }
    function showInfluenceurSection() {
         /*l'element dont l'id est influenceur va etre visible */
        document.getElementById("influenceur").style.display = "block";
         /*l'element dont l'id est entreprise va etre invisible */
        document.getElementById("entreprise").style.display = "none";

             /*enable the button */

        document.getElementById("influenceurButton").disabled = true;

        /*disable the button */

        document.getElementById("entrepriseButton").disabled = false;
    }	
	</script>
 </div>
   <script>
/*de password a text et vice versa */

function showpw(id , id2) {
// selectionner le input dont l'id est id    
    let pwfield = document.querySelector(id);
// selectionner l icon don't l id est id2
    let eyefield= document.querySelector(id2);
//si le type de l input est password
        // change le à text
	if (pwfield.type == "password") {
		pwfield.type = "text";

                // changer le nom de la classe de id2

        eyefield.className = "fas fa-eye-slash";
	} else {

        //si le type de l input est text
        // change le à password

		pwfield.type = "password";
                        // changer le nom de la classe de id2

        eyefield.className = "fas fa-eye";
	}
};

       </script>

</body>
</html>
