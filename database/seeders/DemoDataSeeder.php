<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a dummy client user
        $demoUser = User::firstOrCreate(
            ['email' => 'cliente_demo@ecoentrega.com'],
            [
                'name' => 'Cliente Demo',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $demoUser->assignRole('cliente');

        $demoClient = Client::firstOrCreate(
            ['id_user' => $demoUser->id],
            [
                'phone' => '3001234567',
                'address' => 'Calle Falsa 123',
            ]
        );

        // 2. Create some categories
        $categories = [
            'Camisas',
            'Pantalones',
            'Zapatos',
            'Accesorios',
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['category_name' => $cat], ['description' => "Categoría de $cat"]);
        }

        $camisasCat = Category::where('category_name', 'Camisas')->first();
        $pantalonesCat = Category::where('category_name', 'Pantalones')->first();
        $zapatosCat = Category::where('category_name', 'Zapatos')->first();

        // 3. Create some products
        // Let's attach them to an admin user
        $admin = User::role('super_admin')->first();
        
        $productsData = [
            [
                'product_name' => 'Camisa Vintage A Cuadros',
                'description' => 'Hermosa camisa vintage en excelente estado.',
                'price' => 35000,
                'size' => 'M',
                'garment_condition' => 'Excelente',
                'color' => 'Rojo/Negro',
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e32f85e2c?auto=format&fit=crop&w=500&q=80',
                'id_category' => $camisasCat->id_category,
            ],
            [
                'product_name' => 'Pantalón Denim Clásico',
                'description' => 'Pantalón vaquero de los 90s, desgaste natural.',
                'price' => 50000,
                'size' => '32',
                'garment_condition' => 'Bueno',
                'color' => 'Azul',
                'image' => 'https://images.unsplash.com/photo-1542272604-780c8d52a5ce?auto=format&fit=crop&w=500&q=80',
                'id_category' => $pantalonesCat->id_category,
            ],
            [
                'product_name' => 'Zapatillas Deportivas Retro',
                'description' => 'Zapatillas de colección, casi sin uso.',
                'price' => 120000,
                'size' => '40',
                'garment_condition' => 'Como nuevo',
                'color' => 'Blanco',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80',
                'id_category' => $zapatosCat->id_category,
            ],
            [
                'product_name' => 'Camiseta Estampado Gráfico',
                'description' => 'Camiseta de algodón con diseño retro.',
                'price' => 25000,
                'size' => 'L',
                'garment_condition' => 'Bueno',
                'color' => 'Negro',
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=500&q=80',
                'id_category' => $camisasCat->id_category,
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $data) {
            $createdProducts[] = Product::firstOrCreate(
                ['product_name' => $data['product_name']],
                array_merge($data, [
                    'publication_date' => now(),
                    'id_user' => $admin ? $admin->id : $demoUser->id,
                ])
            );
        }

        // 4. Create an order
        if (count($createdProducts) >= 2) {
            $payment = Payment::create([
                'payment_method' => 'Nequi',
                'payment_status' => 'Aprobado',
                'payment_date' => now(),
                'amount' => $createdProducts[0]->price + $createdProducts[1]->price,
            ]);

            $order = Order::create([
                'id_user' => $demoUser->id,
                'id_client' => $demoClient->id_client,
                'id_payment' => $payment->id_payment,
                'shipping_address' => $demoClient->address,
                'shipping_phone' => $demoClient->phone,
                'payment_method' => 'Nequi',
                'total' => $createdProducts[0]->price + $createdProducts[1]->price,
                'order_status' => 'paid',
                'notes' => 'Dejar en portería por favor.',
                'order_date' => now(),
            ]);

            OrderDetail::create([
                'id_order' => $order->id_order,
                'id_product' => $createdProducts[0]->id_product,
                'quantity' => 1,
                'unit_price' => $createdProducts[0]->price,
                'subtotal' => $createdProducts[0]->price,
            ]);

            OrderDetail::create([
                'id_order' => $order->id_order,
                'id_product' => $createdProducts[1]->id_product,
                'quantity' => 1,
                'unit_price' => $createdProducts[1]->price,
                'subtotal' => $createdProducts[1]->price,
            ]);
        }
    }
}
