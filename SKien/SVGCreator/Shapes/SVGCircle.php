<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element to draw a rect.
 *
 * @see SVGCircle::__construct
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#circle
 * @link https://www.w3schools.com/graphics/svg_circle.asp
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGCircle extends SVGShape
{
    /**
     * Element to draw a circle.
     * @param float $x
     * @param float $y
     * @param float $r
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/circle
     */
    public function __construct(float $x, float $y, float $r, string $strStyleOrClass = null)
    {
        parent::__construct('circle', '', $strStyleOrClass);

        $this->setAttribute('cx', $x);
        $this->setAttribute('cy', $y);
        $this->setAttribute('r', $r);
    }
}