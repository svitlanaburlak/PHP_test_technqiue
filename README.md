# PHP_test_technqiue

## Installation:
Cloner le repo

## branch main
essai de ValueObjects sans frameworks/libraries

## branch hexagonal 
installation des bundles afin de suivre ddd et Hexagonal Architecture
```sh
composer install
```

## [index.php](index.php)
very simple interface to test

## Coupon :
- id
- code unique
- une réduction en valeur absolue (valeur fixe) ou relative
(pourcentage)
## Panier :
- id
- total en €
## Un coupon ne peut s’appliquer à un panier que si l'ensemble des règles qui lui sont propres sont validées. Les voici :
- ne peut être appliqué que 10 fois
- ne peut être utilisé que jusqu'à 2 mois après date de création
- ne peut être appliqué que si un montant minimum d'achat est
atteint, défini à 50€
- un coupon peut-être révoqué à tout moment, ce qui le rend
inutilisable, pour toujours
- un coupon révoqué ne peut pas être réactivé (i.e. on ne peut
pas révoquer une révocation)
