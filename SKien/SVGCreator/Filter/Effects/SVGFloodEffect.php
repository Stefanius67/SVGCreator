<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This filter fills the filter subregion with the given color and opacity.
 *
 * > **Important** <br>
 * > Since the filter subpane size is set by default to 120% of the input image,
 * > it is recommended to either explicitly set the size of the filter to 100%
 * > or use this effect in combination with another filter (merge, blend, ...).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feFlood
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGFloodEffect extends SVGEffect
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
        $this->setAttribute('flood-opacity', $opacity);
    }
}