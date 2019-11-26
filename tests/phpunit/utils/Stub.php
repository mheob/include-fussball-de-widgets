<?php
/**
 * Include Fussball.de Widgets
 * Copyright (C) 2019 IT-Service Böhm - Alexander Böhm <ab@its-boehm.de>
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Include_Fussball_De_Widgets
 */

declare( strict_types=1 );
namespace ITSB\IFDW\PhpUnit\Utils;

use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class Stub
 * Helper to override private methods and properties.
 *
 * @since 3.1
 */
class Stub extends \WP_UnitTestCase {
	/**
	 * The stub
	 *
	 * @since 3.1
	 * @var MockObject
	 */
	private $stub;

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
	 * Stub constructor
	 *
	 * @since 3.1
	 *
	 * @param MockObject $stub The stub.
	 * @param string     $className The class name.
	 */
	public function __construct( MockObject $stub, string $className ) {
		$this->stub            = $stub;
		$this->className       = $className;
		$this->reflectionClass = new \ReflectionClass( $this->className );
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
		$reflectionProperty->setValue( $this->stub, $value );
	}
}
