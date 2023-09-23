function $(e) {
    return document.querySelector(e);
}
function closeModelImg() {
    document.exitFullscreen
        ? document.exitFullscreen()
        : document.webkitExitFullscreen
            ? document.webkitExitFullscreen()
            : document.msExitFullscreen && document.msExitFullscreen(),
        (document.querySelector(".model-img").style.display = "none"),
        document.querySelector("body").classList.remove("disable-scrolling");
}
function ModelImg() {
    $("body").classList.add("disable-scrolling"),
        $(".model-img-url").hasAttribute("src")
            ? (($(".model-img").style.display = "block"),
                $(".model-img").requestFullscreen
                    ? $(".model-img").requestFullscreen()
                    : $(".model-img").webkitRequestFullscreen
                        ? $(".model-img").webkitRequestFullscreen()
                        : $(".model-img").msRequestFullscreen &&
                        $(".model-img").msRequestFullscreen())
            : ($(".model-img-url").setAttribute(
                "src",
                $("#img-heading").getAttribute("value")
            ),
                ($(".model-img").style.display = "block"),
                $(".model-img").requestFullscreen
                    ? $(".model-img").requestFullscreen()
                    : $(".model-img").webkitRequestFullscreen
                        ? $(".model-img").webkitRequestFullscreen()
                        : $(".model-img").msRequestFullscreen &&
                        $(".model-img").msRequestFullscreen());
}
document.body.addEventListener("keyup", (e) => {
    if (e.key == "f" || e.key == "F") {
        ModelImg();
    } else if (e.key == "Escape") {
        closeModelImg();
    } else if (e.key == "s" || e.key == "S") {
        imgShare();
    }
});
function imgShare() {
    document.querySelector(".share-box").classList.add("zoom-in"),
        document.querySelector(".share-box").classList.remove("zoom-out");
}
const imgShareBtn = document.querySelector(".img-share-btn");
imgShareBtn && imgShareBtn.addEventListener("click", imgShare);
$("#preview-img") && $("#preview-img").addEventListener("click", ModelImg);
$(".close-model").addEventListener("click", closeModelImg);
$(".copy-link") &&
    $(".copy-link").addEventListener("click", () => {
        var e = document.createElement("input");
        $("body").append(e),
            (e.value = document.querySelector("input.pageURL").value),
            e.select(),
            e.setSelectionRange(0, 99999),
            navigator.clipboard.writeText(e.value),
            ($(".copy-link").innerHTML = "Copied &#10003;"),
            setTimeout(() => {
                $(".copy-link").innerHTML = "Copy Link";
            }, 2e3),
            e.remove();
    });
const Update = (e, t) => {
    let n = "/api/update?id=" + e + "&flag=" + t;
    return new Promise((e, t) => {
        var d = new XMLHttpRequest();
        (d.onreadystatechange = function () {
            4 == this.readyState &&
                (200 == this.status ? e(this.responseText) : t(this.statusText));
        }),
            d.open("GET", n, !0),
            d.send();
    });
};
if (document.getElementById("data-id-of-img")) {
    let e = document.getElementById("data-id-of-img").dataset.id;
    setTimeout(() => {
        Update(e, "v")
            .then((e) => {
                document.getElementById("number-of-view").innerText = e;
            })
            .catch((e) => {
                console.error(e);
            });
    }, 3e3),
        document
            .getElementById("img-download-btn")
            .addEventListener("click", () => {
                Update(e, "d")
                    .then((e) => {
                        (document.getElementById("number-of-downloads").innerText = e),
                            console.log(e);
                    })
                    .catch((e) => {
                        console.error(e);
                    });
            });
    let t = () => {
        console.log("function is running"),
            fetch(`/api/get_d?id=${e}`)
                .then((e) => e.json())
                .then((e) => {
                    (document.getElementById("number-of-downloads").innerText = e.down),
                        (document.getElementById("number-of-view").innerText = e.view);
                })
                .catch((e) => {
                    console.error(e);
                });
    };
    t();
}
function funcForLazyloadImg() {
    let e = document.querySelectorAll(".lazyload"),
        t = new IntersectionObserver((e, t) => {
            e.forEach((e) => {
                if (!e.isIntersecting) return;
                let r = e.target,
                    n = r.getAttribute("data-src");
                if (
                    ((r.src = n),
                        (r.style.position = "relative"),
                        r.classList.contains("preview-image") && r.nextElementSibling)
                ) {
                    let i = r.nextElementSibling;
                    (i = String(i)).indexOf("<svg>") && r.nextElementSibling.remove();
                }
                t.unobserve(r);
            });
        });
    e.forEach((e) => {
        t.observe(e);
    });
}
let true_cond = 0;
function runOnLoad() {
    setTimeout(() => {
        0 === true_cond && (funcForLazyloadImg(), (true_cond += 1));
    }, 3e3);
}
function urlFormatter() {
    let e = window.location.pathname,
        t = window.location.hostname;
    if (
        "localhost" === t ||
        "wallpaper-access.com" === t ||
        "www.wallpaper-access.com" === t
    ) {
        if ("" === (e = e.split("/"))[0] && "" === e[1]) return "index";
        if ("" === e[0] && "search" === e[1]) return "sr";
        if ("" === e[0] && "w" === e[1]) return "w";
        else if ("" === e[0] && "category" === e[1]) return "category";
    }
}
function sType_and_keywords_find(e) {
    return "index" === e
        ? null
        : "sr" === e
            ? decodeURI(window.location.search.split("wallpaper=")[1]).toLowerCase()
            : "w" === e
                ? decodeURI(window.location.pathname.split("/")[2]).toLowerCase()
                : "category" === e
                    ? decodeURI(window.location.pathname.split("/")[2]).toLowerCase()
                    : void 0;
}
runOnLoad(),
    window.addEventListener("scroll", () => {
        0 === true_cond && (funcForLazyloadImg(), (true_cond += 1));
    });
