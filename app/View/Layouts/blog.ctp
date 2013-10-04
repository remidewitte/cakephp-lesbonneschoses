<?php //@(title: Option[String] = None)(content: Html)(implicit ctx: Prismic.Context)
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>Les bonnes choses <?php $title = $this->fetch('title'); echo !empty($title) ? " – $title" : NULL; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="/css/normalize.min.css">
    <link rel="stylesheet" href="/css/blog.css">
    <link rel="stylesheet" href="/css/toolbar.css">

    <script src="/js/modernizr-2.6.2.min.js"></script>
  </head>
  <body <?php if($ctx->hasPrivilegedAccess()){ echo 'class="toolbar"'; }?>>

    <?php include('toolbar.ctp'); ?>

    <header>

      <a href="/">
        <h1>Les Bonnes Choses</h1>
      </a>

      <nav>
        <ul>
          <li><a href="/">Home</a></li>
          <?php
          foreach (Configure::read('BlogCategories') as $category){
            echo '<li><a href="/blog?category=',urlencode($category),'">',$category,'</a></li>';
          }
          ?>
        </ul>
      </nav>

    </header>

    <div class="main">
      <?php echo $this->fetch('content'); ?>
    </div>

    <?php include('footer.ctp'); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-1.10.1.min.js"><\/script>')</script>
  </body>
</html>