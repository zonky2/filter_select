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
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

/**
 * Frontend filter
 */
$GLOBALS['METAMODELS']['filters']['select']['class'] = 'MetaModelFilterSettingSelect';
$GLOBALS['METAMODELS']['filters']['select']['image'] = 'system/modules/metamodelsfilter_select/html/filter_select.png';
$GLOBALS['METAMODELS']['filters']['select']['info_callback'] = array('TableMetaModelFilterSetting', 'infoCallback');
$GLOBALS['METAMODELS']['filters']['select']['attr_filter'][] = 'select';
$GLOBALS['METAMODELS']['filters']['select']['attr_filter'][] = 'text';