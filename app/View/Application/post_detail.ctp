<?php // @(post: io.prismic.Document, relatedProducts: Seq[io.prismic.Document], relatedPosts: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->assign("title", $post->get("blog-post.body")->getTitle()->text);
?>
  <section id="post">
    
      <em class="infos"><?php echo $post->getDate("blog-post.date", "m d, Y");?> by <?php echo $post->getText("blog-post.author"); ?></em>
      
      <article>
        <?php //@$post->getHtml("blog-$post->body", ctx.linkResolver).map(Html.apply)
        echo $post->getHtml("blog-post.body");
        ?>
      </article>

      <?php if(!empty($relatedPosts)): ?>
        <h2><?php echo count($relatedPosts) == 1 ? "This" : "These"; ?> should interest you too</h2>

        <ul>
        <?php
        foreach($relatedPosts as $post) {
          echo 
              '<li>',
                '<a href="/blog/',$post->id,'/',$post->slug,'">', $post->get("blog-post.body")->getTitle()->text, '</a>',
              '</li>';
        }
        ?>
        </ul>
      <?php endif; ?>

      <?php if($post->getBoolean("blog-post.allow_comments")): ?>
        <h2>Comments</h2>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div class="fb-comments" data-href="@ctx.linkResolver(post)" data-width="640" data-num-posts="10"></div>

      <?php endif; ?>

  </section>

  <aside>

    <?php if(!empty($relatedProducts)): ?>

      <h2>Some pastries you should love</h2>

      <ul>
      <?php
        foreach($relatedProducts as $product) {
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

    <?php endif; ?>

  </aside>
