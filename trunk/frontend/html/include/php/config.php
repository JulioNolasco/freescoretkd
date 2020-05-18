<?php
	function get_ring_number( $n ) {
		if( ! preg_match( '/ring/', $n )) { return null; }
		$n = preg_replace( '/ring/', '', $n );
		return intval( $n );
	}

	function read_config() {
		$file = __DIR__ . '/config.json';
		if( ! file_exists( $file )) {
			die( "Configuration file '$file' does not exist" );
		}
		$string = file_get_contents( $file );
		$config = json_decode( $string, true );
		return $config;
	}

	function init_event( $event ) {
		mkdir( $event, 0777, true )           or die( "Can't create directory '$event'" );
		mkdir( "$event/ring01", 0777, true )  or die( "Can't create directory '$event/ring01'" );
		mkdir( "$event/staging", 0777, true ) or die( "Can't create directory '$event/staging'" );
	}

	function read_rings( $tournament ) {
		// Initialize rings
		$grassroots = '/usr/local/freescore/data/' . $tournament[ 'db' ] . '/forms-grassroots';
		$worldclass = '/usr/local/freescore/data/' . $tournament[ 'db' ] . '/forms-worldclass';
		$freestyle  = '/usr/local/freescore/data/' . $tournament[ 'db' ] . '/forms-freestyle';

		if( ! file_exists( $grassroots )) { init_event( $grassroots ); }
		if( ! file_exists( $worldclass )) { init_event( $worldclass ); }
		if( ! file_exists( $freestyle  )) { init_event( $freestyle  ); }

		$rings = [];
		$rings[ 'grassroots' ] = preg_grep( '/ring|staging/', scandir( $grassroots ));
		$rings[ 'worldclass' ] = preg_grep( '/ring|staging/', scandir( $worldclass ));
		$rings[ 'freestyle' ]  = preg_grep( '/ring|staging/', scandir( $freestyle  ));
		$rings = array_values( array_filter( array_map( 'get_ring_number', array_unique( array_merge( $rings[ 'grassroots' ], $rings[ 'worldclass' ], $rings[ 'freestyle' ] )))));
		asort( $rings );
		$tournament[ 'rings' ] = $rings;
		$tournament = json_encode( $tournament );

		return $tournament;
	}

	$config     = read_config();
	$host       = $config[ 'host' ];
	$tournament = read_rings( $config[ 'tournament' ]);

?>
