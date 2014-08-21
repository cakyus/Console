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

class Application {

	public function start() {

		$this->setErrorHandler();
		$this->setExceptionHandler();
		$this->setAutoloader();

		// request handler
		$request = new \Nmon\Request;

		$controllerName = $request->getControllerName();
		$functionName = $request->getFunctionName();

		$controller = new $controllerName;
		$controller->$functionName();
	}

    protected function setAutoloader() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    protected function loadClass($class) {

        // Controller
		$classes = explode('\\', $class);
        $class = array_pop($classes);
        $namespace = implode('\\', $classes);

        if (count($classes) == 0) {
            // no namespace
            return FALSE;
        } elseif ($classes[0] !== 'Controller') {
			// namespace is not Controller
			$file = APPLICATION_VENDOR.DIRECTORY_SEPARATOR
				.implode(DIRECTORY_SEPARATOR, $classes)
				.DIRECTORY_SEPARATOR.$class.'.php'
				;
        } else {
			$file = APPLICATION_PATH.DIRECTORY_SEPARATOR
				.implode(DIRECTORY_SEPARATOR, $classes)
				.DIRECTORY_SEPARATOR.$class.'.php'
				;
		}

        if (is_file($file)) {
            require_once($file);
        } else {
            throw new \Exception("Controller not found: $namespace\\$class");
        }
    }

    protected function setErrorHandler() {
        set_error_handler(function($errno, $errstr, $errfile, $errline){
            throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
        });
    }

    protected function setExceptionHandler() {
        set_exception_handler(function($exception) {
            echo "Exception Handler"
                ."\nMessage: ".$exception->getMessage()
                ."\nFile: ".$exception->getFile()
                .":".$exception->getLine()
                ."\nDebug-Trace: ".$exception->getTraceAsString()
                ."\n";
        });
    }
}
