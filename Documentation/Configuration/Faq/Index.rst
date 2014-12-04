

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

- I need more options/settings! What can I do?

  You can define your own settings via TypoScript and you can use them in your templates! Here an example:

TypoScript:

::

   plugin.tx_camaliga.settings.myvar = 'showall'

HTML-Template / JavaScript:

::

   var myvar = {settings.myvar};

