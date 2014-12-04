

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

- Wie kann ich das Layout anpassen?

  Siehe Kapitel Administration.

- Was ist der Unterschied zwischen normalen und erweiterten Templates?

  Die erweiterten List- und Galerien-Templates beinhalten ein Suchformular:
  Sortierung und Einschränkungen (benutzt auch die Kategorien). Das
  erweiterte Single-Template zeigt noch die Google-Karte und ggf. das
  Eltern- bzw. die Kinder-Elemente.

- Es läuft nicht! Wo kann der Fehler liegen?

  Es kann mehrere Ursachen geben. Als erstes sollte man sich die JavaScript-Konsole ansehen.
  Wie man dahin kommt, ist bei jedem Browser anders. Die JavaScript-Konsole wird in der Regel etwas sagen.
  Daraus kann man z.B. schliessen, dass jQuery noch nicht geladen wurde oder das das benötigte jQuery-Plugin fehlt.
  Falls der Aufruf des jQuery-Plugins fehl schlägt, vergewissere dich davon, dass es schon geladen wurde.
  Beachte dabei, dass du manche jQuery-Plugins erst downloaden musst! Falls du jQuery
  erst im Footer lädst, musst du sämtliche JavaScripts aus den HTML-Templates auch in den Footer-Bereich verschieben.
  Falls die JavaScript-Konsole nichts ausspuckt, sollte man einen Blick in den HTML-Quelltext werfen.
  Falls dort keine Elemente zu sehen sind, wurde wahrscheinlich vergessen, den Ordner mit den Elementen auszuwählen.

- Es läuft, aber es sieht elendig aus! Was ist los?

  Falls du ein externes jQuery-Plugin benutzt, musst du dich mit deren Dokumentation auseinander setzen.
  Ansonsten kannst du mich um Rat fragen...