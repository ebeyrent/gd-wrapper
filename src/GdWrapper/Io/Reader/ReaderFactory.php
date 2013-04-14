<?php
/**
 * Defines ReaderFactory class.
 *
 * @author Henrique Barcelos
 */
namespace GdWrapper\Io\Reader;

use GdWrapper\Resource\Resource;

/**
 * Defines an abstract implementation of a input "device" for resources.
 */
class ReaderFactory
{
	/**
	 * Returns a concrete instance of a AbstractReader based on the file
	 * extension of `$path`.
	 *
	 * @param string $path the path to an image file.
	 *
	 * @return Reader A concrete implementation of AbstractIo\
	 *
	 * @throws \DomainException If the file type is not currently supported.
	 */
	public static function factory($path)
	{
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$className = __NAMESPACE__ . '\\' . ucfirst(strtolower($type)) . 'Reader';
		try {
			return (new \ReflectionClass($className))->newInstance();
		} catch(\ReflectionException $e) {
			throw new \DomainException("Extension '{$type}' not supported!");
		}
	}
}