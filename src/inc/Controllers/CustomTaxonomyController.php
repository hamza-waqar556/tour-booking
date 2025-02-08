<?php
/**
 * @package TourBooking
 */

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomTaxonomyController extends BaseController
{

    // Classes
    public $settings;
    public $callbacks;

    // Variables
    public $subpages = [  ];

    public function register()
    {
        if ( ! $this->isActivated( 'taxonomy_manager' ) ) {
            return;
        }

        // Classes
        $this->settings  = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        // Methods
        $this->setSubpages();

        // Chaining Methods
        $this->settings->addSubPages( $this->subpages )->register();

    }

    public function setSubpages()
    {
        $this->subpages = [
            [
                'parent_slug' => 'tour_booking',
                'page_title'  => 'Custom Taxonomy',
                'menu_title'  => 'Taxonomies Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'tour_taxonomies',
                'callback'    => [ $this->callbacks, 'taxonomies' ],
             ],
         ];
    }
}
