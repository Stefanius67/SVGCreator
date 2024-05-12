<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGDropShadowEffect;

/**
 * Simple filter that uses the DropShaddowEffect.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGDropShadowFilter extends SVGFilter
{
    /**
     * Simple filter that uses the DropShaddowEffect.
     * @param float $dx
     * @param float $dy
     * @param float $deviation
     * @param string $strFloodColor
     * @param float $opacity
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDropShadow
     */
    public function __construct(float $dx, float $dy, float $deviation = null, string $strFloodColor = null, float $opacity = null)
    {
        parent::__construct();
        $this->addEffect(new SVGDropShadowEffect($dx, $dy, $deviation, $strFloodColor, $opacity));
    }
}