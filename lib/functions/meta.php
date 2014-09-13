<?php
/**
 * This file contains all the functionality for the additional meta boxes for the pages and posts.
 * It contains functions for loading the meta data into arrays, displaying the meta boxes and
 * saving the meta data.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action('init', 'pexeto_load_meta_boxes');

add_action('add_meta_boxes', 'pexeto_portfolio_image_box');
add_action('add_meta_boxes', 'pexeto_init_meta_boxes');  

add_action('save_post', 'pexeto_save_postdata');  

/**
 * Moves the featured image box below the text editor.
 */
if(!function_exists("pexeto_portfolio_image_box")){
	function pexeto_portfolio_image_box() {
		
		
		add_meta_box('portfoliogallery', __('Add images to the item', 'pexeto'), 'pexeto_gallery_meta_box', PEXETO_PORTFOLIO_POST_TYPE, 'normal', 'high');
	}
}

if(!function_exists("pexeto_gallery_meta_box")){
function pexeto_gallery_meta_box(){
		global $post, $wp_version;

		$ver = floatval($wp_version);
		$min_ver = 3.5;
		$load_media_window = $ver < $min_ver ? "true" : "false";
		echo '<script>
		jQuery(document).ready(function($){
			pexetoPageOptions.setMediaUploadFunctionality('.$post->ID.', '.$load_media_window.');
			});</script>';
		if($ver>=$min_ver){
			echo '<div class="option-description">Note: WordPress 3.5 included a new Media management
			section which changes the way the images are added to items. Please check the
			instructions below about how to add and edit images.</div>';
		}
		echo('<p id="gallery-buttons"><a class="button-primary" id="add-images">Add Images</a>');
		if(pexeto_get_image_number($post->ID)>0 || $ver>=$min_ver){
			echo '<a class="button" id="edit-images">Edit images</a>';
		}
		echo '</p>';
		if($ver<$min_ver){
			echo '<div id="gallery-images">'.pexeto_get_attachment_thumb_html($post->ID)
			.'<div class="loading-overlay"></div></div><span class="option-description">
			Click on the "Add Images" button to add images to the item. 
			If you would like to specify a custom thumbnail image for the item, 
			click on the "Set as featured image" link of the image. Otherwise the thumbnail of the item 
			will be the first image of the image set. If you would like to reorder the images, 
			click on the "Edit Images" button and drag and drop the images on the desired position.</span>';
		}else{
			echo '
			<div id="add-instr" style="display:none;">
			<strong>Adding images</strong>
			<ol>
			<li>Click on the "Add Media" button located above the content editor
			<br/><img src="'.PEXETO_IMAGES_URL.'add-media.png" width="200" />
			</li>
			<li>Click on the "Create Gallery" tab. Upload and select the images you want to add and click on the "Create a new gallery" button
			<br/><img src="'.PEXETO_IMAGES_URL.'new-gallery.png" width="100"/>
			</li>
			<li>After you set the images in the gallery, click on the "Insert gallery" button
			<br/><img src="'.PEXETO_IMAGES_URL.'insert-gallery.png" width="100"/>
			</li>
			</ol>
			</div>
			<div id="edit-instr" style="display:none;">
			<strong>Editing images</strong>
			<ol>
			<li>Click on the gallery in the content editor and click on the "Edit Gallery" button of the
			gallery
			<br/><img src="'.PEXETO_IMAGES_URL.'edit-gallery.png" width="400" />
			</li>
			<li>Change the images in the way you like</li>
			<li>Click on the "Update Gallery" button
			<br/><img src="'.PEXETO_IMAGES_URL.'update-gallery.png" width="100"/>
			</li>
			</ol>
			</div>';
		}
		
	}
}

/**
 * Loads the meta boxes content into an array.
 */
