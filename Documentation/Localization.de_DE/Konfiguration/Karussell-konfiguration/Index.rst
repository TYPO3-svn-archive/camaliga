

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


Karussell-Konfiguration
^^^^^^^^^^^^^^^^^^^^^^^

- Diese Extension besitzt ein eigenes jQuery Karussel-Plugin. Alle
  anderen jQuery-Plugins muss man erst downloaden und ins fileadmin-
  Verzeichnis kopieren. Beim onboard plugin handelt es sich um ein
  einfaches Karusell mit einigen Einstellungen. Die werde ich hier
  beschreiben. Man kann das jQuery-Plugin auch zwei mal gleichzeitig
  benutzen, wenn man das Bild getrennt vom Text animieren will. Im
  CarouselSeparated.html Template wird das gemacht. “.camaliga” muss
  dabei für jedes ul-Element mit li-Elementen von Camaliga benutzt
  werden.

=====================  ===========  ==========================================================  ===========
Property               Data type    Description                                                 Default
=====================  ===========  ==========================================================  ===========
auto\_slide            boolean      0: nein.                                                    0

                                    1: ja, automatisch weiter sliden.
hover\_pause           boolean      0: nein.                                                    0

                                    1: ja, stoppe das automatische weiter sliden bei on
                                    mouse hover.
auto\_slide\_seconds   int          Automatisch weiter sliden nach … Millisekunden.             7500
infinitive             boolean      0: nein.                                                    0

                                    1: ja, das Karussell ist unendlich und startet am Ende
                                    von vorne. Man beachte, dass man in diesem Fall
                                    mindestens n+2 Elemente braucht (n: Anzahl der
                                    sichtbaren Elemente).
item\_width            int          Breite eines Elements: width + padding + margin.            0
                                    Man muss diese Angabe nur machen, wenn man beim
                                    li-Element padding oder margin>0 gesetzt hat.
                                    Andernfalls wird die Breite automatisch berechnet.
li\_name               string       Normallerweise holt sich das Plugin alle li-Elemente        li
                                    des angegeben ul-Elements. Wenn man nun aber auch im
                                    li-Element ul-li-Elemente hat, muss man dem li-Elememt
                                    mit den Camaliga-Element eine class zuweisen
                                    und diesen Namen dem Plugin mitteilen.
left\_scroll           string       Class oder ID des DIV-Elements des nach links zeigenden
                                    Pfeils. Dies wird nur dann benötigt, wenn infinitive
                                    gleich 0 ist und wenn man dann am Anfang des Karussells
                                    inaktive Pfeile darstellen will. Das Plugin fügt dann
                                    die Class “camaliga\_first” zu diesem DIV-Element hinzu,
                                    wenn das erste Element links angezeigt wird.
right\_scroll          string       Class oder ID des DIV-Elements des nach rechts zeigenden
                                    Pfeils. Dies wird nur dann benötigt, wenn infinitive
                                    gleich 0 ist und wenn man dann am Ende des Karussells
                                    inaktive Pfeile darstellen will. Das Plugin fügt dann die
                                    Class “camaliga\_last” zu diesem DIV-Element hinzu, wenn
                                    das letzte Element rechts angezeigt wird.
=====================  ===========  ==========================================================  ===========


Beispiel
~~~~~~~~

Hier ein Beispiel mit einigen Einstellungen:

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

