<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;

/**
 * Simple filter that controls the color saturation.
 *
 * Uses the `SVGColorMatrixEffect` and setts the type to 'saturate'.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feColorMatrix
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGSaturationFilter extends SVGFilter
{
    /**
     * Simple filter that controls the color saturation.
     * Values:
     * <pre>
     *    0:  no colors (grayscale)
     *    1:  origin colors
     *   <1:  paler colors
     *   >1:  brighter colors>
     * </pre>
     * @param float $saturation
     */
    public function __construct(float $saturation)
    {
        parent::__construct();
        $this->addEffect(new SVGColorMatrixEffect('', [$saturation], 'saturate'));
    }
}