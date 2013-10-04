<?php
require APP.'Vendor'.DS.'prismic-php-kit'.DS.'src'.DS.'api.php';

use prismic\API as API;

class Context {

    private $api;
    private $ref;
    private $maybeAccessToken;

    function __construct($api, $ref, $maybeAccessToken=null, $linkResolver=null) {
        $this->api = $api;
        $this->ref = $ref;
        $this->maybeAccessToken = $maybeAccessToken;
    }

    function maybeRef() {
        if($this->ref != $this->api->master()->ref) {
            return $this->ref;
        } else {
            return null;
        }
    }

    function hasPrivilegedAccess() {
        return isset($this->maybeAccessToken);
    }

    public function __get($property) {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }
}

class PrismicComponent extends Component {

  public $ctx;

  // A way to implement the equivalent of
  // - buildContext
  // - implicit def fromRequest(implicit req: Request[_]): Context = req.ctx
  public function initialize(Controller $controller) {
    // Available in views
    $this->ctx = $this->buildContext($controller);
    $controller->set('ctx', $this->ctx);
  }

  public function beforeRender(Controller $controller) {
    $controller->set('ctx', $this->ctx);
  }

  public function buildContext(Controller $controller) {
    // TODO: on $controller->request
    $maybeAccessToken = isset($_COOKIE["ACCESS_TOKEN"]) ? $_COOKIE["ACCESS_TOKEN"] : Configure::read('prismic.token');
    $api = self::apiHome($maybeAccessToken);
    $ref = isset($_GET["ref"]) ? $_GET["ref"] : $api->master()->ref;
    return new Context($api, $ref, $maybeAccessToken);
  }

  public static function apiHome($maybeAccessToken = null) {
    return API::get(Configure::read('prismic.api'), $maybeAccessToken);
  }

  public function getDocument($id) {
    $documents = $this->ctx->api->forms()->everything->query('[[:d = at(document.id, "'. $id .'")]]')->ref($this->ctx->ref)->submit();
    return $documents[0];
  }

  public function getDocuments($ids) {
    $fids = '["'.join('","', $ids) .'"]';
    return $this->ctx->api->forms()->everything->query("[[:d = any(document.id, $fids)]]")->ref($this->ctx->ref)->submit();
  }

  // -- Helper: Retrieve a single document from its bookmark
  public function getBookmark($bookmark) {
    $id = $this->ctx->api->bookmarks()->{$bookmark};
    if($id){
      return $this->getDocument($id);
    }
  }

  public function getForm($form, $query=null){
    // var_dump($this->ctx->api->forms()->$form); die();
    return $this->ctx->api->forms()->$form->query($query)->ref($this->ctx->ref)->submit();
  }

  public function callback() {
    $maybeReferer = isset(getallheaders()['Referer']) ? getallheaders()['Referer'] : null;
    return Routes::authCallback(null, isset($maybeReferer) ? $maybeReferer : Routes::index());
  }

}
