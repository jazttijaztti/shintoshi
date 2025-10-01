"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  // ========================================
  // ヘッダー自動隠し/表示機能
  // ========================================
  var $header = $(".js-header");
  var $spButtons = $(".js-sp-buttons");
  var debounceTimeout,
    ticking = false;
  var lastScrollY = window.scrollY;
  var headerHeight = $header.length && $header.height() || 0;
  $(window).on("scroll", function () {
    var isDesktop = window.innerWidth > 780;
    if (!ticking) {
      ticking = true;
      clearTimeout(debounceTimeout);
      debounceTimeout = setTimeout(function () {
        requestAnimationFrame(function () {
          var currentScrollY = window.scrollY;
          if (currentScrollY < headerHeight) {
            $spButtons.removeClass("is-hidden");
          } else if (currentScrollY > lastScrollY) {
            $spButtons.addClass("is-hidden");
          } else {
            $spButtons.removeClass("is-hidden");
          }
          if (isDesktop) {
            if (isDesktop && currentScrollY > headerHeight && currentScrollY > lastScrollY) {
              $header.addClass("is-hidden");
            } else {
              $header.removeClass("is-hidden");
            }
          } else {
            $header.removeClass("is-hidden"); // モバイル時は常に表示
          }

          lastScrollY = currentScrollY;
          ticking = false;
        });
      }, 100);
    }
  });

  // ========================================
  // ドロワーメニューの開閉機能
  // ========================================
  $(".js-menu-toggle").on("click", function () {
    var $drawer = $(".js-drawer");
    var $overlay = $(".js-drawer-overlay");
    var $body = $("body");
    var $menuButton = $(".js-menu-toggle");

    // 現在の状態をチェック
    var isOpen = $drawer.hasClass("is-open");
    var actions = isOpen ? "removeClass" : "addClass";
    var text = isOpen ? "MENU" : "CLOSE";
    $drawer[actions]("is-open");
    $overlay[actions]("is-open");
    $body[actions]("is-drawer-open");
    $menuButton[actions]("is-open");
    $(".sp-buttons__menu-text").text(text);
  });

  // ドロワー閉じるボタンクリック時の処理
  $(".js-drawer-close, .js-drawer-overlay").on("click", closeDrawer);

  // オーバーレイクリック時のドロワー閉じる処理
  $(".js-drawer-overlay").on("click", function () {
    closeDrawer();
  });

  // ドロワーを閉じる共通関数
  function closeDrawer() {
    $(".js-drawer").removeClass("is-open");
    $(".js-drawer-overlay").removeClass("is-open");
    $("body").removeClass("is-drawer-open");
    $(".js-menu-toggle").removeClass("is-open");

    // sp-buttonsのメニューテキストを「MENU」に戻す
    $(".sp-buttons__menu-text").text("MENU");
  }

  // ========================================
  // レスポンシブ対応（リサイズイベント）
  // ========================================
  $(window).on("resize", function () {
    if (window.matchMedia("(min-width: 1240px)").matches) {
      // 既存のcloseDrawer関数を使用して完全にドロワーを閉じる
      closeDrawer();
    }

    // 780px以下の場合はヘッダーを常に表示
    if (window.innerWidth <= 780) {
      $header.removeClass("is-hidden");
    }
  });

  // ========================================
  // headerサブメニューのホバー効果
  // ========================================
  $(".js-has-sub").hover(function () {
    // hover in - マイナス記号に変更
    $(this).find(".js-toggle-icon").text("−");
  }, function () {
    // hover out - プラス記号に変更
    $(this).find(".js-toggle-icon").text("+");
  });
  $(document).ready(function () {
    // ページ読み込み時のタイトルアニメーション
    $(function () {
      $(".main-mv__title").delay(300).queue(function (next) {
        $(this).addClass("is-show");
        next();
      });
    });

    // ========================================
    // テキスト一文字ずつアニメーション
    // ========================================
    var $text = $(".main-mv .main-mv__text .main-mv__message");
    if ($text.length && $text.html()) {
      var lines = $text.html().trim().split(/<br\s*\/?>/i);
      $text.empty();
      var delayMapping = [Array.from({
        length: 15
      }, function (_, i) {
        return i * 0.1;
      }), Array.from({
        length: 14
      }, function (_, i) {
        return (i + 2) * 0.1;
      }), Array.from({
        length: 11
      }, function (_, i) {
        return (i + 4) * 0.1;
      }), Array.from({
        length: 21
      }, function (_, i) {
        return (i + 6) * 0.1;
      })];
      lines.forEach(function (line, lineIndex) {
        if (lineIndex > 0) $text.append("<br />");
        _toConsumableArray(line.trim()).forEach(function (_char, charIndex) {
          var _delayMapping$lineInd, _delayMapping$lineInd2;
          var delay = (_delayMapping$lineInd = (_delayMapping$lineInd2 = delayMapping[lineIndex]) === null || _delayMapping$lineInd2 === void 0 ? void 0 : _delayMapping$lineInd2[charIndex]) !== null && _delayMapping$lineInd !== void 0 ? _delayMapping$lineInd : 0;
          var $char = $("<span>").text(_char).css({
            transitionDelay: "".concat(delay, "s"),
            transitionDuration: "0.5s"
          });
          $text.append($char);
        });
      });
    }

    // ========================================
    // 共通スライドショー関数
    // ========================================
    function createSlideshow(containerSelector, sceneSelector) {
      var interval = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 4000;
      var animationDuration = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 500;
      var $container = $(containerSelector);
      var $scenes = $container.find(sceneSelector);
      if ($scenes.length === 0) return null;
      var currentIndex = 0;
      var slideshowInterval = null;
      var isFirstChange = true; // 最初の切り替えかどうかを追跡

      // 最初の画像は通常表示（アニメーションなし）
      $scenes.eq(currentIndex).addClass("is-initial");

      // 指定間隔で画像切り替え
      slideshowInterval = setInterval(function () {
        var $currentPicture = $scenes.eq(currentIndex);

        // 現在の画像を非アクティブにする
        if (isFirstChange) {
          $currentPicture.removeClass("is-initial").addClass("is-previous");
          isFirstChange = false;
        } else {
          $currentPicture.removeClass("is-active").addClass("is-previous");
        }

        // 次の画像のインデックスを計算
        currentIndex = (currentIndex + 1) % $scenes.length;

        // 次の画像をアクティブにする（常にページめくり効果で登場）
        // 最初の画像に戻る場合も is-active を使用
        $scenes.eq(currentIndex).addClass("is-active");

        // アニメーション完了後に前の画像のクラスを削除
        setTimeout(function () {
          $currentPicture.removeClass("is-previous");
        }, animationDuration);
      }, interval);
      return {
        stop: function stop() {
          return clearInterval(slideshowInterval);
        },
        start: function start() {
          slideshowInterval = setInterval(function () {
            var $currentPicture = $scenes.eq(currentIndex);
            if (isFirstChange) {
              $currentPicture.removeClass("is-initial").addClass("is-previous");
              isFirstChange = false;
            } else {
              $currentPicture.removeClass("is-active").addClass("is-previous");
            }
            currentIndex = (currentIndex + 1) % $scenes.length;
            $scenes.eq(currentIndex).addClass("is-active");
            setTimeout(function () {
              $currentPicture.removeClass("is-previous");
            }, animationDuration);
          }, interval);
        }
      };
    }

    // ========================================
    // Business Gallery スライドショー
    // ========================================
    var businessSlideshow = createSlideshow(".business__gallery-image", ".business__gallery-scene", 2500, 800);

    // ========================================
    // スクロール連動アニメーション（main-mv）
    // ========================================
    var scrollFlag1 = false;
    var scrollFlag2 = false;
    var scrollFlag3 = false;
    var mainMvSlideshow = null;
    function handleScroll() {
      var $mvElement = $(".main-mv");
      var mvHeight = $mvElement.height();
      var scrollPercent = window.scrollY / mvHeight * 100;

      // 各要素を取得
      var $imageElement = $mvElement.find(".main-mv__image");
      var $scene1Element = $mvElement.find(".main-mv__scene--1");
      var $shadeElement = $mvElement.find(".main-mv__shade");
      var $linkElement = $mvElement.find(".main-mv__link");
      var $textElement = $mvElement.find(".main-mv__message");

      // スクロール0-40%：画像のclip-pathとシェードのopacityを変化
      if (scrollPercent <= 40 && !scrollFlag1) {
        var clipHorizontal = 25 - scrollPercent / 40 * 25; // 25% → 0%
        var clipVertical = 10 - scrollPercent / 40 * 10; // 10% → 0%

        $imageElement.css("clipPath", "inset(".concat(clipVertical, "% ").concat(clipHorizontal, "% ").concat(clipVertical, "% ").concat(clipHorizontal, "%)"));
        $shadeElement.css("opacity", scrollPercent / 40); // 0 → 1

        if (scrollPercent >= 25) {
          $textElement.addClass("is-show");
          $linkElement.addClass("is-active");
        }
      }
      // スクロール40%以上：画像を完全表示
      else if (scrollPercent > 40 && !scrollFlag2) {
        scrollFlag1 = true;
        scrollFlag2 = true;
        $imageElement.css("clipPath", "inset(0 0 0 0)"); // 完全表示
        $shadeElement.css("opacity", 1);
        $scene1Element.css("transform", "scale(1)");
        $textElement.addClass("is-show");
        $linkElement.addClass("is-active");
      }
      // スクロール60%以上：main-mv画像スライドショー開始（0.5秒アニメーション）
      else if (scrollPercent > 60 && !scrollFlag3) {
        scrollFlag3 = true;
        $textElement.addClass("is-show");

        // 共通関数を使用してmain-mvスライドショーを開始
        mainMvSlideshow = createSlideshow(".main-mv__image", ".main-mv__scene", 4000, 500);
      }
    }

    // スクロールイベントを追加
    $(window).on("scroll", handleScroll);

    // ========================================
    // Special Loop アニメーション制御
    // ========================================
    $(function () {
      var $specialLoop = $(".special-loop");
      var $specialLoopList = $(".special-loop__list");
      var $specialLoopInner = $(".special-loop__inner");

      // スクロール監視でアニメーション開始
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            $specialLoopList.addClass("is-active");
            $specialLoopInner.addClass("is-show");
          } else {
            $specialLoopList.removeClass("is-active");
          }
        });
      }, {
        threshold: 0.1
      });
      if ($specialLoop.length > 0) {
        observer.observe($specialLoop[0]);
      }

      // ホバー時の一時停止制御
      $specialLoop.on("mouseenter", function () {
        $specialLoopList.addClass("is-paused");
      });
      $specialLoop.on("mouseleave", function () {
        $specialLoopList.removeClass("is-paused");
      });
    });

    // ========================================
    // Environment & Sub-Environment アニメーション制御
    // ========================================
    $(function () {
      var $environment = $(".environment");
      var $environmentInner = $(".environment__inner");
      var $subEnvironment = $(".sub-environment");
      var $subEnvironmentInner = $(".sub-environment__inner");

      // スクロール監視でアニメーション開始
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            if (entry.target.classList.contains("environment")) {
              $environmentInner.addClass("is-show");
            } else if (entry.target.classList.contains("sub-environment")) {
              $subEnvironmentInner.addClass("is-show");
            }
          }
        });
      }, {
        threshold: 0.1
      });
      if ($environment.length > 0) {
        observer.observe($environment[0]);
      }
      if ($subEnvironment.length > 0) {
        observer.observe($subEnvironment[0]);
      }
    });

    // ========================================
    // パララックス アニメーション制御
    // ========================================
    $(function () {
      var ticking = false;
      function updateParallax() {
        var parallaxElements = document.querySelectorAll(".js-parallax-img img");
        parallaxElements.forEach(function (element) {
          var rect = element.getBoundingClientRect();
          var windowHeight = window.innerHeight;

          // 要素が画面内にある場合のみパララックス効果を適用
          if (rect.bottom >= 0 && rect.top <= windowHeight) {
            // スクロール量に応じてパララックス効果を計算
            // 画面の中央を基準に、上下に移動する量を計算
            var elementCenter = rect.top + rect.height / 2;
            var windowCenter = windowHeight / 2;
            var distance = windowCenter - elementCenter;

            // パララックス効果の強さを調整（0.2は効果の強さ）
            var parallaxOffset = distance * 0.2;
            element.style.transform = "translateY(".concat(parallaxOffset, "px)");
          }
        });
        ticking = false;
      }
      function requestTick() {
        if (!ticking) {
          requestAnimationFrame(updateParallax);
          ticking = true;
        }
      }

      // スクロールイベントの最適化
      document.addEventListener("scroll", requestTick);

      // 初回実行
      updateParallax();
    });

    // ========================================
    // マウスストーカー
    // ========================================
    (function initializeCustomCursor() {
      // マウスデバイスでない場合は処理を終了
      if (!window.matchMedia("(pointer: fine)").matches) {
        return;
      }

      // カスタムカーソル要素を作成する関数
      function createCursorElement() {
        var cursorElement = document.createElement("div");
        cursorElement.classList.add("mouse-stalker");
        var textElement = document.createElement("span");
        textElement.classList.add("mouse-stalker-text");
        cursorElement.appendChild(textElement);
        document.body.appendChild(cursorElement);
        return {
          cursorElement: cursorElement,
          textElement: textElement
        };
      }

      // スムーズな追従アニメーション
      function createSmoothFollow(element, targetX, targetY) {
        var currentX = 0;
        var currentY = 0;
        var smoothness = 0.1;
        function animate() {
          currentX += (targetX - currentX) * smoothness;
          currentY += (targetY - currentY) * smoothness;
          element.style.left = currentX + "px";
          element.style.top = currentY + "px";
          requestAnimationFrame(animate);
        }
        animate();
        return function updateTarget(newX, newY) {
          targetX = newX;
          targetY = newY;
        };
      }

      // 各カスタムカーソルターゲット要素に対して処理
      var targetElements = document.querySelectorAll(".mouse-stalker-target");
      targetElements.forEach(function (targetElement) {
        var _createCursorElement = createCursorElement(),
          cursorElement = _createCursorElement.cursorElement,
          textElement = _createCursorElement.textElement;
        var mouseX = 0;
        var mouseY = 0;
        var updateTargetPosition = createSmoothFollow(cursorElement, mouseX, mouseY);

        // マウス移動イベント
        function handleMouseMove(event) {
          mouseX = event.pageX;
          mouseY = event.pageY - window.pageYOffset;
          updateTargetPosition(mouseX, mouseY);
        }

        // マウス入場イベント
        function handleMouseEnter() {
          var displayText = targetElement.getAttribute("data-text");
          textElement.textContent = displayText || "";
          cursorElement.classList.add("mouse-stalker-active");
        }

        // マウス退場イベント
        function handleMouseLeave() {
          cursorElement.classList.remove("mouse-stalker-active");
          textElement.textContent = "";
        }

        // Swiperスライドの特別処理
        function handleSwiperSlideInteraction() {
          var swiperSlides = document.querySelectorAll(".swiper-slide");
          swiperSlides.forEach(function (slide) {
            slide.addEventListener("mouseenter", function () {
              var isViewText = targetElement.getAttribute("data-text") === "VIEW";
              var isComingSlide = slide.classList.contains("is-coming");
              if (isViewText && isComingSlide) {
                cursorElement.style.display = "none";
              } else {
                cursorElement.style.display = "flex";
              }
            });
            slide.addEventListener("mouseleave", function () {
              cursorElement.style.display = "flex";
            });
          });
        }

        // イベントリスナーを追加
        targetElement.addEventListener("mousemove", handleMouseMove);
        targetElement.addEventListener("mouseenter", handleMouseEnter);
        targetElement.addEventListener("mouseleave", handleMouseLeave);

        // Swiperスライドの特別処理を初期化
        handleSwiperSlideInteraction();
      });
    })();

    // ========================================
    // スクロール表示アニメーション
    // ========================================
    $(function () {
      var observer;
      var targets = document.querySelectorAll(".scroll-target, .title");
      var windowHalfHeight = window.innerHeight / 2;
      var initializeScrollMonitors = function initializeScrollMonitors() {
        // 既存のobserverがあれば切断
        if (observer) {
          observer.disconnect();
        }

        // 新しいobserverを作成
        observer = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-show");
            }
          });
        }, {
          root: null,
          rootMargin: "0px 0px 0px 0px",
          threshold: 0.25
        });

        // 各要素を監視対象に追加
        targets.forEach(function (target) {
          observer.observe(target);

          // 初期読み込み時に既に表示されている要素は即座に表示
          var rect = target.getBoundingClientRect();
          var scrollY = window.scrollY;
          if (rect.top + scrollY + rect.height / 2 < windowHalfHeight + scrollY) {
            target.classList.add("is-show");
          }
        });
      };
      setTimeout(initializeScrollMonitors, 100);
    });

    // ========================================
    // ラインアニメーション
    // ========================================
    $(function () {
      // 共通アニメーション制御関数
      function createAnimationObserver(selector, className) {
        var threshold = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0.25;
        var $element = $(selector);
        if ($element.length === 0) return;
        var observer = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              $element.addClass(className);
              observer.unobserve(entry.target);
            }
          });
        }, {
          threshold: threshold
        });
        observer.observe($element[0]);

        // 要素の親要素を監視対象にする
        var parentElement = $element.parent()[0];
        if (parentElement) {
          observer.observe(parentElement);
        }
      }

      // Safariちらつき対策：描画完了の次フレームでトリガー
      window.addEventListener("load", function () {
        requestAnimationFrame(function () {
          $(".line-visual").addClass("is-animate");
        });
      });

      // 1-1. ライン要素のアニメーション（ページ読み込み時）
      // setTimeout(() => $(".line-visual").addClass("is-animate"), 500);

      // Footer Gold Line アニメーション制御（スクロール監視）
      createAnimationObserver(".footer__line", "is-animate", 0.25);
    });
  });
});