

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


Template variables
^^^^^^^^^^^^^^^^^^

- You can use some variables in the Fluid template. You find an
  explanation here. First you find the variables available in the normal
  templates, then those you can use additional in the extended
  templates.

=========================  ===========================================================
Variable                   Description
=========================  ===========================================================
uid                        UID of the plugin (content element ID).
pid                        PID des Plugin (Seiten-ID).
storagePIDsArray           Array with this storage PIDs.
storagePIDsComma           Comma separated list of the storage PIDs.
contents                   Array with the camaliga-elements. The Array containes this
                           variables (categories: see ListExtended.html):

                           title, shortdesc, longdesc, link, image, street, zip, city, country,
                           latitude, longitude, custom1, custom2, custom3, categories.
settings                   See TypoScript settings.
paddingItemWidth           Item width + 2\*padding.
totalItemWidth             Item width + 2\*padding + 2\*margin.
itemWidth                  Depends on "addPadding": item with OR paddingItemWidth.
totalWidth                 n \* totalItemWidth.
paddingItemHeight          Item hight + 2\*padding.
totalItemHeight            Item hight + 2\*padding + 2\*margin.
itemHeight                 Depends on "addPadding": item hight OR paddingItemHight.
=========================  ===========================================================


- Use an extended template only if you need this additional variables:

=========================  ===========================================================
Variable                   Description
=========================  ===========================================================
sortBy\_selected           Argument sortBy.
sortOrder\_selected        Argument sortOrder.
start                      Argument start.
defaultCatIDs              Settings.defaulCatIDs.
storagePIDsData            Array with the storage PIDs and the information about which are selected. See ListExtended.html.
categories                 Array of all used categories.
categoriesAndParents       Array of all used categories and their parent category. See ListExtended.html.
=========================  ===========================================================
