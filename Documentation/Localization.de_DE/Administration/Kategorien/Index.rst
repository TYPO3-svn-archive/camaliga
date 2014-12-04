..  include:: Images.txt

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


Kategorien
^^^^^^^^^^

- Diese Extension benutzt die normalen Typo3-Kategorien. Es gibt verschiedene Arten diese zu benutzen.
  Mit {content.categories} kann man die markierten Kategorien anzeigen.
  Mit {content.categoriesAndParents} kann man die markierten Kategorien und deren Mutter-Kategorie anzeigen.

- Weiterhin kann man diese Extension im Extension-Manager konfigurieren.
  Das ist nur von Bedeutung, wenn man mehrere Sprachen benutzt. Es gibt 2 Optionen:
  Benutze die Kategorie-Relationen der übersetzten Camaliga-Elemente oder der Original-Elemente.
  Es wird empfohlen, die Kategorie-Relationen der übersetzten Elemente zu ignorieren, weil es einen Typo3-Bug gibt.
  Typo3 verliert die Relationen zu den übersetzten Kategorien, wenn man ein übersetztes Camaliga-Element speichert.
  Wenn dieser Bug gefixt ist, kann die Extension wieder umkonfigurieren...

|img-30|

*Bild: Relationen der Kategorien*