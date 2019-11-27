<?php

declare(strict_types=1);

namespace CodeRhapsodie\EzDataflowBundle\Writer;

use CodeRhapsodie\DataflowBundle\DataflowType\Writer\DelegateWriterInterface;
use CodeRhapsodie\EzDataflowBundle\Core\Content\ContentCreatorInterface;
use CodeRhapsodie\EzDataflowBundle\Core\Content\ContentUpdaterInterface;
use CodeRhapsodie\EzDataflowBundle\Model\ContentCreateStructure;
use CodeRhapsodie\EzDataflowBundle\Model\ContentStructure;
use CodeRhapsodie\EzDataflowBundle\Model\ContentUpdateStructure;

class ContentWriter extends RepositoryWriter implements DelegateWriterInterface
{
    /** @var ContentCreatorInterface */
    private $creator;

    /** @var ContentUpdaterInterface */
    private $updater;

    public function __construct(ContentCreatorInterface $creator, ContentUpdaterInterface $updater)
    {
        $this->creator = $creator;
        $this->updater = $updater;
    }

    /**
     * @param ContentStructure $item
     */
    public function write($item)
    {
        if (!$item instanceof ContentStructure) {
            return;
        }

        if ($item instanceof ContentCreateStructure) {
            return $this->creator->createFromStructure($item);
        }

        if ($item instanceof ContentUpdateStructure) {
            return $this->updater->updateFromStructure($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supports($item): bool
    {
        return $item instanceof ContentStructure;
    }
}
