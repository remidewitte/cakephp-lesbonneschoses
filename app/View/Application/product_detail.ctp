<?php // @(product: io.prismic.Document, relatedProducts: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->assign('id', 'product');
$this->assign('title', $product->getText("product.name"));
?>
  <section id="detail">

    <div>

      <img src="<?php $i = $product->getImage("product.image", "main"); echo $i ? $i->url() : "/images/missing-image.png";?>">

      <h4>
        <strong><?php echo getOrElse($product->getText("product.name"), "Missing product name"); ?></strong>
        <?php $price = $product->getNumber("product.price", "$%0.2f"); if($price) echo "<em>$price</em>"; ?>
      </h4>
      
      <h2>
        <?php echo getOrElse($product->getText("product.short_lede"), getOrElse($product->getText("product.name"), "Product")); ?>
      </h2>

      <?php echo $product->getHtml("product.description"); //, ctx.linkResolver); ?>

      <p>
        <a<?php $flavour=$product->getText("product.flavour"); if($flavour) { echo 'href="/products/by-flavour/'.$flavour.'"'; } ?>>
          <strong class="color" style="background: <?php echo $product->getText("product.color");?>"><?php echo $product->getText("product.color"); ?></strong>
        </a>
      </p>

    </div>

    <p>
      <a href="/products">Browse all our products</a>
    </p>

  </section>

  <?php
  $img = $product->getImage("product.gallery[0]", "main");
  if($img) {
    echo '<section id="gallery" style="background-image: url(',$img->url(),')"></section>';
  } else {
    $authors = $product->getText("product.testimonial_author");
    $quote = $product->getText("product.testimonial_quote");
    if($authors != "") {
    ?>
      <section id="quote">
        <blockquote><?php echo $quote; ?> <strong>said <?php echo $authors; ?></strong></blockquote>
      </section>
    <?php
    }
  }

  if(!empty($relatedProducts)){
  ?>
      <section id="related" class="products">

        <h2>You might like these as well</h2> 

        <ul>
        <?php
          $cats = Configure::read('ProductCategories');
          foreach ($relatedProducts as $rproduct) {
            foreach ($rproduct->tags as $t) { if(isset($cats[$t])) {$cat = $cats[$t];}}
            echo '<li data-category="',$cat,'">',
              '<a href="/products/',$rproduct->id,'/',$rproduct->slug(),'">',
                '<img src="', $rproduct->getImage("product.image", "icon")->url(),'">',
                '<span>', getOrElse($rproduct->getText("product.name"), "Product"),'</span>',
                '<em>', getOrElse($product->getNumber("product.price", "$0.2f"), "–"),'</em>',
              '</a>',
            '</li>';
            unset($cat);
          }
        ?>
        </ul>
      </section>
   <?php
  }
