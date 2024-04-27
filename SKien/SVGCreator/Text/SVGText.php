<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Text;

use SKien\SVGCreator\SVGElement;

/**
 * Element that draws text. It's possible to apply a gradient, pattern, clipping
 * path, mask, or filter to <text>, like any other SVG graphics element.
 *
 * @see SVGText::__construct
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGText extends SVGElement
{
    /**
     * Element that draws text.
     * @param float|string $x
     * @param float|string $y
     * @param string $strText
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/text
     */
    public function __construct(float|string $x, float|string $y, string $strText, string $strStyleOrClass = null)
    {
        parent::__construct('text', $strText, $strStyleOrClass);

        $this->setAttribute('x', $x);
        $this->setAttribute('y', $y);
    }

    /**
     * Sets the font size.
     * @param string|float $size
     */
    public function setFontSize(string|float $size) : void
    {
        $this->setAttribute('font-size', $size);
    }

    /**
     * Sets the font weight.
     * @param string|float $weight
     */
    public function setFontWeight(string|float $weight) : void
    {
        $this->setAttribute('font-weight', $weight);
    }

    /**
     * Sets the vertical alignment of the text.
     * Valid values are
     * - SVG::ALIGN_START (default)
     * - SVG::ALIGN_MIDDLE
     * - SVG::ALIGN_END
     * @param string $strAlign
     */
    public function setTextAlign(string $strAlign) : void
    {
        $this->setAttribute('text-anchor', $strAlign);
    }

    /**
     * Sets the vertical alignment of the text.
     * Valid values are
     * - SVG::VALIGN_AUTO (default)
     * - SVG::VALIGN_MIDDLE
     * - SVG::VALIGN_HANGING
     * @param string $strVAlign
     */
    public function setVAlign(string $strVAlign) : void
    {
        $this->setAttribute('dominant-baseline', $strVAlign);
    }

    /**
     * Sets the rotation (in degrees) applied to each letter of the text.
     * @param float|string $length
     */
    public function setRotation(float|string $rotate) : void
    {
        $this->oPath->setAttribute('rotate', $rotate);
    }


    /**
     * Sets the width that the text must fit in.
     * @param float|string $length
     */
    public function setTextLength(float|string $length) : void
    {
        $this->oPath->setAttribute('textLength', $length);
    }

    /**
     * Sets, how the text should be compressed or stretched to fit the width defined
     * by the textLength attribute.
     * Valid values are
     * - SVG::LENGTH_ADJUST_SPACING (default)
     * - SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS
     * @param string $strAdjust
     */
    public function setLengthAdjust(string $strAdjust) : void
    {
        $this->oPath->setAttribute('lengthAdjust', $strAdjust);
    }

    /**
     * Shifts the text position relative from a previous text element.
     * @param float|string $cx
     * @param float|string $cy
     */
    public function shift(float|string $cx = null, float|string $cy = null) : void
    {
        $this->setAttribute('cx', $cx);
        $this->setAttribute('cy', $cy);
    }
}