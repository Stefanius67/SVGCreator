<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Text;

use SKien\SVGCreator\SVGElement;

/**
 * Element that draws text.
 *
 * It's possible to apply a gradient, pattern, clipping
 * path, mask, or filter to a text element, like any other SVG graphics element.
 *
 * The alignment of the text relative to the given position can be set with the
 * `setTextAlign()`and `setVAlign()` methods.
 *
 * The adjustment of the text glyphs can be controled by setting the text length
 * and the glyph adjustment.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/textPath
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Texts#textpath
 * @link https://www.w3schools.com/graphics/svg_textpath.asp
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGText extends SVGElement
{
    /** valid values to add text align to style (!! not to use with setTextAlign!!)    */
    public const STYLE_ALIGN_START     = 'text-anchor: start; ';
    public const STYLE_ALIGN_MIDDLE    = 'text-anchor: middle; ';
    public const STYLE_ALIGN_END       = 'text-anchor: end; ';

    /** valid values to add text vertical align to style (!! not to use with setVAlign!!)   */
    public const STYLE_VALIGN_AUTO     = 'dominant-baseline: auto; ';
    public const STYLE_VALIGN_MIDDLE   = 'dominant-baseline: middle; ';
    public const STYLE_VALIGN_HANGING  = 'dominant-baseline: hangin; ';

    /** valid values for the `setTextRendering()` method   */
    public const RENDER_AUTO                = 'auto';
    public const RENDER_OPTIMIZE_SPEED      = 'optimizeSpeed';
    public const RENDER_OPTIMIZE_LEGIBILITY = 'optimizeLegibility';
    public const RENDER_GEOMETRIC_PRECISION = 'geometricPrecision';

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
        if (strpos($strAlign, ':') !== false) {
            // typical missuse of one of the const self::STYLE_ALIGN_xxx
            trigger_error('invalid value for setTextAlign: ' . $strAlign, E_USER_WARNING);
        }
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
        if (strpos($strVAlign, ':') !== false) {
            // typical missuse of one of the const self::STYLE_VALIGN_xxx
            trigger_error('invalid value for setTextAlign: ' . $strVAlign, E_USER_WARNING);
        }
        $this->setAttribute('dominant-baseline', $strVAlign);
    }

    /**
     * Sets the rotation (in degrees) applied to each letter of the text.
     * @param float|string $rotate
     */
    public function setRotation(float|string $rotate) : void
    {
        $this->setAttribute('rotate', $rotate);
    }

    /**
     * Sets the width that the text must fit in.
     * The text is compressed or stretched to fit in the defined width.
     * By default, only the spacing between characters is adjusted, but the
     * glyph size can also be adjusted by setting lengthAdjust to
     * `SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS`.
     * @see SVGText::setLengthAdjust()
     * @param float|string $length
     */
    public function setTextLength(float|string $length) : void
    {
        $this->setAttribute('textLength', $length);
    }

    /**
     * Sets, how the text should be compressed or stretched to fit the width defined
     * by the textLength attribute.
     * Valid values are
     * - SVG::LENGTH_ADJUST_SPACING (default)
     * - SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS
     * @see SVGText::setTextLength()
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/textLength
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/lengthAdjust
     * @param string $strAdjust
     */
    public function setLengthAdjust(string $strAdjust) : void
    {
        $this->setAttribute('lengthAdjust', $strAdjust);
    }

    /**
     * Sets hints to the renderer about what tradeoffs to make when rendering text.
     * @param string $strTextRendering  one of the self::RENDER_xxx consts
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/text-rendering
     */
    public function setTextRendering(string $strTextRendering) : void
    {
        $this->setAttribute('text-rendering', $strTextRendering);
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