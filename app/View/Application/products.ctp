<?php //@(products: Seq[io.prismic.Document], title: Option[String] = None)(implicit ctx: Prismic.Context)

$this->assign('id', 'products');
$this->assign('title', "Our produts");
?>
  <section id="catalog">

    <h1><?php echo $this->get('title'); ?></h1>
  
    <div class="products">
    
      <ul>
      <?php
      // uasort($products, function($p1, $p2){ return 1;});
      foreach ($products as $product) {
      ?>
          <li data-category="@product.tags.filter(Application.ProductCategories.contains).headOption">
            <a href="<?php echo '/products/',$product->id,'/',$product->slug(); ?>">
              <?php echo getOrElse($product->getImage("product.image", "icon")->asHtml(), '<img src="images/missing-image.png">'); ?>
              <span><?php echo getOrElse($product->getText("product.name"), "Product"); ?></span>
              <em><?php echo getOrElse($product->getNumber("product.price", "$%.2f"), "–"); ?></em>
            </a>
          </li>
      <?php } ?>
      </ul>

    </div>

    <p>
      <a href="/">Close the products list</a>
    </p>

  </section>
