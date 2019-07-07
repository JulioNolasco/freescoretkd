<?php
	include "./include/php/version.php";
	include "./include/php/config.php";
?>
<html>
	<head>
		<title>Staging</title>
		<link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="include/bootstrap/add-ons/bootstrap-select.min.css" rel="stylesheet" />
		<link href="include/css/freescore-light.css" rel="stylesheet" />
		<link href="include/css/staging.css" rel="stylesheet" />
		<link href="include/page-transitions/css/animations.css" rel="stylesheet" type="text/css" />
		<link href="include/alertify/css/alertify.min.css" rel="stylesheet" />
		<link href="include/alertify/css/themes/bootstrap.min.css" rel="stylesheet" />
		<link href="include/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
		<script src="include/later/js/later.min.js"></script>
		<script src="include/jquery/js/jquery.js"></script>
		<script src="include/jquery/js/jquery.howler.min.js"></script>
		<script src="include/jquery/js/jquery-dateformat.min.js"></script>
		<script src="include/bootstrap/js/bootstrap.min.js"></script>
		<script src="include/bootstrap/add-ons/bootstrap-select.min.js"></script>
		<script src="include/bootstrap/add-ons/bootstrap-list-filter.min.js"></script>
		<script src="include/bootstrap/add-ons/bootstrap-sortable.min.js"></script>
		<script src="include/alertify/alertify.min.js"></script>
		<script src="include/js/freescore.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
body {
	margin: 12px;
}
		</style>
	</head>
	<body>
<script>
var refresh = {};
</script>
		<button class="btn btn-primary" id="announcer">Enable Announcer</button>
		<div id="pt-main" class="pt-perspective">
<?php include( 'staging/checkin.php' ); ?>
		</div>
<script src="include/page-transitions/js/pagetransitions.js"></script>
<script>
alertify.set( 'notifier', 'position', 'top-right' );

var announcer = { messages: []};
announcer.message = ( text ) => {
	announcer.messages.push( text );
	$( '#announcer' ).removeClass( 'disabled' ).html( `Announcer has ${announcer.messages.length} messages` );
};
announcer.speak = () => {
	if( announcer.messages.length == 0 ) { return; }
	let text = announcer.messages.shift();
	if( typeof text === 'object' ) { text = `${text.first_name} ${text.last_name}`; alertify.notify( `<b>Announcer</b><br>${text}` ); text = text.toLowerCase(); } else { alertify.notify( `<b>Announcer</b><br>${text}` ); }
	let message = new SpeechSynthesisUtterance( text );
	message.voice = speechSynthesis.getVoices().filter( voice => voice.name == 'Google US English' ).shift();
	window.speechSynthesis.speak( message )
	message.onend = ( e ) => { 
		let n = announcer.messages.length;
		if( n == 0 ) {
			$( '#announcer' ).addClass( 'disabled' ).html( 'Announcer Muted' );
		} else {
			$( '#announcer' ).html( `Announcer has ${n} messages` );
		}
		setTimeout(() => { announcer.speak(); }, 800 ); }; // Wait 1 second and say the next item in the queue
};

var sound = {
	send      : new Howl({ urls: [ "./sounds/upload.mp3",   "./sounds/upload.ogg"   ]}),
	confirmed : new Howl({ urls: [ "./sounds/received.mp3", "./sounds/received.ogg" ]}),
	next      : new Howl({ urls: [ "./sounds/next.mp3",     "./sounds/next.ogg"     ]}),
	previous  : new Howl({ urls: [ "./sounds/prev.mp3",     "./sounds/prev.ogg"     ]}),
};

var host       = '<?= $host ?>';
var tournament = <?= $tournament ?>;
var html       = FreeScore.html;

var page = {
	num : 1,
	transition: ( ev ) => { page.num = PageTransitions.nextPage({ animation: page.animation( page.num )}); },
	animation:  ( pn ) => {
		switch( pn ) {
			case 1: return 1;
			case 2: return 2;
		}
	}
};

$(() => {
	announcer.message( 'Hello' );
	announcer.message( 'First call for Obstacle Course Division OC01A' );
	registration.events[ 'Obstacle Course' ][ 'oc01a' ].athletes.forEach(( id ) => { announcer.message( registration.athletes[ id ]); });
	announcer.message( 'This is your first call for Obstacle Course Division OC01A. You have 30 minutes to report to the staging area.' );
	announcer.message( 'Repeating first call for Obstacle Course Division OC01A' );
	registration.events[ 'Obstacle Course' ][ 'oc01a' ].athletes.forEach(( id ) => { announcer.message( registration.athletes[ id ]); });
	announcer.message( 'Please report to the staging area for Obstacle Course Division OC01A' );
	announcer.message( 'Again, first call for Obstacle Course Division OC01A' );
	registration.events[ 'Obstacle Course' ][ 'oc01a' ].athletes.forEach(( id ) => { announcer.message( registration.athletes[ id ]); });
	announcer.message( 'This is your first call for Obstacle Course Division OC01A. You have 30 minutes.' );
});

$( '#announcer' ).off( 'click' ).click(( ev ) => {
	announcer.speak();
});

// ===== SERVER COMMUNICATION
var server = {
//	worldclass: new WebSocket( 'ws://' + host + ':3088/worldclass/' + tournament.db + '/staging' ),
//	grassroots: new EventSource( 'http://' + host + '/cgi-bin/freescore/forms/grassroots/update?tournament=' + tournament.db ),
//	sparring:   new WebSocket( 'ws://' + host + ':3086/sparring/' + tournament.db + '/staging' ),
};

/*
server.grassroots.addEventListener( 'message', ( update ) => {
	console.log( 'Grassroots', update );
}, false );
 */

/* Sparring server doesn't handle reads yet
server.sparring.onopen = () => {
	var request;

	request = { data : { type : 'ring', action : 'read' }};
	request.json = JSON.stringify( request.data );
	server.worldclass.send( request.json );
};

server.sparring.onmessage = ( response ) => {
	var update = JSON.parse( response.data );
	console.log( 'Sparring', update );
};
*/

/*
server.worldclass.onopen = () => {
	var request;

	request = { data : { type : 'ring', action : 'read' }};
	request.json = JSON.stringify( request.data );
	server.worldclass.send( request.json );
};

server.worldclass.onmessage = ( response ) => {
	var update = JSON.parse( response.data );
	console.log( 'Worldclass', update );
};
 */
</script>
	</body>
</html>
