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


Benutzerhandbuch
----------------

- Als erstes sollte man das statische TypoScript hinzufügen: Template →
  Info/Bearbeiten → Enthält → Statische Templates einschließen (aus
  Erweiterungen) → Camaliga.

- Erzeuge nun einen Ordner für die neuen Elemente und wechsele zu diesem
  Ordner und in die Listen-Ansicht. Lege ein paar neue Elemente an:

|img-7|

*Abbildung 5: Lege neue Elemente an*

- Es gibt verschiedene Felder. Nur der Titel ist ein Pflichtfeld. Wenn
  fertig, lege ein neues Plugin auf einer Seite an und wähle dabei das
  Camaliga-Plug-In aus.

- Wähle ein Layout und mach noch ein paar weitere Einstellungen:

|img-8|

*Abbildung 6: Wähle ein Layout aus*

- Wähle den Ordner mit den Elementen. Wenn nichts gewählt wird, wird die
  TypoScript-Einstellung genommen. Falls auch dort keine storagePid
  gesetzt ist, wird das aktuelle Dokument als Speicherort verwendet.

|img-9|

*Abbildung 7: Wähle den Ordner*

- Fertig. Man kann mit TypoScript noch ein paar weitere Einstellungen
  vornehmen, etwa die Bild-Größe:

|img-10|

*Abbildung 8: Einige TypoScript-Einstellungen*

- Die TypoScript-Einstellungen werden im Kapitel Konfiguration
  beschrieben.

- Wenn du auch die erweiterten Features dieser Extension nutzen willst,
  musst du die Typo3-Kategorien benutzen. Beachte: die übergeordnete
  Kategorie wird dabei als Beschreibung der Kategorie benutzt. Beispiel:
  du hast eine Kategorie namens “Astrolabium”, dann sollte die
  übergeordnete Kategorie z.B. “Typ” heissen, da sie die Kategorie
  beschreibt. Siehe Bild:

|img-11|

*Abbildung 9: Erzeuge eine Kategorie*

|img-12|

*Abbildung 10: Wie man Kategorien benutzt*

- Beachte: normallerweise werden die Kategorien als radio-Buttons in der
  Suche angeboten. Wenn man sie als checkbox benutzen will, muss man bei
  der übergeordneten Kategorie “checkbox” bei Bemerkungen eintragen. Nun
  kann man die Kategorien in den Camaliga-Elementen benutzen:

|img-13|

*Abbildung 11: Benutze die Kategorien*

- Ein anderes Feature ist die Mutter-Kind-Beziehung. Das ist wichtig,
  wenn man auf manchen Seiten nur eindeutige Elemente anzeigen will und
  auf der Einzelansicht dann beide Elemente. Stattdessen könnte man
  natürlich auch 2 verschiedene Ordner benutzten, aber die Mutter-Kind-
  Beziehung ermöglicht auch noch weitere Schmanckerl.

|img-14|

*Abbildung 12: Mutter-Kind-Beziehung*


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Faq/Index
