<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'forename', 'surname', 'email', 'contact_number', 'postcode'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}