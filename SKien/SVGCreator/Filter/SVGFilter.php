<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\Filter\Effects\SVGEffect;

/**
 * Container element for several filter effects.
 *
 * A plain filter has no attributes. The result of a filter depends on the
 * efect(s) that are added to perform special operations with the input image
 * or it's alphachannel.
 * The `id` to reference a created filter does not necessarily have to be
 * set, as each filter automatically receives a unique ID when added to the
 * SVG defs by calling `SVG::addFilter()` if not already has been set.
 *
 * The default width and height of a image resulting from a filter is 120%.
 * (means, 10% 'margin' to the input image in each direction). If the result after
 * applying the filtereffects is more the size and/or position of the filter may
 * need to be adjusted.
 *
 * @see SVGAttributesTrait::setPos()
 * @see SVGAttributesTrait::setSize()
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/filter
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/width#filter
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/height#filter
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGFilter extends SVGElement
{
    /**
     * Creates the container for filter effects.
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/filter
     */
    public function __construct()
    {
        parent::__construct('filter');
    }

    /**
     * @param SVGEffect $oEffect
     * @param string $strResult
     */
    public function addEffect(SVGEffect $oEffect, string $strResult = null) : void
    {
        $this->add($oEffect);
        $oEffect->setAttribute('result', $strResult);
    }
}