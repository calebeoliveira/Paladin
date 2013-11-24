<?php
namespace Util;

/**
 * Paladin Exception class.
 */
class DatabaseException extends \Exception {
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}

	public function __toString() {
		return "[DatabaseException #{$this->code}]: {$this->message}\n";
	}
}