<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * Effect creating a drop shadow of the input image.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDropShadow
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGDropShadowEffect extends SVGEffect
{
    /**
     * Effect creating a drop shadow of the input image.
     * @param float $dx
     * @param float $dy
     * @param float $deviation
     * @param string $strFloodColor
     * @param float $opacity
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feDropShadow
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