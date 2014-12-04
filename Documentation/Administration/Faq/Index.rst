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

- What is the difference between a normal and an extended template?

  See chapter or FAQ above.

- How can I change the translations text? Here an TypoScript example:

  ::

     plugin.tx_camaliga._LOCAL_LANG.de.more = Zur Website

- How can I rename or hide some fields in the Backend?

  You can do that in the “Page TSConfig”. Here to 2 examples:

::

   TCEFORM.tx_camaliga_domain_model_content.custom2.disabled = 1
   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Datum:

|img-15|

*Image 13: You find this on the Ressources tab of a page*

