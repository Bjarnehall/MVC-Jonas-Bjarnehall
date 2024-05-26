THE DATABASE MYSTERY
---------------
The database mystery är ett spel som skrivits i PHP med hjälp av ramverket Symfony. Spelet är ett 
examinerande projekt för kursen MVC på Blekinge tekniska högskola. Nedan följer en beskrivning av
hur spelet är uppbyggt.

OBS! Spelet är tänk att spelas på normal desktop på fullskärm det är inte mobilanpassat och fungerar
dåligt i annat format.

CSS
-----
Spelet har en egen css stil som utgår ifrån filen /project.css där tillhörande
filer även impporteras.

Spelets logik
------------

Spelet går ut på att stänga av/reboota servern för att rädda databasen, en förenklad verision av spelet ser ut på detta sett.

![FLOWCHART IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/Flowchart1.png)

För att spelet ska bli instressant behövs en möjlighet att gå mellan olika rum.

![FLOWCHART IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/Flowchart2.png)

I ett prototyp stadie utvecklades spelet enligt detta flöde och testades innan vidare utveckling fortsatt.

![FLOWCHART IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/Flowchart3.png)

Flödesschema i ett senare skede av utvecklingen där de största delen av spelet är helt klart uppdelat i två kapitel.

Kapitel 1

![FLOWCHART IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/FlowChart4.png)

Kapitel 2

![FLOWCHART IMG](https://github.com/Bjarnehall/MVC-Jonas-Bjarnehall/blob/main/public/img/FlowChart5.png)

Routes / spelets gång

----------
/proj/about
About sidan nås via "Om" i navbaren och beskriver kortfattat vad projektet handlar om.

/proj
Landningsidan visar en bakrundsbild för spelet "The Database Mystery". Här finns möjlighet att
"Play Game" eller "Reset Game". Reset game tömmer den info som spelaren samlat i sin inventory.
Play Game tar spelaren till spelets första rum.

/proj/start
Startrummet i spelet består av en miljö med två dörrar en NPC som vi kan interagera med genom
muspekaren. Vi har även en inventory som vid starten av spelet är tom. Det finns även en ledtråd
att vi ska interagera med NPC. Den ena dörren är låst och det är den spelaren uppmanas att hitta 
ett sätt att komma in i dörren på. Om spelaren försöker uppmanas denne att ange ett lösenord.
Eftersom att dörren är låst antas spelaren fortsätta genom den andra dörren.

/proj/server
När spelaren försöker komma in i serverrummet möts denne av ett formulär där ett lösenord måste anges.
Om spelaren inte har lösenordet finns inget annat alternativ än att gå tillbaka.

/proj/secondroom
Här är första rummet spelaren har accesses till, här finns en ledtråd skriven på väggen "Take out 
the strash!//Jime" Genom ledtråden antas spelaren att leta i papperkorgen där den första ledtråden finns.
Ledtråden består av en papperslapp med en obegriplig text på, om användaren försöker använda detta som
lösenord till servern kommer den inte att komma in. Spelaren har möjlighet att gå genom ytterligare en
dörr där spelet fortsätter.

/proj/thirdroom
I tredje rummet möts spelaren av en garderob som är möjlig att öppna genom att klicka på den.
spelaren kan även gå tillbaka till tidigare rum.

/proj/opencabin
När spelaren öppnat skåpet skymtas ett kretskort i en låda vid klick på kretskortet öppnas 
en decrypting device.

/proj/device
Spelaren möts av ett formulär för "Secret Decrypting Device" där denne uppmanas "Decrypt Message"
en ledtråd talar om för spelaren att använda de ledtrådar de hittat. Det dekrypterade medellandet
sparas i databasen och läggs till i inventory.

Spelaren antas nu gå tillbaka till start och försöka ta sig in i serverrummet. Om spelaren lyckas.

/proj/server/passed
Inne i serverrummet möts vi av killen som försöker sabba databasen. Två olika val kan göras i form 
av att välja mellan två svar till förövaren. Det finns även en cd skiva som kan plockas upp och 
läggas till i inventory. Valet spelaren tar i konversationen påverkar inte spelet mer än att 
konversatioen med förövaren skiljer sig och slut skärmen när spelet är avklarat skiljer sig åt.

/proj/server/dialog_on alternativt /proj/server/dialog_two
Förövaren ger ett svar tillbaka, möjlighet att plocka upp cd skivan finns fortfarande och en möjlighet
att enteragera med datorn finns nu.

/proj/server/final
Här är sista momentet i spelet och spelaren har nu möjlighet att använda cd skivan för att reboota
sytemet och rädda databasen.

/proj/end
Här visas en slut bild med information om att databasen nu är räddad. Spelaren kan starta om spelet om
så önskas och då återställs även databasen för inventory.


Scrutinizer
-----------------
I denna verison av detta repo är de filer som inte har med Spelet "The Database Mystery" att göra 
excluderats i scrutinizer badges avser alltså spelets kod.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/?branch=main)

[![Code Coverage](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/?branch=main)

[![Build Status](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Bjarnehall/MVC-Jonas-Bjarnehall/build-status/main)


Ytterligare information
-------------------------------------------------
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


Data till databas tabellen Books

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