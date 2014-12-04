

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


Seiten-TSconfig
^^^^^^^^^^^^^^^

- Mittels der TypoScript-Konfiguration über Seiten-TSconfig kann man mehrere Layout für ein Template definieren.

Beispiel
~~~~~~~~

Hier werden 3 Layouts für ein Template definiert:

::

  tx_camaliga.templateLayouts {
    0 = Standard-Layout
    1 = Layout für die linke Spalte
    2 = Layout für die rechte Spalte
  }


- Man kann jede Nummer oder Beschreibung benutzen.
- Danach kann man über die FlexForms eins der Layouts auswählen.
- Zu guter letzt müssen die Layouts in einem beliebigen Template abgefragt werden.
  Die if-Abfrage gehört ins innere des Templates.

Beispiel
~~~~~~~~

Hier ein Beispiel mit 2 Layouts:

::

	<f:if condition="{settings.templateLayout} == 1">
		<f:then>
			<f:image src="/uploads/tx_camaliga/{content.image}" maxHeight="{settings.img.thumbHeight}" />
		</f:then>
		<f:else>
			<p>Telefon-Nr.: {content.phone}<br />
			Handy-Nr.: {content.mobile}<br />
			E-Mail: <a href="mailto:{content.email}">{content.email}</a></p>
		</f:else>
	</f:if>

- Weiterhin kann man die TSconfig benutzen, um Camaliga-Felder umzubennen oder zu verstecken. Ein Beispiel findet man im Tutorial.