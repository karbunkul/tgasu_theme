<?php //если не админ то показываем тулбар?>

<?php if (!$is_admin):?>
<!--NAVBAR-->
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar navbar-inner"><a class="brand" href="<?print $front_page; ?>"><?php print strtolower($_SERVER['SERVER_NAME']); ?></a>
  	<ul class="nav pull-right">
  		<li><?php if ($logged_in):?> <a href="/user/logout"><?php print '<i class="icon-off icon-white"></i> ' . t("Logout"); endif;?></a></li>
  	</ul>	    
  </div>
</div>
<!--#NAVBAR-->
<?php endif;?>

<!--HEADER-->
<div class="container-fluid header-wrapper <?php if (!$is_admin):?>header-margin<?php endif;?>">
  <div class="row-fluid">
    <span class="span2">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
      <?php endif; ?>
    </span>
    <span class="span8">
    
    
        <div id="myCarousel" class="carousel slide">
        <?php $banner_dir = 'http://localhost/devel/' . drupal_get_path('theme', 'tgasu') . '/banner'; ?>
    <!-- Carousel items -->
    <div class="carousel-inner">
    	<div class="active item">
    		<img alt="" src="<?php print $banner_dir; ?>/1.jpg">
        <div class="carousel-caption">
        	<h4>Первый слайд</h4>
          	<p>Ну а тут можно выводить любой текст, в том числе и такие ссылки <a href="/node/1"><button class="btn btn-danger">подробнее</button></a></p></div>
    		</div>
    	<div class="item">
    		<img alt="" src="<?php print $banner_dir; ?>/3.png">
        <div class="carousel-caption">
        	<h4>Второй слайд</h4>
          	<p>Текст для второго слайда</p>
        </div>
    	</div>
    	<div class="item">
    		<img alt="" src="<?php print $banner_dir; ?>/2.jpg">
        <div class="carousel-caption">
        	<h4>Third Thumbnail label</h4>
          	<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </div>
    	</div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
    
    <?php //print render($page['header']); ?></span>
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
<!--./HEADER-->


<!-- BREADCRUMB -->
<div class="conteiner-fluid">
	<div class="row-fluid">
		<div class="span12"><?print $breadcrumb; ?></div>
	</div>
</div>

<!-- #BREADCRUMB -->

<!--CONTENT-->
<?php
	$sidebar_one = render($page['sidebar_first']);
	$sidebar_two = render($page['sidebar_second']);
	$content = render($page['content']);
?>

<?php if ( ($sidebar_one != '') && ($sidebar_two == '') ):?>
<div class="container-fluid content-wrapper">
	<div class="row-fluid">
    	<div class="span2"><?php print $sidebar_one; ?></div>
    	<div class="span10">
    		<div id="content" class="column" role="main">
        		<?php print render($page['highlighted']); ?>
        			<a id="main-content"></a>
        		<?php print render($title_prefix); ?>
      			<?php if ($title): ?>
        			<h1 class="title" id="page-title"><?php print $title; ?></h1>
      			<?php endif; ?>
      			<?php print render($title_suffix); ?>
      			<?php print $messages; ?>
      			<?php print render($tabs); ?>
      			<?php print render($page['help']); ?>
      			<?php if ($action_links): ?>
        			<ul class="action-links"><?php print render($action_links); ?></ul>
      			<?php endif; ?>
      			<?php print render($page['content']); ?>
      			<?php print $feed_icons; ?>
    		</div>
    	</div>
    	</div>
    </div>
</div>
<?php endif;?>

<?php if ( ($sidebar_one == '') && ($sidebar_two != '') ):?>
<div class="container-fluid content-wrapper">
	<div class="row-fluid">
    	<div class="span10">
    		<div id="content" class="column" role="main">
        		<?php print render($page['highlighted']); ?>
        			<a id="main-content"></a>
        		<?php print render($title_prefix); ?>
      			<?php if ($title): ?>
        			<h1 class="title" id="page-title"><?php print $title; ?></h1>
      			<?php endif; ?>
      			<?php print render($title_suffix); ?>
      			<?php print $messages; ?>
      			<?php print render($tabs); ?>
      			<?php print render($page['help']); ?>
      			<?php if ($action_links): ?>
        			<ul class="action-links"><?php print render($action_links); ?></ul>
      			<?php endif; ?>
      			<?php print render($page['content']); ?>
      			<?php print $feed_icons; ?>
    		</div>
    	</div>
    	<div class="span2"><?php print $sidebar_two; ?></div>
    </div>
</div>
<?php endif;?>

<?php if ( ($sidebar_one != '') && ($sidebar_two != '') ):?>
<div class="container-fluid content-wrapper">
	<div class="row-fluid">
		<div class="span2"><?php print $sidebar_one; ?></div>
    	<div class="span8">
    		<div id="content" class="column" role="main">
        		<?php print render($page['highlighted']); ?>
        			<a id="main-content"></a>
        		<?php print render($title_prefix); ?>
      			<?php if ($title): ?>
        			<h1 class="title" id="page-title"><?php print $title; ?></h1>
      			<?php endif; ?>
      			<?php print render($title_suffix); ?>
      			<?php print $messages; ?>
      			<?php print render($tabs); ?>
      			<?php print render($page['help']); ?>
      			<?php if ($action_links): ?>
        			<ul class="action-links"><?php print render($action_links); ?></ul>
      			<?php endif; ?>
      			<?php print render($page['content']); ?>
      			<?php print $feed_icons; ?>
    		</div>
    	</div>
    	<div class="span2"><?php print $sidebar_two; ?></div>
    </div>
</div>
<?php endif;?>

<?php if ( ($sidebar_one == '') && ($sidebar_two == '') ):?>
<div class="container-fluid content-wrapper">
	<div class="row-fluid">
    	<div class="span12">
    		<div id="content" class="column" role="main">
        		<?php print render($page['highlighted']); ?>
        			<a id="main-content"></a>
        		<?php print render($title_prefix); ?>
      			<?php if ($title): ?>
        			<h1 class="title" id="page-title"><?php print $title; ?></h1>
      			<?php endif; ?>
      			<?php print render($title_suffix); ?>
      			<?php print $messages; ?>
      			<?php print render($tabs); ?>
      			<?php print render($page['help']); ?>
      			<?php if ($action_links): ?>
        			<ul class="action-links"><?php print render($action_links); ?></ul>
      			<?php endif; ?>
      			<?php print render($page['content']); ?>
      			<?php print $feed_icons; ?>
    		</div>
    	</div>
	</div>
</div>
<?php endif;?>

<!--#CONTENT-->


<!-- FOOTER -->

<footer>
<div class="tabbable tabs-below">

  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <div class="row-fluid">
       <div class="span3">1 колонка</div><span style="background-color:grey;">
тут какой-то текст тут какой-то текст тут какой-то текст тут какой-то текст тут какой-то текст тут какой-то текст</span>
       <div class="span3">2 колонка</div>
       <div class="span3">3 колонка</div>
       <div class="span3">4 колонка</div>
      </div>
    </div>
    <div class="tab-pane" id="tab2">
      <p>Здесь так же могут быть колонки</p>
      
    </div>
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Кафедры</a></li>
    <li><a href="#tab2" data-toggle="tab">Институты</a></li>
  </ul>
</div>
</div>
</footer>
<!-- #FOOTER -->

