<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FilterSelect
 * @author     Christian de la Haye <service@delahaye.de>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'MetaModels\Filter\Setting\Select' => 'system/modules/metamodelsfilter_select/MetaModels/Filter/Setting/Select.php',

	'MetaModelFilterSettingSelect'     => 'system/modules/metamodelsfilter_select/deprecated/MetaModelFilterSettingSelect.php'
));
