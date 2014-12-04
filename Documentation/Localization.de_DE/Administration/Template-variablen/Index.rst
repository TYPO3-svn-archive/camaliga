

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


Template-Variablen
^^^^^^^^^^^^^^^^^^

- Man kann einige Variablen in den Fluid-Templates benutzten. Die werden
  nun hier erklärt. Zuerst findet man die Variablen, die man in normalen
  Templates benutzen kann, dann diejenigen, die man zusätzlich in den
  erweiterten Templates benutzen kann.

=========================  ===========================================================
Variable                   Beschreibung
=========================  ===========================================================
uid                        UID des Plugin (Content-Element ID).
pid                        PID des Plugin (Seiten-ID).
storagePIDsArray           Array mit den PIDs der Datensatzsammlung.
storagePIDsComma           Komma-separierte Liste der PIDs der Datensatzsammlung.
contents                   Array mit den Camaliga-Elementen. Das Array enthält diese Variablen
                           (categories: siehe ListExtended.html):

                           title, shortdesc, longdesc, link, image, street, zip, city, country,
                           latitude, longitude, custom1, custom2, custom3, categories.
settings                   Siehe TypoScript-Einstellungen.
paddingItemWidth           Element-Breite + 2\*padding.
totalItemWidth             Element-Breite + 2\*padding + 2\*margin.
itemWidth                  Hängt von "addPadding" ab: Element-Breite ODER paddingItemWidth.
totalWidth                 n \* totalItemWidth.
paddingItemHeight          Element-Höhe + 2\*padding.
totalItemHeight            Element-Höhe + 2\*padding + 2\*margin.
itemHeight                 Hängt von "addPadding" ab: Element-Höhe ODER paddingItemHight.
=========================  ===========================================================


- Benutze ein erweitertes Template nur dann, wenn du diese zusätzlichen Variablen brauchst:

=========================  ===========================================================
Variable                   Beschreibung
=========================  ===========================================================
sortBy\_selected           Übergabevariable sortBy.
sortOrder\_selected        Übergabevariable sortOrder.
start                      Übergabevariable start.
defaultCatIDs              Settings.defaulCatIDs.
storagePIDsData            Array mit den Datensatzsammlungs-PIDs und der Info, welche davon ausgewählt sind. Siehe ListExtended.html.
categories                 Array mit allen benutzten Kategorien.
categoriesAndParents       Array mit allen benutzten Kategorien und den übergeordneten Kategorien. Siehe ListExtended.html.
=========================  ===========================================================
