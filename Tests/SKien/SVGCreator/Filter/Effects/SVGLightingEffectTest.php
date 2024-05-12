<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGLightingEffect;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGLightingEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGLightingEffect
 */
final class SVGLightingEffectTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new class extends SVGLightingEffect {
            public function __construct()
            {
                parent::__construct('feLighting');
            }
        };
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGEffect);
    }

    public function testSetDistantLight(): void
    {
        $this->oSVGEffect->setDistantLight(1, 2);

        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feDistantLight', $aChilds[0]->getName());
        $this->assertEquals('1', $aChilds[0]->getAttribute('azimuth'));
        $this->assertEquals('2', $aChilds[0]->getAttribute('elevation'));
    }

    public function testSetPointLight(): void
    {
        $this->oSVGEffect->setPointLight(1, 2, 3);

        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('fePointLight', $aChilds[0]->getName());
        $this->assertEquals('1', $aChilds[0]->getAttribute('x'));
        $this->assertEquals('2', $aChilds[0]->getAttribute('y'));
        $this->assertEquals('3', $aChilds[0]->getAttribute('z'));
    }

    public function testSetSpotLight(): void
    {
        $this->oSVGEffect->setSpotLight(1, 2, 3, 4, 5, 6, 7, 8);

        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feSpotLight', $aChilds[0]->getName());
        $this->assertEquals('1', $aChilds[0]->getAttribute('x'));
        $this->assertEquals('2', $aChilds[0]->getAttribute('y'));
        $this->assertEquals('3', $aChilds[0]->getAttribute('z'));
        $this->assertEquals('4', $aChilds[0]->getAttribute('pointsAtX'));
        $this->assertEquals('5', $aChilds[0]->getAttribute('pointsAtY'));
        $this->assertEquals('6', $aChilds[0]->getAttribute('pointsAtZ'));
        $this->assertEquals('7', $aChilds[0]->getAttribute('specularExponent'));
        $this->assertEquals('8', $aChilds[0]->getAttribute('limitingConeAngle'));
    }
}
