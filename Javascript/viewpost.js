$(document).ready(function(){
  //mobile menu
  var $window = $(window);
  var $html = $('html');
  var $body = $html.find('body');
  var $menuTrigger = $body.find('.mobile-trigger');
  var $menu = $menuTrigger.eq(0).next();
  var $nav = $body.find('nav.navbar-top');
  var animationSpeed = 300;

  //ajax messages
  function ajaxMessages(form, messages, path) {

    var $body = $('body');
    var $form = $body.find(form);
    var $messages = $body.find(messages);

    $form.submit(function(e) {

      e.preventDefault();
      var formData = $(this).serialize();

      $.ajax({

        type: 'POST',
        url: document.location.origin + "/Andre_Mashraghi" + path,
        data: formData

      }).done(function(response) {

        $messages.removeClass('error')
        .addClass('success');

        $messages.text(response);

        //resets
        $form.trigger('reset');
        grecaptcha.reset();

      }).fail(function(data) {

        $messages.removeClass('success')
        .addClass('error');

        if (data.responseText !== "") {

          $messages.text(data.responseText);

        } else {

          $messages.text('Oops! An error occured. Try again.');

        }

        //reset
        grecaptcha.reset();

      });
    });
  }

  function expandCode() {

    var $buttons = $('.expand-code');

    $buttons.click(function() {

      var $codeBlock = $(this).prev();
      $codeBlock.toggleClass('animate-full-height');
      
      if($(this).text() === 'Expand Code') {

        $(this).text('Collapse Code');

      } else {

        $(this).text('Expand Code');

      }

    });

  }

  ajaxMessages('#form-comment', '.form-messages', '/PHP/Form Scripts/comment-form.php');
  expandCode();
  PR.prettyPrint();

  $menuTrigger.click(function(){

    var animateValue = $(this).attr('data-animate-value');
    var animationBody = $(this).attr('data-body');
    $body.add($html).toggleClass('b-h-overflow-hidden');
    $menu.animate({right:animateValue}, animationSpeed);

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
