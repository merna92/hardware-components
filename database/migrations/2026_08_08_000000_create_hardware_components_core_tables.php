<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->unique();
            $table->string('country')->nullable();
            $table->string('website_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->string('warranty_period')->nullable();
            $table->string('image_url')->nullable();
            $table->date('release_date')->nullable();
            $table->enum('status', ['Available', 'Out_Of_Stock', 'Discontinued', 'Coming_Soon', 'Hidden'])->default('Available');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('specification_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('unit')->nullable();
            $table->enum('data_type', ['Text', 'Number', 'Boolean', 'Option'])->default('Text');
            $table->timestamps();
        });

        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specification_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('spec_name');
            $table->string('spec_value');
            $table->string('unit')->nullable();
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('image_url');
            $table->string('alt_text')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['Active', 'Checked_Out', 'Abandoned'])->default('Active');
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->timestamp('added_at')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->timestamp('order_date')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Delivered', 'Cancelled', 'Returned'])->default('Pending');
            $table->enum('payment_status', ['Unpaid', 'Paid', 'Failed', 'Refunded', 'Partially_Refunded'])->default('Unpaid');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->string('product_snapshot_name');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['Credit_Card', 'Debit_Card', 'Cash_On_Delivery', 'Wallet', 'Bank_Transfer']);
            $table->decimal('amount', 10, 2);
            $table->string('transaction_reference')->nullable();
            $table->enum('status', ['Pending', 'Successful', 'Failed', 'Cancelled', 'Refunded'])->default('Pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('shipping_company')->nullable();
            $table->string('tracking_number')->nullable();
            $table->enum('status', ['Preparing', 'Shipped', 'In_Transit', 'Delivered', 'Failed', 'Returned'])->default('Preparing');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->timestamps();
        });

        Schema::create('pc_builds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('build_name');
            $table->decimal('total_budget', 10, 2)->nullable();
            $table->enum('usage_type', ['Gaming', 'Workstation', 'Office', 'Programming', 'Design', 'Video_Editing', 'Streaming', 'Study', 'General_Use']);
            $table->enum('status', ['Draft', 'Completed', 'Saved', 'Shared', 'Ordered'])->default('Draft');
            $table->timestamps();
        });

        Schema::create('build_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pc_build_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('component_role', ['CPU', 'GPU', 'RAM', 'Motherboard', 'Storage', 'PSU', 'Case', 'Cooler', 'Monitor', 'Keyboard', 'Mouse', 'Other']);
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamp('added_at')->nullable();
            $table->boolean('is_recommended')->default(false);
            $table->timestamps();
        });

        Schema::create('compatibility_rules', function (Blueprint $table) {
            $table->id();
            $table->string('rule_name');
            $table->enum('rule_type', ['CPU_Motherboard_Socket', 'RAM_Motherboard_Type', 'PSU_Wattage', 'Case_Motherboard_Size', 'GPU_Case_Length', 'Cooler_CPU_Socket', 'Storage_Interface']);
            $table->text('description')->nullable();
            $table->enum('severity', ['Info', 'Warning', 'Error', 'Critical'])->default('Info');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('compatibility_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pc_build_id')->constrained()->cascadeOnDelete();
            $table->foreignId('compatibility_rule_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('result_status', ['Compatible', 'Warning', 'Incompatible', 'Unknown'])->default('Unknown');
            $table->text('message');
            $table->timestamp('checked_at')->nullable();
            $table->enum('severity', ['Info', 'Warning', 'Error', 'Critical'])->default('Info');
            $table->timestamps();
        });

        Schema::create('recommendation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('budget', 10, 2);
            $table->enum('usage_type', ['Gaming', 'Workstation', 'Office', 'Programming', 'Design', 'Video_Editing', 'Streaming', 'Study', 'General_Use']);
            $table->enum('performance_level', ['Entry_Level', 'Mid_Range', 'High_End', 'Enthusiast']);
            $table->string('preferred_brand')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['Pending', 'Generated', 'Failed', 'Saved'])->default('Pending');
            $table->timestamps();
        });

        Schema::create('recommendation_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommendation_request_id')->constrained()->cascadeOnDelete();
            $table->string('preference_name');
            $table->string('preference_value');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->timestamps();
        });

        Schema::create('recommendation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommendation_request_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_estimated_price', 10, 2)->default(0);
            $table->unsignedTinyInteger('score')->default(0);
            $table->text('explanation')->nullable();
            $table->boolean('is_selected')->default(false);
            $table->timestamps();
        });

        Schema::create('recommended_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommendation_result_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('component_role', ['CPU', 'GPU', 'RAM', 'Motherboard', 'Storage', 'PSU', 'Case', 'Cooler', 'Monitor', 'Keyboard', 'Mouse', 'Other']);
            $table->text('reason')->nullable();
            $table->unsignedTinyInteger('score')->default(0);
            $table->decimal('estimated_price', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('comparison_type', ['Manual', 'Recommendation_Based', 'Build_Based'])->default('Manual');
            $table->enum('status', ['Active', 'Saved', 'Archived'])->default('Active');
            $table->timestamps();
        });

        Schema::create('comparison_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comparison_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamp('added_at')->nullable();
            $table->unsignedInteger('display_order')->default(1);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Hidden'])->default('Pending');
            $table->timestamps();
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wishlist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamp('added_at')->nullable();
            $table->timestamps();
        });

        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_code')->unique();
            $table->enum('discount_type', ['Percentage', 'Fixed_Amount']);
            $table->decimal('discount_value', 10, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('usage_limit')->nullable();
            $table->enum('status', ['Active', 'Expired', 'Disabled', 'Scheduled'])->default('Scheduled');
            $table->timestamps();
        });

        Schema::create('discountables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->cascadeOnDelete();
            $table->morphs('discountable');
            $table->timestamps();
        });

        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('support_agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subject');
            $table->text('description');
            $table->enum('status', ['Open', 'In_Progress', 'Waiting_For_Customer', 'Resolved', 'Closed'])->default('Open');
            $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent'])->default('Medium');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('message_text');
            $table->timestamp('sent_at')->nullable();
            $table->enum('sender_type', ['Customer', 'Support_Agent', 'System']);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['Order_Update', 'Recommendation_Ready', 'Price_Drop', 'Stock_Available', 'Support_Update', 'System_Message']);
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action_type');
            $table->string('entity_name');
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('result', ['Success', 'Failed'])->default('Success');
            $table->timestamps();
        });
    }

    public function down()
    {
        $tables = [
            'activity_logs', 'notifications', 'ticket_messages', 'support_tickets',
            'discountables', 'discounts', 'wishlist_items', 'wishlists', 'reviews',
            'comparison_items', 'comparisons', 'recommended_components',
            'recommendation_results', 'recommendation_preferences',
            'recommendation_requests', 'compatibility_checks', 'compatibility_rules',
            'build_components', 'pc_builds', 'shipments', 'payments', 'order_items',
            'orders', 'cart_items', 'carts', 'addresses', 'product_images',
            'product_specifications', 'specification_types', 'products', 'brands',
            'categories',
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
