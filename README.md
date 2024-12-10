
### `README.md`

```markdown
# Order Assignment System

## Overview

```The **Order Assignment System** is designed to automate the process of assigning pending orders to available delivery boys based on their capacity and availability. It ensures efficient management of delivery operations by balancing workloads and keeping track of order statuses.

---

## Task Description

This system fulfills the following requirements:

1. **Delivery Boys and Capacities**:
   - **Delivery Boy A**: Can handle up to 2 orders at a time.
   - **Delivery Boy B**: Can handle up to 4 orders at a time.
   - **Delivery Boy C**: Can handle up to 5 orders at a time.
   - **Delivery Boy D**: Can handle up to 3 orders at a time.

2. **Delivery Time Constraint**:
   - Each delivery boy has a delivery time of **30 minutes** per order.
   - Before assigning new orders, the system checks whether the delivery boy's current orders are completed (i.e., 30 minutes have elapsed since the last assignment).

3. **Order Assignment Logic**:
   - Orders are assigned sequentially in the following order: A → B → C → D.
   - The system repeats the cycle (A → B → C → D) for new orders but skips a delivery boy if their delivery time is not yet covered.

4. **Automation**:
   - Orders are assigned automatically when the function runs.
   - Any unassigned orders will remain in the pending state until the next run.

---

The system supports:
- Automated order assignment using a console command.
- Flexible service-oriented architecture for easy extension and maintenance.
- Reusability through the Service and Repository Patterns.
- Manual triggers via a web interface (controller action).

---

## Features

1. **Order Assignment Logic**:
   - Assigns pending orders to delivery boys based on their capacity.
   - Updates order status to "assigned."
   - Updates delivery boy availability based on delivery time.

2. **Console Command**:
   - Automates the assignment process using `php artisan assign:order`.

3. **Controller Endpoint**:
   - Provides a manual trigger via HTTP API for assigning orders.

4. **Scalable Design**:
   - Handles large datasets efficiently with batch processing and optimized queries.
   - Separation of concerns for better maintainability.

---

## Architecture

### Key Components

1. **Models**:
   - `Order`: Represents customer orders.
   - `DeliveryBoy`: Represents delivery personnel and their capacity/availability.

2. **Repositories**:
   - `OrderRepository`: Handles database operations related to orders.
   - `DeliveryBoyRepository`: Manages delivery boy data and queries.

3. **Service**:
   - `OrderAssignmentService`: Encapsulates business logic for assigning orders.

4. **Console Command**:
   - `AssignOrderToDeliveryBoy`: Automates the assignment process.

5. **Controller**:
   - `OrderAssignmentController`: Exposes an HTTP endpoint to manually trigger the assignment process.

---

## How It Works

### Automated Process

1. Fetches all **pending orders**.
2. Fetches all **available delivery boys** sorted by name.
3. Assigns orders to delivery boys until their capacity is reached.
4. Updates:
   - Order status to "assigned."
   - Delivery boy's availability time.

### Entry Points

1. **Console Command**:
   - Run via CLI: `php artisan assign:order`
   - Executes the assignment process automatically.

2. **HTTP Trigger**:
   - Endpoint: `POST /api/trigger-order-assignment`
   - Invokes the assignment process via the `OrderAssignmentController`.

---

## Installation

### Prerequisites
- PHP >= 8.0
- Laravel Framework
- MySQL Database
- Composer

### Setup Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/order-assignment-system.git
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up environment variables:
   - Copy `.env.example` to `.env` and configure your database credentials.

4. Run migrations to create necessary tables:
   ```bash
   php artisan migrate
   ```

5. Seed test data (optional):
   ```bash
   php artisan db:seed
   ```

---

## Usage

### Running the Console Command
To automatically assign orders:
```bash
php artisan assign:order
```

### Triggering via HTTP API
Use a REST client (e.g., Postman) or a browser to make a `POST` request to:
```
http://your-domain/api/trigger-order-assignment
```

### Scheduling the Command
Automate the process by adding it to the Laravel scheduler (`app/Console/Kernel.php`):
```php
$schedule->command('assign:order')->hourly();
```

---

## File Structure

```
app/
├── Console/
│   └── Commands/
│       └── AssignOrderToDeliveryBoy.php
├── Http/
│   └── Controllers/
│       └── OrderAssignmentController.php
├── Models/
│   ├── DeliveryBoy.php
│   └── Order.php
├── Repositories/
│   ├── DeliveryBoyRepository.php
│   └── OrderRepository.php
├── Services/
│   └── OrderAssignmentService.php
database/
├── migrations/
└── seeders/
routes/
└── api.php
```

---

## Testing

### Unit Tests
Test the service and repository logic:
```bash
php artisan test
```

### Endpoints Testing
1. Use PHPUnit or tools like Postman to test API endpoints.
2. Verify order assignment through logs and database updates.

---

## Extending the System

1. **Add New Business Logic**:
   - Extend `OrderAssignmentService` for custom assignment rules.
2. **Custom Filters**:
   - Add methods in `OrderRepository` or `DeliveryBoyRepository`.


---

## License

This project is licensed under the MIT License.
