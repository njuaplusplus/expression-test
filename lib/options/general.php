<?php

$sociable_icons=array('', 'facebook.png', 'twitter.png', 'googleplus.png', 'rss.png', 'pinterest.png','flickr.png', 'delicious.png', 'skype.png', 'youtube.png', 'vimeo.png', 'blogger.png', 'linkedin.png', 'myspace.png', 'reddit.png', 'dribbble.png', 'forrst.png', 'deviant-art.png', 'digg.png', 'github.png', 'lastfm.png', 'sharethis.png', 'stumbleupon.png', 'tumblr.png', 'wordpress.png', 'yahoo.png', 'amazon.png', 'apple.png', 'bing.png', '500px.png', 'instagram.png');
foreach($sociable_icons as $key=>$value){
	$sociable_icons[$key]=PEXETO_FRONT_IMAGES_URL.'icons/'.$value;
}

$pexeto_general_options= array( array(
"name" => "常规设置",
"type" => "title",
"img" => PEXETO_IMAGES_URL."icon_general.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"main", "name"=>"主要设置"), array("id"=>"sidebars", "name"=>"边栏"), array("id"=>"sociable", "name"=>"社交图标"), array("id"=>"seo", "name"=>"SEO"))
),

/* ------------------------------------------------------------------------*
 * MAIN SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'main'
),

array(
"name" => "网站图标 URL",
"id" => PEXETO_SHORTNAME."_favicon",
"type" => "upload",
"desc" => "上传网站图标 - 扩展名为 .ico."
),

array(
"name" => "显示页面标题",
"id" => PEXETO_SHORTNAME."_show_page_title",
"type" => "checkbox",
"std" => 'on',
"desc" => '如果选择 "ON", 页面标题会作为主标题显示在页面上. '
),

array(
"name" => "显示页面评论",
"id" => PEXETO_SHORTNAME."_page_comments",
"type" => "checkbox",
"std" => 'off',
"desc" => 'By default comments won\'t be displayed on pages, but if you turn this option ON, you will be able
to enable/disable comments for the separate pages in the "Allow comments" field of the page.<br />
Note: This option is available for the Default Page Template only'
),

array(
"name" => "显示单个作品文章评论",
"id" => PEXETO_SHORTNAME."_portfolio_comments",
"type" => "checkbox",
"std" =>'off'
),

array(
"name" => "禁止鼠标右键",
"id" => PEXETO_SHORTNAME."_disable_click",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If "ON" selected, right click will be disabled for the theme in order to add copyright protection to images.
If you insert a text in the "Message on right click" field below, this message will be alerted.'
),

array(
"name" => "鼠标右键提示信息",
"id" => PEXETO_SHORTNAME."_click_message",
"type" => "textarea",
"desc" => "This is the message that is displayed when the mouse right click is disabled. If you leave the field empty, no message will be alerted."
),


array(
"name" => "Google Analytics Code",
"id" => PEXETO_SHORTNAME."_analytics",
"type" => "textarea",
"desc" => "You can paste your generated Google Analytics here and it will be automatically set to the theme."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SIDEBARS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'sidebars'
),

array(
"name"=>"添加边栏",
"id"=>'sidebars',
"type"=>"custom",
"button_text"=>'添加边栏',
"fields"=>array(
	array('id'=>'_sidebar_name', 'type'=>'text', 'name'=>'边栏名')
),
"desc"=>"You can add as many custom sidebars you like and after that for each page you will be
able to assign a different sidebar."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SOCIABLE ICONS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'sociable'
),

array(
"name" => "显示社交图标",
"id" => PEXETO_SHORTNAME."_show_footer_icons",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, a sociable icons section will be displayed in the header. You can add sociable icons in the 
"Add a sociable icon" section below.'
),


array(
"name"=>"添加社交图标",
"id"=>'sociable_icons',
"type"=>"custom",
"button_text"=>'添加图标',
"preview"=>'_icon_url',
"fields"=>array(
array('id'=>'_icon_url', 'type'=>'imageselect', 'name'=>'Select Icon','options'=>$sociable_icons),
	array('id'=>'_icon_link', 'type'=>'text', 'name'=>'社交图标链接'),
	array('id'=>'_icon_title', 'type'=>'text', 'name'=>'悬浮提示 (可选)')
)
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SEO
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'seo'
),

array(
"name" => "网站关键字",
"id" => PEXETO_SHORTNAME."_seo_keywords",
"type" => "text",
"desc" => '描述你网站的主要关键字 (请使用英文!), 用 "英文逗号" 隔开. 例如:<br />
<i>photography,design,art</i>'
),

array(
"name" => "主页说明",
"id" => PEXETO_SHORTNAME."_seo_description",
"type" => "textarea",
"desc" => "By default the Tagline set in <b>Settings &raquo; General</b> will be displayed as a description of the site. Here
you can set a description that will be displayed on your home page only."
),

array(
"name" => "主页标题",
"id" => PEXETO_SHORTNAME."_seo_home_title",
"type" => "text",
"desc" => 'This is the home page document title. By default the blog name is displayed and if you insert a title here,
it will be prepended to the blog name'
),

array(
"name" => "页面标题分隔符",
"id" => PEXETO_SHORTNAME."_seo_serapartor",
"type" => "text",
"std" => '@',
"desc" => 'Separates the different title parts'
),

array(
"name" => "浏览分类页面标题",
"id" => PEXETO_SHORTNAME."_seo_category_title",
"type" => "text",
"std" => 'Category &raquo; ',
"desc" => 'This is the page title that is set to the document when browsing a category - the title is built by the
text entered here, the name of the category and the name of the blog - for example:<br /><i>Category &raquo; Business &laquo; @  Blog name</i>'
),

array(
"name" => "浏览标签页面标题",
"id" => PEXETO_SHORTNAME."_seo_tag_title",
"type" => "text",
"std" => 'Tag &raquo; ',
"desc" => 'This is the page title that is set to the document when browsing a tag - the title is built by the
text entered here, the name of the tag and the name of the blog - for example:<br /><i>Tag &raquo; business &laquo; @  Blog name</i>'
),

array(
"name" => "搜索页面标题",
"id" => PEXETO_SHORTNAME."_search_tag_title",
"type" => "text",
"std" => 'Search results &raquo; ',
"desc" => 'This is the page title that is set to the document when displaying search results - the title is built by the
text entered here, the search query and the name of the blog - for example:<br /><i>Search results &raquo;  business &laquo; @  Blog name</i>'
),

array(
"name" => "排除一下页面索引",
"id" => PEXETO_SHORTNAME."_seo_indexation",
"type" => "multicheck",
"options" => array(array('id'=>'category', 'name'=>'Category Archive'), array('id'=>'date', 'name'=>'Date Archive'), array('id'=>'tag', 'name'=>'Tag Archive'), array('id'=>'author', 'name'=>'Author Archive'), array('id'=>'search', 'name'=>'Search Results')),
"class"=>"exclude",
"desc" => 'Pages, such as archives pages, display some duplicate content - for example, the same post can be found on your main Blog
page, but also in a category archive, date archive, etc. Some search engines are reported to penalize sites associated with too much duplicate
content. Therefore, excluding the pages from this option will remove the search engine indexiation by adding "noindex" and
"nofollow" meta tags which would prevent the search engines to index this duplicate content. By default, all the pages are indexed. '),

array(
"type" => "close"),

array(
"type" => "close"));

pexeto_add_options($pexeto_general_options);