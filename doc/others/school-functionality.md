```md
# school-functionality.md
# School & School Staff Functionality
MVP rule: **1 School ↔ 1 Vendor** | **Children = reference-only**

School is the owner of the booklist. School creates and publishes booklists and monitors parent orders.

---

## 1) School Admin
### Main purpose
Manage school booklists and school team.

### Can do
1. **School profile setup**
   - Update school name, contact, pickup location info
   **Reason:** Parents need correct pickup information.

2. **Create school staff accounts**
   - Add staff under the same school organization
   - Disable staff if needed
   **Reason:** School admin controls who can access school dashboard.

3. **Vendor assignment (MVP v1.1)**
   - Link school to exactly one vendor
   **Reason:** Keeps ordering and fulfillment simple.

4. **Create booklists**
   - Set Academic Year (e.g., 2026)
   - Set Grade Label (Darjah 1 / Tingkatan 1 / Year 7, etc.)
   - Add sections (Textbook / Exercise / Stationery)
   - Add items from vendor catalog
   - Set required quantity per item
   - Optional: set school display name per item
   - Optional: override price per item
   **Reason:** Each school has different format and naming.

5. **Clone last year’s booklist**
   - Copy sections/items into new year and edit
   **Reason:** Schools reuse lists with small changes.

6. **Publish / archive booklists**
   - Draft → Published → Archived
   **Reason:** Parents must only see final, approved booklists.

7. **View parent orders**
   - View paid orders
   - View pickup/shipment method
   **Reason:** Helps school plan pickup and communication.

---

## 2) School Staff
### Main purpose
Support school admin daily tasks.

### Can do (limited)
- Assist creating/editing booklists (if allowed)
- Assist Excel/PDF import and confirmation
- View orders and pickup lists

**Reason:** Reduce school admin workload.

---

## 3) School workflow (simple)
1. School is approved
2. School is assigned to a vendor
3. School creates booklist (year + grade label) with flexible sections
4. School publishes booklist
5. Parents order and pay via FPX
6. School monitors pickup/shipment progress

---

## 4) School rules (MVP v1.1)
- Booklist items must come from the school’s assigned vendor catalog
- School may override item display name and price (optional)
- Children data is not required for ordering (only for parent convenience)

---

## 5) Suggested School pages (Filament)
- Booklists
  - Sections
  - Items
  - Publish
  - Clone
- Orders
  - Paid orders
  - Pickup list
- Import
  - Excel upload
  - PDF extract confirmation
- Staff Management
  - Create/disable school staff
```
