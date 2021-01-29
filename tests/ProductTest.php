<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

class ProductTest extends BaseTestCase {
	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication() {
		return require __DIR__ .'/../bootstrap/app.php';
	}

	public function test_getProductRequest_call() {
		$parameters = [
			'identifier'      => 'vin',
			'identifierField' => 'ASDF123456',
			'fields'          => ['colour', 'make']
		];

		$this->post("/getProductRequest", $parameters, []);
		$this->seeStatusCode(200);
	}
}