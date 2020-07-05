# projet_symfony_l3

Environment utilisé pour le développement
* PHP 7.2.19
* MySQL 5.7.24
* Linux


###Installation du projet 

```bash
   git clone https://github.com/ArthurRmd/projet_symfony_l3
   ```

```bash
   composer install 
   ```

```bash
    yarn install
```

```bash
    yarn encore dev
```

Mettre votre config de Database dans le **.env** 
```env
DATABASE_URL=mysql://user:password@127.0.0.1:3306/db_name?serverVersion=5.7
```

Effectuer les migrations
```env
    php bin/console doctrine:migration:generate
    php bin/console doctrine:migration:migrate
```


Mettre la clef d'Api de Riot Game disponible ici https://developer.riotgames.com/ dans le **.env** 
```env
API_KEY=_YOUR_API_KEY
```

### Lancer le projet

```bash
    cd /..../projet_symfony_l3/public
    php -S localhost:8000   
```

###

### Fonctionnalité du projet

##### Page home page

- url : `` / ``
- description : affiche tous les champions de League Of legend
- fonctionnalité : pagination, recherche instantané

<p align="center">
    <img src="https://github.com/ArthurRmd/projet_symfony_l3/blob/master/readme_asset/champion.gif" width="600" >
</p>


##### Page Free Champion

- url : `` /free-champions ``
- description : affiche tous les champions Gratuit de League Of legend



##### Page champion

- url : `` /champion/{id} ``
- description : affiche les informations d'un champion par son id (on y accede en cliquant sur
                le boutton **get more information**)



##### Page summoner

- url : `` /summoner ``
- description : Permet de chercher les informations d'un summoner en fonction de son nom
- fonctionnalité : Recherche de summoner en ajax.

- url 2 : `` /summoner/{name} ``
- description : Redirige automatiquement vers la page summoner, est effectue la requête ajax automatiquement 

<p align="center">
    <img src="https://github.com/ArthurRmd/projet_symfony_l3/blob/master/readme_asset/summoner.gif" width="600" alt="php-timer">
</p>

##### Page login

- url : `` /login ``
- description : Permet de se connecter avec une adresse email et un mod de passe 



##### Page de inscription

- url : `` /registration ``
- description : Permet de se créer un compte avec un nom de summoner, une adresse email et un mot de passe



##### Page de deconnexion

- url : `` /logout ``
- description : Permet de se déconnecter

<br>

### Technologie utilisé

##### Utilisation de Webpack
Dans se projet Webpack est utilisé, il nous permet de compiler le javascript dans des versions compatible avec
tous les navigateurs mais également de réaliser un fichier CSS avec tout nos fichier SCSS.

##### Utilisation de Bootstrap
Utilisation du Framework CSS Bootstrap

##### Utilisation de List.JS
Pour la pagination j'ai utilisé List.JS au lieu de la pagination de Symfony car cela permet d'ajouter du dynamisme
a notre page.

##### Utilisation de Psalm
Utilisation de psalm afin de pouvoir analyser le code est détecter des ou de potencielle erreur(s).

```bash
composer format
```

##### Utilisation de GitHub Action
Utilisation des gitHub actions afin d'executer automatiquement Psaml à chaque push sur GitHub


