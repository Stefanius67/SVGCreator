<?php

declare(strict_types=1);

include 'autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGImage;
use SKien\SVGCreator\Filter\SVGBlurShadowFilter;
use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Filter\Effects\SVGColorMatrixEffect;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect;
use SKien\SVGCreator\Filter\Effects\SVGOffsetEffect;
use SKien\SVGCreator\Filter\Effects\SVGSpecularLightingEffect;
use SKien\SVGCreator\Shapes\SVGPath;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGTextPath;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(700, 1000);
$oSVG->setViewbox(0, 0, 2100, 2970);

$oSVG->addStyleDef("text {font-size: 256px; font-weight: bold; font-family: 'Arial Black';}");

$oFilter1 = new SVGBlurShadowFilter(-30, 30, 10, SVGEffect::IN_SOURCE_GRAPHIC);
$oFilter1->setPos(-50, -50);
$oFilter1->setSize(300, 300);
$oFilter1->addEffect(new SVGColorMatrixEffect('', [2], 'saturate'));
$oSVG->addDef($oFilter1);

// $oFilter2 = new SVGBlurShadowFilter(20, 20, 10, '#999');
// $oFilter2 = $oSVG->addDef(new SVGDropShadowFilter(10, 10));

$oImage = new SVGImage(100, 100, 200, 200, 'images/elephpant.png');
$oImage->setFilter($oFilter1);
$oSVG->add($oImage);

$oImage = new SVGImage(100, 100, 200, 200, 'images/elephpant.png');
$oImage->setFilter($oFilter1);
$oSVG->add($oImage);

// https://docs.aspose.com/svg/de/net/drawing-basics/filters-and-gradients/
$oFilter7 = new SVGFilter();
$oFilter7->addEffect(new SVGGaussianBlurEffect(SVGEffect::IN_SOURCE_ALPHA, 5), 'blur');
$oFilter7->addEffect(new SVGOffsetEffect('blur', 5, 5), 'offset');
$oLighting = new SVGSpecularLightingEffect('offset', 'gold', 8, 0.7, 2);
$oLighting->setPointLight(-100, -100, 100);
$oFilter7->addEffect($oLighting, 'lighting');
$oFilter7->addEffect(new SVGCompositeEffect('lighting', SVGEffect::IN_SOURCE_ALPHA, 'in'), 'comp');
$oFilter7->addEffect(new SVGCompositeEffect(SVGEffect::IN_SOURCE_GRAPHIC, 'comp', 'arithmetic', 1.5, 0.5, 1, 0), 'paint');
// $oFilter7->addEffect(new SVGMergeEffect(['offset', 'paint']));
$oSVG->addDef($oFilter7);

$oPath = new SVGPath('fill: none; stroke: red; stroke-width: 3;');
$oPath->moveTo(100, 800);
$oPath->quadraticCurveTo(1100, 400, 2100, 800);
$oSVG->addDef($oPath);
$oSVG->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter7);
$oSVG->add($oTPath);

$oPath = new SVGPath('fill: none; stroke: red; stroke-width: 3;');
$oPath->moveTo(100, 1100);
$oPath->quadraticCurveTo(1100, 700, 2100, 1100);
$oSVG->addDef($oPath);
$oSVG->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter7);
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
$oTPath->setFilter($oFilter7);
$oTPath->setTextLength(2000);
$oTPath->setLengthAdjust(SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS);
$oSVG->add($oTPath);

/*
$oFilter3 = $oSVG->addDef(new SVGWoodFilter(1, 'pine'));
$oFilter4 = $oSVG->addDef(new SVGWoodFilter(1, 'beech', 'vert'));
$oFilter5 = $oSVG->addDef(new SVGWoodFilter(1, 'mahogany'));
// $oFilter6 = $oSVG->addDef(new SVGCamouflageFilter());

$oRect = new SVGRect(100, 900, 500, 200);
$oRect->setFilter($oFilter3);
$oSVG->add($oRect);
$oSVG->add(new SVGText(350, 1000, "'pine'", "font-size: 72px; font-weight: bold; font-family: 'Arial Black';" . SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
// $oSVG->add(new SVGRect(100, 900, 500, 200, 'fill: none; stroke: black; stroke-width: 3;'));

$oRect = new SVGRect(100, 1150, 500, 200);
$oRect->setFilter($oFilter4);
$oSVG->add($oRect);
$oSVG->add(new SVGText(350, 1250, "'beech'", "font-size: 72px; font-weight: bold; font-family: 'Arial Black';" . SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));

$oRect = new SVGRect(100, 1400, 500, 200);
$oRect->setFilter($oFilter5);
$oSVG->add($oRect);
$oSVG->add(new SVGText(350, 1500, "'mahogany'", "fill: white; font-size: 72px; font-weight: bold; font-family: 'Arial Black';" . SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
*/

/*
$oRect = new SVGRect(100, 1500, 500, 200);
$oRect->setFilter($oFilter6);
$oSVG->add($oRect);
*/

/*
// https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Filter_effects
$oFilter8 = new SVGFilter();
$oFilter8->addEffect(new SVGGaussianBlurEffect(SVGEffect::IN_SOURCE_ALPHA, 5), 'blur');
$oFilter8->addEffect(new SVGOffsetEffect('blur', 5, 5), 'offset');
$oLighting = new SVGSpecularLightingEffect('blur', '#bbb', 5, 0.75, 20);
$oLighting->setPointLight(-5000, -10000, 20000);
$oFilter8->addEffect($oLighting, 'lighting');
$oFilter8->addEffect(new SVGCompositeEffect('lighting', SVGEffect::IN_SOURCE_ALPHA, 'in'), 'comp');
$oFilter8->addEffect(new SVGCompositeEffect(SVGEffect::IN_SOURCE_GRAPHIC, 'comp', 'arithmetic', 0, 1, 1, 0), 'paint');
// $oFilter7->addEffect(new SVGMergeEffect(['offset', 'paint']));
$oSVG->addDef($oFilter8);


$oSVG->add(new SVGEllipse(500, 1195, 290, 290, 'fill: white'));

$oImage = new SVGImage(200, 900, 600, 600, 'images/hsg.svg');
$oImage->setFilter($oFilter8);
$oImage->flipHorz('500 1195');
$oSVG->add($oImage);

$oSVG->add(new SVGEllipse(1300, 1300, 276, 396, 'fill: white'));

$oImage = new SVGImage(1000, 900, 600, 800, 'images/SC_Freiburg.svg');
$oImage->setFilter($oFilter8);
$oSVG->add($oImage);
*/

$oSVG->output();