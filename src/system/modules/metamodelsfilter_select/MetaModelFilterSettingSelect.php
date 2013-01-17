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
 * Filter "select field" for FE-filtering, based on filters by the meta models team.
 *
 * @package	   MetaModels
 * @subpackage FrontendFilter
 * @author     Christian de la Haye <service@delahaye.de>
 */
class MetaModelFilterSettingSelect extends MetaModelFilterSetting
{
	/**
	 * {@inheritdoc}
	 */
	protected function getParamName()
	{
		if ($this->get('urlparam'))
		{
			return $this->get('urlparam');
		}

		$objAttribute = $this->getMetaModel()->getAttributeById($this->get('attr_id'));
		if ($objAttribute)
		{
			return $objAttribute->getColName();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function prepareRules(IMetaModelFilter $objFilter, $arrFilterUrl)
	{
		$objMetaModel = $this->getMetaModel();
		$objAttribute = $objMetaModel->getAttributeById($this->get('attr_id'));
		$strParamName = $this->getParamName();
		$strParamValue = $arrFilterUrl[$strParamName];

		if ($objAttribute && $strParamName && $strParamValue)
		{
			switch($objAttribute->get('type'))
			{
				case 'select':
					$objQuery = Database::getInstance()->prepare(sprintf(
						'SELECT id FROM %s WHERE %s=(SELECT %s FROM %s WHERE %s=?)',
						$this->getMetaModel()->getTableName(),
						$objAttribute->getColName(),
						$objAttribute->get('select_id'),
						$objAttribute->get('select_table'),
						$objAttribute->get('select_alias')
						))
						->execute($strParamValue);
					break;

				default:
					$objQuery = Database::getInstance()->prepare(sprintf(
						'SELECT id FROM %s WHERE %s=?',
						$this->getMetaModel()->getTableName(),
						$objAttribute->getColName()
						))
						->execute(urldecode($strParamValue));
					break;
			}

			$arrIds = $objQuery->fetchEach('id');

			$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList($arrIds));
			return;
		}

		$objFilter->addFilterRule(new MetaModelFilterRuleStaticIdList(NULL));
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameters()
	{
		return ($strParamName = $this->getParamName()) ? array($strParamName) : array();
	}


	/**
	 * {@inheritdoc}
	 */
	public function getParameterDCA()
	{
		$objMetaModel = $this->getMetaModel();
		$objAttribute = $objMetaModel->getAttributeById($this->get('attr_id'));
		$arrOptions = $objAttribute->getFilterOptions();

		if($this->get('onlyused'))
		{
			if($objAttribute->get('type')=='text')
			{
				// unset all options
				unset($arrOptions);

				// get filtered data
				$objFilter = $objMetaModel->prepareFilter($this->get('fid'), $_GET);
				$objItems = $objMetaModel->findByFilter($objFilter, $objAttribute->getColname(), 0, 0, 'ASC', array($objAttribute->getColname()));
				$arrItems = $objItems->parseAll();
	
				// re-set only possible options
				foreach($arrItems as $arrItem)
				{
					$arrOptions[urlencode($arrItem['raw'][$objAttribute->getColname()])] = $arrItem['raw'][$objAttribute->getColname()];
				}
			}
			else
			{
				foreach($arrOptions as $key=>$val)
				{
					if(count($objAttribute->searchFor($key)) < 1)
					{
						unset($arrOptions[$key]);
					}
				}
			}
		}

		return array(
			$this->getParamName() => array
			(
				'label'     => array(
					($this->get('label') ? $this->get('label') : $objAttribute->getName()),
					'GET: '.$this->get('urlparam')
					),
				'inputType' => 'select',
				'options'   => $arrOptions,
				'eval'      => array(
					'includeBlankOption' => ($this->get('blankoption') ? true : false), 
					'colname'            => $objAttribute->getColname(),
					'urlparam'           => $this->get('urlparam'),
					'onlyused'           => $this->get('onlyused'),
					'onlypossible'       => $this->get('onlypossible'),
					'template'           => $this->get('template'),
					)
			)
		);
	}
}

?>