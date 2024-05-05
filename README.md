![PHP IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/php-scaled.jpg)

Detta kursrepo innehåller arbetet för acronym jobe23 på BTH i samband med en kurs som heter MVC. Kursen använder sig av ramverket Symfony och kommer bland annat behandla objektorienterad programmering i PHP samt enhetstestning. Repot kommer uppdateras i samband med kursens gång.


Instruktioner
-------------

För att använda detta repo se först till att du har Git installerat på din maskin.

Du kan sedan köra följande kommando i din terminal:
git clone https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall.git

Nu kommer repot att klonas till din egen maskin och du kan inspektera eller arbeta vidare på detta repo.

För att köra igång local server för Symfony använd följande kommando i terminalen när du står i roten till repot:
php -S localhost:8888 -t public

Vid problem med repot eller om det är första gången du använder ramverket Symfony finns här en guide för att komma igång:
https://symfony.com/doc/current/setup.html


kör konfiguerad linter for projektet
tools/phpmd/vendor/bin/phpmd . text tools/phpmd/phpmd.xml

kör phpstan exempel (kan köras i skalan 1-9)
tools/phpstan/vendor/bin/phpstan analyse -l 9 src
kör phpstan utifrån konfigurations fil
tools/phpstan/vendor/bin/phpstan analyse -c tools/phpstan/phpstan.neon

Köra verktygen som scripts
composer phpmd
composer phpstan
Kör alla
composer lint

Fixa fel
composer csfix
Visa fel
composer csfix:dry

Rensa cache
php bin/console cache:clear

run phpdoc
composer phpdoc

kör phpdoc config
tools/phpdoc/phpdoc --config=tools/phpdoc/phpdoc.xml
 

kör test
bin/phpunit

exempel på generera code covarage report text
XDEBUG_MODE=coverage bin/phpunit --coverage-text tests/Dice/DiceTest.php

generera code coverage html 
XDEBUG_MODE=coverage bin/phpunit
eller
composer phpunit

Skapa en databas
php bin/console doctrine:database:create


Inför kmom05
Skapa en databas som innehåller en tabell med böcker. Lägg in minst tre böcker (riktiga eller påhittade) med deras titel, ISBN och författare samt en bild som representerar boken.

Data till databasen

Bok 1:
Titel: DUNE
ISBN: 9780441013593
Författare: Frank Herbert
Bild: ??

Beskrivning: 
Set on the desert planet Arrakis, Dune is the story of Paul Atreides--who would become known as Muad'Dib--and of a great family's ambition to bring to fruition humankind's most ancient and unattainable dream.

Bok 2:
Titel: Scary smart
ISBN: 9781529077650
Författare: Mo Gawdat
Bild: ??

Beskrivning:
Technology is putting our humanity at risk to an unprecedented degree. This book is not for engineers who write the code or the policy makers who claim they can regulate it. This is a book for you. Because, believe it or not, you are the only one that can fix it. – Mo Gawdat

Bok 3:
Titel: Into Thin Air
ISBN: 9781447200185
Författare: Jon Krakauer
Bild: ??

Beskrivning:
Jon Krakauer's Into Thin Air is the true story of a 24-hour period on Everest, when members of three separate expeditions were caught in a storm and faced a battle against hurricane-force winds, exposure, and the effects of altitude, which ended in the worst single-season death toll in the peak's history.

