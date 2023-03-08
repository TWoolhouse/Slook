<?php
class Err extends Exception
{
	// Redefine the exception so message isn't optional
	public function __construct($code = 0, $reason , Throwable $previous = null) {
		// some code

		// make sure everything is assigned properly
		parent::__construct($reason, $code, $previous);
	}

	// custom string representation of object
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

	public function export() {
		$r = [
			"status" => $this->code,
			"reason" => $this->message,
		];
		if (($previous = $this->getPrevious()) != NULL) {
			$r["previous"] = gettype($this) == __CLASS__ ? $previous->export() : (string)$previous;
		}
		return $r;
	}
}
?>
