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

 