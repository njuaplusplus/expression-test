<?php


/**
 * Load the patterns into arrays.
 */
$patterns=array();
$patterns[0]='none';
for($i=1; $i<=34; $i++){
	$patterns[]='pattern'.$i.'.png';
}



$pexeto_styles_options=array(array(
"name" => "Style settings",
"type" => "title",
"img" => PEXETO_IMAGES_URL.'icon_style.png'
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"General"), array("id"=>"logo", "name"=>"Logo"), array("id"=>"bg", "name"=>"Background Options"), array("id"=>"text", "name"=>"Text Styles"), array("id"=>"fonts", "name"=>"Fonts"))
),

/* ------------------------------------------------------------------------*
 * GENERAL
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'general'
),

array(
"name" => "Predefined Background Colors",
"id" => PEXETO_SHORTNAME."_body_bg",
"type" => "stylecolor",
"options" => array("","4A4A4A","62786e","83988e","919999","556270","6a9199","b0b0b0","70B0A0","9ab895","99b2b7","257ea8","547980","5e8c6a","574951","9d5c56","8c778f","b38184"),
"std" => '',
"desc" => 'You can either select a predefined background color or pick your custom color below. If the first option
is selected, the background color will be set as the default background of the skin selected.'
),

array(
"name" => "Custom Background Color",
"id" => PEXETO_SHORTNAME."_custom_body_bg",
"type" => "color",
"desc" => 'You can select a custom background color for your theme. This field has priority over the "Predefined Background Colors" field above. '
),

array(
"name" => "Background Pattern",
"id" => PEXETO_SHORTNAME."_pattern",
"type" => "pattern",
"options" => $patterns,
"desc" => 'Here you can choose the pattern for the theme. There are 2 types of patterns - the first 17 patterns best suit
light backgrounds, the rest of them best suit darker backgrounds.'
),

array(
"name" => "Custom Background Pattern",
"id" => PEXETO_SHORTNAME."_custom_pattern",
"type" => "upload",
"desc" => 'You can upload your custom background image here.'
),

array(
"name" => "Full Width Background Image",
"id" => PEXETO_SHORTNAME."_fullwidth_bg_image",
"type" => "upload",
"desc" => 'You can upload a custom background image that will be displayed in full width size.'
),

array(
"name" => "Overlay pattern on fullscreen images",
"id" => PEXETO_SHORTNAME."_bg_top_pattern",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, a transparent overlay pattern will be displayed over the fullscreen background image and the images on the fullscreen slideshow.'
),

array(
"name" => "Main body text size",
"id" => PEXETO_SHORTNAME."_body_text_size",
"type" => "text",
"desc" => "The main body font size in pixels. Default: 13"
),

array(
"name" => "Additional CSS styles",
"id" => PEXETO_SHORTNAME."_additional_styles",
"type" => "textarea",
"desc" => "You can insert some more additional CSS code here. If you would like to do some modifications to the theme's CSS, it is better to insert the modifications in this field rather than modifying the original style.css file, as the modifications in this field will remain saved trough the theme updates."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * LOGO OPTIONS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'logo'
),

array(
"name" => "Logo image",
"id" => PEXETO_SHORTNAME."_logo_image",
"type" => "upload",
"desc" => "If you wouldn't like to use the uploader: if the image is located within the images folder you can just insert images/image-name.jpg, otherwise
you have to insert the full URL of the image, for example: http://site.com/image-name.jpg"
),


array(
"name" => "Retina display logo image",
"id" => PEXETO_SHORTNAME."_retina_logo_image",
"type" => "upload",
"desc" => "You can set a custom logo image for retina displays. The image size for retina displays should be twice the size of the regular logo - for example if the standard logo
image size is 30x70 pixels, the size of the retina display logo image should be 60x140 pixels. If you don't set an image in this field, the image set in the \"Logo Image\" field above will be used."
),


array(
"name" => "Logo image width",
"id" => PEXETO_SHORTNAME."_logo_width",
"type" => "text",
"desc" => "The logo image width in pixels- default:143"
),


array(
"name" => "Logo image height",
"id" => PEXETO_SHORTNAME."_logo_height",
"type" => "text",
"desc" => "The logo image height in pixels- default:28"
),

array(
"name" => "Display site tagline next to logo",
"id" => PEXETO_SHORTNAME."_display_tagline",
"type" => "checkbox",
"std" => 'on',
"desc" => 'You can set the Tagline in Settings &raquo; General &raquo; Tagline'
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * BACKGROUND OPTIONS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'bg',
),

array(
"name" => "Header background",
"id" => PEXETO_SHORTNAME."_header_bg_color",
"type" => "color"
),

array(
"name" => "Footer background",
"id" => PEXETO_SHORTNAME."_footer_bg_color",
"type" => "color"
),

array(
"name" => "Content background color",
"id" => PEXETO_SHORTNAME."_content_bg",
"type" => "color",
"desc" => "The background of the main content area."
),

array(
"name" => "Elements color",
"id" => PEXETO_SHORTNAME."_elements_color",
"type" => "color",
"desc" => 'This is the color of the small detailed elements such as buttons, highlight table elements, image number on item hover, etc.'
),

array(
"name" => "Secondary color",
"id" => PEXETO_SHORTNAME."_secondary_color",
"type" => "color",
"desc" => 'This is the secondary content color, used in widgets (tabs, accordion), hover in sidebar, comments section, etc.'
),

array(
"name" => "Drop-down menu hover color",
"id" => PEXETO_SHORTNAME."_dropdown_color",
"type" => "color"
),

array(
"name" => "Lines and borders color",
"id" => PEXETO_SHORTNAME."_border_color",
"type" => "color"
),



array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * TEXT STYLES
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'text',
),

array(
"name" => "Main body text color",
"id" => PEXETO_SHORTNAME."_body_color",
"type" => "color",
"desc" => "This setting will change the main content and sidebar text color."
),

array(
"name" => "Headings color",
"id" => PEXETO_SHORTNAME."_heading_color",
"type" => "color"
),

array(
"name" => "Links color",
"id" => PEXETO_SHORTNAME."_link_color",
"type" => "color"
),


array(
"name" => "Menu links color",
"id" => PEXETO_SHORTNAME."_menu_link_color",
"type" => "color"
),

array(
"name" => "Footer text color",
"id" => PEXETO_SHORTNAME."_footer_text_color",
"type" => "color"
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * FONTS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'fonts'
),

array(
"type" => "documentation",
"text" => "<h3>Google API Fonts</h3>"
),

array(
"name" => "Enable Google Fonts",
"id" => PEXETO_SHORTNAME."_enable_google_fonts",
"type" => "checkbox",
"std" =>"on"
),

array(
"name"=>"Add Google Font",
"id"=>'google_fonts',
"type"=>"custom",
"button_text"=>'Add Font',
"fields"=>array(
	array('id'=>'pex_google_fonts_name', 'type'=>'textarea', 'name'=>'Font URL',"std"=>PEXETO_GOOGLE_FONTS)
),
"desc"=>"In this field you can add or remove Google Fonts to the theme. Please note that only the font
URL should be inserted here (the value that is set within the 'href' attribute of the embed link tag Google provides), not the whole embed link tag.
<b>Example:</b><br />
http://fonts.googleapis.com/css?family=Lato<br />
<br />In order to enable the new font for the theme, simply add its name before the other font names in the Font Family fields below."

),

array(
"type" => "documentation",
"text" => "<h3>Font Family</h3>"
),

array(
"name" => "Headings font family",
"id" => PEXETO_SHORTNAME."_heading_font_family",
"type" => "textarea",
"std" => '"PT Sans", Verdana, Geneva, sans-serif',
"desc" => 'You can change the font family for the theme headings in this field. If you have loaded a Google API font,
you can insert its name here. 
<br />Notes:
<br />1. If the font name contains an empty space, you have to surround its name with a quotation marks, for example: "Times New Roman"
<br />2. If Cufon font replacement is enabled below, the Cufon font selected will have higher priority than the fonts set in here
<br />3. The different font names should be separated by commas'
),

array(
"name" => "Body font family",
"id" => PEXETO_SHORTNAME."_body_font_family",
"type" => "textarea",
"std" => '"PT Sans", Verdana, Geneva, sans-serif',
"desc" => 'You can change the main body font family for the theme in this field. If you have loaded a Google API font,
you can insert its name here. 
<br />Notes:
<br />1. If the font name contains an empty space, you have to surround its name with a quotation marks, for example: "Times New Roman"
<br />2. The different font names should be separated by commas'
),


array(
"type" => "documentation",
"text" => "<h3>Cufon Fonts</h3>"
),

array(
"name" => "Enable Cufon for headings",
"id" => PEXETO_SHORTNAME."_enable_cufon",
"type" => "checkbox",
"std" =>"off",
"desc" => "If it is enabled, you will be able to use another custom fonts for the headings. You will be able to
either select one of the default fonts that the theme comes with or upload your own font below."
),

array(
"name" => "Heading Cufon Font",
"id" => PEXETO_SHORTNAME."_cufon_font",
"type" => "select",
"options" => array(array('id'=>'andika.js','name'=>'Andika Basic'),array('id'=>'caviar_dreams.js','name'=>'Caviar Dreams'),array('id'=>'charis_sil.js','name'=>'Charis'),array('id'=>'chunk_five.js','name'=>'Chunk Five'),array('id'=>'comfortaa.js','name'=>'Comfortaa'),array('id'=>'droid_serif.js','name'=>'Droid Serif'), array('id'=>'kingthings_exeter.js','name'=>'Kingthings Exeter'), array('id'=>'luxy_sans.js','name'=>'Luxy Sans'), array('id'=>'sling.js','name'=>'Sling'), array('id'=>'vegur.js','name'=>'Vegur')),
"desc" => 'You can select one of the fonts that the theme goes with. In order the font to replace the default one
the "Enable Cufon" field above should be enabled.'
),

array(
"name" => "Custom Heading Font",
"id" => PEXETO_SHORTNAME."_custom_cufon_font",
"type" => "upload",
"desc" => 'You can upload your custom JavaScript font file here. You can generate the font here: http://cufon.shoqolate.com/generate/'
),


array(
"type" => "close"),


array(
"type" => "close"));


pexeto_add_options($pexeto_styles_options);