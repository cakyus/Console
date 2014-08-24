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

namespace Nmon;

class Controller  {

	public function __construct() {
		// code...
	}
	
	/**
	 * Print this information
	 **/

	public function help() {

		// print program usage
		$programName = basename($_SERVER['argv'][0]);
		echo "Usage: $programName command [options].. <arguments>..\n";

		// get avaliable commands
		$class = new \ReflectionClass($this);
		$methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
		$phpInternalMethods = array('__construct');
		echo "Commands:\n";
		$outputCommands = array();
		$columnNameLengthMax = 0;
		foreach ($methods as $method) {
			if (in_array($method->name, $phpInternalMethods)) {
				continue;
			}
			$outputCommands[] = array(
				 'name' => $method->name
				,'description' => $this->getCommentFirst($method->getDocComment())
				);
			if (strlen($method->name) > $columnNameLengthMax) {
				$columnNameLengthMax = strlen($method->name);
			}
		}

		foreach ($outputCommands as $outputCommand) {
			echo '  '.str_pad($outputCommand['name'], $columnNameLengthMax,' ');
			echo '  '.$outputCommand['description']."\n";
		}

		// get options
		$properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);
		if (count($properties) == 0) {
			return TRUE;
		}

		echo "Options:\n";
		$outputProperties = array();
		$columnNameLengthMax = 0;
		foreach ($properties as $property) {
			$outputProperties[] = array(
				 'name' => $property->name
				,'description' => $this->getCommentFirst($property->getDocComment())
				);
			if (strlen($property->name) > $columnNameLengthMax) {
				$columnNameLengthMax = strlen($property->name);
			}
		}

		foreach ($outputProperties as $property) {
			echo '  -'.str_pad($property['name'], $columnNameLengthMax, ' ');
			echo '  '.$property['description']."\n";
		}
	}

	/**
	 * Extract first line of comment from DocComment
	 *
	 * @param $comment string the value of DocComment
	 * @return string
	 **/

	private function getComment($comment) {
		// remove beginning and ending of comment doc
		$comment = preg_replace(array(
			 "/^\/\*+\s*/"
			,"/\s*\*+\/$/"
			), array(
 			 ""
			,""
			), $comment);
		$commentLines = explode("\n", $comment);

		// remove comment at the beginning of each line
		foreach ($commentLines as $index => $value) {
			$commentLines[$index] = preg_replace("/^\s*\*\s*/", "", $value);
		}

		return implode("\n", $commentLines);
	}

	/**
	 * Get first line of comment doc
	 *
	 * @param $comment string comment doc
	 * @return string
	 **/

	private function getCommentFirst($comment) {
		
		$comment = $this->getComment($comment);
		$commentLines = explode("\n", $comment);
		if (count($commentLines) > 0) {
			return $commentLines[0];
		}

		return '';
	}
}
