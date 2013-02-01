<?php
/*режим разработки*/

//$theme_debug = true;
$theme_debug = false;

if ($theme_debug && !defined('MAINTENANCE_MODE')) {
 // Rebuild .info data.
 system_rebuild_theme_data();
 // Rebuild theme registry.
 drupal_theme_rebuild();
}

function tgasu_theme_js_alter(&$javascript){
 //$javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'tgasu_theme') . '/assets/js/jquery/jquery-last.js';
}

/*bootstrap breadcrumbs*/
function tgasu_theme_breadcrumb(&$variables) {
 $breadcrumb = $variables['breadcrumb'];
 if (!empty($breadcrumb)) {
  $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
  $crumbs = '';
  $array_size = count($breadcrumb);
  $i = 0;
  $breadcrumb[0] = '<li><i class="icon icon-home"></i>&nbsp;<a href="/">'.t("Home").'</a></li>';
  while ( $i < $array_size) {
   $crumbs .= '<li>' . $breadcrumb[$i] . '</li><span class="divider">/</span>';
   $i++;
  }
 return '<ul class="breadcrumb">' . $crumbs . '<li class="active">'. drupal_get_title() .'</li></ul>';
 }
}

/*bootstrap tabs*/
function tgasu_theme_menu_local_tasks(&$variables) {
 $output = '';
 if (!empty($variables['primary'])) {
  $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
  $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs">';
  $variables['primary']['#suffix'] = '</ul>';
  $output .= drupal_render($variables['primary']);
 }
 if (!empty($variables['secondary'])) {
  $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
  $variables['secondary']['#prefix'] .= '<ul class="nav nav-tabs">';
  $variables['secondary']['#suffix'] = '</ul>';
  $output .= drupal_render($variables['secondary']);
 }
 return $output;
}

function tgasu_theme_table($variables) {
 $header = $variables['header'];
 $rows = $variables['rows'];
 $attributes = $variables['attributes'];
 $caption = $variables['caption'];
 $colgroups = $variables['colgroups'];
 $sticky = $variables['sticky'];
 $empty = $variables['empty'];

 // Add sticky headers, if applicable.
 if (count($header) && $sticky) {
  drupal_add_js('misc/tableheader.js');
  // Add 'sticky-enabled' class to the table to identify it for JS.
  // This is needed to target tables constructed by this function.
  $attributes['class'][] = 'sticky-enabled';
 }
 /**
  * bootstrap table
 */
 $attributes['class'][] = 'table table-hover table-bordered';
 $output = '<table' . drupal_attributes($attributes) . ">\n";
 if (isset($caption)) {
  $output .= '<caption>' . $caption . "</caption>\n";
 }

	// Format the table columns:
	if (count($colgroups)) {
		foreach ($colgroups as $number => $colgroup) {
			$attributes = array();

			// Check if we're dealing with a simple or complex column
			if (isset($colgroup['data'])) {
				foreach ($colgroup as $key => $value) {
					if ($key == 'data') {
						$cols = $value;
					}
					else {
						$attributes[$key] = $value;
					}
				}
			}
			else {
				$cols = $colgroup;
			}

			// Build colgroup
			if (is_array($cols) && count($cols)) {
				$output .= ' <colgroup' . drupal_attributes($attributes) . '>';
				$i = 0;
				foreach ($cols as $col) {
					$output .= ' <col' . drupal_attributes($col) . ' />';
				}
				$output .= " </colgroup>\n";
			}
			else {
				$output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
			}
		}
	}

	// Add the 'empty' row message if available.
	if (!count($rows) && $empty) {
		$header_count = 0;
		foreach ($header as $header_cell) {
			if (is_array($header_cell)) {
				$header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
			}
			else {
				$header_count++;
			}
		}
		$rows[] = array(array(
				'data' => $empty,
				'colspan' => $header_count,
				'class' => array('empty', 'message'),
		));
	}

	// Format the table header:
	if (count($header)) {
		$ts = tablesort_init($header);
		// HTML requires that the thead tag has tr tags in it followed by tbody
		// tags. Using ternary operator to check and see if we have any rows.
		$output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
		foreach ($header as $cell) {
			$cell = tablesort_header($cell, $header, $ts);
			$output .= _theme_table_cell($cell, TRUE);
		}
		// Using ternary operator to close the tags based on whether or not there are rows
		$output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
	}
	else {
		$ts = array();
	}

	// Format the table rows:
	if (count($rows)) {
		$output .= "<tbody>\n";
		$flip = array(
				'even' => 'odd',
				'odd' => 'even',
		);
		$class = 'even';
		foreach ($rows as $number => $row) {
			$attributes = array();

			// Check if we're dealing with a simple or complex row
			if (isset($row['data'])) {
				foreach ($row as $key => $value) {
					if ($key == 'data') {
						$cells = $value;
					}
					else {
						$attributes[$key] = $value;
					}
				}
			}
			else {
				$cells = $row;
			}
			if (count($cells)) {
				// Add odd/even class
				if (empty($row['no_striping'])) {
					$class = $flip[$class];
					$attributes['class'][] = $class;
				}

				// Build row
				$output .= ' <tr' . drupal_attributes($attributes) . '>';
				$i = 0;
				foreach ($cells as $cell) {
					$cell = tablesort_cell($cell, $header, $ts, $i++);
					$output .= _theme_table_cell($cell);
				}
				$output .= " </tr>\n";
			}
		}
		$output .= "</tbody>\n";
	}

	$output .= "</table>\n";
	return $output;
}


function tgasu_theme_button($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'submit';
	element_set_attributes($element, array('id', 'name', 'value'));

	$element['#attributes']['class'][] = 'form-' . $element['#button_type'];
	if (!empty($element['#attributes']['disabled'])) {
		$element['#attributes']['class'][] = 'form-button-disabled';
	}
	$element['#attributes']['class'][] = 'btn btn-info';
	return '<input' . drupal_attributes($element['#attributes']) . ' />';
	
	//return '<button ' . drupal_attributes($element['#attributes']) . ' >ok</button>';
}


