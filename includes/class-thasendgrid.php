<?php 

/**
 * Returns the main instance of thaSendGrid.
 *
 * @since  1.0.0
 * @return object thaSendGrid
 */

class thaSendGrid {

	/**
	 * The single instance of thaSendGrid.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */

	public function __construct ( $file = '', $version = '1.0.0' ) {
		$this->_version = $version;

		// Load plugin environment variables
		$this->file = $file;
		$this->dir = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
	}


	 /* Main thaSendGrid Instance
	 *
	 * Ensures only one instance of thaSendGrid is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see thaSendGrid()
	 * @return Main thaSendGrid instance
	 */

	public static function instance ( $file = '', $version = '1.0.0' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	} // End instance ()

}
