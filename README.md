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

Bok 3:
Titel: Bläckfisken, en vidunderlig kärlekshistoria
ISBN: 9789185701261
Författare: Christer Lundberg
Bild: ??

Beskrivning:
Den 34-åriga Jimmy förlorade för 15 år sen sin bästa vän och är fast i det förflutna. Större delen av sin tid sitter han på sitt rum och spelar WoW. Han bor fortfarande hos sin mamma och kan knappt ta hand om sig själv, men efter att ha fått en praktikplats på Sjöfartsmuseet i Göteborg blir ingenting sig likt. Där möter han Lisa, och där gömmer han också den lilla bläckfisk som han får i sin vård. Bläckfisken är dock inte så söt och ofarlig och den växer med oroande hastighet.

Bok 4:
Titel: Harry Potter och fången från Azkaban
ISBN: 9789129704211
Författare: J. K. Rowling
Bild: ??

Beskrivning:
De fantastiska, och makalöst framgångsrika, böckerna om Harry Potter har sålt i hundratals miljoner exemplar världen över. Den föräldralöse pojken som visar sig vara en trollkarl tog världen med storm, och lämnade ingen oberörd. Böckerna har blivit klassiker, och de fortsätter att förtrolla nya generationer.

Scrutinizer
--------------
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/?branch=main)

[![Code Coverage](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/?branch=main)

[![Build Status](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/build-status/main)

[![Code Intelligence Status](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)