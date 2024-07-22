<?php
/**
 * Include Fussball.de Widgets
 *
 * @package   ITSB\IncludeFussballDeWidgets
 * @author    Alexander Böhm <ab@its-boehm.de>
 * @license   GPL2
 * @link      https://wordpress.org/plugins/include-fussball-de-widgets/
 * @copyright 2019 Alexander Böhm
 */

declare( strict_types=1 );

namespace ITSB\IFDW\Infrastructure;

/**
 * The Autoloader for all classes in the plugin.
 *
 * @since 3.1
 */
final class Autoloader {
	private const ROOT     = 'root';
	private const BASE_DIR = 'baseDir';
	private const PREFIX   = 'prefix';
	private const SUFFIX   = 'suffix';

	private const DEFAULT_PREFIX = '';
	private const DEFAULT_SUFFIX = '.php';

	private const AUTOLOAD_METHOD = 'autoload';

	/**
	 * Stores the namespaces that the autoloader is responsible for.
	 *
	 * @since 3.1
	 * @var string[]
	 */
	private $namespaces = [];

	/**
	 * Unregister the autoload callback with the SPL autoload system when the Autoloader instance
	 * is destroyed.
	 *
	 * @since 3.1
	 */
	public function __destruct() {
		$this->unregister();
	}

	/**
	 * Register the autoload callback with the SPL autoload system.
	 *
	 * This method registers the autoload method of this Autoloader instance with the SPL
	 * autoload system, allowing the autoloader to handle class loading for the namespaces that
	 * have been added to it.
	 *
	 * @since 3.1

	 * @throws \TypeError If the autoloader could not be registered.
	 */
	public function register(): void {
		spl_autoload_register( [ $this, self::AUTOLOAD_METHOD ] );
	}

	/**
	 * Unregister the autoload callback with the SPL autoload system.
	 *
	 * This method unregisters the autoload method of this Autoloader instance from the SPL
	 * autoload system, allowing other autoloaders to handle class loading.
	 *
	 * @since 3.1
	 */
	public function unregister(): void {
		spl_autoload_unregister( [ $this, self::AUTOLOAD_METHOD ] );
	}

	/**
	 * Returns the namespaces that the autoloader is responsible for.
	 *
	 * @since 3.1
	 * @return string[] The namespaces managed by this autoloader.
	 */
	public function getNamespaces(): array {
		return $this->namespaces;
	}

	/**
	 * Adds a new namespace to the autoloader.
	 *
	 * This method allows you to register a new namespace with the autoloader.
	 * The autoloader will then be able to load classes from that namespace.
	 *
	 * @since 3.1
	 * @param string $root    The root namespace to register.
	 * @param string $baseDir The base directory where classes for this namespace are located.
	 * @param string $prefix  An optional prefix to prepend to the class file names.
	 * @param string $suffix  An optional suffix to append to the class file names.
	 * @return $this The current Autoloader instance, for method chaining.
	 */
	public function addNamespace(
		string $root,
		string $baseDir,
		string $prefix = self::DEFAULT_PREFIX,
		string $suffix = self::DEFAULT_SUFFIX
	): self {
		$this->namespaces[] = [
			self::ROOT     => $this->normalizeRoot( $root ),
			self::BASE_DIR => $this->ensureTrailingSlash( $baseDir ),
			self::PREFIX   => $prefix,
			self::SUFFIX   => $suffix,
		];

		return $this;
	}

	/**
	 * Autoloads a class when it is requested.
	 *
	 * This method is responsible for loading a class when it is requested by the application.
	 * It searches through the registered namespaces to find the appropriate file path for the
	 * class, and then includes that file.
	 *
	 * @since 3.1
	 * @param string $className The name of the class to be autoloaded.
	 */
	public function autoload( string $className ): void {
		// Iterate over namespaces to find a match.
		foreach ( $this->namespaces as $namespaceName ) {
			// Move on if the object does not belong to the current namespace.
			if ( 0 !== strpos( $className, $namespaceName[ self::ROOT ] ) ) {
				continue;
			}

			// Remove namespace root level to correspond with root filesystem.
			$filename = str_replace( $namespaceName[ self::ROOT ], '', $className );

			// Remove a leading backslash from the class name.
			$filename = $this->removeLeadingBackslash( $filename );

			// Replace the namespace separator "\" by the system-dependent
			// directory separator.
			$filename = str_replace( '\\', DIRECTORY_SEPARATOR, $filename );

			// Add base_dir, prefix and suffix.
			$filepath = $namespaceName[ self::BASE_DIR ]
				. $namespaceName[ self::PREFIX ]
				. $filename
				. $namespaceName[ self::SUFFIX ];

			// Require the file if it exists and is readable.
			if ( is_readable( $filepath ) ) {
				require_once $filepath;
			}
		}
	}

	/**
	 * Normalizes the root directory path.
	 *
	 * This method ensures that the root directory path provided has a trailing backslash.
	 *
	 * @since 3.1
	 * @param string $root The root directory path to normalize.
	 * @return string The normalized root directory path.
	 */
	private function normalizeRoot( string $root ): string {
		$root = $this->removeLeadingBackslash( $root );
		$root = $this->ensureTrailingBackslash( $root );

		return $root;
	}

	/**
	 * Removes any leading backslash from the given namespace name.
	 *
	 * @since 3.1
	 * @param string $namespaceName The namespace name to remove the leading backslash from.
	 * @return string The namespace name with any leading backslash removed.
	 */
	private function removeLeadingBackslash( string $namespaceName ): string {
		return ltrim( $namespaceName, '\\' );
	}

	/**
	 * Ensures that the given namespace name has a trailing backslash.
	 *
	 * This method takes a namespace name and ensures that it ends with a backslash.
	 * This is useful for consistently formatting namespace names when constructing
	 * file paths.
	 *
	 * @since 3.1
	 * @param string $namespaceName The namespace name to ensure has a trailing backslash.
	 * @return string The namespace name with a trailing backslash.
	 */
	private function ensureTrailingBackslash( string $namespaceName ): string {
		return rtrim( $namespaceName, '\\' ) . '\\';
	}

	/**
	 * Ensures that the given path has a trailing slash.
	 *
	 * This method takes a path and ensures that it ends with a slash.
	 * This is useful for consistently formatting paths when constructing
	 * file paths.
	 *
	 * @since 3.1
	 * @param string $path The path to ensure has a trailing slash.
	 * @return string The path with a trailing slash.
	 */
	private function ensureTrailingSlash( string $path ): string {
		return rtrim( $path, '/' ) . '/';
	}
}
