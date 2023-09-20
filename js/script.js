$(document).ready(function(){

    $('.carousel__inner').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: true,
        cssEase: 'linear',
        prevArrow: '<button type="button" class="slick-prev"><img src="icons/prev.svg"></button>',
        nextArrow: '<button type="button" class="slick-next"><img src="icons/next.svg"></button>',
        responsive: [
            {
              breakpoint: 767,
              settings: {
                fade: false,
                arrows: false,
              }
            }
          ]
    });
    $('.slider').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 300,
        cssEase: 'linear',
        prevArrow: '<button type="button" class="slick-prev"><img src="icons/prev.svg"></button>',
        nextArrow: '<button type="button" class="slick-next"><img src="icons/next.svg"></button>',
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                centerMode: true,
              }
            },
            {
              breakpoint: 480,
              settings: {
                centerMode: true,
                slidesToShow: 1,
              }
            }
          ]
    });



    $('[data-modal=tournament]').on('click', function(){
        $('.overlay, #tournament').fadeIn('o.5s');
    })
    $('[data-modal=workout]').on('click', function(){
        $('.overlay, #workout').fadeIn('o.5s');
    })

    $('[data-modal=modal_tour]').on('click', function(){
        $('.overlay, #modal_tour').fadeIn('o.5s');
    })
    $('[data-modal=modal_history]').on('click', function(){
        $('#modal_history').fadeIn('o.5s');
    })


    $(document).ready(function(){
        $('[data-modal=particip]').on('click', function(){
            var list_id = $(this).attr("id");
             $.ajax({
                  url:"../form/modal_list.php",
                  method:"post",
                  data:{list_id:list_id},
                  success:function(data){
                    $('#list_id').html(data);
                    $('#participants').fadeIn('o.5s');
                    $('#overlay').fadeIn('o.5s');
                  }
             });
        });
    });


    $(document).ready(function(){
        $('[data-modal=modal_tour]').on('click', function(){
            var tour_year = $(this).attr("id");
             $.ajax({
                  url:"../form/modal_year.php",
                  method:"post",
                  data:{tour_year:tour_year},
                  success:function(data){
                    $('#tour_year').html(data);
                  }
             });
        });
    });

    
    $('.modal_close').on('click', function(){
        $('.overlay, #tournament, #participants, #workout, #modal_tour, #thanks, #stop, #modal_history').fadeOut('o.5s');
        $(".body").removeClass('active');
    
    })

    //блокировка фона при открытии модального окна
    $('.bg_block').on('click', function(e){
        e.preventDefault();
        $(".body").addClass('active');
    })


    function valideForms(form){
        $('form').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 15
                },
                phone: 'required',
                surname: {
                    required: true,
                    maxlength: 20,
                    minlength: 2
                },
            },  
            messages: {
                name: {
                    required: "Пожалуйста, введите своё имя",
                    minlength: "Длина имени должна быть больше 2-х символов",
                    maxlength: "Длина имени не должна превышать 15 символов"
                },
                phone: 'Пожалуйста, введите свой номер телефона',
                surname: {
                    required: "Пожалуйста, введите свою фамилию",
                    minlength: "Длина имени должна быть больше 2-х символов",
                    maxlength:  "Длина имени не должна превышать 20 символов",
                },
            },
        });
    }
    valideForms('#tournament form');

    $('input[name=phone]').mask("+7 (999) 999-99-99");

    $('#feed-form').submit(function(e) {
        e.preventDefault();
        if (!$(this).valid()) {
            return;
        }
        $.ajax({
            type: "POST",
            url: "db_teleg.php",
            data: $(this).serialize()
        }).done(function() {
            $(this).find("input").val("");
            $('#tournament').fadeOut();
            $('.overlay, #thanks').fadeIn('0.5s');
            $('form').trigger('reset');
        });
        return false;
    }); 

    $("#modal").on("show", function () {
        $("body").addClass("modal-open");
    }).on("hidden", function () {
        $("body").removeClass("modal-open")
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() >650) {
            $('.pageup').fadeIn();
        } else {
            $('.pageup').fadeOut();
        }
    });

    window.addEventListener('DOMContentLoaded', () => {
        const menu = document.querySelector('.menu_sm'),
        menuItem = document.querySelectorAll('.menu_sm_item'),
        hamburger = document.querySelector('.hamburger');
    
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('hamburger_active');
            menu.classList.toggle('menu_sm_active');
        });
    
        menuItem.forEach(item => {
            item.addEventListener('click', () => {
                hamburger.classList.toggle('hamburger_active');
                menu.classList.toggle('menu_sm_active');
            });
        });
    });
});