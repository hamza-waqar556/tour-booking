<?php
namespace Inc\Api;

use Inc\Api\Modules\Hotelbed;
use Inc\Api\Modules\Agoda;
use Inc\Api\Modules\Amendus;
use Inc\Api\Modules\Duffel;
use Inc\Api\Modules\Vaitor;

class ApiManager
{

    protected $category;
    protected $params     = [  ];
    protected $modules    = [  ];
    protected $globalData = [  ];

    /**
     * Set the search category (e.g., 'hotels', 'flights', 'tours').
     *
     * @param string $category
     * @return $this
     */
    public function setCategory( string $category )
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Set the search parameters.
     *
     * @param array $params
     * @return $this
     */
    public function setParameters( array $params )
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Load the enabled API modules for the given category.
     * (In production, you’d pull the list of enabled APIs and their credentials
     *  from your custom database table.)
     *
     * @return $this
     */
    public function loadModules()
    {
        // Example: for hotels, assume Hotelbed and Agoda are enabled.
        if ( 'hotels' === $this->category ) {
            // In a real scenario, get the credentials and enabled flag from your custom table.
            $hotelbed = ( new Hotelbed() )
                ->setCredentials( '531c46fc346c6729b9e9094f65abef70', '1e83c000f3' );
            $agoda = ( new Agoda() )
                ->setCredentials( 'A34C14A7-4BC3-4D0D-BD43-36CA7A4BB2B9', '1743607' );

            $this->modules = [ $hotelbed, $agoda ];
        } elseif ( 'flights' === $this->category ) {
            $amendus = ( new Amendus() )
                ->setCredentials( '0PwjIXH2PAj5QGpiFun3IUGtr6GjfB4X', 'BNHdg9lBs77qaIsi' );
            $duffel = ( new Duffel() )
                ->setCredentials( 'duffel_test_89MoX7EqjiSgcJKOrsrW65bDAprzNonT8liIMqc2gn0', '' );

            $this->modules = [ $amendus, $duffel ];
        } elseif ( 'tours' === $this->category ) {
            $vaitor = ( new Vaitor() )
                ->setCredentials( 'cd7229f3-194e-4e5b-80d4-b2804f05f7f6', '' );

            $this->modules = [ $vaitor ];
        }
        // If needed, add logic to support “fallback” modules or custom mappings.
        return $this;
    }

    /**
     * Execute the search on all enabled modules.
     *
     * @return $this
     */
    public function execute()
    {
        foreach ( $this->modules as $module ) {
            // Chain the call: set search parameters then search
            $module->setParameters( $this->params )->search();

            // Get normalized data and merge it into globalData if available
            $data = $module->getData();
            if ( ! empty( $data ) ) {
                $this->globalData = array_merge( $this->globalData, $data );
            }
        }
        return $this;
    }

    /**
     * Get the global (aggregated) data from all modules.
     *
     * @return array
     */
    public function getGlobalData(): array
    {
        return $this->globalData;
    }
}
