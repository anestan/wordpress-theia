<?php
get_header();
?>
<div class="banner-carousel-swiper swiper-container relative h-[600px] w-full mb-[100px]">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="swiper-lazy object-cover object-center h-full w-full" src="https://picsum.photos/1920/600" alt="">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
            <img class="swiper-lazy object-cover object-center h-full w-full" src="https://picsum.photos/1920/601" alt="">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
            <img class="swiper-lazy object-cover object-center h-full w-full" src="https://picsum.photos/1920/602" alt="">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
    </div>
    <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-pagination"></div>
</div>
<div class="container mx-auto mb-[100px] px-[15px]">
    <div id="map" class="h-[500px] w-full"></div>
</div>
<div id="contact-form"></div>
<div class="grid grid-cols-12 mb-[100px]">
    <div class="col-span-9 col-start-4 half-way-carousel-swiper swiper-container relative h-[300px] w-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/300" alt="">
            </div>
            <div class="swiper-slide w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/301" alt="">
            </div>
            <div class="swiper-slide w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/302" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div class="my-swiper swiper-container relative h-[300px] w-full mb-[100px]">
    <ul class="swiper-wrapper my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1080" itemprop="contentUrl" data-size="1920x1080">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/600/300" itemprop="thumbnail" alt="Image description"/>
            </a>
            <p itemprop="caption description">Image caption 1</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1081" itemprop="contentUrl" data-size="1920x1081">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/600/301" itemprop="thumbnail" alt="Image description"/>
            </a>
            <p itemprop="caption description">Image caption 2</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1082" itemprop="contentUrl" data-size="1920x1082">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/600/302" itemprop="thumbnail" alt="Image description"/>
            </a>
            <p itemprop="caption description">Image caption 3</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1083" itemprop="contentUrl" data-size="1920x1083">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/600/303" itemprop="thumbnail" alt="Image description"/>
            </a>
            <p itemprop="caption description">Image caption 4</p>
        </li>
    </ul>
    <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-pagination"></div>
</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Background of PhotoSwipe.
        It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>
    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">
        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="sync-primary-carousel-swiper swiper-container relative h-[300px] w-full mb-[30px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/300" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/301" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/303" alt="">
            </div>
        </div>
    </div>
    <div class="sync-secondary-carousel-swiper swiper-container relative h-[150px] w-full">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/400/150" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/400/151" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/400/152" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div class="container mx-auto mb-[100px] px-[15px]" x-data="{ tab: '1' }">
    <div class="grid grid-cols-12">
        <div class="col-span-1 p-[15px] bg-red-500 cursor-pointer" x-on:click="tab = '1'">Tab #1</div>
        <div class="col-span-1 p-[15px] bg-green-500 cursor-pointer" x-on:click="tab = '2'">Tab #2</div>
        <div class="col-span-1 p-[15px] bg-blue-500 cursor-pointer" x-on:click="tab = '3'">Tab #3</div>
    </div>
    <div class="grid grid-cols-12 h-[300px]">
        <div class="col-span-12 p-[15px] bg-red-500" x-show="tab === '1'" style="display: none;">
            Content #1
        </div>
        <div class="col-span-12 p-[15px] bg-green-500" x-show="tab === '2'" style="display: none;">
            Content #2
        </div>
        <div class="col-span-12 p-[15px] bg-blue-500" x-show="tab === '3'" style="display: none;">
            Content #3
        </div>
    </div>
</div>
<div class="container mx-auto px-[15px] mb-[100px]">
    <ul x-data="{ tab : null }">
        <li class="bg-red-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 1 ? tab = 1 : tab = null">Tab #1</div>
            <div class="relative overflow-hidden bg-red-300 transition-all duration-300" x-ref="tab1" x-bind:style="tab == 1 ? 'max-height: ' + $refs.tab1.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">
                    <p>Content #1</p>
                </div>
            </div>
        </li>
        <li class="bg-green-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 2 ? tab = 2 : tab = null">Tab #2</div>
            <div class="relative overflow-hidden bg-green-300 transition-all duration-300" x-ref="tab2" x-bind:style="tab == 2 ? 'max-height: ' + $refs.tab2.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">
                    <p>Content #2</p>
                </div>
            </div>
        </li>
        <li class="bg-blue-500">
            <div class="p-[15px] cursor-pointer" x-on:click="tab !== 3 ? tab = 3 : tab = null">Tab #3</div>
            <div class="relative overflow-hidden bg-blue-300 transition-all duration-300" x-ref="tab3" x-bind:style="tab == 3 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px' : 'max-height: 0px'">
                <div class="p-[15px]">
                    <p>Content #3</p>
                </div>
            </div>
        </li>
    </ul>
</div>
<!-- redo sync carousel -->
<!-- carousel with index and custom pagination label -->
<div id="scroll-to-top" class="fixed z-10 bottom-[100px] right-[100px] cursor-pointer bg-gray-300 p-[15px] rounded-full shadow-xl transition-all duration-300">
    <svg class="h-[30px] w-[30px] text-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
</div>
<?php
get_footer();
?>
