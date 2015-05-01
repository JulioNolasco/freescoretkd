$.widget( "freescore.formSelector", {
	options: { autoShow: true, num: 0 },
	_create: function() {
		var widget = this.element;
		var o      = this.options;
		var e      = this.options.elements = {};
		var html   = e.html = FreeScore.html;

		// ============================================================
		// BEHAVIOR
		// ============================================================
		var forms = FreeScore.rulesUSAT.recognizedPoomsae( o.format, o.age, o.rank );
		forms.unshift( 'None' );

		// ============================================================
		var getForms = function() {
		// ============================================================
			var map        = { 'Preliminaries' : 'prelim', 'Semi-Finals' : 'semfin', 'Finals 1st form' : 'finals', 'Finals 2nd form' : 'finals' };
			o.selected     = { order : [ 'prelim', 'semfin', 'finals' ], prelim : [], semfin : [], finals : [] };
			for( var i in all ) {
				var round     = all[ i ];
				var roundName = round.children( ".ui-controlgroup-label" ).children( "legend" ).html();
				var forms     = round.children( ".ui-controlgroup-controls" ).children().children( "input" );
				var selected  = forms.filter( ":checked" ).val();

				var roundCode = map[ roundName ];
				if( selected != 'None' ) { o.selected[ roundCode ].push( selected ) };
			}
			var group = [];
			for( var i in o.selected.order ) {
				var round = o.selected.order[ i ];
				if( o.selected[ round ].length > 0 ) { group.push( round + ':' + o.selected[ round ].join( "," )); }
			}
			o.selected.text = group.join( ";" );
			console.log( o.selected.text );
		};

		// ============================================================
		// BEHAVIOR
		// ============================================================
		var reset    = function() {
			for( var i in all ) {
				var round = all[ i ];
				var forms = round.children( ".ui-controlgroup-controls" ).children().children( "input" );
				for( var j in forms ) {
					var button = $( forms[ j ] );
					button .prop( "checked", false );
					console.log( button, j );
				}
			}
		};

		var handle   = {
			select : function( ev ) {
				var val        = $( ev.target ).val();
				var selectedId = $( ev.target ).attr( "id" );
				for( var i in all ) {
					var round     = all[ i ];
					var forms     = round.children( ".ui-controlgroup-controls" ).children().children( "input" );
					var column    = $.grep( forms, function( item ) { return $( item ).val() == val } );
					var columnId  = $( column ).attr( "id" );
					var selected  = forms.filter( ":checked" ).val();

					if( columnId != selectedId && val != "None" ) {
						var none   = $( '#' + columnId.replace( /\d+$/, '0' ));
						var button = $( '#' + columnId );
						if( button .prop( "checked" )) {
							button .prop( "checked", false ) .checkboxradio( "refresh" );
							none   .prop( "checked", true )  .checkboxradio( "refresh" );
						}
					}
				}
				getForms();
			},
			accept : function( ev ) {
			},
			cancel : function( ev ) {
			},
			random : function( ev ) {
				// ===== PICK A RANDOM FORM FOR EVERY ROUND
				var randomPicks = [];
				for( var i in all ) { 
					var round        = all[ i ];
					var forms        = round.children( ".ui-controlgroup-controls" ).children().children( "input" );
					var originalPick = true;
					picking: while( originalPick ) {
						var pick  = Math.ceil( Math.random() * (forms.length - 1));
						for( var i in randomPicks ) { if( randomPicks[ i ] == pick ) { continue picking; } }
						randomPicks.push( pick ); 
						originalPick = false;
					}
				}
				randomPicks = randomPicks.sort( numeric );

				// ===== CHECK THE RADIO BOXES
				for( var i in all ) {
					var round     = all[ i ];
					var forms     = round.children( ".ui-controlgroup-controls" ).children().children( "input" );
					var pick      = randomPicks.shift();
					var button    = $( forms[ pick ]);
					forms.filter( ":checked" ) .prop( "checked", false ) .checkboxradio( "refresh" );
					button .prop( "checked", true  ) .checkboxradio( "refresh" );
				}
				getForms();
			},
		};

		var prelim = addButtonGroup( "Preliminaries",   forms, handle.select );
		var semfin = addButtonGroup( "Semi-Finals",     forms, handle.select );
		var final1 = addButtonGroup( "Finals 1st form", forms, handle.select );
		var final2 = addButtonGroup( "Finals 2nd form", forms, handle.select );
		var all    = [];

		if( o.athletes > 20 ) { all.push( prelim ); }
		if( o.athletes > 8  ) { all.push( semfin ); }
		all.push( final1 );
		all.push( final2 );

		// ===== SELECT "None" BUTTON BY DEFAULT
		all.map( function( item ) { 
			var name = item.children( "legend" ).html().toLowerCase().replace( / /g, '-' );
			item.children( '#' + name + '-0' ).prop( "checked", true ) 
		});

		// ===== CONVERT TO A FIELDCONTAIN (LABEL AND BUTTONS ON ONE LINE)
		var formSelect = e.formSelect = all.map( function( item ) { var div = html.div.clone() .attr( "data-role", "fieldcontain" ) .append( item ); return div; })
		var actions    = e.actions    = html.div.clone() .attr( "data-role", "control-group" ) .attr( "data-type", "horizontal" ) .attr( "data-mini", true ) .css( "margin-left", "20%" );

		actions.append(
			html.a.clone() .attr( "data-role", "button" ) .attr( "data-icon", "star" )   .css( "width", "120px" ) .html( "Random" ) .click( handle.random ),
			html.a.clone() .attr( "data-role", "button" ) .attr( "data-icon", "check" )  .css( "width", "120px" ) .html( "OK" )     .click( handle.accept ),
			html.a.clone() .attr( "data-role", "button" ) .attr( "data-icon", "delete" ) .css( "width", "120px" ) .html( "Cancel" ) .click( handle.cancel )
		);

		actions.controlgroup().controlgroup( "refresh" );

		widget.append( formSelect, actions );
	},
	_init: function( ) {
		var widget = this.element;
		var o      = this.options;
		var e      = this.options.elements;
	}
});
