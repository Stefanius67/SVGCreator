<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Text;

use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\Shapes\SVGPath;

/**
 * Element to render text along the shape of a `path`.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#textpath
 * @link https://www.w3schools.com/graphics/svg_textpath.asp
 *
 * @see SVGTextPath::__construct
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGTextPath extends SVGElement
{
    protected SVGElement $oPath;

    /**
     * Element to render text along the shape of a `path`.
     *
     * The text can be rendered along any visible path (as long as the paths
     * unique id is set - and known) or along a invisble path that has been
     * added to the `defs`
     *
     * @param string|SVGPath $path
     * @param string $strText
     * @param float|string $offset
     * @param string $strStyleOrClass
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/textPath
     */
    public function __construct(string|SVGPath $path, string $strText, float|string $offset = null, string $strStyleOrClass = null)
    {
        parent::__construct('text', '', $strStyleOrClass);

        // add the textpath child element
        $this->oPath = $this->add(new SVGElement('textPath', $strText));
        $id = (is_string($path)) ? $path : $path->getID();
        $this->oPath->setAttribute('href', "#$id");
        $this->oPath->setAttribute('startOffset', $offset);
    }

    /**
     * Sets which side of the path the text should be rendered.
     * Valid values are
     * - SVG::RENDER_LEFT (default)
     * - SVG::RENDER_RICGHT

     * @param string $side
     */
    public function setSide(string $side) : void
    {
        $this->oPath->setAttribute('side', $side);
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
     * Sets, which method to use to render individual glyphs along the path.
     * Valid values are
     * - SVG::METHOD_ALIGN (default)
     * - SVG::METHOD_STRETCH
     * @param string $strMethod
     */
    public function setMethod(string $strMethod) : void
    {
        $this->oPath->setAttribute('method', $strMethod);
    }

    /**
     * Sets how space between glyphs should be handled.
     * Valid values are
     * - SVG::GLYPH_SPACING_EXACT (default)
     * - SVG::GLYPH_SPACING_AUTO
     * @param string $strSpacing
     */
    public function setGlyphSpacing(string $strSpacing) : void
    {
        $this->oPath->setAttribute('spacing', $strSpacing);
    }
}