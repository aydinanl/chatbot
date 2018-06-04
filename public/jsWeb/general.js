$(function(){

  $(".home-slider").pTab({
    pTab: '.tab-list',
    pTabElem: 'li',
    pContent: '.slider-content',
    pDuration: 1000,
    pEffect: 'fadeIn',
    pSlideLoop: true,
    pSlideLoopDuration:5000
  });

    var k = 0;

    var menu3 = $('.menu ul');
    $('.mobile-icon').click(function(){
        var elem = $(this);
        if ( k == 0 ){
            menu3.css('left', '0%');
            $('.menu-icon').find('i').attr("class", 'fa fa-times');
            k++;
        }else{
            menu3.css('left', '-70%');
            $('.menu-icon').find('i').attr("class", 'fa fa-bars');
            k =0;
        }
    });

});
