"use strict";

// ========================================
// Swiper関連
// ========================================

// ========================================
// People Slider（メンバー紹介スライダー）
// ========================================
jQuery(function ($) {
  var service_swiper = new Swiper(".js-people-swiper", {
    loop: true,
    speed: 1000,
    slidesPerView: 1,
    spaceBetween: 63,
    loopedSlides: 6,
    watchSlidesProgress: true,
    watchSlidesVisibility: true,
    breakpoints: {
      781: {
        spaceBetween: 40
      }
    },
    pagination: {
      el: ".people-slider__controls .swiper-pagination",
      type: "custom",
      renderCustom: function renderCustom(swiper, current, total) {
        var realCurrent = swiper.realIndex + 1;
        var realTotal = document.querySelectorAll(".js-people-swiper .swiper-slide:not(.swiper-slide-duplicate)").length;
        var currentFormatted = ("00" + realCurrent).slice(-2);
        var totalFormatted = ("00" + realTotal).slice(-2);
        return "".concat(currentFormatted, "-").concat(totalFormatted);
      }
    },
    navigation: {
      nextEl: ".people-slider__controls .swiper-button-next",
      prevEl: ".people-slider__controls .swiper-button-prev"
    }
  });

  // マウスオーバー時の処理
  function handleMouseOver(e) {
    var t = document.querySelector(".swiper-slide-active");
    e.currentTarget !== t && t.classList.add("is-break");
  }

  // マウスアウト時の処理
  function handleMouseOut(e) {
    document.querySelectorAll(".swiper-slide").forEach(function (e) {
      e.classList.remove("is-break");
    });
  }
  var peopleSlides = document.querySelectorAll(".js-people-swiper .swiper-slide");
  peopleSlides.forEach(function (slide) {
    slide.addEventListener("mouseover", handleMouseOver);
    slide.addEventListener("mouseout", handleMouseOut);
  });
});

// ========================================
// Slider Gallery（物件紹介スライダー）
// ========================================
function initializeSliderGalleries() {
  var sliderGalleries = document.querySelectorAll(".slider-gallery");
  sliderGalleries.forEach(function (gallery, index) {
    var swiperElement = gallery.querySelector(".js-sub-property-swiper");
    if (!swiperElement) return;

    // 既存のSwiperインスタンスがあれば破棄
    if (swiperElement.swiper) {
      swiperElement.swiper.destroy(true, true);
    }
    var sliderGallerySwiper = new Swiper(swiperElement, {
      effect: "slide",
      slidesPerView: 1.2,
      loop: true,
      spaceBetween: 16,
      speed: 800,
      autoplay: false,
      breakpoints: {
        781: {
          loop: true,
          slidesPerView: 1,
          spaceBetween: 0
        }
      },
      pagination: {
        el: gallery.querySelector(".swiper-pagination"),
        type: "custom",
        renderCustom: function renderCustom(swiper, current, total) {
          var realCurrent = swiper.realIndex + 1;
          var realTotal = swiperElement.querySelectorAll(".swiper-slide:not(.swiper-slide-duplicate)").length;
          var currentFormatted = ("00" + realCurrent).slice(-2);
          var totalFormatted = ("00" + realTotal).slice(-2);
          return "".concat(currentFormatted, " - ").concat(totalFormatted);
        }
      },
      navigation: {
        nextEl: gallery.querySelector(".swiper-button-next"),
        prevEl: gallery.querySelector(".swiper-button-prev")
      },
      watchOverflow: false,
      observer: true,
      observeParents: true,
      on: {
        init: function init() {
          console.log("Slider Gallery ".concat(index + 1, " initialized"));
        }
      }
    });
  });
}

// ページ読み込み完了時に初期化
window.addEventListener("load", function () {
  initializeSliderGalleries();
});