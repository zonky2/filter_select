<?php
/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 *
 * @package    MetaModels
 * @subpackage FilterSelect
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace MetaModels\Filter\Setting;

/**
 * Attribute type factory for select filter settings.
 */
class SelectFilterSettingTypeFactory extends AbstractFilterSettingTypeFactory
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->setTypeName('select')
            ->setTypeIcon('system/modules/metamodelsfilter_select/html/filter_select.png')
            ->setTypeClass('MetaModels\Filter\Setting\Select')
            ->allowAttributeTypes();

        foreach (array(
            'select',
            'translatedselect',
            'text',
            'translatedtext',
            'tags',
            'translatedtags',
         ) as $attribute) {
            $this->addKnownAttributeType($attribute);
        }
    }
}
