<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collab</title>
    <link rel="stylesheet" href="./css/test.css">
    <script src="https://kit.fontawesome.com/8b4b4337c0.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="header">
    <nav> <!-- crée une barre de navigation-->
        <a href="#" class="logo"><img src="./images/collab.png" style="width: 180px; height: 140px;" alt=""></a>
        <div class="nav-links" > <!--  crée une liste d'éléments de navigation.-->
            <ul> <!--  crée une liste à puces-->
                <li> <a href="#">Page d'acceuil</a></li> <!-- crée un lien vers la page d'accueil.-->
                <li> <a href="#Aboutus">&Agrave; propos de nous</a></li> <!-- : crée un lien vers la section "About Us"-->
                <li> <a href="#services">Services</a></li> <!--  crée un lien vers la section "Services"-->
                <!-- <li> <a href="admin.php">Admin</a></li>  crée un lien vers une page admin -->
                <li> <a href="#contactus">Contacter nous</a></li> <!-- crée un lien vers la section "Contact"-->
                <li> <a href="loogin.php" >Se connecter</a></li>
            </ul>
        </div>
    </nav>
    <div class="text-box">
        <h1>Bienvenue sur Collab</h1>
        <p>
            la plateforme qui facilite la création de partenariats entre les marques et les influenceurs.
            Que vous soyez une marque cherchant à établir des relations avec des influenceurs pour promouvoir 
            vos produits ou services, ou un influenceur cherchant des marques pour collaborer et développer votre 
            audience, Collab est là pour vous aider à trouver des partenariats rentables et durables
           
        </p>
        <a href="signup.php" class="btnn">Devenir membre</a> <!--  ajoute un bouton pour les marques.-->
      
    </div>
    </section>



                     <!--         About-Us       -->
    <section id="Aboutus" > <!-- crée une section pour la section "About Us".-->
        <div class="heading"> <!-- crée un en-tête pour la section "About Us".-->
            <h1>&Agrave; propos de nous</h1>
            <p>Nous facilitons la création de partenariats qui bénéficient aux marques et aux influenceurs</p>
        </div>
        <div class="container"> <!-- crée une boîte de contenu pour la section "About Us".-->
            <section class="about"> <!-- crée une sous-section "about" pour la section "About Us".-->
               <div class="about-image"> <!--  crée une boîte d'image-->
                 <img src="./images/bacg1.png" alt="">
               </div>
               <div class="about-content">
                <h2>Collab</h2>
                <p> Nous sommes une plateforme de marketing d'influence qui met en relation 
                    les marques et les influenceurs pour des collaborations authentiques et durables. Notre mission est de 
                    simplifier et d'améliorer le processus de marketing d'influence en offrant une expérience utilisateur fluide,
                    efficace et agréable à tous nos utilisateurs
                    Grâce à notre plateforme, les marques peuvent trouver rapidement des influenceurs pertinents pour leur marque
                    et collaborer avec eux de manière transparente et efficace.
                    les influenceurs peuvent être connectés à des marques pertinentes pour leur niche, ce qui leur permet de
                    découvrir de nouvelles opportunités de collaboration et d'augmenter leur visibilité auprès de leur communauté. 
                    Contactez-nous dès aujourd'hui pour en savoir plus sur la manière dont nous pouvons vous aider à réussir votre 
                    prochaine collaboration. <br>
                    <strong>  Rejoignez-nous d&eacutes maintenant !<strong\></p>
                    <a href="signup.php" class="join-btn">Rejoindre nous !</a>
               </div>
            </section>
    </section>


                    <!--__________services__________ -->
      <section id="services"> <!-- creer une section pour les services-->
        <div class="titre">
            <h1>Nos services</h1>
        </div>
        <div class="service-row">
            <div class="service-col">
                <img src="./images/feature1.png" alt="">
                <h4> Partenariat de qualit&eacute</h4>
                <p>Nous travaillons avec des marques de qualité et des influenceurs reconnus dans leur domaine, afin de vous offrir des partenariats de qualité qui répondent à vos besoins spécifiques.
                </p>
                
            </div>
            <div class="service-col"> 
            <img src="./images/feature2.png" alt="">
            <h4> Gratuit&eacute</h4>
            <p>Notre service est gratuit pour les influenceurs, ce qui signifie que vous n'aurez pas à payer pour accéder à des opportunités de collaboration avec des marques de qualité. Nous facturons uniquement les marques pour les services que nous leur fournissons.</p>
            
            </div>
            <div class="service-col"> 
            <img src="./images/feature3.png" alt="">
            <h4> securit&eacute</h4>
            <p>Nous prenons la sécurité et la protection de vos données très au sérieux. Nous avons des politiques de confidentialité strictes en place et nous utilisons des outils de sécurité de pointe pour garantir que vos informations personnelles sont protégées à tout moment.</p>
        
            </div>
        </div>
                      <!-- le bouton d'inscription -->
        <div class="service-btn"> <a href="signup.php" class ="join-btn"> S'inscrire maintenant ! </a> </div>
     </section>
      <!--  _______________Pour quoi nous choisir_________________  -->
      <section id="pourquoi-nous">
        <div class="why">
            <div class="titre">
                <h1>Pourquoi nous choisir ?</h1>
            </div>
            <div class="choix">
                <div class="card">
                     <h2> Marque ?</h2>
                      <p>Si vous êtes une marque, vous savez à quel point il est important d'élargir votre audience
						 et d'augmenter votre visibilité en ligne. Pour atteindre ces objectifs, trouver les bons influenceurs et établir
						 des collaborations fructueuses peut être un véritable défi. C'est là que notre plateforme Collab entre en jeu. 
						 nous pouvons vous aider à trouver les influenceurs qui correspondent le mieux .
                        </p>
                        <a href="signup.php" class="join-btn">Rejoindre nous !</a>
                </div>
                <div class="card">
                   
                     <h2> Influenceur ?</h2>
                      <p> Si vous êtes un influenceur cherchant à améliorer votre présence en ligne et à collaborer
						 avec des marques de manière efficace, Collab est l'outil parfait pour vous. Avec notre
						  plateforme facile à utiliser, vous pouvez accéder à une grande variété de marques et de campagnes, 
						  et même trouver des opportunités de collaboration personnalisées qui correspondent à vos intérêts et à votre audience</p>
                        <a href="signup.php" class="join-btn">Rejoindre nous !</a>
                </div>
            </div>
        </div>
      </section>

                              <!--__________Témoignages__________ -->

      <section id="avis">  <!-- définit une section avec l'id "avis". -->
           <div class="first">
             <h1>T&eacutemoignages</h1></div>
           <div class="wrapper">
            <div class="container"> <!-- une division avec la classe "container". Cela servira de conteneur pour chaque témoignage individuel -->
                <div class="profile"> <!-- une division avec la classe "profile". Cela servira de conteneur pour l'image et le nom de la personne donnant le témoignage -->
                    <div class="imagebox">
                        <img src="./images/kiko.jpg" alt="">
                    </div>
                    <h2>Kiko</h2>
                </div>
               
                <p> <i class="fa-solid fa-quote-left left"></i> <!-- afficher des icônes de guillemets à gauche -->
                     Nous pouvons explorer différents profils et trouver les influenceurs qui correspondent le mieux 
                    à notre image de marque, tout en entrant en contact directement avec eux sur la plateforme pour discuter 
                    des détails de la collaboration.
                    <i class="fa-solid fa-quote-right right"></i> <!-- afficher des icônes de guillemets à droite-->
                </p>
                 <!-- Le contenu du témoignage est placé entre ces icônes de guillemets -->
            </div>
            <div class="container">
                <div class="profile">
                    <div class="imagebox">
                        <img src="./images/inluenceur1.jpg" alt="">
                    </div>
                    <h2>Mounia Jad</h2>
                </div>
                <p> <i class="fa-solid fa-quote-left left"></i>
                    Collab offre un espace centralisé pour la communication avec les marques. Je peux maintenant discuter 
                    avec les marques directement sur la plateforme, ce qui facilite grandement la communication. Nous pouvons 
                    discuter de tous les détails de la collaboration, y compris la portée, le contenu, le calendrier de publication
                     et les modalités de paiement, en un seul et même endroit. Cela a réduit le temps que je passais à chercher des 
                     informations dans différentes plateformes, ce qui me permet de me concentrer sur la création de contenu de qualité.
                    <i class="fa-solid fa-quote-right right"></i>
                </p>
            </div>
            <div class="container">
                <div class="profile">
                    <div class="imagebox">
                        <img src="./images/influenceur2.png" alt="">
                    </div>
                    <h2>Outhman Yazan</h2>
                </div>
                <p> <i class="fa-solid fa-quote-left left"></i>
                    Collab nous a permis de discuter ouvertement de nos attentes et de la portée de notre collaboration,
                     grâce à un espace sécurisé pour les échanges de messages et les discussions. Cette communication efficace 
                     nous a permis de travailler ensemble de manière productive et d'atteindre nos objectifs communs.
                    <i class="fa-solid fa-quote-right right"></i>
                </p>
            </div>
           </div>
      </section>
                    <!--__________Contacter nous__________ -->
