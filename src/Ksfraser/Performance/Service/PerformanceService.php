<?php

declare(strict_types=1);

namespace Ksfraser\Performance\Service;

use Ksfraser\Performance\Entity\PerformanceReview;
use Ksfraser\Performance\Entity\Goal;

class PerformanceService
{
    private array $reviews = [];
    private array $goals = [];

    public function createReview(array $data): PerformanceReview
    {
        $review = new PerformanceReview();
        if (isset($data['id'])) {
            $review->setId($data['id']);
        }
        $review->setEmployeeId($data['employee_id'] ?? 0);
        $review->setReviewerId($data['reviewer_id'] ?? 0);
        $review->setPeriodStart($data['period_start'] ?? '');
        $review->setPeriodEnd($data['period_end'] ?? '');
        $review->setStatus($data['status'] ?? PerformanceReview::STATUS_DRAFT);
        $review->setObjectives($data['objectives'] ?? '');
        $review->setFeedback($data['feedback'] ?? '');
        $review->setDevelopmentPlan($data['development_plan'] ?? '');

        $this->reviews[$review->getId() ?? count($this->reviews) + 1] = $review;
        return $review;
    }

    public function getReview(int $id): ?PerformanceReview
    {
        return $this->reviews[$id] ?? null;
    }

    public function submitReview(int $id): ?PerformanceReview
    {
        $review = $this->getReview($id);
        if ($review === null) return null;

        $review->setStatus(PerformanceReview::STATUS_SUBMITTED);
        $review->setSubmittedAt(date('Y-m-d H:i:s'));
        return $review;
    }

    public function completeReview(int $id, float $rating): ?PerformanceReview
    {
        $review = $this->getReview($id);
        if ($review === null) return null;

        $review->setRating($rating);
        $review->setStatus(PerformanceReview::STATUS_COMPLETED);
        $review->setCompletedAt(date('Y-m-d H:i:s'));
        return $review;
    }

    public function createGoal(array $data): Goal
    {
        $goal = new Goal();
        if (isset($data['id'])) {
            $goal->setId($data['id']);
        }
        $goal->setEmployeeId($data['employee_id'] ?? 0);
        $goal->setTitle($data['title'] ?? '');
        $goal->setDescription($data['description'] ?? '');
        $goal->setCategory($data['category'] ?? 'Professional');
        $goal->setStatus($data['status'] ?? Goal::STATUS_DRAFT);
        $goal->setWeight($data['weight'] ?? 0);
        $goal->setTarget($data['target'] ?? 0);
        $goal->setMeasure($data['measure'] ?? '');
        $goal->setDueDate($data['due_date'] ?? null);

        $this->goals[$goal->getId() ?? count($this->goals) + 1] = $goal;
        return $goal;
    }

    public function getGoal(int $id): ?Goal
    {
        return $this->goals[$id] ?? null;
    }

    public function getEmployeeReviews(int $employeeId): array
    {
        $reviews = [];
        foreach ($this->reviews as $review) {
            if ($review->getEmployeeId() === $employeeId) {
                $reviews[] = $review;
            }
        }
        return $reviews;
    }

    public function getEmployeeGoals(int $employeeId): array
    {
        $goals = [];
        foreach ($this->goals as $goal) {
            if ($goal->getEmployeeId() === $employeeId) {
                $goals[] = $goal;
            }
        }
        return $goals;
    }
}