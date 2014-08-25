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

namespace Console;

class Request {
	
	private static $data;

	public function __construct() {
		
	}

	/**
	 * Resolve Controller Name
	 * @return string
	 **/

	public function getControllerName() {
		$controllerName = '\\Controller\\Index';
		return $controllerName;
	}

	/**
	 * Resolve Function Name
	 * @return string
	 **/

	public function getFunctionName() {
		if (PHP_SAPI == 'cli') {
			$functionName = 'help';
		} else {
			$functionName = 'index';
		}
		return $functionName;
	}

	/**
	 * Get all arguments
	 * @return array
	 **/

	public function getArguments() {
		$arguments = array();
		return $arguments;
	}

	private function getData() {
		// code...
	}

	public function __get($name) {
		// code...
	}

	public function __set($name, $value) {
		// code...
	}
}

