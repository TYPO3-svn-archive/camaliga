

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


TypoScript-Referenz
^^^^^^^^^^^^^^^^^^^

- Hiermit kann man zahlreiche Einstellungen vornehmen.

=================================  =============  =================================================================================  ===========
Variable                           Datentyp       Beschreibung                                                                       Standard
=================================  =============  =================================================================================  ===========
view.templateRootPath              string         Pfad zu den Templates.                                                             EXT:...
                                                  Achtung: im templateRootPath muss noch der Ordner “Content” drin sein.

                                                  **Beispiel:**

                                                  ::

                                                     plugin.tx_camaliga.view.templateRootPath = fileadmin/template/files/
view.partialRootPath               string         Pfad zu den partials des Template.                                                 EXT:...
view.layoutRootPath                string         Pfad zu dem layout des Template.                                                   EXT:...
persistence.storagePid             int            Speicherort der Camaliga-Elemente. Kann auch beim Plugin angegeben werden.
features.rewrittenPropertyMapper   boolean        Benutze den neuen Property Mapper?                                                 1
settings.defaultStoragePids        String / int   Komma-separierte Liste von storage PIDs. Dies muss eine Untermenge von
                                                  storagePid sein. Macht nur bei einem erweiterten Template Sinn.

                                                  **Syntax:**

                                                  ::

                                                     [pid1],[pid2],[pid3]

                                                  **Beispiel:**

                                                  ::

                                                     plugin.tx_camaliga.settings.defaultStoragePids = 354,349
settings.defaultCatIDs             String / int   Standard-Kategorien. Nur Elemente mit dieser Kategorie werden
                                                  angezeigt. Kann vom Benutzer in einem erweiterten Template geändert
                                                  werden.

                                                  **Syntax:**

                                                  ::

                                                     [cat1],[cat2],[cat3]

                                                  **Beispiel:**

                                                  ::

                                                     plugin.tx_camaliga.settings.defaultCatIDs = 2,3
settings.listId                    int            ID der Seite für die Listenansicht.
settings.showId                    int            ID der Seite für die Einzelansicht.
settings.sortBy                    string         Sortieren nach?                                                                    sorting

                                                  **Syntax:**

                                                  ::

                                                     sorting | tstamp | title | zip | city | country | custom1 | custom2 | custom3
settings.sortOrder                 string         Sortierreihenfolge?                                                                asc

                                                  **Syntax:**

                                                  ::

                                                     asc | desc
settings.random                    boolean        Die Elemente zufällig sortieren?                                                   0

                                                  0: nein.

                                                  1: ja, jedes mal wenn der Cache geleert wird.
settings.onlyDistinct              boolean        Zeige nur eindeutige Elemente an?                                                  0

                                                  0: nein.

                                                  1: ja, zeige nur das übergeordnete Element an, wenn Kinder vorhanden sind
                                                  oder zeige ein Kind-Element, wenn das übergeordnete Element nicht
                                                  vorhanden ist.
overrideFlexformSettingsIfEmpty    boolean        Überschreibe die FlexForm-Einstellungen mit den TypoScript-                        1
                                                  Einstellungen, falls die FlexForm-Einstellung leer ist?

                                                  0: nein.

                                                  1: ja (funktioniert gut, außer bei den Checkbox-Einstellungen).
settings.img.width                 int            Breite eines Bildes. Kann im Template benutzt werden...                            700
settings.img.height                int            Höhe eines Bildes.                                                                 500
settings.img.thumbWidth            int            Thumbnail-Breite eines Bildes.                                                     195
settings.img.thumbHeight           int            Thumbnail-Höhe eines Bildes.                                                       139
settings.item.width                int            Breite eines (carousel-)Elementes.                                                 195
settings.item.height               int            Höhe eines (carousel-)Elementes.                                                   290
settings.item.padding              int            Padding eines (carousel-)Elementes.                                                0
settings.item.margin               int            Marging eines (carousel-)Elementes.                                                10
settings.item.items                int            Anzahl der sichtbaren Elemente.                                                    3
=================================  =============  =================================================================================  ===========

Beispiel
~~~~~~~~

Hier ein Beispiel mit einigen Einstellungen:

::

   plugin.tx_camaliga {
       view.templateRootPath = fileadmin/template/camaliga/
       settings.defaultCatIDs = 4,5
       settings.showId = 410
       settings.listId = 402
   }

