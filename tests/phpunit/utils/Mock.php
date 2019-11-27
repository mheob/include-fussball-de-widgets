<?php declare( strict_types=1 );
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    IT Service Böhm -- Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 IT Service Böhm -- Alexander Böhm
 */

namespace ITSB\IFDW\PhpUnit\Utils;

use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class Mock
 * Helper to override private methods and properties.
 *
 * @since 3.1
 */
class Mock extends \WP_UnitTestCase {
	/**
	 * The mock
	 *
	 * @since 3.1
	 * @var MockObject
	 */
	private $mock;

	/**
	 * The class name.
	 *
	 * @since 3.1
	 * @var string
	 */
	private $className;

	/**
	 * The reflection class.
	 *
	 * @since 3.1
	 * @var ReflectionClass
	 */
	private $reflectionClass;

	/**
	 * Mock constructor
	 *
	 * @since 3.1
	 *
	 * @param MockObject $mock The mock.
	 * @param string     $className The class name.
	 */
	public function __construct( MockObject $mock, string $className ) {
		$this->mock            = $mock;
		$this->className       = $className;
		$this->reflectionClass = new \ReflectionClass( $this->className );
	}

	/**
	 * Gets the value of a private or protected property.
	 *
	 * @since 3.1
	 *
	 * @param string $property The property.
	 *
	 * @return void
	 */
	public function getProperty( string $property ): void {
		$reflectionProperty = $this->reflectionClass->getProperty( $property );
		$reflectionProperty->setAccessible( true );
		$reflectionProperty->getValue( $this->mock );
	}

	/**
	 * Override a value of a private or protected property.
	 *
	 * @since 3.1
	 *
	 * @param string      $property The property.
	 * @param string|null $value The value.
	 *
	 * @return void
	 */
	public function setProperty( string $property, ?string $value ): void {
		$reflectionProperty = $this->reflectionClass->getProperty( $property );
		$reflectionProperty->setAccessible( true );
		$reflectionProperty->setValue( $this->mock, $value );
	}
}
