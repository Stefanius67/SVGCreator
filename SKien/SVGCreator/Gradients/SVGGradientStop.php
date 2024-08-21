<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

use SKien\SVGCreator\SVGElement;

/**
 * Stop element for a gradient definition.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGGradientStop extends SVGElement
{
    /**
     * Sets a color and its position for a gradient definition.
     * @param float|string $offset
     * @param string $strColor
     * @param float|string $opacity
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/stop
     */
    public function __construct(float|string $offset, string $strColor, float|string $opacity = null)
    {
        parent::__construct('stop');

        $this->setAttribute('offset', "$offset");
        $this->setAttribute('stop-color', "$strColor");
        $this->setAttribute('stop-opacity', "$opacity");
    }
}