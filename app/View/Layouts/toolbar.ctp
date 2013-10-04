<?php // @()(implicit ctx: Prismic.Context) ?>

<?php if($ctx->hasPrivilegedAccess()) : ?>
  <div id="toolbar">

    <form method="GET">
      <label for="releaseSelector">See this website: </label>
      <?php 
      $refs = $ctx->api->refs();
      $refValues = array_map(function($r){return $r->ref;}, $refs);
      ?>
      <select id="releaseSelector" name="ref" onchange="this.form.submit()">
      <?php if(!in_array($ctx->ref, $refValues)) { ?>
          <option>?</option>
      <?php } ?>
        <option value="" <?php if($ctx->ref == $ctx->api->master()->ref) { echo 'selected="selected"'; }?>>As currently seen by guest visitors</option>
        <optgroup label="Or preview the website in a future release:">
        <?php
        foreach ($refs as $r){
          if(!$r->isMasterRef){
            echo sprintf('<option value="%s"%s>As %s %s</option>',
              $r->ref,
              $ctx->ref == $r->ref ? ' selected="selected"' : NULL,
              $r->label,
              date("Y-m-d", $ref->maybeScheduledAt)
            );
          }
        }
        ?>
        </optgroup>
      </select>
    </form>

    <form action="/signout" method="POST">
      <input type="submit" value="Disconnect">
    </form>

  </div>
<?php endif; ?>