if(!function_exists("pexeto_load_meta_boxes")){
	function pexeto_load_meta_boxes(){
		//load the porftfolio categeories
		$portf_taxonomies=get_terms('portfolio_category', array('hierarchical'=>true, 'hide_empty'=>0));
		$portf_categories=array(array('id'=>'-1', 'name'=>'All Portfolio Categories'));

		foreach($portf_taxonomies as $taxonomy){
			$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->term_id);
		}
		$loader_portf_categories=array_merge(array(array('id'=>'hide','name'=>'Hide'), (array('id'=>'disabled','name'=>'Show:'))), $portf_categories);

		//load the post categeories
		$categories=get_categories('hide_empty=0');
		$pexeto_categories=array(array('id'=>'-1', 'name'=>'All Categories'));
		for($i=0; $i<sizeof($categories); $i++){
			$pexeto_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
		}
		
		global $pexeto_data, $new_meta_boxes, $new_meta_portfolio_boxes, $new_meta_post_boxes;
		
		$sliders=pexeto_get_created_sliders();

		$gallery_post_sliders = array( array('id'=>'attachments', 'name'=>'Post attachments'));
		foreach ($sliders as $slider) {
			if(strstr($slider['id'],PEXETO_NIVOSLIDER_POSTTYPE)){
				$gallery_post_sliders[]=$slider;
			}
		}


		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PAGES
		 * ------------------------------------------------------------------------*/

		//the meta data for posts
		$new_meta_post_boxes =
		array(

		array(
			"title" => "视频连接",
			"name" => "video",
			"type" => "text",
			"description" => '如果这是一篇"视频"文章, 在此处插入视频链接.'
			),
		array(
			"title" => "相册文章滑块 - 选择展示图片:",
			"name" => "post_slider",
			"type" => "select",
			"options" => $gallery_post_sliders,
			"std" => 'attachments',
			'description' => '当文章类型为"相册"时, 选择从何处载入图片. 如果你选择了"Post attachments", 那么在本文中上传的图片将会展示. 你也可以从 '.PEXETO_THEMENAME.' 
			Options -> Nivo Slider 部分已经创建的滑块.'
			)

		);

		//the meta data for pages
		$new_meta_boxes =
		array(

		array(
			"title" => '<div class="ui-icon ui-icon-wrench"></div>页面常规设置',
			"type" => "heading"),

		array(
			"title" => "头部",
			"name" => "slider",
			"type" => "select",
			"options" => $sliders,
			"std" => 'none'
			),

			array(
			"title" => "页面布局",
			"name" => "layout",
			"type" => "imageradio",
			"options" => array(array("img"=>PEXETO_IMAGES_URL.'layout-right-sidebar.png', "id"=>"right", "title"=>"Right Sidebar Layout"),
			array("img"=>PEXETO_IMAGES_URL.'layout-left-sidebar.png', "id"=>"left", "title"=>"Left Sidebar Layout"),
			array("img"=>PEXETO_IMAGES_URL.'layout-full-width.png', "id"=>"full", "title"=>"Full Width Layout")),
			"std" => 'right',
			"description" => '对于默认和联系方式模板有效'
			),

			array(
			"title" => "边栏",
			"name" => "sidebar",
			"type" => "select",
			"options" => $pexeto_data->pexeto_sidebars,
			"description" => '你可以为这个页面选择一个默认的边栏或者你以创建的边栏. 如果你不想使用默认边栏, 你可以在 "'.PEXETO_THEMENAME.' Options->Sidebars" 部分创建新的边栏, 然后在这里选择.'
			),
			
			array(
			"title" => "显示页面标题",
			"name" => "show_title",
			"type" => "select",
			"options" => array(array("name"=>"使用全局设置", "id"=>"global"),
			array("name"=>"显示", "id"=>"on"),
			array("name"=>"隐藏", "id"=>"off")),
			"std" => 'global',
			"description" => '是否显示页面标题 - 如果选择了 "使用全局设置" , 那么会使用在
			'.PEXETO_THEMENAME.' Options &raquo; General &raquo; "Display page title on pages" 中设定的值.'),
			
			array(
			"title" => "自定义全宽度背景图片",
			"name" => "full_bg",
			"std" => "",
			"type" => "upload",
			"description" => '你可以在 '.PEXETO_THEMENAME.' Options &raquo; Style Settings  &raquo; 
			General 部分设置全局的全宽度背景图片. 在这里你可以仅为这个页面进行设置背景图片. <br/>
			使用 "<b>Upload Image</b>" 按钮来上传一个新的图片. 如果你想从多媒体库中选择一个图片,
			点击 "<b>Use Media Library</b>" 按钮. 选择相应的图片后, 选择 "插入到文章" 按钮.'
			),
			
			array(
			"title" => '<div class="ui-icon ui-icon-image"></div>相册设置 - 一下设置仅对 Portfolio Grid Gallery page 模板可用',
			"type" => "heading"),

			array(
			"title" => "选择特定分类的 portfolio 项目",
			"name" => "post_category",
			"type" => "select",
			"none" => true,
			"options" => $portf_categories,
			"std" => '-1',
			"description" => '如果选择了 "All Categories", 会显示所有的 Portfolio 项目. 如果选择了特定的一个分类, 那仅仅这个分类及其子分类中的项目会显示. 
			通过选择不同的分类, 你可以创建多个 portfolio/gallery 页面来展示不同的项目.'
			),

			array(
			"title" => "Portfolio 项目顺序",
			"name" => "order",			
			"type" => "select",
			"options" => array(array("name"=>"按日期", "id"=>"date"),
			array("name"=>"按自定义顺序", "id"=>"custom")),
			"std" => 'date',
			"description" => '如果选择 "By Date" 那么最近创建的项目会先显示. 如果选择 "By Custom Order"
			你需要设置每个项目的顺序 - 序号小的项目会先显示.'),


			array(
			"title" => "显示 portfolio 分类筛选",
			"name" => "show_filter",			
			"type" => "select",
			"options" => array(array("name"=>"显示", "id"=>"true"),
			array("name"=>"隐藏", "id"=>"false")),
			"std" => 'true',
			"description" => '如果选择 "显示", 一个分类筛选器会在 portfolio 项目上显示'),


			array(
			"title" => "每次载入显示的 portfolio 项目数",
			"name" => "post_number",
			"std" => "10",
			"type" => "text"
			),
			
			array(
			"title" => "基本图像宽度",
			"name" => "image_width",			
			"type" => "text",
			"std" => '300',
			"description" => '网格相册中较小图片的基本图片宽度 - 大尺寸的图片尺寸会根据这个宽度计算 (仅对 the Grid Gallery 模板可用)'
			),
			
			array(
			"title" => "基本图像高度",
			"name" => "image_height",			
			"type" => "text",
			"std" => '186',
			"description" => '网格相册中较小图片的基本图片高度 - 大尺寸的图片尺寸会根据这个高度计算 (仅对 the Grid Gallery 模板可用)'
			)
			
			);



			/* ------------------------------------------------------------------------*
			 * META BOXES FOR THE PORTFOLIO POSTS
			 * ------------------------------------------------------------------------*/

			$new_meta_portfolio_boxes =
			array(

			array(
			"title" => "项目类型",
			"name" => "action",
			"type" => "select",
			"options" => array(
			// array("name"=>"全高度相册", "id"=>"slider_full_height"),
			array("name"=>"全宽度相册", "id"=>"slider_full_width"),
			// array("name"=>"轻量级相册", "id"=>"lightbox"),
			// array("name"=>"标准页面", "id"=>"standard"),
			array("name"=>"视频项目", "id"=>"video"),
			array("name"=>"自定义链接", "id"=>"custom")),
			"std" => "slider_full_width",
			"description" => '选择 portfolio 项目类型. 网格相册中点击效果会受此影响. 对于照片选择 "全宽度相册"'
			),
			
			array(
			"title" => "自定义 链接/视频 URL",
			"name" => "custom",
			"std" => "",
			"type" => "text",
			"description" => '如果 "项目类型" 为 "视频项目", 你可以在这里插入一个视频的 URL. 如果选择了 "自定义链接", 
			你可以插入一个自定义的 URL.'
			),
			
			array(
			"title" => "视频描述",
			"name" => "description",
			"std" => "",
			"type" => "textarea",
			"description" => '如果 "项目类型" 为 "视频项目", 你这里输入的描述信息会显示在图片/视频下面.'
			),


			array(
			"title" => '<div class="ui-icon ui-icon-image"></div>仅对网格相册项目的设置',
			"type" => "heading"),
			
			array(
			"title" => "图片布局 - 分配的行列数目",
			"name" => "img_layout",
			"class" => "layout",
			"type" => "multiple-text",
			"std" => "1",
			"elements" => array( array(
				"title" => "列数",
				"name" => "img_columns",
				"type" => "text",
				"std" => "1"
				),

				array(
				"title" => "行数",
				"name" => "img_rows",
				"type" => "text",
				"std" => "1"
				)),
			"description" => '基本图片 (列/行) 的大小可以在相册页面中的编辑选项中设定. 这里设置该图片需要占用多少空间.'
			),

				array(
			"title" => "剪裁缩略图方式",
			"name" => "crop",
			"type" => "imageradio",
			"options" => array(array("img"=>PEXETO_IMAGES_URL.'crop-c.png', "id"=>"c", "title"=>"居中"),
			array("img"=>PEXETO_IMAGES_URL.'crop-t.png', "id"=>"t", "title"=>"顶部"),
			array("img"=>PEXETO_IMAGES_URL.'crop-b.png', "id"=>"b", "title"=>"底部"),
			array("img"=>PEXETO_IMAGES_URL.'crop-l.png', "id"=>"l", "title"=>"左侧"),
			array("img"=>PEXETO_IMAGES_URL.'crop-r.png', "id"=>"r", "title"=>"右侧")
			),
			"std" => "c",
			"description" => '当缩略图由特色图片自动生成时会使用这个选项 (当 "缩略图 URL" 留空时)- 如图所示, 该选项会影响横向和纵向图片.'
			),

			array(
			"title" => "自定义缩略图 URL",
			"name" => "thumbnail",
			"std" => "",
			"type" => "upload",
			"description" => '自定义缩略图, 建议使用此项.<br />
			使用 "<b>Upload Image</b>" 按钮来上传一个新的图片. 如果你想从多媒体库中选择一个图片,
			使用 "<b>Use Media Library</b>" 按钮. 选择相应的图片后, 选择 "插入到文章" 按钮.'
			),

			array(
			"title" => '<div class="ui-icon ui-icon-image"></div>标准页面类型设置',
			"type" => "heading"),

				array(
			"name" => "layout",
			"title" => "Layout",
			"type" => "select",
			"class" => "two-columns",
			"options" => array(array("name"=>"右边栏", "id"=>"right"),
			array("name"=>"左边栏", "id"=>"left"),
			array("name"=>"全宽度", "id"=>"full")),
			"std" => 'right',
			"description" => '这是单个项目的布局 - 当项目类型为 "视频项目" 时, 该选项会影响单个项目页面.'),
			
				array(
			"title" => "边栏",
			"name" => "sidebar",
			"class" => "two-columns last",			
			"type" => "select",
			"options" => $pexeto_data->pexeto_sidebars,
			"description" => '单个项目页面的边栏 - 当项目类型为 "视频项目" 时, 该选项会影响单个项目页面.'),

	);

	}
}


if(!function_exists("pexeto_get_posttype_meta_boxes")){
	function pexeto_get_posttype_meta_boxes($post_type){
		$meta_boxes = null;
		switch ($post_type) {
			case 'page':
				global $new_meta_boxes;
				$meta_boxes = $new_meta_boxes;
				break;
			case 'post':
				global $new_meta_post_boxes;
				$meta_boxes = $new_meta_post_boxes;
				break;
			case PEXETO_PORTFOLIO_POST_TYPE:
				global $new_meta_portfolio_boxes;
				$meta_boxes = $new_meta_portfolio_boxes;
				break;	
		}
		return $meta_boxes;
	}
}


/**
 * Creates a page meta box.
 */
if(!function_exists("pexeto_init_meta_boxes")){
	function pexeto_init_meta_boxes() {
		global $post;
		$post_type = $post->post_type;
		$allowed_types = array("post", "page", PEXETO_PORTFOLIO_POST_TYPE);
		if(in_array($post_type, $allowed_types)){
			add_meta_box( 'new-meta-'.$post_type.'-boxes', '<div class="icon-small"></div> '.PEXETO_THEMENAME.' '.$post_type.' SETTINGS', 'pexeto_add_meta_boxes', $post_type, 'normal', 'high' );
		}
	}
}


/**
 * Calls the print method for the relevant post type meta boxes.
 */
if(!function_exists("pexeto_add_meta_boxes")){
	function pexeto_add_meta_boxes() {
		global $post;
		$post_type = $post->post_type;
		$meta_boxes = pexeto_get_posttype_meta_boxes($post_type);
		

		if($meta_boxes!=null){
			foreach($meta_boxes as $meta_box) {
				print_meta_box($meta_box, $post);
			}
		}
	}
}


/**
 * Prints the meta box
 * @param $meta_box the meta box to be printed
 * @param $post the post to contain the meta box
 */
if(!function_exists("print_meta_box")){
	function print_meta_box($meta_box, $post){
		$meta_box_value = "";
		if(isset($meta_box['name'])){
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		}

		if($meta_box_value == "" && isset($meta_box['std'])){
			$meta_box_value = $meta_box['std'];
		}

		if($meta_box['type']!='heading'){
			$box_class = isset($meta_box['class'])?' '.$meta_box['class']:'';
			echo '<div class="option-container'.$box_class.'">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';
		}

		switch($meta_box['type']){
			case 'heading':
				echo'<div class="option-heading"><h4>'.$meta_box['title'].'</h4></div>';
				break;
			case 'text':
				echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" class="option-input"/><br />';
				break;
			case 'upload':
				echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" id="pexeto-'.$meta_box['name'].'" class="option-input upload pexeto-upload"/>';
				echo '<input type="button" id="pexeto-'.$meta_box['name'].'_button" class="button pexeto-upload-btn" value="Upload Image" />';
				echo '<input type="button" id="pex-media" class="button-secondary" value="Use Media Library" onclick="pexetoPageOptions.loadMediaImage(jQuery(\'#pexeto-'.$meta_box['name'].'\'));"/>';
				break;
			case 'textarea':
				echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';
				break;
			case 'imageradio':
				if(sizeof($meta_box['options'])>0){
					foreach ($meta_box['options'] as $option) { 
						$checked= $meta_box_value == $option['id']?'checked="checked"':'';
						echo '<div class="imageradio"><input type="radio" name="'.$meta_box['name'].'_value" value="'.$option['id'].'" '.$checked.'/><img src="'.$option['img'].'" title="'.$option['title'].'"/></div>';
					}
				}
				break;
			case 'select':
				echo '<select name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">';

					
				if(sizeof($meta_box['options'])>0){
					foreach ($meta_box['options'] as $option) { ?>
						<option
						<?php if ( $meta_box_value == $option['id']) {
							echo ' selected="selected"';
						}
						if ($option['id']=='disabled') {
							echo ' disabled="disabled"';
						}

						if (isset($option['class'])) {
							echo ' class="'.$option['class'].'"';
						}
						?>
							value="<?php echo($option['id']);?>"><?php echo $option['name']; ?></option>
						<?php

					}
				}
				echo '</select>';
				break;
				case 'multiple-text':
				foreach ($meta_box['elements'] as $el) {
					$el_value = get_post_meta($post->ID, $el['name'].'_value', true);
					if($el_value == "")
					$el_value = $el['std'];
					echo $el['title'].' <input type="text" name="'.$el['name'].'_value" value="'.$el_value.'" id="'.$el['name'].'" class="option-input small-input"/>';
				}

				if($meta_box['class']=='layout'){
					echo '<div id="item-layout"></div>
					<script type="text/javascript">
						jQuery(document).ready(function($){
							pexetoPageOptions.imageLayoutSelector($("#item-layout"), $("#'.$meta_box['elements'][0]["name"].'"), $("#'.$meta_box['elements'][1]["name"].'"));
						});
					</script>
					';
				}
				
				break;
		}


		if($meta_box['type']!='heading'){
			echo'<span class="option-description">';
			if(isset($meta_box['description'])){
				echo $meta_box['description'];
			}
			echo '</span></div>';
			if(strstr($box_class,'last')){
				echo '<div class="clear"></div>';
			}
		}
	}
}


/**
 * Saves the meta box content of the post
 * @param $post_id the ID of the page that contains the meta box
 */
if(!function_exists("pexeto_save_postdata")){
	function pexeto_save_postdata( $post_id ) {
		global $post;
		if(isset($post)){
			$post_type = $post->post_type;
			$meta_boxes = pexeto_get_posttype_meta_boxes($post_type);

			if($meta_boxes!=null){
				pexeto_save_meta_data($meta_boxes, $post_id);
			}
		}
	}
}

/**
 * Saves the post meta for all types of posts.
 * @param $new_meta_boxes the meta data array
 * @param $post_id the ID of the post
 */
if(!function_exists("pexeto_save_meta_data")){
	function pexeto_save_meta_data($new_meta_boxes, $post_id){
		foreach($new_meta_boxes as $meta_box) {

			if($meta_box['type']!='heading'){
				// Verify
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
					return $post_id;
				}

				if ( 'page' == $_POST['post_type'] ) {
					if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
				} else {
					if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
				}

				$meta_name = $meta_box['name'].'_value';
				$data = isset($_POST[$meta_box['name'].'_value']) ? $_POST[$meta_box['name'].'_value'] : null;

				if($meta_box['type']!='multiple-text'){
					pexeto_update_single_meta($post_id, $meta_name, $data);
				}elseif(isset($meta_box['elements'])){
					foreach ($meta_box['elements'] as $el) {
						pexeto_update_single_meta($post_id, $el['name'].'_value', $_POST[$el['name'].'_value']);
					}
				}
				
			}
		}
	}
}

