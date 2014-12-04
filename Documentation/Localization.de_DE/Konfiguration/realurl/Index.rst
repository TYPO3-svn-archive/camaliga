

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


realUrl
^^^^^^^

- Man kann diese Extension auch mit realUrl verwenden.

Beispiel
~~~~~~~~

Hier ein Beispiel für deine realurl-config-Datei:

::

  'postVarSets' => array(
    '_DEFAULT' => array(
    ...

	  'camaliga' => array( // darf nicht wie die seite heißen
	      array(
		  'GETvar' => 'tx_camaliga_pi1[action]',
	      ),
	      array(
		  'GETvar' => 'tx_camaliga_pi1[controller]',
	      ),
	      array(
		  'GETvar' => 'tx_camaliga_pi1[content]',
	      ),
	  ),

    ...
   ),
  ),