<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

//kpr($row);
?>

<style>

.news-main-preview{
	max-width:128px;
}

</style>
 
 <div class="well">
	<div class="row-fluid">
		<div class="news-main-preview span2 clearfix"><?php print $fields['field_new_preview']->content;?></div>
		<div class="span10">
			<div class="conteiner-fluid">
				<h4><small><i class="icon icon-time"></i><?php print $fields['created']->content;?></small>
					<?php print $fields['title']->content;?>
				</h4>
				
				<p><?php print $fields['body']->content;?>	
				<?php if (user_access('edit any new content')): ?>
					<a href="node/<?php print $row->nid; ?>/edit">
						<button class="btn btn-success"><?php print t('Edit')?></button>
					</a>
				
				<?php endif; ?>
					<a href="node/<?php print $row->nid; ?>">
					 <button class="btn btn-info pull-right"><?php print t('Read more')?>
					 </button>
				</a>
			</div>
			
		</div>
	</div>	
</div>