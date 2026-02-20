```md
# parent-functionality.md
# Parent Functionality
MVP rule: **1 School ↔ 1 Vendor** | **Children = reference-only**

Parent is the buyer. Parent views the school’s published booklist, orders online, and pays via FPX.

---

## 1) Parent main actions
1. **Register and login**
   **Reason:** Needed to track orders and payments.

2. **Create children profiles (reference-only)**
   Fields:
   - child name
   - school
   - grade label
   **Reason:** Helps parent quickly find the correct booklist. Children do not appear in order.

3. **View published booklist**
   - Select school + grade label (or use child profile)
   - See sections (Textbook/Stationery/etc.)
   **Reason:** School lists are different, so system must display flexibly.

4. **Add items to cart**
   - Use **Buy All** (adds all required items)
   - Or choose items one-by-one
   - Adjust quantities
   **Reason:** Some parents want speed, others want flexibility.

5. **Checkout (one school only)**
   - Cart must contain items from ONE school
   - Choose fulfillment:
     - pickup at school
     - shipment (enter address)
   **Reason:** Prevent confusion in pickup/shipping.

6. **Pay via FPX**
   - Redirect to gateway
   - Return to system after payment
   **Reason:** Online payment is the core requirement.

7. **Track order status**
   Status example:
   - pending_payment → paid → processing → ready/shipped → completed
   **Reason:** Parent needs confidence and updates.

---

## 2) Parent rules (MVP v1.1)
1. **Cart cannot mix schools**
   **Reason:** Different pickup/shipping and different vendors.

2. **1 school always routes to 1 vendor**
   **Reason:** Simple fulfillment.

3. **Children data stays as profile only**
   - not stored in order
   - not used to split order items
   **Reason:** Keeps ordering logic simple.

---

## 3) Suggested Parent pages (Next.js)
- Register / Login
- My Profile
  - children list
  - default address
- Booklist Viewer
  - sections + items
  - buy all + item select
- Cart
- Checkout
  - pickup/shipment
  - payment redirect
- My Orders
  - status tracking
  - receipt/payment status
```
