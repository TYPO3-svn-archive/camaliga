

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


TypoScript-Reference
^^^^^^^^^^^^^^^^^^^^

- Here you can make some settings.

=================================  =============  =================================================================================  ===========
Property                           Data type      Description                                                                        Default
=================================  =============  =================================================================================  ===========
view.templateRootPath              string         Path to the main template.                                                         EXT:...
                                                  Note: in the templateRootPath must be the the folder “Content”.

                                                  **Example:**

                                                  ::

                                                     plugin.tx_camaliga.view.templateRootPath = fileadmin/template/files/
view.partialRootPath               string         Path to the partials of the template.                                              EXT:...
view.layoutRootPath                string         Path to the layout template.                                                       EXT:...
persistence.storagePid             int            Storage PID of the Camaliga elements. Can be defined by the plugin too.
features.rewrittenPropertyMapper   boolean        Use the rewritten property mapper?                                                 1
settings.defaultStoragePids        String / int   Comma seperated list of storage pids. This must be a subset of the
                                                  storagePids. Makes only sense if you use an extended template.

                                                  **Syntax:**

                                                  ::

                                                     [pid1],[pid2],[pid3]

                                                  **Example:**

                                                  ::

                                                     plugin.tx_camaliga.settings.defaultStoragePids = 354,349
settings.defaultCatIDs             String / int   Default categories. Only elements with this category will be shown.
                                                  Can be changed in extended templates by the user.

                                                  **Syntax:**

                                                  ::

                                                     [cat1],[cat2],[cat3]

                                                  **Example:**

                                                  ::

                                                     plugin.tx_camaliga.settings.defaultCatIDs = 2,3
settings.listId                    int            ID of the list page.
settings.showId                    int            ID of the single page.
settings.sortBy                    string         Sort by?                                                                           sorting

                                                  **Syntax:**

                                                  ::

                                                     sorting | tstamp | title | zip | city | country | custom1 | custom2 | custom3
settings.sortOrder                 string         Order by?                                                                          asc

                                                  **Syntax:**

                                                  ::

                                                     asc | desc
settings.random                    boolean        Shuffle elements (random order, cached)?                                           0

                                                  0: no.

                                                  1: yes, shuffle the elements every time the cache is cleared.
settings.onlyDistinct              boolean        Show only distinct entries?                                                        0

                                                  0: no.

                                                  1: yes, show only the parent element when there are childs available or show a
                                                  child when there is no parent available.
overrideFlexformSettingsIfEmpty    boolean        Override FlexForm settings with TypoScript settings if the FlexForm                1
                                                  settings are empty?

                                                  0: no.

                                                  1: yes (works good, except for checkboxes).
settings.img.width                 int            Width of the images. Can be used in the template.                                  700
settings.img.height                int            Height of the images. Can be used in the template.                                 500
settings.img.thumbWidth            int            Thumbnail width of the images. Can be used in the template.                        195
settings.img.thumbHeight           int            Thumbnail height of the images. Can be used in the template.                       139
settings.item.width                int            Width of an (carousel-)item.                                                       195
settings.item.height               int            Height of an (carousel-)item.                                                      290
settings.item.padding              int            Padding of an (carousel-)item.                                                     0
settings.item.margin               int            Marging of an (carousel-)item.                                                     10
settings.item.items                int            Number of visible items.                                                           3
=================================  =============  =================================================================================  ===========

Example
~~~~~~~

Here an example with some settings:

::

   plugin.tx_camaliga {
       view.templateRootPath = fileadmin/template/camaliga/
       settings.defaultCatIDs = 4,5
       settings.showId = 410
       settings.listId = 402
   }

