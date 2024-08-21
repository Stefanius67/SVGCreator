<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This filter blurs the input image.
 *
 * The input image is blured by the amount specified in stdDeviation, which
 * defines the bell-curve.
 *
 * The edgeMode determines how to extend the input image as necessary with color values so
 * that the matrix operations can be applied when the kernel is positioned at or near the
 * edge of the input image.
 * ##### duplicate
 * This value indicates that the input image is extended along each of its borders as
 * necessary by duplicating the color values at the given edge of the input image.
 * ##### wrap
 * This value indicates that the input image is extended by taking the color values from
 * the opposite edge of the image.
 * ##### none
 * This value indicates that the input image is extended with pixel values of zero for
 * R, G, B and A.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feGaussianBlur
 * @link https://en.wikipedia.org/wiki/Gaussian_blur
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGGaussianBlurEffect extends SVGEffect
{
    /**
     * Blurs the input image by the amount specified in stdDeviation, which
     * defines the bell-curve.
     * @see SVGGaussianBlurEffect
     * @param string $strIn
     * @param float $deviation
     * @param string $strEdgeMode   'duplicate' | 'wrap' | 'none' (default)
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feGaussianBlur
     */
    public function __construct(string $strIn, float $deviation, string $strEdgeMode = null)
    {
        parent::__construct('feGaussianBlur');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('stdDeviation', $deviation);
        $this->setAttribute('edgeMode', $strEdgeMode);
    }
}