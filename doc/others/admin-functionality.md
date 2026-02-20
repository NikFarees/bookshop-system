```md
# admin-functionality.md
# Admin & Super Admin Functionality
MVP rule: **1 School ↔ 1 Vendor** | **Children = reference-only**

This document explains what Admin and Super Admin can do in the system.

---

## 1) Super Admin (highest access)
### Main purpose
Keep the platform safe, correct, and controlled.

### Can do
1. **Approve / Reject / Suspend organizations**
   - Schools
   - Vendors
   **Reason:** Prevent fake accounts and protect payment operations.

2. **Manage admins**
   - Create/disable Admin accounts
   **Reason:** Control who can operate the platform.

3. **Manage global settings**
   - System settings (statuses, basic configuration)
   **Reason:** Ensure consistent rules and stable operations.

4. **View and audit everything**
   - All organizations, users, booklists, orders, payments, shipments, imports
   - View audit logs
   **Reason:** Needed for troubleshooting, disputes, and reporting.

5. **Override / emergency actions (if enabled)**
   - Temporarily stop orders for a school/vendor
   - Freeze operations during incident
   **Reason:** Protect customers during serious issues.

---

## 2) Admin (platform operator)
### Main purpose
Handle daily operations and user support.

### Can do
1. **Process approvals (if you allow Admin to approve)**
   - Approve / Reject / Suspend schools and vendors
   **Reason:** Faster onboarding.

2. **Support data import**
   - Help schools import booklists (Excel)
   - Help schools confirm PDF extraction rows
   **Reason:** Import is a key pain point for schools.

3. **Monitor orders and payments**
   - View order statuses
   - View FPX payment logs (paid/failed)
   **Reason:** Payment and ordering issues must be handled quickly.

4. **Operational support**
   - Assist schools/vendors when order statuses are stuck
   - Check shipment/pickup records
   **Reason:** Keep day-to-day business running smoothly.

---

## 3) Admin rules to enforce (MVP v1.1)
1. **Organization approval is required**
   - Unapproved schools/vendors cannot publish booklists or accept paid orders.
   **Reason:** Prevent fraud.

2. **School ↔ Vendor binding is fixed**
   - Each school must be assigned to exactly one vendor.
   **Reason:** Keeps fulfillment simple.

3. **Role + org membership must match**
   - `school_admin/school_staff` must link to a school organization
   - `vendor_admin/vendor_staff` must link to a vendor organization
   **Reason:** Prevent wrong access and data leaks.

---

## 4) Suggested Admin pages (Filament)
- Organizations
  - Schools: approve/suspend
  - Vendors: approve/suspend
- Users
  - Create/disable Admins
  - View org users
- School-Vendor assignment
  - Assign vendor to school
- Orders
  - View all orders + statuses
- Payments
  - View FPX logs
- Imports
  - View import history
- Audit Logs
  - Key activity tracking

**Reason:** Covers the full operational lifecycle.
```
