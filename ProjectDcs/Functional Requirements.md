# Functional Requirements - ksf_Performance

## Document Information
- **Module**: ksf_Performance
- **Version**: 1.0.0
- **Date**: 2026-05-24
- **Status**: Draft
- **Author**: KSFII Development Team

---

## 1. Performance Review Management

### FR-PERF-001: Create Performance Review
**Description**: HR Manager or designated reviewer can create a performance review for an employee.

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| employee_id | string | Yes | FK to crm_persons |
| reviewer_id | string | Yes | FK to crm_persons |
| review_period_start | date | Yes | Start of review period |
| review_period_end | date | Yes | End of review period |
| type | enum | Yes | annual, quarterly, probation, 360 |

### FR-PERF-002: Review Workflow
**Description**: Reviews follow a status workflow: draft → in_progress → completed → acknowledged. HR can re-open a review if needed.

### FR-PERF-003: Review Acknowledgment
**Description**: Employee must acknowledge the completed review. Acknowledgment is recorded with timestamp.

---

## 2. Goal Setting

### FR-PERF-004: Goal Management
**Description**: Reviewer can add, update, and delete goals within a review.

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| name | string | Yes | Goal name |
| description | text | No | Detailed goal description |
| category | enum | Yes | performance, development, behavioral |
| weight | integer | Yes | 0-100, auto-normalized across goals |

### FR-PERF-005: Goal Scoring
**Description**: Each goal is scored (not_met, partially_met, met, exceeded). The overall rating is calculated as weighted average of goal scores.

---

## 3. 360 Feedback

### FR-PERF-006: Feedback Request
**Description**: Reviewer can request feedback from peers, subordinates, and other managers for a review.

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| requested_from | string | Yes | FK to crm_persons |
| relationship | enum | Yes | peer, subordinate, manager |
| due_date | date | No | Response deadline |

### FR-PERF-007: Feedback Submission
**Description**: Requested feedback providers can submit responses. Responses may be anonymous (flagged). Submitted feedback is append-only and cannot be edited after submission.

---

## 4. Rating and Scoring

### FR-PERF-008: Overall Rating Calculation
**Description**: The system calculates an overall rating (1-5) from weighted goal scores. Manual override by HR Manager is allowed with reason.

### FR-PERF-009: Rating History
**Description**: Historical ratings are preserved. Previous ratings are visible in subsequent reviews for trend analysis.

---

## 5. RBAC Integration

### FR-PERF-010: Role-Based Access
**Description**: Access to performance reviews, goals, and feedback is controlled via ksfraser/rbac:

| Role | Access Level | Scope |
|------|-------------|-------|
| HR Manager | FULL | All reviews |
| Manager | FULL | Direct reports' reviews |
| Employee | PUBLIC | Own review + acknowledge |
| Peer/Subordinate | PUBLIC | Feedback requests only |
| Executive | Aggregate only | No individual review detail |

### FR-PERF-011: Data Projections
**Description**: The module enforces PUBLIC vs FULL projections per the RBAC entity projection table defined in Architecture.md §3.2. Salary recommendations and promotion data are FULL-only.

### FR-PERF-012: Audit Trail
**Description**: All review status changes, score changes, and feedback submissions are logged for audit compliance.

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-24*
