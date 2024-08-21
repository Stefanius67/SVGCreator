<?php

declare(strict_types=1);

namespace SKien\SVGCreator\ExtShapes;

use SKien\SVGCreator\Shapes\SVGPath;
use SKien\SVGCreator\Shapes\SVGShape;

/**
 * Creates a group that contains a regular star.
 *
 * The shape of the star is defined by the count of rays, the outer radius and
 * the inner radius.
 * The position is defined by its center.
 * The style that is passed to the object is used for the drawing of the core star
 * element.
 *
 * In addition to the core element, the circum- and/or incircle radiuses can be added
 * and pass them (line) styles different from the core style.
 *
 * For a kind of 3D display, an additional style can be passed that is used for on
 * half of each ray.
 *
 * In conjunction with the use of suitable filter(s), some amazing 3D effect can be
 * achieved.
 * <pre>
 *  $o3DFilter = new SVGFilter();
 *  $o3DFilter->addEffect(new SVGGaussianBlurEffect(SVGEffect::IN_SOURCE_ALPHA, 5), 'blur');
 *  $o3DFilter->addEffect(new SVGOffsetEffect('blur', 5, 5), 'offset');
 *  $oLighting = new SVGSpecularLightingEffect('offset', 'gold', 8, 0.7, 2);
 *  $oLighting->setPointLight(-100, -100, 100);
 *  $o3DFilter->addEffect($oLighting, 'lighting');
 *  $o3DFilter->addEffect(new SVGCompositeEffect('lighting', SVGEffect::IN_SOURCE_ALPHA, 'in'), 'comp');
 *  $o3DFilter->addEffect(new SVGCompositeEffect(SVGEffect::IN_SOURCE_GRAPHIC, 'comp', 'arithmetic', 1.5, 0.5, 1, 0), 'paint');
 *  $oSVG->addDef($o3DFilter);
 *
 *  $oStar = new SVGStar(5, 150, 80, 200, 200, 'fill: #777;');
 *  $o3D = $oStar->draw3D('fill: #555;');
 *  $o3D->setFilter($o3DFilter);
 *  $oStar->setFilter($o3DFilter);
 *  $oSVG->add($oStar);
 * </pre>
 *
 * @SKienImage SVGStar.png
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGStar extends SVGShape
{
    /** @var int    count of star pikes/rays (must be at least 2)     */
    protected int $iRays;
    /** @var float  outer radius of the star     */
    protected float $rCircum;
    /** @var float  radius of the inner circle     */
    protected float $rIncircle;
    /** @var float  x-coordinate of the center     */
    protected float $dx;
    /** @var float  y-coordinate of the center     */
    protected float $dy;

    /**
     * Creates a group that contains a regular star.
     * @param int $iRays                count of rays
     * @param float $rCircum            radius of the outer circle
     * @param float $rIncircle          radius of the inner circle
     * @param float $dx                 x-center of the star
     * @param float $dy                 x-center of the star
     * @param string $strStyleOrClass   style or class to draw the star
     */
    public function __construct(int $iRays, float $rCircum, float $rIncircle, float $dx, float $dy, string $strStyleOrClass = null)
    {
        parent::__construct('g', '', $strStyleOrClass);

        $this->iRays = $iRays;
        $this->rCircum = $rCircum;
        $this->rIncircle = $rIncircle;
        $this->dx = $dx;
        $this->dy = $dy;

        $oStar = new SVGPath();
        $this->add($oStar);

        if ($iRays > 1) {
            $degrees = -90;
            $degreeStep = 360 / (2 * $iRays);
            $iRay = 1;
            [$x, $y] = $this->fromPolar($rCircum, $degrees);
            $oStar->moveTo($x + $dx, $y + $dy);
            while ($iRay <= $iRays) {
                $degrees -= $degreeStep;
                [$x, $y] = $this->fromPolar($rIncircle, $degrees);
                $oStar->lineTo($x + $dx, $y + $dy);
                if ($iRay < $iRays) {
                    $degrees -= $degreeStep;
                    [$x, $y] = $this->fromPolar($rCircum, $degrees);
                    $oStar->lineTo($x + $dx, $y + $dy);
                } else {
                    $oStar->close();
                }
                $iRay++;
            }
        }
    }

    /**
     * Draws the radiuses from the center to the star pikes.
     * If no explicit style or class is passed, the stroke style from the star
     * is used to draw the radiuses.
     * @param string $strStyleOrClass   style or class to use
     * @return SVGPath                  the created child SVGPath element
     */
    public function drawCircumRadiuses(string $strStyleOrClass = null) : SVGPath
    {
        $oRadiuses = new SVGPath($strStyleOrClass);
        if ($this->iRays > 1) {
            $this->add($oRadiuses);

            $degrees = -90;
            $degreeStep = 360 / $this->iRays;
            $iRay = 1;
            while ($iRay <= $this->iRays) {
                $oRadiuses->moveTo($this->dx, $this->dy);
                [$x, $y] = $this->fromPolar($this->rCircum, $degrees);
                $oRadiuses->lineTo($x + $this->dx, $y + $this->dy);
                $oRadiuses->close();

                $degrees -= $degreeStep;
                $iRay++;
            }
        }
        return $oRadiuses;
    }

    /**
     * Draws the radiuses from the incircle corners.
     * If no explicit style or class is passed, the stroke style from the star
     * is used to draw the radiuses.
     * @param string $strStyleOrClass   style or class to use
     * @return SVGPath                  the created child SVGPath element
     */
    public function drawIncircleRadiuses(string $strStyleOrClass = null) : SVGPath
    {
        $oRadiuses = new SVGPath($strStyleOrClass);
        if ($this->iRays > 1) {
            $this->add($oRadiuses);

            $degrees = -90 - (360 / (2 * $this->iRays));
            $degreeStep = 360 / $this->iRays;
            $iRay = 1;
            while ($iRay <= $this->iRays) {
                $oRadiuses->moveTo($this->dx, $this->dy);
                [$x, $y] = $this->fromPolar($this->rIncircle, $degrees);
                $oRadiuses->lineTo($x + $this->dx, $y + $this->dy);
                $oRadiuses->close();

                $degrees -= $degreeStep;
                $iRay++;
            }
        }
        return $oRadiuses;
    }

    /**
     * Draws parts of the star to get a 3D impression.
     * For a kind of 3D display, an additional style can be passed that is used for on
     * half of each ray. <br>
     * @param string $strStyleOrClass   style or class to use
     * @return SVGPath                  the created child SVGPath element
     */
    public function draw3D(string $strStyleOrClass = null) : SVGPath
    {
        $o3D = new SVGPath($strStyleOrClass);
        if ($this->iRays > 1) {
            $this->add($o3D);

            $degrees = -90;
            $degreeStep = 360 / (2 * $this->iRays);
            $iRay = 1;
            while ($iRay <= $this->iRays) {
                $o3D->moveTo($this->dx, $this->dy);
                [$x, $y] = $this->fromPolar($this->rCircum, $degrees);
                $o3D->lineTo($x + $this->dx, $y + $this->dy);
                $degrees -= $degreeStep;
                [$x, $y] = $this->fromPolar($this->rIncircle, $degrees);
                $o3D->lineTo($x + $this->dx, $y + $this->dy);
                $o3D->close();

                $degrees -= $degreeStep;
                $iRay++;
            }
        }
        return $o3D;
    }
}