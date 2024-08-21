<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

/**
 * Creates a linear gradient.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGLinearGradient extends SVGGradient
{
    /**
     * Creates a linear gradient.
     * @param float|string $x1
     * @param float|string $x2
     * @param float|string $y1
     * @param float|string $y2
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
     */
    public function __construct(float|string $x1 = null, float|string $x2 = null, float|string $y1 = null, float|string $y2 = null)
    {
        parent::__construct('linearGradient');

        $this->setAttribute('x1', "$x1");
        $this->setAttribute('x2', "$x2");
        $this->setAttribute('y1', "$y1");
        $this->setAttribute('y2', "$y2");
    }
}