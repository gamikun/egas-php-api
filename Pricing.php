<?php

namespace edesarrollos\egas;

class Pricing {

	public $perKilogram;
	public $perLitter;

	public static function fromVariablesList($list) {
		$price = new Pricing;

		foreach ($list as $name => $value) {
			if ($name === 'PRECIO_KILO') {
				$price->perKilogram = floatval($value);
			} elseif ($name === 'PRECIO_LITRO') {
				$price->perLitter = floatval($value);
			}
		}

		return $price;
	}
}