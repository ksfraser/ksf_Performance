# Architecture - ksf_Performance

## Document Information
- **Module**: ksf_Performance
- **Version**: 1.0.0
- **Date**: 2026-05-24
- **Status**: Draft
- **Author**: KSFII Development Team

---

## 1. Module Overview

ksf_Performance manages employee performance reviews, goal setting, feedback collection, and performance ratings.

### 1.1 Namespace
```php
Ksfraser\Performance\
```

### 1.2 Layer Pattern
```
ksf_Performance/             → Business Logic
    ├── Entity/              → Domain entities
    ├── Service/             → Business services
    ├── Repository/          → Data access interfaces
    └── Exception/           → Domain exceptions
```

---

## 2. Core Entities

### 2.1 PerformanceReview
```php
class PerformanceReview {
    private string $id;
    private string $employeeId;
    private string $reviewerId;
    private \DateTime $reviewPeriodStart;
    private \DateTime $reviewPeriodEnd;
    private ReviewType $type;            // annual, quarterly, probation, 360
    private ReviewStatus $status;        // draft, in_progress, completed, acknowledged
    private ?int $overallRating;         // 1-5
    private ?string $summary;
    private ?\DateTime $completedAt;
    private ?\DateTime $acknowledgedAt;
}
```

### 2.2 ReviewGoal
```php
class ReviewGoal {
    private string $id;
    private string $reviewId;
    private string $name;
    private string $description;
    private GoalCategory $category;      // performance, development, behavioral
    private GoalStatus $status;          // not_met, partially_met, met, exceeded
    private int $weight;                  // 0-100, sum across goals = 100
    private ?string $comment;
}
```

### 2.3 FeedbackRequest
```php
class FeedbackRequest {
    private string $id;
    private string $reviewId;
    private string $requestedFrom;       // peer, subordinate, manager
    private FeedbackStatus $status;      // pending, submitted
    private ?string $response;
    private ?\DateTime $submittedAt;
}
```

---

## 3. RBAC Integration (ksfraser/rbac)

### 3.1 Module Registration

ksf_Performance registers with ksfraser/rbac:
- record_types: 'performance_review', 'review_goal', 'feedback_request'
- projections: 'public' (employee_id, reviewer_id, period, status, overall_rating), 'full' (all fields including summary, comments, 360 feedback, salary_recommendation)
- sensitive data: rating, salary recommendation in FULL only
- allow_invite: false
- children: review_goal, feedback_request (children of performance_review)

### 3.2 Entity Projections

| Entity | PUBLIC Fields | FULL Fields |
|--------|---------------|-------------|
| PerformanceReview | employee, reviewer, period, status, overall_rating | + summary, comments, salary_recommendation, promotion_recommendation, development_plan |
| ReviewGoal | name, category, status, weight | + comment, manager_notes, achievement_evidence |
| FeedbackRequest | requested_from, status | + full response text, submitted_at, anonymity_flag |

### 3.3 Access Model

- **HR Manager**: FULL to all reviews (PROJECTION_FULL), can create/initiate reviews
- **Manager (reviewer)**: FULL to own direct reports' reviews (via org_direct team)
- **Employee**: View own review (PROJECTION_PUBLIC), acknowledge completed review
- **Peer/Subordinate (360)**: View only feedback requests (PROJECTION_PUBLIC), submit feedback
- **Executive**: View aggregate ratings only (no individual review details)

### 3.4 SQL Enforcement

Standard RBAC JOIN pattern for all performance review queries.

### 3.5 Soft Delete

- Reviews are archived (not deleted) on completion
- Draft reviews may be soft-deleted
- Feedback responses are append-only (audit requirement)

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-24*
