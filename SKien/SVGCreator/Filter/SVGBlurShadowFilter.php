<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGFloodEffect;
use SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect;
use SKien\SVGCreator\Filter\Effects\SVGMergeEffect;
use SKien\SVGCreator\Filter\Effects\SVGOffsetEffect;

/**
 * Filter that creates a blur drop shadow of the input image.
 * Either the input graphic or its alpha channel can be used as the basis
 * for the blur effect. If a color (and optionally the opacity) is specified
 * instead, the alpha channel colored accordingly before blured.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGBlurShadowFilter extends SVGFilter
{
    /**
     * Filter that creates a blur drop shadow of the input image.
     * Either the input graphic or its alpha channel can be used as the basis
     * for the blur effect. If a color (and optionally the opacity) is specified
     * instead, the alpha channel is used, which is colored accordingly.
     * @param float $dx
     * @param float $dy
     * @param float $deviation
     * @param string $strInOrBlurColor
     * @param float $blurOpacity
     */
    public function __construct(float $dx, float $dy, float $deviation, string $strInOrBlurColor = null, float $blurOpacity = null)
    {
        parent::__construct();

        $strIn = SVGEffect::IN_SOURCE_ALPHA;
        $strBlurColor = $strInOrBlurColor;
        if ($strInOrBlurColor == SVGEffect::IN_SOURCE_ALPHA || $strInOrBlurColor == SVGEffect::IN_SOURCE_GRAPHIC) {
            $strIn = $strInOrBlurColor;
            $strBlurColor = null;
        }
        $this->addEffect(new SVGOffsetEffect($strIn, $dx, $dy), 'offset');
        $this->addEffect(new SVGGaussianBlurEffect('offset', $deviation), 'blur');
        if ($strBlurColor !== null) {
            $this->addEffect(new SVGFloodEffect($strBlurColor, $blurOpacity ?? 1), 'flood');
            $this->addEffect(new SVGCompositeEffect('flood', 'blur', 'in'), 'blur');
        }
        $this->addEffect(new SVGMergeEffect(['blur', SVGEffect::IN_SOURCE_GRAPHIC]));
    }
}