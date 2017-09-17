$(document).ready(function(){
  //mobile menu
  var $html = $('html');
  var $body = $html.find('body');
  var $menuTrigger = $body.find('.mobile-trigger');
  var $menu = $menuTrigger.eq(0).next();
  var animationSpeed = 300;
  $menuTrigger.click(function(){
    var animateValue = $(this).attr('data-animate-value');
    var animationBody = $(this).attr('data-body');
    $body.add($html).toggleClass('b-h-overflow-hidden');
    $menu.animate({right:animateValue}, animationSpeed);
  });

  //approves comments using ajax
  function ajaxApproveComments(ele, targets, path) {
    var $body = $('body');
    var $ele = $body.find(ele);
    var $commentsTitle = $body.find('h2.comments-title');
    var hostName = window.location.hostname;
    $ele.click(function(e) {

      e.preventDefault();
      var $message = $(this);
      var buttonClass = $(e.target).attr('class');
      var messageId = $(this).parents('.comment').attr('id');

      $.ajax({
        type: 'POST',
        url: "http://" + hostName + "/Andre_Mashraghi" + path,
        data: {
          commentId: messageId.split('-')[1],
          buttonClass: buttonClass
        }
      }).done(function() {
        if(buttonClass === 'trash-comment') {

          $message.parent().remove();
          $commentsTitle.load(document.URL + ' h2.comments-title');
          $commentsTitle.children().parent().remove();

        } else {

          $message.load(document.URL + ' #' + messageId + ' > .comment-options');

        }
      }).fail(function() {

        console.log('failed');

      });
    });
  }

  //messages for forms using ajax
  function ajaxMessages(form, messages, path, inputs, redirect) {
    var $body = $('body');
    var $form = $body.find(form);
    var hostName = window.location.hostname;

    $form.submit(function(e) {

      var $messages = $(this).next();

      e.preventDefault();

      var formId;
      formId = $(this).attr('id');

      var formData = formId ? $(this).serialize() + '&' + $.param({formId: formId}) : $(this).serialize();
      console.log(formData);

      $.ajax({

        type: 'POST',
        url: document.location.origin + "/Andre_Mashraghi" + path,
        data: formData

      }).done(function(response) {

        $messages.removeClass('error')
        .addClass('success');

        $messages.text(response);

        if(redirect) {

          window.location.replace(document.location.origin + redirect);

        }
        //clear form
        if(inputs) {

          var i;
          var l = inputs.length;

          for(i = 0; i < l; i++) {

            $form.find(inputs[i]).val('');

          }

        }

      }).fail(function(data) {

        $messages.removeClass('success')
        .addClass('error');

        console.log('failed');

        //set the message text.
        if (data.responseText !== "") {

            $messages.text(data.responseText);

        } else {

            $messages.text('Oops! An error occured. Try again.');

        }
      });
    });
  }

  //messages for forms using ajax
  function ajaxMessagesFile(form, messages, path, redirect) {
    var $body = $('body');
    var $form = $body.find(form);
    var hostName = window.location.hostname;

    $form.submit(function(e) {

      var $messages = $(this).next();

      e.preventDefault();

      $.ajax({

        type: 'POST',
        url: document.location.origin + "/Andre_Mashraghi" + path,
        data: new FormData(this),
        contentType: false,
        processData: false

      }).done(function(response) {

        $messages.removeClass('error')
        .addClass('success');

        $messages.text(response);

        if(redirect) {

          window.location.replace(document.location.origin + redirect);

        }

        //clear form
        $form.trigger('reset');

      }).fail(function(data) {

        $messages.removeClass('success')
        .addClass('error');

        console.log('failed');

        //set the message text.
        if (data.responseText !== "") {

            $messages.text(data.responseText);

        } else {

            $messages.text('Oops! An error occured. Try again.');

        }
      });
    });
  }

  ajaxApproveComments('.comment-options', ['.approve-comment', '.unapprove-comment', '.trash-comment'], '/PHP/Form Scripts/approve_comments.php');

  //ajax for category, delete, and post forms
  ajaxMessages('#form-category', '.form-messages', '/PHP/Form Scripts/add_category.php', ['#add-category']);
  ajaxMessages('#form-del-blog', '.form-messages', '/PHP/Form Scripts/delete.php', ['#del-blog-title']);
  ajaxMessages('#form-del-work', '.form-messages', '/PHP/Form Scripts/delete.php', ['#del-work-url']);

  ajaxMessagesFile('#form-new-post', '.form-messages', '/PHP/Form Scripts/new_post.php');
  ajaxMessagesFile('#form-add-work', '.form-messages', '/PHP/Form Scripts/new_work.php');
});
