@extends('theme::layouts.app')

@section('content')

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Scripts for dials -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/ThrowPropsPlugin.min.js"></script> -->
    <!-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/DrawSVGPlugin.min.js"></script> -->
    <!-- <script src="https://codepen.io/petebarr/pen/2fc0573674b0f849badd58a15371534e.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/utils/Draggable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

    <!-- For graph -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <style>

        #right-panel
        {
            height: 1150px;
            background-image: radial-gradient(ellipse at left bottom, rgb(21 21 33) -1%, rgb(66 44 110) -1%, rgb(21 21 33) 35%);
        }

        @media only screen and (min-width: 768px) and (orientation: landscape){
            .col1-4 {
                width: calc(100% / 5.2);
            }
        }

        @media only screen and (min-width: 768px) and (orientation: landscape){
            .col1-1, .col1-2, .col1-3, .col1-4, .col1-5, .col2-3, .col3-4 {
                display: inline-block;
                vertical-align: top;
                /*margin: 10px 0 5px 0;*/
            }
        }

        .col1-4{
            margin-top: 10px;
            width: 215px;
        }
        div.content{
            text-align: center;
        }
        i.fa-solid {
            font-size: 35px;
            margin-bottom: 10px;
        }
        i.fa-color
        {
            color: #4b5567;
        }

        span.bigText {
            font-size: 26px;
            font-weight: 600;
            /*color: #4b5567;*/
        }
        span.g-text {
            color: #4b5567;
        }

        .platinum-wallet, .balance-dials {
            margin: 50px 45px 50px 45px;
        }
        /*#myChart {*/
        /*    margin-top: 10px;*/
        /*}*/

        /*Refer User*/
        @media only screen and (min-width: 768px) and (orientation: landscape){
            .col1-3 {
                width: calc(100% / 3.1);
            }
        }
        /*Latest Posts*/
        @media only screen and (min-width: 768px) and (orientation: landscape) {
            .col2-3 {
                width: calc(100% / 3 * 2 - 2px);
            }
        }
        @media only screen and (min-width: 768px) and (orientation: landscape) {
            .col1-1, .col1-2, .col1-3, .col1-4, .col1-5, .col2-3, .col3-4 {
                display: inline-block;
                vertical-align: top;
                margin: 0 0 5px 0;
            }
        }

        .col1-col2-wrapper {
            margin: 45px 40px 20px 45px;
        }

        .col2-3 {
            text-align: center;
            width: 100%;
        }
        div.icenter {
            text-align: center;
        }

        .posts-section {
            padding: 115px 0;
        }
        .col1-3 {
            text-align: center;
        }

        .qr-code{
            vertical-align: baseline;
            display: inline-grid;
        }

        .input-field-dark {
            background-color: #151521;
            color: #9ca3af;
        }


        /*Chart CSS*/
        #myChart {
            width: 698px;
            max-width: 775px !important;
            display: block;
            margin: 50px auto;
            height: 349px;
        }


        #chartdiv {
            width: 100%;
            height: 500px;
        }

        hr.seperator {
      border-color: #2b2b40;
        }

        div.latest-posts {
            margin-top: 35px;
        }


        /* All the CSS for Dials Starts From Here */

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
  margin-left: 3%;
}

/*  ==========================================================================
    Dial
    ========================================================================== */
