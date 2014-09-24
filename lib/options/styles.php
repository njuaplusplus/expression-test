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
"name" => "样式设置",
"type" => "title",
"img" => PEXETO_IMAGES_URL.'icon_style.png'
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"general", "name"=>"常规"), array("id"=>"logo", "name"=>"Logo"), array("id"=>"bg", "name"=>"背景选项"), array("id"=>"text", "name"=>"文字样式"), array("id"=>"fonts", "name"=>"字体"))
),

/* ------------------------------------------------------------------------*
 * GENERAL
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id" => 'general'
),

array(
"name" => "预定义背景色",
"id" => PEXETO_SHORTNAME."_body_bg",
"type" => "stylecolor",
"options" => array("","4A4A4A","62786e","83988e","919999","556270","6a9199","b0b0b0","70B0A0","9ab895","99b2b7","257ea8","547980","5e8c6a","574951","9d5c56","8c778f","b38184"),
"std" => '',
"desc" => '你可以选择预定义的颜色, 或者在下面指定你自己的颜色. 如果你选择预定义中的第一项, 那么背景色将会与主题颜色一致.'
),

array(
"name" => "自定义背景色",
"id" => PEXETO_SHORTNAME."_custom_body_bg",
"type" => "color",
"desc" => '你可以自定义你主题的背景色. 这个值优先于上面的预定义背景色. '
),

array(
"name" => "背景图案",
"id" => PEXETO_SHORTNAME."_pattern",
"type" => "pattern",
"options" => $patterns,
"desc" => '你可以选择你的背景图案. 这里有两类图案 - 前 17 个图案 适合浅色背景, 其他的适合深色背景.'
),

array(
"name" => "自定义背景图案",
"id" => PEXETO_SHORTNAME."_custom_pattern",
"type" => "upload",
"desc" => '你可以上传自定义的背景图案.'
),

array(
"name" => "全宽背景图片",
"id" => PEXETO_SHORTNAME."_fullwidth_bg_image",
"type" => "upload",
"desc" => '你可以上传一张图片, 来作为全宽的背景.'
),

array(
"name" => "在全屏图片上显示图案",
"id" => PEXETO_SHORTNAME."_bg_top_pattern",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, a transparent overlay pattern will be displayed over the fullscreen background image and the images on the fullscreen slideshow.'
),

array(
"name" => "正文字体大小",
"id" => PEXETO_SHORTNAME."_body_text_size",
"type" => "text",
"desc" => "正文字体大小, 单位为像素. 默认: 13"
),

array(
"name" => "额外的 CSS 样式",
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
"name" => "Logo 图像",
"id" => PEXETO_SHORTNAME."_logo_image",
"type" => "upload",
"desc" => "你的团队 Logo 例如 TEAM-S, 不是网站图标"
),


array(
"name" => "视网膜屏幕的 logo 图像",
"id" => PEXETO_SHORTNAME."_retina_logo_image",
"type" => "upload",
"desc" => "针对苹果设备视网膜屏幕的 logo, 尺寸为上面 logo 图像的 4 倍. 例如上面图片尺寸为 143 x 28, 则这里的尺寸为 286 x 56."
),


array(
"name" => "Logo 图像宽度",
"id" => PEXETO_SHORTNAME."_logo_width",
"type" => "text",
"desc" => "Logo 图像宽度, 单位为像素 - 默认:143"
),


array(
"name" => "Logo 图像高度",
"id" => PEXETO_SHORTNAME."_logo_height",
"type" => "text",
"desc" => "Logo 图像高度, 单位像素 - 默认:28"
),

array(
"name" => "在 logo 旁显示副标题",
"id" => PEXETO_SHORTNAME."_display_tagline",
"type" => "checkbox",
"std" => 'on',
"desc" => '你可以说在 设置 &raquo; 常规 &raquo; 副标题 中设置你的副标题'
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
http://fonts.useso.com/css?family=Lato<br />
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