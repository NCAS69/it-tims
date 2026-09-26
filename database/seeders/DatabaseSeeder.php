<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\ChecklistItem;
use App\Models\InspectionTemplate;
use App\Models\Site;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(
            ['email' => 'admin@it-tims.local'],
            [
                'name' => 'IT Admin',
                'password' => Hash::make('password123'),
            ]
        );

        $inspector = User::updateOrCreate(
            ['email' => 'inspector@it-tims.local'],
            [
                'name' => 'IT Inspector',
                'password' => Hash::make('password123'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SITE
        |--------------------------------------------------------------------------
        */

        $site = Site::updateOrCreate(
            ['code' => 'PENEBANG'],
            [
                'name' => 'Penebang Site',
                'location' => 'Penebang',
                'description' => 'Site IT infrastructure Penebang',
                'status' => 'active',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | TOWERS
        |--------------------------------------------------------------------------
        */

        $sst120 = Tower::updateOrCreate(
            ['code' => 'SST120'],
            [
                'site_id' => $site->id,
                'name' => 'SST 120',
                'tower_type' => 'SST',
                'height' => 120,
                'description' => 'Main communication tower',
                'status' => 'active',
            ]
        );

        $lqUtama = Tower::updateOrCreate(
            ['code' => 'LQ-UTAMA'],
            [
                'site_id' => $site->id,
                'name' => 'LQ Utama',
                'tower_type' => 'Combat Tower',
                'height' => 42,
                'description' => 'Communication tower area LQ Utama',
                'status' => 'active',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | ASSET CATEGORIES
        |--------------------------------------------------------------------------
        */

        $networking = AssetCategory::updateOrCreate(
            ['name' => 'Networking'],
            [
                'description' => 'Switch, router, firewall, radio, access point, dan perangkat jaringan',
            ]
        );

        $power = AssetCategory::updateOrCreate(
            ['name' => 'Power'],
            [
                'description' => 'UPS, power supply, ATS, dan perangkat kelistrikan pendukung',
            ]
        );

        $cctv = AssetCategory::updateOrCreate(
            ['name' => 'CCTV'],
            [
                'description' => 'NVR, camera CCTV, dan perangkat pendukung CCTV',
            ]
        );

        $towerEquipment = AssetCategory::updateOrCreate(
            ['name' => 'Tower Equipment'],
            [
                'description' => 'Perangkat radio, antenna, feeder, dan perangkat tower lainnya',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | ASSETS
        |--------------------------------------------------------------------------
        */

        Asset::updateOrCreate(
            ['asset_code' => 'NET-SST120-MIKROTIK'],
            [
                'tower_id' => $sst120->id,
                'category_id' => $networking->id,
                'name' => 'MikroTik Router',
                'brand' => 'MikroTik',
                'model' => 'CCR2116',
                'ip_address' => '10.116.128.1',
                'status' => 'active',
                'description' => 'Core routing device',
            ]
        );

        Asset::updateOrCreate(
            ['asset_code' => 'NET-LQ-OMADA01'],
            [
                'tower_id' => $lqUtama->id,
                'category_id' => $networking->id,
                'name' => 'Managed Switch',
                'brand' => 'TP-Link Omada',
                'model' => 'SG3428XMP',
                'status' => 'active',
                'description' => 'Managed PoE switch',
            ]
        );

        Asset::updateOrCreate(
            ['asset_code' => 'PWR-SST120-UPS01'],
            [
                'tower_id' => $sst120->id,
                'category_id' => $power->id,
                'name' => 'UPS',
                'brand' => 'UPS',
                'model' => 'UPS Rack',
                'status' => 'active',
                'description' => 'UPS power backup',
            ]
        );

        Asset::updateOrCreate(
            ['asset_code' => 'CCTV-LQ-NVR01'],
            [
                'tower_id' => $lqUtama->id,
                'category_id' => $cctv->id,
                'name' => 'NVR CCTV',
                'brand' => 'Hikvision',
                'model' => 'NVR',
                'status' => 'active',
                'description' => 'Network video recorder',
            ]
        );

        Asset::updateOrCreate(
            ['asset_code' => 'RADIO-SST120-01'],
            [
                'tower_id' => $sst120->id,
                'category_id' => $towerEquipment->id,
                'name' => 'Wireless Radio',
                'brand' => 'AF',
                'model' => 'AF5XHD',
                'status' => 'active',
                'description' => 'Point-to-point wireless radio',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | INSPECTION TEMPLATE
        |--------------------------------------------------------------------------
        */

        $template = InspectionTemplate::updateOrCreate(
            ['name' => 'Monthly IT Tower Inspection'],
            [
                'description' => 'Template inspeksi rutin bulanan infrastruktur IT tower',
                'frequency' => 'monthly',
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | CHECKLIST ITEMS
        |--------------------------------------------------------------------------
        */

        $checklists = [
            [
                'category' => 'Tower',
                'item' => 'Kondisi fisik tower',
                'description' => 'Periksa struktur tower dari kerusakan atau korosi',
                'sort_order' => 1,
            ],
            [
                'category' => 'Networking',
                'item' => 'Kondisi switch',
                'description' => 'Periksa status switch, port, dan indikator',
                'sort_order' => 2,
            ],
            [
                'category' => 'Networking',
                'item' => 'Kondisi wireless radio',
                'description' => 'Periksa status radio dan koneksi link',
                'sort_order' => 3,
            ],
            [
                'category' => 'Power',
                'item' => 'Kondisi UPS',
                'description' => 'Periksa status UPS dan alarm',
                'sort_order' => 4,
            ],
            [
                'category' => 'Power',
                'item' => 'Kondisi power supply',
                'description' => 'Periksa PSU dan sumber listrik perangkat',
                'sort_order' => 5,
            ],
            [
                'category' => 'CCTV',
                'item' => 'Status NVR',
                'description' => 'Periksa status NVR dan penyimpanan',
                'sort_order' => 6,
            ],
            [
                'category' => 'CCTV',
                'item' => 'Kondisi kamera CCTV',
                'description' => 'Periksa tampilan dan konektivitas kamera',
                'sort_order' => 7,
            ],
            [
                'category' => 'Environment',
                'item' => 'Kebersihan area perangkat',
                'description' => 'Periksa debu, air, dan kondisi lingkungan sekitar perangkat',
                'sort_order' => 8,
            ],
        ];

        foreach ($checklists as $checklist) {
            ChecklistItem::updateOrCreate(
                [
                    'template_id' => $template->id,
                    'item' => $checklist['item'],
                ],
                [
                    'category' => $checklist['category'],
                    'description' => $checklist['description'],
                    'input_type' => 'status',
                    'sort_order' => $checklist['sort_order'],
                    'is_required' => true,
                ]
            );
        }
    }
}