.results__dial {
  /* visibility: hidden; */
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

.show_total_balance {
  margin: 0px 0px 0 450px;

}


    /* All the CSS For Dials End Here */
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
                    <span class="show_total_balance">Your Portfolio Total: &nbsp;${{ $user_forex_balance + $user_crypto_balance }} USD</span></h3>
                </div>
            </div>
            <div class="uk-card-body h-24 min-h-0 md:min-h-full">

                <!-- ---------------------------------------- -->

                <div class="platinum-wallet">
                    <span class="text text-lg font-medium leading-6 text-gray-600">PLATINUM WALLET</span>
                    <p class="text block text-sm font-medium leading-5 text-gray-700 mt-2"><b>Here is the status of your balance over time.</b></p>

                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

                    <script>
                        const xValues = {!! json_encode($months) ? json_encode($months) : '' !!};
                        const yValues = {!! json_encode($total_balances) ? json_encode($total_balances) : '' !!};

                        new Chart("myChart", {
                            type: "line",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    fill: true,
                                    lineTension: 0.2,
                                    // backgroundColor: "rgba(116,154,217,0.4)",
                                    backgroundColor: "rgba(168,85,247,0.2)",
                                    borderColor: "rgba(168,85,247,0.8)",
                                    borderWidth: 3,
                                    pointBorderWidth: 2.5,
                                    pointHoverRadius: 6,
                                    pointRadius: 4,
                                    pointBackgroundColor: "rgba(168,85,247,1)",
                                    pointHoverBackgroundColor: "rgba(168,85,247,1)",
                                    pointBorderColor: "rgba(168,85,247,1)",
                                    pointHoverBorderColor: "rgba(168,85,247,1)",
                                    steppedLine: false,
                                    data: yValues
                                }]
                            },
                            options: {
                                legend: {display: false},
                                scales: {
                                    yAxes: [{ticks: {min: 50, max:15000}}],
                                }
                            }
                        });
                    </script>
                </div>

                <hr class="seperator">


                <div class="balance-dials">
    <span class="text text-lg font-medium leading-6 text-gray-600">BALANCE STATUS</span>
    <p class="text block text-sm font-medium leading-5 text-gray-700 mt-2"><b>Here is the status of your balance by type.</b></p>

    <div class="container mt-10 flex gap-6">
        <!-- First SVG here -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 920 520" class="results__dial">

<title>Your Crypto Balance</title>

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
    <text class="results__dial-effect results__text text-center" x="200" y="350" font-size="28" fill="#64d3de">CRYPTO</text>
    <text class="results__dial-results results__text" text-anchor="middle" x="250" y="285" fill="#64d3de">
        <tspan baseline-shift="super">$</tspan>
        <tspan fill="#fff" class="results__dial-saving">{{ $user_crypto_balance ? $user_crypto_balance : 0 }}</tspan>
    </text>
</g>
<!-- <g class="results__dial-drag" fill="#fff">
    <g class="results__dial-drag-inner">
        <circle class="results__dial-drag-hit" cx="260" cy="35" r="30" fill="white" opacity="0" />
        <circle class="results__dial-drag-pad" cx="260" cy="35" r="20" />
        <g class="results__dial-drag-arrows" fill="#092a30">
            <polygon points="266.73 38.66 266 37.96 268.55 35.48 266 33.01 266.73 32.3 270 35.48 266.73 38.66" />
            <polygon points="253.27 38.66 254 37.96 251.45 35.48 254 33.01 253.27 32.3 250 35.48 253.27 38.66" />
            <rect x="251" y="35" width="18" height="1"  />
        </g>
    </g>
    <rect class="results__dial-drag-line" x="260" y="55" width="1" height="35" />
</g> -->
</svg>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 920 520" class="results__dial">
<title>Your Forex Balance</title>
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
    <text class="results__dial-effect results__text text-center" x="215" y="350" font-size="28" fill="#64d3de">FOREX</text>
    <text class="results__dial-results results__text" text-anchor="middle" x="250" y="285" fill="#64d3de">
        <tspan baseline-shift="super">$</tspan>
        <tspan fill="#fff" class="results__dial-saving">{{ $user_forex_balance ? $user_forex_balance : 0 }}</tspan>
    </text>
</g>
<!-- <g class="results__dial-drag" fill="#fff">
    <g class="results__dial-drag-inner">
        <circle class="results__dial-drag-hit" cx="260" cy="35" r="30" fill="white" opacity="0" />
        <circle class="results__dial-drag-pad" cx="260" cy="35" r="20" />
        <g class="results__dial-drag-arrows" fill="#092a30">
            <polygon points="266.73 38.66 266 37.96 268.55 35.48 266 33.01 266.73 32.3 270 35.48 266.73 38.66" />
            <polygon points="253.27 38.66 254 37.96 251.45 35.48 254 33.01 253.27 32.3 250 35.48 253.27 38.66" />
            <rect x="251" y="35" width="18" height="1"  />
        </g>
    </g>
    <rect class="results__dial-drag-line" x="260" y="55" width="1" height="35" />
</g> -->
</svg>
        <!-- Second SVG here -->
    </div>
</div>

            </div>
        </div>
    </div>



    <script>

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
			scale: 1.2,
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
			drawSVG: "0% 10%", // animate to the default 10%
			ease: initEasing
		},
		"-=0.4"
	)

	.to(
		$drag,
		0.8,
		{
			rotation: 36, // animate to the default 10%
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
	var val = $drag[0]._gsTransform.rotation;
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