<footer>
	<div>
         <h2 id="contactus" > Contacter nous</h2>
    </div>
    <!-- message sera envoyé à no22one20@gmail.com -->
	<form method="post" action="https://formsubmit.co/no22one20@gmail.com"> 
        <!--Début du formulaire avec la méthode 'post' 
        et l'action qui va envoyer les données saisies dans le formulaire à l'adresse email indiquée-->
    	<input type="text" placeholder="Nom" name="nom"><!--  Zone de texte pour le nom -->
    	<input type="email" placeholder="E-mail" name="email" required > <!-- Zone de texte pour l'email de l'utilisateur, avec une indication que ce champ est obligatoire-->
    	<textarea name="message" placeholder=" Votre message ici" required></textarea><!--Zone de texte pour le message de l'utilisateur, avec une indication que ce champ est obligatoire-->
	    <input class="but" type="submit" name="envoyer" value="envoyer"  > <!-- : Bouton pour envoyer le formulaire-->
	</form>
<div id="trait"> </div> <!--  div qui contient rien sert comme Ligne de séparation-->
<div id="copyrighticon"> 

    <div id="copyright"> <span> &copy;2023 </span></div>
    <div id="icons"> <!-- Balise pour les icônes des réseaux sociaux-->
        <a href="http://www.twitter.fr"> <i class="fa fa-twitter">  </i></a> <!-- Lien vers Twitter avec l'icône de Twitter.-->
        <a href="http://www.facebook.fr"> <i class="fa fa-facebook">  </i></a><!-- Lien vers Facebook avec l'icône de Facebook-->
        <a href="http://www.instagram.fr"> <i class="fa fa-instagram">  </i></a><!-- Lien vers Instagram avec l'icône de Instagram.-->
    </div>
</div>
</footer>
</body>
</html>
