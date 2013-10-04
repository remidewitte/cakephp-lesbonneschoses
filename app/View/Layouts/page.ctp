<?php // @(id: String)(title: Option[String], image: Option[String] = None, catcher: Option[Html] = None)(body: Html)(implicit ctx: Prismic.Context) ?>

  <section id="page-header">

    <div style="<?php $url = $this->fetch('image'); if($url){ echo "background-image: url($url)";} ?>">
      <div>
        <h1><?php echo $this->fetch('title'); ?></h1>

        <?php echo $this->fetch('catcher'); ?>
      </div>
    </div>

  </section>

  <section id="page-body">
    <?php echo $this->fetch('content'); ?>
  </section>
