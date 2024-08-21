<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 * Element that includes other images inside the SVG document.
 *
 * It can display raster image files or other SVG files. The only image formats
 * SVG software must support are JPEG, PNG, and other SVG files. Animated GIF
 * behavior is undefined.
 *
 * Unlike an HTML 'img' element, where the size (height and width) may be determined
 * from the source file, the values for the width and height must be specified for
 * the SVG 'image' element.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGImage extends SVGElement
{
    /**
     * Element that includes other images inside the SVG document.
     * The position of the image inside of the specified rect can be set using
     * the `setPreserveAspectRatio()` method.
     * @param float|string $x       x-position of the image
     * @param float|string $y       y-position of the image
     * @param float|string $width   width of the image
     * @param float|string $height  height of the image
     * @param string $strHref       the image to draw
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/image
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
}