<?php // @(main: io.prismic.Document, stores: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->extend('/Layouts/page');
$this->assign('id', 'stores');

$this->assign('title', $main->getText("article.title"));
$this->assign('image', $main->getImage("article.image", "main")->url());

// catcher = about.getHtml("article.short_lede", ctx.linkResolver).map(Html.apply)) {
$this->assign('catcher', $main->getHtml("article.short_lede"));

echo $main->getHtml("article.content"); //, ctx.linkResolver).map(Html.apply)

// TODO: sort by name usort($stores, function($s1, $s2){ });
foreach($stores as $store) {
  ?>
    <article class="store" style="<?php $img = $store->getImage("store.image", "medium"); if($img) { echo 'background-image: url(', $img->url(),');'; }?>">
      <a href="/stores/<?php echo $store->id,'/', $store->slug();?>"><h3><?php echo $store->getText("store.name"); ?></h3></a>
    </article>
  <?php
}
