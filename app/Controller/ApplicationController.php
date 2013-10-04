<?php
App::uses('Controller', 'Controller');

class ApplicationController extends Controller {

  public $layout = 'main';

  public $helpers = array('Html');

  public $components = array('Prismic');

  // -- Home page

  public function index(){
    $products = $this->Prismic->getForm('products');
    $featured = $this->Prismic->getForm('featured');
    $this->set(compact('products', 'featured'));
  }

  // -- About us

  public function about(){
    $about = $this->Prismic->getBookmark('about');
    $this->set(compact('about'));
  }

  // -- Jobs
  
  public function jobs(){
    $main = $this->Prismic->getBookmark("jobs");
    $jobs = $this->Prismic->getForm('jobs');
    $this->set(compact('main', 'jobs'));
  }
  
  public function jobDetail($id){
    $main = $this->Prismic->getBookmark("jobs");
    $job = $this->Prismic->getDocument($id);
    $this->set(compact('main', 'job'));
  }

  // -- Stores

  public function stores() {
    $main = $this->Prismic->getBookmark("stores");
    $stores = $this->Prismic->getForm('stores');
    $this->set(compact('main', 'stores'));
  }

  public function storeDetail($id){
    $store = $this->Prismic->getDocument($id);
    $this->set(compact('store'));
  }

  // -- Products Selections
  
  public function selectionDetail($id){
    $selection = $this->Prismic->getDocument($id);
    $ids = array_map(function($link){ return $link->id; }, $selection->getAll("selection.product"));
    $products = $this->Prismic->getDocuments($ids);
    $this->set(compact('selection', 'products'));
  }

  // -- Blog

  public function blog(){
    $category = $this->request->query('category');
    if($category){
      $posts = $this->Prismic->getForm('blog', "[[:d = at(my.blog-post.category, \"$category\")]]");
    } else {
      $posts = $this->Prismic->getForm('blog');
    }
    // posts.sortBy(_.getDate("blog-post.date").map(_.value.getMillis)).reverse
    usort($posts, function($p1, $p2){return strcmp($p2->getDate("blog-post.date"), $p1->getDate("blog-post.date"));});
    $this->layout = 'blog';
    $this->view = 'posts';
    $this->set(compact('posts'));
  }

  public function blogPost($id){
    $post = $this->Prismic->getDocument($id);
    $ids = array_map(function($link){ return $link->id; }, $post->getAll("blog-post.relatedproduct"));
    $relatedProducts = $this->Prismic->getDocuments($ids);
    $ids = array_map(function($link){ return $link->id; }, $post->getAll("blog-post.relatedpost"));
    $relatedPosts = $this->Prismic->getDocuments($ids);
    $this->layout = 'blog';
    $this->view = 'postDetail';
    $this->set(compact('post', 'relatedProducts', 'relatedPosts'));
  }

  // -- Products
  
  public function products() {
    $products = $this->Prismic->getForm('products');
    $this->set(compact('products'));
  }
  
  public function productDetail($id){
    $product = $this->Prismic->getDocument($id);
    $ids = array_map(function($link){ return $link->id; }, $product->getAll("product.related"));
    $relatedProducts = $this->Prismic->getDocuments($ids);
    $this->set(compact('product', 'relatedProducts'));
  }

  /*
  def productsByFlavour(flavour: String, ref: Option[String]) = Prismic.action(ref) { implicit request =>
  for {
    products <- ctx.api.forms("everything").query(s"""[[:d = at(my.product.flavour, "$flavour")]]""").ref(ctx.ref).submit()
  } yield {
    if(products.isEmpty) {
      PageNotFound
    } else {
      Ok(views.html.productsByFlavour(flavour, products))
    }
  }
  }
  */

  // -- Search

  /*
  def search(query: Option[String], ref: Option[String]) = Prismic.action(ref) { implicit request =>
  query.map(_.trim).filterNot(_.isEmpty).map { q =>
  for {
    products <- ctx.api.forms("everything").query(s"""[[:d = any(document.type, ["product", "selection"])][:d = fulltext(document, "$q")]]""").ref(ctx.ref).submit()
    others <- ctx.api.forms("everything").query(s"""[[:d = any(document.type, ["article", "blog-post", "job-offer", "store"])][:d = fulltext(document, "$q")]]""").ref(ctx.ref).submit()
  } yield {
    Ok(views.html.search(query, products, others))
  }
  }.getOrElse {
    Future.successful(Ok(views.html.search()))
  }
  }
  */

}