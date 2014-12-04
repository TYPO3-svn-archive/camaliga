

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

- You can use this extension with realUrl.

Example
~~~~~~~

Here an example for your realurl config file:

::

  'postVarSets' => array(
    '_DEFAULT' => array(
    ...

	  'camaliga' => array( // this key must be unique
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