<?php

declare(strict_types=1);

namespace SKien\SVGCreator;


/**
 * Class to define symbols in a svg image.
 *
 * This element allows to define graphical template objects which can be instantiated
 * by a [use] element.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/symbol
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGSymbol extends SVGElement
{
    /**
     * Creates a symbol element.
     * @param float|string $width
     * @param float|string $height
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/marker
     */
    public function __construct(float|string $width, float|string $height)
    {
        parent::__construct('symbol');

        $this->setAttribute('width', $width);
        $this->setAttribute('height', $height);
    }

    /**
     * Sets the refenrence point of the symbol.
     * If the `refY` value is ommited, it is set to the `refX` value.
     * @param float|string $refX    `left` | `center` | `right` | [coordinate] (default: 0)
     * @param float|string $refY    `top` | `center` | `bottom` | [coordinate] (default: 0)
     */
    public function setRefPoint(float|string $refX, float|string $refY = null) : void
    {
        $this->setAttribute('refX', $refX);
        $this->setAttribute('refY', $refY ?? $refX);
        trigger_error('Have not found any browser that supports the RefPoint for symbol so far!', E_USER_NOTICE);
    }
}