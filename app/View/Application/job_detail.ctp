<?php //@(main: io.prismic.Document, job: io.prismic.Document)(implicit ctx: Prismic.Context)

$this->extend('/Layouts/page');
$this->assign('id', 'job');

$this->assign('title', $job->getText("job-offer.name"));
$this->assign('image', $main->getImage("article.image", "main")->url());
?>
  <h2>About you</h2>

  <?php echo $job->getHtml("job-offer.profile"); //, ctx.linkResolver).map(Html.apply)?>

  <h2>Your responsibilities</h2>

  <?php echo $job->getHtml("job-offer.job_description"); //, ctx.linkResolver).map(Html.apply)?>

