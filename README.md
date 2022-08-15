<!-- PROJECT LOGO -->
<br />
  <h3 align="center">Sql Blog Sam</h3>
<div align="center">
    <a href="https://github.com/SamTravail/SBS">
    <img src="asset/img/logo_rdm.png" alt="logo_rdm" width="80" height="80">
  </a>

  <h3 align="center">README</h3>
<br>
</div>
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

Votre client, un célèbre influenceur de la région de Sous-Parsat dans la Creuse,
souhaite que vous lui développiez une application lui permettant de publier des articles et autres
contenus.
<br><br>
Malgré vos explications acharnées pour lui expliquer qu’un WordPress fera très
bien l’affaire, ledit client est prêt à vous payer le développement de son propre CMS parce
que c’est son projet !
<br><br>
Bien que plus à l’aise dans la communication digitale pour vendre l’eau de ses poissons
rouges et poster des selfies en débardeur pour ses fans du Club des Cheveux d’Argent de
Saint-Avit-le-Pauvre, votre client vous a néanmoins communiqué un cahier des charges
fonctionnel.
<br><br>
**Fonctionnalités à développer**
<br>
1. **Fonctionnalités du site**<br>
   Le site a pour vocation de permettre la rédaction de contenus et leur commentaire
   par des utilisateurs qui auront nécessairement un compte et des niveaux d’accès
   limitant leurs actions possibles.<br>
   Chaque opération liée à des (comptes) utilisateurs devra faire l’objet d’un envoi de
   mail au compte concerné.<br>
   N’importe quel utilisateur peut s’inscrire sur le site et aura par défaut le rôle
   “utilisateur inscrit”.<br>
   Seul l’administrateur aura la possibilité de modifier le rôle d’un utilisateur. L’utilisateur
   en question sera notifié par mail du changement de situation de son compte.<br>
   L’administrateur et les rédacteurs devront pouvoir visualiser les notes affectées aux
   articles (nombre de notes et moyenne des notes).<br><br>
2. **Gestion des rôles**<br>
   Votre client souhaite avoir la possibilité de gérer les niveaux de compte suivante :
   * **Visiteur**<br>
   Pas de compte en soi, est en capacité de lire les articles publics, mais ne
   peut ni leur affecter une note, ni écrire un commentaire, ni répondre à un
   commentaire ;<br>
   * **Utilisateur inscrit**<br>
   Possède un compte, peut mettre une note à un article, rédiger un
   commentaire et répondre à un commentaire<br>
   * **Modérateur**<br>
   A les mêmes droit que l’utilisateur inscrit, mais peut en plus modifier ou
   supprimer un commentaire ou une réponse à un commentaire d’un autre
   utilisateur (mais pas d’un autre modérateur)
   * **Rédacteur**<br>
   A les mêmes droits que le modérateur, mais peut rédiger et publier des
   articles.
   * **Administrateur**<br>
   Possède la totalité des droits, incluant l’ajout, la suppression, la gestion ou le
   bannissement temporaire d’un utilisateur.<br><br>
3. **Interface utilisateur**<br>
   Interface par défaut pour chaque catégorie d’utilisateurs, intégrant les fonctionnalités
   suivantes :
   * navigation classique (accueil, mentions légales, formulaire de contact,
   formulaire d’inscription)
   * inscription
   * connexion/déconnexion
   * afficher les derniers articles
   * noter un article (si connecté)
   * afficher les catégories des articles
   * afficher les articles par catégories (un article peut être dans plusieurs
   catégories).<br><br>
4. **Interface administrateur**<br>
   Cette interface sera accessible aux modérateurs, rédacteurs et administrateurs.<br>
   Les fonctionnalités seront à afficher en fonction du rôle de l’utilisateur connecté.<br>
   Outre les fonctions classiques de CRUD, les fonctionnalités seront à proposer en
   fonction des droits des utilisateurs.<br>
   * CRUD utilisateurs avec affectation des droits
   * CRUD de contenus en fonction des droits
   * gestion des commentaires.


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

To connect the SQL database :
* **user** : ' root '
* **mdp** : ' '

### Prerequisites

This is the list things you need to use the blog and how to install them.
* MySQL Workbench
  ```sh
  https://dev.mysql.com/downloads/workbench/
  ```
* xampp
  ```sh
  https://www.apachefriends.org/fr/index.html
  ```  

### Installation

1. Clone the repo
   ```sh
   git https://github.com/SamTravail/SBS
   ```
2. Install MySQL Workbench
   ```
   // Install whith default option
   // Douwnload and open the 'modelisation_SBS.mwb' from _documents
   ```
3. Install xampp
   ```
   // After xampp was installed whith default option,
   // In phpMyAdmin, create a sbs database.
   // import the base from _documents into sbs
   ```
4. Site access
   
   You can now access by your localhost at : [SBS](http://localhost/sbs/index.php),
   and [phpMyadmin](http://localhost/phpmyadmin/index.php?route=/database/structure&db=sbs).
     
  


<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.


1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

Sam - contact@sbs.com

Project Link: [https://github.com/SamTravail/SBS](https://github.com/SamTravail/SBS)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

* [Choose an Open Source License](https://choosealicense.com)
* [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet)
* [Malven's Flexbox Cheatsheet](https://flexbox.malven.co/)
* [Malven's Grid Cheatsheet](https://grid.malven.co/)
* [Img Shields](https://shields.io)
* [GitHub Pages](https://pages.github.com)
* [Font Awesome](https://fontawesome.com)
* [React Icons](https://react-icons.github.io/react-icons/search)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=for-the-badge
[contributors-url]: https://github.com/SamTravail/SBS/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/othneildrew/Best-README-Template.svg?style=for-the-badge
[forks-url]: https://github.com/SamTravail/SBS/network/members
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=for-the-badge
[license-url]: https://github.com/SamTravail/SBS/blob/master/LICENSE.txt
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 
