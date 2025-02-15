<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if (!$admin_id) {
    header('Location: login.php');
    exit(); // Ensure the script stops execution after redirect
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Shop Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #27ae60;
            text-align: center;
        }
        .alert {
            padding: 15px;
            margin-bottom: 15px;
            border-left: 5px solid;
        }
        .new-stock { background: #fff3cd; border-left-color: #ffcc00; }
        .inventory { background: #d4edda; border-left-color: #28a745; }
        .expiry { background: #f8d7da; border-left-color: #dc3545; }
        .sales { background: #cce5ff; border-left-color: #007bff; }
        .feedback { background: #e2e3e5; border-left-color: #6c757d; }
        .promotions { background: #fff3f3; border-left-color: #e74c3c; }
        .alert h3 { margin: 0; }
        .alert p { margin: 5px 0; color: #555; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: black;
        }
        ul {
            color: #555;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Yatawara Grocerry Shop : Admin Updates</h2>
        <p style="text-align: center; color: #666; font-size: 14px;">Stay updated with the latest grocery shop operations, stock levels, and performance insights.</p>

        <div class="alert new-stock">
            <h3>🛒 New Stock Arrivals</h3>
            <p>Fresh vegetables and dairy products have arrived. Update the stock details.</p>
            <ul>
                <li>Organic Carrots - 50kg</li>
                <li>Fresh Milk - 100 packs</li>
                <li>Whole Wheat Bread - 80 loaves</li>
            </ul>
        </div>

        <div class="alert inventory">
            <h3>📦 Inventory Update</h3>
            <p>Stock levels are stable, but rice and flour need restocking soon.</p>
            <p>🔔 Reminder: Order <strong>25 bags of Basmati Rice</strong> and <strong>50 bags of Wheat Flour</strong>.</p>
        </div>

        <div class="alert expiry">
            <h3>⚠️ Expiry Alert</h3>
            <p>Some dairy products are near expiry. Check and apply discounts or remove from stock.</p>
            <p>⚠️ Items expiring soon: <strong>Yogurt (15 packs)</strong>, <strong>Cheese (10 blocks)</strong>, <strong>Butter (5 packs)</strong></p>
        </div>

        <div class="alert sales">
            <h3>💰 Sales Performance</h3>
            <p>This week's sales have increased by 12%. Keep up the good promotions.</p>
            <p>Top-selling items this week:
                <ul>
                    <li>Fresh Eggs - 250 packs sold</li>
                    <li>Basmati Rice - 180 bags sold</li>
                    <li>Cooking Oil - 100 bottles sold</li>
                </ul>
            </p>
        </div>

        <div class="alert feedback">
            <h3>🛍️ Customer Feedback</h3>
            <p>Recent customer reviews indicate high satisfaction with product quality but suggest improving checkout speed.</p>
            <p>💡 Suggested improvements:
                <ul>
                    <li>Introduce self-checkout counters.</li>
                    <li>Provide more staff at peak hours.</li>
                </ul>
            </p>
        </div>

        <div class="alert promotions">
            <h3>🚀 Promotions & Discounts</h3>
            <p>Upcoming weekend sale: Get up to 20% off on selected fresh produce and dairy items.</p>
            <p>📢 Promotional ideas:
                <ul>
                    <li>Send SMS offers to regular customers.</li>
                    <li>Highlight discounts on social media.</li>
                </ul>
            </p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="admin_page.php" class="btn">Go to Admin Panel</a>
        </div>
    </div>

</body>
</html>
