<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element to draw a line.
 *
 * @see SVGLine::__construct
 *
 * @link https://www.w3schools.com/graphics/svg_line.asp
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#line
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGLine extends SVGShape
{
    /**
     * Element to draw a line.
     * @param float $x1
     * @param float $x2
     * @param float $y1
     * @param float $y2
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/line
     */
    public function __construct(float $x1, float $x2, float $y1, float $y2, string $strStyleOrClass = null)
    {
        parent::__construct('line', '', $strStyleOrClass);

        $this->setAttribute('x1', $x1);
        $this->setAttribute('x2', $x2);
        $this->setAttribute('y1', $y1);
        $this->setAttribute('y2', $y2);
    }
}