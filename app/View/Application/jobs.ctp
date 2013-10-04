<?php //@(main: io.prismic.Document, jobs: Seq[io.prismic.Document])(implicit ctx: Prismic.Context)

$this->extend('/Layouts/page');
$this->assign('id', 'jobs');

$this->assign('title', $main->getText("article.title"));
$this->assign('image', $main->getImage("article.image", "main")->url());

// catcher = about.getHtml("article.short_lede", ctx.linkResolver).map(Html.apply)) {
$this->assign('catcher', $main->getHtml("article.short_lede"));
?>

  <div class="presentation">
    <?php echo $main->getHtml("article.content"); //, ctx.linkResolver).map(Html.apply) ?>
  </div>

  <?php
  foreach($jobs as $job){
    $service = $job->getText("job-offer.service");
    $groupByService[$service][] = $job;
  }
  foreach($groupByService as $service => $sjobs) {
    echo '<h2>';
        switch($service){
          case "Store": 
            echo "Positions in our Stores"; break;
          case "Office": 
            echo "Positions in our Offices"; break;
          case "Workshop": 
            echo "Positions in our Workshops"; break;
          default:
            echo "Other positions"; break;
        }
    echo '</h2>';

    echo '<div class="listing">';
      foreach($sjobs as $job){
        echo '<div class="job">',
          '<a href="/jobs/',$job->id,'/',$job->slug(),'">',
            '<h3>',$job->getText("job-offer.name"),'</h3>',
            '<p>',
              $job->get("job-offer.profile")->getFirstParagraph()->text,
            '</p>',
            '<strong>Learn more</strong>',
          '</a>',
        '</div>';
      }
    echo '</div>';
  }

