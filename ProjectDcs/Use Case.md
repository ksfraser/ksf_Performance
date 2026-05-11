# Use Cases - ksf_Performance

## UC-PR-001: Create Performance Review
**Actor**: Manager, HR

**Flow**:
1. HR initiates review cycle
2. Manager assigned to direct reports
3. Self-review requested from employees
4. Manager completes review form
5. Goals for next period set
6. Workflow approval (ksf_Workflow)

## UC-PR-002: 360 Feedback Collection
**Actor**: System, Peers

**Flow**:
1. Review includes 360 feedback
2. System sends requests to:
   - Peers
   - Direct reports (if manager review)
   - Manager
3. Anonymous responses collected
4. Aggregated for reviewee
5. Manager sees all feedback

## UC-PR-003: Goal Tracking
**Actor**: Employee, Manager

**Flow**:
1. Set goals (SMART format)
2. Link to company objectives
3. Track progress throughout year
4. Update status: Not Started → In Progress → Complete
5. Include in performance review

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*