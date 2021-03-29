jQuery(document).ready(function($) {

    // POST commands to YouTube or Vimeo API
        function postMessageToPlayer(player, command){
          if (player == null || command == null) return;
          player.contentWindow.postMessage(JSON.stringify(command), "*");
        }

        // When the slide is changing
        function playPauseVideo(slick, control){
          var currentSlide, slideType, startTime, player, video;

          currentSlide = slick.find(".slick-current");
          // slideType = currentSlide.attr("class").split(" ")[1];
          if($('iframe', currentSlide)[0]){
              if($('iframe', currentSlide).attr('src').indexOf('youtube') > -1){
                slideType = 'youtube';
              }else if($('iframe', currentSlide).attr('src').indexOf('vimeo') > -1){
                slideType = 'vimeo';
              }
          }

          player = currentSlide.find("iframe").get(0);
          startTime = currentSlide.data("video-start");


          if (slideType === "vimeo") {
            switch (control) {
              case "play":
                if ((startTime != null && startTime > 0 ) && !currentSlide.hasClass('started')) {
                  currentSlide.addClass('started');
                  postMessageToPlayer(player, {
                    "method": "setCurrentTime",
                    "value" : startTime
                  });
                }
                postMessageToPlayer(player, {
                  "method": "play",
                  "value" : 1
                });
                break;
              case "pause":
                postMessageToPlayer(player, {
                  "method": "pause",
                  "value": 1
                });
                break;
            }
          } else if (slideType === "youtube") {
            switch (control) {
              case "play":
                postMessageToPlayer(player, {
                  "event": "command"
                  // "func": "mute"
                });
                postMessageToPlayer(player, {
                  "event": "command",
                  "func": "playVideo"
                });
                break;
              case "pause":
                postMessageToPlayer(player, {
                  "event": "command",
                  "func": "pauseVideo"
                });
                break;
            }
          } else if (slideType === "video") {
            video = currentSlide.children("video").get(0);
            if (video != null) {
              if (control === "play"){
                video.play();
              } else {
                video.pause();
              }
            }
          }
        }



    $('.cq-videogallery').each(function(index, el) {

        var _this = $(this);
        var _buttonbackground = $(this).data('buttonbackground');
        var _buttonhoverbackground = $(this).data('buttonhoverbackground');
        var _contentcolor = $(this).data('contentcolor');
        var _dotanimation = $(this).data('dotanimation');
        // var _autoslide = parseInt($(this).data('autoslide'));
        var _contentbackground = $(this).data('contentbackground');
        var _arrowcolor = $(this).data('arrowcolor');
        var _arrowhovercolor = $(this).data('arrowhovercolor');
        var _bgcolor = $(this).data('bgcolor');
        var _cover = $('.cq-videogallery-cover', _this);
        var _itemContainer = $('.cq-videogallery-itemcontainer', _this);
        var _isautoheight = $(this).data('isautoheight') == "yes" ? true : false;
        var _istooltip = $(this).data('istooltip') == "yes" ? true : false;
        var _minheight = parseInt($(this).data('minheight'), 10) || 240;
        var _videonum = parseInt($(this).data('videonum'), 10) || 4;
        var _itemWidth = _cover.width();
        var _itemNum = 0;
        var _index = index;

        if(_contentbackground!=""){
            $('.cq-videogallery-area', _this).css('background', _contentbackground);
        }


        var _autoplay = false;

        // if(_autoslide>0) _autoplay = true;

        $('.cq-videogallery-itemcontainer', _this).on('init', function(event, slick){
            $(window).trigger('resize');
        });


        var _imagecarousel = $('.cq-videogallery-itemcontainer', _this).slick({
            infinite: true,
            arrow: true,
            dots: false,
            pauseOnHover: true,
            slidesToShow: 1,
            adaptiveHeight: _isautoheight,
            autoplay: false,
            speed: 600,
            draggable: false,
            swipe: false,
            cssEase:"cubic-bezier(0.87, 0.03, 0.41, 0.9)",
            // asNavFor: $('.cq-videogallery-thumbcontainer', _this),
            // prevArrow: $('.videogallery-navigation-prev', _this),
            // nextArrow: $('.videogallery-navigation-next', _this),
            // autoplaySpeed: _autoslide*1000,
            slidesToScroll: 1
        });


        _imagecarousel.on("init", function(slick){
            slick = $(slick.currentTarget);
            setTimeout(function(){
              playPauseVideo(slick, "play");
            }, 1000);
            // resizePlayer(iframes, 16/9);
        });

        _imagecarousel.on("beforeChange", function(event, slick, currentSlide, nextSlide) {
            slick = $(slick.$slider);
            playPauseVideo(slick,"pause");

            if($('iframe', currentSlide)[0]){
                // if(_autoplay) slick.slick('slickPause');
            }else{
                // if(_autoplay) slick.slick('slickPlay');
            }

        });


        _imagecarousel.on('afterChange', function(event, slick, currentSlide, nextSlide){
            slick = $(slick.$slider);
            playPauseVideo(slick, "play");
            $('.cq-videogallery-thumbcontainer li', _this).each(function(index) {
                $(this).removeClass('is-current');
                if($(this).data('index') == currentSlide) $(this).addClass('is-current');
            });

            // if($('iframe', currentSlide)[0]){
            //     if(_autoplay) slick.slick('slickPause');
            // }else{
            //     // if(_autoplay) slick.slick('slickPlay');
            // }

        });

        $('.cq-videogallery-text:has(iframe)').css('margin-top', '0');


        // $('iframe', $('.cq-videogallery-item', _imagecarousel)).css('background-color', _bgcolor);

        if($('iframe', $('.cq-videogallery-item', _imagecarousel))[0]){
            if(_autoplay) _imagecarousel.slick('slickPause');
        }


        // _imagecarousel.on("afterChange", function(event, slick) {
        //     slick = $(slick.$slider);
        //     playPauseVideo(slick,"play");
        // });



        // var _minheight = parseInt($('.cq-videogallery-item', $(this)).data('minheight'), 10);
        // if(_minheight > 0){
        //     $('.cq-videogallery-noimage', $(this)).css('min-height', _minheight);
        // }else if($('.cq-videogallery-image', $(this)).outerHeight() > 0){
        //     $('.cq-videogallery-noimage', $(this)).css('min-height', $('.cq-videogallery-image', $(this)).outerHeight());
        // }

        // var _slidestoshow = Math.round(_minheight / 64 -1) || 4;

        var _prevBtn = $('.videogallery-navigation-prev', _this);
        var _nextBtn = $('.videogallery-navigation-next', _this);


        var _thumbcarousel = $('.cq-videogallery-thumbcontainer', _this).slick({
            vertical: true,
            infinite: false,
            // arrow: true,
            dots: false,
            slidesToScroll: 1,
            pauseOnHover: true,
            slidesToShow: _videonum,
            // autoSlidesToShow: true,
            // adaptiveHeight: _isautoheight,
            // autoplay: _autoplay,
            // asNavFor: $('.cq-videogallery-itemcontainer', _this),
            speed: 600,
            draggable: false,
            swipe: true,
            prevArrow: _prevBtn,
            nextArrow: _nextBtn,
            cssEase:"cubic-bezier(0.87, 0.03, 0.41, 0.9)"
            // prevArrow: $('.videogallery-thumb-prev', _this),
            // nextArrow: $('.videogallery-thumb-next', _this),
            // autoplaySpeed: _autoslide*1000,
        });

        // if(_minheight < _thumbcarousel.height()) _minheight = _thumbcarousel.height();

        // $('iframe', $('.cq-videogallery-item', _this)).css('min-height', _minheight);

        // $('.cq-videogallery-item', _imagecarousel).css('min-height', );

        $('.cq-videogallery-thumbcontainer li', _this).each(function(index) {
            $(this).data('index', index);
            if(index==0) $(this).addClass('is-current');
            if(_istooltip){
                var _tooltip = $(this).tooltipster({
                    content: $('.cq-videogallery-thumbcaption', $(this)).html(),
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

        $('.cq-videogallery-thumbcontainer', _this).on('click', 'li', function(event) {
            $('.cq-videogallery-thumbcontainer li', _this).each(function(index) {
                $(this).removeClass('is-current');
            });
            $(this).addClass('is-current');
            // _imagecarousel.slickGoTo($(this).data('index'));
            _imagecarousel.slick('slickGoTo', $(this).data('index'));
            event.preventDefault();
        });


        // $('a.cq-videogallery-lightbox', _this).each(function() {
        //     $(this).boxer({
        //         fixed : true
        //     });
        // });

        _itemNum = $('.cq-videogallery-image', _this).length;

        var _currentItem = 0;


        if(_arrowcolor!=""){
            $('.videogallery-navigation-prev, .videogallery-navigation-next', _this).css('color', _arrowcolor);;
        }

        $('iframe', $('.cq-videogallery-item', _this)).css('min-height', Math.max(_minheight, _thumbcarousel.height()));
        var _resizeID = 0;
        $(window).on('resize', function(event) {
            // if(_this.width()<320){
            //     $('.cq-videogallery-thumbcaption', _this).css('display', 'none');
            // } else{
            //     $('.cq-videogallery-thumbcaption', _this).css('display', 'inline-block');
            // }
            clearTimeout(_resizeID);
            var _resizeID = setTimeout(function(){
                clearTimeout(_resizeID);
                // $('iframe', $('.cq-videogallery-item', _this)).css('min-height', _thumbcarousel.height());
                $('iframe', $('.cq-videogallery-item', _this)).css('min-height', Math.max(_minheight, _thumbcarousel.height()));
            }, 500)


            event.preventDefault();
        });




        if(_buttonbackground!=""){
            _nextBtn.css('background', _buttonbackground);
            _prevBtn.css('background', _buttonbackground);
        }
        _nextBtn.on('mouseover', function() {
            $(this).css('background', _buttonhoverbackground);
            if(_arrowhovercolor!=""){
                $(this).css('color', _arrowhovercolor);
            }
        }).on('mouseleave', function(event) {
            if(_buttonbackground!=""){
                $(this).css('background', _buttonbackground);
            }else{
                $(this).css('background', '');
            }
            if(_arrowhovercolor!=""){
                if(_arrowcolor!=""){
                    $(this).css('color', _arrowcolor);
                }else{
                    $(this).css('color', '');
                }
            }
        })

        _prevBtn.on('mouseover', function() {
            $(this).css('background', _buttonhoverbackground);
            if(_arrowhovercolor!=""){
                $(this).css('color', _arrowhovercolor);
            }
        }).on('mouseleave', function(event) {
            if(_buttonbackground!=""){
                $(this).css('background', _buttonbackground);
            }else{
                $(this).css('background', '');
            }

            if(_arrowhovercolor!=""){
                if(_arrowcolor!=""){
                    $(this).css('color', _arrowcolor);
                }else{
                    $(this).css('color', '');
                }
            }
        })

    });
});
