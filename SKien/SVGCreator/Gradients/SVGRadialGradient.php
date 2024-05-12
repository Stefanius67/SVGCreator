<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

/**
 * Creates a radial gradient.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/radialGradient
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGRadialGradient extends SVGGradient
{
    /**
     * Creates a radial gradient.
     * @param float|string $cx  x coordinate of the end circle of the radial gradient (Default value: 50%)
     * @param float|string $cy  y coordinate of the end circle of the radial gradient (Default value: 50%)
     * @param float|string $fr  radius of the start circle of the radial gradient (Default value: 0%)
     * @param float|string $fx  x coordinate of the start circle of the radial gradient (Default value: cx)
     * @param float|string $fy  y coordinate of the start circle of the radial gradient (Default value: cy)
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/radialGradient
     */
    public function __construct(
        float|string $cx = null,
        float|string $cy = null,
        float|string $fr = null,
        float|string $fx = null,
        float|string $fy = null)
    {
        parent::__construct('radialGradient');

        $this->setAttribute('cx', "$cx");
        $this->setAttribute('cy', "$cy");
        $this->setAttribute('fr', "$fr");
        $this->setAttribute('fx', "$fx");
        $this->setAttribute('fy', "$fy");
    }
}