if(!function_exists("pexeto_update_single_meta")){
	function pexeto_update_single_meta($post_id, $meta_name, $data){
		if(get_post_meta($post_id, $meta_name) == "")
		add_post_meta($post_id, $meta_name, $data, true);
		elseif($data != get_post_meta($post_id, $meta_name, true))
		update_post_meta($post_id, $meta_name, $data);
		elseif($data == "")
		delete_post_meta($post_id, $meta_name, get_post_meta($post_id, $meta_name, true));
	}
}

/* ------------------------------------------------------------------------*
 * HELPER META FUNCTIONS
 * ------------------------------------------------------------------------*/

/**
 * Returns the default value of a meta box.
 * @param $meta_array the array of meta boxes to search within
 * @param $name the name (ID) of the meta box
 */
if(!function_exists("pexeto_get_meta_std_value")){
	function pexeto_get_meta_std_value($meta_array, $name){
		foreach($meta_array as $meta_item){
			if(isset($meta_item["name"]) && $meta_item["name"]==$name){
				return $meta_item["std"];
			}
		}
		return '';
	}
}

/**
 * Returns the saved meta data for a page of each of the given keys.
 * @param int $page_id the ID of the page to retrieve the meta data
 * @param array $keys an array containing all the keys whose values will be retrieved
 */
if(!function_exists("pexeto_get_post_meta")){
	function pexeto_get_post_meta($page_id, $keys){
		global $new_meta_boxes;
		
		$res=array();
		foreach($keys as $key){
			$meta=get_post_meta($page_id, $key.'_value', true);
			if($meta!=''){
				$res[$key]=$meta;
			}else{
				//if the value is not saved, get the default value from the array
				$res[$key]=pexeto_get_meta_std_value($new_meta_boxes, $key);
			}
		}
		return $res;
	}
}
