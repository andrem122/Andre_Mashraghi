//Javascript Document
$(document).ready(function(){
  //caching the DOM for body animations
  var $window = $(window);
  var $html = $('html');
  var $body = $html.find('body');
  var $loader = $body.find('> :first-child');
  var $bodyContainer = $body.find('div.body-container');
  var $nav = $body.find('nav.navbar-top');
  var $menuTrigger = $nav.find('.mobile-trigger');
  var $menu = $menuTrigger.eq(0).next();
  var nums = [0, 1, 300, 400, 800];
  //functions
  //ajax messages
  function ajaxMessages(form, messages, path, redirect) {
    var $body = $('body');
    var $form = $body.find(form);
    var $messages = $body.find(messages);
    var hostName = window.location.hostname;
    $form.submit(function(e) {
      e.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: "http://" + hostName + "/Andre_Mashraghi" + path,
        data: formData

      }).done(function(response) {
        $messages.removeClass('error')
        .addClass('success');
        $messages.text(response);

        if(redirect) {
          window.location.replace(document.location.origin + redirect);
        }

        //resets
        $form.trigger('reset');
        grecaptcha.reset();

      }).fail(function(data) {
        $messages.removeClass('success')
        .addClass('error');

        //set the message text.
        if (data.responseText !== "") {

            $messages.text(data.responseText);

        } else {

            $messages.text('Oops! An error occured. Try again.');

        }

        //resets
        grecaptcha.reset();

      });
    });
  }

  //loading screen
  $window.on('load', function() {
    $loader.css('opacity', nums[0]);
    $bodyContainer.addClass('animate-bottom')
    .css({opacity: nums[1]});
    $body.add($html).removeClass('b-h-overflow-hidden');
    //set loader to display none to prevent
    //interference with other elements
    setTimeout(function() {
      $loader.css('display', 'none');
    }, 200);
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

  ajaxMessages('#form-login', '.form-messages', '/PHP/Form Scripts/login.php', '/blog');
});
