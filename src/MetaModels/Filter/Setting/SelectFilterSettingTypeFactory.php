<?php

/**
 * This file is part of MetaModels/filter_select.
 *
 * (c) 2012-2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage FilterSelect
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/filter_select/blob/master/LICENSE LGPL-3.0
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
