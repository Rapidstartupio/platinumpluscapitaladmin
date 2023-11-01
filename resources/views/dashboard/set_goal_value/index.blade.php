@extends('theme::layouts.app')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/ThrowPropsPlugin.min.js"></script> -->
    <!-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/DrawSVGPlugin.min.js"></script> -->

    <script src="https://codepen.io/petebarr/pen/2fc0573674b0f849badd58a15371534e.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/utils/Draggable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

    <style>
		#right-panel
        {
            height: 1200px;
            background-image: radial-gradient(ellipse at left bottom, rgb(21 21 33) -1%, rgb(66 44 110) -1%, rgb(21 21 33) 35%);
        }

        textarea#funds_for {
            background-color: #151521;
            color: #9ca3af;
            resize: none;
        }
        /* OLD Range Slider Start */

        .range-slider {
            width: 100%;
        }

        .range-slider__range {
            -webkit-appearance: none;
            width: calc(97% - (73px));
            height: 5px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 0;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;

        }

        .range-slider__range:focus
        {
            box-shadow: 0 0 12px #c1ccff;
        }


        .range-slider__range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #4b5567;
            cursor: pointer;
            -webkit-transition: background 0.15s ease-in-out;
            transition: background 0.15s ease-in-out;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
        }
        .range-slider__range::-webkit-slider-thumb:hover {
            background: #005fe6;
            width: 20px;
            height: 20px;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
        }

        .range-slider__range:active::-webkit-slider-thumb {
            background: #005fe6;
        }
        .range-slider__range:focus::-webkit-slider-thumb {
            background: #005fe6;
            width: 20px;
            height: 20px;
        }
        .range-slider__range::-moz-range-thumb {
            width: 15px;
            height: 15px;
            border: 0;
            border-radius: 50%;
            background: #4b5567;
            cursor: pointer;
            -moz-transition: background 0.15s ease-in-out;
            transition: background 0.15s ease-in-out;
        }
        .range-slider__range::-moz-range-thumb:hover {
            background: #005fe6;
        }
        .range-slider__range:active::-moz-range-thumb {
            background: #005fe6;
        }

        .range-slider__value {
            display: inline-block;
            position: relative;
            width: 90px;
            color: #fff;
            line-height: 20px;
            text-align: center;
            border-radius: 15px;
            background: #005ee3;;
            padding: 5px 10px;
            margin-left: 2px;
            box-shadow: 0px 0px 20px 0px #005ee3;
        }

        ::-moz-range-track {
            background: #d7dcdf;
            border: 0;
        }

        input::-moz-focus-inner,
        input::-moz-focus-outer {
            border: 0;
        }
        /* Old Range Slider Ends */


        /* CSS For Dial Start From Here */
      .me-toggle {
        position: fixed;
        z-index: 9999;
        top: 8px;
        left: 8px;
        display: none;
        width: 48px;
        height: 48px;
        cursor: pointer;
        outline: none;
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        overflow: visible;
      }
      @media only screen and (max-width: 800px) {
        .me-toggle {
          display: none;
        }
      }

      .me-toggle__info {
        position: absolute;
        z-index: 2;
        top: 30px;
        left: 30px;
        margin: 0;
        color: white;
        text-transform: uppercase;
        font-size: 10px;
        opacity: 0;
        letter-spacing: 1px;
        font-weight: 300;
      }

      .me-logo__device--small {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 1;
        width: 48px;
        height: 48px;
      }

      .me-close {
        visibility: hidden;
        opacity: 0;
      }

      .me-toggle__base {
        width: 100%;
        height: 48px;
        background: black;
        background-image: linear-gradient(205deg, #313346 0%, #15161D 76%);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        border-radius: 2px;
      }

      .me-panel {
        position: absolute;
        z-index: 9998;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        width: 50%;
        height: 100%;
        transform: translateX(-101%);
        color: white;
        margin: auto;
        background-image: linear-gradient(205deg, #313346 0%, #15161D 76%);
        box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.3);
        font-family: noto-sans-condensed, sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 14px;
        line-height: 1.357;
        text-align: center;
        -webkit-font-kerning: normal;
                font-kerning: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        overflow-y: scroll;
        overflow: -moz-scrollbars-none;
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      .me-panel::-webkit-scrollbar {
        display: none;
      }
      @media only screen and (max-width: 800px) {
        .me-panel {
          display: none;
        }
      }

      .me-panel__content {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: center;
        width: 90%;
        max-width: 376px;
        height: 100%;
        min-height: 630px;
        visibility: hidden;
        opacity: 0;
      }

      .me-panel__content-top {
        flex-basis: 60%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
      }

      .me-panel__content-btm {
        flex-basis: 40%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
      }

      .me-logo {
        width: 76px;
        height: 66px;
      }

      .me-logo__device {
        opacity: 0;
      }

      .me-title {
        position: relative;
        top: auto;
        left: auto;
        margin: 26px 0 35px;
        font-family: noto-sans-extracondensed, sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 5px;
      }
      .me-title span {
        display: block;
        margin-top: 5px;
        opacity: 0.5;
        font-family: noto-sans-condensed, sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 14px;
      }

      .me-thanks {
        margin-bottom: 16px;
        overflow: hidden;
      }

      .me-thanks__title {
        margin: 0 0 2px;
        font-family: noto-sans-extracondensed, sans-serif;
        font-weight: 700;
        font-style: normal;
        font-size: 104px;
        text-transform: uppercase;
        letter-spacing: 5px;
        line-height: 1;
      }

      .me-line {
        width: 100%;
        height: 1px;
        background: white;
        opacity: 0.16;
      }

      .me-intro {
        margin: 0;
        opacity: 0.5;
      }

      .me-profile {
        position: relative;
        display: flex;
        justify-content: center;
        width: 100%;
        height: 100%;
        margin-top: 18px;
        min-height: 20vh;
      }

      .me-profile__link {
        position: absolute;
        top: calc(50% - 54px);
        left: calc(50% - 132px);
        width: 262px;
        height: 108px;
        border-radius: 50%;
      }
      .me-profile__link.me-profile__link-disabled {
        pointer-events: none;
        cursor: default;
      }

      .me-line-vert {
        width: 1px;
        height: 100%;
        min-height: 20vh;
        background: white;
        opacity: 0.16;
      }

      .me-links {
        width: 100%;
      }

      .me-links__list {
        display: flex;
        justify-content: space-between;
        margin: 0;
        padding: 0;
        height: 92px;
        overflow: hidden;
      }

      .me-links__item {
        list-style-type: none;
      }

      .me-links__link {
        position: relative;
        display: flex;
        align-items: center;
        height: 100%;
        color: white;
        opacity: 0.5;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: scale 0.2s linear, color 0.2s linear;
      }
      .me-links__link:hover {
        color: #4A90E2;
        opacity: 1;
      }
      .me-links__link:hover .me-links__item-marker {
        transform: scale(1);
      }

      .me-links__item-marker {
        position: absolute;
        left: 50%;
        bottom: 0;
        z-index: 1;
        width: 1px;
        height: 30px;
        background-color: #4A90E2;
        transform: scale(0);
        transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        transform-origin: center bottom;
      }

      /*  ==========================================================================
        Variables etc
        ========================================================================== */
      .results__dial-percent-text text, body {
        font-family: "proxima-nova", sans-serif;
        font-style: normal;
        font-weight: 400;
      }

      .results__dial-saving, .results__dial-perc, .results__dial-perc-text, .results__dial-results {
        font-family: "proxima-nova", sans-serif;
        font-style: normal;
        font-weight: 700;
      }

      .container {
        position: relative;
        width: 120%;
          overflow: hidden !important;
          display: flex;
          margin-left: 26.2%;
      }

      /*  ==========================================================================
          Dial
          ========================================================================== */
      .results__dial {
        visibility: hidden;
      }
      .results__dial text, .results__dial tspan {
        -webkit-user-select: none;
          -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
      }

      /*  Percentage Markers
          ========================================================================== */
      .results__dial-percent-text text {
        -webkit-font-smoothing: subpixel-antialiased;
      }

      /*  Text
          ========================================================================== */
      .results__dial-perc-text, .results__dial-results {
        font-feature-settings: "tnum" 1;
        text-anchor: middle;
      }

      .results__dial-perc-text, .results__dial-results {
        font-size: 24px;
      }

      .results__dial-perc {
        text-anchor: middle;
        font-size: 48px;
        -webkit-font-smoothing: subpixel-antialiased;
      }

      .results__dial-saving {
        font-size: 65px;
        -webkit-font-smoothing: subpixel-antialiased;
        -webkit-transition: 0.3s;
      }

      .results__dial-saving:hover {
        font-size: 75px;
        -webkit-font-smoothing: subpixel-antialiased;
        -webkit-transition: 0.3s;
      }

      /*  Dragger
          ========================================================================== */
      .results__dial-drag-arrows, .results__dial-drag-pad {
        pointer-events: none;
      }

      .results__dial-drag-hit {
        cursor: pointer;
      }

      /*  Custom
          ========================================================================== */
      svg.results__dial {
        width: 70%;
        overflow: hidden !important;
      }
      /* CSS For Dial End Here */



    p.set-monthly-goal {
      margin: 25px 0 0 40px;
      font-weight: 600;
    }
    hr.seperator {
      border-color: #2b2b40;
    }
    </style>

    <div class="flex px-8 mx-auto my-6 max-w-7xl xl:px-5">
        <!-- Left Settings Menu -->
        <div class="w-16 mr-6 md:w-1/5">
            @include('theme::partials.sidebar')
        </div>
        <!-- End Settings Menu -->

        <div id="right-panel" class="dark-section flex flex-col w-full bg-white border rounded-lg md:w-4/5 border-gray-150">

            <div class="dark-section flex flex-wrap items-center justify-between border-b border-gray-200 sm:flex-no-wrap">
                <div class="relative p-6">
                    <h3 class="text flex text-lg font-medium leading-6 text-gray-600">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @if(isset($section_title)){{ $section_title }}@else{{Auth::user()->name}} {{ ucwords(str_replace('-', ' ', Request::segment(2)) ?? 'profile') }} @endif
                    </h3>
                </div>
            </div>

            <div class="uk-card-body h-24 min-h-0 md:min-h-full">

            <div class="heading goal-graph">
              <p class="set-monthly-goal text text-lg font-medium leading-6 text-gray-600">GOAL STATUSES</p>

              <p class="text block text-sm font-medium leading-5 text-gray-700 mt-2 mb-5" style="margin-left: 40px"><b>Check the status of your portfolio goal here.</b></p>

						<div class="container">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 920 520" class="results__dial">

                  <title>Goal</title>

                    <g class="results__dial-circles">
                        <path class="results__dial-outer" d="M260,64c110.46,0,200,89.54,200,200S370.46,464,260,464,60,374.46,60,264,149.54,64,260,64" fill="none" stroke="#64d3de" stroke-miterlimit="10" opacity="0.6"/>
                        <path class="results__dial-track" d="M260,86A178,178,0,1,1,82,264,178,178,0,0,1,260,86" fill="none" stroke="#50afb8" stroke-miterlimit="10" stroke-width="8"/>
                        <path class="results__dial-track-perc" d="M260,86A178,178,0,1,1,82,264,178,178,0,0,1,260,86" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="8"/>
                    </g>
                    <g class="results__dial-markers" fill="#64d3de">
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                        <rect class="results__dial-marker" x="260" y="55" width="1" height="9" />
                    </g>
                    <g class="results__dial-percent-text" fill="#64d3de" font-size="18" >
                        <text x="255" y="43.99">0%</text>
                        <text x="388" y="86.99">10%</text>
                        <text x="471" y="199.99">20%</text>
                        <text x="470" y="340.99">30%</text>
                        <text x="381" y="454.99">40%</text>
                        <text x="250" y="495.99">50%</text>
                        <text x="118" y="454.99">60%</text>
                        <text x="26" y="340.99">70%</text>
                        <text x="20" y="200.99">80%</text>
                        <text x="105" y="85.99">90%</text>
                    </g>
                    <g class="">
                        <!-- <text class="results__dial-perc-text results__text" x="272" y="203.98" fill="#fff">
                            <tspan class="results__dial-perc" text-anchor="start">0</tspan>
                            <tspan baseline-shift="super">%</tspan>
                        </text> -->
                        <text class="results__dial-effect results__text text-center" x="175" y="350" font-size="28" fill="#64d3de">YOUR GOAL</text>
                        <text class="results__dial-results results__text" text-anchor="middle" x="250" y="285" fill="#64d3de">
                            <tspan baseline-shift="super">$</tspan>
                            <tspan fill="#fff" class="results__dial-saving">{{ $user_goal }}</tspan>
                        </text>
                    </g>

                </svg>

            </div>

            <hr class="seperator">

            <div class="set-monthly-goal">
              <p class="set-monthly-goal text text-lg font-medium leading-6 text-gray-600">SET PORTFOLIO GOAL</p>
                <p class="text block text-sm font-medium leading-5 text-gray-700 mt-2" style="margin-left: 40px"><b>Now, you can set your port goals. Tell us how much you would like to save and what you would use it for!</b></p>
                <form action="{{ route('dashboard.setGoal') }}" method="POST">
                    @csrf
                    <div class="relative flex flex-col px-10 py-8 saving-goal-form">

                        <div class="range-slider">
                            <label for="interest_goal_value" class="text block text-sm font-medium leading-5 text-gray-700">Set Goal Value</label>
                            <input class="range-slider__range" id=" interest_goal_value" name="interest_goal_value" type="range" value="0" min="0" step="5000" max="1000000">
                            <span class="range-slider__value">0</span>
                        </div>

                        <br>
                        <div>
                            <label for="funds_for" class="text block text-sm font-medium leading-5 text-gray-700">Purpose</label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <!-- <input id="funds_for" type="text" name="funds_for" placeholder="Tell us what you would use the funds for" class="w-full form-input"> -->
                                <textarea name="funds_for" id="funds_for" cols="30" rows="6" placeholder="Tell us what you would use the funds for" class="w-full form-input"></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end w-full mt-2">
                            <button type="submit" class="flex self-end justify-center w-auto px-4 py-2 mt-5 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-wave-700">Set Goal</button>
                        </div>
                    </div>
                </form>

              </div>





        </div>

    </div>

    <script>

/*  ==========================================================================
    Range Slider
    ========================================================================== */
        function rangeSlider() {
            let slider = document.querySelectorAll(".range-slider");
            let range = document.querySelectorAll(".range-slider__range");
            let value = document.querySelectorAll(".range-slider__value");

            slider.forEach((currentSlider) => {
                value.forEach((currentValue) => {
                    let val = currentValue.previousElementSibling.getAttribute("value");
                    currentValue.innerText = val;
                });

                range.forEach((elem) => {
                    elem.addEventListener("input", (eventArgs) => {
                        elem.nextElementSibling.innerText = eventArgs.target.value;
                    });
                });
            });
        }
        rangeSlider();

/*  ==========================================================================
    Dial
    ========================================================================== */

      var tCost = 8501373;
      var hhCost = tCost * 0.5;
      var decreaseScale = 0.006; // per 1%
      var savings;
      var maxRotation = 179.6;
      var rotationSnap = 360 / 100; // snap to 1% increments
      var initEasing = Power4.easeInOut;
      var $circOuter = $(".results__dial-outer");
      var $circTrack = $(".results__dial-track");
      var $trackPerc = $(".results__dial-track-perc");
      var $dialMarkers = $(".results__dial-marker");
      var $dialMarkerNums = $(".results__dial-percent-text text");
      var $drag = $(".results__dial-drag");
      var $dragPad = $(".results__dial-drag-pad");
      var $dragPadHit = $(".results__dial-drag-hit");
      var $dragLine = $(".results__dial-drag-line");
      var $dragInner = $(".results__dial-drag-inner");
      // var $precText = $('.results__dial-perc-text');
      var $resultsText = $(".results__text");
      var $perc = $(".results__dial-perc");
      // var $effectText = $('.results__dial-effect');
      // var $savingText = $('.results__dial-results');
      var $saving = $(".results__dial-saving");
      var dialTL = new TimelineMax();

      TweenMax.set(".results__dial", {
        visibility: "visible"
      });

      TweenMax.set([$trackPerc, $circOuter, $circTrack], {
        transformOrigin: "50% 50%",
        drawSVG: "0% 0%"
      });

      TweenMax.set($drag, {
        transformOrigin: "50% 259", // set rotationY to the center of the dial
        rotation: 0
      });

      TweenMax.set($dialMarkers, {
        transformOrigin: "50% 209" // set rotationY to the center of the dial
        // rotation: 0
      });

      $dragPadHit.hover(
        function () {
          TweenMax.to($dragPad, 0.4, {
            transformOrigin: "center center",
            scale: 1.5,
            ease: Elastic.easeOut.config(0.9, 0.3)
          });
        },
        function () {
          TweenMax.to($dragPad, 0.2, {
            scale: 1
          });
        }
      );

      dialTL
        .to($circTrack, 0.8, {
          drawSVG: "0% 100%",
          ease: initEasing
        })

        .to(
          $circOuter,
          0.8,
          {
            drawSVG: "0% 100%",
            ease: initEasing
          },
          "-=0.6"
        )

        .staggerTo(
          $dialMarkers,
          0.8,
          {
            cycle: {
              rotation: function (i) {
                return 180 - 36 * i;
              }
            },
            ease: Power2.easeOut
          },
          0.1,
          "-=0.4"
        )

        .staggerFrom(
          $dialMarkerNums,
          0.8,
          {
            autoAlpha: 0,
            x: 20,
            ease: Power2.easeOut
          },
          0.1,
          "-=0.6"
        )

        .from(
          $dragLine,
          0.3,
          {
            scaleY: 0,
            transformOrigin: "0% 100%",
            ease: Power2.easeIn
          },
          "-=1.2"
        )

        .from(
          $dragInner,
          0.5,
          {
            scale: 0,
            y: 20,
            transformOrigin: "center center",
            ease: Elastic.easeOut.config(0.9, 0.3)
          },
          "-=0.9"
        )

        .staggerFrom(
          $resultsText,
          0.8,
          {
            autoAlpha: 0,
            y: 20,
            ease: Power2.easeOut
          },
          0.1,
          "-=1.4"
        )

        .to(
          $trackPerc,
          0.8,
          {
            drawSVG: "0% 13%", // animate to the default 10%
            ease: initEasing
          },
          "-=0.4"
        )

        .to(
          $drag,
          0.8,
          {
            rotation: 55, // animate to the default 10%
            ease: initEasing,
            onUpdate: function () {
              dragUpdate();
            }
          },
          "-=1.0"
        );

      // Draggable.create($drag, {
      // 	type: "rotation",
      // 	throwProps: true,
      // 	bounds: { maxRotation: maxRotation, minRotation: 0 },
      // 	snap: function (endValue) {
      // 		return Math.round(endValue / rotationSnap) * rotationSnap;
      // 	},
      // 	onDrag: dragUpdate,
      // 	onThrowUpdate: dragUpdate
      // });

      function dragUpdate() {
        // var val = $drag[0]._gsTransform.rotation;
        var percentage = Math.round(((val / 180) * 100) / 2);
        savings = Math.round(percentage * decreaseScale * tCost); // 1% savings = 0.006 x total infections cost
        if (savings < 0) {
          savings = 0;
        }
        if (percentage > 50) {
          percentage = 50;
        } else if (percentage < 0) {
          percentage = "0";
        }
        $perc.text(percentage);
        TweenMax.set($trackPerc, {
          drawSVG: "0% " + ((val / 180) * 100) / 2 + "%"
        });
        $saving.text(savings.toLocaleString("en", { maximumSignificantDigits: 21 })); // change! Locale not massively compatible yet especially on mobile
      }

      console.clear();



    </script>
@endsection
