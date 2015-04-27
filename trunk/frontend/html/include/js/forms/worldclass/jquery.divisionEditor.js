
$.widget( "freescore.divisionEditor", {
	options: { autoShow: true, },
	_create: function() {
		var o = this.options;
		var e = this.options.elements = {};

		var html      = e.html      = FreeScore.html;
		var division  = e.division  = html.div.clone();
		var edit      = e.edit      = html.div.clone();
		var header    = e.header    = html.div.clone();
		var list      = e.list      = html.ol.clone() .attr( "data-role", "listview" ) .attr( "id", "list" );

		var actions   = e.actions   = {
			athlete : html.div.clone(),
			reset   : html.a.clone(),
			remove  : html.a.clone(),
			close   : html.a.clone(),
		}

		actions.reset
			.addClass( "ui-btn ui-icon-back ui-btn-icon-left" )
			.html( "Clear Score" )
			.click( function( ev ) { } );

		actions.remove
			.addClass( "ui-btn ui-icon-minus ui-btn-icon-left" )
			.html( "Remove" )
			.click( function( ev ) { } );

		actions.close
			.addClass( "ui-btn ui-icon-delete ui-btn-icon-left" )
			.html( "Cancel" )
			.attr( "href", "#list" )
			.attr( "data-rel", "close" );

		edit 
			.attr( "data-role", "panel" ) 
			.attr( "data-position", "right" ) 
			.attr( "data-display", "overlay" ) 
			.attr( "data-theme", "b" ) 
			.attr( "id", "edit-panel" )
			.append( actions.athlete, actions.reset, actions.remove, actions.close );
		
		division.append( edit, header, list );
		this.element .append( division );
	},

	_init: function() {
		var e       = this.options.elements;
		var o       = this.options;
		var html    = e.html;

		// ============================================================
		function refresh( update ) {
		// ============================================================
			var tournament = JSON.parse( update.data );
			o.division = tournament.divisions[ 2 ]; // MW

			e.list.empty();
			for( var i in o.division.athletes ) {
				var athlete = { 
					data     : o.division.athletes[ i ],
					name     : html.text.clone(),
					view     : html.div.clone(),
					move     : html.div.clone(),
					moveup   : html.a.clone(),
					movedown : html.a.clone(),
					actions  : html.div.clone(),
					edit     : html.a.clone(),
					listitem : html.li.clone() .attr( "data-icon", "ui-icon-user" ),
				};


				athlete.view
					.css( "display", "inline-block" )
					.css( "width", "95%" );

				athlete.name
					.css( "border", "0" )
					.css( "font-weight", "bold" )
					.css( "font-size", "14pt" )
					.css( "margin-top", "10px" )
					.attr( "value", athlete.data.name );

				athlete.move
					.addClass( "ui-nodisc-icon" )
					.css( "padding", "8px" )
					.css( "background", "#eee" )
					.css( "border-radius", "24px" )
					.css( "margin-right", "24px" )
					.css( "float", "left" );

				athlete.moveup
					.addClass( "ui-btn ui-icon-arrow-u ui-btn-icon-notext ui-btn-inline" )
					.css( "margin", "0 1px 0 0" )
					.css( "border-radius", "24px 0 0 24px" )
					.css( "border", "0" )
					.css( "background", "#999" )
					.click( function( ev ) { console.log( ev ) } );

				athlete.movedown
					.addClass( "ui-btn ui-icon-arrow-d ui-btn-icon-notext ui-btn-inline" )
					.css( "margin", "0 0 0 0" )
					.css( "border-radius", "0 24px 24px 0" )
					.css( "border", "0" )
					.css( "background", "#999" )
					.click( function( ev ) { console.log( ev ) } );

				athlete.edit
					.addClass( "ui-btn ui-icon-edit ui-btn-icon-notext ui-btn-inline" )
					.attr( "athlete", i )
					.css( "margin", "0 1px 0 0" )
					.css( "border-radius", "24px" )
					.css( "margin-top", "8px" )
					.css( "border", "0" )
					.css( "float", "right" )
					.click( function( ev ) { 
						var i = $( this ).attr( "athlete" ); 
						var athlete = o.division.athletes[ i ];
						o.current = athlete;
						e.actions.athlete.html( athlete.name ); e.edit.panel( "open" ); 
					});

				athlete.move.append( athlete.moveup, athlete.movedown );

				athlete.view.append( athlete.move, athlete.name, athlete.edit );
				athlete.listitem.append( athlete.view );
				e.list.append( athlete.listitem );
			}
			e.list.listview( "refresh" );
		};

		e.source = new EventSource( '/cgi-bin/freescore/forms/worldclass/update?tournament=' + o.tournament.db );
		e.source.addEventListener( 'message', refresh, false );
	},
});