<?php

namespace Ichi\FakerComplexUnique\Provider;

use Faker\Provider\Base;
use Faker\UniqueGenerator;

class ComplexUnique extends Base
{

    /**
     * @var \Ichi\FakerComplexUnique\ComplexUniqueGenerator[]
     */
    protected $complexUniques = [];

    /**
     * Chainable method for making any formatter complex unique.
     *
     * <code>
     * // will never return twice the same value on dependencies
     * $faker->complexUnique(['key1' => 'value1', 'key2' => 'value2'])->randomElement(array(1, 2, 3));
     * </code>
     *
     * @param boolean $reset
     * @param array   $dependencies [string => mixed, ...]
     * @param integer $maxRetries
     * @throws \OverflowException
     *
     * @return ComplexUniqueGenerator
     */
    public function complexUnique(array $dependencies, $reset = false, $maxRetries = 10000)
    {
        ksort($dependencies);
        $key = serialize($dependencies);

        if ($reset || ! array_key_exists($key, $this->complexUniques)) {
            $this->complexUniques[$key] = new UniqueGenerator($this->generator, $maxRetries);
        }

        return $this->complexUniques[$key];
    }

}
