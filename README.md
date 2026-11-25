# Ashwick Outdoor Structures — Laravel 13 + Filament 3 Website, ERP & AI

Production-ready public website, Filament ERP, and AI assistants for a Charlotte, NC custom pergola and gazebo builder SME. Manage structure jobs, lumber inventory, invoices, appointments, knowledge base content, and FAQ-trained chatbot flows from one stack.

## ✨ Features

- 🏠 Premium public marketing site (hero, services, about, contact, journal)
- 🛠️ Service detail pages for pergolas, gazebos, and attached patio shade
- 📚 Seeded blog / knowledge base for homeowners and staff
- 📩 Contact form that stores leads in the database with flash confirmation
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🧾 Filament ERP admin at `/admin` (customers, jobs, inventory, invoices, payments, appointments)
- 👥 Roles: Admin, Manager, Staff (Spatie Permission + role column)
- 📊 Reports dashboard with stats and charts
- ⚙️ Company settings page
- 🤖 Admin AI Studio: blog generator, descriptions, automation suggestions, troubleshooting
- 🔐 Demo admin login seeded out of the box

## 🧰 Tech Stack

- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind (Filament)
- MySQL or SQLite (local demo)
- Spatie Laravel Permission
- OpenAI / Gemini HTTP integration with FAQ fallback (`App\Services\AiService`)

## 🚀 Installation

```bash
git clone https://github.com/imranbru99/pergola-gazebo-builder.git
cd pergola-gazebo-builder
composer install
copy .env.example .env   # Windows
php artisan key:generate
# Ensure database/database.sqlite exists when using SQLite
php artisan migrate --seed
php artisan serve
```

Admin panel: `http://localhost:8000/admin`  
Public site: `http://localhost:8000`

Optional AI keys in `.env`:

```
OPENAI_API_KEY=
OPENAI_MODEL=gpt-4o-mini
GEMINI_API_KEY=
GEMINI_MODEL=gemini-1.5-flash
```

Without keys, chatbot and AI Studio use Ashwick FAQ / demo generators.

### Demo credentials

- Email: `admin@example.com`
- Password: `password`

## 🖼️ Screenshots / Visual Dashboard

![Ashwick gazebo pavilion hero](https://images.unsplash.com/photo-1464146072230-91cabc968266?auto=format&fit=crop&w=1400&q=80)

![Cedar pergola outdoor living](https://images.unsplash.com/photo-1598902108854-10e335adac99?auto=format&fit=crop&w=1400&q=80)

![Ops visual / patio structure mood](https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1400&q=80)

## 🌐 Live Demo

Placeholder — deploy to your preferred host (Forge, Vapor, shared hosting with PHP 8.3+) and update this section with the production URL.

## 🔍 SEO-optimized repo description suggestion

`Ashwick Outdoor Structures — Laravel 13 + Filament 3 pergola & gazebo website, ERP, inventory, invoicing, scheduling, and AI chatbot for Charlotte SMEs.`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
