package FreeScore::Forms::WorldClass::Division;
use FreeScore;
use FreeScore::Forms::Division;
use FreeScore::Forms::WorldClass::Division::Round;
use FreeScore::Forms::WorldClass::Division::Round::Score;
use base qw( FreeScore::Forms::Division );

our @round_order = ( qw( prelim semfin finals ) );

# ============================================================
sub assign {
# ============================================================
# Assigns the athlete to a round; if the athlete is already 
# assigned to the round this function does nothing.
# ------------------------------------------------------------
	my $self    = shift;
	my $athlete = shift;
	my $round   = $self->{ round };
	my $forms   = exists $self->{ forms }{ $round } ? int(@{ $self->{ forms }{ $round }}) : 0;
	my $judges  = $self->{ judges };

	return if exists $athlete->{ scores }{ $round };
	$athlete->{ scores }{ $round } = new FreeScore::Forms::WorldClass::Division::Round( [], $forms, $judges );
}

# ============================================================
sub place_athletes {
# ============================================================
	my $self      = shift;
	my $round     = shift;
	my $placement = shift;
	my $tied      = {};

	# ===== PLACE ATHLETES
	my @athlete_indices = ( 0 .. $#{ $self->{ athletes }} );
	@$placement = sort { 
		# TODO Select compulsory rounds for x and y
		my $x = exists $self->{ athletes }[ $a ]{ scores }{ $round } ? $self->{ athletes }[ $a ]{ scores }{ $round } : undef;
		my $y = exists $self->{ athletes }[ $b ]{ scores }{ $round } ? $self->{ athletes }[ $b ]{ scores }{ $round } : undef;
		Forms::WorldClass::Division::Round::_compare( $x, $y ); 
	} @athlete_indices;

	# ===== TIE DETECTION
	# We could do tie detection during placement, but that would be inefficient
	# (i.e. redundant detection for every pairwise comparison) and incomplete
	# (i.e.  we don't know which place the athletes are tied for; two athletes
	# tied for 1st place, for example)
	my $i = 0;
	while( $i < $k ) {
		my $a = $placement->[ $i ];
		my $x = exists $self->{ athletes }[ $a ]{ scores }{ $round } ? $self->{ athletes }[ $a ]{ scores }{ $round } : undef;
		my $j = $i + 1;
		while( $j < $k ) {
			my $b = $placement->[ $j ];
			my $y = exists $self->{ athletes }[ $b ]{ scores }{ $round } ? $self->{ athletes }[ $b ]{ scores }{ $round } : undef;
			last unless abs( Forms::WorldClass::Division::Round::_compare( $x, $y )) >= 0.005;
			push @{ $tied->{ $round }{ $i }}, $j; 
			$j++;
		}
		$i = $j;
	}
}

# ============================================================
sub get_only {
# ============================================================
	my $self  = shift;
	my $judge = shift;
	my $round = $self->{ round };

	foreach my $athlete (@{ $self->{ athletes }}) {
		$athlete->{ scores } = { $round => $athlete->{ scores }{ $round } };
		foreach my $form (@{$athlete->{ scores }{ $round }}) {
			$form->{ judge } = [ $form->{ judge }[ $judge ] ];
		}
	}
}

# ============================================================
sub record_score {
# ============================================================
	my $self  = shift;
	my $judge = shift;
	my $score = shift;

	$score = new FreeScore::Forms::WorldClass::Division::Round::Score({ %$score });
	my $i = $self->{ current };
	my $j = $self->{ round };
	my $k = $self->{ form };

	$self->{ athletes }[ $i ]{ scores }{ $j }[ $k ]{ judge }[ $judge ] = $score;
	$self->update_status();
}

# ============================================================
sub read {
# ============================================================
	my $self  = shift;

	# ===== DEFAULTS
	$self->{ state }   = 'score';
	$self->{ current } = 0;
	$self->{ round }   = 'finals';

	my $athlete = {};
	my $table   = { max_rounds => {}, max_forms => 0, max_judges => 0 };
	open FILE, $self->{ file } or die "Can't read '$self->{ file }' $!";
	while( <FILE> ) {
		chomp;
		next if /^\s*$/;

		# ===== READ DIVISION STATE INFORMATION
		if( /^#/ ) {
			s/^#\s+//;
			my ($key, $value) = split /=/;
			if( $key eq 'forms' ) { $self->{ $key } = _parse_forms( $value ); }
			else                  { $self->{ $key } = $value;                 }
			next;

		# ===== READ DIVISION ATHLETE INFORMATION
		} elsif( /^\w/ ) {
			if( $athlete->{ name } ) {
				push @{ $self->{ athletes }}, $athlete;
				$athlete = {};
			}

			my ($name, $rank, $age) = split /\t/;

			$athlete->{ name }   = $name;
			$athlete->{ rank }   = $rank;
			$athlete->{ age }    = $age;
			$athlete->{ scores } = {};

		# ===== READ DIVISION ATHLETE SCORES
		} elsif( /^\t/ ) {
			s/^\t//;
			my ($round, $form, $judge, $major, $minor, $rhythm, $power, $ki) = split /\t/;
			$self->{ rounds }{ $round } = 1;

			$table->{ max_rounds }{ $round }++;
			$table->{ max_forms }  = $table->{ max_forms }  > $form  ? $table->{ max_forms }  : $form;
			$table->{ max_judges } = $table->{ max_judges } > $judge ? $table->{ max_judges } : $judge;
			$form  =~ s/f//; $form  = int( $form )  - 1;
			$judge =~ s/j//; $judge = int( $judge ) - 1;

			$athlete->{ scores }{ $round }[ $form ] = { judge => [] } unless exists $athlete->{ scores }{ $round }[ $form ]{ judge };
			$athlete->{ scores }{ $round }[ $form ]{ judge }[ $judge ] = { judge => $judge, major => $major, minor => $minor, rhythm => $rhythm, power => $power, ki => $ki };

		} else {
			die "Unknown line type '$_'\n";
		}
	}
	push @{ $self->{ athletes }}, $athlete if( $athlete->{ name } );
	close FILE;

	# ===== INITIALIZE EACH ROUND (IF NOT ALREADY INITIALIZED)
	ROUND_SETUP: {
		my $round    = local $_ = $self->{ round };
		my $n        = int( @{ $self->{ athletes }} );

		if     ( /^prelim$/ ) { 
			last ROUND_SETUP unless $n >= 20;
			$self->assign( $_ ) foreach ( @{ $self->{ athletes }} );

		} elsif( /^semfin$/ ) {
			last ROUND_SETUP unless $n > 8 && $n < 20;
			$self->assign( $_ ) foreach ( @{ $self->{ athletes }} );

		} elsif( /^finals$/ ) {
			last ROUND_SETUP unless $n <= 8;
			$self->assign( $_ ) foreach ( @{ $self->{ athletes }} );
		}
	}

	# ===== COMPLETE THE TABLE OF SCORES
	$table->{ max_judges } = $self->{ judges } if( exists $self->{ judges } );
	$table->{ max_rounds } = [ grep { exists $table->{ max_rounds }{ $_ } } @FreeScore::Forms::WorldClass::Division::round_order ];
	foreach my $athlete (@{ $self->{ athletes }}) {
		foreach my $round (@{ $table->{ max_rounds }}) {
			foreach my $i ( 0 .. $table->{ max_forms } ) {
				my $judge_scores = $athlete->{ scores }{ $round }[ $i ];
				$judge_scores->{ judge } = [] unless exists $judge_scores->{ judge };
				foreach my $j ( 0 .. ($table->{ max_judges } - 1) ) {
					next if( ref $judge_scores->{ judge }[ $j ] );
					$judge_scores->{ judge }[ $j ] = { major => undef, minor => undef, rhythm => undef, power => undef, ki => undef };
				}
			}
			$athlete->{ scores }{ $round } = new FreeScore::Forms::WorldClass::Division::Round( $athlete->{ scores }{ $round } );
		}
	}
}

# ============================================================
sub update_status {
# ============================================================
	my $self  = shift;

	# ==== SKIP STATUS UPDATE UNLESS ROUND IS NOT INITIALIZED OR ROUND IS COMPLETE
	# This avoids unnecessary processing
	return unless $self->round_complete( $self->{ round } );

	# ===== ORGANIZE ATHLETES BY ROUND
	my $tie        = 0; # a constant representing a tie
	my $completed  = {};
	my $resolved   = {};
	my $n          = int( @ { $self->{ athletes }});
	my $placement  = {};
	my $round      = $self->{ round };

	return unless $self->round_complete( $round );

	# ===== SORT THE ATHLETES TO THEIR PLACES (1st, 2nd, etc.) AND DETECT TIES
	# $self->place_athletes( $placement );


	return $placement;
}

# ============================================================
sub round_complete {
# ============================================================
	my $self  = shift;
	my $round = shift;

	my $complete = 1;
	my $compulsory_forms = grep { $_->{ type } eq 'compulsory' } @{$self->{ forms }{ $round }};
	foreach my $athlete (@{$self->{ athletes }}) {
		next unless exists $athlete->{ scores }{ $round };
		$complete &&= $athlete->{ scores }{ $round }->complete();
	}
	return $complete;
}

# ============================================================
sub round_resolved {
# ============================================================
	my $self  = shift;
	my $round = shift;
	my $tie   = 0;

	my $athletes = [ grep { exists $_->{ scores }{ $round } } @{ $self->{ athletes }} ];

	foreach my $i ( 0 .. $#$athletes ) {
		my $a = $athletes->[ $i ]{ scores }{ $round };
		foreach my $j ( $i + 1 .. $#$athletes ) {
			$b = $athletes->[ $j ]{ scores }{ $round };
			my $has_tie = FreeScore::Forms::WorldClass::Division::Round::_compare( $a, $b ) == $tie;
			if( $has_tie ) { return 0; }
		}
	}
	return 1;
}

# ============================================================
sub write {
# ============================================================
	my $self = shift;
	my @criteria = qw( major minor rhythm power ki );

	# ===== COLLECT THE FORM NAMES TOGETHER PROPERLY
	my @forms = ();
	foreach my $round (@FreeScore::Forms::WorldClass::Division::round_order) {
		next unless exists $self->{ forms }{ $round };
		push @forms, "$round:" . join( ",", map { $_->{ type } eq 'tiebreaker' ? "$->{ name } ($_->{ type })" : $_->{ name }; } @{$self->{ forms }{ $round }} );
	}

	open FILE, ">$self->{ file }" or die "Can't write '$self->{ file }' $!";
	print FILE "# state=$self->{ state }\n";
	print FILE "# current=$self->{ current }\n";
	print FILE "# form=$self->{ form }\n";
	print FILE "# round=$self->{ round }\n";
	print FILE "# judges=$self->{ judges }\n";
	print FILE "# description=$self->{ description }\n";
	print FILE "# forms=" . join( ";", @forms ) . "\n";
	my $forms = int( split /,/, $self->{ forms } );
	foreach my $athlete (@{ $self->{ athletes }}) {
		print FILE join( "\t", @{ $athlete }{ qw( name rank age ) }), "\n";

		foreach my $round (@FreeScore::Forms::WorldClass::Division::round_order) {
			next unless exists $athlete->{ scores }{ $round };
			my $forms = $athlete->{ scores }{ $round };
			for( my $i = 0; $i <= $#$forms; $i++ ) {
				my $form   = $forms->[ $i ];
				my $judges = $form->{ judge };
				foreach my $j (0 .. $#$judges) {
					my $score = $judges->[ $j ];
					my @scores = map { defined $_ ? sprintf( "%.1f", $_ ) : '' } @{ $score }{ @criteria };
					printf FILE "\t" . join( "\t", $round, 'f' . ($i + 1), 'j' . ($j + 1), @scores ) . "\n";
				}
			}
		}
	}
	close FILE;
}

# ============================================================
sub next_round {
# ============================================================
	my $self   = shift;
	my @rounds = @FreeScore::Forms::WorldClass::Division::round_order;
	my @i      = (0 .. $#rounds);
	my ($i)    = grep { $self->{ round } eq $rounds[ $_ ] } @i;
	if( $i == $#rounds ) { $i = 0; }
	else { $i++; }

	$self->{ round } = $rounds[ $i ];
}

# ============================================================
sub previous_round {
# ============================================================
	my $self   = shift;
	my @rounds = @FreeScore::Forms::WorldClass::Division::round_order;
	my @i      = (0 .. $#rounds);
	my ($i)    = grep { $self->{ round } eq $rounds[ $_ ] } @i;
	if( $i == 0 ) { $i = $#rounds; }
	else { $i--; }

	$self->{ round } = $rounds[ $i ];
}


# ============================================================
sub next {
# ============================================================
	my $self = shift;
	$self->{ state } = 'score';

	my $round     = $self->{ round };
	my $form      = $self->{ form };
	my $max_forms = $#{ $self->{ forms }{ $round }};

	if( $form < $max_forms ) {
		$self->{ form }++;
	} else {
		$self->{ current } = ($self->{ current } + 1) % int( @{ $self->{ athletes }});
		$self->{ form } = 0;
	}
}

# ============================================================
sub previous {
# ============================================================
	my $self = shift;
	$self->{ state } = 'score';

	my $round        = $self->{ round };
	my $form         = $self->{ form };
	my $max_forms    = $#{ $self->{ forms }{ $round }};
	my $previous     = ($self->{ current } - 1);
	my $max_athletes = $#{ $self->{ athletes }};

	if( $form > 0 ) {
		$self->{ form }--;
	} else {
		$self->{ current } = $previous >= 0 ? $previous: $max_athletes;
		$self->{ form }    = $max_forms;
	}
}

# ============================================================
sub _filter_unimportant_ties {
# ============================================================
	my $assigned         = shift; # Number of athletes in the round
	my $ties             = shift; # 
	my $order            = shift;
	my $places_available = shift; # Places available
	my $n                = shift;

	# Count number of places needed
	my $places_needed = 0;
	while( $places_needed < $places_available ) {
		$places_needed++;
		next unless exists $ties->{ $places_needed };
		my $num_ties = int( @{ $ties->{ $places_needed }} );

		# Deal with ties that cross the number of available places (e.g. 3 ties for 19th place out of 20 available places; 2 of 3 ties will advance)
		if( $places_needed + $num_ties > $places_available ) {
			my @athletes = map { my $i = $order->[ $_ ]; $self->{ athletes }[ $i ]; } ($places_needed, @{ $ties->{ $places_needed }});
			foreach my $athlete (@athletes) {
				$athlete->{ scores }{ $round } = [] unless exists $athlete->{ scores }{ $round };
			}
		} else {
			# Discard ties that are placed comfortably within the top athletes; they move on to the next round
			delete $ties->{ $places_needed };
		}
		$places_needed += $num_ties;
	}
	# Discard ties that are placed past the top athletes; they don't move on to the next round
	while( $places_needed < $n ) {
		delete $ties->{ $places_needed } if exists $ties->{ $places_needed };
		$places_needed++;
	}
}

# ============================================================
sub _parse_forms {
# ============================================================
# Compulsory forms are optionally labeled. Tiebreaker forms 
# must be labeled.
# ------------------------------------------------------------
	my $value = shift;

	my @rounds = map { 
		my ($round, $forms) = split /:/;
		my @forms = map { my ($name, $type) = /^([\w\s]+)(?:\s\((compulsory|tiebreaker)\))?/; { name => $name, type => $type || 'compulsory' }; } split /,\s?/, $forms;
		$round => [ @forms ];
	} split /;/, $value;
	return { @rounds }; 
}

1;
