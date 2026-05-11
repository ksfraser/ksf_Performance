<?php

declare(strict_types=1);

namespace Ksfraser\Performance\Entity;

class PerformanceReview
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_MANAGER_REVIEW = 'manager_review';
    public const STATUS_COMPLETED = 'completed';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $reviewerId = 0;
    private string $periodStart = '';
    private string $periodEnd = '';
    private string $status = self::STATUS_DRAFT;
    private float $rating = 0;
    private string $objectives = '';
    private string $feedback = '';
    private string $developmentPlan = '';
    private ?string $submittedAt = null;
    private ?string $completedAt = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getReviewerId(): int { return $this->reviewerId; }
    public function setReviewerId(int $reviewerId): self { $this->reviewerId = $reviewerId; return $this; }
    public function getPeriodStart(): string { return $this->periodStart; }
    public function setPeriodStart(string $periodStart): self { $this->periodStart = $periodStart; return $this; }
    public function getPeriodEnd(): string { return $this->periodEnd; }
    public function setPeriodEnd(string $periodEnd): self { $this->periodEnd = $periodEnd; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getRating(): float { return $this->rating; }
    public function setRating(float $rating): self { $this->rating = $rating; return $this; }
    public function getObjectives(): string { return $this->objectives; }
    public function setObjectives(string $objectives): self { $this->objectives = $objectives; return $this; }
    public function getFeedback(): string { return $this->feedback; }
    public function setFeedback(string $feedback): self { $this->feedback = $feedback; return $this; }
    public function getDevelopmentPlan(): string { return $this->developmentPlan; }
    public function setDevelopmentPlan(string $developmentPlan): self { $this->developmentPlan = $developmentPlan; return $this; }
    public function getSubmittedAt(): ?string { return $this->submittedAt; }
    public function setSubmittedAt(?string $submittedAt): self { $this->submittedAt = $submittedAt; return $this; }
    public function getCompletedAt(): ?string { return $this->completedAt; }
    public function setCompletedAt(?string $completedAt): self { $this->completedAt = $completedAt; return $this; }
    public function isCompleted(): bool { return $this->status === self::STATUS_COMPLETED; }
}