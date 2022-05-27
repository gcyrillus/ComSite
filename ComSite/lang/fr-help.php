<div id="help">
<h3>aide du plugin ComSite</h3>
<p>Ce plugin permet d'ajouter le lien vers le site de l'auteur d'un commentaire, ceux dans affichés dans la sidebar en "Derniers commentaires".</p>
<h4>Intégration</h4>
<p>Pour modifier l'affichage de la liste des derniers articles , il faut modifier la structure HTML générer par la fonction lastComList() afin de pouvoir extraire et afficher le lien du site de l'auteur.</p>
<p>Ce code sera remplacer par l'adresse du site si disponible.</p>
<h4>Exemple</h4>
<p>Appel de la fonction dans le fichier sidebar.php du theme par défaut de PluXml:
<code><pre>&lt;?php $plxShow->lastComList('&lt;li>&lt;a href="#com_url">#com_author '.$plxShow->getLang('SAID').' : #com_content(34)&lt;/a>&lt;/li>'); ?></pre></code> </p>

<p>Nouvel affichage possible avec le plugin activé en modifiant la structure de base à afficher
<code><pre>&lt;?php $plxShow->lastComList('&lt;li>&lt;p>&lt;cite>#com_author&lt;/cite> : 
&lt;small>&lt;a href="#com_site" class="authComLink" rel="nofollow">website&lt;/a>&lt;/small>
 &lt;b>L_SAID: &lt;/b> &lt;br>&lt;q>&lt;a href="#com_url"> #com_content(10)&lt;/a>&lt;/q>&lt;/p>&lt;/li>') ?></pre></code>
<p>Ce qui donne un rendu similaire à </p>
<ul data-demo>
  <li><p><cite>Auteur :</cite>  <small><a href="" class="authComLink" rel= "nofollow" style="float:inline-end;">website</a></small><b>a dit: </b> <br><q><a href="">Et un deuxieme commentaire  ...</a></q></p></li>
  <li><p><cite>Auteur :</cite>  <small><a href="" class="authComLink" rel= "nofollow" style="float:inline-end;">website</a></small><b>a dit: </b> <br><q><a href="">Debut du premier commentaire ...</a></q></p></li>
</ul>
<p>Le fichier <code>sidebar.php</code> peut-être editer depuis l'administration si vous le souhaitez. Il est cependant préferable de faire un backup de votre thème avant de le modifier, que ce soit enn local ou en ligne.</p>
<h4>PostFace</h4>
<p>Le plugin vous convient mais vous avez besoin d'un peu d'aide pour l'implementer ou le modifier, Vous pouvez vous adresser au <a href="https://forum.pluxml.org/">forum.pluxml.org</a> .</p>
<p>Vous souhaiter le modifier , pour cela , faites en un 'fork' <a href="https://github.com/gcyrillus/ComSite">depuis son repo sur github </a>.</p>

<hr>
</div>
