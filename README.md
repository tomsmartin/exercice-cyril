# Exercice Cyril Pereira


L'exercice demandé est développé avec symfony 4.2
## Pré-Requis
- composer

## Installation

- Télécharger le projet sur github
- Lancer l'invité de commande
- Se placer dans le dossier du projet avec la commande :

```bash
cd CHEMIN_DU_PROJET
```
- Installer le projet avec la commande :

```bash
composer install
```
Créer la base de données :
```bash
php bin/console doctrine:database:create
```
Mettre à jour les tables de la bdd
```bash
php bin/console doctrine:schema:update
```

## Usage

Lancer le serveur :
```bash
php bin/console server:run
```

## Utilisation
La page d'index n'a pas été fait.
Par conséquent pour créer un nouveau job il faut se rendre sur :
  - /job/new
Pour update un job :
  - /job/edit/{id}
Pour voir la liste des jobs :
  - /job/list

Pour créer un nouveau contrat il faut se rendre sur :
  - /contrat/new
Pour update un contrat :
  - /contrat/edit/{id}
Pour voir la liste des contrats :
  - /contrat/list

Pour créer une nouvelle compétence il faut se rendre sur :
  - /competence/new
Pour update une compétence :
  - /competence/edit/{id}
Pour voir la liste des compétences :
  - /competence/list

Pour créer une nouvelle candidature il faut se rendre sur :
  - /candidature/new
Pour update une candidature :
  - /candidature/edit/{id}
Pour voir la liste des candidatures :
  - /candidature/list

Pour créer une nouvelle offre il faut se rendre sur :
  - /offre/new
Pour update une offre :
  - /offre/edit/{id}
Pour voir la liste des offres :
  - /offre/list
