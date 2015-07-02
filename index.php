<?php
  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#bb-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h1 class="sg-h1"><a id="bb-'.$filename.'" class="sg-anchor">'.$title.'</a></h1>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a> <a class="sg-btn--top" href="#top">Back to Top</a> </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <title>Lorem Ipsum, Bitch! Text Placeholders from Breaking Bad - Breaking Ipsum</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/sg-style.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.min.css" />
<!--[if lt IE 9]>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.ie.min.css" />
<![endif]-->
</head>
<body>

<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">Breaking <span>Ipsum</span></h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Character:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
        </optgroup>
        <optgroup label="Characters (alphabetically)">
          <?php listMarkupAsOptions('cast'); ?>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container">
  <div class="sg-info">
    <div class="sg-about sg-section">
      <h1 class="sg-h1"><a id="sg-about" class="sg-anchor">About</a></h1>
      <p>Comments and documentation about your style guide. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus nobis enim labore facilis consequuntur! Veritatis neque est suscipit tenetur temporibus enim consequatur deserunt perferendis. Neque nemo iusto minima deserunt amet.</p>
    </div><!--/.sg-about-->

  <div class="sg-base-styles">
    <h2 class="sg-h2">Breaking Bad Quotes (Spoilers! Duh!)</h2>
    <?php showMarkup('cast'); ?>
  </div><!--/.sg-base-styles-->

  <footer role="contentinfo">
    <iframe src="http://ghbtns.com/github-btn.html?user=espidesigns&repo=breaking-ipsum&type=fork&count=true" height="30" width="118" frameborder="0" scrolling="0" style="width:118px; height: 30px;" allowTransparency="true"></iframe>

    <p><a href="https://twitter.com/share" class="twitter-share-button" data-via="espidesignscom">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1540653739541110&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <p><div class="fb-like" data-href="http://breakingipsum.com" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div></p>

    <div class="github-fork-ribbon-wrapper right-bottom">
        <div class="github-fork-ribbon">
            <a href="https://github.com/espidesigns/breaking-ipsum" target="_blank">Fork me on GitHub</a>
        </div>
    </div>

    <p>Created by Mark Louie Espedido, <a href="https://twitter.com/espidesignscom" title="Follow me" target="_blank">@espidesignscom</a></p>
    <p>Other projects: <a href="http://moviephonenumbers.tumblr.com" title="Phone and Mobile Numbers on Movies and TV Shows" target="_blank">moviephonenumbers.tumblr.com</a>, <a href="http://betteripsumsaul.com" title="Better Call Saul text and code placeholder" target="_blank">betteripsumsaul.com</a>
    </p>
    <p>All characters and quotes are property of <a href="http://www.amctv.com/shows/breaking-bad" target="_blank">AMC's Breaking Bad</a></p>
  </footer>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.sticky.js"></script>
  <script>
    $(window).load(function(){
      $(".sg-header").sticky({ topSpacing: 0 });
    });
  </script>
  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>

</body>
</html>
