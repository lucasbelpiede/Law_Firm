<?php

	// Load classes

	require_once('class.tdcron.php');
	require_once('class.tdcron.entry.php');

	// Load tests

	require_once('test.data.php');

	// Rock it....

	$ok	= 0;
	$fail	= 0;

	echo "\n".str_repeat('-',80)."\n";

	echo 'Testing '.count($tests).' expressions...';

	echo "\n\n".str_repeat('-',80)."\n";

	foreach ($tests as $curtest) {

		try {

			if (!empty($curtest['desc'])) {
				echo 'Description:   ['.$curtest['desc'].']'."\n";
			}
			echo 'Expression:    ['.$curtest['expression'].']'."\n";

			echo 'Ref-Time:      ['.date('d.m.Y, H:i:s', $curtest['reftime'])."]\n\n";

			if (isset($curtest['expected_n'])) {

				echo 'nextRun():     ['.date('d.m.Y, H:i:s', tdCron::getNextOccurrence($curtest['expression'],$curtest['reftime']))."]\n";
				echo 'Expected:      ['.$curtest['expected_n']."] - ";

				if (date('d.m.Y, H:i:s', tdCron::getNextOccurrence($curtest['expression'],$curtest['reftime'])) == $curtest['expected_n']) {
					echo 'passed!';
					$ok++;
				} else {
					echo 'FAILED!';
					$fail++;
				}

				echo "\n\n";

			}

			if (isset($curtest['expected_l'])) {

				echo 'lastRun():     ['.date('d.m.Y, H:i:s', tdCron::getLastOccurrence($curtest['expression'],$curtest['reftime']))."]\n";
				echo 'Expected:      ['.$curtest['expected_l']."] - ";

				if (date('d.m.Y, H:i:s', tdCron::getLastOccurrence($curtest['expression'],$curtest['reftime'])) == $curtest['expected_l']) {
					echo 'passed!';
					$ok++;
				} else {
					echo 'FAILED!';
					$fail++;
				}

				echo "\n\n";

			}

		} catch (Exception $e) {

			echo 'ERROR!'."\n\n";
			print_r($e);

		}

		echo str_repeat('-',80)."\n";

	}

	echo 'OK:   '.$ok."\n";
	echo 'FAIL: '.$fail."\n";
