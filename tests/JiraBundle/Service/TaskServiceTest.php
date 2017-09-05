<?php
declare(strict_types=1);

namespace JiraBundle\Service;

use JiraBundle\Entity\Document;
use PHPUnit\Framework\TestCase;

class TaskServiceTest extends TestCase {

    /** @var TaskService */
    public $service;

    public function setUp() {
        $this->service = new TaskService();
    }

    public function test_sortDocumentsByLanguage_emptyResultOnEmptyInput() {
        $this->assertEquals(
            [],
            $this->service->sortDocumentsByLanguage([], [])
        );
    }

    public function test_sortDocumentsByLanguage_emptyResultOnEmptyDocument() {
        $this->assertEquals(
            ['BR' => [], 'MX' => []],
            $this->service->sortDocumentsByLanguage([], ['BR', 'MX'])
        );
    }

    public function test_sortDocumentsByLanguage_oneDocument() {
        $document = new Document();
        $document->setFilename('BR.pdf');

        $this->assertEquals(
            ['BR' => [$document]],
            $this->service->sortDocumentsByLanguage([$document], ['BR'])
        );
    }

    public function test_sortDocumentsByLanguage_twoDocumentsTwoLanguages() {
        $document1 = new Document();
        $document1->setFilename('BR.pdf');

        $document2 = new Document();
        $document2->setFilename('MX.pdf');

        $this->assertEquals(
            ['BR' => [$document1], 'MX' => [$document2]],
            $this->service->sortDocumentsByLanguage([$document1, $document2], ['BR', 'MX'])
        );
    }

}
