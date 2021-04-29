<?php

namespace WPML\WPSEO\Presentation;

use WPML\FP\Obj;
use WPML\WPSEO\Meta\SocialHooks;
use WPML\WPSEO\Utils;
use Yoast\WP\SEO\Presentations\Indexable_Presentation;

class Hooks implements \IWPML_Frontend_Action {

	const OPTION_KEY = 'wpseo_titles';

	/**
	 * Add hooks.
	 */
	public function add_hooks() {
		add_filter( 'wpseo_title', [ $this, 'translateTitle' ], 10, 2 );
		add_filter( 'wpseo_metadesc', [ $this, 'translateDescription' ], 10, 2 );

		add_action( 'init', [ $this, 'init' ] );

		add_filter( 'wpseo_breadcrumb_indexables', [ $this, 'translateBreadcrumbs' ] );

		add_filter( 'wpseo_frontend_presentation', [ $this, 'translatePermalinks' ] );
	}

	public function init() {
		if ( ! Utils::isFrontPageWithPosts() ) {
			add_filter( 'wpseo_opengraph_title', [ $this, 'translateTitle' ], 10, 2 );
			add_filter( 'wpseo_opengraph_desc', [ $this, 'translateDescription' ], 10, 2 );
		}
	}

	/**
	 * Translates a title.
	 *
	 * @param string                 $title        The title in the default language.
	 * @param Indexable_Presentation $presentation The presentation class.
	 *
	 * @return string
	 */
	public function translateTitle( $title, $presentation ) {
		return $this->translate( 'title', $title, $presentation );
	}

	/**
	 * Translates a description.
	 *
	 * @param string                 $description  The description in the default language.
	 * @param Indexable_Presentation $presentation The presentation class.
	 *
	 * @return string
	 */
	public function translateDescription( $description, $presentation ) {
		return $this->translate( 'metadesc', $description, $presentation );
	}

	/**
	 * Translates a breadcrumb title.
	 *
	 * @param string                 $title        The title in the default language.
	 * @param Indexable_Presentation $presentation The presentation class.
	 *
	 * @return string
	 */
	public function translateBreadcrumbTitle( $title, $presentation ) {
		return $this->translate( 'bctitle', $title, $presentation );
	}

	/**
	 * Get the translations from the options table, which will include the translated admin-texts.
	 *
	 * @param string                 $type         The object type of the Indesable, used as a prefix for the option name.
	 * @param string                 $text         The text in the default language.
	 * @param Indexable_Presentation $presentation The presentation class.
	 *
	 * @return string
	 */
	private function translate( $type, $text, $presentation ) {
		$translation = Obj::prop( $this->getOptionKey( $type, $presentation ), get_option( self::OPTION_KEY, [] ) );

		if ( $translation ) {
			$text = wpseo_replace_vars( $translation, $presentation );
		}

		return $text;
	}

	/**
	 * Returns the option key for the object being translated.
	 *
	 * @param string                 $type         How to prefix the option name.
	 * @param Indexable_Presentation $presentation The presentation class.
	 *
	 * @return string
	 */
	private function getOptionKey( $type, $presentation ) {
		$systemPageSubType = wpml_collect( [
			'search-result' => 'search',
		] )->get( $presentation->model->object_sub_type, $presentation->model->object_sub_type );

		return wpml_collect(
			[
				'post-type-archive' => $type . '-ptarchive-' . $presentation->model->object_sub_type,
				'system-page'       => $type . '-' . $systemPageSubType . '-wpseo',
				'home-page'         => $type . '-home-wpseo',
			]
		)->get( $presentation->model->object_type, '' );
	}

	/**
	 * Translate titles and links for home and archives.
	 *
	 * @param Indexable[] $indexables An array of Indexable objects representing the breacrumbs.
	 *
	 * @return Indexable[]
	 */
	public function translateBreadcrumbs( $indexables ) {
		foreach ( $indexables as &$indexable ) {
			if ( 'post-type-archive' === $indexable->object_type ) {
				$getDefaultLabel = function( $indexable ) {
					$post_object = get_post_type_object( $indexable->object_sub_type );
					return $post_object ? $post_object->labels->name : $indexable->breadcrumb_title;
				};

				$getYoastLabel = function( $indexable ) {
					return $this->translateBreadcrumbTitle(
						$indexable->breadcrumb_title,
						(object) [ 'model' => $indexable ]
					);
				};

				$indexable->breadcrumb_title = $getDefaultLabel( $indexable );
				$indexable->breadcrumb_title = $getYoastLabel( $indexable );
				$indexable->permalink        = get_post_type_archive_link( $indexable->object_sub_type );
			}
			if ( 'term' === $indexable->object_type ) {
				$term                        = apply_filters( 'wpml_object_id', $indexable->object_id, $indexable->object_sub_type, true );
				$indexable->permalink        = get_term_link( $term );
				$indexable->breadcrumb_title = get_term( $term )->name;
			} else {
				$indexable->permalink = apply_filters( 'wpml_permalink', $indexable->permalink );
			}
		}

		return $indexables;
	}

	/**
	 * Translate permalinks.
	 *
	 * @param Indexable_Presention $presentation The indexable presentation.
	 *
	 * @return Indexable_Presention
	 */
	public function translatePermalinks( $presentation ) {
		$presentation = clone $presentation;

		if ( 'post' === $presentation->model->object_type ) {
			$presentation->model->permalink = get_permalink( $presentation->model->object_id );
		} elseif ( 'term' === $presentation->model->object_type ) {
			$presentation->model->permalink = get_term_link( $presentation->model->object_id );
		} elseif ( 'post-type-archive' === $presentation->model->object_type ) {
			$presentation->model->permalink = get_post_type_archive_link( $presentation->model->object_sub_type );
		}

		return $presentation;
	}
}
