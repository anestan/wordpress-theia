<?php
if (!class_exists('VC_Extensions_InfoBlock')) {
    class VC_Extensions_InfoBlock{
        function __construct() {
            vc_map(array(
            "name" => __("Info Block", 'cq_allinone_vc'),
            "base" => "cq_vc_infoblock",
            "class" => "cq_vc_infoblock",
            // "as_parent" => array('only' => 'cq_vc_infoblock_item'),
            "icon" => "cq_vc_infoblock",
            "category" => __('Sike Extensions', 'js_composer'),
            // "content_element" => false,
            // "show_settings_on_create" => false,
            'description' => __('Image, text and button', 'js_composer'),
            "params" => array(
              array(
                "type" => "attach_image",
                "heading" => __("Image:", "cq_allinone_vc"),
                "param_name" => "image",
                "value" => "",
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Resize the image?", "cq_allinone_vc"),
                "param_name" => "isresize",
                "value" => array("no", "yes (specify the image width below)"=>"yes"),
                "std" => "no",
                "description" => __("Choose to resize the image or not, useful if your original image is too large.", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Resize image to this width", "cq_allinone_vc"),
                "param_name" => "imagewidth",
                "value" => "",
                "dependency" => Array('element' => "isresize", 'value' => array('yes')),
                "description" => __("Default we will use the original image, specify a width. For example, 200 will resize the image to width 200. ", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("How to display the icon:", "cq_allinone_vc"),
                "param_name" => "iconstyle",
                "value" => array('As Bar' => 'asbar', 'Float' => 'float'),
                'std' => 'float',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content background color", 'cq_allinone_vc'),
                "param_name" => "bgcolor",
                "value" => "rgba(0, 0, 0, 0.5)",
                "description" => __("Customize header background color.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Content hover background color", 'cq_allinone_vc'),
                "param_name" => "bghovercolor",
                "value" => "",
                "description" => __("Customize bar background color.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Custom bar background color", 'cq_allinone_vc'),
                "param_name" => "barbgcolor",
                "dependency" => Array('element' => 'iconstyle', 'value' => 'asbar'),
                "value" => "",
                "description" => __("Customize bar background color.", 'cq_allinone_vc')
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Bar hover background color", 'cq_allinone_vc'),
                "dependency" => Array('element' => 'iconstyle', 'value' => 'asbar'),
                "param_name" => "barhoverbg",
                "value" => "",
                "description" => __("Customize bar background color.", 'cq_allinone_vc')
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Whole element shape", "cq_allinone_vc"),
                "param_name" => "elementshape",
                "value" => array('Square' => 'square', 'Rounded' => 'rounded', 'Round' => 'round'),
                'std' => 'square',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "heading" => __("Title over the image (optional)", "cq_allinone_vc"),
                "param_name" => "title",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Title font size", "cq_allinone_vc"),
                "param_name" => "titlesize",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is 1.5em. You can customize it with other value, like <strong>14px</strong> or <strong>1.2em</strong> etc.", "cq_allinone_vc")
              ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title color", 'cq_allinone_vc'),
                "param_name" => "titlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is white.", 'cq_allinone_vc')
             ),
              array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title background color", 'cq_allinone_vc'),
                "param_name" => "titlebgcolor",
                "value" => "",
                "group" => "Text",
                "description" => __("Default is light gray.", 'cq_allinone_vc')
             ),
              array(
                "type" => "textfield",
                "heading" => __("Sub title above the title (optional)", "cq_allinone_vc"),
                "param_name" => "subtitle",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
             array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Font size for the sub title", "cq_allinone_vc"),
                "param_name" => "subtitlesize",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),

             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("sub title color", 'cq_allinone_vc'),
                "param_name" => "subtitlecolor",
                "value" => "",
                "group" => "Text",
                "description" => __("", 'cq_allinone_vc')
            ),

            array(
                "type" => "textfield",
                "heading" => __("Sub label in the bar (optional)", "cq_allinone_vc"),
                "param_name" => "sublabel",
                "value" => "",
                "group" => "Text",
                "dependency" => Array("element" => "iconstyle", "value" => "asbar"),
                "description" => __("", "cq_allinone_vc")
              ),
             array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Font size for the sub label", "cq_allinone_vc"),
                "param_name" => "sublabelsize",
                "value" => "",
                "group" => "Text",
                "dependency" => Array("element" => "iconstyle", "value" => "asbar"),
                "description" => __("", "cq_allinone_vc")
              ),
             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sub label color", 'cq_allinone_vc'),
                "param_name" => "sublabelcolor",
                "value" => "",
                "group" => "Text",
                "dependency" => Array("element" => "iconstyle", "value" => "asbar"),
                "description" => __("", 'cq_allinone_vc')
            ),

             array(
                "type" => "dropdown",
                "holder" => "",
                "heading" => __("Avatar type", "cq_allinone_vc"),
                "param_name" => "avatartype",
                "value" => array('Image' => 'image', 'Icon' => 'icon'),
                'std' => 'icon',
                "group" => "Avatar",
                "description" => __("", "cq_allinone_vc")
              ),
             array(
                "type" => "attach_image",
                "heading" => __("Avatar image", "cq_allinone_vc"),
                "param_name" => "avatarimage",
                "value" => "",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "description" => __("Select image from media library.", "cq_allinone_vc")
              ),
             array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Avatar position", "cq_allinone_vc"),
                "param_name" => "avatarpos",
                "value" => array('Left' => 'left', 'Right' => 'right'),
                'std' => 'right',
                "group" => "Avatar",
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Resize the avatar image?", "cq_allinone_vc"),
                "param_name" => "avatarwidth",
                "value" => "160",
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('image')),
                "description" => __('The avatar will be displayed in circle. Default will be resized to be 160 (in pixel).', "cq_allinone_vc")
              ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library (optional icon before label)', 'js_composer' ),
                'value' => array(
                  __( 'Entypo', 'js_composer' ) => 'entypo',
                  __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                  __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                  __( 'Typicons', 'js_composer' ) => 'typicons',
                  __( 'Linecons', 'js_composer' ) => 'linecons',
                  __( 'Material', 'js_composer' ) => 'material',
                  // __( 'Mono Social', 'js_composer' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'captionicon',
                "group" => "Avatar",
                "dependency" => Array('element' => "avatartype", 'value' => array('icon')),
                'description' => __( 'Select icon library.', 'js_composer' ),
              ),
             array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon for the label (optional)', 'js_composer' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-user', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => true, // default true, display an "EMPTY" icon?
                  'type' => 'fontawesome',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'fontawesome',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
             array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'openiconic',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'openiconic',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'typicons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'typicons',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-user', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'entypo',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                "group" => "Avatar",
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'entypo',
                ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false, // default true, display an "EMPTY" icon?
                  'type' => 'linecons',
                  'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'linecons',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
              array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'js_composer' ),
                'param_name' => 'icon_material',
                'value' => 'vc-material vc-material-cake',
                // default value to backend editor admin_label
                'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'type' => 'material',
                  'iconsPerPage' => 4000,
                  // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                  'element' => 'captionicon',
                  'value' => 'material',
                ),
                "group" => "Avatar",
                'description' => __( 'Select icon from library.', 'js_composer' ),
              ),
            array(
                "type" => "vc_link",
                "heading" => __( "Link for the avatar (optional)", "cq_allinone_vc" ),
                "param_name" => "avatarlink",
                "group" => "Avatar",
                "description" => __( "", "cq_allinone_vc" )
              ),
            array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Avatar Background color", 'cq_allinone_vc'),
                "param_name" => "iconbg",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Background color for the avatar.", 'cq_allinone_vc')
              ),
            array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Avatar size:", "cq_allinone_vc"),
                "param_name" => "avatarsize",
                "value" => array("small", "medium", "large"),
                "std" => "medium",
                "group" => "Avatar",
                "description" => __("Choose to avatar size.", "cq_allinone_vc")
              ),
             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon color", 'cq_allinone_vc'),
                "param_name" => "iconcolor",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Color for the avatar icon.", 'cq_allinone_vc')
              ),
             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon hover color", 'cq_allinone_vc'),
                "param_name" => "iconhovercolor",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Color for icon when hover.", 'cq_allinone_vc')
              ),
             array(
                "type" => "colorpicker",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "div",
                "class" => "",
                "heading" => __("Icon hover background color", 'cq_allinone_vc'),
                "param_name" => "iconhoverbg",
                "value" => "",
                "group" => "Avatar",
                "description" => __("Background color for icon when hover.", 'cq_allinone_vc')
              ),
            array(
                "type" => "textarea_html",
                "heading" => __("Content", "cq_allinone_vc"),
                "param_name" => "content",
                "value" => "",
                "group" => "Text",
                "description" => __("", "cq_allinone_vc")
              ),
            array(
                "type" => "textfield",
                "heading" => __("Button text", "cq_allinone_vc"),
                "param_name" => "buttontext",
                "value" => "",
                'group' => 'Button',
                "description" => __("Optional button under the title and description.", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Button color", "cq_allinone_vc"),
                 "param_name" => "buttoncolor",
                 "value" => array('Blue' => 'blue', 'Turquoise' => 'turquoise', 'Pink' => 'pink', 'Violet' => 'violet', 'Peacoc' => 'peacoc', 'Chino' => 'chino', 'Vista Blue' => 'vista_blue', 'Black' => 'black', 'Grey' => 'grey', 'Orange' => 'orange', 'Sky' => 'sky', 'Green' => 'green', 'Sandy brown' => 'sandy_brown', 'Purple' => 'purple', 'White' => 'white'),
                'std' => 'blue',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                 "type" => "dropdown",
                 "edit_field_class" => "vc_col-xs-6 vc_column",
                 "holder" => "",
                 "heading" => __("Button size", "cq_allinone_vc"),
                 "param_name" => "buttonsize",
                 "value" => array('Mini' => 'xs', 'Small' => 'sm', 'Large' => 'lg'),
                 'std' => 'xs',
                 'group' => 'Button',
                 "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Button shape", "cq_allinone_vc"),
                "param_name" => "buttonshape",
                "value" => array('Rounded' => 'rounded', 'Square' => 'square', 'Round' => 'round'),
                'std' => 'rounded',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "dropdown",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "holder" => "",
                "heading" => __("Button alignment", "cq_allinone_vc"),
                "param_name" => "align",
                "value" => array('Inline' => 'inline', 'Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
                'std' => 'center',
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
              array(
                "type" => "vc_link",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("URL (Optional link for the button)", "cq_allinone_vc"),
                "param_name" => "buttonlink",
                "value" => "",
                'group' => 'Button',
                "description" => __("", "cq_allinone_vc")
              ),
             array(
                "type" => "textfield",
                "edit_field_class" => "vc_col-xs-6 vc_column",
                "heading" => __("Extra class name", "cq_allinone_vc"),
                "param_name" => "extraclass",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "cq_allinone_vc")
              ),
             array(
                "type" => "css_editor",
                "heading" => __( "CSS", "cq_allinone_vc" ),
                "param_name" => "css",
                "description" => __("It's recommended to use this to customize the padding/margin only.", "cq_allinone_vc"),
                "group" => __( "Design options", "cq_allinone_vc" ),
             )


           )
        ));

        add_shortcode('cq_vc_infoblock', array($this,'cq_vc_infoblock_func'));

      }

      function cq_vc_infoblock_func($atts, $content=null, $tag) {
          $image = $imagewidth = $align = $title = $subtitle = $isdisplay = $titlecolor = $titlesize = $avatarlink = $elementshape = $captionicon = $subtitlesize = $subtitlecolor = $titlebgcolor = $labelcolor = $avatarimage = $iconbg = $iconcolor = $avatarwidth = $avatarpos = $buttoncolor = $buttontext = $buttonshape = $buttonsize = $buttonlink = $iconstyle = $bgcolor = $barbgcolor = $bghovercolor = $barhoverbg = $iconhovercolor = $iconhoverbg = $avatarsize = $avatartype = $sublabel = $sublabelsize = $sublabelcolor = $css_class = $css = "";
          $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_pixelicons = $icon_material = '';
          extract(shortcode_atts(array(
            "avatarsize" => "medium",
            "avatartype" => "icon",
            "iconstyle" => "float",
            "image" => "",
            "avatarimage" => "",
            "iconbg" => "",
            "iconcolor" => "",
            "iconhovercolor" => "",
            "iconhoverbg" => "",
            "avatarwidth" => "",
            "avatarpos" => "right",
            "buttontext" => "",
            "buttoncolor" => "blue",
            "buttonsize" => "xs",
            "buttonshape" => "rounded",
            "buttonstyle" => "modern",
            "buttonlink" => "",
            "align" => "center",
            "bgcolor" => "",
            "bghovercolor" => "",
            "barbgcolor" => "",
            "barhoverbg" => "",
            "labelcolor" => "",
            "subtitlesize" => "",
            "subtitlecolor" => "",
            "sublabel" => "",
            "sublabelsize" => "",
            "sublabelcolor" => "",
            "titlebgcolor" => "",
            "imagewidth" => "",
            "titlecolor" => "",
            "avatarlink" => "",
            "titlesize" => "",
            "title" => "",
            "label" => "",
            "subtitle" => "",
            "elementshape" => "square",
            "captionicon" => "entypo",
            "icon_fontawesome" => 'fa fa-share',
            "icon_openiconic" => 'vc-oi vc-oi-dial',
            "icon_typicons" => 'typcn typcn-adjust-brightness',
            "icon_entypo" => 'entypo-icon entypo-icon-comment',
            "icon_linecons" => 'vc_li vc_li-heart',
            "icon_material" => 'vc-material vc-material-cake',
            "isresize" => "no",
            "isdisplay" => "",
            "bgheight" => "240", "contentcolor" => "",
            "captionoffset" => "",
            "captiontype" => "hideicon",
            "lightboxmargin" => "",
            "linktype" => "",
            "lightbox_url" => "",
            "videowidth" => "640",
            "css" => "",
            "extraclass" => ""
          ), $atts));


          $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ''), 'cq_vc_infoblock', $atts);


          $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

          $imagewidth = intval($imagewidth);
          $attachment = get_post($image);
          $imageurl = wp_get_attachment_image_src($image, 'full');
          $attachment = get_post($image);
          $resizedimage = $imageurl[0];
          if($imagewidth>0){
              if(function_exists('wpb_resize')){
                  $resizedimage = wpb_resize($image, null, $imagewidth, null);
                  $resizedimage = $resizedimage['url'];
                  if($resizedimage=="") $resizedimage = $imageurl[0];
              }
          }


        $avatarimagearr = wp_get_attachment_image_src(trim($avatarimage), 'full');
        $avatar_image_temp = $avatarimage_url = "";
        $avatar_full_image = $avatarimagearr[0];
        $avatarimage_url = $avatar_full_image;
        if($avatarwidth!=""){
            if(function_exists('wpb_resize')){
                $avatar_image_temp = wpb_resize($avatarimage, null, $avatarwidth*2, $avatarwidth*2, true);
                $avatarimage_url = $avatar_image_temp['url'];
                if($avatarimage_url=="") $avatarimage_url = $avatar_full_image;
            }
        }


          wp_register_style( 'vc-extensions-morecaption-style', plugins_url('css/style.css', __FILE__) );
          wp_enqueue_style( 'vc-extensions-morecaption-style' );


          wp_register_script('vc-extensions-morecaption-script', plugins_url('js/init.min.js', __FILE__), array("jquery"));
          wp_enqueue_script('vc-extensions-morecaption-script');

          $output = "";
          $text_str = "";
          $image_str = "";
          $style_str = "";

          vc_icon_element_fonts_enqueue('entypo');
          vc_icon_element_fonts_enqueue($captionicon);

          $avatarlink = vc_build_link($avatarlink);

          $output .= '<div class="cq-infoblock cq-infoblock-avapos-'.$avatarpos.' cq-infoblock-bar-'.$iconstyle.' cq-infoblock-avatar-'.$avatarsize.' cq-infoblock-shape-'.$elementshape.' '.$extraclass.' '.$css_class.'" style="background-image:url('.$resizedimage.');background-color:'.$bgcolor.';" data-iconcolor="'.$iconcolor.'" data-iconbg="'.$iconbg.'" data-iconhovercolor="'.$iconhovercolor.'" data-iconhoverbg="'.$iconhoverbg.'" data-bghovercolor="'.$bghovercolor.'" data-barhoverbg="'.$barhoverbg.'" data-bgcolor="'.$bgcolor.'" data-barbgcolor="'.$barbgcolor.'">';
          $output .= '<div class="cq-infoblock-content" style="background-color:'.$bgcolor.';">';


          $avatar_str = "";
          if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
              $avatar_str .= '<a href="'.$avatarlink['url'].'" class="cq-infoblock-link" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'">';
          }
          $avatar_str .= '<span class="cq-infoblock-iconarea" style="background-color:'.$iconbg.';background-image:url('.$avatarimage_url.')">';
          if($avatartype == "icon"){
              $avatar_str .= '<i class="cq-infoblock-icon '.esc_attr(${'icon_' . $captionicon}).'" style="color:'.$iconcolor.';"></i>';
          }
          $avatar_str .= '</span>';
          if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
            $avatar_str .= '</a>';
          }

          $output .= '<div class="cq-infoblock-textcontainer">';
          if($avatarpos == "left"){
            if($iconstyle == "float"){
              $output .= $avatar_str;
            }
          }

          $output .= '<div class="cq-infoblock-text">';

          if($subtitle != ""){
              $output .= '<span class="cq-infoblock-subtitle" style="font-size:'.$subtitlesize.';color:'.$subtitlecolor.'">'.$subtitle.'</span>';
          }

          if($title != ""){
             $output .= '<h4 class="cq-infoblock-title" style="font-size:'.$titlesize.';color:'.$titlecolor.'">'.$title.'</h4>';
          }


          $output .= $content;

          if($buttontext!=""){
              $output .= do_shortcode('[vc_btn title="'.$buttontext.'" color="'.$buttoncolor.'" style="'.$buttonstyle.'" shape="'.$buttonshape.'" link="'.$buttonlink.'" align="'.$align.'" size="'.$buttonsize.'"]');
          }
          $output .= '</div>';


          if($avatarpos == "right"){
            if($iconstyle == "float"){
              $output .= $avatar_str;
            }
          }

          $output .= '</div> ';

          $output .= '</div>';

          if($iconstyle == "asbar"){
              if($barbgcolor != ""){
                  $output .= '<div class="cq-infoblock-bar" style="background-color:'.$barbgcolor.';">';
              } else {
                  $output .= '<div class="cq-infoblock-bar">';
              }

              if($avatarpos == "left"){
                if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
                    $output .= '<a href="'.$avatarlink['url'].'" class="cq-infoblock-link" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'">';
                }
                $output .= '<span class="cq-infoblock-iconarea" style="background-color:'.$iconbg.';background-image:url('.$avatarimage_url.')">';
                if($avatartype == "icon"){
                    $output .= '<i class="cq-infoblock-icon '.esc_attr(${'icon_' . $captionicon}).'" style="color:'.$iconcolor.';"></i>';
                }

                $output .= '</span>';
                if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
                  $output .= '</a>';
                }

              }

              if($sublabel != ""){
                  $output .= '<span class="cq-infoblock-label" style="font-size:'.$sublabelsize.';color:'.$sublabelcolor.'">';
                  $output .= $sublabel;
                  $output .= '</span>';
              }

              if($avatarpos == "right"){
                if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
                    $output .= '<a href="'.$avatarlink['url'].'" class="cq-infoblock-link" title="'.$avatarlink["title"].'" target="'.$avatarlink["target"].'">';
                }
                $output .= '<span class="cq-infoblock-iconarea" style="background-color:'.$iconbg.';">';
                $output .= '<i class="cq-infoblock-icon '.esc_attr(${'icon_' . $captionicon}).'" style="color:'.$iconcolor.';"></i>';
                $output .= '</span>';
                if(isset($avatarlink['url'])&&$avatarlink['url']!=""){
                  $output .= '</a>';
                }


              }
              $output .= '</div>';
          }


          $output .= '</div>';
          return $output;

        }

  }

}

?>
