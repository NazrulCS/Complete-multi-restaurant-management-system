# Multi-Restaurant Management System and Online Food Ordering

This project is an attempt at a complete **multi-restaurant management system** that deals with adding and managing multiple restaurants, overseeing their individual food items, incomes, orders, and more. It also includes the usual features of an online food portal for users.

## User Logins

The system supports three primary login and management processes:

1. **User or Customer Login**
2. **Restaurant Owner Login**
3. **Admin Login**

---

### 1. User or Customer Login

Users can access the website as a typical online food ordering system. They can browse, select, and add food items to their cart, complete online payments, and check order status.

### 2. Restaurant Owner Login

Restaurant owners can manage their online food shop or store. They are able to:
- Add, edit, or modify specific dishes or food items under their restaurant (one owner can have one or more restaurants).
- Manage order and payment information.
- Check order status.

### 3. Admin Login

Administrators have the ability to:
- Perform necessary maintenance, modifications, and management of the current state of the members within the full system.
- Generate reports.

---

## User Registration and Validation

To ensure a smooth registration process, the following criteria are considered:

- User names must be unique.
- Phone number length must be valid.
- Email addresses must be valid.
- Password security requirements:
  - Combination of upper-case and lower-case letters.
  - A minimal length for the password.
- Currency symbol conversion from `$` to `৳`, `bdt`, or `taka`.

---

## Support for Restaurant Owners

Significant changes have been implemented in the database/backend to support restaurant owners:

- Creation of accounts under the `restaurant_owners` table.
- Access to maintain their restaurants under the following tables:
  - `restaurant`
  - `res_category`
  - `dishes`

### User Experience Enhancements

To streamline support for restaurant owners, the following PHP files have been created:

- `restaurant_owner_register.php`
- `restaurant_owner_login.php`
- `restaurant_owner_dashboard.php`
- `manage_restaurant.php`
- `dishes.php`
- `create_restaurant.php`
- `create_dish.php`
