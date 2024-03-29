<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cncf.io/
 * @since      1.0.0
 *
 * @package    Lf_Mu
 * @subpackage Lf_Mu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Lf_Mu
 * @subpackage Lf_Mu/admin
 * @author     Chris Abraham <cjyabraham@gmail.com>
 */
class Lf_Mu_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$options       = get_option( $this->plugin_name );
		$this->site    = ( isset( $options['site'] ) && ! empty( $options['site'] ) ) ? esc_attr( $options['site'] ) : '';
		$this->is_cncf = ( 'cncf' === $this->site ) ? true : false;

		$this->webinar = 'webinar';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook_suffix part of WP.
	 */
	public function enqueue_styles( $hook_suffix ) {

			// only loads on LF MU top level page.
		if ( 'toplevel_page_lf-mu' == $hook_suffix ) {

			// color picker.
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lf-mu-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $hook_suffix part of WP.
	 */
	public function enqueue_scripts( $hook_suffix ) {

		// only loads on LF MU top level page.
		if ( 'toplevel_page_lf-mu' == $hook_suffix ) {

			// color picker.
			wp_enqueue_script( 'wp-color-picker' );
			// media uploader.
			wp_enqueue_media();
			// custom scripts.
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lf-mu-admin.js', array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Registers the custom post types
	 */
	public function register_cpts() {
		include_once 'partials/cpts.php';
	}

	/**
	 * Registers the extra sidebar for post types
	 *
	 * See https://melonpan.io/wordpress-plugins/post-meta-controls/ for docs.
	 *
	 * @param array $sidebars    Existing sidebars in Gutenberg.
	 */
	public function create_sidebar( $sidebars ) {
		include 'partials/sidebars.php';
		return $sidebars;
	}

	/**
	 * Registers the taxonomies.
	 */
	public function register_taxonomies() {
		include_once 'partials/taxonomies.php';
	}

	/**
	 * Removes unneeded menu items from the admin.
	 */
	public function remove_menu_items() {
		remove_menu_page( 'edit-comments.php' );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since 1.1.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page( 'Global Options', 'Global Options', 'manage_options', $this->plugin_name, array( $this, 'display_plugin_setup_page' ), null, 4 );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.1.0
	 */
	public function display_plugin_setup_page() {
		include_once 'partials/' . $this->plugin_name . '-admin-display.php';
	}

	/**
	 * Validate fields from admin area plugin settings form
	 *
	 * @param  mixed $input as field form settings form.
	 * @return mixed as validated fields.
	 *
	 * @since 1.1.0
	 */
	public function validate( $input ) {

		$options = get_option( $this->plugin_name );

		$options['show_hello_bar'] = ( isset( $input['show_hello_bar'] ) && ! empty( $input['show_hello_bar'] ) ) ? 1 : 0;

		$options['hello_bar_content'] = ( isset( $input['hello_bar_content'] ) && ! empty( $input['hello_bar_content'] ) ) ? $input['hello_bar_content'] : '';

		$options['hello_bar_bg'] = ( isset( $input['hello_bar_bg'] ) && ! empty( $input['hello_bar_bg'] ) ) ? esc_attr( $input['hello_bar_bg'] ) : '';

		$options['hello_bar_text'] = ( isset( $input['hello_bar_text'] ) && ! empty( $input['hello_bar_text'] ) ) ? esc_attr( $input['hello_bar_text'] ) : '';

		$options['header_image_id'] = ( isset( $input['header_image_id'] ) && ! empty( $input['header_image_id'] ) ) ? absint( $input['header_image_id'] ) : '';

		$options['header_cta_text'] = ( isset( $input['header_cta_text'] ) && ! empty( $input['header_cta_text'] ) ) ? esc_html( $input['header_cta_text'] ) : '';

		$options['header_cta_link'] = ( isset( $input['header_cta_link'] ) && ! empty( $input['header_cta_link'] ) ) ? absint( $input['header_cta_link'] ) : '';

		$options['copyright_textarea'] = ( isset( $input['copyright_textarea'] ) && ! empty( $input['copyright_textarea'] ) ) ? $input['copyright_textarea'] : '';

		$options['social_email'] = ( isset( $input['social_email'] ) && ! empty( $input['social_email'] ) ) ? esc_url( $input['social_email'] ) : '';

		$options['social_facebook'] = ( isset( $input['social_facebook'] ) && ! empty( $input['social_facebook'] ) ) ? esc_url( $input['social_facebook'] ) : '';

		$options['social_flickr'] = ( isset( $input['social_flickr'] ) && ! empty( $input['social_flickr'] ) ) ? esc_url( $input['social_flickr'] ) : '';

		$options['social_github'] = ( isset( $input['social_github'] ) && ! empty( $input['social_github'] ) ) ? esc_url( $input['social_github'] ) : '';

		$options['social_instagram'] = ( isset( $input['social_instagram'] ) && ! empty( $input['social_instagram'] ) ) ? esc_url( $input['social_instagram'] ) : '';

		$options['social_linkedin'] = ( isset( $input['social_linkedin'] ) && ! empty( $input['social_linkedin'] ) ) ? esc_url( $input['social_linkedin'] ) : '';

		$options['social_meetup'] = ( isset( $input['social_meetup'] ) && ! empty( $input['social_meetup'] ) ) ? esc_url( $input['social_meetup'] ) : '';

		$options['social_rss'] = ( isset( $input['social_rss'] ) && ! empty( $input['social_rss'] ) ) ? esc_url( $input['social_rss'] ) : '';

		$options['social_slack'] = ( isset( $input['social_slack'] ) && ! empty( $input['social_slack'] ) ) ? esc_url( $input['social_slack'] ) : '';

		$options['social_twitch'] = ( isset( $input['social_twitch'] ) && ! empty( $input['social_twitch'] ) ) ? esc_url( $input['social_twitch'] ) : '';

		$options['social_twitter'] = ( isset( $input['social_twitter'] ) && ! empty( $input['social_twitter'] ) ) ? esc_url( $input['social_twitter'] ) : '';

		$options['social_twitter_handle'] = ( isset( $input['social_twitter_handle'] ) && ! empty( $input['social_twitter_handle'] ) ) ? esc_html( $input['social_twitter_handle'] ) : '';

		$options['social_youtube'] = ( isset( $input['social_youtube'] ) && ! empty( $input['social_youtube'] ) ) ? esc_url( $input['social_youtube'] ) : '';

		$options['social_wechat_id'] = ( isset( $input['social_wechat_id'] ) && ! empty( $input['social_wechat_id'] ) ) ? absint( $input['social_wechat_id'] ) : '';

		$options['generic_thumb_id'] = ( isset( $input['generic_thumb_id'] ) && ! empty( $input['generic_thumb_id'] ) ) ? absint( $input['generic_thumb_id'] ) : '';

		$options['generic_avatar_id'] = ( isset( $input['generic_avatar_id'] ) && ! empty( $input['generic_avatar_id'] ) ) ? absint( $input['generic_avatar_id'] ) : '';

		$options['generic_hero_id'] = ( isset( $input['generic_hero_id'] ) && ! empty( $input['generic_hero_id'] ) ) ? absint( $input['generic_hero_id'] ) : '';

		$options['gtm_id'] = ( isset( $input['gtm_id'] ) && ! empty( $input['gtm_id'] ) ) ? esc_html( $input['gtm_id'] ) : '';

		$options['site'] = ( isset( $input['site'] ) && ! empty( $input['site'] ) ) ? esc_html( $input['site'] ) : '';

		return $options;
	}

	/**
	 * Update options
	 *
	 * @since 1.1.0
	 */
	public function options_update() {
		register_setting(
			$this->plugin_name,
			$this->plugin_name,
			array(
				'sanitize_callback' => array( $this, 'validate' ),
			)
		);
	}

	/**
	 * Change navigation bar colour for version in debug/local
	 */
	public function change_adminbar_colors() {
		if ( WP_DEBUG !== true ) {
			return;
		}

		$change_adminbar_colors = '<style type="text/css">
			#wpadminbar { background-color:#12881D; }
		</style>';
		echo $change_adminbar_colors; // phpcs:ignore
	}

	/**
	 * Set meta data of year for case studies to faciliate filtering
	 *
	 * @param int    $post_id Post ID.
	 * @param object $post Post object.
	 * @param bool   $update Whether this is an existing post being updated.
	 */
	public function set_case_study_year( $post_id, $post, $update ) {
		$year = get_post_time( 'Y', false, $post );
		update_post_meta( $post_id, 'lf_case_study_published_year', $year );
	}

	/**
	 * Sync projects data from landscape.
	 */
	public function sync_projects() {
		$projects_url = 'https://landscape.' . $this->site . '.io/api/items?project=hosted';
		$items_url    = 'https://landscape.' . $this->site . '.io/data/items.json';
		$logos_url    = 'https://landscape.' . $this->site . '.io/';

		$args = array(
			'timeout'   => 100,
			'sslverify' => false,
		);

		$data = wp_remote_get( $projects_url, $args );
		if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
			return;
		}
		$projects = json_decode( wp_remote_retrieve_body( $data ) );

		$data = wp_remote_get( $items_url, $args );
		if ( is_wp_error( $data ) || ( wp_remote_retrieve_response_code( $data ) != 200 ) ) {
			return;
		}
		$items = json_decode( wp_remote_retrieve_body( $data ) );
		$id_column = array_column( $items, 'id' );

		foreach ( $projects as $level ) {
			foreach ( $level->items as $project ) {
				$key = array_search( $project->id, $id_column );
				if ( false === $key ) {
					continue;
				}

				$p = $items[ $key ];

				$params = array(
					'post_type' => 'lf_project',
					'post_title' => $p->name,
					'post_status' => 'publish',
					'meta_input' => array(
						'lf_project_external_url' => $p->homepage_url,
						'lf_project_twitter' => $p->twitter,
						'lf_project_logo' => $logos_url . $p->href,
						'lf_project_category' => explode( ' / ', $p->path )[1],
					),
				);

				if ( property_exists( $p, 'repo_url' ) ) {
					$params['meta_input']['lf_project_github'] = $p->repo_url;
				}

				if ( property_exists( $p, 'description' ) ) {
					$params['meta_input']['lf_project_description'] = $p->description;
				}

				if ( property_exists( $p, 'extra' ) ) {
					if ( property_exists( $p->extra, 'dev_stats_url' ) ) {
						$params['meta_input']['lf_project_devstats'] = $p->extra->dev_stats_url;
					}
					if ( property_exists( $p->extra, 'artwork_url' ) ) {
						$params['meta_input']['lf_project_logos'] = $p->extra->artwork_url;
					}
					if ( property_exists( $p->extra, 'stack_overflow_url' ) ) {
						$params['meta_input']['lf_project_stack_overflow'] = $p->extra->stack_overflow_url;
					}
					if ( property_exists( $p->extra, 'accepted' ) ) {
						$params['meta_input']['lf_project_date_accepted'] = $p->extra->accepted;
					}
					if ( property_exists( $p->extra, 'blog_url' ) ) {
						$params['meta_input']['lf_project_blog'] = $p->extra->blog_url;
					}
					if ( property_exists( $p->extra, 'mailing_list_url' ) ) {
						$params['meta_input']['lf_project_mail'] = $p->extra->mailing_list_url;
					}
					if ( property_exists( $p->extra, 'slack_url' ) ) {
						$params['meta_input']['lf_project_slack'] = $p->extra->slack_url;
					}
					if ( property_exists( $p->extra, 'youtube_url' ) ) {
						$params['meta_input']['lf_project_youtube'] = $p->extra->youtube_url;
					}
					if ( property_exists( $p->extra, 'gitter_url' ) ) {
						$params['meta_input']['lf_project_gitter'] = $p->extra->gitter_url;
					}
				}

				$pp = get_page_by_title( $p->name, OBJECT, 'lf_project' );
				if ( $pp ) {
					$params['ID'] = $pp->ID;
				}

				// adds term to taxonomy if it doesn't exist.
				if ( ! term_exists( $p->name, 'lf-project' ) ) {
					wp_insert_term( $p->name, 'lf-project' );
				}

				$newid = wp_insert_post( $params ); // will insert or update the post as needed.

				if ( $newid ) {
					wp_set_object_terms( $newid, $p->category, 'lf-project-stage', false );
				}
			}
		}

	}
}
