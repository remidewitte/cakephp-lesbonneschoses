<?php //@(posts: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->assign('title', "Our blog");
?>
  <section id="posts">
  <?php
  $c = 1;
  foreach ($posts as $post){
    if($c++ > 10) break;
    echo
      '<article>',
        '<a href="/blog/',$post->id,'/',$post->slug(),'">',
          '<em class="infos">', $post->getDate("blog-post.date", "m d, Y"), ' by ', $post->getText("blog-post.author"), '</em>',
          '<h2>',$post->get("blog-post.body")->getTitle()->text, '</h2>',
          '<p>',$post->get("blog-post.body")->getFirstParagraph()->text, '</p>',
          '<div style="background-image: url(',$post->getImage("blog-post.body", "main")->url(),'); background-size: cover;" }></div>',
          '<strong>Read more</strong>',
        '</a>',
      '</article>';
  }
  ?>
  </section>
