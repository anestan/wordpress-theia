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
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/300" alt="">
            </div>
            <div class="swiper-slide">
                <img class="object-cover object-center h-full w-full" src="https://picsum.photos/1920/301" alt="">
            </div>
            <div class="swiper-slide">
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
                <img class="object-cover object-center h-full w-full"  src="https://picsum.photos/600/300" itemprop="thumbnail" alt="Image description" />
            </a>
            <p itemprop="caption description">Image caption 1</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1081" itemprop="contentUrl" data-size="1920x1081">
                <img class="object-cover object-center h-full w-full"  src="https://picsum.photos/600/301" itemprop="thumbnail" alt="Image description" />
            </a>
            <p itemprop="caption description">Image caption 2</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1082" itemprop="contentUrl" data-size="1920x1082">
                <img class="object-cover object-center h-full w-full"  src="https://picsum.photos/600/302" itemprop="thumbnail" alt="Image description" />
            </a>
            <p itemprop="caption description">Image caption 3</p>
        </li>
        <li class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a title="click to zoom-in" href="https://picsum.photos/1920/1083" itemprop="contentUrl" data-size="1920x1083">
                <img class="object-cover object-center h-full w-full"  src="https://picsum.photos/600/303" itemprop="thumbnail" alt="Image description" />
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
<?php
get_footer();
?>
