<!-- Banner Carousel -->
<div class="banner-carousel swiper-container relative mb-[100px]">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/600" alt="">
        </div>
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/601" alt="">
        </div>
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/602" alt="">
        </div>
    </div>
    <div class="swiper-button-next absolute z-20 top-1/2 right-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-button-prev absolute z-20 top-1/2 left-[15px] transform -translate-y-1/2"></div>
    <div class="swiper-pagination z-20"></div>
    <div class="absolute z-10 inset-0 bg-green-500 bg-opacity-50 h-full w-full flex items-center">
        <div class="container mx-auto">
            <div class="text-[80px] text-white">Lorem ipsum</div>
            <button type="button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Button
            </button>
        </div>
    </div>
</div>
<!-- Hover Link Carousel -->
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="hover-link-carousel swiper-container relative">
        <div class="swiper-wrapper">
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/500/300" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-[30px] text-white">Lorem ipsum</div>
                </div>
            </a>
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/500/301" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-[30px] text-white">Lorem ipsum</div>
                </div>
            </a>
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/500/302" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-[30px] text-white">Lorem ipsum</div>
                </div>
            </a>
        </div>
        <div class="swiper-button-next top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Sync Carousel -->
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="sync-primary-carousel swiper-container relative mb-[30px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/600" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/601" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/602" alt="">
            </div>
        </div>
    </div>
    <div class="sync-secondary-carousel swiper-container relative h-[300px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/600" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/601" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/602" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Numbered Carousel -->
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="numbered-carousel swiper-container relative">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/500" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/501" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/502" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination absolute z-10 bottom-0 left-1/2 my-[15px] transform -translate-x-1/2 flex justify-center"></div>
        <div class="absolute z-10 bottom-0 left-0 m-[15px] flex items-center justify-center bg-blue-500 text-white h-[50px] w-[50px]" id="swiper-fraction">
        </div>
    </div>
</div>
<!-- Centered Carousel -->
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="centered-carousel swiper-container relative" x-data="{ navigation: false }" x-on:mouseover="navigation = true" x-on:mouseleave="navigation = false">
        <div class="swiper-wrapper">
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/400/300" alt="">
                </div>
            </div>
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/400/301" alt="">
                </div>
            </div>
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/400/302" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-button-prev absolute top-1/2 left-0 transform -translate-y-1/2 transition-all duration-300" x-bind:class="{ 'translate-x-full': navigation, '-translate-x-full' : !navigation }"></div>
        <div class="swiper-button-next absolute top-1/2 right-0 transform -translate-y-1/2 transition-all duration-300" x-bind:class="{ '-translate-x-full': navigation, 'translate-x-full' : !navigation }"></div>
    </div>
</div>
<!-- Halfway Carousel -->
<div class="grid grid-cols-12 mb-[100px]">
    <div class="col-span-9 col-start-4 halfway-carousel swiper-container relative">
        <div class="swiper-wrapper">
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/300" alt="">
            </div>
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/301" alt="">
            </div>
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/302" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- My Swiper Carousel -->
<div class="container mx-auto mb-[100px] px-[15px]">
    <div class="my-swiper swiper-container relative h-[300px]">
        <ul class="swiper-wrapper my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1080" itemprop="contentUrl" data-size="1920x1080">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 1</p>
            </li>
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1081" itemprop="contentUrl" data-size="1920x1081">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1081" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 2</p>
            </li>
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1082" itemprop="contentUrl" data-size="1920x1082">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1082" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 3</p>
            </li>
        </ul>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
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
