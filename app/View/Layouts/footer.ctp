<?php // @()(implicit ctx: Prismic.Context) ?>

<footer>
  This is a demonstration website for <a href="http://prismic.io">prismic.io</a> 

  <?php if(!$ctx->hasPrivilegedAccess()) : ?>
    – Please <a href="/signin">sign in</a> to preview your changes.
  <?php endif; ?>
</footer>