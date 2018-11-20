<?php
	include "../include/php/version.php";
	include "../include/php/config.php";
?>
<html>
	<head>
		<title>Upload USAT Registration</title>
		<link href="../include/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../include/css/registration.css" rel="stylesheet" />
		<link href="../include/bootstrap/add-ons/bootstrap-select.min.css" rel="stylesheet" />
		<link href="../include/bootstrap/add-ons/bootstrap-toggle.min.css" rel="stylesheet" />
		<link href="../include/page-transitions/css/animations.css" rel="stylesheet" type="text/css" />
		<link href="../include/alertify/css/alertify.min.css" rel="stylesheet" />
		<link href="../include/alertify/css/themes/bootstrap.min.css" rel="stylesheet" />
		<link href="../include/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
		<script src="../include/jquery/js/jquery.js"></script>
		<script src="../include/jquery/js/jquery.howler.min.js"></script>
		<script src="../include/bootstrap/js/bootstrap.min.js"></script>
		<script src="../include/bootstrap/add-ons/bootstrap-select.min.js"></script>
		<script src="../include/bootstrap/add-ons/bootstrap-toggle.min.js"></script>
		<script src="../include/alertify/alertify.min.js"></script>
		<script src="../include/js/freescore.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.file-drop-zone {
				height: 200px;
				border: 3px dashed #17a2b8;
				border-radius: 8px;
			}
		</style>
	</head>
	<body>
		<div id="pt-main" class="pt-perspective">
			<div class="pt-page pt-page-1">
<?php include "upload.php" ?>
			</div>
			<div class="pt-page pt-page-2">
<?php include "import.php" ?>
			</div>
		</div>
		<script src="../include/page-transitions/js/pagetransitions.js"></script>
		<script>

var host       = '<?= $host ?>';
var tournament = <?= $tournament ?>;
var html       = FreeScore.html;
var divisions  = undefined;

var sound = {
	send      : new Howl({ urls: [ "../sounds/upload.mp3",   "../sounds/upload.ogg"   ]}),
	confirmed : new Howl({ urls: [ "../sounds/received.mp3", "../sounds/received.ogg" ]}),
	error     : new Howl({ urls: [ "../sounds/warning.mp3",  "../sounds/warning.ogg"  ]}),
	next      : new Howl({ urls: [ "../sounds/next.mp3",     "../sounds/next.ogg"     ]}),
	prev      : new Howl({ urls: [ "../sounds/prev.mp3",     "../sounds/prev.ogg"     ]}),
};

var page = {
	num : 1,
	transition: ( to ) => { page.num = to; PageTransitions.nextPage({ animation: page.animation( page.num, to )}); },
	animation:  ( from, to ) => {
		if     ( from > to ) { return 2; }
		else if( from < to ) { return 1; }
	}
};

var ws = {
	worldclass : new WebSocket( 'ws://' + host + ':3088/worldclass/' + tournament.db + '/staging' ),
	sparring   : new WebSocket( 'ws://' + host + ':3086/sparring/' + tournament.db + '/staging' ),
	// grassroots : new WebSocket( 'ws://' + host + ':3080/grassroots/' + tournament.db + '/staging' ),
};

$( '#back-to-upload' ).off( 'click' ).click( ( ev ) => {
	sound.prev.play();
	page.transition( 1 );
});

$( '.file-drop-zone' )
	.on( 'dragover', ( ev ) => {
		ev.preventDefault();
		ev.stopPropagation();
	})
	.on( 'dragenter', ( ev ) => {
		ev.preventDefault();
		ev.stopPropagation();
	})
	.on( 'drop', ( ev ) => {
		ev.preventDefault();
		ev.stopPropagation();
		var target = $( ev.target ).attr( 'id' );
		if( registration[ target ] ) { sound.next.play(); return; }

		var upload = ev.originalEvent;
		var reader = new FileReader();

		if( ! defined( upload )) { return; }
		upload = upload.dataTransfer;
		if( ! defined( upload )) { return; }

		var data = '';
		for( file of upload.files ) {
			reader.onload = (( f ) => {
				return ( e ) => { 
					if( e.target.result == registration.female || e.target.result == registration.male ) {
						alertify.error( 'Same file uploaded twice; possible user error?' );
						return;
					}
					dropzone.disable( target );

					registration[ target ] = e.target.result;
					sound.send.play();
					alertify.success( target.capitalize() + ' divisions uploaded' );

					$( '#upload' ).css({ 'padding-top' : '64px' }).html( 'Uploading Registrations...' );
					var request;
					request = { data : { type : 'registration', action : 'upload', gender: target, data: registration[ target ] }};
					request.json = JSON.stringify( request.data );
					ws.worldclass.send( request.json );
					ws.sparring.send( request.json );
				};
			})( file );

			data = reader.readAsText( file );
		}

	});

