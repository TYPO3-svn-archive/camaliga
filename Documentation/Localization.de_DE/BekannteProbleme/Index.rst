

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


Bekannte Probleme
-----------------

- Wenn du die Felder latitude oder longitude benutzt, bekommst du oft diese Fehlermeldung:

  102: These fields are not properly updated in database: (latitude) Probably value mismatch with fieldtype.

  Du kannst diese Meldung ignorieren.

- Die Kategorien eines Elements werden nicht sortiert ausgegeben.

- Die Kategorie-Relationen der übersetzten Elemente sind bugy:
  `https://forge.typo3.org/issues/61923#change-233249
  <https://forge.typo3.org/issues/61923#change-233249>`_

- Es werden keine zugeordneten Kategorien nach einem Update auf Typo3 6.2 mehr angezeigt.
  Lösung: man muss das Update-Skript ausführen, um diesen Typo3-Bug zu beheben.

- Wenn du einen Bug findest, melde ihn unter TYPO3 Forge:
  `http://forge.typo3.org/projects/show/extension-camaliga
  <http://forge.typo3.org/projects/show/extension-camaliga>`_


