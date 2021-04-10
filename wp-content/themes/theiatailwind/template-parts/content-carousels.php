<!-- Banner Carousel -->
<div class="banner-carousel swiper-container h-[400px] xl:h-[600px] mb-20 relative">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
        </div>
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
        </div>
        <div class="swiper-slide">
            <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
        </div>
    </div>
    <div class="swiper-button-next absolute z-20 top-1/2 right-4 transform -translate-y-1/2"></div>
    <div class="swiper-button-prev absolute z-20 top-1/2 left-4 transform -translate-y-1/2"></div>
    <div class="swiper-pagination z-20"></div>
    <div class="flex items-center h-full w-full bg-yellow-100 bg-opacity-50 absolute z-10 inset-0 ">
        <div class="container px-4 mx-auto">
            <div class="text-8xl text-white pb-4">Lorem ipsum</div>
            <button type="button" class="inline-flex font-medium text-base text-white items-center bg-blue-700 px-6 py-3 border border-transparent rounded-md shadow-sm transition-all duration-300 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">
                Lorem
            </button>
        </div>
    </div>
</div>
<!-- Halfway Carousel -->
<div class="grid grid-cols-12 mb-20 gap-8 relative">
    <div class="col-span-12 xl:col-span-6 xl:col-start-7 halfway-carousel swiper-container relative order-1 xl:order-0">
        <div class="swiper-wrapper">
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide h-[300px] w-[75%]">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="col-span-12 flex flex-col items-start justify-center h-full container px-4 mx-auto relative xl:absolute xl:inset-0 order-0 xl:order-1">
        <div class="text-6xl pb-4">Lorem ipsum dolor</div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, ipsum?</div>
    </div>
</div>
<!-- Hover Link Carousel -->
<div class="container px-4 mx-auto mb-20">
    <div class="hover-link-carousel swiper-container relative">
        <div class="swiper-wrapper">
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/1920/1080" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-2xl text-white">Lorem ipsum</div>
                </div>
            </a>
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/1920/1080" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-2xl text-white">Lorem ipsum</div>
                </div>
            </a>
            <a href="#" class="swiper-slide relative overflow-hidden" x-data="{ overlay : false }" x-on:mouseover="overlay = true" x-on:mouseleave="overlay = false">
                <img class="object-cover object-center h-full w-full transition-all duration-300 transform" src="https://picsum.photos/1920/1080" alt="" x-bind:class="{'scale-150' : overlay, 'scale-100': !overlay}">
                <div class="absolute z-10 inset-0 h-full w-full bg-yellow-500 bg-opacity-50"
                     x-show="overlay"
                     x-transition:enter="transition-opacity duration-300 ease-linear"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-300 ease-linear"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <div class="flex items-center justify-center h-full w-full text-2xl text-white">Lorem ipsum</div>
                </div>
            </a>
        </div>
        <div class="swiper-button-next top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev top-1/2 left-4 transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Centered Carousel -->
<div class="container px-4 mx-auto mb-20">
    <div class="centered-carousel swiper-container relative" x-data="{ navigation: false }" x-on:mouseover="navigation = true" x-on:mouseleave="navigation = false">
        <div class="swiper-wrapper">
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="swiper-slide h-[500px] w-[500px]">
                <div class="flex items-center justify-center h-full w-full">
                    <img src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-button-prev absolute top-1/2 left-0 transform -translate-y-1/2 transition-all duration-300" x-bind:class="{ 'translate-x-full': navigation, '-translate-x-full' : !navigation }"></div>
        <div class="swiper-button-next absolute top-1/2 right-0 transform -translate-y-1/2 transition-all duration-300" x-bind:class="{ '-translate-x-full': navigation, 'translate-x-full' : !navigation }"></div>
    </div>
</div>
<!-- Sync Carousel -->
<div class="container px-4 mx-auto mb-20">
    <div class="sync-primary-carousel swiper-container relative mb-8">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
        </div>
    </div>
    <div class="sync-secondary-carousel swiper-container relative h-[300px]">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Numbered Carousel -->
<div class="container px-4 mx-auto mb-20">
    <div class="numbered-carousel swiper-container relative">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2"></div>
        <div class="swiper-pagination absolute z-10 bottom-0 left-1/2 my-4 transform -translate-x-1/2 flex justify-center"></div>
        <div class="absolute z-10 bottom-0 left-0 m-4 flex items-center justify-center bg-blue-700 text-white h-12 w-12" id="swiper-fraction">
        </div>
    </div>
</div>
<!-- My Swiper Carousel -->
<div class="container px-4 mx-auto mb-20">
    <div class="my-swiper swiper-container relative h-[300px]">
        <ul class="swiper-wrapper my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1080" itemprop="contentUrl" data-size="1920x1080">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 1</p>
            </li>
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1080" itemprop="contentUrl" data-size="1920x1081">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 2</p>
            </li>
            <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="https://picsum.photos/1920/1080" itemprop="contentUrl" data-size="1920x1082">
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" itemprop="thumbnail" alt="Image description"/>
                </a>
                <p itemprop="caption description">Image caption 3</p>
            </li>
        </ul>
        <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2"></div>
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
<!-- Vertical Line On Carousel A -->
<div class="grid grid-cols-12 mb-20 relative">
    <div class="col-span-12 vertical-line-on-carousel-a swiper-container relative">
        <div class="swiper-wrapper">
            <div class="flex items-end swiper-slide h-[780px] w-[40%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[40%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[40%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Vertical Line On Carousel B -->
<div class="grid grid-cols-12 mb-20 relative">
    <div class="col-span-9 col-start-4 vertical-line-on-carousel-b swiper-container relative">
        <div class="swiper-wrapper">
            <div class="flex items-end swiper-slide h-[780px] w-[50%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[30%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[50%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Vertical Line On Carousel C -->
<div class="grid grid-cols-12 mb-20 relative">
    <div class="col-span-9 col-start-4 vertical-line-on-carousel-c swiper-container relative">
        <div class="swiper-wrapper">
            <div class="flex items-end swiper-slide h-[780px] w-[60%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[60%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
            <div class="flex items-end swiper-slide h-[780px] w-[60%]">
                <div class="h-[680px] w-100 relative">
                    <div class="flex items-start justify-end h-[200px] w-[150px] border-l-[1px] border-black absolute top-[-15%] left-[20%]">
                        <div>
                            <div class="font-bold">Lorem ipsum.</div>
                            <small>Lorem ipsum</small>
                        </div>
                    </div>
                    <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/1080" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-button-next absolute top-1/2 right-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-button-prev absolute top-1/2 left-[15px] transform -translate-y-1/2"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