function sport_poomsae_division_description( s, d ) {
	d = JSON.parse( d );
	d = d.gender + ' ' + d.age;
	var format = '';
	if( s.match( /pair/i ))      { format = 'Pair' }
	else if( s.match( /team/i )) { format = 'Team' }
	else                         { format = 'Individual' }
	d = d.replace( /10-11/, 'Youths' );
	d = d.replace( /12-14/, 'Cadets' );
	d = d.replace( /15-17/, 'Juniors' );
	d = d.replace( /18-30/, 'Seniors' );
	d = d.replace( /31-40/, 'Under 40' );
	d = d.replace( /41-50/, 'Under 50' );
	d = d.replace( /51-60/, 'Under 60' );
	d = d.replace( /61-65/, 'Under 65' );
	d = d.replace( /66-99/, 'Over 65' );
	d = d.replace( /31-99/, 'Over 30' );
	d = d.replace( /black all/, '' );
	d = d.replace( /coed/, format );
	d = d.replace( /female/, 'Female ' + format );
	d = d.replace( /\bmale/, 'Male ' + format );

	return d;
};

function display_sport_poomsae_divisions( divisions ) {
	var map = {
		'world class poomsae'       : 'worldclass-individuals',
		'world class pairs poomsae' : 'worldclass-pairs',
		'world class team poomsae'  : 'worldclass-teams',
	};

	var events = [ 'world class poomsae', 'world class pairs poomsae', 'world class team poomsae' ];

	for( var subevent of events) {
		if( !( subevent in divisions )) { continue; }
		var id    = '#' + map[ subevent ] + ' .panel-body table';
		var table = $( id );
		table.empty();
		var tr = html.tr.clone();
		tr.append( html.th.clone().html( 'Division' ), html.th.clone().html( 'Athletes' ));
		table.append( tr );
		var sum = 0;
		for( var division in divisions[ subevent ] ) {
			var tr    = html.tr.clone();
			var count = divisions[ subevent ][ division ].length;

			if( subevent.match( /pair/i )) { count = Math.ceil( count/2 ); }
			if( subevent.match( /team/i )) { count = Math.ceil( count/3 ); }

			var row = {
				name : html.td.clone().html( sport_poomsae_division_description( subevent, division )),
				count: html.td.clone().html( divisions[ subevent ][ division ].length )
			};
			tr.append( row.name, row.count );
			table.append( tr );
			sum += count;
		}

		tr = html.tr.clone();
		tr.append( html.th.clone().html( 'Total' ), html.th.clone().html( sum ));
		table.append( tr );
	}
}

function sparring_division_description( s, g, d ) {
	d = JSON.parse( d );
	age = d.age; age = age.replace( /\-99/, '+' );
	s = s.split( /\s/ ).map(( i ) => { return i.capitalize(); }).join( ' ' );
	if( s.match( /(?:cadet|junior|senior)/i )) {
		s = s.replace( /(cadet|junior|senior)/i, g.capitalize() + ' $&' );
		s = s.replace( /\s*sparring/i, '' );
		s = s + ' (' + age + ')';
		return s;
	}
	s = s.replace( /\s*sparring/i, ' ' + g.capitalize() );
	s = s + ' (' + age + ')';
	return s;
}

