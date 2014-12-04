

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


Page TSconfig
^^^^^^^^^^^^^

- You can use the Page TSconfig to define some template layouts.

Example
~~~~~~~

Here an example with 3 layouts for your templates:

::

  tx_camaliga.templateLayouts {
    0 = Standard-Layout
    1 = Layout for the left column
    2 = Layout for the right column
  }


- You can use every number and description for the layouts.
- Now you can select a layout in the FlexForm of every page.
- Finally you can use now different layouts in your templates.

Example
~~~~~~~

Here an example for a template (extract) with 2 layouts:

::

	<f:if condition="{settings.templateLayout} == 1">
		<f:then>
			<f:image src="/uploads/tx_camaliga/{content.image}" maxHeight="{settings.img.thumbHeight}" />
		</f:then>
		<f:else>
			<p>Phone: {content.phone}<br />
			Mobile: {content.mobile}<br />
			Email: <a href="mailto:{content.email}">{content.email}</a></p>
		</f:else>
	</f:if>

- Furthermore you can use TSconfig to rename or hide camaliga-fields. You find an example in the Tutorial.