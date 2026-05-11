<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Performance\Service;

use Ksfraser\Performance\Entity\PerformanceReview;
use Ksfraser\Performance\Entity\Goal;
use Ksfraser\Performance\Service\PerformanceService;
use PHPUnit\Framework\TestCase;

class PerformanceServiceTest extends TestCase
{
    private PerformanceService $service;

    protected function setUp(): void
    {
        $this->service = new PerformanceService();
    }

    /**
     * @covers Ksfraser\Performance\Service\PerformanceService::createReview
     */
    public function testCreateReview(): void
    {
        $review = $this->service->createReview([
            'id' => 1,
            'employee_id' => 100,
            'reviewer_id' => 200,
            'period_start' => '2026-01-01',
            'period_end' => '2026-12-31',
        ]);

        $this->assertInstanceOf(PerformanceReview::class, $review);
        $this->assertSame(100, $review->getEmployeeId());
    }

    /**
     * @covers Ksfraser\Performance\Service\PerformanceService::submitReview
     */
    public function testSubmitReview(): void
    {
        $this->service->createReview(['id' => 10, 'employee_id' => 1, 'reviewer_id' => 1]);

        $submitted = $this->service->submitReview(10);

        $this->assertNotNull($submitted);
        $this->assertSame('submitted', $submitted->getStatus());
    }

    /**
     * @covers Ksfraser\Performance\Service\PerformanceService::completeReview
     */
    public function testCompleteReview(): void
    {
        $this->service->createReview(['id' => 20, 'employee_id' => 1, 'reviewer_id' => 1]);

        $completed = $this->service->completeReview(20, 4.5);

        $this->assertNotNull($completed);
        $this->assertSame(4.5, $completed->getRating());
        $this->assertTrue($completed->isCompleted());
    }

    /**
     * @covers Ksfraser\Performance\Service\PerformanceService::createGoal
     */
    public function testCreateGoal(): void
    {
        $goal = $this->service->createGoal([
            'id' => 1,
            'employee_id' => 100,
            'title' => 'Complete Training',
            'target' => 100,
        ]);

        $this->assertInstanceOf(Goal::class, $goal);
        $this->assertSame('Complete Training', $goal->getTitle());
    }
}