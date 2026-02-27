<?php

namespace Database\Seeders;

use App\Models\KasPayment;
use App\Models\OrganizationMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin user
        User::create([
            'name' => 'Admin HMTI',
            'email' => 'admin@hmti.ac.id',
            'nim' => '20260001',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'generation' => '2024',
            'joined_at' => '2024-09-01',
        ]);

        // 2. Organization Structure - KWSB
        OrganizationMember::create([
            'name' => 'Firman',
            'division' => 'kwsb',
            'position' => 'ketua',
            'sort_order' => 1,
        ]);
        OrganizationMember::create([
            'name' => 'Syafiq',
            'division' => 'kwsb',
            'position' => 'wakil',
            'sort_order' => 2,
        ]);
        OrganizationMember::create([
            'name' => 'Haidar',
            'division' => 'kwsb',
            'position' => 'sekretaris',
            'sort_order' => 3,
        ]);
        OrganizationMember::create([
            'name' => 'Farista',
            'division' => 'kwsb',
            'position' => 'bendahara',
            'sort_order' => 4,
        ]);

        // 3. Organization Structure - Kominfo
        OrganizationMember::create([
            'name' => 'Fadil',
            'division' => 'kominfo',
            'position' => 'kadiv',
            'sort_order' => 1,
        ]);
        OrganizationMember::create([
            'name' => 'Zahra',
            'division' => 'kominfo',
            'position' => 'staff',
            'sort_order' => 2,
        ]);
        OrganizationMember::create([
            'name' => 'Taufiq',
            'division' => 'kominfo',
            'position' => 'staff',
            'sort_order' => 3,
        ]);
        OrganizationMember::create([
            'name' => 'Sutan',
            'division' => 'kominfo',
            'position' => 'staff',
            'sort_order' => 4,
        ]);

        // 4. Organization Structure - Litbang
        OrganizationMember::create([
            'name' => 'Aqib',
            'division' => 'litbang',
            'position' => 'kadiv',
            'sort_order' => 1,
        ]);
        OrganizationMember::create([
            'name' => 'Amri',
            'division' => 'litbang',
            'position' => 'staff',
            'sort_order' => 2,
        ]);
        OrganizationMember::create([
            'name' => 'Bukhori',
            'division' => 'litbang',
            'position' => 'staff',
            'sort_order' => 3,
        ]);

        // 5. Organization Structure - PSDM
        OrganizationMember::create([
            'name' => 'Nauval',
            'division' => 'psdm',
            'position' => 'kadiv',
            'sort_order' => 1,
        ]);
        OrganizationMember::create([
            'name' => 'Kayla',
            'division' => 'psdm',
            'position' => 'staff',
            'sort_order' => 2,
        ]);
        OrganizationMember::create([
            'name' => 'Safana',
            'division' => 'psdm',
            'position' => 'staff',
            'sort_order' => 3,
        ]);

        // 6. Generate kas payments for current month
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $members = OrganizationMember::all();

        // Generate for Jan to current month
        for ($m = 1; $m <= $currentMonth; $m++) {
            foreach ($members as $member) {
                $isLate = $m < $currentMonth; // past months are considered late if unpaid
                $isPaid = fake()->boolean(60); // 60% chance of being paid for demo

                KasPayment::create([
                    'organization_member_id' => $member->id,
                    'month' => $m,
                    'year' => $currentYear,
                    'amount' => KasPayment::MONTHLY_AMOUNT,
                    'is_paid' => $isPaid,
                    'paid_at' => $isPaid ? now()->subDays(rand(1, 28)) : null,
                    'is_late' => !$isPaid && $isLate,
                    'fine_amount' => (!$isPaid && $isLate) ? KasPayment::LATE_FINE : 0,
                    'total_amount' => KasPayment::MONTHLY_AMOUNT + ((!$isPaid && $isLate) ? KasPayment::LATE_FINE : 0),
                ]);
            }
        }
    }
}
