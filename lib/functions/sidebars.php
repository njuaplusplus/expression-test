<?php
/**
 * This file contains the sidebars functionality.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action('init', 'pexeto_load_sidebar_names');
add_action('init', 'pexeto_register_all_sidebars' );   

//allow shortcodes in sidebar widgets
add_filter('widget_text', 'do_shortcode');


/**
 * Loads all the existing sidebars to be registered into the global
 * manager object.
 */
if(!function_exists("pexeto_load_sidebar_names")){
	function pexeto_load_sidebar_names(){
		global $pexeto_data;
		
		//there always should be one default sidebar
		$pexeto_sidebars=array(array('name'=>'Default Sidebar', 'id'=>'default'));

		//get the sidebar names that have been saved as option
		$sidebar_strings=get_option('_sidebar_names');
		$generated_sidebars=explode(PEXETO_SEPARATOR, $sidebar_strings);
		array_pop($generated_sidebars);
		$pexeto_generated_sidebars=array();

		//add the generated sidebars to the default ones
		foreach($generated_sidebars as $sidebar){
			$pexeto_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
			$pexeto_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
		}

		//set the main sidebars to the global manager object
		$pexeto_data->pexeto_sidebars=$pexeto_sidebars;
	}
}


/**
 * Registers all the sidebars that have been created.
 */
if(!function_exists("pexeto_register_all_sidebars")){
	function pexeto_register_all_sidebars(){
		global $pexeto_data;

		$pexeto_sidebars=$pexeto_data->pexeto_sidebars;
		
		//register all the sidebars
		if (function_exists('register_sidebar')){

			//register the sidebars
			foreach($pexeto_sidebars as $sidebar){
				pexeto_register_sidebar($sidebar['name'], $sidebar['id']);
			}

		}
	}
}



/**
 * Registers a sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
if(!function_exists("pexeto_register_sidebar")){
	function pexeto_register_sidebar($name, $id){
		register_sidebar(array('name'=>$name,
			'id' => $id,
	        'before_widget' => '<div class="sidebar-box %2$s" id="%1$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4><div class="double-line"></div>',
		));
	}
}

/**
 * Prints a sidebar.
 * @param $name the name of the sidebar to print
 */
if(!function_exists("print_sidebar")){
	function print_sidebar($name){
		?>
		<div id="sidebar">
			<?php   
			if ( function_exists('dynamic_sidebar')) { 
			dynamic_sidebar($name);  
			}?>
		</div>
	<?php
	}
}


/**
 * Converts a name that consists of more words and different characters to a class (id).
 * @param $name the name to convert
 */
if(!function_exists("convert_to_class")){
	function convert_to_class($name){
		return strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
	}
}

