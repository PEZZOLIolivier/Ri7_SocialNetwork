# <center>Table des matières</center><
1. [Table des matières](#Table-des-matièrescenter)
2. [Consignes](#consignes)
3. [Local installation](#local-installation)
4. [Commits history](#commits-history)


# Consignes

Bienvenue en 2003, Facebook n’existe pas encore et vous avez la merveilleuse idée de créer un réseau social. 
Devenez milliardaire grâce à la POO en concevant un mini réseau social :
- Connexion/Inscription/Déconnexion d'un utilisateur.
- Visualisation de l’ensemble des Post créés.
- Un Post est défini a minima par un titre, un contenu et un auteur.
- Possibilité de créer un nouveau Post, de supprimer ceux que vous avez posté ou de les modifier.

# Local installation
 
 $ git clone https://github.com/PEZZOLIolivier/Ri7_SocialNetwork.git
 Ensuite modifier les informations de connexion de bose de données dans /src/models/Database.php


# Commits History

## <center>Initial commit</center>
- Project & repository initialisation.
        
## <center>Add authentification feature</center> 
- Ajout des divers composants du module:
  + Création du router.
  + Gestion de la base de donnée.
  + Enregistrement d'un nouvel utilisateur.
  + Connexion d'un nouvel utilisateur.
  + Déconnexion de l'utilisateur connecté.

## <center>Add post feature</center> 
- Ajout des divers composants du module:
  + Modification du router.
  + Gestion de la base de donnée.
  + Ajout de post pour un utilisateur connecté.
  + Possibilité à l'utilisateur de modifier et/ou de supprimer ses posts.
  + Première revue du code. 

## <center>Fix welcome bug</center> 
- modification du code pour la suppression du bug sur le message de bienvenue hors session.
- mise à jour du fichier README.md 



last update 18 march 2024# Ri7_SocialNetwork