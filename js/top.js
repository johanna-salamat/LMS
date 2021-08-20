

  $(".logoin").hover(function(){

    $(".loginMask").show();
    // if($("#loginOut").css("display")=="block"){
    //   $(".login-off").show();
    // }else{
    //   $(".login-off").hide();
    // }
      
})

$(".logoin").mouseleave(function(){

  $(".loginMask").hide();
  // if($("#loginOut").css("display")=="block"){
  //   $(".login-off").show();
  // }else{
  //   $(".login-off").hide();
  // }
    
})
// Right menu bar
$(".menu").click(function(){
  $('.nav_box').show();
  $('.nav_left').on('click',function (e) {
      e.stopPropagation();
  })
  $('.searchall').hide();
  $('.nav_box .nav_left .nav_close').on('click',function () {
      $('.nav_box').hide()
  })
  $('.nav_box').on('click',function () {
      $('.nav_box').hide()
  })
  $('.ring').on('click',function () {
    $(this).find("._img").css("background-image","url(https://img.ido-love.com/icon/ring_hover.png)")
    $(".gift").find("._img").css("background-image","url(https://img.ido-love.com/icon/gift.png)")
    $(".series").find("._img").css("background-image","url(https://img.ido-love.com/icon/series.png)")
      var className = 'ring_product'
      $('.nav_middle>div').hide()
      $('.rightlist').hide()
      $('#ring_nav').show()
      $('.nav_middle').on('click',function (e) {
          e.stopPropagation();
      })
      $('#ring_nav').children('.nav_one').children('a').css('background','#f0f0f0')
      $('.ring_list').show()
      $('.nav_right').on('click',function (e) {
          e.stopPropagation();
      })
      $('.jiehun .g_r_img img').each(function () {
          if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
              if ($(this).attr('data-src'))
                  $(this).attr('src', $(this).attr('data-src'))
          }
      });
      $('.ring_child>a').on('mouseover',function () {
       var suoyin =  $(this).index()
  
          className = $(this).parents('.ring_child').data('id')
   

        if(className=='jiehun'){
          $('.qiuhun').hide()

          $('.jiehun').show()
        }else if(className=='qiuhun'){
          $('.jiehun').hide()
          $('.qiuhun').show()

        }

          $('.ring_child').children('a').css('background','#fff')
          $(this).css('background','#f0f0f0')
          $('.upbtn').hide()
          // $(that).siblings('.ring_product').scrollTop(0).hide()
          // $(that).show() 
          // if(fn(className)[0].scrollHeight > $('.'+className).height()){
          //     $('.downbtn').show()
          // }else{
          //     $('.downbtn').hide()
          // }
          $('.' + className + ' .g_r_img img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
      })
      $('.ring_child>a').on('mouseout',function () {
   
          $('.ring_child').children('a').css('background','#fff')
      })
      $('.ring_list .ring_product').scroll(function () {
          $(this).find('img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
      })
      $('.' + className).on('scroll',function () {
          iScroll(className,'upbtn','downbtn',1)
      })
      $('.ring_list').on('click','.right_up',function () {
          iUp(className,150)
      })
      $('.ring_list').on('click','.right_down',function () {
          iDown(className,150)
      })
      // if(fn(className)[0].scrollHeight > $('.'+className).height()){
      //     $('.downbtn').show()
      // }else{
      //     $('.downbtn').hide()
      // }
  })
  $('.gift').on('click',function () {
    $(".ring").find("._img").css("background-image","url(https://img.ido-love.com/icon/ring.png)")
    $(this).find("._img").css("background-image","url(https://img.ido-love.com/icon/gift_hover.png)")
    $(".series").find("._img").css("background-image","url(https://img.ido-love.com/icon/series.png)")
      var className = 'gift_product'
      $('.nav_middle>div').hide()
      $('.rightlist').hide()
      $('#  ').show()
      $('.nav_middle').on('click',function (e) {
          e.stopPropagation();
      })
      $('#gift_nav').children('.nav_one').children('a').css('background','#f0f0f0')
      $('.gift_list').show()
      $('.nav_right').on('click',function (e) {
          e.stopPropagation();
      })
      $('.jinian .g_r_img img').each(function () {
          if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
              if ($(this).attr('data-src'))
                  $(this).attr('src', $(this).attr('data-src'))
          }
      })
      $('.gift_child>a').on('mouseover',function () {
          className = $(this).parents('.gift_child').data('id')
          var that = fn(className)[0]
          $('.gift_child').children('a').css('background','#fff')
          $(this).css('background','#f0f0f0')
          $('.upbtn').hide()
          $(that).siblings('.gift_product').scrollTop(0).hide()
          $(that).show()
          if(fn(className)[0].scrollHeight > $('.'+className).height()){
              $('.downbtn').show()
          }else{
              $('.downbtn').hide()
          }
          $('.' + className + ' .g_r_img img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
      })
      $('.gift_child>a').on('mouseout',function () {
          $('.gift_child').children('a').css('background','#fff')
      })
      $('.gift_list .gift_product').scroll(function () {
          $(this).find('img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1500) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
      })
      if(fn(className)[0].scrollHeight > $('.'+className).height()){
          $('.downbtn').show()
      }else{
          $('.downbtn').hide()
      }
      $('.' + className).on('scroll',function () {
          iScroll(className,'upbtn','downbtn',2)
      })
      $('.gift_list').on('click','.right_up',function () {
          iUp(className,150)
      })
      $('.gift_list').on('click','.right_down',function () {
          iDown(className,150)
      })
  })
  $('.series').on('click',function () {
    $(".ring").find("._img").css("background-image","url(https://img.ido-love.com/icon/ring.png)")
    $(".gift").find("._img").css("background-image","url(https://img.ido-love.com/icon/gift.png)")
    $(this).find("._img").css("background-image","url(https://img.ido-love.com/icon/series_hover.png)")
      var className = 'product'
      $('.nav_middle>div').hide()
      $('.rightlist').hide()
      $('#series_nav .arrow_up .up').hide()
      $('#series_nav').show()
      $('.nav_middle').on('click',function (e) {
          e.stopPropagation();
      })
      // if(fn('childbox')[0].scrollHeight > $('.childbox').height()){
      //     $('#series_nav .arrow_down .down').show()
      // }else{
      //     $('#series_nav .arrow_down .down').hide()
      // }
      $('.childbox').children('.nav_one').children('.series_title').css('background','#f0f0f0')
      $('.series_list').show()
      $('.nav_right').on('click',function (e) {
          e.stopPropagation();
      })
      className = $('.childbox').children('.nav_one').children('a').data('id');
      // if(fn(className)[0].scrollHeight > $('.'+className).height()){
      //     $('.downbtn').show()
      // }else{
      //     $('.downbtn').hide()
      // }
      $('.' + className + ' .series_img img').each(function () {
          if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1000) {
              if ($(this).attr('data-src'))
                  $(this).attr('src', $(this).attr('data-src'))
          }
      });
      $('.series_title').on('mouseover',function () {
          className = $(this).data('id')
          // var that = fn(className)[0]
          $('.series_title').css('background','#fff')
          $(this).css('background','#f0f0f0')
          $('.upbtn').hide()
          if(className =='series100'){
            $('.list_content').children().hide();
            $('.series100').show();
          }else if(className =='series13'){
            $('.list_content').children().hide();
            $('.series13').show();
          }else if(className =='series03'){
            $('.list_content').children().hide();
            $('.series03').show();
          }else if(className =='series14 '){
            $('.list_content').children().hide();
            $('.series14 ').show();
          }else if(className =='series00 '){
            $('.list_content').children().hide();
            $('.series00 ').show();
          }else if(className =='series08'){
            $('.list_content').children().hide();
            $('.series08 ').show();
          }
          // $(that).siblings('.product').scrollTop(0).hide()
          // $(that).show()
          // if(fn(className)[0].scrollHeight > $('.'+className).height()){
          //     $('.downbtn').show()
          // }else{
          //     $('.downbtn').hide()
          // }
          $('.' + className + ' .series_img img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1000) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
          $('.' + className ).on('scroll',function () {
              iScroll(className,'upbtn','downbtn',0)
          })
      })
      $('.series_title').on('mouseout',function () {
          $('.series_title').css('background','#fff')
      })
      $('.series_list .product').scroll(function () {
          $(this).find('img').each(function () {
              if ($(this).offset().top > window.scrollY && $(this).offset().top < window.scrollY + 1000) {
                  if ($(this).attr('data-src'))
                      $(this).attr('src', $(this).attr('data-src'))
              }
          })
      })
      // if(fn(className)[0].scrollHeight > $('.'+className).height()){
      //     $('.downbtn').show()
      // }else{
      //     $('.downbtn').hide()
      // }
      $('.' + className ).on('scroll',function () {
          iScroll(className,'upbtn','downbtn',0)
      })
      $('.series_list').on('click','.right_up',function () {
          iUp(className,200)
      })
      $('.series_list').on('click','.right_down',function () {
          iDown(className,200)
      })
      $('#series_nav').on('click','.arrow_down',function () {
          iDown('childbox',60)
      })
      $('#series_nav').on('click','.arrow_up',function () {
          iUp('childbox',60)
      })
      $('.childbox').on('scroll',function () {
          iScroll('childbox','up','down',0)
      })
  })


})

// Top
$(".allgotop").click(function() {
    $('body,html').animate({
            scrollTop: 0
        },
        1000);
    return false;
});
