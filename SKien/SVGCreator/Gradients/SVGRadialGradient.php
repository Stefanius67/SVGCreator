<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;


/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGRadialGradient extends SVGGradient
{
    /**
     * Creates a radial gradient.
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/radialGradient
     *
     * @param float|string $cx
     * @param float|string $cy
     * @param float|string $fr
     * @param float|string $fx
     * @param float|string $fy
     */
    public function __construct(float|string $cx, float|string $cy, float|string $fr, float|string $fx, float|string $fy)
    {
        parent::__construct('radialGradient');

        $this->setAttribute('cx', "$cx");
        $this->setAttribute('cy', "$cy");
        $this->setAttribute('fr', "$fr");
        $this->setAttribute('fx', "$fx");
        $this->setAttribute('fy', "$fy");
    }
}