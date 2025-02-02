!(function (t, e) {
  "object" == typeof exports && "undefined" != typeof module
    ? (module.exports = e())
    : "function" == typeof define && define.amd
    ? define(e)
    : ((t = t || self).Cropper = e());
})(this, function () {
  "use strict";
  function t(e) {
    return (t =
      "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
        ? function (t) {
            return typeof t;
          }
        : function (t) {
            return t &&
              "function" == typeof Symbol &&
              t.constructor === Symbol &&
              t !== Symbol.prototype
              ? "symbol"
              : typeof t;
          })(e);
  }
  function e(t, e) {
    for (var i = 0; i < e.length; i++) {
      var a = e[i];
      (a.enumerable = a.enumerable || !1),
        (a.configurable = !0),
        "value" in a && (a.writable = !0),
        Object.defineProperty(t, a.key, a);
    }
  }
  function i(t, e, i) {
    return (
      e in t
        ? Object.defineProperty(t, e, {
            value: i,
            enumerable: !0,
            configurable: !0,
            writable: !0,
          })
        : (t[e] = i),
      t
    );
  }
  function a(t, e) {
    var i = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
      var a = Object.getOwnPropertySymbols(t);
      e &&
        (a = a.filter(function (e) {
          return Object.getOwnPropertyDescriptor(t, e).enumerable;
        })),
        i.push.apply(i, a);
    }
    return i;
  }
  function n(t) {
    for (var e = 1; e < arguments.length; e++) {
      var n = null != arguments[e] ? arguments[e] : {};
      e % 2
        ? a(n, !0).forEach(function (e) {
            i(t, e, n[e]);
          })
        : Object.getOwnPropertyDescriptors
        ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n))
        : a(n).forEach(function (e) {
            Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e));
          });
    }
    return t;
  }
  function o(t) {
    return (
      (function (t) {
        if (Array.isArray(t)) {
          for (var e = 0, i = new Array(t.length); e < t.length; e++)
            i[e] = t[e];
          return i;
        }
      })(t) ||
      (function (t) {
        if (
          Symbol.iterator in Object(t) ||
          "[object Arguments]" === Object.prototype.toString.call(t)
        )
          return Array.from(t);
      })(t) ||
      (function () {
        throw new TypeError("Invalid attempt to spread non-iterable instance");
      })()
    );
  }
  var r = "undefined" != typeof window && void 0 !== window.document,
    h = r ? window : {},
    s = !!r && "ontouchstart" in h.document.documentElement,
    c = !!r && "PointerEvent" in h,
    p = "".concat("cropper", "-crop"),
    l = "".concat("cropper", "-disabled"),
    d = "".concat("cropper", "-hidden"),
    m = "".concat("cropper", "-hide"),
    u = "".concat("cropper", "-invisible"),
    g = "".concat("cropper", "-modal"),
    f = "".concat("cropper", "-move"),
    v = "".concat("cropper", "Action"),
    w = "".concat("cropper", "Preview"),
    b = c ? "pointerdown" : s ? "touchstart" : "mousedown",
    y = c ? "pointermove" : s ? "touchmove" : "mousemove",
    x = c ? "pointerup pointercancel" : s ? "touchend touchcancel" : "mouseup",
    M = /^e|w|s|n|se|sw|ne|nw|all|crop|move|zoom$/,
    C = /^data:/,
    D = /^data:image\/jpeg;base64,/,
    B = /^img|canvas$/i,
    k = {
      viewMode: 0,
      dragMode: "crop",
      initialAspectRatio: NaN,
      aspectRatio: NaN,
      data: null,
      preview: "",
      responsive: !0,
      restore: !0,
      checkCrossOrigin: !0,
      checkOrientation: !0,
      modal: !0,
      guides: !0,
      center: !0,
      highlight: !0,
      background: !0,
      autoCrop: !0,
      autoCropArea: 0.8,
      movable: !0,
      rotatable: !0,
      scalable: !0,
      zoomable: !0,
      zoomOnTouch: !0,
      zoomOnWheel: !0,
      wheelZoomRatio: 0.1,
      cropBoxMovable: !0,
      cropBoxResizable: !0,
      toggleDragModeOnDblclick: !0,
      minCanvasWidth: 0,
      minCanvasHeight: 0,
      minCropBoxWidth: 0,
      minCropBoxHeight: 0,
      minContainerWidth: 200,
      minContainerHeight: 100,
      ready: null,
      cropstart: null,
      cropmove: null,
      cropend: null,
      crop: null,
      zoom: null,
    },
    O = Number.isNaN || h.isNaN;
  function T(t) {
    return "number" == typeof t && !O(t);
  }
  var E = function (t) {
    return t > 0 && t < 1 / 0;
  };
  function W(t) {
    return void 0 === t;
  }
  function N(e) {
    return "object" === t(e) && null !== e;
  }
  var H = Object.prototype.hasOwnProperty;
  function z(t) {
    if (!N(t)) return !1;
    try {
      var e = t.constructor,
        i = e.prototype;
      return e && i && H.call(i, "isPrototypeOf");
    } catch (t) {
      return !1;
    }
  }
  function L(t) {
    return "function" == typeof t;
  }
  var Y = Array.prototype.slice;
  function X(t) {
    return Array.from ? Array.from(t) : Y.call(t);
  }
  function R(t, e) {
    return (
      t &&
        L(e) &&
        (Array.isArray(t) || T(t.length)
          ? X(t).forEach(function (i, a) {
              e.call(t, i, a, t);
            })
          : N(t) &&
            Object.keys(t).forEach(function (i) {
              e.call(t, t[i], i, t);
            })),
      t
    );
  }
  var S =
      Object.assign ||
      function (t) {
        for (
          var e = arguments.length, i = new Array(e > 1 ? e - 1 : 0), a = 1;
          a < e;
          a++
        )
          i[a - 1] = arguments[a];
        return (
          N(t) &&
            i.length > 0 &&
            i.forEach(function (e) {
              N(e) &&
                Object.keys(e).forEach(function (i) {
                  t[i] = e[i];
                });
            }),
          t
        );
      },
    A = /\.\d*(?:0|9){12}\d*$/;
  function j(t) {
    var e =
      arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1e11;
    return A.test(t) ? Math.round(t * e) / e : t;
  }
  var P = /^width|height|left|top|marginLeft|marginTop$/;
  function I(t, e) {
    var i = t.style;
    R(e, function (t, e) {
      P.test(e) && T(t) && (t = "".concat(t, "px")), (i[e] = t);
    });
  }
  function U(t, e) {
    if (e)
      if (T(t.length))
        R(t, function (t) {
          U(t, e);
        });
      else if (t.classList) t.classList.add(e);
      else {
        var i = t.className.trim();
        i
          ? i.indexOf(e) < 0 && (t.className = "".concat(i, " ").concat(e))
          : (t.className = e);
      }
  }
  function q(t, e) {
    e &&
      (T(t.length)
        ? R(t, function (t) {
            q(t, e);
          })
        : t.classList
        ? t.classList.remove(e)
        : t.className.indexOf(e) >= 0 &&
          (t.className = t.className.replace(e, "")));
  }
  function $(t, e, i) {
    e &&
      (T(t.length)
        ? R(t, function (t) {
            $(t, e, i);
          })
        : i
        ? U(t, e)
        : q(t, e));
  }
  var Q = /([a-z\d])([A-Z])/g;
  function K(t) {
    return t.replace(Q, "$1-$2").toLowerCase();
  }
  function Z(t, e) {
    return N(t[e])
      ? t[e]
      : t.dataset
      ? t.dataset[e]
      : t.getAttribute("data-".concat(K(e)));
  }
  function G(t, e, i) {
    N(i)
      ? (t[e] = i)
      : t.dataset
      ? (t.dataset[e] = i)
      : t.setAttribute("data-".concat(K(e)), i);
  }
  var V = /\s\s*/,
    F = (function () {
      var t = !1;
      if (r) {
        var e = !1,
          i = function () {},
          a = Object.defineProperty({}, "once", {
            get: function () {
              return (t = !0), e;
            },
            set: function (t) {
              e = t;
            },
          });
        h.addEventListener("test", i, a), h.removeEventListener("test", i, a);
      }
      return t;
    })();
  function J(t, e, i) {
    var a = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {},
      n = i;
    e.trim()
      .split(V)
      .forEach(function (e) {
        if (!F) {
          var o = t.listeners;
          o &&
            o[e] &&
            o[e][i] &&
            ((n = o[e][i]),
            delete o[e][i],
            0 === Object.keys(o[e]).length && delete o[e],
            0 === Object.keys(o).length && delete t.listeners);
        }
        t.removeEventListener(e, n, a);
      });
  }
  function _(t, e, i) {
    var a = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : {},
      n = i;
    e.trim()
      .split(V)
      .forEach(function (e) {
        if (a.once && !F) {
          var o = t.listeners,
            r = void 0 === o ? {} : o;
          (n = function () {
            delete r[e][i], t.removeEventListener(e, n, a);
            for (var o = arguments.length, h = new Array(o), s = 0; s < o; s++)
              h[s] = arguments[s];
            i.apply(t, h);
          }),
            r[e] || (r[e] = {}),
            r[e][i] && t.removeEventListener(e, r[e][i], a),
            (r[e][i] = n),
            (t.listeners = r);
        }
        t.addEventListener(e, n, a);
      });
  }
  function tt(t, e, i) {
    var a;
    return (
      L(Event) && L(CustomEvent)
        ? (a = new CustomEvent(e, { detail: i, bubbles: !0, cancelable: !0 }))
        : (a = document.createEvent("CustomEvent")).initCustomEvent(
            e,
            !0,
            !0,
            i
          ),
      t.dispatchEvent(a)
    );
  }
  function et(t) {
    var e = t.getBoundingClientRect();
    return {
      left: e.left + (window.pageXOffset - document.documentElement.clientLeft),
      top: e.top + (window.pageYOffset - document.documentElement.clientTop),
    };
  }
  var it = h.location,
    at = /^(\w+:)\/\/([^:\/?#]*):?(\d*)/i;
  function nt(t) {
    var e = t.match(at);
    return (
      null !== e &&
      (e[1] !== it.protocol || e[2] !== it.hostname || e[3] !== it.port)
    );
  }
  function ot(t) {
    var e = "timestamp=".concat(new Date().getTime());
    return t + (-1 === t.indexOf("?") ? "?" : "&") + e;
  }
  function rt(t) {
    var e = t.rotate,
      i = t.scaleX,
      a = t.scaleY,
      n = t.translateX,
      o = t.translateY,
      r = [];
    T(n) && 0 !== n && r.push("translateX(".concat(n, "px)")),
      T(o) && 0 !== o && r.push("translateY(".concat(o, "px)")),
      T(e) && 0 !== e && r.push("rotate(".concat(e, "deg)")),
      T(i) && 1 !== i && r.push("scaleX(".concat(i, ")")),
      T(a) && 1 !== a && r.push("scaleY(".concat(a, ")"));
    var h = r.length ? r.join(" ") : "none";
    return { WebkitTransform: h, msTransform: h, transform: h };
  }
  function ht(t, e) {
    var i = t.pageX,
      a = t.pageY,
      o = { endX: i, endY: a };
    return e ? o : n({ startX: i, startY: a }, o);
  }
  function st(t) {
    var e = t.aspectRatio,
      i = t.height,
      a = t.width,
      n =
        arguments.length > 1 && void 0 !== arguments[1]
          ? arguments[1]
          : "contain",
      o = E(a),
      r = E(i);
    if (o && r) {
      var h = i * e;
      ("contain" === n && h > a) || ("cover" === n && h < a)
        ? (i = a / e)
        : (a = i * e);
    } else o ? (i = a / e) : r && (a = i * e);
    return { width: a, height: i };
  }
  var ct = String.fromCharCode;
  var pt = /^data:.*,/;
  function lt(t) {
    var e,
      i = new DataView(t);
    try {
      var a, n, o;
      if (255 === i.getUint8(0) && 216 === i.getUint8(1))
        for (var r = i.byteLength, h = 2; h + 1 < r; ) {
          if (255 === i.getUint8(h) && 225 === i.getUint8(h + 1)) {
            n = h;
            break;
          }
          h += 1;
        }
      if (n) {
        var s = n + 10;
        if (
          "Exif" ===
          (function (t, e, i) {
            var a = "";
            i += e;
            for (var n = e; n < i; n += 1) a += ct(t.getUint8(n));
            return a;
          })(i, n + 4, 4)
        ) {
          var c = i.getUint16(s);
          if (
            ((a = 18761 === c) || 19789 === c) &&
            42 === i.getUint16(s + 2, a)
          ) {
            var p = i.getUint32(s + 4, a);
            p >= 8 && (o = s + p);
          }
        }
      }
      if (o) {
        var l,
          d,
          m = i.getUint16(o, a);
        for (d = 0; d < m; d += 1)
          if (((l = o + 12 * d + 2), 274 === i.getUint16(l, a))) {
            (l += 8), (e = i.getUint16(l, a)), i.setUint16(l, 1, a);
            break;
          }
      }
    } catch (t) {
      e = 1;
    }
    return e;
  }
  var dt = {
      render: function () {
        this.initContainer(),
          this.initCanvas(),
          this.initCropBox(),
          this.renderCanvas(),
          this.cropped && this.renderCropBox();
      },
      initContainer: function () {
        var t = this.element,
          e = this.options,
          i = this.container,
          a = this.cropper;
        U(a, d), q(t, d);
        var n = {
          width: Math.max(i.offsetWidth, Number(e.minContainerWidth) || 200),
          height: Math.max(i.offsetHeight, Number(e.minContainerHeight) || 100),
        };
        (this.containerData = n),
          I(a, { width: n.width, height: n.height }),
          U(t, d),
          q(a, d);
      },
      initCanvas: function () {
        var t = this.containerData,
          e = this.imageData,
          i = this.options.viewMode,
          a = Math.abs(e.rotate) % 180 == 90,
          n = a ? e.naturalHeight : e.naturalWidth,
          o = a ? e.naturalWidth : e.naturalHeight,
          r = n / o,
          h = t.width,
          s = t.height;
        t.height * r > t.width
          ? 3 === i
            ? (h = t.height * r)
            : (s = t.width / r)
          : 3 === i
          ? (s = t.width / r)
          : (h = t.height * r);
        var c = {
          aspectRatio: r,
          naturalWidth: n,
          naturalHeight: o,
          width: h,
          height: s,
        };
        (c.left = (t.width - h) / 2),
          (c.top = (t.height - s) / 2),
          (c.oldLeft = c.left),
          (c.oldTop = c.top),
          (this.canvasData = c),
          (this.limited = 1 === i || 2 === i),
          this.limitCanvas(!0, !0),
          (this.initialImageData = S({}, e)),
          (this.initialCanvasData = S({}, c));
      },
      limitCanvas: function (t, e) {
        var i = this.options,
          a = this.containerData,
          n = this.canvasData,
          o = this.cropBoxData,
          r = i.viewMode,
          h = n.aspectRatio,
          s = this.cropped && o;
        if (t) {
          var c = Number(i.minCanvasWidth) || 0,
            p = Number(i.minCanvasHeight) || 0;
          r > 1
            ? ((c = Math.max(c, a.width)),
              (p = Math.max(p, a.height)),
              3 === r && (p * h > c ? (c = p * h) : (p = c / h)))
            : r > 0 &&
              (c
                ? (c = Math.max(c, s ? o.width : 0))
                : p
                ? (p = Math.max(p, s ? o.height : 0))
                : s &&
                  ((c = o.width),
                  (p = o.height) * h > c ? (c = p * h) : (p = c / h)));
          var l = st({ aspectRatio: h, width: c, height: p });
          (c = l.width),
            (p = l.height),
            (n.minWidth = c),
            (n.minHeight = p),
            (n.maxWidth = 1 / 0),
            (n.maxHeight = 1 / 0);
        }
        if (e)
          if (r > (s ? 0 : 1)) {
            var d = a.width - n.width,
              m = a.height - n.height;
            (n.minLeft = Math.min(0, d)),
              (n.minTop = Math.min(0, m)),
              (n.maxLeft = Math.max(0, d)),
              (n.maxTop = Math.max(0, m)),
              s &&
                this.limited &&
                ((n.minLeft = Math.min(o.left, o.left + (o.width - n.width))),
                (n.minTop = Math.min(o.top, o.top + (o.height - n.height))),
                (n.maxLeft = o.left),
                (n.maxTop = o.top),
                2 === r &&
                  (n.width >= a.width &&
                    ((n.minLeft = Math.min(0, d)),
                    (n.maxLeft = Math.max(0, d))),
                  n.height >= a.height &&
                    ((n.minTop = Math.min(0, m)),
                    (n.maxTop = Math.max(0, m)))));
          } else
            (n.minLeft = -n.width),
              (n.minTop = -n.height),
              (n.maxLeft = a.width),
              (n.maxTop = a.height);
      },
      renderCanvas: function (t, e) {
        var i = this.canvasData,
          a = this.imageData;
        if (e) {
          var n = (function (t) {
              var e = t.width,
                i = t.height,
                a = t.degree;
              if (90 == (a = Math.abs(a) % 180)) return { width: i, height: e };
              var n = ((a % 90) * Math.PI) / 180,
                o = Math.sin(n),
                r = Math.cos(n),
                h = e * r + i * o,
                s = e * o + i * r;
              return a > 90 ? { width: s, height: h } : { width: h, height: s };
            })({
              width: a.naturalWidth * Math.abs(a.scaleX || 1),
              height: a.naturalHeight * Math.abs(a.scaleY || 1),
              degree: a.rotate || 0,
            }),
            o = n.width,
            r = n.height,
            h = i.width * (o / i.naturalWidth),
            s = i.height * (r / i.naturalHeight);
          (i.left -= (h - i.width) / 2),
            (i.top -= (s - i.height) / 2),
            (i.width = h),
            (i.height = s),
            (i.aspectRatio = o / r),
            (i.naturalWidth = o),
            (i.naturalHeight = r),
            this.limitCanvas(!0, !1);
        }
        (i.width > i.maxWidth || i.width < i.minWidth) && (i.left = i.oldLeft),
          (i.height > i.maxHeight || i.height < i.minHeight) &&
            (i.top = i.oldTop),
          (i.width = Math.min(Math.max(i.width, i.minWidth), i.maxWidth)),
          (i.height = Math.min(Math.max(i.height, i.minHeight), i.maxHeight)),
          this.limitCanvas(!1, !0),
          (i.left = Math.min(Math.max(i.left, i.minLeft), i.maxLeft)),
          (i.top = Math.min(Math.max(i.top, i.minTop), i.maxTop)),
          (i.oldLeft = i.left),
          (i.oldTop = i.top),
          I(
            this.canvas,
            S(
              { width: i.width, height: i.height },
              rt({ translateX: i.left, translateY: i.top })
            )
          ),
          this.renderImage(t),
          this.cropped && this.limited && this.limitCropBox(!0, !0);
      },
      renderImage: function (t) {
        var e = this.canvasData,
          i = this.imageData,
          a = i.naturalWidth * (e.width / e.naturalWidth),
          n = i.naturalHeight * (e.height / e.naturalHeight);
        S(i, {
          width: a,
          height: n,
          left: (e.width - a) / 2,
          top: (e.height - n) / 2,
        }),
          I(
            this.image,
            S(
              { width: i.width, height: i.height },
              rt(S({ translateX: i.left, translateY: i.top }, i))
            )
          ),
          t && this.output();
      },
      initCropBox: function () {
        var t = this.options,
          e = this.canvasData,
          i = t.aspectRatio || t.initialAspectRatio,
          a = Number(t.autoCropArea) || 0.8,
          n = { width: e.width, height: e.height };
        i &&
          (e.height * i > e.width
            ? (n.height = n.width / i)
            : (n.width = n.height * i)),
          (this.cropBoxData = n),
          this.limitCropBox(!0, !0),
          (n.width = Math.min(Math.max(n.width, n.minWidth), n.maxWidth)),
          (n.height = Math.min(Math.max(n.height, n.minHeight), n.maxHeight)),
          (n.width = Math.max(n.minWidth, n.width * a)),
          (n.height = Math.max(n.minHeight, n.height * a)),
          (n.left = e.left + (e.width - n.width) / 2),
          (n.top = e.top + (e.height - n.height) / 2),
          (n.oldLeft = n.left),
          (n.oldTop = n.top),
          (this.initialCropBoxData = S({}, n));
      },
      limitCropBox: function (t, e) {
        var i = this.options,
          a = this.containerData,
          n = this.canvasData,
          o = this.cropBoxData,
          r = this.limited,
          h = i.aspectRatio;
        if (t) {
          var s = Number(i.minCropBoxWidth) || 0,
            c = Number(i.minCropBoxHeight) || 0,
            p = r
              ? Math.min(a.width, n.width, n.width + n.left, a.width - n.left)
              : a.width,
            l = r
              ? Math.min(a.height, n.height, n.height + n.top, a.height - n.top)
              : a.height;
          (s = Math.min(s, a.width)),
            (c = Math.min(c, a.height)),
            h &&
              (s && c
                ? c * h > s
                  ? (c = s / h)
                  : (s = c * h)
                : s
                ? (c = s / h)
                : c && (s = c * h),
              l * h > p ? (l = p / h) : (p = l * h)),
            (o.minWidth = Math.min(s, p)),
            (o.minHeight = Math.min(c, l)),
            (o.maxWidth = p),
            (o.maxHeight = l);
        }
        e &&
          (r
            ? ((o.minLeft = Math.max(0, n.left)),
              (o.minTop = Math.max(0, n.top)),
              (o.maxLeft = Math.min(a.width, n.left + n.width) - o.width),
              (o.maxTop = Math.min(a.height, n.top + n.height) - o.height))
            : ((o.minLeft = 0),
              (o.minTop = 0),
              (o.maxLeft = a.width - o.width),
              (o.maxTop = a.height - o.height)));
      },
      renderCropBox: function () {
        var t = this.options,
          e = this.containerData,
          i = this.cropBoxData;
        (i.width > i.maxWidth || i.width < i.minWidth) && (i.left = i.oldLeft),
          (i.height > i.maxHeight || i.height < i.minHeight) &&
            (i.top = i.oldTop),
          (i.width = Math.min(Math.max(i.width, i.minWidth), i.maxWidth)),
          (i.height = Math.min(Math.max(i.height, i.minHeight), i.maxHeight)),
          this.limitCropBox(!1, !0),
          (i.left = Math.min(Math.max(i.left, i.minLeft), i.maxLeft)),
          (i.top = Math.min(Math.max(i.top, i.minTop), i.maxTop)),
          (i.oldLeft = i.left),
          (i.oldTop = i.top),
          t.movable &&
            t.cropBoxMovable &&
            G(
              this.face,
              v,
              i.width >= e.width && i.height >= e.height ? "move" : "all"
            ),
          I(
            this.cropBox,
            S(
              { width: i.width, height: i.height },
              rt({ translateX: i.left, translateY: i.top })
            )
          ),
          this.cropped && this.limited && this.limitCanvas(!0, !0),
          this.disabled || this.output();
      },
      output: function () {
        this.preview(), tt(this.element, "crop", this.getData());
      },
    },
    mt = {
      initPreview: function () {
        var t = this.element,
          e = this.crossOrigin,
          i = this.options.preview,
          a = e ? this.crossOriginUrl : this.url,
          n = t.alt || "The image to preview",
          o = document.createElement("img");
        if (
          (e && (o.crossOrigin = e),
          (o.src = a),
          (o.alt = n),
          this.viewBox.appendChild(o),
          (this.viewBoxImage = o),
          i)
        ) {
          var r = i;
          "string" == typeof i
            ? (r = t.ownerDocument.querySelectorAll(i))
            : i.querySelector && (r = [i]),
            (this.previews = r),
            R(r, function (t) {
              var i = document.createElement("img");
              G(t, w, {
                width: t.offsetWidth,
                height: t.offsetHeight,
                html: t.innerHTML,
              }),
                e && (i.crossOrigin = e),
                (i.src = a),
                (i.alt = n),
                (i.style.cssText =
                  'display:block;width:100%;height:auto;min-width:0!important;min-height:0!important;max-width:none!important;max-height:none!important;image-orientation:0deg!important;"'),
                (t.innerHTML = ""),
                t.appendChild(i);
            });
        }
      },
      resetPreview: function () {
        R(this.previews, function (t) {
          var e = Z(t, w);
          I(t, { width: e.width, height: e.height }),
            (t.innerHTML = e.html),
            (function (t, e) {
              if (N(t[e]))
                try {
                  delete t[e];
                } catch (i) {
                  t[e] = void 0;
                }
              else if (t.dataset)
                try {
                  delete t.dataset[e];
                } catch (i) {
                  t.dataset[e] = void 0;
                }
              else t.removeAttribute("data-".concat(K(e)));
            })(t, w);
        });
      },
      preview: function () {
        var t = this.imageData,
          e = this.canvasData,
          i = this.cropBoxData,
          a = i.width,
          n = i.height,
          o = t.width,
          r = t.height,
          h = i.left - e.left - t.left,
          s = i.top - e.top - t.top;
        this.cropped &&
          !this.disabled &&
          (I(
            this.viewBoxImage,
            S(
              { width: o, height: r },
              rt(S({ translateX: -h, translateY: -s }, t))
            )
          ),
          R(this.previews, function (e) {
            var i = Z(e, w),
              c = i.width,
              p = i.height,
              l = c,
              d = p,
              m = 1;
            a && (d = n * (m = c / a)),
              n && d > p && ((l = a * (m = p / n)), (d = p)),
              I(e, { width: l, height: d }),
              I(
                e.getElementsByTagName("img")[0],
                S(
                  { width: o * m, height: r * m },
                  rt(S({ translateX: -h * m, translateY: -s * m }, t))
                )
              );
          }));
      },
    },
    ut = {
      bind: function () {
        var t = this.element,
          e = this.options,
          i = this.cropper;
        L(e.cropstart) && _(t, "cropstart", e.cropstart),
          L(e.cropmove) && _(t, "cropmove", e.cropmove),
          L(e.cropend) && _(t, "cropend", e.cropend),
          L(e.crop) && _(t, "crop", e.crop),
          L(e.zoom) && _(t, "zoom", e.zoom),
          _(i, b, (this.onCropStart = this.cropStart.bind(this))),
          e.zoomable &&
            e.zoomOnWheel &&
            _(i, "wheel", (this.onWheel = this.wheel.bind(this)), {
              passive: !1,
              capture: !0,
            }),
          e.toggleDragModeOnDblclick &&
            _(i, "dblclick", (this.onDblclick = this.dblclick.bind(this))),
          _(t.ownerDocument, y, (this.onCropMove = this.cropMove.bind(this))),
          _(t.ownerDocument, x, (this.onCropEnd = this.cropEnd.bind(this))),
          e.responsive &&
            _(window, "resize", (this.onResize = this.resize.bind(this)));
      },
      unbind: function () {
        var t = this.element,
          e = this.options,
          i = this.cropper;
        L(e.cropstart) && J(t, "cropstart", e.cropstart),
          L(e.cropmove) && J(t, "cropmove", e.cropmove),
          L(e.cropend) && J(t, "cropend", e.cropend),
          L(e.crop) && J(t, "crop", e.crop),
          L(e.zoom) && J(t, "zoom", e.zoom),
          J(i, b, this.onCropStart),
          e.zoomable &&
            e.zoomOnWheel &&
            J(i, "wheel", this.onWheel, { passive: !1, capture: !0 }),
          e.toggleDragModeOnDblclick && J(i, "dblclick", this.onDblclick),
          J(t.ownerDocument, y, this.onCropMove),
          J(t.ownerDocument, x, this.onCropEnd),
          e.responsive && J(window, "resize", this.onResize);
      },
    },
    gt = {
      resize: function () {
        var t = this.options,
          e = this.container,
          i = this.containerData,
          a = Number(t.minContainerWidth) || 200,
          n = Number(t.minContainerHeight) || 100;
        if (!(this.disabled || i.width <= a || i.height <= n)) {
          var o,
            r,
            h = e.offsetWidth / i.width;
          if (1 !== h || e.offsetHeight !== i.height)
            t.restore &&
              ((o = this.getCanvasData()), (r = this.getCropBoxData())),
              this.render(),
              t.restore &&
                (this.setCanvasData(
                  R(o, function (t, e) {
                    o[e] = t * h;
                  })
                ),
                this.setCropBoxData(
                  R(r, function (t, e) {
                    r[e] = t * h;
                  })
                ));
        }
      },
      dblclick: function () {
        var t, e;
        this.disabled ||
          "none" === this.options.dragMode ||
          this.setDragMode(
            ((t = this.dragBox),
            (e = p),
            (
              t.classList
                ? t.classList.contains(e)
                : t.className.indexOf(e) > -1
            )
              ? "move"
              : "crop")
          );
      },
      wheel: function (t) {
        var e = this,
          i = Number(this.options.wheelZoomRatio) || 0.1,
          a = 1;
        this.disabled ||
          (t.preventDefault(),
          this.wheeling ||
            ((this.wheeling = !0),
            setTimeout(function () {
              e.wheeling = !1;
            }, 50),
            t.deltaY
              ? (a = t.deltaY > 0 ? 1 : -1)
              : t.wheelDelta
              ? (a = -t.wheelDelta / 120)
              : t.detail && (a = t.detail > 0 ? 1 : -1),
            this.zoom(-a * i, t)));
      },
      cropStart: function (t) {
        var e = t.buttons,
          i = t.button;
        if (
          !(
            this.disabled ||
            (("mousedown" === t.type ||
              ("pointerdown" === t.type && "mouse" === t.pointerType)) &&
              ((T(e) && 1 !== e) || (T(i) && 0 !== i) || t.ctrlKey))
          )
        ) {
          var a,
            n = this.options,
            o = this.pointers;
          t.changedTouches
            ? R(t.changedTouches, function (t) {
                o[t.identifier] = ht(t);
              })
            : (o[t.pointerId || 0] = ht(t)),
            (a =
              Object.keys(o).length > 1 && n.zoomable && n.zoomOnTouch
                ? "zoom"
                : Z(t.target, v)),
            M.test(a) &&
              !1 !==
                tt(this.element, "cropstart", {
                  originalEvent: t,
                  action: a,
                }) &&
              (t.preventDefault(),
              (this.action = a),
              (this.cropping = !1),
              "crop" === a && ((this.cropping = !0), U(this.dragBox, g)));
        }
      },
      cropMove: function (t) {
        var e = this.action;
        if (!this.disabled && e) {
          var i = this.pointers;
          t.preventDefault(),
            !1 !==
              tt(this.element, "cropmove", { originalEvent: t, action: e }) &&
              (t.changedTouches
                ? R(t.changedTouches, function (t) {
                    S(i[t.identifier] || {}, ht(t, !0));
                  })
                : S(i[t.pointerId || 0] || {}, ht(t, !0)),
              this.change(t));
        }
      },
      cropEnd: function (t) {
        if (!this.disabled) {
          var e = this.action,
            i = this.pointers;
          t.changedTouches
            ? R(t.changedTouches, function (t) {
                delete i[t.identifier];
              })
            : delete i[t.pointerId || 0],
            e &&
              (t.preventDefault(),
              Object.keys(i).length || (this.action = ""),
              this.cropping &&
                ((this.cropping = !1),
                $(this.dragBox, g, this.cropped && this.options.modal)),
              tt(this.element, "cropend", { originalEvent: t, action: e }));
        }
      },
    },
    ft = {
      change: function (t) {
        var e,
          i = this.options,
          a = this.canvasData,
          o = this.containerData,
          r = this.cropBoxData,
          h = this.pointers,
          s = this.action,
          c = i.aspectRatio,
          p = r.left,
          l = r.top,
          m = r.width,
          u = r.height,
          g = p + m,
          f = l + u,
          v = 0,
          w = 0,
          b = o.width,
          y = o.height,
          x = !0;
        !c && t.shiftKey && (c = m && u ? m / u : 1),
          this.limited &&
            ((v = r.minLeft),
            (w = r.minTop),
            (b = v + Math.min(o.width, a.width, a.left + a.width)),
            (y = w + Math.min(o.height, a.height, a.top + a.height)));
        var M = h[Object.keys(h)[0]],
          C = { x: M.endX - M.startX, y: M.endY - M.startY },
          D = function (t) {
            switch (t) {
              case "e":
                g + C.x > b && (C.x = b - g);
                break;
              case "w":
                p + C.x < v && (C.x = v - p);
                break;
              case "n":
                l + C.y < w && (C.y = w - l);
                break;
              case "s":
                f + C.y > y && (C.y = y - f);
            }
          };
        switch (s) {
          case "all":
            (p += C.x), (l += C.y);
            break;
          case "e":
            if (C.x >= 0 && (g >= b || (c && (l <= w || f >= y)))) {
              x = !1;
              break;
            }
            D("e"),
              (m += C.x) < 0 && ((s = "w"), (p -= m = -m)),
              c && ((u = m / c), (l += (r.height - u) / 2));
            break;
          case "n":
            if (C.y <= 0 && (l <= w || (c && (p <= v || g >= b)))) {
              x = !1;
              break;
            }
            D("n"),
              (u -= C.y),
              (l += C.y),
              u < 0 && ((s = "s"), (l -= u = -u)),
              c && ((m = u * c), (p += (r.width - m) / 2));
            break;
          case "w":
            if (C.x <= 0 && (p <= v || (c && (l <= w || f >= y)))) {
              x = !1;
              break;
            }
            D("w"),
              (m -= C.x),
              (p += C.x),
              m < 0 && ((s = "e"), (p -= m = -m)),
              c && ((u = m / c), (l += (r.height - u) / 2));
            break;
          case "s":
            if (C.y >= 0 && (f >= y || (c && (p <= v || g >= b)))) {
              x = !1;
              break;
            }
            D("s"),
              (u += C.y) < 0 && ((s = "n"), (l -= u = -u)),
              c && ((m = u * c), (p += (r.width - m) / 2));
            break;
          case "ne":
            if (c) {
              if (C.y <= 0 && (l <= w || g >= b)) {
                x = !1;
                break;
              }
              D("n"), (u -= C.y), (l += C.y), (m = u * c);
            } else
              D("n"),
                D("e"),
                C.x >= 0
                  ? g < b
                    ? (m += C.x)
                    : C.y <= 0 && l <= w && (x = !1)
                  : (m += C.x),
                C.y <= 0
                  ? l > w && ((u -= C.y), (l += C.y))
                  : ((u -= C.y), (l += C.y));
            m < 0 && u < 0
              ? ((s = "sw"), (l -= u = -u), (p -= m = -m))
              : m < 0
              ? ((s = "nw"), (p -= m = -m))
              : u < 0 && ((s = "se"), (l -= u = -u));
            break;
          case "nw":
            if (c) {
              if (C.y <= 0 && (l <= w || p <= v)) {
                x = !1;
                break;
              }
              D("n"), (u -= C.y), (l += C.y), (m = u * c), (p += r.width - m);
            } else
              D("n"),
                D("w"),
                C.x <= 0
                  ? p > v
                    ? ((m -= C.x), (p += C.x))
                    : C.y <= 0 && l <= w && (x = !1)
                  : ((m -= C.x), (p += C.x)),
                C.y <= 0
                  ? l > w && ((u -= C.y), (l += C.y))
                  : ((u -= C.y), (l += C.y));
            m < 0 && u < 0
              ? ((s = "se"), (l -= u = -u), (p -= m = -m))
              : m < 0
              ? ((s = "ne"), (p -= m = -m))
              : u < 0 && ((s = "sw"), (l -= u = -u));
            break;
          case "sw":
            if (c) {
              if (C.x <= 0 && (p <= v || f >= y)) {
                x = !1;
                break;
              }
              D("w"), (m -= C.x), (p += C.x), (u = m / c);
            } else
              D("s"),
                D("w"),
                C.x <= 0
                  ? p > v
                    ? ((m -= C.x), (p += C.x))
                    : C.y >= 0 && f >= y && (x = !1)
                  : ((m -= C.x), (p += C.x)),
                C.y >= 0 ? f < y && (u += C.y) : (u += C.y);
            m < 0 && u < 0
              ? ((s = "ne"), (l -= u = -u), (p -= m = -m))
              : m < 0
              ? ((s = "se"), (p -= m = -m))
              : u < 0 && ((s = "nw"), (l -= u = -u));
            break;
          case "se":
            if (c) {
              if (C.x >= 0 && (g >= b || f >= y)) {
                x = !1;
                break;
              }
              D("e"), (u = (m += C.x) / c);
            } else
              D("s"),
                D("e"),
                C.x >= 0
                  ? g < b
                    ? (m += C.x)
                    : C.y >= 0 && f >= y && (x = !1)
                  : (m += C.x),
                C.y >= 0 ? f < y && (u += C.y) : (u += C.y);
            m < 0 && u < 0
              ? ((s = "nw"), (l -= u = -u), (p -= m = -m))
              : m < 0
              ? ((s = "sw"), (p -= m = -m))
              : u < 0 && ((s = "ne"), (l -= u = -u));
            break;
          case "move":
            this.move(C.x, C.y), (x = !1);
            break;
          case "zoom":
            this.zoom(
              (function (t) {
                var e = n({}, t),
                  i = [];
                return (
                  R(t, function (t, a) {
                    delete e[a],
                      R(e, function (e) {
                        var a = Math.abs(t.startX - e.startX),
                          n = Math.abs(t.startY - e.startY),
                          o = Math.abs(t.endX - e.endX),
                          r = Math.abs(t.endY - e.endY),
                          h = Math.sqrt(a * a + n * n),
                          s = (Math.sqrt(o * o + r * r) - h) / h;
                        i.push(s);
                      });
                  }),
                  i.sort(function (t, e) {
                    return Math.abs(t) < Math.abs(e);
                  }),
                  i[0]
                );
              })(h),
              t
            ),
              (x = !1);
            break;
          case "crop":
            if (!C.x || !C.y) {
              x = !1;
              break;
            }
            (e = et(this.cropper)),
              (p = M.startX - e.left),
              (l = M.startY - e.top),
              (m = r.minWidth),
              (u = r.minHeight),
              C.x > 0
                ? (s = C.y > 0 ? "se" : "ne")
                : C.x < 0 && ((p -= m), (s = C.y > 0 ? "sw" : "nw")),
              C.y < 0 && (l -= u),
              this.cropped ||
                (q(this.cropBox, d),
                (this.cropped = !0),
                this.limited && this.limitCropBox(!0, !0));
        }
        x &&
          ((r.width = m),
          (r.height = u),
          (r.left = p),
          (r.top = l),
          (this.action = s),
          this.renderCropBox()),
          R(h, function (t) {
            (t.startX = t.endX), (t.startY = t.endY);
          });
      },
    },
    vt = {
      crop: function () {
        return (
          !this.ready ||
            this.cropped ||
            this.disabled ||
            ((this.cropped = !0),
            this.limitCropBox(!0, !0),
            this.options.modal && U(this.dragBox, g),
            q(this.cropBox, d),
            this.setCropBoxData(this.initialCropBoxData)),
          this
        );
      },
      reset: function () {
        return (
          this.ready &&
            !this.disabled &&
            ((this.imageData = S({}, this.initialImageData)),
            (this.canvasData = S({}, this.initialCanvasData)),
            (this.cropBoxData = S({}, this.initialCropBoxData)),
            this.renderCanvas(),
            this.cropped && this.renderCropBox()),
          this
        );
      },
      clear: function () {
        return (
          this.cropped &&
            !this.disabled &&
            (S(this.cropBoxData, { left: 0, top: 0, width: 0, height: 0 }),
            (this.cropped = !1),
            this.renderCropBox(),
            this.limitCanvas(!0, !0),
            this.renderCanvas(),
            q(this.dragBox, g),
            U(this.cropBox, d)),
          this
        );
      },
      replace: function (t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
        return (
          !this.disabled &&
            t &&
            (this.isImg && (this.element.src = t),
            e
              ? ((this.url = t),
                (this.image.src = t),
                this.ready &&
                  ((this.viewBoxImage.src = t),
                  R(this.previews, function (e) {
                    e.getElementsByTagName("img")[0].src = t;
                  })))
              : (this.isImg && (this.replaced = !0),
                (this.options.data = null),
                this.uncreate(),
                this.load(t))),
          this
        );
      },
      enable: function () {
        return (
          this.ready &&
            this.disabled &&
            ((this.disabled = !1), q(this.cropper, l)),
          this
        );
      },
      disable: function () {
        return (
          this.ready &&
            !this.disabled &&
            ((this.disabled = !0), U(this.cropper, l)),
          this
        );
      },
      destroy: function () {
        var t = this.element;
        return t.cropper
          ? ((t.cropper = void 0),
            this.isImg && this.replaced && (t.src = this.originalUrl),
            this.uncreate(),
            this)
          : this;
      },
      move: function (t) {
        var e =
            arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t,
          i = this.canvasData,
          a = i.left,
          n = i.top;
        return this.moveTo(W(t) ? t : a + Number(t), W(e) ? e : n + Number(e));
      },
      moveTo: function (t) {
        var e =
            arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t,
          i = this.canvasData,
          a = !1;
        return (
          (t = Number(t)),
          (e = Number(e)),
          this.ready &&
            !this.disabled &&
            this.options.movable &&
            (T(t) && ((i.left = t), (a = !0)),
            T(e) && ((i.top = e), (a = !0)),
            a && this.renderCanvas(!0)),
          this
        );
      },
      zoom: function (t, e) {
        var i = this.canvasData;
        return (
          (t = (t = Number(t)) < 0 ? 1 / (1 - t) : 1 + t),
          this.zoomTo((i.width * t) / i.naturalWidth, null, e)
        );
      },
      zoomTo: function (t, e, i) {
        var a = this.options,
          n = this.canvasData,
          o = n.width,
          r = n.height,
          h = n.naturalWidth,
          s = n.naturalHeight;
        if (
          (t = Number(t)) >= 0 &&
          this.ready &&
          !this.disabled &&
          a.zoomable
        ) {
          var c = h * t,
            p = s * t;
          if (
            !1 ===
            tt(this.element, "zoom", {
              ratio: t,
              oldRatio: o / h,
              originalEvent: i,
            })
          )
            return this;
          if (i) {
            var l = this.pointers,
              d = et(this.cropper),
              m =
                l && Object.keys(l).length
                  ? (function (t) {
                      var e = 0,
                        i = 0,
                        a = 0;
                      return (
                        R(t, function (t) {
                          var n = t.startX,
                            o = t.startY;
                          (e += n), (i += o), (a += 1);
                        }),
                        { pageX: (e /= a), pageY: (i /= a) }
                      );
                    })(l)
                  : { pageX: i.pageX, pageY: i.pageY };
            (n.left -= (c - o) * ((m.pageX - d.left - n.left) / o)),
              (n.top -= (p - r) * ((m.pageY - d.top - n.top) / r));
          } else
            z(e) && T(e.x) && T(e.y)
              ? ((n.left -= (c - o) * ((e.x - n.left) / o)),
                (n.top -= (p - r) * ((e.y - n.top) / r)))
              : ((n.left -= (c - o) / 2), (n.top -= (p - r) / 2));
          (n.width = c), (n.height = p), this.renderCanvas(!0);
        }
        return this;
      },
      rotate: function (t) {
        return this.rotateTo((this.imageData.rotate || 0) + Number(t));
      },
      rotateTo: function (t) {
        return (
          T((t = Number(t))) &&
            this.ready &&
            !this.disabled &&
            this.options.rotatable &&
            ((this.imageData.rotate = t % 360), this.renderCanvas(!0, !0)),
          this
        );
      },
      scaleX: function (t) {
        var e = this.imageData.scaleY;
        return this.scale(t, T(e) ? e : 1);
      },
      scaleY: function (t) {
        var e = this.imageData.scaleX;
        return this.scale(T(e) ? e : 1, t);
      },
      scale: function (t) {
        var e =
            arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t,
          i = this.imageData,
          a = !1;
        return (
          (t = Number(t)),
          (e = Number(e)),
          this.ready &&
            !this.disabled &&
            this.options.scalable &&
            (T(t) && ((i.scaleX = t), (a = !0)),
            T(e) && ((i.scaleY = e), (a = !0)),
            a && this.renderCanvas(!0, !0)),
          this
        );
      },
      getData: function () {
        var t,
          e = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
          i = this.options,
          a = this.imageData,
          n = this.canvasData,
          o = this.cropBoxData;
        if (this.ready && this.cropped) {
          t = {
            x: o.left - n.left,
            y: o.top - n.top,
            width: o.width,
            height: o.height,
          };
          var r = a.width / a.naturalWidth;
          if (
            (R(t, function (e, i) {
              t[i] = e / r;
            }),
            e)
          ) {
            var h = Math.round(t.y + t.height),
              s = Math.round(t.x + t.width);
            (t.x = Math.round(t.x)),
              (t.y = Math.round(t.y)),
              (t.width = s - t.x),
              (t.height = h - t.y);
          }
        } else t = { x: 0, y: 0, width: 0, height: 0 };
        return (
          i.rotatable && (t.rotate = a.rotate || 0),
          i.scalable &&
            ((t.scaleX = a.scaleX || 1), (t.scaleY = a.scaleY || 1)),
          t
        );
      },
      setData: function (t) {
        var e = this.options,
          i = this.imageData,
          a = this.canvasData,
          n = {};
        if (this.ready && !this.disabled && z(t)) {
          var o = !1;
          e.rotatable &&
            T(t.rotate) &&
            t.rotate !== i.rotate &&
            ((i.rotate = t.rotate), (o = !0)),
            e.scalable &&
              (T(t.scaleX) &&
                t.scaleX !== i.scaleX &&
                ((i.scaleX = t.scaleX), (o = !0)),
              T(t.scaleY) &&
                t.scaleY !== i.scaleY &&
                ((i.scaleY = t.scaleY), (o = !0))),
            o && this.renderCanvas(!0, !0);
          var r = i.width / i.naturalWidth;
          T(t.x) && (n.left = t.x * r + a.left),
            T(t.y) && (n.top = t.y * r + a.top),
            T(t.width) && (n.width = t.width * r),
            T(t.height) && (n.height = t.height * r),
            this.setCropBoxData(n);
        }
        return this;
      },
      getContainerData: function () {
        return this.ready ? S({}, this.containerData) : {};
      },
      getImageData: function () {
        return this.sized ? S({}, this.imageData) : {};
      },
      getCanvasData: function () {
        var t = this.canvasData,
          e = {};
        return (
          this.ready &&
            R(
              [
                "left",
                "top",
                "width",
                "height",
                "naturalWidth",
                "naturalHeight",
              ],
              function (i) {
                e[i] = t[i];
              }
            ),
          e
        );
      },
      setCanvasData: function (t) {
        var e = this.canvasData,
          i = e.aspectRatio;
        return (
          this.ready &&
            !this.disabled &&
            z(t) &&
            (T(t.left) && (e.left = t.left),
            T(t.top) && (e.top = t.top),
            T(t.width)
              ? ((e.width = t.width), (e.height = t.width / i))
              : T(t.height) &&
                ((e.height = t.height), (e.width = t.height * i)),
            this.renderCanvas(!0)),
          this
        );
      },
      getCropBoxData: function () {
        var t,
          e = this.cropBoxData;
        return (
          this.ready &&
            this.cropped &&
            (t = {
              left: e.left,
              top: e.top,
              width: e.width,
              height: e.height,
            }),
          t || {}
        );
      },
      setCropBoxData: function (t) {
        var e,
          i,
          a = this.cropBoxData,
          n = this.options.aspectRatio;
        return (
          this.ready &&
            this.cropped &&
            !this.disabled &&
            z(t) &&
            (T(t.left) && (a.left = t.left),
            T(t.top) && (a.top = t.top),
            T(t.width) &&
              t.width !== a.width &&
              ((e = !0), (a.width = t.width)),
            T(t.height) &&
              t.height !== a.height &&
              ((i = !0), (a.height = t.height)),
            n && (e ? (a.height = a.width / n) : i && (a.width = a.height * n)),
            this.renderCropBox()),
          this
        );
      },
      getCroppedCanvas: function () {
        var t =
          arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
        if (!this.ready || !window.HTMLCanvasElement) return null;
        var e = this.canvasData,
          i = (function (t, e, i, a) {
            var n = e.aspectRatio,
              r = e.naturalWidth,
              h = e.naturalHeight,
              s = e.rotate,
              c = void 0 === s ? 0 : s,
              p = e.scaleX,
              l = void 0 === p ? 1 : p,
              d = e.scaleY,
              m = void 0 === d ? 1 : d,
              u = i.aspectRatio,
              g = i.naturalWidth,
              f = i.naturalHeight,
              v = a.fillColor,
              w = void 0 === v ? "transparent" : v,
              b = a.imageSmoothingEnabled,
              y = void 0 === b || b,
              x = a.imageSmoothingQuality,
              M = void 0 === x ? "low" : x,
              C = a.maxWidth,
              D = void 0 === C ? 1 / 0 : C,
              B = a.maxHeight,
              k = void 0 === B ? 1 / 0 : B,
              O = a.minWidth,
              T = void 0 === O ? 0 : O,
              E = a.minHeight,
              W = void 0 === E ? 0 : E,
              N = document.createElement("canvas"),
              H = N.getContext("2d"),
              z = st({ aspectRatio: u, width: D, height: k }),
              L = st({ aspectRatio: u, width: T, height: W }, "cover"),
              Y = Math.min(z.width, Math.max(L.width, g)),
              X = Math.min(z.height, Math.max(L.height, f)),
              R = st({ aspectRatio: n, width: D, height: k }),
              S = st({ aspectRatio: n, width: T, height: W }, "cover"),
              A = Math.min(R.width, Math.max(S.width, r)),
              P = Math.min(R.height, Math.max(S.height, h)),
              I = [-A / 2, -P / 2, A, P];
            return (
              (N.width = j(Y)),
              (N.height = j(X)),
              (H.fillStyle = w),
              H.fillRect(0, 0, Y, X),
              H.save(),
              H.translate(Y / 2, X / 2),
              H.rotate((c * Math.PI) / 180),
              H.scale(l, m),
              (H.imageSmoothingEnabled = y),
              (H.imageSmoothingQuality = M),
              H.drawImage.apply(
                H,
                [t].concat(
                  o(
                    I.map(function (t) {
                      return Math.floor(j(t));
                    })
                  )
                )
              ),
              H.restore(),
              N
            );
          })(this.image, this.imageData, e, t);
        if (!this.cropped) return i;
        var a = this.getData(),
          n = a.x,
          r = a.y,
          h = a.width,
          s = a.height,
          c = i.width / Math.floor(e.naturalWidth);
        1 !== c && ((n *= c), (r *= c), (h *= c), (s *= c));
        var p = h / s,
          l = st({
            aspectRatio: p,
            width: t.maxWidth || 1 / 0,
            height: t.maxHeight || 1 / 0,
          }),
          d = st(
            {
              aspectRatio: p,
              width: t.minWidth || 0,
              height: t.minHeight || 0,
            },
            "cover"
          ),
          m = st({
            aspectRatio: p,
            width: t.width || (1 !== c ? i.width : h),
            height: t.height || (1 !== c ? i.height : s),
          }),
          u = m.width,
          g = m.height;
        (u = Math.min(l.width, Math.max(d.width, u))),
          (g = Math.min(l.height, Math.max(d.height, g)));
        var f = document.createElement("canvas"),
          v = f.getContext("2d");
        (f.width = j(u)),
          (f.height = j(g)),
          (v.fillStyle = t.fillColor || "transparent"),
          v.fillRect(0, 0, u, g);
        var w = t.imageSmoothingEnabled,
          b = void 0 === w || w,
          y = t.imageSmoothingQuality;
        (v.imageSmoothingEnabled = b), y && (v.imageSmoothingQuality = y);
        var x,
          M,
          C,
          D,
          B,
          k,
          O = i.width,
          T = i.height,
          E = n,
          W = r;
        E <= -h || E > O
          ? ((E = 0), (x = 0), (C = 0), (B = 0))
          : E <= 0
          ? ((C = -E), (E = 0), (B = x = Math.min(O, h + E)))
          : E <= O && ((C = 0), (B = x = Math.min(h, O - E))),
          x <= 0 || W <= -s || W > T
            ? ((W = 0), (M = 0), (D = 0), (k = 0))
            : W <= 0
            ? ((D = -W), (W = 0), (k = M = Math.min(T, s + W)))
            : W <= T && ((D = 0), (k = M = Math.min(s, T - W)));
        var N = [E, W, x, M];
        if (B > 0 && k > 0) {
          var H = u / h;
          N.push(C * H, D * H, B * H, k * H);
        }
        return (
          v.drawImage.apply(
            v,
            [i].concat(
              o(
                N.map(function (t) {
                  return Math.floor(j(t));
                })
              )
            )
          ),
          f
        );
      },
      setAspectRatio: function (t) {
        var e = this.options;
        return (
          this.disabled ||
            W(t) ||
            ((e.aspectRatio = Math.max(0, t) || NaN),
            this.ready &&
              (this.initCropBox(), this.cropped && this.renderCropBox())),
          this
        );
      },
      setDragMode: function (t) {
        var e = this.options,
          i = this.dragBox,
          a = this.face;
        if (this.ready && !this.disabled) {
          var n = "crop" === t,
            o = e.movable && "move" === t;
          (t = n || o ? t : "none"),
            (e.dragMode = t),
            G(i, v, t),
            $(i, p, n),
            $(i, f, o),
            e.cropBoxMovable || (G(a, v, t), $(a, p, n), $(a, f, o));
        }
        return this;
      },
    },
    wt = h.Cropper,
    bt = (function () {
      function t(e) {
        var i =
          arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
        if (
          ((function (t, e) {
            if (!(t instanceof e))
              throw new TypeError("Cannot call a class as a function");
          })(this, t),
          !e || !B.test(e.tagName))
        )
          throw new Error(
            "The first argument is required and must be an <img> or <canvas> element."
          );
        (this.element = e),
          (this.options = S({}, k, z(i) && i)),
          (this.cropped = !1),
          (this.disabled = !1),
          (this.pointers = {}),
          (this.ready = !1),
          (this.reloading = !1),
          (this.replaced = !1),
          (this.sized = !1),
          (this.sizing = !1),
          this.init();
      }
      var i, a, n;
      return (
        (i = t),
        (n = [
          {
            key: "noConflict",
            value: function () {
              return (window.Cropper = wt), t;
            },
          },
          {
            key: "setDefaults",
            value: function (t) {
              S(k, z(t) && t);
            },
          },
        ]),
        (a = [
          {
            key: "init",
            value: function () {
              var t,
                e = this.element,
                i = e.tagName.toLowerCase();
              if (!e.cropper) {
                if (((e.cropper = this), "img" === i)) {
                  if (
                    ((this.isImg = !0),
                    (t = e.getAttribute("src") || ""),
                    (this.originalUrl = t),
                    !t)
                  )
                    return;
                  t = e.src;
                } else
                  "canvas" === i &&
                    window.HTMLCanvasElement &&
                    (t = e.toDataURL());
                this.load(t);
              }
            },
          },
          {
            key: "load",
            value: function (t) {
              var e = this;
              if (t) {
                (this.url = t), (this.imageData = {});
                var i = this.element,
                  a = this.options;
                if (
                  (a.rotatable || a.scalable || (a.checkOrientation = !1),
                  a.checkOrientation && window.ArrayBuffer)
                )
                  if (C.test(t))
                    D.test(t)
                      ? this.read(
                          ((n = t.replace(pt, "")),
                          (o = atob(n)),
                          (r = new ArrayBuffer(o.length)),
                          R((h = new Uint8Array(r)), function (t, e) {
                            h[e] = o.charCodeAt(e);
                          }),
                          r)
                        )
                      : this.clone();
                  else {
                    var n,
                      o,
                      r,
                      h,
                      s = new XMLHttpRequest(),
                      c = this.clone.bind(this);
                    (this.reloading = !0),
                      (this.xhr = s),
                      (s.onabort = c),
                      (s.onerror = c),
                      (s.ontimeout = c),
                      (s.onprogress = function () {
                        "image/jpeg" !== s.getResponseHeader("content-type") &&
                          s.abort();
                      }),
                      (s.onload = function () {
                        e.read(s.response);
                      }),
                      (s.onloadend = function () {
                        (e.reloading = !1), (e.xhr = null);
                      }),
                      a.checkCrossOrigin &&
                        nt(t) &&
                        i.crossOrigin &&
                        (t = ot(t)),
                      s.open("GET", t),
                      (s.responseType = "arraybuffer"),
                      (s.withCredentials = "use-credentials" === i.crossOrigin),
                      s.send();
                  }
                else this.clone();
              }
            },
          },
          {
            key: "read",
            value: function (t) {
              var e = this.options,
                i = this.imageData,
                a = lt(t),
                n = 0,
                o = 1,
                r = 1;
              if (a > 1) {
                this.url = (function (t, e) {
                  for (var i = [], a = new Uint8Array(t); a.length > 0; )
                    i.push(ct.apply(null, X(a.subarray(0, 8192)))),
                      (a = a.subarray(8192));
                  return "data:".concat(e, ";base64,").concat(btoa(i.join("")));
                })(t, "image/jpeg");
                var h = (function (t) {
                  var e = 0,
                    i = 1,
                    a = 1;
                  switch (t) {
                    case 2:
                      i = -1;
                      break;
                    case 3:
                      e = -180;
                      break;
                    case 4:
                      a = -1;
                      break;
                    case 5:
                      (e = 90), (a = -1);
                      break;
                    case 6:
                      e = 90;
                      break;
                    case 7:
                      (e = 90), (i = -1);
                      break;
                    case 8:
                      e = -90;
                  }
                  return { rotate: e, scaleX: i, scaleY: a };
                })(a);
                (n = h.rotate), (o = h.scaleX), (r = h.scaleY);
              }
              e.rotatable && (i.rotate = n),
                e.scalable && ((i.scaleX = o), (i.scaleY = r)),
                this.clone();
            },
          },
          {
            key: "clone",
            value: function () {
              var t = this.element,
                e = this.url,
                i = t.crossOrigin,
                a = e;
              this.options.checkCrossOrigin &&
                nt(e) &&
                (i || (i = "anonymous"), (a = ot(e))),
                (this.crossOrigin = i),
                (this.crossOriginUrl = a);
              var n = document.createElement("img");
              i && (n.crossOrigin = i),
                (n.src = a || e),
                (n.alt = t.alt || "The image to crop"),
                (this.image = n),
                (n.onload = this.start.bind(this)),
                (n.onerror = this.stop.bind(this)),
                U(n, m),
                t.parentNode.insertBefore(n, t.nextSibling);
            },
          },
          {
            key: "start",
            value: function () {
              var t = this,
                e = this.image;
              (e.onload = null), (e.onerror = null), (this.sizing = !0);
              var i =
                  h.navigator &&
                  /(?:iPad|iPhone|iPod).*?AppleWebKit/i.test(
                    h.navigator.userAgent
                  ),
                a = function (e, i) {
                  S(t.imageData, {
                    naturalWidth: e,
                    naturalHeight: i,
                    aspectRatio: e / i,
                  }),
                    (t.sizing = !1),
                    (t.sized = !0),
                    t.build();
                };
              if (!e.naturalWidth || i) {
                var n = document.createElement("img"),
                  o = document.body || document.documentElement;
                (this.sizingImage = n),
                  (n.onload = function () {
                    a(n.width, n.height), i || o.removeChild(n);
                  }),
                  (n.src = e.src),
                  i ||
                    ((n.style.cssText =
                      "left:0;max-height:none!important;max-width:none!important;min-height:0!important;min-width:0!important;opacity:0;position:absolute;top:0;z-index:-1;"),
                    o.appendChild(n));
              } else a(e.naturalWidth, e.naturalHeight);
            },
          },
          {
            key: "stop",
            value: function () {
              var t = this.image;
              (t.onload = null),
                (t.onerror = null),
                t.parentNode.removeChild(t),
                (this.image = null);
            },
          },
          {
            key: "build",
            value: function () {
              if (this.sized && !this.ready) {
                var t = this.element,
                  e = this.options,
                  i = this.image,
                  a = t.parentNode,
                  n = document.createElement("div");
                n.innerHTML =
                  '<div class="cropper-container" touch-action="none"><div class="cropper-wrap-box"><div class="cropper-canvas"></div></div><div class="cropper-drag-box"></div><div class="cropper-crop-box"><span class="cropper-view-box"></span><span class="cropper-dashed dashed-h"></span><span class="cropper-dashed dashed-v"></span><span class="cropper-center"></span><span class="cropper-face"></span><span class="cropper-line line-e" data-cropper-action="e"></span><span class="cropper-line line-n" data-cropper-action="n"></span><span class="cropper-line line-w" data-cropper-action="w"></span><span class="cropper-line line-s" data-cropper-action="s"></span><span class="cropper-point point-e" data-cropper-action="e"></span><span class="cropper-point point-n" data-cropper-action="n"></span><span class="cropper-point point-w" data-cropper-action="w"></span><span class="cropper-point point-s" data-cropper-action="s"></span><span class="cropper-point point-ne" data-cropper-action="ne"></span><span class="cropper-point point-nw" data-cropper-action="nw"></span><span class="cropper-point point-sw" data-cropper-action="sw"></span><span class="cropper-point point-se" data-cropper-action="se"></span></div></div>';
                var o = n.querySelector(".".concat("cropper", "-container")),
                  r = o.querySelector(".".concat("cropper", "-canvas")),
                  h = o.querySelector(".".concat("cropper", "-drag-box")),
                  s = o.querySelector(".".concat("cropper", "-crop-box")),
                  c = s.querySelector(".".concat("cropper", "-face"));
                (this.container = a),
                  (this.cropper = o),
                  (this.canvas = r),
                  (this.dragBox = h),
                  (this.cropBox = s),
                  (this.viewBox = o.querySelector(
                    ".".concat("cropper", "-view-box")
                  )),
                  (this.face = c),
                  r.appendChild(i),
                  U(t, d),
                  a.insertBefore(o, t.nextSibling),
                  this.isImg || q(i, m),
                  this.initPreview(),
                  this.bind(),
                  (e.initialAspectRatio =
                    Math.max(0, e.initialAspectRatio) || NaN),
                  (e.aspectRatio = Math.max(0, e.aspectRatio) || NaN),
                  (e.viewMode =
                    Math.max(0, Math.min(3, Math.round(e.viewMode))) || 0),
                  U(s, d),
                  e.guides ||
                    U(
                      s.getElementsByClassName("".concat("cropper", "-dashed")),
                      d
                    ),
                  e.center ||
                    U(
                      s.getElementsByClassName("".concat("cropper", "-center")),
                      d
                    ),
                  e.background && U(o, "".concat("cropper", "-bg")),
                  e.highlight || U(c, u),
                  e.cropBoxMovable && (U(c, f), G(c, v, "all")),
                  e.cropBoxResizable ||
                    (U(
                      s.getElementsByClassName("".concat("cropper", "-line")),
                      d
                    ),
                    U(
                      s.getElementsByClassName("".concat("cropper", "-point")),
                      d
                    )),
                  this.render(),
                  (this.ready = !0),
                  this.setDragMode(e.dragMode),
                  e.autoCrop && this.crop(),
                  this.setData(e.data),
                  L(e.ready) && _(t, "ready", e.ready, { once: !0 }),
                  tt(t, "ready");
              }
            },
          },
          {
            key: "unbuild",
            value: function () {
              this.ready &&
                ((this.ready = !1),
                this.unbind(),
                this.resetPreview(),
                this.cropper.parentNode.removeChild(this.cropper),
                q(this.element, d));
            },
          },
          {
            key: "uncreate",
            value: function () {
              this.ready
                ? (this.unbuild(), (this.ready = !1), (this.cropped = !1))
                : this.sizing
                ? ((this.sizingImage.onload = null),
                  (this.sizing = !1),
                  (this.sized = !1))
                : this.reloading
                ? ((this.xhr.onabort = null), this.xhr.abort())
                : this.image && this.stop();
            },
          },
        ]) && e(i.prototype, a),
        n && e(i, n),
        t
      );
    })();
  return S(bt.prototype, dt, mt, ut, gt, ft, vt), bt;
});
