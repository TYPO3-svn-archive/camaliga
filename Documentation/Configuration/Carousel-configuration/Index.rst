

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


Carousel-Configuration
^^^^^^^^^^^^^^^^^^^^^^

- This extension comes with its own jQuery carousel plugin. All other
  jQuery-Plugins must be downloaded and copied into the fileadmin-
  folder. The onboard plugin is a basic carousel with some options. I
  will describe them here. You can use the jQuery-plugin twice if you
  wand to animate the image and text separated. The
  CarouselSeparated.html templates does that. “.camaliga” must be
  specified for each ul-element with the li-elements of Camaliga.

=====================  ===========  ==========================================================  ===========
Property               Data type    Description                                                 Default
=====================  ===========  ==========================================================  ===========
auto\_slide            boolean      0: no.                                                      0

                                    1: yes, automatic sliding.
hover\_pause           boolean      0: no.                                                      0

                                    1: yes, pause the automatic sliding on mouse hover.
auto\_slide\_seconds   int          Automatic sliding after … milliseconds.                     7500
infinitive             boolean      0: no.                                                      0

                                    1: yes, but you need in this case at least n+2 elements
                                    (n: number of visible elements)!
item\_width            int          Width of an element: width + padding + margin.              0
                                    You must specify this only if the padding or margin of
                                    the li-element is >0. Otherwise the plugin calculates
                                    the width automatic.
li\_name               string       Normally the plugin gets all li-elements of the specified   li
                                    ul-element. If you have other ul-elements in your
                                    li-element, you must use a class for the li-elements with
                                    the camaliga-elements and you must tell the plugin the
                                    name of that class.
left\_scroll           string       Class or ID of the DIV element with the left scroll arrow.
                                    This is needed if infinitive is 0 and if you want to
                                    display an inactive arrow on the beginning of the
                                    carousel. The plugin adds the class “camaliga\_first” to
                                    this div if the first element is shown left.
right\_scroll          string       Class or ID of the DIV element with the right scroll
                                    arrow. This is needed if infinitive is 0 and if you want
                                    to display an inactive arrow on the end of the carousel.
                                    The plugin adds the class “camaliga\_last” to this div if
                                    the last element is shown right.
=====================  ===========  ==========================================================  ===========


Example
~~~~~~~

Here an example with some settings:

::

   $('#carousel_ul').camaliga({
           auto_slide: 0,
           hover_pause: 0,
           auto_slide_seconds: 5000,
           infinite: 0,
           item_width: 215,
           li_name: 'li.carousel_li',
           left_scroll: '#left_scroll',
           right_scroll: '#right_scroll'
   });

