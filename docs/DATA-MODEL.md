# Data Model

Hardware Components is a Laravel and MySQL e-commerce recommendation system for computer hardware.

## Main Entities

- Users: admins, customers, and support agents.
- Catalog: categories, brands, products, product specifications, and product images.
- Commerce: addresses, carts, cart items, orders, order items, payments, and shipments.
- PC builds: customer builds, selected components, compatibility rules, and compatibility checks.
- Recommendations: requests, preferences, results, and recommended components.
- Engagement: comparisons, reviews, wishlists, support tickets, ticket messages, notifications, and activity logs.
- Discounts: discount rules that can apply to products, categories, or future entities through `discountables`.

## Important Rules

- Products belong to one category and one brand.
- A customer can have many addresses and one wishlist.
- A cart contains many cart items, and each cart item references one product.
- Orders preserve product names in `order_items.product_snapshot_name`.
- Recommendations must not silently recommend unavailable, discontinued, or incompatible products.
- Support tickets may be assigned to a support agent, who is also a user with `role_type = Support_Agent`.
