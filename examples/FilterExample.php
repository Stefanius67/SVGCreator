<?php

/**
 * This example demonstrate  some filter effects.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGImage;
use SKien\SVGCreator\Filter\SVGBlurShadowFilter;
use SKien\SVGCreator\Filter\SVGDropShadowFilter;
use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect;
use SKien\SVGCreator\Filter\Effects\SVGMergeEffect;
use SKien\SVGCreator\Filter\Effects\SVGOffsetEffect;
use SKien\SVGCreator\Filter\Effects\SVGSpecularLightingEffect;
use SKien\SVGCreator\Shapes\SVGPath;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGTextPath;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(700, 500);
$oSVG->setViewbox(0, 0, 2100, 1485);

$oSVG->addStyleDef("text {font-size: 256px; font-weight: bold; font-family: 'Arial Black';}");

$oFilter1 = new SVGBlurShadowFilter(30, 30, 10, SVGEffect::IN_SOURCE_GRAPHIC);
$oFilter1->setPos(-50, -50);
$oFilter1->setSize(300, 300);
$oFilter1->addEffect(new SVGColorMatrixEffect('', [2], 'saturate'));
$oSVG->addDef($oFilter1);

$oFilter2 = new SVGBlurShadowFilter(20, 20, 10, '#999');
$oFilter2 = $oSVG->addDef(new SVGDropShadowFilter(10, 10));

$oImage = new SVGImage(600, 100, 200, 200, './images/elephpant.png');
$oImage->setFilter($oFilter1);
$oSVG->add($oImage);

$oImage = new SVGImage(1300, 100, 200, 200, './images/elephpant.png');
$oImage->setFilter($oFilter2);
$oSVG->add($oImage);

// https://docs.aspose.com/svg/de/net/drawing-basics/filters-and-gradients/
$oFilter3 = new SVGFilter();
$oFilter3->addEffect(new SVGGaussianBlurEffect(SVGEffect::IN_SOURCE_ALPHA, 5), 'blur');
$oFilter3->addEffect(new SVGOffsetEffect('blur', 5, 5), 'offset');
$oLighting = new SVGSpecularLightingEffect('offset', 'gold', 8, 0.7, 2);
$oLighting->setPointLight(-100, -100, 100);
$oFilter3->addEffect($oLighting, 'lighting');
$oFilter3->addEffect(new SVGCompositeEffect('lighting', SVGEffect::IN_SOURCE_ALPHA, 'in'), 'comp');
$oFilter3->addEffect(new SVGCompositeEffect(SVGEffect::IN_SOURCE_GRAPHIC, 'comp', 'arithmetic', 1.5, 0.5, 1, 0), 'paint');
$oFilter3->addEffect(new SVGMergeEffect(['offset', 'paint']));
$oSVG->addDef($oFilter3);

$oPath = new SVGPath('fill: none; stroke: red; stroke-width: 3;');
$oPath->moveTo(100, 800);
$oPath->quadraticCurveTo(1100, 400, 2100, 800);
$oSVG->addDef($oPath);
$oSVG->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter3);
$oSVG->add($oTPath);

$oPath = new SVGPath('fill: none; stroke: red; stroke-width: 3;');
$oPath->moveTo(100, 1100);
$oPath->quadraticCurveTo(1100, 700, 2100, 1100);
$oSVG->addDef($oPath);
$oSVG->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter3);
$oTPath->setTextLength(2000);
$oSVG->add($oTPath);

$oPath = new SVGPath('fill: none; stroke: red; stroke-width: 3;');
$oPath->moveTo(100, 1400);
$oPath->quadraticCurveTo(1100, 1000, 2100, 1400);
$oSVG->addDef($oPath);
$oSVG->add($oPath);
$oSVG->add(new SVGRect(100, 1000, 2000, 400, 'fill: none; stroke: #777; stroke-width: 2;'));

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter3);
$oTPath->setTextLength(2000);
$oTPath->setLengthAdjust(SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS);
$oSVG->add($oTPath);

$oSVG->output();