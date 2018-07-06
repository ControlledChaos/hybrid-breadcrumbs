<?php
/**
 * Post build class.
 *
 * This is a wrapper to determine a more specific post-related build class to
 * call based on the given post.
 *
 * @package   HybridBreadcrumbs
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-breadcrumbs
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Hybrid\Breadcrumbs\Build;

/**
 * Post build sub-class.
 *
 * @since  1.0.0
 * @access public
 */
class Post extends Build {

	/**
	 * Post object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Post
	 */
	protected $post;

	/**
	 * Builds the breadcrumbs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function make() {

		// If the post has a parent, follow the parent trail.
		if ( 0 < $this->post->post_parent ) {

			$this->builder->build( 'PostAncestors', [
				'post' => $this->post
			] );

		// If the post doesn't have a parent, get its hierarchy based off the post type.
		} else {

			$this->builder->build( 'PostHierarchy', [
				'post' => $this->post
			] );
		}

		// Display terms for specific post type taxonomy if requested.
		if ( $this->manager->postTaxonomy( $this->post->post_type ) ) {

			$this->builder->build( 'PostTerms', [
				'post'     => $this->post,
				'taxonomy' => $this->manager->postTaxonomy( $this->post->post_type )
			] );
		}
	}
}
