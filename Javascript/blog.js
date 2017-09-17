$(document).ready(function(){
  //mobile menu
  var $window = $(window);
  var $html = $('html');
  var $body = $html.find('body');
  var $loader = $body.find('> :first-child');
  var $bodyContainer = $body.find('div.body-container');
  var $nav = $body.find('nav.navbar-top');
  var $menuTrigger = $body.find('.mobile-trigger');
  var $menu = $menuTrigger.eq(0).next();
  var nums = [0, 1, 300, 400, 800];
  //functions
  //ta da
  function taDa(ele) {
    var $b = $('body');
    var $items = $b.find(ele);
    var randNum = Math.floor(Math.random() * $items.length) + 1;
    $items.eq(randNum).addClass('taDa')
      .siblings().removeClass('taDa');
  }
  function addClass(ele, c) {
    var $b = $('body');
    var $ele = $b.find(ele);
    $ele.addClass(c);
    return $ele;
  }
  function animateEle(ele, obj, speed, time) {
    var $b = $('body');
    var $ele = $b.find(ele);
    if(time !== "") {
      $ele.each(function(i) {
        setTimeout(function() {
          $ele.eq(i).animate(obj, speed);
        }, time * i);
      });
    } else {
      $ele.animate(obj, speed);
    }
    return $ele;
  }
  //loading screen
  $window.on('load', function() {
    $loader.css('opacity', nums[0]);
    $bodyContainer.addClass('animate-bottom')
    .css('opacity', nums[1]);
  });
  //mobile menu
  $menuTrigger.click(function(){
    var animateValue = $(this).attr('data-animate-value');
    var animationBody = $(this).attr('data-body');
    $body.add($html).toggleClass('b-h-overflow-hidden');
    $menu.animate({right:animateValue}, nums[2]);
  });
  //sticky nav bar
  $window.scroll(function() {
    //if scrolling is greater than 10px, add 'sticky' class
    if($(this).scrollTop() >= 10) {
      $nav.addClass('sticky');
    } else {
      $nav.removeClass('sticky');
    }
  });
});
