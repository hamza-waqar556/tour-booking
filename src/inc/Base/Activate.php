<?php
/**
 * @package TourBooking
 */

namespace Inc\Base;

class Activate
{
    /**
     * Plugin activation routine.
     *
     * Flushes rewrite rules, sets default options, and processes JSON imports.
     *
     * @return void
     */
    public static function activate()
    {
        flush_rewrite_rules();

        add_option( 'aiob_settings', [  ] );
        add_option( 'aiob_cpts', [  ] );

        // Process JSON imports on activation.
        self::processJsonImports();
    }

    /**
     * Processes the JSON files: creates tables and imports data if the table is empty.
     *
     * Files for airlines and airports are located in the same data directory
     * but have a .json extension now.
     *
     * @return void
     */
    private static function processJsonImports()
    {
        global $wpdb;
        // Adjust the path as needed.
        $pluginPath = plugin_dir_path( __FILE__ ) . '../../assets/data/';

        // Map JSON files to table slugs.
        $jsonFiles = [
            'airlines' => $pluginPath . 'airlines.json',
            'airports' => $pluginPath . 'airports.json',
         ];

        // Process each JSON file.
        foreach ( $jsonFiles as $tableSlug => $jsonPath ) {
            $tableName = $wpdb->prefix . $tableSlug;

            // Create the table based on JSON structure.
            if ( ! self::createTable( $tableName, $jsonPath, $tableSlug ) ) {
                error_log( "Failed to create table: {$tableName}" );
                continue;
            }

            // Import data only if the table is empty.
            $count = $wpdb->get_var( "SELECT COUNT(*) FROM {$tableName}" );
            if ( $count > 0 ) {
                error_log( "Table {$tableName} already contains data. Skipping JSON import." );
                continue;
            }

            self::importJson( $jsonPath, $tableName, $tableSlug );
        }
    }

    /**
     * Creates a database table based on the keys of the first JSON object.
     *
     * For the airlines table, it adds an extra "code" column that stores the JSON "id" value.
     * Skips any JSON key named "id" to avoid conflicts with the auto-increment primary key.
     *
     * @param string $tableName The full table name (with prefix).
     * @param string $jsonPath  Path to the JSON file.
     * @param string $tableSlug Table slug (e.g., airlines, airports).
     *
     * @return bool True if table creation succeeded; false otherwise.
     */
    private static function createTable( $tableName, $jsonPath, $tableSlug = '' )
    {
        global $wpdb;

        if ( ! file_exists( $jsonPath ) || ! is_readable( $jsonPath ) ) {
            error_log( "JSON file {$jsonPath} not found or not readable." );
            return false;
        }

        $jsonContent = file_get_contents( $jsonPath );
        if ( false === $jsonContent ) {
            error_log( "Failed to read JSON file: {$jsonPath}" );
            return false;
        }

        $data = json_decode( $jsonContent, true );
        if ( ! is_array( $data ) || empty( $data ) ) {
            error_log( "Empty JSON or unable to decode data from: {$jsonPath}" );
            return false;
        }

        // Use the keys from the first object to build the table structure.
        $columns = array_keys( $data[ 0 ] );

        // Prepare SQL columns, skipping the JSON "id" key.
        $sqlColumns = [  ];
        foreach ( $columns as $column ) {
            $column = sanitize_key( $column );
            if ( 'id' === $column ) {
                continue;
            }
            $sqlColumns[  ] = "`{$column}` TEXT";
        }

        // For the airlines table, add an extra "code" column that stores the JSON "id" value.
        if ( 'airlines' === $tableSlug ) {
            // Prepend the "code" column so it appears right after the primary key.
            array_unshift( $sqlColumns, "`code` TEXT" );
        }

        // Build the CREATE TABLE SQL statement.
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
        if ( ! empty( $sqlColumns ) ) {
            $sql .= ", " . implode( ", ", $sqlColumns );
        }
        $sql .= " ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        return true;
    }

    /**
     * Imports data from a JSON file into a given table.
     *
     * For the airlines table, the JSON "id" value is stored in the "code" column,
     * and the original "id" field is removed to allow auto-increment primary key.
     *
     * @param string $jsonPath  Path to the JSON file.
     * @param string $tableName Full table name (with prefix) to insert data into.
     * @param string $tableSlug Table slug (e.g., airlines, airports).
     *
     * @return void
     */
    private static function importJson( $jsonPath, $tableName, $tableSlug = '' )
    {
        global $wpdb;
        // Increase the maximum execution time for large files.
        set_time_limit( 0 );

        $jsonContent = file_get_contents( $jsonPath );
        if ( false === $jsonContent ) {
            error_log( "Failed to read JSON file: {$jsonPath}" );
            return;
        }

        $data = json_decode( $jsonContent, true );
        if ( ! is_array( $data ) || empty( $data ) ) {
            error_log( "Empty JSON or unable to decode data from: {$jsonPath}" );
            return;
        }

        // Insert each record into the database.
        foreach ( $data as $row ) {
            // For the airlines table, move the JSON "id" value into the "code" column.
            if ( 'airlines' === $tableSlug && isset( $row[ 'id' ] ) ) {
                $row[ 'code' ] = $row[ 'id' ];
                unset( $row[ 'id' ] );
            }

            $wpdb->insert( $tableName, $row );
        }
    }
}
