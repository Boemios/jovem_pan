#!/usr/bin/nawk -f

#This parsing script was developed by Marco A Benatto and works as
#a wrapper to create_tables.php done by Allam Matsubara
#this software is a free software licensed under MIT license terms
#you can modify it to fir to your needs, but please keep author's
#name on the head of this file.

BEGIN {
	print "Starting awk wrapper for database creation scripts....\n"
}
{
	#table found
	tablef = 0;

	if ($1 == "-"){
		tablef = 1;
		line = 0;
		sql[0] = "CREATE TABLE " $2 "( ";

		
		print sql[0];
	}
}
END{
	print "done...\n"
}
