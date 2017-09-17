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
  var offset = ['50%', '60%', '100%'];
  //functions
  //ta da
  function taDa(ele) {
    var $body = $('body');
    var $items = $body.find(ele);
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
  //ajax messages
  function ajaxMessages(form, messages, path, inputs) {
    var $body = $('body');
    var $form = $body.find(form);
    var $messages = $body.find(messages);
    $form.submit(function(e) {
      //stop default browser behavior
      e.preventDefault();
      // Serialize the form data so it can be sent with ajax
      var formData = $(this).serialize();
      //submit form using ajax
      $.ajax({
        //the type of submit method we will use
        type: 'POST',
        //where to send the data
        url: "http://" + window.location.hostname + "/Andre_Mashraghi" + path,
        //data to be submitted
        data: formData
      }).done(function(response) {
        //add success class if ajax succeeds
        $messages.removeClass('error')
        .addClass('success');
        //set the text of the form messages element
        $messages.text(response);
        // Clear the form
        var i;
        var l = inputs.length;
        for(i = 0; i < l; i++) {
          $form.find(inputs[i]).val('');
        }
      }).fail(function(data) {
        //add error class if ajax fails
        $messages.removeClass('success')
        .addClass('error');
        // Set the message text.
        if (data.responseText !== "") {
            $messages.text(data.responseText);
        } else {
            $messages.text('Oops! An error occured. Try again.');
        }
      });
    });
  }
  //loading screen
  $window.on('load', function() {
    $loader.css('opacity', nums[0]);
    $bodyContainer.addClass('animate-bottom')
    .css('opacity', nums[1]);
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
  //typewriter effect
  var $type = $body.find("#typewriter > h1");
  $type.typed({
    strings: ["Bringing your <br> ideas together."],
    typeSpeed: 50,
    callback: function(){
      var $jumboDesc  = $type.parent().next();
      $jumboDesc.addClass("fade-up");
    }
  });
  //animations
  //work
  var $work = $body.find('#my-work div.section-content');
  var waypoint = new Waypoint({
    element: $work,
    handler: function() {
      var $workItems = addClass('.work-cloud a', 'animate-bottom');
      $workItems.css({opacity: nums[1], bottom: nums[0]});
      this.destroy();
    },
    offset: offset[1]
  });
  //why work
  var $whyWork = $body.find('#why-work .section-content');
  waypoint = new Waypoint({
    element: $whyWork,
    handler: function() {
      animateEle('#why-work .section-content .reason-wrap', {opacity: 1}, nums[3], nums[3]);
      this.destroy();
    },
    offset: offset[0]
  });
  //skills
  var $skills = $body.find('#skills-breakdown');
  waypoint = new Waypoint({
    element: $skills,
    handler: function() {
      //animate title
      animateEle('#skills-title', {left: nums[0], opacity: nums[1]}, nums[4]);
      var $skillBars = $skills.find('.skill-bar');
      var l = $skillBars.length;
      for(var i = 0; i < l; i++) {
        var $percent = $skillBars.eq(i).children();
        var value = $percent.attr('data-percentage');
        //animate skill bar width
        $skillBars.eq(i).animate({width: value}, nums[4]);
        //add percentage value
        $percent.html(value);
      }
    },
    offset: offset[0]
  });
  //get in touch
  waypoint = new Waypoint({
    element: document.getElementById('get-in-touch'),
    handler: function() {
      setInterval(function() {taDa("#get-in-touch .social-icons-wrapper > a > i");}, 2000);
      //content dock
      var $contentDock = animateEle('.content-dock', {left: 20 + 'px', opacity: nums[1]}, nums[3]);
      var $close = $contentDock.find('.close-content-dock');
      var value = $close.attr('data-animate');
      $close.on('click', function(e) {
        e.preventDefault();
        $contentDock.animate({left: value}, nums[3]);
      });
      this.destroy();
    },
    offset: offset[0]
  });
  //content dock/
  ajaxMessages('#form-contentdock', '.form-messages', '/PHP/Mail/content-dock.php', ['#email', '#message']);
  //page scrolling
  var $mainMenuAnchor = $menu.next().find('li > a').slice(0, 3);
  var $mobileMenuAnchor = $menu.find('li > a').slice(0, 3);
  var $jumboBtn = $body.find('#jumbo-desc .jumbo-btn');
  $mainMenuAnchor.add($mobileMenuAnchor).add($jumboBtn)
  .on('click', function(e){
    e.preventDefault();
    //get the id of the section to scroll to
    var navigationId = $(this).attr('data-nav');
    var $scrollTarget = $body.find(navigationId);
    $body.add($html).removeClass('b-h-overflow-hidden');
    $menu.animate({right:-280 + 'px'}, nums[2]);
    $.scrollTo($scrollTarget, nums[3]);
  });
});
