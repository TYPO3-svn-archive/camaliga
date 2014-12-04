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


Tutorial
--------

- You are a property shark and you want to sell or rent flats or houses.
  You want to show a carousel or a gallery with your highlights on your
  start page. On other pages you want to show a map and a list view with
  single views. This tutorial show you how you can do that.

- First, think about the fields you need. In this example: Name,
  description, address, GEO-data, price, floor space, build year, type,
  number of rooms, facility. For the last 3 fields we use categories for
  the other fields we use textfields. Now we rename the custom fields in
  the “Page TSConfig”:

::

   TCEFORM.tx_camaliga_domain_model_content.custom1.label = Preis:
   TCEFORM.tx_camaliga_domain_model_content.custom2.label = Grundfläche:
   TCEFORM.tx_camaliga_domain_model_content.custom3.label = Baujahr:

- Now we create TYPO3 categories. Go to the list view and create some
  categories. Note: if you want to use checkboxes in the search, you
  need to write “checkbox” in the parent category. See image below.

|img-16|

*Image 14: Categories for our example page*

- Now you can create some camaliga-entries. First create a entry for
  every house/flat. When you are done you can create additional entries
  for the existing entries. In that case fill out only the title and the
  image. Finally choose the parent-entry of this additional entry. The
  additional entries will be shown only at the single-page-view. Reason:
  you want to show more than one image on the detail-page.

  .. ### BEGIN~OF~TABLE ###

  .. container:: table-row

     a
           |img-17|

           *Image 15: Select a parent element only for additional elements*

     b
           |img-18|

           *Image 16: Categories of a house*

  .. ###### END~OF~TABLE ######

- Now we can present our camaliga-entries. Include the static TypoScript
  of this extension and add this plugin to your start page. For the
  start page select a carousel or a gallery. Therefore you need to check
  the checkbox: show only distinct entries, because we don´t want to
  show the additional entries there. If you want to display only some
  highlights on your start page, you can use two folders (one for the
  highlights and one for the rest) or you can use a category. If you are
  using a extended template, you can use that category otherwise not. If
  yes, you can show only elements with a specific category with this
  TypoScript (30 is the ID of “ja”):

::

   plugin.tx_camaliga.settings.defaultCatIDs = 30

|img-19|

*Image 17: Category for the search restriction*

- Now you see only some highlights on your start page. In the next step
  you want to customize the layout of the carousel or gallery. Therefore
  copy the folder
  typo3conf/ext/camaliga/Resources/Private/Templates/Content to you
  fileadmin-folder. Change the path to the template with this TypoScript
  (Content must be in that folder):

::

   plugin.tx_camaliga.view.templateRootPath = fileadmin/templates/Camaliga/

- Now you can edit the files. If the template includes external files
  please download them and copy them to the fileadmin-folder too. Copy
  the included CSS-files to the fileadmin-folder too and include that
  edited files.

- In the next step you can add a google map, a list view and a single
  view to your page. For this example site choose in every case the
  extended-version of that template. The extended template gives the
  user the possibility to change the sorting fields/order and allows him
  to search elements with specific categories. The images below shows
  you an extended list view and an extended single view. Currently you
  have to specify the link to the single page via TypoScript and you
  need to add pageUid to the link in the List-template:

::

   plugin.tx_camaliga.settings.showId = 20

   <f:link.action action="showExtended" pageUid="{settings.showId}" arguments="{content : content}">

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   a
         |img-20|

         *Image 18: Extended list view with search options*

   b
         |img-21|

         *Image 19: Detail view with an addiotional child-element*


.. ###### END~OF~TABLE ######
