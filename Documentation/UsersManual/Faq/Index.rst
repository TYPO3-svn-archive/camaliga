

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

- How can I customize the layout?

  See chapter administration.

- What is the difference between a normal and an extended template?

  The extended list- and gallery-templates contains a search form: sorting and restriction (uses the categories too).
  The extended single-template displays a google map and the parent or child elements too.
  Note: the extended version is not so fast as the normal version. Use it only if you need it.

- Its not running! Whats wrong?

  There could be more reasons. First you should take a look at the JavaScript console. What does it say?
  If the call to the jQuery plugin fails: is it allready loaded? Note that you must download external jQuery plugins
  first. If you are loading jQuery only in the footer of your page, you must move all the JavaScript from the HTML
  templates to the footer too!
  If the console says nothing, then take a look at the HTML source code.
  If there are no elements you may have forgot to select the folder with the elements in the plugin...

- It runs, but it looks ugly! Whats wrong?

  If you are using an external jQuery plugin, you must read that documentation carefully.
  Otherwise you can ask me...