<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Ashwick Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(704) 555-0100',
            ]
        );
        $admin->assignRole('admin');

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@ashwickoutdoor.com'],
            [
                'name' => 'Elena Voss',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(704) 555-0101',
            ]
        );
        $manager->assignRole('manager');

        $staff = User::query()->updateOrCreate(
            ['email' => 'crew@ashwickoutdoor.com'],
            [
                'name' => 'Marcus Quinn',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(704) 555-0102',
            ]
        );
        $staff->assignRole('staff');

        $images = config('brand.images');

        $services = [
            [
                'name' => 'Custom Freestanding Pergola',
                'slug' => 'custom-freestanding-pergola',
                'tagline' => 'Open-roof shade sized for dining and lounging.',
                'summary' => 'Engineered cedar or aluminum pergolas with precise footings and optional lighting.',
                'body' => "Our signature Ashwick pergola includes site engineering for Carolina soils, shop-cut joinery, and exterior stains rated for UV and humidity.\n\nIdeal for patio dining zones, poolside seating, and attached living extensions that still want sky light.\n\nIncludes optional LED kits, privacy screens, and a final punch-list walkthrough.",
                'image_url' => $images['service_pergola'],
                'starting_price' => 8500,
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'name' => 'Classic Gazebo Pavilion',
                'slug' => 'classic-gazebo-pavilion',
                'tagline' => 'Freestanding shelter with solid or louvered roof.',
                'summary' => 'Octagon and rectangular gazebos for gardens, lawns, and entertaining yards.',
                'body' => "When you need weather-ready shade, we build freestanding gazebos with sturdy roofs, rail options, and finishes that complement your landscape.\n\nGreat for wedding lawns, backyard retreats, and HOA communities that want a refined pavilion look.",
                'image_url' => $images['service_gazebo'],
                'starting_price' => 14500,
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'name' => 'Attached Patio Cover & Shade',
                'slug' => 'attached-patio-cover-shade',
                'tagline' => 'Ledger-mounted structures that expand indoor living outdoors.',
                'summary' => 'Code-aware attached pergolas and shade covers tied into existing homes.',
                'body' => "We flash ledgers properly, match roof pitches when required, and coordinate with electricians for fans and outlets.\n\nPair with screening, curtains, or louvered roof systems for four-season comfort.",
                'image_url' => $images['service_attached'],
                'starting_price' => 11200,
                'sort_order' => 3,
                'is_featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['slug' => $service['slug']], $service);
        }

        Post::query()->updateOrCreate(['slug' => 'cedar-pergola-sizing-charlotte'], [
            'title' => 'How to Size a Cedar Pergola for Charlotte Entertaining',
            'excerpt' => 'Furniture zones, sun angles, and Carolina summer shade rules of thumb.',
            'body' => "Charlotte summers are long and bright. A pergola that feels generous on paper can still leave the dining table in glare if rafter spacing and orientation ignore afternoon sun.\n\nAshwick maps furniture zones first—table, lounge, grill—then sizes posts and beams so the structure feels intentional, not cramped. We also plan for ceiling fans and low-voltage lighting during the design phase.",
            'cover_image' => $images['blog1'],
            'category' => 'design',
            'author_name' => 'Elena Voss',
            'published_at' => now()->subDays(12),
            'is_published' => true,
        ]);

        Post::query()->updateOrCreate(['slug' => 'pergola-vs-gazebo-decision'], [
            'title' => 'Pergola vs Gazebo: Which Outdoor Structure Fits Your Yard?',
            'excerpt' => 'Open sky vs solid shelter—and how HOAs often weigh in.',
            'body' => "Pergolas keep a connection to the sky and pair beautifully with vines or retractable canopies. Gazebos deliver more weather protection and a destination feel in the landscape.\n\nBudget, setbacks, and intended use decide the winner. Ashwick walks both options with permit and HOA realities for Mecklenburg County homeowners.",
            'cover_image' => $images['blog2'],
            'category' => 'planning',
            'author_name' => 'Ashwick Team',
            'published_at' => now()->subDays(5),
            'is_published' => true,
        ]);

        Post::query()->updateOrCreate(['slug' => 'footing-prep-carolina-clay'], [
            'title' => 'Footing Prep in Carolina Clay: What Homeowners Should Expect',
            'excerpt' => 'Depth, drainage, and why rushed posts fail.',
            'body' => "Expansive clay soils need proper footing depth and drainage. We dig to local code, set post bases correctly, and keep water moving away from posts so your pergola stays plumb for years.",
            'cover_image' => $images['blog3'],
            'category' => 'process',
            'author_name' => 'Marcus Quinn',
            'published_at' => now()->subDay(),
            'is_published' => true,
        ]);

        $kb = [
            [
                'title' => 'Warped pergola rafters after a wet season',
                'slug' => 'warped-pergola-rafters',
                'category' => 'common_issues',
                'summary' => 'Why lumber moves and how proper species & fastening help.',
                'body' => "Rafters warp when undersized lumber is used or when finish is skipped on all faces. Ashwick selects kiln-dried stock, seals end grain, and uses fastening patterns that allow controlled movement without racking the frame.",
                'sort_order' => 1,
            ],
            [
                'title' => 'Ledger leaks on attached patio covers',
                'slug' => 'ledger-leaks-attached-covers',
                'category' => 'common_issues',
                'summary' => 'Flashing failures cause wall rot—here is how we prevent them.',
                'body' => "We never rely on caulk alone. Proper counter-flashing into the house wrap or siding, corrosion-resistant ledger fasteners, and slope away from the wall keep attached structures dry.",
                'sort_order' => 2,
            ],
            [
                'title' => 'Step-by-step: Ashwick build process',
                'slug' => 'step-by-step-ashwick-build',
                'category' => 'guides',
                'summary' => 'From shade consult to final stain.',
                'body' => "1. Site measure & shade consult\n2. Design & permit packet\n3. Shop fabrication\n4. Footings / ledger\n5. Frame & roof\n6. Stain, lighting, walkthrough",
                'sort_order' => 1,
            ],
            [
                'title' => 'Homeowner prep checklist for install week',
                'slug' => 'homeowner-prep-install-week',
                'category' => 'guides',
                'summary' => 'Clear access and protect landscaping.',
                'body' => "Mark irrigation lines if known, move patio furniture, secure pets, and leave driveway access for lumber delivery. We protect turf with plywood paths when needed.",
                'sort_order' => 2,
            ],
            [
                'title' => 'Admin manual: logging a new structure job',
                'slug' => 'admin-manual-new-job',
                'category' => 'admin_manual',
                'summary' => 'ERP steps for managers.',
                'body' => "1. Create or select Customer\n2. Add Job with status Estimate\n3. Schedule Appointment (site measure)\n4. After approval, move Job to Scheduled and assign crew lead\n5. Create Invoice draft when fabrication starts\n6. Record Payments as deposits clear",
                'sort_order' => 1,
            ],
            [
                'title' => 'Admin manual: lumber inventory reorder cues',
                'slug' => 'admin-manual-inventory',
                'category' => 'admin_manual',
                'summary' => 'Keep posts, beams, and hardware stocked.',
                'body' => "Check Products weekly. Reorder when stock_qty falls below 12 for 6x6 posts or 40 for post bases. Tag low stock in notes for the next mill run.",
                'sort_order' => 2,
            ],
            [
                'title' => 'Troubleshooting: AI chat returns FAQ only',
                'slug' => 'troubleshoot-ai-faq-only',
                'category' => 'troubleshooting',
                'summary' => 'Missing API keys fall back to demo knowledge.',
                'body' => "Set OPENAI_API_KEY or GEMINI_API_KEY in .env. Until then, the chatbot answers from Ashwick FAQ content—which is intentional for local demos.",
                'sort_order' => 1,
            ],
            [
                'title' => 'Troubleshooting: invoice balance still open',
                'slug' => 'troubleshoot-invoice-balance',
                'category' => 'troubleshooting',
                'summary' => 'Payments must be logged against the invoice.',
                'body' => "Create a Payment linked to the Invoice. Update amount_paid and status to partial/paid. Jobs can complete while a balance remains—don't confuse status fields.",
                'sort_order' => 2,
            ],
        ];

        foreach ($kb as $article) {
            KnowledgeArticle::query()->updateOrCreate(['slug' => $article['slug']], $article + ['is_published' => true]);
        }

        $products = [
            ['name' => 'Cedar 6x6 Post – 10 ft', 'sku' => 'CDR-POST-66-10', 'category' => 'lumber', 'unit_cost' => 86, 'unit_price' => 145, 'stock_qty' => 28],
            ['name' => 'Cedar 2x8 Rafter – 12 ft', 'sku' => 'CDR-RFT-28-12', 'category' => 'lumber', 'unit_cost' => 32, 'unit_price' => 58, 'stock_qty' => 64],
            ['name' => 'Galvanized Post Base', 'sku' => 'HDW-PB-01', 'category' => 'hardware', 'unit_cost' => 18, 'unit_price' => 34, 'stock_qty' => 80],
            ['name' => 'Exterior Stain – Warm Cedar', 'sku' => 'STN-CDR-01', 'category' => 'finish', 'unit_cost' => 38, 'unit_price' => 72, 'stock_qty' => 22],
            ['name' => 'LED String / Beam Kit', 'sku' => 'LIT-LED-BM', 'category' => 'lighting', 'unit_cost' => 55, 'unit_price' => 120, 'stock_qty' => 18],
            ['name' => 'Carriage Bolt Assortment', 'sku' => 'HDW-CB-ASST', 'category' => 'hardware', 'unit_cost' => 12, 'unit_price' => 28, 'stock_qty' => 40],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + [
                'description' => 'Ashwick shop stock for pergola and gazebo builds.',
                'unit' => 'each',
                'is_active' => true,
            ]);
        }

        $customer = Customer::query()->updateOrCreate(
            ['email' => 'jordan.blake@example.com'],
            [
                'name' => 'Jordan Blake',
                'phone' => '(704) 555-0199',
                'address' => '214 Myers Park Ln',
                'city' => 'Charlotte',
                'state' => 'NC',
                'zip' => '28207',
                'notes' => 'Wants 14x16 cedar pergola with LED beams.',
            ]
        );

        $customer2 = Customer::query()->updateOrCreate(
            ['email' => 'sofia.nguyen@example.com'],
            [
                'name' => 'Sofia Nguyen',
                'phone' => '(704) 555-0177',
                'address' => '88 Lakeview Ridge',
                'city' => 'Huntersville',
                'state' => 'NC',
                'zip' => '28078',
            ]
        );

        $job = Job::query()->updateOrCreate(
            ['job_number' => 'AO-2142'],
            [
                'customer_id' => $customer->id,
                'assigned_to' => $staff->id,
                'title' => 'Myers Park – freestanding cedar pergola',
                'description' => '14x16 cedar, warm stain, LED beam kit, four post bases.',
                'service_type' => 'pergola',
                'status' => 'in_progress',
                'priority' => 'high',
                'address' => $customer->address.', '.$customer->city,
                'start_date' => now()->subDays(2)->toDateString(),
                'due_date' => now()->addDays(4)->toDateString(),
                'estimated_value' => 12800,
                'actual_value' => 0,
            ]
        );

        Job::query()->updateOrCreate(
            ['job_number' => 'AO-2148'],
            [
                'customer_id' => $customer2->id,
                'assigned_to' => $manager->id,
                'title' => 'Huntersville – octagon gazebo',
                'service_type' => 'gazebo',
                'status' => 'estimate',
                'priority' => 'normal',
                'address' => $customer2->address.', '.$customer2->city,
                'start_date' => now()->addDays(10)->toDateString(),
                'due_date' => now()->addDays(20)->toDateString(),
                'estimated_value' => 22400,
            ]
        );

        $invoice = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-3401'],
            [
                'customer_id' => $customer->id,
                'job_id' => $job->id,
                'issue_date' => now()->subDays(3)->toDateString(),
                'due_date' => now()->addDays(12)->toDateString(),
                'status' => 'partial',
                'subtotal' => 12800,
                'tax' => 0,
                'total' => 12800,
                'amount_paid' => 4000,
                'notes' => 'Deposit received; balance due at completion.',
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'DEP-3401'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 4000,
                'method' => 'card',
                'paid_at' => now()->subDays(3)->toDateString(),
                'notes' => 'Project deposit',
            ]
        );

        Appointment::query()->updateOrCreate(
            [
                'customer_id' => $customer->id,
                'title' => 'Myers Park frame day 2',
            ],
            [
                'job_id' => $job->id,
                'assigned_to' => $staff->id,
                'type' => 'install',
                'status' => 'scheduled',
                'starts_at' => now()->addDay()->setTime(8, 0),
                'ends_at' => now()->addDay()->setTime(16, 0),
                'location' => $customer->address,
            ]
        );

        Appointment::query()->updateOrCreate(
            [
                'customer_id' => $customer2->id,
                'title' => 'Site measure – Huntersville gazebo',
            ],
            [
                'assigned_to' => $manager->id,
                'type' => 'site_measure',
                'status' => 'scheduled',
                'starts_at' => now()->addDays(3)->setTime(10, 0),
                'ends_at' => now()->addDays(3)->setTime(11, 30),
                'location' => $customer2->address,
            ]
        );

        Setting::setValue('company_name', config('brand.name'));
        Setting::setValue('phone', config('brand.phone'));
        Setting::setValue('email', config('brand.email'));
        Setting::setValue('address', config('brand.address'));
        Setting::setValue('whatsapp', config('brand.whatsapp'));
    }
}
