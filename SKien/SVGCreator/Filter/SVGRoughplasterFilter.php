<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGDiffuseLightingEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGTurbulenceEffect;

/**
 * Filter that creates a 'roughplaster' texture.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGRoughplasterFilter extends SVGFilter
{
    /**
     * Filter that creates a 'roughplaster' texture.
     * @param string $color
     * @param float $grain
     */
    public function __construct(string $color, float $grain = 1)
    {
        parent::__construct();

        $this->addEffect(new SVGTurbulenceEffect(0.04 * $grain, intval(5 * $grain), null, 'turbulence' , false), 'turb');
        $oLigthingEffect = new SVGDiffuseLightingEffect('turb', $color, 2);
        $oLigthingEffect->setDistantLight(45, 35);
        $this->addEffect($oLigthingEffect, 'light');
        $this->addEffect(new SVGCompositeEffect('light', SVGEffect::IN_SOURCE_ALPHA, 'in'));
    }
}