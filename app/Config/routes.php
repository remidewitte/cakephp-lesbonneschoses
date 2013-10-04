<?php
// NOTE: I have kept the original scala route

# Routes
# This file defines all application routes (Higher priority routes first)
# ~~~~

//GET     /                                                   controllers.Application.index(ref: Option[String] ?= None)
Router::connect('/', array('controller' => 'Application', 'action' => 'index'));

//GET     /about                                              controllers.Application.about(ref: Option[String] ?= None)
Router::connect('/about', array('controller' => 'Application', 'action' => 'about'));

//GET     /jobs                                               controllers.Application.jobs(ref: Option[String] ?= None)
//GET     /jobs/$id<[-_a-zA-Z0-9]{16}>/:slug                  controllers.Application.jobDetail(id, slug, ref: Option[String] ?= None)
Router::connect('/jobs', array('controller' => 'Application', 'action' => 'jobs'));
Router::connect('/jobs/:id/:slug', array('controller' => 'Application', 'action' => 'jobDetail'), array('pass' => array('id'), 'id' => '[-_a-zA-Z0-9]{16}'));

//GET     /stores                                             controllers.Application.stores(ref: Option[String] ?= None)
//GET     /stores/$id<[-_a-zA-Z0-9]{16}>/:slug                controllers.Application.storeDetail(id, slug, ref: Option[String] ?= None)
Router::connect('/stores', array('controller' => 'Application', 'action' => 'stores'));
Router::connect('/stores/:id/:slug', array('controller' => 'Application', 'action' => 'storeDetail'), array('pass' => array('id'), 'id' => '[-_a-zA-Z0-9]{16}'));

//GET     /blog                                               controllers.Application.blog(category: Option[String] ?= None, ref: Option[String] ?= None)
//GET     /blog/$id<[-_a-zA-Z0-9]{16}>/:slug                  controllers.Application.blogPost(id, slug, ref: Option[String] ?= None)
Router::connect('/blog', array('controller' => 'Application', 'action' => 'blog'));
Router::connect('/blog/:id/:slug', array('controller' => 'Application', 'action' => 'blogPost'), array('pass' => array('id'), 'id' => '[-_a-zA-Z0-9]{16}'));

//GET     /products                                           controllers.Application.products(ref: Option[String] ?= None)
//GET     /products/$id<[-_a-zA-Z0-9]{16}>/:slug              controllers.Application.productDetail(id, slug, ref: Option[String] ?= None)
//GET     /products/by-flavour                                controllers.Application.productsByFlavour(flavour, ref: Option[String] ?= None)
Router::connect('/products', array('controller' => 'Application', 'action' => 'products'));
Router::connect('/products/:id/:slug', array('controller' => 'Application', 'action' => 'productDetail'), array('pass' => array('id'), 'id' => '[-_a-zA-Z0-9]{16}'));
Router::connect('/products/by-flavour/*', array('controller' => 'Application', 'action' => 'productsByFlavour'));

//GET     /selections/$id<[-_a-zA-Z0-9]{16}>/:slug            controllers.Application.selectionDetail(id, slug, ref: Option[String] ?= None)
Router::connect('/selections/:id/:slug', array('controller' => 'Application', 'action' => 'selectionDetail'), array('pass' => array('id'), 'id' => '[-_a-zA-Z0-9]{16}'));

//GET     /search                                             controllers.Application.search(query: Option[String] ?= None, ref: Option[String] ?= None)
Router::connect('/search', array('controller' => 'Application', 'action' => 'search'));

//GET     /not-found                                          controllers.Application.brokenLink(ref: Option[String] ?= None)
Router::connect('/not-found', array('controller' => 'Application', 'action' => 'brokenLink'));

//# Prismic.io OAuth
//GET     /signin                                             controllers.Prismic.signin
//GET     /auth_callback                                      controllers.Prismic.callback(code: Option[String], redirect_uri: Option[String])
//POST    /signout                                            controllers.Prismic.signout()
Router::connect('/signin', array('controller' => 'OAuth', 'action' => 'signin'));
Router::connect('/auth_callback/*', array('controller' => 'OAuth', 'action' => 'callback'));
Router::connect('/signout', array('controller' => 'OAuth', 'action' => 'signout'));
