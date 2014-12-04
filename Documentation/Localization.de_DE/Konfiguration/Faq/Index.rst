

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

- Ich brauche mehr Konfigurationsmöglichkeiten! Was kann ich tun?

  Du kannst deine eigenen “settings” per TypoScript definieren und in den
  Templates benutzen! Hier ein Beispiel:

TypoScript:

::

   plugin.tx_camaliga.settings.myvar = 'showall'

HTML-Template / JavaScript:

::

   var myvar = {settings.myvar};

