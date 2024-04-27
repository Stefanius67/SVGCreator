<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;


/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGLinearGradient extends SVGGradient
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
    public function __construct(float|string $x1, float|string $x2, float|string $y1, float|string $y2)
    {
        parent::__construct('linearGradient');

        $this->setAttribute('x1', "$x1");
        $this->setAttribute('x2', "$x2");
        $this->setAttribute('y1', "$y1");
        $this->setAttribute('y2', "$y2");
    }
}