function display_sparring_divisions( divisions ) {
	var sum = 0;
	var tr = html.tr.clone();
	tr.append( html.th.clone().html( 'Events' ), html.th.clone().html( 'Divisions' ), html.th.clone().html( 'Athletes' ));
	var table = $( '.sparring .panel-body table' );
	table.empty();
	table.append( tr );

	var subevents = { 'worldclass-sparring' : {}, 'blackbelt-sparring' : {}, 'colorbelt-sparring' : {}};
	for( var subevent in divisions ) {
		for( var json in divisions[ subevent ] ) {
			var d = JSON.parse( json );
			if( subevent.match( /world class/i )) { 
				var name = 'worldclass-sparring';
				if( ! defined( subevents[ name ][ subevent ])) { subevents[ name ][ subevent ] = {}; }
				if( ! defined( subevents[ name ][ subevent ][ d.gender ])) { subevents[ name ][ subevent ][ d.gender ] = {}; }
				subevents[ name ][ subevent ][ d.gender ][ json ] = divisions[ subevent ][ json ];
				continue;
			}
			if( d.belt.match( /black/i )) {
				var name = 'blackbelt-sparring';
				if( ! defined( subevents[ name ][ subevent ])) { subevents[ name ][ subevent ] = {}; }
				if( ! defined( subevents[ name ][ subevent ][ d.gender ])) { subevents[ name ][ subevent ][ d.gender ] = {}; }
				subevents[ name ][ subevent ][ d.gender ][ json ] = divisions[ subevent ][ json ];
				continue;
			}
			var name = 'colorbelt-sparring';
			if( ! defined( subevents[ name ][ subevent ])) { subevents[ name ][ subevent ] = {}; }
			if( ! defined( subevents[ name ][ subevent ][ d.gender ])) { subevents[ name ][ subevent ][ d.gender ] = {}; }
			subevents[ name ][ subevent ][ d.gender ][ json ] = divisions[ subevent ][ json ];
		}
	}
	console.log( subevents );

	for( var name in subevents ) {
		var id         = '#' + name + ' .panel-body table';
		var table      = $( id );
		var divcount   = 0;
		var count      = 0;
		for( var subevent of Object.keys( subevents[ name ]).sort(( a, b ) => {
			// Sort by age, regardless of gender
			var i = subevents[ name ][ a ];
			var j = subevents[ name ][ b ];
			if( 'male' in i ) { i = i[ 'male' ]; } else if( 'female' in i ) { i = i[ 'female' ]; } else { return -1; }
			if( 'male' in j ) { j = j[ 'male' ]; } else if( 'female' in j ) { j = j[ 'female' ]; } else { return  1; }
			i = Object.keys( i )[ 0 ];
			j = Object.keys( j )[ 0 ];
			i = JSON.parse( i );
			j = JSON.parse( j );
			i = parseInt( i.age );
			j = parseInt( j.age );
			if( i == j ) { return  0; }
			if( i  > j ) { return  1; }
			if( i <  j ) { return -1; }
		})) {
			for( var gender in subevents[ name ][ subevent ] ) {
				var count = Object.values( subevents[ name ][ subevent ][ gender ]).map(( i ) => { return i.length; }).reduce(( acc, cur ) => { return acc + cur; });
				var tr   = html.tr.clone();
				var d    = Object.keys( subevents[ name ][ subevent ][ gender ])[ 0 ];
				var evnt = sparring_division_description( subevent, gender, d );
				var divs = Object.keys( subevents[ name ][ subevent ][ gender ]).length;
				var row  = {
					name       : html.td.clone().html( evnt ),
					categories : html.td.clone().html( divs ),
					count      : html.td.clone().html( count )
				};
				tr.append( row.name, row.categories, row.count );
				table.append( tr );
				divcount += divs;
				sum += count;
			}
		}
		tr = html.tr.clone();
		tr.append( html.th.clone().html( 'Total' ), html.th.clone().html( divcount ), html.th.clone().html( sum ));
		table.append( tr );
	}
}

$( '#import' ).off( 'click' ).click(( ev ) => {
	var request;
	request = { data : { type : 'registration', action : 'import' }};
	request.json = JSON.stringify( request.data );
	ws.worldclass.send( request.json );
	ws.sparring.send( request.json );
});

ws.worldclass.onopen = () => {
	var request;
	request = { data : { type : 'registration', action : 'read' }};
	request.json = JSON.stringify( request.data );
	ws.worldclass.send( request.json );
};

ws.worldclass.onmessage = ( response ) => {
	var update = JSON.parse( response.data );
	if( ! defined( update )) { return; }
	console.log( update );

	if( update.request.action == 'read' ) {
		if( update.male   ) { dropzone.disable( 'male'   ); } else { dropzone.enable( 'male'   ); }
		if( update.female ) { dropzone.disable( 'female' ); } else { dropzone.enable( 'female' ); }
	
	} else if( update.request.action == 'upload' ) {
		sound.next.play();
		page.transition( 2 );
		display_sport_poomsae_divisions( update.divisions );

	} else if( update.request.action == 'import' ) {
		if( update.result == 'success' ) {
			imported.poomsae = true;
			if( imported.poomsae && imported.sparring ) {
				var request;
				request = { data : { type : 'registration', action : 'clear' }};
				request.json = JSON.stringify( request.data );
				ws.worldclass.send( request.json );
			}
		} else {
			alertify.error( 'Import failed for World Class Poomsae' );
			sound.warning.play();
		}
	} else if( update.request.action == 'clear' ) {
		if( update.result == 'success' ) {
			sound.send.play();
			setTimeout(() => { window.location = 'index.php'; }, 750 );
		} else {
			alertify.error( 'Import failed for World Class Poomsae' );
			sound.warning.play();
		}
	}
};

ws.sparring.onopen = () => {
	var request;
	request = { data : { type : 'registration', action : 'read' }};
	request.json = JSON.stringify( request.data );
	ws.sparring.send( request.json );
};

ws.sparring.onmessage = ( response ) => { 
	var update = JSON.parse( response.data );
	if( ! defined( update )) { return; }
	console.log( update );

	if( update.request.action == 'upload' ) {
		display_sparring_divisions( update.divisions );

	} else if( update.request.action == 'import' ) {
		if( update.result == 'success' ) {
			imported.sparring = true;
			if( imported.poomsae && imported.sparring ) {
				var request;
				request = { data : { type : 'registration', action : 'clear' }};
				request.json = JSON.stringify( request.data );
				ws.worldclass.send( request.json );
			}
		} else {
			alertify.error( 'Import failed for Olympic Sparring' );
			sound.warning.play();
		}
	}
};
		</script>
	</body>
</html>
