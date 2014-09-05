package FreeScore::Forms;
use FreeScore;
use FreeScore::Forms::Division;

# ============================================================
sub new {
# ============================================================
	my ($class) = map { ref || $_ } shift;
	my $self = bless {}, $class;
	$self->init( @_ );
	return $self;
}

# ============================================================
sub pre_init {
# ============================================================
	my $self       = shift;
	my $tournament = shift;
	my $ring       = shift;

	$self->{ file } = "$self->{ path }/progress.txt";

	if( -e $self->{ file } ) {
		open FILE, $self->{ file };
		while( <FILE> ) {
			chomp;
			next if /^\s*$/;

			# ===== READ DIVISION PROGRESS STATE INFORMATION
			if( /^#/ ) {
				s/^#\s+//;
				my ($key, $value) = split /=/;
				$self->{ $key } = $value;
				next;
			}
		}
		close FILE;
	}

	opendir DIR, $self->{ path } or die "Can't open directory '$self->{ path }' $!";
	my @divisions = map { /^div\.(\w+)\.txt$/; } grep { /^div\.\w+\.txt$/ } readdir DIR;
	closedir DIR;

	$self->{ divisions } = [ @divisions ];
	$self->{ current } ||= 0;
}

# ============================================================
sub write {
# ============================================================
	my $self = shift;

	open FILE, ">$self->{ file }" or die "Can't write '$self->{ file }' $!";
	print FILE "# current=$self->{ current }\n";
	close FILE;
}

sub current  { my $self = shift; return $self->{ divisions }[ $self->{ current }]; }
sub next     { my $self = shift; my $i = $self->{ current }; $i = ($i + 1) % int(@{ $self->{ divisions }}); $self->{ current } = $i; }
sub previous { my $self = shift; my $i = $self->{ current }; $i = ($i - 1) >= 0 ? ($i -1) : $#{ $self->{ divisions }}; $self->{ current } = $i; }
sub TO_JSON  { my $self = shift; return { %$self }; }
1;