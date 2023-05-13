<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--pour utiliser les icon de fontawsome en ligne -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Sign Up</title>
    <!-- page de css -->
    <link rel="stylesheet" href="./css/s.css">

</head>
<body>
<!-- influenceur -->

    <section id="influenceur">
    <div class="container">
        <header>Bienvenue !</header>
         <!-- les info seront envoyé à la page submitinf.php par POST-->
        <form  action="submitinf.php" method="post" enctype="multipart/form-data">
                <div class="details personnel">
                    <span class="titre">Information Personnel</span>
                        <!-- ERROR HANDLING  -->

                    <div class="erreur-msg" id="inf">
                <!-- ecrire l'erreur s'il y a un erreur -->

                        <?php
                        if(isset($_GET['error'])){
                            
                            echo $_GET['error'];

                              ?>
            <!-- changer display:none à display:flex -->      
                            <script>
                                document.getElementById("inf").style.display = "flex";
                            </script>
                            <?php

                        }

                        ?>
                        
                </div>
                    <!-- information personnel de l'influenceur -->
                    <div class="boxs">
                        <div class="input-boxss">
                        <label >Nom</label>
                        <input type="text" name="nom" placeholder="Entrez votre nom" required>
                        </div>

                        <div class="input-boxss">
                        <label >Prénom</label>
                        <input type="text" name="prenom" placeholder="Entrez votre prénom" required>
                        </div>

                        <div class="input-boxss">
                        <label >Age</label>
                        <input type="text" name="age" placeholder="Entrez votre Age" required>
                        </div>

                        <div class="input-boxss">
                        <label >Téléphone</label>
                        <input type="phone" name="telephone" placeholder="Entrez votre numéro de téléphone" required>
                        </div>

                        <div class="input-boxss">
                        <label >Email</label>
                        <input type="email"  name="email"placeholder="Entrez votre email" required>
                        </div>
                        <div class="input-boxss">
                        <label >Profile</label>
                        <input type="file" name="logo" required>
                        </div>
                    </div>
                </div>
                        <!-- information sur les réseaux sociaux -->
                <div class="details personnel">
                    <span class="titre">Resaux Sociaux</span>

                    <div class="boxs">
                        <div class="input-boxss">
                        <label >Instagram</label>
                        <input type="text" name="insta" placeholder="Ex:https://www.instagram.com"required>
                        </div>

                        <div class="input-boxss">
                        <label >Facebook</label>
                        <input type="text" name="fcbk" placeholder="Ex:https://www.facebook.com" required>
                        </div>

                        <div class="input-boxss">
                        <label >Youtube</label>
                        <input type="text" name="ytb" placeholder="Ex:https://www.youtube.com" required>
                        </div>
            
                        <div class="input-boxss">
                        <!-- niche -->
                        <label >Domaine</label>
                        <select name="domaine" id="domaine">
                           <option value="Fashion">Fashion</option>
                           <option value="Sport">Sport</option>
                           <option value="Art">Art</option>
                           <option value="Cuisine">Cuisine</option>
                           <option value="autre">Autre</option>
                        </select>
                        </div>

                        <!-- informations sur les abonnées-->
                        <div class="input-boxss">
                        <label >Abonnées</label> 
                        <select name="follower" id="follower">
                            <option value="30k-60k">30k-60k Abonné</option>
                            <option value="60k-90k">60k-90k Abonné</option>
                            <option value="90k-150k">90k-150k Abonné</option>
                            <option value="+150k">+150k Abonné</option>
                        </select>
                        </div> 

                        <!-- mot de passe et confirmation -->
                        <div class="input-boxss">
                        <label >Mot de passe</label>
                        <input id="pw1" type="password" name="password" placeholder=" mot de passe" required>
          <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->
                         <i class="fas fa-eye eye" id="eye1" onclick="showpw('#pw1' , '#eye1')"></i>

                        </div>
                        <div class="input-boxss">
                        <label >Répéter le mot de passe</label>
                        <input id="pw2" type="password" name="password-confirm" placeholder=" mot de passe" required>
                <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->          
                         <i class="fas fa-eye eye" id="eye2" onclick="showpw('#pw2' , '#eye2')"></i>

                        </div>
                    </div>
                </div>
                <div class="btn"> 
                <button type="submit" name="submit">S'inscrire</button>
                <button id="cancel"> <a href="index.php"> Cancel</a></button>
                </div>
                 <!-- si on clique montrer la section de l'entreprise-->
                <a onclick="showEntrepriseSection()" href="#entreprise" >Je suis une Entreprise</a>
                <div class="loginlink">
                <p> Vous avez d&eacute;j&agrave; un compte ?<a href="loogin.php">Se connecter</a></p>
                </div>
        </form>
    </div>
    </section>

    <!-- entreprise -->

   <section id="entreprise">
      <div class="container">
        <header>Bienvenue !</header>
         <!-- les info seront envoyé à la page submit.php par POST-->
        <form action="submit.php" method="post" enctype="multipart/form-data">
                <div class="details personnel">
                    <span class="titre">Information Personnel</span>
                    <div class="erreur-msg" id="ent">
            <!-- ecrire l'erreur s'il y a des erreurs -->
 
                     <?php

                        if(isset($_GET['error'])){
                            echo $_GET['error'];
                             ?>
                    <!-- changer display:none à display:flex -->         
                            <script>
                                document.getElementById("ent").style.display = "flex";
                            </script>
                            <?php
                        }
                        ?>
                        

                    </div>

                    <div class="boxs">
                        <div class="input-boxss">
                        <label >Nom</label>
                        <input type="text" name="nom" placeholder="Entrez le nom de votre marque" required>
                        </div>

                        <div class="input-boxss">
                        <label >Téléphone</label>
                        <input type="phone" name="telephone" placeholder="Entrez votre numéro de téléphone" required>
                        </div>

                        <div class="input-boxss">
                        <label >Email</label>
                        <input type="email" name="email" placeholder="Entrez votre email" required>
                        </div>

                        <div class="input-boxss">
                        <label >Logo</label>
                        <input type="file" name="logo" required>
                        </div>
                        
                  
                        <div class="input-boxss">
                        <label >Site Web </label>
                        <input type="text"name="site" placeholder="Ex:https://www.nomEntreprise.com"required>
                        </div>
                        
                    
                        <div class="input-boxss">
                        <label >Chiffre d'affaire</label>
                        <input type="text" name="ca" placeholder="en MAD "required>
                        </div>
                        <div class="input-boxss">
                        <label >Domaine</label>
                        <select name="domaine" id="">
                           <option value="Fashion">Fashion</option>
                           <option value="Sport">Sport</option>
                           <option value="Art">Art</option>
                           <option value="Cuisine">Cuisine</option>
                           <option value="autre">Autre</option>
                        </select>
                        </div>
                        <div class="input-boxss">
                        <label >Mot de passe</label>
                        <input id="pw3" type="password" name="password" placeholder=" mot de passe" required>

          <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->
                         <i class="fas fa-eye eye" id="eye3" onclick="showpw('#pw3' , '#eye3')"></i>

                        </div>
                        <div class="input-boxss">
                        <label >Répéter le mot de passe</label>
                        <input id="pw4" type="password" name="password-confirm" placeholder=" mot de passe" required>
              <!-- si on clique sur l'oeil le mot de passe va apparaite on reclique et le mot de passe sera caché-->            
                         <i class="fas fa-eye eye" id="eye4" onclick="showpw('#pw4' , '#eye4')"></i>
                        </div>
                    </div>
                </div> 
                <div class="btn"> 
                <button type="submit" name="submit">S'inscrire</button>
                <button id="cancel"> <a href="index.php">Annuler</a></button>
                </div>
                 <div class="change">
                     <!-- si on clique montrer la section de l'influenceur-->
                 <a onclick="showInfluenceurSection()" href="#influenceur" >Je suis un Influenceur</a>
                 </div>
                <div class="loginlink">
                <p>Vous avez d&eacute;j&agrave; un compte ? <a href="loogin.php">Se connecter</a></p>
                </div>
        </form>
    </div>
   </section>
   
<!-- script pour montrer la section entreprise ou influenceur  -->
	<script>
		function showEntrepriseSection() {
         
         /*l'element dont l'id est entreprise va etre visible */

			document.getElementById("entreprise").style.display = "block";

        
            /*l'element dont l'id est influenceur va etre invisible */			
            document.getElementById("influenceur").style.display = "none";
		}

		function showInfluenceurSection() {

        /*l'element dont l'id est entreprise va etre invisible */
			document.getElementById("entreprise").style.display = "none";

        /*l'element dont l'id est influenceur va etre visible */    
			document.getElementById("influenceur").style.display = "block";
		}
	</script>

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

        eyefield.className = "fas fa-eye-slash eye";
	} else {
         //si le type de l input est text
        // change le à password
		pwfield.type = "password";

        // changer le nom de la classe de id2

        eyefield.className = "fas fa-eye eye";
	}
};

       </script>

</body>
</html>