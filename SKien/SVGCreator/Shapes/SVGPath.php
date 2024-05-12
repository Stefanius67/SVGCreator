<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Creates a path for drawing or to use for rendering text along.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/path
 * @link https://www.w3schools.com/graphics/svg_path.asp
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGPath extends SVGShape
{
    /** @var string     the previous called command     */
    protected string $strPrevCmd = '';

    /**
     * Creates a path for drawing or to use for rendering text along.
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/path
     */
    public function __construct(string $strStyleOrClass = null)
    {
        parent::__construct('path', '', $strStyleOrClass);

        $this->setAttribute('d', '');
    }

    /**
     * Moves the cursor to the given position.
     * @param float $x
     * @param float $y
     */
    public function moveTo(float $x, float $y) : void
    {
        $this->strPrevCmd = 'M';
        $this->oAttrib['d'] .= "M $x $y ";
    }

    /**
     * Moves the cursor by the given distances from the current position.
     * @param float $dx
     * @param float $dy
     */
    public function move(float $dx, float $dy) : void
    {
        $this->strPrevCmd = 'm';
        $this->oAttrib['d'] .= "m $dx $dy ";
    }

    /**
     * Draws a line from the current position to the new position.
     * @param float $x
     * @param float $y
     */
    public function lineTo(float $x, float $y) : void
    {
        $this->strPrevCmd = 'L';
        $this->oAttrib['d'] .= "L $x $y ";
    }

    /**
     * Draws a line from the current position by the given distances.
     * @param float $dx
     * @param float $dy
     */
    public function line(float $dx, float $dy) : void
    {
        $this->strPrevCmd = 'l';
        $this->oAttrib['d'] .= "l $dx $dy ";
    }

    /**
     * Draws a horizontal line from the current position to the new x position.
     * @param float $x
     */
    public function horzLineTo(float $x) : void
    {
        $this->strPrevCmd = 'H';
        $this->oAttrib['d'] .= "H $x ";
    }

    /**
     * Draws a horizontal line from the current position by the given x distance.
     * @param float $dx
     */
    public function horzLine(float $dx) : void
    {
        $this->strPrevCmd = 'h';
        $this->oAttrib['d'] .= "h $dx ";
    }

    /**
     * Draws a vertical line from the current position to the new y position.
     * @param float $y
     */
    public function vertLineTo(float $y) : void
    {
        $this->strPrevCmd = 'V';
        $this->oAttrib['d'] .= "V $y ";
    }

    /**
     * Draws a vertical line from the current position by the given y distance.
     * @param float $dy
     */
    public function vertLine(float $dy) : void
    {
        $this->strPrevCmd = 'v';
        $this->oAttrib['d'] .= "v $dy ";
    }

    /**
     * Closes the path.
     * Draws a straight line from the current position back to the first point of the path.
     */
    public function close() : void
    {
        $this->oAttrib['d'] .= "Z ";
    }

    /**
     * Draws an arc at given position.
     * @param float $rx
     * @param float $ry
     * @param float $xAxisRotation
     * @param bool|int $largeArc
     * @param bool|int $sweep
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#arcs
     */
    public function arcAt(float $rx, float $ry, float $xAxisRotation, bool|int $largeArc, bool|int $sweep, float $x, float $y) : void
    {
        $iLargeArc = (int) $largeArc;
        $iSweep = (int) $sweep;
        $this->strPrevCmd = 'A';
        $this->oAttrib['d'] .= "A $rx $ry, $xAxisRotation, $iLargeArc, $iSweep, $x $y ";
    }

    /**
     * Draws an arc at given distance from current position.
     * @param float $rx
     * @param float $ry
     * @param float $xAxisRotation
     * @param bool|int $largeArc
     * @param bool|int $sweep
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#arcs
     */
    public function arc(float $rx, float $ry, float $xAxisRotation, bool|int $largeArc, bool|int $sweep, float $dx, float $dy) : void
    {
        $iLargeArc = (int) $largeArc;
        $iSweep = (int) $sweep;
        $this->strPrevCmd = 'a';
        $this->oAttrib['d'] .= "a $rx $ry, $xAxisRotation, $iLargeArc, $iSweep, $dx $dy ";
    }

    /**
     * Draws a bézier curve to the new position.
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function curveTo(float $x1, float $y1, float $x2, float $y2, float $x, float $y) : void
    {
        $this->strPrevCmd = 'C';
        $this->oAttrib['d'] .= "C $x1 $y1, $x2 $y2, $x $y ";
    }

    /**
     * Draws a bézier curve by the given distance.
     * @param float $dx1
     * @param float $dy1
     * @param float $dx2
     * @param float $dy2
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function curve(float $dx1, float $dy1, float $dx2, float $dy2, float $dx, float $dy) : void
    {
        $this->strPrevCmd = 'c';
        $this->oAttrib['d'] .= "c $dx1 $dy1, $dx2 $dy2, $dx $dy ";
    }

    /**
     * Draws a smooth bézier curve to the new position.
     * 'Smooth' curve means that several bézier curves can be strung together to create extended,
     * smooth shapes. The control point on the start side will be a reflection of the control point
     * used on the end side of the previous bézier curve. <br>
     * This command can only be used, if the previous command was already a full or smooth bézier curve.
     * @param float $x2
     * @param float $y2
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function smoothCurveTo(float $x2, float $y2, float $x, float $y) : void
    {
        if ($this->strPrevCmd !== 'S' && $this->strPrevCmd !== 'C') {
            trigger_error('A smoothCurve . command can only follows a curve or another smoothCurve - command!', E_USER_WARNING);
        }
        $this->strPrevCmd = 'S';
        $this->oAttrib['d'] .= "S $x2 $y2, $x $y ";
    }

    /**
     * Draws a smooth bézier curve by the given distance.
     * 'Smooth' curve means that several bézier curves can be strung together to create extended,
     * smooth shapes. The control point on the start side will be a reflection of the control point
     * used on the end side of the previous bézier curve. <br>
     * This command can only be used, if the previous command was already a full or smooth bézier curve.
     * @param float $dx2
     * @param float $dy2
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function smoothCurve(float $dx2, float $dy2, float $dx, float $dy) : void
    {
        if ($this->strPrevCmd !== 's' && $this->strPrevCmd !== 'c') {
            trigger_error('A smoothCurve . command can only follows a curve or another smoothCurve - command!', E_USER_WARNING);
        }
        $this->strPrevCmd = 's';
        $this->oAttrib['d'] .= "s $dx2 $dy2, $dx $dy ";
    }

    /**
     * Draws a quadratic bézier curve to the new position.
     * The quadratic curve is actually a simpler curve than the cubic one. It requires one
     * control point which determines the slope of the curve at both the start point and
     * the end point.
     * @param float $x1
     * @param float $y1
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function quadraticCurveTo(float $x1, float $y1, float $x, float $y) : void
    {
        $this->strPrevCmd = 'Q';
        $this->oAttrib['d'] .= "Q $x1 $y1, $x $y ";
    }

    /**
     * Draws a quadratic bézier curve by the given distance.
     * The quadratic curve is actually a simpler curve than the cubic one. It requires one
     * control point which determines the slope of the curve at both the start point and
     * the end point.
     * @param float $dx1
     * @param float $dy1
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function quadraticCurve(float $dx1, float $dy1, float $dx, float $dy) : void
    {
        $this->strPrevCmd = 'q';
        $this->oAttrib['d'] .= "q $dx1 $dy1, $dx $dy ";
    }

    /**
     * Draws a smooth quadratic bézier curve to the new position.
     * 'Smooth' curve means that several bézier curves can be strung together to create extended,
     * smooth shapes. The control point on the start side will be a reflection of the control point
     * used on the end side of the previous bézier curve. <br>
     * This command can only be used, if the previous command was already a full or smooth quadratic
     * bézier curve.
     * @param float $x
     * @param float $y
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function smoothQuadraticCurveTo(float $x, float $y) : void
    {
        if ($this->strPrevCmd !== 'Q' && $this->strPrevCmd !== 'T') {
            trigger_error('A smoothQuadraticCurve . command can only follows a quadraticCurve or another smoothQuadraticCurve - command!', E_USER_WARNING);
        }
        $this->strPrevCmd = 'T';
        $this->oAttrib['d'] .= "T $x $y ";
    }

    /**
     * Draws a smooth quadratic bézier curve by the given distance.
     * 'Smooth' curve means that several bézier curves can be strung together to create extended,
     * smooth shapes. The control point on the start side will be a reflection of the control point
     * used on the end side of the previous bézier curve. <br>
     * This command can only be used, if the previous command was already a full or smooth quadratic
     * bézier curve.
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     */
    public function smoothQuadraticCurve(float $dx, float $dy) : void
    {
        if ($this->strPrevCmd !== 'q' && $this->strPrevCmd !== 't') {
            trigger_error('A smoothQuadraticCurve . command can only follows a quadraticCurve or another smoothQuadraticCurve - command!', E_USER_WARNING);
        }
        $this->strPrevCmd = 't';
        $this->oAttrib['d'] .= "t $dx $dy ";
    }
}