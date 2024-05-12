<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;

/**
 * Class SVGColorMatrixEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect
 */
final class SVGColorMatrixEffectTest extends TestCase
{
    private SVGColorMatrixEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $aMatrix = [
            [1, 2, 3, 4, 5],
            [2, 3, 4, 5, 6],
            [3, 4, 5, 6, 7],
            [4, 5, 6, 7, 8],
        ];
        $this->oSVGEffect = new SVGColorMatrixEffect('in', $aMatrix, 'matrix');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGEffect);
    }

    public function test__construct1(): void
    {
        $this->assertEquals('feColorMatrix', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('matrix', $this->oSVGEffect->getAttribute('type'));
        $this->assertEquals('1 2 3 4 5, 2 3 4 5 6, 3 4 5 6 7, 4 5 6 7 8', $this->oSVGEffect->getAttribute('values'));
    }

    public function test__construct2(): void
    {
        $aMatrix = [
            1, 2, 3, 4, 5,
            2, 3, 4, 5, 6,
            3, 4, 5, 6, 7,
            4, 5, 6, 7, 8,
        ];
        $this->oSVGEffect = new SVGColorMatrixEffect('in', $aMatrix, 'matrix');

        $this->assertEquals('feColorMatrix', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
        $this->assertEquals('matrix', $this->oSVGEffect->getAttribute('type'));
        $this->assertEquals('1 2 3 4 5 2 3 4 5 6 3 4 5 6 7 4 5 6 7 8', $this->oSVGEffect->getAttribute('values'));
    }
}
