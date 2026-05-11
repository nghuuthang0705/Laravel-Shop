# Thiết kế database Website bán hàng

Bảng chính:
- products
- orders
- order_items

Ý nghĩa:
- products: lưu sản phẩm
- orders: lưu đơn hàng
- order_items: từng sản phẩm trong đơn hàng
- user # Laravel Tạo sẵn

products:
- id
- name
- price
- description
- image
- created_at, updated_at

orders:
- id
- user_id
- customer_name
- customer_phone
- customer_address
- total_amount
- created_at, updated_at

order_items:
- id
- order_id
- product_id
- quantity
- price
- created_at, updated_at