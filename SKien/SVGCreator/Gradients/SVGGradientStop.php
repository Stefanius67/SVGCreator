<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

use SKien\SVGCreator\SVGElement;

/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGGradientStop extends SVGElement
{
    /**
     * Creates a radial gradient.
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
     *
     * @param float|string $x1
     * @param float|string $x2
     * @param float|string $y1
     * @param float|string $y2
     */
    public function __construct(float|string $offset, string $strColor, float|string $opacity = null)
    {
        parent::__construct('stop');

        $this->setAttribute('offset', "$offset");
        $this->setAttribute('stop-color', "$strColor");
        $this->setAttribute('stop-opacity', "$opacity");
    }
}