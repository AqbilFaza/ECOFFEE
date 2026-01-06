<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class OrderAdminTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_bisa_login()
    {
        $admin = Admin::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password')
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'password'
        ]);

        $response->assertRedirect('/admin/orders');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    #[Test]
    public function admin_tidak_bisa_akses_dashboard_tanpa_login()
    {
        $response = $this->get('/admin/orders');
        $response->assertRedirect('/admin/login');
    }

    #[Test]
    public function order_dan_items_tersimpan_dengan_benar()
    {
        $customer = Customer::create([
            'nama' => 'Budi',
            'hp' => '081234567890',
            'meja' => '5'
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'metode_bayar' => 'TUNAI',
            'status' => 'MENUNGGU_PEMBAYARAN',
            'total' => 50000
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'nama' => 'Cappuccino',
            'harga' => 20000,
            'qty' => 2
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'total' => 50000
        ]);

        $this->assertDatabaseHas('order_items', [
            'nama' => 'Cappuccino',
            'qty' => 2
        ]);
    }

    #[Test]
    public function admin_bisa_mengkonfirmasi_pembayaran()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);

        $customer = Customer::create([
            'nama' => 'Ani',
            'hp' => '081234567891',
            'meja' => '3'
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'metode_bayar' => 'TUNAI',
            'status' => 'MENUNGGU_PEMBAYARAN',
            'total' => 30000
        ]);

        $this->actingAs($admin, 'admin')
            ->post("/admin/orders/{$order->id}/confirm")
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'LUNAS'
        ]);
    }

    #[Test]
    public function halaman_admin_menampilkan_pesanan()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);

        $customer = Customer::create([
            'nama' => 'Rina',
            'hp' => '081234567892',
            'meja' => '2'
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'metode_bayar' => 'TUNAI',
            'status' => 'MENUNGGU_PEMBAYARAN',
            'total' => 40000
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'nama' => 'Americano',
            'harga' => 18000,
            'qty' => 2
        ]);

        $response = $this->actingAs($admin, 'admin')
            ->get('/admin/orders');

        $response->assertStatus(200);
        $response->assertSee('Americano');
        $response->assertSee('2x');
    }
}
