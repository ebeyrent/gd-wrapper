<?php
/**
 * Defines Abstract Action class.
 *
 * @author Henrique Barcelos
 */
namespace GdWrapper\Action;

use GdWrapper\Action\ResizeStrategy\Strategy;
use GdWrapper\Resource\EmptyResourceFactory;
use GdWrapper\Resource\AbstractResourceFactory;
use GdWrapper\Resource\Resource;

/**
 * Abstraction for an action.
 */
abstract class AbstractAction implements Action
{
    
    /**
     * @var string The resource factory class name.
     */
    private $resourceFactoryClass;
    
    /**
     * @var \GdWrapper\Resource\EmptyResourceFactory The resource factory.
     */
    private $resourceFactory;
    
    /**
     * Creates an action with the classname of a factory that might be needed to create resources
     * in the actions performed by the concrete classes.
     *
     * By default, if no `$resourceFactoryClass` is provided, will be created an instance of
     * `\GdWrapper\Resource\EmptyResourceFactory`.
     *
     * IMPORTANT: to apply actions on images with transparency, the factory should be an instance of
     * `\GdWrapper\Resource\TransparentResourceFactory`.
     *
     * @param string $resourceFactoryClass [OPTIONAL] The name of the class.
     */
    public function __construct($resourceFactoryClass = null)
    {
        if ($resourceFactoryClass === null) {
            $resourceFactoryClass = "\\GdWrapper\\Resource\\EmptyResourceFactory";
        }
        $this->resourceFactoryClass = (string) $resourceFactoryClass;
    }

    /**
     * Obtains the resource factory;
     *
     * @param $width The width of the images that will be created by the factory
     *
     * @return \GdWrapper\Resource\EmptyResourceFactory A resource factory.
     */
    public function getResourceFactory($width, $height)
    {
        if ($this->resourceFactory === null) {
            $reflection = new \ReflectionClass($this->resourceFactoryClass);
            $this->resourceFactory = $reflection->newInstance($width, $height);
        }
        return $this->resourceFactory;
    }
    
    /**
     * Sets the name of the resource factory class.
     * The class should be derived from '\GdWrapper\Resource\EmptyResourceFactory` or
     * must have the same assignature in the constructor.
     *
     * @param string $resourceFactory
     */
    public function setResourceFactoryClass($resourceFactoryClass)
    {
        $this->resourceFactoryClass = $resourceFactoryClass;
        $this->resourceFactory = null;
    }
    
    /**
     * Obtains the name of the resource factory class.
     *
     * return string The name of the class
     */
    public function getResourceFactoryClass()
    {
        return $this->resourceFactoryClass;
    }
}