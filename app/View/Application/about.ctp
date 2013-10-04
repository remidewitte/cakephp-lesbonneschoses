<?php
// @(about: io.prismic.Document)(implicit ctx: Prismic.Context)

$this->extend('/Layouts/page');
$this->assign('id', 'about');

// title = about.getText("article.title")
$this->assign('title', $about->getText("article.title"));

// image = about.getImage("article.image", "main").map(_.url),
$this->assign('image', $about->getImage("article.image", "main")->url());

// catcher = about.getHtml("article.short_lede", ctx.linkResolver).map(Html.apply)) {
$this->assign('catcher', $about->getHtml("article.short_lede"));

//  @about.getHtml("article.content", ctx.linkResolver).map(Html.apply)
echo $about->getHtml("article.content");
