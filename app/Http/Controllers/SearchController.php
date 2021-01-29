<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;

use Illuminate\Http\Request;
/**
 * The reusable SearchController
 *
 */

class SearchController extends Controller {
	// Reusable method for both existing endpoints
	// This method tests if the request path is for Customer or Product search and reuses all the components as much as possible.
	public function getSearchRequest(Request $request) {

		/* The following fields are mandatory to be sent on the request.
		 *  identifier: string. > Column to be searched e.g.: 'forename'.
		 *  identifierField: string. > Value to search for e.g.: 'Tom'.
		 *  fields: array. > Which fields will be returned on the response e.g.: ['surname', 'postcode'] or use ['*'] for all.
		 */
		$requiredFields = ['identifier' => 'required', 'identifierField' => 'required', 'fields' => 'required'];

		// Validates if required fields are present in the request
		$this->validate($request, $requiredFields);

		// Populating the request fields into the variables for code clarity.
		$identifier      = $request->get('identifier');
		$identifierField = $request->get('identifierField');
		$fields          = $request->get('fields');
		$path            = $request->path();

		// Assert if the URL path is getCustomerRequest or getProductRequest and create the respective object.
		$path == 'getCustomerRequest'?$obj = new Customer:$obj = new Product;

		// Get all the fields from the Model based on the object.
		$filterColumns = $obj->getFillable();

		// Initialization
		$status = 'not found';
		$data   = [];

		// Loop through the fillable values and perform wildcard search in the DB field.
		foreach ($filterColumns as $column) {
			if ($identifier == $column) {
				$value = $identifierField;

				$data = $obj::where($column, 'LIKE', "%{$value}%")->get($fields);

				// Change status if data lenght > 0
				if (count($data) > 0) {
					$status = 'found';
				}

				// Return status and data as per the design.
				return response()->json([
						'status' => $status,
						'data'   => $data
					]);
			}
		}

		// if request field was not found among the filter columns
		return response()->json([
				'status' => $status,
				'data'   => []
			]);
	}
}
