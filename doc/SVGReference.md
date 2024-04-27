## a

TODO

## animate

Animation is not supported so far since i haven't take care about 
yet (more precisely i haven't needed it so far).

- animateMotion
- animateTransform
- mpath
- set

## circle

`SVGCircle`

## clipPath

Check, if needed...

## defs

Implemented as protected `oDefs` property in `SVG` using `SVGElement` element. 
'Defs' can be added uaing the method `addDef()` of `SVG`.
No need for an own class.

## desc

Is not supported/needed so far.

## ellipse

`SVGEllipse`

## filter

`SVGFilter`
`SVGFilterEffect`

### supported filters
- `SVGBlendFilter`
- `SVGFloodFilter`
- `SVGDropShadowFilter`

### so far unsupported filters
- feColorMatrix
- feComponentTransfer
- feComposite
- feConvolveMatrix
- feDiffuseLighting
- feDisplacementMap
- feDistantLight
- feFuncA
- feFuncB
- feFuncG
- feFuncR
- feGaussianBlur
- feImage
- feMerge
- feMergeNode
- feMorphology
- feOffset
- fePointLight
- feSpecularLighting
- feSpotLight
- feTile
- feTurbulence

## foreignObject

Is not supported/needed so far.

## g

`SVGGroup`

## image

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/image)

TODO

## line

`SVGLine`

## linearGradient

`SVGLinearGradient`

## marker

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/marker)

TODO

## mask

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/mask)

## metadata

Is not supported/needed so far.

## path

`SVGPath`

## pattern

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/pattern)

Check for implementation

## polygon

`SVGPolygon`

## polyline

`SVGPolyline`

## radialGradient

`SVGRadialGradient`

## rect

`SVGRect`

## script

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/script)

No direct support so far - just create and add a `SVGCData('script')` instead.

## stop

`SVGGradientStop`

## style

Implemented as method `addStyleDef()` in `SVG` using `SVGCData` element. No need for an own class.

## switch

[MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/SVG/Element/switch)

No direct support so far - just create and add a `SVGElement('switch')` instead.


## symbol

## text

`SVGText`

## textpath

`SVGTextPath`

## title

Implemented as method `setTitle()` in `SVGElement`. No need for an own class.

## tspan

## use

## view









Elements by category

- Animation elements
  - animate
  - animateMotion
  - animateTransform
  - mpath
  - set
- Shape elements
  - circle
  - ellipse
  - line
  - path
  - polygon
  - polyline
  - rect
- Text elements
  - text
  - textPath
  - tspan
- Container elements
  - a
  - defs
  - g
  - marker
  - mask
  - pattern
  - svg
  - switch
  - symbol
- Descriptive elements
  - desc
  - metadata
  - title
- Filter elements
  - filter
  - feBlend
  - feColorMatrix
  - feComponentTransfer
  - feComposite
  - feConvolveMatrix
  - feDiffuseLighting
  - feDisplacementMap
  - feDistantLight
  - feDropShadow
  - feFlood
  - feFuncA
  - feFuncB
  - feFuncG
  - feFuncR
  - feGaussianBlur
  - feImage
  - feMerge
  - feMergeNode
  - feMorphology
  - feOffset
  - fePointLight
  - feSpecularLighting
  - feSpotLight
  - feTile
  - feTurbulence
- Gradient elements
  - linearGradient
  - radialGradient
  - stop
- Graphics elements
  - image
- Graphics referencing elements
  - use
- other elements
  - style
  - script

> Note: The SVG 2 spec requires that any unknown elements be treated as 'g' for the purpose of rendering.

