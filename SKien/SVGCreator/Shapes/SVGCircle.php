<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element to draw a circle.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/circle
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
     * @see SVGCircle
     * @param float $x      The x position of the center of the circle.
     * @param float $y      The y position of the center of the circle.
     * @param float $r      The radius of the circle.
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