jQuery(document).ready(function($) {

    $('.cq-parallaxslider').each(function(index, el) {
        var _this = $(this);
        var _itemsize = $(this).data('itemsize');
        var _transparentitem = $(this).data('transparentitem') == "yes" ? true:false;
        var _autoheight = $(this).data('autoheight') == "yes" ? true:false;
        var _labelfontsize = $(this).data('labelfontsize');
        var _subfontsize = $(this).data('subfontsize');
        var _arrowcolor = $(this).data('arrowcolor');
        var _arrowhovercolor = $(this).data('arrowhovercolor');
        var _arrowhoverbg = $(this).data('arrowhoverbg');
        var _arrowbg = $(this).data('arrowbg');
        // var _transition = $(this).data('transition');
        var _autoslide = parseInt($(this).data('autoslide'), 10);

        var _currentIndex = 0;
        var _videomode = true;
        var _slideID = 0;

        var _autoslideObj;
        if(_autoslide > 0){
           _autoslideObj =  JSON.parse(JSON.stringify({delay: _autoslide*1000, disableOnInteraction: false}));
        }else{
            _autoslideObj = false;
        }

        var _tooltipArr = [];
        $('.cq-parallaxslider-imgcontainer', _this).each(function(index) {
            _tooltipArr[index] = $(this).attr('title');
        });


        if(_arrowhovercolor != ""){
          $('.cq-parallaxslider-button', _this).on('mouseover', function(event) {
              $(this).css('color', _arrowhovercolor);
              event.preventDefault();
          }).on('mouseleave', function(event) {
              if(_arrowcolor != ""){
                  $(this).css('color', _arrowcolor);
              }else{
                  $(this).css('color', '');
              }
              event.preventDefault();
          });
        }

        if(_arrowhoverbg != ""){
          $('.cq-parallaxslider-button', _this).on('mouseover', function(event) {
              $(this).css('background-color', _arrowhoverbg);
              event.preventDefault();
          }).on('mouseleave', function(event) {
              if(_arrowbg != "") {
                  $(this).css('background-color', _arrowbg);
              } else {
                  $(this).css('background-color', '');
              }
              event.preventDefault();
          });
        }



        var _dotcolorArr = [];
        $('.cq-parallaxslider-item', _this).each(function(index) {
              _dotcolorArr[index] = $(this).data('dotcolor');
        });
        var interleaveOffset = 0.5;
        var swiper = new Swiper( _this, {
              spaceBetween: 0,
              // parallax: true,
              // effect: _transition,
              autoHeight: _autoheight,
              loop: true,
              loopAdditionalSlides: 10,
              grabCursor: true,
              watchSlidesProgress: true,
              autoplay: _autoslideObj,
              watchSlidesProgress: true,
              // mousewheel: {
              //   invert: false,
              // },
              // autoHeight: true,
              on: {
                init: function () {
                    // $(window).trigger('resize');
                },
                progress: function(){
                  var swiper = this;
                  for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress,
                        innerOffset = swiper.width * interleaveOffset,
                        innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".cq-parallaxslider-image").style.transform =
                      "translateX(" + innerTranslate + "px)";
                  }
                },
                touchStart: function() {
                  var swiper = this;
                  for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                  }
                },
                setTransition: function(speed) {
                  var swiper = this;
                  for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".cq-parallaxslider-image").style.transition =
                      speed + "ms";
                  }
                }

              },
              // pagination: {
              //   el: '.cq-parallaxslider-nav',
              //   clickable: true,
              // },
              pagination: {
                el: '.cq-parallaxslider-nav',
                clickable: true,
                renderBullet: function (index, className) {
                  return '<div class="' + className + '" title="' + _tooltipArr[index] + '" style=""></div>';
                },
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              }

        });

        // var _loadingID = 0;
        // $('.cq-parallaxslider-item', _this).on('animationend transitionend webkitTransitionEnd oTransitionEnd', function () {
        //     // var _loadingbar = $(this);
        //     // $(this).removeClass('cq-isloading-' + _autoslide);
        //     clearTimeout(_loadingID);
        //     _loadingID = setTimeout(function(){
        //       // _loadingbar.addClass('cq-isloading-' + _autoslide);
        //       swiper.slideNext();
        //     }, 100)
        // });

        _this.on('mouseover', function(event) {
           // $('.cq-parallaxslider-item', _this).css("-webkit-animation-play-state", "paused");
          event.preventDefault();
        }).on('mouseleave', function(event) {
           // $('.cq-parallaxslider-item', _this).css("-webkit-animation-play-state", "running");
          event.preventDefault();
        });

        $('.cq-parallaxslider-image', _this).each(function(index) {
            var _tooltip = $(this).attr('title');
            if(_tooltip&&_tooltip!==""){
                var _tooltip = $(this).tooltipster({
                    content: _tooltip,
                    position: 'top',
                    // offsetY: '-4',
                    delay: 200,
                    // minWidth: _minwidth,
                    // maxWidth: 600,
                    // autoClose: _autoclose,
                    interactive: true,
                    // onlyOne: true,
                    // timer: 2000,
                    speed: 300,
                    touchDevices: true,
                    // interactive: false,
                    animation: 'grow',
                    theme: 'tooltipster-shadow',
                    contentAsHTML: true
                });
            }

        });

        $('.swiper-pagination-bullet', _this).each(function(index) {
            var _tooltip = $(this).attr('title');
            if(_tooltip&&_tooltip!==""){
                var _tooltip = $(this).tooltipster({
                    content: _tooltip,
                    position: 'top',
                    // offsetY: '-4',
                    delay: 200,
                    // minWidth: _minwidth,
                    // maxWidth: 600,
                    // autoClose: _autoclose,
                    interactive: true,
                    // onlyOne: true,
                    // timer: 2000,
                    speed: 300,
                    touchDevices: true,
                    // interactive: false,
                    animation: 'grow',
                    theme: 'tooltipster-shadow',
                    contentAsHTML: true
                });
            }

        });




    });
});
