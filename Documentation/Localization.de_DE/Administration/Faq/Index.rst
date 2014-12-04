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


FAQ
^^^

- Was ist der Unterschied zwischen normalen und erweiterten Templates?

  Siehe bei den oberen FAQs oder dem vorherigen Kapitel nach.

- Wie kann ich Übersetzungstexte ändern? Hier ein TypoScript-Beispiel:

  ::

     plugin.tx_camaliga._LOCAL_LANG.de.more = Zur Website

- Wie kann ich Felder im Backend umbenennen oder verbergen?

  Das kann man in den “Seiten-TSConfig” machen. Hier 2 Beispiele:

::

   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Datum:
   TCEFORM.tx_camaliga_domain_model_content.custom2.disabled = 1

|img-15|

*Abbildung 13: Dies findet man im Ressources-Tab einer Seite*

