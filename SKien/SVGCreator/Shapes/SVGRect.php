<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element to draw a rect.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/rect
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#rect
 * @link https://www.w3schools.com/graphics/svg_rect.asp
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGRect extends SVGShape
{
    /**
     * Element to draw a rect.
     * @param float $x
     * @param float $y
     * @param float $width
     * @param float $height
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/rect
     */
    public function __construct(float $x, float $y, float $width, float $height, string $strStyleOrClass = null)
    {
        parent::__construct('rect', '', $strStyleOrClass);

        $this->setAttribute('x', $x);
        $this->setAttribute('y', $y);
        $this->setAttribute('width', $width);
        $this->setAttribute('height', $height);
    }

    /**
     * @param float $rx
     * @param float $ry
     */
    public function setCornerRadius(float $rx, float $ry = null) : void
    {
        $this->setAttribute('rx', $rx);
        $this->setAttribute('ry', $ry ?? $rx);
    }
}