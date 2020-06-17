<?php

namespace App\System\base;

use App\System\Context;
use Illuminate\Support\Collection;

/**
 * Class SystemModel
 *
 * @package App\System\base
 */
class SystemModel extends PropertyModel
{
    /**
     * @var object
     */
    public $db = null;
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * SystemModel constructor.
     *
     * @param array $options
     */
    function __construct($options = [])
    {
        parent::__construct($options);

        $this->db = Context::App()->db;
    }

    /**
     * @param array $items
     * @param null  $entityClass
     *
     * @return Collection
     * @throws \ReflectionException
     */
    protected function makeCollection($items = [], $entityClass = null)
    {
        $collection = new Collection();
        $entity     = ClassFactory::getClassNamespace(
            $entityClass ?? (new \ReflectionClass($this))->getShortName(),
            ClassFactory::ENTITIES
        );
        foreach ($items as $item) {
            $collection->add(new $entity($item));
        }

        return $collection;
    }

    /**
     * @param      $item
     * @param null $entityClass
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected function makeSingle($item, $entityClass = null)
    {
        $entity = ClassFactory::getClassNamespace(
            $entityClass ?? (new \ReflectionClass($this))->getShortName(),
            ClassFactory::ENTITIES
        );

        return new $entity($item);
    }
}
