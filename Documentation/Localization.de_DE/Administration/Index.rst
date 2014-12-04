

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


Administration
--------------

- Nachdem man sich für ein Layout entschieden hat, sollte man das HTML-
  Template und die CSS-Datei anpassen.

- Kopiere dazu diese 2 Ordner in einen Ordner im fileadmin-Verzeichnis:

  typo3conf\ext\camaliga\Resources\Private\Templates\Content

  typo3conf\ext\camaliga\Resources\Public\css

- Wenn du z.B. den Ordner fileadmin/ext/camaliga genannt hast, dann gibt
  den Pfad dazu mit TypoScript an:

::

   plugin.tx_camaliga.view.templateRootPath = fileadmin/ext/camaliga/

- Achtung: in diesem Ordner muss dann der Ordner “Content” drin liegen.

- Nun kann man das HTMl-Template bearbeiten. Welches? Das ist nicht
  schwer, da die Namen treffend gewählt sind. Falls das Template JS-
  oder CSS-Dateien enthält, kopiere die auch in den fileadmin-Ordner und
  binde sie via TypoScript ein. Sie werden nur zu Demo-Zwecken im
  Template eingebunden. Entferne sie dann aus dem Template.Bemerkung:
  man findet mehr Informationen zu jedem Template am Anfang eines
  Template. Weitere Infos findet man auch im Kapitel Tutorial.


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Html-templates/Index
   Template-variablen/Index
   Kategorien/Index
   DasBackend-modul/Index
   Faq/Index

