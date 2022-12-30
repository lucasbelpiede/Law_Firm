<?php

	// Define some tests :-)

	$tests		= array();

	$tests[]	= array(
				'expression'		=> '10,20,45 9,10,11,12 * * *',
				'reftime'		=> mktime(9,9,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 09:10:00',
				'expected_l'		=> '01.08.2010, 12:45:00'
				);

	$tests[]	= array(
				'expression'		=> '10,20,45 9,10,11,12 * * *',
				'reftime'		=> mktime(9,46,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 10:10:00',
				'expected_l'		=> '02.08.2010, 09:45:00'
				);

	$tests[]	= array(
				'expression'		=> '10,20,45 9,10,11,12 * * *',
				'reftime'		=> mktime(12,46,0,8,2,2010),
				'expected_n'		=> '03.08.2010, 09:10:00',
				'expected_l'		=> '02.08.2010, 12:45:00'
				);

	$tests[]	= array(
				'expression'		=> '10,20,45 9,10,11,12 * * *',
				'reftime'		=> mktime(10,36,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 10:45:00',
				'expected_l'		=> '02.08.2010, 10:20:00'
				);

	$tests[]	= array(
				'expression'		=> '10,20,45 9,10,11,12 * * *',
				'reftime'		=> mktime(12,46,0,8,2,2010),
				'expected_n'		=> '03.08.2010, 09:10:00',
				'expected_l'		=> '02.08.2010, 12:45:00'
				);

	$tests[]	= array(
				'expression'		=> '25 9,10,12 * * *',
				'reftime'		=> mktime(10,20,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 10:25:00',
				'expected_l'		=> '02.08.2010, 09:25:00'
				);

	$tests[]	= array(
				'expression'		=> '1,2,10-20,40-50/5 10,11,12 * * *',
				'reftime'		=> mktime(9,45,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 10:01:00',
				'expected_l'		=> '01.08.2010, 12:50:00'
				);

	$tests[]	= array(
				'expression'		=> '10,30,50 10,11,12 * * *',
				'reftime'		=> mktime(11,45,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 11:50:00',
				'expected_l'		=> '02.08.2010, 11:30:00'
				);

	$tests[]	= array(
				'expression'		=> '* * 29 2 *',
				'reftime'		=> mktime(11,45,0,8,2,2010),
				'expected_n'		=> '29.02.2012, 00:00:00',
				'expected_l'		=> '29.02.2008, 23:59:00'
				);

	$tests[]	= array(
				'expression'		=> '* * * * *',
				'reftime'		=> mktime(11,45,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 11:45:00',
				'expected_l'		=> '02.08.2010, 11:45:00'
				);

	$tests[]	= array(
				'expression'		=> '* * 3 6 3',
				'reftime'		=> mktime(11,45,0,8,2,2010),
				'expected_n'		=> '03.06.2015, 00:00:00',
				'expected_l'		=> '03.06.2009, 23:59:00'
				);

	$tests[]	= array(
				'expression'		=> '* * 3 Feb Sat',
				'reftime'		=> mktime(11,45,0,8,2,2010),
				'expected_n'		=> '03.02.2018, 00:00:00',
				'expected_l'		=> '03.02.2007, 23:59:00'
				);

	$tests[]	= array(
				'expression'		=> '*/15 * * * *',
				'reftime'		=> mktime(11,40,0,8,2,2010),
				'expected_n'		=> '02.08.2010, 11:45:00',
				'expected_l'		=> '02.08.2010, 11:30:00'
				);

	$tests[]	= array(
				'expression'		=> '*/15 * * * Fri,Tue',
				'reftime'		=> mktime(11,40,0,8,2,2010),
				'expected_n'		=> '03.08.2010, 00:00:00',
				'expected_l'		=> '30.07.2010, 23:45:00'
				);

	$tests[]	= array(
				'expression'		=> '*/15 * 1 4 Fri,Tue',
				'reftime'		=> mktime(11,40,0,8,2,2010),
				'expected_n'		=> '01.04.2011, 00:00:00',
				'expected_l'		=> '01.04.2008, 23:45:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> next day',
				'expression'		=> '10,20,45 9,10,11 * * *',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_n'		=> '02.02.2010, 09:10:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> last day',
				'expression'		=> '10,20,45 9,10,11 * * *',
				'reftime'		=> mktime(9,5,0,2,1,2010),
				'expected_l'		=> '31.01.2010, 11:45:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> next day -> LEAP YEAR',
				'expression'		=> '10,20,45 9,10,11 * * *',
				'reftime'		=> mktime(11,50,0,2,28,2008),
				'expected_n'		=> '29.02.2008, 09:10:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> last day -> LEAP YEAR',
				'expression'		=> '10,20,45 9,10,11 * * *',
				'reftime'		=> mktime(9,5,0,3,1,2008),
				'expected_l'		=> '29.02.2008, 11:45:00'
				);

	$tests[]	= array(
				'desc'			=> 'Thursday before/after Feb. 1st 2010',
				'expression'		=> '* * * * 4',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_n'		=> '04.02.2010, 00:00:00',
				'expected_l'		=> '28.01.2010, 23:59:00'
				);

	$tests[]	= array(
				'desc'			=> 'Tuesday before/after Jan. 1st 2010',
				'expression'		=> '* * * * 2',
				'reftime'		=> mktime(11,50,0,1,1,2010),
				'expected_n'		=> '05.01.2010, 00:00:00',
				'expected_l'		=> '29.12.2009, 23:59:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> next day -> August',
				'expression'		=> '10,20,45 9,10,11 * 8,9 *',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_n'		=> '01.08.2010, 09:10:00'
				);

	$tests[]	= array(
				'desc'			=> 'Hours match, no more minutes -> last day -> September',
				'expression'		=> '10,20,45 9,10,11 * 8,9 *',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_l'		=> '30.09.2009, 11:45:00'
				);

	$tests[]	= array(
				'desc'			=> 'Last February, 29th - 11:45',
				'expression'		=> '10,20,45 9,10,11 29 2 5',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_l'		=> '29.02.2008, 11:45:00'
				);

	$tests[]	= array(
				'desc'			=> 'Lets get wild with the cron-expression...',
				'expression'		=> '7-20,3,1 5-8,12-20/3 1-10,13,15,20-30/2 March-Sep Wed-Friday',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_l'		=> '30.09.2009, 18:20:00',
				'expected_n'		=> '03.03.2010, 05:01:00'
				);

	$tests[]	= array(
				'desc'			=> 'Just a simple -> * * * * *',
				'expression'		=> '* * * * *',
				'reftime'		=> mktime(11,50,0,2,1,2010),
				'expected_l'		=> '01.02.2010, 11:50:00',
				'expected_n'		=> '01.02.2010, 11:50:00'
				);

/*
	// This WILL FAIL!

	$tests[]	= array(
				'expression'		=> '99 * * * *',
				'reftime'		=> mktime(11,40,0,8,2,2010),
				'expected_n'		=> 'Error',
				'expected_l'		=> 'Error'
				);
*/