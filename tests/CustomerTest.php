<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

class CustomerTest extends BaseTestCase {
	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication() {
		return require __DIR__ .'/../bootstrap/app.php';
	}

	public function test_getCustomerRequest_forename() {
		$parameters = [
			'identifier'      => 'forename',
			'identifierField' => 'Tom',
			'fields'          => ['surname', 'postcode']
		];

		$this->post("/getCustomerRequest", $parameters, []);
		$this->seeStatusCode(200);
	}

	public function test_getCustomerRequest_surname() {
		$parameters = [
			'identifier'      => 'surname',
			'identifierField' => 'Ahmed',
			'fields'          => ['forename', 'contact_number', 'postcode']
		];

		$this->post("/getCustomerRequest", $parameters, []);
		$this->seeStatusCode(200);
	}

	public function test_getCustomerRequest_email_notfound() {
		$parameters = [
			'identifier'      => 'email',
			'identifierField' => '@gmail.com',
			'fields'          => ['*']
		];

		$this->post("/getCustomerRequest", $parameters, []);
		$this->seeStatusCode(200);
		$this->seeJson(['status' => 'not found', ]);
	}

	public function test_getCustomerRequest_email_found() {
		$parameters = [
			'identifier'      => 'email',
			'identifierField' => '@gmail.co.uk',
			'fields'          => ['*']
		];

		$this->post("/getCustomerRequest", $parameters, []);
		$this->seeStatusCode(200);
		$this->seeJson(['status' => 'found', ]);
	}

}