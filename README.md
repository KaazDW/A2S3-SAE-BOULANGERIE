# PTUTBoulanger

# Réponses de la prof
## 2
 Le Moulin (bâtiment classé) est la propriété de la commune, qui est propriétaire de l'éco-musée intérieur (vieux outils, machines etc.). Un éco-musée c'est un musée qui représente des activités d'autrefois : ici meunerie, tournerie, battage du blé.

Le boulanger Benoit bénéficie ici d'un contrat de "mise à disponibilité" du lieu pour son activité de meunerie / boulangerie, et il doit assurer en contre partie les visites du musée et payer un loyer.
On parle ainsi de "Moulin éco-musée qui produit de la farine et du pain", il y en plusieurs dans les vallées du Jura où court une rivière. Ca n'est pas une boulangerie.
Il n'y a que 2 fournées par semaine : Mercredi et Vendredi. Les autres jours on peut avoir du pain, mais cuit la veille (moins cher). Il est fermé les Dimanche et Lundi hors saison, uniquement le Lundi en pleine saison.

Donc ce que les clients pourront réserver via le site, c'est :
- du pain, des brioches ou biscuits, de la farine (qu'ils viendront chercher au Moulin ensuite ou au marché de Lons le Jeudi matin : le lieu de livraison sera ainsi à préciser dans la commande)
- des stages de pain, en famille ou groupe d'adultes (PSH ou non).
- des visites guidée du musée (à 15h chaque jour).

Il existe aussi des visites en autonomie à un tarif réduit : pas besoin de réserver.

## 1

- Site client actuel : https://moulindepontdesvents.fr/ -> c'est une version développée par un ami consultant avec ODOO, un ERP CRM open-source (https://www.odoo.com/fr_FR). Vous pouvez vous en inspirer ! Le boulanger n'est pas satisfait de cette version, qui ne répond pas son CDC initial (joint).
Si vous faites mieux, il prendra votre site.

Sur le front ODOO, vous y trouverez les réponses aux Q2 et Q7.
Le backOffice se fait directement sur ODOO, je ne peux pas vous montrer les pages, mais c'est directement via les templates : pas simple pour le boulanger. Il préfèrerait un vrai backoffice.

Pour la Q3 et Q4 : oui, les deux.
Q5 : le site ne sait pas définir ce qu'est une commande "absurde". On prendra toutes les commandes, souvent elles ne concernent d'ailleurs qu'un pain. Pas grave, c'est le deal : la cde est intégrée dans la production de pains (entre 20 et 50kg par fournée). Sauf qu'il n'y a pas de baguette :-)

Q6 : les recettes sont établies sur la base d'un pain d'1Kg, oui

Il y a bien des pbs avec l'hébergement aussi, d'ailleurs la version du site actuelle est temporaire, c une restauration car le serveur a planté, à ce jour, il n'y a pas les VRAIES pages.
