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


Users manual
------------

- First you need to include the static typoscript template.: Template →
  Info/Modify → Includes → Static include (From extensions) → Camaliga.

- Now create a folder for the new elements. Change to that folder and
  into the list view. Create some elements:

|img-7|

*Image 5: Create new elements*

- There are several fields. You must fill out only the title. When done,
  add a new plugin to your page and select Camaliga.

- Select a template layout and make other settings:

|img-8|

*Image 6: Select a layout*

- Select the folder with the elements. If you don´t select something,
  the TypoScript setting is used. If there is no storagePid defined too,
  the current document will be used as storage pid.

|img-9|

*Image 7: Select the folder*

- Done. You can make some more settings via TypoScript, e.g. the image width:

|img-10|

*Image 8: Some TypoScript settings*

- See chapter Configuration for the TypoScript settings.

- If you want to use the enhanced features, then you must create some
  Typo3 categories. Note: the parent category is used as the description
  of the category. Example: you have a category “Astrolabium” that
  describes your element, then you must use a parent category too that
  describes that category. In this case: “Type”. See image:

|img-11|

*Image 9: Create a category*

|img-12|

*Image 10: How to use categories*

- Note: normally the categories are used as radio-button in the search.
  If you want to use checkboxes in the search, you need to write
  “checkbox” in the description of the parent category. Now you can use
  the categories in the camaliga-elements:

|img-13|

*Image 11: Use the categories*

- Another features is the parent-child-relation. This is important if
  you want to show on some pages only distinct elements (parents) and on
  a single page both elements. Otherwise you can use 2 different
  folders, but the relation has some other pros too.

|img-14|

*Image 12: Mother-Child-Relation*


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Faq/Index

