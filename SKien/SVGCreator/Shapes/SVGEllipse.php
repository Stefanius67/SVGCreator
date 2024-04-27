<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element to draw a ellipse.
 *
 * @see SVGEllipse::__construct
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#ellipse
 * @link https://www.w3schools.com/graphics/svg_ellipse.asp
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGEllipse extends SVGShape
{
    /**
     * Element to draw a ellipse.
     * @param float $x
     * @param float $y
     * @param float $rx
     * @param float $ry
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/ellipse
     */
    public function __construct(float $x, float $y, float $rx, float $ry, string $strStyleOrClass = null)
    {
        parent::__construct('ellipse', '', $strStyleOrClass);

        $this->setAttribute('cx', $x);
        $this->setAttribute('cy', $y);
        $this->setAttribute('rx', $rx);
        $this->setAttribute('ry', $ry);
    }
}