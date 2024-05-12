<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Gradients;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Gradients\SVGSimpleGradient;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGSimpleGradientTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Gradients\SVGSimpleGradient
 */
final class SVGSimpleGradientTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    public function test__construct(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue');

        $aChilds = $this->getObjectProperty($oGradient, 'aChilds');
        $this->assertEquals(2, count($aChilds));

        $this->assertEquals('0%', $aChilds[0]->getAttribute('offset'));
        $this->assertEquals('red', $aChilds[0]->getAttribute('stop-color'));
        $this->assertEquals('100%', $aChilds[1]->getAttribute('offset'));
        $this->assertEquals('blue', $aChilds[1]->getAttribute('stop-color'));
    }

    public function test__constructHorz(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue', SVGSimpleGradient::LINEAR_HORZ);

        $this->assertEquals('linearGradient', $oGradient->getName());
        $this->assertEquals('0%', $oGradient->getAttribute('x1'));
        $this->assertEquals('100%', $oGradient->getAttribute('x2'));
        $this->assertEquals('0%', $oGradient->getAttribute('y1'));
        $this->assertEquals('0%', $oGradient->getAttribute('y2'));
    }

    public function test__constructVert(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue', SVGSimpleGradient::LINEAR_VERT);

        $this->assertEquals('linearGradient', $oGradient->getName());
        $this->assertEquals('0%', $oGradient->getAttribute('x1'));
        $this->assertEquals('0%', $oGradient->getAttribute('x2'));
        $this->assertEquals('0%', $oGradient->getAttribute('y1'));
        $this->assertEquals('100%', $oGradient->getAttribute('y2'));
    }

    public function test__constructTL2BR(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue', SVGSimpleGradient::LINEAR_TL2BR);

        $this->assertEquals('linearGradient', $oGradient->getName());
        $this->assertEquals('0%', $oGradient->getAttribute('x1'));
        $this->assertEquals('100%', $oGradient->getAttribute('x2'));
        $this->assertEquals('0%', $oGradient->getAttribute('y1'));
        $this->assertEquals('100%', $oGradient->getAttribute('y2'));
    }

    public function test__constructRL2TR(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue', SVGSimpleGradient::LINEAR_BL2TR);

        $this->assertEquals('linearGradient', $oGradient->getName());
        $this->assertEquals('0%', $oGradient->getAttribute('x1'));
        $this->assertEquals('100%', $oGradient->getAttribute('x2'));
        $this->assertEquals('100%', $oGradient->getAttribute('y1'));
        $this->assertEquals('0%', $oGradient->getAttribute('y2'));
    }

    public function test__constructRadial(): void
    {
        $oGradient = new SVGSimpleGradient('red', 'blue', SVGSimpleGradient::RADIAL);

        $this->assertEquals('radialGradient', $oGradient->getName());

        $aChilds = $this->getObjectProperty($oGradient, 'aChilds');
        $this->assertEquals(2, count($aChilds));

        $this->assertEquals('10%', $aChilds[0]->getAttribute('offset'));
        $this->assertEquals('red', $aChilds[0]->getAttribute('stop-color'));
        $this->assertEquals('100%', $aChilds[1]->getAttribute('offset'));
        $this->assertEquals('blue', $aChilds[1]->getAttribute('stop-color'));
    }
}
