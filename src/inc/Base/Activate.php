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
     * Flushes rewrite rules, sets default options, and processes CSV imports.
     *
     * @return void
     */
    public static function activate()
    {
        flush_rewrite_rules();

        add_option( 'aiob_settings', [  ] );
        add_option( 'aiob_cpts', [  ] );

        // Process CSV imports on activation.
        self::processCsvImports();
    }

    /**
     * Processes the CSV files: creates tables and imports data if the table is empty.
     *
     * @return void
     */
    private static function processCsvImports()
    {
        global $wpdb;
        // Adjust the path as needed.
        $pluginPath = plugin_dir_path( __FILE__ ) . '../../assets/data/';

        // Map CSV files to table slugs.
        $csvFiles = [
            'airlines' => $pluginPath . 'airlines.csv',
            'airports' => $pluginPath . 'airports.csv',
         ];

        // Process each CSV file.
        foreach ( $csvFiles as $tableSlug => $csvPath ) {
            $tableName = $wpdb->prefix . $tableSlug;

            // Create the table based on CSV header.
            if ( ! self::createTable( $tableName, $csvPath ) ) {
                error_log( "Failed to create table: {$tableName}" );
                continue;
            }

            // Import data only if the table is empty.
            $count = $wpdb->get_var( "SELECT COUNT(*) FROM {$tableName}" );
            if ( $count > 0 ) {
                error_log( "Table {$tableName} already contains data. Skipping CSV import." );
                continue;
            }

            self::importCsv( $csvPath, $tableName );
        }
    }

    /**
     * Creates a database table based on the header row of the CSV.
     *
     * Skips any CSV column named "id" to avoid conflicts with the auto-increment primary key.
     *
     * @param string $tableName The full table name (with prefix).
     * @param string $csvPath   Path to the CSV file.
     *
     * @return bool True if table creation succeeded; false otherwise.
     */
    private static function createTable( $tableName, $csvPath )
    {
        global $wpdb;

        if ( ! file_exists( $csvPath ) || ! is_readable( $csvPath ) ) {
            error_log( "CSV file {$csvPath} not found or not readable." );
            return false;
        }

        $file = fopen( $csvPath, 'r' );
        if ( ! $file ) {
            error_log( "Failed to open CSV file: {$csvPath}" );
            return false;
        }

        // Read the CSV header with an explicit escape parameter.
        $columns = fgetcsv( $file, 0, ',', '"', '\\' );
        fclose( $file );

        if ( ! $columns ) {
            error_log( "Empty CSV or unable to read columns from: {$csvPath}" );
            return false;
        }

        // Prepare SQL columns (skip CSV "id" column).
        $sqlColumns = [  ];
        foreach ( $columns as $column ) {
            $column = sanitize_key( $column );
            if ( 'id' === $column ) {
                continue;
            }
            $sqlColumns[  ] = "`{$column}` TEXT";
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
     * Imports data from a CSV file into a given table.
     *
     * Reads the CSV header to map column names and then imports each row,
     * ensuring that any CSV 'id' field is removed.
     *
     * @param string $csvPath   Path to the CSV file.
     * @param string $tableName Full table name (with prefix) to insert data into.
     *
     * @return void
     */
    private static function importCsv( $csvPath, $tableName )
    {
        global $wpdb;
        // Increase the maximum execution time for large files.
        set_time_limit( 0 );

        $file = fopen( $csvPath, 'r' );
        if ( ! $file ) {
            error_log( "Failed to open CSV file: {$csvPath}" );
            return;
        }

        // Read header row.
        $columns = fgetcsv( $file, 0, ',', '"', '\\' );
        if ( ! $columns ) {
            error_log( "Empty CSV or unable to read columns from: {$csvPath}" );
            fclose( $file );
            return;
        }

        $data = [  ];
        while ( ( $row = fgetcsv( $file, 0, ',', '"', '\\' ) ) !== false ) {
            // Skip completely empty rows.
            if ( ! array_filter( $row ) ) {
                continue;
            }

            // Check that the row has the expected number of columns.
            if ( count( $row ) != count( $columns ) ) {
                error_log( "Skipping row due to column count mismatch in {$csvPath}" );
                continue;
            }

            $data[  ] = array_combine( $columns, $row );
        }
        fclose( $file );

        // Insert each row into the database, removing any CSV 'id' field.
        foreach ( $data as $row ) {
            if ( isset( $row[ 'id' ] ) ) {
                unset( $row[ 'id' ] );
            }
            $wpdb->insert( $tableName, $row );
        }
    }
}
