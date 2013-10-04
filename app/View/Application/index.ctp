<?php // @(products: Seq[io.prismic.Document], featured: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->assign('id', "home");
?>
  <section id="caroussel">

    <nav>
      <ul>
      <?php
      echo $this->Html->nestedList(array_map(function($category){return "<a>$category</a>"; }, Configure::read('ProductCategories')));
      ?>
      </ul>
    </nav>

    <div class="products">

    <?php
      foreach (Configure::read('ProductCategories') as $category => $label) {
        echo '<ul>';
        $filtered = Hash::filter($products, function($p) use($category){
          return in_array($category, $p->tags) && ! in_array('Featured', $p->tags);
        });
        foreach (array_slice($filtered, 0, 5) as $product) {
          echo '<li data-category="',urlencode($category),'">',
              '<a href="/products/',$product->id,'/',$product->slug(),'">',
                $product->getImage("product.image", "icon")->asHtml(),
                '<span>',getOrElse($product->getText("product.name"), "Product"),'</span>',
                '<em>',getOrElse($product->getNumber("product.price", "$%0.2f"), "–"), '</em>',
              '</a>',
            '</li>';
          }
        echo '</ul>';
      }
    ?>

    </div>

    <p>
      <a href="/products">Browse all our products</a>
    </p>

  </section>

  <section id="featured">
  <?php
    $filtered = Hash::filter($featured, function($f) { return $f->type != 'blog-post'; });
    foreach (array_slice($filtered, 0, 3) as $f) {
      // var_dump($f->get('selection.catcher_image')); die();
      if ($f->type == "product") {
        $img = $f->getImage("product.gallery[0]", "squared");
        echo
        '<div style="', $img ? 'background-image: url('.$img->url().')' : '','">',
          '<a href="/products/',$f->id,'/',$f->slug(),'">',
            '<h3><span>',getOrElse($f->getText("product.name"), "Product"),'</span></h3>',
            '<p>',
              '<span>',$f->getText("product.short_lede"),'</span>',
            '</p>',
          '</a>',
        '</div>';
      }
      else if ($f->type == "selection") {
        echo
        '<div style="background-image: url(', $f->getImage("selection.catcher_image", "squarred")->url(),'">',
          '<a href="/selections/',$f->id,'/', $f->slug(),'">',
            '<h3><span>',getOrElse($f->getText("selection.name"), "Selection"),'</span></h3>',
            '<p>',
              '<span>',$f->getText("selection.short_lede"),'</span>',
            '</p>',
          '</a>',
        '</div>';
      }
    }
  ?>
  </section>

  <?php
    $filtered = Hash::filter($featured, function($f) { return $f->type == 'blog-post'; });
    if(!empty($filtered)):
    $post = current($filtered);
  ?>

    <section id="blog">

      <h2>Fresh news from <a href="/blog">our blog</a></h2>

      <a href="/blog/<?php echo $post->id,'/', $post->slug()?>">
        <h1><?php echo $post->get("blog-post.body")->getTitle()->text; ?></h1>
        <p><?php echo $post->get("blog-post.body")->getFirstParagraph()->text; ?></p>
      </a>

      <a class="more" href="/blog/<?php echo $post->id,'/', $post->slug()?>">Read more</a>

    </section>
  <?php endif; ?>