class checkEnd {
    constructor(e, t, r) {
        (this.urlType = urlFormatter()),
            (this.keywords = sType_and_keywords_find(this.urlType)),
            (this.cbox = document.querySelector(e)),
            (this.data_id = this.cbox.getAttribute("data-id")),
            (this._print_where = document.querySelector(t)),
            (this.loader = document.querySelector(r));
    }
    Observe_Checker() {
        new IntersectionObserver((e, t) => {
            e.forEach((e) => {
                e.isIntersecting &&
                    ((this.loader.style.display = "block"),
                        this.id_checker()
                            .then((e) => {
                                window.innerWidth >= 930
                                    ? (e += 10)
                                    : window.innerWidth < 930 &&
                                    window.innerWidth >= 400 &&
                                    (e += 5),
                                    this.loading(e)
                                        .then((e) => {
                                            !1 == e
                                                ? ((this.loader.style.display = "none"),
                                                    this._print_where.insertAdjacentHTML(
                                                        "beforeend",
                                                        '<strong style="text-align : center; display:inline-block;margin : 10px auto;">End<br>More Coming Soon<br><a href="/category/cars" style="border:none;outline:none;text-decoration:none;">Try This</a></strong>'
                                                    ))
                                                : setTimeout(() => {
                                                    (this.loader.style.display = "none"),
                                                        this._print_where.insertAdjacentHTML(
                                                            "beforeend",
                                                            e
                                                        ),
                                                        funcForLazyloadImg(),
                                                        this.Observe_Checker();
                                                }, 2e3);
                                        })
                                        .catch((e) => {
                                            console.log(e);
                                        });
                            })
                            .catch((e) => {
                                console.error(e);
                            }),
                        t.unobserve(e.target));
            });
        }).observe(this.cbox);
    }
    id_checker() {
        return new Promise((e, t) => {
            let r = "";
            "ir-1" === this.data_id
                ? e(
                    (r = parseInt(
                        (r = document.querySelectorAll(".ir-1-tb .img-anchor"))[
                            r.length - 1
                        ].getAttribute("data-id")
                    ))
                )
                : "ir-2" === this.data_id
                    ? e(
                        (r = parseInt(
                            (r = document.querySelectorAll(".ir-2-tb .img-anchor"))[
                                r.length - 1
                            ].getAttribute("data-id")
                        ))
                    )
                    : "ir-3" === this.data_id
                        ? e(
                            (r = parseInt(
                                (r = document.querySelectorAll(".ir-3-tb .img-anchor"))[
                                    r.length - 1
                                ].getAttribute("data-id")
                            ))
                        )
                        : t("Error : Something went wrong");
        });
    }
    loading(e) {
        let t = "";
        return (
            (t =
                null === this.keywords
                    ? "/api/send?id=" + e + "&type=" + this.urlType
                    : "/api/send?id=" +
                    e +
                    "&type=" +
                    this.urlType +
                    "&keywords=" +
                    this.keywords),
            new Promise((e, r) => {
                var n = new XMLHttpRequest();
                (n.onreadystatechange = function () {
                    4 === this.readyState &&
                        (200 === this.status ? e(this.responseText) : r(this.statusText));
                }),
                    n.open("GET", t, !0),
                    n.send();
            })
        );
    }
}
let _row_01 = new checkEnd(
    "div.hidden-end-checker-01",
    ".ir-1-tb",
    ".ir-1-tb-loader"
);
_row_01.Observe_Checker();
let _row_02, _row_03;
window.innerWidth >= 400 &&
    (_row_02 = new checkEnd(
        "div.hidden-end-checker-02",
        ".ir-2-tb",
        ".ir-2-tb-loader"
    )).Observe_Checker(),
    window.innerWidth >= 930 &&
    (_row_03 = new checkEnd(
        "div.hidden-end-checker-03",
        ".ir-3-tb",
        ".ir-3-tb-loader"
    )).Observe_Checker();
