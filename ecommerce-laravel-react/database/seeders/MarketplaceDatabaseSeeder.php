<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Enums\UserLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MarketplaceDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar o Administrador Geral da Plataforma
        User::create([
            'name' => 'Admin do Marketplace',
            'email' => 'admin@marketplace.com',
            'password' => Hash::make('password123'),
            'nivel' => UserLevel::ADMIN,
        ]);

        // 2. Criar Categorias Globais de Teste
        $eletronicos = Category::create(['name' => 'Eletrônicos', 'slug' => 'eletronicos']);
        $vestuario = Category::create(['name' => 'Vestuário', 'slug' => 'vestuario']);

        // 3. Criar um Usuário Vendedor 1 e sua respectiva Loja (Seller)
        $userSeller1 = User::create([
            'name' => 'Carlos da Silva Vendedor',
            'email' => 'loja1@vendedor.com',
            'password' => Hash::make('password123'),
            'nivel' => UserLevel::VENDEDOR,
        ]);

        $seller1 = Seller::create([
            'user_id' => $userSeller1->id,
            'store_name' => 'Tech World Store',
            'slug' => 'tech-world-store',
            'document' => '12345678000100', // CNPJ fictício
            'status' => 'active',
        ]);

        // 4. Criar um Usuário Vendedor 2 e sua respectiva Loja
        $userSeller2 = User::create([
            'name' => 'Mariana Souza Modas',
            'email' => 'loja2@vendedor.com',
            'password' => Hash::make('password123'),
            'nivel' => UserLevel::VENDEDOR,
        ]);

        $seller2 = Seller::create([
            'user_id' => $userSeller2->id,
            'store_name' => 'Mari Fashion',
            'slug' => 'mari-fashion',
            'document' => '98765432000199',
            'status' => 'active',
        ]);

        // 5. Vincular Produtos Fictícios aos seus respectivos donos e categorias
        Product::create([
            'seller_id' => $seller1->id,
            'category_id' => $eletronicos->id,
            'name' => 'Smartphone Pro Max X',
            'slug' => 'smartphone-pro-max-x',
            'description' => 'Smartphone de última geração com tela AMOLED.',
            'price' => 4500.00,
            'stock' => 15,
            'weight' => 0.25, 'width' => 8.00, 'height' => 16.00, 'length' => 1.00
        ]);

        Product::create([
            'seller_id' => $seller2->id,
            'category_id' => $vestuario->id,
            'name' => 'Jaqueta de Couro Unissex',
            'slug' => 'jaqueta-de-couro-unissex',
            'description' => 'Jaqueta moderna de couro sintético resistente.',
            'price' => 299.90,
            'stock' => 40,
            'weight' => 0.80, 'width' => 30.00, 'height' => 5.00, 'length' => 40.00
        ]);

        // 6. Criar um Cliente Comum (para simular compras depois)
        User::create([
            'name' => 'João Cliente Final',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('password123'),
            'nivel' => UserLevel::CLIENTE,
        ]);
    }
}
