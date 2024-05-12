<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;
use SKien\SVGCreator\Filter\Effects\SVGComponentTransferEffect;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGTurbulenceEffect;

/**
 * Filter that creates a random 'camouflage' pattern.
 *
 * Inspired by {@link https://css-tricks.com/creating-patterns-with-svg-filters/}
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGCamouflageFilter extends SVGFilter
{
    /**
     * Filter that creates a random 'camouflage' pattern.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addEffect(new SVGTurbulenceEffect(0.02, 3, rand(0, 200000), 'fractalNoise'), 'turb');
        $oCompTrans = new SVGComponentTransferEffect('turb');
        $oCompTrans->addDiscreteFunc('R', [0, 0, 1]);
        $oCompTrans->addDiscreteFunc('G', [0, 0, 0, 1, 1]);
        $oCompTrans->addDiscreteFunc('B', [0, 1]);
        $this->addEffect($oCompTrans, 'trans');
        $aMatrix = [
            [ 1,  0, 0, 0, 0],
            [-1,  1, 0, 0, 0],
            [-1, -1, 1, 0, 0],
            [ 0,  0, 0, 0, 1],
        ];
        $this->addEffect(new SVGColorMatrixEffect('trans', $aMatrix), 'matrix1');
        $aMatrix = [
            [-0.08, 0.42,  0.09, 0, 0.08],
            [-0.17, 0.35, -0.08, 0, 0.17],
            [-0.08, 0.15, -0.04, 0, 0.08],
            [ 0   , 0   ,  0   , 0, 1   ],
        ];
        $this->addEffect(new SVGColorMatrixEffect('matrix1', $aMatrix), 'matrix2');
        $this->addEffect(new SVGCompositeEffect('matrix2', SVGEffect::IN_SOURCE_ALPHA, 'in'));
    }
}