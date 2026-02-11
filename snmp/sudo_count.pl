#!/usr/bin/perl
use strict;
use warnings;

my @arrsudo;

open(my $fh, "<", "/var/log/auth.log") or exit 1;

while(my $line = <$fh>) {
	if($line =~ /sudo:.*COMMAND=/) {
		push @arrsudo, $line;
	}
}

close($fh);

print scalar(@arrsudo);
