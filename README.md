![Mollie](https://www.mollie.com/files/Mollie-Logo-Style-Small.png)

# thirty bees plugin voor [betalingen via Mollie](https://www.mollie.com/). #

## Installatie [![Build Status](https://travis-ci.org/mollie/Prestashop.png)](https://travis-ci.org/mollie/Prestashop) ##

## Verzorgd door [Snowy Cat Software](https://www.snowycatsoftware.com/). ##

**Let op:** voor de installatie van deze module is eventueel FTP-toegang tot je webserver benodigd. Heb je hier geen ervaring mee? Laat de installatie van deze module dan over aan je websitebouwer of serverbeheerder.

* Download de laatste versie van de module via de [Releases-pagina](https://github.com/mollie/thirtybees/releases).
* Ga naar het administratiepaneel van uw thirt bees webwinkel
* In uw administratiepaneel selecteert u de tab 'Modules' en kiest vervolgens 'upload een module' rechts bovenin uw scherm
* Kies 'selecteer bestand' en upload vervolgens het bestand met de naam 'mollie.zip' dat u eerder heeft gedownload 
* Nadat de module zich heeft geïnstalleerd kiest u 'configureer'
* Vul uw _API-key_ in en sla de gegevens vervolgens op.

# Ondersteunde betaalmethodes

### iDEAL
Met [iDEAL via Mollie](https://www.mollie.com/nl/payments/ideal) kunt u vertrouwd, veilig en gemakkelijk uw online aankopen afrekenen. iDEAL is het systeem dat u direct koppelt aan uw internetbankierprogramma bij een online aankoop.
Via [Mollie](https://www.mollie.com/) is iDEAL gemakkelijk aan te sluiten zonder de gebruikelijke technische en administratieve rompslomp. Mollie geeft u op ieder moment toegang tot uw transactieoverzichten en andere statistieken. Tevens is het mogelijk per e-mail of SMS een notificatie te ontvangen bij elke gelukte betaling. [Mollie](https://www.mollie.com/) is hierdoor dus een perfecte partner op het gebied van iDEAL en is het dan ook niet verbazingwekkend dat [Mollie](https://www.mollie.com/) ondertussen op meer dan 30.000 websites iDEAL-betalingen mag verzorgen.

### Creditcard
[Creditcard](https://www.mollie.com/nl/payments/credit-card) is vrijwel de bekendste methode voor het ontvangen van betalingen met wereldwijde dekking. Doordat we onder andere de bekende merken Mastercard, VISA en American Express ondersteunen, zorgt dit direct voor veel potentiële kopers.

### Bancontact
[Bancontact](https://www.mollie.com/nl/payments/bancontact) maakt gebruik van een fysieke kaart die gekoppeld is aan tegoed op een Belgische bankrekening. Betalingen via Bancontact/Mister Cash zijn gegarandeerd en lijkt daarmee sterk op iDEAL in Nederland. Daarom is het uitermate geschikt voor uw webwinkel.

### SOFORT Banking
[SOFORT Banking](https://www.mollie.com/nl/payments/sofort) is één van de populairste betaalmethodes in Duitsland en actief in 11 landen. Betalingen zijn direct en niet storneerbaar, waarmee het sterk op het Nederlandse iDEAL lijkt. Daarom is het uitermate geschikt voor uw webwinkel.

### Overboekingen
[Overboekingen](https://www.mollie.com/nl/payments/bank-transfer) binnen de SEPA zone ontvangen via Mollie. Hiermee kun je betalingen ontvangen van zowel particulieren als zakelijke klanten in meer dan 35 Europese landen.

### PayPal
[PayPal](https://www.mollie.com/nl/payments/paypal) is wereldwijd een zeer populaire betaalmethode. In enkele klikken kunt u betalingen ontvangen via een bankoverschrijving, creditcard of het PayPal-saldo.

### Bitcoin
[Bitcoin](https://www.mollie.com/nl/payments/bitcoin) is een vorm van elektronisch geld. De bitcoin-euro wisselkoers wordt vastgesteld op het moment van de transactie waardoor het bedrag en de uitbetaling zijn gegarandeerd.

### paysafecard
[paysafecard](https://www.mollie.com/nl/payments/paysafecard) is de populairste prepaidcard voor online betalingen die veel door ouders voor hun kinderen wordt gekocht.

### KBC/CBC-Betaalknop
De [KBC/CBC-Betaalknop](https://www.mollie.com/nl/payments/kbc-cbc) is een online betaalmethode voor de klanten van de KBC en CBC, samen de grootste bank van België. KBC richt zich op Vlaanderen en CBC op Wallonië.

### Belfius Pay Button
[Belfius](https://www.mollie.com/nl/payments/belfius) is een van de grootste banken van België. Met de Belfius Pay Button voorziet de bank haar klanten van een eigen betaaloplossing.

### CartaSi
[CartaSi](https://www.mollie.com/nl/payments/cartasi) is een van de meest gebruikte betaalmethoden in Italië. Er zijn ruim 13 miljoen CartaSi-creditcards in circulatie en het is een van de meest gebruikte betaalmethoden in Italië. 

### Cartes Bancaires
[Cartes Bancaires](https://www.mollie.com/nl/payments/cartes-bancaires) zijn de meest gebruikte creditcards in Frankrijk, met meer dan 64 miljoen kaarten in circulatie. De kaarten zijn co-branded met Visa.

# Veel gestelde vragen #

**Ik heb alles ingesteld, maar de module verschijnt niet bij het afrekenen.**

* Controleer of de module staat ingeschakeld en of er een juiste API key staat ingesteld. Zie de installatie-instructies.
* Controleer of euro's als valuta staat ingesteld in uw winkel. Mollie ondersteunt alleen euro's.
* Controleer via "Geavanceerde parameters" -> "Prestatie" of "HTML minimaliseren" staat uigeschakeld.

**Moet ik ook een return- en / of webhook-URL instellen?**

Het is niet nodig een redirect URL of webhook in te stellen. Dat doet de module zelf automatisch bij elke order.

**De status van mijn bestelling wordt niet bijgewerkt**

Mollie stuurt een bericht aan je website wanneer de status van de betaling veranderd. Het kan zijn dat Mollie je website niet kon bereiken of dat je website de status niet heeft kunnen verwerken.

* Controleer in je [Mollie beheer](https://www.mollie.com/beheer/) of er gefaalde rapportages zijn. [Meer informatie](https://www.mollie.com/nl/support/post/ik-krijg-een-e-mail-over-gefaalde-http-rapportages-wat-nu/)
* Soms gaat er iets fout bij het aanmaken van de factuur. Controleer of de optie "Afbeelding voor het product inschakelen" uit staat in "Bestellingen" -> "Facturen" -> "Factuur opties" of in "Voorkeuren" -> "Bestellingen" -> "PDF instellingen".

# Wil je meewerken aan deze module? #

Wil je helpen om onze plugin voor thirty bees nog beter te maken? Wij staan open voor [pull requests](https://github.com/mollie/thirtybees/pulls?utf8=%E2%9C%93&q=is%3Apr) voor onze module. 

Maar wat denk je er over om bij een [technology driven organisatie](https://www.mollie.com/nl/blog/post/werken-bij-mollie-sfeer-kansen-en-mogelijkheden/) aan de slag te gaan? Mollie is altijd op zoek naar developers en system engineers. [Check onze vacatures](https://www.mollie.com/nl/jobs) of [neem contact met ons op](mailto:personeel@mollie.com).

# Licentie #
[BSD (Berkeley Software Distribution) License](http://www.opensource.org/licenses/bsd-license.php).
Copyright (c) 2013, Mollie B.V.

# Ondersteuning #

Heeft u problemen met de installatie of bevat de module volgens u een bug? Stuurt u dan een email 
naar info@mollie.com met een zo precies mogelijke omschrijving van het probleem.

![Powered By Mollie](https://www.mollie.com/images/badge-betaling-medium.png)
