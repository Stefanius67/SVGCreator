<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

/**
 * This filter fills the filter subregion with the given color and opacity.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGBlendFilter extends SVGFilterEffect
{
    /**
     * This filter fills the filter subregion with the given color and opacity.
     * @param string $color
     * @param float $opacity
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feFlood
     */
    public function __construct(string $color, float $opacity)
    {
        parent::__construct('feFlood');

        $this->setAttribute('flood-color', $color);
        $this->setAttribute('flood-opacityin', $opacity);
    }
}