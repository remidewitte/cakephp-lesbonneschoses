<?php //@(store: io.prismic.Document)(implicit ctx: Prismic.Context)

$this->extend('/Layouts/page');
$this->assign('id', 'store');

$this->assign('title', $store->getText("store.title"));
$this->assign('image', $store->getImage("store.image", "main")->url());

// catcher = store.getHtml("store.description", ctx.linkResolver).map(Html.apply)
$this->assign('catcher', $store->getHtml("store.description"));
?>

  <div id="map-canvas" style="width:400px; height: 300px"></div>

  <p class="address">
  <?php
  foreach(array(
    "store.address",
    "store.address2",
    "store.city",
    "store.zipcode"
  ) as $field){
    $v = $store->getText($field);
    if($v) echo "$v<br>";
  }
  $store->getText("store.country")
  ?>
  </p>

  <aside>

    <h4>Opening times</h4>

    <?php foreach(array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday") as $day): ?>
      <dl>
        <dt><?php echo $day; ?></dt>
        <dd><?php echo $store->getText("store.".strtolower($day).'[0]'); ?></dd>
      </dl>
    <?php endforeach;?>

  </aside>

