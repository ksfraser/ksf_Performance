<?php

declare(strict_types=1);

namespace Ksfraser\Performance\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Performance\Entity\PerformanceReview;

class PerformanceReviewTest extends TestCase
{
    public function testCanCreateReview(): void
    {
        $review = new PerformanceReview();
        $this->assertInstanceOf(PerformanceReview::class, $review);
    }

    public function testCanSetAndGetEmployeeId(): void
    {
        $review = new PerformanceReview();
        $review->setEmployeeId(1);
        $this->assertEquals(1, $review->getEmployeeId());
    }

    public function testCanSetRating(): void
    {
        $review = new PerformanceReview();
        $review->setOverallRating(4);
        $this->assertEquals(4, $review->getOverallRating());
    }

    public function testCanCheckIsCompleted(): void
    {
        $review = new PerformanceReview();
        $review->setStatus(PerformanceReview::STATUS_COMPLETED);
        $this->assertTrue($review->isCompleted());
    }
}