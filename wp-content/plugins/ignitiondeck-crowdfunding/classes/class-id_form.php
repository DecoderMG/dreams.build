<?php

class ID_Form {

	var $fields;

	function __construct(
		$fields = null
		) 
	{
		$this->fields = $fields;
	}

	function build_form($vars = null) {
		$output = '<ul>';
		foreach ($this->fields as $field) {
			if (isset($field['label'])) {
				$label = $field['label'];
			}
			else {
				$label = '';
			}
			if (isset($field['name'])) {
				$name = $field['name'];
			}
			else {
				$name = '';
			}
			if (isset($field['id'])) {
				$id = $field['id'];
			}
			if (isset($field['taxonomy']) && !empty($field['taxonomy'])) {
				$taxonomy = $field['taxonomy'];
			}
			if (isset($field['taxonomy_type']) && !empty($field['taxonomy_type'])) {
				$taxonomy_type = $field['taxonomy_type'];
			}
			if (isset($field['wclass'])) {
				$wclass = $field['wclass'];
			}
			else {
				$wclass = null;
			}
			if (isset($field['class'])) {
				$class= $field['class'];
			}
			else {
				$class = $id;
			}
			if (isset($field['type'])) {
				$type = $field['type'];
			}
			else {
				$type = '';
			}
			if (isset($field['options'])) {
				$options = $field['options'];
			}
			else {
				$options = null;
			}
			if (isset($field['value'])) {
				$value = $field['value'];
			}
			else {
				$value = null;
			}
			if (isset($field['misc'])) {
				$misc = $field['misc'];
			}
			else {
				$misc = '';
			}
			if (isset($field['mediabuttons'])) {
				$mediabuttons = $field['mediabuttons'];
			}
			else {
				$mediabuttons = '';
			}
			if (isset($field['errors'])) {
				$errors = $field['errors'];
			}
			else{
				$errors ='';
			}
			// Start Building
			ob_start();
			$post_id = (isset($vars['post_id']) ? $vars['post_id'] : null);
			do_action('fes_'.$name.'_before', $post_id);
			$output .= ob_get_contents();
			ob_end_clean();
			if (isset($field['before'])) {
				$output .= $field['before'];
			}
			$output .= '<li '.(isset($wclass) ? 'class="'.$wclass.'"' : '').'>';
			if(strpos($misc, 'title=')!==false) $class.=' itooltip ';
			switch($type) {
				case 'text':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="text" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'email':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="email" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'number':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="number" id="'.$id.'" name="'.$name.'" class="'.$class.' number-field" value="'.((!empty($value)) ? $value : 0).'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'password':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="password" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'file':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="file" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'date':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="date" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'tel':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<input type="tel" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'hidden':
					$output .= '<input type="hidden" id="'.$id.'" name="'.$name.'" value="'.$value.'" '.$misc.'/>';
					break;
				case 'select':
					if (isset($taxonomy)) {
						$taxonomy_args = array(
							'taxonomy' => $taxonomy,
							'hide_empty' => false,
							'exclude' => '1,36,47,46,232,233,234'
						);
						if (isset($taxonomy_type)) {
							$taxonomy_args['type'] = $taxonomy_type;
						}
						$terms = get_categories($taxonomy_args);

						$taxonomy_options = array();

						// $taxonomy_options = array(array('value'=>'', 'title' =>'Please select...'));
						
						/* Filtering categories to not allow for random numbers */
						foreach ($terms as $term) {
							if($term->name == 'Blog' || $term->name == 'Uncategorized' || $term->name == 'Events' || $term->name == 'News' || is_numeric($term->name)) {
							}
							else {
								$taxonomy_options[] = array('value' => $term->cat_ID, 'title' => $term->name);
							}
						}

						if ($options) {
							$options = array_merge($options,$taxonomy_options);
						} else {
							$options = $taxonomy_options;
						}
					}

					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<select id="'.$id.'" name="'.$name.'" class="'.$class.'" >';
					foreach ($options as $option) {
						$output .= '<option value="'.$option['value'].'" '.($option['value'] == $value ? 'selected="selected"' : '').' '.$misc.' '.(isset($option['misc']) ? $option['misc'] : '').'>'.$option['title'].'</option>';
					}
					$output .='</select></p>';
					break;
				case 'select_multiple':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					if(!empty($value)){$array = array();
					foreach($value as $val) $array[] = $val->term_id;}
					//$output .= '<select multiple data-placeholder="Project Tags" id="'.$id.'" name="'.$name.'" class="'.$class.'" >';
					$output .= '<select multiple="multiple" id="'.$id.'" name="'.$name.'[]" class="'.$class.'" >';
					foreach ($options as $option) {
						//$output .= '<option value="'.$option['value'].'" '.($option['value'] == $value ? 'selected="selected"' : '').' '.$misc.' '.(isset($option['misc']) ? $option['misc'] : '').'>'.$option['title'].'</option>';
						
						/* Check for vulnerable tags and exclude tags that could be used incorrectly */
						if($option['title'] == 'Dream Of The Day' || $option['title'] == 'Trending' || $option['title'] == 'Popular') {
							
						}
						else {
							$output .= '<option value="'.$option['value'].'" '.(!empty($value)&&in_array($option['value'], $array) ? 'selected="selected"' : '').' '.$misc.' '.(isset($option['misc']) ? $option['misc'] : '').'>'.$option['title'].'</option>';
						}
						
					}
					$output .='</select></p>';
					break;
				case 'checkbox':
					$output .= '<input type="checkbox" id="'.$id.'" name="'.$name.'" class="'.$class.'"  value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= '<label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					break;
				case 'radio':
					$output .= '<input type="radio" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'" '.$misc.'/>';
					if (!empty($label)) {
						$output .= ' <label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					break;
				case 'textarea':
					if (!empty($label)) {
						$output .= '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label>';
					}
					$output .= '<textarea id="'.$id.'" name="'.$name.'" class="'.$class.'" '.$misc.'>'.$value.'</textarea>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
				case 'wpeditor':
					ob_start();
					if (!empty($label)) {
						echo '<p><label for="'.$id.'">'.apply_filters('fes_'.$name.'_label', $label).'</label></p>';
					}
					$media_buttons = ($mediabuttons===true) ? true : false;
					wp_editor(html_entity_decode($value), $id, array('editor_class' => $class, 'textarea_name' => $name, 'media_buttons' => 1, 'textarea_rows' => 6, 'media_buttons'=>$media_buttons,'quicktags'=>false));
					/*if (!empty($label)) {
						echo '</p>';
					}*/
					$output .= ob_get_contents();
					ob_end_clean();
					break;
				case 'submit':
					$output .= '<p><input type="submit" id="'.$id.'" name="'.$name.'" class="'.$class.'" value="'.$value.'"/>';
					if (!empty($label)) {
						$output .= '</p>';
					}
					break;
			}
			if (!empty($errors)) {
				$output .= '<p class="error">'.$label.' '.$errors.'.</p>';
			}
			$output .= '</li>';
			if (isset($field['after'])) {
				$output .= $field['after'];
			}
			ob_start();
			do_action('fes_'.$name.'_after', $post_id);
			$output .= ob_get_contents();
			ob_end_clean();
		}
		$output .= '</ul>';
		return $output;
	}
}
?>