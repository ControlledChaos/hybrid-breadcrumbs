<?php

namespace Hybrid\Breadcrumbs\Query;

use Hybrid\Breadcrumbs\Breadcrumbs;
use Hybrid\Breadcrumbs\Builder;
use Hybrid\Breadcrumbs\Contracts\Query as QueryContract;

class Query implements QueryContract {

	protected $builder;
	protected $manager;

	public function __construct( Builder $builder, Breadcrumbs $manager, $data = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

			if ( isset( $data[ $key ] ) ) {
				$this->$key = $data[ $key ];
			}
		}

		$this->builder = $builder;
		$this->manager = $manager;
	}

	public function make() {}
}
