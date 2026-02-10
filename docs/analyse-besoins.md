# Analyse des besoins  
## Projet : Plateforme de location de voitures – Entreprise Grand Turismo

---

## 1. Contexte du projet

Grand Turismo est une société fictive spécialisée dans la location de voitures pour les particuliers et les professionnels.  
Dans le cadre de son développement numérique, l’entreprise souhaite mettre en place une plateforme web de location de véhicules permettant aux 
utilisateurs de consulter les voitures disponibles et d’effectuer une demande de location en ligne.

Cette plateforme vise à simplifier le processus de réservation tout en offrant une expérience utilisateur claire, ergonomique et accessible sur 
ordinateur comme sur mobile.

---

## 2. Objectifs de la plateforme

Les objectifs principaux de la plateforme sont les suivants :

- Présenter les véhicules disponibles à la location
- Permettre aux utilisateurs de consulter les caractéristiques détaillées d’un véhicule
- Permettre la réservation d’un véhicule via un formulaire en ligne
- Calculer dynamiquement le coût de la location selon les choix de l’utilisateur
- Fournir un récapitulatif clair de la demande de location

---

## 3. Utilisateurs cibles

La plateforme s’adresse principalement :

- Aux particuliers souhaitant louer une voiture pour une courte ou moyenne durée
- Aux professionnels ayant besoin d’un véhicule ponctuellement nécessitant une interface simple et intuitive

---

## 4. Fonctionnalités attendues

### 4.1 Consultation des véhicules

- Afficher un catalogue de véhicules disponibles à la location
- Présenter les informations essentielles :
  - image du véhicule
  - marque et modèle
  - type de véhicule (citadine, SUV, utilitaire, etc.)
  - prix journalier
- Possibilité de filtrer les véhicules par catégorie ou type (interaction JavaScript)

---

### 4.2 Fiche véhicule

- Affichage détaillé d’un véhicule sélectionné
- Informations affichées :
  - description du véhicule
  - caractéristiques (motorisation, nombre de places, transmission)
  - prix journalier
  - disponibilité
- Bouton permettant d’accéder au formulaire de réservation

---

### 4.3 Réservation d’un véhicule

La réservation s’effectue via un formulaire comprenant plusieurs champs :

**Informations client**
- nom
- prénom
- adresse email
- numéro de téléphone

**Informations de location**
- date de début de location
- date de fin de location
- lieu de prise en charge
- type de véhicule sélectionné

**Validation**
- acceptation des conditions générales (obligatoire)

---

### 4.4 Comportements dynamiques (JavaScript)

- Affichage dynamique des options selon les choix de l’utilisateur
- Calcul estimatif du prix total de la location en fonction :
  - de la durée
  - du prix journalier
  - des options sélectionnées
- Vérification visuelle de certains champs du formulaire

---

### 4.5 Traitement du formulaire (PHP)

- Récupération et traitement des données envoyées via le formulaire
- Vérification de la validité des données (dates cohérentes, champs obligatoires)
- Calcul final du prix de la location
- Affichage d’un récapitulatif de la réservation

---

## 5. Parcours utilisateur

1. L’utilisateur arrive sur la page d’accueil
2. Il consulte le catalogue des véhicules disponibles
3. Il sélectionne un véhicule et accède à sa fiche détaillée
4. Il remplit le formulaire de réservation
5. Il valide sa demande et obtient un récapitulatif de réservation

---

## 6. Contraintes techniques

Le projet doit respecter les contraintes suivantes :

- Utilisation des langages HTML, CSS, JavaScript et PHP
- Mise en page responsive adaptée aux différents supports
- Utilisation de JavaScript pour les interactions dynamiques
- Traitement du formulaire en PHP
- Conception d’une base de données avec MCD et MLD
- Utilisation de Git pour le suivi de l’évolution du projet

---

## 8. Conclusion

Cette analyse des besoins permet de définir clairement le périmètre fonctionnel et technique de la plateforme de location de voitures.  
Elle servira de base pour la conception des maquettes, de la base de données et du développement de la plateforme.


