```md
# vendor-functionality.md
# Vendor & Vendor Staff Functionality
MVP rule: **1 School ↔ 1 Vendor** | **Children = reference-only**

Vendor is the supplier. Vendor manages product supplies, price, stock, and fulfillment.

---

## 1) Vendor Admin
### Main purpose
Control vendor operations and manage vendor team.

### Can do
1. **Vendor profile setup**
   - Update vendor name, phone, email, address
   **Reason:** Needed for shipping and communication.

2. **Create vendor staff accounts**
   - Add staff under the same vendor organization
   - Disable staff if needed
   **Reason:** Vendor admin controls who can access vendor dashboard.

3. **Manage vendor catalog (supplies)**
   - Add products (link to master product by ISBN/code)
   - Set default price
   - Update stock quantity
   - Activate/deactivate items
   **Reason:** Vendor must declare what can be supplied and at what price.

4. **Demand dashboard**
   - View **forecast demand** (from published booklists)
   - View **actual demand** (from paid orders)
   - Compare with current stock
   **Reason:** Vendor can prepare earlier, not waiting blindly.

5. **Fulfillment (orders)**
   - View paid orders for assigned schools
   - Update status: processing → ready → shipped/picked up → completed
   - For shipment: enter courier + tracking
   **Reason:** Parents need clear status updates.

---

## 2) Vendor Staff
### Main purpose
Help vendor admin handle daily operational work.

### Can do (limited)
- Update stock
- View orders
- Pack items
- Update fulfillment status
- Add tracking number (if permitted)

**Reason:** Staff should not change sensitive vendor settings.

---

## 3) Vendor workflow (simple)
1. Vendor gets approved
2. Vendor sets up products + stock
3. School publishes booklist using vendor products
4. Parent pays via FPX
5. Vendor fulfills order (pickup or shipment)

**Reason:** Matches your end-to-end system objective.

---

## 4) Vendor rules (MVP v1.1)
- Vendor receives orders only from schools assigned via `school_vendor`
- Default prices come from vendor, unless school overrides at booklist item level
- Forecast uses published booklists; actual uses paid orders

---

## 5) Suggested Vendor pages (Filament)
- Catalog
  - Products, prices, stock
- Orders
  - Paid orders list + status updates
- Fulfillment
  - Pickup readiness
  - Shipment tracking
- Demand Dashboard
  - Forecast vs actual vs stock
- Staff Management
  - Create/disable vendor staff
```
