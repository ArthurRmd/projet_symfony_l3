# projet_symfony_l3

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

###

###Fonctionnalité du projet

##### Page home page

- url : `` / ``
- description : affiche tous les champions de League Of legend
- fonctionnalité : pagination, recherche instantané



##### Page Free Champion

- url : `` /free-champions ``
- description : qui affiche tous les champions Gratuit de League Of legend



##### Page Free Champion

- url : `` /champion/{id} ``
- description : qui affiche les informations d'un champion par son id (on y accede en cliquant sur
                le boutton **get more information**)



##### Page summoner

- url : `` /summoner ``
- description : Permet de chercher les informations d'un summoner en fonction de son nom

- url 2 : `` /summoner/{name} ``
- description : Redirige automatiquement vers la page summoner, est effectue la requête ajax automatiquement 



##### Page login

- url : `` /login ``
- description : Permet de se connecter avec une adresse email et un mod de passe 



##### Page de connexion

- url : `` /registration ``
- description : Permet de se créer un compte avec un nom de summoner, une adresse email et un mod de passe



##### Page de deconnexion

- url : `` /logout ``
- description : Permet de se déconnecter

<br>

### Technologie utilisé

##### Utilisation de Webpack
Dans se projet Webpack est utilisé, il nous permet de compiler le javascript dans des versions compatible avec
tous les navigateurs mais également de réaliser un fichier CSS avec tout nos fichier SCSS.

##### Utilisation de List.JS
Pour la pagination j'ai utilisé List.JS au lieu de la pagination de Symfony car cela permet d'ajouter du dynamisme
a notre page.


