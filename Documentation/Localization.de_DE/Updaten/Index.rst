

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


Updaten auf Typo3 6.2
---------------------

Wenn du Kategorien unter Typo3 6.0 oder 6.1 benutzt hast, musst du ein
Update-Skript durchführen, wenn du auf Typo3 6.2 updatest.

- Gehe zum Erweiterungsmanager und suche die Extension Camaliga.

- Klicke auf das grüne Ausführen-Icon im rechten Bereich.

- Das Skript wird folgendes SQL-Statement durchführen:

  UPDATE sys_category_record_mm
  SET fieldname = 'categories'
  WHERE tablenames='tx_camaliga_domain_model_content' AND fieldname=''