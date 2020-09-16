<?php

declare(strict_types=1);

namespace CodeRhapsodie\EzDataflowBundle\Core\Field;

use eZ\Publish\Core\FieldType\Value;

interface FieldValueCreatorInterface
{
    public function supports(string $fieldTypeIdentifier): bool;

    /**
     * @param mixed $hash
     */
    public function createValue(string $fieldTypeIdentifier, $hash): Value;
}
