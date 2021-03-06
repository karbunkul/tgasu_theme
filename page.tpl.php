<!-- PAGE WRAPPER -->
<div class="wrapper">
  
  <!-- HEADER -->
  <div class="container-fluid header-wrapper <?php if (!$is_admin):?><!--header-margin--><?php endif;?>">
	<div class="row-fluid">
	  <!-- LOGO -->
	  <span class="span2">
		<?php if ($logo): ?>
		  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
		<?php endif; ?>
	  </span>
	  <!-- #LOGO -->
	  
	  <!-- SLIDER -->
	  <span class="span8">
		<?php print render($page['header']); ?>
	  </span>
	  <!-- #SLIDER -->
	  
	  <span class="span2">
		<?php if (!$logged_in):?>
		<p>Добро пожаловать Гость</p>
		<button class="btn" type="button" data-toggle="modal" data-target="#userModal">Войти</button>
		
		<div id="userModal" class="modal hide fade">
          <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>A Modal Form</h3>
          </div>
        
		  <div class="modal-body">
          <?php print render($page['auth']); ?>
			</div>
		</div>
		<?php endif;?> 
	  </span>
	</div>
  </div>
  <!-- #HEADER -->
  
  <!-- BREADCRUMB -->
  <div class="conteiner-fluid">
	  <div class="row-fluid">
		  <div class="span12"><?print $breadcrumb; ?></div>
	  </div>
  </div>
  <!-- #BREADCRUMB -->

  <!-- CONTENT -->
  <?php
	$sidebar_one = render($page['sidebar_first']);
	$sidebar_two = render($page['sidebar_second']);
	$content = drupal_get_path('theme', 'tgasu_theme') . '/assets/content.php';
  ?>
  
  <?php if ( ($sidebar_one != '') && ($sidebar_two == '') ):?>
  <div class="container-fluid content-wrapper">
	<div class="row-fluid">
	  <div class="span2"><?php print $sidebar_one; ?></div>
	  <div class="span10"><?php require_once $content; ?></div>
	</div>
  </div>
  <?php endif;?>
  
  <?php if ( ($sidebar_one == '') && ($sidebar_two != '') ):?>
  <div class="container-fluid content-wrapper">
	  <div class="row-fluid">
		  <div class="span10"><?php require_once $content; ?></div>
		  <div class="span2"><?php print $sidebar_two; ?></div>
	  </div>
  </div>
  <?php endif;?>
  
  <?php if ( ($sidebar_one != '') && ($sidebar_two != '') ):?>
  <div class="container-fluid content-wrapper">
	  <div class="row-fluid">
		  <div class="span2"><?php print $sidebar_one; ?></div>
		  <div class="span8"><?php require_once $content; ?></div>
		  <div class="span2"><?php print $sidebar_two; ?></div>
	  </div>
  </div>
  <?php endif;?>
  
  <?php if ( ($sidebar_one == '') && ($sidebar_two == '') ):?>
  <div class="container-fluid content-wrapper">
	  <div class="row-fluid">
		  <div class="span12"><?php require_once $content; ?></div>
	  </div>
  </div>
  <?php endif;?>
  <!-- #CONTENT -->
  
  <div class="push">&nbsp;</div>
  </div>
  
  <!-- FOOTER -->
  <div class="footer">
	<?php print render($page['footer']); ?>
  </div>
  <!-- #FOOTER -->

</div>
<!-- #PAGE WRAPPER -->