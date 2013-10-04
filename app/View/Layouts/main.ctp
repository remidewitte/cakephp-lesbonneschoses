<?php //@(id: String (content: Html)(implicit ctx: Prismic.Context)
$id = $this->fetch('id');
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
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/toolbar.css">

    <script src="/js/modernizr-2.6.2.min.js"></script>
  </head>
  <body <?php if($ctx->hasPrivilegedAccess()){ echo 'class="toolbar"'; }?>>

    <?php include('toolbar.ctp'); ?>

    <header>
      <nav>
        <h1><?php echo $this->Html->link('Les bonnes choses', '/'); ?></h1>

        <ul>
          <li><?php
          echo $this->Html->link(
            'About',
            '/about',
            array('class' => $id == 'about' ? 'selected' : null)
          );
          ?></li>
          <li><?php
          echo $this->Html->link(
            'Stores',
            '/stores',
            array('class' => $id == "stores" || $id == "store" ? 'selected' : null)
          );
          ?></li>
        </ul>
        <ul>
          <li><?php
          echo $this->Html->link(
            'Jobs',
            '/jobs',
            array('class' => $id == "jobs" || $id == "job" ? 'selected' : null)
          );
          ?></li>
          <li><?php
          echo $this->Html->link(
            'Our blog',
            '/blog',
            array(
              'class' => $id == 'blog' ? 'selected' : null,
              'target' => '_self'
            )
          );
          ?></li>
        </ul>

        <a href="/search"><span>Search</span></a>

      </nav>
    </header>

    <div class="main" id="<?php echo $id ?>">
      <?php echo $this->fetch('content'); ?>
    </div>

    <?php include('footer.ctp'); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <script src="/js/catslider.js"></script>
    <script src="/js/main.js"></script>
  </body>
</html>
