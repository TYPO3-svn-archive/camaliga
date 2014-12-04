.. include:: Images.txt

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Tutorial
--------

- Nehmen wir mal an, du seist ein Immobilienhai und möchtest ein paar
  Wohnungen bzw. Häuser verkaufen oder vermieten. Mit dieser Extension
  kannst du deine Häuser auf verschiedene Art und Weise präsentieren.
  Auf der Homepage kannst du z.B. ein Karussell oder eine Gallerie mit
  den Highlights anzeigen. Auf einer Folgeseite kannst du eine
  Kartenansicht anbieten. Dazu dann noch eine Listenansicht mit einer
  Detailansicht. Wie das geht, verrät dieses Tutorial.

- Als erstes denke darüber nach, welche Felder du brauchst. In diesem
  Fall: Name, Beschreibung, Adresse, GEO-Daten, Preis, Grundfläche,
  Baujahr, Typ, Anzahl Zimmer, vorhandene Einrichtung. Jetzt sollte man
  sich überlegen, welche Felder sich immer ändern und welche man als
  Kategorie verwenden kann. Die Felder bis einschließlich Baujahr machen
  wir als Textfeld. Die danach als Kategorie. Wir nutzen nun custom1 als
  Preis, custom2 als Grundfläche und custom3 als Baujahr. Die Label
  werden so bei der “Seiten-TSConfig” angepasst:

::

   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Preis:
   TCEFORM.tx_camaliga_domain_model_content.custom2.label = Grundfläche:
   TCEFORM.tx_camaliga_domain_model_content.custom3.label = Baujahr:

- Als nächstes legen wir die Typo3-Kategorien an. Lege die Kategorien
  wie folgt in der Listenansicht an. Beachte dabei, dass bei der
  Kategorie “Vorhandene Einrichtung” unter Bemerkung “checkbox”
  eingetragen ist, damit bei der Suche bei dieser Kategorie eine
  checkbox statt ein Radio-Button benutzt wird.

|img-16|

*Abbildung 14: Kategorien für unsere Beispiel-Seiten*

- Nun kann man die camaliga-Elemente anlegen. Als erstes wird für jede
  Wohung/Haus ein Eintrag gemacht. Wenn man fertig ist, kann man dann
  noch zusätzliche Einträge anlegen, wo man nur den Titel und ein Bild
  angibt. Außerdem wählt man ganz unten das übergeordnete Element aus.
  Die zusätzlichen Elemente werden dann nur auf der Detail-Seite
  angezeigt. Grund: auf der Detail-Seite soll mehr als ein Bild
  angezeigt werden.

  .. ### BEGIN~OF~TABLE ###

  .. container:: table-row

     a
           |img-17|

           *Abbildung 15: Wähle ein übergeordnetes Element nur bei zusätzlichen
           Elementen aus*

     b
           |img-18|

           *Abbildung 16: Kategorien eines Hauses*


  .. ###### END~OF~TABLE ######

- Nun können wir die camaliga-Einträge präsentieren. Füge das statische
  TypoScript dieser Extension ein und füge das Plugin auf der Startseite
  ein. Für die Startseite wählen wir ein Karussell oder eine Gallerie.
  Dabei muss man ankreuzen: zeige nur eindeutige Elemente an, damit die
  zusätzlichen Elemente nicht mit angezeigt werden. Wenn nun nur
  Highlights auf der Startseite angezeigt werden sollen, kann man
  entweder 2 Ordner benutzen (einen für die Highlights und einen für die
  restlichen Elemente) oder man benutzt eine weitere Kategorie. Wenn man
  ein erweitertes Template benutzt, kann man diese zusätzliche Kategorie
  benutzen, sonst nicht. Wenn ja, dann kann man mit diesem TypoScript
  nur Elemente anzeigen, die eine bestimmte Kategorie besitzen (30 ist
  die ID von “ja”):

::

   plugin.tx_camaliga.settings.defaultCatIDs = 30

|img-19|

*Abbildung 17: Kategorie für die Sucheinschränkung*

- Nun werden nur noch Highlights auf der Startseite angezeigt. Im
  nächsten Schritt soll das Layout des Karussell oder der Gallerie
  angepasst werden. Kopiere dafür den Ordner
  typo3conf/ext/camaliga/Resources/Private/Templates/Content in dein
  fileadmin-Verzeichnis und teile den neuen Pfad mittels TypoScript mit
  (Content muss in diesem Ordner drin sein):

::

   plugin.tx_camaliga.view.templateRootPath = fileadmin/templates/Camaliga/

- Nun kann man die HTML-Dateien bearbeiten. Falls sie externe Dateien
  inkludiert, downloade die und kopiere sie ebenfalls ins fileadmin-
  Verzeichnis. Kopiere auch die inkludieren CSS-Dateien ins fileadmin-
  Verzeichnis und passe sie an.

- Im nächsten Schritt füge eine Google Karte, eine Listenansicht und
  eine Detail-Ansicht deiner Website hinzu. Für dieses Beispiel sollte
  man allerdings immer die extended/erweiterte Version wählen, da die
  dem Benutzer die Möglichkeit gibt, die Ergebnisse anders zu sortieren
  und nur Elemente mit bestimmten Kategorien anzuzeigen. Die folgenden
  Bilder zeigen eine erweiterte Listen- und Detail-Ansicht. Im Moment
  kann man den Link zur Einzelansicht nur mit TypoScript angeben und man
  muss noch pageUid zum Link im List-Template hinzufügen:

::

   plugin.tx_camaliga.settings.showId = 20

   <f:link.action action="showExtended" pageUid="{settings.showId}" arguments="{content : content}">

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   a
         |img-20|

         *Abbildung 18: Erweiterte Listenansicht mit Suchmöglichkeit*

   b
         |img-21|

         *Abbildung 19: Detailansicht mit einem zusätzlichem Kind-Element*


.. ###### END~OF~TABLE ######


