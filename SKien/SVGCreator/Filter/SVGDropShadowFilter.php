<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

/**
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/line
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGDropShadowFilter extends SVGFilterEffect
{
    /**
     * @param float $dx
     * @param float $dy
     * @param float $deviation
     * @param string $strFloodColor
     * @param float $opacity
     */
    public function __construct(float $dx, float $dy, float $deviation = null, string $strFloodColor = null, float $opacity = null)
    {
        parent::__construct('feDropShadow');

        $this->setAttribute('dx', $dx);
        $this->setAttribute('dy', $dy);
        $this->setAttribute('stdDeviation', $deviation);
        $this->setAttribute('flood-color', $strFloodColor);
        $this->setAttribute('flood-opacity', $opacity);
    }
}