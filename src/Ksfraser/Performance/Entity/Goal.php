<?php

declare(strict_types=1);

namespace Ksfraser\Performance\Entity;

class Goal
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    private ?int $id = null;
    private int $employeeId = 0;
    private string $title = '';
    private string $description = '';
    private string $category = 'Professional';
    private string $status = self::STATUS_DRAFT;
    private int $weight = 0;
    private float $target = 0;
    private float $actual = 0;
    private string $measure = '';
    private ?string $dueDate = null;
    private ?string $completedAt = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getCategory(): string { return $this->category; }
    public function setCategory(string $category): self { $this->category = $category; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getWeight(): int { return $this->weight; }
    public function setWeight(int $weight): self { $this->weight = $weight; return $this; }
    public function getTarget(): float { return $this->target; }
    public function setTarget(float $target): self { $this->target = $target; return $this; }
    public function getActual(): float { return $this->actual; }
    public function setActual(float $actual): self { $this->actual = $actual; return $this; }
    public function getMeasure(): string { return $this->measure; }
    public function setMeasure(string $measure): self { $this->measure = $measure; return $this; }
    public function getDueDate(): ?string { return $this->dueDate; }
    public function setDueDate(?string $dueDate): self { $this->dueDate = $dueDate; return $this; }
    public function getCompletedAt(): ?string { return $this->completedAt; }
    public function setCompletedAt(?string $completedAt): self { $this->completedAt = $completedAt; return $this; }
    public function getProgress(): float
    {
        return $this->target > 0 ? ($this->actual / $this->target) * 100 : 0;
    }
}