<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/s.css">

</head>
<body>
    <!-- ERROR HANDLING  -->
<div class="erreur-msg">
                        <?php
                        if(isset($_GET['error'])){
                            echo $_GET['error'];
                        }

                        ?>
</div>
    <section id="influenceur">
    <div class="container">
        <header>Bienvenue !</header>
        <form  action="submitinf.php" method="post" enctype="multipart/form-data">
                <div class="details personnel">
                    <span class="titre">Information Personnel</span>
                    

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
                        <label >Genre</label>
                        <select name="genre" id="">
                           <option value="Homme">Homme</option>
                           <option value="Femme">Femme</option>
                           <option value="Autre">Autre</option>
                           </select>
                        </div>
                    </div>
                </div>

                <div class="details personnel">
                    <span class="titre">Resaux Sociaux</span>

                    <div class="boxs">
                        <div class="input-boxss">
                        <label >Instagram</label>
                        <input type="text" name="insta" placeholder="Votre compte Instagramm "required>
                        </div>

                        <div class="input-boxss">
                        <label >Facebook</label>
                        <input type="text" name="fcbk" placeholder="Votre compte Facebook" required>
                        </div>

                        <div class="input-boxss">
                        <label >Youtube</label>
                        <input type="text" name="ytb" placeholder="Votre chaine Youtube" required>
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
                        <label >Abonnées</label> <select name="followers" id="follower">
                            <option value="">30k-60k Abonné</option>
                            <option value="">60k-90k Abonné</option>
                            <option value="">90k-150k Abonné</option>
                            <option value="">+150k Abonné</option>
                        </select>
                        </div> 
                        <div class="input-boxss">
                        <label >Mot de passe</label>
                        <input id="pw1" type="password" name="password" placeholder=" mot de passe" required>
                         <i class="fas fa-eye eye" onclick="showpw('#pw1')"></i>

                        </div>
                        <div class="input-boxss">
                        <label >Répéter le mot de passe</label>
                        <input id="pw2" type="password" name="password-confirm" placeholder="un mot de passe" required>
                         <i class="fas fa-eye eye" onclick="showpw('#pw2')"></i>

                        </div>
                    </div>
                </div>

                <div class="btn"> 
                <button type="submit" name="submit">S'inscrire</button>
                <button id="cancel"> <a href="index.php"> Cancel</a></button>
                </div>
                <a onclick="showEntrepriseSection()" href="#entreprise" >Je suis Entreprise</a>
                <div class="loginlink">
                <p>Vous avez déjà un compte ? <a href="loogin.php"> Login</a></p>
                </div>
        </form>
    </div>
    </section>
   <section id="entreprise">
      <div class="container">
        <header>Bienvenue !</header>
        <form action="submit.php" method="post" enctype="multipart/form-data">
                <div class="details personnel">
                    <span class="titre">Information Personnel</span>
                    <div class="erreur-msg">

                     <?php
                        if(isset($_GET['error'])){
                            echo $_GET['error'];
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
                        <input type="text"name="site" placeholder="Lien de Votre site web "required>
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
                         <i class="fas fa-eye eye" onclick="showpw('#pw3')"></i>

                        </div>
                        <div class="input-boxss">
                        <label >Répéter le mot de passe</label>
                        <input id="pw4" type="password" name="password-confirm" placeholder="un mot de passe" required>
                         <i class="fas fa-eye eye" onclick="showpw('#pw4')"></i>
                        </div>
                    </div>
                </div> 
                <div class="btn"> 
                <button type="submit" name="submit">S'inscrire</button>
                <button id="cancel"> <a href="index.php"> Cancel</a></button>
                </div>
                 <div class="change">
                 <a onclick="showInfluenceurSection()" href="#influenceur" >Je suis Influenceur</a>
                 </div>
                <div class="loginlink">
                <p>Vous avez déjà un compte ? <a href="loogin.php"> Login</a></p>
                </div>
        </form>
    </div>
   </section>
   

	<script>
		function showEntrepriseSection() {
			document.getElementById("entreprise").style.display = "block";
			document.getElementById("influenceur").style.display = "none";
		}

		function showInfluenceurSection() {
			document.getElementById("entreprise").style.display = "none";
			document.getElementById("influenceur").style.display = "block";
		}
	</script>

       <script>

function showpw(id) {
     
    let pwfield = document.querySelector(id);

	if (pwfield.type == "password") {
		pwfield.type = "text";
	} else {
		pwfield.type = "password";
	}
};

       </script>

</body>
</html>