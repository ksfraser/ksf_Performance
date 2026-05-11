<?php

declare(strict_types=1);

namespace Ksfraser\Performance\Entity;

class PerformanceReview
{
    public const STATUS_DRAFT = 'Draft';
    public const STATUS_SELF_REVIEW = 'Self Review';
    public const STATUS_MANAGER_REVIEW = 'Manager Review';
    public const STATUS_FINAL = 'Final';
    public const STATUS_COMPLETED = 'Completed';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $reviewerId = 0;
    private string $period = '';
    private string $status = self::STATUS_DRAFT;
    private ?string $selfReviewDue = null;
    private ?string $managerReviewDue = null;
    private ?string $meetingDate = null;
    private int $overallRating = 0;
    private string $comments = '';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getReviewerId(): int { return $this->reviewerId; }
    public function setReviewerId(int $reviewerId): self { $this->reviewerId = $reviewerId; return $this; }
    public function getPeriod(): string { return $this->period; }
    public function setPeriod(string $period): self { $this->period = $period; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getSelfReviewDue(): ?string { return $this->selfReviewDue; }
    public function setSelfReviewDue(?string $selfReviewDue): self { $this->selfReviewDue = $selfReviewDue; return $this; }
    public function getManagerReviewDue(): ?string { return $this->managerReviewDue; }
    public function setManagerReviewDue(?string $managerReviewDue): self { $this->managerReviewDue = $managerReviewDue; return $this; }
    public function getMeetingDate(): ?string { return $this->meetingDate; }
    public function setMeetingDate(?string $meetingDate): self { $this->meetingDate = $meetingDate; return $this; }
    public function getOverallRating(): int { return $this->overallRating; }
    public function setOverallRating(int $overallRating): self { $this->overallRating = $overallRating; return $this; }
    public function getComments(): string { return $this->comments; }
    public function setComments(string $comments): self { $this->comments = $comments; return $this; }

    public function isCompleted(): bool { return $this->status === self::STATUS_COMPLETED; }
    public function isInProgress(): bool { return in_array($this->status, [self::STATUS_SELF_REVIEW, self::STATUS_MANAGER_REVIEW]); }
}