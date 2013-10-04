<?php // @(selection: io.prismic.Document, products: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->assign('id', 'selection');
$this->assign('title', $selection->getText("selection.name"));
?>

  <section id="page-header">

    <div style="background-image: url(<?php echo $selection->getImage("selection.catcher_image", "main")->url(); ?>)")">
      <div>
        <h1><?php echo $selection->getText("selection.name"); ?></h1>

        <p>
          <?php echo $selection->getText("selection.short_lede"); ?>
        </p>
      </div>
    </div>

  </section>

  <section id="page-body">

    <?php echo $selection->getImage("selection.image", "main")->asHtml(); ?>

    <div>
      <?php echo $selection->getHtml("selection.description"); //, ctx.linkResolver).map(Html.apply) ?>

      <h4>
        <em><?php echo $selection->getNumber("selection.price", "$%0.2f"); ?></em>
      </h4>
    </div>

  </section>

  <?php
  if(!empty($products)) { ?>
      <section class="products">

        <h2>Part of this selection</h2> 

        <ul>
        <?php
          foreach($products as $product) {
            echo
            '<li>',
              '<a href="/products/',$product->id,'/', $product->slug(), '">',
                $product->getImage("product.image", "icon")->asHtml(),
                '<span>',getOrElse($product->getText("product.name"), "Product"),'</span>',
              '</a>',
            '</li>';
          }
        ?>
        </ul>
      </section>
  <?php
  }
  ?>

