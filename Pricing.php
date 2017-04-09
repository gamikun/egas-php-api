<?php

namespace edesarrollos\egas;

class Pricing {

	public $perKilogram;
	public $perLitter;
	public $perLitterAlternative;

	public static function fromVariablesList($list) {
		$price = new Pricing;

		foreach ($list as $name => $value) {
			if ($name === 'PRECIO_KILO') {
				$price->perKilogram = floatval($value);
			} elseif ($name === 'PRECIO_LITRO') {
				$price->perLitter = floatval($value);
			} elseif ($name === 'PRECIO_LITRO_ALTERNO') {
				$price->perLitterAlternative = floatval($value);
			}
		}

		return $price;
	}
}