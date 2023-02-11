<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\JenisRekap;
use App\Models\JenisSaldo;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make('allen123'),

        ]);

        // \App\Models\User::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        JenisSaldo::create([
            'jenis_saldo' => 'Pertambahan'
        ]);
        JenisSaldo::create([
            'jenis_saldo' => 'Pengurangan'
        ]);
        Kategori::create([
            'jenis_akun' => 'Pendapatan',
            'jenis_rekap_id' => '1'
        ]);
        Kategori::create([
            'jenis_akun' => 'Retur',
            'jenis_rekap_id' => '1'
        ]);
        Kategori::create([
            'jenis_akun' => 'Utang Produk',
            'jenis_rekap_id' => '2'
        ]);
        Kategori::create([
            'jenis_akun' => 'Utang Peralatan',
            'jenis_rekap_id' => '2'
        ]);
        Kategori::create([
            'jenis_akun' => 'Piutang',
            'jenis_rekap_id' => '3'
        ]);
        Kategori::create([
            'jenis_akun' => 'Kas',
            'jenis_rekap_id' => '3'
        ]);
        Kategori::create([
            'jenis_akun' => 'Produk',
            'jenis_rekap_id' => '3'
        ]);
        Kategori::create([
            'jenis_akun' => 'Peralatan',
            'jenis_rekap_id' => '3'
        ]);
        Kategori::create([
            'jenis_akun' => 'Beban Operasional',
            'jenis_rekap_id' => '4'
        ]);
        Kategori::create([
            'jenis_akun' => 'Beban Gaji',
            'jenis_rekap_id' => '4'
        ]);
        Kategori::create([
            'jenis_akun' => 'Beban Sewa',
            'jenis_rekap_id' => '4'
        ]);
        Kategori::create([
            'jenis_akun' => 'Modal',
            'jenis_rekap_id' => '5'
        ]);


        JenisRekap::create([
            'jenis_rekap' => 'Pendapatan'
        ]);

        JenisRekap::create([
            'jenis_rekap' => 'Kewajiban'
        ]);

        JenisRekap::create([
            'jenis_rekap' => 'Aset'
        ]);

        JenisRekap::create([
            'jenis_rekap' => 'Beban'
        ]);

        JenisRekap::create([
            'jenis_rekap' => 'Modal'
        ]);

        Permission::create(['name' => 'edit transaksi']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'edit kategori']);
        Permission::create(['name' => 'delete transaksi']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'delete kategori']);
        Permission::create(['name' => 'create transaksi']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'create kategori']);
        Permission::create(['name' => 'read kategori']);
        Permission::create(['name' => 'read user']);

        Role::create(['name' => 'user'])
            ->givePermissionTo([
                'create transaksi', 'edit transaksi', 'delete transaksi'
            ]);
        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'read kategori', 'create kategori', 'edit kategori', 'delete kategori'
            ]);
        Role::create(['name' => 'super admin'])
            ->givePermissionTo(Permission::all());

        Transaksi::create([
            'kategori_id' => '12',
            'jenis_saldo_id' => '1',
            'lokasi' => '',
            'nominal' => '300000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        Transaksi::create([
            'kategori_id' => '6',
            'jenis_saldo_id' => '1',
            'lokasi' => '',
            'nominal' => '300000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        Transaksi::create([
            'kategori_id' => '7',
            'jenis_saldo_id' => '1',
            'lokasi' => '',
            'nominal' => '20000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        Transaksi::create([
            'kategori_id' => '6',
            'jenis_saldo_id' => '2',
            'lokasi' => '',
            'nominal' => '20000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        Transaksi::create([
            'kategori_id' => '4',
            'jenis_saldo_id' => '1',
            'lokasi' => '',
            'nominal' => '15000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        Transaksi::create([
            'kategori_id' => '8',
            'jenis_saldo_id' => '1',
            'lokasi' => '',
            'nominal' => '15000000',
            'keterangan' => '-',
            'tanggal' => Carbon::now(),
            'user_id' => '1'
        ]);
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('allen123'),

        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'allen',
            'email' => 'allenchriselkurius@gmail.com',
            'password' => Hash::make('allen123')
        ]);
        $user->assignRole('super admin');
    }
}
