<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Performance\Entity;

use Ksfraser\Performance\Entity\PerformanceReview;
use PHPUnit\Framework\TestCase;

class PerformanceReviewTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $review = new PerformanceReview();

        $this->assertNull($review->getId());
        $this->assertSame(0, $review->getEmployeeId());
        $this->assertSame(0, $review->getReviewerId());
        $this->assertSame('draft', $review->getStatus());
        $this->assertFalse($review->isCompleted());
    }

    /**
     * @covers Ksfraser\Performance\Entity\PerformanceReview::setId
     */
    public function testSetId(): void
    {
        $review = new PerformanceReview();
        $result = $review->setId(1);

        $this->assertInstanceOf(PerformanceReview::class, $result);
        $this->assertSame(1, $review->getId());
    }

    /**
     * @covers Ksfraser\Performance\Entity\PerformanceReview::setRating
     */
    public function testSetRating(): void
    {
        $review = new PerformanceReview();
        $result = $review->setRating(4.5);

        $this->assertInstanceOf(PerformanceReview::class, $result);
        $this->assertSame(4.5, $review->getRating());
    }

    /**
     * @covers Ksfraser\Performance\Entity\PerformanceReview::isCompleted
     */
    public function testIsCompleted(): void
    {
        $review = new PerformanceReview();
        $review->setStatus('draft');
        $this->assertFalse($review->isCompleted());

        $review->setStatus('completed');
        $this->assertTrue($review->isCompleted());
    }
}