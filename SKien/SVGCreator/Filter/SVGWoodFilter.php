<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;
use SKien\SVGCreator\Filter\Effects\SVGComponentTransferEffect;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGTurbulenceEffect;

/**
 * Filter that creates a wood texture.
 *
 * Currently supported types
 * - pine
 * - beech
 * - mahogany
 *
 * @SKienImage SVGWoodFilterTypes.png
 *
 * @link https://css-tricks.com/creating-patterns-with-svg-filters/
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGWoodFilter extends SVGFilter
{
    public const TYPE_PINE      =  'pine';
    public const TYPE_BEECH     =  'beech';
    public const TYPE_MAHOGANY  =  'mahogany';

    public const ALIGN_HORZ = 'horz';
    public const ALIGN_VERT = 'vert';

    /**
     * Filter that creates a wood texture.
     * @param float $grain
     * @param string $strType   One of self::TYPE_xxx
     * @param string $strDir    One of self::ALIGN_xxx
     */
    public function __construct(float $grain = 1, string $strType = 'pine', string $strDir = 'horz')
    {
        parent::__construct();

        switch ($strType) {
            case 'beech':
                $aMatrix = [
                    [0, 0, 0, 0.12, 0.74],
                    [0, 0, 0, 0.09, 0.42],
                    [0, 0, 0, 0.03, 0.17],
                    [0, 0, 0, 0,    1   ],
                ];
                $slope = 1;
                break;
            case 'mahogany':
                $aMatrix = [
                    [0, 0, 0, 0.38, 0.82],
                    [0, 0, 0, 0.46, 0.11],
                    [0, 0, 0, 0.82, 0.08],
                    [0, 0, 0, 0,    1   ],
                ];
                $slope = 0.2;
                break;
            case 'pine':
            default:
                $aMatrix = [
                    [0, 0, 0, 0.11, 0.69],
                    [0, 0, 0, 0.27, 0.38],
                    [0, 0, 0, 0.12, 0.14],
                    [0, 0, 0, 0,    1   ],
                ];
                $slope = 1;
                break;
        }

        $freq1 = 0.001 * $grain;
        $freq2 = 0.05 * $grain;
        $baseFrequency = $strDir == 'horz' ? $freq1 . ' ' . $freq2 : $freq2 . ' ' . $freq1;

        $this->addEffect(new SVGTurbulenceEffect($baseFrequency, 1, rand(0, 200000)), 'turb');
        $this->addEffect(new SVGColorMatrixEffect('turb', $aMatrix), 'matrix');
        if ($slope !== 1) {
            $oCompTrans = new SVGComponentTransferEffect('matrix');
            $oCompTrans->addLinearFunc('R', $slope);
            $oCompTrans->addLinearFunc('G', $slope);
            $oCompTrans->addLinearFunc('B', $slope);
            $this->addEffect($oCompTrans, 'matrix');
        }
        $this->addEffect(new SVGCompositeEffect('matrix', SVGEffect::IN_SOURCE_ALPHA, 'in'));
    }
}