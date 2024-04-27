<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * Element that includes other images inside the SVG document. It can display
 * raster image files or other SVG files.
 *
 * @see SVGImage::__construct
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGImage extends SVGElement
{
    /**
     * Element that draws text.
     * @param float|string $x
     * @param float|string $y
     * @param string $strText
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/text
     */
    public function __construct(float|string $x, float|string $y, float|string $width, float|string $height, string $strHref, string $strStyleOrClass = null)
    {
        parent::__construct('image', '', $strStyleOrClass);

        $this->setAttribute('x', $x);
        $this->setAttribute('y', $y);
        $this->setAttribute('width', $width);
        $this->setAttribute('height', $height);
        $this->setAttribute('href', $strHref);
    }

    /**
     * Sets the way, how the image is scaled.
     * By default the aspect-ratio of the source image is kept and the imoge is fit
     * inside the given rect.
     * NONE:
     *      width and height of the source image is stretched to the given rect
     *
     * @param string|float $size
     */
    public function setPreserveAspectRatio(string $preserve) : void
    {
        $this->setAttribute('preserveAspectRatio', $preserve);
    }
}