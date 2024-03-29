<?php

/*
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

define('APPLICATION_ROOT', __DIR__);
define('APPLICATION_PATH', APPLICATION_ROOT.DIRECTORY_SEPARATOR.'app');
define('APPLICATION_DATA', APPLICATION_ROOT.DIRECTORY_SEPARATOR.'data');
define('APPLICATION_VENDOR', APPLICATION_ROOT.DIRECTORY_SEPARATOR.'vendor');

include(__DIR__.DIRECTORY_SEPARATOR.'config.php');

include(APPLICATION_VENDOR
	.DIRECTORY_SEPARATOR.'Console'
	.DIRECTORY_SEPARATOR.'Application.php'
	);

$app = new \Console\Application;
$app->start();

