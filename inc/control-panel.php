<?php
/**
 * Enqueue scripts and styles.
 */
function observo_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'theme-options-menu') {
        wp_enqueue_style( 'observo-admin-style', get_template_directory_uri() . '/css/wp-admin.css');
        //Please replace the path with the correct path to the file in your theme 
        wp_enqueue_script( 'observo-admin-animation', get_template_directory_uri() . '/js/control-panel-animation.js', array('jquery'), '20141205', true );

        wp_enqueue_script( 'observo-retina-js', get_template_directory_uri() . '/js/retina.min.js', array(), '20150407', true );

        wp_enqueue_media();
        wp_register_script( 'observo-admin', get_template_directory_uri() . '/js/control-panel.js', array('jquery'), '20141205', true );
        wp_enqueue_script( 'observo-admin', get_template_directory_uri() . '/js/control-panel.js', array('jquery'), '20141205', true );   
    }
}
add_action( 'admin_enqueue_scripts', 'observo_admin_scripts' );

/**
 * Admin Notification
 */
function observo_admin_notice() {
    if (get_option('observo_general_settings_option') == null && get_option('observo_homepage_option') == null) {
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($page != 'theme-options-menu') {
            printf(
            __( '<div class="updated"><p>This appears to be a new installation of the %1$s theme. To set up your theme, please <a href="%2$s">click here to go to the theme options page</a></p></div>.', 'observo' ),
                wp_get_theme(), 
                admin_url( 'themes.php?page=theme-options-menu' )
            );
        } else {
            printf(
            __( '<div class="updated"><p>This appears to be a new installation of the %1$s theme. This message will disappear once you click save below.</a></p></div>.', 'observo' ),
                wp_get_theme()
            );
        }
    }   
}
add_action( 'admin_notices', 'observo_admin_notice' );



class SettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'observo_create_options_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function observo_create_options_page()
    {
        // This page will be under "Appearance"
        add_theme_page(
            'Observo Theme Options', 
            'Observo Options', 
            'manage_options', 
            'theme-options-menu', 
            array( $this, 'observo_general_options_page' )
        );
    }

    /**
     * Options page callback
     */
    public function observo_general_options_page()
    {
    if ( !current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.', 'observo' ) );
    }

    // Set class property
    $this->generalOptions = get_option( 'observo_general_settings_option' );
    $theme_data = wp_get_theme();
    ?>
        <div class="wordskins-dashboard">
            <div class="wrap">
                <div class="dashboard-header">
                    <h1><?php echo $theme_data->get( 'Name' );?> <span class="version"><?php echo $theme_data->get( 'Version' ); ?></span></h1>
                    <div class="logo">
                        <?php printf(
                            '<a href="%1$s"><img src="%2$s/images/wordskins-logo-white.png" alt="%3$s"></a>',
                            esc_url( __( 'http://www.wordskins.com/', 'observo' ) ),
                            get_template_directory_uri(),
                            __('WordSkins WordPress Themes', 'observo')
                            );
                        ?>
                    </div>
                </div>
                <div class="dashboard-content">
                    <div class="dashboard-nav">
                        <ul>
                            <li class="active"><a id="general"><i class="fa fa-gears"></i> <?php _e('General Settings', 'observo') ?></a></li>
                            <li><a id="support"><i class="fa fa-life-saver"></i> <?php _e('Support', 'observo') ?></a></li>
                        </ul>
                    </div>
             
                    <div class="dashboard-panes">
                        <div class="pane" id="general-pane">
                            <h2><?php _e('General Settings', 'observo') ?></h2>
                            <form method="post" enctype="multipart/form-data" action="options.php">
                                <?php 
                                    settings_fields('observo_general_settings_option_group'); 

                                    do_settings_sections('observo-logos-section-options');

                                    do_settings_sections('observo-social-icons-section-options');
                                ?>
                                <p class="submit">  
                                    <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'observo') ?>" />
                                </p>
                            </form>
                        </div>
                        <div class="pane" id="support-pane">
                            <h2><?php _e('Support', 'observo') ?></h2>
                            <p><?php printf( __('For theme support, go to %1$sWordskins.Zendesk.com%2$s!', 'observo'),
                                sprintf('<a href="%s">', esc_url('http://wordskins.zendesk.com')),
                                '</a>');
                            ?></p>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {       
        //Register General Settings
        register_setting(
            'observo_general_settings_option_group', // Option group
            'observo_general_settings_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );



        add_settings_section(
            'logos_section', // ID
            'Logo Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'observo-logos-section-options' // Page
        );      

        add_settings_field(
            'header_logo', 
            'Header Logo', 
            array( $this, 'header_logo_callback' ), 
            'observo-logos-section-options', 
            'logos_section'
        );     



        add_settings_section(
            'social_icons_section', // ID
            'Social Media Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'observo-social-icons-section-options' // Page
        );      

        add_settings_field(
            'show_facebook', 
            'Show Facebook Icon?', 
            array( $this, 'show_facebook_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'facebook_url', 
            'Facebook URL', 
            array( $this, 'facebook_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );   

        add_settings_field(
            'show_twitter', 
            'Show Twitter Icon?', 
            array( $this, 'show_twitter_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'twitter_url', 
            'Twitter URL', 
            array( $this, 'twitter_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_google_plus', 
            'Show Google Plus Icon?', 
            array( $this, 'show_google_plus_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'google_plus_url', 
            'Google Plus URL', 
            array( $this, 'google_plus_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_linkedin', 
            'Show LinkedIn Icon?', 
            array( $this, 'show_linkedin_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'linkedin_url', 
            'LinkedIn URL', 
            array( $this, 'linkedin_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_instagram', 
            'Show Instagram Icon?', 
            array( $this, 'show_instagram_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'instagram_url', 
            'Instagram URL', 
            array( $this, 'instagram_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_pinterest', 
            'Show Pinterest Icon?', 
            array( $this, 'show_pinterest_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'pinterest_url', 
            'Pinterest URL', 
            array( $this, 'pinterest_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_youtube', 
            'Show Youtube Icon?', 
            array( $this, 'show_youtube_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'youtube_url', 
            'Youtube URL', 
            array( $this, 'youtube_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_vimeo', 
            'Show Vimeo Icon?', 
            array( $this, 'show_vimeo_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'vimeo_url', 
            'Vimeo URL', 
            array( $this, 'vimeo_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_dribbble', 
            'Show Dribbble Icon?', 
            array( $this, 'show_dribbble_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'dribbble_url', 
            'Dribbble URL', 
            array( $this, 'dribbble_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );

        add_settings_field(
            'show_behance', 
            'Show Behance Icon?', 
            array( $this, 'show_behance_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );     

        add_settings_field(
            'behance_url', 
            'Behance URL', 
            array( $this, 'behance_url_callback' ), 
            'observo-social-icons-section-options', 
            'social_icons_section'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        //General Settings Sanitizers
        //
        if( isset( $input['header_logo'] ) )
            $new_input['header_logo'] = sanitize_text_field( $input['header_logo'] );



        if( isset( $input['show_facebook'] ) )
            $new_input['show_facebook'] = absint( $input['show_facebook'] );

        if( isset( $input['facebook_url'] ) )
            $new_input['facebook_url'] = esc_url( $input['facebook_url'] );
        
        if( isset( $input['show_twitter'] ) )
            $new_input['show_twitter'] = absint( $input['show_twitter'] );

        if( isset( $input['twitter_url'] ) )
            $new_input['twitter_url'] = esc_url( $input['twitter_url'] );
        
        if( isset( $input['show_google_plus'] ) )
            $new_input['show_google_plus'] = absint( $input['show_google_plus'] );

        if( isset( $input['google_plus_url'] ) )
            $new_input['google_plus_url'] = esc_url( $input['google_plus_url'] );
        
        if( isset( $input['show_linkedin'] ) )
            $new_input['show_linkedin'] = absint( $input['show_linkedin'] );

        if( isset( $input['linkedin_url'] ) )
            $new_input['linkedin_url'] = esc_url( $input['linkedin_url'] );

        if( isset( $input['show_instagram'] ) )
            $new_input['show_instagram'] = absint( $input['show_instagram'] );

        if( isset( $input['instagram_url'] ) )
            $new_input['instagram_url'] = esc_url( $input['instagram_url'] );

        if( isset( $input['show_pinterest'] ) )
            $new_input['show_pinterest'] = absint( $input['show_pinterest'] );

        if( isset( $input['pinterest_url'] ) )
            $new_input['pinterest_url'] = esc_url( $input['pinterest_url'] );

        if( isset( $input['show_youtube'] ) )
            $new_input['show_youtube'] = absint( $input['show_youtube'] );

        if( isset( $input['youtube_url'] ) )
            $new_input['youtube_url'] = esc_url( $input['youtube_url'] );

        if( isset( $input['show_vimeo'] ) )
            $new_input['show_vimeo'] = absint( $input['show_vimeo'] );

        if( isset( $input['vimeo_url'] ) )
            $new_input['vimeo_url'] = esc_url( $input['vimeo_url'] );

        if( isset( $input['show_dribbble'] ) )
            $new_input['show_dribbble'] = absint( $input['show_dribbble'] );

        if( isset( $input['dribbble_url'] ) )
            $new_input['dribbble_url'] = esc_url( $input['dribbble_url'] );

        if( isset( $input['show_behance'] ) )
            $new_input['show_behance'] = absint( $input['show_behance'] );

        if( isset( $input['behance_url'] ) )
            $new_input['behance_url'] = esc_url( $input['behance_url'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        // print 'Enter your settings below:';
    }



    /** 
     *
     **************************
     ******** Builders ********
     **************************
     *
     */
    
     /** 
     * Build toggle input
     */
    public function build_toggle($underscore_name, $optionsGroup, $on, $off)
    {
        $hyphenName = str_replace("_", "-", $underscore_name);
        $storedValue = "";
        if( isset( $this->{$optionsGroup . "Options"}[$underscore_name] ) ) {
            $storedValue = $this->{$optionsGroup . "Options"}[$underscore_name];
        }
        if($storedValue == 0) {
            $checked = '';
        } else {
            $checked = 'checked';
        }

        $optionsGroup = ($optionsGroup == "general" ? "general_settings" : $optionsGroup);

        printf(
            '<div class="%1$s-switch toggle-switch">
                <input id="%1$s" class="ws-toggle ws-toggle-yes-no" type="checkbox" name="observo_%3$s_option[%2$s]" value="1" %6$s>
                <label for="%1$s" data-on="%4$s" data-off="%5$s"></label>
            </div>',
            $hyphenName,
            $underscore_name,
            $optionsGroup,
            $on,
            $off,
            $checked
        );
    }

     /** 
     * Build toggle input
     */
    public function build_image_upload($underscore_name, $optionsGroup, $suggestedWidth, $suggestedHeight)
    {
        $hyphenName = str_replace("_", "-", $underscore_name);
        $storedValue = "";
        if( isset( $this->{$optionsGroup . "Options"}[$underscore_name] ) ) {
            $storedValue = $this->{$optionsGroup . "Options"}[$underscore_name];
        }

        $optionsGroup = ($optionsGroup == "general" ? "general_settings" : $optionsGroup);

        printf(
            '<div class="%1$s-upload">
                <label for="upload_%2$s">
                    <input id="upload_%2$s" type="text" size="40" name="observo_%3$s_option[%2$s]" value="%4$s" /> 
                    <input id="upload_%2$s_button" class="button" type="button" value="Upload Image" />
                    <br />%5$s: %6$s x %7$s
                </label>
            </div>',
            $hyphenName,
            $underscore_name,
            $optionsGroup,
            $storedValue,
            __('Suggested Size', 'observo'),
            $suggestedWidth,
            $suggestedHeight
        );
    }

     /** 
     * Build text input
     */
    public function build_text_input($underscore_name, $optionsGroup, $size = 40)
    {
        $hyphenName = str_replace("_", "-", $underscore_name);
        $storedValue = "";
        if( isset( $this->{$optionsGroup . "Options"}[$underscore_name] ) ) {
            $storedValue = $this->{$optionsGroup . "Options"}[$underscore_name];
        }

        $optionsGroup = ($optionsGroup == "general" ? "general_settings" : $optionsGroup);

        printf(
            '<div class="%1$s-input form-input">
                <input type="text" id="%2$s" size="%5$s" name="observo_%3$s_option[%2$s]" value="%4$s" />
            </div>',
            $hyphenName,
            $underscore_name,
            $optionsGroup,
            $storedValue,
            $size
        );
    }

     /** 
     * Build text input
     */
    public function build_textarea($underscore_name, $optionsGroup, $rows = 5, $cols = 40)
    {
        $hyphenName = str_replace("_", "-", $underscore_name);
        $storedValue = "";
        if( isset( $this->{$optionsGroup . "Options"}[$underscore_name] ) ) {
            $storedValue = $this->{$optionsGroup . "Options"}[$underscore_name];
        }

        $optionsGroup = ($optionsGroup == "general" ? "general_settings" : $optionsGroup);

        printf(
            '<div class="%1$s-textarea">
                <textarea rows="%5$s" cols="%6$s" id="%2$s" name="observo_%3$s_option[%2$s]" />%4$s</textarea>
            </div>',
            $hyphenName,
            $underscore_name,
            $optionsGroup,
            $storedValue,
            $rows,
            $cols
        );
    }


    /** 
     *
     **************************
     ******** Callbacks ********
     **************************
     *
     */

    public function header_logo_callback()
    {
        $this->build_image_upload('header_logo', 'general', '560px width', 'Any height');
    }

    public function show_facebook_callback()
    {
        $this->build_toggle('show_facebook', 'general', 'Show', 'Hide');
    }

    public function facebook_url_callback()
    {
        $this->build_text_input('facebook_url', 'general');
    }

    public function show_twitter_callback()
    {
        $this->build_toggle('show_twitter', 'general', 'Show', 'Hide');
    }

    public function twitter_url_callback()
    {
        $this->build_text_input('twitter_url', 'general');
    }

    public function show_google_plus_callback()
    {
        $this->build_toggle('show_google_plus', 'general', 'Show', 'Hide');
    }

    public function google_plus_url_callback()
    {
        $this->build_text_input('google_plus_url', 'general');
    }

    public function show_linkedin_callback()
    {
        $this->build_toggle('show_linkedin', 'general', 'Show', 'Hide');
    }

    public function linkedin_url_callback()
    {
        $this->build_text_input('linkedin_url', 'general');
    }

    public function show_instagram_callback()
    {
        $this->build_toggle('show_instagram', 'general', 'Show', 'Hide');
    }

    public function instagram_url_callback()
    {
        $this->build_text_input('instagram_url', 'general');
    }

    public function show_pinterest_callback()
    {
        $this->build_toggle('show_pinterest', 'general', 'Show', 'Hide');
    }

    public function pinterest_url_callback()
    {
        $this->build_text_input('pinterest_url', 'general');
    }

    public function show_youtube_callback()
    {
        $this->build_toggle('show_youtube', 'general', 'Show', 'Hide');
    }

    public function youtube_url_callback()
    {
        $this->build_text_input('youtube_url', 'general');
    }

    public function show_vimeo_callback()
    {
        $this->build_toggle('show_vimeo', 'general', 'Show', 'Hide');
    }

    public function vimeo_url_callback()
    {
        $this->build_text_input('vimeo_url', 'general');
    }

    public function show_dribbble_callback()
    {
        $this->build_toggle('show_dribbble', 'general', 'Show', 'Hide');
    }

    public function dribbble_url_callback()
    {
        $this->build_text_input('dribbble_url', 'general');
    }

    public function show_behance_callback()
    {
        $this->build_toggle('show_behance', 'general', 'Show', 'Hide');
    }

    public function behance_url_callback()
    {
        $this->build_text_input('behance_url', 'general');
    }

}

if( is_admin() )
    $my_settings_page = new SettingsPage();