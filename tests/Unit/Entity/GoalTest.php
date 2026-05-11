<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Performance\Entity;

use Ksfraser\Performance\Entity\Goal;
use PHPUnit\Framework\TestCase;

class GoalTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $goal = new Goal();

        $this->assertNull($goal->getId());
        $this->assertSame(0, $goal->getEmployeeId());
        $this->assertSame('', $goal->getTitle());
        $this->assertSame('draft', $goal->getStatus());
    }

    /**
     * @covers Ksfraser\Performance\Entity\Goal::setId
     */
    public function testSetId(): void
    {
        $goal = new Goal();
        $result = $goal->setId(1);

        $this->assertInstanceOf(Goal::class, $result);
        $this->assertSame(1, $goal->getId());
    }

    /**
     * @covers Ksfraser\Performance\Entity\Goal::getProgress
     */
    public function testGetProgress(): void
    {
        $goal = new Goal();
        $goal->setTarget(100);
        $goal->setActual(75);

        $this->assertSame(75.0, $goal->getProgress());
    }

    /**
     * @covers Ksfraser\Performance\Entity\Goal::STATUS_ACTIVE
     */
    public function testStatusConstants(): void
    {
        $this->assertSame('draft', Goal::STATUS_DRAFT);
        $this->assertSame('active', Goal::STATUS_ACTIVE);
        $this->assertSame('completed', Goal::STATUS_COMPLETED);
    }
}