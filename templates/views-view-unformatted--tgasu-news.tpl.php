<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<style>
  .news-wrapper{
    text-align: center;
    min-width:700px;
  }
.news-post{
  margin-left: 5px;
  margin-right: 5px;
  padding: 15px;
  text-align: left;
  height: 300px;
  display: inline-block;
  overflow: hidden;
}

.news-preview{
  text-align: center;
  //width: 272px;
  //height: 181px;
}

.news-title{
  height: 85px;
  margin-top: 15px;
  font-size: 18px;
  font-weight: 700;
}

.news-more{
  margin-top: 1px;
}
</style>

<div class="news-wrapper<?php if (count($rows) <= 2){ print '-none';} ?>">

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
<?php endforeach; ?>

</div>
