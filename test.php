<p class="intro-p">
  jQuery is a great tool for web developers. It's easy to use,  has Ajax support,
  and is constantly maintained by a community of developers who know their code well.
  However, sometimes it's just unnecessary in certain circumstances, and  plain, old
  JavaScript can get the job done a lot faster.
</p>
<p>
  Today, I want to show you a little function I created in JavaScript for fun that is
  quite similar to the jQuery <code class="prettyprint">.parents()</code> method. It's
  not entirely the same, but with a little modification, you can get it quite close to
  the jQuery <code class="prettyprint">.parents()</code> method. Anyways, let's take a look at the code.
</p>
<pre class="prettyprint">
  <code>
function getParent(ele, parentSelector) {

  var parentSelectorType = parentSelector.substring(0, 1);

  //get the parent
  var p = ele.parentElement;
  var check;

  //check to see if parentSelector is a class or id
  switch (parentSelectorType) {
    case '.':

      check = p.className;
      parentSelector = parentSelector.substring(parentSelector.indexOf('.') + 1, parentSelector.length);
      break;

    case '#':

      check = p.id;
      parentSelector = parentSelector.substring(parentSelector.indexOf('#') + 1, parentSelector.length);
      break;

    default:

    return document;

  }

  //keep looping through parents until a match is found
  while(check !== parentSelector) {

    p = p.parentElement;

    switch (parentSelectorType) {
      case '.':

        check = p.className;
        break;

      case '#':

        check = p.id;
        break;

    }

  }

  return p;

}
  </code>
</pre>
<button class="button expand-code">Expand Code</button>
<p>
  So, as you can see from the function name, the parent that is specified is
  returned, and the specified parent can be found via a class or id. So, for
  example, if I want to find a parent with an id of <code class="prettyprint">#parent</code>
  starting from any element, then I would type in the following statement:
</p>
<code class="prettyprint margin-bottom inline-block">getParent(document.getElementById('ele'), '#parent');</code>
<p>
  This will fetch the first parent matching the id of <code class="prettyprint">#parent</code>.
  Now, that we see how to use it. Let's dive into how it works.
</p>
<h2>The Break Down</h2>
<p>
  Let's dive into each part of the code, and I'll explain how it works.
  We'll start of by analyzing the third line.
</p>
<code class="prettyprint margin-bottom inline-block">var parentSelectorType = parentSelector.substring(0, 1);</code>
<p>
  Now, this line of code takes our input string <code class="prettyprint">parentSelector</code>
  and grabs the first character in it. Let's go back to our first example. I input a string of
  <code class="prettyprint">'#parent'</code>
  and our third line of code will grab the <code class="prettyprint">'#'</code>. Now let's go on to lines 6 and 7.
</p>
<pre class="prettyprint">
  <code>
var p = ele.parentElement;
var check;
  </code>
</pre>
<p>
  So, the 6th line will grab the immediate parent of our element, which we will use later.
  Then, we initialize the variable <code class="prettyprint">check</code>, which we will use later as well.
  Let's move on to lines 18 through 35.
</p>
<pre class="prettyprint">
  <code>
switch (parentSelectorType) {
  case '.':

    check = p.className;
    parentSelector = parentSelector.substring(parentSelector.indexOf('.') + 1, parentSelector.length);
    break;

  case '#':

    check = p.id;
    parentSelector = parentSelector.substring(parentSelector.indexOf('#') + 1, parentSelector.length);
    break;

  default:

  return document;

}
  </code>
</pre>
<button class="button expand-code">Expand Code</button>
<p>
  Now, this part of our code checks that variable we had declared earlier,
  <code class="prettyprint">parentSelectorType</code>. If <code class="prettyprint">parentSelectorType</code>
  is a class (indicated by a period), then the variable <code class="prettyprint">check</code> will
  take on the value of the class of the parent element. The same logic applies if the case was an id.
  Additionally, <code class="prettyprint">parentSelector</code>
  will be set to the whole string minus the first character. So, in our previous example
  <code class="prettyprint">'#parent'</code> would become <code class="prettyprint">'parent'</code>.
  Also, if no valid selector is input into the function, then we would just return the document. Now,
  let's go on and analyze our last bit of code where all the magic happens!
</p>
<pre class="prettyprint">
  <code>
while(check !== parentSelector) {

  p = p.parentElement;

  switch (parentSelectorType) {
    case '.':

      check = p.className;
      break;

    case '#':

      check = p.id;
      break;

  }

}

return p;
  </code>
</pre>
<button class="button expand-code">Expand Code</button>
<p>
  Ok, so this while loop takes our variable <code class="prettyprint">check</code>
  and <code class="prettyprint">parentSelector</code>. It keeps looping through the
  DOM until it finds a class or id that matches the specified parent selector. So, let's
  use our world famous example again. I input a string <code class="prettyprint">'#parent'</code>,
  and, thanks to our previous code, it will be processed as <code class="prettyprint">'parent'</code>.
  So, the while loop will continue running until <code class="prettyprint">check</code> is equal to
  the string <code class="prettyprint">'parent'</code>. If this condition is not met, it will
  get the grandparent and <code class="prettyprint">check</code> will be set to the grandparent's id.
  If you input a valid selector but no parent can be found, then it will return an error that
  <code class="prettyprint">p</code> is <code class="prettyprint">null</code>. However, once,
  it finds a matching element, it will return that element, and then you've got your parent!
</p>
<p>That's all for today folks. I hope you enjoyed it. It's Andre signing off!</p>
