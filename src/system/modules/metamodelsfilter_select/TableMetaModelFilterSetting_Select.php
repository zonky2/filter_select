<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package    MetaModels
 * @subpackage FrontendFilter
 * @author     Christian de la Haye <service@delahaye.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */
if (!defined('TL_ROOT'))
{
	die('You cannot access this file directly!');
}


/**
 * Provides be-functionalities
 *
 * @package	   MetaModels
 * @subpackage FrontendFilter
 * @author     Christian de la Haye <service@delahaye.de>
 */
class TableMetaModelFilterSetting_Select extends Backend
{

	/**
	 * provide options for default selection
	 * @param object
	 * @return array
	 */
	public function getSelectDefault($objRow)
	{
		$return = array();

		if(!$objRow->activeRecord->attr_id)
		{
			return $return;
		}

		$objAttribSetting = $this->Database->prepare("SELECT * FROM tl_metamodel_attribute WHERE id=(SELECT attr_id FROM tl_metamodel_filtersetting WHERE id=?)")
			->execute($objRow->activeRecord->id);

		$arrAttribSetting = $objAttribSetting->fetchAssoc();

		$objAttribute = MetaModelAttributeFactory::createFromArray($objAttribSetting->row());

		$arrAttribute = $objAttribute->getItemDCA();
		
		return $arrAttribute['fields'][$arrAttribSetting['colname']]['options'];
	}
}

?>